<?php
/**
 * Nombre de la Clase:	cls_DBFecha
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tpm_fecha
 * Autor:				Grover Velasquez Colque
 * Fecha creaci�n:		24-01-2008
 */

class cls_DBFecha
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
	var $nombre_archivo = "cls_DBFecha.php";

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
	 * Nombre de la funci�n:	ListarFecha
	 * Prop�sito:				Desplegar los registros de tpm_fecha en funci�n de los par�metros del filtro
	 * Autor:					Grover Velasquez Colque
	 * Fecha de creaci�n:		14-08-2007
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
	function ListarFecha($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_fecha_sel';
		$this->codigo_procedimiento = "'PM_FECHAS_SEL'";

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
		$this->var->add_param($func->iif($id_financiador == '',"'%'","'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'","'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'","'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'","'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'","'$id_actividad'"));//id_actividad

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_fecha','integer');
		$this->var->add_def_cols('fecha','date');
		$this->var->add_def_cols('tipo_fecha','numeric(2,0)');
		$this->var->add_def_cols('desc_fecha','varchar(200)');
		$this->var->add_def_cols('id_lugar','integer');
		$this->var->add_def_cols('nombre','varchar(200)');
		$this->var->add_def_cols('dia_literal','text');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarFecha
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					Grover Velasquez Colque
	 * Fecha de creaci�n:		14-08-2007
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
	function ContarFecha($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_fecha_sel';
		$this->codigo_procedimiento = "'PM_FECHAS_COUNT'";

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
		$this->var->add_param($func->iif($id_financiador == '',"'%'","'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'","'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'","'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'","'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'","'$id_actividad'"));//id_actividad

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
	 * Nombre de la funci�n:	InsertarFecha
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpm_fecha,
	 * 							con los par�metros requeridos
	 * Autor:					Grover Velasquez Colque
	 * Fecha de creaci�n:		14-08-2007
	 *
	 * @param unknown_type $id_fecha
	 * @param unknown_type $id_param
	 * @param unknown_type $fecha
	 * @param unknown_type $tipo_fecha
	 * @param unknown_type $desc_fecha	
	 * @return unknown
	 */
	function InsertarFecha($id_fecha, $fecha, $tipo_fecha, $desc_fecha, $id_lugar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_fecha_iud';
		$this->codigo_procedimiento = "'PM_FECHAS_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id de fecha
		$this->var->add_param("'$fecha'");//fecha
		$this->var->add_param("$tipo_fecha");//estado de la fecha
		$this->var->add_param("'$desc_fecha'");//descripcion de la fecha		
		$this->var->add_param("$id_lugar");//id de lugar
		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	ModificarFecha
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpm_fecha
	 * con los par�metros requeridos
	 * Autor:					Grover Velasquez Colque
	 * Fecha de creaci�n:		14-08-2007
	 *
	 * @param unknown_type $id_fecha
	 * @param unknown_type $id_param
	 * @param unknown_type $id_cuenta
	 * @param unknown_type $desc_fecha
	 * @param unknown_type $importe_garantia
	 * @param unknown_type $estado
	 * @return unknown
	 */
	function ModificarFecha($id_fecha, $fecha, $tipo_fecha, $desc_fecha, $id_lugar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_fecha_iud';
		$this->codigo_procedimiento = "'PM_FECHAS_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_fecha");//id de fecha
		$this->var->add_param("'$fecha'");//fecha
		$this->var->add_param("$tipo_fecha");//tipo_fecha
		$this->var->add_param("'$desc_fecha'");//descripcion de la fecha	
		$this->var->add_param("$id_lugar");//id de lugar		
		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	EliminarFecha
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpm_fecha
	 * con los par�metros requeridos
	 * Autor:					Grover Velasquez Colque
	 * Fecha de creaci�n:		14-08-2007
	 *
	 * @param unknown_type $id_fecha
	 * @return unknown
	 */
	function EliminarFecha($id_fecha)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_fecha_iud';
		$this->codigo_procedimiento = "'PM_FECHAS_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)

		$this->var->add_param("$id_fecha");//id de fecha
		$this->var->add_param("NULL");//fecha
		$this->var->add_param("NULL");//tipo fecha
		$this->var->add_param("NULL");//descripcion de la fecha		
		$this->var->add_param("NULL");//id_lugar
		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	ValidarFecha
	 * Prop�sito:				Realiza una validaci�n de datos del lado del servidor (sin consultar a BD)
	 * Autor:					Grover Velasquez Colque
	 * Fecha creaci�n:			14-08-2007
	 *
	 * @param unknown_type $operacion_sql
	 * @param unknown_type $id_fecha
	 * @param unknown_type $id_param
	 * @param unknown_type $id_cuenta
	 * @param unknown_type $desc_fecha
	 * @param unknown_type $importe_garantia
	 * @param unknown_type $estado
	 * @return unknown
	 */
	function ValidarFecha($operacion_sql, $id_fecha, $fecha, $tipo_fecha, $desc_fecha)
	{
		//operacion_sql se refiere a que operaci�n validar (por ejemplo: insert, update, delete; podr�an ser otros espec�ficos)

		$this->salida = "";
		$valid = new cls_validacion_serv();

		//Clase para validad el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();

		//Ejecuta la validaci�n por el tipo de operaci�n
		switch ($operacion_sql) {
			case 'insert' or 'update':

				/*******************************Verificaci�n de datos****************************/
				//Verifica que las columnas obligatorias tengan datos, que tenga formato v�lido y un tama�o v�lido
				//Se valida todas las columnas de la tabla

				if($operacion_sql == 'update')
				{
					//Validar id_fecha - tipo integer
					$tipo_dato->_reiniciar_valor();
					$tipo_dato->set_Columna("id_fecha");
					$tipo_dato->set_MaxLength(15);
					$tipo_dato->set_MinLength(0);
					$tipo_dato->set_Signo('2');

					if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_fecha", $id_fecha))
					{
						$this->salida = $valid->salida;
						return false;
					}
				}

				//Validar id_cuenta - tipo integer
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("fecha");
				$tipo_dato->set_MaxLength(15);
				$tipo_dato->set_MinLength(0);
				$tipo_dato->set_Signo('2');

				if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha", $fecha))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar importe_fecha - tipo numeric
				/*$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("tipo_fecha");
				$tipo_dato->set_MaxLength(2);
				$tipo_dato->set_MinLength(0);
				$tipo_dato->set_Signo('2');

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "tipo_fecha", $tipo_fecha))
				{
					$this->salida = $valid->salida;
					return false;
				}*/

				//Validar desc_fecha - tipo varchar
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("desc_fecha");
				$tipo_dato->set_MaxLength(100);
				$tipo_dato->set_MinLength(0);

				if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "desc_fecha", $desc_fecha))
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
				return false;
				break;
		}
	}
}?>