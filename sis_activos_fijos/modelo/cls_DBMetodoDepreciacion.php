<?php
class cls_DBMetodoDepreciacion
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

	var $nombre_archivo = "cls_DBMetodoDepreciacion.php";

	//Matriz de par�metros de validaci�n de todas las columnas
	var $matriz_validacion = array();

	//Bandera que indica si los datos se decodificar�n o no
	var $decodificar = false;

	function __construct($decodificar)
	{
		//Carga en una variable interna la bandera del GET o POST
		$this->decodificar = $decodificar;
	}
	function ListarMetodoDepreciacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{


		$this->salida ="";
		$this->nombre_funcion = 'f_taf_metodo_depreciacion_sel';
		$this->codigo_procedimiento = "'AF_MET_DEP_SEL'";

		$func = new cls_funciones();
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";


		//Carga los par�metros espec�fos
		$this->var->add_param($func->iif($id_financiador == '','NULL',"'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '','NULL',"'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '','NULL',"'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '','NULL',"'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '','NULL',"'$id_actividad'"));//id_actividad



		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_metodo_depreciacion','integer');
		$this->var->add_def_cols('descripcion','varchar');
		


		//Ejecuta la funci�n de consulta
		$res = $this ->var->exec_query();



		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	function ContarListaMetodoDepreciacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_metodo_depreciacion_sel';
		$this->codigo_procedimiento = "'AF_MET_DEP_SEL_COUNT'";


		$func = new cls_funciones();//Instancia de las funciones generales
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);


		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

		//Carga par�metros espec�ficos
		$this->var->add_param($func->iif($id_financiador == '','NULL',$id_financiador));
		$this->var->add_param($func->iif($id_regional == '','NULL',$id_regional));
		$this->var->add_param($func->iif($id_programa == '','NULL',$id_programa));
		$this->var->add_param($func->iif($id_proyecto== '','NULL',$id_proyecto));
		$this->var->add_param($func->iif($id_actividad == '','NULL',$id_actividad));

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('total','bigint');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n
		$this->salida = $this->var->salida;
		//Si la ejecuci�n fue satisfactoria modifica la salida para que solo devuelva al total de la consulta
		if($res)
		{
			$this->salida = $this->var->salida[0][0];

		}
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		//Retorna el resultado de la ejecuci�n

		return $res;
	}

	/*
	**********************************************************
	Nombre de la funci�n:	CrearMetodoDepreciacion()

	Prop�sito:				Se utiliza esta funci�n para insertar un nuevo Metodo de Depreciacion en la base de datos
	Par�metros:				$descripcion	-->	desc del ActivoFijoProceso

	&obs --> observaciones pertinentes
	Valores de Retorno:		 0	-->	Retorna el nombre del archivo
	-1	--> Indica que se produjo un error y no se pudo subir el archivo al servidor
	**********************************************************
	*/
	function CrearMetodoDepreciacion($descripcion,$id_metodo_depreciacion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_metodo_depreciacion_iud';
		$this->codigo_procedimiento = "'AF_MET_DEP_INS'";

		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param('NULL');//id_fina_regi_
		$this->var->add_param("'$descripcion'");//desc
		$this->var->add_param('NULL');//id_met
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}


	
	function  EliminarMetodoDepreciacion($id_metodo_depreciacion)
	{

		$this->salida="";
		$this->nombre_funcion = 'f_taf_metodo_depreciacion_iud';
		$this->codigo_procedimiento = "'AF_MET_DEP_DEL'";

		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param('NULL');//id_fina_regi
		$this->var->add_param('NULL');//
		$this->var->add_param($id_metodo_depreciacion);
		
		
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		$this->query = $this->var->query;
	
		return $res;
	}


	function  ModificarMetodoDepreciacion($descripcion,$id_metodo_depreciacion)
	{
		$this->salida="";
		$this->nombre_funcion = 'f_taf_metodo_depreciacion_iud';
		$this->codigo_procedimiento = "'AF_MET_DEP_UPD'";

		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		$this->var->add_param('NULL');//id_fina_regi_
		$this->var->add_param("'$descripcion'");//
		$this->var->add_param($id_metodo_depreciacion);//
		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		$this->query = $this->var->query;
		
		//echo $this->query;exit;
		return $res;
	}

	function ValidarMetodoDepreciacion($operacion_sql,$descripcion,$id_metodo_depreciacion)
	{
		//operacion_sql se refiere a que operaci�n validar (por ejemplo: insert, update, delete; podr�an ser otros espec�ficos)
		$this->salida = "";
		$valid = new cls_validacion_serv();


		//Ejecuta la validaci�n por el tipo de operaci�n
		switch ($operacion_sql) {
			case 'insert' :
				{
					/*******************************Verificaci�n de datos****************************/
					//Verifica que las columnas obligatorias tengan datos, que tenga formato v�lido y un tama�o v�lido
					//Se valida todas las columnas de la tabla
					if(!$valid->verifica_dato($this->matriz_validacion[1] ,"descripcion",$descripcion))
					{
						$this->salida = $valid->resp;
						return false;
					}
					//Validaci�n exitosa
					return true;
				}
				break;

			case 'update' :
				{
					
					/*******************************Verificaci�n de datos****************************/
					//Verifica que las columnas obligatorias tengan datos, que tenga formato v�lido y un tama�o v�lido
					//Se valida todas las columnas de la tabla
					if(!$valid->verifica_dato($this->matriz_validacion[0],"id_metodo_depreciacion",$id_metodo_depreciacion))
					{
						$this->salida = $valid->resp;
						return  false;
					}

					if(!$valid->verifica_dato($this->matriz_validacion[1] ,"descripcion",$descripcion))
					{
						$this->salida = $valid->resp;
						return false;
					}

					//Validaci�n exitosa
					return true;
				}
				break;


			case 'delete':
				{
					if(!$valid->verifica_dato($array_valid,"id_metodo_depreciacion",$id_metodo_depreciacion))
					{
						$this->salida = $valid->resp;
						return false;
					}
					//Validaci�n exitosa
					return true;

				}
				break;
			default:
				{
					return false;
				}
				break;
		}

	}



}?>