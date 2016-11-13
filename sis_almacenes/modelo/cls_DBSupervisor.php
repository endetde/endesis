<?php
/**
 * Nombre de la clase:	cls_DBSupervisor.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tal_supervisor
 * Autor:				RCM
 * Fecha creaci�n:		02/07/2008
 */

class cls_DBSupervisor
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
	 * Nombre de la funci�n:	ListarSupervisor
	 * Prop�sito:				Desplegar los registros de tal_estante
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-11 10:54:54
	 */
	function ListarSupervisor($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_supervisor_sel';
		$this->codigo_procedimiento = "'AL_SUPERV_SEL'";

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
		$this->var->add_param($func->iif($id_financiador == '','NULL',$id_financiador));//id_financiador
		$this->var->add_param($func->iif($id_regional == '','NULL',$id_regional));//id_regional
		$this->var->add_param($func->iif($id_programa == '','NULL',$id_programa));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '','NULL',$id_proyecto));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '','NULL',$id_actividad));//id_actividad

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_supervisor','integer');
		$this->var->add_def_cols('id_persona','integer');
		$this->var->add_def_cols('nombre_superv','text');
		$this->var->add_def_cols('doc_id','varchar');
		$this->var->add_def_cols('fecha_reg','date');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarSupervisor
	 * Prop�sito:				Contar los registros de tal_estante
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-11 10:54:54
	 */
	function ContarSupervisor($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_supervisor_sel';
		$this->codigo_procedimiento = "'AL_SUPERV_COUNT'";

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
		$this->var->add_param($func->iif($id_financiador == '','NULL',$id_financiador));//id_financiador
		$this->var->add_param($func->iif($id_regional == '','NULL',$id_regional));//id_regional
		$this->var->add_param($func->iif($id_programa == '','NULL',$id_programa));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '','NULL',$id_proyecto));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '','NULL',$id_actividad));//id_actividad
		
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
	 * Nombre de la funci�n:	InsertarSupervisor
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_estante
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-11 10:54:54
	 */
	function InsertarSupervisor($id_supervisor,$id_persona,$fecha_reg)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_supervisor_iud';
		$this->codigo_procedimiento = "'AL_SUPERV_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("$id_persona");
		$this->var->add_param("'$fecha_reg'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarSupervisor
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_estante
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-11 10:54:54
	 */
	function ModificarSupervisor($id_supervisor,$id_persona,$fecha_reg)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_supervisor_iud';
		$this->codigo_procedimiento = "'AL_SUPERV_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_supervisor);
		$this->var->add_param("$id_persona");
		$this->var->add_param("'$fecha_reg'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarSupervisor
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_estante
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-11 10:54:54
	 */
	function EliminarSupervisor($id_supervisor)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_supervisor_iud';
		$this->codigo_procedimiento = "'AL_SUPERV_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_supervisor);
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
	 * Nombre de la funci�n:	ValidarSupervisor
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tal_estante
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-11 10:54:54
	 */
	function ValidarSupervisor($operacion_sql,$id_supervisor,$id_persona,$fecha_reg)
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
				//Validar id_estante - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_supervisor");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_supervisor", $id_supervisor))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_persona - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_persona");
			$tipo_dato->set_MaxLength(20);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_persona", $id_persona))
			{
				$this->salida = $valid->salida;
				return false;
			}

			
			//Validar fecha_reg - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_reg");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_reg", $fecha_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			
				//Validaci�n exitosa
				return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_supervisor - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_supervisor");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_supervisor", $id_supervisor))
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