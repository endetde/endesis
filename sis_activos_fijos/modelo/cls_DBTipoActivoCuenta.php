<?php
/**
 * Nombre de la clase:	cls_DBTipoActivoCuenta
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla taf_tipo_activo_cuenta
 * Autor:				Elmer Velasquez
 * Fecha creaci�n:		01/02/2013
 */
class cls_DBTipoActivoCuenta
{
	//Variable que contiene la salida de la ejecuci�n de la funci�n
	//si la funci�n tuvo error (false), salida contendr� el mensaje de error
	//si la funci�n no tuvo error (true), salida contendr� el resultado, ya sea un conjunto de datos o un mensaje de confirmaci�n
	var $salida;

	//Variable que contedr� la cadena de llamada a las funciones postgres
	var $query;

	//Variables para la ejecuci�n de funciones
	var $var; //middle_client
	var $nombre_funcion; //nombre de la funci�n a ejecutar
	var $codigo_procedimiento; //codigo del procedimiento a ejecutar

	//Nombre del archivo
	var $nombre_archivo = "cls_DBTipoActivoCuenta";

	//Matriz de par�metros de validaci�n de todas las columnas
	var $matriz_validacion = array();

	//Bandera que indica si los datos se decodificar�n o no
	var $decodificar = false;

	function __construct($decodificar)
	{
		//Carga en una variable interna la bandera del GET o POST
		$this->decodificar = $decodificar;
	}

	/**
	 * Nombre de la funci�n:	ListarTipoActivoCuenta
	 * Prop�sito:				Desplegar los registros de taf_tipo_activo_cuenta en funci�n de los par�metros del filtro
	 * Autor:					
	 * Fecha de creaci�n:		
	 *
	 * @param unknown_type $cant
	 * @param unknown_type $puntero
	 * @param unknown_type $sortcol
	 * @param unknown_type $sortdir
	 * @param unknown_type $criterio_filtro
	 * @return unknown
	 */
	
	/***************************************************************************************************/
	function ListarTipoActivoCuenta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_tipo_activo_cuenta_sel';
		$this->codigo_procedimiento = "'AF_TAFCTA_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales  
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD 
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

		//Carga la definici�n de columnas con sus tipos de datos
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_tipo_activo_cuenta','integer');
		$this->var->add_def_cols('id_tipo_activo','integer');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('descripcion_programa','varchar');
		$this->var->add_def_cols('cuenta_activo','varchar');
		$this->var->add_def_cols('cuenta_dep_acumulada','varchar');
		$this->var->add_def_cols('cuenta_gasto','varchar');
		$this->var->add_def_cols('cuenta_activo_auxiliar','varchar');
		$this->var->add_def_cols('cuenta_dep_acumulada_auxiliar','varchar');
		$this->var->add_def_cols('cuenta_gasto_auxiliar','varchar');
		$this->var->add_def_cols('tension','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('nombre_cuenta_activo','text');
		$this->var->add_def_cols('nombre_cuenta_activo_auxiliar','text');
		$this->var->add_def_cols('id_cta_activo','integer');
		$this->var->add_def_cols('id_cta_activo_auxiliar','integer');
		$this->var->add_def_cols('nombre_cuenta_dep_acumulada','text');
		$this->var->add_def_cols('nombre_cuenta_dep_acumulada_auxiliar','text');
		$this->var->add_def_cols('nombre_cuenta_gasto','text');
		$this->var->add_def_cols('nombre_cuenta_gasto_auxiliar','text');
		$this->var->add_def_cols('id_cta_dep_acum','integer');
		$this->var->add_def_cols('id_cta_dep_acum_auxiliar','integer');
		$this->var->add_def_cols('id_cta_gasto','integer');
		$this->var->add_def_cols('id_cta_gasto_auxiliar','integer');
		

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	/**
	 * Nombre de la funci�n:	CountTipoActivoCuenta
	 * Prop�sito:				Contar los registros de taf_tipo_activo_cuenta 
	 * Autor:					
	 * Fecha de creaci�n:		
	 *
	 * @param unknown_type $cant
	 * @param unknown_type $puntero
	 * @param unknown_type $sortcol
	 * @param unknown_type $sortdir
	 * @param unknown_type $criterio_filtro
	 * @return unknown
	 */
	
	function CountTipoActivoCuenta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_tipo_activo_cuenta_sel';
		$this->codigo_procedimiento = "'AF_TAFCTA_COUNT'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";
		
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
	 * Nombre de la funci�n:	InsertarProceso
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n en la tabla actif.taf_tipo_activo_cuenta
	 * Autor:				    (
	 * Fecha de creaci�n:		
	 */
	function InsertarTipoActivoCuenta($id_tipo_activo_cuenta,$id_tipo_activo,$codigo_programa,$descripcion_programa,$cuenta_activo,$cuenta_depacum,$cuenta_gasto,$cuenta_activo_auxiliar,$cuenta_dep_acumulada_auxiliar,$cuenta_gasto_auxiliar,$id_tension)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_tipo_activo_cuenta_iud';
		$this->codigo_procedimiento = "'AF_TAFCTA_INS'";
  
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_tipo_activo_cuenta);//af_id_tipo_activo_cuenta
		$this->var->add_param($id_tipo_activo);//af_id_tipo_activo 
		$this->var->add_param("'$codigo_programa'");//af_codigo_programa
		$this->var->add_param("'$descripcion_programa'");//af_descripcion_programa
		$this->var->add_param("'$cuenta_activo'");//af_cuenta_activo
		$this->var->add_param("'$cuenta_depacum'");//af_cuenta_dep_acumulada
		$this->var->add_param("'$cuenta_gasto'");//af_cuenta_gasto
		$this->var->add_param("'$cuenta_activo_auxiliar'");//af_cuenta_activo_auxiliar
		$this->var->add_param("'$cuenta_dep_acumulada_auxiliar'");//af_cuenta_dep_acumulada_auxiliar
		$this->var->add_param("'$cuenta_gasto_auxiliar'");//af_cuenta_gasto_auxiliar
		$this->var->add_param("'$id_tension'");//af_id_tension	

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//echo "query:" .$this->query;
		//exit;
		
		return $res;
	}
	/*
	 * Nombre de la funci�n:	EliminarTipoActivoCuenta
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla taf_activo_fijo_cuenta
	 * Autor:				    
	 * Fecha de creaci�n:		
	 */
	function EliminarTipoActivoCuenta($id_tipo_activo_cuenta)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_tipo_activo_cuenta_iud';
		$this->codigo_procedimiento = "'AF_TAFCTA_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_tipo_activo_cuenta);//af_id_tipo_activo_cuenta
		$this->var->add_param("NULL");//af_id_tipo_activo
		$this->var->add_param("NULL");//af_codigo_programa
		$this->var->add_param("NULL");//af_descripcion_programa
		$this->var->add_param("NULL");//af_cuenta_activo
		$this->var->add_param("NULL");//af_cuenta_dep_acumulada
		$this->var->add_param("NULL");//af_cuenta_gasto
		$this->var->add_param("NULL");//af_cuenta_activo_auxiliar
		$this->var->add_param("NULL");//af_cuenta_dep_acumulada_auxiliar
		$this->var->add_param("NULL");//af_cuenta_gasto_auxiliar
		$this->var->add_param("NULL");//af_id_tension

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	/**
	 * Nombre de la funci�n:	ModificarTipoActivoCuenta
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla taf_tipo_activo_cuenta
	 * Autor:				    
	 * Fecha de creaci�n:		
	 */
	function ModificarTipoActivoCuenta($id_tipo_activo_cuenta,$id_tipo_activo,$codigo_programa,$descripcion_programa,$cuenta_activo,$cuenta_depacum,$cuenta_gasto,$cuenta_activo_auxiliar,$cuenta_dep_acumulada_auxiliar,$cuenta_gasto_auxiliar,$id_tension)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_tipo_activo_cuenta_iud';
		$this->codigo_procedimiento = "'AF_TAFCTA_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_tipo_activo_cuenta);//af_id_tipo_activo_cuenta
		$this->var->add_param($id_tipo_activo);//af_id_tipo_activo
		$this->var->add_param("'$codigo_programa'");//af_codigo_programa
		$this->var->add_param("'$descripcion_programa'");//af_descripcion_programa
		$this->var->add_param("'$cuenta_activo'");//af_cuenta_activo
		$this->var->add_param("'$cuenta_depacum'");//af_cuenta_dep_acumulada
		$this->var->add_param("'$cuenta_gasto'");//af_cuenta_gasto	
		$this->var->add_param("'$cuenta_activo_auxiliar'");//af_cuenta_activo_auxiliar
		$this->var->add_param("'$cuenta_dep_acumulada_auxiliar'");//af_cuenta_dep_acumulada_auxiliar
		$this->var->add_param("'$cuenta_gasto_auxiliar'");//af_cuenta_gasto_auxiliar
		$this->var->add_param("'$id_tension'");//af_id_tension
		
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
     
		return $res;	
	}
	/*INICIO FUNCIONES EXTRAS PARA LISTAR LAS CUENTAS CONTABLES REGISTRAS LA ACTUAL GESTION*/
	/**
	 * Nombre de la funci�n:	ContarCuentasContablesGestion
	 * Prop�sito:				cantidad de cuentas registradas la gestion contable actual
	 * Autor:				    
	 * Fecha de creaci�n:		
	 */
	function ContarCuentasContablesGestion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_tipo_activo_cuenta_sel';
		$this->codigo_procedimiento = "'CTAS_GEST_COUNT'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";
		
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
		//echo "query:" .$this->query;
		//exit;
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	/**
	 * Nombre de la funci�n:	ListarCuentasContablesGestion
	 * Prop�sito:				Lista  las cuentas registradas la gestion contable actual
	 * Autor:				    
	 * Fecha de creaci�n:		
	 */
	function ListarCuentasContablesGestion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_tipo_activo_cuenta_sel';
		$this->codigo_procedimiento = "'CTAS_GEST_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";
	
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_cuenta','integer');
		$this->var->add_def_cols('nro_cuenta','varchar');
		$this->var->add_def_cols('nombre_cuenta','varchar');
		$this->var->add_def_cols('descripcion','text');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//echo "query:" .$this->query;
		//exit;
		return $res;
	}
	/*FIN FUNCIONES EXTRAS PARA LISTAR LAS CUENTAS CONTABLES REGISTRAS LA ACTUAL GESTION*/
	
	/**
	 * Nombre de la funci�n:	CountActivoFijoDistribucion
	 * Prop�sito:				determinar la cantidad de activos fijos con programa distribucion
	 * 							dado un grupo proceso como parametro
	 * Autor:				    
	 * Fecha de creaci�n:		
	 */
	function CountActivoFijoDistribucion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_tipo_activo_cuenta_sel';
		$this->codigo_procedimiento = "'AF_TAFCTA_COUNTDIST'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";
		
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
	function ListarActivoFijoDistribucion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = ""; 		$this->nombre_funcion = 'f_taf_tipo_activo_cuenta_sel';
		$this->codigo_procedimiento = "'AF_TAFCTA_SELDIST'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_activo_fijo','integer'); 
		$this->var->add_def_cols('descripcion_activo_fijo','text');
		$this->var->add_def_cols('id_tipo_activo','integer');
		$this->var->add_def_cols('tipo_activo','varchar');
		$this->var->add_def_cols('id_sub_tipo_activo','integer');
		$this->var->add_def_cols('subtipo_activo','varchar');
		$this->var->add_def_cols('programa','text');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('tension','varchar');
		
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
}?>