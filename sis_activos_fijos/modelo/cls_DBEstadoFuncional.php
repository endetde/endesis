<?php
class cls_DBEstadoFuncional
{	//Variable que contiene la salida de la ejecuci�n de la funci�n
	//si la funci�n tuvo error (false), salida contendr� el mensaje de error
	//si la funci�n no tuvo error (true), salida contendr� el resultado, ya sea un conjunto de datos o un mensaje de confirmaci�n
	var $salida;
	//Variable que contedr� la cadena de llamada a las funciones postgres
	var $query;
	//Variables para la ejecuci�n de funciones
	var $var; //middle_client
	var $nombre_funcion; //nombre de la funci�n a ejecutar
	var $codigo_procedimiento; //codigo del procedimiento a ejecutar
	var $nombre_archivo = "cls_DBEstadoFuncional.php";
	//Matriz de par�metros de validaci�n de todas las columnas
	var $matriz_validacion = array();

	//Bandera que indica si los datos se decodificar�n o no
	var $decodificar = false;

	function __construct($decodificar)
	{
		//Carga los par�metro de validaci�n de todas las columnas
		$this->cargar_param_valid();

		//Carga en una variable interna la bandera del GET o POST
		$this->decodificar = $decodificar;
	}
	function ListarEstadoFuncional($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{	$this->salida ="";
		$this->nombre_funcion = 'f_taf_estado_funcional_consultas';
		$this->codigo_procedimiento = "'AF_EST_FUN_SEL'";

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
		$this->var->add_def_cols('id_estado_funcional','int4');
		$this->var->add_def_cols('codigo','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('estado','varchar');
		
		//Ejecuta la funci�n de consulta
		$res = $this ->var->exec_query();
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	function ContarListaEstadoFuncional($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_estado_funcional_consultas';
		$this->codigo_procedimiento = "'AF_EST_FUN_SEL_COUNT'";

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
	function CrearEstadoFuncional($id_estado_funcional,$codigo,$descripcion,$estado)
	{	$this->salida = "";
		$this->nombre_funcion = 'f_taf_estado_funcional';
		$this->codigo_procedimiento = "'AF_EST_FUN_INS'";

		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param('NULL');//id_fina_regi_
		$this->var->add_param('NULL');//id_estado_funcional
		$this->var->add_param("'$codigo'");//codigo
		$this->var->add_param("'$descripcion'");//desc
		$this->var->add_param('NULL');//estado
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}


	
	function  EliminarEstadoFuncional($id_estado_funcional)
	{	$this->salida="";
		$this->nombre_funcion = 'f_taf_estado_funcional';
		$this->codigo_procedimiento = "'AF_EST_FUN_DEL'";
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param('NULL');//id_fina_regi
		$this->var->add_param($id_estado_funcional);
		$this->var->add_param('NULL');//codigo
		$this->var->add_param('NULL');//descripcion
		$this->var->add_param('NULL');//estado
		
		
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		$this->query = $this->var->query;
	
		return $res;
	}


	function  ModificarEstadoFuncional($id_estado_funcional,$codigo,$descripcion,$estado)
	{	
		$this->salida="";
		$this->nombre_funcion = 'f_taf_estado_funcional';
		$this->codigo_procedimiento = "'AF_EST_FUN_UPD'";

		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		$this->var->add_param('NULL');//id_fina_regi_
		$this->var->add_param($id_estado_funcional);//
		$this->var->add_param("'$codigo'");//
		$this->var->add_param("'$descripcion'");//
		$this->var->add_param("'$estado'");//
		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		$this->query = $this->var->query;
		return $res;
	}
//se adiciono esta funcion en ves de la anterior en fecha 10 de enero 2011 por Williams Escobar	
function ValidarEstadoFuncional($operacion_sql,$id_estado_funcional,$codigo,$descripcion,$estado)
{
$this->salida = "";
		$valid = new cls_validacion_serv();

		//Clase para validar el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();
	
		//Ejecuta la validaci�n del $id_proceso_depto tipo integer
		if($operacion_sql=='insert' || $operacion_sql=='update')
		{
			if($operacion_sql == 'update')
			{
				//Validar id_estado_funcional - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_estado_funcional");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_estado_funcional", $id_estado_funcional))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar codigo - tipo text
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("codigo");
			$tipo_dato->set_MaxLength(5);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "codigo",$codigo))
			{
				$this->salida = $valid->salida;
				return false;
			}

         //Validar $id_depto  - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(30);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
        return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_tipo_proceso - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_estado_funcional");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_estado_funcional", $id_estado_funcional))
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

//	function ValidarEstadoFuncional($operacion_sql,$id_estado_funcional,$codigo,$descripcion,$estado)
	//{
		//operacion_sql se refiere a que operaci�n validar (por ejemplo: insert, update, delete; podr�an ser otros espec�ficos)
 
		/*this->salida = "";
		$valid = new cls_validacion_serv();


		//Ejecuta la validaci�n por el tipo de operaci�n
		switch ($operacion_sql) {
			case 'insert' :
				{	/*******************************Verificaci�n de datos****************************/
					//Verifica que las columnas obligatorias tengan datos, que tenga formato v�lido y un tama�o v�lido
					//Se valida todas las columnas de la tabla
					/*if(!$valid->verifica_dato($this->matriz_validacion[1],"codigo",$codigo))
					{	$this->salida = $valid->resp; echo"matriz_validacion[1]:".$this->matriz_validacion[1]['Columna'];exit;
					    return false;
					}
					if(!$valid->verifica_dato($this->matriz_validacion[2] ,"descripcion",$descripcion))
					{	$this->salida = $valid->resp;
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
				/*	if(!$valid->verifica_dato($this->matriz_validacion[0],"id_metodo_depreciacion",$id_metodo_depreciacion))
					{	$this->salida = $valid->resp;
						return  false;
					}
					if(!$valid->verifica_dato($this->matriz_validacion[1] ,"codigo",$codigo))
					{	$this->salida = $valid->resp;
						return false;
					}
					if(!$valid->verifica_dato($this->matriz_validacion[2] ,"descripcion",$descripcion))
					{	$this->salida = $valid->resp;
						return false;
					}
                    if(!$valid->verifica_dato($this->matriz_validacion[3] ,"estado",$estado))
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
					if(!$valid->verifica_dato($array_valid,"id_estado_funcional",$id_estado_funcional))
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
		}*/

	//}

	function cargar_param_valid()
	{	//Columnas: id_metodo_depreciacion
		$matriz_validacion[0] = array();
		$matriz_validacion[0]['Columna'] = "id_estado_funcional";
		$matriz_validacion[0]['allowBlank'] = "false";
		$matriz_validacion[0]['maxLength'] = 15;
		$matriz_validacion[0]['minLength'] = 0;
		$matriz_validacion[0]['SelectOnFocus'] = "true";
		$matriz_validacion[0]['vtype'] = "alphanum";
		$matriz_validacion[0]['dataType'] = "entero";
		$matriz_validacion[0]['width'] = "";
		$matriz_validacion[0]['grow'] = "";

		$matriz_validacion[1] = array();
		$matriz_validacion[1]['Columna'] = "codigo";
		$matriz_validacion[1]['allowBlank'] = "true";
		$matriz_validacion[1]['maxLength'] = 10;
		$matriz_validacion[1]['minLength'] = 0;
		$matriz_validacion[1]['SelectOnFocus'] = "true";
		$matriz_validacion[1]['vtype'] = "alphaLatino";
		$matriz_validacion[1]['dataType'] = "texto";
		$matriz_validacion[1]['width'] = "";
		$matriz_validacion[1]['grow'] = "";
		
		//Columnas: monto_vigente_anterior (money)
		$matriz_validacion[2] = array();
		$matriz_validacion[2]['Columna'] = "descripcion";
		$matriz_validacion[2]['allowBlank'] = "true";
		$matriz_validacion[2]['maxLength'] = 100;
		$matriz_validacion[2]['minLength'] = 0;
		$matriz_validacion[2]['SelectOnFocus'] = "true";
		$matriz_validacion[2]['vtype'] = "alphaLatino";
		$matriz_validacion[2]['dataType'] = "texto";
		$matriz_validacion[2]['width'] = "";
		$matriz_validacion[2]['grow'] = "";
		
		$matriz_validacion[3] = array();
		$matriz_validacion[3]['Columna'] = "estado";
		$matriz_validacion[3]['allowBlank'] = "true";
		$matriz_validacion[3]['maxLength'] = 10;
		$matriz_validacion[3]['minLength'] = 2;
		$matriz_validacion[3]['SelectOnFocus'] = "true";
		$matriz_validacion[3]['vtype'] = "alphaLatino";
		$matriz_validacion[3]['dataType'] = "texto";
		$matriz_validacion[3]['width'] = "";
		$matriz_validacion[3]['grow'] = "";

	}


}?>