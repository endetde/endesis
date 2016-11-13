<?php
/**
 * Nombre de la Clase:	cls_DBFacturaDet
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tfv_factura_det
 * Autor:				MTSL
 * Fecha creaci�n:		2014.05
 *
 */
class cls_DBFacturaDet
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
	var $nombre_archivo = "cls_DBFacturaDet.php";

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
	 * Nombre de la funci�n:	ListarFacturaDet
	 * Prop�sito:				Desplegar los registros de tfv_factura_det en funci�n de los par�metros del filtro
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
	function ListarFacturaDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_factura_det_sel';
		$this->codigo_procedimiento = "'FV_FACDET_SEL'";

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
		$this->var->add_def_cols('id_factura_det','integer');
		$this->var->add_def_cols('id_factura','integer');
		$this->var->add_def_cols('id_presupuesto','integer');
		$this->var->add_def_cols('desc_presupuesto','text');
		$this->var->add_def_cols('id_ppto_gasto','integer');
		$this->var->add_def_cols('desc_gasto','text');
		$this->var->add_def_cols('id_concepto_ingas','integer');
		$this->var->add_def_cols('desc_ingas','varchar');
		$this->var->add_def_cols('id_partida','integer');
		$this->var->add_def_cols('despar','text');
		$this->var->add_def_cols('id_cuenta','integer');
		$this->var->add_def_cols('descta','text');
		$this->var->add_def_cols('id_auxiliar','integer');
		$this->var->add_def_cols('desaux','text');
		$this->var->add_def_cols('fac_importe','numeric');
		$this->var->add_def_cols('fac_descuento','numeric');
		$this->var->add_def_cols('fac_obsdesc','varchar');
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
	 * Nombre de la funci�n:	ContarFacturaDet
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
	function ContarFacturaDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_factura_det_sel';
		$this->codigo_procedimiento = "'FV_FACDET_COUNT'";

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
	 * Nombre de la funci�n:	InsertarFacturaDet
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tfv_FacturaDet
	 * 							con los par�metros requeridos
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
		
	function InsertarFacturaDet($id_factura_det, $id_factura, $id_presupuesto, $id_ppto_gasto, $id_concepto_ingas, $fac_importe, $fac_descuento, $fac_obsdesc)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_factura_det_iud';
		$this->codigo_procedimiento = "'FV_FACDET_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id factura_det
		$this->var->add_param("$id_factura");
		$this->var->add_param("$id_presupuesto");
		$this->var->add_param("$id_ppto_gasto");
		$this->var->add_param("$id_concepto_ingas");
		$this->var->add_param("$fac_importe");
		$this->var->add_param("$fac_descuento");
		$this->var->add_param("'$fac_obsdesc'");
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	ModificarFacturaDet
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tfv_FacturaDet
	 * con los par�metros requeridos
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
	function ModificarFacturaDet($id_factura_det, $id_factura, $id_presupuesto, $id_ppto_gasto, $id_concepto_ingas, $fac_importe, $fac_descuento, $fac_obsdesc)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_factura_det_iud';
		$this->codigo_procedimiento = "'FV_FACDET_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		
		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_factura_det");//id de FacturaDet
		$this->var->add_param("$id_factura");
		$this->var->add_param("$id_presupuesto");
		$this->var->add_param("$id_ppto_gasto");
		$this->var->add_param("$id_concepto_ingas");
		$this->var->add_param("$fac_importe");
		$this->var->add_param("$fac_descuento");
		$this->var->add_param("'$fac_obsdesc'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EditarFacturaDet
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tfv_FacturaDet
	 * con los par�metros requeridos
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
	function EditarFacturaDet($id_factura_det, $id_factura, $fac_obsdesc)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_factura_det_iud';
		$this->codigo_procedimiento = "'FV_FACDET_MOD'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
	
		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_factura_det");//id de FacturaDet
		$this->var->add_param("$id_factura");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("null");
		$this->var->add_param("'$fac_obsdesc'");
	
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarFacturaDet
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tfv_FacturaDet
	 * con los par�metros requeridos
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
	function EliminarFacturaDet($id_factura_det)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_factura_det_iud';
		$this->codigo_procedimiento = "'FV_FACDET_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_factura_det");//id de FacturaDet
		$this->var->add_param("null");
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
	 * Nombre de la funci�n:	ValidarFacturaDet
	 * Prop�sito:				Realiza una validaci�n de datos del lado del servidor (sin consultar a BD)
	 * Autor:					MTSL			
	 * Fecha creaci�n:			2014.05
	 */
	function ValidarFacturaDet($operacion_sql, $id_factura_det, $id_presupuesto, $id_ppto_gasto, $id_concepto_ingas, $fac_importe, $fac_descuento, $fac_obsdesc)
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
					//Validar id_FacturaDet - tipo integer
					$tipo_dato->_reiniciar_valor();
					$tipo_dato->set_Columna("id_factura_det");	
					$tipo_dato->set_MaxLength(15);
					$tipo_dato->set_MinLength(0);
					$tipo_dato->set_Signo('2');
					 
					if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_factura_det", $id_factura_det))
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
}?>