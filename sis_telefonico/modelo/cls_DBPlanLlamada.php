<?php
/**
 * Nombre de la clase:	cls_DBPlanLlamada.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tst_tst_plan_llamada
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2016-04-18 19:44:10
 */

class cls_DBPlanLlamada
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
	 * Nombre de la funci�n:	ListarPlanLlamada
	 * Prop�sito:				Desplegar los registros de tst_plan_llamada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-01-18 19:44:10
	 */
	function ListarPlanLlamada($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'gestel.f_tst_plan_llamada_sel';
		$this->codigo_procedimiento = "'ST_PLALLAM_SEL'";

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
		$this->var->add_def_cols('id_plan_llamada','int4');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('monto_llamada','numeric');
		$this->var->add_def_cols('monto_datos','numeric');
		$this->var->add_def_cols('tarifa_win','numeric');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('usuario_reg','varchar');
		$this->var->add_def_cols('fecha_ini','date');
		$this->var->add_def_cols('fecha_fin','date');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarPlanLlamada
	 * Prop�sito:				Contar los registros de tst_plan_llamada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-01-18 19:44:10
	 */
	function ContarPlanLlamada($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'gestel.f_tst_plan_llamada_sel';
		$this->codigo_procedimiento = "'ST_PLALLAM_COUNT'";

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
	 * Nombre de la funci�n:	InsertarPlanLlamada
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tst_plan_llamada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2016-04-18 19:44:10
	 */
	function InsertarPlanLlamada($id_plan_llamada, $nombre,$descripcion,$monto_llamada,$monto_datos,$tarifa_win, $fecha_ini,$fecha_fin)
	{
		$this->salida = "";
		$this->nombre_funcion = 'gestel.f_tst_plan_llamada_iud';
		$this->codigo_procedimiento = "'ST_PLALLAM_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$nombre'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$monto_llamada'");
		$this->var->add_param("'$monto_datos'");
        $this->var->add_param("'$tarifa_win'");
        $this->var->add_param("null");
        $this->var->add_param("'$fecha_ini'");
        $this->var->add_param("'$fecha_fin'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarPlanLlamada
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tst_plan_llamada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-01-18 19:44:10
	 */
	function ModificarPlanLlamada($id_plan_llamada, $nombre,$descripcion,$monto_llamada,$monto_datos,$tarifa_win, $estado_reg, $fecha_ini,$fecha_fin)
	{
		$this->salida = "";
		$this->nombre_funcion = 'gestel.f_tst_plan_llamada_iud';
		$this->codigo_procedimiento = "'ST_PLALLAM_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_plan_llamada);
		$this->var->add_param("'$nombre'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$monto_llamada'");
		$this->var->add_param("'$monto_datos'");
        $this->var->add_param("'$tarifa_win'");
        $this->var->add_param("'$estado_reg'");
        $this->var->add_param("'$fecha_ini'");
        $this->var->add_param("'$fecha_fin'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarPlanLlamada
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tst_plan_llamada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-01-18 19:44:10
	 */
	function EliminarPlanLlamada($id_plan_llamada)
	{
		$this->salida = "";
		$this->nombre_funcion = 'gestel.f_tst_plan_llamada_iud';
		$this->codigo_procedimiento = "'ST_PLALLAM_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_plan_llamada);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
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
	 * Nombre de la funci�n:	ValidarPlanLlamada
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tst_plan_llamada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-01-18 19:44:10
	 */
	function ValidarPlanLlamada($operacion_sql,$id_plan_llamada, $nombre,$descripcion,$monto_llamada,$monto_datos,$tarifa_win)
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
				//Validar id_plan_llamada - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_plan_llamada");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_plan_llamada", $id_plan_llamada))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar empresa - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nombre");
			$tipo_dato->set_MaxLength(100);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "nombre", $nombre))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar puerto_plan_llamada - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(100);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion))
			{
				$this->salida = $valid->salida;
				return false;
			}

			
			
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_plan_llamada - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_plan_llamada");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_plan_llamada", $id_plan_llamada))
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