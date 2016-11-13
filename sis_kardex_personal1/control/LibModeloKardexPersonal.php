<?php
/**
 * Nombre de la Archivo:	LibModeloKardexPersonal
 * Prop�sito:				Aqui se incluyen todas los custom necesarios para que funcionen
 * el la capa de CONTROL
 * Fecha de Creaci�n:		21/06/2007
 * Autor:					Rodrigo Chumacero Moscoso
 */

include_once("../../../lib/configuracion.inc.php");
include_once("../../../lib/lib_general/cls_funciones.php");
include_once("../../../lib/lib_general/cls_archivos.php");
include_once("../../../lib/lib_modelo/cls_conexion.php");
include_once("../../../lib/lib_modelo/cls_middle.php");
include_once("../../../lib/lib_modelo/cls_define_tipo_dato.php");
include_once("../../../lib/lib_control/cls_manejo_xml.php");
include_once("../../../lib/lib_control/cls_manejo_mensajes.php");
include_once("../../../lib/lib_control/cls_validacion_serv.php");
include_once("../../../lib/lib_control/cls_criterio_filtro.php");
include_once(dirname(__FILE__)."../../../lib/lib_control/cls_criterio_sort.php");
include_once(dirname(__FILE__)."../../../lib/lib_general/cls_correo.php");

include_once("../../modelo/cls_CustomDBKardexPersonal.php");

?>
