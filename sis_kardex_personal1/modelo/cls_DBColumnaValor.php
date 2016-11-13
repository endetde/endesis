<?php
/**
 * Nombre de la clase:	cls_DBColumnaValor.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tkp_tkp_columna_valor
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2010-08-30 15:43:31
 */

 
class cls_DBColumnaValor
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
	 * Nombre de la funci�n:	ListarColumnaValor
	 * Prop�sito:				Desplegar los registros de tkp_columna_valor
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-30 15:43:31
	 */
	function ListarColumnaValor($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_columna_valor_sel';
		$this->codigo_procedimiento = "'KP_COLVAL_SEL'";

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
		$this->var->add_def_cols('id_columna_valor','int8');
		$this->var->add_def_cols('id_empleado_planilla','int4');
		$this->var->add_def_cols('id_columna','int4');
		$this->var->add_def_cols('valor','numeric');
		$this->var->add_def_cols('valor_automatico','numeric');
		$this->var->add_def_cols('usuario_reg','int4');
		$this->var->add_def_cols('fecha_reg','timestamp');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('nombre_columna','varchar');
		$this->var->add_def_cols('formula','varchar');
		$this->var->add_def_cols('tipo_dato','varchar');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarColumnaValor
	 * Prop�sito:				Contar los registros de tkp_columna_valor
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-30 15:43:31
	 */
	function ContarColumnaValor($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_columna_valor_sel';
		$this->codigo_procedimiento = "'KP_COLVAL_COUNT'";

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
		
		//echo $this->query;exit;

		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	InsertarColumnaValor
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_columna_valor
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-30 15:43:31
	 */
	function InsertarColumnaValor($id_columna_valor,$valor)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_columna_valor_iud';
		$this->codigo_procedimiento = "'KP_COLVAL_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($valor);
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
	 * Nombre de la funci�n:	InsertarColumnaValor
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_columna_valor
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-30 15:43:31
	 */
	function InsertarColumnaValorArray($id_empleado_planilla_array,$id_columna_array,$id_valor_array,$tam)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_columna_valor_array_iud';
		$this->codigo_procedimiento = "'KP_COLVALM_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param_array($id_empleado_planilla_array);
		$this->var->add_param_array($id_columna_array);
		$this->var->add_param_array($id_valor_array);
		$this->var->add_param($tam);
     	//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarColumnaValor
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_columna_valor
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-30 15:43:31
	 */
	function ModificarColumnaValor($id_columna_valor,$valor)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_columna_valor_iud';
		$this->codigo_procedimiento = "'KP_COLVAL_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_columna_valor);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($valor);
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
	 * Nombre de la funci�n:	EliminarColumnaValor
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tkp_columna_valor
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-30 15:43:31
	 */
	function EliminarColumnaValor($id_columna_valor)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_columna_valor_iud';
		$this->codigo_procedimiento = "'KP_COLVAL_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_columna_valor);
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
	 * Nombre de la funci�n:	ValidarColumnaValor
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tkp_columna_valor
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-30 15:43:31
	 */
	function ValidarColumnaValor($operacion_sql,$id_columna_valor,$valor)
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
				//Validar id_columna_valor - tipo int8
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_columna_valor");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_columna_valor", $id_columna_valor))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_empleado_planilla - tipo int4
			/*$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado_planilla");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado_planilla", $id_empleado_planilla))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_columna - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_columna");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_columna", $id_columna))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar valor - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("valor");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "valor", $valor))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar valor_automatico - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("valor_automatico");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "valor_automatico", $valor_automatico))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar usuario_reg - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("usuario_reg");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "usuario_reg", $usuario_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fecha_reg - tipo timestamp
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_reg");
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_reg", $fecha_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar estado_reg - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_reg");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado_reg", $estado_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}*/
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_columna_valor - tipo int8
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_columna_valor");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_columna_valor", $id_columna_valor))
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