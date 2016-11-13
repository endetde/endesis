<?php
class cls_DBHistoricoLectura
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

	var $nombre_archivo = "cls_DBHistoricoLectura.php";

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
	function ListarHistoricoLectura($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'casis.f_tca_historico_lectura_sel';
		$this->codigo_procedimiento = "'CA_HIS_LEC_SEL'";

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
		$this->var->add_def_cols('id_historico_lectura','bigint');
		$this->var->add_def_cols('hora','time');
		$this->var->add_def_cols('tipo_movimiento','varchar');
		$this->var->add_def_cols('id_lectura_procesada','integer');
		$this->var->add_def_cols('desc_lectura','text');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//echo $this->query;
		//exit;
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
	function ContarListaHistoricoLectura($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
{
		$this->salida = "";
		$this->nombre_funcion = 'casis.f_tca_historico_lectura_sel';
		$this->codigo_procedimiento = "'CA_HIS_LEC_SEL_COUNT'";

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
	Nombre de la funci�n:	CrearHistoricoLectura()

	Prop�sito:				Se utiliza esta funci�n para insertar un nuevo Historico de la lectura en la base de datos
	Par�metros:				$descripcion	-->	desc 
	&obs --> observaciones pertinentes
	Valores de Retorno:		 0	-->	Retorna el nombre del archivo
	-1	--> Indica que se produjo un error y no se pudo subir el archivo al servidor
	**********************************************************
	*/
	function CrearHistoricoLectura($id_historico_lectura,$hora,$tipo_movimiento,$id_lectura_procesada)
	{
		$this->salida = "";
		$this->nombre_funcion = 'casis.f_tca_historico_lectura_iud';
		$this->codigo_procedimiento = "'CA_HIS_LEC_INS'";

		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id_fina_regi_prog_proy_acti
		$this->var->add_param("NULL");//id_historico_lectura
		$this->var->add_param("'$hora'");//hora
		$this->var->add_param("'$tipo_movimiento'");//tipo_movimiento
		$this->var->add_param("'$id_lectura_procesada'");//id_lectura_procesada
        				
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}


	
	function  EliminarHistoricoLectura($id_historico_lectura)
	{

		$this->salida="";
		$this->nombre_funcion = 'casis.f_tca_historico_lectura_iud';
		$this->codigo_procedimiento = "'CA_HIS_LEC_DEL'";

		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id_fina_regi_prog_proy_acti
		$this->var->add_param("'$id_historico_lectura'");
		$this->var->add_param('NULL');//hora
		$this->var->add_param('NULL');//tipo_movimiento
		$this->var->add_param('NULL');//id_lectura_procesada
				
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		$this->query = $this->var->query;
	
		return $res;
	}


	function  ModificarHistoricoLectura($id_historico_lectura,$hora,$tipo_movimiento,$id_lectura_procesada)
	{
		$this->salida="";
		$this->nombre_funcion = 'casis.f_tca_historico_lectura_iud';
		$this->codigo_procedimiento = "'CA_HIS_LEC_UPD'";

		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		
		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id_fina_regi_prog_proy_acti
		$this->var->add_param("'$id_historico_lectura'");//id_historico_lectura
		$this->var->add_param("'$hora'");//hora
		$this->var->add_param("'$tipo_movimiento'");//tipo_movimiento
		$this->var->add_param("'$id_lectura_procesada'");//id_lectura_procesada
	    		
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
	function ValidarHistoricoLectura($operacion_sql,$id_historico_lectura,$hora,$tipo_movimiento,$id_lectura_procesada)
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
							
									
				//Validar nombre horario - tipo time
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("hora");	
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoTime(), "hora", $hora))
				
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar tipo_movimiento - tipo varchar
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("tipo_movimiento");	
				$tipo_dato->set_MaxLength(30);
				$tipo_dato->set_MinLength(0);
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "tipo_movimiento", $tipo_movimiento))				
				{
					$this->salida = $valid->salida;
					return false;
				}

				//Validar id_lectura_procesada - tipo integer
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("id_lectura_procesada");	
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_MinLength(0);				
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_lectura_procesada", $id_lectura_procesada))				
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
				
					
				//Validar id_historico_lectura - tipo entero
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("id_historico_lectura");	
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_MinLength(0);				
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_historico_lectura", $id_historico_lectura))					
				//if(!$valid->verifica_dato($this->matriz_validacion[0], "id_parametro_general", $id_parametro_general))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar hora - tipo time
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("hora");
												 
				if(!$valid->verifica_dato($tipo_dato->TipoDatoTime(), "hora", $hora))				
				//if(!$valid->verifica_dato($this->matriz_validacion[1], "nombre_atributo", $nombre_atributo))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar tipo_movimiento - tipo varchar
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("tipo_movimiento");	
				$tipo_dato->set_MaxLength(30);
				$tipo_dato->set_MinLength(0);
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "tipo_movimiento", $tipo_movimiento))				
				//if(!$valid->verifica_dato($this->matriz_validacion[2], "valor_atributo", $valor_atributo))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar id_lectura_procesada - tipo integer
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("id_lectura_procesada");	
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_MinLength(0);				
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_lectura_procesada", $id_lectura_procesada))					
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