<?php
/**
 * Nombre de la clase:	cls_DBTipoProcesoDepto.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tfl_tipo_proceso_depto
 * Autor:				Williams Escobar 
 * Fecha creaci�n:		2010-12-27 17:04:51
 */

 
/*
* Se deben poner en comentario las funcion de selecci�n
* No se ha realizado ning�n cambio sobre esta clase.
* Se debe revisar el
* */
class cls_DBTipoProcesoDepto
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
	 * Nombre de la funci�n:	ListarTipoProcesoDepto
	 * Prop�sito:				Desplegar los registros de tfl_tipo_proceso_depto
	 * Autor:				    Williams Escobar
	 * Fecha de creaci�n:		2010-12-27 17:04:51
	 */
	function ListarTipoProcesoDepto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfl_tipo_proceso_depto_sel';
		$this->codigo_procedimiento = "'FL_TIPODE_SEL'";

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
		$this->var->add_def_cols('id_proceso_depto','int4');
		$this->var->add_def_cols('id_tipo_proceso','int4');
		$this->var->add_def_cols('id_depto','int4');		
		$this->var->add_def_cols('id_usuario_reg','int4');		
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('nombre_depto','varchar');//a�adido 30_12_2010
		

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarTipoProcesoDepto
	 * Prop�sito:				Contar los registros de tfl_tipo_proceso_depto
	 * Autor:				    Williams Escobar
	 * Fecha de creaci�n:		2010-12-27 17:04:51
	 */
	function ContarTipoProcesoDepto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfl_tipo_proceso_depto_sel';
		$this->codigo_procedimiento = "'FL_TIPODE_COUNT'";

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
	 * Nombre de la funci�n:	InsertarTipoProcesoDepto
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tfl_tipo_proceso_depto
	 * Autor:				    Williams Escobar
	 * Fecha de creaci�n:		2010-12-27 16:22:51
	 */
	function InsertarTipoProcesoDepto($id_tipo_proceso,$id_depto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfl_tipo_proceso_depto_iud';
		$this->codigo_procedimiento = "'FL_TIPODE_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");//id_proceso_depto
		$this->var->add_param($id_tipo_proceso);//id_tipo_proceso
		$this->var->add_param($id_depto);//id_depto		
		
		
        //Ejecuta la funci�n
		$res = $this->var->exec_non_query(); 

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
 
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
      
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarTipoProcesoDepto
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tfl_tipo_proceso_depto
	 * Autor:				    Williams Escobar
	 * Fecha de creaci�n:		2010-12-27 16:22:51
	 */
	function ModificarTipoProcesoDepto($id_proceso_depto,$id_tipo_proceso,$id_depto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfl_tipo_proceso_depto_iud';
		$this->codigo_procedimiento = "'FL_TIPODE_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_proceso_depto);
		$this->var->add_param($id_tipo_proceso);
		$this->var->add_param($id_depto);
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
      /* echo $this->query;
exit;*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarTipoProcesoDepto	
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tfl_tipo_proceso_depto
	 * Autor:				    Williams Escobar
	 * Fecha de creaci�n:		2010-12-27 16:22:51
	 */
	function EliminarTipoProcesoDepto($id_proceso_depto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfl_tipo_proceso_depto_iud';
		$this->codigo_procedimiento = "'FL_TIPODE_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_proceso_depto);
		$this->var->add_param("NULL");//id_tipo_proceso
		$this->var->add_param("NULL");//id_depto
		
        
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarTipoProcesoDepto
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tfl_tipo_proceso_depto
	 * Autor:				    Williams Escobar
	 * Fecha de creaci�n:		2010-12-26 16:31:51
	 */
	
			  
	function ValidarTipoProcesoDepto($operacion_sql,$id_proceso_depto,$id_tipo_proceso,$id_depto)
	{
		$this->salida = "";
		$valid = new cls_validacion_serv();

		//Clase para validar el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();
	
		//Ejecuta la validaci�n del $id_proceso_depto tipo integer
		if($operacion_sql=='insert' || $operacion_sql=='update')
		{
			if($operacion_sql == 'update')
			{
				//Validar id_tipo_proceso - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_proceso_depto");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_proceso_depto", $id_proceso_depto))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar $id_tipo_proceso - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_tipo_proceso");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_proceso",$id_tipo_proceso))
			{
				$this->salida = $valid->salida;
				return false;
			}

         //Validar $id_depto  - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_depto");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_depto", $id_depto))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
        return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_tipo_proceso - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_proceso_depto");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_proceso_depto", $id_proceso_depto))
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