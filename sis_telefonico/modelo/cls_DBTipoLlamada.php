<?php
/**
 * Nombre de la clase:	cls_DBTipoLlamada.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tst_tst_tipo_llamada
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-01-17 18:29:44
 */

class cls_DBTipoLlamada
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
	 * Nombre de la funci�n:	ListarTipoLlamada
	 * Prop�sito:				Desplegar los registros de tst_tipo_llamada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-01-17 18:29:44
	 */
	function ListarTipoLlamada($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'gestel.f_tst_tipo_llamada_sel';
		$this->codigo_procedimiento = "'ST_TIPLLA_SEL'";

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
		$this->var->add_def_cols('id_tipo_llamada','int4');
		$this->var->add_def_cols('nombre_tipo_llamada','varchar');
		$this->var->add_def_cols('costo_minuto','numeric');
		$this->var->add_def_cols('descripcion','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarTipoLlamada
	 * Prop�sito:				Contar los registros de tst_tipo_llamada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-01-17 18:29:44
	 */
	function ContarTipoLlamada($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'gestel.f_tst_tipo_llamada_sel';
		$this->codigo_procedimiento = "'ST_TIPLLA_COUNT'";

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
	 * Nombre de la funci�n:	InsertarTipoLlamada
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tst_tipo_llamada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-01-17 18:29:44
	 */
	function InsertarTipoLlamada($id_tipo_llamada,$nombre_tipo_llamada,$costo_minuto,$descripcion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'gestel.f_tst_tipo_llamada_iud';
		$this->codigo_procedimiento = "'ST_TIPLLA_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$nombre_tipo_llamada'");
		$this->var->add_param($costo_minuto);
		$this->var->add_param("'$descripcion'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarTipoLlamada
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tst_tipo_llamada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-01-17 18:29:44
	 */
	function ModificarTipoLlamada($id_tipo_llamada,$nombre_tipo_llamada,$costo_minuto,$descripcion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'gestel.f_tst_tipo_llamada_iud';
		$this->codigo_procedimiento = "'ST_TIPLLA_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_tipo_llamada);
		$this->var->add_param("'$nombre_tipo_llamada'");
		$this->var->add_param($costo_minuto);
		$this->var->add_param("'$descripcion'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarTipoLlamada
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tst_tipo_llamada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-01-17 18:29:44
	 */
	function EliminarTipoLlamada($id_tipo_llamada)
	{
		$this->salida = "";
		$this->nombre_funcion = 'gestel.f_tst_tipo_llamada_iud';
		$this->codigo_procedimiento = "'ST_TIPLLA_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_tipo_llamada);
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
	 * Nombre de la funci�n:	ValidarTipoLlamada
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tst_tipo_llamada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-01-17 18:29:44
	 */
	function ValidarTipoLlamada($operacion_sql,$id_tipo_llamada,$nombre_tipo_llamada,$costo_minuto,$descripcion)
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
				//Validar id_tipo_llamada - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_tipo_llamada");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_llamada", $id_tipo_llamada))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar nombre_tipo_llamada - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nombre_tipo_llamada");
			$tipo_dato->set_MaxLength(30);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "nombre_tipo_llamada", $nombre_tipo_llamada))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar costo_minuto - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("costo_minuto");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "costo_minuto", $costo_minuto))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar descripcion - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(150);
			$tipo_dato->set_AllowBlank("true");
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
			//Validar id_tipo_llamada - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_tipo_llamada");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_llamada", $id_tipo_llamada))
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