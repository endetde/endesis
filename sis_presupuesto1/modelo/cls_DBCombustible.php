<?php
/**
 * Nombre de la clase:	cls_DBCombustible.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpr_tpr_combustible
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-11-04 11:21:47
 */

 
class cls_DBCombustible
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
	 * Nombre de la funci�n:	ListarCombustible
	 * Prop�sito:				Desplegar los registros de tpr_combustible
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-04 11:21:47
	 */
	function ListarCombustible($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_combustible_sel';
		$this->codigo_procedimiento = "'PR_COMBUS_SEL'";

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
		$this->var->add_def_cols('id_combustible','int4');
		$this->var->add_def_cols('id_parametro','int4');
		$this->var->add_def_cols('desc_parametro','numeric');
		$this->var->add_def_cols('id_moneda','int4');
		$this->var->add_def_cols('desc_moneda','varchar');
		$this->var->add_def_cols('consumo_preferencial','numeric');
		$this->var->add_def_cols('precio_preferencial','numeric');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('precio_mercado','numeric');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarCombustible
	 * Prop�sito:				Contar los registros de tpr_combustible
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-04 11:21:47
	 */
	function ContarCombustible($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_combustible_sel';
		$this->codigo_procedimiento = "'PR_COMBUS_COUNT'";

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
	 * Nombre de la funci�n:	InsertarCombustible
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_combustible
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-04 11:21:47
	 */
	function InsertarCombustible($id_combustible,$id_parametro,$id_moneda,$consumo_preferencial,$precio_preferencial,$descripcion,$precio_mercado)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_combustible_iud';
		$this->codigo_procedimiento = "'PR_COMBUS_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_parametro);
		$this->var->add_param($id_moneda);
		$this->var->add_param($consumo_preferencial);
		$this->var->add_param($precio_preferencial);
		$this->var->add_param("'$descripcion'");
		$this->var->add_param($precio_mercado);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarCombustible
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpr_combustible
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-04 11:21:47
	 */
	function ModificarCombustible($id_combustible,$id_parametro,$id_moneda,$consumo_preferencial,$precio_preferencial,$descripcion,$precio_mercado)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_combustible_iud';
		$this->codigo_procedimiento = "'PR_COMBUS_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_combustible);
		$this->var->add_param($id_parametro);
		$this->var->add_param($id_moneda);
		$this->var->add_param($consumo_preferencial);
		$this->var->add_param($precio_preferencial);
		$this->var->add_param("'$descripcion'");
		$this->var->add_param($precio_mercado);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarCombustible
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_combustible
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-04 11:21:47
	 */
	function EliminarCombustible($id_combustible)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_combustible_iud';
		$this->codigo_procedimiento = "'PR_COMBUS_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_combustible);
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
	 * Nombre de la funci�n:	ValidarCombustible
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpr_combustible
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-04 11:21:47
	 */
	function ValidarCombustible($operacion_sql,$id_combustible,$id_parametro,$id_moneda,$consumo_preferencial,$precio_preferencial,$descripcion,$precio_mercado)
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
				//Validar id_combustible - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_AllowBlank(true);
				$tipo_dato->set_Columna("id_combustible");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_combustible", $id_combustible))
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

			//Validar id_moneda - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_moneda");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_moneda", $id_moneda))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar consumo_preferencial - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("consumo_preferencial");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "consumo_preferencial", $consumo_preferencial))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar precio_preferencial - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("precio_preferencial");
			$tipo_dato->set_MaxLength(1179652);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "precio_preferencial", $precio_preferencial))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar precio_mercado - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("precio_mercado");
			$tipo_dato->set_MaxLength(1179652);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "precio_mercado", $precio_mercado))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar descripcion - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(200);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_combustible - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_combustible");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_combustible", $id_combustible))
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