<?php
/**
 * Nombre de la clase:	cls_DBPartidaArb.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla presto.tpr_partida
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-11-07 15:46:18
 */
class cls_DBPartidaArb{
	var $salida;
	var $query;
	var $var;
	var $nombre_funcion;
	var $codigo_procedimiento;
	var $decodificar;

	function __construct(){
		$this->decodificar=$decodificar;
	}
	/**
	 * ***********************************************************
	 * Para el Mannejo de �rboles
	 * 
	 * 
	 ************************************************************* 
	 */
	/**
	 * Nombre de la funci�n:	ListarPartidaRaiz
	 * Prop�sito:				Desplegar los registros de tpr_partida
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-07 15:46:18
	 */
	
	
	function ListarPartidaRaiz($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$gestion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_partida_arb_sel';
		$this->codigo_procedimiento = "'PR_PARGAS_RAIZ_SEL'";

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
		$this->var->add_param("NULL");//raiz
		$this->var->add_param("NULL");//id_presupuesto
        $this->var->add_param("$gestion");//gestion
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_partida','int4');
		$this->var->add_def_cols('codigo_partida','varchar');
		$this->var->add_def_cols('nombre_partida','varchar');
		$this->var->add_def_cols('desc_partida','varchar');
		$this->var->add_def_cols('nivel_partida','numeric');
		$this->var->add_def_cols('sw_transaccional','numeric');
		$this->var->add_def_cols('tipo_partida','numeric');
		$this->var->add_def_cols('id_parametro','integer');
		$this->var->add_def_cols('gestion_pres','numeric');
		$this->var->add_def_cols('estado_gral','numeric');
		$this->var->add_def_cols('tipo_memoria','numeric');
		$this->var->add_def_cols('sw_movimiento','numeric');
		$this->var->add_def_cols('dig_nivel','integer');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	/**
	 * Nombre de la funci�n:	ListarPartidaIngresoRaiz
	 * Prop�sito:				Desplegar los registros de tpr_partida
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-07 15:46:18
	 */
	function ListarPartidaIngresoRaiz($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$gestion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_partida_arb_sel';
		$this->codigo_procedimiento = "'PR_PARING_RAIZ_SEL'";

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
		$this->var->add_param("NULL");//raiz
		$this->var->add_param("NULL");//id_presupuesto
        $this->var->add_param("$gestion");//gestion
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_partida','int4');
		$this->var->add_def_cols('codigo_partida','varchar');
		$this->var->add_def_cols('nombre_partida','varchar');
		$this->var->add_def_cols('desc_partida','varchar');
		$this->var->add_def_cols('nivel_partida','numeric');
		$this->var->add_def_cols('sw_transaccional','numeric');
		$this->var->add_def_cols('tipo_partida','numeric');
		$this->var->add_def_cols('id_parametro','integer');
		$this->var->add_def_cols('gestion_pres','numeric');
		$this->var->add_def_cols('estado_gral','numeric');
		$this->var->add_def_cols('tipo_memoria','numeric');
		$this->var->add_def_cols('sw_movimiento','numeric');
		$this->var->add_def_cols('dig_nivel','integer');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	function ListarDetallePartidaAsignacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_partida_arb_sel';
		$this->codigo_procedimiento = "'PR_PARASI_RAIZ_SEL'";

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
		$this->var->add_param("NULL");//raiz
		$this->var->add_param("NULL");//raiz
        $this->var->add_param("NULL");//raiz
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_partida','int4');
		$this->var->add_def_cols('codigo_partida','varchar');
		$this->var->add_def_cols('nombre_partida','varchar');
		$this->var->add_def_cols('desc_partida','varchar');
		$this->var->add_def_cols('nivel_partida','numeric');
		$this->var->add_def_cols('sw_transaccional','numeric');
		$this->var->add_def_cols('tipo_partida','numeric');
		$this->var->add_def_cols('id_parametro','integer');
		$this->var->add_def_cols('gestion_pres','numeric');
		$this->var->add_def_cols('tipo_memoria','numeric');
		$this->var->add_def_cols('sw_movimiento','numeric');
		$this->var->add_def_cols('checked','BOOLEAN');
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
	
	function ListarDetallePartidaAsignacionRama($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_partida,$id_presupuesto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_partida_arb_sel';
		$this->codigo_procedimiento = "'PR_PARASI_RAMA_SEL'";

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
		$this->var->add_param($id_partida);//raiz
		$this->var->add_param($id_presupuesto);//id_presupuesto
		$this->var->add_param("NULL");//raiz

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_partida','integer');
		$this->var->add_def_cols('codigo_partida','varchar');
		$this->var->add_def_cols('nombre_partida','varchar');
		$this->var->add_def_cols('desc_partida','varchar');
		$this->var->add_def_cols('nivel_partida','numeric');
		$this->var->add_def_cols('sw_transaccional','numeric');
		$this->var->add_def_cols('tipo_partida','numeric');
		$this->var->add_def_cols('id_parametro','integer');
		$this->var->add_def_cols('gestion_pres','numeric');
		$this->var->add_def_cols('tipo_memoria','numeric');
		$this->var->add_def_cols('sw_movimiento','numeric');
		$this->var->add_def_cols('checked','boolean');
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
	 * Nombre de la funci�n:	ListarPartidaArb
	 * Prop�sito:				Desplegar los registros de tpr_partida
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-07 15:46:18
	 */
	function ListarPartidaArb($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$agrupador,$gestion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_partida_arb_sel';
		$this->codigo_procedimiento = "'PR_PARGAS_ARB_SEL'";

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
		$this->var->add_param("$agrupador");//raiz
		$this->var->add_param("NULL");//id_presupuesto
        $this->var->add_param("$gestion");//gestion
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_partida','int4');
		$this->var->add_def_cols('codigo_partida','varchar');
		$this->var->add_def_cols('nombre_partida','varchar');
		$this->var->add_def_cols('desc_partida','varchar');
		$this->var->add_def_cols('nivel_partida','numeric');
		$this->var->add_def_cols('sw_transaccional','numeric');
		$this->var->add_def_cols('tipo_partida','numeric');
		$this->var->add_def_cols('id_parametro','integer');
		$this->var->add_def_cols('gestion_pres','numeric');
		$this->var->add_def_cols('estado_gral','numeric');
		$this->var->add_def_cols('id_partida_padre','integer');
		$this->var->add_def_cols('nombre_padre','varchar');
		$this->var->add_def_cols('codigo_padre','varchar');
		$this->var->add_def_cols('tipo_memoria','numeric');
		$this->var->add_def_cols('sw_movimiento','numeric');
		$this->var->add_def_cols('dig_nivel','integer');
		$this->var->add_def_cols('id_concepto_colectivo','integer');
		$this->var->add_def_cols('desc_colectivo','varchar');
		$this->var->add_def_cols('id_oec_sigma','integer');
		$this->var->add_def_cols('ent_trf','varchar');
		$this->var->add_def_cols('cod_ascii','varchar');
		$this->var->add_def_cols('cod_excel','varchar');
		$this->var->add_def_cols('desc_oec','varchar');
		$this->var->add_def_cols('cod_trans','varchar');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//echo "query:".$this->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarPartidaArb
	 * Prop�sito:				Contar los registros de tpr_partida
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-06 16:27:45
	 */
	function ContarPartidaArb($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$raiz,$gestion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_partida_arb_sel';
		$this->codigo_procedimiento = "'PR_PARGAS_ARB_COUNT'";
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
		$this->var->add_param("$raiz");//raiz
		$this->var->add_param("NULL");//id_presupuesto
		$this->var->add_param("$gestion");//gestion
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('total','bigint');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
		//Obtiene el array de salida de la funci�n
		$this->salida = $this->var->salida;
		//Si la ejecuci�n fue satisfactoria modifica la salida para que solo devuelva el total de la consulta
		if($res){
			$this->salida = $this->var->salida[0][0];
		}
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	/**
	 * Nombre de la funci�n:	InsertarPartidaRaiz
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_partida
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-07 15:46:18
	 */
	function InsertarPartidaRaiz($id_partida,$codigo_partida,$nombre_partida,$nivel_partida,$sw_transaccional,$tipo_partida,$id_parametro,$id_partida_padre,$tipo_memoria,$desc_partida){
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_partida_arb_iud';
		$this->codigo_procedimiento = "'PR_PARGASRAI_INS'";
		
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$codigo_partida'");
		$this->var->add_param("'$nombre_partida'");
		$this->var->add_param("$nivel_partida");
		$this->var->add_param("$sw_transaccional");
		$this->var->add_param("$tipo_partida");
		$this->var->add_param("$id_parametro");
		$this->var->add_param("NULL");
		$this->var->add_param("$tipo_memoria");
		$this->var->add_param("'$desc_partida'");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//id_oec_sigma
		$this->var->add_param("NULL");//ent_trf
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
	 * Nombre de la funci�n:	InsertarPartidaArb
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_partida
	 * Autor:				    (autogenerado)	
	 * Fecha de creaci�n:		2007-11-07 15:46:18
	 */
	function InsertarPartidaArb($id_partida,$codigo_partida,$nombre_partida,$nivel_partida,$sw_transaccional,$tipo_partida,$id_parametro,$id_partida_padre,$tipo_memoria,$desc_partida,$sw_movimiento,$id_concepto_colectivo,$id_oec_sigma,$ent_trf,$cod_ascii,$cod_excel,$cod_trans){
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_partida_arb_iud';
		$this->codigo_procedimiento = "'PR_PARGAS_ARB_INS'";
			
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$codigo_partida'");
		$this->var->add_param("'$nombre_partida'");
		$this->var->add_param("$nivel_partida");
		$this->var->add_param("$sw_transaccional");
		$this->var->add_param("$tipo_partida");
		$this->var->add_param("$id_parametro");
		$this->var->add_param("$id_partida_padre");
		$this->var->add_param("$tipo_memoria");
		$this->var->add_param("'$desc_partida'");
		$this->var->add_param("$sw_movimiento");
		
		if($id_concepto_colectivo=="-1"){$this->var->add_param("null");}
		else {$this->var->add_param("$id_concepto_colectivo");}       
		
		$this->var->add_param("$id_oec_sigma");
		$this->var->add_param("'$ent_trf'");
		$this->var->add_param("'$cod_ascii'");
		$this->var->add_param("'$cod_excel'");
		$this->var->add_param("'$cod_trans'");
		 
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo $this->query ;
		exit();*/
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ModificarPartidaArb
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpr_partida
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-07 15:46:18
	 */
	function ModificarPartidaArb($id_partida,$codigo_partida,$nombre_partida,$nivel_partida,$sw_transaccional,$tipo_partida,$id_parametro,$id_partida_padre,$tipo_memoria,$desc_partida,$sw_movimiento,$id_concepto_colectivo,$id_oec_sigma,$ent_trf,$cod_ascii,$cod_excel,$cod_trans){
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_partida_arb_iud';
		$this->codigo_procedimiento = "'PR_PARGAS_ARB_UPD'";
		
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("$id_partida");
		$this->var->add_param("'$codigo_partida'");
		$this->var->add_param("'$nombre_partida'");
		$this->var->add_param("$nivel_partida");
		$this->var->add_param("$sw_transaccional");
		$this->var->add_param("$tipo_partida");
		$this->var->add_param("$id_parametro");
		$this->var->add_param("$id_partida_padre");
		$this->var->add_param("$tipo_memoria");
		$this->var->add_param("'$desc_partida'");
        $this->var->add_param("$sw_movimiento");
        
        if($id_concepto_colectivo=="-1"){
        		$this->var->add_param("null");
        }
		else {
			$this->var->add_param("$id_concepto_colectivo");
		}     
		
		$this->var->add_param("$id_oec_sigma");//id_oec_sigma
		$this->var->add_param("'$ent_trf'");//ent_trf
		$this->var->add_param("'$cod_ascii'");
		$this->var->add_param("'$cod_excel'");
		$this->var->add_param("'$cod_trans'");
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
/*echo $this->query ;
		exit;*/
		return $res;
	}

	/**
	 * Nombre de la funci�n:	EliminarPartidaArb
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_partida
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-07 15:46:18
	 */
	function EliminarPartidaArb($id_partida,$id_partida_padre){
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_partida_arb_iud';
		$this->codigo_procedimiento = "'PR_PARGAS_ARB_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("$id_partida");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("$id_partida_padre");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
        $this->var->add_param("NULL");
        $this->var->add_param("NULL");
        $this->var->add_param("NULL");//id_oec_sigma
		$this->var->add_param("NULL");//ent_trf
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
	 * Nombre de la funci�n:	EliminarPartidaRaiz
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_partida
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-07 15:46:18
	 */
	function EliminarPartidaRaiz($id_partida){
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_partida_arb_iud';
		$this->codigo_procedimiento = "'PR_PARGASRAI_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("$id_partida");
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
        $this->var->add_param("NULL");//id_oec_sigma
		$this->var->add_param("NULL");//ent_trf
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//echo "query:".$this->query;

		return $res;
	}
}?>