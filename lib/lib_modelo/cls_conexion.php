<?php
/**
 * Nombre clase:	cls_conexion
 * Prop�sito:		Clase que contiene las funcionalidades para la conexi�n a la base de datos
 * Autor:			Rodrigo Chumacero Moscoso
 * Fecha Creaci�n:	18-05-2007
 *
 */
session_start();
class cls_conexion
{
	var $host; //Host de la base de datos
	var $dbname; //Nombre de la base de datos
	var $usr; //Usuario de conexi�n a la base de datos
	var $pwd; //Password del usuario de conexi�n
	var $conexion_bd; //Conexi�n a la base de datos

	/**
	 * Nombre funci�n:	__construct
	 * Prop�sito:		Constructor de la clase cls_conexion, que carga los datos de conexi�n de archivo de configuraci�n
	 * Autor:			Rodrigo Chumacero Moscoso
	 * Fecha Creaci�n:	18-05-2007
	 * 
	 */
	function __construct()
	{
		$this->host = $_SESSION["HOST"];
		//$this->dbname = $_SESSION["BASE_DATOS"];
		//echo "baseantes: ".trim($_SESSION["ss_nombre_basedatos"])."<br>";
		$this->dbname = trim($_SESSION["BASE_DATOS"]);
		//echo "base datos: ".$this->dbname;
		//$this->usr = addslashes(htmlentities($_SESSION["ss_usuario"],ENT_QUOTES));
		$this->usr = addslashes(htmlentities($_SESSION["BASE_DATOS"],ENT_QUOTES))."_".addslashes(htmlentities($_SESSION["ss_usuario"],ENT_QUOTES));
		$this->pwd='null';

		//echo addslashes(htmlentities($_SESSION["CONTRASENA"],ENT_QUOTES));

		$this->pwd = trim(addslashes(htmlentities($_SESSION["ss_contrasenia"],ENT_QUOTES)));
	}



	/**
	 * Nombre funci�n:	conectar_pg
	 * Prop�sito:		Permite abrir una conexi�n con una base de datos postges en base a los par�metros de configuraci�n
	 * Autor:			Rensi Arteaga Copari
	 * Fecha Creaci�n:	18-05-2007
	 *
	 * @return unknown
	 */
	function conectar_pg ()
	{
		//error_reporting(0);
	


		$this->conexion_bd = pg_connect("host=".$this->host." dbname=".$this->dbname." user=".$this->usr." password=".$this->pwd." port=5432");

		

	


		if($this->conexion_bd!=""){

			

			return $this->conexion_bd;
		}else{
			
			//echo pg_last_error($this->conexion_bd);exit;
			$_SESSION["EXITO_CNX__DB"]='NO';
			echo $this->usr;
			echo "fallo";
			exit;
			//echo "{success:false}";
			//exit;

		}
	

	}


	/**
	 * Nombre funci�n:	desconectar_pg
	 * Prop�sito:		Cerrar una conexi�n abierta con una base de datos postgres
	 * Autor:			Rensi Arteaga Copari
	 * Fecha creaci�n:	18-05-2007
	 *
	 * @return unknown
	 */
	function desconectar_pg()
	{


		if($this->conexion_bd){

			if(!pg_close($this->conexion_bd))
			{
				echo "Error al cerrar la conexi�n:".pg_last_error();
				return -1 ;
			}
			else
			{
				return $this->conexion_bd;
			}
		}
	}
	
	
	/**
	 * Nombre funci�n:	conectar_pg_login
	 * Prop�sito:		Permite abrir una conexi�n con una base de datos postges en base a los par�metros de configuraci�n
	 * Autor:			Rensi Arteaga Copari
	 * Fecha creaci�n:	29-04-2010
	 *
	 * @return unknown
	 */
	function conectar_pg_login ()
	{
	
       $temp = "host=".$this->host." dbname=".$this->dbname." user=".$_SESSION["CON_USUARIO"]." password=".$_SESSION["CON_CONTRASENA"]." port=5432";
		
		/*echo 'host='.$this->host;
		echo 'hbname='.$this->dbname;
		echo "user=".$_SESSION["CON_USUARIO"];
		echo "password=".$_SESSION["CON_CONTRASENA"];
		
		*/
		
		$this->conexion_bd = pg_connect($temp);
        //echo 'llega '.$temp;
		//exit;
	

		if($this->conexion_bd!=""){

			return $this->conexion_bd;
		}else{
			//$_SESSION["EXITO_CNX__DB"]='NO';
			//echo pg_last_error($this->conexion_bd);exit;
			echo $this->usr;
			echo "fallo";
			exit;
			//echo "{success:false}";
			//exit;

		}
		

	}


	/**
	 * Nombre funci�n:	desconectar_pg_login
	 * Prop�sito:		Cerrar una conexi�n abierta con una base de datos postgres
	 * Autor:			Rensi Arteaga Copari
	 * Fecha creaci�n:	29-04-2010
	 *
	 * @return unknown
	 */
	function desconectar_pg_login()
	{

		if($this->conexion_bd){
			
			if(!pg_close($this->conexion_bd))
			{
				echo "Error al cerrar la conexi�n:".pg_last_error();
				return -1 ;
			}
			else
			{
				return $this->conexion_bd;
			}
		}
	}


	/**
	 * Nombre funci�n:	conectar_mysql
	 * Prop�sito:		Permite abrir una conexi�n con una base de datos mysql en base a los par�metros de configuraci�n
	 * Autor:			Rensi Arteaga Copari
	 * Fecha creaci�n:	18-05-2007
	 *
	 * @return unknown
	 */
	function conectar_mysql()
	{
		if (!($id_conexion = @mysql_connect($HOST, $USUARIO, $CONTRASENA)))
		{
			return -1 ;
		}
		elseif ( ! @mysql_select_db ($BASE_DATOS, $id_conexion) )
		{
			return -1 ;
		}
		else
		return $id_conexion ;
	}

	//Cierra la conexi�n abierta con la base de datos Mysql

	/**
	 * Nombre funci�n:	desconectar_mysql
	 * Prop�sito:		Cerrar una conexi�n abierta con una base de datos postgres
	 * Autor:			Rensi Arteaga Copari
	 * Fecha creaci�n:	18-05-2007
	 *
	 * @return unknown
	 */
	function desconectar_mysql()
	{
		if(!@mysql_close($this->conexion_bd) )
		{
			echo "Error al cerrar la conexi�n:" . mysql_errno() . " Error: " . mysql_error() ;
			return -1 ;
		}
		else
		{
			return $this->conexion_bd;
		}
	}


	/**
	 * Nombre funci�n:	NombreBD
	 * Prop�sito:		Devuelve el nombre de la Base de Datos de la configuraci�n
	 * Autor:			Rodrigo Chumacero Moscoso
	 * Fecha creaci�n:	18-05-2007
	 *
	 * @return unknown
	 */
	function NombreBD ()
	{
		return $this->dbname;
	}


	/**
	 * Nombre funci�n:	Host
	 * Prop�sito:		Devuelve el nombre del Host de la configuraci�n
	 * Autor:			Rodrigo Chumacero Moscoso
	 * Fecha creaci�n:	18-05-2007
	 *
	 * @return unknown
	 */
	function Host ()
	{
		return $this->host;
	}


	/**
	 * Nombre funci�n:	Usuario
	 * Prop�sito:		Devuelve el usuario para la conexi�n a la base de datos
	 * Autor:			Rodrigo Chumacero Moscoso
	 * Fecha creaci�n:	18-05-2007
	 *
	 * @return unknown
	 */
	function Usuario()
	{
		return $this->usr;

	}

}
?>