<?php

session_start();
/*include_once("../../../lib/funciones.inc.php");
$Funciones=new funciones();
$filtro1=$Funciones->eliminarespeciales($_GET["filtro1"]);
$filtro2=$Funciones->eliminarespeciales($_GET["filtro2"]);
$filtro3=$Funciones->eliminarespeciales($_GET["filtro3"]);
$titulo=$_GET["titulo"];
$valor=$_GET["valor"];*/

 
$nombre_archivo = 'ActionSaldosBancariosPeriodo.php';

if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']="NO";
}
if($_SESSION['autentificado']=="SI")
{
	$cant = 100000;
	$puntero = 0;
	$sortcol = 'nro_cuenta';
	$sortdir = 'asc';
	
	
			
				$_SESSION['start']=utf8_decode($_GET['start']);
				$_SESSION['limit']=utf8_decode($_GET['limit']);
				$_SESSION['CantFiltros']=utf8_decode($_GET['CantFiltros']);
				$_SESSION['nivel']=utf8_decode($_GET['nivel']);
				
				$_SESSION['sw_actualizacion']=utf8_decode($_GET['sw_actualizacion']);
				
				$_SESSION['id_parametro']=utf8_decode($_GET['id_parametro']);
				$_SESSION['ids_ctaban']=utf8_decode($_GET['ids_ctaban']);
				$_SESSION['id_moneda']=utf8_decode($_GET['id_moneda']);
				$_SESSION['id_reporte_eeff']=utf8_decode($_GET['id_reporte_eeff']);
				$_SESSION['fecha_trans']=utf8_decode($_GET['fecha_trans']);
				$_SESSION['fecha_trans_ini']=utf8_decode($_GET['fecha_trans_ini']);
				
				
				$_SESSION['EEFF']=utf8_decode($_GET['EEFF']);
				$_SESSION['ids_periodo']=utf8_decode($_GET['ids_periodo']);
				
				$_SESSION['ids_fuente_financiamiento']=utf8_decode($_GET['ids_fuente_financiamiento']);
				$_SESSION['ids_u_o']=utf8_decode($_GET['ids_u_o']);
				$_SESSION['ids_financiador']=utf8_decode($_GET['ids_financiador']);
				$_SESSION['ids_regional']=utf8_decode($_GET['ids_regional']);
				$_SESSION['ids_programa']=utf8_decode($_GET['ids_programa']);
				$_SESSION['ids_proyecto']=utf8_decode($_GET['ids_proyecto']);
				$_SESSION['ids_actividad']=utf8_decode($_GET['ids_actividad']);
				$_SESSION['sw_vista']=utf8_decode($_GET['sw_vista']);
				$_SESSION['ids_concepto_colectivo']=utf8_decode($_GET['ids_concepto_colectivo']);
				$_SESSION['regional']=utf8_decode($_GET['regional']);
				$_SESSION['financiador']=utf8_decode($_GET['financiador']);
				$_SESSION['programa']=utf8_decode($_GET['programa']);
				$_SESSION['proyecto']=utf8_decode($_GET['proyecto']);
				$_SESSION['actividad']=utf8_decode($_GET['actividad']);
				$_SESSION['unidad_organizacional']=utf8_decode($_GET['unidad_organizacional']);
				$_SESSION['Fuente_financiamiento']=utf8_decode($_GET['Fuente_financiamiento']);
				$_SESSION['colectivo']=utf8_decode($_GET['colectivo']);
				$_SESSION['desc_moneda']=utf8_decode($_GET['desc_moneda']);
				$_SESSION['desc_estado_gral']=utf8_decode($_GET['desc_estado_gral']);
				$_SESSION['gestion']=utf8_decode($_GET['gestion']);
				$_SESSION['Cta_Bancaria']=utf8_decode($_GET['Cta_Bancaria']);
				
				$_SESSION['fecha_reporte']=$_GET['fecha_rep'];
				$_SESSION['fecha_reporte_ini']=$_GET['fecha_rep_ini'];
				 
			 
				/*echo $_GET['fecha_rep'];
 exit;
 			*/
	 
 			

		//echo( 'tipo_pres'.$_SESSION['tipo_pres'].'id_parametro'.$_SESSION['id_parametro'].'id_moneda'.$_SESSION['id_moneda'].'ids_fuente_financiamiento'.$_SESSION['ids_fuente_financiamiento'].'ids_u_o'.$_SESSION['ids_u_o'].'ids_financiador'.$_SESSION['ids_financiador'].'ids_regional'.$_SESSION['ids_regional'].'ids_programa'.$_SESSION['ids_programa'].'ids_proyecto'.$_SESSION['ids_proyecto'].'ids_actividad'.$_SESSION['ids_actividad'].'sw_vista'.$_SESSION['sw_vista'].'epe'.$_SESSION['epe']);
		//	exit()		;	 
			
//echo "rep_gestion".$txt_gestion."rep_periodo".$txt_periodo."id_param".$hidden_id_param."sw_global".$txt_sw_global."municipio_ini".$txt_cod_municipio_origen."municipio_fin".$txt_cod_municipio_destino."ruta_ini".$txt_cod_ruta_origen."ruta_fin".$txt_cod_ruta_destino."municipio".$txt_municipio."nombre numicipio".$txt_nombre_municipio;
			header("location:PDFSaldosBancariosPeriodo.php");
		
				
	
}
else
{
	$resp = new cls_manejo_mensajes(true, "401");
	$resp->mensaje_error = 'MENSAJE ERROR = Usuario no Autentificado';
	$resp->origen = "ORIGEN = $nombre_archivo";
	$resp->proc = "PROC = $nombre_archivo";
	$resp->nivel = 'NIVEL = 3';
	echo $resp->get_mensaje();
	exit;

}?>