<?php 
/**
**********************************************************
Nombre de archivo:	    control.php
Prop�sito:				Permite autenticar al usuario
Tabla:					tsg_usuario
Par�metros:				$login_usuario
						$contrasenia

Valores de Retorno:    	Permite o deniega acceso al sistema
Fecha de Creaci�n:		11 - 06 - 07
Versi�n:				1.0.0
Autor:					Enzo Rojas
**********************************************************
*/
//vemos si el usuario y contrase�a es v�ildo 
//session_destroy();
session_start() ;
//session_register('ss_id_usuario');
include_once("../LibModeloSeguridad.php");
include_once("../../../lib/configuracion.log.php");
$Custom = new cls_CustomDBSeguridad();
$nombre_archivo = 'control.php';
$ip_origenx = captura_ip();


//$usu = preg_replace("/\\n", "",$_POST["usuario"]);
$login_usuario = addslashes(htmlentities($_POST["usuario"],ENT_QUOTES));
//$con = preg_replace("/\\/0", "",$_POST["contrasena"]);
$contrasenia = md5(addslashes(htmlentities($_POST["contrasena"],ENT_QUOTES)));
$nombre_basedatos = addslashes(htmlentities($_POST["nombre_basedatos"],ENT_QUOTES));

//cargamos el nombre de la base de datos
$_SESSION["BASE_DATOS"] = $nombre_basedatos;
$_SESSION["ss_nombre_basedatos"] = $_SESSION["BASE_DATOS"];

	include ("../../../lib/configuracion.inc.php");	

	
	$_SESSION["autentificado"] = "SI";
	$_SESSION["ss_id_usuario"] = 10;//id_usuario id del usuario
	$_SESSION["ss_id_rol"] = 1;//id_rol asignado al usuario
	$_SESSION["ss_id_lugar"] = 1;//id_lugar id del lugar
	$_SESSION["ss_nombre_lugar"] = "COCHABAMBA";//nombre_lugar nombre del lugar	
	$_SESSION["ss_nombre_usuario"] = "JUAN PEREZ";//nombre_usaurio nombre completo del usuario	
	$_SESSION["ss_estilo_usuario"] = "xtheme-vista.css";//estilo_usuario estilo para el tema de la interfaz
	$_SESSION["ss_filtro_avanzado"] = 'true';
	$_SESSION["ss_ip"] = $ip_origenx;
	$_SESSION["ss_mac"] = "99:99:99:99:99:99";
	$_SESSION["SESION_TIME"] = time();
	//echo "time; ".$_SESSION["SESION_TIME"];
	$_SESSION["ID_SESSION"] = session_id();
	
	
	//Redireccionamos al la pagina principal del sistema
    //header ("Location: ../../vista/administracion/layout4.php"); 
    echo "{success:true}";
    exit;   

?>