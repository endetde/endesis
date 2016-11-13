<?php
/**
 * Nombre de la clase:	cls_DBMemInversionGasto.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpr_tpr_mem_inversion_gasto
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-07-10 08:45:16
 */

 
class cls_DBMemInversionGasto
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
	 * Nombre de la funci�n:	ListarMemoriaGasto
	 * Prop�sito:				Desplegar los registros de tpr_mem_inversion_gasto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:16
	 */
	function ListarMemoriaGasto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_mem_inversion_gasto_sel';
		$this->codigo_procedimiento = "'PR_MEMGAS_SEL'";

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
		$this->var->add_def_cols('id_mem_inversion_gasto','int4');
		$this->var->add_def_cols('cantidad','int4');
		$this->var->add_def_cols('costo_unitario','numeric');
		$this->var->add_def_cols('periodo_pres','numeric');
		$this->var->add_def_cols('tipo_mem','numeric');
		$this->var->add_def_cols('id_memoria_calculo','int4');
		$this->var->add_def_cols('id_moneda','int4');
		$this->var->add_def_cols('desc_moneda','varchar');
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
	 * Nombre de la funci�n:	ContarMemoriaGasto
	 * Prop�sito:				Contar los registros de tpr_mem_inversion_gasto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:16
	 */
	function ContarMemoriaGasto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_mem_inversion_gasto_sel';
		$this->codigo_procedimiento = "'PR_MEMGAS_COUNT'";

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
	 * Nombre de la funci�n:	InsertarMemoriaGasto
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_mem_inversion_gasto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:16
	 */
	function InsertarMemoriaGasto($id_mem_inversion_gasto,$cantidad,$costo_unitario,$periodo_pres,$tipo_mem,$id_memoria_calculo,$id_moneda,$total_general,$tipo_insercion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_mem_inversion_gasto_iud';
		$this->codigo_procedimiento = "'PR_MEMGAS_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");		
		$this->var->add_param($cantidad);
		$this->var->add_param($costo_unitario);
		$this->var->add_param($periodo_pres);
		$this->var->add_param($tipo_mem);
		$this->var->add_param($id_memoria_calculo);
		$this->var->add_param($id_moneda);
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
	 * Nombre de la funci�n:	ModificarMemoriaGasto
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpr_mem_inversion_gasto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:16
	 */
	function ModificarMemoriaGasto($id_mem_inversion_gasto,$cantidad,$costo_unitario,$periodo_pres,$tipo_mem,$id_memoria_calculo,$id_moneda,$total_general,$tipo_insercion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_mem_inversion_gasto_iud';
		$this->codigo_procedimiento = "'PR_MEMGAS_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_mem_inversion_gasto);
		$this->var->add_param($cantidad);
		$this->var->add_param($costo_unitario);
		$this->var->add_param($periodo_pres);
		$this->var->add_param($tipo_mem);
		$this->var->add_param($id_memoria_calculo);
		$this->var->add_param($id_moneda);
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
	 * Nombre de la funci�n:	EliminarMemoriaGasto
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_mem_inversion_gasto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:16
	 */
	function EliminarMemoriaGasto($id_mem_inversion_gasto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_mem_inversion_gasto_iud';
		$this->codigo_procedimiento = "'PR_MEMGAS_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_mem_inversion_gasto);
		$this->var->add_param("NULL");
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
	 * Nombre de la funci�n:	ValidarMemoriaGasto
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpr_mem_inversion_gasto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:16
	 */
	function ValidarMemoriaGasto($operacion_sql,$id_mem_inversion_gasto,$cantidad,$costo_unitario,$periodo_pres,$tipo_mem,$id_memoria_calculo,$id_moneda,$total_general)
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
				//Validar id_mem_inversion_gasto - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_mem_inversion_gasto");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_mem_inversion_gasto", $id_mem_inversion_gasto))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar cantidad - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("cantidad");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "cantidad", $cantidad))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar costo_unitario - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("costo_unitario");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "costo_unitario", $costo_unitario))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar periodo_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("periodo_pres");
			$tipo_dato->set_MaxLength(131072);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "periodo_pres", $periodo_pres))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar tipo_mem - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("tipo_mem");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "tipo_mem", $tipo_mem))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_memoria_calculo - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_memoria_calculo");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_memoria_calculo", $id_memoria_calculo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_moneda - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_moneda");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_moneda", $id_moneda))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar total_general - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("total_general");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
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
			//Validar id_mem_inversion_gasto - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_mem_inversion_gasto");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_mem_inversion_gasto", $id_mem_inversion_gasto))
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