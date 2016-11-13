<?php
/**
 * Nombre de la Clase:	cls_DBCaracteristicaItem.php
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tal_caracteristicas_item
 * Autor:				Susana Castro Guaman
 * Fecha creaci�n:		28-09-2007
 */
class cls_DBCaracteristicaItem
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
	var $nombre_archivo = "cls_DBCaracteristicaItem.php";

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
	 * Nombre de la funci�n:	ListarCaracteristicasItem
	 * Prop�sito:				Desplegar los registros de tal_caracteristica_item en funci�n de los par�metros del filtro
	 * Autor:				    Rodrigo Chumacero Moscoso
	 * Fecha de creaci�n:		28-09-2007
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
	function ListarCaracteristicaItem($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_caracteristica_item_sel';
		$this->codigo_procedimiento = "'AL_CARITE_SEL'";

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
		$this->var->add_def_cols('id_caracteristica_item','integer');
		$this->var->add_def_cols('valor','varchar');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_item','integer');
		$this->var->add_def_cols('id_caracteristica','integer');
		$this->var->add_def_cols('id_unidad_medida_base','integer');
		$this->var->add_def_cols('desc_item','varchar');
		$this->var->add_def_cols('desc_caracteristica','varchar');
		$this->var->add_def_cols('desc_unidad_medida_base','varchar');
		$this->var->add_def_cols('desc_tipo_caracteristica','varchar');
		

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarCaracteristicaItem
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:				    Rodrigo Chumacero Moscoso
	 * Fecha de creaci�n:		28-09-2007
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
	function ContarCaracteristicaItem($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_caracteristica_item_sel';
		$this->codigo_procedimiento = "'AL_CARITE_COUNT'";

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
	 * Nombre de la funci�n:	InsertarCaracteristicaItem
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_caracteristica_item
	 * 							con los par�metros requeridos
	 * Autor:				    Rodrigo Chumacero Moscoso
	 * Fecha de creaci�n:		28-09-2007
	 *
	 * @param unknown_type $id_caracteristica_item
	 * @param unknown_type $codigo
	 * @param unknown_type $valor
	 * @param unknown_type $observaciones
	 * @param unknown_type $id_item
	 * @param unknown_type $id_caracteristica
	 * @param unknown_type $id_unidad_medida_base
	 * @param unknown_type $fecha_reg
	 * @return unknown
	 */
	function InsertarCaracteristicaItem($id_caracteristica_item,$valor,$observaciones,$fecha_reg,$id_item,$id_caracteristica,$id_unidad_medida_base)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_caracteristica_item_iud';
		$this->codigo_procedimiento = "'AL_CARITE_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");
		$this->var->add_param("'$valor'");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param("$id_item");
		$this->var->add_param("$id_caracteristica");
		$this->var->add_param("$id_unidad_medida_base");
		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	ModificarCaracteristicaItem
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_caracteristica_item
	 * 							con los par�metros requeridos
	 * Autor:				    Rodrigo Chumacero Moscoso
	 * Fecha de creaci�n:		28-09-2007
	 *
	 * @param unknown_type $id_caracteristica_item
	 * @param unknown_type $codigo
	 * @param unknown_type $valor
	 * @param unknown_type $observaciones
	 * @param unknown_type $id_item
	 * @param unknown_type $id_caracteristica
	 * @param unknown_type $id_unidad_medida_base
	 * @param unknown_type $fecha_reg
	 * @return unknown
	 */
	function ModificarCaracteristicaItem($id_caracteristica_item,$valor,$observaciones,$fecha_reg,$id_item,$id_caracteristica,$id_unidad_medida_base)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_caracteristica_item_iud';
		$this->codigo_procedimiento = "'AL_CARITE_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_caracteristica_item");
		$this->var->add_param("'$valor'");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param("$id_item");
		$this->var->add_param("$id_caracteristica");
		$this->var->add_param("$id_unidad_medida_base");
		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	EliminarCaracteristicaItem
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_caracteristica_item
	 * 							con los par�metros requeridos
	 * Autor:				    Rodrigo Chumacero Moscoso
	 * Fecha de creaci�n:		28-09-2007
	 *
	 * @param unknown_type $id_caracteristica_item
	 * @return unknown
	 */
	function EliminarCaracteristicaItem($id_caracteristica_item)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_caracteristica_item_iud';
		$this->codigo_procedimiento = "'AL_CARITE_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_caracteristica_item");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
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

	/**
	 * Nombre de la funci�n:	ValidarCaracteristicaItem
	 * Prop�sito:				Realiza una validaci�n de datos del lado del servidor (sin consultar a BD)
	 * Autor:				    Rodrigo Chumacero Moscoso
	 * Fecha de creaci�n:		28-09-2007
	 *
	 * @param unknown_type $operacion_sql
	 * @param unknown_type $id_caracteristica_item
	 * @param unknown_type $codigo
	 * @param unknown_type $valor
	 * @param unknown_type $observaciones
	 * @param unknown_type $id_item
	 * @param unknown_type $id_caracteristica
	 * @param unknown_type $id_unidad_medida_base
	 * @param unknown_type $fecha_reg
	 * @return unknown
	 */
	function ValidarCaracteristicaItem($operacion_sql,$id_caracteristica_item,$valor,$observaciones,$fecha_reg,$id_item,$id_caracteristica,$id_unidad_medida_base)
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
				//Validar id_caracteristica_item - tipo integer
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("id_caracteristica_item");
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_MinLength(0);
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_caracteristica_item", $id_caracteristica_item))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}
			
			//Validar valor - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("valor");
			$tipo_dato->set_MaxLength(1200);
			$tipo_dato->set_MinLength(0);

			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "valor", $valor))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar observaciones - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("observaciones");
			$tipo_dato->set_MaxLength(300);
			$tipo_dato->set_MinLength(0);

			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "observaciones", $observaciones))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fecha_reg - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_reg");
            $tipo_dato->set_AllowBlank("true");			
			
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_reg", $fecha_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_item - tipo integer
			/*
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_item");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_MinLength(0);

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_item", $id_item))
			{
				$this->salida = $valid->salida;
				return false;
			}
			*/
			//Validar id_caracteristica - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_caracteristica");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_MinLength(0);

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_caracteristica", $id_caracteristica))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar id_unidad_medida_base - tipo integer
//			$tipo_dato->_reiniciar_valor();
//			$tipo_dato->set_Columna("id_unidad_medida_base");
//			$tipo_dato->set_MaxLength(10);
//			$tipo_dato->set_MinLength(0);
//
//			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_unidad_medida_base", $id_unidad_medida_base))
//			{
//				$this->salida = $valid->salida;
//				return false;
//			}
//
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_caracteristica_item - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_caracteristica_item");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_MinLength(0);
			
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_caracteristica_item", $id_caracteristica_item))
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