<?php
session_start();
include_once("../LibModeloKardexPersonal.php");
$nombre_archivo='ActionPDFResumenCostos.php';

if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']="NO";
}
if($_SESSION['autentificado']=="SI")
{
		    $Custom = new cls_CustomDBKardexPersonal();
		    $mes=$mes;
			$gestion=$gestion;
			$id_planilla=$m_id_planilla;
			$planilla=$planilla;
			$_SESSION['mes_resumen_costo_centro']=$mes;
			$_SESSION['gestion_resumen_costo_centro']=$gestion;
			$_SESSION['planilla_costo_centro']=$planilla;
			 $cant=10;
			 $puntero=0;
			 $sortcol='desc_presupuesto';
			 $sortdir='asc';
			 $criterio_filtro='0=0';
			 $Custom->ResumenCostosPersonal($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_planilla);
			 //echo $Custom->query; exit();
			 header("location:PDFResumenCostos.php?id_planilla=".$id_planilla); 			
}
else
{
	$resp=new cls_manejo_mensajes(true,"401");
	$resp->mensaje_error='MENSAJE ERROR = Usuario no Autentificado';
	$resp->origen="ORIGEN = $nombre_archivo";
	$resp->proc="PROC = $nombre_archivo";
	$resp->nivel='NIVEL = 3';
	echo $resp->get_mensaje();
	exit;
}?>