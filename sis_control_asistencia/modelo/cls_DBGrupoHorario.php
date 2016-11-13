<?php
class cls_DBGrupoHorario
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

	var $nombre_archivo = "cls_DBGrupoHorario.php";

	//Matriz de par�metros de validaci�n de todas las columnas
	var $matriz_validacion = array();

	//Bandera que indica si los datos se decodificar�n o no
	var $decodificar = false;

	function __construct($decodificar)
	{
		//Carga los par�metro de validaci�n de todas las columnas
		//$this->cargar_param_valid();
		
		//Carga en una variable interna la bandera del GET o POST
		$this->decodificar = $decodificar;
	}
	/**
	 *
	 *
	 * @param unknown_type $cant
	 * @param unknown_type $puntero
	 * @param unknown_type $sortcol
	 * @param unknown_type $sortdir
	 * @param unknown_type $criterio_filtro
	 * @param unknown_type $id_parametros_generales
	 * @param unknown_type $nombre_atributo
	 * @param unknown_type $valor_atributo
	 * @param unknown_type $descripcion
	 * @return unknown
	 */
	function ListarGrupoHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'casis.f_tca_grupo_horario_sel';
		$this->codigo_procedimiento = "'CA_GRU_HOR_SEL'";

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
		$this->var->add_def_cols('id_grupo_horario','integer');
		$this->var->add_def_cols('nombre_horario','varchar');
		$this->var->add_def_cols('acronimo_horario','varchar');
		$this->var->add_def_cols('descripcion','text');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}


/**
 * 
 * 
 *
 * @param unknown_type $cant
 * @param unknown_type $puntero
 * @param unknown_type $sortcol
 * @param unknown_type $sortdir
 * @param unknown_type $criterio_filtro
 * @param unknown_type $id_parametros_generales
 * @param unknown_type $nombre_atributo
 * @param unknown_type $valor_atributo
 * @param unknown_type $descripcion
 * @return unknown
 */
	function ContarListaGrupoHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
{
		$this->salida = "";
		$this->nombre_funcion = 'casis.f_tca_grupo_horario_sel';
		$this->codigo_procedimiento = "'CA_GRU_HOR_SEL_COUNT'";

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

	/*
	**********************************************************
	Nombre de la funci�n:	CrearGrupoHorario()

	Prop�sito:				Se utiliza esta funci�n para insertar un nuevo Grupo de Horario en la base de datos
	Par�metros:				$descripcion	-->	desc 
	&obs --> observaciones pertinentes
	Valores de Retorno:		 0	-->	Retorna el nombre del archivo
	-1	--> Indica que se produjo un error y no se pudo subir el archivo al servidor
	**********************************************************
	*/
	function CrearGrupoHorario($id_grupo_horario,$nombre_horario,$acronimo_horario,$descripcion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'casis.f_tca_grupo_horario_iud';
		$this->codigo_procedimiento = "'CA_GRU_HOR_INS'";

		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id_fina_regi_prog_proy_acti
		$this->var->add_param("NULL");//id_grupo_horario
		$this->var->add_param("'$nombre_horario'");//nombre_horario
		$this->var->add_param("'$acronimo_horario'");//acronimo_horario
		$this->var->add_param("'$descripcion'");//descripcion
        				
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}


	
	function  EliminarGrupoHorario($id_grupo_horario)
	{

		$this->salida="";
		$this->nombre_funcion = 'casis.f_tca_grupo_horario_iud';
		$this->codigo_procedimiento = "'CA_GRU_HOR_DEL'";

		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id_fina_regi_prog_proy_acti
		$this->var->add_param("'$id_grupo_horario'");
		$this->var->add_param('NULL');//nombre_horario
		$this->var->add_param('NULL');//acronimo_horario
		$this->var->add_param('NULL');//descripcion
				
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		$this->query = $this->var->query;
	
		return $res;
	}


	function  ModificarGrupoHorario($id_grupo_horario,$nombre_horario,$acronimo_horario,$descripcion)
	{
		$this->salida="";
		$this->nombre_funcion = 'casis.f_tca_grupo_horario_iud';
		$this->codigo_procedimiento = "'CA_GRU_HOR_UPD'";

		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		
		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id_fina_regi_prog_proy_acti
		$this->var->add_param("'$id_grupo_horario'");//id_grupo_horario
		$this->var->add_param("'$nombre_horario'");//nombre_horario
		$this->var->add_param("'$acronimo_horario'");//acronimo_horario
		$this->var->add_param("'$descripcion'");//descripcion
	    		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		$this->query = $this->var->query;
		return $res;
	}

	/**
	 * Enter description here...
	 *
	 * @param unknown_type $operacion_sql
	 * @param unknown_type $id_parametros_generales
	 * @param unknown_type $nombre_atributo
	 * @param unknown_type $valor_atributo
	 * @param unknown_type $descripcion
	 * @return unknown
	 */
	function ValidarGrupoHorario($operacion_sql,$id_grupo_horario,$nombre_horario,$acronimo_horario,$descripcion)
	{
		//operacion_sql se refiere a que operaci�n validar (por ejemplo: insert, update, delete; podr�an ser otros espec�ficos)

		$this->salida = "";
		$valid = new cls_validacion_serv();
		
		//Clase para validar el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();

		//Ejecuta la validaci�n por el tipo de operaci�n
		switch ($operacion_sql)
		{
			case 'insert' :
				
					/*******************************Verificaci�n de datos****************************/
					//Verifica que las columnas obligatorias tengan datos, que tenga formato v�lido y un tama�o v�lido
					//Se valida todas las columnas de la tabla
							
									
				//Validar nombre horario - tipo varchar
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("nombre_horario");	
				$tipo_dato->set_MaxLength(30);
				$tipo_dato->set_MinLength(0); 
				if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "nombre_horario", $nombre_horario))
				
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar acronimo horario - tipo varchar
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("acronimo_horario");	
				$tipo_dato->set_MaxLength(30);
				$tipo_dato->set_MinLength(0);
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "acronimo_horario", $acronimo_horario))				
				//if(!$valid->verifica_dato($this->matriz_validacion[2],"valor_atributo",$valor_atributo))
				{
					$this->salida = $valid->salida;
					return false;
				}

				//Validar descripcion - tipo texto
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("descripcion");	
				$tipo_dato->set_MaxLength(400);
				$tipo_dato->set_MinLength(0);				
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion))				
				//if(!$valid->verifica_dato($this->matriz_validacion[3],"descripcion",$descripcion))
				{
					$this->salida = $valid->salida;
					return false;
				}

				
				//Validaci�n exitosa
				return true;				
				break;
				
			case 'update' :
				
					/*******************************Verificaci�n de datos****************************/
					//Verifica que las columnas obligatorias tengan datos, que tenga formato v�lido y un tama�o v�lido
					//Se valida todas las columnas de la tabla
				
					
				//Validar id_grupo_horario - tipo entero
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("id_grupo_horario");	
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_MinLength(0);				
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_grupo_horario", $id_grupo_horario))					
				//if(!$valid->verifica_dato($this->matriz_validacion[0], "id_parametro_general", $id_parametro_general))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar nombre_horario - tipo varchar
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("nombre_horario");
				$tipo_dato->set_MaxLength(30);
				$tipo_dato->set_MinLength(0);	
								 
				if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "nombre_horario", $nombre_horario))				
				//if(!$valid->verifica_dato($this->matriz_validacion[1], "nombre_atributo", $nombre_atributo))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar acronimo_horario - tipo varchar
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("acronimo_horario");	
				$tipo_dato->set_MaxLength(30);
				$tipo_dato->set_MinLength(0);
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "acronimo_horario", $acronimo_horario))				
				//if(!$valid->verifica_dato($this->matriz_validacion[2], "valor_atributo", $valor_atributo))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar descripcion - tipo texto
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("descripcion");	
				$tipo_dato->set_MaxLength(400);
				$tipo_dato->set_MinLength(0);				
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion))					
				//if(!$valid->verifica_dato($this->matriz_validacion[3], "descripcion", $descripcion))
				{
					$this->salida = $valid->salida;
					return false;

				}
				
								
				//Validaci�n exitosa
				return true;
				break;


			case 'delete':
				break;
			default:
				{
					return false;
				}
				break;
		}

	}
	


}
?>