<?php
/**
 * Nombre de la Clase:	cls_DBTipoMaterial
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tal_tipo_material
 * Autor:				Fernando Prudencio Cardona
 * Fecha creaci�n:		28-09-2007
 */
class cls_DBTipoMaterial
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
	var $nombre_archivo = "cls_DBTipoMaterial.php";

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
	 * Nombre de la funci�n:	ListarTipoMaterial
	 * Prop�sito:				Desplegar los registros de tal_tipo_material en funci�n de los par�metros del filtro
	 * Autor:					Fernando Prudencio Cardona
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
	function ListarTipoMaterial($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_tipo_material_sel';
		$this->codigo_procedimiento = "'AL_TIPMAT_SEL'";

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
		$this->var->add_def_cols('id_tipo_material','integer');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarTipoMaterial
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					Fernando Prudencio Cardona
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
	function ContarTipoMaterial($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_tipo_material_sel';
		$this->codigo_procedimiento = "'AL_TIPMAT_COUNT'";

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
	 * Nombre de la funci�n:	InsertarTipoMaterial
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_tipo_material,
	 * 							con los par�metros requeridos
	 * Autor:					Fernando Prudencio Cardona
	 * Fecha de creaci�n:		28-09-2007
	 *
	 * @param unknown_type $id_tipo_material
	 * @param unknown_type $nombre
	 * @param unknown_type $descripcion
	 * @param unknown_type $observaciones
	 * @param unknown_type $fecha_reg
	 * @return unknown
	 */
	function InsertarTipoMaterial($id_tipo_material,$nombre,$descripcion,$observaciones,$fecha_reg)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_tipo_material_iud';
		$this->codigo_procedimiento = "'AL_TIPMAT_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id_tipo_material
		$this->var->add_param("'$nombre'");//nombre
		$this->var->add_param("'$descripcion'");//descripcion
		$this->var->add_param("'$observaciones'");//observaciones
		$this->var->add_param("'$fecha_reg'");//fecha_reg
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}


	/**
	 * Nombre de la funci�n:	ModificarTipoMaterial
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_tipo_material
	 * 							con los par�metros requeridos
	 * Autor:					Fernando Prudencio Cardona
	 * Fecha de creaci�n:		28-09-2007
	 *
	 * @param unknown_type $id_tipo_material
	 * @param unknown_type $nombre
	 * @param unknown_type $descripcion
	 * @param unknown_type $observaciones
	 * @param unknown_type $fecha_reg
	 * @return unknown
	 */
	function ModificarTipoMaterial($id_tipo_material,$nombre,$descripcion,$observaciones,$fecha_reg)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_tipo_material_iud';
		$this->codigo_procedimiento = "'AL_TIPMAT_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_tipo_material");//id_tipo_material
		$this->var->add_param("'$nombre'");//nombre
		$this->var->add_param("'$descripcion'");//descripcion
		$this->var->add_param("'$observaciones'");//observaciones
		$this->var->add_param("'$fecha_reg'");//fecha_reg
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}



	/**
	 * Nombre de la funci�n:	EliminarTipoMaterial
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_tipo_material
	 * 							con los par�metros requeridos
	 * Autor:					Fernando Prudencio Cardona
	 * Fecha de creaci�n:		28-09-2007
	 *
	 * @param unknown_type $id_tipo_material
	 * @return unknown
	 */
	function EliminarTipoMaterial($id_tipo_material)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_tipo_material_iud';
		$this->codigo_procedimiento = "'AL_TIPMAT_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_tipo_material");//id_tipo_material
		$this->var->add_param("NULL");//nombre
		$this->var->add_param("NULL");//descripcion
		$this->var->add_param("NULL");//observaciones
		$this->var->add_param("NULL");//fecha_reg
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}


	/**
	  * Nombre de la funci�n:	ValidaTipoMaterial
	 * Prop�sito:				Realiza una validaci�n de datos del lado del servidor (sin consultar a BD)
	* Autor:					Fernando Prudencio Cardona
	 * Fecha de creaci�n:		28-09-2007
	 *
	 * @param unknown_type $operacion_sql
	 * @param unknown_type $id_tipo_material
	 * @param unknown_type $nombre
	 * @param unknown_type $descripcion
	 * @param unknown_type $observaciones
	 * @param unknown_type $fecha_reg
	 * @return unknown
	 */
	function ValidarTipoMaterial($operacion_sql,$id_tipo_material,$nombre,$descripcion,$observaciones,$fecha_reg)
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
					//Validar id_tipo_material - tipo integer
					$tipo_dato->_reiniciar_valor();
					$tipo_dato->set_Columna("id_tipo_material");
					$tipo_dato->set_MaxLength(10);
					$tipo_dato->set_MinLength(0);
					
					if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_material", $id_tipo_material))
					{
						$this->salida = $valid->salida;
						return false;
					}
				}

				//Validar nombre - tipo varchar
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("nombre");
				$tipo_dato->set_MaxLength(50);
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
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_reg", $fecha_reg))
				{
					$this->salida = $valid->salida;
					return false;
				}

				
				//Validaci�n exitosa
				return true;
		}

			elseif ($operacion_sql=='delete')
		{
				//Validar id_tipo_material - tipo integer
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("id_tipo_material");
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_MinLength(0);
			
				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_material", $id_tipo_material))
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