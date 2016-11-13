<?php
/**
 * Nombre de la clase:	cls_DBAccion.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tfl_accion
 * Autor:				Silvia Ximena Ortiz Fern�ndez
 * Fecha creaci�n:		2010-12-27 15:36:51
 */

 
/*
* Se deben poner en comentario las funcion de selecci�n
* No se ha realizado ning�n cambio sobre esta clase.
*
* */

class cls_DBAccion
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
	 * Nombre de la funci�n:	ListarAccion
	 * Prop�sito:				Desplegar los registros de tfl_accion
	 * Autor:				    Silvia Ximena Ortiz Fern�ndez
	 * Fecha de creaci�n:		2010-12-27 15:36:51
	 */
	
	function ListarAccion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfl_accion_sel';
		$this->codigo_procedimiento = "'FL_ACCION_SEL'";

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
		$this->var->add_def_cols('id_accion','int4');
		$this->var->add_def_cols('id_tipo_accion','int4');
		$this->var->add_def_cols('id_tipo_circuito','int4');
		$this->var->add_def_cols('id_usuario_reg','int4');	
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('detalle_accion','text');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		exit();*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarAccion
	 * Prop�sito:				Contar los registros de tfl_accion
	 * Autor:				    Silvia Ximena Ortiz Fern�ndez
	 * Fecha de creaci�n:		2010-12-27 15:50:51
	 */
	function ContarAccion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfl_accion_sel';
		$this->codigo_procedimiento = "'FL_ACCION_COUNT'";

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
	 * Nombre de la funci�n:	InsertarAccion
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tfl_accion
	 * Autor:				    Silvia Ximena Ortiz Fern�ndez
	 * Fecha de creaci�n:		2010-12-23 15:50:51
	 */
	
	function InsertarAccion($id_tipo_accion, $id_tipo_circuito,$detalle_accion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfl_accion_iud';
		$this->codigo_procedimiento = "'FL_ACCION_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$id_tipo_accion'");
		$this->var->add_param("'$id_tipo_circuito'");
		$this->var->add_param("'$detalle_accion'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
       
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarAccion
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tfl_tipo_circuito
	 * Autor:				    Silvia Ximena Ortiz Fern�ndez
	 * Fecha de creaci�n:		2010-12-27 15:52:51
	 */
	function ModificarAccion($id_accion,$id_tipo_accion, $id_tipo_circuito,$detalle_accion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfl_accion_iud';
		$this->codigo_procedimiento = "'FL_ACCION_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("'$id_accion'");
		$this->var->add_param("'$id_tipo_accion'");
		$this->var->add_param("'$id_tipo_circuito'");
		$this->var->add_param("'$detalle_accion'");
	
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
	 * Nombre de la funci�n:	EliminarAccion
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tfl_accion
	 * Autor:				    Silvia Ximena Ortiz Fern�ndez
	 * Fecha de creaci�n:		2008-05-07 15:34:51
	 */
	function EliminarAccion($id_accion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfl_accion_iud';
		$this->codigo_procedimiento = "'FL_ACCION_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_accion);
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
	 * Nombre de la funci�n:	ValidarAccion
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tf_accion
	 * Autor:				    Silvia Ximena Ortiz Fern�ndez
	 * Fecha de creaci�n:		2012-12-27 15:54:51
	 */
	function ValidarAccion($operacion_sql,$id_accion, $id_tipo_accion, $id_tipo_circuito)
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
				//Validar id_accion - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_accion");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_accion", $id_accion))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_tipo_accion int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_Columna("id_tipo_accion");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_accion", $id_tipo_accion))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar id_tipo_nodo - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_tipo_circuito");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_circuito", $id_tipo_circuito))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_accion - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_accion");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_accion", $id_accion))
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
