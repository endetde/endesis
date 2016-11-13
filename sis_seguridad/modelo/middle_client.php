<?php
/**
**********************************************************
Nombre de archivo:	    middle_client.php
Prop�sito:				Enlace con la base de datos, que pemite ejecutar funciones de la BD, tanto de cosultas (querys) o de inserciones,
modificaciones y eliminaciones
(realiza la conexi�n a la base de datos)
Par�metros:				$nombre_funcion
$codigo_procedimiento
$id_usuario
$ip_origen
$mac_maquina
$cant
$puntero
$sortcol
$sortdir
$criterio_filtro
Array de par�metros espec�ficos de la funci�n (mediante la funci�n add_param)
Array de definici�n de columnas (caso de querys, mediante la funci�n add_def_cols)
$sortcol
$sortdir
$criterio_filtro
$id_usuario_asignacion

Valores de Retorno:    	Verdadero + Resultado -> si la funci�n se ejecut� correctamente
Falso + Mensaje error -> si la funci�n no pudo ejecutarse
Fecha de Creaci�n:		22 - 05 - 07
Versi�n:				1.0.0
Autor:					Rodrigo Chumacero Moscoso
**********************************************************
*/
class middle_client
{
	/*	//Variables para manejo de errores
	var $pg_error;
	var $mensaje_error;*/

	//Array de salida $salida[0] -> TRUE - FALSE  (indica si la funci�n se ejecut� correctamente o no
	//				  $salida[1] -> contendr� el resultado de la funci�n, ya sea mensaje de error, conjunto de datos ,etc.
	var $salida = array();

	//Par�metros Fijos
	var $id_usuario;
	var $ip_origen;
	var $mac_maquina;
	var $nombre_funcion;
	var $codigo_procedimiento;
	var $proc_almacenado;
	var $parametros = array(); //array de par�metros espec�ficos por tabla
	var $def_cols = array();//array de las definiciones de columnas en caso de que sea QUERY
	var $cols_def;

	//Par�metros para el filtro
	var $cant;
	var $puntero;
	var $sortcol;
	var $sortdir;
	var $criterio_filtro;

	/**
	 * Funci�n de inicializaci�n
	 *
	 * @param unknown_type $nombre_funcion
	 * @param unknown_type $codigo_procedimiento
	 */
	function init($nombre_funcion,$codigo_procedimiento)
	{
		//Inicializa los par�metros fijos
		$this->id_usuario = "";
		$this->ip_origen = "";
		$this->mac_maquina = "";
		$this->nombre_funcion = "";
		$this->codigo_procedimiento = "";
		$this->proc_almacenado = "";

		$this->parametros = array();
		$this->def_cols = array();

		//Inicializa los par�metros del filtro
		$this->cant = "15";
		$this->puntero = "";
		$this->sortcol = "";
		$this->sortdir = "asc";
		$this->criterio_filtro = "";

		//Obtiene los par�metros fijos de la sesi�n del usuario
		$this->id_usuario = 10;
		$this->ip_origen = '\'200.87.181.201\'';
		$this->mac_maquina = '\'00:19:d1:09:22:7e\'';

		//Asigna los valores enviados
		$this->nombre_funcion = $nombre_funcion;
		$this->codigo_procedimiento = $codigo_procedimiento;
		$this->proc_almacenado='NULL';
	}

	/**
	 * Ejecuta las funciones que no sean querys
	 *
	 * @return unknown
	 */
	function exec_non_query()
	{
		$salida_temp = array();//array que contendr� el resultado del query
		$Funciones = new funciones();
		$link = $Funciones->conectar_pg();

		//Forma la llamada a la funci�n
		$query = "SELECT $this->nombre_funcion ($this->id_usuario,$this->ip_origen,$this->mac_maquina,$this->codigo_procedimiento,$this->proc_almacenado";

		//Concantena los par�metros espec�ficos; sino existieran a�ade un par�ntesis
		if(sizeof($this->parametros)>0)
		{
			$query .= ','.implode(",",$this->parametros).')';
		}
		else
		{
			$query .=')';
		}

		//Ejecuta la funci�n
		if($result = pg_query($link,$query))
		{
			//Carga el resultado en el array temporal de salida
			while ($row = pg_fetch_array($result))
			{
				array_push ($salida_temp, $row);
			}

			//Libera la memoria
			pg_free_result($result);

			//Cierra la conexi�n con postegres
			$res = $Funciones->desconectar_pg($link);

			//Verifica si se produjo alg�n error l�gico en la funci�n
			$resp_funcion = $salida_temp[0][0];

			if($resp_funcion==t)
			{
				//No existe error l�gico
				$this->salida[0] = true;
				$this->salida[1] = $resp_funcion;
				return true;
			}
			else
			{
				//Existe error l�gico
				$this->salida[0] = false;
				$this->salida[1] = $resp_funcion;
				return false;
			}
		}
		else
		{
			//Se produjo un error a nivel de base de datos
			$this->salida[0]=false;
			$this->salida[1]=pg_last_error($link);
			return false;
		}
	}


	/**
	 * Ejecuta las funciones del tipo QUERY
	 *
	 * @return unknown
	 */
	function exec_query()
	{
		$salida_temp = array();//array que contendr� el resultado del query
		$Funciones = new funciones();
		$link = $Funciones ->conectar_pg();

		//Forma la llamda a la funci�n
		$query = "SELECT * FROM $this->nombre_funcion ($this->id_usuario,$this->ip_origen,$this->mac_maquina,$this->codigo_procedimiento,$this->proc_almacenado";

		//Concantena los par�metros del filtro
		$query .= ", $this->cant,$this->puntero,$this->sortcol,$this->sortdir,$this->criterio_filtro";

		//Concatena los par�metros espec�ficos si existieran, caso contrario cierra par�ntesis
		if(sizeof($this->parametros)>0)
		{
			$query .= ','.implode(",",$this->parametros) . ")";
		}
		else
		{
			$query.= ')';
		}

		//Concatena la lista de columnas con sus respectivos tipos de datos
		if(sizeof($this->def_cols)>0)
		{
			$query .= " AS (". implode(",",$this->def_cols).')';
		}


		/**
		 * Ejecuta la funci�n 
		 */
		if($result = pg_query($link,$query))
		{
			//Carga el resultado en el array temporal de salida
			while ($row = pg_fetch_array($result))
			{
				array_push ($salida_temp, $row);
			}

			//Libera la memoria
			pg_free_result($result);

			//Cierra la conexi�n con postegres
			$res = $Funciones->desconectar_pg($link);

			//Define el array de salida
			$this->salida[0] = true;
			$this->salida[1] = $salida_temp;

			return true;

			/*$this->pg_error = false;
			return $salida; //Devuelve el array resultado de la consulta*/
		}
		else
		{
			//Se produjo un error a nivel de base de datos
			$this->salida[0]=false;
			$this->salida[1]=pg_last_error($link);
			return false;
			/*
			$this->pg_error = true;
			$this->mensaje_error = pg_last_error($link);
			return $this->mensaje_error;*/
		}
	}

	/**
	 * Funci�n que adiciona par�metros espec�ficos para las funciones (aparte de los fijos y del filtro)
	 *
	 * @param unknown_type $param
	 */
	function add_param($param)
	{
		array_push ($this->parametros, $param);
	}

	/**
	 * Funci�n que adiciona definici�n de columnas para querys
	 *
	 * @param unknown_type $nombre_col
	 * @param unknown_type $tipo_dato
	 */
	function add_def_cols($nombre_col,$tipo_dato)
	{
		$aux = $nombre_col . " ".$tipo_dato;
		array_push($this->def_cols, $aux);
	}

}//FIN CLASE
?>
