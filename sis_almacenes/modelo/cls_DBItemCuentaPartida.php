<?php
/**
 * Nombre de la Clase:	cls_DBItemCuentaPartida
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tal_item_cuenta_partida
 * Autor:				Fernando Prudencio Cardona
 * Fecha creaci�n:		28-09-2007
 */
class cls_DBItemCuentaPartida
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
	var $nombre_archivo = "cls_DBItemCuentaPartida.php";

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
	 * Nombre de la funci�n:	ListarItemCuentaPartida
	 * Prop�sito:				Desplegar los registros de tal_item_cuenta_partida en funci�n de los par�metros del filtro
	 * Autor:				    Fernando Prudencio Cardona
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
	function ListarItemCuentaPartida($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_item_cuenta_partida_sel';
		$this->codigo_procedimiento = "'AL_ICUPAR_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = "'$cant'";
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
		$this->var->add_def_cols('id_item_cuenta_partida','integer');//0
		$this->var->add_def_cols('nivel','integer');//1
		$this->var->add_def_cols('id_gral','integer');//2
		$this->var->add_def_cols('id_supergrupo','integer');//3
		$this->var->add_def_cols('nombre_supgru','varchar');//4
		$this->var->add_def_cols('id_grupo','integer');//5
		$this->var->add_def_cols('nombre_grupo','varchar');
		$this->var->add_def_cols('id_subgrupo','integer');//7
		$this->var->add_def_cols('nombre_subgrupo','varchar');
		$this->var->add_def_cols('id_id1','integer');//9
		$this->var->add_def_cols('nombre_id1','varchar');
		$this->var->add_def_cols('id_id2','integer');
		$this->var->add_def_cols('nombre_id2','varchar');
		$this->var->add_def_cols('id_id3','integer');
		$this->var->add_def_cols('nombre_id3','varchar');//14
		$this->var->add_def_cols('desc_item_cuenta_partida','text');
		$this->var->add_def_cols('id_cuenta','integer');
		$this->var->add_def_cols('nombre_cuenta','text');
		$this->var->add_def_cols('id_partida','integer');
		$this->var->add_def_cols('nombre_partida','text');
        $this->var->add_def_cols('fecha_reg','date');//20
        $this->var->add_def_cols('id_gestion','integer');
        $this->var->add_def_cols('gestion','numeric');
        $this->var->add_def_cols('id_cuenta_gasto','integer');
        $this->var->add_def_cols('desc_cuenta_gasto','text');
        $this->var->add_def_cols('id_presupuesto','integer');
        $this->var->add_def_cols('desc_presupuesto','text');//26
        $this->var->add_def_cols('id_auxiliar_activo','integer');
        $this->var->add_def_cols('desc_auxiliar_activo','text');
        $this->var->add_def_cols('id_auxiliar_gasto','integer');
        $this->var->add_def_cols('desc_auxiliar_gasto','text');
        $this->var->add_def_cols('detalle_usado','varchar');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
			
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//echo $this->query;exit;
		
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarItem
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
	function ContarItemCuentaPartida($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_item_cuenta_partida_sel';
		$this->codigo_procedimiento = "'AL_ICUPAR_COUNT'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = "'$cant'";
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
	 * Nombre de la funci�n:	InsertarParametrosAlmacen
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_item,
	 * 							con los par�metros requeridos
	 * Autor:				    Rodrigo Chumacero Moscoso
	 * Fecha de creaci�n:		28-09-2007
	 *
	 * @param unknown_type $id_item
	 * @param unknown_type $codigo
	 * @param unknown_type $descripcion
	 * @param unknown_type $precio_venta_almacen
	 * @param unknown_type $costo_estimado
	 * @param unknown_type $costo_almacen
	 * @param unknown_type $stock_min
	 * @param unknown_type $stock_total
	 * @param unknown_type $observaciones
	 * @param unknown_type $nivel_convertido
	 * @param unknown_type $estado_item
	 * @param unknown_type $estado_registro
	 * @param unknown_type $fecha_reg
	 * @param unknown_type $id_unidad_medida_base
	 * @param unknown_type $id_id3
	 * @param unknown_type $id_id2
	 * @param unknown_type $id_id1
	 * @param unknown_type $id_subgrupo
	 * @param unknown_type $id_grupo
	 * @param unknown_type $id_supergrupo
	 * @param unknown_type $nombre
	 * @return unknown
	 */
	function InsertarItemCuentaPartida($id_item_cuenta_partida,$nivel,$id_material,$id_cuenta,$id_partida,$id_gestion,$id_cuenta_gasto,$id_presupuesto,$id_auxiliar_activo,$id_auxiliar_gasto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_item_cuenta_partida_iud';
		$this->codigo_procedimiento = "'AL_ICUPAR_INS'";
		
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id_item
		$this->var->add_param("$nivel");//codigo
		$this->var->add_param("$id_material");//descripcion
		$this->var->add_param("$id_cuenta");//precio_venta_almacen
		$this->var->add_param("$id_partida");//costo_estimado
		$this->var->add_param("$id_gestion");//costo_estimado
		$this->var->add_param("$id_cuenta_gasto");//costo_estimado
		$this->var->add_param("$id_presupuesto");//costo_estimado
		$this->var->add_param("$id_auxiliar_activo");//costo_estimado
		$this->var->add_param("$id_auxiliar_gasto");//costo_estimado
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}


	/**
	 * Nombre de la funci�n:	ModificarParametrosAlmacen
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_item
	 * 							con los par�metros requeridos
	 * Autor:				    Rodrigo Chumacero Moscoso
	 * Fecha de creaci�n:		28-09-2007
	 *
	 * @param unknown_type $id_parametros_almacen
	 * @param unknown_type $dias_reserva
	 * @param unknown_type $cierre
	 * @param unknown_type $gestion
	 * @param unknown_type $bloqueado
	 * @param unknown_type $actualizar
	 * @param unknown_type $observaciones
	 * @param unknown_type $id_cuenta
	 * @return unknown
	 */
	function ModificarItemCuentaPartida($id_item_cuenta_partida,$nivel,$id_material,$id_cuenta,$id_partida,$id_gestion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_item_cuenta_partida_iud';
		$this->codigo_procedimiento = "'AL_ICUPAR_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_item_cuenta_partida");//id_item
		$this->var->add_param("$nivel");//codigo
		$this->var->add_param("$id_material");//descripcion
		$this->var->add_param("$id_cuenta");//precio_venta_almacen
		$this->var->add_param("$id_partida");//costo_estimado
        $this->var->add_param("$id_gestion");//costo_estimado
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}



	/**
	 * Nombre de la funci�n:	EliminarParametrosAlmacen
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_item
	 * 							con los par�metros requeridos
	 * Autor:				    Rodrigo Chumacero Moscoso
	 * Fecha de creaci�n:		28-09-2007
	 *
	 * @param unknown_type $id_parametros_almacen
	 * @return unknown
	 */
	function EliminarItemCuentaPartida($id_item_cuenta_partida)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_item_cuenta_partida_iud';
		$this->codigo_procedimiento = "'AL_ICUPAR_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_item_cuenta_partida");//id_item
		$this->var->add_param("NULL");//codigo
		$this->var->add_param("NULL");//descripcion
		$this->var->add_param("NULL");//precio_venta_almacen
		$this->var->add_param("NULL");//costo_estimado
		$this->var->add_param("NULL");//costo_estimado
		$this->var->add_param("NULL");//costo_estimado
		$this->var->add_param("NULL");//costo_estimado
		$this->var->add_param("NULL");//costo_estimado
		$this->var->add_param("NULL");//costo_estimado
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}


	/**
	 * Nombre de la funci�n:	ValidaParametrosAlmacen
	 * Prop�sito:				Realiza una validaci�n de datos del lado del servidor (sin consultar a BD)
	 * Autor:				    Rodrigo Chumacero Moscoso
	 * Fecha de creaci�n:		28-09-2007
	 *
	 * @param unknown_type $operacion_sql
	 * @param unknown_type $id_parametros_almacen
	 * @param unknown_type $dias_reserva
	 * @param unknown_type $cierre
	 * @param unknown_type $gestion
	 * @param unknown_type $bloqueado
	 * @param unknown_type $actualizar
	 * @param unknown_type $observaciones
	 * @param unknown_type $id_cuenta
	 * @return unknown
	 */
	function ValidarItemCuentaPartida($operacion_sql,$id_item_cuenta_partida,$nivel,$id_material,$id_cuenta,$id_partida,$id_gestion,$id_cuenta_gasto,$id_presupuesto,$id_auxiliar_activo,$id_auxiliar_gasto)
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
				//Validar id_item - tipo integer
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("id_item_cuenta_partida");
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_MinLength(0);
				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_item_cuenta_partida",$id_item_cuenta_partida))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar codigo - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nivel");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "nivel", $nivel))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar descripcion - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_material");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_MinLength(0);

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_material", $id_material))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar precio_venta_almacen - tipo num�rico
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_cuenta");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_MinLength(0);

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cuenta", $id_cuenta))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar costo_estimado - tipo numerico
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_partida");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_partida", $id_partida))
			{
				$this->salida = $valid->salida;
				return false;
			}
		//Validar costo_estimado - tipo numerico
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_gestion");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_gestion", $id_gestion))
			{
				$this->salida = $valid->salida;
				return false;
			}
		   //Validar costo_estimado - tipo numerico
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_cuenta_gasto");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cuenta_gasto", $id_cuenta_gasto))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validar costo_estimado - tipo numerico
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_presupuesto");
			$tipo_dato->set_AllowBlank(false);	
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_presupuesto", $id_presupuesto))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validar costo_estimado - tipo numerico
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_auxiliar_activo");
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_auxiliar_activo", $id_auxiliar_activo))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validar costo_estimado - tipo numerico
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_auxiliar_gasto");
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_auxiliar_gasto", $id_auxiliar_gasto))
			{
				$this->salida = $valid->salida;
				return false;
			}		
		//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_item - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_item_cuenta_partida");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_MinLength(0);

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_item_cuenta_partida", $id_item_cuenta_partida))
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
	
	function ListarNivel($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_item_cuenta_partida_sel';
		$this->codigo_procedimiento = "'AL_NIVEL_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = "'$cant'";
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
		$this->var->add_def_cols('nombre','varchar');//0
	
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
			
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//echo $this->query;exit;
		return $res;
	}

}?>
