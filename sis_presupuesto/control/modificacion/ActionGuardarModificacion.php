<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarModificacion.php
Prop�sito:				Permite insertar y modificar datos en la tabla tpr_modificacion
Tabla:					tpr_tpr_modificacion
Par�metros:				$id_modificacion
						$id_gestion
						$tipo_modificacion
						$justificacion
						$tipo_presupuesto
						$nro_traspaso
						$estado_modificacion
						$fecha_regis
						$fecha_conclusion
						$id_usuario_reg

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2010-05-10 18:01:22
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloPresupuesto.php");

$Custom = new cls_CustomDBPresupuesto();
$nombre_archivo = "ActionGuardarModificacion.php";

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
			$id_modificacion= $_GET["id_modificacion_$j"];
			$id_parametro= $_GET["id_parametro_$j"];
			$tipo_modificacion= $_GET["tipo_modificacion_$j"];
			$justificacion= $_GET["justificacion_$j"];
			$tipo_presupuesto= $_GET["tipo_presupuesto_$j"];
			$nro_modificacion= $_GET["nro_modificacion_$j"];
			$estado_modificacion= $_GET["estado_modificacion_$j"];
			$fecha_regis= $_GET["fecha_regis_$j"];
			$fecha_conclusion= $_GET["fecha_conclusion_$j"];
			$id_usuario_reg= $_GET["id_usuario_reg_$j"];
			$id_periodo= $_GET["id_periodo_$j"];
            $docmod_tipo= $_GET["docmod_tipo_$j"];
            $docmod_nro= $_GET["docmod_nro_$j"];
            $docmod_fecha= $_GET["docmod_fecha_$j"];
            $docdis_tipo= $_GET["docdis_tipo_$j"];
            $docdis_nro= $_GET["docdis_nro_$j"];
            $docdis_fecha= $_GET["docdis_fecha_$j"];
		}
		else
		{
			$id_modificacion=$_POST["id_modificacion_$j"];
			$id_parametro=$_POST["id_parametro_$j"];
			$tipo_modificacion=$_POST["tipo_modificacion_$j"];
			$justificacion=$_POST["justificacion_$j"];
			$tipo_presupuesto=$_POST["tipo_presupuesto_$j"];
			$nro_modificacion=$_POST["nro_modificacion_$j"];
			$estado_modificacion=$_POST["estado_modificacion_$j"];
			$fecha_regis=$_POST["fecha_regis_$j"];
			$fecha_conclusion=$_POST["fecha_conclusion_$j"];
			$id_usuario_reg=$_POST["id_usuario_reg_$j"];
			$id_periodo= $_POST["id_periodo_$j"];
            $docmod_tipo= $_POST["docmod_tipo_$j"];
            $docmod_nro= $_POST["docmod_nro_$j"];
            $docmod_fecha= $_POST["docmod_fecha_$j"];
            $docdis_tipo= $_POST["docdis_tipo_$j"];
            $docdis_nro= $_POST["docdis_nro_$j"];
            $docdis_fecha= $_POST["docdis_fecha_$j"];
		}

		if ($id_modificacion == "undefined" || $id_modificacion == "")
		{
			////////////////////Inserci�n/////////////////////

			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarModificacion("insert",$id_modificacion,$id_parametro,$tipo_modificacion,$justificacion,$tipo_presupuesto,$nro_modificacion,$estado_modificacion,$fecha_regis,$fecha_conclusion,$id_usuario_reg,$id_periodo,$docmod_tipo,$docmod_nro,$docmod_fecha,$docdis_tipo,$docdis_nro,$docdis_fecha);

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

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tpr_modificacion
			$res = $Custom -> InsertarModificacion($id_modificacion,$id_parametro,$tipo_modificacion,$justificacion,$tipo_presupuesto,$nro_modificacion,$estado_modificacion,$fecha_regis,$fecha_conclusion,$id_usuario_reg,$id_periodo,$docmod_tipo,$docmod_nro,$docmod_fecha,$docdis_tipo,$docdis_nro,$docdis_fecha);

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
			
			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarModificacion("update",$id_modificacion,$id_parametro,$tipo_modificacion,$justificacion,$tipo_presupuesto,$nro_modificacion,$estado_modificacion,$fecha_regis,$fecha_conclusion,$id_usuario_reg,$id_periodo,$docmod_tipo,$docmod_nro,$docmod_fecha,$docdis_tipo,$docdis_nro,$docdis_fecha);

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
			
			if ($estado_modificacion == "Concluido"){
				$res = $Custom->ModificarModificacionSigma($id_modificacion,$id_periodo,$docmod_tipo,$docmod_nro,$docmod_fecha,$docdis_tipo,$docdis_nro,$docdis_fecha);
			}else{
				$res = $Custom->ModificarModificacion($id_modificacion,$id_parametro,$tipo_modificacion,$justificacion,$tipo_presupuesto,$nro_modificacion,$estado_modificacion,$fecha_regis,$fecha_conclusion,$id_usuario_reg,$id_periodo,$docmod_tipo,$docmod_nro,$docmod_fecha,$docdis_tipo,$docdis_nro,$docdis_fecha);
			}
			
			
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
	}//END FOR

	//Guarda el mensaje de �xito de la operaci�n realizada
	if($cont > 1) $mensaje_exito = "Se guardaron todos los datos.";
	else $mensaje_exito = $Custom->salida[1];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "id_modificacion";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarModificacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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