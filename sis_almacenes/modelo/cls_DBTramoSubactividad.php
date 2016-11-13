<?php
/**
 * Nombre de la clase:	cls_DBTramoSubactividad.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tal_tal_tramo_subactividad
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-03-31 11:15:31
 */

class cls_DBTramoSubactividad
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
	 * Nombre de la funci�n:	ListarTramoSubactividad
	 * Prop�sito:				Desplegar los registros de tal_tramo_subactividad
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-03-31 11:15:31
	 */
	function ListarTramoSubactividad($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_tramo_subactividad_sel';
		$this->codigo_procedimiento = "'AL_TRASAC_SEL'";

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
		$this->var->add_def_cols('id_tramo_subactividad','int4');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_subactividad','int4');
		$this->var->add_def_cols('desc_subactividad','varchar');
		$this->var->add_def_cols('id_tramo','int4');
		$this->var->add_def_cols('desc_tramo','varchar');
		$this->var->add_def_cols('codigo_tramo','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarTramoSubactividad
	 * Prop�sito:				Contar los registros de tal_tramo_subactividad
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-03-31 11:15:31
	 */
	function ContarTramoSubactividad($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_tramo_subactividad_sel';
		$this->codigo_procedimiento = "'AL_TRASAC_COUNT'";

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
	 * Nombre de la funci�n:	InsertarTramoSubactividad
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_tramo_subactividad
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-03-31 11:15:31
	 */
	function InsertarTramoSubactividad($id_tramo_subactividad,$fecha_reg,$id_subactividad,$id_tramo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_tramo_subactividad_iud';
		$this->codigo_procedimiento = "'AL_TRASAC_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_subactividad);
		$this->var->add_param($id_tramo);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarTramoSubactividad
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_tramo_subactividad
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-03-31 11:15:31
	 */
	function ModificarTramoSubactividad($id_tramo_subactividad,$fecha_reg,$id_subactividad,$id_tramo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_tramo_subactividad_iud';
		$this->codigo_procedimiento = "'AL_TRASAC_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_tramo_subactividad);
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_subactividad);
		$this->var->add_param($id_tramo);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarTramoSubactividad
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_tramo_subactividad
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-03-31 11:15:31
	 */
	function EliminarTramoSubactividad($id_tramo_subactividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_tramo_subactividad_iud';
		$this->codigo_procedimiento = "'AL_TRASAC_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_tramo_subactividad);
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
	 * Nombre de la funci�n:	ValidarTramoSubactividad
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tal_tramo_subactividad
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-03-31 11:15:31
	 */
	function ValidarTramoSubactividad($operacion_sql,$id_tramo_subactividad,$fecha_reg,$id_subactividad,$id_tramo)
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
				//Validar id_tramo_subactividad - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_tramo_subactividad");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tramo_subactividad", $id_tramo_subactividad))
				{
					$this->salida = $valid->salida;
					return false;
				}
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

			//Validar id_subactividad - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_subactividad");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_subactividad", $id_subactividad))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_tramo - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_tramo");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tramo", $id_tramo))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_tramo_subactividad - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_tramo_subactividad");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tramo_subactividad", $id_tramo_subactividad))
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