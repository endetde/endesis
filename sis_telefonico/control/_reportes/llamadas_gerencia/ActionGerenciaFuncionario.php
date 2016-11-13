<?php
/**
 * Nombre del archivo:	ActionObtenerTipoCambio.php
 * Prop�sito:			Devolver el tipo de cambio de una moneda en funci�n de otra en una fecha espec�fica
 * Par�metros:			$fecha, $id_moneda1, $id_moneda2, $tipo
 * Valores de Retorno:	Tipo de cambio (n�mero)
 * Autor:				Rodrigo Chumacero Moscoso
 * Fecha creaci�n:		28-06-2007
 */
session_start();
include_once("../../LibModeloSistemaTelefonico.php");
$nombre_archivo='ActionGerenciaFuncionario.php';
$Custom=new cls_CustomDBSistemaTelefonico();
if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']="NO";
}
if($_SESSION['autentificado']=="SI")
{
	if($limit == '') $cant = 15;
	else $cant = $limit;

	if($start == '') $puntero = 0;
	else $puntero = $start;

	if($sort == '') $sortcol = 'id_empleado';
	else $sortcol = $sort;

	if($dir == '') $sortdir = 'asc';
	else $sortdir = $dir;
	$cond = new cls_criterio_filtro($decodificar);
	for($i=0;$i<$CantFiltros;$i++)
	{
		$cond->add_condicion_filtro($_POST["filterCol_$i"], $_POST["filterValue_$i"], $_POST["filterAvanzado_$i"]);
	}
	$id_emp=$_SESSION["ss_id_empleado"];
	if($id_emp===""){
		$id_emp='null';
	}
	
	$cond->add_criterio_extra("e.id_empleado",$id_emp);

	$criterio_filtro = $cond -> obtener_criterio_filtro();
	//Obtiene el criterio de orden de columnas
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'GerenUsu');
	$sortcol = $crit_sort->get_criterio_sort();
	//Obtiene el conjunto de datos de la consulta
	$res=$Custom->GerenciaEmpleado($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
	if ($res){
		$cont_aux=0;
		foreach ($Custom->salida as $f){
		    $cont_aux=$cont_aux+1;
		   	echo "{id_empleado:".$f["id_empleado"].",nombre_completo:'".$f["nombre_completo"]."',rol:".$f["rol"]."}";
			
		}
		if($cont_aux==0){
		echo "{id_empleado:0,nombre_completo:'null',rol:'null'}";	
		}
	}
	else
	{
		//Se produjo un error
		$resp = new cls_manejo_mensajes(true,'406');
		$resp->mensaje_error = $Custom->salida[1];
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
	$resp = new cls_manejo_mensajes(true, "401");
	$resp->mensaje_error = "MENSAJE ERROR = Usuario no Autentificado";
	$resp->origen = "ORIGEN = $nombre_archivo";
	$resp->proc = "PROC = $nombre_archivo";
	$resp->nivel = "NIVEL = 1";
	echo $resp->get_mensaje();
	exit;
}
?>