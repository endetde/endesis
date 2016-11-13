<?php
/**
 * Nombre de la clase:	cls_DBCartaDocs.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tts_tts_carta_docs
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-11-18 20:39:09
 */

 
class cls_DBCartaDocs
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
	 * Nombre de la funci�n:	ListarCartaDocs
	 * Prop�sito:				Desplegar los registros de tts_carta_docs
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-18 20:39:09
	 */
	function ListarCartaDocs($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_carta_docs_sel';
		$this->codigo_procedimiento = "'TS_DOCCAR_SEL'";

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
		$this->var->add_def_cols('id_carta_docs','int4');
		$this->var->add_def_cols('id_carta','int4');
		$this->var->add_def_cols('descri_docs','varchar');
		$this->var->add_def_cols('fecha_presenta','date');
		$this->var->add_def_cols('sw_presenta','numeric');
		                    

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarCartaDocs
	 * Prop�sito:				Contar los registros de tts_carta_docs
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-18 20:39:09
	 */
	function ContarCartaDocs($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_carta_docs_sel';
		$this->codigo_procedimiento = "'TS_DOCCAR_COUNT'";

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
	 * Nombre de la funci�n:	InsertarCartaDocs
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tts_carta_docs
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-18 20:39:09
	 */
	function InsertarCartaDocs($id_carta_docs,$id_carta,$descri_docs,$fecha_presenta,$sw_presenta)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_carta_docs_iud';
		$this->codigo_procedimiento = "'TS_DOCCAR_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_carta);
		$this->var->add_param("'$descri_docs'");
		$this->var->add_param("'$fecha_presenta'");
		$this->var->add_param($sw_presenta);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarCartaDocs
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tts_carta_docs
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-18 20:39:09
	 */
	function ModificarCartaDocs($id_carta_docs,$id_carta,$descri_docs,$fecha_presenta,$sw_presenta)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_carta_docs_iud';
		$this->codigo_procedimiento = "'TS_DOCCAR_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_carta_docs);
		$this->var->add_param($id_carta);
		$this->var->add_param("'$descri_docs'");
		$this->var->add_param("'$fecha_presenta'");
		$this->var->add_param($sw_presenta);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarCartaDocs
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tts_carta_docs
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-18 20:39:09
	 */
	function EliminarCartaDocs($id_carta_docs)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_carta_docs_iud';
		$this->codigo_procedimiento = "'TS_DOCCAR_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_carta_docs);
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
	 * Nombre de la funci�n:	ValidarCartaDocs
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tts_carta_docs
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-18 20:39:09
	 */
	function ValidarCartaDocs($operacion_sql,$id_carta_docs,$id_carta,$descri_docs,$fecha_presenta,$sw_presenta)
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
				//Validar id_carta_docs - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_carta_docs");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_carta_docs", $id_carta_docs))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_carta - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_carta");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_carta", $id_carta))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar descri_docs - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descri_docs");
			$tipo_dato->set_MaxLength(150);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descri_docs", $descri_docs))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fecha_presenta - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_presenta");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_presenta", $fecha_presenta))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar sw_presenta - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("sw_presenta");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "sw_presenta", $sw_presenta))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_carta_docs - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_carta_docs");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_carta_docs", $id_carta_docs))
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