--------------- SQL ---------------

CREATE OR REPLACE FUNCTION almin.f_tal_item_iud (
  pm_id_usuario integer,
  pm_ip_origen varchar,
  pm_mac_maquina text,
  pm_codigo_procedimiento varchar,
  pm_proc_almacenado varchar,
  al_id_item integer,
  al_codigo varchar,
  al_descripcion varchar,
  al_precio_venta_almacen numeric,
  al_costo_estimado numeric,
  al_stock_min numeric,
  al_observaciones varchar,
  al_nivel_convertido varchar,
  al_estado_registro varchar,
  al_fecha_reg date,
  al_id_unidad_medida_base integer,
  al_id_id3 integer,
  al_id_id2 integer,
  al_id_id1 integer,
  al_id_subgrupo integer,
  al_id_grupo integer,
  al_id_supergrupo integer,
  al_nombre varchar,
  al_peso_kg numeric,
  al_mat_bajo_responsabilidad varchar,
  al_calidad varchar,
  al_descripcion_aux varchar,
  al_registro varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA ENDESIS - SISTEMA DE FACTURACION (FACTUR)
***************************************************************************
 SCRIPT: 		almin.f_tal_item_iud
 DESCRIPCI�N: 	Permite registrar los �tems de almac�n
 AUTOR: 		Rodrigo Chumacero Moscoso
 FECHA:			28-09-2007
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
    g_cod_duplicado            varchar;
    g_cod_id3                  varchar;
    g_cod_item                   varchar;
BEGIN

    ---*** INICIACI�N DE VARIABLES
    g_separador = '#@@@#'; --Separador para mensajes devueltos por la funci�n
    g_nombre_funcion := 'almin.f_tal_item_iud';
    g_privilegio_procedimiento := FALSE;
    g_cod_id3:=codigo from almin.tal_id3 where almin.tal_id3.id_id3=al_id_id3;

    g_respuesta := FALSE;

    ---*** OBTENCI�N DEL ID DEL SUBSISTEMA
    SELECT id_subsistema
    INTO g_id_subsistema
    FROM sss.tsg_procedimiento_db
    WHERE codigo_procedimiento = pm_codigo_procedimiento;


    ---*** OBTENCI�N DEL ID DEL LUGAR ASIGNADO AL USUARIO
    SELECT sss.tsg_usuario_lugar.id_lugar
    INTO   g_id_lugar
    FROM   sss.tsg_usuario_lugar
    WHERE  sss.tsg_usuario_lugar.id_usuario = pm_id_usuario;


    ---*** VALIDACI�N DE LLAMADA POR USUARIO O FUNCI�N
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



    ---*** VERIFICACI�N DE PERMISOS DEL USUARIO
    IF NOT g_privilegio_procedimiento THEN
       g_privilegio_procedimiento := sss.f_sg_validacion_procedimiento(pm_id_usuario,pm_codigo_procedimiento,NULL);
    END IF;


    ---*** SI NO SE TIENE PERMISOS DE EJECUCI�N SE RETORNA EL MENSAJE DE ERROR
    IF NOT g_privilegio_procedimiento THEN
        g_nivel_error := '3';
        g_descripcion_log_error := 'El usuario no tiene permisos de ejecuci�n del procedimiento';
        g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);

        --REGISTRA EL LOG
        g_reg_evento:= sss.f_tsg_registro_evento(pm_id_usuario             ,g_id_subsistema           ,g_id_lugar         ,g_descripcion_log_error,
                                             pm_ip_origen              ,pm_mac_maquina            ,'error'            ,NULL,
                                             pm_codigo_procedimiento   ,pm_proc_almacenado);

        --DEVUELVE MENSAJE DE ERROR
        RETURN 'f'||g_separador||g_respuesta||g_separador||g_reg_evento;
    END IF;


    --*** EJECUCI�N DEL PROCEDIMIENTO ESPEC�FICO
    IF pm_codigo_procedimiento = 'AL_ITEM_INS' THEN

        BEGIN
               g_cod_duplicado := upper(g_cod_id3||al_codigo);
               
               
               IF EXISTS(SELECT 1 FROM almin.tal_item
                  WHERE codigo = g_cod_duplicado) THEN
                  g_descripcion_log_error := 'Inserci�n no realizada: C�digo Duplicado';
                  g_nivel_error := '4';
                  g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                  RETURN 'f'||g_separador||g_respuesta;
               END IF;
            
            
            
            INSERT INTO almin.tal_item(
                  codigo                      ,descripcion         ,precio_venta_almacen      ,costo_estimado,
                  stock_min                   ,observaciones,
                  nivel_convertido            ,estado_registro     ,fecha_reg,
                  id_unidad_medida_base       ,id_id3              ,id_id2,
                  id_id1                      ,id_subgrupo         ,id_grupo,
                  id_supergrupo               ,nombre              ,peso_kg,
                  mat_bajo_responsabilidad    ,calidad             ,descripcion_aux,
                  id_usuario, registro
            ) VALUES (
                  upper(g_cod_id3||'.'||al_codigo) ,al_descripcion      ,al_precio_venta_almacen  ,al_costo_estimado,
                  al_stock_min                ,al_observaciones,
                  '4'                         ,al_estado_registro  ,now(),
                  al_id_unidad_medida_base    ,al_id_id3           ,al_id_id2,
                  al_id_id1                   ,al_id_subgrupo      ,al_id_grupo,
                  al_id_supergrupo            ,al_nombre           ,al_peso_kg,
                  al_mat_bajo_responsabilidad ,al_calidad          ,al_descripcion_aux,
                  pm_id_usuario, al_registro
            );

            -- DESCRIPCI�N DE �XITO PARA GUARDAR EN EL LOG
            g_descripcion_log_error := 'Registro exitoso del Item';
            g_respuesta := 't'||g_separador||g_descripcion_log_error;

        END;

    ELSIF pm_codigo_procedimiento = 'AL_ITEM_UPD' THEN

        BEGIN
            --VERIFICA EXISTENCIA DEL REGISTRO
            IF NOT EXISTS(SELECT 1 FROM almin.tal_item
                          WHERE id_item = al_id_item) THEN
                g_descripcion_log_error := 'Modificaci�n no realizada: Item no existente';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;
            END IF;
            
            --RCM 06/04/2010: Validaci�n que no permite modificar items si estos fueron registrados en alguna solicitud de compro
            IF EXISTS(SELECT 1 FROM compro.tad_solicitud_compra_det
            		WHERE id_item = al_id_item) THEN
            	RAISE EXCEPTION 'Modificaci�n no permitida: este Item est� incluido en una Solicitud de Bienes en sistema COMPRO';
            END IF;

            g_cod_duplicado := upper(g_cod_id3||al_codigo);
            g_cod_item:=codigo from almin.tal_item where almin.tal_item.id_item=al_id_item;
            IF al_nivel_convertido != '4' THEN
               /* := '4';
               g_descripcion_log_error := 'Modificacion no realizada: El Item esta Asociado con Identificadores';
               g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
               RETURN 'f'||g_separador||g_respuesta;      */ 
                UPDATE almin.tal_item SET
                   descripcion                = al_descripcion,
                   precio_venta_almacen     = al_precio_venta_almacen,
                   costo_estimado            = al_costo_estimado,
                   stock_min                = al_stock_min,
                   observaciones            = al_observaciones,
                   estado_registro          = al_estado_registro,
                   id_unidad_medida_base    = al_id_unidad_medida_base,
                   nombre                   = al_nombre,
                   peso_kg                  = al_peso_kg,
                   mat_bajo_responsabilidad = al_mat_bajo_responsabilidad,
                   calidad                  = al_calidad,
                   descripcion_aux          = al_descripcion_aux
                   WHERE id_item = al_id_item; 
                   g_descripcion_log_error := 'Modificaci�n exitosa de Item';
                   g_respuesta := 't'||g_separador||g_descripcion_log_error;             
            ELSE   
                IF g_cod_duplicado = g_cod_item THEN
                   UPDATE almin.tal_item SET
                   codigo                   = upper(g_cod_id3||'.'||al_codigo),
                   descripcion                = al_descripcion,
                   precio_venta_almacen     = al_precio_venta_almacen,
                   costo_estimado            = al_costo_estimado,
                   stock_min                = al_stock_min,
                   observaciones            = al_observaciones,
                   nivel_convertido         = al_nivel_convertido,
                   estado_registro          = al_estado_registro,
                   fecha_reg                = al_fecha_reg,
                   id_unidad_medida_base    = al_id_unidad_medida_base,
                   id_id3                   = al_id_id3,
                   id_id2                   = al_id_id2,
                   id_id1                   = al_id_id1,
                   id_subgrupo              = al_id_subgrupo,
                   id_grupo                 = al_id_grupo,
                   id_supergrupo            = al_id_supergrupo,
                   nombre                   = al_nombre,
                   peso_kg                  = al_peso_kg,
                   mat_bajo_responsabilidad = al_mat_bajo_responsabilidad,
                   calidad                  = al_calidad,
                   descripcion_aux          = al_descripcion_aux
                   WHERE id_item = al_id_item;
                   -- DESCRIPCI�N DE �XITO PARA GUARDAR EN EL LOG
                   g_descripcion_log_error := 'Modificaci�n exitosa de Item';
                   g_respuesta := 't'||g_separador||g_descripcion_log_error;
                ELSE
                    IF EXISTS(SELECT 1 FROM almin.tal_item
                        WHERE codigo = g_cod_duplicado) THEN
                        g_descripcion_log_error := 'Modificacion no realizada: C�digo Duplicado';
                        g_nivel_error := '4';
                        g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                        RETURN 'f'||g_separador||g_respuesta;
                    ELSE
                        UPDATE almin.tal_item SET
                            codigo                 = upper(g_cod_id3||'.'||al_codigo),
                            descripcion               = al_descripcion,
                            precio_venta_almacen   = al_precio_venta_almacen,
                            costo_estimado           = al_costo_estimado,
                            stock_min              = al_stock_min,
                            observaciones          = al_observaciones,
                            nivel_convertido       = al_nivel_convertido,
                            estado_registro        = al_estado_registro,
                            fecha_reg              = al_fecha_reg,
                            id_unidad_medida_base  = al_id_unidad_medida_base,
                            id_id3                 = al_id_id3,
                            id_id2                 = al_id_id2,
                            id_id1                 = al_id_id1,
                            id_subgrupo            = al_id_subgrupo,
                            id_grupo               = al_id_grupo,
                            id_supergrupo          = al_id_supergrupo,
                            nombre                 = al_nombre,
                            mat_bajo_responsabilidad=al_mat_bajo_responsabilidad,
                            calidad                = al_calidad,
                            descripcion_aux        = al_descripcion_aux,
                            peso_kg 			   = al_peso_kg
                        WHERE id_item = al_id_item;
                         -- DESCRIPCI�N DE �XITO PARA GUARDAR EN EL LOG
                        g_descripcion_log_error := 'Modificaci�n exitosa de Item';
                        g_respuesta := 't'||g_separador||g_descripcion_log_error;
                    END IF;
                END IF;
            END IF;
        END;

    ELSIF pm_codigo_procedimiento = 'AL_ITEM_DEL' THEN

        BEGIN
            --VERIFICACI�N DE EXISTENCIA DEL REGISTRO
           IF NOT EXISTS(SELECT 1 FROM almin.tal_item
                          WHERE id_item = al_id_item) THEN

                g_descripcion_log_error := 'Modificaci�n no realizada: Item no existente';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;

            END IF;

            -- VERIFICACI�N DE EXISTENCIA EN TABLAS RELACIONADAS
            IF EXISTS(SELECT 1 FROM almin.tal_item_doc_tec
                       WHERE id_item = al_id_item) THEN

                g_descripcion_log_error := 'Eliminaci�n no realizada: El Item est� referenciado en Documentos T�cnicos';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;

            END IF;

            IF EXISTS(SELECT 1 FROM almin.tal_caracteristica_item
                       WHERE id_item = al_id_item) THEN

                g_descripcion_log_error := 'Eliminaci�n no realizada: El Item est� referenciado en Caracter�sticas';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;

            END IF;

            IF EXISTS(SELECT 1 FROM almin.tal_item_reemplazo
                       WHERE id_item = al_id_item) THEN

                g_descripcion_log_error := 'Eliminaci�n no realizada: El Item est� referenciado en Reemplazos';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;

            END IF;

            IF EXISTS(SELECT 1 FROM almin.tal_codigo_fabricante
                       WHERE id_item = al_id_item) THEN

                g_descripcion_log_error := 'Eliminaci�n no realizada: El Item est� referenciado en C�digo Fabricante';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;

            END IF;

            IF EXISTS(SELECT 1 FROM almin.tal_ingreso_detalle
                       WHERE id_item = al_id_item) THEN

                g_descripcion_log_error := 'Eliminaci�n no realizada: El Item est� referenciado en Detalle Ingreso';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;

            END IF;

            IF EXISTS(SELECT 1 FROM almin.tal_inventario_det
                       WHERE id_item = al_id_item) THEN

                g_descripcion_log_error := 'Eliminaci�n no realizada: El Item est� referenciado en Inventario';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;

            END IF;

            IF EXISTS(SELECT 1 FROM almin.tal_salida_detalle
                       WHERE id_item = al_id_item) THEN

                g_descripcion_log_error := 'Eliminaci�n no realizada: El Item est� referenciado en Salida Detalle';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;

            END IF;

            IF EXISTS(SELECT 1 FROM almin.tal_kardex_logico
                       WHERE id_item = al_id_item) THEN

                g_descripcion_log_error := 'Eliminaci�n no realizada: El Item est� referenciado en Kardex l�gico';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;
            END IF;

            IF EXISTS(SELECT 1 FROM almin.tal_componente
                       WHERE id_item = al_id_item) THEN

                g_descripcion_log_error := 'Eliminaci�n no realizada: El Item est� referenciado en Componentes de Tipos de Undiad Constructiva';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;
            END IF;

            IF EXISTS(SELECT 1 FROM almin.tal_item_ubicacion
                       WHERE id_item = al_id_item) THEN

                g_descripcion_log_error := 'Eliminaci�n no realizada: El Item est� referenciado en Ubicaci�n ';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;
            END IF;

            -- BORRADO DE DATO
            DELETE FROM almin.tal_item WHERE id_item = al_id_item;

            -- DESCRIPCI�N DE �XITO PARA GUARDAR EN EL LOG
            g_descripcion_log_error := 'Eliminaci�n exitosa del Item';
            g_respuesta := 't'||g_separador||g_descripcion_log_error;
        END;
    
    /*
    Autor: 			RCM
    C�digo:			AL_ITEM_INA
    Fecha:	 		17/06/2010
    Descripci�n:	Opci�n que permite cambiar el estado Activo a Inactivo o viceversa
    */    
    ELSIF pm_codigo_procedimiento = 'AL_ITEM_INA' THEN --ITEM INActivaci�n

        BEGIN
            --VERIFICACI�N DE EXISTENCIA DEL REGISTRO
           IF NOT EXISTS(SELECT 1 FROM almin.tal_item
                          WHERE id_item = al_id_item) THEN
                g_descripcion_log_error := 'Inactivaci�n no realizada: Item no existente';
                g_nivel_error := '4';
                g_respuesta := param.f_pm_mensaje_error(g_descripcion_log_error, g_nombre_funcion, g_nivel_error, pm_codigo_procedimiento);
                RETURN 'f'||g_separador||g_respuesta;
            END IF;

            IF EXISTS(SELECT 1 FROM almin.tal_item
            		WHERE id_item = al_id_item
                    AND estado_registro = 'activo') THEN
            	--Estaba activo->LO VUELVE INACTIVO
                UPDATE almin.tal_item SET
                estado_registro = 'inactivo'
                WHERE id_item = al_id_item;
                
                --DESCRIPCI�N DE �XITO PARA GUARDAR EN EL LOG
            	g_descripcion_log_error := 'Item(s) Inactivado(s) ('||al_id_item||')';
            ELSE
            	--Estaba inactivo->LO VUELVE ACTIVO
                UPDATE almin.tal_item SET
                estado_registro = 'activo'
                WHERE id_item = al_id_item;
                
                --DESCRIPCI�N DE �XITO PARA GUARDAR EN EL LOG
            	g_descripcion_log_error := 'Item(s) Activado(s) ('||al_id_item||')';
            END IF;

            --RESPUESTA
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

    ---*** REGISTRO EN EL LOG EL �XITO DE LA EJECUI�N DEL PROCEDIMIENTO
    g_reg_evento:= sss.f_tsg_registro_evento(pm_id_usuario             ,g_id_subsistema           ,g_id_lugar         ,g_descripcion_log_error,
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