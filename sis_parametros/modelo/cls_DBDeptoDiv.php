<?php
/**
 * Nombre de la clase:	cls_DBDeptoDiv.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpm_tpm_depto_ep
 * Autor:				Silvia Ximena Ortiz Fern�ndez
 * Fecha creaci�n:		16-02-2011
 */

class cls_DBDeptoDiv
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
	 * Nombre de la funci�n:	ListarDepartamentoUo
	 * Prop�sito:				Desplegar los registros de tpm_depto_ep
	 * Autor:				    Silvia Ximena Ortiz Fern�ndez
	 * Fecha de creaci�n:		16-02-2011
	 */
	function ListarDepartamentoDiv($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_depto_division_sel';
		$this->codigo_procedimiento = "'PM_DEPDIV_SEL'";

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
		$this->var->add_def_cols('id_depto_division','int4');
		$this->var->add_def_cols('id_depto','int4');
		$this->var->add_def_cols('desc_depto','text');
		$this->var->add_def_cols('codigo_division','varchar');
		$this->var->add_def_cols('division','varchar');
		$this->var->add_def_cols('estado','varchar');		
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//echo $this->query;
		//exit;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarDepartamentoEP
	 * Prop�sito:				Contar los registros de tpm_depto_ep
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2009-01-23 10:58:13
	 */
	function ContarDepartamentoDiv($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_depto_division_sel';
		$this->codigo_procedimiento = "'PM_DEPDIV_COUNT'";

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
	 * Nombre de la funci�n:	InsertarDepartamentoUo
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpm_depto_ep
	 * Autor:				    Silvia Ximena Ortiz Fernandez
	 * Fecha de creaci�n:		16-02-2011
	 */
	function InsertarDepartamentoDiv($id_depto,$codigo_division,$division,$estado)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_depto_division_iud';
		$this->codigo_procedimiento = "'PM_DEPDIV_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_depto);
		$this->var->add_param("'$codigo_division'");
		$this->var->add_param("'$division'");
		$this->var->add_param("'$estado'");
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarDepartamentoUo
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_unidad_organizacional
	 * Autor:				    Silvia Ximena Ortiz Fern�ndez
	 * Fecha de creaci�n:		16-02-2011
	 */
	function ModificarDepartamentoDiv($id_depto_division,$id_depto,$codigo_division,$division,$estado)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_depto_division_iud';
		$this->codigo_procedimiento = "'PM_DEPDIV_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_depto_division);
		$this->var->add_param($id_depto);
		$this->var->add_param("'$codigo_division'");
		$this->var->add_param("'$division'");
		$this->var->add_param("'$estado'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarDepartamentoUo
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tkp_unidad_organizacional
	 * Autor:				    Silvia Ximena Ortiz Fern�ndez
	 * Fecha de creaci�n:		16-02-2011
	 */
	function EliminarDepartamentoDiv($id_depto_division)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_depto_division_iud';
		$this->codigo_procedimiento = "'PM_DEPDIV_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_depto_division);
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
		//echo $this->query;
		//exit;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarDepartamentoUo
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tkp_unidad_organizacional
	 * Autor:				    Silvia Ximena Ortiz Fern�ndez
	 * Fecha de creaci�n:		16-02-2011
	 */
	function ValidarDepartamentoDiv($operacion_sql,$id_depto_division,$id_depto,$codigo_division,$division,$estado)
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
				//Validar id_depto_division - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_depto_division");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_depto_division", $id_depto_division))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_depto - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_depto");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_depto", $id_depto))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_ep - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("division");
			$tipo_dato->set_MaxLength(100);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "division", $division))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar estado - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado", $estado))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_depto_ep - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_depto_division");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_depto_division", $id_depto_division))
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