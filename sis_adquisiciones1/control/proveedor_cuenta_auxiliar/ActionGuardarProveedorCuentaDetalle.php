<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarProveedorCuentaDetalle.php
Prop�sito:				Permite insertar y modificar datos en la tabla tad_proveedor_cuenta_auxiliar
Tabla:					tad_tad_proveedor_cuenta_auxiliar
Par�metros:				$id_proveedor_cuenta_auxiliar
						$id_proveedor
						$id_cuenta
						$id_auxiliar
						$id_gestion

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-12-16 16:05:58
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloAdquisiciones.php");

$Custom = new cls_CustomDBAdquisiciones();
$nombre_archivo = "ActionGuardarProveedorCuentaDetalle.php";

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
			$id_proveedor_cuenta_auxiliar= $_GET["id_proveedor_cuenta_auxiliar_$j"];
			$id_proveedor=$_GET["id_proveedor"];
			$id_cuenta= $_GET["id_cuenta_$j"];
			$id_auxiliar= $_GET["id_auxiliar_$j"];
			$id_gestion= $_GET["id_gestion_$j"];
			$tipo= $_GET["tipo_$j"];
			$id_cuenta_anticipo= $_GET["id_cuenta_anticipo_$j"];
			$id_cuenta_garantia= $_GET["id_cuenta_garantia_$j"];
			$id_cuenta_descuento= $_GET["id_cuenta_descuento_$j"];
			$id_cuenta_multa= $_GET["id_cuenta_multa_$j"];

		}
		else
		{
			$id_proveedor_cuenta_auxiliar=$_POST["id_proveedor_cuenta_auxiliar_$j"];
			$id_proveedor=$_POST["id_proveedor"];
			$id_cuenta=$_POST["id_cuenta_$j"];
			$id_auxiliar=$_POST["id_auxiliar_$j"];
			$id_gestion=$_POST["id_gestion_$j"];
			$tipo= $_POST["tipo_$j"];
			$id_cuenta_anticipo= $_POST["id_cuenta_anticipo_$j"];
			$id_cuenta_garantia= $_POST["id_cuenta_garantia_$j"];
 			$id_cuenta_descuento= $_POST["id_cuenta_descuento_$j"];
 			$id_cuenta_multa= $_POST["id_cuenta_multa_$j"];
		}
		
		if ($id_proveedor_cuenta_auxiliar == "undefined" || $id_proveedor_cuenta_auxiliar == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarProveedorCuentaDetalle("insert",$id_proveedor_cuenta_auxiliar, $id_proveedor,$id_cuenta,$id_auxiliar,$id_gestion,$id_cuenta_anticipo,$id_cuenta_garantia);

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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tad_proveedor_cuenta_auxiliar
			$res = $Custom -> InsertarProveedorCuentaDetalle($id_proveedor_cuenta_auxiliar, $id_proveedor,$id_cuenta,$id_auxiliar,$id_gestion,$tipo,$id_cuenta_anticipo,$id_cuenta_garantia,$id_cuenta_descuento,$id_cuenta_multa);

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
			$res = $Custom->ValidarProveedorCuentaDetalle("update",$id_proveedor_cuenta_auxiliar, $id_proveedor,$id_cuenta,$id_auxiliar,$id_gestion,$id_cuenta_anticipo,$id_cuenta_garantia);

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

			$res = $Custom->ModificarProveedorCuentaDetalle($id_proveedor_cuenta_auxiliar, $id_proveedor,$id_cuenta,$id_auxiliar,$id_gestion,$tipo,$id_cuenta_anticipo,$id_cuenta_garantia,$id_cuenta_descuento,$id_cuenta_multa);

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
	if($sortcol == "") $sortcol = "id_proveedor_cuenta_auxiliar";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = " PROVEE.id_proveedor=''$id_proveedor''";

	$res = $Custom->ContarProveedorCuentaDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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