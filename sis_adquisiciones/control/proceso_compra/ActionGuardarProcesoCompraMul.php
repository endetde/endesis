<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarProcesoCompra.php
Prop�sito:				Permite insertar y modificar datos en la tabla tad_proceso_compra
Tabla:					tad_tad_proceso_compra
Par�metros:				$id_proceso_compra
						$observaciones
						$codigo_proceso
						$fecha_reg
						$estado_vigente
						$id_tipo_categoria_adq
						$id_moneda
						$num_cotizacion
						$num_proceso
						$siguiente_estado
						$periodo
						$gestion
						$num_cotizacion_sis
						$num_proceso_sis

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-05-13 18:03:05
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloAdquisiciones.php");

$Custom = new cls_CustomDBAdquisiciones();
$nombre_archivo = "ActionGuardarProcesoCompra.php";

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
			$id_proceso_compra= $_GET["id_proceso_compra_$j"];
			$observaciones= $_GET["observaciones_$j"];
			$codigo_proceso= $_GET["codigo_proceso_$j"];
			$fecha_reg= $_GET["fecha_reg_$j"];
			$estado_vigente= $_GET["estado_vigente_$j"];
			$id_tipo_categoria_adq= $_GET["id_tipo_categoria_adq_$j"];
			$id_moneda= $_GET["id_moneda_$j"];
			$num_cotizacion= $_GET["num_cotizacion_$j"];
			$num_proceso= $_GET["num_proceso_$j"];
			$siguiente_estado= $_GET["siguiente_estado_$j"];
			$periodo= $_GET["periodo_$j"];
			$gestion= $_GET["gestion_$j"];
			$num_cotizacion_sis= $_GET["num_cotizacion_sis_$j"];
			$num_proceso_sis= $_GET["num_proceso_sis_$j"];
			$fecha_proc= $_GET["fecha_proc_$j"];
			$id_tipo_adq = $_GET["id_tipo_adq_$j"];
			$lugar_entrega= $_GET["lugar_entrega_$j"];
			$id_parametro_adquisicion = $_GET["id_parametro_adquisicion_$j"];
			$norma = $_GET["norma_$j"];
			$pago_variable = $_GET["pago_variable_$j"];
			$id_depto=$_GET["id_depto_$j"];//adicionado 26sep11: debido a que un usuario podr� pertenecer a varios deptos de compro
		}
		else
		{
			$id_proceso_compra=$_POST["id_proceso_compra_$j"];
			$observaciones=$_POST["observaciones_$j"];
			$codigo_proceso=$_POST["codigo_proceso_$j"];
			$fecha_reg=$_POST["fecha_reg_$j"];
			$estado_vigente=$_POST["estado_vigente_$j"];
			$id_tipo_categoria_adq=$_POST["id_tipo_categoria_adq_$j"];
			$id_moneda=$_POST["id_moneda_$j"];
			$num_cotizacion=$_POST["num_cotizacion_$j"];
			$num_proceso=$_POST["num_proceso_$j"];
			$siguiente_estado=$_POST["siguiente_estado_$j"];
			$periodo=$_POST["periodo_$j"];
			$gestion=$_POST["gestion_$j"];
			$num_cotizacion_sis=$_POST["num_cotizacion_sis_$j"];
			$num_proceso_sis=$_POST["num_proceso_sis_$j"];
			$fecha_proc=$_POST["fecha_proc_$j"];
			$id_tipo_adq=$_POST["id_tipo_adq_$j"];
			$lugar_entrega = $_POST["lugar_entrega_$j"];
			$id_parametro_adquisicion = $_POST["id_parametro_adquisicion_$j"];
			$norma = $_POST["norma_$j"];
			$pago_variable = $_POST["pago_variable_$j"];
$id_depto=$_POST["id_depto_$j"]; //adicionado 26sep11: debido a que un usuario podr� pertenecer a varios deptos de compro
		}

		if ($id_proceso_compra == "undefined" || $id_proceso_compra == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarProcesoCompra("insert",$id_proceso_compra, $observaciones,$codigo_proceso,$fecha_reg,$estado_vigente,$id_tipo_categoria_adq,$id_moneda,$num_cotizacion,$num_proceso,$siguiente_estado,$periodo,$gestion,$num_cotizacion_sis,$num_proceso_sis);

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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tad_proceso_compra
			//adicionado 26sep11: en el lugar donde se enviaba id_tipo_Categoria_adq se enviar� id_depto debido a que un usuario podr� pertenecer a varios deptos de compro
			$res = $Custom -> InsertarProcesoCompraMul($id_proceso_compra, $observaciones, $codigo_proceso, $fecha_reg, $estado_vigente, $id_depto, $id_moneda, $num_cotizacion, $num_proceso, $siguiente_estado, $periodo, $gestion, $num_cotizacion_sis, $num_proceso_sis,$fecha_proc,$id_tipo_adq,$lugar_entrega,$id_parametro_adquisicion,$norma,$pago_variable);

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
			$res = $Custom->ValidarProcesoCompra("update",$id_proceso_compra, $observaciones, $codigo_proceso, $fecha_reg, $estado_vigente, $id_tipo_categoria_adq, $id_moneda, $num_cotizacion, $num_proceso, $siguiente_estado, $periodo, $gestion, $num_cotizacion_sis, $num_proceso_sis);

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

			$res = $Custom->ModificarProcesoCompraMul($id_proceso_compra,$observaciones,$codigo_proceso,$fecha_reg,$estado_vigente,$id_depto,$id_moneda,$num_cotizacion,$num_proceso,$siguiente_estado,$periodo,$gestion,$num_cotizacion_sis,$num_proceso_sis,$fecha_proc,$id_tipo_adq,$lugar_entrega,$id_parametro_adquisicion,$norma,$pago_variable);

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
	if($sortcol == "") $sortcol = "id_proceso_compra";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarProcesoCompra($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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