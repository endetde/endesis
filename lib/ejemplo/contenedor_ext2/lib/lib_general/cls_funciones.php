<?php

/**
 * Nombre clase:	cls_funciones
 * Prop�sito:		Clase que contiene funciones de uso general para todo el sistema
 * Autor:			Rensi Arteaga Copari
 * Fecha creaci�n:	31-05-2007
 */
class cls_funciones
{
	/**
	 * Nombre funci�n:		sanitize_vars_fixed
	 * Prop�sito:			Se utiliza para limpiar las variables de posibles ataques de SQL injection
	 * Valores de Retorno:	
	 * Autor:				Rensi Arteaga Copari
	 * Fecha creaci�n:		31-05-2007
	 */
	function sanitize_vars_fixed()
	{
		foreach ($GLOBALS as $var => $value)
		{echo "$var ,=> $value";
		if (is_array($value))
		{
			foreach ($value as $i => $j)
			{   echo "$j jjj $value";
			$j = preg_replace("/\\/", "", $j);
			$GLOBALS[$var][$i] = addslashes(htmlentities($j,ENT_QUOTES));
			}
		}
		else
		{
			$value = preg_replace("/\\/", "", $value);
			$GLOBALS[$var] = addslashes(htmlentities($value,ENT_QUOTES));
		}
		}
		exit;
	}

	/**
 * Nombre funci�n: 		fecha_actual
 * Prop�sito:			Se utiliza para obtener la fecha actual parametrizada
 * Valores de Retorno:	Fecha
 * Autor:				Rensi Arteaga Copari
 * Fecha creaci�n:		31-05-2007
 * 
 * @return date
 */
	function fecha_actual()
	{
		$fecha=date("Y-m-d");

		$fecha = explode("-",$fecha);
		switch ($fecha[1])
		{
			case 1:
				$fecha[1]="enero";
				break;
			case 2:
				$fecha[1]="febrero";
				break;
			case 3:
				$fecha[1]="marzo";
				break;
			case 4:
				$fecha[1]="abril";
				break;
			case 5:
				$fecha[1]="mayo";
				break;
			case 6:
				$fecha[1]="junio";
				break;
			case 7:
				$fecha[1]="julio";
				break;
			case 8:
				$fecha[1]="agosto";
				break;
			case 9:
				$fecha[1]="septiembre";
				break;
			case 10:
				$fecha[1]="octubre";
				break;
			case 11:
				$fecha[1]="noviembre";
				break;
			case 12:
				$fecha[1]="diciembre";
				break;

		}
		$fecha_actual = " ".$fecha[2]." de ".$fecha[1]." de ".$fecha[0];
		return  $fecha_actual;
	}

	/**
 * Nombre funci�n:		redondeado
 * Prop�sito:			Se utiliza para redondar con una cantidad especifica de decimales
 * Valores de Retorno:	N�mero redondeado
 * Autor:				Rensi Arteaga Copari
 * Fecha creaci�n:		31-05-2007
 *
 * @param unknown_type $numero
 * @param unknown_type $decimales
 * @return number
 */
	function redondeado ($numero, $decimales)
	{
		$factor = pow(10, $decimales);
		return (round($numero*$factor)/$factor);
	}


	/**
 * Nombre funci�n:		cifrar	
 * Prop�sito:			Se utiliza para cifrar
 * Valores de Retorno:	Cadena cifrada
 * Autor:				Rensi Arteaga Copari
 * Fecha creaci�n:		31-05-2007
 *
 * @param unknown_type $palabra
 * @return unknown
 */
	function cifrar ($palabra)
	{
		//$palabra_c = crypt($palabra,$CLAVE_E);
		$palabra_c = md5($palabra);
		return $palabra_c;
	}

	/**
 * Nombre funci�n:		FormatearContenidoFPDF
 * Prop�sito:			Se utiliza para que los caracteres raros(����� �.. etc) aparescan bien el el PDF
 * Valores de Retorno:	Cadena reparada
 * Autor:				Rensi Arteaga Copari
 * Fecha creaci�n:		31-05-2007
 *
 * @param unknown_type $palabra
 * @return string
 */
	function FormatearContenidoFPDF ($palabra)
	{
		$a = chr(195).chr(129);
		$i = chr(195).chr(141);
		$dicc=array (
		"á"=>"�",
		"é"=>"�",
		"í" =>"�",
		"ó" =>"�",
		"ú" =>"�",
		"$a" =>"�",
		"É" =>"�",
		"$i" =>"�",
		"Ó" =>"�",
		"Ú" =>"�",
		"Ñ" =>"�",
		"ñ" =>"�"
		);

		$palabra_c = strtr($palabra,$dicc);

		return $palabra_c;
	}

	/**
	 * Nombre funci�n:		iif
	 * Prop�sito:			Se utiliza para evaluar r�pidamente una expresi�n y devolver valor por verdad o por falsedad
	 * Valores de Retorno:	Valor definido dependiendo de la evaluaci�n de la expresi�n
	 * Autor:				Rodrigo Chumacero Moscoso
	 * Fecha creaci�n:		31/05/2007
	 *
	 * @param unknown_type $expresion
	 * @param unknown_type $returntrue
	 * @param unknown_type $returnfalse
	 * @return unknown
	 */
	public function iif($expresion, $returntrue, $returnfalse = '') {
		return ($expresion ? $returntrue : $returnfalse);
	}

	public function mostrar_xml($xml)
	{
		//include("../../../lib/configuracion.inc.php");

		//$host  = $_SERVER['HTTP_HOST'];

		//include("http://$host/endesis/lib/configuracion.inc.php");
		//include("http://$host/endesis/lib/configuracion.inc.php");


		$encoding = $CODIFICACION_HEADER;

		/*echo "hed->".$COD_HEADER;
		exit;*/

		/*if($encoding=="")
		{
		header('Content-Type: text/xml');
		}
		else
		{
		header("'Content-Type: text/xml charset= $encoding'");
		}*/
		header('Content-Type: text/xml charset= ' .$encoding);
		//header('Content-Type: text/xml charset= UTF-8');
		echo $xml;
	}

}?>