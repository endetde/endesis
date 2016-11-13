<?php

session_start();
include_once('../../LibModeloTesoreria.php');
$Custom = new cls_CustomDBTesoreria();

$nombre_archivo = 'ActionPDFRendicionCuentaDoc.php';



if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']="NO";
}
if($_SESSION['autentificado']=="SI")
{
    if($limit == '') $cant = 1500;
	else $cant = $limit;

	if($start == '') $puntero = 0;
	else $puntero = $start;

	if($sort == '') $sortcol = ' ';   /// tengo que   cambiar de acuerdo a la consulta
	else $sortcol = $sort;

	if($dir == '') $sortdir = 'desc';
	else $sortdir = $dir;

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

//Verifica si se manda la cantidad de filtros
	if($CantFiltros=="") $CantFiltros = 0;


//Se obtiene el criterio del filtro con formato sql para mandar a la BD
	$cond = new cls_criterio_filtro($decodificar);
	for($i=0;$i<$CantFiltros;$i++)
	{
		$cond->add_condicion_filtro($_POST["filterCol_$i"], $_POST["filterValue_$i"], $_POST["filterAvanzado_$i"]);
	}

	$criterio_filtro = $cond->obtener_criterio_filtro();
	
	
	//$Proceso = array();
	$CabRendicionCuenta = array();
	$DetRendicionCuenta = array();
	//	if($tipo_vista=="avance"){
	/*echo($id_cuenta_doc);
	exit;*/
	$CabRendicionCuenta= $Custom-> CabeRendicionCuentaDoc($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$id_cuenta_doc);
	//print_r($Custom->salida);
	
	foreach ($Custom->salida as $f)
			{   
			    $_SESSION['PDF_subtitulo']=$f["subtitulo"]; 
			    $_SESSION['PDF_nombre_completo']=$f["nombre_completo"];
                $_SESSION['PDF_nombre_cargo']=$f["nombre_cargo"];				       
                $_SESSION['PDF_nombre_lugar']=$f["nombre_lugar"];
                $_SESSION['PDF_concepto']=$f["concepto"];				       
                $_SESSION['PDF_fecha_ini_rendicion']=$f["fecha_ini_rendicion"];				       
                $_SESSION['PDF_fecha_fin_rendicion']=$f["fecha_fin_rendicion"];		
                $_SESSION['PDF_fecha_avance']=$f["fecha_avance"];		
                $_SESSION['PDF_nro_avance']=$f["nro_avance"];		
                
                 
                $DetRendicionCuenta=$Custom->DetalleRendicionCuentaDoc($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$id_cuenta_doc);
                 //echo $Custom->query; exit();
                $_SESSION['PDF_DetRendicionCuenta']=$Custom->salida;
              }
/*	}else if ($tipo_vista=="viatico"){
		
	$CabRendicionCuenta= $Custom-> CabeRendicionCuentasViaticos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$id_viatico);
	
	foreach ($Custom->salida as $f)
			{   
			    $_SESSION['PDF_subtitulo']="Cuenta Documentada"; 
			    $_SESSION['PDF_nombre_completo']=$f["nombre_completo"];
                $_SESSION['PDF_nombre_cargo']=$f["nombre_cargo"];				       
                $_SESSION['PDF_nombre_lugar']=$f["nombre_lugar"];
                $_SESSION['PDF_concepto_avance']=$f["concepto_avance"];				       
                $_SESSION['PDF_fecha_ini_rendicion']=$f["fecha_ini_rendicion"];				       
                $_SESSION['PDF_fecha_fin_rendicion']=$f["fecha_fin_rendicion"];		
                $_SESSION['PDF_fecha_avance']=$f["fecha_avance"];		
                $_SESSION['PDF_nro_avance']=$f["nro_avance"];		
              }
                     
                $DetRendicionCuenta=$Custom->DetalleRendicionCuentasViaticos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$id_viatico);
                $_SESSION['PDF_DetRendicionCuenta']=$Custom->salida;
    	
	
	}else {
		$CabRendicionCuenta= $Custom-> CabeRendicionCuentasCajas($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$id_caja_regis);
	
	foreach ($Custom->salida as $f)
			{   
			    $_SESSION['PDF_subtitulo']="Fondo Rotatorio"; 
			    $_SESSION['PDF_nombre_completo']=$f["nombre_completo"];
                $_SESSION['PDF_nombre_cargo']=$f["nombre_cargo"];				       
                $_SESSION['PDF_nombre_lugar']=$f["nombre_lugar"];
                $_SESSION['PDF_concepto_avance']=$f["concepto_avance"];				       
                $_SESSION['PDF_fecha_ini_rendicion']=$f["fecha_ini_rendicion"];				       
                $_SESSION['PDF_fecha_fin_rendicion']=$f["fecha_fin_rendicion"];		
                $_SESSION['PDF_fecha_avance']=$f["fecha_avance"];		
                $_SESSION['PDF_nro_avance']=$f["nro_rendicion"];		
                }
                     
               $DetRendicionCuenta=$Custom->DetalleRendicionCuentasCajas($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$id_caja_regis);
                $_SESSION['PDF_DetRendicionCuenta']=$Custom->salida;
    	

	}*/
	
 if(count($Custom->salida)!=0){
		   header("location: ../../../vista/solicitud_viaticos2/PDFRendicionCuentaDoc.php");
	}else{
		echo"No retorna ning�n valor de la base de datos consulte con el Administrador";
	}


	}
else
	{
		header("HTTP/1.0 401 No autorizado");
		header('Content-Type: text/plain; charset=iso-8859-1');
		echo "No tiene los permisos necesarios ";
	}

?>