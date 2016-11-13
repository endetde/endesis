<?php
/**
 * Nombre de la clase:	cls_DBGestionSubsistema.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tct_tct_gestion_subsistema
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-12-01 14:49:34
 */

 
class cls_DBGestionSubsistema
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
	 * Nombre de la funci�n:	ListarGestionSubsistema
	 * Prop�sito:				Desplegar los registros de tct_gestion_subsistema
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-01 14:49:34
	 */
	function ListarGestionSubsistema($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_gestion_subsistema_sel';
		$this->codigo_procedimiento = "'CT_GESSIS_SEL'";

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
		$this->var->add_def_cols('id_gestion_subsistema','int4');
		$this->var->add_def_cols('id_gestion','int4');
		$this->var->add_def_cols('desc_gestion','int4');
		$this->var->add_def_cols('estado_gestion','varchar');
		$this->var->add_def_cols('nombre_largo','text');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarGestionSubsistema
	 * Prop�sito:				Contar los registros de tct_gestion_subsistema
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-01 14:49:34
	 */
	function ContarGestionSubsistema($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_gestion_subsistema_sel';
		$this->codigo_procedimiento = "'CT_GESSIS_COUNT'";

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
	 * Nombre de la funci�n:	InsertarGestionSubsistema
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tct_gestion_subsistema
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-01 14:49:34
	 */
	function InsertarGestionSubsistema($id_gestion_subsistema,$id_gestion,$estado_gestion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_gestion_subsistema_iud';
		$this->codigo_procedimiento = "'CT_GESSIS_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_gestion);
		$this->var->add_param("'$estado_gestion'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarGestionSubsistema
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tct_gestion_subsistema
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-01 14:49:34
	 */
	function ModificarGestionSubsistema($id_gestion_subsistema,$id_gestion,$estado_gestion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_gestion_subsistema_iud';
		$this->codigo_procedimiento = "'CT_GESSIS_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_gestion_subsistema);
		$this->var->add_param($id_gestion);
		$this->var->add_param("'$estado_gestion'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarGestionSubsistema
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tct_gestion_subsistema
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-01 14:49:34
	 */
	function EliminarGestionSubsistema($id_gestion_subsistema)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_gestion_subsistema_iud';
		$this->codigo_procedimiento = "'CT_GESSIS_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_gestion_subsistema);
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
	 * Nombre de la funci�n:	ValidarGestionSubsistema
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tct_gestion_subsistema
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-01 14:49:34
	 */
	function ValidarGestionSubsistema($operacion_sql,$id_gestion_subsistema,$id_gestion,$estado_gestion)
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
				//Validar id_gestion_subsistema - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_gestion_subsistema");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_gestion_subsistema", $id_gestion_subsistema))
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

			//Validar estado_gestion - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_gestion");
			$tipo_dato->set_MaxLength(15);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado_gestion", $estado_gestion))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_gestion_subsistema - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_gestion_subsistema");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_gestion_subsistema", $id_gestion_subsistema))
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