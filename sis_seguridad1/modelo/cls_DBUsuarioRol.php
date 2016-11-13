<?php
/**
 * Nombre de la clase:	cls_DBUsuarioRol.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tsg_tsg_usuario_rol
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-10-26 17:44:19
 */

class cls_DBUsuarioRol
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
	 * Nombre de la funci�n:	ListarUsuarioRol
	 * Prop�sito:				Desplegar los registros de tsg_usuario_rol
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-26 17:44:19
	 */
	function ListarUsuarioRol($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_usuario_rol_sel';
		$this->codigo_procedimiento = "'SG_USUROL_SEL'";

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
		$this->var->add_def_cols('id_usuario_rol','int4');
		$this->var->add_def_cols('id_rol','int4');
		$this->var->add_def_cols('desc_rol','varchar');
		$this->var->add_def_cols('id_usuario','int4');
		$this->var->add_def_cols('desc_usuario','int4');
		$this->var->add_def_cols('descripcion','varchar');
		
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('fecha_inactivacion','date');
		$this->var->add_def_cols('usuario_reg','varchar');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
//		echo $this->query;
//		exit;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarUsuarioRol
	 * Prop�sito:				Contar los registros de tsg_usuario_rol
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-26 17:44:19
	 */
	function ContarUsuarioRol($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_usuario_rol_sel';
		$this->codigo_procedimiento = "'SG_USUROL_COUNT'";

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
	 * Nombre de la funci�n:	InsertarUsuarioRol
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tsg_usuario_rol
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-26 17:44:19
	 */
	function InsertarUsuarioRol($id_usuario_rol,$id_rol,$id_usuario
	//,$descripcion, $estado_reg
	)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_usuario_rol_iud';
		$this->codigo_procedimiento = "'SG_USUROL_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_rol);
		$this->var->add_param($id_usuario);
		//$this->var->add_param("'$descripcion'");
		//$this->var->add_param("null");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarUsuarioRol
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tsg_usuario_rol
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-26 17:44:19
	 */
	function ModificarUsuarioRol($id_usuario_rol,$id_rol,$id_usuario
	//, $descripcion, $estado_reg
	)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_usuario_rol_iud';
		$this->codigo_procedimiento = "'SG_USUROL_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_usuario_rol);
		$this->var->add_param($id_rol);
		$this->var->add_param($id_usuario);
		//$this->var->add_param("'$descripcion'");
		//$this->var->add_param("'$estado_reg'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarUsuarioRol
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tsg_usuario_rol
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-26 17:44:19
	 */
	function EliminarUsuarioRol($id_usuario_rol)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_usuario_rol_iud';
		$this->codigo_procedimiento = "'SG_USUROL_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_usuario_rol);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		//$this->var->add_param("NULL");
		//$this->var->add_param("NULL");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarUsuarioRol
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tsg_usuario_rol
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-26 17:44:19
	 */
	function ValidarUsuarioRol($operacion_sql,$id_usuario_rol,$id_rol,$id_usuario)
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
				//Validar id_usuario_rol - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_usuario_rol");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_usuario_rol", $id_usuario_rol))
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

			//Validar id_usuario - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_usuario");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_usuario", $id_usuario))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_usuario_rol - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_usuario_rol");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_usuario_rol", $id_usuario_rol))
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