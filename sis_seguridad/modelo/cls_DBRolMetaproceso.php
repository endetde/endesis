<?php
/**
 * Nombre de la clase:	cls_DBRolMetaproceso.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tsg_tsg_rol_metaproceso
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-11-01 08:36:06
 */

class cls_DBRolMetaproceso
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
	 * Nombre de la funci�n:	ListarRolMetaproceso
	 * Prop�sito:				Desplegar los registros de tsg_rol_metaproceso
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-01 08:36:06
	 */
	function ListarRolMetaproceso($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_rol_metaproceso_sel';
		$this->codigo_procedimiento = "'SG_ROLMET_SEL'";

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
		$this->var->add_def_cols('id_rol_metaproceso','int4');
		$this->var->add_def_cols('id_rol','int4');
		$this->var->add_def_cols('desc_rol','varchar');
		$this->var->add_def_cols('id_metaproceso','int4');
		$this->var->add_def_cols('desc_metaproceso','text');
		$this->var->add_def_cols('nombre_corto','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	
	
	function ListarUsuarioRolMetaproceso($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_rol_metaproceso_sel';
		$this->codigo_procedimiento = "'SG_ROLMET_SEL_USU'";

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
		$this->var->add_def_cols('id_rol_metaproceso','int4');
		$this->var->add_def_cols('id_rol','int4');
		$this->var->add_def_cols('desc_rol','varchar');
		$this->var->add_def_cols('id_metaproceso','int4');
		$this->var->add_def_cols('desc_metaproceso','text');
		$this->var->add_def_cols('nombre_corto','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	
	
	/**
	 * Nombre de la funci�n:	ContarRolMetaproceso
	 * Prop�sito:				Contar los registros de tsg_rol_metaproceso
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-01 08:36:06
	 */
	function ContarRolMetaproceso($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_rol_metaproceso_sel';
		$this->codigo_procedimiento = "'SG_ROLMET_COUNT'";

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
	 * Nombre de la funci�n:	InsertarRolMetaproceso
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tsg_rol_metaproceso
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-01 08:36:06
	 */
	function InsertarRolMetaproceso($id_metaproceso_db,$id_rol,$id_metaproceso)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_rol_metaproceso_iud';
		$this->codigo_procedimiento = "'SG_ROLMET_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_metaproceso_db);
		$this->var->add_param($id_rol);
		$this->var->add_param($id_metaproceso);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
 //echo $this->query;exit;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarRolMetaproceso
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tsg_rol_metaproceso
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-01 08:36:06
	 */
	function ModificarRolMetaproceso($id_rol_metaproceso,$id_rol,$id_metaproceso)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_rol_metaproceso_iud';
		$this->codigo_procedimiento = "'SG_ROLMET_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_rol_metaproceso);
		$this->var->add_param($id_rol);
		$this->var->add_param($id_metaproceso);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;  

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarRolMetaproceso
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tsg_rol_metaproceso
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-01 08:36:06
	 */
	function EliminarRolMetaproceso($id_metaproceso_db,$id_rol,$id_metaproceso)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_rol_metaproceso_iud';
		$this->codigo_procedimiento = "'SG_ROLMET_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_metaproceso_db);
		$this->var->add_param($id_rol);
		$this->var->add_param($id_metaproceso);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarRolMetaproceso
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tsg_rol_metaproceso
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-01 08:36:06
	 */
	function ValidarRolMetaproceso($operacion_sql,$id_rol_metaproceso,$id_rol,$id_metaproceso)
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
				//Validar id_rol_metaproceso - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_rol_metaproceso");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_rol_metaproceso", $id_rol_metaproceso))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_rol - tipo int4
			$tipo_dato->_reiniciar_valor();     
			$tipo_dato->set_Columna("id_rol");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_rol", $id_rol))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_metaproceso - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_metaproceso");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_metaproceso", $id_metaproceso))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_rol_metaproceso - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_rol_metaproceso");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_rol_metaproceso", $id_rol_metaproceso))
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