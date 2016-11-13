<?php
/**
 * Nombre de la clase:	cls_DBProgramaProyectoActividad.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpm_tpm_programa_proyecto_actividad
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-11-06 16:42:14
 */

class cls_DBProgramaProyectoActividad
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
	 * Nombre de la funci�n:	ListarProgramaProyectoActividad
	 * Prop�sito:				Desplegar los registros de tpm_programa_proyecto_actividad
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-06 16:42:14
	 */
	function ListarProgramaProyectoActividad($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_programa_proyecto_actividad_sel';
		$this->codigo_procedimiento = "'PM_PGPYAC_SEL'";

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
		$this->var->add_def_cols('id_prog_proy_acti','int4');
		$this->var->add_def_cols('id_programa','int4');
		$this->var->add_def_cols('desc_programa','text');
		$this->var->add_def_cols('id_proyecto','int4');
		$this->var->add_def_cols('desc_proyecto','text');
		$this->var->add_def_cols('id_actividad','int4');
		$this->var->add_def_cols('desc_actividad','text');
		$this->var->add_def_cols('desc_prog_proy_acti','text');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		$this->var->add_def_cols('cod_prog_proy_acti','text');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('codigo_proyecto','varchar');
		$this->var->add_def_cols('codigo_actividad','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarProgramaProyectoActividad
	 * Prop�sito:				Contar los registros de tpm_programa_proyecto_actividad
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-06 16:42:14
	 */
	function ContarProgramaProyectoActividad($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_programa_proyecto_actividad_sel';
		$this->codigo_procedimiento = "'PM_PGPYAC_COUNT'";

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
	 * Nombre de la funci�n:	InsertarProgramaProyectoActividad
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpm_programa_proyecto_actividad
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-06 16:42:14
	 */
	function InsertarProgramaProyectoActividad($id_prog_proy_acti,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_programa_proyecto_actividad_iud';
		$this->codigo_procedimiento = "'PM_PGPYAC_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_programa);
		$this->var->add_param($id_proyecto);
		$this->var->add_param($id_actividad);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarProgramaProyectoActividad
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpm_programa_proyecto_actividad
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-06 16:42:14
	 */
	function ModificarProgramaProyectoActividad($id_prog_proy_acti,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_programa_proyecto_actividad_iud';
		$this->codigo_procedimiento = "'PM_PGPYAC_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_prog_proy_acti);
		$this->var->add_param($id_programa);
		$this->var->add_param($id_proyecto);
		$this->var->add_param($id_actividad);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarProgramaProyectoActividad
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpm_programa_proyecto_actividad
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-06 16:42:14
	 */
	function EliminarProgramaProyectoActividad($id_prog_proy_acti)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_programa_proyecto_actividad_iud';
		$this->codigo_procedimiento = "'PM_PGPYAC_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_prog_proy_acti);
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
	 * Nombre de la funci�n:	ValidarProgramaProyectoActividad
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpm_programa_proyecto_actividad
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-06 16:42:14
	 */
	function ValidarProgramaProyectoActividad($operacion_sql,$id_prog_proy_acti,$id_programa,$id_proyecto,$id_actividad)
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
				//Validar id_prog_proy_acti - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_prog_proy_acti");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_prog_proy_acti", $id_prog_proy_acti))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_programa - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_programa");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_programa", $id_programa))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_proyecto - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_proyecto");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_proyecto", $id_proyecto))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_actividad - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_actividad");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_actividad", $id_actividad))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_prog_proy_acti - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_prog_proy_acti");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_prog_proy_acti", $id_prog_proy_acti))
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