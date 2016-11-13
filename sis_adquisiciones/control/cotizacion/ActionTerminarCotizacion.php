<?php
/**
**********************************************************
Nombre de archivo:	    ActionTerminarCotizacion.php
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
						$num_cotizacion_sis

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-05-28 16:58:42
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloAdquisiciones.php");

$Custom = new cls_CustomDBAdquisiciones();
$nombre_archivo = "ActionTerminarCotizacion.php";

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

		
		if ($id_cotizacion!= "undefined" && $id_cotizacion!= "")
		{  
			if($fin>0){
				$res = $Custom->FinalizarCotizacion($id_cotizacion);
	           		if(!$res){
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
				
			}else{
			   if($anular>0){
		          $res = $Custom->AnularCotizacion($id_cotizacion);
		        	if(!$res){
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
		    	}else{
		        	$retencion=$_SESSION["ss_retencion"];
		    		$res = $Custom->TerminarCotizacion($id_cotizacion,$retencion);
	           		if(!$res){
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
			}
		
		}

	//}//END FOR

	//Guarda el mensaje de �xito de la operaci�n realizada
	if($cont > 1) $mensaje_exito = "Se guardaron todos los datos.";
	else $mensaje_exito = $Custom->salida[0];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "id_cotizacion";
	if($sortdir == "") $sortdir = "asc";
	
	
	if($criterio_filtro == "") $criterio_filtro = " COTIZA.id_cotizacion=''$id_cotizacion''";

	$res = $Custom->ContarCotizacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
	
	if($res) $total_registros = $Custom->salida[0];

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