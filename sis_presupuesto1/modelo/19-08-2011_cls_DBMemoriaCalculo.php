<?php
/**
 * Nombre de la clase:	cls_DBMemoriaCalculo.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpr_tpr_memoria_calculo
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-07-10 08:45:14
 */

 
class cls_DBMemoriaCalculo
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
	 * Nombre de la funci�n:	ListarMemoriaCalculo
	 * Prop�sito:				Desplegar los registros de tpr_memoria_calculo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:14
	 */
	function ListarMemoriaCalculo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_memoria_calculo_sel';
		$this->codigo_procedimiento = "'PR_MEMCAL_SEL'";

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
		$this->var->add_def_cols('id_memoria_calculo','int4');
		$this->var->add_def_cols('id_concepto_ingas','int4');
		$this->var->add_def_cols('desc_concepto_ingas','text');
		$this->var->add_def_cols('justificacion','varchar');
		$this->var->add_def_cols('tipo_detalle','numeric');
		$this->var->add_def_cols('id_partida_presupuesto','integer');
		$this->var->add_def_cols('id_moneda','integer');
		$this->var->add_def_cols('des_moneda','varchar');
		$this->var->add_def_cols('costo_estimado','numeric');
		$this->var->add_def_cols('tipo_cambio','numeric');
		$this->var->add_def_cols('total','numeric');
		$this->var->add_def_cols('id_moneda2','integer');
		$this->var->add_def_cols('desc_moneda2','varchar');
		

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
	 * Nombre de la funci�n:	ListarMemoriaCalculo
	 * Prop�sito:				Desplegar los registros de tpr_memoria_calculo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:14
	 */
	function ListarCabeceraMemoriaCalculo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_partida_sel';
		$this->codigo_procedimiento = "'PR_CAB_MEM_SEL'";

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
		$this->var->add_def_cols('codigo_partida','varchar');
		$this->var->add_def_cols('nombre_partida','text');
		$this->var->add_def_cols('fuente','varchar');
		$this->var->add_def_cols('cod_formulario_gasto','varchar');
		$this->var->add_def_cols('gestion_pres','numeric');
		$this->var->add_def_cols('fecha_elaboracion','date');
		$this->var->add_def_cols('simbolo','varchar');
		$this->var->add_def_cols('id_partida_presupuesto','integer');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		echo $this->query;
		exit();
		
		return $res;
	}  
	
	/**
	 * Nombre de la funci�n:	ContarMemoriaCalculo
	 * Prop�sito:				Contar los registros de tpr_memoria_calculo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:14
	 */
	function ContarMemoriaCalculo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_memoria_calculo_sel';
		$this->codigo_procedimiento = "'PR_MEMCAL_COUNT'";

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
	 * Nombre de la funci�n:	InsertarMemoriaCalculo
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_memoria_calculo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:14
	 */
	function InsertarMemoriaCalculo($id_memoria_calculo,$id_concepto_ingas,$justificacion,$id_partida_presupuesto,$tipo_detalle,$id_moneda)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_memoria_calculo_iud';
		$this->codigo_procedimiento = "'PR_MEMCAL_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_concepto_ingas);
		$this->var->add_param("'$justificacion'");
		$this->var->add_param($tipo_detalle);
		$this->var->add_param($id_partida_presupuesto);
		$this->var->add_param($id_moneda);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
/*echo $this->query;
exit();*/
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarMemoriaCalculo
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpr_memoria_calculo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:14
	 */
	function ModificarMemoriaCalculo($id_memoria_calculo, $id_concepto_ingas,$justificacion,$id_partida_presupuesto,$tipo_detalle,$id_moneda)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_memoria_calculo_iud';
		$this->codigo_procedimiento = "'PR_MEMCAL_UPD'";
  
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_memoria_calculo);
		$this->var->add_param($id_concepto_ingas);
		$this->var->add_param("'$justificacion'");
		$this->var->add_param($tipo_detalle);
		$this->var->add_param($id_partida_presupuesto);
		$this->var->add_param($id_moneda);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	/*echo $this->query;
		exit();*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarMemoriaCalculo
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_memoria_calculo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:14
	 */
	function EliminarMemoriaCalculo($id_memoria_calculo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_memoria_calculo_iud';
		$this->codigo_procedimiento = "'PR_MEMCAL_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_memoria_calculo);
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
	 * Nombre de la funci�n:	ValidarMemoriaCalculo
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpr_memoria_calculo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:14
	 */
	function ValidarMemoriaCalculo($operacion_sql,$id_memoria_calculo,$id_concepto_ingas,$justificacion,$id_partida_presupuesto,$tipo_detalle,$id_moneda)
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
				//Validar id_memoria_calculo - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_memoria_calculo");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_memoria_calculo", $id_memoria_calculo))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_concepto_ingas - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_concepto_ingas");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_concepto_ingas", $id_concepto_ingas))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar justificacion - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("justificacion");
			$tipo_dato->set_MaxLength(400);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "justificacion", $justificacion))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_partida_presupuesto - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_partida_presupuesto");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_partida_presupuesto", $id_partida_presupuesto))
			{
				$this->salida = $valid->salida;
				return false;
			}	
			//Validar ,$id_moneda - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_moneda");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_moneda",$id_moneda))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar tipo_detalle - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("tipo_detalle");
			$tipo_dato->set_MaxLength(131072);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "tipo_detalle", $tipo_detalle))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_memoria_calculo - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_memoria_calculo");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_memoria_calculo", $id_memoria_calculo))
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