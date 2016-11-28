<?php
/**
 * Nombre clase:	cls_manejo_xml
 * Prop�sito:		Permite crear cadenas en formato xml a partir de un nodo principal
 * Autor:			Rodrigo Chumacero Moscoso
 * Fecha creaci�n:	25-05-2007
 */
class cls_manejo_xml
{
	var $xml;//Variable que contendr� el xml
	var $etiqueta_arbol;
	var $func; //instancia de la clase funciones para acceder a sus m�todos
	var $array_etiquetas_rama = array();//Array que contendr� las etiquetas de todas las ramas temporalmente
	var $encoding_xml; //Codificaci�n que se utilizar� para el xml
	var $encoding_header; //Codificaci�n que se utilizar� para el Header de despliegue del xml
	var $version_xml = '1.0' ;//Versi�n del xml
	var $terminado = false;//Vriable que indica si se coloc� ya su fin de nodo ra�z
	//Variable que contiene el c�digo del header del html
	var $codigo_header;

	public function __construct($etiqueta_arbol, $codigo_header="")
	{
		session_start();
		//Obtiene las codificaciones de la configuraci�n
		$this->encoding_xml = $_SESSION["CODIFICACION_XML"];
		$this->encoding_header = $_SESSION["CODIFICACION_HEADER"];
		$this->codigo_header = $codigo_header;
		$this->etiqueta_arbol = $etiqueta_arbol;
		$this->func = new cls_funciones();

		//Crea el encabezado del xml
		if($this->encoding_xml == "")
		{
			$this->xml = "<?xml version=\"$this->version_xml\"?>\n";
		}
		else
		{
			$this->xml = "<?xml version=\"$this->version_xml\" encoding=\"$this->encoding_xml\"?>\n";
		}

		//A�ade el nodo ra�z
		$this->xml .= "<$etiqueta_arbol>\n";
	}

	//A�ade un nodo xml
	public function add_nodo($etiqueta_nodo, $valor)
	{
		$this->xml .= "<$etiqueta_nodo>$valor</$etiqueta_nodo>\n";
	}

	//A�ade una rama
	public function add_rama($etiqueta_rama)
	{
		//Coloca temporalmente la etiqueta de la rama, hasta que se cierre (al cerrar se borrar� el elemento de la etiqueta)
		array_push($this->array_etiquetas_rama,$etiqueta_rama);
		$this->xml .= "<$etiqueta_rama>\n";
	}

	public function fin_rama()
	{
		$aux = array_pop($this->array_etiquetas_rama);
		$this->xml .= "</$aux>\n";

	}

	public function cadena_xml()
	{
		if(!$this->terminado)
		{
			$this->xml .= "</$this->etiqueta_arbol>\n";
			$this->terminado = true;
		}
		return $this->xml;
	}

	public function mostrar_xml()
	{
		
		//echo 'llega';
		
		if(!$this->terminado)
		{
			$this->xml .= "</$this->etiqueta_arbol>\n";
			$this->terminado = true;
		}

		//Despliega el header del html si es que tuviese
		if($this->codigo_header!="")
		{
			//Despliega el header correspondiente
			$aux = $this->header($this->codigo_header);
			if($aux != '') header($aux);
		}

		//Despliega el header del xml
		if($this->encoding_header == "")
		{
			header('Content-Type:text/xml');
		}
		else
		{
			header("Content-Type:text/xml; charset=$this->encoding_header");
		}


		//Despliega el xml
		echo $this->xml;
	}

	/**
	 * Nombre funci�n:	header
	 * Prop�sito:		Devolver el header de html a partir del c�digo header del html
	 * Fecha creaci�n:	25-05-2007
	 * Autor:			Rodrigo Chumacero Moscoso
	 *
	 * @param unknown_type $codigo_header
	 * @return unknown
	 */
	function header($codigo_header)
	{
		switch ($codigo_header)
		{
			case '406':
				return "HTTP/1.1 $codigo_header No Aceptable";
				break;


			case '409':
				return "HTTP/1.1 $codigo_header  Conflict";
				break;


			case '412':
				return "HTTP/1.1 $codigo_header Precondition Failed";  //lo reconoce exoplorer

				break;

			case '500':
				return "HTTP/1.1 $codigo_header  Internal Server Error";
				break;
				
			case '503':
				return "HTTP/1.1 $codigo_header   Service Unavailable"; //lo reconoce exoplorer
				break;

			case '401':
				return "HTTP/1.1 $codigo_header No autorizado"; //lo reconoce exoplorer
				break;

			case '202':
				return "HTTP/1.1 $codigo_header ok";  //lo reconoce exoplorer
				break;

			default:
				return '';
				break;
		}
	}

}
?>