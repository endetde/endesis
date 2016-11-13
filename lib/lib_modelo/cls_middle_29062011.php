<?php
/**
 * Nombre clase:	cls_middle
 * Prop�sito:		Clase que sirve de puente entre la conexi�n y la interfaz, para las llamadas a las funciones de la Base de Datos Postgres
 * Autor:			Rodrigo Chumacero Moscoso
 * Fecha creaci�n:	22-05-2007
 *
 */
class cls_middle
{
	//variable que contiene la salida de la ejecuci�n de la funci�n
	//si la funci�n tuvo error (false), salida contendr� el mensaje de error
	//si la funci�n no tuvo error (true), salida contendr� el resultado, ya sea un conjunto de datos o un mensaje de confirmaci�n
	var $salida;
	var $filtro_funcion='';//Filtro que se aumenta al final de la llamada de la funci�n


	//Variable que contedr� la cadena de llamada a las funciones postgres
	var $query;

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

	//Variable que contendr� la conexi�n a la base de datos
	var $cnx;
	var $func; //Variable que contendr� las funciones generales del sistema

	//Variable que contiene el separador de cadenas usado en la BD
	var $sep = '#@@@#';

	//Variable que contiene el nombre del archivo
	var $nombre_archivo = "cls_middle.php";

	//Bandera que indica si los datos se decodificar�n o no
	var $decodificar = false;
	var $criterio_funcion;

	/**
	 * Nombre funci�n:	__construct
	 * Prop�sito:		Constructor de la clase cls_middle. Carga el nombre de la funci�n y el c�digo del procedimiento.
	 * 					Obtiene los par�metros fijos del usuario de la sesi�n (id_usuario, ip, macaddress)
	 * Autor:			Rodrigo Chumacero Moscoso
	 * Fecha creaci�n:	22-05-2007
	 *
	 * @param unknown_type $nombre_funcion
	 * @param unknown_type $codigo_procedimiento
	 */
	function __construct($nombre_funcion, $codigo_procedimiento, $decodificar = false)
	{
		//Inicializa los par�metros fijos
		$this->id_usuario = "";
		$this->ip_origen = "";
		$this->mac_maquina = "";
		$this->nombre_funcion = "";
		$this->codigo_procedimiento = "";
		$this->proc_almacenado = "";

		//Inicializa los arrays de par�metros y de definici�n de columnas
		$this->parametros = array();
		$this->def_cols = array();

		//Inicializa los par�metros del filtro
		$this->cant = "15";
		$this->puntero = "";
		$this->sortcol = "";
		$this->sortdir = "asc";
		$this->criterio_filtro = "";

		//Obtiene los par�metros fijos de la sesi�n del usuario
		//$this->id_usuario = 10;
		$this->id_usuario = $_SESSION["ss_id_usuario"];
		//$this->ip_origen = "'200.87.181.201'";
		$this->ip_origen = $_SESSION["ss_ip"];
		$this->ip_origen = "'$this->ip_origen'";
		$this->mac_maquina = "'00:19:d1:09:22:7e'";

		//A�ade el esquema a la funcion
		$this->nombre_funcion = $this->add_esquema($nombre_funcion);
		//$this->nombre_funcion = $nombre_funcion;


		$this->codigo_procedimiento = $codigo_procedimiento;
		$this->proc_almacenado = 'NULL';

		//Instancia la clase funciones que contiene las funciones generales para todo el sistema
		$this->func = new cls_funciones();

	}


	/**
	 * Nombre funci�n:	exec_non_query
	 * Prop�sito:		Ejecuta las funciones de la base de datos que no sean querys (insert, update, delete),
	 * 					a partir del nombre de la funci�n y de los par�metos necesarios de la funci�n
	 * Autor:			Rodrigo Chumacero Moscoso
	 * Fecha creaci�n:	22-05-2007
	 *
	 * @return unknown
	 */
	function exec_non_query()
	{
		//Array que contendr� el resultado del query
		$salida_temp = array();

		//Forma la llamada a la funci�n

		$this->query = "SELECT $this->nombre_funcion ($this->id_usuario,$this->ip_origen,$this->mac_maquina,$this->codigo_procedimiento,$this->proc_almacenado";

		//Concantena los par�metros espec�ficos; sino existieran a�ade un par�ntesis
		if(sizeof($this->parametros)>0)
		{
			$this->query .= ','.implode(",", $this->parametros).')';
		}
		else
		{
			$this->query .=')';
		}

		//Se abre la conexi�n a la base de datos
		$this->cnx = new cls_conexion();
		$this->cnx->conectar_pg();

		// RAC:Incluimos la cadena de la noxeci�n en vez de la MAC
		//$consulta= "'".addcslashes($this->query)."'";

		$consulta=str_replace("'","''",$this->query);
		$this->query=str_replace("'00:19:d1:09:22:7e'","'$consulta'",$this->query);

		if(! $this -> verificarSesion())
		{
			//existen un problema co las vasrialbes de sesi�n
			$this->salida[0] = "f";
			$this->salida[1] = "MENSAJE ERROR = La sesi�n del usario ha sido eliminada";
			$this->salida[2] = "ORIGEN = $this->nombre_archivo";
			$this->salida[3] = "PROC = verificarSesion";
			$this->salida[4] = "NIVEL = 2";

			$this->cnx->desconectar_pg();

			return false;

		}

		else
		{

			//Ejecuta la funci�n
			if($result = pg_query($this->cnx->conexion_bd,$this->query))
			{
				//Carga el resultado en el array temporal de salida
				while ($row = pg_fetch_array($result))
				{
					array_push ($salida_temp, $row);
				}

				//Libera la memoria
				pg_free_result($result);

				//Cierra la conexi�n con postgres
				$this->cnx->desconectar_pg();

				//Verifica si se produjo alg�n error l�gico en la funci�n



				$resp_funcion = explode($this->sep, $salida_temp[0][0]);


				if(sizeof($resp_funcion)>0)
				{
					if($resp_funcion[0]==t)
					{
						//No existe error l�gico
						$this->salida = $resp_funcion;
						return true;
					}
					elseif ($resp_funcion[0]==f)
					{
						//Existe error l�gico
						$this->salida = $resp_funcion;
						return false;
					}
					else
					{
						//Si $resp_funcion no tiene ning�n elemento, quiere decir que no hubo respuesta de la base de datos
						$this->salida[0] = "f";
						$this->salida[1] = "MENSAJE ERROR = No se obtuvo respuesta de la base de datos";
						$this->salida[2] = "ORIGEN = $this->nombre_archivo";
						$this->salida[3] = "PROC = exec_non_query";
						$this->salida[4] = "NIVEL = 2";
						return false;
					}
				}
				else
				{

					//Si $resp_funcion no tiene ning�n elemento, quiere decir que no hubo respuesta de la base de datos
					$this->salida[0] = "f";
					$this->salida[1] = "MENSAJE ERROR = No se obtuvo respuesta de la base de datos";
					$this->salida[2] = "ORIGEN = $this->nombre_archivo";
					$this->salida[3] = "PROC = exec_non_query";
					$this->salida[4] = "NIVEL = 2";

					return false;

				}

			}
			else
			{
				//Se produjo un error a nivel de base de datos
				$resp_funcion = explode($this->sep, pg_last_error($this->cnx->conexion_bd));
				$this->salida[0] = "f";
				$this->salida[1] = $resp_funcion[1];
				$this->salida[2] = $resp_funcion[2];
				$this->salida[3] = $resp_funcion[3];
				$this->salida[4] = $resp_funcion[4];

				//Cierra la conexi�n con postgres
				$this->cnx->desconectar_pg();
				return false;
			}
		}

	}

	/**
	 * Nombre funci�n:	exec_query
	 * Prop�sito:		Verifica la sesion del usuario logueado para detectar fraudes o robo de sesi�n
	 * Autor:			Rensi Arteaga Copari
	 * Fecha creaci�n:	10-05-2010
	 *
	 * @return unknown
	 */
	function verificarSesion(){
		$salida_temp = array();
		$estado =true;
		
	

		if($this->nombre_funcion !='sss.f_tsg_sesion_iud'){


			$consulta = "SELECT sss.f_tsg_sesion_sel(".$_SESSION["ss_id_usuario"].",'".$_SERVER['REMOTE_ADDR']."','". session_id()."')";

			if($res_ses=pg_query($this->cnx->conexion_bd,$consulta)){


				//Carga el resultado en el array temporal de salida
				while ($row_ses = pg_fetch_array($res_ses))
				{
					array_push ($salida_temp, $row_ses);
				}

				/*echo "<pre>";
				print_r($salida_temp);
				echo "</pre>";
				exit;
				*/
				//Libera la memoria
				pg_free_result($res_ses);

				if($salida_temp[0][0]=='t'){

					return true;
				}
				else{
					return false;
				}


			}
			else {
				return false;

			}


		}

		return $estado;
	}
	
/**
	 * Nombre funci�n:	exec_query
	 * Prop�sito:		Ejecuta las funciones de la base de datos de consultas (querys), a partir del nombre
	 * 					de la funci�n y de los par�metos necesarios de la funci�n
	 * Autor:			Julio Guarachi Lopez
	 * Fecha creaci�n:	18/03/2011
	 *
	 * @return unknown
	 */
	function exec_query_SQL($var='*',$tipo='both')
	{
		//Array que contendr� el resultado del query
		$salida_temp = array();

		//Forma la llamada a la funci�n con los par�metros fijos

		$this->query = "SELECT $var FROM $this->nombre_funcion($this->id_usuario,$this->ip_origen,$this->mac_maquina,$this->codigo_procedimiento,$this->proc_almacenado";

		//Concatena los par�metros del filtro
		$this->query .= ", $this->cant,$this->puntero,$this->sortcol,$this->sortdir";
		if($this->criterio_filtro != '')
		{
			$this->query .= ",".$this->esquema_filtro($this->criterio_filtro);
		}


		//Concatena los par�metros espec�ficos si existieran, caso contrario cierra par�ntesis
		if(sizeof($this->parametros)>0)
		{
			$this->query .= ','.implode(",",$this->parametros) . ")";
		}
		else
		{
			$this->query.= ')';

		}

		//Concatena la lista de columnas con sus respectivos tipos de datos
		if(sizeof($this->def_cols)>0)
		{
			$this->query .= " AS (". implode(",",$this->def_cols).')';

			if($criterio_funcion)
			{
				$this->query .=$criterio_funcion;
			}

		}

		/*echo $this->query;
		exit();*/

		//RCM:18/11/2008 Verifica si est� definido un criterio a nivel de llamada de funci�n
		$this->add_filtro_funcion_llamada();
		//Se abre la conexi�n a la base de datos
		$this->cnx = new cls_conexion();
		$this->cnx->conectar_pg();

		if(! $this -> verificarSesion())
		{
			//existen un problema co las vasrialbes de sesi�n
			$this->salida[0] = "f";
			$this->salida[1] = "MENSAJE ERROR = La sesi�n del usario ha sido duplicada";
			$this->salida[2] = "ORIGEN = $this->nombre_archivo";
			$this->salida[3] = "PROC = verificarSesion";
			$this->salida[4] = "NIVEL = 2";

			$this->cnx->desconectar_pg();

			return false;

		}

		else
		{
			return $this->query ;
			$this->query='';
		}
	}

	/**
	 * Nombre funci�n:	exec_query
	 * Prop�sito:		Ejecuta las funciones de la base de datos de consultas (querys), a partir del nombre
	 * 					de la funci�n y de los par�metos necesarios de la funci�n
	 * Autor:			Rodrigo Chumacero Moscoso
	 * Fecha creaci�n:	22-05-2007
	 *
	 * @return unknown
	 */
	function exec_query($var='*',$tipo='both')
	{
		//Array que contendr� el resultado del query
		$salida_temp = array();

		//Forma la llamada a la funci�n con los par�metros fijos

		$this->query = "SELECT $var FROM $this->nombre_funcion($this->id_usuario,$this->ip_origen,$this->mac_maquina,$this->codigo_procedimiento,$this->proc_almacenado";

		//Concatena los par�metros del filtro
		$this->query .= ", $this->cant,$this->puntero,$this->sortcol,$this->sortdir";
		if($this->criterio_filtro != '')
		{
			$this->query .= ",".$this->esquema_filtro($this->criterio_filtro);
		}


		//Concatena los par�metros espec�ficos si existieran, caso contrario cierra par�ntesis
		if(sizeof($this->parametros)>0)
		{
			$this->query .= ','.implode(",",$this->parametros) . ")";
		}
		else
		{
			$this->query.= ')';

		}

		//Concatena la lista de columnas con sus respectivos tipos de datos
		if(sizeof($this->def_cols)>0)
		{
			$this->query .= " AS (". implode(",",$this->def_cols).')';

			if($criterio_funcion)
			{
				$this->query .=$criterio_funcion;
			}

		}

		/*echo $this->query;
		exit();*/

		//RCM:18/11/2008 Verifica si est� definido un criterio a nivel de llamada de funci�n
		$this->add_filtro_funcion_llamada();


		//Se abre la conexi�n a la base de datos
		$this->cnx = new cls_conexion();
		$this->cnx->conectar_pg();

		//RAC:pregunta por la validez de lasesion


		if(! $this -> verificarSesion())
		{
			//existen un problema co las vasrialbes de sesi�n
			$this->salida[0] = "f";
			$this->salida[1] = "MENSAJE ERROR = La sesi�n del usario ha sido eliminada";
			$this->salida[2] = "ORIGEN = $this->nombre_archivo";
			$this->salida[3] = "PROC = verificarSesion";
			$this->salida[4] = "NIVEL = 2";

			$this->cnx->desconectar_pg();

			return false;

		}

		else
		{

			//Ejecuta la funci�n
			//	echo($this->query);
			//		exit();

			if($result = pg_query($this->cnx->conexion_bd,$this->query))
			{
				//			echo "emtra";
				//			exit;
				//Carga el resultado en el array temporal de salida
				if($tipo=='both'){
					while ($row = pg_fetch_array($result))
					{
						array_push ($salida_temp, $row);
					}
				}
				elseif ($tipo=='numeral'){
					while ($row = pg_fetch_array($result,null,PGSQL_NUM))
					{
						array_push ($salida_temp, $row);
					}
				
				}
				else{
					while ($row = pg_fetch_array($result,null,PGSQL_ASSOC))
					{
						array_push ($salida_temp, $row);
					}
				}

				//Libera la memoria
				pg_free_result($result);

				//Cierra la conexi�n con postgres
				$this->cnx->desconectar_pg();

				//Define el array de salida
				$this->salida = $salida_temp;
				return true;
			}
			else
			{
				//			echo "else".$result = pg_query($this->cnx->conexion_bd,$this->query);
				//			exit;
				//Se produjo un error a nivel de base de datos (ac� saltan los exceptions que definimos en postgres)
				$resp_funcion = explode($this->sep, pg_last_error($this->cnx->conexion_bd));
				$this->salida[0] = "f";
				$this->salida[1] = $resp_funcion[1];
				$this->salida[2] = $resp_funcion[2];
				$this->salida[3] = $resp_funcion[3];
				$this->salida[4] = $resp_funcion[4];

				//Cierra la conexi�n con postgres
				$this->cnx->desconectar_pg();

				return false;
			}
		}
	}

	/**
	 * Nombre funci�n:	exec_query_sg
	 * Prop�sito:		Ejecuta las funciones de la base de datos que no sean querys (insert, update, delete),
	 * 					a partir del nombre de la funci�n y de los par�metos necesarios de la funci�n
	 * Autor:			Enzo Rojas
	 * Fecha creaci�n:	22-05-2007
	 *
	 * @return unknown
	 */
	function exec_query_sss()
	{
		include_once("cls_conexion.php");

		//array que contendr� el resultado del query
		$salida_temp = array();
		//$this->query = "SELECT * FROM $this->nombre_funcion($this->id_usuario,$this->ip_origen,$this->mac_maquina,$this->codigo_procedimiento,$this->proc_almacenado";
		//Forma la llamada a la funci�n con los par�metros fijos
		$this->query = "SELECT * FROM $this->nombre_funcion(";


		//Concatena los par�metros del filtro-->no necesarion para el caso de login
		//$this->query .= ", $this->cant,$this->puntero,$this->sortcol,$this->sortdir,$this->criterio_filtro";

		//Concatena los par�metros espec�ficos si existieran, caso contrario cierra par�ntesis
		if(sizeof($this->parametros)>0)
		{
			$this->query .= ''.implode(",",$this->parametros) . ")";
		}
		else
		{
			$this->query.= ')';
		}

		//Concatena la lista de columnas con sus respectivos tipos de datos
		if(sizeof($this->def_cols)>0)
		{
			$this->query .= " AS (". implode(",",$this->def_cols).')';
		}

		//Se abre la conexi�n a la base de datos


		$this->cnx = new cls_conexion();

		$this->cnx->conectar_pg();


		//Ejecuta la funci�n
		if($result = pg_query($this->cnx->conexion_bd,$this->query))
		{
			//Carga el resultado en el array temporal de salida
			while ($row = pg_fetch_array($result))
			{
				array_push ($salida_temp, $row);
			}

			//Libera la memoria
			pg_free_result($result);

			//Cierra la conexi�n con postgres
			$this->cnx->desconectar_pg();

			//Define el array de salida
			$this->salida = $salida_temp;
			return true;
		}
		else
		{
			//Se produjo un error a nivel de base de datos (ac� saltan los exceptions que definimos en postgres)
			$resp_funcion = explode($this->sep, pg_last_error($this->cnx->conexion_bd));
			$this->salida[0] = "f";
			$this->salida[1] = $resp_funcion[1];
			$this->salida[2] = $resp_funcion[2];
			$this->salida[3] = $resp_funcion[3];
			$this->salida[4] = $resp_funcion[4];

			//Cierra la conexi�n con postgres
			$this->cnx->desconectar_pg();

			return false;

		}
	}
	function exec_non_query_sss()
	{
		//	include_once("cls_conexion.php");

		//Array que contendr� el resultado del query
		$salida_temp = array();

		//Forma la llamada a la funci�n
		$this->query = "SELECT * FROM $this->nombre_funcion(";

		//Concantena los par�metros espec�ficos; sino existieran a�ade un par�ntesis
		if(sizeof($this->parametros)>0)
		{
			$this->query .= ''.implode(",", $this->parametros).')';
		}
		else
		{
			$this->query .=')';
		}

		//Se abre la conexi�n a la base de datos
		$this->cnx = new cls_conexion();

		$this->cnx->conectar_pg_login();


		//Ejecuta la funci�n
		if($result = pg_query($this->cnx->conexion_bd,$this->query))
		{
			//Carga el resultado en el array temporal de salida
			while ($row = pg_fetch_array($result))
			{
				array_push ($salida_temp, $row);
			}

			//Libera la memoria
			pg_free_result($result);

			//Cierra la conexi�n con postgres
			$this->cnx->desconectar_pg_login();

			//Verifica si se produjo alg�n error l�gico en la funci�n
			$resp_funcion = explode($this->sep, $salida_temp[0][0]);

			if(sizeof($resp_funcion)>0)
			{
				if($resp_funcion[0]==t)
				{
					//No existe error l�gico

					$this->salida = $resp_funcion;
					return true;
				}
				elseif ($resp_funcion[0]==f)
				{
					//Existe error l�gico
					$this->salida = $resp_funcion;
					return false;
				}
				else
				{
					//Si $resp_funcion no tiene ning�n elemento, quiere decir que no hubo respuesta de la base de datos
					$this->salida[0] = "f";
					$this->salida[1] = "MENSAJE ERROR = No se obtuvo respuesta de la base de datos";
					$this->salida[2] = "ORIGEN = $this->nombre_archivo";
					$this->salida[3] = "PROC = exec_non_query";
					$this->salida[4] = "NIVEL = 2";
					return false;
				}
			}
			else
			{
				//Si $resp_funcion no tiene ning�n elemento, quiere decir que no hubo respuesta de la base de datos
				$this->salida = 'No se obtuvo respuesta de la base de datos';
				return false;
			}
		}
		else
		{
			//Se produjo un error a nivel de base de datos
			$resp_funcion = explode($this->sep, pg_last_error($this->cnx->conexion_bd));
			$this->salida[0] = "f";
			$this->salida[1] = $resp_funcion[1];
			$this->salida[2] = $resp_funcion[2];
			$this->salida[3] = $resp_funcion[3];
			$this->salida[4] = $resp_funcion[4];

			//Cierra la conexi�n con postgres
			$this->cnx->desconectar_pg_login();
			return false;
		}
	}

	/**
	 * Nombre funci�n: 	exec_function
	 * Prop�sito:		Ejecutar cualquier funci�n de postgres que no necesite definici�n de columnas
	 * Autor:			Rodrigo Chumacero Moscoso
	 * Fecha creaci�n:	28-06-2007
	 *
	 * @return unknown
	 */
	function exec_function()
	{
		//Array que contendr� el resultado del query
		$salida_temp = array();

		//Forma la llamada a la funci�n con los par�metros fijos
		$this->query = "SELECT $this->nombre_funcion(";

		//Concatena los par�metros espec�ficos si existieran, caso contrario cierra par�ntesis
		if(sizeof($this->parametros)>0)
		{
			$this->query .= implode(",",$this->parametros) . ")";
		}
		else
		{
			$this->query.= ')';
		}
		//echo $this->query;

		//Se abre la conexi�n a la base de datos
		$this->cnx = new cls_conexion();
		$this->cnx->conectar_pg();

		//Ejecuta la funci�n
		if($result = pg_query($this->cnx->conexion_bd,$this->query))
		{
			//Carga el resultado en el array temporal de salida
			while ($row = pg_fetch_array($result))
			{
				array_push ($salida_temp, $row);
			}

			//Libera la memoria
			pg_free_result($result);

			//Cierra la conexi�n con postgres
			$this->cnx->desconectar_pg();

			//Define el array de salida
			$this->salida = $salida_temp;

			return true;
		}
		else
		{
			//Se produjo un error a nivel de base de datos (ac� saltan los exceptions que definimos en postgres)
			$resp_funcion = explode($this->sep, pg_last_error($this->cnx->conexion_bd));
			$this->salida[0] = "f";
			$this->salida[1] = $resp_funcion[1];
			$this->salida[2] = $resp_funcion[2];
			$this->salida[3] = $resp_funcion[3];
			$this->salida[4] = $resp_funcion[4];

			//Cierra la conexi�n con postgres
			$this->cnx->desconectar_pg();

			return false;
		}
	}

	//Funci�n que verifica si la transacci�n efectuada requiere un env�o de alerta
	function verifica_alerta($id_usuario, $ip_origen, $mac_maquina, $codigo_procedimiento, $proc_almacenado, $mensaje_alerta)
	{
		include_once("cls_conexion.php");

		//Define el nombre de la funci�n de verificaci�n de env�o de alerta
		$this->nombre_funcion = 'f_pm_verifica_envio_alerta' ;

		//array que contendr� el resultado del query
		$salida_temp = array();

		//Forma la llamada a la funci�n
		$this->query = "SELECT * FROM $this->nombre_funcion($this->id_usuario,$this->ip_origen,$this->mac_maquina,$this->codigo_procedimiento,$this->proc_almacenado,$mensaje_alerta)";

		//Se abre la conexi�n a la base de datos
		$this->cnx = new cls_conexion();
		$this->cnx->conectar_pg();

		//Ejecuta la funci�n
		if($result = pg_query($this->cnx->conexion_bd, $this->query))
		{
			//Carga el resultado en el array temporal de salida
			while ($row = pg_fetch_array($result))
			{
				array_push ($salida_temp, $row);
			}

			//Libera la memoria
			pg_free_result($result);

			//Cierra la conexi�n con postgres
			$this->cnx->desconectar_pg();

			//Define el array de salida
			$this->salida = $salida_temp;

			//Si el array es mayor a cero devuelve true, caso contrario false
			if(sizeof($this->salida)>0) return true;
			else return false;

		}
		else
		{
			//Se produjo un error a nivel de base de datos
			$this->salida = pg_last_error($this->cnx->conexion_bd);

			//Cierra la conexi�n con postgres
			$this->cnx->desconectar_pg();
			return false;
		}
	}

	//Funci�n que adiciona par�metros espec�ficos para las funciones (aparte de los fijos y del filtro)
	function add_param($param)
	{
		//Valida sin son vac�os o solo tienen comillitas ("''")
		$aux = $this->func->iif($param == '','NULL',$param);
		$aux = $this->func->iif($aux == "''",'NULL',$aux);

		//Se verifica si se decodifica el dato o no
		if(!$this->decodificar)
		{
			$aux = utf8_decode($aux);
		}

		//array_push ($this->parametros, $aux);
		array_push ($this->parametros, $aux);

	}

	
	
	
	
	
	
	
	function add_param_array($param)
	{	//Valida sin son vac�os o solo tienen comillitas ("''")
		
		if($param!="NULL"){
	
			if(sizeof($param)>0){
				$param_array  = "'{". implode(",",$param)."}'";
			}
			else{
				$param_array  = "'{}'";
				
			}
			array_push ($this->parametros,$param_array);
		}
		else{
			array_push ($this->parametros,$param);			
		}
	}
	
	
	//Funci�n que adiciona definici�n de columnas para querys
	function add_def_cols($nombre_col,$tipo_dato)
	{
		$aux = $nombre_col . " ".$tipo_dato;
		array_push($this->def_cols, $aux);
	}
	function add_esquema($nom_fun){

		if(substr($nom_fun,0,5)=='f_al_'||substr($nom_fun,0,6)=='f_tal_'||substr($nom_fun,0,6)=='f_val_'){
			return "almin.$nom_fun";
		}
		elseif (substr($nom_fun,0,5)=='f_af_'||substr($nom_fun,0,6)=='f_taf_'){
			return "actif.$nom_fun";
		}
		elseif (substr($nom_fun,0,5)=='f_ad_'||substr($nom_fun,0,6)=='f_tad_'){
			return "compro.$nom_fun";
		}
		elseif (substr($nom_fun,0,5)=='f_ca_'||substr($nom_fun,0,6)=='f_tca_'){
			return "casis.$nom_fun";
		}
		elseif (substr($nom_fun,0,5)=='f_ct_'||substr($nom_fun,0,6)=='f_tct_'){
			return "sci.$nom_fun";
		}
		elseif (substr($nom_fun,0,5)=='f_fv_'||substr($nom_fun,0,6)=='f_tfv_'){
			return "factur.$nom_fun";
		}
		elseif (substr($nom_fun,0,5)=='f_kp_'||substr($nom_fun,0,6)=='f_tkp_'){
			return "kard.$nom_fun";
		}
		elseif (substr($nom_fun,0,5)=='f_pm_'||substr($nom_fun,0,6)=='f_tpm_'){
			return "param.$nom_fun";
		}
		elseif (substr($nom_fun,0,5)=='f_sg_'||substr($nom_fun,0,6)=='f_tsg_'){
			return "sss.$nom_fun";
		}
		elseif (substr($nom_fun,0,5)=='f_st_'||substr($nom_fun,0,6)=='f_tst_'){
			return "gestel.$nom_fun";
		}
		elseif (substr($nom_fun,0,5)=='f_pr_'||substr($nom_fun,0,6)=='f_tpr_'){
			return "presto.$nom_fun";
		}
		elseif (substr($nom_fun,0,5)=='f_ts_'||substr($nom_fun,0,6)=='f_tts_'){
			return "tesoro.$nom_fun";
		}
		elseif (substr($nom_fun,0,5)=='f_sp_'||substr($nom_fun,0,6)=='f_tsp_'){
			return "pspro.$nom_fun";
		}
		elseif (substr($nom_fun,0,5)=='f_si_'||substr($nom_fun,0,6)=='f_tsi_'){
			return "sigma.$nom_fun";
		} 
		elseif (substr($nom_fun,0,5)=='f_fl_'||substr($nom_fun,0,6)=='f_tfl_'){
			return "flujo.$nom_fun";
		} 
		else{
			return $nom_fun;
		}
	}

	function esquema_filtro($filtro){
		$res="";
		$res=$filtro;
		//tablas
		$res=str_replace(" tad_"," compro.tad_",$res);
		$res=str_replace(" tal_"," almin.tal_",$res);
		$res=str_replace(" taf_"," actif.taf_",$res);
		$res=str_replace(" tca_"," casis.tca_",$res);
		$res=str_replace(" tct_"," sci.tct_",$res);
		$res=str_replace(" tfv_"," factur.tfv_",$res);
		$res=str_replace(" tkp_"," kard.tkp_",$res);

		$res=str_replace(" tpm_"," param.tpm_",$res);
		$res=str_replace(" tsg_"," sss.tsg_",$res);
		$res=str_replace(" tst_"," gestel.tst_",$res);
		$res=str_replace(" tpr_"," presto.tpr_",$res);
		$res=str_replace(" tts_"," tesoro.tts_",$res);
		$res=str_replace(" tsp_"," pspro.tsp_",$res);
		$res=str_replace(" tsi_"," sigma.tsi_",$res);


		//vistas


		$res=str_replace(" vad_"," compro.vad_",$res);
		$res=str_replace(" val_"," almin.val_",$res);
		$res=str_replace(" vaf_"," actif.vaf_",$res);
		$res=str_replace(" vca_"," casis.vca_",$res);
		$res=str_replace(" vct_"," sci.vct_",$res);
		$res=str_replace(" vfv_"," factur.vfv_",$res);
		$res=str_replace(" vkp_"," kard.vkp_",$res);
		$res=str_replace(" vpm_"," param.vpm_",$res);
		$res=str_replace(" vsg_"," sss.vsg_",$res);
		$res=str_replace(" vst_"," gestel.vst_",$res);
		$res=str_replace(" vpr_"," presto.vpr_",$res);
		$res=str_replace(" vts_"," tesoro.vts_",$res);
		$res=str_replace(" vsp_"," pspro.vsp_",$res);
		$res=str_replace(" vsi_"," sigma.vsi_",$res);

		return $res;

	}

	function get_query_iud(){
		//Forma la llamada a la funci�n
		$sql="";
		$sql = "SELECT $this->nombre_funcion ($this->id_usuario,$this->ip_origen,$this->mac_maquina,$this->codigo_procedimiento,$this->proc_almacenado";

		//Concantena los par�metros espec�ficos; sino existieran a�ade un par�ntesis
		if(sizeof($this->parametros)>0){
			$sql .= ','.implode(",", $this->parametros).')';
		}
		else{
			$sql .=')';
		}

		return $sql;
	}

	function get_query_sel(){
		//Forma la llamada a la funci�n
		$sql="";
		$sql = "SELECT * FROM $this->nombre_funcion($this->id_usuario,$this->ip_origen,$this->mac_maquina,$this->codigo_procedimiento,$this->proc_almacenado";
		$sql .= ", $this->cant,$this->puntero,$this->sortcol,$this->sortdir";

		if($this->criterio_filtro != ''){
			$sql .= ",".$this->esquema_filtro($this->criterio_filtro);
		}

		//Concantena los par�metros espec�ficos; sino existieran a�ade un par�ntesis
		if(sizeof($this->parametros)>0){
			$sql .= ','.implode(",", $this->parametros).')';
		}
		else{
			$sql .=')';
		}

		//Concatena la lista de columnas con sus respectivos tipos de datos
		if(sizeof($this->def_cols)>0)
		{
			$sql .= " AS (". implode(",",$this->def_cols).')';

			if($criterio_funcion)
			{
				$sql .=$criterio_funcion;
			}

		}

		return $sql;
	}

	//RCM: 18/11/2008
	//Funci�n que permite a�adir un filtro a nivel de llamada de la funci�n, s�lo para el caso de Ejecutar Query
	function add_filtro_funcion($filtro){
		$this->filtro_funcion=$filtro;
	}

	//RCM: 18/11/2008
	//Funci�n que agrega el filtro (si fue definido) a la cadena query a ejecutar
	private function add_filtro_funcion_llamada(){
		if($this->filtro_funcion!=''){
			$this->query.=" WHERE ".$this->filtro_funcion;
		}
	}
}
?>
