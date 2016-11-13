<?php
/**
 * Nombre de la clase:	cls_DBDevPasaje.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tts_cuenta_doc_det
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-10-21 15:43:28
 */


class cls_DBDevPasaje
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
	 * Nombre de la funci�n:	ListarDevPasaje
	 * Prop�sito:				Desplegar los registros de tts_cuenta_doc_det
	 * Autor:				    TSL
	 * Fecha de creaci�n:		2009.11.12
	 */
	function ListarDevPasaje($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_dev_pasaje_sel';
		$this->codigo_procedimiento = "'TS_DEVPAS_SEL'";

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
		$this->var->add_def_cols('id_cuenta_doc_det','int4');
		$this->var->add_def_cols('sw_select','numeric');
		$this->var->add_def_cols('partida','text');
		$this->var->add_def_cols('desc_presupuesto','text');
		$this->var->add_def_cols('pasaje_orden','numeric');
		$this->var->add_def_cols('nota_debito','varchar');
		$this->var->add_def_cols('pasaje_nro','varchar');
		$this->var->add_def_cols('importe','numeric');
		$this->var->add_def_cols('pasaje_cobrar','numeric');
		$this->var->add_def_cols('pasaje_credito','numeric');
		$this->var->add_def_cols('importe_total','numeric');
		$this->var->add_def_cols('fecha_sol', 'date' );
		$this->var->add_def_cols('recorrido','varchar');
		$this->var->add_def_cols('res_pago','text');
		$this->var->add_def_cols('res_dev','text');
		$this->var->add_def_cols('nro_documento','varchar');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo "query:".$this->query;
		exit;*/
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarDevPasaje
	 * Prop�sito:				Contar los registros de tts_cuenta_doc_det
	 * Autor:				    TSL
	 * Fecha de creaci�n:		2009.11.12
	 */
	function ContarDevPasaje($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_dev_pasaje_sel';
		$this->codigo_procedimiento = "'TS_DEVPAS_COUNT'";

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
	 * Nombre de la funci�n:	InsertarDevPasaje
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tts_dev_pasaje
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-21 15:43:28
	 */
	function InsertarDevPasaje($id_cuenta_doc_det,$id_presupuesto,$sw_select,$desc_presupuesto,$fecha_ini,$importe,$observaciones)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_dev_pasaje_iud';
		$this->codigo_procedimiento = "'TS_DEVPAS_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_presupuesto);
		$this->var->add_param($sw_select);
		$this->var->add_param($desc_presupuesto);
		$this->var->add_param($fecha_ini);
		$this->var->add_param($importe);
		$this->var->add_param($observaciones);
 		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		//echo "query: ".$this->query;
		//exit;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarDevPasaje
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tts_dev_pasaje
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-21 15:43:28
	 */
	function ModificarDevPasaje($id_cuenta_doc_det,$id_presupuesto,$sw_select,$desc_presupuesto,$fecha_ini,$importe,$observaciones)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_dev_pasaje_iud';
		$this->codigo_procedimiento = "'TS_DEVPAS_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_cuenta_doc_det);
		$this->var->add_param($id_presupuesto);
		$this->var->add_param($sw_select);
		$this->var->add_param($desc_presupuesto);
		$this->var->add_param($fecha_ini);
		$this->var->add_param($importe);
		$this->var->add_param($observaciones);
 

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	EliminarDevPasaje
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tts_dev_pasaje
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-21 15:43:28
	 */
	function EliminarDevPasaje($id_cuenta_doc_det)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_dev_pasaje_iud';
		$this->codigo_procedimiento = "'TS_DEVPAS_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_cuenta_doc_det);
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

		//echo "query:".$this->query;
		//exit;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	SelectDevPasaje
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tts_dev_pasaje
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-21 15:43:28
	 */
	function SelectDevPasaje($id_cuenta_doc_det,$sw_select)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_dev_pasaje_iud';
		$this->codigo_procedimiento = "'TS_DEVPAS_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_cuenta_doc_det);
		$this->var->add_param("NULL");
		$this->var->add_param($sw_select);
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
	 * Nombre de la funci�n:	SelectDevPasaje
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tts_dev_pasaje
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-21 15:43:28
	 */
	function ProceDevPasaje($id_depto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_dev_pasaje_iud';
		$this->codigo_procedimiento = "'TS_DEVPAS_PRO'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("$id_depto");//en vez de id_cuenta_doc_det mando el id_depto
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
	 * Nombre de la funci�n:	ValidarDevPasaje
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tts_dev_pasaje
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-21 15:43:28
	 */
	function ValidarDevPasaje($operacion_sql,$id_cuenta_doc_det,$id_presupuesto,$sw_select,$desc_presupuesto,$fecha_ini,$importe,$observaciones)
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
				//Validar id_dev_pasaje - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_cuenta_doc_det");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cuenta_doc_det", $id_dev_pasaje))
				{
					$this->salida = $valid->salida;
					return false;
				}

			}

			//Validar importe_devengado - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("sw_select");
			$tipo_dato->set_MaxLength(2);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "sw_select", $importe_devengado))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_dev_pasaje - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_cuenta_doc_det");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cuenta_doc_det", $id_dev_pasaje))
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