<?php
/**
 * Nombre de la Clase:	cls_DBMotivoIngreso
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tal_motivo_ingreso
 * Autor:				Jos� A. Mita Huanca
 * Fecha creaci�n:		04-10-2007
 */
class cls_DBMotivoIngreso
{
	//Variable que contiene la salida de la ejecuci�n de la funci�n
	//si la funci�n tuvo error (false), salida contendr� el mensaje de error
	//si la funci�n no tuvo error (true), salida contendr� el resultado, ya sea un conjunto de datos o un mensaje de confirmaci�n
	var $salida;

	//Variable que contedr� la cadena de llamada a las funciones postgres
	var $query;

	//Variables para la ejecuci�n de funciones
	var $var; //middle
	var $nombre_funcion; //nombre de la funci�n a ejecutar
	var $codigo_procedimiento; //codigo del procedimiento a ejecutar

	//Nombre del archivo
	var $nombre_archivo = "cls_DBMotivoIngreso.php";

	//Matriz de par�metros de validaci�n de todas las columnas
	var $matriz_validacion = array();

	//Bandera que indica si los datos se decodificar�n o no
	var $decodificar = false;

	function __construct()
	{
		//Carga en una variable interna la bandera del GET o POST
		$this->decodificar = $decodificar;
	}

	/**
	 * Nombre de la funci�n:	ListarMotivoIngreso
	 * Prop�sito:				Desplegar los registros de tal_motivo_ingreso en funci�n de los par�metros del filtro
	 * Autor:					Jos� A. Mita Huanca
	 * Fecha de creaci�n:		04-10-2007
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
	function ListarMotivoIngreso($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_motivo_ingreso_sel';
		$this->codigo_procedimiento = "'AL_MOTING_SEL'";

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
		$this->var->add_def_cols('id_motivo_ingreso','integer');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('estado_registro','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_cuenta','integer');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarMotivoIngreso
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					Jos� A. Mita Huanca
	 * Fecha de creaci�n:		04-10-2007
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
	function ContarMotivoIngreso($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_motivo_ingreso_sel';
		$this->codigo_procedimiento = "'AL_MOTING_COUNT'";

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
	 * Nombre de la funci�n:	InsertarMotivoIngreso
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_motivo_ingreso
	 * 							con los par�metros requeridos
	 * Autor:					Jos� A. Mita Huanca
	 * Fecha de creaci�n:		04-10-2007
	 * @param unknown_type $id_motivo_ingreso
	 * @param unknown_type $nombre
	 * @param unknown_type $descripcion
	 * @param unknown_type $estado_registro
	 * @param unknown_type $fecha_reg
	 * @param unknown_type $id_cuenta
	 * @return unknown
	 */
	function InsertarMotivoIngreso($id_motivo_ingreso,$nombre,$descripcion,$estado_registro,$fecha_reg,$id_cuenta)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_motivo_ingreso_iud';
		$this->codigo_procedimiento = "'AL_MOTING_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id_motivo_ingreso
		$this->var->add_param("'$nombre'");//nombre
		$this->var->add_param("'$descripcion'");//descripcion
		$this->var->add_param("'$estado_registro'");//estado_registro
		$this->var->add_param("'$fecha_reg'");//fecha_reg
		$this->var->add_param("$id_cuenta");//id_cuenta

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}


	
	/**
	 * Nombre de la funci�n:	ModificarMotivoIngreso
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_motivo_ingreso
	 * 							con los par�metros requeridos
	 * Autor:					Jos� A. Mita Huanca
	 * Fecha de creaci�n:		04-10-2007
	 *
	 * @param unknown_type $id_motivo_ingreso
	 * @param unknown_type $nombre
	 * @param unknown_type $descripcion
	 * @param unknown_type $estado_registro
	 * @param unknown_type $fecha_reg
	 * @param unknown_type $id_cuenta
	 * @return unknown
	 */
	function ModificarMotivoIngreso($id_motivo_ingreso,$nombre,$descripcion,$estado_registro,$fecha_reg,$id_cuenta)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_motivo_ingreso_iud';
		$this->codigo_procedimiento = "'AL_MOTING_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_motivo_ingreso");//id_motivo_ingreso
		$this->var->add_param("'$nombre'");//nombre
		$this->var->add_param("'$descripcion'");//descripcion
		$this->var->add_param("'$estado_registro'");//estado_registro
		$this->var->add_param("'$fecha_reg'");//fecha_reg
		$this->var->add_param("$id_cuenta");//id_cuenta

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}


	/**
	 * Nombre de la funci�n:	EliminarMotivoIngreso
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_motivo_ingreso
	 * 							con los par�metros requeridos
	 * Autor:					Jos� A. Mita Huanca
	 * Fecha de creaci�n:		04-10-2007
	 *
	 * @param unknown_type $id_motivo_ingreso
	 * @return unknown
	 */
	function EliminarMotivoIngreso($id_motivo_ingreso)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_motivo_ingreso_iud';
		$this->codigo_procedimiento = "'AL_MOTING_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_motivo_ingreso");//id_motivo_ingreso
		$this->var->add_param("NULL");//nombre
		$this->var->add_param("NULL");//descripcion
		$this->var->add_param("NULL");//estado_registro
		$this->var->add_param("NULL");//fecha_reg
		$this->var->add_param("NULL");//id_cuenta


		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}


	/**
	 * Nombre de la funci�n:	ValidaMotivoIngreso
	 * Prop�sito:				Realiza una validaci�n de datos del lado del servidor (sin consultar a BD)
	 * Autor:					Jos� A. Mita Huanca
	 * Fecha de creaci�n:		04-10-2007
	 *
	 * @param unknown_type $operacion_sql
	 * @param unknown_type $id_motivo_ingreso
	 * @param unknown_type $nombre
	 * @param unknown_type $descripcion
	 * @param unknown_type $estado_registro
	 * @param unknown_type $fecha_reg
	 * @param unknown_type $id_cuenta
	 * @return unknown
	 */
	function ValidarMotivoIngreso($operacion_sql, $id_motivo_ingreso,$nombre,$descripcion,$estado_registro,$fecha_reg,$id_cuenta)
	{
		//operacion_sql se refiere a que operaci�n validar (por ejemplo: insert, update, delete; podr�an ser otros espec�ficos)

		$this->salida = "";
		$valid = new cls_validacion_serv();

		//Clase para validad el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();

		//Ejecuta la validaci�n por el tipo de operaci�n
		if($operacion_sql=='insert' || $operacion_sql=='update')
		{
			/*******************************Verificaci�n de datos****************************/
			//Verifica que las columnas obligatorias tengan datos, que tenga formato v�lido y un tama�o v�lido
			//Se valida todas las columnas de la tabla

			if($operacion_sql == 'update')
			{
				//Validar id_motivo_ingreso - tipo integer
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("id_motivo_ingreso");
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_MinLength(0);
				$tipo_dato->set_Signo('2');

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_motivo_ingreso", $id_motivo_ingreso))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}
			//Validar nombre - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nombre");
			$tipo_dato->set_MaxLength(70);
			$tipo_dato->set_MinLength(0);

			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "nombre", $nombre))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar descripcion - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(200);
			$tipo_dato->set_MinLength(2);

			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar estado_registro - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_registro");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_MinLength(4);

			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado_registro", $estado_registro))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fecha_rerg - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_reg");
			
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_reg", $fecha_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_cuenta - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_cuenta");
			$tipo_dato->set_MaxLength(15);
			$tipo_dato->set_MinLength(0);
			$tipo_dato->set_Signo('2');

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cuenta", $id_cuenta))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_motivo_ingreso - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_motivo_ingreso");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_MinLength(0);
			$tipo_dato->set_Signo('2');

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_motivo_ingreso", $id_motivo_ingreso))
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