<?php
session_start ();
require_once ('../../../lib/Spreadsheet_Excel_Writer-0.9.2/Spreadsheet/Excel/Writer.php');
include_once ("../LibModeloSigma.php");

$nombre_archivo = 'consulta_recursos.xls';
$docexcel = new Spreadsheet_Excel_Writer ( );
$nuevahoja = & $docexcel->addWorksheet ( "RECURSO PERCIBIDO - ".$_SESSION ['PDF_id_declaracion']);

$format_titulo =& $docexcel->addFormat();
$format_titulo->setBold();
$format_titulo->setAlign('center');

$format_numero =& $docexcel->addFormat();
$format_numero->setNumFormat('D-MMM-YYYY');

$fila = 0;
$columna = 0;

$nuevahoja->write ( 0, 0, 'PARTIDA',$format_titulo);
$nuevahoja->write ( 0, 1, 'DESCRIPCION',$format_titulo );
$nuevahoja->write ( 0, 2, 'ID PPTO',$format_titulo );
$nuevahoja->write ( 0, 3, 'PRESUPUESTO',$format_titulo);
$nuevahoja->write ( 0, 4, 'PERCIBIDO',$format_titulo);


//OBTENCION DE LOS DATOS
$sigma = new cls_CustomDBSigma();
$res = $sigma->ConsultaRecurso('null', 'null', $_SESSION ['PDF_sortcol'], $_SESSION ['PDF_sortdir'], $criterio_filtro, $id_financiador, $id_regional, $id_programa, $id_proyecto, $id_actividad, $_SESSION ['PDF_id_declaracion'], $_SESSION ['PDF_id_partida'], 'null' );

if ($res) {
	$data = $sigma->salida;
	$fila = 1;

	foreach ( $data as $row ) {
		$nuevahoja->write ( $fila, 0, $row [0] );
		$nuevahoja->write ( $fila, 1, $row [1] );
		$nuevahoja->write ( $fila, 2, $row [2] );
		$nuevahoja->write ( $fila, 3, $row [3] );
		$nuevahoja->write ( $fila, 4, $row [4] );

		$fila ++; 
	} //FIN DE FOREACH
	$docexcel->send ( $nombre_archivo );
	$docexcel->close ();
} 
else 
{
	$resp = new cls_manejo_mensajes ( true, "401" );
	$resp->mensaje_error = 'MENSAJE ERROR = Error al generar el archivo xls';
	$resp->origen = "ORIGEN = $nombre_archivo";
	$resp->proc = "PROC = $nombre_archivo";
	$resp->nivel = 'NIVEL = 3';
	echo $resp->get_mensaje ();
	exit ();
}
?>