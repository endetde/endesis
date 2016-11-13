
	CREATE OR REPLACE FUNCTION "public"."f_tal_almacen_ep_iud" (
		pm_id_usuario integer,
		pm_ip_origen varchar,
		pm_mac_maquina macaddr,
		pm_codigo_procedimiento varchar,
		pm_proc_almacenado varchar,
		al_id_almacen_ep  int4,
		al_descripcion  varchar,
		al_observaciones  varchar,
		al_fecha_reg  date,
		al_id_fina_regi_prog_proy_acti  int4,
		al_id_almacen  int4
)
		RETURNS varchar AS
$body$



/**************************************************************************
 SISTEMA ENDESIS - SISTEMA DE ALMACENES (ALMIN)
***************************************************************************
 SCRIPT: 		f_tal_almacen_ep_iud
 DESCRIPCI�N: 	Permite registrar en la tabla tal_almacen_ep
 AUTOR: 		(generado automaticamente)
 FECHA:			2007-10-12 16:30:26
 COMENTARIOS:	
***************************************************************************
 HISTORIA DE MODIFICACIONES:

 DESCRIPCION:	
 AUTOR:			
 FECHA:			

***************************************************************************/
--------------------------
-- CUERPO DE LA FUNCI�N --
--------------------------

-- PAR�METROS FIJOS
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

-- DECLARACI�N DE VARIABLES PARTICULARES

--**** DECLARACION DE VARIABLES DE LA FUNCI�N (LOCALES) ****---


DECLARE

    --PAR�METROS FIJOS

    g_id_subsistema            integer; -- ID SUBSISTEMA
    g_id_lugar                 integer; -- ID LUGAR
    g_numero_error             varchar; -- ALMACENA EL N�MERO DE ERROR
    g_mensaje_error            varchar; -- ALMACENA MENSAJE DEL ERROR
    g_privilegio_procedimiento boolean; -- BANDERA PARA VERIFICAR LLAMADA DE LA FUNCI�N
    g_descripcion_log_error    text;    -- PARA ALMACENAR EL MENSAJE DE ERROR O LOG
    g_reg_evento               varchar; --boolean;
    g_reg_error                varchar; --boolean;
    g_respuesta                varchar; -- VARIABLE QUE CONTIENE LA RESPUESTA DE LA FUNCI�N
    g_nivel_error              varchar; -- VARIABLE QUE CONTIENE EL NIVEL DE ERROR
                                        --      ERROR DE SINTAXIS (cuando llega a exception) = 1
                                        --      ERROR L�GICO (CR�TICO) = 2
                                        --      ERROR L�GICO (INTERMEDIO) = 3
                                        --      ERROR L�GICO (ADVERTENCIA) = 4
    
    g_nombre_funcion           varchar; --NOMBRE F�SICO DE LA FUNCI�N
    g_separador                varchar(10); --Caracteres que servir�n para separar el mensaje, nivel y origen del error
    
BEGIN


---*** INICIACI�N DE VARIABLES 
    g_separador = '#@@@#'; --Separador para mensajes devueltos por la funci�n
    g_nombre_funcion := 'f_tal_almacen_ep_iud';
    g_privilegio_procedimiento := FALSE;
    g_respuesta := FALSE;
   
    ---*** OBTENCI�N DEL ID DEL SUBSISTEMA
    SELECT id_subsistema
    INTO g_id_subsistema
    FROM tsg_metaproceso
    WHERE codigo_procedimiento = pm_codigo_procedimiento;


    ---*** OBTENCI�N DEL ID DEL LUGAR ASIGNADO AL USUARIO
    SELECT tsg_usuario_lugar.id_lugar
    INTO   g_id_lugar
    FROM   tsg_usuario_lugar
    WHERE  tsg_usuario_lugar.id_usuario = pm_id_usuario;
    
    
     ---*** VALIDACI�N DE LLAMADA POR USUARIO O FUNCI�N
    IF pm_proc_almacenado IS NOT NULL THEN
        IF NOT EXISTS(SELECT 1 FROM pg_proc WHERE proname = pm_proc_almacenado) THEN
            g_descripcion_log_error := 'Procedimiento ejecutor inexistente';
            g_nivel_error := '2';
            g_respuesta := f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
            
            --REGISTRA EL LOG
            g_reg_evento:= f_tsg_registro_evento(pm_id_usuario             ,g_id_subsistema           ,g_id_lugar         ,g_descripcion_log_error,
                                                 pm_ip_origen              ,pm_mac_maquina            ,'error'            ,NULL,
                                                 pm_codigo_procedimiento   ,pm_proc_almacenado);
            --DEVUELVE MENSAJE DE ERROR
            RETURN 'f'||g_separador||g_respuesta||g_separador||g_reg_evento;
        ELSE
            g_privilegio_procedimiento := TRUE;
        END IF;
    END IF;


    
    ---*** VERIFICACI�N DE PERMISOS DEL USUARIO
    IF NOT g_privilegio_procedimiento THEN
       g_privilegio_procedimiento := f_sg_validacion_procedimiento(pm_id_usuario,pm_codigo_procedimiento,NULL);
    END IF;


    ---*** SI NO SE TIENE PERMISOS DE EJECUCI�N SE RETORNA EL MENSAJE DE ERROR
    IF NOT g_privilegio_procedimiento THEN
        g_nivel_error := '3';
        g_descripcion_log_error := 'El usuario no tiene permisos de ejecuci�n del procedimiento';
        g_respuesta := f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);

        --REGISTRA EL LOG
        g_reg_evento:= f_tsg_registro_evento(pm_id_usuario             ,g_id_subsistema           ,g_id_lugar         ,g_descripcion_log_error,
                                             pm_ip_origen              ,pm_mac_maquina            ,'error'            ,NULL,
                                             pm_codigo_procedimiento   ,pm_proc_almacenado);
        
        --DEVUELVE MENSAJE DE ERROR
        RETURN 'f'||g_separador||g_respuesta||g_separador||g_reg_evento;
    END IF;
    
    
      --*** EJECUCI�N DEL PROCEDIMIENTO ESPEC�FICO
    IF pm_codigo_procedimiento = 'AL_ALMAEP_INS' THEN

        BEGIN
        	
            INSERT INTO tal_almacen_ep(
		descripcion,
		observaciones,
		fecha_reg,
		id_fina_regi_prog_proy_acti,
		id_almacen
		        ) VALUES (
		 al_descripcion,
		 al_observaciones,
		 now(),
		 al_id_fina_regi_prog_proy_acti,
		al_id_almacen

            );   
            -- DESCRIPCI�N DE �XITO PARA GUARDAR EN EL LOG
            g_descripcion_log_error := 'Registro exitoso en tal_almacen_ep';
            g_respuesta := 't'||g_separador||g_descripcion_log_error;
   
        END;
        
  --procedimiento de modificacion      
        
   ELSIF pm_codigo_procedimiento = 'AL_ALMAEP_UPD' THEN

        BEGIN
            --VERIFICA EXISTENCIA DEL REGISTRO
            IF NOT EXISTS(SELECT 1 FROM tal_almacen_ep
                          WHERE tal_almacen_ep.id_almacen_ep=al_id_almacen_ep) THEN
                              
                g_descripcion_log_error := 'Modificaci�n no realizada: no existe el registro de tal_almacen_epno existente';
                g_nivel_error := '4';
                g_respuesta := f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;
                    
            END IF;

            UPDATE tal_almacen_ep SET 
		descripcion=al_descripcion,
		observaciones=al_observaciones,
		fecha_reg=al_fecha_reg,
		id_fina_regi_prog_proy_acti=al_id_fina_regi_prog_proy_acti,
		id_almacen=al_id_almacen

				WHERE tal_almacen_ep.id_almacen_ep= al_id_almacen_ep;

            -- DESCRIPCI�N DE �XITO PARA GUARDAR EN EL LOG
            g_descripcion_log_error := 'Modificaci�n exitosa en tal_almacen_ep';
            g_respuesta := 't'||g_separador||g_descripcion_log_error;

        END;
        
        ELSIF pm_codigo_procedimiento = 'AL_ALMAEP_DEL' THEN
        
    BEGIN
            --VERIFICACI�N DE EXISTENCIA DEL REGISTRO
            IF NOT EXISTS(SELECT 1 FROM tal_almacen_ep
                          WHERE tal_almacen_ep.id_almacen_ep=al_id_almacen_ep) THEN
                              
                g_nivel_error := '4';
                g_descripcion_log_error := 'Eliminaci�n no realizada: registro en tal_almacen_ep inexistente';
                g_respuesta := f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;
                    
            END IF;

 			-- VERIFICACI�N DE EXISTENCIA DE HIJOS
         --   IF EXISTS(SELECT 1 FROM tal_almacen_ep
         --            INNER JOIN tal_id1 ON tal_almacen_ep.id_subgrupo = tal_id1.id_subgrupo
         --            WHERE tal_almacen_ep.id_almacen_ep = al_id_almacen_ep) THEN
         --            
         --       g_nivel_error := '4';
         --       g_descripcion_log_error := 'Eliminaci�n no realizada: El registro en tal_almacen_ep tiene regitros asociados en XXX';
         --       g_respuesta := f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
         --      RETURN 'f'||g_separador||g_respuesta;
                
         --   END IF;   
         
         -- BORRADO DE DATO
            DELETE FROM tal_almacen_ep WHERE tal_almacen_ep.id_almacen_ep = al_id_almacen_ep;

            -- DESCRIPCI�N DE �XITO PARA GUARDAR EN EL LOG
            g_descripcion_log_error := 'Eliminaci�n exitosa del registro en tal_almacen_ep';
            g_respuesta := 't'||g_separador||g_descripcion_log_error;
        END;

    ELSE
        --PROCEDIMIENTO INEXISTENTE
        g_nivel_error := '2';
        g_descripcion_log_error := 'Procedimiento inexistente';
        g_respuesta := f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
        
        --REGISTRA EL LOG
        g_reg_evento:= f_tsg_registro_evento(pm_id_usuario            ,g_id_subsistema           ,g_id_lugar         ,g_descripcion_log_error,
                                            pm_ip_origen              ,pm_mac_maquina            ,'error'            ,NULL,
                                            pm_codigo_procedimiento   ,pm_proc_almacenado);
        --DEVUELVE MENSAJE DE ERROR
        RETURN 'f'||g_separador||g_respuesta||g_separador||g_reg_evento;
        
    END IF;

    ---*** REGISTRO EN EL LOG EL �XITO DE LA EJECUI�N DEL PROCEDIMIENTO
    g_reg_evento:= f_tsg_registro_evento(pm_id_usuario             ,g_id_subsistema           ,g_id_lugar         ,g_descripcion_log_error,
                                         pm_ip_origen              ,pm_mac_maquina            ,'log'              ,NULL,
                                         pm_codigo_procedimiento   ,pm_proc_almacenado);

    ---*** SE DEVUELVE LA RESPUESTA
    RETURN g_respuesta||g_separador||g_reg_evento;


EXCEPTION

    WHEN others THEN BEGIN

        --SE OBTIENE EL MENSAJE Y EL N�MERO DEL ERROR LANZADO POR EL GESTOR DE BASE DE DATOS
        g_mensaje_error := SQLERRM ;
        g_numero_error := SQLSTATE;
    
        -- SE REGISTRA EL ERROR OCURRIDO
        g_reg_error:= f_tsg_registro_evento (pm_id_usuario            ,g_id_subsistema          ,g_id_lugar         ,g_mensaje_error,
                                             pm_ip_origen             ,pm_mac_maquina           ,'error'            ,g_numero_error,
                                             pm_codigo_procedimiento  ,pm_proc_almacenado);
                                             
        --SE DEVUELVE EL MENSAJE DE ERROR
        g_nivel_error := '1';
        g_descripcion_log_error := g_numero_error || ' - ' || g_mensaje_error;
        g_respuesta := f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
        RETURN 'f'||g_separador||g_respuesta||g_separador||g_reg_error;         
    END;
    
END;
$body$
LANGUAGE 'plpgsql' VOLATILE CALLED ON NULL INPUT SECURITY INVOKER;