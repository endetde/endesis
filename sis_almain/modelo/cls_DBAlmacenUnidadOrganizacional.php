<?php
/**
 * Nombre de la Clase:	cls_DBAlmacenUnidadOrganizacional
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tal_fase
 * Autor:				UNKNOW
 * Fecha creaci�n:		01-12-2014
 *
 */
class cls_DBAlmacenUnidadOrganizacional
{
	// Variable que contiene la salida de la ejecuci�n de la funci�n
	// si la funci�n tuvo error (false), salida contendr� el mensaje de error
	// si la funci�n no tuvo error (true), salida contendr� el resultado, ya sea un conjunto de datos o un mensaje de confirmaci�n
	var $salida;
	
	// Variable que contedr� la cadena de llamada a las funciones postgres
	var $query;
	
	// Variables para la ejecuci�n de funciones
	var $var; // middle_client
	var $nombre_funcion; // nombre de la funci�n a ejecutar
	var $codigo_procedimiento; // codigo del procedimiento a ejecutar
	                           
	// Nombre del archivo
	var $nombre_archivo = "cls_DBAlmacenUnidadOrganizacional.php";
	
	// Matriz de par�metros de validaci�n de todas las columnas
	var $matriz_validacion = array ();
	
	// Bandera que indica si los datos se decodificar�n o no
	var $decodificar = false;
	function __construct() {
		// Carga los par�metro de validaci�n de todas las columnas
		// $this->cargar_param_valid();
		
		// Carga en una variable interna la bandera del GET o POST
		$this->decodificar = $decodificar;
	}
	
	function ListarAlmacenUnidadOrganizacional($cant, $puntero, $sortcol, $sortdir, $criterio_filtro) 
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tai_almacen_unidad_org_sel';
		$this->codigo_procedimiento = "'AL_ALMUO_SEL'";
		
		$func = new cls_funciones(); // Instancia de las funciones generales
		                             
		// Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion, $this->codigo_procedimiento);
		
		// Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";
		
		// Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '', "'%'", $id_financiador)); // id_financiador
		$this->var->add_param($func->iif($id_regional == '', "'%'", $id_regional)); // id_regional
		$this->var->add_param($func->iif($id_programa == '', "'%'", $id_programa)); // id_programa
		$this->var->add_param($func->iif($id_proyecto == '', "'%'", $id_proyecto)); // id_proyecto
		$this->var->add_param($func->iif($id_actividad == '', "'%'", $id_actividad)); // id_actividad
		                                                                              
		// Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('fecha_reg', 'text');
		$this->var->add_def_cols('usuario_reg', 'varchar');
		$this->var->add_def_cols('estado', 'varchar');
		$this->var->add_def_cols('id_almacen', 'integer');
		$this->var->add_def_cols('desc_almacen', 'text');
		$this->var->add_def_cols('id_unidad_organizacional', 'integer');
		$this->var->add_def_cols('nombre_unidad', 'varchar');
		$this->var->add_def_cols('descripcion_uo', 'varchar');
		$this->var->add_def_cols('id_almacen_unidad_org', 'integer');
		$this->var->add_def_cols('fecha_desde', 'text');
		$this->var->add_def_cols('fecha_hasta', 'text');

		// Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
		
		// Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		// Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	function ContarAlmacenUnidadOrganizacional($cant, $puntero, $sortcol, $sortdir, $criterio_filtro) 
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tai_almacen_unidad_org_sel';
		$this->codigo_procedimiento = "'AL_ALMUO_COUNT'";
		
		$func = new cls_funciones(); // Instancia de las funciones generales
		                             
		// Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion, $this->codigo_procedimiento);
		
		// Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero; 
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";
		
		// Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '', "'%'", $id_financiador)); // id_financiador
		$this->var->add_param($func->iif($id_regional == '', "'%'", $id_regional)); // id_regional
		$this->var->add_param($func->iif($id_programa == '', "'%'", $id_programa)); // id_programa
		$this->var->add_param($func->iif($id_proyecto == '', "'%'", $id_proyecto)); // id_proyecto
		$this->var->add_param($func->iif($id_actividad == '', "'%'", $id_actividad)); // id_actividad
		                                                                              
		// Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('total', 'bigint');
		
		// Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
		
		// Obtiene el array de salida de la funci�n
		$this->salida = $this->var->salida;
		
		// Si la ejecuci�n fue satisfactoria modifica la salida para que solo devuelva el total de la consulta
		if ($res) {
			$this->salida = $this->var->salida[0][0];
		}
		
		// Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	
		// Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	
	function EliminarAlmacenUnidadOrganizacional($id) {
		$this->salida = "";
		$this->nombre_funcion = 'f_tai_almacen_unidad_org_iud';
		$this->codigo_procedimiento = "'AL_ALMUO_DEL'";
		
		// Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion, $this->codigo_procedimiento, $this->decodificar);
		
		// Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param($id);//al_id_almacen_uo
		$this->var->add_param("NULL");//al_id_almacen
		$this->var->add_param("NULL");//al_id_uo
		$this->var->add_param("NULL");//desde
		$this->var->add_param("NULL");//hasta
		 		                               
		// Ejecuta la funci�n
		$res = $this->var->exec_non_query();
		
		// Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		// Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	
	
	function InsertarAlmacenUnidadOrganizacional($id_almacen, $id_uo, $desde, $hasta)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tai_almacen_unidad_org_iud';
		$this->codigo_procedimiento = "'AL_ALMUO_INS'";
	
		// Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion, $this->codigo_procedimiento, $this->decodificar);
		$this->var->add_param("NULL");//al_id_almacen_uo
		$this->var->add_param($id_almacen);//al_id_almacen
		$this->var->add_param($id_uo);//al_id_uo
		$this->var->add_param("'$desde'");//desde
		$this->var->add_param("'$hasta'");//hasta

		// Ejecuta la funci�n
		$res = $this->var->exec_non_query();
		
		// Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		// Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	function ModificarAlmacenUnidadOrganizacional($id,$id_almacen, $id_uo, $desde, $hasta)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tai_almacen_unidad_org_iud';
		$this->codigo_procedimiento = "'AL_ALMUO_UPD'";
		
		// Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion, $this->codigo_procedimiento, $this->decodificar);
	
		$this->var->add_param($id);//al_id_almacen_uo
		$this->var->add_param($id_almacen);//al_id_almacen
		$this->var->add_param($id_uo);//al_id_uo
		$this->var->add_param("'$desde'");//desde
		$this->var->add_param("'$hasta'");//hasta
		
		
		// Ejecuta la funci�n
		$res = $this->var->exec_non_query();
		
		// Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		// Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}

	
}
?>
