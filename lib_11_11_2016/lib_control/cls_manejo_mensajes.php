<?php
//Clase para el manejo de los mensajes que se enviar�n a la vista, que hereda las funcionalidades de la clase cls_manejo_xml
//Da el formato de XML est�ndar definido para las respuestas obtenidas tanto de la bd como de la aplicaci�n php
//Utiliza la clase manejo_xml
//Creaci�n 29-05-2007
class cls_manejo_mensajes extends cls_manejo_xml
{
	//Variable booleana que indica si es error o no
	var $error;

	//Para el manejo de errores
	var $mensaje_error;
	var $origen;
	var $proc;
	var $nivel;
	var $query;

	function __construct($error, $codigo_header="", $etiqueta_arbol = 'ROOT')
	{
		parent::__construct($etiqueta_arbol, $codigo_header);
		$this->error = $error;
	
		if($error) $this->add_nodo('error', 'true');
		else $this->add_nodo('error', 'false');

		$this->add_rama('detalle');
	}
	
	function get_mensaje()
	{
		//Verifica si es mensaje de error o de �xito
		if($this->error)
		{
			$this->add_nodo('mensaje',$this->mensaje_error);
			$this->add_nodo('origen',$this->origen);
			$this->add_nodo('proc',$this->proc);
			$this->add_nodo('nivel',$this->nivel);
			$this->add_nodo('query',$this->query);
			$this->fin_rama();

			return $this->mostrar_xml();
		}
		else
		{
			$this->fin_rama();
			return $this->mostrar_xml();
		}
	}
	
}


?>