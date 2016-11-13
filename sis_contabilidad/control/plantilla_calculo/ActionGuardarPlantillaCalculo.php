<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarPlantillaCalculo.php
Prop�sito:				Permite insertar y modificar datos en la tabla tct_plantilla_calculo
Tabla:					tct_tct_plantilla_calculo
Par�metros:				$id_plantilla_calculo
						$id_plantilla
						$tipo_cuenta
						$id_ejercicio
						$debe_haber
						$porcen_calculo

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-10-16 12:20:41
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloContabilidad.php");

$Custom = new cls_CustomDBContabilidad();
$nombre_archivo = "ActionGuardarPlantillaCalculo.php";

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
			$id_plantilla_calculo= $_GET["id_plantilla_calculo_$j"];
			$id_plantilla= $_GET["id_plantilla_$j"];
			$tipo_cuenta= $_GET["tipo_cuenta_$j"];
			$id_ejercicio= $_GET["id_ejercicio_$j"];
			$debe_haber= $_GET["debe_haber_$j"];
			$porcen_calculo= $_GET["porcen_calculo_$j"];
			$campo_doc= $_GET["campo_doc_$j"];
			$sw_porcentaje= $_GET["sw_porcentaje_$j"];
			$sw_retencion= $_GET["sw_retencion_$j"];
			$sw_contabilizacion= $_GET["sw_contabilizacion_$j"];

			//id_gestion
			$id_gestion=$_GET["id_gestion_$j"];
			
		}
		else
		{
			$id_plantilla_calculo=$_POST["id_plantilla_calculo_$j"];
			$id_plantilla=$_POST["id_plantilla_$j"];
			$tipo_cuenta=$_POST["tipo_cuenta_$j"];
			$id_ejercicio=$_POST["id_ejercicio_$j"];
			$debe_haber=$_POST["debe_haber_$j"];
			$porcen_calculo=$_POST["porcen_calculo_$j"];
			$campo_doc= $_POST["campo_doc_$j"];
			$sw_porcentaje= $_POST["sw_porcentaje_$j"];
			$sw_retencion= $_POST["sw_retencion_$j"];
			$sw_contabilizacion= $_POST["sw_contabilizacion_$j"];
			
			$id_gestion=$_POST["id_gestion_$j"];
			$id_gestion_plantilla=$_POST["id_gestion_plantilla_$j"];
		}
     
		if ($id_plantilla_calculo == "undefined" || $id_plantilla_calculo == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarPlantillaCalculo("insert",$id_plantilla_calculo, $id_plantilla,$tipo_cuenta,$id_ejercicio,$debe_haber,$porcen_calculo,$sw_porcentaje,$sw_retencion,$sw_contabilizacion);

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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tct_plantilla_calculo
			$res = $Custom -> InsertarPlantillaCalculo($id_plantilla_calculo, $id_plantilla,$tipo_cuenta,$id_ejercicio,$debe_haber,$porcen_calculo,$campo_doc,$sw_porcentaje,$sw_retencion,$sw_contabilizacion,$id_gestion_plantilla);

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
			$res = $Custom->ValidarPlantillaCalculo("update",$id_plantilla_calculo, $id_plantilla,$tipo_cuenta,$id_ejercicio,$debe_haber,$porcen_calculo,$sw_porcentaje,$sw_retencion,$sw_contabilizacion);

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
                  
			$res = $Custom->ModificarPlantillaCalculo($id_plantilla_calculo, $id_plantilla,$tipo_cuenta,$id_ejercicio,$debe_haber,$porcen_calculo,$campo_doc,$sw_porcentaje,$sw_retencion,$sw_contabilizacion,$id_gestion_plantilla);
          
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
	if($sortcol == "") $sortcol = "id_plantilla_calculo";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "PLANT.id_plantilla=''$m_id_plantilla''";

	$res = $Custom->ContarPlantillaCalculo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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