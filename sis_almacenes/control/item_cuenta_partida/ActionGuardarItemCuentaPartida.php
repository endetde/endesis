<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarItemArchivo.php
Prop�sito:				Permite insertar y modificar datos en la tabla tal_item_archivo
Tabla:					tal_item_archivo
Par�metros:				$hidden_id_item_archivo
						$txt_descripcion
						$txt_tipo
						$txt_archivo
						$txt_id_item
						
	
Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		
Versi�n:				
Autor:					
**********************************************************
*/
session_start();
include_once("../LibModeloAlmacenes.php");

$Custom = new cls_CustomDBAlmacenes();
$nombre_archivo = "ActionGuardarItemCuentaPartida.php";

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
			$hidden_id_item_cuenta_partida  = $_GET["hidden_id_item_cuenta_partida_$j"];
			$txt_nivel      			    = $_GET["txt_nivel_$j"];
			$txt_id_supergrupo				= $_GET["txt_id_supergrupo_$j"];
			$txt_id_grupo					= $_GET["txt_id_grupo_$j"];
			$txt_id_subgrupo				= $_GET["txt_id_subgrupo_$j"];
			$txt_id_id1 					= $_GET["txt_id_id1_$j"];
			$txt_id_id2 					= $_GET["txt_id_id2_$j"];
			$txt_id_id3 					= $_GET["txt_id_id3_$j"];
			$txt_id_cuenta 					= $_GET["txt_id_cuenta_$j"];
			$txt_id_partida					= $_GET["txt_id_partida_$j"];
			$txt_id_gestion					= $_GET["txt_id_gestion_$j"];
			$txt_id_cuenta_gasto			= $_GET["txt_id_cuenta_gasto_$j"];
			$txt_id_presupuesto	            = $_GET["txt_id_presupuesto_$j"];
			$txt_id_auxiliar_activo			= $_GET["txt_id_auxiliar_activo_$j"];
			$txt_id_auxiliar_gasto			= $_GET["txt_id_auxiliar_gasto_$j"];
		}
		else
		{
			$hidden_id_item_cuenta_partida  = $_POST["hidden_id_item_cuenta_partida_$j"];
			$txt_nivel      			    = $_POST["txt_nivel_$j"];
			$txt_id_supergrupo				= $_POST["txt_id_supergrupo_$j"];
			$txt_id_grupo					= $_POST["txt_id_grupo_$j"];
			$txt_id_subgrupo				= $_POST["txt_id_subgrupo_$j"];
			$txt_id_id1 					= $_POST["txt_id_id1_$j"];
			$txt_id_id2 					= $_POST["txt_id_id2_$j"];
			$txt_id_id3 					= $_POST["txt_id_id3_$j"];
			$txt_id_cuenta 					= $_POST["txt_id_cuenta_$j"];
			$txt_id_partida					= $_POST["txt_id_partida_$j"];				
			$txt_id_gestion					= $_POST["txt_id_gestion_$j"];
			$txt_id_cuenta_gasto			= $_POST["txt_id_cuenta_gasto_$j"];
			$txt_id_presupuesto   	        = $_POST["txt_id_presupuesto_$j"];
			$txt_id_auxiliar_activo			= $_POST["txt_id_auxiliar_activo_$j"];
			$txt_id_auxiliar_gasto			= $_POST["txt_id_auxiliar_gasto_$j"];				
		}
        if($txt_nivel==1){$id_material=$txt_id_supergrupo;}
        if($txt_nivel==2){$id_material=$txt_id_grupo;}
        if($txt_nivel==3){$id_material=$txt_id_subgrupo;}
        if($txt_nivel==4){$id_material=$txt_id_id1;}
        if($txt_nivel==5){$id_material=$txt_id_id2;}
        if($txt_nivel==6){$id_material=$txt_id_id3;}
		if ($hidden_id_item_cuenta_partida == "undefined" || $hidden_id_item_cuenta_partida == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarItemCuentaPartida("insert",$hidden_id_item_cuenta_partida,$txt_nivel, $id_material,$txt_id_cuenta, $txt_id_partida,$txt_id_gestion,$txt_id_cuenta_gasto,$txt_id_presupuesto,$txt_id_auxiliar_activo,$txt_id_auxiliar_gasto);
			
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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tal_item_reemplazo
			$res = $Custom -> InsertarItemCuentaPartida($hidden_id_item_cuenta_partida,$txt_nivel, $id_material,$txt_id_cuenta, $txt_id_partida,$txt_id_gestion,$txt_id_cuenta_gasto,$txt_id_presupuesto,$txt_id_auxiliar_activo,$txt_id_auxiliar_gasto);

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
			$res = $Custom->ValidarItemCuentaPartida("update",$hidden_id_item_cuenta_partida,$txt_nivel, $id_material,$txt_id_cuenta, $txt_id_partida,$txt_id_gestion,$txt_id_cuenta_gasto,$txt_id_presupuesto,$txt_id_auxiliar_activo,$txt_id_auxiliar_gasto);
			
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

			$res = $Custom->ModificarItemCuentaPartida($hidden_id_item_cuenta_partida,$txt_nivel, $id_material,$txt_id_cuenta, $txt_id_partida,$txt_id_gestion,$txt_id_cuenta_gasto,$txt_id_presupuesto,$txt_id_auxiliar_activo,$txt_id_auxiliar_gasto);

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
	if($sortcol == "") $sortcol = "id_item_cuenta_partida";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarItemCuentaPartida($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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