<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarCorrespondencia.php
Prop�sito:				Permite insertar y modificar datos en la tabla tfl_correspondencia
Tabla:					tfl_tfl_correspondencia
Par�metros:				$id_correspondencia
						$id_depto
						$id_documento
						$id_empleado_origen
						$id_uo_origen
						$id_institucion
						$id_persona
						$referencia
						$fecha_origen
						$hora_origen
						$fecha_destino
						$hora_destino
						$accion

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2011-02-11 10:52:59
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloFlujo.php");

$Custom = new cls_CustomDBFlujo();
$nombre_archivo = "ActionGuardarCorrespondencia.php";

$carpeta_destino = '../../control/correspondencia/arch_adjuntos/';

/*
 * TAMA�O MAXIMO DEL ARCHIVO
 */
$tMax = 200000000;
        
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
		
		if($_POST["subearchivo"] == 'si')
			$cont =  1;
		else
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

		//$url_archivo
		
		$url_archivo='';

		///////////////////////Modificaci�n////////////////////
		//valida tama�o de archivo 
			if($_FILES["archivo"]["size"] < $tMax  && ($_FILES["archivo"]["error"] ==0 || $_FILES["archivo"]["error"] == 7||
			/*si no subio arhivo debe seguir*/$_FILES["archivo"]["error"] == 4))
				{		  
			    	  $nombre_original = $_FILES["archivo"]["name"];	
					  $ext = explode(".",$_FILES["archivo"]["name"]); //obtiene cadena despues del .
					  $tama�o = count($ext);
					  $extension = $ext[$tama�o - 1]; // se obtiene la extension = ultimo indice del vector
					  //MODIFICACI�N aayaviri 12/04/2011 - 23:46
					  
					  $extension = strtolower($extension);
					  if($extension=='pdf' || $extension=='PDF' || $extension=='' || $extension=='doc' || $extension=='DOC' ||$extension=='docx' || $extension=='DOCX' ){
							  $nombre_arch = 'corres_';	
			
							  $nombre_original = $_FILES["archivo"]["name"];
							  //validamos si el archivo se subio
							  $sw_subir_archivo = true;
							   if($_FILES["archivo"]["size"]==0){
							   	// no est� entrando aqu�.
							   			$nombre_arch=null;	
										$sw_subir_archivo = false;
							   }
								$res = $Custom->SubirArchivoCorrespondencia($id_correspondencia,$nombre_arch,$extension);
					
								if(!$res){
									
								
									//Se produjo un error
									$resp = new cls_manejo_mensajes(true, "406");
									$resp->mensaje_error = $Custom->salida[1];
									$resp->origen = $Custom->salida[2];
									$resp->proc = $Custom->salida[3];
									$resp->nivel = $Custom->salida[4];
									$resp->query = '';
									echo $resp->get_mensaje();
									exit;
								}
								else{
									
								  if($sw_subir_archivo){
								    //eliminamos el archivo viejo
								    if($Custom->salida[2]!='null')
								    //valida si existe el archivo antes de eliminar
								    if (file_exists($carpeta_destino.$Custom->salida[2])){ 
								    	//rac para no borrar archivos remplazodos si no cambiar version
								    	//unlink($carpeta_destino.$Custom->salida[2]);
								    	copy($carpeta_destino.$Custom->salida[2],$carpeta_destino.'v'.$Custom->salida[4].$Custom->salida[3]);
								    	
								    }
									//subimos el nuevo archivo
									move_uploaded_file($_FILES["archivo"]["tmp_name"],$carpeta_destino.$Custom->salida[3]);
								   }
								}
					  }
					  else{
						$resp = new cls_manejo_mensajes(true, "406");
						$resp->mensaje_error = "Solo es posible subir archivos en formato PDF";
						$resp->origen = "control";
						$resp->proc = 'subida de archivo';
						$resp->nivel = "0";
						$resp->query = "";
						echo $resp->get_mensaje();
						exit;
						
					}
			    }
			    else{
		    	//error en el archivo

			    	if($_FILES["archivo"]["error"] != 0)
					{
								if($_FILES["archivo"]["error"] == 3)
								{
									$mensaje_error= 'El archivo subido fue s�lo parcialmente cargado.';
								}
								
								/*if($_FILES["archivo"]["error"] == 4)
								{
									$mensaje_error= 'Ning�n archivo fue subido.';  
								}*/
															
								if($_FILES["archivo"]["error"] == 6)
								{
									$mensaje_error= 'Falta la carpeta temporal.';  
								}
								
							
					 }
					 else{
					 	  $mensaje_error= 'El tama�o sobrepasa lo permitido, maximo '.$tMax.' Kb y su archivo tiene='.$_FILES["archivo"]["size"]."Kb";  
					 	  
					 	  echo "<script languaje='javascript' type='text/javascript'>alert('El tama�o sobrepasa lo permitido, m�ximo 100 Mb');</script>"; exit;
					 }
				 	//Se produjo un error
					$resp = new cls_manejo_mensajes(true, "406");
					$resp->mensaje_error = $mensaje_error;
					$resp->origen = "control";
					$resp->proc = 'subida de archivo';
					$resp->nivel = "0";
					$resp->query = "";
					echo $resp->get_mensaje();
					exit;
			 }
		

	//Guarda el mensaje de �xito de la operaci�n realizada
	if($cont > 1) $mensaje_exito = "Se guardaron todos los datos.";
	else $mensaje_exito = $Custom->salida[1];
	//Arma el xml para desplegar el mensaje
	$resp = new cls_manejo_mensajes(false);
	$resp->add_nodo("TotalCount", 1);
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