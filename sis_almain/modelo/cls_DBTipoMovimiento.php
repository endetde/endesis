<?php
/**
 * Nombre de la Clase:	cls_DBTipoMovimiento
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tal_tipo_movimiento
 * Autor:				Ariel Ayavir Omonte
 * Fecha creaci�n:		25-07-2013
 *
 */
class cls_DBTipoMovimiento {
	var $salida;
	var $query;
	// Variables para la ejecuci�n de funciones
	var $var; // middle_client
	var $nombre_funcion; // nombre de la funci�n a ejecutar
	var $codigo_procedimiento; // codigo del procedimiento a ejecutar
	                           
	// Nombre del archivo
	var $nombre_archivo = "cls_DBTipoMovimiento.php";
	
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
	function ListarTipoMovimiento($cant, $puntero, $sortcol, $sortdir, $criterio_filtro, $id_financiador, $id_regional, $id_programa, $id_proyecto, $id_actividad) {
		$this->salida = "";
		$this->nombre_funcion = 'f_tai_tipo_movimiento_sel';
		$this->codigo_procedimiento = "'AL_TIPMOV_SEL'";
		
		$func = new cls_funciones();
		
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
		$this->var->add_def_cols('usuario_reg', 'varchar');
		$this->var->add_def_cols('fecha_reg', 'text');
		$this->var->add_def_cols('id_tipo_movimiento', 'integer');
		$this->var->add_def_cols('id_documento', 'integer');
		$this->var->add_def_cols('tipo', 'varchar');
		$this->var->add_def_cols('requiere_aprobacion', 'varchar');
		$this->var->add_def_cols('codigo_documento', 'varchar');
		$this->var->add_def_cols('descripcion_documento', 'varchar');
		$this->var->add_def_cols('documento', 'varchar');
		
		// Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
		
		// Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		// Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	function ContarTipoMovimiento($cant, $puntero, $sortcol, $sortdir, $criterio_filtro, $id_financiador, $id_regional, $id_programa, $id_proyecto, $id_actividad) {
		$this->salida = "";
		$this->nombre_funcion = 'f_tai_tipo_movimiento_sel';
		$this->codigo_procedimiento = "'AL_TIPMOV_COUNT'";
		
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
	function InsertarTipoMovimiento($id_documento, $tipo, $requiere_aprobacion) {
		$this->salida = "";
		$this->nombre_funcion = 'f_tai_tipo_movimiento_iud';
		$this->codigo_procedimiento = "'AL_TIPMOV_INS'";
		
		// Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion, $this->codigo_procedimiento, $this->decodificar);
		
		$this->var->add_param("NULL");
		$this->var->add_param($id_documento);
		$this->var->add_param("'$tipo'");
		$this->var->add_param("'$requiere_aprobacion'");
		
		// Ejecuta la funci�n
		$res = $this->var->exec_non_query();
		
		// Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		// Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	function ModificarTipoMovimiento($id_tipo_movimiento, $id_documento, $tipo, $requiere_aprobacion) {
		$this->salida = "";
		$this->nombre_funcion = 'f_tai_tipo_movimiento_iud';
		$this->codigo_procedimiento = "'AL_TIPMOV_UPD'";
		
		// Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion, $this->codigo_procedimiento, $this->decodificar);
		
		$this->var->add_param($id_tipo_movimiento);
		$this->var->add_param($id_documento);
		$this->var->add_param("'$tipo'");
		$this->var->add_param("'$requiere_aprobacion'");
		
		// Ejecuta la funci�n
		$res = $this->var->exec_non_query();
		
		// Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		// Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	function EliminarTipoMovimiento($id_tipo_movimiento) {
		$this->salida = "";
		$this->nombre_funcion = 'f_tai_tipo_movimiento_iud';
		$this->codigo_procedimiento = "'AL_TIPMOV_DEL'";
		
		// Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion, $this->codigo_procedimiento, $this->decodificar);
		
		// Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_tipo_movimiento");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		// Ejecuta la funci�n
		$res = $this->var->exec_non_query();
		
		// Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		// Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	function ValidarTipoMovimiento($operacion_sql, $id_tipo_movimiento, $id_documento, $tipo, $requiere_aprobacion) {
		$this->salida = "";
		$valid = new cls_validacion_serv();
		
		// Clase para validar el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();
		
		// Ejecuta la validaci�n por el tipo de operaci�n
		if ($operacion_sql == 'insert' || $operacion_sql == 'update') {
			if ($operacion_sql == 'update') {
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_tipo_movimiento");
				
				if (! $valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_movimiento", $id_tipo_movimiento)) {
					$this->salida = $valid->salida;
					return false;
				}
			}
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_documento");
			$tipo_dato->set_MinLength(2);
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if (! $valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_documento", $id_documento)) {
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("tipo");
			$tipo_dato->set_MaxLength(100);
			$tipo_dato->set_AllowBlank(true);
			if (! $valid->verifica_dato($tipo_dato->TipoDatoText(), "tipo", $tipo)) {
				$this->salida = $valid->salida;
				return false;
			}
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("requiere_aprobacion");
			$tipo_dato->set_MaxLength(2);
			$tipo_dato->set_AllowBlank(false);
			if (! $valid->verifica_dato($tipo_dato->TipoDatoText(), "requiere_aprobacion", $requiere_aprobacion)) {
				$this->salida = $valid->salida;
				return false;
			}
			//validaci�n exitosa
			return true;
		} elseif ($operacion_sql == 'delete') {
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_tipo_movimiento");
			
			if (! $valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_movimiento", $id_tipo_movimiento)) {
				$this->salida = $valid->salida;
				return false;
			}
			
			return true;
		} else {
			return false;
		}
	}
}
?>
