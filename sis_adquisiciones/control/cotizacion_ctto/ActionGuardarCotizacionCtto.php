<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarCotizacion.php
Prop�sito:				Permite insertar y modificar datos en la tabla tad_cotizacion
Tabla:					tad_tad_cotizacion
Par�metros:				$id_cotizacion
						$fecha_venc
						$fecha_reg
						$estado_cotizacion
						$impuestos
						$garantia
						$lugar_entrega
						$forma_pago
						$fecha_validez_oferta
						$fecha_entrega
						$fecha_limite
						$tipo_entrega
						$observaciones
						$id_proceso_compra
						$id_moneda
						$id_proveedor
						$id_tipo_categoria_adq
						$precio_total
						$figura_acta
						$num_factura
						$num_orden_compra
						$estado_vigente
						$estado_reg
						$nombre_pago
						$siguiente_estado
						$periodo
						$gestion
						$num_orden_compra_sis
						$num_cotizacion

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-05-28 16:58:42
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloAdquisiciones.php");

$Custom = new cls_CustomDBAdquisiciones();
$nombre_archivo = "ActionGuardarCotizacionCtto.php";

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
			$id_cotizacion_ctto= $_GET["id_cotizacion_ctto_$j"];
			$id_cotizacion= $_GET["id_cotizacion_$j"];
			$antecedentes= $_GET["antecedentes_$j"];
			$controversias= $_GET["controversias_$j"];
			$doc_integrantes= $_GET["doc_integrantes_$j"];
			$fecha_ctto= $_GET["fecha_ctto_$j"];
			$garantias= $_GET["garantias_$j"];
			$legislacion= $_GET["legislacion_$j"];
			$multas= $_GET["multas_$j"];
			$nro_contrato= $_GET["nro_contrato_$j"];
			$obligaciones= $_GET["obligaciones_$j"];
			$controversias= $_GET["controversias_$j"];
			$partes= $_GET["partes_$j"];
			$usuario_reg= $_GET["usuario_reg_$j"];
			$vigencia= $_GET["vigencia_$j"];
			$fecha_reg= $_GET["fecha_reg_$j"];
		}
		else
		{
			$id_cotizacion_ctto= $_POST["id_cotizacion_ctto_$j"];
			$id_cotizacion= $_POST["id_cotizacion_$j"];
			$antecedentes= $_POST["antecedentes_$j"];
			$controversias= $_POST["controversias_$j"];
			$doc_integrantes= $_POST["doc_integrantes_$j"];
			$fecha_ctto= $_POST["fecha_ctto_$j"];
			$garantias= $_POST["garantias_$j"];
			$legislacion= $_POST["legislacion_$j"];
			$multas= $_POST["multas_$j"];
			$nro_contrato= $_POST["nro_contrato_$j"];
			$obligaciones= $_POST["obligaciones_$j"];
			$controversias= $_POST["controversias_$j"];
			$partes= $_POST["partes_$j"];
			$usuario_reg= $_POST["usuario_reg_$j"];
			$vigencia= $_POST["vigencia_$j"];
			$fecha_reg= $_POST["fecha_reg_$j"];
		}
		
		
		

		if ($id_cotizacion_ctto == "undefined" || $id_cotizacion_ctto == "")
		{
						//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tad_cotizacion
			$res = $Custom -> InsertarCotizacionCtto($id_cotizacion_ctto, $id_cotizacion,$antecedentes,$controversias, $doc_integrantes, $fecha_ctto, $garantias, $legislacion, $multas, $nro_contrato, $obligaciones,$controversias,
		   $partes,$vigencia );

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
		    
		    
		   
					$res = $Custom->ModificarCotizacionCtto($id_cotizacion_ctto, $id_cotizacion,$antecedentes,$controversias, $doc_integrantes, $fecha_ctto, $garantias, $legislacion, $multas, $nro_contrato, $obligaciones,$controversias,
		$partes,$vigencia);
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
	if($sortcol == "") $sortcol = "id_cotizacion_ctto";
	if($sortdir == "") $sortdir = "asc";
	
   if($criterio_filtro == "") $criterio_filtro = "COT.id_cotizacion=''$id_cotizacion''";
	

	$res = $Custom->ContarCotizacionCtto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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