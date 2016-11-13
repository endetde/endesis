<?php
/**
 * Nombre de la clase:	cls_DBCuentaEjercicio.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tct_tct_cuenta_ejercicio
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-10-16 11:36:59
 */

 
class cls_DBCuentaEjercicio
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
	 * Nombre de la funci�n:	ListarCuentaEjecricio
	 * Prop�sito:				Desplegar los registros de tct_cuenta_ejercicio
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-16 11:36:59
	 */
	function ListarCuentaEjecricio($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_cuenta_ejercicio_sel';
		$this->codigo_procedimiento = "'CT_REFCTA_SEL'";

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
		$this->var->add_def_cols('id_ejercicio','int4');
		$this->var->add_def_cols('id_partida_cuenta','int4');
		$this->var->add_def_cols('desc_parcta','text');
		$this->var->add_def_cols('tipo_ejercicio','numeric');
		$this->var->add_def_cols('desc_ejercicio','varchar');
		$this->var->add_def_cols('gestion_conta','numeric');
		$this->var->add_def_cols('id_auxiliar','integer');
		$this->var->add_def_cols('desc_auxiliar','text');


		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarCuentaEjecricio
	 * Prop�sito:				Contar los registros de tct_cuenta_ejercicio
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-16 11:36:59
	 */
	function ContarCuentaEjecricio($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_cuenta_ejercicio_sel';
		$this->codigo_procedimiento = "'CT_REFCTA_COUNT'";

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
	 * Nombre de la funci�n:	InsertarCuentaEjecricio
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tct_cuenta_ejercicio
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-16 11:36:59
	 */
	function InsertarCuentaEjecricio($id_ejercicio,$id_partida_cuenta,$tipo_ejercicio,$desc_ejercicio,$id_gestion,$id_auxiliar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_cuenta_ejercicio_iud';
		$this->codigo_procedimiento = "'CT_REFCTA_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_partida_cuenta);
		$this->var->add_param($tipo_ejercicio);
		$this->var->add_param("'$desc_ejercicio'");
		$this->var->add_param($id_gestion);
		$this->var->add_param($id_auxiliar);
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarCuentaEjecricio
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tct_cuenta_ejercicio
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-16 11:36:59
	 */
	function ModificarCuentaEjecricio($id_ejercicio,$id_partida_cuenta,$tipo_ejercicio,$desc_ejercicio,$id_gestion,$id_auxiliar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_cuenta_ejercicio_iud';
		$this->codigo_procedimiento = "'CT_REFCTA_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_ejercicio);
		$this->var->add_param($id_partida_cuenta);
		$this->var->add_param($tipo_ejercicio);
		$this->var->add_param("'$desc_ejercicio'");
		$this->var->add_param("$id_gestion");
		$this->var->add_param("$id_auxiliar");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarCuentaEjecricio
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tct_cuenta_ejercicio
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-16 11:36:59
	 */
	function EliminarCuentaEjecricio($id_ejercicio)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_cuenta_ejercicio_iud';
		$this->codigo_procedimiento = "'CT_REFCTA_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_ejercicio);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//desc_ejercicio
		$this->var->add_param("NULL");//desc_ejercicio
		$this->var->add_param("NULL");//desc_ejercicio

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarCuentaEjecricio
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tct_cuenta_ejercicio
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-16 11:36:59
	 */
	function ValidarCuentaEjecricio($operacion_sql,$id_ejercicio,$id_partida_cuenta,$tipo_ejercicio,$desc_ejercicio,$id_gestion,$id_auxiliar)
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
				//Validar id_ejercicio - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_ejercicio");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_ejercicio", $id_ejercicio))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_cuenta - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_partida_cuenta");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_partida_cuenta", $id_partida_cuenta))
			{
				$this->salida = $valid->salida;
				return false;
			}
	//Validar id_cuenta - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_auxiliar");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_auxiliar", $id_auxiliar))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar tipo_ejercicio - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("tipo_ejercicio");
			$tipo_dato->set_MaxLength(131072);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "tipo_ejercicio", $tipo_ejercicio))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
			
			//Validar nro_linea - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("desc_ejercicio");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "desc_ejercicio", $desc_ejercicio))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validar $id_gestion - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_gestion");

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
			//Validar id_ejercicio - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_ejercicio");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_ejercicio", $id_ejercicio))
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