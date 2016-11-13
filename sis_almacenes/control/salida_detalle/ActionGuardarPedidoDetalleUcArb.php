<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarPedidoDetalleUcArb.php
Prop�sito:				Permite insertar y modificar datos en la tabla tal_tipo_unidad_constructiva
Tabla:					tal_tal_tipo_unidad_constructiva
Par�metros:				$hidden_id_tipo_unidad_constructiva
						$txt_codigo
						$txt_nombre
						$txt_tipo
						$txt_descripcion
						$txt_observaciones
						$txt_fecha_reg

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2007-11-07 15:46:18
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../rcm_LibModeloAlmacenes.php");

$Custom = new cls_CustomDBAlmacenes();
$nombre_archivo = "ActionGuardarPedidoDetalleUcArb.php";

if (!isset($_SESSION["autentificado"]))
{
	$_SESSION["autentificado"]="NO";
}
if($_SESSION["autentificado"]=="SI")
{

	$decodificado = stripslashes($_REQUEST['datos']);
	$proceso=stripslashes($_REQUEST['proc']);

	$nodo = json_decode($decodificado,true);

	/*print("<pre>");
	print_r($nodo);
	print("</pre>");
	exit;*/


	//Selecci�n de procedimiento a ejecutar en la BD
	if($proc==='del')
	{
		if($nodo['tipo']=='raiz')
		{
			//No considerado por el momento
			$res = $Custom ->EliminarOrdenSalidaUCDetalle($nodo['id_reg']);
			if(!$res)
			{
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1] ;
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				$resp->query = $Custom->query;
				echo $resp->get_mensaje();
				exit;
			}
			$tmp['success'] = 'true';
			$tmp['id_reg'] = $Custom->salida[2];
			echo json_encode($tmp);
			exit;
		}
		elseif($nodo['tipo']=='item')
		{
			$res = $Custom -> EliminarOrdenSalidaUCDetalle($nodo['id_reg']);
			if(!$res)
			{
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1] ;
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				$resp->query = $Custom->query;
				echo $resp->get_mensaje();
				exit;
			}
		}
		else
		{
			$resp = new cls_manejo_mensajes(true, "406");
			$resp->mensaje_error = "MENSAJE ERROR = Tipo desconocido.";
			$resp->origen = "ORIGEN = ";
			$resp->proc = "PROC = ";
			$resp->nivel = "NIVEL = 4";
			echo $resp->get_mensaje();
			exit;
		}

		//Devuelve el mensaje de �xito
		$mensaje_exito = $Custom->salida[1];
		$resp = new cls_manejo_mensajes(false);
		$resp->add_nodo("mensaje",$mensaje_exito);
		$resp->add_nodo("tiempo_resp", "200");
		echo $resp->get_mensaje();
		exit;
	}
	elseif($proc==='add')
	{
		if($nodo['tipo']=='raiz' || $nodo['tipo']=='rama')
		{
			$res = $Custom -> InsertarOrdenSalidaUCDetalle($nodo['id'],$nodo['descripcion'],$nodo['observaciones'],$nodo['id'],$id_salida,"",$nodo['cantidad'],$nodo['repeticion']);
			if(!$res)
			{
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1] ;
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				$resp->query = $Custom->query;
				echo $resp->get_mensaje();
				exit;
			}
			$tmp['success'] = 'true';
			$tmp['id_reg'] = $Custom->salida[2];
			echo json_encode($tmp);
			exit;
		}

		elseif($nodo['tipo']=='item')
		{
			$res = $Custom -> InsertarOrdenSalidaUCDetalleItem($nodo['id'],$nodo['descripcion'],$nodo['observaciones'],"",$id_salida,"",$nodo['cantidad'],$nodo['id']);
			if(!$res)
			{
				$tmp['success'] = 'false';
				echo json_encode($tmp);
				exit;
			}
			$tmp['success'] = 'true';
			$tmp['id_reg'] = $Custom->salida[2];
			echo json_encode($tmp);
			exit;
		}

		//Devuelve el Id del TUC creado
		$tmp['success'] = 'true';
		echo json_encode($tmp);
		exit;

	}
	elseif($proc==='upd')
	{

		if($nodo['tipo']=='raiz')
		{
			$res = $Custom ->ModificarOrdenSalidaUCDetalle($nodo['id_reg'],"","",$nodo['id'],$nodo['cantidad'],$nodo['repeticion']);
			if(!$res)
			{
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1] ;
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				$resp->query = $Custom->query;
				echo $resp->get_mensaje();
				exit;
			}
			$tmp['success'] = 'true';
			$tmp['id_reg'] = $nodo['id_reg'];
			echo json_encode($tmp);
			exit;
		}
		
		elseif($nodo['tipo']=='rama')
		{
			$res = $Custom ->ModificarOrdenSalidaUCDetalleRama($nodo['id_reg'],$nodo['id'],$nodo['cantidad'],$nodo['id_composicion_tuc']);
			if(!$res)
			{
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1] ;
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				$resp->query = $Custom->query;
				echo $resp->get_mensaje();
				exit;
			}
			$tmp['success'] = 'true';
			$tmp['id_reg'] = $nodo['id_reg'];
			echo json_encode($tmp);
			exit;
		}

		elseif($nodo['tipo']=='item')
		{
			$res = $Custom ->ModificarOrdenSalidaUCDetalleItem($nodo['id_reg'],"","",$nodo['cantidad'],$nodo['id']);
			if(!$res)
			{
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1] ;
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				$resp->query = $Custom->query;
				echo $resp->get_mensaje();
				exit;
			}
			$tmp['success'] = 'true';
			$tmp['id_reg'] = $nodo['id_reg'];
			echo json_encode($tmp);
			exit;
		}


	}
	elseif($proc==='dd')
	{
		if($nodo['tipo']=='raiz')
		{
			$res = $Custom ->DragAndDropRaiz($nodo['id'],$nodo['id_pn']);
			if(!$res)
			{
				$tmp['success'] = $Custom->salida[0]=='f' ? 'false':'true';
				echo json_encode($tmp);
				exit;
			}
		}
		elseif($nodo['tipo']=='rama')
		{
			$res = $Custom ->DragAndDropRama($nodo['id'],$nodo['id_p'],$nodo['id_pn']);
			if(!$res)
			{
				$tmp['success'] = $Custom->salida[0]=='f' ? 'false':'true';
				echo json_encode($tmp);
				exit;
			}
		}
		elseif($nodo['tipo']=='item')
		{
			$res = $Custom ->DragAndDropItem($nodo['id'],$nodo['id_p'],$nodo['id_pn']);
			if(!$res)
			{
				$tmp['success'] = $Custom->salida[0]=='f' ? 'false':'true';
				echo json_encode($tmp);
				exit;
			}
		}
		else
		{
			$resp = new cls_manejo_mensajes(true, "406");
			$resp->mensaje_error = "MENSAJE ERROR = Tipo desconocido.";
			$resp->origen = "ORIGEN = ";
			$resp->proc = "PROC = ";
			$resp->nivel = "NIVEL = 4";
			echo $resp->get_mensaje();
			exit;
		}

		//Respuesta de �xito
		$tmp['success'] = $Custom->salida[0]=='t' ? 'true':'false';
		echo json_encode($tmp);
		exit;
	}

	elseif($proc==='reemp')
	{
		if($nodo['tipo']=='rama')
		{
			$res = $Custom ->InsertarDetalleSalidaUC(" ",$nodo['cantidad'],"",$nodo['id_reg'],$nodo['id_tuc'],"",$nodo['id_composicion_tuc'],$nodo['id']);
			if(!$res)
			{
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1] ;
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				$resp->query = $Custom->query;
				echo $resp->get_mensaje();
				exit;
				$tmp['success'] = $Custom->salida[0]=='f' ? 'false':'true';
				echo json_encode($tmp);
				exit;
			}
		}
		elseif($nodo['tipo']=='item')
		{
			$res = $Custom ->DragAndDropItem($nodo['id'],$nodo['id_p'],$nodo['id_pn']);
			if(!$res)
			{
				$tmp['success'] = $Custom->salida[0]=='f' ? 'false':'true';
				echo json_encode($tmp);
				exit;
			}
		}
		else
		{
			$resp = new cls_manejo_mensajes(true, "406");
			$resp->mensaje_error = "MENSAJE ERROR = Tipo desconocido.";
			$resp->origen = "ORIGEN = ";
			$resp->proc = "PROC = ";
			$resp->nivel = "NIVEL = 4";
			echo $resp->get_mensaje();
			exit;
		}

		//Respuesta de �xito
		$tmp['success'] = $Custom->salida[0]=='t' ? 'true':'false';
		echo json_encode($tmp);
		exit;
	}

	elseif($proc==='orig')
	{
		$res = $Custom ->VolverOriginal(" ",$nodo['cantidad'],"",$nodo['id_reg'],$nodo['id_tuc'],"",$nodo['id_composicion_tuc'],$nodo['id']);
		if(!$res)
		{
			$resp = new cls_manejo_mensajes(true, "406");
			$resp->mensaje_error = $Custom->salida[1] ;
			$resp->origen = $Custom->salida[2];
			$resp->proc = $Custom->salida[3];
			$resp->nivel = $Custom->salida[4];
			$resp->query = $Custom->query;
			echo $resp->get_mensaje();
			exit;
			$tmp['success'] = $Custom->salida[0]=='f' ? 'false':'true';
			echo json_encode($tmp);
			exit;
		}
		//Respuesta de �xito
		$tmp['success'] = 'true';
		echo json_encode($tmp);
		exit;
	}

	else
	{
		$resp = new cls_manejo_mensajes(true, "401");
		$resp->mensaje_error = "MENSAJE ERROR = Proceso no identificado";
		$resp->origen = "ORIGEN = $nombre_archivo";
		$resp->proc = "PROC = $nombre_archivo";
		$resp->nivel = "NIVEL = 1";
		echo $resp->get_mensaje();
		exit;
	}


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