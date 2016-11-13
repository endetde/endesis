<?php
/**
 * Nombre de la Clase:	cls_DBReparacion
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla taf_reparacion
 * Autor:				Rodrigo Chumacero Moscoso -- Mercedes Zambrana Meneses
 * Fecha creaci�n:		12-06-2007 -- 18-06-2007
 *
 */
class cls_DBReparacion
{
	//Variable que contiene la salida de la ejecuci�n de la funci�n
	//si la funci�n tuvo error (false), salida contendr� el mensaje de error
	//si la funci�n no tuvo error (true), salida contendr� el resultado, ya sea un conjunto de datos o un mensaje de confirmaci�n
/*	var $salida;

	//Variable que contedr� la cadena de llamada a las funciones postgres
	var $query;

	//Variables para la ejecuci�n de funciones
	var $var; //middle_client
	var $nombre_funcion; //nombre de la funci�n a ejecutar
	var $codigo_procedimiento; //codigo del procedimiento a ejecutar

	//Nombre del archivo
	var $nombre_archivo = "cls_DBReparacion.php";

	//Matriz de par�metros de validaci�n de todas las columnas
	var $matriz_validacion = array();

	//Bandera que indica si los datos se decodificar�n o no
	var $decodificar = false;
	
	function __construct()
	{
		$this->decodificar=$decodificar;
	}
	
	*/
var $salida;
	var $query;
	var $var;
	var $nombre_funcion;
	var $codigo_procedimiento;
	var $decodificar;

	/**
	 * Nombre de la funci�n:	ListarReparacion
	 * Prop�sito:				Desplegar los registros de taf_reparacion en funci�n de los par�metros del filtro
	 * Autor:					Rodrigo Chumacero Moscoso
	 * Fecha de creaci�n:		12-06-2007
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
	function ListarReparacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_reparacion_consultas';
		$this->codigo_procedimiento = "'AF_REP_SEL'";

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
		$this->var->add_def_cols('id_reparacion','integer');
		$this->var->add_def_cols('fecha_desde','date');
		$this->var->add_def_cols('fecha_hasta','date');
		$this->var->add_def_cols('problema','text');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('observaciones','text');
		$this->var->add_def_cols('estado','varchar');
		$this->var->add_def_cols('id_activo_fijo','integer');
		$this->var->add_def_cols('id_persona','integer');
		$this->var->add_def_cols('id_institucion','integer');
		$this->var->add_def_cols('des_activo_fijo','varchar');
		$this->var->add_def_cols('des_persona','text');
		$this->var->add_def_cols('des_institucion','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarListaReparacion
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					Rodrigo Chumacero Moscoso
	 * Fecha de creaci�n:		12-06-2007
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
	function ContarListaReparacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_reparacion_consultas';
		$this->codigo_procedimiento = "'AF_REP_SEL_COUNT'";

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
	 * Nombre de la funci�n:	CrearReparacion
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la taf_reparacion de la base de datos,
	 * 							con los par�metros requeridos
	 * Autor:					Rodrigo Chumacero Moscoso
	 * Fecha de creaci�n:		12-06-2007
	 *
	 * @param unknown_type $id_reparacion
	 * @param unknown_type $fecha_desde
	 * @param unknown_type $fecha_hasta
	 * @param unknown_type $problema
	 * @param unknown_type $fecha_reg
	 * @param unknown_type $observaciones
	 * @param unknown_type $estado
	 * @param unknown_type $id_institucion
	 * @param unknown_type $id_persona
	 * @param unknown_type $id_activo_fijo
	 * @return unknown
	 */
	function CrearReparacion($id_reparacion, $fecha_desde, $fecha_hasta, $problema, $fecha_reg, $observaciones, $estado,  $id_activo_fijo, $id_persona,$id_institucion)
	{
		
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_reparacion';
		$this->codigo_procedimiento = "'AF_REP_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id_fina_regi_prog_proy_acti
		$this->var->add_param("NULL");//id_reparacion
		$this->var->add_param("'$fecha_desde'");//fecha_desde
		$this->var->add_param("'$fecha_hasta'");//fecha_hasta
		$this->var->add_param("'$problema'");//problema
		$this->var->add_param("'$fecha_reg'");//fecha_reg
		$this->var->add_param("'$observaciones'");//observaciones
		$this->var->add_param("'$estado'");//estado
		$this->var->add_param($id_activo_fijo);//id_activo_fijo
		$this->var->add_param($id_persona);//id_persona
		$this->var->add_param($id_institucion);//id_institucion

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		echo $this->query;
		exit;
		
		return $res;
	}

	/**
	 * Nombre de la funci�n:	EliminarReparacion
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla taf_reparacion de la base de datos
	 * con los par�metros requeridos
	 * Autor:					Rodrigo Chumacero Moscoso
	 * Fecha de creaci�n:		12-06-2007
	 *
	 * @param unknown_type $id_reparacion
	 * @return unknown
	 */
	function  EliminarReparacion($id_reparacion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_reparacion';
		$this->codigo_procedimiento = "'AF_REP_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id_fina_regi_prog_proy_acti
		$this->var->add_param($id_reparacion);//id_reparacion
		$this->var->add_param("NULL");//fecha_desde
		$this->var->add_param("NULL");//fecha_hasta
		$this->var->add_param("NULL");//problema
		$this->var->add_param("NULL");//fecha_reg
		$this->var->add_param("NULL");//observaciones
		$this->var->add_param("NULL");//estado
		$this->var->add_param("NULL");//id_institucion
		$this->var->add_param("NULL");//id_persona
		$this->var->add_param("NULL");//id_activo_fijo

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	  * Nombre de la funci�n:	ModificarReparacion
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla taf_reparacion de la base de datos
	 * con los par�metros requeridos
	 * Autor:					Rodrigo Chumacero Moscoso
	 * Fecha de creaci�n:		12-06-2007
	 *
	 * @param unknown_type $id_reparacion
	 * @param unknown_type $fecha_desde
	 * @param unknown_type $fecha_hasta
	 * @param unknown_type $problema
	 * @param unknown_type $fecha_reg
	 * @param unknown_type $observaciones
	 * @param unknown_type $estado
	 * @param unknown_type $id_institucion
	 * @param unknown_type $id_persona
	 * @param unknown_type $id_activo_fijo
	 * @return unknown
	 */
	function  ModificarReparacion($id_reparacion, $fecha_desde, $fecha_hasta, $problema, $fecha_reg, $observaciones, $estado,  $id_activo_fijo, $id_persona,$id_institucion)
	{

		$this->salida = "";
		$this->nombre_funcion = 'f_taf_reparacion';
		$this->codigo_procedimiento = "'AF_REP_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id_fina_regi_prog_proy_acti
		$this->var->add_param($id_reparacion);//id_reparacion
		$this->var->add_param("'$fecha_desde'");//fecha_desde
		$this->var->add_param("'$fecha_hasta'");//fecha_hasta
		$this->var->add_param("'$problema'");//problema
		$this->var->add_param("'$fecha_reg'");//fecha_reg
		$this->var->add_param("'$observaciones'");//observaciones
		$this->var->add_param("'$estado'");//estado
		$this->var->add_param($id_activo_fijo);//id_activo_fijo
		$this->var->add_param($id_persona);//id_persona
		$this->var->add_param($id_institucion);//id_institucion

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	
	/**
	 * Nombre de la funci�n:	ValidarSubTipoActivoCuenta
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla taid_sub_tipo_activo_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-07 15:34:51
	 */
	function ValidarReparacion($operacion_sql, $id_reparacion, $fecha_desde, $fecha_hasta, $problema, $fecha_reg, $observaciones, $estado,$id_activo_fijo, $id_persona,  $id_institucion)
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
				//Validar iid_sub_tipo_activo_cuenta - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_reparacion");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_reparacion", $id_reparacion))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}
			
			$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_activo_fijo");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_activo_fijo", $id_activo_fijo))
				{
					$this->salida = $valid->salida;
					return false;
				}
			
			//Validar estado_reg - tipo varchar
			/*$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("problema");
			$tipo_dato->set_MaxLength(800);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "problema", $problema))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
				//Validar fecha_desde - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_desde");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_desde", $fecha_desde))
			{
				$this->salida = $valid->salida;
				return false;
			}
		
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_hasta");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_hasta", $fecha_hasta))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_reg");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_reg", $fecha_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar estado_reg - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("observaciones");
			$tipo_dato->set_MaxLength(30);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "observaciones", $observaciones))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validar estado_reg - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado");
			$tipo_dato->set_MaxLength(30);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado", $estado))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_Columna("id_persona");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_persona", $id_persona))
				{
					$this->salida = $valid->salida;
					return false;
				}
			

			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_Columna("id_institucion");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_institucion", $id_institucion))
				{
					$this->salida = $valid->salida;
					return false;
				}*/
			
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar iid_sub_tipo_activo_cuenta - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_reparacion");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_reparacion", $id_reparacion))
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