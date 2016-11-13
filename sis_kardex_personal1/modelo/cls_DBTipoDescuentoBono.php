<?php
/**
 * Nombre de la Clase:	cls_DBTipoDescuentoBono
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tkp_TipoDescuentoBono
 * Autor:				Mercedes Zambrana Meneses
 * Fecha creaci�n:		17-08-2010
 *
 */
class cls_DBTipoDescuentoBono
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
	var $nombre_archivo = "cls_DBTipoDescuentoBono.php";

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
	 * Nombre de la funci�n:	ListarTipoDescuentoBono
	 * Prop�sito:				Desplegar los registros de tkp_TipoDescuentoBono en funci�n de los par�metros del filtro
	 * Autor:					Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		11-08-2010
	 *
	 */
	function ListarTipoDescuentoBono($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_tipo_descuento_bono_sel';
		$this->codigo_procedimiento = "'KP_DESBONO_SEL'";

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
		$this->var->add_param($func->iif($id_financiador == '',"'%'",$id_financiador));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'",$id_regional));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'",$id_programa));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'",$id_proyecto));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'",$id_actividad));//id_actividad

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_tipo_descuento_bono','integer');
		$this->var->add_def_cols('codigo','varchar');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('tipo','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('modalidad','varchar');
		$this->var->add_def_cols('valor_modalidad_porcentual','numeric');
		$this->var->add_def_cols('forma_asignacion','varchar');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarTipoDescuentoBono
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		11-08-2010
	 *
	 */
	function ContarTipoDescuentoBono($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_tipo_descuento_bono_sel';
		$this->codigo_procedimiento = "'KP_DESBONO_COUNT'";

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
		$this->var->add_param($func->iif($id_financiador == '',"'%'",$id_financiador));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'",$id_regional));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'",$id_programa));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'",$id_proyecto));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'",$id_actividad));//id_actividad

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
	 * Nombre de la funci�n:	InsertarTipoDescuentoBono
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_TipoDescuentoBono
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		11-08-2010
	 * Descripci�n:             Se a�adio los atributos fecha_reg, estado_reg
	
	 */
	function InsertarTipoDescuentoBono($id_tipo_descuento_bono,$codigo,$nombre,$descripcion,$tipo,$fecha_reg,$estado_reg, $modalidad,$valor_modalidad_porcentual,$forma_asignacion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_tipo_descuento_bono_iud';
		$this->codigo_procedimiento = "'KP_DESBONO_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$codigo'");
		$this->var->add_param("'$nombre'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$tipo'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param("'$estado_reg'");
	
		$this->var->add_param("'$modalidad'");
		$this->var->add_param($valor_modalidad_porcentual);
		$this->var->add_param("'$forma_asignacion'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarTipoDescuentoBono
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_TipoDescuentoBono
	 * Autor:				    Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		11-08-2010
	 */
	function ModificarTipoDescuentoBono($id_tipo_descuento_bono,$codigo,$nombre,$descripcion,$tipo,$fecha_reg,$estado_reg,$modalidad,$valor_modalidad_porcentual,$forma_asignacion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_tipo_descuento_bono_iud';
		$this->codigo_procedimiento = "'KP_DESBONO_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_tipo_descuento_bono);
		
		$this->var->add_param("'$codigo'");
		$this->var->add_param("'$nombre'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$tipo'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param("'$estado_reg'");
	
		$this->var->add_param("'$modalidad'");
		$this->var->add_param($valor_modalidad_porcentual);
		$this->var->add_param("'$forma_asignacion'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarTipoDescuentoBono
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tkp_TipoDescuentoBono
	 * Autor:				    Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		11-08-2010
	 */
	function EliminarTipoDescuentoBono($id_tipo_descuento_bono)
	{ 
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_tipo_descuento_bono_iud';
		$this->codigo_procedimiento = "'KP_DESBONO_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_tipo_descuento_bono);
		
		$this->var->add_param("NULL");//("'$codigo'");
		$this->var->add_param("NULL");//("'$nombre'");
		$this->var->add_param("NULL");//("'$descripcion'");
		$this->var->add_param("NULL");//("'$tipo'");
		$this->var->add_param("NULL");//("'$fecha_reg'");
		$this->var->add_param("NULL");//("'$estado_reg'");
		$this->var->add_param("NULL");//modalidad;
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//($valor_modalidad_porcentual);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarTipoDescuentoBono
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tkp_TipoDescuentoBono
	 * Autor:				    Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		11-08-2010
	 */
	function ValidarTipoDescuentoBono($operacion_sql,$id_tipo_descuento_bono,$codigo,$nombre,$descripcion,$tipo,$fecha_reg,$estado_reg)
	{
		$this->salida = "";
		$valid = new cls_validacion_serv();

		//Clase para validar el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();
	
		//Ejecuta la validaci�n por el tipo de operaci�n
		if($operacion_sql=='insert' || $operacion_sql=='update')
		{
			if($operacion_sql == 'update')
			{
				//Validar id_Afp - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_tipo_descuento_bono");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_descuento_bono", $id_tipo_descuento_bono))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			
			//Validar nombre - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("codigo");
			$tipo_dato->set_MaxLength(300);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "codigo", $codigo))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar nombre - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nombre");
			$tipo_dato->set_MaxLength(300);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "nombre", $nombre))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			
			
			//Validar nombre - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(1000);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			
			
			//Validar nombre - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("tipo");
			$tipo_dato->set_MaxLength(300);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "tipo", $tipo))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_reg");
			$tipo_dato->set_MaxLength(20);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado_reg", $estado_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_reg");
			$tipo_dato->set_MaxLength(20);
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
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_afp");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_afp", $id_afp))
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
	
}
?>