<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarTipoCuentaCuenta.php
Prop�sito:				Permite insertar y modificar datos en la tabla  taf_tipo_cuenta_cuenta
Tabla:					taf_tipo_cuenta_cuenta


Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2007-11-07 15:46:18
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloActivoFijo.php");

$Custom = new cls_CustomDBActivoFijo();
$nombre_archivo = "ActionListarTipoCuentaCuenta.php";

if (!isset($_SESSION["autentificado"]))
{
	$_SESSION["autentificado"]="NO";
}
if($_SESSION["autentificado"]=="SI")
{

	$decodificado = stripslashes($_REQUEST['datos']);
	$proceso=stripslashes($_REQUEST['proc']);

	$nodo = json_decode($decodificado,true);

	

	//Selecci�n de procedimiento a ejecutar en la BD
	if($proc==='del'){
		
			$res=$Custom->EliminarTipoCuentaCuenta($nodo['id']);
			if(!$res){
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1] ;
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				$resp->query = $Custom->query;
				echo $resp->get_mensaje();
				exit;
			}
		
      	//Devuelve el mensaje de �xito
		$mensaje_exito = $Custom->salida[1];
		$resp = new cls_manejo_mensajes(false);
		$resp->add_nodo("mensaje",$mensaje_exito);
		$resp->add_nodo("tiempo_resp", "200");
		echo $resp->get_mensaje();
		exit;
	}
	elseif($proc==='add'){
		
			$res = $Custom -> InsertarTipoCuentaCuenta($nodo['id_p'],$nodo['id_tipo_cuenta'],$nodo['id_gestion'],$nodo['id_presupuesto'],$nodo['id_tipo_activo'],$nodo['id_sub_tipo_activo'],$nodo['id_cuenta'],$nodo['id_auxiliar']);
			if(!$res){
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1] ;
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				$resp->query = $Custom->query;
				echo $resp->get_mensaje();
				exit;

			}
			$tmp['id'] = $Custom->salida[2];
			echo json_encode($tmp);
			exit;
		
		
	}
	elseif($proc==='upd'){
		//Verifica si es una inserci�n de TUC y modificaci�n de Composici�n simultaneo
		              
		$res=$Custom->ModificarTipoCuentaCuenta($nodo['id'],$nodo['id_tipo_cuenta'],$nodo['id_gestion'],$nodo['id_presupuesto'],$nodo['id_tipo_activo'],$nodo['id_sub_tipo_activo'],$nodo['id_cuenta'],$nodo['id_auxiliar']);;
			if(!$res){
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1] ;
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				$resp->query = $Custom->query;
				echo $resp->get_mensaje();
				exit;
			}

			//Devuelve el Id del TUC creado
			$tmp['id'] = $Custom->salida[2];
			echo json_encode($tmp);
			exit;		
	}
	
	else
	{
		$resp = new cls_manejo_mensajes(true, "401");
		$resp->mensaje_error = "MENSAJE ERROR = Proceso no identificado";
		$resp->origen = "ORIGEN = $nombre_archivo";
		$resp->proc = "PROC = $nombre_archivo";
		$resp->nivel = "NIVEL = 1";
		echo $resp->get_mensaje();
		exit;
	}

}
else
{
	$resp = new cls_manejo_mensajes(true, "401");
	$resp->mensaje_error = "MENSAJE ERROR = Usuario no Autentificado";
	$resp->origen = "ORIGEN = $nombre_archivo";
	$resp->proc = "PROC = $nombre_archivo";
	$resp->nivel = "NIVEL = 1";
	echo $resp->get_mensaje();
	exit;
}
?>