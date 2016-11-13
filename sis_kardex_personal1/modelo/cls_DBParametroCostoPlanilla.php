<?php
/**
 * Nombre de la clase:	cls_DBParametroCostoPlanilla.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tkp_tkp_parametro_costo_planilla
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2010-08-13 09:27:55
 */

 
class cls_DBParametroCostoPlanilla
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
	 * Nombre de la funci�n:	ListarParametroCostoPlanilla
	 * Prop�sito:				Desplegar los registros de tkp_parametro_costo_planilla
	 * Autor:				    Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		2010-10-01 09:27:55
	 */
	function ListarParametroCostoPlanilla($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_parametro_costo_planilla_sel';
		$this->codigo_procedimiento = "'KP_PACOPLA_SEL'";

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
		$this->var->add_def_cols('id_parametro_costo_planilla','int4');
		$this->var->add_def_cols('valor','numeric');
		$this->var->add_def_cols('id_gestion','int4');
		$this->var->add_def_cols('id_gestion','int4');
		$this->var->add_def_cols('desc_gestion','numeric');
		$this->var->add_def_cols('salario_min_nacional','numeric');
		$this->var->add_def_cols('id_moneda','integer');
		$this->var->add_def_cols('porcen_fijo_cooperativa','numeric');
		$this->var->add_def_cols('aporte_fijo_min_cooperativa','numeric');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('desc_moneda','varchar');
		$this->var->add_def_cols('porcen_max_quincena','numeric');
		$this->var->add_def_cols('id_moneda_cooperativa','integer');
		$this->var->add_def_cols('desc_moneda_coop','varchar');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	function ListarAsignaPago($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_parametro_asigna_pago_sel';
		$this->codigo_procedimiento = "'KP_ASIPAGO_SEL'";

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
		$this->var->add_def_cols('id_parametro_costo_planilla','integer');
		$this->var->add_def_cols('id_empleado','integer');
		$this->var->add_def_cols('id_gestion','integer');
		$this->var->add_def_cols('gestion','numeric');
		$this->var->add_def_cols('id_unidad_organizacional','integer');
		$this->var->add_def_cols('nombre_unidad','varchar');
		$this->var->add_def_cols('id_fina_regi_prog_proy_acti','integer');
		$this->var->add_def_cols('id_financiador','integer');
		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('id_regional','integer');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('id_programa','integer');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('id_proyecto','integer');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('id_actividad','integer');
		$this->var->add_def_cols('nombre_actividad','varchar');
		$this->var->add_def_cols('valor','numeric');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_usuario_reg','integer');
		$this->var->add_def_cols('id_presupuesto','integer');
		$this->var->add_def_cols('desc_presupuesto','text');
		$this->var->add_def_cols('id_orden_trabajo','integer');
		$this->var->add_def_cols('desc_orden','varchar');
		$this->var->add_def_cols('motivo_orden','varchar');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	function ListarProrrateoHoras($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_parametro_prorrateo_horas_sel';
		$this->codigo_procedimiento = "'KP_PAPRORA_SEL'";

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
		$this->var->add_def_cols('id_parametro_costo_planilla','integer');
		$this->var->add_def_cols('id_empleado_planilla','integer');
		$this->var->add_def_cols('id_gestion','integer');
		$this->var->add_def_cols('gestion','numeric');
		$this->var->add_def_cols('id_unidad_organizacional','integer');
		//$this->var->add_def_cols('nombre_unidad','varchar');
		$this->var->add_def_cols('id_fina_regi_prog_proy_acti','integer');
		/*$this->var->add_def_cols('id_financiador','integer');
		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('id_regional','integer');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('id_programa','integer');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('id_proyecto','integer');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('id_actividad','integer');
		$this->var->add_def_cols('nombre_actividad','varchar');*/
		$this->var->add_def_cols('id_orden_trabajo','integer');
		$this->var->add_def_cols('desc_orden','varchar');
		$this->var->add_def_cols('motivo_orden','varchar');
		$this->var->add_def_cols('id_usuario_reg','integer');
		$this->var->add_def_cols('id_presupuesto','integer');
		$this->var->add_def_cols('desc_presupuesto','text');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('horas_normales','numeric');
		$this->var->add_def_cols('costo_horas_normales','numeric');		
		$this->var->add_def_cols('horas_extra','numeric');
		$this->var->add_def_cols('costo_horas_extra','numeric');
		$this->var->add_def_cols('horas_nocturnas','numeric');
		$this->var->add_def_cols('costo_horas_nocturnas','numeric');
		$this->var->add_def_cols('horas_disp','numeric');
		$this->var->add_def_cols('costo_horas_disp','numeric');
		$this->var->add_def_cols('id_resumen_horario_mes','integer');
		$this->var->add_def_cols('factor_prorrateo','numeric');
		
		
		$this->var->add_def_cols('total_horas_normales','numeric');
		
		$this->var->add_def_cols('total_horas_extra','numeric');
		$this->var->add_def_cols('total_horas_nocturnas','numeric');
		$this->var->add_def_cols('total_horas_disp','numeric');
		
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	/**
	 * Nombre de la funci�n:	ContarParametroCostoPlanilla
	 * Prop�sito:				Contar los registros de tkp_parametro_costo_planilla
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-13 09:27:55
	 */
	function ContarParametroCostoPlanilla($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_parametro_costo_planilla_sel';
		$this->codigo_procedimiento = "'KP_PARKAR_COUNT'";

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
	function ContarListaAsignaPago($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_parametro_asigna_pago_sel';
		$this->codigo_procedimiento = "'KP_ASIPAGO_COUNT'";

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
	function ContarProrrateoHoras($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_parametro_prorrateo_horas_sel';
		$this->codigo_procedimiento = "'KP_PAPRORA_COUNT'";

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
	 * Nombre de la funci�n:	InsertarParametroCostoPlanilla
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_parametro_costo_planilla
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-13 09:27:55
	 */
	function InsertarParametroCostoPlanilla($id_parametro_costo_planilla,$id_empleado_planilla,$id_gestion,$id_presupuesto,$id_orden_trabajo,$id_resumen_horario_mes,$horas_normales,$horas_extra,$horas_nocturnas,$horas_disp)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_parametro_costo_planilla_iud';
		$this->codigo_procedimiento = "'KP_PACOPLA_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_empleado_planilla);
		$this->var->add_param($id_gestion);
		$this->var->add_param($id_presupuesto);
		$this->var->add_param($id_orden_trabajo);
		$this->var->add_param($id_resumen_horario_mes);
		$this->var->add_param($horas_normales);
		$this->var->add_param($horas_extra);
		$this->var->add_param($horas_nocturnas);//$aporte_fijo_min_cooperativa);
		$this->var->add_param($horas_disp);//$estado_reg);
		$this->var->add_param("NULL");//$fecha_reg);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
        //echo $this->query;
        //exit;
		return $res;
	}
	function InsertarAsignaPago($hidden_id_parametro_costo_planilla, $hidden_id_empleado,$hidden_id_gestion,$hidden_id_presupuesto,$txt_valor,$txt_estado_reg,$hidden_id_orden_trabajo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_parametro_asigna_pago_iud';
		$this->codigo_procedimiento = "'KP_ASIPAGO_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($hidden_id_empleado);
		$this->var->add_param($hidden_id_gestion);
		$this->var->add_param($hidden_id_presupuesto);
		$this->var->add_param($txt_valor);
		$this->var->add_param("'$txt_estado_reg'");
        $this->var->add_param($hidden_id_orden_trabajo);
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	/**
	 * Nombre de la funci�n:	ModificarParametroCostoPlanilla
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_parametro_costo_planilla
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-13 09:27:55
	 */
	function ModificarParametroCostoPlanilla($id_parametro_costo_planilla,$id_empleado_planilla,$id_gestion,$id_presupuesto,$id_orden_trabajo,$id_resumen_horario_mes,$horas_normales,$horas_extra,$horas_nocturnas,$horas_disp)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_parametro_costo_planilla_iud';
		$this->codigo_procedimiento = "'KP_PACOPLA_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_parametro_costo_planilla);
		$this->var->add_param($id_empleado_planilla);
		$this->var->add_param($id_gestion);
		$this->var->add_param($id_presupuesto);
		$this->var->add_param($id_orden_trabajo);
		$this->var->add_param($id_resumen_horario_mes);
		$this->var->add_param($horas_normales);
		$this->var->add_param($horas_extra);
		$this->var->add_param($horas_nocturnas);//$aporte_fijo_min_cooperativa);
		$this->var->add_param($horas_disp);
		$this->var->add_param("NULL");//$fecha_reg);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		 //echo $this->query;
		 //exit;
		return $res;
	}
	function ModificarAsignaPago($hidden_id_parametro_costo_planilla, $hidden_id_empleado,$hidden_id_gestion,$hidden_id_presupuesto,$txt_valor,$txt_estado_reg,$hidden_id_orden_trabajo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_parametro_asigna_pago_iud';
		$this->codigo_procedimiento = "'KP_ASIPAGO_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($hidden_id_parametro_costo_planilla);
		$this->var->add_param($hidden_id_empleado);
		$this->var->add_param($hidden_id_gestion);
		$this->var->add_param($hidden_id_presupuesto);
		$this->var->add_param($txt_valor);
		$this->var->add_param("'$txt_estado_reg'");
		$this->var->add_param($hidden_id_orden_trabajo);
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}	
	/**
	 * Nombre de la funci�n:	EliminarParametroCostoPlanilla
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tkp_parametro_costo_planilla
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-13 09:27:55
	 */
	function EliminarParametroCostoPlanilla($id_parametro_costo_planilla)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_parametro_costo_planilla_iud';
		$this->codigo_procedimiento = "'KP_PACOPLA_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_parametro_costo_planilla);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//$salario_min_nacional);
		$this->var->add_param("NULL");//$id_moneda);
		$this->var->add_param("NULL");//$porcen_fijo_cooperativa);
		$this->var->add_param("NULL");//$aporte_fijo_min_cooperativa);
		$this->var->add_param("NULL");//$estado_reg);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//$aporte_fijo_min_cooperativa);
		$this->var->add_param("NULL");//$estado_reg);
		$this->var->add_param("NULL");//$fecha_reg);
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
	function EliminarAsignaPago($id_parametro_costo_planilla)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_parametro_asigna_pago_iud';
		$this->codigo_procedimiento = "'KP_ASIPAGO_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_parametro_costo_planilla);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//$salario_min_nacional);
		$this->var->add_param("NULL");//$id_moneda);
		$this->var->add_param("NULL");//$porcen_fijo_cooperativa);
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
	 * Nombre de la funci�n:	ValidarParametroCostoPlanilla
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tkp_parametro_costo_planilla
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-13 09:27:55
	 */
	function ValidarParametroCostoPlanilla($operacion_sql,$id_parametro_costo_planilla,$id_empleado_planilla,$id_gestion,$id_presupuesto,$id_orden_trabajo,$id_resumen_horario_mes,$horas_normales)
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
				//Validar id_parametro_costo_planilla - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_parametro_costo_planilla");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_parametro_costo_planilla", $id_parametro_costo_planilla))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_gestion - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_gestion");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_gestion", $id_gestion))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado_planilla");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado_planilla", $id_empleado_planilla))
			{
				$this->salida = $valid->salida;
				return false;
			}
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_presupuesto");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_presupuesto", $id_presupuesto))
			{
				$this->salida = $valid->salida;
				return false;
			}
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_orden_trabajo");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_orden_trabajo", $id_orden_trabajo))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_resumen_horario_mes");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_resumen_horario_mes", $id_resumen_horario_mes))
			{
				$this->salida = $valid->salida;
				return false;
			}
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("horas_normales");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "horas_normales", $horas_normales))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_parametro_costo_planilla - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_parametro_costo_planilla");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_parametro_costo_planilla", $id_parametro_costo_planilla))
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