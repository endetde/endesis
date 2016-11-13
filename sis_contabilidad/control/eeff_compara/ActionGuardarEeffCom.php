<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarEeff.php
Prop�sito:				Permite insertar y modificar datos en la tabla tct_eeff
Tabla:					tct_eeff
Par�metros:				$id_eeff
						$id_gestion_act
						$id_gestion_ant
						$efff_texto
Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-10-02 11:34:33
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloContabilidad.php");

$Custom = new cls_CustomDBContabilidad();
$nombre_archivo = "ActionGuardarEeffCom.php";

if (!isset($_SESSION["autentificado"]))
{
	$_SESSION["autentificado"]="NO";
}
if($_SESSION["autentificado"]=="SI")
{
	//Verifica si los datos vienen por POST o GET
	if (sizeof($_GET) > 0)
	{
		$get=true;
		$cont=1;
		
		//Verifica si se har� o no la decodificaci�n(s�lo pregunta en caso del GET)
		//valores permitidos de $cod -> "si", "no"
		switch ($cod)
		{
			case "si":
				$decodificar = true;
				break;
			case "no":
				$decodificar = false;
				break;
			default:
				$decodificar = true;
				break;
		}
	}
	elseif(sizeof($_POST) > 0)
	{
		$get = false;
		$cont =  $_POST["cantidad_ids"];
		
		//Por Post siempre se decodifica
		$decodificar = true;
	}
	else
	{
		$resp = new cls_manejo_mensajes(true, "406");
		$resp->mensaje_error = "MENSAJE ERROR = No existen datos para almacenar.";
		$resp->origen = "ORIGEN = ";
		$resp->proc = "PROC = ";
		$resp->nivel = "NIVEL = 4";
		echo $resp->get_mensaje();
		exit;
	}
	
	//Envia al Custom la bandera que indica si se decodificar� o no
	$Custom->decodificar = $decodificar;

	//Realiza el bucle por todos los ids mandados
	for($j = 0;$j < $cont; $j++)
	{
		if ($get)
		{
			$id_eeff = $_GET["id_eeff_$j"];
			$id_gestion_act = $_GET["id_gestion_act_$j"];
			$id_gestion_ant = $_GET["id_gestion_ant_$j"];
			$eeff_texto = $_GET["eeff_texto_$j"];
			$id_reporte_eeff = $_GET["id_reporte_eeff_$j"];
			$id_moneda = $_GET["id_moneda_$j"];
			$eeff_actual = $_GET["eeff_actual_$j"];
			$eeff_fecran = $_GET["eeff_fecran_$j"];
			$eeff_nivel = $_GET["eeff_nivel_$j"];
		}
		else
		{
			$id_eeff = $_POST["id_eeff_$j"];
			$id_gestion_act = $_POST["id_gestion_act_$j"];
			$id_gestion_ant = $_POST["id_gestion_ant_$j"];
			$eeff_texto = $_POST["eeff_texto_$j"];
			$id_reporte_eeff = $_POST["id_reporte_eeff_$j"];
			$id_moneda = $_POST["id_moneda_$j"];
			$eeff_actual = $_POST["eeff_actual_$j"];
			$eeff_fecran = $_POST["eeff_fecran_$j"];
			$eeff_nivel = $_POST["eeff_nivel_$j"];
		}

		if ($id_eeff == "undefined" || $id_eeff == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarEeffCom("insert",$id_eeff,$id_gestion_act,$id_gestion_ant,$eeff_texto,$id_reporte_eeff,$id_moneda,$eeff_actual,$eeff_fecran,$eeff_nivel);

			if(!$res)
			{
				//Error de validaci�n
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1];
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				echo $resp->get_mensaje();
				exit;
			}

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tct_reporte_eeff
			$res = $Custom -> InsertarEeffCom($id_eeff,$id_gestion_act,$id_gestion_ant,$eeff_texto,$id_reporte_eeff,$id_moneda,$eeff_actual,$eeff_fecran,$eeff_nivel);

			if(!$res)
			{
				//Se produjo un error
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1] . " (iteraci�n $cont)";
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				$resp->query = $Custom->query;
				echo $resp->get_mensaje();
				exit;
			}
		}
		else
		{	///////////////////////Modificaci�n////////////////////
			
			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarEeffCom("update",$id_eeff,$id_gestion_act,$id_gestion_ant,$eeff_texto,$id_reporte_eeff,$id_moneda,$eeff_actual,$eeff_fecran,$eeff_nivel);

			if(!$res)
			{
				//Error de validaci�n
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1];
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				echo $resp->get_mensaje();
				exit;
			}

			$res = $Custom->ModificarEeffCom($id_eeff,$id_gestion_act,$id_gestion_ant,$eeff_texto,$id_reporte_eeff,$id_moneda,$eeff_actual,$eeff_fecran,$eeff_nivel);

			if(!$res)
			{
				//Se produjo un error
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1];
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				$resp->query = $Custom->query;
				echo $resp->get_mensaje();
				exit;
			}
		}

	}//END FOR

	//Guarda el mensaje de �xito de la operaci�n realizada
	if($cont > 1) $mensaje_exito = "Se guardaron todos los datos.";
	else $mensaje_exito = $Custom->salida[1];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "id_eeff";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarEeffCom($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
	if($res) $total_registros = $Custom->salida;

	//Arma el xml para desplegar el mensaje
	$resp = new cls_manejo_mensajes(false);
	$resp->add_nodo("TotalCount", $total_registros);
	$resp->add_nodo("mensaje", $mensaje_exito);
	$resp->add_nodo("tiempo_resp", "200");
	echo $resp->get_mensaje();
	exit;
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