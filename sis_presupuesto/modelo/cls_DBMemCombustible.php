<?php
/**
 * Nombre de la clase:	cls_DBMemCombustible.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpr_tpr_mem_combustible
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-11-04 19:39:13
 */

 
class cls_DBMemCombustible
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
	 * Nombre de la funci�n:	ListarMemoriaCombustible
	 * Prop�sito:				Desplegar los registros de tpr_mem_combustible
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-04 19:39:13
	 */
	function ListarMemoriaCombustible($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_mem_combustible_sel';
		$this->codigo_procedimiento = "'PR_MEMCOM_SEL'";

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
		$this->var->add_def_cols('id_mem_combustible','int4');
		$this->var->add_def_cols('id_memoria_calculo','int4');
		$this->var->add_def_cols('id_moneda','int4');
		$this->var->add_def_cols('desc_moneda','varchar');
		$this->var->add_def_cols('id_combustible','int4');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('periodo_pres','numeric');
		$this->var->add_def_cols('cantidad_combustible','numeric');
		$this->var->add_def_cols('cantidad_preferencial','numeric');
		$this->var->add_def_cols('precio_preferencial','numeric');
		$this->var->add_def_cols('cantidad_mercado','numeric');
		$this->var->add_def_cols('precio_mercado','numeric');
		$this->var->add_def_cols('costo_preferencial','numeric');
		$this->var->add_def_cols('costo_mercado','numeric');
		$this->var->add_def_cols('costo_total','numeric');
		$this->var->add_def_cols('porcentaje','numeric');
		$this->var->add_def_cols('total_general','numeric');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarMemoriaCombustible
	 * Prop�sito:				Contar los registros de tpr_mem_combustible
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-04 19:39:13
	 */
	function ContarMemoriaCombustible($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_mem_combustible_sel';
		$this->codigo_procedimiento = "'PR_MEMCOM_COUNT'";

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
	 * Nombre de la funci�n:	InsertarMemoriaCombustible
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_mem_combustible
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-04 19:39:13
	 */
	function InsertarMemoriaCombustible($id_mem_combustible,$id_memoria_calculo,$id_moneda,$id_combustible,$periodo_pres,$cantidad_combustible,$cantidad_preferencial,$precio_preferencial,$cantidad_mercado,$precio_mercado,$costo_preferencial,$costo_mercado,$costo_total,$porcentaje,$total_general,$tipo_insercion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_mem_combustible_iud';
		$this->codigo_procedimiento = "'PR_MEMCOM_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_memoria_calculo);
		$this->var->add_param($id_moneda);
		$this->var->add_param($id_combustible);
		$this->var->add_param($periodo_pres);
		$this->var->add_param($cantidad_combustible);
		$this->var->add_param($cantidad_preferencial);
		$this->var->add_param($precio_preferencial);
		$this->var->add_param($cantidad_mercado);
		$this->var->add_param($precio_mercado);
		$this->var->add_param($costo_preferencial);
		$this->var->add_param($costo_mercado);
		$this->var->add_param($costo_total);
		$this->var->add_param($porcentaje);
		$this->var->add_param($total_general);
		$this->var->add_param($tipo_insercion);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarMemoriaCombustible
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpr_mem_combustible
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-04 19:39:13
	 */
	function ModificarMemoriaCombustible($id_mem_combustible,$id_memoria_calculo,$id_moneda,$id_combustible,$periodo_pres,$cantidad_combustible,$cantidad_preferencial,$precio_preferencial,$cantidad_mercado,$precio_mercado,$costo_preferencial,$costo_mercado,$costo_total,$porcentaje,$total_general,$tipo_insercion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_mem_combustible_iud';
		$this->codigo_procedimiento = "'PR_MEMCOM_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_mem_combustible);
		$this->var->add_param($id_memoria_calculo);
		$this->var->add_param($id_moneda);
		$this->var->add_param($id_combustible);
		$this->var->add_param($periodo_pres);
		$this->var->add_param($cantidad_combustible);
		$this->var->add_param($cantidad_preferencial);
		$this->var->add_param($precio_preferencial);
		$this->var->add_param($cantidad_mercado);
		$this->var->add_param($precio_mercado);
		$this->var->add_param($costo_preferencial);
		$this->var->add_param($costo_mercado);
		$this->var->add_param($costo_total);
		$this->var->add_param($porcentaje);
		$this->var->add_param($total_general);
		$this->var->add_param($tipo_insercion);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarMemoriaCombustible
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_mem_combustible
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-04 19:39:13
	 */
	function EliminarMemoriaCombustible($id_mem_combustible)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_mem_combustible_iud';
		$this->codigo_procedimiento = "'PR_MEMCOM_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_mem_combustible);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");	//Tipo insercion

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarMemoriaCombustible
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpr_mem_combustible
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-04 19:39:13
	 */
	function ValidarMemoriaCombustible($operacion_sql,$id_mem_combustible,$id_memoria_calculo,$id_moneda,$id_combustible,$periodo_pres,$cantidad_combustible,$cantidad_preferencial,$precio_preferencial,$cantidad_mercado,$precio_mercado,$costo_preferencial,$costo_mercado,$costo_total,$porcentaje,$total_general)
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
				//Validar id_mem_combustible - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_mem_combustible");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_mem_combustible", $id_mem_combustible))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_memoria_calculo - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_memoria_calculo");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_memoria_calculo", $id_memoria_calculo))
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

			//Validar id_combustible - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_combustible");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_combustible", $id_combustible))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar periodo_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("periodo_pres");
			$tipo_dato->set_MaxLength(131072);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "periodo_pres", $periodo_pres))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar cantidad_combustible - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("cantidad_combustible");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "cantidad_combustible", $cantidad_combustible))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar cantidad_preferencial - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("cantidad_preferencial");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "cantidad_preferencial", $cantidad_preferencial))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar precio_preferencial - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("precio_preferencial");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "precio_preferencial", $precio_preferencial))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar cantidad_mercado - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("cantidad_mercado");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "cantidad_mercado", $cantidad_mercado))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar precio_mercado - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("precio_mercado");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "precio_mercado", $precio_mercado))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar costo_preferencial - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("costo_preferencial");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "costo_preferencial", $costo_preferencial))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar costo_mercado - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("costo_mercado");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "costo_mercado", $costo_mercado))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar costo_total - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("costo_total");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "costo_total", $costo_total))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar porcentaje - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("porcentaje");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "porcentaje", $porcentaje))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar total_general - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("total_general");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "total_general", $total_general))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_mem_combustible - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_mem_combustible");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_mem_combustible", $id_mem_combustible))
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