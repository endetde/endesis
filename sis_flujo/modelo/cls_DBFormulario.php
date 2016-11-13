<?php
/**
 * Nombre de la clase:	cls_DBTipoNodo.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tfl_tipo_nodo
 * Autor:				Ariel Ayaviri Omonte
 * Fecha creaci�n:		2010-12-22 17:04:51
 */

 
/*
* Se deben poner en comentario las funcion de selecci�n
* No se ha realizado ning�n cambio sobre esta clase.
*
* */
class cls_DBFormulario
{
	var $salida;
	var $query;
	var $var;
	var $nombre_funcion;
	var $codigo_procedimiento;
	var $decodificar;
	
	function __construct()
	{
		$this->decodificar=$decodificar;
	}
	
	/**
	 * Nombre de la funci�n:	ListarTipoNod
	 * Prop�sito:				Desplegar los registros de tfl_tipo_nodo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-12-23 09:50:51
	 */
	
	
	function ListarFormulario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfl_formulario_sel';
		$this->codigo_procedimiento = "'FL_FORMUL_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_formulario','int4');
		$this->var->add_def_cols('id_tipo_formulario','int4');
		$this->var->add_def_cols('id_proceso','int4');
		$this->var->add_def_cols('id_depto','int4');
		$this->var->add_def_cols('numero_sis','varchar');
		$this->var->add_def_cols('fecha','date');
		$this->var->add_def_cols('estado_reg','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarTipoNodo
	 * Prop�sito:				Contar los registros de tfl_tipo_nod
	 * Autor:				    Ariel Ayaviri Omonte
	 * Fecha de creaci�n:		2010-12-23 09:59:51
	 */
	function ContarFormulario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfl_formulario_sel';
		$this->codigo_procedimiento = "'FL_FORMUL_COUNT'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
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
	 * Nombre de la funci�n:	InsertarTipoNodo
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tfl_tipo_nodo
	 * Autor:				    Ariel Ayaviri Omonte
	 * Fecha de creaci�n:		2010-12-23 10:17:51
	 */
	
	function InsertarFormulario($id_tipo_formulario,$id_proceso,$id_depto,$numero_sis)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfl_formulario_iud';
		$this->codigo_procedimiento = "'FL_FORMUL_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_tipo_formulario);
		$this->var->add_param($id_proceso);
		$this->var->add_param($id_depto);
		$this->var->add_param($numero_sis);
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarTipoNodo
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tfl_tipo_nod
	 * Autor:				    Ariel Ayaviri Omonte
	 * Fecha de creaci�n:		2010-12-23 10:16:51
	 */
	function ModificarFormulario($id_formulario,$id_tipo_formulario,$id_proceso,$id_depto,$numero_sis)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfl_formulario_iud';
		$this->codigo_procedimiento = "'FL_FORMUL_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_formulario);
		$this->var->add_param($id_tipo_formulario);
		$this->var->add_param($id_proceso);
		$this->var->add_param($id_depto);
		$this->var->add_param("'$numero_sis'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
      /* echo $this->query;
		exit;*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarTipoNodo
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tfl_tipo_nodo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-07 15:34:51
	 */
	function EliminarFormulario($id_formulario)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfl_formulario_iud';
		$this->codigo_procedimiento = "'FL_FORMUL_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_formulario);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	} 
	
	/**
	 * Nombre de la funci�n:	ValidarTipoAdq
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tad_tipo_adq
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-07 15:34:51
	 */
	function ValidarFormulario($operacion_sql,$id_formulario,$id_tipo_formulario,$id_proceso)
	{
		$this->salida = "";
		$valid = new cls_validacion_serv();

		//Clase para validar el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();
	
		//Ejecuta la validaci�n por el tipo de operaci�n
		if($operacion_sql=='insert' || $operacion_sql=='update')
		{
			if($operacion_sql == 'update')
			{
				//Validar id_tipo_adq - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_formulario");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_formulario", $id_formulario))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_tipo_formulario - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_Columna("id_tipo_formulario");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_formulario", $id_tipo_formulario))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_proceso - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_Columna("id_proceso");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_proceso", $id_proceso))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_tipo_adq - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_Columna("id_formulario");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_formulario", $id_formulario))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validaci�n exitosa
			return true;
		}
		else
		{
			return false;
		}
	}
}?>