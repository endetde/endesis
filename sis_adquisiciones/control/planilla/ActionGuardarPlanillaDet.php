<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarPlanillaDet.php
Prop�sito:				Permite insertar y modificar datos en la tabla tad_planilla
Tabla:					tad_planilla
Par�metros:				$id_planilla
						
Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-05-28 17:32:19
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloAdquisiciones.php");

$Custom = new cls_CustomDBAdquisiciones();
$nombre_archivo = "ActionGuardarPlanillaDet.php";

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
			
			$id_cotizacion= $_GET["id_cotizacion_$j"];
			$nro_cuota= $_GET["prox_pago_$j"];
			$id_plan_pago= $_GET["id_plan_pago_$j"];
			$tipo_plantilla= $_GET["tipo_plantilla_$j"];
			$fecha_pagado= $_GET["fecha_pagado_$j"];
			$num_factura= $_GET["num_factura_$j"];
			$fecha_factura= $_GET["fecha_factura_$j"];
			$por_anticipo= $_GET["por_anticipo_$j"];
			$por_retgar= $_GET["por_retgar_$j"];
			$multas= $_GET["multas_$j"];
			$obs_descuento= $_GET["obs_descuentos_$j"];
			$monto_no_pagado= $_GET["monto_no_pagado_$j"];
		}
		else
		{
			
			$id_cotizacion= $_POST["id_cotizacion_$j"];
			$nro_cuota= $_POST["prox_pago_$j"];
			$id_plan_pago= $_POST["id_plan_pago_$j"];
			$tipo_plantilla= $_POST["tipo_plantilla_$j"];
			$fecha_pagado= $_POST["fecha_pagado_$j"];
			$num_factura= $_POST["num_factura_$j"];
			$fecha_factura= $_POST["fecha_factura_$j"];
			$por_anticipo= $_POST["por_anticipo_$j"];
			$por_retgar= $_POST["por_retgar_$j"];
			$multas= $_POST["multas_$j"];
			$obs_descuento= $_POST["obs_descuentos_$j"];
			$monto_no_pagado= $_POST["monto_no_pagado_$j"];
		}

				$res = $Custom->InsertarPlanillaDet($m_id_planilla,$id_plan_pago,$tipo_plantilla,$fecha_pagado,$num_factura,$fecha_factura,$por_anticipo,$por_retgar,$multas,$obs_descuento, $monto_no_pagado);
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
	}//END FOR

	//Guarda el mensaje de �xito de la operaci�n realizada
	if($cont > 1) $mensaje_exito = "Se guardaron todos los datos.";
	else $mensaje_exito = $Custom->salida[1];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "id_cotizacion";
	if($sortdir == "") $sortdir = "asc";
	
	
	if($criterio_filtro == "") $criterio_filtro = "0=0";
	$en_planilla=" inner join compro.tad_plan_pago PP on PP.id_cotizacion=c.id_cotizacion
	               inner join sci.tct_plantilla PLANT on PLANT.tipo_plantilla=PLA.tipo_plantilla
                   inner join compro.tad_planilla PLANIL on PLANIL.id_planilla=PP.id_planilla and PLANIL.id_planilla=$m_id_planilla";
	
	$res = $Custom->ContarConsultores($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$en_planilla);
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