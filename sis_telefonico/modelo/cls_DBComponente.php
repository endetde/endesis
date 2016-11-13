<?php
/**
 * Nombre de la clase:	cls_DBComponente.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tst_tst_componente
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2016-04-18 19:44:10
 */

class cls_DBComponente
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
	 * Nombre de la funci�n:	ListarComponente
	 * Prop�sito:				Desplegar los registros de tst_componente
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-01-18 19:44:10
	 */
	function ListarComponente($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'gestel.f_tst_componente_sel';
		$this->codigo_procedimiento = "'ST_COMPON_SEL'";

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
		$this->var->add_def_cols('id_componente','int4');
		//$this->var->add_def_cols('imei','varchar');
		$this->var->add_def_cols('sim_card','varchar');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('fecha_ini','date');
		$this->var->add_def_cols('fecha_fin','date');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('usuario_reg','varchar');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarComponente
	 * Prop�sito:				Contar los registros de tst_componente
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-01-18 19:44:10
	 */
	function ContarComponente($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'gestel.f_tst_componente_sel';
		$this->codigo_procedimiento = "'ST_COMPON_COUNT'";

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
	 * Nombre de la funci�n:	InsertarComponente
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tst_componente
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2016-04-18 19:44:10
	 */
	function InsertarComponente($id_componente, $imei,$sim_card, $fecha_ini,$fecha_fin, $estado_reg)
	{
		$this->salida = "";
		$this->nombre_funcion = 'gestel.f_tst_componente_iud';
		$this->codigo_procedimiento = "'ST_COMPON_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$imei'");
		$this->var->add_param("'$sim_card'");
		$this->var->add_param("'$fecha_ini'");
		$this->var->add_param("'$fecha_fin'");
		$this->var->add_param("'$estado_reg'");
        
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarComponente
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tst_componente
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-01-18 19:44:10
	 */
	function ModificarComponente($id_componente, $imei,$sim_card, $fecha_ini,$fecha_fin, $estado_reg)
	{
		$this->salida = "";
		$this->nombre_funcion = 'gestel.f_tst_componente_iud';
		$this->codigo_procedimiento = "'ST_COMPON_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_componente);
		$this->var->add_param("'$imei'");
		$this->var->add_param("'$sim_card'");
		$this->var->add_param("'$fecha_ini'");
		$this->var->add_param("'$fecha_fin'");
		$this->var->add_param("'$estado_reg'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarComponente
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tst_componente
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-01-18 19:44:10
	 */
	function EliminarComponente($id_componente)
	{
		$this->salida = "";
		$this->nombre_funcion = 'gestel.f_tst_componente_iud';
		$this->codigo_procedimiento = "'ST_COMPON_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_componente);
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
	 * Nombre de la funci�n:	ValidarComponente
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tst_componente
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-01-18 19:44:10
	 */
	function ValidarComponente($operacion_sql,$id_componente, $imei,$sim_card, $fecha_ini,$fecha_fin, $estado_reg)
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
				//Validar id_componente - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_componente");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_componente", $id_componente))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar empresa - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("imei");
			$tipo_dato->set_MaxLength(100);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "imei", $imei))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar puerto_componente - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("sim_card");
			$tipo_dato->set_MaxLength(100);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "sim_card", $sim_card))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_componente - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_componente");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_componente", $id_componente))
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