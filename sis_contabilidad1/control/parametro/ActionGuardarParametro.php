<?php
/**
**********************************************************
Nombre de archivo:	    ActionGuardarParametro.php
Prop�sito:				Permite insertar y modificar datos en la tabla tct_parametro
Tabla:					tct_tct_parametro
Par�metros:				$id_parametro
						$id_gestion
						$cantidad_nivel
						$estado_gestion
						$gestion_conta
						$porcen_iva
						$porcen_it
						$porcen_servicio
						$porcen_bien
						$porcen_remesa

Valores de Retorno:    	N�mero de registros guardados
Fecha de Creaci�n:		2008-10-15 17:39:51
Versi�n:				1.0.0
Autor:					Generado Automaticamente
**********************************************************
*/
session_start();
include_once("../LibModeloContabilidad.php");

$Custom = new cls_CustomDBContabilidad();
$nombre_archivo = "ActionGuardarParametro.php";

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
		if ($get){
			$id_parametro= $_GET["id_parametro_$j"];
			$id_gestion= $_GET["id_gestion_$j"];
			$cantidad_nivel= $_GET["cantidad_nivel_$j"];
			$estado_gestion= $_GET["estado_gestion_$j"];
			$gestion_conta= $_GET["gestion_conta_$j"];
			$porcen_iva= $_GET["porcen_iva_$j"];
			$porcen_it= $_GET["porcen_it_$j"];
			$porcen_servicio= $_GET["porcen_servicio_$j"];
			$porcen_bien= $_GET["porcen_bien_$j"];
			$porcen_remesa= $_GET["porcen_remesa_$j"];
            $id_moneda= $_GET["id_moneda_$j"];
            $id_fina_regi_prog_proy_acti= $_GET["id_fina_regi_prog_proy_acti_$j"];
            $id_unidad_organizacional= $_GET["id_unidad_organizacional_$j"];
		}else{
			$id_parametro=$_POST["id_parametro_$j"];
			$id_gestion=$_POST["id_gestion_$j"];
			$cantidad_nivel=$_POST["cantidad_nivel_$j"];
			$estado_gestion=$_POST["estado_gestion_$j"];
			$gestion_conta=$_POST["gestion_conta_$j"];
			$porcen_iva=$_POST["porcen_iva_$j"];
			$porcen_it=$_POST["porcen_it_$j"];
			$porcen_servicio=$_POST["porcen_servicio_$j"];
			$porcen_bien=$_POST["porcen_bien_$j"];
			$porcen_remesa=$_POST["porcen_remesa_$j"];
            $id_moneda=$_POST["id_moneda_$j"];
            $id_fina_regi_prog_proy_acti=$_POST["id_fina_regi_prog_proy_acti_$j"];
            $id_unidad_organizacional=$_POST["id_unidad_organizacional_$j"];
		}

		if ($id_parametro == "undefined" || $id_parametro == ""){
			////////////////////Inserci�n/////////////////////
			//Validaci�n de datos (del lado del servidor)
			$res = $Custom->ValidarParametro("insert",$id_parametro,$id_gestion,$cantidad_nivel,$estado_gestion,$gestion_conta,$porcen_iva,$porcen_it,$porcen_servicio,$porcen_bien,$porcen_remesa,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional);

			if(!$res){
				//Error de validaci�n
				$resp = new cls_manejo_mensajes(true, "406");
				$resp->mensaje_error = $Custom->salida[1];
				$resp->origen = $Custom->salida[2];
				$resp->proc = $Custom->salida[3];
				$resp->nivel = $Custom->salida[4];
				echo $resp->get_mensaje();
				exit;
			}

			//Validaci�n satisfactoria, se ejecuta la inserci�n en la tabla tct_parametro
			$res = $Custom -> InsertarParametro($id_parametro,$id_gestion,$cantidad_nivel,$estado_gestion,$gestion_conta,$porcen_iva,$porcen_it,$porcen_servicio,$porcen_bien,$porcen_remesa,$id_moneda,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional);

			if(!$res){
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
		}else{	///////////////////////Modificaci�n////////////////////
			if($accion == "undefined" || $accion == ""){
				//Validaci�n de datos (del lado del servidor)
				$res = $Custom->ValidarParametro("update",$id_parametro,$id_gestion,$cantidad_nivel,$estado_gestion,$gestion_conta,$porcen_iva,$porcen_it,$porcen_servicio,$porcen_bien,$porcen_remesa,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional);
	
				if(!$res){
					//Error de validaci�n
					$resp = new cls_manejo_mensajes(true, "406");
					$resp->mensaje_error = $Custom->salida[1];
					$resp->origen = $Custom->salida[2];
					$resp->proc = $Custom->salida[3];
					$resp->nivel = $Custom->salida[4];
					echo $resp->get_mensaje();
					exit;
				}
	
				$res = $Custom->ModificarParametro($id_parametro,$id_gestion,$cantidad_nivel,$estado_gestion,$gestion_conta,$porcen_iva,$porcen_it,$porcen_servicio,$porcen_bien,$porcen_remesa,$id_moneda,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional);
	
				if(!$res){
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
			}else{
				if($accion=='migrar'){
					$res = $Custom->MigrarParametro($id_parametro);
					if(!$res){
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
				if($accion=='actual'){
					$res = $Custom->ActualParametro($id_parametro);
					if(!$res){
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
			}
		}

	}//END FOR

	//Guarda el mensaje de �xito de la operaci�n realizada
	if($cont > 1) $mensaje_exito = "Se guardaron todos los datos.";
	else $mensaje_exito = $Custom->salida[1];

	//Obtiene el total de los registros. Par�metros del filtro
	if($cant == "") $cant = 100;
	if($puntero == "") $puntero = 0;
	if($sortcol == "") $sortcol = "id_parametro";
	if($sortdir == "") $sortdir = "asc";
	if($criterio_filtro == "") $criterio_filtro = "0=0";

	$res = $Custom->ContarParametro($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
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