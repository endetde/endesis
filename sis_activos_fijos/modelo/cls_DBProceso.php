<?php
/**
 * Nombre de la clase:	cls_DBProceso.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla taf_taf_proceso
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2010-10-13 17:05:17
 */

 
class cls_DBProceso
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
	 * Nombre de la funci�n:	ListarProceso
	 * Prop�sito:				Desplegar los registros de taf_proceso
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-10-13 17:05:17
	 */
	function ListarProceso($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_proceso_sel';
		$this->codigo_procedimiento = "'AF_PROC_SEL'";

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
		$this->var->add_def_cols('id_proceso','integer');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('codigo','varchar');
		$this->var->add_def_cols('sw_aprobar','varchar');
		$this->var->add_def_cols('sw_contabilizar','varchar');
		$this->var->add_def_cols('sw_registrar','varchar');
		$this->var->add_def_cols('sw_bien_responsabilidad','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarProceso
	 * Prop�sito:				Contar los registros de taf_proceso
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-10-13 17:05:17
	 */
	function ContarProceso($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_proceso_sel';
		$this->codigo_procedimiento = "'AF_PROC_COUNT'";

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
	 * Nombre de la funci�n:	InsertarProceso
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla taf_proceso
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-10-13 17:05:17
	 */
	function InsertarProceso($descripcion,$codigo,$sw_aprobar,$sw_contabilizar,$sw_registrar,$sw_bien_responsabilidad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_proceso_iud';
		$this->codigo_procedimiento = "'AF_PROC_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$codigo'");
		$this->var->add_param("'$sw_aprobar'");
		$this->var->add_param("'$sw_contabilizar'");
		$this->var->add_param("'$sw_registrar'");
		$this->var->add_param("'$sw_bien_responsabilidad'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarProceso
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla taf_proceso
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-10-13 17:05:17
	 */
	function ModificarProceso($id_proceso,$descripcion,$codigo,$sw_aprobar,$sw_contabilizar,$sw_registrar,$sw_bien_responsabilidad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_proceso_iud';
		$this->codigo_procedimiento = "'AF_PROC_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_proceso);
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$codigo'");
		$this->var->add_param("'$sw_aprobar'");
		$this->var->add_param("'$sw_contabilizar'");
		$this->var->add_param("'$sw_registrar'");
		$this->var->add_param("'$sw_bien_responsabilidad'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarProceso
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla taf_proceso
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-10-13 17:05:17
	 */
	function EliminarProceso($id_proceso)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_proceso_iud';
		$this->codigo_procedimiento = "'AF_PROC_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_proceso);
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
	 * Nombre de la funci�n:	ValidarProceso
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla taf_proceso
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-10-13 17:05:17
	 */
	function ValidarProceso($operacion_sql,$id_proceso,$descripcion,$codigo)
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
				//Validar descripcion - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_proceso");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_proceso", $id_proceso))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar codigo - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("codigo");
			$tipo_dato->set_MaxLength(30);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "codigo", $codigo))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar descripcion - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_proceso");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_proceso", $id_proceso))
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