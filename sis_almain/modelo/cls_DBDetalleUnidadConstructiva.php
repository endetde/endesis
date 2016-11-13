<?php
/**
 * Nombre de la Clase:	cls_DBDetalleUnidadConstructiva
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tal_detalle_unidad_constructiva
 * Autor:				UNKNOW
 * Fecha creaci�n:		14-08/2014
 *
 */
class cls_DBDetalleUnidadConstructiva 
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
	var $nombre_archivo = "cls_DBDetalleUnidadConstructiva.php";
	// Matriz de par�metros de validaci�n de todas las columnas
	var $matriz_validacion = array ();
	// Bandera que indica si los datos se decodificar�n o no
	var $decodificar = false;
	function __construct() {
		// Carga los par�metro de validaci�n de todas las columnas
		// Carga en una variable interna la bandera del GET o POST
		$this->decodificar = $decodificar;
	}
	
	/**
	 * Nombre de la funci�n:	ListarDetalleUnidadConstructiva
	 * Prop�sito:				Desplegar los registros de tal_detalle_unidad_constructiva en funci�n de los par�metros del filtro
	 * Autor:					UNKNOW
	 * Fecha de creaci�n:		14-08-2014
	 *
	 * @param unknown_type $cant        	
	 * @param unknown_type $puntero        	
	 * @param unknown_type $sortcol        	
	 * @param unknown_type $sortdir        	
	 * @param unknown_type $criterio_filtro        	
	 * @param unknown_type $id_financiador        	
	 * @param unknown_type $id_regional        	
	 * @param unknown_type $id_programa        	
	 * @param unknown_type $id_proyecto        	
	 * @param unknown_type $id_actividad        	
	 * @return unknown
	 */
	function ListarDetalleUnidadConstructiva($cant, $puntero, $sortcol, $sortdir, $criterio_filtro, $id_financiador, $id_regional, $id_programa, $id_proyecto, $id_actividad) {
		
		$this->salida = "";
		$this->nombre_funcion = 'f_tai_detalle_unidad_constructiva_sel';
		$this->codigo_procedimiento = "'AL_DETUNICONST_SEL'";
		
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
		$this->var->add_def_cols('id_detalle_unidad_constructiva', 'integer');
		$this->var->add_def_cols('id_unidad_constructiva', 'integer');
		$this->var->add_def_cols('desc_unidad_constructiva', 'text');
		$this->var->add_def_cols('id_item', 'integer');
		$this->var->add_def_cols('desc_item', 'text');
		$this->var->add_def_cols('id_unidad_medida', 'integer'); 
		$this->var->add_def_cols('nombre_unidad','varchar');
		$this->var->add_def_cols('cantidad', 'numeric');
		$this->var->add_def_cols('descripcion', 'varchar');
		$this->var->add_def_cols('estado_registro', 'varchar');
		$this->var->add_def_cols('orden', 'integer');
		$this->var->add_def_cols('usuario_reg', 'varchar');
		$this->var->add_def_cols('fecha_reg', 'text'); 
		
		
		// Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
		// Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		// Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	/**
	 * Nombre de la funci�n:	CountDetalleUnidadConstructiva
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					UNKNOW
	 * Fecha de creaci�n:		14-08-2014
	 *
	 * @param unknown_type $cant        	
	 * @param unknown_type $puntero        	
	 * @param unknown_type $sortcol        	
	 * @param unknown_type $sortdir        	
	 * @param unknown_type $criterio_filtro        	
	 * @param unknown_type $id_financiador        	
	 * @param unknown_type $id_regional        	
	 * @param unknown_type $id_programa        	
	 * @param unknown_type $id_proyecto        	
	 * @param unknown_type $id_actividad        	
	 * @return unknown
	 */
	function CountDetalleUnidadConstructiva($cant, $puntero, $sortcol, $sortdir, $criterio_filtro, $id_financiador, $id_regional, $id_programa, $id_proyecto, $id_actividad) {
		
		
		$this->salida = "";
		$this->nombre_funcion = 'f_tai_detalle_unidad_constructiva_sel';
		$this->codigo_procedimiento = "'AL_DETUNICONST_COUNT'";
	
		
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
	/**
	 * Nombre de la funci�n:	EliminarDetalleUnidadConstructiva
	 * Prop�sito:				Eliminar registros de la tabla tal_detalle_unidad_constructiva mediante filtros
	 *-Autor:					UNKNOW
	 -* Fecha de creaci�n:		14-08-2014		
	 */
	function EliminarDetalleUnidadConstructiva($id_detalle_unidad_constructiva)
	 {
		$this->salida = "";
		$this->nombre_funcion = 'f_tai_detalle_unidad_constructiva_iud';
		$this->codigo_procedimiento = "'AL_DETUNICONS_DEL'";
		
		// Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion, $this->codigo_procedimiento, $this->decodificar);
		// Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_detalle_unidad_constructiva"); 
		$this->var->add_param("NULL"); // id de clasificacion
		$this->var->add_param("NULL"); // id de unidad medida
		$this->var->add_param("NULL"); // nombre
		$this->var->add_param("NULL"); // descripcion
		
		$this->var->add_param("NULL");//al_orden

		                              
		// Ejecuta la funci�n
		$res = $this->var->exec_non_query();
		
		// Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		// Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	function InsertarDetalleUnidadConstructiva($id_detalle_unidad_constructiva, $id_unidad_constructiva, $id_item, $cantidad, $descripcion,$orden_duc){
		$this->salida = "";
		$this->nombre_funcion = 'f_tai_detalle_unidad_constructiva_iud';
		$this->codigo_procedimiento = "'AL_DETUNICONS_INS'";
		
		// Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion, $this->codigo_procedimiento, $this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_unidad_constructiva);
		$this->var->add_param($id_item);
		$this->var->add_param("'$cantidad'");
		$this->var->add_param("'$descripcion'");
		
		$this->var->add_param($orden_duc);//al_orden
		
		
		// Ejecuta la funci�n
		$res = $this->var->exec_non_query();
		// Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		// Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	//insercion de items por unidades constructivas
	function InsertarDetalleUnidadConstructivaItem($id_unidad_constructiva,$id_item,$cantidad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tai_detalle_unidad_constructiva_iud';
		$this->codigo_procedimiento = "'AL_DETUNICONS_INSITEM'";
		
		// Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion, $this->codigo_procedimiento, $this->decodificar);
		$this->var->add_param("NULL");//al_id_detalle_unidad_constructiva
		$this->var->add_param($id_unidad_constructiva);//al_id_unidad_constructiva
		$this->var->add_param($id_item);//al_id_item
		$this->var->add_param("'$cantidad'");//al_cantidad
		$this->var->add_param("NULL");//al_descripcion
		$this->var->add_param("NULL");//al_orden
		
		
		// Ejecuta la funci�n
		$res = $this->var->exec_non_query();
		// Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		// Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	//fin insercion de items por unidades constructivas
	
	function ModificarDetalleUnidadConstructiva($id_detalle_unidad_constructiva, $id_unidad_constructiva, $id_item, $cantidad, $descripcion,$orden_duc)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tai_detalle_unidad_constructiva_iud';
		$this->codigo_procedimiento = "'AL_DETUNICONS_UPD'";
		
		// Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion, $this->codigo_procedimiento, $this->decodificar);
		
		$this->var->add_param($id_detalle_unidad_constructiva);
		$this->var->add_param($id_unidad_constructiva);
		$this->var->add_param($id_item);
		$this->var->add_param("'$cantidad'");
		$this->var->add_param("'$descripcion'");
		
		$this->var->add_param($orden_duc);//al_orden
		
		// Ejecuta la funci�n
		$res = $this->var->exec_non_query();
		// Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		// Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	function ValidarDestalleUnidadConstructiva($operacion_sql, $id_detalle_unidad_constructiva, $id_unidad_constructiva, $id_item, $cantidad, $descripcion)
	{
		$this->salida = "";
		$valid = new cls_validacion_serv();
		
		// Clase para validar el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();
		
		// Ejecuta la validaci�n por el tipo de operaci�n
		if ($operacion_sql == 'insert' || $operacion_sql == 'update') 
		{
			if ($operacion_sql == 'update') {
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_detalle_unidad_constructiva");
				
				if (! $valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_detalle_unidad_constructiva", $id_detalle_unidad_constructiva)) {
					$this->salida = $valid->salida;
					return false;
				}
			}
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_unidad_constructiva");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if (! $valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_unidad_constructiva", $id_unidad_constructiva)) {
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_item");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if (! $valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_item", $id_item)) {
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("cantidad");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if (! $valid->verifica_dato($tipo_dato->TipoDatoReal(), "cantidad", $cantidad)) {
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(100);
			$tipo_dato->set_AllowBlank(true);
			if (! $valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion)) 
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			return true;
		} 
		else 
		{
			return false;
		}
	}
}
?>
