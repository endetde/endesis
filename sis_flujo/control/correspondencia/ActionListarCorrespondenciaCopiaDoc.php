<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarCorrespondencia.php
Prop�sito:				Permite realizar el listado en tfl_correspondencia
Tabla:					tfl_tfl_correspondencia
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2011-02-11 10:52:59
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../LibModeloFlujo.php');
include_once('../../../lib/lib_control/GestionarExcel.php');

$Custom = new cls_CustomDBFlujo();
$nombre_archivo = 'ActionListarCorrespondencia .php';

if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']='NO';
}
if($_SESSION['autentificado']=='SI')
{

	/*
	
	emitida 
			tipo	interna
			vista	enviado
			    
			    
			tipo	externa
			vista	enviado
			
	recibida
	-----------------		
			tipo	externa
			vista	recibido
			
			tipo	externa
			vista	recibido_archivado
	
	
	
	*/
	
	//
	$tipo='externa';
    $vista='todas_externa';
	
	
	//
	
	
	
	//para forzr toda la corrrespondecia externa recibida
	//$vista='externo_derivado';
	
	//para forzar externa emitida
	//$tipo='externa';
    //$vista='enviado';
	
	
	
	
	
//Par�metros del filtro
	if($limit == '') $cant = 15;
	else $cant = $limit;

	if($start == '') $puntero = 0;
	else $puntero = $start;
	
	$puntero =0;
	$cant = 100000;
	
	
	//Flag para limpiar el criterio de Ordenaci�n
	//aayaviri 20-04-2011 11:42
	if($limpiar_ord==1){
		$nombre='correspondencia-'.$vista;
		unset($_SESSION["'$nombre'"]);
		$sortcol = 'id_correspondencia';
		$sortdir = 'desc';
	}
	else{
		if($sort == '') $sortcol = 'id_correspondencia';
		else $sortcol = $sort;
	
		if($dir == '') $sortdir = 'desc';
		else $sortdir = $dir;
	}
	//-----------------------
	//Verifica si se har� o no la decodificaci�n(s�lo pregunta en caso del GET)
	//valores permitidos de $cod -> 'si', 'no'
	
	switch ($cod)
	{
		case 'si':
			$decodificar = true;
			break;
		case 'no':
			$decodificar = false;
			break;
		default:
			$decodificar = true;
			break;
	}

	//Verifica si se manda la cantidad de filtros
	if($CantFiltros=='') $CantFiltros = 0;

	//Se obtiene el criterio del filtro con formato sql para mandar a la BD
	$cond = new cls_criterio_filtro($decodificar);
	for($i=0;$i<$CantFiltros;$i++)
	{  
		if ($reporte_excel=='si')
	    {	
		$cond->add_condicion_filtro($_GET["filterCol_$i"], $_GET["filterValue_$i"], $_GET["filterAvanzado_$i"]);
	    }
	    else{
	    $cond->add_condicion_filtro($_POST["filterCol_$i"], $_POST["filterValue_$i"], $_POST["filterAvanzado_$i"]);	
	    	
	    }
		
	}
	
	$criterio_filtro = $cond -> obtener_criterio_filtro();

	if(isset($id_correspondencia_fk)){
		$criterio_filtro.=" and CORRE.id_correspondencia_fk=$id_correspondencia_fk ";
	}
	
	if($vista=='recibido'){
		$criterio_filtro.=" and CORRE.id_correspondencia_fk is not null ";
		$criterio_filtro.=" and CORRE.estado!=''archivado''";
		if(isset($tipo)){
			$criterio_filtro.=" and CORRE.tipo = ''$tipo''";
		}
	}
	
	if($vista=='todas_externa'){
		$criterio_filtro.=" and CORRE.id_correspondencia_fk is null ";
		$criterio_filtro.=" and CORRE.nivel=0 ";
		
		if(isset($tipo)){
			$criterio_filtro.=" and CORRE.tipo = ''$tipo''";
		}
	}
	
	
	
	
	
	if(($vista=='enviado' || $vista=='administracion') && isset($tipo)){
		if ($tipo=='externa')
			$tipo_env='emitida';
		else 
			$tipo_env='interna';
			
		$criterio_filtro.=" and CORRE.tipo = ''$tipo_env''";
		
	}
	if($vista=='recibido_archivado'){
		$criterio_filtro.=" and CORRE.estado=''archivado''";
	}
	
	if($vista=='externo_recibido'){
		$criterio_filtro.=" and CORRE.id_correspondencia_fk is null and CORRE.estado=''borrador_recibido''";
	}

	if($vista=='detalle_externo')
	{
		$criterio_filtro.=" and CORRE.id_correspondencia_fk is null and (CORRE.estado=''registrado_recibido'' or CORRE.estado=''recibido'')";
		if(isset($id_gestion)){
				$criterio_filtro.=" and CORRE.id_gestion = $id_gestion";
				if(isset($mes)&&isset($gestion)){
					if($mes=='12'){
						$mesNext = '01';
						$gestionNext = $gestion+1;
					}
					else{
						$mesNext = $mes+1;
						if($mesNext<10)
							$mesNext= '0'.$mesNext;
						$gestionNext = $gestion;
					}
					$criterio_filtro.=" and CORRE.fecha_reg>=".$gestion.$mes."01 and CORRE.fecha_reg <".$gestionNext.$mesNext."01";
				}
			}
	}
	
	
	if($vista=='externo_derivado'){
		if(isset($estado) && $estado!='sin_fin'){
			$criterio_filtro.=" and CORRE.id_correspondencia_fk is null and CORRE.estado=''$estado''";
		}
		else if($estado=='sin_fin'){
			$criterio_filtro.=" and CORRE.id_correspondencia_fk is null and CORRE.fecha_fin is null ";
		}
		else{
			$criterio_filtro.=" and CORRE.id_correspondencia_fk is null and CORRE.estado<>''borrador_recibido''";
		}
	}
	
	if($empleado=='si'){
		$criterio_filtro.=" and CORRE.id_empleado is not null ";
	}
	
	if(!isset($vista)){
		if(isset($tipo)){
			$criterio_filtro.=" and CORRE.tipo = ''$tipo''";
		}/*
		if(isset($id_gestion)){
			$criterio_filtro.=" and CORRE.id_gestion = $id_gestion";
			if(isset($mes)&&isset($gestion)){
				if($mes=='12'){
					$mesNext = '01';
					$gestionNext = $gestion+1;
				}
				else{
					$mesNext = $mes+1;
					if($mesNext<10)
						$mesNext= '0'.$mesNext;
					$gestionNext = $gestion;
				}
				$criterio_filtro.=" and CORRE.fecha_origen>=".$gestion.$mes."01 and CORRE.fecha_origen <".$gestionNext.$mesNext."01";
			}
		}*/
	}
	
	

	//Obtiene el criterio de orden de columnas
	if($sortcol=='fecha_reg'){
		$sortcol='CORRE.fecha_reg';
	}
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'correspondencia-'.$vista);
	
	//var_dump($crit_sort);
	$sortcol = $crit_sort->get_criterio_sort();
	
	//MFLORES - GENERAR EXCEL DE GRILLA DE CORRESPONDENCIA EMITIDA
	$titulo_reporte_excel = 'LISTADO DE CORRESPONDENCIA.xls';
	
	if ($reporte_excel=='si')
	{	
		//recupera los valores de las columnas
		for($i=0;$i<$nro_columnas;$i++)
		{
			$datosCabecera['valor'][$i]=$_GET["valor_$i"];
			$datosCabecera['columna'][$i]=$_GET["columna_$i"];
			$datosCabecera['align'][$i]=$_GET["align_$i"];
			$datosCabecera['width'][$i]=$_GET["width_$i"];		
		}
		$i=$i+1;
		$datosCabecera['valor'][$i]='estado';
		$datosCabecera['columna'][$i]='Estado';
		$datosCabecera['align'][$i]='left';
		$datosCabecera['width'][$i]='200';
		
		$i=$i+1;
		$datosCabecera['valor'][$i]='observaciones_estado';
		$datosCabecera['columna'][$i]='Obs. Est.';
		$datosCabecera['align'][$i]='left';
		$datosCabecera['width'][$i]='400';
		
		$i=$i+1;
		$datosCabecera['valor'][$i]='desc_documento';
		$datosCabecera['columna'][$i]='Desc. Doc..';
		$datosCabecera['align'][$i]='left';
		$datosCabecera['width'][$i]='400';
		
		
				
		$Excel = new GestionarExcel();
		$Excel->SetNombreReporte($titulo_reporte_excel);		
		$Excel->SetHoja("Hoja 1 Datos");
		$Excel->SetFila(3);
		$cant=100000000;
		$puntero=0;
		 
		$Excel->SetTitulo($titulo_reporte_excel,0,3,$nro_columnas); //Colocamos el titulo al reporte
		$Excel->SetCabeceraDetalle($datosCabecera);//Colocamos el nombre de las columnas
		
		//echo $criterio_filtro;
		//exit;
								                
		$res = $Custom->ListarCorrespondencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$vista,'excel');
	 
		$Excel->setDetalle($Custom->salida);
		$Excel->setFin();		
	}
	
	else 
	{
		//Obtiene el total de los registros
		$res = $Custom -> ContarCorrespondencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$vista);
	//	var_dump($Custom->query);
	//	exit;
		if($res) $total_registros= $Custom->salida;
			
		//Obtiene el conjunto de datos de la consulta
		$res = $Custom->ListarCorrespondencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad,$vista);
		
		if($res)
		{
			
			 /*copy('/opt/lampp/htdocs/endesis/sis_flujo/control/correspondencia/arch_adjuntos/corres_74899.pdf','/opt/lampp/htdocs/endesis/sis_flujo/control/correspondencia/arch_adjuntos/emitidos/ENDE-GTR-12_14-11.pdf');
								 
								 echo 'copiado '.$f["url_archivo"].' -> '. $nomb.' <br>';*/
								 	
			
			$cont_omitidos=0;
			$cont_existentes=0;
			$cont_copiados=0;
			
			//$ruta_raiz = /opt/lampp/htdocs/endesis/sis_flujo/control/correspondencia/corres/;
			$ruta_raiz = '/pdflapiz/';
	
			foreach ($Custom->salida as $f)
			{
				
				
				
				/*
				emitida 
			tipo	interna
			vista	enviado
			    
			    
			tipo	externa
			vista	enviado
			
	recibida
	-----------------		
			tipo	externa
			vista	recibido
			
			tipo	externa
			vista	recibido_archivado
			
			*/
				$tipo_carpeta ='sin_tipo';
				if($tipo =='interna' && $vista=='enviado'){
					$tipo_carpeta ='interna';
					
				}
				if($tipo =='externa' && $vista=='enviado'){
					
					$tipo_carpeta ='saliente';
				}
				if($tipo =='externa' && $vista=='recibido'){
					$tipo_carpeta ='entrante2';
					
				}
				if($tipo =='externa' && $vista=='recibido_archivado'){
					$tipo_carpeta ='entrante2';
					
				}
				if($tipo =='externa' && $vista=='todas_externa'){
					$tipo_carpeta ='entrante2';
					
				}
				
				 $uo=explode(' ',$f["desc_uo"]);
				 $nomb =str_replace("/","_",$f["numero"]); 
				 
				 echo $f['fecha_reg'].'<br>';
				 $partes = explode("/", $f['fecha_reg']);
				 $periodo=$partes[2].'/'.$partes[1];
				 
				// $ruta_nueva=$tipo_carpeta.'/'.$uo[0].'/'.$periodo.'/';
				 $ruta_nueva=$tipo_carpeta.'/'.$periodo.'/';
				 
				 
				 echo '<br>'.$ruta_nueva.'<BR>';
				 
				 
				 if(file_exists('/opt/lampp/htdocs/endesis/sis_flujo/control/correspondencia/arch_adjuntos/'.$f["url_archivo"]) && isset($f["url_archivo"])){
				 
							 
							if(!is_dir($ruta_raiz.$ruta_nueva)){
								echo 'crea carpeta ',$ruta_nueva;
								mkdir($ruta_raiz.$ruta_nueva, 0777,true);
							}else{
								echo "Ya existe ese directorio ".$ruta_nueva;
							} 
				 	
				 	
				 	        if(file_exists($ruta_raiz.$ruta_nueva.'/'.$nomb.'.pdf')){
							 	
							 	echo 'YA EXISTE '.$f["id_correspondencia"].'  url='.$f["url_archivo"].' -> '. $nomb.'<br>';
							 	$cont_existentes++;
							 }
							 else{
							 	
							 	
								 copy('/opt/lampp/htdocs/endesis/sis_flujo/control/correspondencia/arch_adjuntos/'.$f["url_archivo"],$ruta_raiz.$ruta_nueva.'/'.$nomb.'.pdf');
								 
								 echo 'copiado id '.$f["id_correspondencia"].'  url '.$f["url_archivo"].' -> '. $nomb.' <br>';
								 $cont_copiados++;
								 	
							 }
                 }
				 else
				 {
				 	echo 'FICHERO OMITIDO '.$f["id_correspondencia"].' url'.$f["url_archivo"].'<br>';
				 	 $cont_omitidos++;
				 	
				 }
				 
				
				 echo "	FIcheros omitidos $cont_omitidos existentes $cont_existentes copaidos $cont_copiados;";
			
			
			
			
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