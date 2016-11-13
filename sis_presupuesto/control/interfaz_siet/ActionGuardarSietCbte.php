<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarSietDeclara.php
Prop�sito:				Permite insertar y modificar datos en la tabla tsi_siet_cbte
Tabla:					tsi_siet_cbte
Par�metros:				$id_siet_declara
						

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		01/11/2015
Versi�n:				1.0.0
Autor:					avq
**********************************************************
*/
session_start();
include_once("../LibModeloPresupuesto.php");

$Custom = new cls_CustomDBPresupuesto();
$nombre_archivo = "ActionGuardarSietCbte.php";

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
			$id_siet_declara		= $_GET["id_siet_declara_".$j];
         	$id_siet_cbte			= $_GET["id_siet_cbte_".$j];
          	$id_extracto_bancario	= $_GET["id_extracto_bancario_".$j];
		    $sw_ingresa_declaracion	= $_GET["sw_ingresa_declaracion_".$j];
            $id_gestion				= $_GET["id_gestion_".$j];
			$id_periodo				= $_GET["id_periodo_".$j];
			$tipo_declara			= $_GET["tipo_declara_".$j];
			$tipo_generacion		= $_GET["tipo_generacion_".$j];
		}
		else 
		{ 
		  $id_siet_declara			= $_POST["id_siet_declara_".$j];
          $id_siet_cbte				= $_POST["id_siet_cbte_".$j];
          $id_extracto_bancario		= $_POST["id_extracto_bancario_".$j];
		  $sw_ingresa_declaracion	= $_POST["sw_ingresa_declaracion_".$j];                 
          $id_gestion				= $_POST["id_gestion_".$j];
		  $id_periodo				= $_POST["id_periodo_".$j];
		  $tipo_declara				= $_POST["tipo_declara_".$j];
          $tipo_generacion			= $_POST["tipo_generacion_".$j];
			
		}
         
       		////////////////////Inserci�n/////////////////////
        	//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tpr_categoria
        	 if ($tipo_generacion=='uno'){
        	     $res = $Custom -> InsertarSietCbte($id_siet_cbte,$id_siet_declara,$id_extracto_bancario,$sw_ingresa_declaracion); //todos o uno por uno
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
             else {
               if ($tipo_declara=='gasto'){
   						$res = $Custom -> InsertarSietCbtesPartidas($id_siet_declara,$id_gestion,$id_periodo,$tipo_declara);
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
		       elseif ($tipo_declara=='validar_sino'){
		       
		       	$res = $Custom -> ValidarSiNo($id_siet_declara);
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
		       else{
		                $res = $Custom ->InsertarSietCbtesPartidasRecurso($id_siet_declara,$id_gestion,$id_periodo,$tipo_declara);
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
               }

	}//END FOR

	//Guarda el mensaje de �xito de la operaci�n realizada
	if($cont > 1) $mensaje_exito = "Se guardaron todos los datos.";
	else $mensaje_exito = $Custom->salida[1];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "id_siet_declara";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarSietCbte($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_siet_declara);
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