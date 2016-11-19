--------------- SQL ---------------

CREATE OR REPLACE FUNCTION alma.f_tai_movimiento_proyecto_iud (
  pm_id_usuario integer,
  pm_ip_origen varchar,
  pm_mac_maquina text,
  pm_codigo_procedimiento varchar,
  pm_proc_almacenado varchar,
  al_id_movimiento_proyecto integer,
  al_id_almacen integer,
  al_id_tipo_movimiento integer,
  al_fecha_ingreso timestamp,
  al_origen_ingreso varchar,
  al_id_contratista integer,
  al_id_proveedor integer,
  al_id_empleado integer,
  al_id_institucion integer,
  al_concepto_ingreso varchar,
  al_observaciones varchar,
  al_entregado varchar,
  al_nota_remision varchar,
  al_nro_contrato varchar,
  al_peso_neto numeric
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA ENDESIS - SISTEMA Almacen 
***************************************************************************
 SCRIPT:          alma.f_tai_movimiento_proyecto_iud
 DESCRIPCION:     Realiza modificaciones en la tabla alma.tai_movimiento_proyecto
 AUTOR:           UNKNOW
 FECHA:           23-10-2014
 COMENTARIOS:    
***************************************************************************
 HISTORIA DE MODIFICACIONES:

 DESCRIPCION:  
 AUTOR:           
 FECHA:          

***************************************************************************/

--------------------------
-- CUERPO DE LA FUNCION --
--------------------------

-- PARMETROS FIJOS
/*
pm_id_usuario                               integer (si)
pm_ip_origen                                varchar(40) (si)
pm_mac_maquina                              macaddr (si)
pm_log_error                                varchar -- log -- error //variable interna (si)
pm_codigo_procedimiento                     varchar  // valor que identifica el tipo
                                                        de operacion a realizar
                                                        insert  (insertar)
                                                        delete  (eliminar)
                                                        update  (actualizar)
                                                        select  (visualizar)
pm_proc_almacenado                          varchar  // para colocar el nombre del procedimiento en caso de ser llamado
                                                        por otro procedimiento

*/

-- PARA�?METROS VARIABLES
/*
cb_id_movimiento
cb_id_sucursal
cb_id_usuario
cb_estado
*/

-- DECLARACION DE VARIABLES PARTICULARES

--**** DECLARACION DE VARIABLES DE LA FUNCION (LOCALES) ****---


DECLARE

    --PARAMETROS FIJOS

    g_id_subsistema               integer;     -- ID SUBSISTEMA
    g_id_lugar                    integer;     -- ID LUGAR
    g_numero_error                varchar;     -- ALMACENA EL N�????MERO DE ERROR
    g_mensaje_error               varchar;     -- ALMACENA MENSAJE DEL ERROR
    g_privilegio_procedimiento    boolean;     -- BANDERA PARA VERIFICAR LLAMADA DE LA FUNCI�????N
    g_descripcion_log_error       text;        -- PARA ALMACENAR EL MENSAJE DE ERROR O LOG
    g_reg_evento                  varchar; 
    g_reg_error                	  varchar; 
    g_respuesta                   varchar;     -- VARIABLE QUE CONTIENE LA RESPUESTA DE LA FUNCI�????N
    g_nivel_error                 varchar;     -- VARIABLE QUE CONTIENE EL NIVEL DE ERROR
                                               --      ERROR DE SINTAXIS (cuando llega a exception) = 1
                                               --      ERROR L�????GICO (CR�???�??�?TICO) = 2
                                               --      ERROR L�????GICO (INTERMEDIO) = 3
                                               --      ERROR L�????GICO (ADVERTENCIA) = 4
    
    g_nombre_funcion              	varchar;     -- NOMBRE F�???�??�?SICO DE LA FUNCI�????N
    g_separador                   	varchar(10); -- SEPARADOR DE CADENAS
    g_id_movimiento					integer;
    g_estado						varchar;
    
    --a�adido 12-05-2015
    v_id_gestion					integer;
    v_id_empresa					integer;
    v_id_periodo					integer;
    v_correlativo					integer;
	v_aux							integer;
	v_cad							varchar;
    v_cad_periodo					varchar;
    v_codigo						varchar;
    v_periodo						integer;
    v_datos_correlativo				record;
    v_gen_code						varchar;
    v_datos							record;
    	
BEGIN
---*** INICIACION DE VARIABLES 
    g_separador = '#@@@#'; --Separador para mensajes devueltos por la funcion	
    g_nombre_funcion :='f_tai_movimiento_iud';
    g_privilegio_procedimiento := FALSE;
    g_respuesta := FALSE;
   
    ---*** OBTENCION DEL ID DEL SUBSISTEMA
    SELECT id_subsistema
    INTO g_id_subsistema
    FROM sss.tsg_procedimiento_db
    WHERE codigo_procedimiento = pm_codigo_procedimiento;


    ---*** OBTENC?ION DEL ID DEL LUGAR ASIGNADO AL USUARIO
    SELECT tsg_usuario_lugar.id_lugar
    INTO   g_id_lugar
    FROM   sss.tsg_usuario_lugar
    WHERE  tsg_usuario_lugar.id_usuario = pm_id_usuario;
    
    
     ---*** VALIDACION DE LLAMADA POR USUARIO O FUNCION
    IF pm_proc_almacenado IS NOT NULL THEN
        IF NOT EXISTS(SELECT 1 FROM pg_proc WHERE proname = pm_proc_almacenado) THEN
            g_descripcion_log_error := 'Procedimiento ejecutor inexistente';
            g_nivel_error := '2';
            g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
            
            --REGISTRA EL LOG
            g_reg_evento:= sss.f_tsg_registro_evento(pm_id_usuario             ,g_id_subsistema           ,g_id_lugar         ,g_descripcion_log_error,
                                                 pm_ip_origen              ,pm_mac_maquina            ,'error'            ,NULL,
                                                 pm_codigo_procedimiento   ,pm_proc_almacenado);
            --DEVUELVE MENSAJE DE ERROR
            RETURN 'f'||g_separador||g_respuesta||g_separador||g_reg_evento;
        ELSE
            g_privilegio_procedimiento := TRUE;
        END IF;
    END IF;

    ---*** VERIFICACI�????N DE PERMISOS DEL USUARIO
    IF NOT g_privilegio_procedimiento THEN
       g_privilegio_procedimiento := sss.f_sg_validacion_procedimiento(pm_id_usuario,pm_codigo_procedimiento,NULL);
    END IF;

---*** SI NO SE TIENE PERMISOS DE EJECUCION SE RETORNA EL MENSAJE DE ERROR
    IF NOT g_privilegio_procedimiento THEN
        g_nivel_error := '3';
        g_descripcion_log_error := 'El usuario no tiene permisos de ejecucion del procedimiento';
        g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);

        --REGISTRA EL LOG
        g_reg_evento:= sss.f_tsg_registro_evento(pm_id_usuario             ,g_id_subsistema           ,g_id_lugar         ,g_descripcion_log_error,
                                             pm_ip_origen              ,pm_mac_maquina            ,'error'            ,NULL,
                                             pm_codigo_procedimiento   ,pm_proc_almacenado);
        
        --DEVUELVE MENSAJE DE ERROR
        RETURN 'f'||g_separador||g_respuesta||g_separador||g_reg_evento;
    END IF;
    
    
      --*** EJECUCION DEL PROCEDIMIENTO ESPECIFICO
    IF pm_codigo_procedimiento = 'AL_MOVPROY_INS' THEN
    	BEGIN
        
    		INSERT INTO alma.tai_movimiento_proyecto
            (id_almacen,		id_tipo_movimiento,		fecha_ingreso,		origen_ingreso
            ,id_contratista		,id_proveedor			,id_empleado		,id_institucion
            ,concepto_ingreso	,observaciones			,estado
            ,nro_contrato		,nota_remision			,entregado_por 		,peso_neto
            )
            VALUES
            (al_id_almacen		,al_id_tipo_movimiento	,al_fecha_ingreso	,al_origen_ingreso 
            ,al_id_contratista	,al_id_proveedor		,al_id_empleado		,al_id_institucion
            ,al_concepto_ingreso	,al_observaciones	,'borrador'
            ,al_nro_contrato		,al_nota_remision	,al_entregado		,al_peso_neto
            );
            
            -- DESCRIPCION DE EXITO PARA GUARDAR EN EL LOG
            g_descripcion_log_error := 'Registro exitoso de un nuevo registro en la tabla alma.tai_movimiento_proyecto';
            g_respuesta := 't'||g_separador||g_descripcion_log_error;   
    	END;
        
  --procedimiento de modificacion      
	ELSIF pm_codigo_procedimiento = 'AL_MOVPROY_UPD' THEN
	BEGIN
            --VERIFICA EXISTENCIA DEL REGISTRO
      
            
            IF NOT EXISTS (select 1 from alma.tai_movimiento_proyecto  where alma.tai_movimiento_proyecto.id_movimiento_proyecto=al_id_movimiento_proyecto) THEN
                              
                g_descripcion_log_error := 'Modificacion no realizada: no existe el registro' || al_id_movimiento_proyecto || 'en la tabla alma.tai_movimiento_proyecto';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;               
            END IF;
                     
    
                UPDATE alma.tai_movimiento_proyecto SET 
                	usuario_reg = "current_user"() ,
                	fecha_reg = now(),
                    id_tipo_movimiento=al_id_tipo_movimiento,
                    fecha_ingreso = al_fecha_ingreso,
                    origen_ingreso = al_origen_ingreso,
                    id_contratista =al_id_contratista,
                    id_proveedor = al_id_proveedor,
                    id_empleado = al_id_empleado,
                    id_institucion = al_id_institucion,
                    concepto_ingreso = al_concepto_ingreso,
                    observaciones = al_observaciones
                    ,nro_contrato=al_nro_contrato
                    ,nota_remision=al_nota_remision
                    ,entregado_por = al_entregado
                    ,peso_neto = al_peso_neto                    
				WHERE alma.tai_movimiento_proyecto.id_movimiento_proyecto = al_id_movimiento_proyecto;
                        
			--DESCRIPCION DE EXITO PARA GUARDAR EN EL LOG
            g_descripcion_log_error := 'Modificacion exitosa en alma.tai_movimiento_proyecto del registro '||  al_id_movimiento_proyecto;
            g_respuesta := 't'||g_separador||g_descripcion_log_error;

        END;  
     ELSIF pm_codigo_procedimiento = 'AL_MOVPROY_DEL' THEN
        
    	BEGIN
            --VERIFICACI�???N DE EXISTENCIA DEL REGISTRO
            
            IF NOT EXISTS(select 1 from alma.tai_movimiento_proyecto where alma.tai_movimiento_proyecto.id_movimiento_proyecto=al_id_movimiento_proyecto) THEN
                              
                g_descripcion_log_error := 'Eliminacion no realizada: no existe el registro' || al_id_movimiento_proyecto || 'en la tabla alma.tai_movimiento_proyecto';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;
                    
            END IF;
            
            DELETE FROM alma.tai_movimiento_proyecto  
			WHERE alma.tai_movimiento_proyecto.id_movimiento_proyecto = al_id_movimiento_proyecto;
                
 			
            -- DESCRIPCION DE EXITO PARA GUARDAR EN EL LOG
            g_descripcion_log_error := 'Eliminacion exitosa del registro '||al_id_movimiento_proyecto||' en alma.tai_movimiento_proyecto';
            g_respuesta := 't'||g_separador||g_descripcion_log_error;
        END;
        
     ELSIF pm_codigo_procedimiento = 'AL_MOVPROY_FIN' THEN
        
    	BEGIN
            --VERIFICACI�???N DE EXISTENCIA DEL REGISTRO
            
            IF NOT EXISTS(select 1 from alma.tai_movimiento_proyecto where alma.tai_movimiento_proyecto.id_movimiento_proyecto=al_id_movimiento_proyecto) THEN
                              
                g_descripcion_log_error := 'Finalizacion no realizada: no existe el registro' || al_id_movimiento_proyecto || 'en la tabla alma.tai_movimiento_proyecto';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;
                    
            END IF;
                     
            --verificacion de existencia de item en el movimiento 
            IF NOT EXISTS(SELECT 1 FROM alma.tai_movimiento_proyecto_det det WHERE det.id_movimiento_proyecto = al_id_movimiento_proyecto)
            THEN
            	g_descripcion_log_error := 'Finalizacion no realizada: El movimiento seleccionado no tiene el detalle de items correspondiente';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;
            END IF;
            
            select mov.codigo into v_gen_code from alma.tai_movimiento_proyecto mov where mov.id_movimiento_proyecto = al_id_movimiento_proyecto;
            
            IF  (v_gen_code IS NULL) 
            THEN  
                  --id_gestion,id_empresa
                  SELECT ges.id_gestion,ges.id_empresa INTO v_id_gestion,v_id_empresa
                  FROM param.tpm_gestion ges
                  WHERE ges.gestion = (	select to_char(now(),'YYYY')::integer	);
                  --id_periodo
                  select	per.id_periodo into v_id_periodo
                  from param.tpm_periodo per
                  where 	per.id_gestion = v_id_gestion 
                          and per.periodo =(	
                                              SELECT EXTRACT (MONTH FROM (	select m.fecha_ingreso
                                                                              from alma.tai_movimiento_proyecto m
                                                                              where m.id_movimiento_proyecto=al_id_movimiento_proyecto	)
                                                                          )	);
              
                  if(v_id_periodo is null)
                  then
                      g_descripcion_log_error := 'Finalizacion erronea: No se encontro el periodo correspondiente a la fecha de ingreso del movimiento';
                      g_nivel_error := '4';
                      g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                      RETURN 'f'||g_separador||g_respuesta;
                  end if;
                  
                  --datos correlativo                                                      
                  select 'ALMA'::varchar as nombre_corto,doc.codigo as codigo_documento,doc.prefijo,doc.sufijo,dep.id_depto INTO v_datos_correlativo
                  from alma.tai_movimiento_proyecto mov
                  inner join alma.tai_almacen alm on alm.id_almacen=mov.id_almacen and alm.estado = 'activo'
                  inner join alma.tai_tipo_movimiento tip on tip.id_tipo_movimiento = mov.id_tipo_movimiento
                  left join param.tpm_documento doc on doc.id_documento=tip.id_documento 
                  left join param.tpm_depto dep on dep.id_depto=alm.id_depto and dep.estado='activo'
                  where mov.id_movimiento_proyecto=al_id_movimiento_proyecto;
            
                  SELECT param.f_pm_get_num_dep_gral(  v_datos_correlativo.nombre_corto
                                                               ,v_datos_correlativo.codigo_documento
                                                               ,v_id_periodo
                                                               ,v_id_empresa
                                                               ,v_datos_correlativo.id_depto) INTO v_correlativo;
                  
                  if  v_correlativo > 0 
                  then
                       select trunc(	(log(v_correlativo)+1)	) into v_aux;
                       
                       if v_aux = 1 
                       then v_cad = '000'||v_correlativo;
                       elsif v_aux = 2 then v_cad = '00'||v_correlativo;
                       elsif v_aux = 3 then v_cad = '0'||v_correlativo;
                       else v_cad = v_correlativo;
                       end if;
                       
                       
                       if EXISTS (select 1 from param.tpm_periodo p where p.id_periodo = v_id_periodo )
                       then
                                  SELECT EXTRACT ( MONTH FROM (	select m.fecha_ingreso
                                                                              from alma.tai_movimiento_proyecto m
                                                                              where m.id_movimiento_proyecto=al_id_movimiento_proyecto	)
                                                  )	  INTO v_periodo;
                                  
                                  if v_periodo < 10
                                  then
                                      v_cad_periodo = '0'||v_periodo;
                                  else
                                      v_cad_periodo = v_periodo;
                                  end if;
                       end if;
                       
                      -- v_codigo = v_datos_correlativo.prefijo||'-'||v_cad_periodo||'-'||v_cad;
                       v_codigo = v_datos_correlativo.codigo_documento||'-'||v_cad_periodo||'-'||v_cad;
           
                       if EXISTS (select 1 from alma.tai_movimiento_proyecto m where m.codigo = v_codigo )
                       then
                          g_descripcion_log_error := 'Error al generar el codigo del movimiento, error de duplicidad de codigo movimiento proyecto  ' || v_codigo || ', revise la parametrizacion del documento';
                          g_nivel_error := '4';
                          g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                          RETURN 'f'||g_separador||g_respuesta;               
                       end if;
                       
                  end if;
                   	UPDATE alma.tai_movimiento_proyecto
             		SET estado = 'pendiente_costeo',
                 	codigo = v_codigo
             		WHERE alma.tai_movimiento_proyecto.id_movimiento_proyecto = al_id_movimiento_proyecto; 
            ELSE
            	--cambio a estado finalizado del movimiento_ptoyecto
                UPDATE alma.tai_movimiento_proyecto
                SET estado = 'pendiente_costeo'
                WHERE alma.tai_movimiento_proyecto.id_movimiento_proyecto = al_id_movimiento_proyecto;
            
            END IF;
            
            --inicio registro costeo
          /*  select mp.id_almacen INTO v_datos_correlativo
			from alma.tai_movimiento_proyecto mp
			where mp.id_movimiento_proyecto = al_id_movimiento_proyecto;

            if NOT EXISTS (select 1 from alma.tai_costeo cos where cos.id_movimiento_proyecto=al_id_movimiento_proyecto)
        	then
            		INSERT INTO alma.tai_costeo(fecha_ingreso,fecha_salida,estado,descripcion,id_almacen,id_movimiento_proyecto,tipo_costeo)
             	 	VALUES(now(),NULL,'borrador',NULL,v_datos_correlativo.id_almacen,al_id_movimiento_proyecto,NULL);
            else
            		g_descripcion_log_error := 'Verifique que el movimiento finalizado ' || al_id_movimiento_proyecto || ' no haya sido registrado anteriormente.';
                	g_nivel_error := '4';
                	g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                	RETURN 'f'||g_separador||g_respuesta;   
            end if;*/
                        
            -- DESCRIPCION DE EXITO PARA GUARDAR EN EL LOG
            g_descripcion_log_error := 'Finalizacion exitosa del registro '||al_id_movimiento_proyecto||' en alma.tai_movimiento_proyecto';
            g_respuesta := 't'||g_separador||g_descripcion_log_error;
        END;
     
    ELSIF pm_codigo_procedimiento = 'AL_MOVPROY_CORREG' THEN
    BEGIN
    		if not EXISTS (select 1 from alma.tai_movimiento_proyecto p where p.id_movimiento_proyecto=al_id_movimiento_proyecto)
            then
            		g_descripcion_log_error := 'El movimiento de ingreso seleccionado ' || al_id_movimiento_proyecto || ' no fue registrado anteriormente.';
                	g_nivel_error := '4';
                	g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                	RETURN 'f'||g_separador||g_respuesta;   
            end if;
           
            /*if EXISTS (	select 1 from alma.tai_movimiento_proyecto mp 
            			inner join alma.tai_costeo co on co.id_movimiento_proyecto = mp.id_movimiento_proyecto
                        where mp.id_movimiento_proyecto = al_id_movimiento_proyecto and co.estado='costeado')
            then
            		g_descripcion_log_error := 'Error al corregir el movimiento de ingreso ' || al_id_movimiento_proyecto ||chr(10)|| 'Los items del proyecto fueron costeados anteriormente.'||chr(10)||'Se necesita corregir el costeo de estos items, antes de corregir el movimiento.';
                	g_nivel_error := '4';
                	g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                	RETURN 'f'||g_separador||g_respuesta;  
            end if;*/
            
            /*
            *
            *	1.- eliminar de la tabla costeo_detalle todos los costos asociados al costeo
            	2.- eliminar de la tabla costeo el registro con ID al_id_movimiento_proyecto
            	3.- cambiar el estado del movimiento a 'borrador'
            */
			--obtencion de los datos del movimiento proyecto
            SELECT mp.id_almacen,mp.estado as estado_mp,co.id_costeo,co.estado as estado_costeo,co.tipo_costeo INTO v_datos
            FROM alma.tai_movimiento_proyecto mp
            INNER JOIN alma.tai_costeo co on co.id_movimiento_proyecto=mp.id_movimiento_proyecto
            WHERE mp.id_movimiento_proyecto = al_id_movimiento_proyecto;
            
            
            if (v_datos.estado_mp = 'pendiente_costeo')
            then
            	 UPDATE alma.tai_movimiento_proyecto
            	 SET estado = 'borrador'
            	 WHERE alma.tai_movimiento_proyecto.id_movimiento_proyecto = al_id_movimiento_proyecto; 
            else
            	 --se elimina los datos del costeo detalle
                  DELETE FROM alma.tai_costeo_detalle
                  WHERE alma.tai_costeo_detalle.id_costeo = v_datos.id_costeo;
                  
                  --se elimna el costeo registrado para el proyecto
                  DELETE FROM alma.tai_costeo
                  WHERE alma.tai_costeo.id_costeo = v_datos.id_costeo;
                  
                 /* select cos.id_costeo into v_datos_correlativo
                  from alma.tai_movimiento_proyecto mp
                  inner join alma.tai_costeo cos on cos.id_movimiento_proyecto = mp.id_movimiento_proyecto and cos.estado='borrador'
                  where mp.id_movimiento_proyecto = al_id_movimiento_proyecto;
                  
                  DELETE FROM alma.tai_costeo_detalle
                  WHERE alma.tai_costeo_detalle.id_costeo = v_datos_correlativo.id_costeo;
                  
                  DELETE FROM alma.tai_costeo
                  WHERE alma.tai_costeo.id_costeo = v_datos_correlativo.id_costeo;*/
                  
                  UPDATE alma.tai_movimiento_proyecto
                  SET estado = 'borrador'
                  WHERE alma.tai_movimiento_proyecto.id_movimiento_proyecto = al_id_movimiento_proyecto; 
                  
                  UPDATE alma.tai_movimiento_proyecto_det
                  SET calculo_costeado = NULL
                  WHERE alma.tai_movimiento_proyecto_det.id_movimiento_proyecto = al_id_movimiento_proyecto;
                  
            end if;
            
            
            
            -- DESCRIPCI�???N DE �???XITO PARA GUARDAR EN EL LOG
            g_descripcion_log_error := 'modificacion exitosa del registro '||al_id_movimiento_proyecto||' en alma.tai_movimiento_proyecto';
            g_respuesta := 't'||g_separador||g_descripcion_log_error;
    END;
    
    ELSE
        --PROCEDIMIENTO INEXISTENTE
        g_nivel_error := '2';
        g_descripcion_log_error := 'Procedimiento inexistente';
        g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
        
        --REGISTRA EL LOG
        g_reg_evento:= sss.f_tsg_registro_evento(pm_id_usuario            ,g_id_subsistema           ,g_id_lugar         ,g_descripcion_log_error,
                                            pm_ip_origen              ,pm_mac_maquina            ,'error'            ,NULL,
                                            pm_codigo_procedimiento   ,pm_proc_almacenado);
        --DEVUELVE MENSAJE DE ERROR
        RETURN 'f'||g_separador||g_respuesta||g_separador||g_reg_evento;
        
    END IF;

    ---*** REGISTRO EN EL LOG EL EXITO DE LA EJECUCION DEL PROCEDIMIENTO
    g_reg_evento:= sss.f_tsg_registro_evento(pm_id_usuario             ,g_id_subsistema           ,g_id_lugar         ,g_descripcion_log_error,
                                         pm_ip_origen              ,pm_mac_maquina            ,'log'              ,NULL,
                                         pm_codigo_procedimiento   ,pm_proc_almacenado);

    ---*** SE DEVUELVE LA RESPUESTA
    RETURN g_respuesta||g_separador||g_reg_evento;

EXCEPTION

    WHEN others THEN BEGIN

        --SE OBTIENE EL MENSAJE Y EL NUMERO DEL ERROR LANZADO POR EL GESTOR DE BASE DE DATOS
        g_mensaje_error := SQLERRM ;
        g_numero_error := SQLSTATE;
    
        -- SE REGISTRA EL ERROR OCURRIDO
        g_reg_error:= sss.f_tsg_registro_evento (pm_id_usuario            ,g_id_subsistema          ,g_id_lugar         ,g_mensaje_error,
                                             pm_ip_origen             ,pm_mac_maquina           ,'error'            ,g_numero_error,
                                             pm_codigo_procedimiento  ,pm_proc_almacenado);
                                             
        --SE DEVUELVE EL MENSAJE DE ERROR
        g_nivel_error := '1';
        g_descripcion_log_error := g_numero_error || ' - ' || g_mensaje_error;
        g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
        RETURN 'f'||g_separador||g_respuesta||g_separador||g_reg_error;         
    END;
    
END;
$body$
LANGUAGE 'plpgsql'
VOLATILE
CALLED ON NULL INPUT
SECURITY INVOKER;