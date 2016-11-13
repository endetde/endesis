<?php
/**
**********************************************************
Nombre de archivo:	    ActionListarFuncionario.php
Prop�sito:				Permite realizar el listado en tkp_empleado
Tabla:					t_tkp_empleado
Par�metros:				$cant
						$puntero
						$sortcol
						$sortdir
						$criterio_filtro

Valores de Retorno:    	Listado de Procesos y total de registros listados
Fecha de Creaci�n:		2010-08-04 09:06:56
Versi�n:				1.0.0
Autor:					
**********************************************************
*/
session_start();
include_once('../LibModeloKardexPersonal.php');

$Custom = new cls_CustomDBKardexPersonal();
$nombre_archivo = 'ActionListarFuncionario.php'; 

if (!isset($_SESSION['autentificado']))
{
	$_SESSION['autentificado']='NO';
}
if($_SESSION['autentificado']=='SI')
{
//Par�metros del filtro
	if($limit == '') $cant = 15;
	else $cant = $limit;

	if($start == '') $puntero = 0;
	else $puntero = $start;

	
	if($sort == '') $sortcol = 'FUNCIO.desc_persona';
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

	//Verifica si se manda la cantidad de filtros
	if($CantFiltros=='') $CantFiltros = 0;

	//Se obtiene el criterio del filtro con formato sql para mandar a la BD
	$cond = new cls_criterio_filtro($decodificar);
	for($i=0;$i<$CantFiltros;$i++)
	{
		$cond->add_condicion_filtro($_POST["filterCol_$i"], $_POST["filterValue_$i"], $_POST["filterAvanzado_$i"]);
	}
	$criterio_filtro = $cond -> obtener_criterio_filtro();
	//Obtiene el criterio de orden de columnas
	$crit_sort = new cls_criterio_sort($sortcol,$sortdir,'Empleado_kasderg');
	$sortcol = $crit_sort->get_criterio_sort();
	
	
	if($solicitud_compra!=''){  //para sistema de adquisiciones(solicitud de compra): solo deben listarse los empleados cuya asignacion este activa==> estado='activo' && estado_reg='activo'
		$criterio_filtro=$criterio_filtro." AND EMPLEA.id_empleado in (select distinct id_empleado from tkp_historico_asignacion where estado=''activo'' and estado_reg=estado) and EMPLEA.id_empleado in (select distinct id_empleado from tkp_empleado_tpm_frppa)";
	}
	if($unidad=='si'){
		$criterio_filtro=$criterio_filtro." AND EMPLEA.id_empleado in (select distinct id_empleado from tkp_historico_asignacion where estado=''activo'') ";
	}

	/*echo $id_planilla;
	exit;
	*/
	if(isset($id_planilla)){
	  if ($id_planilla>0){

		$criterio_filtro=$criterio_filtro." AND EMPLEA.id_empleado in (select id_empleado from kard.tkp_empleado_planilla where id_planilla=$id_planilla) ";
	
	  }
	}
	
	//Obtiene el total de los registros
	$res = $Custom -> ContarFuncionario($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);

	if($res) $total_registros= $Custom->salida;

	//Obtiene el conjunto de datos de la consulta
	$res = $Custom->ListarFuncionario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$hidden_ep_id_financiador,$hidden_ep_id_regional,$hidden_ep_id_programa,$hidden_ep_id_proyecto,$hidden_ep_id_actividad);
	
	if($res)
	{
		$xml = new cls_manejo_xml('ROOT');
		$xml->add_nodo('TotalCount',$total_registros);

		if($filtro>0){
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_empleado', '0');
			//$xml->add_nodo('id_persona','');
			$xml->add_nodo('desc_persona','Ninguno');
			//$xml->add_nodo('codigo_empleado','Ninguno');
			$xml->add_nodo('nombre_tipo_documento','Documento');
			$xml->add_nodo('doc_id','Ninguno');
			$xml->add_nodo('email1','Ninguno');			
			
			$xml->fin_rama();
		}

		foreach ($Custom->salida as $f)
		{
			$xml->add_rama('ROWS');
			$xml->add_nodo('id_empleado',$f["id_empleado"]);
			$xml->add_nodo('id_persona',$f["id_persona"]);
			$xml->add_nodo('desc_persona',$f["desc_persona"]);
			
			$xml->add_nodo('nombre_cargo',$f["nombre_cargo"]);
			$xml->add_nodo('nombre_unidad_presupuesta',$f["nombre_unidad_presupuesta"]);
			
			$xml->add_nodo('codigo_empleado',$f["codigo_empleado"]);
			$xml->add_nodo('nombre_tipo_documento',$f["nombre_tipo_documento"]);
			$xml->add_nodo('doc_id',$f["doc_id"]);
			$xml->add_nodo('email1',$f["email1"]);
			$xml->add_nodo('id_cuenta',$f["id_cuenta"]);
			$xml->add_nodo('nombre_cuenta',$f["nombre_cuenta"]);
			$xml->add_nodo('id_auxiliar',$f["id_auxiliar"]);
			$xml->add_nodo('nombre_auxiliar',$f["nombre_auxiliar"]);
            $xml->add_nodo('estado_reg', $f["estado_reg"]);
			$xml->add_nodo('fecha_reg', $f["fecha_reg"]);
			$xml->add_nodo('id_depto', $f["id_depto"]);
			$xml->add_nodo('desc_depto', $f["desc_depto"]);
			$xml->add_nodo('id_lugar_trabajo', $f["id_lugar_trabajo"]);
			$xml->add_nodo('desc_lugar', $f["desc_lugar"]);
			$xml->add_nodo('fecha_ingreso', $f["fecha_ingreso"]);
			$xml->add_nodo('antiguedad_ant', $f["antiguedad_ant"]);
			$xml->add_nodo('id_usuario_reg', $f["id_usuario_reg"]);
			$xml->add_nodo('id_escala_salarial', $f["id_escala_salarial"]);
			$xml->add_nodo('desc_usuario', $f["desc_usuario"]);
			$xml->add_nodo('desc_escala_salarial', $f["desc_escala_salarial"]);
			$xml->add_nodo('compensa', $f["compensa"]);
			$xml->add_nodo('marca', $f["marca"]);
			//$xml->add_nodo('foto_persona', $f["foto_persona"]);
			$xml->add_nodo('numero', $f["numero"]);
			$xml->add_nodo('extension', $f["extension"]);
			$xml->add_nodo('nombre_foto', $f["nombre_foto"]);
			
			
			$xml->add_nodo('nivel_academico', $f["nivel_academico"]);
			
			$xml->add_nodo('tiene_descuento', $f["tiene_descuento"]);
			$xml->add_nodo('nro_interno', $f["nro_interno"]);
			$xml->add_nodo('nro_celular_empresa', $f["nro_celular_empresa"]);
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