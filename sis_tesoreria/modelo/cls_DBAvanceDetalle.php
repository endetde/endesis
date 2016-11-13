<?php
/**
 * Nombre de la clase:	cls_DBAvanceDetalle.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tts_avance_detalle
 * Autor:				Fernando Prudencio
 * Fecha creaci�n:		2008-07-02 21:46:09
 */

 
class cls_DBAvanceDetalle
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
	 * Nombre de la funci�n:	ListarNivelOec
	 * Prop�sito:				Desplegar los registros de tts_nivel_oec
	 * Autor:				    Fernando Prudencio
	 * Fecha de creaci�n:		2008-10-10 21:46:09
	 */
	function ListarAvanceDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_detalle_sel';
		$this->codigo_procedimiento = "'TS_AVADET_SEL'";

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
		$this->var->add_def_cols('id_avance_detalle','int4');
		$this->var->add_def_cols('id_avance','int4');
		$this->var->add_def_cols('id_concepto_ingas','int4');
		$this->var->add_def_cols('desc_ingas_item_serv','text');
		$this->var->add_def_cols('importe_detalle','numeric');
		$this->var->add_def_cols('observa_detalle','varchar');
		$this->var->add_def_cols('sw_valida','numeric');
		$this->var->add_def_cols('id_presupuesto','int4');
		$this->var->add_def_cols('desc_presupuesto','text');
		$this->var->add_def_cols('id_item','int4');
		$this->var->add_def_cols('id_servicio','int4');
		$this->var->add_def_cols('id_solicitud_compra_det','int4');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarAvanceDetalle
	 * Prop�sito:				Contar los registros de tts_avance_detalle
	 * Autor:				    Fernando Prudencio
	 * Fecha de creaci�n:		2008-10-10 21:46:09
	 */
	function ContarAvanceDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_detalle_sel';
		$this->codigo_procedimiento = "'TS_AVADET_COUNT'";

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
	 * Nombre de la funci�n:	InsertarAvanceDetalle
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tts_avance_detalle
	 * Autor:				    Fernando Prudencio
	 * Fecha de creaci�n:		2008-10-10 21:46:09
	 */
	function InsertarAvanceDetalle($id_avance_detalle,$id_avance,$id_concepto_ingas,$importe_detalle,$observa_detalle,$sw_valida,$id_presupuesto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_detalle_iud';
		$this->codigo_procedimiento = "'TS_AVADET_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_avance);
		$this->var->add_param($id_concepto_ingas);
		$this->var->add_param($importe_detalle);
		$this->var->add_param("'$observa_detalle'");
		$this->var->add_param($sw_valida);
		$this->var->add_param($id_presupuesto);
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarAvanceDetalle
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tts_avance_detalle
	 * Autor:				    Fernando Prudencio
	 * Fecha de creaci�n:		2008-10-10 21:46:09
	 */
	function ModificarAvanceDetalle($id_avance_detalle,$id_avance,$id_concepto_ingas,$importe_detalle,$observa_detalle,$sw_valida,$id_presupuesto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_detalle_iud';
		$this->codigo_procedimiento = "'TS_AVADET_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);		
		$this->var->add_param($id_avance_detalle);
		$this->var->add_param($id_avance);
		$this->var->add_param($id_concepto_ingas);
		$this->var->add_param($importe_detalle);
		$this->var->add_param("'$observa_detalle'");
		$this->var->add_param($sw_valida);
		$this->var->add_param($id_presupuesto);
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarAvanceDetalle
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tts_avance_detalle
	 * Autor:				    Fernando Prudencio
	 * Fecha de creaci�n:		2008-10-10 21:46:09
	 */
	function EliminarAvanceDetalle($id_avance_detalle)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_detalle_iud';
		$this->codigo_procedimiento = "'TS_AVADET_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance_detalle);
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
	 * Nombre de la funci�n:	ModificarAvanceDetalle
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tts_avance_detalle
	 * Autor:				    Fernando Prudencio
	 * Fecha de creaci�n:		2008-10-10 21:46:09
	 */
	function AprobarAvanceDetalle($id_avance_detalle,$id_avance,$sw_valida)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_detalle_iud';
		$this->codigo_procedimiento = "'TS_AVADET_APRO'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);		
		$this->var->add_param($id_avance_detalle);
		$this->var->add_param($id_avance);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($sw_valida);
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
	 * Nombre de la funci�n:	ValidarAvanceDetalle
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tts_avance_detalle
	 * Autor:				    Fernando Prudencio
	 * Fecha de creaci�n:		2008-07-02 21:46:09
	 */
	function ValidarAvanceDetalle($operacion_sql,$id_avance_detalle,$id_avance,$id_concepto_ingas,$importe_detalle,$observa_detalle)
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
				//Validar id_nivel_oec - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_avance_detalle");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_avance_detalle", $id_avance_detalle))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_avance - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_avance");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("false");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_avance", $id_avance))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validar id_concepto_ingas - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_concepto_ingas");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("false");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_concepto_ingas", $id_concepto_ingas))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar importe_detalle - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("importe_detalle");
			$tipo_dato->set_MaxLength(131072);
			$tipo_dato->set_AllowBlank("false");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "importe_detalle", $importe_detalle))
			{
				$this->salida = $valid->salida;
				return false;
			}
            //Validar observa_detalle - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("observa_detalle");
			$tipo_dato->set_AllowBlank("true");
			$tipo_dato->set_MaxLength(300);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "observa_detalle", $observa_detalle))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_nivel_oec - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_avance_detalle");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_avance_detalle", $id_avance_detalle))
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