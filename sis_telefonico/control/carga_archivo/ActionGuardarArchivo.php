<?php
/*
**********************************************************
Nombre de archivo:	    ActionGuardarFeriado.php
Prop�sito:				Permite insertar y modificar Feriados
Tabla:					tca_feriado
Par�metros:				$hidden_id_feriado	--> id del feriado
						$descripcion
						$txt_id_usuario_asignacion

Valores de Retorno:    	N�mero de registros
Fecha de Creaci�n:		24-05-2007
Versi�n:				
Autor:					Fernando Prudencio Cardona
**********************************************************
*/
session_start();
include_once("../LibModeloSistemaTelefonico.php");
$Custom = new cls_CustomDBSistemaTelefonico();
$nombre_archivo = 'ActionGuardarArchivo.php';

if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']="NO";
}
if($_SESSION['autentificado']=="SI")
{
	
		include_once("../funciones.inc.php");
		$f = new funciones();
		$archivo_nombre = $HTTP_POST_FILES['archivo']['name'];
		$arch = $HTTP_POST_FILES['archivo']['tmp_name'];
       	$direccion = $f-> carga_archivo($HTTP_POST_FILES['archivo'],'../../archivo/' );
	    $res = $Custom->ProcesarArchivo($archivo_nombre);
	// header("Location: ../../vista/lectura_reloj/lectura_reloj.php");
		
}
?>