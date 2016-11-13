<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarMemoria.php
Prop�sito:				Permite insertar y modificar datos en la tabla tpr_mem_pasaje
Tabla:					tpr_tpr_mem_pasaje
Par�metros:				$id_mem_pasaje
						$id_destino
						$id_moneda
						$periodo_pres
						$total_general
						$id_memoria_calculo

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-08-25 18:50:54
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloPresupuesto.php");

$Custom = new cls_CustomDBPresupuesto();
$nombre_archivo = "ActionGuardarMemoriaPasaje.php";

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
			$id_mem_pasaje= $_GET["id_mem_pasaje_$j"];
			$id_destino= $_GET["id_destino_$j"];
			$id_moneda= $_GET["id_moneda_$j"];
			$periodo_pres= $_GET["periodo_pres_$j"];
			$total_general= $_GET["total_general_$j"];
			$id_memoria_calculo= $_GET["id_memoria_calculo_$j"];
			$id_categoria= $_GET["id_categoria_$j"];
			$nro_personas= $_GET["nro_personas_$j"];

		}
		else
		{
			$id_mem_pasaje=$_POST["id_mem_pasaje_$j"];
			$id_destino=$_POST["id_destino_$j"];
			$id_moneda=$_POST["id_moneda_$j"];
			$periodo_pres=$_POST["periodo_pres_$j"];
			$total_general=$_POST["total_general_$j"];
			$id_memoria_calculo=$_POST["id_memoria_calculo_$j"];
			$id_categoria=$_POST["id_categoria_$j"];
			$nro_personas=$_POST["nro_personas_$j"];

		}

		if ($id_mem_pasaje == "undefined" || $id_mem_pasaje == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarMemoriaPasaje("insert",$id_mem_pasaje, $id_destino,$id_moneda,$periodo_pres,$total_general,$id_memoria_calculo,$id_categoria,$nro_personas);

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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tpr_mem_pasaje
			$res = $Custom -> InsertarMemoriaPasaje($id_mem_pasaje, $id_destino,$id_moneda,$periodo_pres,$total_general,$id_memoria_calculo,$id_categoria,$nro_personas);

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
			$res = $Custom->ValidarMemoriaPasaje("update",$id_mem_pasaje, $id_destino,$id_moneda,$periodo_pres,$total_general,$id_memoria_calculo,$id_categoria,$nro_personas);

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

			$res = $Custom->ModificarMemoriaPasaje($id_mem_pasaje, $id_destino,$id_moneda,$periodo_pres,$total_general,$id_memoria_calculo,$id_categoria);

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
	if($sortcol == "") $sortcol = "id_mem_pasaje";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "MEMCAL.id_memoria_calculo=''$m_id_memoria_calculo''";

	$res = $Custom->ContarMemoriaPasaje($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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