<?php
/**
 * Nombre de la clase:	cls_DBActivoFijoComprobante
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla taf_activo_fijo_comprobante
 * Autor:				Elmer Velasquez
 * Fecha creaci�n:		01/02/2013
 */
class cls_DBActivoFijoComprobante
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
	var $nombre_archivo = "cls_DBActivoFijoComprobante";

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
	 * Nombre de la funci�n:	ListarActivoFijoComprobante
	 * Prop�sito:				Desplegar los registros de taf_activo_fijo_comprobante en funci�n de los par�metros del filtro
	 * Autor:					Elmer Velasquez
	 * Fecha de creaci�n:		01/02/2013
	 *
	 * @param unknown_type $cant
	 * @param unknown_type $puntero
	 * @param unknown_type $sortcol
	 * @param unknown_type $sortdir
	 * @param unknown_type $criterio_filtro
	 * @return unknown
	 */
	
	/***************************************************************************************************/
	function ListarActivoFijoComprobante($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_activo_fijo_comprobante_sel';
		$this->codigo_procedimiento = "'AF_TAFCOMP_SEL'";
 
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
		$this->var->add_def_cols('id_activo_fijo_comprobante','integer');
		$this->var->add_def_cols('id_grupo_proceso','integer');
		$this->var->add_def_cols('id_comprobante','integer');
		$this->var->add_def_cols('id_depto_contable','integer');
		$this->var->add_def_cols('desc_cuenta','text');
		$this->var->add_def_cols('monto','numeric');
		$this->var->add_def_cols('depreciacion_acumulada','numeric');
		$this->var->add_def_cols('estado','varchar');
		$this->var->add_def_cols('tipo_comprobante','varchar');
		$this->var->add_def_cols('monto_actual','numeric');
		$this->var->add_def_cols('id_tipo_activo_cuenta','integer');
		$this->var->add_def_cols('id_contra_cuenta','integer');
		$this->var->add_def_cols('depto_contable','text');
		

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
	/**
	 * Nombre de la funci�n:	CountActivoFijoComprobante
	 * Prop�sito:				Contar los registros de taf_activo_fijo_comprobante
	 * Autor:					Elmer Velasquez
	 * Fecha de creaci�n:		01/02/2013
	 *
	 * @param unknown_type $cant
	 * @param unknown_type $puntero
	 * @param unknown_type $sortcol
	 * @param unknown_type $sortdir
	 * @param unknown_type $criterio_filtro
	 * @return unknown
	 */
	
	function CountActivoFijoComprobante($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_activo_fijo_comprobante_sel';
		$this->codigo_procedimiento = "'AF_TAFCOMP_COUNT'";

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
	 * Nombre de la funci�n:	InsertarActivoFijoComprobante
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n en la tabla actif.taf_activo_fijo_comprobante
	 * Autor:				    Elmer Velasquez
	 * Fecha de creaci�n:		01/02/2013
	 */
	function InsertarActivoFijoComprobante($id_grupo_proceso)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_activo_fijo_comprobante_iud';
		$this->codigo_procedimiento = "'AF_TAFCOMP_INS'";
  
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		$this->var->add_param('NULL');//af_id_activo_fijo_comprobante
		$this->var->add_param($id_grupo_proceso);//af_id_grupo_proceso
		$this->var->add_param('NULL');//af_id_comprobante 
		$this->var->add_param('NULL');//af_id_depto_contable
		$this->var->add_param('NULL');//af_nro_cuenta
		$this->var->add_param('NULL');//af_nombre_cuenta
		$this->var->add_param('NULL');//af_monto
		$this->var->add_param('NULL');//af_depreciacion_acumulada
		$this->var->add_param('NULL');//af_estado
		$this->var->add_param('NULL');//af_tipo_comprobante
		$this->var->add_param('NULL');//af_monto_actual
		$this->var->add_param('NULL');//af_id_tipo_activo_cuenta
		$this->var->add_param('NULL');//af_id_contra_cuenta
		
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
	 * Nombre de la funci�n:	EliminarActivoFijoComprobante
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla taf_activo_fijo_comprobante
	 * Autor:				    Elmer Velasquez
	 * Fecha de creaci�n:		01/02/2013
	 */
	function EliminarActivoFijoComprobante($id_activo_fijo_comprobante)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_activo_fijo_comprobante_iud';
		$this->codigo_procedimiento = "'AF_TAFCOMP_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		
		
		$this->var->add_param($id_activo_fijo_comprobante);//af_id_activo_fijo_comprobante
		$this->var->add_param('NULL');//af_id_grupo_proceso
		$this->var->add_param('NULL');//af_id_comprobante
		$this->var->add_param('NULL');//af_id_depto_contable
		$this->var->add_param('NULL');//af_nro_cuenta
		$this->var->add_param('NULL');//af_nombre_cuenta
		$this->var->add_param('NULL');//af_monto
		$this->var->add_param('NULL');//af_depreciacion_acumulada
		$this->var->add_param('NULL');//af_estado
		$this->var->add_param('NULL');//af_tipo_comprobante
		$this->var->add_param('NULL');//af_monto_actual
		$this->var->add_param('NULL');//af_id_tipo_activo_cuenta
		$this->var->add_param('NULL');//af_id_contra_cuenta

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	/**INICIO DE LAS FUNCIONES QUE PERMITEN GENERAR LOS COMPROBANTES DE ALTA Y BAJA EN EL CONIN***/
	
	/*
	 * Nombre de la funci�n:	RegistrarComprobantesAlta
	 * Prop�sito:				Iniciar el registro de los comprobantes de alta en el CONIN
	 * Autor:				    Elmer Velasquez
	 * Fecha de creaci�n:		01/02/2013
	 */
	function RegistrarComprobantesAlta($id_grupo_proceso) 
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_registro_comprobantes_alta_iud';
		$this->codigo_procedimiento = "'AF_TAFCOMP_CBTEALTA'";

		$func = new cls_funciones();//Instancia de las funciones generales
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);
		
		/*$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";*/
		
		
		$this->var->add_param("$id_grupo_proceso");
		
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
	/*
	 * Nombre de la funci�n:	RegistrarComprobantesBaja
	 * Prop�sito:				Iniciar el registro de los comprobantes de baja en el CONIN
	 * Autor:				    Elmer Velasquez
	 * Fecha de creaci�n:		01/02/2013
	 */
	function RegistrarComprobantesBaja($id_grupo_proceso)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_registro_comprobantes_baja_iud';
		$this->codigo_procedimiento = "'AF_TAFCOMP_CBTEBAJA'";

		$func = new cls_funciones();//Instancia de las funciones generales
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);
		
		/*$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";*/
		
		
		$this->var->add_param("$id_grupo_proceso");
		
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
	
	function PDFDetalleAsociacionTipoEP($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_activo_fijo_comprobante_sel';
		$this->codigo_procedimiento = "'AF_DET_ASOC_TIPOEP'"; 

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los parametros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";
		
		
		//Carga la definicion de columnas con sus tipos de datos
		$this->var->add_def_cols('id_codigo_activo','text');
		$this->var->add_def_cols('tipo','varchar');
		$this->var->add_def_cols('estructura_programatica','text');
		$this->var->add_def_cols('cuenta','text');
		$this->var->add_def_cols('monto_compra_mon_orig','numeric');
		$this->var->add_def_cols('monto_actualiz','numeric');
		$this->var->add_def_cols('depreciacion_acum','numeric');
		$this->var->add_def_cols('monto_actual','numeric');
		$this->var->add_def_cols('estado','varchar');
		$this->var->add_def_cols('proyecto','varchar');
		$this->var->add_def_cols('tension','varchar');
		$this->var->add_def_cols('id_grupo_proceso','integer');	
		$this->var->add_def_cols('proceso','varchar');
		$this->var->add_def_cols('id_tipo_activo','integer');
		$this->var->add_def_cols('ep','integer');
		

		
		//Ejecuta la funcion de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	/**FIN DE LAS FUNCIONES QUE PERMITEN GENERAR LOS COMPROBANTES DE ALTA Y BAJA EN EL CONIN***/
}?>