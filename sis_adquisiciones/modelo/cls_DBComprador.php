<?php
/**
 * Nombre de la clase:	cls_DBComprador.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tad_tad_comprador
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-11-17 11:14:48
 */

 
class cls_DBComprador
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
	 * Nombre de la funci�n:	ListarComprador
	 * Prop�sito:				Desplegar los registros de tad_comprador
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-17 11:14:48
	 */
	function ListarComprador($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_comprador_sel';
		$this->codigo_procedimiento = "'AD_COMPRAD_SEL'";

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
		$this->var->add_def_cols('id_comprador','int4');
		$this->var->add_def_cols('id_empleado','int4');
		$this->var->add_def_cols('apellido_paterno_persona','varchar');
		$this->var->add_def_cols('apellido_materno_persona','varchar');
		$this->var->add_def_cols('nombre_persona','varchar');
		$this->var->add_def_cols('desc_empleado','text');
		$this->var->add_def_cols('fecha_asignacion','date');
		$this->var->add_def_cols('estado','varchar');
		
		$this->var->add_def_cols('id_depto','int4');
		$this->var->add_def_cols('codigo_depto','varchar');
		$this->var->add_def_cols('nombre_depto','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarComprador
	 * Prop�sito:				Contar los registros de tad_comprador
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-17 11:14:48
	 */
	function ContarComprador($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_comprador_sel';
		$this->codigo_procedimiento = "'AD_COMPRAD_COUNT'";

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
	 * Nombre de la funci�n:	InsertarComprador
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tad_comprador
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-17 11:14:48
	 */
	function InsertarComprador($id_comprador,$id_empleado,$fecha_asignacion,$estado,$id_depto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_comprador_iud';
		$this->codigo_procedimiento = "'AD_COMPRAD_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_empleado);
		$this->var->add_param("'$fecha_asignacion'");
		$this->var->add_param("'$estado'");
		$this->var->add_param($id_depto);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarComprador
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tad_comprador
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-17 11:14:48
	 */
	function ModificarComprador($id_comprador,$id_empleado,$fecha_asignacion,$estado,$id_depto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_comprador_iud';
		$this->codigo_procedimiento = "'AD_COMPRAD_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_comprador);
		$this->var->add_param($id_empleado);
		$this->var->add_param("'$fecha_asignacion'");
		$this->var->add_param("'$estado'");
		$this->var->add_param($id_depto);
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarComprador
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tad_comprador
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-17 11:14:48
	 */
	function EliminarComprador($id_comprador)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_comprador_iud';
		$this->codigo_procedimiento = "'AD_COMPRAD_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_comprador);
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
	 * Nombre de la funci�n:	ValidarComprador
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tad_comprador
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-17 11:14:48
	 */
	function ValidarComprador($operacion_sql,$id_comprador,$id_empleado,$fecha_asignacion,$estado)
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
				//Validar id_comprador - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_comprador");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_comprador", $id_comprador))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_empleado - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado", $id_empleado))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fecha_asignacion - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_asignacion");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_asignacion", $fecha_asignacion))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar estado - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado");
			$tipo_dato->set_MaxLength(18);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado", $estado))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_comprador - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_comprador");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_comprador", $id_comprador))
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