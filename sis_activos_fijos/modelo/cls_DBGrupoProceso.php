<?php
/**
 * Nombre de la Clase:	cls_DBProceso
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla taf_proceso
 * Autor:				Rodrigo Chumacero M.
 * Fecha creaci�n:		12-06-2007
 *
 */
class cls_DBGrupoProceso
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
	var $nombre_archivo = "cls_DBGrupoProceso.php";

	//Matriz de par�metros de validaci�n de todas las columnas
	var $matriz_validacion = array();

	//Bandera que indica si los datos se decodificar�n o no
	var $decodificar = false;

	function __construct()
	{
		//Carga los par�metro de validaci�n de todas las columnas
		$this->cargar_param_valid();

		//Carga en una variable interna la bandera del GET o POST
		$this->decodificar = $decodificar;
	}

	/**
	 * Nombre de la funci�n:	ListarProceso
	 * Prop�sito:				Desplegar los registros de taf_subtipo_activo en funci�n de los par�metros del filtro
	 * Autor:					Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		07-07-2010
	 *
	 * @param unknown_type $cant
	 * @param unknown_type $puntero
	 * @param unknown_type $sortcol
	 * @param unknown_type $sortdir
	 * @param unknown_type $criterio_filtro
	 * @param unknown_type $id_financiador
	 * @param unknown_type $id_regional
	 * @param unknown_type $id_programa
	 * @param unknown_type $id_proyecto
	 * @param unknown_type $id_actividad
	 * @return unknown
	 */
function ListarGrupoProceso($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_grupo_proceso_sel';
		$this->codigo_procedimiento = "'AF_GRPROC_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

		//Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '','NULL',$id_financiador));//id_financiador
		$this->var->add_param($func->iif($id_regional == '','NULL',$id_regional));//id_regional
		$this->var->add_param($func->iif($id_programa == '','NULL',$id_programa));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '','NULL',$id_proyecto));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '','NULL',$id_actividad));//id_actividad

		//Carga la definici�n de columnas con sus tipos de datos
		
		$this->var->add_def_cols('id_grupo_proceso','integer');
	    $this->var->add_def_cols('estado','varchar');
	    $this->var->add_def_cols('descripcion','text');
	    $this->var->add_def_cols('agrupador','varchar');
	    $this->var->add_def_cols('fecha_reg','date');
	    $this->var->add_def_cols('sw_prestamo','varchar');
	    $this->var->add_def_cols('fecha_contabilizacion','date');
	    $this->var->add_def_cols('id_depto_org','integer');
	    $this->var->add_def_cols('desc_depto_ori','varchar');
	    $this->var->add_def_cols('id_proceso','integer');
	    $this->var->add_def_cols('desc_proceso','varchar');
	    $this->var->add_def_cols('id_depto_des','integer');
	    $this->var->add_def_cols('desc_depto_des','varchar');
	    $this->var->add_def_cols('id_empleado_org','integer');
	    $this->var->add_def_cols('desc_empleado_ori','text');
	    $this->var->add_def_cols('id_empleado_des','integer');
	    $this->var->add_def_cols('desc_empleado_des','text');
	    $this->var->add_def_cols('id_presupuesto_org','integer');
	    $this->var->add_def_cols('desc_presupuesto_ori','text');
	    $this->var->add_def_cols('id_presupuesto_des','integer');
	    $this->var->add_def_cols('desc_presupuesto_des','text');
	    $this->var->add_def_cols('id_activo_fijo','integer');
	    $this->var->add_def_cols('desc_activo_fijo','varchar');
	    $this->var->add_def_cols('codigo_proceso','varchar');
	    $this->var->add_def_cols('fecha_devolucion','date');
	    $this->var->add_def_cols('sw_bien_responsabilidad','varchar');
	    $this->var->add_def_cols('id_persona','integer');
	    $this->var->add_def_cols('custodio','text');
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
	 * Nombre de la funci�n:	ContarGrupoProceso
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					Mercedes Zambrana M.
	 * Fecha de creaci�n:		07-07-2010
	 *
	 * @param unknown_type $cant
	 * @param unknown_type $puntero
	 * @param unknown_type $sortcol
	 * @param unknown_type $sortdir
	 * @param unknown_type $criterio_filtro
	 * @param unknown_type $id_financiador
	 * @param unknown_type $id_regional
	 * @param unknown_type $id_programa
	 * @param unknown_type $id_proyecto
	 * @param unknown_type $id_actividad
	 * @return unknown
	 */
	function ContarGrupoProceso($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_grupo_proceso_sel';
		$this->codigo_procedimiento = "'AF_GRPROC_COUNT'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

		//Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '','NULL',$id_financiador));//id_financiador
		$this->var->add_param($func->iif($id_regional == '','NULL',$id_regional));//id_regional
		$this->var->add_param($func->iif($id_programa == '','NULL',$id_programa));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '','NULL',$id_proyecto));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '','NULL',$id_actividad));//id_actividad

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
	 * Nombre de la funci�n:	CrearGrupoProceso
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la taf_proceso de la base de datos,
	 * 							con los par�metros requeridos
	 * Autor:					Mercedes Zambrana M.
	 * Fecha de creaci�n:		07-07-2010
	 *
	 * @param unknown_type $id_proceso
	 * @param unknown_type $descripcion
	 * @param unknown_type $flag_comprobante
	 * @param unknown_type $tipo_comprobante
	 * @return unknown
	 */
function InsertarGrupoProceso($id_depto_org,$id_proceso,$descripcion,$id_gestion,
													$fecha_contabilizacion,$id_activo_fijo,$id_empleado_org,
													$id_empleado_des,$id_presupuesto_org,$id_presupuesto_des,$codigo_proceso,$sw_prestamo,$fecha_devolucion,$id_persona)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_grupo_proceso_iud';
		if($codigo_proceso=='ALTA')
			$this->codigo_procedimiento = "'AF_ALTA_INS'";
		else if($codigo_proceso=='REVA')
			$this->codigo_procedimiento = "'AF_REVA_INS'";
		else if($codigo_proceso=='TRAN')
			$this->codigo_procedimiento = "'AF_TRAN_INS'";
		else if($codigo_proceso=='REAEMP')
			$this->codigo_procedimiento = "'AF_REAEMP_INS'";
		else if($codigo_proceso=='REACT')
			$this->codigo_procedimiento = "'AF_REACT_INS'";
		else if($codigo_proceso=='MEJACT')
			$this->codigo_procedimiento = "'AF_MEJACT_INS'";
		else if($codigo_proceso=='ASIG')
			$this->codigo_procedimiento = "'AF_ASIG_INS'";
		else if(substr($codigo_proceso,0,4)=='BAJA')
			$this->codigo_procedimiento = "'AF_BAJA_INS'";
		else if($codigo_proceso=='DEVOL')
			$this->codigo_procedimiento = "'AF_DEVOL_INS'";
		else if($codigo_proceso=='CUST')
			$this->codigo_procedimiento = "'AF_CUST_INS'";
		else if($codigo_proceso=='DEVCUS')
			$this->codigo_procedimiento = "'AF_DEVCUS_INS'";
		//a�adido 28/04/2014
		
		else if ($codigo_proceso=='BAJPROY')
		{
			$this->codigo_procedimiento="'AF_BAJAPROY_INS'";
		}
		else if($codigo_proceso=='DEPAF')
			$this->codigo_procedimiento="'AF_DEPAF_INS'";
		
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		
		  $this->var->add_param("NULL");//id_grupo_proceso
		  $this->var->add_param($id_depto_org);//id_sub_proceso
		  $this->var->add_param($id_proceso);//descripcion
		  $this->var->add_param("'$descripcion'");
		  $this->var->add_param($id_gestion);
		  $this->var->add_param("'$fecha_contabilizacion'");
		  $this->var->add_param($id_activo_fijo);//flag_comprobante
		  $this->var->add_param($id_empleado_org);//tipo_comprobante
		  $this->var->add_param($id_empleado_des);
		  $this->var->add_param($id_presupuesto_org);
		  $this->var->add_param($id_presupuesto_des);
		  $this->var->add_param("'$codigo_proceso'");
		  $this->var->add_param("'$sw_prestamo'");
		  $this->var->add_param("'$fecha_devolucion'");
		  $this->var->add_param($id_persona);
		 
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		//echo $this->query; exit;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	EliminarGrupoProceso
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla taf_subtipo_activo de la base de datos
	 * con los par�metros requeridos
	 * Autor:					Mercedes Zambrana M.
	 * Fecha de creaci�n:		07-07-2010
	 *
	 * @return unknown
	 */
	function  EliminarGrupoProceso($id_grupo_proceso)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_grupo_proceso_iud';
		$this->codigo_procedimiento = "'AF_GRPROC_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param($id_grupo_proceso);//id_fina_regi_prog_proy_acti
		$this->var->add_param("NULL");//id_procesosub_tipo_activo
		$this->var->add_param("NULL");//descripcion
		$this->var->add_param("NULL");//flag_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//id_persona
		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	ModificarGRupoProceso
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla taf_proceso de la base de datos
	 * con los par�metros requeridos
	 * Autor:					Mercedes Zambrana M.
	 * Fecha de creaci�n:		07-07-2010
	 *
	 * @return unknown
	 */
function  ModificarGrupoProceso($id_grupo_proceso,$id_depto_org,$id_proceso,$descripcion,$id_gestion,
													$fecha_contabilizacion,$id_activo_fijo,$id_empleado_org,
													$id_empleado_des,$id_presupuesto_org,$id_presupuesto_des,$codigo_proceso,$sw_prestamo,$fecha_devolucion,$id_persona)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_grupo_proceso_iud';
		if($codigo_proceso=='ALTA')
			$this->codigo_procedimiento = "'AF_ALTA_UPD'";
		else if($codigo_proceso=='REVA')
			$this->codigo_procedimiento = "'AF_REVA_UPD'";
		else if($codigo_proceso=='TRAN')
			$this->codigo_procedimiento = "'AF_TRAN_UPD'";
		else if($codigo_proceso=='REAEMP')
			$this->codigo_procedimiento = "'AF_REAEMP_UPD'";
		else if($codigo_proceso=='REACT')
			$this->codigo_procedimiento = "'AF_REACT_UPD'";
		else if($codigo_proceso=='MEJACT')
			$this->codigo_procedimiento = "'AF_MEJACT_UPD'";
		else if($codigo_proceso=='ASIG')
			$this->codigo_procedimiento = "'AF_ASIG_UPD'";
		else if(substr($codigo_proceso,0,4)=='BAJA')
			$this->codigo_procedimiento = "'AF_BAJA_UPD'";
		else if($codigo_proceso=='DEVOL')
			$this->codigo_procedimiento = "'AF_DEVOL_UPD'";
		else if($codigo_proceso=='CUST')
			$this->codigo_procedimiento = "'AF_CUST_UPD'";
		//a�adido 28/04/2014
		else if ($codigo_proceso=='BAJPROY')
		{
			$this->codigo_procedimiento="'AF_BAJAPROY_UPD'";
		}
		else if ($codigo_proceso=='DEPAF')
			$this->codigo_procedimiento="'AF_DEPAF_UPD'";
		
					

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		
		  $this->var->add_param($id_grupo_proceso);//id_proceso
		  $this->var->add_param($id_depto_org);//id_sub_proceso
		  $this->var->add_param($id_proceso);//descripcion
		  $this->var->add_param("'$descripcion'");
		  $this->var->add_param($id_gestion);
		  $this->var->add_param("'$fecha_contabilizacion'");
		  $this->var->add_param($id_activo_fijo);//flag_comprobante
		  $this->var->add_param($id_empleado_org);//tipo_comprobante
		  $this->var->add_param($id_empleado_des);
		  $this->var->add_param($id_presupuesto_org);
		  $this->var->add_param($id_presupuesto_des);
		  $this->var->add_param("'$codigo_proceso'");
		  $this->var->add_param("'$sw_prestamo'");
		  $this->var->add_param("'$fecha_devolucion'");
		  $this->var->add_param($id_persona);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	
function  AccionesGrupoProceso($id_grupo_proceso,$accion,$id_persona)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_grupo_proceso_iud';
		
		if($accion=='GRUFIN')
			$this->codigo_procedimiento = "'AF_GRUFIN_UPD'";
		else if($accion=='REVPRES')
			$this->codigo_procedimiento = "'AF_REVPRES_UPD'";
		else if($accion=='REVFIN')
			$this->codigo_procedimiento = "'AF_REVFIN_UPD'";
		else if($accion=='REVAPRO')
			$this->codigo_procedimiento = "'AF_REVAPRO_UPD'";
		else if($accion=='GRUAPRO')
			$this->codigo_procedimiento = "'AF_GRUAPRO_UPD'";
		else if($accion=='FINPRES')
			$this->codigo_procedimiento = "'AF_FINPRES_UPD'";
		else
		{	echo "No se ha elegido ninguna accion";
			exit();
		}
		
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param($id_grupo_proceso);//id_fina_regi_prog_proy_acti
		$this->var->add_param("NULL");//id_procesosub_tipo_activo
		$this->var->add_param("NULL");//descripcion
		$this->var->add_param("NULL");//flag_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param("NULL");//tipo_comprobante
		$this->var->add_param($id_persona);//tipo_comprobante

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		//echo $this->query; exit;
		
		return $res;
	}
	
	

	/**
	 * Nombre de la funci�n:	ValidarProceso
	 * Prop�sito:				Realiza una validaci�n de datos del lado del servidor (sin consultar a BD)
	 * Autor:					Mercedes Zambrana M.
	 * Fecha de creaci�n:		07-07-2010
	 *
	 * @param unknown_type $operacion_sql
	 * @param unknown_type $id_proceso
	 * @param unknown_type $descripcion
	 * @param unknown_type $flag_comprobante
	 * @param unknown_type $tipo_comprobante
	 * @return unknown
	 */
	function ValidarProceso($operacion_sql, $id_proceso, $descripcion, $flag_comprobante, $tipo_comprobante)
	{
		//operacion_sql se refiere a que operaci�n validar (por ejemplo: insert, update, delete; podr�an ser otros espec�ficos)

		$this->salida = "";
		$valid = new cls_validacion_serv();

		if(!$valid->verifica_dato($this->matriz_validacion[1], "fecha_prueba", '13-13-1980 23:59:59'))
		{
			$this->salida = $valid->salida;
			echo $this->salida[1];
			exit;
		}
echo "pas� validaci�n";
		exit;
		$valid->es_fecha_hora('01-01-1980 23:59:00',$resp);
		echo $resp;
		exit;


		//Ejecuta la validaci�n por el tipo de operaci�n
		switch ($operacion_sql) {
			case 'insert':

				/*******************************Verificaci�n de datos****************************/
				//Verifica que las columnas obligatorias tengan datos, que tenga formato v�lido y un tama�o v�lido
				//Se valida todas las columnas de la tabla
				if(!$valid->verifica_dato($this->matriz_validacion[1], "descripcion", $descripcion))
				{
					$this->salida = $valid->salida;
					return false;
				}
				if(!$valid->verifica_dato($this->matriz_validacion[2], "flag_comprobante", $flag_comprobante))
				{
					$this->salida = $valid->salida;
					return false;
				}
				if(!$valid->verifica_dato($this->matriz_validacion[3], "tipo_comprobante", $tipo_comprobante))
				{
					$this->salida = $valid->salida;
					return false;
				}

				//Validaci�n de reglas de datos

				$def_flag_comprobante = array ("si", "no");
				if(!in_array($flag_comprobante,$def_flag_comprobante))
				{
					$this->salida[0] = "f";
					$this->salida[1] = "Error de validaci�n en columna 'flag_comprobante': El valor no est� dentro del dominio definido";
					$this->salida[2] = "ORIGEN = $this->nombre_archivo";
					$this->salida[3] = "PROC = ValidaUnidadConstructiva";
					$this->salida[4] = "NIVEL = 3";
					return false;
				}

				//Validaci�n exitosa
				return true;
				break;

			case 'update':
				/*******************************Verificaci�n de datos****************************/
				//Verifica que las columnas obligatorias tengan datos, que tenga formato v�lido y un tama�o v�lido
				//Se valida todas las columnas de la tabla

				if(!$valid->verifica_dato($this->matriz_validacion[0], "id_proceso", $id_proceso))
				{
					$this->salida = $valid->salida;
					return false;
				}
				if(!$valid->verifica_dato($this->matriz_validacion[1], "descripcion", $descripcion))
				{
					$this->salida = $valid->salida;
					return false;
				}
				if(!$valid->verifica_dato($this->matriz_validacion[2], "flag_comprobante", $flag_comprobante))
				{
					$this->salida = $valid->salida;
					return false;
				}
				if(!$valid->verifica_dato($this->matriz_validacion[3], "tipo_comprobante", $tipo_comprobante))
				{
					$this->salida = $valid->salida;
					return false;
				}

				//Validaci�n de reglas de datos
				$def_estados = array ("si", "no");
				if(!in_array($flag_comprobante,$def_estados))
				{
					$this->salida[0] = "f";
					$this->salida[1] = "Error de validaci�n en columna 'estado': El valor no est� dentro del dominio definido";
					$this->salida[2] = "ORIGEN = $this->nombre_archivo";
					$this->salida[3] = "PROC = ValidaUnidadConstructiva";
					$this->salida[4] = "NIVEL = 3";
					return false;
				}

				//Validaci�n exitosa
				return true;
				break;
			case 'delete':
				break;
			default:
				return false;
				break;
		}

	}

	function cargar_param_valid()
	{
		$this->matriz_validacion[0] = array();
		$this->matriz_validacion[0]['Columna'] = "id_proceso";
		$this->matriz_validacion[0]['allowBlank'] = "false";
		$this->matriz_validacion[0]['maxLength'] = 15;
		$this->matriz_validacion[0]['minLength'] = 0;
		$this->matriz_validacion[0]['SelectOnFocus'] = "true";
		$this->matriz_validacion[0]['vtype'] = "alphanum";
		$this->matriz_validacion[0]['dataType'] = "entero";
		$this->matriz_validacion[0]['width'] = "";
		$this->matriz_validacion[0]['grow'] = "";

		$this->matriz_validacion[1] = array();
		$this->matriz_validacion[1]['Columna'] = "descripcion";
		$this->matriz_validacion[1]['allowBlank'] = "true";
		$this->matriz_validacion[1]['maxLength'] = 30;
		$this->matriz_validacion[1]['minLength'] = 0;
		$this->matriz_validacion[1]['SelectOnFocus'] = "false";
		$this->matriz_validacion[1]['vtype'] = "alphaLatino";
		//$this->matriz_validacion[1]['dataType'] = "texto";
		$this->matriz_validacion[1]['dataType'] = "fecha_hora";
		$this->matriz_validacion[1]['width'] = "";
		$this->matriz_validacion[1]['grow'] = "";

		$this->matriz_validacion[2] = array();
		$this->matriz_validacion[2]['Columna'] = "flag_comprobante";
		$this->matriz_validacion[2]['allowBlank'] = "false";
		$this->matriz_validacion[2]['maxLength'] = 2;
		$this->matriz_validacion[2]['minLength'] = 0;
		$this->matriz_validacion[2]['SelectOnFocus'] = "false";
		$this->matriz_validacion[2]['vtype'] = "alphaLatino";
		$this->matriz_validacion[2]['dataType'] = "texto";
		$this->matriz_validacion[2]['width'] = "";
		$this->matriz_validacion[2]['grow'] = "";

		$this->matriz_validacion[3] = array();
		$this->matriz_validacion[3]['Columna'] = "tipo_comprobante";
		$this->matriz_validacion[3]['allowBlank'] = "true";
		$this->matriz_validacion[3]['maxLength'] = 10;
		$this->matriz_validacion[3]['minLength'] = 0;
		$this->matriz_validacion[3]['SelectOnFocus'] = "false";
		$this->matriz_validacion[3]['vtype'] = "alphaLatino";
		$this->matriz_validacion[3]['dataType'] = "texto";
		$this->matriz_validacion[3]['width'] = "";
		$this->matriz_validacion[3]['grow'] = "";


	}

}?>