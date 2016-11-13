<?php
/**
 * Nombre de la clase:	cls_DBCorteMoneda.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tts_tts_corte_moneda
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-10-21 09:40:02
 */

 
class cls_DBCorteMoneda
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
	 * Nombre de la funci�n:	ListarCorteMoneda
	 * Prop�sito:				Desplegar los registros de tts_corte_moneda
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-21 09:40:02
	 */
	function ListarCorteMoneda($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_corte_moneda_sel';
		$this->codigo_procedimiento = "'TS_CORMON_SEL'";

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
		$this->var->add_def_cols('id_corte','int4');
		$this->var->add_def_cols('id_moneda','int4');
		$this->var->add_def_cols('desc_moneda','varchar');
		$this->var->add_def_cols('descri_corte','varchar');
		$this->var->add_def_cols('importe_valor','numeric');
		$this->var->add_def_cols('tipo_corte','numeric');
		//$this->var->add_def_cols('desc_tipo_corte','text');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo $this->var->query;
		exit ();*/
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarCorteMoneda
	 * Prop�sito:				Contar los registros de tts_corte_moneda
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-21 09:40:02
	 */
	function ContarCorteMoneda($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_corte_moneda_sel';
		$this->codigo_procedimiento = "'TS_CORMON_COUNT'";

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
	 * Nombre de la funci�n:	InsertarCorteMoneda
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tts_corte_moneda
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-21 09:40:02
	 */
	function InsertarCorteMoneda($id_corte,$id_moneda,$descri_corte,$importe_valor,$tipo_corte)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_corte_moneda_iud';
		$this->codigo_procedimiento = "'TS_CORMON_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_moneda);
		$this->var->add_param("'$descri_corte'");
		$this->var->add_param($importe_valor);
		$this->var->add_param($tipo_corte);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarCorteMoneda
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tts_corte_moneda
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-21 09:40:02
	 */
	function ModificarCorteMoneda($id_corte,$id_moneda,$descri_corte,$importe_valor,$tipo_corte)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_corte_moneda_iud';
		$this->codigo_procedimiento = "'TS_CORMON_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_corte);
		$this->var->add_param($id_moneda);
		$this->var->add_param("'$descri_corte'");
		$this->var->add_param($importe_valor);
		$this->var->add_param($tipo_corte);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarCorteMoneda
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tts_corte_moneda
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-21 09:40:02
	 */
	function EliminarCorteMoneda($id_corte)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_corte_moneda_iud';
		$this->codigo_procedimiento = "'TS_CORMON_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_corte);
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
	 * Nombre de la funci�n:	ValidarCorteMoneda
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tts_corte_moneda
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-21 09:40:02
	 */
	function ValidarCorteMoneda($operacion_sql,$id_corte,$id_moneda,$descri_corte,$importe_valor,$tipo_corte)
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
				//Validar id_corte - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_corte");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_corte", $id_corte))
				{
					$this->salida = $valid->salida;
					return false;
				}
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

			//Validar descri_corte - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descri_corte");
			$tipo_dato->set_MaxLength(50);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descri_corte", $descri_corte))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar importe_valor - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("importe_valor");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "importe_valor", $importe_valor))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar tipo_corte - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("tipo_corte");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "tipo_corte", $tipo_corte))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_corte - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_corte");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_corte", $id_corte))
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
