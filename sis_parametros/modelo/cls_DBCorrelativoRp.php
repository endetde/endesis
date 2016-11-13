<?php
/**
 * Nombre de la clase:	cls_DBCorrelativoRp.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpm_tpm_correlativo_rp
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-09-08 10:46:41
 */

 
class cls_DBCorrelativoRp
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
	 * Nombre de la funci�n:	ListarCorrelativoRp
	 * Prop�sito:				Desplegar los registros de tpm_correlativo_rp
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-09-08 10:46:41
	 */
	function ListarCorrelativoRp($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_correlativo_rp_sel';
		$this->codigo_procedimiento = "'PM_CORLRP_SEL'";

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
		$this->var->add_def_cols('id_correlativo_rp','int8');
		$this->var->add_def_cols('nro_doc_siguiente','int8');
		$this->var->add_def_cols('nro_doc_actual','int8');
		$this->var->add_def_cols('id_documento','int4');
		$this->var->add_def_cols('desc_documento','varchar');
		$this->var->add_def_cols('id_empresa','int4');
		$this->var->add_def_cols('desc_empresa','varchar');
		$this->var->add_def_cols('id_periodo','int4');
		$this->var->add_def_cols('desc_periodo','numeric');
		$this->var->add_def_cols('id_proyecto','int4');
		$this->var->add_def_cols('desc_proyecto','text');
		$this->var->add_def_cols('id_regional','int4');
		$this->var->add_def_cols('desc_regional','varchar');
        $this->var->add_def_cols('gestion','numeric');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	/*	echo $this->query;
		exit;*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarCorrelativoRp
	 * Prop�sito:				Contar los registros de tpm_correlativo_rp
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-09-08 10:46:41
	 */
	function ContarCorrelativoRp($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_correlativo_rp_sel';
		$this->codigo_procedimiento = "'PM_CORLRP_COUNT'";

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
	 * Nombre de la funci�n:	InsertarCorrelativoRp
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpm_correlativo_rp
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-09-08 10:46:41
	 */
	function InsertarCorrelativoRp($id_correlativo_rp,$nro_doc_siguiente,$nro_doc_actual,$id_documento,$id_empresa,$id_periodo,$id_proyecto,$id_regional)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_correlativo_rp_iud';
		$this->codigo_procedimiento = "'PM_CORLRP_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($nro_doc_siguiente);
		$this->var->add_param($nro_doc_actual);
		$this->var->add_param($id_documento);
		$this->var->add_param($id_empresa);
		$this->var->add_param($id_periodo);
		$this->var->add_param($id_proyecto);
		$this->var->add_param($id_regional);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarCorrelativoRp
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpm_correlativo_rp
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-09-08 10:46:41
	 */
	function ModificarCorrelativoRp($id_correlativo_rp,$nro_doc_siguiente,$nro_doc_actual,$id_documento,$id_empresa,$id_periodo,$id_proyecto,$id_regional)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_correlativo_rp_iud';
		$this->codigo_procedimiento = "'PM_CORLRP_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_correlativo_rp);
		$this->var->add_param($nro_doc_siguiente);
		$this->var->add_param($nro_doc_actual);
		$this->var->add_param($id_documento);
		$this->var->add_param($id_empresa);
		$this->var->add_param($id_periodo);
		$this->var->add_param($id_proyecto);
		$this->var->add_param($id_regional);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarCorrelativoRp
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpm_correlativo_rp
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-09-08 10:46:41
	 */
	function EliminarCorrelativoRp($id_correlativo_rp)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_correlativo_rp_iud';
		$this->codigo_procedimiento = "'PM_CORLRP_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_correlativo_rp);
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
	 * Nombre de la funci�n:	ValidarCorrelativoRp
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpm_correlativo_rp
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-09-08 10:46:41
	 */
	function ValidarCorrelativoRp($operacion_sql,$id_correlativo_rp,$nro_doc_siguiente,$nro_doc_actual,$id_documento,$id_empresa,$id_periodo,$id_proyecto,$id_regional)
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
				//Validar id_correlativo_rp - tipo int8
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_correlativo_rp");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_correlativo_rp", $id_correlativo_rp))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar nro_doc_siguiente - tipo int8
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nro_doc_siguiente");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "nro_doc_siguiente", $nro_doc_siguiente))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar nro_doc_actual - tipo int8
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nro_doc_actual");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "nro_doc_actual", $nro_doc_actual))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_documento - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_documento");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_documento", $id_documento))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_empresa - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empresa");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empresa", $id_empresa))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_periodo - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_periodo");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_periodo", $id_periodo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_proyecto - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_proyecto");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_proyecto", $id_proyecto))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_regional - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_regional");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_regional", $id_regional))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_correlativo_rp - tipo int8
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_correlativo_rp");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_correlativo_rp", $id_correlativo_rp))
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