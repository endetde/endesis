<?php
/**
 * Nombre de la Clase:	cls_DBDetalleNormativa
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla com_detalle_normativa
 * Autor:				Morgan Huascar Checa Lopez
 * Fecha creaci�n:		14-05-2013
 *
 */
class cls_DBDetalleNormativa
{
	//Variable que contiene la salida de la ejecuci�n de la funci�n
	//si la funci�n tuvo error (false), salida contendr� el mensaje de error
	//si la funci�n no tuvo error (true), salida contendr� el resultado, ya sea un conjunto de datos o un mensaje de confirmaci�n
	var $salida;
	
	//Variable que contedr� la cadena de llamada a las funciones postgres
	var $query;

	//Variables para la ejecuci�n de funciones
	var $var; //middle_client
	var $nombre_funcion; //nombre de la funci�n a ejecutar
	var $codigo_procedimiento; //codigo del procedimiento a ejecutar

	//Nombre del archivo
	var $nombre_archivo = "cls_DBDetalleNormativa.php";

	//Matriz de par�metros de validaci�n de todas las columnas
	var $matriz_validacion = array();
	
	//Bandera que indica si los datos se decodificar�n o no
	var $decodificar = false;

	function __construct($decodificar)
	{
		//Carga los par�metro de validaci�n de todas las columnas
		//$this->cargar_param_valid();
		
		//Carga en una variable interna la bandera del GET o POST
		$this->decodificar = $decodificar;
	}

	/**
	 * Nombre de la funci�n:	ListarNormativas
	 * Prop�sito:				Desplegar los registros de com_normativa_interna
	 * Autor:					Morgan Huascar Checa Lopez
	 * Fecha de creaci�n:		14-05-2013
	 *
	 */
	function ListarDetalleNormativa($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'comunidad.f_com_detalle_normativa_sel';
		$this->codigo_procedimiento = "'CO_DETNORM_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

	

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_detalle_normativa','integer');
		$this->var->add_def_cols('nombre_subcategoria','varchar');
		$this->var->add_def_cols('descripcion_subcategoria','varchar');
		$this->var->add_def_cols('fecha_registro','date');
		$this->var->add_def_cols('id_normativa_interna','integer');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//echo $this->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarNormativas
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					Morgan Huascar checa Lopez
	 * Fecha de creaci�n:		15-05-2013
	 *
	 */
	function ContarDetalleNormativa($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'comunidad.f_com_detalle_normativa_sel';
		$this->codigo_procedimiento = "'CO_DETNORM_COUNT'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";


		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('total','bigint');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n
		$this->salida = $this->var->salida;

		//Si la ejecuci�n fue satisfactoria modifica la salida para que solo devuelva el total de la consulta
		if($res)
		{
			$this->salida = $this->var->salida[0][0];
		}
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	
	
	/**
	 * Nombre de la funci�n:	InsertarNormativas
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla comunidad.com_normativa_interna
	 * Autor:				    (Morgan Huascar Checa Lopez)
	 * Fecha de creaci�n:		15-05-2013
	 * Descripci�n:             
	
	 */
	function InsertarDetalleNormativa($id_detalle_normativa, $nombre_subcategoria, $descripcion_subcategoria, $id_normativa_interna)
	{
		$this->salida = "";
		$this->nombre_funcion = 'comunidad.f_com_detalle_normativa_iud';
		$this->codigo_procedimiento = "'CO_DETNORM_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param(0);
		$this->var->add_param("'$nombre_subcategoria'");
		$this->var->add_param("'$descripcion_subcategoria'");
		$this->var->add_param("'$id_normativa_interna'");
	
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();
		
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	
	/**
	 * Nombre de la funci�n:	ModificarNormativas
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla comunidad.com_normativa_interna
	 * Autor:				    Morgan Huascar Checa Lopez
	 * Fecha de creaci�n:		16-05-2013
	 */
	function ModificarDetalleNormativa($id_detalle_normativa, $nombre_subcategoria, $descripcion_subcategoria, $id_normativa_interna)
	{
		$this->salida = "";
		$this->nombre_funcion = 'comunidad.f_com_detalle_normativa_iud';
		$this->codigo_procedimiento = "'CO_DETNORM_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		//$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_detalle_normativa);
		$this->var->add_param("'$nombre_subcategoria'");
		$this->var->add_param("'$descripcion_subcategoria'");
		$this->var->add_param("'$id_normativa_interna'");
	
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//echo $this->query;
		return $res;
	}
	
	
	/**
	 * Nombre de la funci�n:	EliminarNormativas
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla com_normativa_interna
	 * Autor:				    Morgan Huascar Checa Lopez
	 * Fecha de creaci�n:		15-05-2013
	 */
	function EliminarDetalleNormativa($id_detalle_normativa)
	{
		$this->salida = "";
		$this->nombre_funcion = 'comunidad.f_com_detalle_normativa_iud';
		$this->codigo_procedimiento = "'CO_DETNORM_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_detalle_normativa);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param(0);

		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	
	
}
?>