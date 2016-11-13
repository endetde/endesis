<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarNormativas.php
Prop�sito:				Permite insertar y modificar datos en la tabla com_normativa_interna
Tabla:					com_normativa_interna
Par�metros:				dependiendo
						

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2013-05-2013
Versi�n:				1.0.0
Autor:					Morgan Huascar Checa Lopez
**********************************************************
*/
session_start();
include_once('../LibModeloAdministracionComunidad.php');

$Custom = new cls_CustomDBComunidad();
$nombre_archivo = "ActionGuardarNormativaInterna.php";

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
			$id_normativa=$_GET["id_normativa_interna_$j"];
			$nombre_normativa=$_GET["nombre_categoria_normativa_$j"];
			$descripcion_normativa=$_GET["descripcion_categoria_$j"];
			//PARA SUBIR ARCHIVO
			/*$txt_archivo = $_FILES["ni_ruta_archivo"]["tmp_name"];
			$ruta_archivo= ($_FILES["ni_ruta_archivo"]["name"]);
			$extension_archivo = $_FILES["ni_ruta_archivo"]["type"];
			$directorio_archivo = '../../../../comunidadEnde/vista/archivos/normativaInterna/';
			$extension_archivo=substr(strrchr($ruta_archivo, '.'), 1);*/
			
		
		}
		else
		{
		
			$id_normativa=$_POST["id_normativa_interna_$j"];
			$nombre_normativa=$_POST["nombre_categoria_normativa_$j"];
			$descripcion_normativa=$_POST["descripcion_categoria_$j"];
			//PARA SUBIR ARCHIVO
			/*$txt_archivo = $_FILES["ni_ruta_archivo"]["tmp_name"];
			$ruta_archivo= ($_FILES["ni_ruta_archivo"]["name"]);
			$extension_archivo = $_FILES["ni_ruta_archivo"]["type"];
			$directorio_archivo = '../../../../comunidadEnde/vista/archivos/normativaInterna/';
			$extension_archivo=substr(strrchr($ruta_archivo, '.'), 1);*/
			

		}
	 /*   echo $id_normativa;
	    exit;*/
               
		if ($id_normativa == "undefined" || $id_normativa== "")
		{
			//include("../ActionSubirArchivo.php");
			////////////////////Inserci�n/////////////////////
					//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla com_publicaciones 
					$res = $Custom -> InsertarNormativas($id_normativa,$nombre_normativa,$descripcion_normativa);
			
						if(!$res){
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
			
		
			//if($ruta_archivo!=''){include("../ActionSubirArchivo.php");}
			$res = $Custom->ModificarNormativas($id_normativa,$nombre_normativa,$descripcion_normativa);

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
	if($sortcol == "") $sortcol = "NI.id_normativa_interna ASC";
	if($sortdir == "") $sortdir = " ";
	if($criterio_filtro == "") $criterio_filtro = "0=0 and NI.estado_registro=''activo'' ";

	$res = $Custom->ContarNormativas($cant,$puntero,$sortcol,$sortdir,$criterio_filtro);
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