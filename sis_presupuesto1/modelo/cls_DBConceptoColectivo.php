<?php
/**
 * Nombre de la clase:	cls_DBConceptoColectivo.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpr_tpr_concepto_colectivo
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-08-15 16:45:20
 */

 
class cls_DBConceptoColectivo
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
	 * Nombre de la funci�n:	ListarPresupuestoColectivo
	 * Prop�sito:				Desplegar los registros de tpr_concepto_colectivo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-15 16:45:20
	 */
	function ListarPresupuestoColectivo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_concepto_colectivo_sel';
		$this->codigo_procedimiento = "'PR_CONCOL_SEL'";

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
		$this->var->add_def_cols('id_concepto_colectivo','integer');
		$this->var->add_def_cols('estado_colectivo','numeric');
		$this->var->add_def_cols('id_usuario','integer');
		$this->var->add_def_cols('desc_usuario','text');
		$this->var->add_def_cols('desc_colectivo','varchar');
 
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarPresupuestoColectivo
	 * Prop�sito:				Contar los registros de tpr_concepto_colectivo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-15 16:45:20
	 */
	function ContarPresupuestoColectivo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_concepto_colectivo_sel';
		$this->codigo_procedimiento = "'PR_CONCOL_COUNT'";

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
	 * Nombre de la funci�n:	InsertarPresupuestoColectivo
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_concepto_colectivo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-15 16:45:20
	 */
	function InsertarPresupuestoColectivo($id_concepto_colectivo,$estado_colectivo,$id_usuario,$desc_colectivo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_concepto_colectivo_iud';
		$this->codigo_procedimiento = "'PR_CONCOL_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		
		$this->var->add_param($estado_colectivo);
		$this->var->add_param($id_usuario);
		$this->var->add_param("'$desc_colectivo'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
/*echo $this->query;
exit();*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarPresupuestoColectivo
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpr_concepto_colectivo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-15 16:45:20
	 */
	function ModificarPresupuestoColectivo($id_concepto_colectivo,$estado_colectivo,$id_usuario,$desc_colectivo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_concepto_colectivo_iud';
		$this->codigo_procedimiento = "'PR_CONCOL_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_concepto_colectivo);
		$this->var->add_param($estado_colectivo);
		$this->var->add_param($id_usuario);
		$this->var->add_param("'$desc_colectivo'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		exit();*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarPresupuestoColectivo
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_concepto_colectivo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-15 16:45:20
	 */
	function EliminarPresupuestoColectivo($id_concepto_colectivo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_concepto_colectivo_iud';
		$this->codigo_procedimiento = "'PR_CONCOL_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_concepto_colectivo);
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
	 * Nombre de la funci�n:	ValidarPresupuestoColectivo
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpr_concepto_colectivo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-15 16:45:20
	 */
	function ValidarPresupuestoColectivo($operacion_sql,$id_concepto_colectivo,$estado_colectivo,$id_usuario,$desc_colectivo)
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
				//Validar id_concepto_colectivo - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_concepto_colectivo");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_concepto_colectivo", $id_concepto_colectivo))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar estado_colectivo - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("desc_colectivo");
			$tipo_dato->set_MaxLength(150);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(),"desc_colectivo", $desc_colectivo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_usuario - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_usuario");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_usuario", $id_usuario))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar desc_colectivo - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_colectivo");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(),  "estado_colectivo", $estado_colectivo))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_concepto_colectivo - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_concepto_colectivo");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_concepto_colectivo", $id_concepto_colectivo))
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