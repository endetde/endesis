<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarSolicitudCompra.php
Prop�sito:				Permite insertar y modificar datos en la tabla tad_solicitud_compra
Tabla:					tad_tad_solicitud_compra
Par�metros:				$hidden_id_solicitud_compra
						$txt_precio_total
						$txt_observaciones
						$txt_fecha_venc
						$txt_fecha_reg
						$txt_hora_reg
						$txt_localidad
						$txt_num_solicitud
						$txt_estado_reg
						$txt_estado_vigente_solicitud
						$txt_tipo_adjudicacion
						$txt_modalidad
						$txt_id_solicitud_compra_ant
						$txt_id_tipo_categoria_adq
						$txt_id_empleado_frppa_solicitante
						$txt_id_moneda
						$txt_id_rpa
						$txt_id_empleado_frppa_transcriptor
						
						$txt_id_unidad_organizacional
						$txt_id_empleado_frppa_pre_aprobacion
						$txt_id_empleado_frppa_aprobacion
						$txt_id_empleado_frppa_gfa
						$txt_id_estado_compra_categoria_adq
						$txt_codigo_sicoes
						$txt_siguiente_estado
						$txt_periodo
						$txt_gestion
						$txt_num_solicitud_sis
						$txt_id_fina_regi_prog_proy_acti

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-05-12 10:00:30
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloAdquisiciones.php");

$Custom = new cls_CustomDBAdquisiciones();
$nombre_archivo = "ActionGuardarSolicitudCompra.php";

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
			$hidden_id_solicitud_compra= $_GET["hidden_id_solicitud_compra_$j"];
			$txt_precio_total= $_GET["txt_precio_total_$j"];
			$txt_observaciones= $_GET["txt_observaciones_$j"];
			$txt_fecha_venc= $_GET["txt_fecha_venc_$j"];
			$txt_fecha_reg= $_GET["txt_fecha_reg_$j"];
			$txt_hora_reg= $_GET["txt_hora_reg_$j"];
			$txt_localidad= $_GET["txt_localidad_$j"];
			$txt_num_solicitud= $_GET["txt_num_solicitud_$j"];
			$txt_estado_reg= $_GET["txt_estado_reg_$j"];
			$txt_estado_vigente_solicitud= $_GET["txt_estado_vigente_solicitud_$j"];
			$txt_tipo_adjudicacion= $_GET["txt_tipo_adjudicacion_$j"];
			$txt_modalidad= $_GET["txt_modalidad_$j"];
			$txt_id_solicitud_compra_ant= $_GET["txt_id_solicitud_compra_ant_$j"];
			$txt_id_tipo_categoria_adq= $_GET["txt_id_tipo_categoria_adq_$j"];
			//$txt_id_empleado_frppa_solicitante= $_GET["id_empleado_frppa_solicitante_$j"];
			$txt_id_empleado_frppa_solicitante= $_GET["id_emp_$j"];
			$txt_id_moneda= $_GET["txt_id_moneda_$j"];
			$txt_id_rpa= $_GET["txt_id_rpa_$j"];
			$txt_id_empleado_frppa_transcriptor= $_GET["txt_id_usuario_transcriptor_$j"];
			$txt_id_unidad_organizacional= $_GET["txt_id_unidad_organizacional_$j"];
			$txt_id_empleado_frppa_pre_aprobacion= $_GET["txt_id_empleado_frppa_pre_aprobacion_$j"];
			$txt_id_empleado_frppa_aprobacion= $_GET["txt_id_empleado_frppa_aprobacion_$j"];
			$txt_id_empleado_frppa_gfa= $_GET["txt_id_empleado_frppa_gfa_$j"];
			$txt_codigo_sicoes= $_GET["txt_codigo_sicoes_$j"];
			$txt_siguiente_estado= $_GET["txt_siguiente_estado_$j"];
			$txt_periodo= $_GET["txt_periodo_$j"];
			$txt_gestion= $_GET["txt_gestion_$j"];
			$txt_num_solicitud_sis= $_GET["txt_num_solicitud_sis_$j"];
			$txt_id_frppa= $_GET["txt_id_frppa_$j"];
			$txt_id_tipo_adq= $_GET["txt_id_tipo_adq_$j"];
			$txt_id_fin=$_GET["txt_id_financiador_$j"];
			$txt_id_reg=$_GET["txt_id_regional_$j"];
			$txt_id_prog=$_GET["txt_id_programa_$j"];
			$txt_id_proy=$_GET["txt_id_proyecto_$j"];
			$txt_id_act=$_GET["txt_id_actividad_$j"];
			$txt_id_empresa=$_GET["id_empresa_$j"];
			
			$txt_id_orden_trabajo=$_GET["id_orden_trabajo_$j"];
			$txt_id_almacen_logico=$_GET["id_almacen_logico_$j"];
			$txt_modificacion=$_GET["es_modificacion_$j"];
			$txt_id_uo_gerencia=$_GET["id_uo_gerencia_$j"];
			$txt_id_depto=$_GET["id_depto_$j"];
			$txt_proveedores_propuestos=$_GET["proveedores_propuestos_$j"];
			$txt_comite_calificacion=$_GET["comite_calificacion_$j"];
			$txt_comite_recepcion=$_GET["comite_recepcion_$j"];
			$txt_avance=$_GET["avance_$j"];
			$txt_tipo_presu=$_GET["tipo_presu_$j"];
			
		}
		else
		{
			$hidden_id_solicitud_compra=$_POST["hidden_id_solicitud_compra_$j"];
			$txt_precio_total=$_POST["txt_precio_total_$j"];
			$txt_observaciones=$_POST["txt_observaciones_$j"];
			$txt_fecha_venc=$_POST["txt_fecha_venc_$j"];
			$txt_fecha_reg=$_POST["txt_fecha_reg_$j"];
			$txt_hora_reg=$_POST["txt_hora_reg_$j"];
			$txt_localidad=$_POST["txt_localidad_$j"];
			$txt_num_solicitud=$_POST["txt_num_solicitud_$j"];
			$txt_estado_reg=$_POST["txt_estado_reg_$j"];
			$txt_estado_vigente_solicitud=$_POST["txt_estado_vigente_solicitud_$j"];
			$txt_tipo_adjudicacion=$_POST["txt_tipo_adjudicacion_$j"];
			$txt_modalidad=$_POST["txt_modalidad_$j"];
			$txt_id_solicitud_compra_ant=$_POST["txt_id_solicitud_compra_ant_$j"];
			$txt_id_tipo_categoria_adq=$_POST["txt_id_tipo_categoria_adq_$j"];
			//$txt_id_empleado_frppa_solicitante=$_POST["id_empleado_frppa_solicitante_$j"];
			$txt_id_empleado_frppa_solicitante= $_POST["id_emp_$j"];
			$txt_id_moneda=$_POST["txt_id_moneda_$j"];
			$txt_id_rpa=$_POST["txt_id_rpa_$j"];
			$txt_id_empleado_frppa_transcriptor=$_POST["txt_id_usuario_transcriptor_$j"];
			$txt_id_unidad_organizacional=$_POST["txt_id_unidad_organizacional_$j"];
			$txt_id_empleado_frppa_pre_aprobacion=$_POST["txt_id_empleado_frppa_pre_aprobacion_$j"];
			$txt_id_empleado_frppa_aprobacion=$_POST["txt_id_empleado_frppa_aprobacion_$j"];
			$txt_id_empleado_frppa_gfa=$_POST["txt_id_empleado_frppa_gfa_$j"];
			
			$txt_codigo_sicoes=$_POST["txt_codigo_sicoes_$j"];
			$txt_siguiente_estado=$_POST["txt_siguiente_estado_$j"];
			$txt_periodo=$_POST["txt_periodo_$j"];
			$txt_gestion=$_POST["txt_gestion_$j"];
			$txt_num_solicitud_sis=$_POST["txt_num_solicitud_sis_$j"];
			$txt_id_frppa=$_POST["txt_id_frppa_$j"];
			$txt_id_tipo_adq= $_POST["txt_id_tipo_adq_$j"];
			$txt_id_fin=$_POST["txt_id_financiador_$j"];
			$txt_id_reg=$_POST["txt_id_regional_$j"];
			$txt_id_prog=$_POST["txt_id_programa_$j"];
			$txt_id_proy=$_POST["txt_id_proyecto_$j"];
			$txt_id_act=$_POST["txt_id_actividad_$j"];
			$txt_id_empresa=$_POST["id_empresa_$j"];			
			
			$txt_id_orden_trabajo=$_POST["id_orden_trabajo_$j"];
			$txt_id_almacen_logico=$_POST["id_almacen_logico_$j"];
			$txt_modificacion=$_POST["es_modificacion_$j"];
			$txt_id_uo_gerencia=$_POST["id_uo_gerencia_$j"];
			$txt_id_depto=$_POST["id_depto_$j"];
			$txt_proveedores_propuestos=$_POST["proveedores_propuestos_$j"];
			$txt_comite_calificacion=$_POST["comite_calificacion_$j"];
			$txt_comite_recepcion=$_POST["comite_recepcion_$j"];
			$txt_avance=$_POST["avance_$j"];
			$txt_tipo_presu=$_POST["tipo_presu_$j"];
		}
		
	
        $txt_id_empresa=$_SESSION["ss_id_empresa"];
		/*if($txt_id_empresa =='undefined'){
			$txt_id_empresa='NULL';
		}*/
		//echo 'aaa'.$txt_gestion; exit;
		if ($hidden_id_solicitud_compra == "undefined" || $hidden_id_solicitud_compra == "")
		{
			////////////////////Inserci�n/////////////////////
			$txt_hora_reg=date("H:i:s");
			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarSolicitudCompra("insert",$hidden_id_solicitud_compra, $txt_precio_total,$txt_observaciones,$txt_fecha_venc,$txt_fecha_reg,$txt_hora_reg,$txt_localidad,$txt_num_solicitud,$txt_estado_reg,$txt_estado_vigente_solicitud,$txt_tipo_adjudicacion,$txt_modalidad,$txt_id_solicitud_compra_ant,$txt_id_tipo_categoria_adq,$txt_id_empleado_frppa_solicitante,$txt_id_moneda,$txt_id_rpa,$txt_id_empleado_frppa_transcriptor,$txt_id_unidad_organizacional,$txt_id_empleado_frppa_pre_aprobacion,$txt_id_empleado_frppa_aprobacion,$txt_id_empleado_frppa_gfa,$txt_codigo_sicoes,$txt_siguiente_estado,$txt_periodo,$txt_gestion,$txt_num_solicitud_sis,$txt_id_frppa);

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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tad_solicitud_compra
			$res = $Custom -> InsertarSolicitudCompra($hidden_id_solicitud_compra, $txt_precio_total, $txt_observaciones, $txt_fecha_venc, $txt_fecha_reg, $txt_hora_reg, $txt_localidad, $txt_num_solicitud, $txt_estado_reg, $txt_estado_vigente_solicitud, $txt_tipo_adjudicacion, $txt_modalidad, $txt_id_solicitud_compra_ant, $txt_id_tipo_categoria_adq, $txt_id_empleado_frppa_solicitante, $txt_id_moneda, $txt_id_rpa, $txt_id_empleado_frppa_transcriptor,  $txt_id_unidad_organizacional, $txt_id_empleado_frppa_pre_aprobacion, $txt_id_empleado_frppa_aprobacion, $txt_id_empleado_frppa_gfa, $txt_codigo_sicoes, $txt_siguiente_estado, $txt_periodo, $txt_gestion, $txt_num_solicitud_sis, $txt_id_frppa,$txt_id_tipo_adq,$txt_id_fin,$txt_id_reg,$txt_id_prog,$txt_id_proy,$txt_id_act,$txt_id_empresa,$txt_id_orden_trabajo,$txt_id_almacen_logico,$txt_id_uo_gerencia,$txt_id_depto,$txt_proveedores_propuestos,$txt_comite_calificacion,$txt_comite_recepcion,$txt_avance,$txt_tipo_presu);
			//

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
			
			
			if($txt_id_rpa>0 && $txt_modificacion==''){
				
				$res = $Custom->ModificarSolicitudCompraRPA($hidden_id_solicitud_compra, $txt_id_rpa);

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
			}else{
			
			//Validaci�n de datos (del lado del servidor)
				$res = $Custom->ValidarSolicitudCompra("update",$hidden_id_solicitud_compra, $txt_precio_total, $txt_observaciones, $txt_fecha_venc, $txt_fecha_reg, $txt_hora_reg, $txt_localidad, $txt_num_solicitud, $txt_estado_reg, $txt_estado_vigente_solicitud, $txt_tipo_adjudicacion, $txt_modalidad, $txt_id_solicitud_compra_ant, $txt_id_tipo_categoria_adq, $txt_id_empleado_frppa_solicitante, $txt_id_moneda, $txt_id_rpa, $txt_id_empleado_frppa_transcriptor, $txt_id_unidad_organizacional, $txt_id_empleado_frppa_pre_aprobacion, $txt_id_empleado_frppa_aprobacion, $txt_id_empleado_frppa_gfa, $txt_codigo_sicoes, $txt_siguiente_estado, $txt_periodo, $txt_gestion, $txt_num_solicitud_sis, $txt_id_frppa);

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

				$res = $Custom->ModificarSolicitudCompra($hidden_id_solicitud_compra, $txt_precio_total, $txt_observaciones, $txt_fecha_venc, $txt_fecha_reg, $txt_hora_reg, $txt_localidad, $txt_num_solicitud, $txt_estado_reg, $txt_estado_vigente_solicitud, $txt_tipo_adjudicacion, $txt_modalidad, $txt_id_solicitud_compra_ant, $txt_id_tipo_categoria_adq, $txt_id_empleado_frppa_solicitante, $txt_id_moneda, $txt_id_rpa, $txt_id_empleado_frppa_transcriptor, $txt_id_unidad_organizacional, $txt_id_empleado_frppa_pre_aprobacion, $txt_id_empleado_frppa_aprobacion, $txt_id_empleado_frppa_gfa, $txt_codigo_sicoes, $txt_siguiente_estado, $txt_periodo, $txt_gestion, $txt_num_solicitud_sis, $txt_id_frppa,$txt_id_tipo_adq,$txt_id_fin,$txt_id_reg,$txt_id_prog,$txt_id_proy,$txt_id_act,$txt_id_empresa,$txt_id_orden_trabajo,$txt_id_almacen_logico,$txt_id_uo_gerencia,$txt_id_depto,$txt_proveedores_propuestos,$txt_comite_calificacion,$txt_comite_recepcion,$txt_avance, $txt_tipo_presu);
				//
                                                      
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
		}

	}//END FOR

	//Guarda el mensaje de �xito de la operaci�n realizada
	if($cont > 1) $mensaje_exito = "Se guardaron todos los datos.";
	else $mensaje_exito = $Custom->salida[1];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "id_solicitud_compra";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0 AND (SOLADQ.estado_vigente_solicitud =''borrador'' OR (SOLADQ.estado_vigente_solicitud=''pendiente_pre_aprobacion'' AND SOLADQ.id_rpa is null))";

	$id_empresa=$_SESSION["ss_id_empresa"];
	$res = $Custom->ContarSolicitudCompra($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empresa);
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