<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarSalida.php
Prop�sito:				Permite insertar y modificar datos en la tabla tal_salida
Tabla:					tal_tal_salida
Par�metros:				$hidden_id_salida
						$txt_codigo
						$txt_correlativo_sal
						$txt_correlativo_vale
						$txt_descripcion
						$txt_contabilizar
						$txt_contabilizado
						$txt_estado_salida
						$txt_tipo_entrega
						$txt_estado_registro
						$txt_motivo_cancelacion
						$txt_id_responsable_almacen
						$txt_id_almacen_logico
						$txt_id_empleado
						$txt_id_firma_autorizada
						$txt_id_contratista
						$txt_id_tipo_material
						$txt_id_institucion
						$txt_id_subactividad

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2007-10-25 15:08:17
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../rac_LibModeloAlmacenes.php");

$Custom = new cls_CustomDBAlmacenes();
$nombre_archivo = "ActionModificarSalidaFinalizada.php";

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
			$hidden_id_salida= $_GET["hidden_id_salida_$j"];
			$txt_descripcion= $_GET["txt_descripcion_$j"];
			$txt_observaciones= $_GET["txt_observaciones_$j"];
			$txt_num_contrato= $_GET["txt_num_contrato_$j"];
		}
		else
		{
			$hidden_id_salida=$_POST["hidden_id_salida_$j"];
			$txt_descripcion=$_POST["txt_descripcion_$j"];
			$txt_observaciones= $_POST["txt_observaciones_$j"];
			$txt_num_contrato= $_POST["txt_num_contrato_$j"];
		}
		
		if ($hidden_id_salida == "undefined" || $hidden_id_salida == "")
		{

		}
		else
		{	///////////////////////Modificaci�n////////////////////
			
			$res = $Custom->ModificarSalidasFinalizadas($hidden_id_salida, $txt_descripcion, $txt_observaciones, $txt_num_contrato);
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

	$tipo=utf8_decode($tipo);
	$tipo_pedido=utf8_decode($tipo_pedido);
	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "id_salida";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro =="") {
		if($tipo!='General'&&$tipo!=''){
		   $criterio_filtro = "MOTSAL.tipo=''$tipo'' AND SALIDA.tipo_pedido=''$tipo_pedido''";
		}
		else{
			$criterio_filtro = "SALIDA.tipo_pedido=''$tipo_pedido''" ;
		}
		
	}

	$id_emp = $_SESSION["ss_id_empleado"];
	
	
	//si el rol es administrador no es necesario filtrar por empleado
	//$criterio_filtro = $cond -> obtener_criterio_filtro();
	//echo $id_emp;
	
    if(($id_emp!="null" && $id_emp!='') && $tipo=='Personal'){
    
	       $criterio_filtro= $criterio_filtro." AND SALIDA.id_empleado=$id_emp";
	}


	$res = $Custom->ContarSalidaPedido($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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