<?php
/**
 * Nombre de la clase:	cls_DBGestionFirma.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpm_gestion_firma
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-12-01 14:49:34
 */

class cls_DBGestionFirma
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
	 * Nombre de la funci�n:	ListarGestionFirma
	 * Prop�sito:				Desplegar los registros de tpm_gestion_firma
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-01 14:49:34
	 */
	function ListarGestionFirma($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_gestion_firma_sel';
		$this->codigo_procedimiento = "'CT_GESFIR_SEL'";

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
		$this->var->add_def_cols('id_gestion_firma','int4');
		$this->var->add_def_cols('id_gestion','int4');
		$this->var->add_def_cols('sw_firma','varchar');
		$this->var->add_def_cols('id_empleado','int4');
		$this->var->add_def_cols('nombre_completo','text');
		$this->var->add_def_cols('id_cargo','int4');
		$this->var->add_def_cols('nombre_cargo','varchar');
		$this->var->add_def_cols('mat_contador','varchar');
		

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarGestionFirma
	 * Prop�sito:				Contar los registros de tpm_gestion_firma
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-01 14:49:34
	 */
	function ContarGestionFirma($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_gestion_firma_sel';
		$this->codigo_procedimiento = "'CT_GESFIR_COUNT'";

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
	 * Nombre de la funci�n:	InsertarGestionFirma
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpm_gestion_firma
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-01 14:49:34
	 */
	function InsertarGestionFirma($id_gestion_firma,$id_gestion,$sw_firma,$id_empleado,$id_cargo,$mat_contador)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_gestion_firma_iud';
		$this->codigo_procedimiento = "'CT_GESFIR_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_gestion);
		$this->var->add_param("'$sw_firma'");
		$this->var->add_param($id_empleado);
		$this->var->add_param($id_cargo);
		$this->var->add_param("'$mat_contador'");
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarGestionFirma
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpm_gestion_firma
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-01 14:49:34
	 */
	function ModificarGestionFirma($id_gestion_firma,$id_gestion,$sw_firma,$id_empleado,$id_cargo,$mat_contador)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_gestion_firma_iud';
		$this->codigo_procedimiento = "'CT_GESFIR_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_gestion_firma);
		$this->var->add_param($id_gestion);
		$this->var->add_param("'$sw_firma'");
		$this->var->add_param($id_empleado);
		$this->var->add_param($id_cargo);
		$this->var->add_param("'$mat_contador'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarGestionFirma
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpm_gestion_firma
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-01 14:49:34
	 */
	function EliminarGestionFirma($id_gestion_firma)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_gestion_firma_iud';
		$this->codigo_procedimiento = "'CT_GESFIR_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_gestion_firma);
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
	 * Nombre de la funci�n:	ValidarGestionFirma
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tct_gestion_firma
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-01 14:49:34
	 */
	function ValidarGestionFirma($operacion_sql,$id_gestion_firma,$id_gestion,$sw_firma,$id_empleado,$id_cargo,$mat_contador)
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
				//Validar id_gestion_firma - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_gestion_firma");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_gestion_firma", $id_gestion_firma))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}
			//Validar id_gestion - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_gestion");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_gestion", $id_gestion))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_gestion_firma - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_gestion_firma");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_gestion_firma", $id_gestion_firma))
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
	
	/**
	 * Nombre de la funci�n:	ListarCargos
	 * Prop�sito:				Desplegar los registros de vkp_empleado_asignacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-01 14:49:34
	 */
	function ListarCargos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_gestion_firma_sel';
		$this->codigo_procedimiento = "'CT_CARGOS_SEL'";
	
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
		$this->var->add_def_cols('id_historico_asignacion','int4');
		$this->var->add_def_cols('nombre_cargo','varchar');
		$this->var->add_def_cols('nombre_unidad','varchar');
	
	
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarGestionFirma
	 * Prop�sito:				Contar los registros de tpm_gestion_firma
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-01 14:49:34
	 */
	function ContarCargos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_gestion_firma_sel';
		$this->codigo_procedimiento = "'CT_CARGOS_COUNT'";
	
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
}?>