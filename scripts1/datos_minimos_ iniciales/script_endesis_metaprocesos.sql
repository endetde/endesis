/**************************************************************************
 SISTEMA ENDESIS
***************************************************************************
 SCRIPT: 		script_endesis_metaprocesos.sql
 DESCRIPCI�N: 	Script de creaci�n de los metaprocesos definidos (para la estructura del men� de la aplicaci�n)
 AUTOR: 		Rodrigo Chumacero Moscoso
 FECHA:			20-07-2007
 COMENTARIOS:	
***************************************************************************
 HISTORIA DE MODIFICACIONES:

 DESCRIPCI�N:
 AUTOR:
 FECHA:

***************************************************************************/

/* Data for the `public.tsg_metaproceso` table  (Records 1 - 64) */
INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (1, 1, 1, 0, 'ENDESIS', 'ENDESIS', NULL, NULL, '11/05/2007', '10:42:00', NULL, NULL, 'Sistema de Informaci�n Administrativo Financiero ENDE', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (2, 2, 1, 1, 'ACTIF', 'ACTIF', NULL, NULL, '11/05/2007', '10:44:00', NULL, NULL, 'Sistema de Administraci�n y Control de Activos Fijos', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (3, 3, 1, 1, 'ALMIN', 'ALMIN', NULL, NULL, '11/05/2007', '10:55:00', NULL, NULL, 'Sistema de Almacenes e Inventarios', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (4, 4, 1, 1, 'SICOMP', 'SICOMP', NULL, NULL, '11/05/2007', '10:57:00', NULL, NULL, 'Sistema de Compras', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (5, 5, 1, 1, 'KARD', 'KARD', NULL, NULL, '11/05/2007', '10:58:00', NULL, NULL, 'Sistema de Kardex de Personal', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (6, 6, 1, 1, 'SSS', 'SSS', NULL, NULL, '11/05/2007', '10:58:00', NULL, NULL, 'Sistema de Seguridad', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (7, 7, 1, 1, 'PM', 'PM', NULL, NULL, '11/05/2007', '10:59:00', NULL, NULL, 'Sistema de Par�metros', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (8, 8, 1, 1, 'SAJ', 'SAJ', NULL, NULL, '11/05/2007', '11:00:00', NULL, NULL, 'Sistema Jur�dico', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (9, 9, 1, 1, 'SCI', 'SCI', NULL, NULL, '11/05/2007', '11:00:00', NULL, NULL, 'Sistema de Contabilidad Integrada', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (10, 1, 2, 2, 'Par�metros', 'AF_PARAM', NULL, NULL, '11/05/2007', '11:11:00', NULL, NULL, 'Par�metros de Activos Fijos', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (11, 1, 2, 2, 'Procesos', 'AF_OPER', NULL, NULL, '11/05/2007', '11:12:00', NULL, NULL, 'Operaciones de Activos Fijos', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (12, 1, 2, 2, 'Reportes', 'AF_REP', NULL, NULL, '11/05/2007', '11:13:00', NULL, NULL, 'Reportes de Activos Fijos', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (13, 1, 10, 3, 'M�todos de Depreciaci�n', 'AF_MET_DEP', 'f_taf_metodo_depreciacion', 'sis_activos_fijos/vista/metodo_depreciacion/metodo_depreciacion.php', '11/05/2007', '11:14:00', NULL, NULL, 'M�todos de Depreciaci�n considerados', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (14, 1, 10, 3, 'Definici�n de Procesos ', 'AF_PROC', 'f_taf_proceso', 'sis_activos_fijos/vista/proceso/proceso.php', '11/05/2007', '11:16:00', NULL, NULL, 'Procesos a realizar con los Activos Fijos', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (15, 1, 10, 3, 'Tipos de Activos Fijos', 'AF_TIP', 'f_taf_tipo_activo', 'sis_activos_fijos/vista/tipo_activo/tipo_activo.php', '11/05/2007', '11:23:00', NULL, NULL, 'Tipos de Activos Fijos', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (16, 1, 14, 4, 'Motivos para la realizaci�n de los procesos con los Activos Fijos', 'AF_MOT_PROC', 'f_taf_proceso_motivo', NULL, '11/05/2007', '11:27:00', NULL, NULL, 'Motivos para la realizaci�n de los procesos con los Activos Fijos', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (17, 1, 15, 4, 'Subtipos de Activos Fijos', 'AF_SUBTIP', 'f_taf_sub_tipo_activo', NULL, '11/05/2007', '11:31:00', NULL, NULL, 'Subtipos de los Activos Fijos', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (18, 1, 15, 4, 'Relacionador Tipos/Proceso/Cuentas Contables', 'AF_TIPO_PROC_CTA', 'f_taf_tipo_activo_proceso', NULL, '11/05/2007', '11:33:00', NULL, NULL, 'Relaciona los procesos por Tipo con las cuentas contables', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (19, 1, 15, 4, 'Caracter�sticas por Tipo', 'AF_TIP_CAR', 'f_taf_caracteristicas', NULL, '11/05/2007', '12:07:00', NULL, NULL, 'Caracter�stifcas generales de los activos fijos por Tipo', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (20, 1, 13, 4, 'Inserci�n M�todos de Depreciaci�n', 'AF_MET_DEP_INS', 'f_taf_metodo_depreciacion', NULL, '11/05/2007', '12:09:00', NULL, NULL, 'Inserci�n de M�todos de Depreciaci�n', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (21, 1, 13, 4, 'Modificaci�n de M�todos de Depreciaci�n', 'AF_MET_DEP_UPD', 'f_taf_metodo_depreciacion', NULL, '11/05/2007', '12:11:00', NULL, NULL, 'Modificaci�n de M�todos de Depreciaci�n', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (22, 1, 13, 4, 'Eliminaci�n de M�todos de Depreciaci�n', 'AF_MET_DEP_DEL', 'f_taf_metodo_depreciacion', NULL, '11/05/2007', '12:12:00', NULL, NULL, 'Eliminaci�n de M�todos de Depreciaci�n', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (23, 1, 14, 4, 'Inserci�n de Procesos de Activos Fijos', 'AF_PROC_INS', 'f_taf_proceso', NULL, '11/05/2007', '12:19:00', NULL, NULL, 'Inserci�n de Procesos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (24, 1, 14, 4, 'Modificaci�n de Procesos de Activos Fijos', 'AF_PROC_UPD', 'f_taf_proceso', '', '11/05/2007', '12:19:00', NULL, NULL, 'Modificaci�n de Procesos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (25, 1, 15, 4, 'Eliminaci�n de Procesos de Activos Fijos', 'AF_PROC_DEL', 'f_taf_proceso', '', '11/05/2007', '12:23:00', NULL, NULL, 'Eliminaci�n de Procesos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (26, 1, 15, 4, 'Inserci�n de Tipos de Activos', 'AF_TIP_INS', 'f_taf_tipo_activo', 'sis_activos_fijos/vista/tipo_activo/tipo_activo.php', '11/05/2007', '12:23:00', NULL, NULL, 'Inserci�n de Tipos de Activos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (27, 1, 15, 4, 'Modificaci�n de Tipos de Activos', 'AF_TIP_UPD', 'f_taf_tipo_activo', NULL, '11/05/2007', '12:23:00', NULL, NULL, 'Modificaci�n de Tipos de Activos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (28, 1, 15, 4, 'Eliminaci�n de Tipos de Activos', 'AF_TIP_DEL', 'f_taf_tipo_activo', NULL, '11/05/2007', '12:23:00', NULL, NULL, 'Eliminaci�n de Tipos de Activos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (29, 1, 16, 5, 'Inserci�n de Motivos de Procesos de Activos Fijos', 'AF_MOT_PROC_INS', 'f_taf_proceso_motivo', NULL, '11/05/2007', '12:23:00', NULL, NULL, 'Inserci�n de Motivos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (30, 1, 16, 5, 'Modificaci�n de Motivos de Procesos de Activos Fijos', 'AF_MOT_PROC_UPD', 'f_taf_proceso_motivo', NULL, '11/05/2007', '12:23:00', NULL, NULL, 'Modificaci�n de Motivos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (31, 1, 16, 5, 'Eliminaci�n de Motivos de Procesos de Activos Fijos', 'AF_MOT_PROC_DEL', 'f_taf_proceso_motivo', NULL, '11/05/2007', '12:23:00', NULL, NULL, 'Eliminaci�n de Motivos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (32, 1, 17, 5, 'Inserci�n de Subtipos de Activos Fijos', 'AF_SUBTIP_INS', 'f_taf_sub_tipo_activo', NULL, '11/05/2007', '11:31:00', NULL, NULL, 'Inserci�n de subtipos de activos fijos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (33, 1, 17, 5, 'Modificaci�n de Subtipos de Activos Fijos', 'AF_SUBTIP_UPD', 'f_taf_sub_tipo_activo', NULL, '11/05/2007', '11:31:00', NULL, NULL, 'Modificaci�n de subtipos de activos fijos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (34, 1, 17, 5, 'Eliminaci�n de Subtipos de Activos Fijos', 'AF_SUBTIP_DEL', 'f_taf_sub_tipo_activo', NULL, '11/05/2007', '11:31:00', NULL, NULL, 'Eliminaci�n de subtipos de activos fijos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (35, 1, 18, 5, 'Inserci�n de relaci�n Tipo/Proceso/Cuenta', 'AF_TIPO_PROC_CTA_INS', 'f_taf_tipo_activo_proceso', NULL, '11/05/2007', '11:33:00', NULL, NULL, 'Inserci�n relaci�n Tipo/Proceso/Cuenta', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (36, 1, 18, 5, 'Modificaci�n relaci�n Tipo/Proceso/Cuenta', 'AF_TIPO_PROC_CTA_UPD', 'f_taf_tipo_activo_proceso', NULL, '11/05/2007', '11:33:00', NULL, NULL, 'Modificaci�n relaci�n Tipo/Proceso/Cuenta', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (37, 1, 18, 5, 'Eliminaci�n relaci�n Tipo/Proceso/Cuenta', 'AF_TIPO_PROC_CTA_DEL', 'f_taf_tipo_activo_proceso', NULL, '11/05/2007', '11:33:00', NULL, NULL, 'Eliminaci�n relaci�n Tipo/Proceso/Cuenta', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (38, 1, 19, 5, 'Inserci�n Caracter�sticas Generales por Tipo', 'AF_TIP_CAR_INS', 'f_taf_caracteristicas', NULL, '11/05/2007', '12:07:00', NULL, NULL, 'Inserci�n de caracter�sticas generales de los activos fijos por Tipo', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (39, 1, 11, 3, 'Alta de Activos Fijos', 'AF_AF', 'f_taf_activo_fijo', 'sis_activos_fijos/vista/activo_fijo/activo_fijo.php', '15/05/2007', '20:00:00', NULL, NULL, 'Registro de Activos Fijos', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (40, 1, 39, 4, 'Inserci�n Activos Fijos', 'AF_AF_INS', 'f_taf_activo_fijo', NULL, '15/05/2007', '20:00:00', NULL, NULL, 'Inserci�n de Activos Fijos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (41, 1, 39, 4, 'Modificaci�n Activos Fijos', 'AF_AF_UPD', 'f_taf_activo_fijo', NULL, '15/05/2007', '20:00:00', NULL, NULL, 'Modificaci�n de Activos Fijos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (42, 1, 39, 4, 'Eliminaci�n Activos Fijos', 'AF_AF_DEL', 'f_taf_activo_fijo', NULL, '15/05/2007', '20:00:00', NULL, NULL, 'Eliminaci�n de Activos Fijos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (43, 1, 13, 4, 'Selecci�n de M�todos de Depreciaci�n', 'AF_MET_DEP_SEL', 'f_taf_metodo_depreciacion', NULL, '15/05/2007', '20:00:00', NULL, NULL, 'Selecci�n de M�todos de depreciaci�n', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (44, 1, 14, 4, 'Selecci�n de Procesos de Activos Fijos', 'AF_PROC_SEL', 'f_taf_proceso', NULL, '15/05/2007', '20:00:00', NULL, NULL, 'Selecci�n de Procesos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (45, 1, 15, 4, 'Selecci�n de Tipos de Activos', 'AF_TIP_SEL', 'f_taf_tipo_activo', NULL, '15/05/2007', '20:00:00', NULL, NULL, 'Selecci�n de Tipos de Activos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (46, 1, 16, 5, 'Selecci�n de Motivos de los Procesos', 'AF_MOT_PROC_SEL', 'f_taf_proceso_motivo', NULL, '15/05/2007', '20:00:00', NULL, NULL, 'Selecci�n de Motivos de los Procesos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (47, 1, 17, 5, 'Selecci�n de Subtipos de Activos Fijos', 'AF_SUBTIP_SEL', 'f_taf_sub_tipo_activo', NULL, '15/05/2007', '20:00:00', NULL, NULL, 'Selecci�n de Sub Tipos de Activos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (48, 1, 18, 5, 'Selecci�n de Relaci�n Tipo/Proceso/Cuenta', 'AF_TIPO_PROC_CTA_SEL', 'f_taf_tipo_activo_proceso', NULL, '15/05/2007', '20:00:00', NULL, NULL, 'Selecci�n de Relaci�n Tipo/Proceso/Cuenta', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (49, 1, 19, 5, 'Modificaci�n de Caracter�sticas Generales por Tipo', 'AF_TIP_CAR_UPD', 'f_taf_caracteristicas', NULL, '15/05/2007', '20:00:00', NULL, NULL, 'Modificaci�n de Caracter�sticas Generales por Tipo', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (50, 1, 19, 5, 'Eliminaci�n de Caracter�sticas Generales por Tipo', 'AF_TIP_CAR_DEL', 'f_taf_caracteristicas', NULL, '15/05/2007', '20:00:00', NULL, NULL, 'Eliminaci�n de Caracter�sticas Generales por Tipo', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (51, 1, 19, 5, 'Selecci�n de Caracter�sticas Generales por Tipo', 'AF_TIP_CAR_SEL', 'f_taf_caracteristicas', NULL, '15/05/2007', '20:00:00', NULL, NULL, 'Selecci�n de Caracter�sticas Generales por Tipo', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (52, 1, 39, 4, 'Selecci�n de Activos Fijos', 'AF_AF_SEL', 'f_taf_activo_fijo', NULL, '15/05/2007', '20:00:00', NULL, NULL, 'Selecci�n de Activos Fijos', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (53, 1, 11, 3, 'Unidades Constructivas', 'AF_UNI_CONS', 'f_taf_unidad_constructiva', 'sis_activos_fijos/vista/unidad_constructiva/unidad_constructiva.php', '01/06/2007', '20:00:00', NULL, NULL, 'Unidades Constructivas', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (54, 1, 53, 4, 'Inserci�n Unidades Constructivas', 'AF_UNI_CONS_INS', 'f_taf_unidad_constructiva', NULL, '01/06/2007', '20:00:00', NULL, NULL, 'Inserci�n de Unidades Constructivas', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (55, 1, 53, 4, 'Modificaci�n Unidades Constructivas', 'AF_UNI_CONS_UPD', 'f_taf_unidad_constructiva', NULL, '01/06/2007', '20:00:00', NULL, NULL, 'Modificaci�n de Unidades Constructivas', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (56, 1, 53, 4, 'Eliminaci�n Unidades Constructivas', 'AF_UNI_CONS_DEL', 'f_taf_unidad_constructiva', NULL, '01/06/2007', '20:00:00', NULL, NULL, 'Eliminaci�n de Unidades Constructivas', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (57, 1, 53, 4, 'Selecci�n Unidades Constructivas', 'AF_UNI_CONS_SEL', 'f_taf_unidad_constructiva', NULL, '01/06/2007', '20:00:00', NULL, NULL, 'Selecci�n de Unidades Constructivas', 'si', 'si');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (58, 1, 11, 3, 'Registro de Mejoras', 'AF_AF_PROC', 'f_taf_activo_fijo_proceso', 'sis_activos_fijos/vista/activo_fijo_proceso/activo_fijo_proceso__mejora.php', '15/05/2007', '20:00:00', NULL, NULL, 'Registro de Mejoras de Activos Fijos', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (59, 1, 11, 3, 'Registro de Revalorizaciones', 'AF_AF_PROC', 'f_taf_activo_fijo_proceso', 'sis_activos_fijos/vista/activo_fijo_proceso/activo_fijo_proceso__reval.php', '15/05/2007', '20:00:00', NULL, NULL, 'Registro de Revalorizaciones de Activos Fijos', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (60, 1, 11, 3, 'Registro de Bajas', 'AF_AF_PROC', 'f_taf_activo_fijo_proceso', 'sis_activos_fijos/vista/activo_fijo_proceso/activo_fijo_proceso__baja.php', '15/05/2007', '20:00:00', NULL, NULL, 'Registro de Bajas de Activos Fijos', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (61, 1, 11, 3, 'Aprobaci�n (Mejora, Revalorizaci�n, Baja)', 'AF_AF_PROC', 'f_taf_activo_fijo_proceso', 'sis_activos_fijos/vista/activo_fijo_proceso/activo_fijo_proceso__aprobacion.php', '15/05/2007', '20:00:00', NULL, NULL, 'Aprobaci�n de procesos aplicados sobre los Activos Fijos', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (62, 1, 11, 3, 'Depreciaciones', 'AF_DEP', 'f_af_depreciacion', 'sis_activos_fijos/vista/depreciacion/proc_depreciacion.php', '15/05/2007', '20:00:00', NULL, NULL, 'Ejecuci�n de Depreciaci�n de Activos Fijos', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (63, 6, 6, 2, 'Par�metros', '', NULL, NULL, '13/07/2007', '20:00:00', NULL, NULL, 'Par�metros Sistema Seguridad', 'si', 'no');

INSERT INTO "public"."tsg_metaproceso" ("id_metaproceso", "id_subsistema", "fk_id_metaproceso", "nivel", "nombre", "codigo_procedimiento", "nombre_achivo", "ruta_archivo", "fecha_registro", "hora_registro", "fecha_ultima_modificacion", "hora_ultima_modificacion", "descripcion", "visible", "habilitar_log")
VALUES 
  (64, 6, 63, 3, 'Ingreso de Par�metros Generales', 'SG_INS_PG', 'f_tsg_parametros_general', NULL, '13/07/2007', '20:00:00', NULL, NULL, NULL, 'si', 'no');
