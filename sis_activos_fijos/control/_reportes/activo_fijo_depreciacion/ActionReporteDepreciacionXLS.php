<?php
/**
 * Nombre:				ActionReporteDepreciacionNuevo.php
 * Descripcion:			Permite la recuperacion de la informacion referente a la depreciacion
 * 						de los activos fijos de la Gestion Actual
 * Autor:				Daniel Sanchez Torrico
 * Fecha creaci�n:		23/11/2012
 *
 */
session_start();
include_once("../../LibModeloActivoFijo.php");

$Custom = new cls_CustomDBActivoFijo();

$nombre_archivo = 'ActionReporteDepreciacionNuevo.php';

if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']='NO';
}
if($_SESSION['autentificado']=='SI')
{
	$cant = 0;
	$puntero = 0;
	$sortdir = '';
	$sortcol = '';
	$criterio_filtro = "";	
		
	
	$fecha_hasta = 	$txt_mes_fin."/01/".$txt_ano_fin;
	$num_dias=date("d",mktime(0,0,0,$txt_mes_fin+1,0,$txt_ano_fin));
		
	//header("location:../../../vista/_reportes/activo_fijo_depreciacion/XLS_ReporteActivoFijoDepreciacion.php?id_grupo_dep=".$m_id_grupo_depreciacion."&fecha_hasta=".$fecha_hasta);
	header("location:../../../vista/_reportes/activo_fijo_depreciacion/XLS_ReporteActivoFijoDepreciacionPHPExcel.php?id_grupo_dep=".$m_id_grupo_depreciacion."&fecha_hasta=".$fecha_hasta.'&m_anio='.$txt_ano_fin.'&m_mes='.$txt_mes_fin.'&num_dias='.$num_dias);

}
else
{
	    header("HTTP/1.0 401 No autorizado");
		header('Content-Type: text/plain; charset=iso-8859-1');
		echo "No tiene los permisos necesarios ";
}
?>