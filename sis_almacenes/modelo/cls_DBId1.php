<?php
/**
 * Nombre de la Clase:	cls_DBId1
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tal_id1
 * Autor:				Fernando Prudencio Cardona
 * Fecha creaci�n:		28-09-2007
 */
class cls_DBId1
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
	var $nombre_archivo = "cls_DBId1.php";

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
	 * Nombre de la funci�n:	ListarId1
	 * Prop�sito:				Desplegar los registros de tal_id1 en funci�n de los par�metros del filtro
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
	function ListarId1($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_id1_sel';
		$this->codigo_procedimiento = "'AL_IDENT1_SEL'";

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
		$this->var->add_def_cols('id_id1','integer');
		$this->var->add_def_cols('codigo','varchar');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('nivel_convertido','varchar');
		$this->var->add_def_cols('convertido','varchar');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('estado_registro','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_subgrupo','integer');
		$this->var->add_def_cols('id_grupo','integer');
		$this->var->add_def_cols('id_supergrupo','integer');
		$this->var->add_def_cols('desc_subgrupo','varchar');
		$this->var->add_def_cols('desc_grupo','varchar');
		$this->var->add_def_cols('desc_supergrupo','varchar');
		$this->var->add_def_cols('registro','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarId1
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
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
	function ContarId1($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_id1_sel';
		$this->codigo_procedimiento = "'AL_IDENT1_COUNT'";

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
///////////////////////////////////////////////////////////////////////////
/**
	 * Nombre de la funci�n:	ListarGrupoAlmacen
	 * Prop�sito:				Desplegar los registros de tal_grupo en funci�n de los par�metros del filtro
	 * Autor:					Susana Castro G.
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
	function ListarId1Almacen($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_id1_sel';
		$this->codigo_procedimiento = "'AL_ID1AL_SEL'";

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
		$this->var->add_def_cols('id_id1','integer');
		$this->var->add_def_cols('codigo','varchar');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('nivel_convertido','varchar');
		$this->var->add_def_cols('convertido','varchar');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('estado_registro','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_subgrupo','integer');
		$this->var->add_def_cols('id_grupo','integer');
		$this->var->add_def_cols('id_supergrupo','integer');
		$this->var->add_def_cols('desc_subgrupo','varchar');
		$this->var->add_def_cols('desc_grupo','varchar');
		$this->var->add_def_cols('desc_supergrupo','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarGrupo
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					Susana Castro G.
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
	function ContarId1Almacen($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_id1_sel';
		$this->codigo_procedimiento = "'AL_ID1AL_COUNT'";

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
//////////////////////////////////////////////////////////////////////////
	/**
	 * Nombre de la funci�n:	InsertarId1
	 * Prop�sito:				Insertar registros en la tabla tal_id1
	 * Autor:					Fernando Prudencio Cardona
	 * Fecha Creaci�n:			29-09-2007
	 *
	 * @param unknown_type $id_id_1
	 * @param unknown_type $codigo
	 * @param unknown_type $nombre
	 * @param unknown_type $descripcion
	 * @param unknown_type $nivel_convertido
	 * @param unknown_type $convertido
	 * @param unknown_type $observaciones
	 * @param unknown_type $estado_registro
	 * @param unknown_type $fecha_reg
	 * @param unknown_type $id_subgrupo
	 * @param unknown_type $id_grupo
	 * @param unknown_type $id_supergrupo
	 * @return unknown
	 */
	function InsertarId1($id_id1,$codigo,$nombre,$descripcion,$nivel_convertido,$convertido,$observaciones,$estado_registro,$fecha_reg,$id_subgrupo,$id_grupo,$id_supergrupo,$id_unidad_medida_base,$costo_estimado,$precio_estimado,$stock_min,$registro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_id1_iud';
		$this->codigo_procedimiento = "'AL_IDENT1_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id_id1
		$this->var->add_param("'$codigo'");//codigo
		$this->var->add_param("'$nombre'");//nombre
		$this->var->add_param("'$descripcion'");//descripcion
		$this->var->add_param("'$nivel_convertido'");//precio_venta_almacen
		$this->var->add_param("'$convertido'");//costo_estimado
		$this->var->add_param("'$observaciones'");//observaciones
		$this->var->add_param("'$estado_registro'");//estado_registro
		$this->var->add_param("'$fecha_reg'");//fecha_reg
		$this->var->add_param("$id_subgrupo");//id_subgrupo
		$this->var->add_param("$id_grupo");//id_grupo
		$this->var->add_param("$id_supergrupo");//id_supergrupo
		$this->var->add_param("$id_unidad_medida_base");//id_unidad_de_medida_base
		$this->var->add_param("$costo_estimado");//costo_estimado
		$this->var->add_param("$precio_estimado");//precio_estimado
		$this->var->add_param("$stock_min");//stock_min
		$this->var->add_param("'$registro'");//registro
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

/**
 * Nombre de la funci�n:	ModificarId1
 * Prop�sito:				Actualizar registros de la tabla tal_id1
 * Autor:					Fernando Prudencio Cardona
 * Fecha Creaci�n:			29-09-2007
 *
 * @param unknown_type $id_id_1
 * @param unknown_type $codigo
 * @param unknown_type $nombre
 * @param unknown_type $descripcion
 * @param unknown_type $nivel_convertido
 * @param unknown_type $convertido
 * @param unknown_type $observaciones
 * @param unknown_type $estado_registro
 * @param unknown_type $fecha_reg
 * @param unknown_type $id_subgrupo
 * @param unknown_type $id_grupo
 * @param unknown_type $id_supergrupo
 * @return unknown
 */

	function ModificarId1($id_id1,$codigo,$nombre,$descripcion,$nivel_convertido,$convertido,$observaciones,$estado_registro,$fecha_reg,$id_subgrupo,$id_grupo,$id_supergrupo,$id_unidad_medida_base,$costo_estimado,$precio_estimado,$stock_min)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_id1_iud';
		$this->codigo_procedimiento = "'AL_IDENT1_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_id1");//id_id1
		$this->var->add_param("'$codigo'");//codigo
		$this->var->add_param("'$nombre'");//nombre
		$this->var->add_param("'$descripcion'");//descripcion
		$this->var->add_param("'$nivel_convertido'");//precio_venta_almacen
		$this->var->add_param("'$convertido'");//costo_estimado
		$this->var->add_param("'$observaciones'");//observaciones
		$this->var->add_param("'$estado_registro'");//estado_registro
		$this->var->add_param("'$fecha_reg'");//fecha_reg
		$this->var->add_param("$id_subgrupo");//id_subgrupo
		$this->var->add_param("$id_grupo");//id_grupo
		$this->var->add_param("$id_supergrupo");//id_supergrupo
		$this->var->add_param("$id_unidad_medida_base");//id_unidad_de_medida_base
		$this->var->add_param("$costo_estimado");//costo_estimado
		$this->var->add_param("$precio_estimado");//precio_estimado
		$this->var->add_param("$stock_min");//stock_min
		$this->var->add_param("NULL");//registro

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}



	/**
	 * Nombre de la funci�n:	EliminarId1
	 * Prop�sito:				Permite eliminar registros de la tabla tal_id1
	 * Autor:					Fernando Prudencio Cardona
	 * Fecha Creaci�n:			29-09-2007
	 *
	 * @param unknown_type $id_id1
	 * @return unknown
	 */
	function EliminarId1($id_id1)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_id1_iud';
		$this->codigo_procedimiento = "'AL_IDENT1_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_id1");//id_id1
		$this->var->add_param("NULL");//codigo
		$this->var->add_param("NULL");//nombre
		$this->var->add_param("NULL");//descripcion
		$this->var->add_param("NULL");//nivel_convertido
		$this->var->add_param("NULL");//convertido
		$this->var->add_param("NULL");//observaciones
		$this->var->add_param("NULL");//estado_registro
		$this->var->add_param("NULL");//fecha_reg
		$this->var->add_param("NULL");//id_subgrupo
		$this->var->add_param("NULL");//id_grupo
		$this->var->add_param("NULL");//id_supergrupo
		$this->var->add_param("NULL");//id_unidad_de_medida_base
		$this->var->add_param("NULL");//costo_estimado
		$this->var->add_param("NULL");//precio_estimado
		$this->var->add_param("NULL");//stock_min
		$this->var->add_param("NULL");//registro
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	/**
	 * Nombre funci�n:		CrearItem
	 * Prop�sito:			Convierte un material a Item
	 * Autor:				Fernando Prudencio Cardona
	 * Fecha:				01-10-2007
	 *
	 * @param unknown_type $id_id1
	 * @param unknown_type $codigo
	 * @param unknown_type $nombre
	 * @param unknown_type $descripcion
	 * @param unknown_type $nivel_convertido
	 * @param unknown_type $convertido
	 * @param unknown_type $observaciones
	 * @param unknown_type $estado_registro
	 * @param unknown_type $fecha_reg
	 * @param unknown_type $id_subgrupo
	 * @param unknown_type $id_grupo
	 * @param unknown_type $id_supergrupo
	 * @return unknown
	 */
	function CrearItemId1($id_id1,$codigo,$nombre,$descripcion,$nivel_convertido,$convertido,$observaciones,$estado_registro,$fecha_reg,$id_subgrupo,$id_grupo,$id_supergrupo,$id_unidad_medida_base,$costo_estimado,$precio_estimado,$stock_min)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_id1_iud';
		$this->codigo_procedimiento = "'AL_IDENT1_CIT'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_id1");//id_id1
		$this->var->add_param("'$codigo'");//codigo
		$this->var->add_param("'$nombre'");//nombre
		$this->var->add_param("'$descripcion'");//descripcion
		$this->var->add_param("'$nivel_convertido'");//precio_venta_almacen
		$this->var->add_param("'$convertido'");//costo_estimado
		$this->var->add_param("'$observaciones'");//observaciones
		$this->var->add_param("'$estado_registro'");//estado_registro
		$this->var->add_param("'$fecha_reg'");//fecha_reg
		$this->var->add_param("$id_subgrupo");//id_subgrupo
		$this->var->add_param("$id_grupo");//id_grupo
		$this->var->add_param("$id_supergrupo");//id_supergrupo
		$this->var->add_param("$id_unidad_medida_base");//id_unidad_de_medida_base
		$this->var->add_param("$costo_estimado");//costo_estimado
		$this->var->add_param("$precio_estimado");//precio_estimado
		$this->var->add_param("$stock_min");//stock_min
		$this->var->add_param("NULL");//registro

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}


	/**
	 * Nombre de la funci�n:	ValidarId1
	 * Prop�sito:				Realiza una validaci�n de datos del lado del servidor web (sin consultar la bd)
	 * Autor:					Fernando Prudencio Cardona
	 * Fecha Creaci�n:			29-09-2007
	 *
	 * @param unknown_type $operacion_sql
	 * @param unknown_type $id_id_1
	 * @param unknown_type $codigo
	 * @param unknown_type $nombre
	 * @param unknown_type $descripcion
	 * @param unknown_type $nivel_convertido
	 * @param unknown_type $convertido
	 * @param unknown_type $observaciones
	 * @param unknown_type $estado_registro
	 * @param unknown_type $fecha_reg
	 * @param unknown_type $id_subgrupo
	 * @param unknown_type $id_grupo
	 * @param unknown_type $id_supergrupo
	 */
	function ValidarId1($operacion_sql,$id_id1,$codigo,$nombre,$descripcion,$nivel_convertido,$convertido,$observaciones,$estado_registro,$fecha_reg,$id_subgrupo,$id_grupo,$id_supergrupo)
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
				//Validar id_id1 - tipo integer
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("id_id1");
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_MinLength(0);
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_id1", $id_id1))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar codigo - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("codigo");
			//$tipo_dato->set_MaxLength(3);
			$tipo_dato->set_MinLength(1);

			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "codigo", $codigo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar nombre - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nombre");
			$tipo_dato->set_MaxLength(100);
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
			$tipo_dato->set_MinLength(0);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar nivel_convertido - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nivel_convertido");
			$tipo_dato->set_MaxLength(1);
			$tipo_dato->set_MinLength(0);

			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "nivel_convertido", $nivel_convertido))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar convertido - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("convertido");
			$tipo_dato->set_MaxLength(2);
			$tipo_dato->set_MinLength(0);

			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "convertido", $convertido))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar observaciones - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("observaciones");
			$tipo_dato->set_MaxLength(200);
			$tipo_dato->set_MinLength(0);

			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "observaciones", $observaciones))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar estado_registro - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_registro");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_MinLength(0);

			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado_registro", $estado_registro))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar fecha_reg - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_reg");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_reg", $fecha_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_subgrupo - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_subgrupo");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_MinLength(0);
			
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_subgrupo", $id_subgrupo))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar id_grupo - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_grupo");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_MinLength(0);
			
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_grupo", $id_grupo))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar id_supergrupo - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_supergrupo");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_MinLength(0);
			
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_supergrupo", $id_supergrupo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_id1 - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_id1");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_MinLength(0);
	
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_id1", $id_id1))
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