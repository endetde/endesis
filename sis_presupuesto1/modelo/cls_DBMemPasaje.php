<?php
/**
 * Nombre de la clase:	cls_DBMemPasaje.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpr_tpr_mem_pasaje
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-08-25 18:50:54
 */

 
class cls_DBMemPasaje
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
	 * Nombre de la funci�n:	ListarMemoria
	 * Prop�sito:				Desplegar los registros de tpr_mem_pasaje
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-25 18:50:54
	 */
	function ListarMemoriaPasaje($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_mem_pasaje_sel';
		$this->codigo_procedimiento = "'PR_MEMPAS_SEL'";

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
		$this->var->add_def_cols('id_mem_pasaje','integer');
		$this->var->add_def_cols('id_destino','integer');
		$this->var->add_def_cols('nombre_lugar','varchar');
		$this->var->add_def_cols('desc_destino','varchar');
		$this->var->add_def_cols('id_moneda','integer');
		$this->var->add_def_cols('desc_moneda','varchar');
		$this->var->add_def_cols('periodo_pres','numeric');
		$this->var->add_def_cols('total_general','numeric');
		$this->var->add_def_cols('id_memoria_calculo','integer');
		$this->var->add_def_cols('desc_memoria_calculo','varchar');
		$this->var->add_def_cols('id_categoria','integer');
		$this->var->add_def_cols('desc_categoria','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
/*	
echo $this->query;
		exit();*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarMemoria
	 * Prop�sito:				Contar los registros de tpr_mem_pasaje
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-25 18:50:54
	 */
	function ContarMemoriaPasaje($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_mem_pasaje_sel';
		$this->codigo_procedimiento = "'PR_MEMPAS_COUNT'";

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
	 * Nombre de la funci�n:	InsertarMemoria
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_mem_pasaje
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-25 18:50:54
	 */
	function InsertarMemoriaPasaje($id_mem_pasaje,$id_destino,$id_moneda,$periodo_pres,$total_general,$id_memoria_calculo,$id_categoria,$nro_personas)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_mem_pasaje_iud';
		$this->codigo_procedimiento = "'PR_MEMPAS_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_destino);
		$this->var->add_param($id_moneda);
		$this->var->add_param($periodo_pres);
		$this->var->add_param($total_general);
		$this->var->add_param($id_memoria_calculo);
		$this->var->add_param($id_categoria);
		$this->var->add_param($nro_personas);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
/*		echo $this->query;
		exit();*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarMemoria
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpr_mem_pasaje
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-25 18:50:54
	 */
	function ModificarMemoriaPasaje($id_mem_pasaje,$id_destino,$id_moneda,$periodo_pres,$total_general,$id_memoria_calculo,$id_categoria)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_mem_pasaje_iud';
		$this->codigo_procedimiento = "'PR_MEMPAS_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_mem_pasaje);
		$this->var->add_param($id_destino);
		$this->var->add_param($id_moneda);
		$this->var->add_param($periodo_pres);
		$this->var->add_param($total_general);
		$this->var->add_param($id_memoria_calculo);
		$this->var->add_param($id_categoria);
		$this->var->add_param("NULL");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
/*echo $this->query ;
exit();*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarMemoria
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_mem_pasaje
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-25 18:50:54
	 */
	function EliminarMemoriaPasaje($id_mem_pasaje)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_mem_pasaje_iud';
		$this->codigo_procedimiento = "'PR_MEMPAS_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_mem_pasaje);
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
	 * Nombre de la funci�n:	ValidarMemoria
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpr_mem_pasaje
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-25 18:50:54
	 */
	function ValidarMemoriaPasaje($operacion_sql,$id_mem_pasaje,$id_destino,$id_moneda,$periodo_pres,$total_general,$id_memoria_calculo,$id_categoria,$nro_personas)
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
				//Validar id_mem_pasaje - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_mem_pasaje");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_mem_pasaje", $id_mem_pasaje))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_destino - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_destino");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_destino", $id_destino))
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
				//Validar $nro_personas - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nro_personas");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "nro_personas", $nro_personas))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validar id_moneda - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_categoria");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_categoria",$id_categoria))
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
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_mem_pasaje - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_mem_pasaje");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_mem_pasaje", $id_mem_pasaje))
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