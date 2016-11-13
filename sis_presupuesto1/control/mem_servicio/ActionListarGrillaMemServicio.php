<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarPartidaModificacion.php
Prop�sito:				Permite realizar el listado en tpr_partida_modificacion
Tabla:					tpr_tpr_partida_modificacion
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2010-05-10 18:19:16
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once('../LibModeloPresupuesto.php');

$Custom = new cls_CustomDBPresupuesto();
$nombre_archivo = 'ActionListarGrillaMemServicio.php';

if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']='NO';
}
if($_SESSION['autentificado']=='SI')
{
	function transponerMatriz($matriz) 
	{ 
	    $out = array(); 
	    foreach ($matriz as $key => $subarr) 
	    { 
		    foreach ($subarr as $subkey => $subvalue) 
		    { 
		    	$out[$subkey][$key] = $subvalue; 
		    } 
	    } 
	    return $out; 
	} 
	
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
	
	//Par�metros del filtro
	if($limit == '') $cant = 15;
	else $cant = $limit;

	if($start == '') $puntero = 0;
	else $puntero = $start;

	if($sort == '') $sortcol = 'periodo_pres';
	else $sortcol = $sort;

	if($dir == '') $sortdir = 'asc';
	else $sortdir = $dir;

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
		
	$id_mem_servicio = $_POST["id_mem_servicio"];
	$id_memoria_calculo = $_POST["id_memoria_calculo"];
	$id_moneda = $_POST["id_moneda"];
	$tipo_insercion = $_POST["tipo_insercion"];
	$total_general = $_POST["total_general"]; 
					
	//Verifica si se manda la cantidad de filtros
	if($CantFiltros=='') $CantFiltros = 0;

	//Se obtiene el criterio del filtro con formato sql para mandar a la BD
	$cond = new cls_criterio_filtro($decodificar);
	
	for($i=0;$i<$CantFiltros;$i++)
	{
		$cond->add_condicion_filtro($_POST["filterCol_$i"], $_POST["filterValue_$i"], $_POST["filterAvanzado_$i"]);
	}
		
	$criterio_filtro = $cond -> obtener_criterio_filtro();
	
	$criterio_filtro = $criterio_filtro." and memser.id_moneda = $id_moneda and memser.id_memoria_calculo = $id_memoria_calculo ";
		
	//Obtiene el total de los registros
	$res = $Custom -> ListarGrillaMemCalculo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_memoria_calculo,$id_moneda);
	
	//$Custom->salida = transponerMatriz($Custom->salida);
	
	//echo var_dump($Custom); exit;
	
	$tamanio = sizeof($Custom->salida);
	$suma = 0;
					
	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);

		if($id_mem_servicio == '') //nuevo
		{			
			$xml->add_rama('ROWS');						
			$xml->add_nodo('mes_01',0);
			$xml->add_nodo('mes_02',0);
			$xml->add_nodo('mes_03',0);
			$xml->add_nodo('mes_04',0);
			$xml->add_nodo('mes_05',0);
			$xml->add_nodo('mes_06',0);
			$xml->add_nodo('mes_07',0);
			$xml->add_nodo('mes_08',0);
			$xml->add_nodo('mes_09',0);
			$xml->add_nodo('mes_10',0);
			$xml->add_nodo('mes_11',0);
			$xml->add_nodo('mes_12',0);
			$xml->add_nodo('total',0);
			
			$xml->add_nodo('fila','editar');
			$xml->fin_rama();						
		}
		
		else //editar
		{
			$xml->add_rama('ROWS');
			
			for($i = 0; $i <= $tamanio; $i++)
			{
				switch ($Custom->salida[$i]['periodo_pres'])
				{
					case 1:$xml->add_nodo('mes_01',$Custom->salida[$i]['total_general']); break;
					case 2:$xml->add_nodo('mes_02',$Custom->salida[$i]['total_general']); break;
					case 3:$xml->add_nodo('mes_03',$Custom->salida[$i]['total_general']); break;
					case 4:$xml->add_nodo('mes_04',$Custom->salida[$i]['total_general']); break;
					case 5:$xml->add_nodo('mes_05',$Custom->salida[$i]['total_general']); break;
					case 6:$xml->add_nodo('mes_06',$Custom->salida[$i]['total_general']); break;
					case 7:$xml->add_nodo('mes_07',$Custom->salida[$i]['total_general']); break;
					case 8:$xml->add_nodo('mes_08',$Custom->salida[$i]['total_general']); break;
					case 9:$xml->add_nodo('mes_09',$Custom->salida[$i]['total_general']); break;
					case 10:$xml->add_nodo('mes_10',$Custom->salida[$i]['total_general']); break;
					case 11:$xml->add_nodo('mes_11',$Custom->salida[$i]['total_general']); break;
					case 12:$xml->add_nodo('mes_12',$Custom->salida[$i]['total_general']); break;			
					default :  break;
				}
				
				$suma = $suma + $Custom->salida[$i]['total_general'];
			}
			
			$xml->add_nodo('total',$suma);
							
			$xml->add_nodo('fila','editar');
			$xml->fin_rama();			
		}
		
		$xml->mostrar_xml();
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
	$resp->mensaje_error = 'MENSAJE ERROR = Usuario no Autentificado';
	$resp->origen = "ORIGEN = $nombre_archivo";
	$resp->proc = "PROC = $nombre_archivo";
	$resp->nivel = 'NIVEL = 3';
	echo $resp->get_mensaje();
	exit;
}?>