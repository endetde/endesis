<?php
/**
 * Nombre de la clase:	cls_DBPresupuesto.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpr_tpr_presupuesto
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-07-10 08:45:10
 */

 
class cls_DBPresupuesto
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
	 * Nombre de la funci�n:	ListarFormulacionPresupuesto
	 * Prop�sito:				Desplegar los registros de tpr_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:10
	 */
	function ListarFormulacionPresupuesto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_sel';
		$this->codigo_procedimiento = "'PR_PREGAS_SEL'";

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
		$this->var->add_def_cols('id_presupuesto','integer');
		$this->var->add_def_cols('tipo_pres','numeric');
		$this->var->add_def_cols('estado_pres','numeric');
		$this->var->add_def_cols('id_fina_regi_prog_proy_acti','integer');
		$this->var->add_def_cols('id_unidad_organizacional','integer');
		$this->var->add_def_cols('desc_unidad_organizacional','varchar');
		$this->var->add_def_cols('id_fuente_financiamiento','integer');
		$this->var->add_def_cols('denominacion','varchar');
		$this->var->add_def_cols('id_parametro','integer');
		$this->var->add_def_cols('desc_parametro','numeric');
		$this->var->add_def_cols('id_financiador','integer');
		$this->var->add_def_cols('id_regional','integer');
		$this->var->add_def_cols('id_programa','integer');
		$this->var->add_def_cols('id_proyecto','integer');
		$this->var->add_def_cols('id_actividad','integer');
		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		$this->var->add_def_cols('codigo_financiador','varchar');
		$this->var->add_def_cols('codigo_regional','varchar');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('codigo_proyecto','varchar');
		$this->var->add_def_cols('codigo_actividad','varchar');
		$this->var->add_def_cols('id_concepto_colectivo','integer');
		$this->var->add_def_cols('desc_colectivo','varchar');	
		$this->var->add_def_cols('sigla','varchar');	
		$this->var->add_def_cols('desc_presupuesto','text');

		$this->var->add_def_cols('cod_prg','varchar');
		$this->var->add_def_cols('cod_proy','varchar');
		$this->var->add_def_cols('cod_act','varchar');
		$this->var->add_def_cols('cod_fin','varchar');
		$this->var->add_def_cols('desc_usr_reg','varchar');
		$this->var->add_def_cols('fecha_reg','timestamp');	
 
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
 
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		
/*echo $this->query;
		exit();*/


		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarFormulacionPresupuesto
	 * Prop�sito:				Contar los registros de tpr_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:10
	 */
	function ContarFormulacionPresupuesto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_sel';
		$this->codigo_procedimiento = "'PR_PREGAS_COUNT'";

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
		//$this->var->add_def_cols('suma_total','numeric');

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
	/*echo $this->query;
		exit();*/
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	/**
	 * Nombre de la funci�n:	ListarFormulacionPresupuesto
	 * Prop�sito:				Desplegar los registros de tpr_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:10
	 */
	function ListarPresupuestoDepto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_sel';
		$this->codigo_procedimiento = "'PR_PREDEP_SEL'";

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
		$this->var->add_def_cols('id_presupuesto','integer');
		$this->var->add_def_cols('desc_presupuesto','text');
		$this->var->add_def_cols('tipo_pres','VARCHAR');
		$this->var->add_def_cols('estado_pres','numeric');
		$this->var->add_def_cols('id_fuente_financiamiento','integer');
		$this->var->add_def_cols('nombre_fuente_financiamiento','varchar');
		$this->var->add_def_cols('id_unidad_organizacional','integer');
		$this->var->add_def_cols('nombre_unidad','varchar');
	 	$this->var->add_def_cols('id_fina_regi_prog_proy_acti','integer');
		$this->var->add_def_cols('desc_epe','TEXT');
		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		$this->var->add_def_cols('id_parametro','integer');
		$this->var->add_def_cols('gestion_pres','numeric');
  
  
		
		
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
 
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
/*echo $this->query;
		exit();*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarFormulacionPresupuesto
	 * Prop�sito:				Contar los registros de tpr_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:10
	 */
	function ContarPresupuestoDepto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_sel';
		$this->codigo_procedimiento = "'PR_PREDEP_COUNT'";

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
		//$this->var->add_def_cols('suma_total','numeric');

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
	/*echo $this->query;
		exit();*/
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	function ListarPresupuestoSuma($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_sel';
		$this->codigo_procedimiento = "'PR_PRESUM_SEL'";

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
		$this->var->add_def_cols('id_presupuesto','integer');
		$this->var->add_def_cols('tipo_pres','numeric');
		$this->var->add_def_cols('estado_pres','numeric');
		$this->var->add_def_cols('id_fina_regi_prog_proy_acti','integer');
		$this->var->add_def_cols('id_unidad_organizacional','integer');
		$this->var->add_def_cols('desc_unidad_organizacional','varchar');
		$this->var->add_def_cols('id_fuente_financiamiento','integer');
		$this->var->add_def_cols('denominacion','varchar');
		$this->var->add_def_cols('id_parametro','integer');
		$this->var->add_def_cols('desc_parametro','numeric');
		$this->var->add_def_cols('id_financiador','integer');
		$this->var->add_def_cols('id_regional','integer');
		$this->var->add_def_cols('id_programa','integer');
		$this->var->add_def_cols('id_proyecto','integer');
		$this->var->add_def_cols('id_actividad','integer');
		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		$this->var->add_def_cols('codigo_financiador','varchar');
		$this->var->add_def_cols('codigo_regional','varchar');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('codigo_proyecto','varchar');
		$this->var->add_def_cols('codigo_actividad','varchar');
		$this->var->add_def_cols('id_concepto_colectivo','integer');
		$this->var->add_def_cols('desc_colectivo','varchar');
		$this->var->add_def_cols('total','numeric');
		$this->var->add_def_cols('id_moneda','integer');
		$this->var->add_def_cols('desc_moneda','varchar');
 
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
 
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
/*echo $this->query;
		exit();*/

		return $res;
	}	
	function ContarPresupuestoSuma($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_sel';
		$this->codigo_procedimiento = "'PR_PRESUM_COUNT'";

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
		//$this->var->add_def_cols('suma_total','numeric');

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
	/*echo $this->query;
		exit();*/
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	InsertarFormulacionPresupuesto
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:10
	 */
	function InsertarFormulacionPresupuesto($id_presupuesto,$tipo_pres,$estado_pres,$id_unidad_organizacional,$id_fuente_financiamiento,$id_parametro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$cod_fin,$cod_prg,$cod_proy,$cod_act)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_iud';
		$this->codigo_procedimiento = "'PR_PREGAS_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
	 	$this->var->add_param($tipo_pres);
		$this->var->add_param($estado_pres);
		$this->var->add_param($id_unidad_organizacional);
		$this->var->add_param($id_fuente_financiamiento);
		$this->var->add_param($id_parametro);
		
		$this->var->add_param("$id_financiador");
		$this->var->add_param("$id_regional");
		$this->var->add_param("$id_programa");
		$this->var->add_param("$id_proyecto");
		$this->var->add_param("$id_actividad");
		$this->var->add_param("null");
		$this->var->add_param("'$cod_fin'");//cod_fin
		$this->var->add_param("'$cod_prg'");//cod_prg
		$this->var->add_param("'$cod_proy'");//cod_proy
		$this->var->add_param("'$cod_act'");//cod_act

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	/*	echo ($this->query);
		exit();*/
		return $res;
	}
	function InsertarPresupuestoColectivoPartida($id_presupuesto,$tipo_pres,$estado_pres,$id_unidad_organizacional,$id_fuente_financiamiento,$id_parametro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_concepto_colectivo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_iud';
		$this->codigo_procedimiento = "'PR_PRECOL_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
	 	$this->var->add_param($tipo_pres);
		$this->var->add_param($estado_pres);
		$this->var->add_param($id_unidad_organizacional);
		$this->var->add_param($id_fuente_financiamiento);
		$this->var->add_param($id_parametro);
		
		$this->var->add_param("$id_financiador");
		$this->var->add_param("$id_regional");
		$this->var->add_param("$id_programa");
		$this->var->add_param("$id_proyecto");
		$this->var->add_param("$id_actividad");
		$this->var->add_param("$id_concepto_colectivo");
		$this->var->add_param("'$cod_fin'");//cod_fin
		$this->var->add_param("'$cod_prg'");//cod_prg
		$this->var->add_param("'$cod_proy'");//cod_proy
		$this->var->add_param("'$cod_act'");//cod_act

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	/*echo ($this->query);
		exit();*/
		return $res;
	}
	function InsertarFormulacionPresupuestoPlantilla($id_presupuesto,$tipo_pres,$estado_pres,$id_unidad_organizacional,$id_fuente_financiamiento,$id_parametro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$cod_fin,$cod_prg,$cod_proy,$cod_act)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_iud';
		$this->codigo_procedimiento = "'PR_PREGAS_PLAN_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_presupuesto);
	 	$this->var->add_param($tipo_pres);
		$this->var->add_param($estado_pres);
		$this->var->add_param($id_unidad_organizacional);
		$this->var->add_param($id_fuente_financiamiento);
		$this->var->add_param($id_parametro);
		
		$this->var->add_param("$id_financiador");
		$this->var->add_param("$id_regional");
		$this->var->add_param("$id_programa");
		$this->var->add_param("$id_proyecto");
		$this->var->add_param("$id_actividad");
		$this->var->add_param("null");
		$this->var->add_param("'$cod_fin'");//cod_fin
		$this->var->add_param("'$cod_prg'");//cod_prg
		$this->var->add_param("'$cod_proy'");//cod_proy
		$this->var->add_param("'$cod_act'");//cod_act

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	/*	echo ($this->query);
		exit();*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarFormulacionPresupuesto
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpr_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:10
	 */
	function ModificarFormulacionPresupuesto($id_presupuesto,$tipo_pres,$estado_pres,$id_unidad_organizacional,$id_fuente_financiamiento,$id_parametro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$cod_fin,$cod_prg,$cod_proy,$cod_act)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_iud';
		$this->codigo_procedimiento = "'PR_PREGAS_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_presupuesto);
		$this->var->add_param($tipo_pres);
		$this->var->add_param($estado_pres);
		$this->var->add_param($id_unidad_organizacional);
		$this->var->add_param($id_fuente_financiamiento);
		$this->var->add_param($id_parametro);
		$this->var->add_param("$id_financiador");
		$this->var->add_param("$id_regional");
		$this->var->add_param("$id_programa");
		$this->var->add_param("$id_proyecto");
		$this->var->add_param("$id_actividad");
		$this->var->add_param("null");
		$this->var->add_param("'$cod_fin'");//cod_fin
		$this->var->add_param("'$cod_prg'");//cod_prg
		$this->var->add_param("'$cod_proy'");//cod_proy
		$this->var->add_param("'$cod_act'");//cod_act

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	function ModificarEstado ($id_presupuesto,$estado_pres)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_iud';
		$this->codigo_procedimiento = "'PR_PRECAM_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_presupuesto);
		$this->var->add_param("null");
		$this->var->add_param($estado_pres);
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");//cod_fin
		$this->var->add_param("null");//cod_prg
		$this->var->add_param("null");//cod_proy
		$this->var->add_param("null");//cod_act

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
	 * Nombre de la funci�n:	EliminarFormulacionPresupuesto
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:10
	 */
	function EliminarFormulacionPresupuesto($id_presupuesto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_iud';
		$this->codigo_procedimiento = "'PR_PREGAS_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_presupuesto);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("null");//cod_fin
		$this->var->add_param("null");//cod_prg
		$this->var->add_param("null");//cod_proy
		$this->var->add_param("null");//cod_act

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
/****************************************************************************************************/
	function ListarComboPresupuesto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_sel';
		$this->codigo_procedimiento = "'PR_PRECOMB_SEL'";

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
		$this->var->add_def_cols('id_presupuesto','integer');
		$this->var->add_def_cols('tipo_pres','varchar');
		$this->var->add_def_cols('estado_pres','numeric');
		$this->var->add_def_cols('id_unidad_organizacional','integer');
		$this->var->add_def_cols('nombre_unidad','varchar');
		$this->var->add_def_cols('id_fina_regi_prog_proy_acti','integer');
		$this->var->add_def_cols('desc_epe','text');
		$this->var->add_def_cols('id_fuente_financiamiento','integer');
		$this->var->add_def_cols('sigla','varchar');
		$this->var->add_def_cols('id_parametro','integer');
		$this->var->add_def_cols('gestion_pres','numeric');
		$this->var->add_def_cols('estado_gral','numeric');
		$this->var->add_def_cols('id_gestion','integer');
		$this->var->add_def_cols('desc_presupuesto','text');
		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
 
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
 
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo $this->query;
		exit();*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarFormulacionPresupuesto
	 * Prop�sito:				Contar los registros de tpr_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:10
	 */
	function ContarComboPresupuesto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_sel';
		$this->codigo_procedimiento = "'PR_PRECOMB_COUNT'";

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
		//$this->var->add_def_cols('suma_total','numeric');

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
		/*echo $this->query;
		exit();*/
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
/****************************************************************************************************/
	
	
	/**
	 * Nombre de la funci�n:	ValidarFormulacionPresupuesto
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpr_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:10
	 */
	function ValidarCambiarEstado($id_presupuesto,$estado_pres)
	{
		$this->salida = "";
		$valid = new cls_validacion_serv();

		//Clase para validar el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();
	
		//Validar id_presupuesto - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_presupuesto");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_presupuesto", $id_presupuesto))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar estado_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_pres");
			$tipo_dato->set_MaxLength(65536);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "estado_pres", $estado_pres))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		 
	}
	
	
	function ValidarFormulacionPresupuesto($operacion_sql,$id_presupuesto,$tipo_pres,$estado_pres,$id_unidad_organizacional,$id_fuente_financiamiento,$id_parametro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
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
				//Validar id_presupuesto - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_presupuesto");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_presupuesto", $id_presupuesto))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar tipo_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("tipo_pres");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "tipo_pres", $tipo_pres))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar estado_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_pres");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "estado_pres", $estado_pres))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_financiador - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_financiador");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_financiador", $id_financiador))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_regional - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_regional");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_regional", $id_regional))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_programa - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_programa");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_programa", $id_programa))
			{
				$this->salida = $valid->salida;
				return false;
			}
 
			//Validar id_proyecto - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_proyecto");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_proyecto", $id_proyecto))
			{
				$this->salida = $valid->salida;
				return false;
			} 

			//Validar id_actividad - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_actividad");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_actividad", $id_actividad))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_unidad_organizacional - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_unidad_organizacional");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_unidad_organizacional", $id_unidad_organizacional))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_fuente_financiamiento - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_fuente_financiamiento");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_fuente_financiamiento", $id_fuente_financiamiento))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_parametro - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_parametro");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_parametro", $id_parametro))
			{
				$this->salida = $valid->salida;
				return false;
			}

			
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_presupuesto - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_presupuesto");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_presupuesto", $id_presupuesto))
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
	
	/*----------------------------------- PRESUPUESTO VIGENTE - MFLORES - 29-07-2011 ---------------------------------------------*/
	
	function PresupuestoVigente($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_presupuesto,$id_partida,$id_moneda,$id_partida_modificacion,$id_partida_presupuesto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_detalle_presupuesto_vigente_sel';
		$this->codigo_procedimiento = "'PR_PREVIG'";

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
		/*$this->var->add_param($func->iif($id_financiador == '',"'%'","'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'","'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'","'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'","'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'","'$id_actividad'"));//id_actividad*/
		$this->var->add_param($id_presupuesto);
		$this->var->add_param($id_partida);
		$this->var->add_param($id_moneda);
		$this->var->add_param($id_partida_modificacion);
		$this->var->add_param($id_partida_presupuesto);

		//Carga la definici�n de columnas con sus tipos de datos
		if($id_partida_modificacion == '') //nuevo
		{
			//$this->var->add_def_cols('id_partida_detalle_modificacion','integer');
			$this->var->add_def_cols('descripcion','text');
			$this->var->add_def_cols('mes_01','numeric');
			$this->var->add_def_cols('mes_02','numeric');
			$this->var->add_def_cols('mes_03','numeric');
			$this->var->add_def_cols('mes_04','numeric');
			$this->var->add_def_cols('mes_05','numeric');
			$this->var->add_def_cols('mes_06','numeric');
			$this->var->add_def_cols('mes_07','numeric');
			$this->var->add_def_cols('mes_08','numeric');
			$this->var->add_def_cols('mes_09','numeric');
			$this->var->add_def_cols('mes_10','numeric');
			$this->var->add_def_cols('mes_11','numeric');
			$this->var->add_def_cols('mes_12','numeric');
			$this->var->add_def_cols('total','numeric');
		}
		else //editar
		{
			//$this->var->add_def_cols('id_partida_detalle_modificacion','integer');
			$this->var->add_def_cols('descripcion','text');
			$this->var->add_def_cols('mes_01','numeric');
			$this->var->add_def_cols('mes_02','numeric');
			$this->var->add_def_cols('mes_03','numeric');
			$this->var->add_def_cols('mes_04','numeric');
			$this->var->add_def_cols('mes_05','numeric');
			$this->var->add_def_cols('mes_06','numeric');
			$this->var->add_def_cols('mes_07','numeric');
			$this->var->add_def_cols('mes_08','numeric');
			$this->var->add_def_cols('mes_09','numeric');
			$this->var->add_def_cols('mes_10','numeric');
			$this->var->add_def_cols('mes_11','numeric');
			$this->var->add_def_cols('mes_12','numeric');
			$this->var->add_def_cols('total','numeric');
		}
  		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
 
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		//echo $this->query; exit;
		
		return $res;
	}
	
	function DetallePresupuestoVigente($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_presupuesto,$id_partida,$id_moneda,$id_partida_modificacion,$id_partida_presupuesto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_detalle_presupuesto_vigente_sel';
		$this->codigo_procedimiento = "'PR_PREVIG_SEL'";

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
		/*$this->var->add_param($func->iif($id_financiador == '',"'%'","'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'","'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'","'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'","'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'","'$id_actividad'"));//id_actividad*/
		
		$this->var->add_param($id_presupuesto);
		$this->var->add_param($id_partida);
		$this->var->add_param($id_moneda);
		$this->var->add_param($id_partida_modificacion);
		$this->var->add_param($id_partida_presupuesto);

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_partida_detalle_modificacion','integer');
		$this->var->add_def_cols('codigo_partida','varchar');
		$this->var->add_def_cols('nombre_partida','varchar');
		$this->var->add_def_cols('mes_01','numeric');
		$this->var->add_def_cols('mes_02','numeric');
		$this->var->add_def_cols('mes_03','numeric');
		$this->var->add_def_cols('mes_04','numeric');
		$this->var->add_def_cols('mes_05','numeric');
		$this->var->add_def_cols('mes_06','numeric');
		$this->var->add_def_cols('mes_07','numeric');
		$this->var->add_def_cols('mes_08','numeric');
		$this->var->add_def_cols('mes_09','numeric');
		$this->var->add_def_cols('mes_10','numeric');
		$this->var->add_def_cols('mes_11','numeric');
		$this->var->add_def_cols('mes_12','numeric');
		$this->var->add_def_cols('total','numeric');
		$this->var->add_def_cols('id_moneda','integer');
		$this->var->add_def_cols('id_partida_presupuesto','integer');
		$this->var->add_def_cols('id_partida_modificacion','integer');
		$this->var->add_def_cols('id_partida','integer');
		$this->var->add_def_cols('id_presupuesto','integer');
		$this->var->add_def_cols('estado','varchar');
		  		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
 
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		//echo $this->query; exit;
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarFormulacionPresupuesto
	 * Prop�sito:				Contar los registros de tpr_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:10
	 */
	function ContarDetallePresupuestoVigente($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_presupuesto,$id_partida,$id_moneda,$id_partida_modificacion,$id_partida_presupuesto)
	{
		//echo $id_financiador.'-'.$id_regional.'-'.$id_programa.'-'.$id_proyecto.'-'.$id_actividad; exit;
		
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_detalle_presupuesto_vigente_sel';
		$this->codigo_procedimiento = "'PR_PREVIG_COUNT'";

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
	/*	$this->var->add_param($func->iif($id_financiador == '',"'%'","'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'","'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'","'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'","'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'","'$id_actividad'"));//id_actividad	*/
	
		$this->var->add_param($id_presupuesto);
		$this->var->add_param($id_partida);
		$this->var->add_param($id_moneda);
		$this->var->add_param($id_partida_modificacion);
		$this->var->add_param($id_partida_presupuesto);
		
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('total','bigint');
		//$this->var->add_def_cols('suma_total','numeric');

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
	/*echo $this->query;
		exit();*/
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	function InsertarPartidaDetalleModificacion($id_partida_detalle_modificacion,$mes_01,$mes_02,$mes_03,$mes_04,$mes_05,$mes_06,$mes_07,$mes_08,$mes_09,$mes_10,$mes_11,$mes_12,$total,$id_partida_presupuesto,$id_moneda,$id_partida_modificacion,$id_partida,$id_presupuesto)
	{
		
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_detalle_presupuesto_vigente_iud';
		$this->codigo_procedimiento = "'PR_PREVIG_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_partida_detalle_modificacion);
	 	$this->var->add_param($mes_01);
		$this->var->add_param($mes_02);
		$this->var->add_param($mes_03);
		$this->var->add_param($mes_04);
		$this->var->add_param($mes_05);
		$this->var->add_param($mes_06);
		$this->var->add_param($mes_07);
		$this->var->add_param($mes_08);
		$this->var->add_param($mes_09);
		$this->var->add_param($mes_10);
		$this->var->add_param($mes_11);
		$this->var->add_param($mes_12);
		$this->var->add_param($total);
		$this->var->add_param($id_partida_presupuesto);
		$this->var->add_param($id_moneda);
		$this->var->add_param($id_partida_modificacion);
		$this->var->add_param($id_partida);
		$this->var->add_param($id_presupuesto);
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	
		//echo ($this->query); exit;
		
		return $res;
	}
	
	function ModificarPartidaDetalleModificacion($id_partida_detalle_modificacion,$mes_01,$mes_02,$mes_03,$mes_04,$mes_05,$mes_06,$mes_07,$mes_08,$mes_09,$mes_10,$mes_11,$mes_12,$total,$id_partida_presupuesto,$id_moneda,$id_partida_modificacion,$id_partida,$id_presupuesto)
	{
		
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_detalle_presupuesto_vigente_iud';
		$this->codigo_procedimiento = "'PR_PREVIG_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_partida_detalle_modificacion);
	 	$this->var->add_param($mes_01);
		$this->var->add_param($mes_02);
		$this->var->add_param($mes_03);
		$this->var->add_param($mes_04);
		$this->var->add_param($mes_05);
		$this->var->add_param($mes_06);
		$this->var->add_param($mes_07);
		$this->var->add_param($mes_08);
		$this->var->add_param($mes_09);
		$this->var->add_param($mes_10);
		$this->var->add_param($mes_11);
		$this->var->add_param($mes_12);
		$this->var->add_param($total);
		$this->var->add_param($id_partida_presupuesto);
		$this->var->add_param($id_moneda);
		$this->var->add_param($id_partida_modificacion);
		$this->var->add_param($id_partida);
		$this->var->add_param($id_presupuesto);
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	
		//echo ($this->query); exit;
		
		return $res;
	}
	
	function ValidarPartidaDetalleModificacion($operacion_sql,$id_partida_detalle_modificacion,$mes_01,$mes_02,$mes_03,$mes_04,$mes_05,$mes_06,$mes_07,$mes_08,$mes_09,$mes_10,$mes_11,$mes_12,$total,$id_partida_presupuesto,$id_moneda,$id_partida_modificacion,$id_partida,$id_presupuesto)
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
				//Validar id_presupuesto - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_partida_detalle_modificacion");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_partida_detalle_modificacion", $id_partida_detalle_modificacion))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar tipo_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_01");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_01", $mes_01))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar tipo_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_02");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_02", $mes_02))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar tipo_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_04");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_04", $mes_04))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar tipo_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_05");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_05", $mes_05))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar tipo_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_05");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_05", $mes_05))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar tipo_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_06");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_06", $mes_06))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar tipo_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_07");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_07", $mes_07))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar tipo_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_08");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_08", $mes_08))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar tipo_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_09");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_09", $mes_09))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar tipo_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_10");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_10", $mes_10))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar tipo_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_11");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_11", $mes_11))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar tipo_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_12");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_12", $mes_12))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar tipo_pres - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("total");
			$tipo_dato->set_MaxLength(65536);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "total", $total))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar id_financiador - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_financiador");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_partida_presupuesto", $id_partida_presupuesto))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_regional - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_regional");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_moneda", $id_moneda))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_programa - tipo integer
			/*$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_programa");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_partida_modificacion", $id_partida_modificacion))
			{
				$this->salida = $valid->salida;
				return false;
			}*/
 
			//Validar id_proyecto - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_proyecto");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_partida", $id_partida))
			{
				$this->salida = $valid->salida;
				return false;
			} 

			//Validar id_actividad - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_actividad");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_presupuesto", $id_presupuesto))
			{
				$this->salida = $valid->salida;
				return false;
			}
					
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_presupuesto - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_partida_detalle_modificacion");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_partida_detalle_modificacion", $id_partida_detalle_modificacion))
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
	
	function ListarPresupuestoVigenteSuma($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_gestion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_vigente_suma_sel';
		$this->codigo_procedimiento = "'PR_PRVISU_SEL'";

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
		$this->var->add_param($id_gestion);

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_presupuesto','integer');
		$this->var->add_def_cols('tipo_pres','varchar');
		$this->var->add_def_cols('estado_pres','numeric');
		$this->var->add_def_cols('id_fina_regi_prog_proy_acti','integer');
		$this->var->add_def_cols('id_unidad_organizacional','integer');
		$this->var->add_def_cols('desc_unidad_organizacional','varchar');
		$this->var->add_def_cols('id_fuente_financiamiento','integer');
		$this->var->add_def_cols('denominacion','varchar');
		$this->var->add_def_cols('id_parametro','integer');
		$this->var->add_def_cols('desc_parametro','numeric');
		$this->var->add_def_cols('id_financiador','integer');
		$this->var->add_def_cols('id_regional','integer');
		$this->var->add_def_cols('id_programa','integer');
		$this->var->add_def_cols('id_proyecto','integer');
		$this->var->add_def_cols('id_actividad','integer');
		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');		
		$this->var->add_def_cols('total','numeric');
		/*$this->var->add_def_cols('id_moneda','integer');
		$this->var->add_def_cols('desc_moneda','varchar');*/
		$this->var->add_def_cols('fecha_reg','timestamp');
		$this->var->add_def_cols('usuario','varchar');
		$this->var->add_def_cols('estado','numeric');
 
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
 
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		//echo $this->query; exit();

		return $res;
	}	
	
	
	function ContarPresupuestoVigenteSuma($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_gestion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_vigente_suma_sel';
		$this->codigo_procedimiento = "'PR_PRVISU_COUNT'";

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
		$this->var->add_param($id_gestion);
		
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('total','bigint');
		//$this->var->add_def_cols('suma_total','numeric');

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
	
		//echo $this->query; exit();
		
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	function CambiarEstadoPresupuesto($id_presupuesto,$accion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_presupuesto_vigente_iud';
		
		if($accion=='aprobar_pres_vigente'){
			$this->codigo_procedimiento = "'PR_PREVIG_APROBAR'";
		}
		/*elseif ($accion=='rechazar_pres_vigente'){
			$this->codigo_procedimiento = "'PR_PREVIG_RECHAZAR'";
		}*/
		
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_presupuesto);
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		//echo $this->query; exit;

		return $res;
	}
}?>