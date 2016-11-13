<?php
/**
 * Nombre de la Clase:	cls_DBDetalleNormativa
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla com_detalle_normativa
 * Autor:				Morgan Huascar Checa Lopez
 * Fecha creaci�n:		14-05-2013
 *
 */
class cls_DBArchivoNormativa
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
	var $nombre_archivo = "cls_DBArchivoNormativa.php";

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
	function ListarArchivoNormativa($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'comunidad.f_com_archivos_normativas_sel';
		$this->codigo_procedimiento = "'CO_ARCHNORM_SEL'";

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
		$this->var->add_def_cols('id_archivos_normativas','integer');
		$this->var->add_def_cols('nombre_archivo','varchar');
		$this->var->add_def_cols('descripcion_archivo','varchar');
		$this->var->add_def_cols('fecha_registro','date');
		$this->var->add_def_cols('ruta_archivo','varchar');
		$this->var->add_def_cols('id_detalle_normativa','integer');
		
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
	function ContarArchivoNormativa($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'comunidad.f_com_archivos_normativas_sel';
		$this->codigo_procedimiento = "'CO_ARCHNORM_COUNT'";

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
        /*echo $this-> query;
        exit;*/
		//Retorna el resultad   de la ejecuci�n
		return $res;
	}
	
	
	
	/**
	 * Nombre de la funci�n:	InsertarNormativas
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla comunidad.com_normativa_interna
	 * Autor:				    (Morgan Huascar Checa Lopez)
	 * Fecha de creaci�n:		15-05-2013
	 * Descripci�n:             
	
	 */
	function InsertarArchivoNormativa($id_archivos_normativas, $nombre_archivo, $descripcion_archivo, $id_detalle_normativa,$ruta_archivo )
	{
		$this->salida = "";
		$this->nombre_funcion = 'comunidad.f_com_archivos_normativas_iud';
		$this->codigo_procedimiento = "'CO_ARCHNORM_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param(0);
		$this->var->add_param("'$nombre_archivo'");
		$this->var->add_param("'$descripcion_archivo'");
		$this->var->add_param("'$id_detalle_normativa'");
		$this->var->add_param("'$ruta_archivo'");
	
		
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
	 * Nombre de la funci�n:	ModificarNormativas
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla comunidad.com_normativa_interna
	 * Autor:				    Morgan Huascar Checa Lopez
	 * Fecha de creaci�n:		16-05-2013
	 */
	function ModificarArchivoNormativa($id_archivos_normativas, $nombre_archivo, $descripcion_archivo, $id_detalle_normativa,$ruta_archivo )
	{
		$this->salida = "";
		$this->nombre_funcion = 'comunidad.f_com_archivos_normativas_iud';
		$this->codigo_procedimiento = "'CO_ARCHNORM_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		//$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_archivos_normativas);
		$this->var->add_param("'$nombre_archivo'");
		$this->var->add_param("'$descripcion_archivo'");
		$this->var->add_param("'$id_detalle_normativa'");
		$this->var->add_param("'$ruta_archivo'");
	
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
	function EliminarArchivoNormativa($id_archivos_normativas)
	{
		$this->salida = "";
		$this->nombre_funcion = 'comunidad.f_com_archivos_normativas_iud';
		$this->codigo_procedimiento = "'CO_ARCHNORM_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_archivos_normativas);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param(0);
		$this->var->add_param("NULL");

		

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