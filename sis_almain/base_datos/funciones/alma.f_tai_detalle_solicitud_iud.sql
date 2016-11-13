--------------- SQL ---------------

CREATE OR REPLACE FUNCTION alma.f_tai_detalle_solicitud_iud (
  pm_id_usuario integer,
  pm_ip_origen varchar,
  pm_mac_maquina text,
  pm_codigo_procedimiento varchar,
  pm_proc_almacenado varchar,
  al_id_detalle_solicitud integer,
  al_id_solicitud_salida integer,
  al_id_item integer,
  al_cantidad numeric
)
RETURNS varchar AS
$body$
/************************************************************************** 
AUTOR:           Ruddy Limbert Lujan Bravo
FECHA:           18-09-2013
DESCRIPCION:     Realiza modificaciones en la tabla alma.f_tai_detalle_solicitud
***************************************************************************/

-- PARAMETROS FIJOS
/*
pm_id_usuario                               integer (si)
pm_ip_origen                                varchar(40) (si)
pm_mac_maquina                              macaddr (si)
pm_log_error                                varchar -- log -- error //variable interna (si)
pm_codigo_procedimiento                     varchar  // valor que identifica el detalle
                                                        de operacion a realizar
                                                        insert  (insertar)
                                                        delete  (eliminar)
                                                        update  (actualizar)
                                                        select  (visualizar)
pm_proc_almacenado                          varchar  // para colocar el nombre del procedimiento en caso de ser llamado
                                                        por otro procedimiento
*/

DECLARE

  --PARAMETROS FIJOS
  g_id_subsistema integer; -- ID SUBSISTEMA
  g_id_lugar integer; -- ID LUGAR
  g_numero_error varchar; -- ALMACENA EL NUMERO DE ERROR
  g_mensaje_error varchar; -- ALMACENA MENSAJE DEL ERROR
  g_privilegio_procedimiento boolean;
  -- BANDERA PARA VERIFICAR LLAMADA DE LA FUNCION
  g_descripcion_log_error text; -- PARA ALMACENAR EL MENSAJE DE ERROR O LOG
  g_reg_evento varchar;
  g_reg_error varchar;
  g_respuesta varchar; -- VARIABLE QUE CONTIENE LA RESPUESTA DE LA FUNCION
  g_nivel_error varchar; -- VARIABLE QUE CONTIENE EL NIVEL DE ERROR
  --      ERROR DE SINTAXIS (cuando llega a exception) = 1
  --      ERROR LOGICO (CRAMATICO) = 2
  --      ERROR LOGICO (INTERMEDIO) = 3
  --      ERROR LOGICO (ADVERTENCIA) = 4
  g_nombre_funcion varchar;
  g_separador varchar(10); -- SEPARADOR DE CADENAS
  g_id_fina_regi_prog_proy_acti integer;
  -- VARIABLE DE LA ESTRUCTURA PROGRAMATICA

  --VARIABLES
  g_nro_reclamo integer;
  g_id_param integer;
  g_codigo_sucursal_padre varchar;
  g_codigo_largo varchar;
  g_id_padre_arb varchar;
  g_id_sucursal_padre integer;
  g_auxiliar varchar;
  g_registros record;
  g_id_detalle_solicitud integer;
  g_estado_padre varchar;

BEGIN
  --- INICIACION DE VARIABLES
  g_separador = '#@@@#'; --Separador para mensajes devueltos por la funcion
  g_nombre_funcion :='f_tai_detalle_solicitud_iud';
  g_privilegio_procedimiento := FALSE;
  g_respuesta := FALSE;

  ---*** OBTENCION DEL ID DEL SUBSISTEMA

  SELECT id_subsistema
  INTO g_id_subsistema
  FROM sss.tsg_procedimiento_db
  WHERE codigo_procedimiento = pm_codigo_procedimiento;

  ---*** OBTENCION DEL ID DEL LUGAR ASIGNADO AL USUARIO

  SELECT tsg_usuario_lugar.id_lugar
  INTO g_id_lugar
  FROM sss.tsg_usuario_lugar
  WHERE tsg_usuario_lugar.id_usuario = pm_id_usuario;

  ---*** VALIDACION DE LLAMADA POR USUARIO O FUNCION
  IF pm_proc_almacenado IS NOT NULL THEN
    IF NOT EXISTS(
      SELECT 1
      FROM pg_proc
      WHERE proname = pm_proc_almacenado) THEN
      g_descripcion_log_error := 'Procedimiento ejecutor inexistente';
      g_nivel_error := '2';
      g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error,
        g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);

      --REGISTRA EL LOG
      g_reg_evento:= sss.f_tsg_registro_evento(pm_id_usuario             ,
        g_id_subsistema           ,g_id_lugar         ,g_descripcion_log_error,
        pm_ip_origen              ,pm_mac_maquina            ,'error'
          ,NULL,
        pm_codigo_procedimiento   ,pm_proc_almacenado);
      --DEVUELVE MENSAJE DE ERROR
      RETURN 'f'||g_separador||g_respuesta||g_separador||g_reg_evento;
      ELSE
      g_privilegio_procedimiento := TRUE;
    END IF;
  END IF;

  ---*** VERIFICACION DE PERMISOS DEL USUARIO
  IF NOT g_privilegio_procedimiento THEN
    g_privilegio_procedimiento := sss.f_sg_validacion_procedimiento(
      pm_id_usuario,pm_codigo_procedimiento,NULL);
  END IF;

  ---*** SI NO SE TIENE PERMISOS DE EJECUCION SE RETORNA EL MENSAJE DE ERROR
  IF NOT g_privilegio_procedimiento THEN
    g_nivel_error := '3';
    g_descripcion_log_error :=
      'El usuario no tiene permisos de ejecucion del procedimiento';
    g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error,
      g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);

    --REGISTRA EL LOG
    g_reg_evento:= sss.f_tsg_registro_evento(pm_id_usuario             ,
      g_id_subsistema           ,g_id_lugar         ,g_descripcion_log_error,
      pm_ip_origen              ,pm_mac_maquina            ,'error'            ,
        NULL,
      pm_codigo_procedimiento   ,pm_proc_almacenado);

    --DEVUELVE MENSAJE DE ERROR
    RETURN 'f'||g_separador||g_respuesta||g_separador||g_reg_evento;
  END IF;

  --*** EJECUCION DEL PROCEDIMIENTO ESPECIFICO
  IF pm_codigo_procedimiento = 'AL_DETSOL_INS' THEN
    BEGIN
    	 --control de insercion de un unico item en una solicitud
        if EXISTS (select 1 from alma.tai_detalle_solicitud det where det.id_solicitud_salida=al_id_solicitud_salida AND det.id_item=al_id_item)
        then
        	g_descripcion_log_error := 'El item seleccionado ya fue registrado en la solicitud.';
            g_nivel_error := '4';
            g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
            RETURN 'f'||g_separador||g_respuesta;
        end if;
    
    
      INSERT INTO alma.tai_detalle_solicitud(
    		id_solicitud_salida, 
            id_item, 
            cantidad
            )
      VALUES (
            al_id_solicitud_salida, 
            al_id_item, 
            al_cantidad
      );

      -- DESCRIPCION DE EXITO PARA GUARDAR EN EL LOG
      g_descripcion_log_error :=
        'Registro exitoso de un nuevo registro en la tabla detalle_solicitud';
      g_respuesta := 't'||g_separador||g_descripcion_log_error;
    END;
    --insert de mov -> solicitud
     ELSIF pm_codigo_procedimiento = 'AL_DETSOL_INS2' THEN
    BEGIN 
    		INSERT INTO alma.tai_detalle_solicitud(
    		id_solicitud_salida, 
            id_item, 
            cantidad
            )
      VALUES (
            al_id_solicitud_salida, 
            al_id_item, 
            al_cantidad
      );  
    END;
    
    ELSIF pm_codigo_procedimiento = 'AL_DETSOL_UPD' THEN
    BEGIN   
      select id_detalle_solicitud
      into g_id_detalle_solicitud
      from alma.tai_detalle_solicitud
      where id_detalle_solicitud = al_id_detalle_solicitud;

      IF NOT EXISTS(select 1 from alma.tai_detalle_solicitud det where det.id_detalle_solicitud=al_id_detalle_solicitud) THEN
              g_descripcion_log_error :='Modificacion no realizada: no existe el registro '||al_id_detalle_solicitud || ' en la tabla alma.tai_detalle_solicitud';
              g_nivel_error := '4';
              g_respuesta := f_pm_mensaje_error(g_descripcion_log_error,g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
        RETURN 'f'||g_separador||g_respuesta;
      END IF;
      
      UPDATE alma.tai_detalle_solicitud
      SET 
          usuario_reg = "current_user"(),
          fecha_reg = now(),
          id_solicitud_salida = al_id_solicitud_salida,
          id_item = al_id_item,
          cantidad = al_cantidad
      WHERE alma.tai_detalle_solicitud.id_detalle_solicitud = al_id_detalle_solicitud;

      -- DESCRIPCION DE EXITO PARA GUARDAR EN EL LOG
      g_descripcion_log_error :=
        'Modificacion exitosa en alma.tai_detalle_solicitud del registro '||
        al_id_detalle_solicitud   ;
      g_respuesta := 't'||g_separador||g_descripcion_log_error;

    END;
    ELSIF pm_codigo_procedimiento = 'AL_DETSOL_DEL' THEN
    BEGIN
      select id_detalle_solicitud
      into g_id_detalle_solicitud
      from alma.tai_detalle_solicitud
      where id_detalle_solicitud = al_id_detalle_solicitud;

      IF g_id_detalle_solicitud is null THEN
        g_nivel_error := '4';
        g_descripcion_log_error := 'Eliminacion no realizada: registro '||al_id_detalle_solicitud || ' en detalle alma.tai_detalle_solicitud inexistente';
        g_respuesta := f_pm_mensaje_error(g_descripcion_log_error,g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
        RETURN 'f'||g_separador||g_respuesta;
      END IF;
      DELETE
      FROM alma.tai_detalle_solicitud
      WHERE id_detalle_solicitud = al_id_detalle_solicitud;

      -- DESCRIPCION DE EXITO PARA GUARDAR EN EL LOG
      g_descripcion_log_error := 'Eliminacion exitosa del registro '||
        al_id_detalle_solicitud||' alma.tai_detalle_solicitud';
      g_respuesta := 't'||g_separador||g_descripcion_log_error;
    END;
    ELSE
    --PROCEDIMIENTO INEXISTENTE
    g_nivel_error := '2';
    g_descripcion_log_error := 'Procedimiento inexistente';
    g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error,
      g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);

    --REGISTRA EL LOG
    g_reg_evento:= sss.f_tsg_registro_evento(
      pm_id_usuario,
      g_id_subsistema,
      g_id_lugar,
      g_descripcion_log_error,
      pm_ip_origen,
      pm_mac_maquina,
      'error',
      NULL,
      pm_codigo_procedimiento,
      pm_proc_almacenado
    );
    --DEVUELVE MENSAJE DE ERROR
    RETURN 'f'||g_separador||g_respuesta||g_separador||g_reg_evento;

  END IF;

  ---*** REGISTRO EN EL LOG EL EXITO DE LA EJECUCION DEL PROCEDIMIENTO
  g_reg_evento:= sss.f_tsg_registro_evento(pm_id_usuario             ,
    g_id_subsistema           ,g_id_lugar         ,g_descripcion_log_error,
    pm_ip_origen              ,pm_mac_maquina            ,'log'              ,
      NULL,
    pm_codigo_procedimiento   ,pm_proc_almacenado);

  ---*** SE DEVUELVE LA RESPUESTA
  RETURN g_respuesta||g_separador||g_reg_evento;

  EXCEPTION

  WHEN others THEN
  BEGIN
    --SE OBTIENE EL MENSAJE Y EL N�????MERO DEL ERROR LANZADO POR EL GESTOR DE BASE DE DATOS
    g_mensaje_error := SQLERRM ;
    g_numero_error := SQLSTATE;

    -- SE REGISTRA EL ERROR OCURRIDO
    g_reg_error:= sss.f_tsg_registro_evento (pm_id_usuario            ,
      g_id_subsistema          ,g_id_lugar         ,g_mensaje_error,
      pm_ip_origen             ,pm_mac_maquina           ,'error'            ,
        g_numero_error,
      pm_codigo_procedimiento  ,pm_proc_almacenado);

    --SE DEVUELVE EL MENSAJE DE ERROR
    g_nivel_error := '1';
    g_descripcion_log_error := g_numero_error || ' - ' || g_mensaje_error;
    g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error,
      g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
    RETURN 'f'||g_separador||g_respuesta||g_separador||g_reg_error;
  END;

END;
$body$
LANGUAGE 'plpgsql'
VOLATILE
CALLED ON NULL INPUT
SECURITY INVOKER;