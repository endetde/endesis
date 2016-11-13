<?php
/**
 * Nombre de la clase:	cls_DBCorrelativo.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tal_tal_correlativo
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-10-18 15:38:49
 */

class cls_DBCorrelativo
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
	 * Nombre de la funci�n:	ListarCorrelativo
	 * Prop�sito:				Desplegar los registros de tal_correlativo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-18 15:38:49
	 */
	function ListarCorrelativo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_correlativo_sel';
		$this->codigo_procedimiento = "'AL_CORREL_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

		//Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '',"'%'","'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'","'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'","'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'","'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'","'$id_actividad'"));//id_actividad

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_correlativo','int4');
		$this->var->add_def_cols('codigo','varchar');
		$this->var->add_def_cols('prefijo','varchar');
		$this->var->add_def_cols('sufijo','varchar');
		$this->var->add_def_cols('valor_actual','int4');
		$this->var->add_def_cols('valor_siguiente','int4');
		$this->var->add_def_cols('incremento','int4');
		$this->var->add_def_cols('id_parametro_almacen','int4');
		$this->var->add_def_cols('desc_parametro_almacen','int4');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarCorrelativo
	 * Prop�sito:				Contar los registros de tal_correlativo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-18 15:38:49
	 */
	function ContarCorrelativo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_correlativo_sel';
		$this->codigo_procedimiento = "'AL_CORREL_COUNT'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

		//Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '',"'%'","'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'","'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'","'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'","'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'","'$id_actividad'"));//id_actividad

		
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
	 * Nombre de la funci�n:	InsertarCorrelativo
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_correlativo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-18 15:38:49
	 */
	function InsertarCorrelativo($id_correlativo,$codigo,$prefijo,$sufijo,$valor_actual,$valor_siguiente,$incremento,$id_parametro_almacen)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_correlativo_iud';
		$this->codigo_procedimiento = "'AL_CORREL_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$codigo'");
		$this->var->add_param("'$prefijo'");
		$this->var->add_param("'$sufijo'");
		$this->var->add_param($valor_actual);
		$this->var->add_param($valor_siguiente);
		$this->var->add_param($incremento);
		$this->var->add_param($id_parametro_almacen);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarCorrelativo
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_correlativo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-18 15:38:49
	 */
	function ModificarCorrelativo($id_correlativo,$codigo,$prefijo,$sufijo,$valor_actual,$valor_siguiente,$incremento,$id_parametro_almacen)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_correlativo_iud';
		$this->codigo_procedimiento = "'AL_CORREL_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_correlativo);
		$this->var->add_param("'$codigo'");
		$this->var->add_param("'$prefijo'");
		$this->var->add_param("'$sufijo'");
		$this->var->add_param($valor_actual);
		$this->var->add_param($valor_siguiente);
		$this->var->add_param($incremento);
		$this->var->add_param($id_parametro_almacen);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarCorrelativo
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_correlativo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-18 15:38:49
	 */
	function EliminarCorrelativo($id_correlativo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_correlativo_iud';
		$this->codigo_procedimiento = "'AL_CORREL_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_correlativo);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
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
	 * Nombre de la funci�n:	ValidarCorrelativo
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tal_correlativo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-18 15:38:49
	 */
	function ValidarCorrelativo($operacion_sql,$id_correlativo,$tabla,$prefijo,$sufijo,$valor_actual,$valor_siguiente,$incremento,$id_parametro_almacen)
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
				//Validar id_correlativo - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_correlativo");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_correlativo", $id_correlativo))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar tabla - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("codigo");
			$tipo_dato->set_MaxLength(20);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "codigo", $codigo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar prefijo - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("prefijo");
			$tipo_dato->set_MaxLength(25);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "prefijo", $prefijo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar sufijo - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("sufijo");
			$tipo_dato->set_MaxLength(25);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "sufijo", $sufijo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar valor_actual - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("valor_actual");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "valor_actual", $valor_actual))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar valor_siguiente - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("valor_siguiente");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "valor_siguiente", $valor_siguiente))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar incremento - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("incremento");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "incremento", $incremento))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_parametro_almacen - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_parametro_almacen");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_parametro_almacen", $id_parametro_almacen))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_correlativo - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_correlativo");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_correlativo", $id_correlativo))
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