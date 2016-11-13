<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarEeffLinea.php
Prop�sito:				Permite insertar y modificar datos en la tabla tct_eeff_linea
Tabla:					tct_eeff_linea
Par�metros:				$id_eeff_linea
						$id_cuenta_act
						$id_cuenta_ant
						$linea_dato
						$linea_saldo
						$linea_n
						$linea_s
						$id_eeff_nota

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-10-02 11:34:33
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloContabilidad.php");

$Custom = new cls_CustomDBContabilidad();
$nombre_archivo = "ActionGuardarEeffLinea.php";

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
			$id_eeff_linea = $_GET["id_eeff_linea_$j"];
			$id_eeff = $_GET["id_eeff_$j"];
			$id_cuenta_act = $_GET["id_cuenta_act_$j"];
			$linea_letra = $_GET["linea_letra_$j"];
			$linea_dato = $_GET["linea_dato_$j"];
			$linea_saldo = $_GET["linea_saldo_$j"];
			$linea_n = $_GET["linea_n_$j"];
			$linea_s = $_GET["linea_s_$j"];
			$id_eeff_nota = $_GET["id_eeff_nota_$j"];
			$linea_desope = $_GET["linea_desope_$j"];
			$linea_b = $_GET["linea_b_$j"];
			$linea_nro = $_GET["linea_nro_$j"];
			$linea_t = $_GET["linea_t_$j"];
		}
		else
		{
			$id_eeff_linea = $_POST["id_eeff_linea_$j"];
			$id_eeff = $_POST["id_eeff_$j"];
			$id_cuenta_act = $_POST["id_cuenta_act_$j"];
			$linea_letra = $_POST["linea_letra_$j"];
			$linea_dato = $_POST["linea_dato_$j"];
			$linea_saldo = $_POST["linea_saldo_$j"];
			$linea_n = $_POST["linea_n_$j"];
			$linea_s = $_POST["linea_s_$j"];
			$id_eeff_nota = $_POST["id_eeff_nota_$j"];
			$linea_desope = $_POST["linea_desope_$j"];
			$linea_b = $_POST["linea_b_$j"];
			$linea_nro = $_POST["linea_nro_$j"];
			$linea_t = $_POST["linea_t_$j"];
		}

		if ($id_eeff_linea == "undefined" || $id_eeff_linea == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarEeffLinea("insert",$id_eeff_linea,$id_eeff,$id_cuenta_act,$linea_letra,$linea_dato,$linea_saldo,$linea_n,$linea_s,$id_eeff_nota,$linea_desope,$linea_b,$linea_nro,$linea_t);

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
			$res = $Custom -> InsertarEeffLinea($id_eeff_linea,$id_eeff,$id_cuenta_act,$linea_letra,$linea_dato,$linea_saldo,$linea_n,$linea_s,$id_eeff_nota,$linea_desope,$linea_b,$linea_nro,$linea_t);

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
			$res = $Custom->ValidarEeffLinea("update",$id_eeff_linea,$id_eeff,$id_cuenta_act,$linea_letra,$linea_dato,$linea_saldo,$linea_n,$linea_s,$id_eeff_nota,$linea_desope,$linea_b,$linea_nro,$linea_t);

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

			$res = $Custom->ModificarEeffLinea($id_eeff_linea,$id_eeff,$id_cuenta_act,$linea_letra,$linea_dato,$linea_saldo,$linea_n,$linea_s,$id_eeff_nota,$linea_desope,$linea_b,$linea_nro,$linea_t);

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
	if($sortcol == "") $sortcol = "id_eeff_linea";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarEeffLinea($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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