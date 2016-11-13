<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarCategoriaVacacion.php
Prop�sito:				Permite insertar y modificar datos en la tabla tkp_categoria_vacacion
Tabla:					tkp_tkp_categoria_vacacion
Par�metros:				$id_categoria_vacacion
						$nombre
						$dias_vacacion
						$caducidad
						$antiguedad
						$descripcion
						$fecha_reg
						$estado_reg

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2010-08-13 15:23:28
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloKardexPersonal.php");

$Custom = new cls_CustomDBKardexPersonal();
$nombre_archivo = "ActionGuardarCategoriaVacacion.php";

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
			$id_categoria_vacacion= $_GET["id_categoria_vacacion_$j"];
			$nombre= $_GET["nombre_$j"];
			$dias_vacacion= $_GET["dias_vacacion_$j"];
			$caducidad= $_GET["caducidad_$j"];
			$antiguedad_ini= $_GET["antiguedad_ini_$j"];
			$descripcion= $_GET["descripcion_$j"];
			$fecha_reg= $_GET["fecha_reg_$j"];
			$estado_reg= $_GET["estado_reg_$j"];
			$antiguedad_fin= $_GET["antiguedad_fin_$j"];
		}
		else
		{
			$id_categoria_vacacion=$_POST["id_categoria_vacacion_$j"];
			$nombre=$_POST["nombre_$j"];
			$dias_vacacion=$_POST["dias_vacacion_$j"];
			$caducidad=$_POST["caducidad_$j"];
			$antiguedad_ini=$_POST["antiguedad_ini_$j"];
			$descripcion=$_POST["descripcion_$j"];
			$fecha_reg=$_POST["fecha_reg_$j"];
			$estado_reg=$_POST["estado_reg_$j"];
			$antiguedad_fin=$_POST["antiguedad_fin_$j"];
		}

		if ($id_categoria_vacacion == "undefined" || $id_categoria_vacacion == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarCategoriaVacacion("insert",$id_categoria_vacacion,$nombre,$dias_vacacion,$caducidad,$antiguedad,$descripcion,$fecha_reg,$estado_reg);

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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tkp_categoria_vacacion
			$res = $Custom -> InsertarCategoriaVacacion($id_categoria_vacacion,$nombre,$dias_vacacion,$caducidad,$antiguedad_ini,$descripcion,$fecha_reg,$estado_reg,$antiguedad_fin);

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
			$res = $Custom->ValidarCategoriaVacacion("update",$id_categoria_vacacion,$nombre,$dias_vacacion,$caducidad,$antiguedad,$descripcion,$fecha_reg,$estado_reg);

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

			$res = $Custom->ModificarCategoriaVacacion($id_categoria_vacacion,$nombre,$dias_vacacion,$caducidad,$antiguedad_ini,$descripcion,$fecha_reg,$estado_reg,$antiguedad_fin);

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
	if($sortcol == "") $sortcol = "id_categoria_vacacion";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarCategoriaVacacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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