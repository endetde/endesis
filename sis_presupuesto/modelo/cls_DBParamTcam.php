<?php
/**
 * Nombre de la clase:	cls_DBParamTcam.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpr_tpr_param_tcam
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-08-14 18:05:58
 */

 
class cls_DBParamTcam
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
	 * Nombre de la funci�n:	ListarTipoCambio
	 * Prop�sito:				Desplegar los registros de tpr_param_tcam
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-14 18:05:58
	 */
	function ListarTipoCambio($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_param_tcam_sel';
		$this->codigo_procedimiento = "'PR_TCAMBIO_SEL'";

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
		$this->var->add_def_cols('id_param_tcam','int4');
		$this->var->add_def_cols('id_parametro','int4');
		$this->var->add_def_cols('desc_parametro','numeric');
		$this->var->add_def_cols('id_moneda_int','int4');
		$this->var->add_def_cols('desc_moneda','varchar');
		$this->var->add_def_cols('tipo_cambio','numeric');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarTipoCambio
	 * Prop�sito:				Contar los registros de tpr_param_tcam
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-14 18:05:58
	 */
	function ContarTipoCambio($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_param_tcam_sel';
		$this->codigo_procedimiento = "'PR_TCAMBIO_COUNT'";

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
	 * Nombre de la funci�n:	InsertarTipoCambio
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_param_tcam
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-14 18:05:58
	 */
	function InsertarTipoCambio($id_param_tcam,$id_parametro,$id_moneda_int,$tipo_cambio)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_param_tcam_iud';
		$this->codigo_procedimiento = "'PR_TCAMBIO_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		//$this->var->add_param($id_param_tcam);
		$this->var->add_param($id_parametro);
		$this->var->add_param($id_moneda_int);
		$this->var->add_param($tipo_cambio);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarTipoCambio
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpr_param_tcam
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-14 18:05:58
	 */
	function ModificarTipoCambio($id_param_tcam,$id_parametro,$id_moneda_int,$tipo_cambio)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_param_tcam_iud';
		$this->codigo_procedimiento = "'PR_TCAMBIO_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_param_tcam);
		$this->var->add_param($id_parametro);
		$this->var->add_param($id_moneda_int);
		$this->var->add_param($tipo_cambio);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarTipoCambio
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_param_tcam
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-14 18:05:58
	 */
	function EliminarTipoCambio($id_param_tcam)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_param_tcam_iud';
		$this->codigo_procedimiento = "'PR_TCAMBIO_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_param_tcam);
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
	 * Nombre de la funci�n:	ValidarTipoCambio
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpr_param_tcam
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-14 18:05:58
	 */
	function ValidarTipoCambio($operacion_sql,$id_param_tcam,$id_parametro,$id_moneda_int,$tipo_cambio)
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
				//Validar id_param_tcam - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_param_tcam");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_param_tcam", $id_param_tcam))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_parametro - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_parametro");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_parametro", $id_parametro))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_moneda_int - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_moneda_int");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_moneda_int", $id_moneda_int))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar tipo_cambio - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("tipo_cambio");
			$tipo_dato->set_MaxLength(983046);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "tipo_cambio", $tipo_cambio))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_param_tcam - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_param_tcam");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_param_tcam", $id_param_tcam))
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