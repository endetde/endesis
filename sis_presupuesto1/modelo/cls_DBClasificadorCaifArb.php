<?php
/**
 * Nombre de la clase:	cls_DBClasificadorCaifArb.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla presto.tpr_caif
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-11-07 15:46:18
 */
class cls_DBClasificadorCaifArb{
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
	 * Para el Manejo de �rboles
	 * 
	 * 
	 ************************************************************* 
	 */
	/**
	 * Nombre de la funci�n:	ListarCaifRaiz
	 * Prop�sito:				Desplegar los registros de tpr_caif
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-07 15:46:18
	 */
	
	
	function ListarCaifRaiz($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$gestion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_caif_arb_sel';
		$this->codigo_procedimiento = "'PR_CAIFGAS_RAIZ_SEL'";

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
		$this->var->add_def_cols('id_caif','int4');
		$this->var->add_def_cols('codigo_caif','varchar');
		$this->var->add_def_cols('nombre_caif','varchar');
		$this->var->add_def_cols('desc_caif','varchar');
		$this->var->add_def_cols('nivel_caif','numeric');
		$this->var->add_def_cols('sw_transaccional','numeric');
		$this->var->add_def_cols('tipo_caif','numeric');
		$this->var->add_def_cols('id_parametro','integer');
		$this->var->add_def_cols('gestion_pres','numeric');
		$this->var->add_def_cols('estado_gral','numeric');
		/*$this->var->add_def_cols('tipo_memoria','numeric');
		$this->var->add_def_cols('sw_movimiento','numeric');*/
		$this->var->add_def_cols('dig_nivel','integer');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		exit;*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ListarcaifIngresoRaiz
	 * Prop�sito:				Desplegar los registros de tpr_caif
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-07 15:46:18
	 */
	function ListarcaifIngresoRaiz($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$gestion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_caif_arb_sel';
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
		$this->var->add_def_cols('id_caif','int4');
		$this->var->add_def_cols('codigo_caif','varchar');
		$this->var->add_def_cols('nombre_caif','varchar');
		$this->var->add_def_cols('desc_caif','varchar');
		$this->var->add_def_cols('nivel_caif','numeric');
		$this->var->add_def_cols('sw_transaccional','numeric');
		$this->var->add_def_cols('tipo_caif','numeric');
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
	
	function ListarDetallecaifAsignacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_caif_arb_sel';
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
		$this->var->add_def_cols('id_caif','int4');
		$this->var->add_def_cols('codigo_caif','varchar');
		$this->var->add_def_cols('nombre_caif','varchar');
		$this->var->add_def_cols('desc_caif','varchar');
		$this->var->add_def_cols('nivel_caif','numeric');
		$this->var->add_def_cols('sw_transaccional','numeric');
		$this->var->add_def_cols('tipo_caif','numeric');
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
	
	function ListarDetallecaifAsignacionRama($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_caif,$id_presupuesto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_caif_arb_sel';
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
		$this->var->add_param($id_caif);//raiz
		$this->var->add_param($id_presupuesto);//id_presupuesto
		$this->var->add_param("NULL");//raiz

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_caif','integer');
		$this->var->add_def_cols('codigo_caif','varchar');
		$this->var->add_def_cols('nombre_caif','varchar');
		$this->var->add_def_cols('desc_caif','varchar');
		$this->var->add_def_cols('nivel_caif','numeric');
		$this->var->add_def_cols('sw_transaccional','numeric');
		$this->var->add_def_cols('tipo_caif','numeric');
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
	 * Nombre de la funci�n:	ListarcaifArb
	 * Prop�sito:				Desplegar los registros de tpr_caif
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-07 15:46:18
	 */
	function ListarCaifArb($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$agrupador,$gestion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_caif_arb_sel';
		$this->codigo_procedimiento = "'PR_CAIFGAS_ARB_SEL'";

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
		$this->var->add_def_cols('id_caif','int4');
		$this->var->add_def_cols('codigo_caif','varchar');
		$this->var->add_def_cols('nombre_caif','varchar');
		$this->var->add_def_cols('desc_caif','varchar');
		$this->var->add_def_cols('nivel_caif','numeric');
		$this->var->add_def_cols('sw_transaccional','numeric');
		$this->var->add_def_cols('tipo_caif','numeric');
		$this->var->add_def_cols('id_parametro','integer');
		$this->var->add_def_cols('gestion_pres','numeric');
		$this->var->add_def_cols('estado_gral','numeric');
		$this->var->add_def_cols('id_caif_padre','integer');
		$this->var->add_def_cols('nombre_padre','varchar');
		$this->var->add_def_cols('codigo_padre','varchar');
		//$this->var->add_def_cols('tipo_memoria','numeric');
		//$this->var->add_def_cols('sw_movimiento','numeric');
		$this->var->add_def_cols('dig_nivel','integer');
	/*	$this->var->add_def_cols('id_concepto_colectivo','integer');
		$this->var->add_def_cols('desc_colectivo','varchar');
		$this->var->add_def_cols('id_oec_sigma','integer');
		$this->var->add_def_cols('ent_trf','varchar');
		$this->var->add_def_cols('cod_ascii','varchar');
		$this->var->add_def_cols('cod_excel','varchar');
		$this->var->add_def_cols('desc_oec','varchar');
		$this->var->add_def_cols('cod_trans','varchar');*/
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo "query:".$this->query;
		exit;*/
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarcaifArb
	 * Prop�sito:				Contar los registros de tpr_caif
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-06 16:27:45
	 */
	function ContarcaifArb($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$raiz,$gestion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_caif_arb_sel';
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
	 * Nombre de la funci�n:	InsertarcaifRaiz
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_caif
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-07 15:46:18
	 */
	function InsertarCaifRaiz($id_caif,$codigo_caif,$nombre_caif,$nivel_caif,$sw_transaccional,$tipo_caif,$id_parametro,$id_caif_padre,$tipo_memoria,$desc_caif){
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_caif_arb_iud';
		$this->codigo_procedimiento = "'PR_CAIFGASRAI_INS'";
		
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$codigo_caif'");
		$this->var->add_param("'$nombre_caif'");
		$this->var->add_param("$nivel_caif");
		$this->var->add_param("$sw_transaccional");
		$this->var->add_param("$tipo_caif");
		$this->var->add_param("$id_parametro");
		$this->var->add_param("NULL");
		//$this->var->add_param("$tipo_memoria");
		$this->var->add_param("'$desc_caif'");
		/*$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//id_oec_sigma
		$this->var->add_param("NULL");//ent_trf
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		*/
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	InsertarCaifArb
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_caif
	 * Autor:				    (autogenerado)	
	 * Fecha de creaci�n:		2007-11-07 15:46:18
	 */
	function InsertarCaifArb($id_caif,$codigo_caif,$nombre_caif,$nivel_caif,$sw_transaccional,$tipo_caif,$id_parametro,$id_caif_padre,$tipo_memoria,$desc_caif,$sw_movimiento,$id_concepto_colectivo,$id_oec_sigma,$ent_trf,$cod_ascii,$cod_excel,$cod_trans){
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_caif_arb_iud';
		$this->codigo_procedimiento = "'PR_CAIFGAS_ARB_INS'";
			
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$codigo_caif'");
		$this->var->add_param("'$nombre_caif'");
		$this->var->add_param("$nivel_caif");
		$this->var->add_param("$sw_transaccional");
		$this->var->add_param("$tipo_caif");
		$this->var->add_param("$id_parametro");
		$this->var->add_param("$id_caif_padre");
		//$this->var->add_param("$tipo_memoria");
		$this->var->add_param("'$desc_caif'");
		//$this->var->add_param("$sw_movimiento");
		
		/*if($id_concepto_colectivo=="-1"){$this->var->add_param("null");}
		else {$this->var->add_param("$id_concepto_colectivo");}       
		
		$this->var->add_param("$id_oec_sigma");
		$this->var->add_param("'$ent_trf'");
		$this->var->add_param("'$cod_ascii'");
		$this->var->add_param("'$cod_excel'");
		$this->var->add_param("'$cod_trans'");
		 */
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
	 * Nombre de la funci�n:	ModificarcaifArb
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpr_caif
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-07 15:46:18
	 */
	function ModificarCaifArb($id_caif,$codigo_caif,$nombre_caif,$nivel_caif,$sw_transaccional,$tipo_caif,$id_parametro,$id_caif_padre,$tipo_memoria,$desc_caif,$sw_movimiento,$id_concepto_colectivo,$id_oec_sigma,$ent_trf,$cod_ascii,$cod_excel,$cod_trans){
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_caif_arb_iud';
		$this->codigo_procedimiento = "'PR_CAIFGAS_ARB_UPD'";
		
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("$id_caif");
		$this->var->add_param("'$codigo_caif'");
		$this->var->add_param("'$nombre_caif'");
		$this->var->add_param("$nivel_caif");
		$this->var->add_param("$sw_transaccional");
		$this->var->add_param("$tipo_caif");
		$this->var->add_param("$id_parametro");
		$this->var->add_param("$id_caif_padre");
		//$this->var->add_param("$tipo_memoria");
		$this->var->add_param("'$desc_caif'");
      /*  $this->var->add_param("$sw_movimiento");
        
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
		$this->var->add_param("'$cod_trans'");*/
		
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
	 * Nombre de la funci�n:	EliminarcaifArb
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_caif
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-07 15:46:18
	 */
	function EliminarCaifArb($id_caif,$id_caif_padre){
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_caif_arb_iud';
		$this->codigo_procedimiento = "'PR_CAIGAS_ARB_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("$id_caif");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("$id_caif_padre");
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
	 * Nombre de la funci�n:	EliminarcaifRaiz
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_caif
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-07 15:46:18
	 */
	function EliminarCaifRaiz($id_caif){
		$this->salida = "";
		$this->nombre_funcion = 'presto.f_tpr_caif_arb_iud';
		$this->codigo_procedimiento = "'PR_CAIGASRAI_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("$id_caif");
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