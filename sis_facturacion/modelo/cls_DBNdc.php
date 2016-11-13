<?php
/**
 * Nombre de la Clase:	cls_DBNdc
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tfv_Ndc
 * Autor:				MTSL
 * Fecha creaci�n:		2014.05
 *
 */
class cls_DBNdc
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
	var $nombre_archivo = "cls_DBNdc.php";

	//Matriz de par�metros de validaci�n de todas las columnas
	var $matriz_validacion = array();
	
	//Bandera que indica si los datos se decodificar�n o no
	var $decodificar = false;

	function __construct()
	{
		//Carga los par�metro de validaci�n de todas las columnas
		//$this->cargar_param_valid();
		
		//Carga en una variable interna la bandera del GET o POST
		$this->decodificar = $decodificar;
	}

	/**
	 * Nombre de la funci�n:	ListarNdc
	 * Prop�sito:				Desplegar los registros de tfv_Ndc en funci�n de los par�metros del filtro
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
	function ListarNdc($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_ndc_sel';
		$this->codigo_procedimiento = "'FV_FACNDC_SEL'";

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
		//Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '',"'%'","'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'","'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'","'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'","'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'","'$id_actividad'"));//id_actividad
		
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_ndc','integer');
		$this->var->add_def_cols('id_gestion','integer');
		$this->var->add_def_cols('id_factura','integer');
		$this->var->add_def_cols('id_dosifica','integer');
		$this->var->add_def_cols('nro_autoriza','numeric');
		$this->var->add_def_cols('simbolo','varchar');
		$this->var->add_def_cols('nombre_depto','varchar');
		$this->var->add_def_cols('fac_nombre','varchar');
		$this->var->add_def_cols('fac_nronit','numeric');
		$this->var->add_def_cols('fac_numero','integer');
		$this->var->add_def_cols('ndc_fecha','date');
		$this->var->add_def_cols('ndc_concepto','varchar');
		$this->var->add_def_cols('ndc_importe','numeric');
		$this->var->add_def_cols('ndc_numero','integer');
		$this->var->add_def_cols('ndc_control','varchar');
		$this->var->add_def_cols('ndc_formula','integer');
		$this->var->add_def_cols('ndc_estado_vig','varchar');
		$this->var->add_def_cols('usuario_reg','varchar');
		$this->var->add_def_cols('fecha_reg','timestamp');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarNdc
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
	function ContarNdc($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_ndc_sel';
		$this->codigo_procedimiento = "'FV_FACNDC_COUNT'";

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
	 * Nombre de la funci�n:	InsertarNdc
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tfv_ndc
	 * 							con los par�metros requeridos
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
		
	function InsertarNdc($id_ndc, $id_gestion, $id_factura, $id_dosifica, $ndc_fecha, $ndc_concepto, $ndc_formula)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_ndc_iud';
		$this->codigo_procedimiento = "'FV_FACNDC_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id ndc
		$this->var->add_param("$id_gestion");
		$this->var->add_param("$id_factura");
		$this->var->add_param("$id_dosifica");;
		$this->var->add_param("'$ndc_fecha'");
		$this->var->add_param("'$ndc_concepto'");
		$this->var->add_param("$ndc_formula");
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	ModificarNdc
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tfv_ndc
	 * con los par�metros requeridos
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
	function ModificarNdc($id_ndc, $id_gestion, $id_factura, $id_dosifica, $ndc_fecha, $ndc_concepto, $ndc_formula)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_ndc_iud';
		$this->codigo_procedimiento = "'FV_FACNDC_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		
		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_ndc");
		$this->var->add_param("$id_gestion");
		$this->var->add_param("$id_factura");
		$this->var->add_param("$id_dosifica");
		$this->var->add_param("'$ndc_fecha'");
		$this->var->add_param("'$ndc_concepto'");
		$this->var->add_param("$ndc_formula");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}

	/**
	 * Nombre de la funci�n:	EliminarNdc
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tfv_ndc
	 * con los par�metros requeridos
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
	function EliminarNdc($id_ndc)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_ndc_iud';
		$this->codigo_procedimiento = "'FV_FACNDC_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_ndc");//id de Ndc
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarNdc
	 * Prop�sito:				Realiza una validaci�n de datos del lado del servidor (sin consultar a BD)
	 * Autor:					MTSL			
	 * Fecha creaci�n:			2014.05
	 */
	function ValidarNdc($operacion_sql, $id_ndc, $id_gestion, $id_factura, $id_dosifica, $ndc_fecha, $ndc_concepto, $ndc_formula)
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
					//Validar id_factura - tipo integer
					$tipo_dato->_reiniciar_valor();
					$tipo_dato->set_Columna("id_ndc");	
					$tipo_dato->set_MaxLength(15);
					$tipo_dato->set_MinLength(0);
					$tipo_dato->set_Signo('2');
					 
					if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_ndc", $id_ndc))
					{
						$this->salida = $valid->salida;
						return false;
					}
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
	
	/**
	 * Nombre de la funci�n:	ProcesarNdc
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tfv_Ndc
	 * con los par�metros requeridos
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
	function ProcesarNdc($accion,$id_ndc)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_ndc_iud';
		
		if($accion=='devengar'){
			$this->codigo_procedimiento = "'FV_NDCDEV_PRO'";
		}
		elseif ($accion=='emitir'){
			$this->codigo_procedimiento = "'FV_NDCEMI_PRO'";
		}
		elseif ($accion=='revertir'){
			$this->codigo_procedimiento = "'FV_NDCREV_PRO'";
		}
		elseif ($accion=='anular'){
			$this->codigo_procedimiento = "'FV_NDCNUL_PRO'";
		}
		elseif ($accion=='percibir'){
			$this->codigo_procedimiento = "'TS_NDCEMI_PRO'";
		}
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
	
		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_ndc");//id de Ndc
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
	
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ListarNdcQR
	 * Prop�sito:				Desplegar los registros de tfv_Ndc en funci�n de los par�metros del filtro
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2016.01
	 */
	function ListarNdcQR($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_ndc_sel';
		$this->codigo_procedimiento = "'FV_NDCDQR_SEL'";
	
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
		//Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '',"'%'","'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'","'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'","'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'","'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'","'$id_actividad'"));//id_actividad
	
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('nro_nit','numeric');
		$this->var->add_def_cols('ndc_numero','integer');
		$this->var->add_def_cols('nro_autoriza','numeric');
		$this->var->add_def_cols('ndc_fecha','varchar');
		$this->var->add_def_cols('ndc_importe','varchar');
		$this->var->add_def_cols('ndc_control','varchar');
		$this->var->add_def_cols('fac_nronit','numeric');
		$this->var->add_def_cols('sw_debito','varchar');
	
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
}?>