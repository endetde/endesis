<?php
/**
 * Nombre de la Clase:	cls_DBWebService
 * Prop�sito:			Permite ejecutar la funcionalidad de web services
 * Autor:				Ana Maria Villegas Quispe
 * Fecha creaci�n:		15-10-2014
 *
 */
class cls_DBWebService
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
	var $nombre_archivo = "cls_DBWebService.php";

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
	 * Nombre de la funci�n:	ListarPensamientoDia
	 * Prop�sito:				Desplegar los registros de com_pensamiento_dia
	 * Autor:					Morgan Huascar Checa Lopez
	 * Fecha de creaci�n:		14-05-2013
	 *
	 */
	function ListarUsuarios($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'comunidad.f_com_acceso_webservice_sel';
		$this->codigo_procedimiento = "'CO_USUARIOS_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

	
		$this->var->add_def_cols('nombre_completo','TEXT');
		$this->var->add_def_cols('id_usuario',' INTEGER');
		$this->var->add_def_cols('id_persona',' INTEGER');
		$this->var->add_def_cols('login',' VARCHAR(60)');
		$this->var->add_def_cols('contrasenia',' VARCHAR(200)');
		$this->var->add_def_cols('fecha_registro','DATE');
		$this->var->add_def_cols('hora_registro',' TIME');
		$this->var->add_def_cols('fecha_ultima_modificacion','DATE');
		$this->var->add_def_cols('hora_ultima_modificacion',' TIME');
		$this->var->add_def_cols('estado_usuario','VARCHAR(12)');
		$this->var->add_def_cols('estilo_usuario','VARCHAR(50)');
		$this->var->add_def_cols('filtro_avanzado','VARCHAR(6)');
		$this->var->add_def_cols('fecha_expiracion','DATE');
		$this->var->add_def_cols('autentificacion','VARCHAR(10)');
		$this->var->add_def_cols('id_nivel_seguridad','INTEGER');
		$this->var->add_def_cols('login_nuevo','VARCHAR(70)');
		$this->var->add_def_cols('login_anterior','VARCHAR(20)');
		$this->var->add_def_cols('usuario_reg','VARCHAR');
		$this->var->add_def_cols('fecha_inactivacion','DATE');
		$this->var->add_def_cols('id_rol',' INTEGER');
		//Carga la definici�n de columnas con sus tipos de datos
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;*/
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarSistemas
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					Morgan Huascar checa Lopez
	 * Fecha de creaci�n:		15-05-2013
	 *
	 */
	/*function ContarSistemas($cant ,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'comunidad.f_com_sistema_informatico_administracion_sel';
		$this->codigo_procedimiento = "'CO_SISTINF_COUNT'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
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

		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	
	
	/**
	 * Nombre de la funci�n:	InsertarSistemas
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla comunidad.com_sistema_informatico
	 * Autor:				    (Morgan Huascar Checa Lopez)
	 * Fecha de creaci�n:		15-05-2013
	 * Descripci�n:             
	
	 */
	/*function InsertarSistemas($id_sistema,$nombre_sistema,$enlace_sistema, $sistema)
	{
		$this->salida = "";
		$this->nombre_funcion = 'comunidad.f_com_sistema_informatico_administracion_iud';
		$this->codigo_procedimiento = "'CO_SISTINF_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param(0);
		$this->var->add_param("'$nombre_sistema'");
		$this->var->add_param("'$enlace_sistema'");
		$this->var->add_param("'$sistema'");
	
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();
		
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	
	/**
	 * Nombre de la funci�n:	ModificarSistemas
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_TipoObligacion
	 * Autor:				    Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		11-08-2010
	 */
	/*function ModificarSistemas($id_sistema,$nombre_sistema,$enlace_sistema, $sistema)
	{
		$this->salida = "";
		$this->nombre_funcion = 'comunidad.f_com_sistema_informatico_administracion_iud';
		$this->codigo_procedimiento = "'CO_SISTINF_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		//$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_sistema);
		$this->var->add_param("'$nombre_sistema'");
		$this->var->add_param("'$enlace_sistema'");
		$this->var->add_param("'$sistema'");
	
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	
	/**
	 * Nombre de la funci�n:	EliminarSistemas
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla com_sistema_informatico
	 * Autor:				    Morgan Huascar Checa Lopez
	 * Fecha de creaci�n:		15-05-2013
	 */
	/*function EliminarSistemas($id_sistema_informatico)
	{
		$this->salida = "";
		$this->nombre_funcion = 'comunidad.f_com_sistema_informatico_administracion_iud';
		$this->codigo_procedimiento = "'CO_SISTINF_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_sistema_informatico);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");

		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	*/
	
	
}
?>