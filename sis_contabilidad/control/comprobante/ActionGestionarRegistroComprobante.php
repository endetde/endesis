<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarRegistroComprobante.php
Prop�sito:				Permite insertar y modificar datos en la tabla tct_comprobante
Tabla:					tct_tct_comprobante
Par�metros:				$id_comprobante
						$id_parametro
						$nro_cbte
						$clase_cbte
						$tipo_cbte
						$momento_cbte
						$fecha_cbte
						$concepto_cbte
						$glosa_cbte
						$acreedor
						$aprobacion
						$conformidad
						$pedido
						$id_periodo_subsis
						$id_moneda_reg
						$id_usuario
						$id_subsistema
						$id_documento_nro

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-09-16 17:55:38
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloContabilidad.php");

$Custom = new cls_CustomDBContabilidad();
$nombre_archivo = "ActionGuardarRegistroComprobante.php";

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
			$id_comprobante= $_GET["id_comprobante_$j"];
			$id_parametro= $_GET["id_parametro_$j"];
			$nro_cbte= $_GET["nro_cbte_$j"];
			$momento_cbte= $_GET["momento_cbte_$j"];
			$fecha_cbte= $_GET["fecha_cbte_$j"];
			$concepto_cbte= $_GET["concepto_cbte_$j"];
			$glosa_cbte= $_GET["glosa_cbte_$j"];
			$acreedor= $_GET["acreedor_$j"];
			$aprobacion= $_GET["aprobacion_$j"];
			$conformidad= $_GET["conformidad_$j"];
			$pedido= $_GET["pedido_$j"];
			$id_periodo_subsis= $_GET["id_periodo_subsis_$j"];
			$id_usuario= $_GET["id_usuario_$j"];
			$id_subsistema= $_GET["id_subsistema_$j"];
			$id_clase_cbte=$_GET["id_clase_cbte_$j"];
			$sw_validacion=$_GET["sw_validacion_$j"];
			$id_depto=$_GET["id_depto_$j"];
			$id_moneda_cbte=$_GET["id_moneda_cbte_$j"];
			$tipo_cambio=$_GET["tipo_cambio_$j"];
			$fk_comprobante=$_GET["fk_comprobante_$j"];
			$tipo_relacion=$_GET["tipo_relacion_$j"];
			$sw_activo_fijo=$_GET["sw_activo_fijo_$j"];

		}
		else
		{
			$id_comprobante=$_POST["id_comprobante_$j"];
			$id_parametro=$_POST["id_parametro_$j"];
			$nro_cbte=$_POST["nro_cbte_$j"];
			$momento_cbte=$_POST["momento_cbte_$j"];
			$fecha_cbte=$_POST["fecha_cbte_$j"];
			$concepto_cbte=$_POST["concepto_cbte_$j"];
			$glosa_cbte=$_POST["glosa_cbte_$j"];
			$acreedor=$_POST["acreedor_$j"];
			$aprobacion=$_POST["aprobacion_$j"];
			$conformidad=$_POST["conformidad_$j"];
			$pedido=$_POST["pedido_$j"];
			$id_periodo_subsis=$_POST["id_periodo_subsis_$j"];
			
			$id_usuario=$_POST["id_usuario_$j"];
			$id_subsistema=$_POST["id_subsistema_$j"];
			$id_clase_cbte=$_POST["id_clase_cbte_$j"];
			$sw_validacion=$_POST["sw_validacion_$j"];
			$id_depto=$_POST["id_depto_$j"];
			$id_moneda_cbte=$_POST["id_moneda_cbte_$j"];
			$tipo_cambio=$_POST["tipo_cambio_$j"];
			$fk_comprobante=$_POST["fk_comprobante_$j"];
			$tipo_relacion=$_POST["tipo_relacion_$j"];
			$sw_activo_fijo=$_POST["sw_activo_fijo_$j"];
			
		}

		if ($id_comprobante == "undefined" || $id_comprobante == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			/*$res = $Custom->ValidarRegistroComprobante("insert",$id_comprobante,$id_parametro,$nro_cbte, $momento_cbte,$fecha_cbte,$concepto_cbte,$glosa_cbte,$acreedor,$aprobacion,$conformidad,$pedido,$id_periodo_subsis,$id_usuario,$id_subsistema,$id_clase_cbte,$sw_validacion, $id_depto);

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
			}*/

			
			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tct_comprobante
			$res = $Custom -> InsertarGestionarRegistroComprobante($id_comprobante,$id_parametro,$nro_cbte, $momento_cbte,$fecha_cbte,$concepto_cbte,$glosa_cbte,$acreedor,$aprobacion,$conformidad,$pedido,$id_periodo_subsis,$id_usuario,$id_subsistema,$id_clase_cbte,$sw_validacion,$id_depto,$id_moneda_cbte,$tipo_cambio,$fk_comprobante,$tipo_relacion,$sw_activo_fijo);

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
			
			/*//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarRegistroComprobante("update",$id_comprobante,$id_parametro,$nro_cbte, $momento_cbte,$fecha_cbte,$concepto_cbte,$glosa_cbte,$acreedor,$aprobacion,$conformidad,$pedido,$id_periodo_subsis,$id_usuario,$id_subsistema,$id_clase_cbte,$sw_validacion,$id_depto);

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
			}*/

			$res = $Custom->ModificarGestionarRegistroComprobante($id_comprobante,$id_parametro,$nro_cbte, $momento_cbte,$fecha_cbte,$concepto_cbte,$glosa_cbte,$acreedor,$aprobacion,$conformidad,$pedido,$id_periodo_subsis,$id_usuario,$id_subsistema,$id_clase_cbte,$sw_validacion,$id_depto,$id_moneda_cbte,$tipo_cambio,$fk_comprobante,$tipo_relacion,$sw_activo_fijo);

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
	if($sortcol == "") $sortcol = "id_comprobante";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarRegistroComprobante($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
	//echo($Custom->query); exit();
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