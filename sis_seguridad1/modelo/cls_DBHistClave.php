<?php
/**
 * Nombre de la clase:	cls_DBHistClave.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tsg_tsg_hist_clave
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-10-26 17:45:40
 */

class cls_DBHistClave
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
	 * Nombre de la funci�n:	ListarHistClave
	 * Prop�sito:				Desplegar los registros de tsg_hist_clave
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-26 17:45:40
	 */
	function ListarHistClave($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_hist_clave_sel';
		$this->codigo_procedimiento = "'SG_HISCLA_SEL'";

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
		$this->var->add_def_cols('id_hist_clave','int4');
		$this->var->add_def_cols('id_usuario','int4');
		$this->var->add_def_cols('desc_usuario','int4');
		$this->var->add_def_cols('fecha_cambio','date');
		$this->var->add_def_cols('hora_cambio','time');
		$this->var->add_def_cols('contrasenia_anterior','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarHistClave
	 * Prop�sito:				Contar los registros de tsg_hist_clave
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-26 17:45:40
	 */
	function ContarHistClave($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_hist_clave_sel';
		$this->codigo_procedimiento = "'SG_HISCLA_COUNT'";

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
	 * Nombre de la funci�n:	InsertarHistClave
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tsg_hist_clave
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-26 17:45:40
	 */
	function InsertarHistClave($id_hist_clave,$id_usuario,$fecha_cambio,$hora_cambio,$contrasenia_anterior)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_hist_clave_iud';
		$this->codigo_procedimiento = "'SG_HISCLA_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_usuario);
		$this->var->add_param("'$fecha_cambio'");
		$this->var->add_param("'$hora_cambio'");
		$this->var->add_param("'$contrasenia_anterior'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarHistClave
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tsg_hist_clave
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-26 17:45:40
	 */
	function ModificarHistClave($id_hist_clave,$id_usuario,$fecha_cambio,$hora_cambio,$contrasenia_anterior)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_hist_clave_iud';
		$this->codigo_procedimiento = "'SG_HISCLA_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_hist_clave);
		$this->var->add_param($id_usuario);
		$this->var->add_param("'$fecha_cambio'");
		$this->var->add_param("'$hora_cambio'");
		$this->var->add_param("'$contrasenia_anterior'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarHistClave
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tsg_hist_clave
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-26 17:45:40
	 */
	function EliminarHistClave($id_hist_clave)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_hist_clave_iud';
		$this->codigo_procedimiento = "'SG_HISCLA_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_hist_clave);
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
	 * Nombre de la funci�n:	ValidarHistClave
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tsg_hist_clave
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-26 17:45:40
	 */
	function ValidarHistClave($operacion_sql,$id_hist_clave,$id_usuario,$fecha_cambio,$hora_cambio,$contrasenia_anterior)
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
				//Validar id_hist_clave - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_hist_clave");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_hist_clave", $id_hist_clave))
				{
					$this->salida = $valid->salida;
					return false;
				}
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

			//Validar fecha_cambio - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_cambio");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_cambio", $fecha_cambio))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar hora_cambio - tipo time
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("hora_cambio");
			$tipo_dato->set_MaxLength(8);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoTime(), "hora_cambio", $hora_cambio))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar contrasenia_anterior - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("contrasenia_anterior");
			$tipo_dato->set_MaxLength(20);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "contrasenia_anterior", $contrasenia_anterior))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_hist_clave - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_hist_clave");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_hist_clave", $id_hist_clave))
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