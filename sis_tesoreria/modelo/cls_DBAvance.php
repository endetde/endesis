<?php
/**
 * Nombre de la clase:	cls_DBAvance.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tts_tts_avance
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-10-17 15:49:00
 */

 
class cls_DBAvance
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
	 * Nombre de la funci�n:	ListarSolicitudFondos
	 * Prop�sito:				Desplegar los registros de tts_avance
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function ListarSolicitudFondos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_usuario)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'TS_SOLFON_SEL'";

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
		$this->var->add_param($id_usuario);//id_usuario

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_avance','int4');
		$this->var->add_def_cols('id_empleado','int4');
		$this->var->add_def_cols('desc_empleado','text');
		$this->var->add_def_cols('tipo_avance','numeric');
		$this->var->add_def_cols('fecha_avance','date');
		$this->var->add_def_cols('importe_avance','numeric');
		$this->var->add_def_cols('estado_avance','numeric');
		$this->var->add_def_cols('id_moneda','int4');
		$this->var->add_def_cols('nombre_moneda','varchar');
		$this->var->add_def_cols('id_cheque','int4');
		$this->var->add_def_cols('nro_cheque','int4');
		$this->var->add_def_cols('id_documento','int4');
		$this->var->add_def_cols('nro_documento','bigint');
		$this->var->add_def_cols('id_comprobante','int4');
		$this->var->add_def_cols('nro_comprobante','int4');
		$this->var->add_def_cols('fk_avance','int4');
		$this->var->add_def_cols('id_depto','int4');
		$this->var->add_def_cols('desc_depto','varchar');
		$this->var->add_def_cols('id_caja','int4');
		$this->var->add_def_cols('desc_unidad_organizacional','varchar');
		$this->var->add_def_cols('id_subsistema','int4');
		$this->var->add_def_cols('desc_subsistema','text');
		$this->var->add_def_cols('avance_solicitud','numeric');
		$this->var->add_def_cols('id_cajero','integer');
		$this->var->add_def_cols('desc_cajero','text');
		$this->var->add_def_cols('saldo','numeric');
		$this->var->add_def_cols('nro_avance','varchar');
		$this->var->add_def_cols('concepto_avance','varchar');
		$this->var->add_def_cols('observacion_avance','text');
		$this->var->add_def_cols('observacion_conta','text');
		$this->var->add_def_cols('id_usr_reg','int4');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	//echo $this->query; exit();
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarSolicitudFondos
	 * Prop�sito:				Contar los registros de tts_avance
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function ContarSolicitudFondos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_usuario)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'TS_SOLFON_COUNT'";

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
        $this->var->add_param($id_usuario);//id_usuario
		
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
	 * Nombre de la funci�n:	ListarDescargo
	 * Prop�sito:				Desplegar los registros de tts_avance
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function ListarDescargo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'TS_DESCAR_SEL'";

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
        $this->var->add_param("NULL");//id_usuario
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_avance','int4');
		$this->var->add_def_cols('id_empleado','int4');
		$this->var->add_def_cols('desc_empleado','text');
		$this->var->add_def_cols('tipo_avance','numeric');
		$this->var->add_def_cols('fecha_avance','date');
		$this->var->add_def_cols('importe_avance','numeric');
		$this->var->add_def_cols('estado_avance','numeric');
		$this->var->add_def_cols('id_moneda','int4');
		$this->var->add_def_cols('nombre_moneda','varchar');
		$this->var->add_def_cols('id_cheque','int4');
		$this->var->add_def_cols('nro_cheque','int4');
		$this->var->add_def_cols('id_documento','int4');
		$this->var->add_def_cols('nro_documento','bigint');
		$this->var->add_def_cols('id_comprobante','int4');
		$this->var->add_def_cols('nro_comprobante','int4');
		$this->var->add_def_cols('fk_avance','int4');
		$this->var->add_def_cols('nro_avance','varchar');	
		$this->var->add_def_cols('fecha_ini_rendicion','date');		
		$this->var->add_def_cols('fecha_fin_rendicion','date');	
		$this->var->add_def_cols('id_plan_pago','int4');
		$this->var->add_def_cols('id_usr_reg','int4');
		$this->var->add_def_cols('id_depto','int4');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		/*echo $this->query;
		exit;*/
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarDescargo
	 * Prop�sito:				Contar los registros de tts_avance
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function ContarDescargo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'TS_DESCAR_COUNT'";

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
        $this->var->add_param("NULL");//id_usuario
		
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
		
		/*echo $this->query;
		exit;*/

		//Retorna el resultado de la ejecuci�n
		return $res;
	}	
	
	/**
	 * Nombre de la funci�n:	ListarDescargoDetalle
	 * Prop�sito:				Desplegar los registros de tts_avance
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function ListarDescargoDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'TS_DESDET_SEL'";

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
        $this->var->add_param("NULL");//id_usuario
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_avance','int4');
		$this->var->add_def_cols('tipo_avance','numeric');
		$this->var->add_def_cols('fecha_avance','date');
		$this->var->add_def_cols('importe_avance','numeric');
		$this->var->add_def_cols('estado_avance','numeric');
		$this->var->add_def_cols('id_moneda','int4');
		$this->var->add_def_cols('nombre_moneda','varchar');
		$this->var->add_def_cols('id_documento','int4');
		$this->var->add_def_cols('tipo_documento','numeric');
		$this->var->add_def_cols('nro_documento','bigint');
		$this->var->add_def_cols('fecha_documento','date');
		$this->var->add_def_cols('razon_social','varchar');
		$this->var->add_def_cols('nro_nit','varchar');
		$this->var->add_def_cols('nro_autorizacion','varchar');
		$this->var->add_def_cols('codigo_control','varchar');
		$this->var->add_def_cols('fk_avance','int4');
		$this->var->add_def_cols('importe_detalle','numeric');
		$this->var->add_def_cols('sw_valida','numeric');
		$this->var->add_def_cols('id_usuario_aprueba','int4');
		$this->var->add_def_cols('aprobador','text');
		$this->var->add_def_cols('id_usr_reg','int4');
		$this->var->add_def_cols('id_empleado_reg','int4');
		$this->var->add_def_cols('id_depto','int4');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarDescargoDetalle
	 * Prop�sito:				Contar los registros de tts_avance
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function ContarDescargoDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'TS_DESDET_COUNT'";

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
        $this->var->add_param("NULL");//id_usuario
		
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
	 * Nombre de la funci�n:	ListarSolicitudAvance
	 * Prop�sito:				Desplegar los registros de tad_solicitud_compra que tienen avance = si
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function ListarSolicitudAvance($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'TS_SOLAVA_SEL'";

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
        $this->var->add_param("NULL");//id_usuario
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_solicitud_compra','int4');
		$this->var->add_def_cols('precio_total','numeric');
		$this->var->add_def_cols('num_solicitud','int4');
		$this->var->add_def_cols('id_empleado_solicitante','int4');
		$this->var->add_def_cols('solicitante','text');
		$this->var->add_def_cols('periodo','numeric');
		$this->var->add_def_cols('id_ep','int4');
		$this->var->add_def_cols('codigo_financiador','varchar');
		$this->var->add_def_cols('codigo_regional','varchar');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('codigo_proyecto','varchar');
		$this->var->add_def_cols('codigo_actividad','varchar');
		$this->var->add_def_cols('id_periodo','int4');
		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		$this->var->add_def_cols('id_financiador','int4');
		$this->var->add_def_cols('id_regional','int4');
		$this->var->add_def_cols('id_programa','int4');
		$this->var->add_def_cols('id_proyecto','int4');
		$this->var->add_def_cols('id_actividad','int4');
		$this->var->add_def_cols('id_uo','int4');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	//echo $this->query; exit();
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarSolicitudAvance
	 * Prop�sito:				Contar los registros de tad_solicitud_compra con avance=si
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function ContarSolicitudAvance($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'TS_SOLAVA_COUNT'";

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
        $this->var->add_param("NULL");//id_usuario
		
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
	 * Nombre de la funci�n:	ListarSolicitudAvance
	 * Prop�sito:				Desplegar los registros de tad_solicitud_compra que tienen avance = si
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function ListarSolicitudADQAvance($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'TS_SOLADQAVA_SEL'";

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
        $this->var->add_param("NULL");//id_usuario
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_solicitud_compra','int4');
		$this->var->add_def_cols('precio_total','numeric');
		$this->var->add_def_cols('num_solicitud','int4');
		$this->var->add_def_cols('id_empleado_solicitante','int4');
		$this->var->add_def_cols('solicitante','text');
		$this->var->add_def_cols('periodo','numeric');
		$this->var->add_def_cols('id_ep','int4');
		$this->var->add_def_cols('codigo_financiador','varchar');
		$this->var->add_def_cols('codigo_regional','varchar');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('codigo_proyecto','varchar');
		$this->var->add_def_cols('codigo_actividad','varchar');
		$this->var->add_def_cols('id_periodo','int4');
		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		$this->var->add_def_cols('id_financiador','int4');
		$this->var->add_def_cols('id_regional','int4');
		$this->var->add_def_cols('id_programa','int4');
		$this->var->add_def_cols('id_proyecto','int4');
		$this->var->add_def_cols('id_actividad','int4');
		$this->var->add_def_cols('id_uo','int4');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	//echo $this->query; exit();
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarSolicitudAvance
	 * Prop�sito:				Contar los registros de tad_solicitud_compra con avance=si
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function ContarSolicitudADQAvance($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'TS_SOLADQAVA_COUNT'";

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
        $this->var->add_param("NULL");//id_usuario
		
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
	 * Nombre de la funci�n:	ListarAvanceSolicitud
	 * Prop�sito:				Lista los registros de tad_solicitud_compra
	 * Autor:				    Fernando Prudencio
	 * Fecha de creaci�n:		2009-05-12
	 */
function ListarAvanceSolicitud($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empresa)
	{
		$this->salida = "";
		$this->nombre_funcion = 'compro.f_tad_solicitud_compra_sel';
		$this->codigo_procedimiento = "'AD_AVASOL_SEL'";

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
		$this->var->add_param($id_empresa);//id_empresa
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_solicitud_compra','int4');
		$this->var->add_def_cols('num_solicitud','int4');
		$this->var->add_def_cols('precio_total','numeric');
		$this->var->add_def_cols('id_fina_regi_prog_proy_acti','int4');
		$this->var->add_def_cols('id_empleado_frppa_solicitante','int4');
		$this->var->add_def_cols('desc_empleado_tpm_frppa','text');
		$this->var->add_def_cols('id_rpa','int4');
		$this->var->add_def_cols('localidad','varchar');
		$this->var->add_def_cols('id_moneda','int4');
    	$this->var->add_def_cols('desc_moneda','varchar');
		$this->var->add_def_cols('id_unidad_organizacional','int4');
		$this->var->add_def_cols('desc_unidad_organizacional','varchar');
		$this->var->add_def_cols('id_tipo_categoria_adq','int4');
		$this->var->add_def_cols('desc_tipo_categoria_adq','varchar');
		$this->var->add_def_cols('tipo_adjudicacion','varchar');
		$this->var->add_def_cols('tipo_adq','varchar');
		$this->var->add_def_cols('observaciones','text');
		$this->var->add_def_cols('nombre','varchar');
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
		$this->var->add_def_cols('periodo','int4');
		$this->var->add_def_cols('gestion','int4');
		$this->var->add_def_cols('categoria','varchar');
		$this->var->add_def_cols('permite_agrupar','int4');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	
	/**
	 * Nombre de la funci�n:	ContarAvanceSolicitud
	 * Prop�sito:				Contar los registros de tad_solicitud_compra
	 * Autor:				    Fernando Prudencio
	 * Fecha de creaci�n:		2009-05-12
	 */
	function ContarAvanceSolicitud($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empresa)
	{
		$this->salida = "";
		$this->nombre_funcion = 'compro.f_tad_solicitud_compra_sel';
		$this->codigo_procedimiento = "'AD_AVASOL_COUNT'";

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
		$this->var->add_param($id_empresa);//id_empresa
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
	 * Nombre de la funci�n:	InsertarAvanceSolicitud
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tts_avance
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function InsertarAvanceSolicitud($id_avance,$id_solicitud)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_iud';
		$this->codigo_procedimiento = "'TS_AVASOL_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance);
		$this->var->add_param($id_solicitud);
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
        $this->var->add_param("NULL");
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
/* echo $this->query;
        exit;*/
		return $res;
	}
/**
	 * Nombre de la funci�n:	EliminarAvanceSolicitud
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tts_avance
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function EliminarAvanceSolicitud($id_avance,$id_solicitud)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_iud';
		$this->codigo_procedimiento = "'TS_AVASOL_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance);
		$this->var->add_param($id_solicitud);
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
        $this->var->add_param("NULL");
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
/* echo $this->query;
        exit;*/
		return $res;
	}

/**
	 * Nombre de la funci�n:	ContabilizarFondoAvance
	 * Prop�sito:				Permite Crear un comprobante en contabilidad luego contabilidad valida este comprobante
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function ContabilizarFondoAvance($id_avance,$id_empleado,$id_moneda)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_iud';
		$this->codigo_procedimiento = "'TS_CONTAB_AVA'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance);
		$this->var->add_param("NULL");
		$this->var->add_param($id_empleado);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($id_moneda);
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
        $this->var->add_param("NULL");
        $this->var->add_param("NULL");
        $this->var->add_param("NULL");
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
	 * Nombre de la funci�n:	InsertarSolicitudFondos
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tts_avance
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function InsertarSolicitudFondos($id_avance,$id_empleado,$tipo_avance,$fecha_avance,$importe_avance,$estado_avance,$id_moneda,$id_cheque,$id_documento,$id_comprobante,$fk_avance,$id_depto,$id_caja,$avance_solicitud,$id_cajero,$nro_avance,$concepto_avance,$observacion_avance)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_iud';
		$this->codigo_procedimiento = "'TS_SOLFON_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($id_empleado);
		$this->var->add_param($tipo_avance);
		$this->var->add_param("'$fecha_avance'");
		$this->var->add_param($importe_avance);
		$this->var->add_param($estado_avance);
		$this->var->add_param($id_moneda);
		$this->var->add_param($id_cheque);
		$this->var->add_param($id_documento);
		$this->var->add_param($id_comprobante);
		$this->var->add_param($fk_avance);
		$this->var->add_param("NULL");
        $this->var->add_param($id_depto);
        $this->var->add_param($id_caja);
        $this->var->add_param($avance_solicitud);
        $this->var->add_param($id_cajero);
        $this->var->add_param("'$nro_avance'");
        $this->var->add_param("'$concepto_avance'");
        $this->var->add_param("NULL");
        $this->var->add_param("NULL");
        $this->var->add_param("'$observacion_avance'");
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
	 * Nombre de la funci�n:	ModificarSolicitudFondos
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tts_avance
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function ModificarSolicitudFondos($id_avance,$id_empleado,$tipo_avance,$fecha_avance,$importe_avance,$estado_avance,$id_moneda,$id_cheque,$id_documento,$id_comprobante,$fk_avance,$id_depto,$id_caja,$avance_solicitud,$id_cajero,$nro_avance,$concepto_avance,$observacion_avance)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_iud';
		$this->codigo_procedimiento = "'TS_SOLFON_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance);
		$this->var->add_param("NULL");
		$this->var->add_param($id_empleado);
		$this->var->add_param($tipo_avance);
		$this->var->add_param("'$fecha_avance'");
		$this->var->add_param($importe_avance);
		$this->var->add_param($estado_avance);
		$this->var->add_param($id_moneda);
		$this->var->add_param($id_cheque);
		$this->var->add_param($id_documento);
		$this->var->add_param($id_comprobante);
		$this->var->add_param($fk_avance);
		$this->var->add_param("NULL");
        $this->var->add_param($id_depto);
        $this->var->add_param($id_caja);
        $this->var->add_param($avance_solicitud);
        $this->var->add_param($id_cajero);
         $this->var->add_param("'$nro_avance'");
        $this->var->add_param("'$concepto_avance'");
        $this->var->add_param("NULL");
        $this->var->add_param("NULL");
        $this->var->add_param("'$observacion_avance'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
       
		return $res;
	}
	/**
	 * Nombre de la funci�n:	InsertarDescargo
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tts_avance
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function InsertarDescargo($id_avance,$id_unidad_organizacional,$id_empleado,$tipo_avance,$fecha_avance,$importe_avance,$estado_avance,$id_moneda,$id_cheque,$id_documento,$id_comprobante,$fk_avance,$id_presupuesto,$id_depto,$id_caja,$avance_solicitud,$id_cajero,$nro_avance,$fecha_ini_rendicion,$fecha_fin_rendicion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_iud';
		$this->codigo_procedimiento = "'TS_DESCAR_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_unidad_organizacional);
		$this->var->add_param($id_empleado);
		$this->var->add_param($tipo_avance);
		$this->var->add_param("'$fecha_avance'");
		$this->var->add_param($importe_avance);
		$this->var->add_param($estado_avance);
		$this->var->add_param($id_moneda);
		$this->var->add_param($id_cheque);
		$this->var->add_param($id_documento);
		$this->var->add_param($id_comprobante);
		$this->var->add_param($fk_avance);
		$this->var->add_param("NULL");
        $this->var->add_param($id_depto);
        $this->var->add_param($id_caja);
        $this->var->add_param($avance_solicitud);
        $this->var->add_param($id_cajero);
        $this->var->add_param("'$nro_avance'");
        $this->var->add_param("NULL");
        $this->var->add_param("'$fecha_ini_rendicion'");
        $this->var->add_param("'$fecha_fin_rendicion'");
        $this->var->add_param("NULL");
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
	
	
	function ModificarDescargo($id_avance,$fecha_avance,$nro_avance,$fecha_ini_rendicion,$fecha_fin_rendicion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_iud';
		$this->codigo_procedimiento = "'TS_DESCAR_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("'$fecha_avance'");
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
		$this->var->add_param("NULL");
		$this->var->add_param("'$nro_avance'");
        $this->var->add_param("NULL");
        $this->var->add_param("'$fecha_ini_rendicion'");
        $this->var->add_param("'$fecha_fin_rendicion'");
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
	 * Nombre de la funci�n:	EliminarSolicitudFondos
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tts_avance
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function EliminarSolicitudFondos($id_avance)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_iud';
		$this->codigo_procedimiento = "'TS_SOLFON_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance);
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
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	/**
	 * Nombre de la funci�n:	EliminarDescargoDetalle
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tts_avance
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function EliminarDescargoDetalle($id_avance)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_iud';
		$this->codigo_procedimiento = "'TS_DESDET_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance);
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
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
/**
	 * Nombre de la funci�n:	InsertarValeAvance
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de un vale de caja
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function InsertarValeAvance($id_avance,$tipo,$id_empleado,$importe_avance,$id_moneda,$id_caja,$id_cajero)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_iud';
		$this->codigo_procedimiento = "'TS_VALAVA_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance);
		$this->var->add_param($tipo);
		$this->var->add_param($id_empleado);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($importe_avance);
		$this->var->add_param("NULL");
		$this->var->add_param($id_moneda);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
        $this->var->add_param("NULL");
        $this->var->add_param($id_caja);
        $this->var->add_param("NULL");
        $this->var->add_param($id_cajero);
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
/* echo $this->query;
        exit;*/
		return $res;
	}	
	
	/**
	 * Nombre de la funci�n:	ModificarDescargoDetalla
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n del aprobador en los documentos
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function ModificarDescargoDetalle($id_avance,$id_usuario_aprueba)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_iud';
		$this->codigo_procedimiento = "'TS_DESDET_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance);
		$this->var->add_param($id_usuario_aprueba);
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
        $this->var->add_param("NULL");
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
/* echo $this->query;
        exit;*/
		return $res;
	}
/**
	 * Nombre de la funci�n:	ComproContaDescargo
	 * Prop�sito:				Permite comprometer y contabilizar un descargo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function ComproContaDescargo($id_avance,$id_moneda)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_iud';
		$this->codigo_procedimiento = "'TS_COMPRO_CONTA'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($id_moneda);
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
        $this->var->add_param("NULL");
        $this->var->add_param("NULL");
        $this->var->add_param("NULL");
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
	 * Nombre de la funci�n:	ChequeEmitido
	 * Prop�sito:				Cambia el estado del avance de solicitud validada a cheque emitido
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function ChequeEmitido($id_avance,$estado_avance)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_iud';
		$this->codigo_procedimiento = "'TS_CHEQUE_EMI'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($estado_avance);
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
	 * Nombre de la funci�n:	AnularDescargo
	 * Prop�sito:				Permite ejecutar la funci�n para anular el descargo de solicitud de compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function AnularDescargo($id_avance,$id_plan_pago)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_iud';
		$this->codigo_procedimiento = "'TS_ANULA_DES'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance);
		$this->var->add_param($id_plan_pago);
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
        $this->var->add_param("NULL");
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
/* echo $this->query;
        exit;*/
		return $res;
	}
	/**
	 * Nombre de la funci�n:	FinalizaPendienteAvance
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tts_avance
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function FinalizaPendienteAvance($id_avance,$tipo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_iud';
		$this->codigo_procedimiento = "'TS_FINPEN_AVA'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance);
		$this->var->add_param($tipo);
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
		$this->var->add_param("NULL");
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
	 * Nombre de la funci�n:	AprobarDocumentoDescargo
	 * Prop�sito:				Permite aprobar los documentos de un descargo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function AprobarDocumentoDescargo($id_avance,$id_usuario_aprueba)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_iud';
		$this->codigo_procedimiento = "'TS_APRO_DOCUME'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($id_usuario_aprueba);//id del usuario que aprueba
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
        $this->var->add_param("NULL");
        $this->var->add_param("NULL");
        $this->var->add_param("NULL");
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
	 * Nombre de la funci�n:	Reporte Cheque
	 * Prop�sito:				Desplegar los registros de cheque
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2009-02-03 11:19:00
	 */
	function ReporteCheque($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'TS_REPCHE_SEL'";

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
        $this->var->add_param("NULL");//id_usuario
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('fecha_cheque_literal','text');
		$this->var->add_def_cols('nombre_cheque','varchar');
		$this->var->add_def_cols('importe_avance','numeric(18,2)');
		$this->var->add_def_cols('importe_avance_literal','varchar');
		$this->var->add_def_cols('fecha_cheque','date');
		$this->var->add_def_cols('nombre_institucion','varchar');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	/*	echo $this->query;
		exit;*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	Reporte Cheque
	 * Prop�sito:				Desplegar los registros de cheque
	 * Autor:				    avq)
	 * Fecha de creaci�n:		2009-02-03 11:19:00
	 * Fecha ultima de modificaci�n: 2009-07-02
	 */
	function ReporteReciboFondoAvance($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'TS_RECENT_SEL'";

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
		$this->var->add_param("NULL");//id_usuario
	
		
		
		$this->var->add_def_cols('id_avance','int4');
		$this->var->add_def_cols('fecha_avance','date');
		$this->var->add_def_cols('id_cuenta_bancaria','int4');
		$this->var->add_def_cols('nro_cheque','integer');
		$this->var->add_def_cols('nomb_empleado','TEXT'); 
        $this->var->add_def_cols('nombre_institucion','VARCHAR(100)'); 
  	    $this->var->add_def_cols('importe_avance','NUMERIC(18,2)'); 
        $this->var->add_def_cols('importe_avance_literal','VARCHAR'); 
  		$this->var->add_def_cols('nombre_financiador','VARCHAR(100)'); 
  		$this->var->add_def_cols('nombre_regional','VARCHAR(100)'); 
  		$this->var->add_def_cols('nombre_programa','VARCHAR(100)'); 
  		$this->var->add_def_cols('nombre_proyecto','VARCHAR(100)'); 
  		$this->var->add_def_cols('nombre_actividad','VARCHAR(100)');
  		$this->var->add_def_cols('nro_avance','varchar');
  		$this->var->add_def_cols('nombre_unidad','varchar');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	/*	echo $this->query;
		exit;*/
		return $res;
	}
	
	function ListarReporteDescargoCab($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'TS_REDECA_SEL'";

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
        $this->var->add_param("NULL");//id_usuario
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('nro_avance','varchar');
		$this->var->add_def_cols('fecha','text');
		$this->var->add_def_cols('hora','text');		
		$this->var->add_def_cols('unidad','varchar');
		$this->var->add_def_cols('empleado','text');
		$this->var->add_def_cols('importe_entregado','numeric');
		$this->var->add_def_cols('fecha_avance','text');
		
		$this->var->add_def_cols('importe_literal','varchar');
		$this->var->add_def_cols('nombre_completo','text');
		$this->var->add_def_cols('lugar_sus','varchar');
		

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
	    
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo $this->query; exit();
		return $res;*/
	}
	
	
	
	function ListarReporteDescargoEP($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'TS_REDEEP_SEL'";

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
        $this->var->add_param("NULL");//id_usuario
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_fina_regi_prog_proy_acti','integer');
		$this->var->add_def_cols('financiador','varchar');
		$this->var->add_def_cols('regional','varchar');
		$this->var->add_def_cols('programa','varchar');
		$this->var->add_def_cols('proyecto','varchar');
		$this->var->add_def_cols('actividad','varchar');
		$this->var->add_def_cols('unidad','varchar');
		$this->var->add_def_cols('id_unidad_organizacional','integer');
		
		

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		
		return $res;
	}
	
	
	function ListarReporteDescargo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'TS_REPDES_SEL'";

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
        $this->var->add_param("NULL");//id_usuario
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('nro','bigint');
		$this->var->add_def_cols('fecha','text');
		$this->var->add_def_cols('descripcion','text');
		$this->var->add_def_cols('cargo','varchar');
		$this->var->add_def_cols('descargo','numeric');
		
		

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		/*$this->query = $this->var->query;
		echo $this->query; exit();*/
		
		return $res;
	}
	/**
	 * Nombre de la funci�n:	ListarRepSolicitudFondos
	 * Prop�sito:				Desplegar los registros de tts_avance
	 * Autor:				    avq
	 * Fecha de creaci�n:		2009/07/07
	 */
	function ListarRepSolicitudFondos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'TS_REFOAV_SEL'";

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
		 $this->var->add_param("NULL");//id_usuario
		//$this->var->add_param($id_usuario);//id_usuario

		//Carga la definici�n de columnas con sus tipos de datos
		
		$this->var->add_def_cols('nro_sol',' TEXT');
		$this->var->add_def_cols('fecha_solicitud',' TEXT');
		$this->var->add_def_cols('nombre_empleado',' TEXT');
		$this->var->add_def_cols('cargo','VARCHAR ');
		$this->var->add_def_cols('centro_responsabilidad',' VARCHAR ');
		$this->var->add_def_cols('concepto_avance',' VARCHAR ');
		$this->var->add_def_cols('lugar',' VARCHAR ');
		$this->var->add_def_cols('fecha_ini',' DATE');
		$this->var->add_def_cols('monto',' NUMERIC ');
		$this->var->add_def_cols('monto_literal',' TEXT');
		$this->var->add_def_cols('detalle_gasto',' TEXT');
		$this->var->add_def_cols('total','NUMERIC ');
		$this->var->add_def_cols('observacion_avance',' TEXT ');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	//echo $this->query; exit();
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ListarCheques_x_Planilla
	 * Prop�sito:				Desplegar los cheques  por planilla
	 * Autor:				    Ana Maria Villegas Quispe
	 * Fecha de creaci�n:		29/09/2009
	 */
	function ListarCheques_x_Planilla($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_avance_sel';
		$this->codigo_procedimiento = "'CT_CHEQUES_SEL'";

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
		 $this->var->add_param("NULL");//id_usuario

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('fecha_cheque_literal','text');
		$this->var->add_def_cols('nombre_cheque','varchar');
		$this->var->add_def_cols('importe_avance','numeric(18,2)');
		$this->var->add_def_cols('importe_avance_literal','varchar');
		$this->var->add_def_cols('fecha_cheque','date');
		$this->var->add_def_cols('nombre_institucion','varchar');
		



		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	
	
	/**
	 * Nombre de la funci�n:	ValidarSolicitudFondos
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tts_avance
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 15:49:00
	 */
	function ValidarSolicitudFondos($operacion_sql,$id_avance,$id_empleado,$tipo_avance,$fecha_avance,$importe_avance,$estado_avance,$id_moneda,$id_cheque,$id_documento,$id_comprobante,$fk_avance,$id_depto,$id_caja,$id_cajero)
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
				//Validar id_avance - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_avance");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_avance", $id_avance))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_unidad_organizacional - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_unidad_organizacional");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_unidad_organizacional", $id_unidad_organizacional))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_presupuesto - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_presupuesto");
			$tipo_dato->set_AllowBlank("true");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_presupuesto", $id_presupuesto))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_depto - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_depto");
			$tipo_dato->set_AllowBlank("true");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_depto", $id_depto))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_caja - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_caja");
			$tipo_dato->set_MaxLength(15);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_caja", $id_caja))
			{
				$this->salida = $valid->salida;
				return false;
			}
            //Validar id_cajero - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_cajero");
			$tipo_dato->set_MaxLength(15);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cajero", $id_cajero))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validar id_empleado - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado", $id_empleado))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar tipo_avance - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("tipo_avance");
			$tipo_dato->set_MaxLength(131072);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "tipo_avance", $tipo_avance))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fecha_avance - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_avance");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_avance", $fecha_avance))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar importe_avance - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("importe_avance");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "importe_avance", $importe_avance))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar estado_avance - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_avance");
			$tipo_dato->set_MaxLength(131072);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "estado_avance", $estado_avance))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_moneda - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_moneda");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_moneda", $id_moneda))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_cheque - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_cheque");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cheque", $id_cheque))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_documento - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_documento");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_documento", $id_documento))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_comprobante - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_comprobante");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_comprobante", $id_comprobante))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fk_avance - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fk_avance");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "fk_avance", $fk_avance))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_avance - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_avance");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_avance", $id_avance))
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