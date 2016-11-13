<?php
/**
 * Nombre de la Clase:	cls_DBObligacion
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla cls_DBObligacion
 * Autor:				Resni Artega Copari
 * Fecha creaci�n:		11-08-2010
 *
 */
class cls_DBObligacion
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
	var $nombre_archivo = "cls_DBObligacion.php";

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
	 * Nombre de la funci�n:	ListarTipoObligacion
	 * Prop�sito:				Desplegar los registros de tkp_TipoObligacion en funci�n de los par�metros del filtro
	 * Autor:					Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		11-08-2010
	 *
	 */
	function ListarObligacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_obligacion_sel';
		$this->codigo_procedimiento = "'KP_OBLIGA_SEL'";

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
		$this->var->add_def_cols('id_obligacion','integer');
		$this->var->add_def_cols('id_tipo_obligacion','integer');
		$this->var->add_def_cols('codigo','varchar');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('id_planilla','integer');
		$this->var->add_def_cols('id_comprobante','integer');
		$this->var->add_def_cols('monto','numeric');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('estado_reg','varchar');
		
		$this->var->add_def_cols('observaciones','text');
		$this->var->add_def_cols('nro_cuenta_banco','varchar');
		$this->var->add_def_cols('id_institucion','integer');
		$this->var->add_def_cols('desc_institucion','varchar');
		$this->var->add_def_cols('tipo_pago','varchar');
		$this->var->add_def_cols('fecha_pago','date');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarTipoObligacion
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		11-08-2010
	 *
	 */
	function ContarObligacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_obligacion_sel';
		$this->codigo_procedimiento = "'KP_OBLIGA_COUNT'";

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
	 * Nombre de la funci�n:	InsertarObligacion
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_Obligacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		11-08-2010
	 * Descripci�n:             Se a�adio los atributos fecha_reg, estado_reg
	
	 */
	function InsertarObligacion($id_obligacion,$id_tipo_obligacion,$id_planilla,$id_comprobante,$monto,$estado_reg,$observaciones,$id_cuenta_bancaria,$tipo_pago)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_obligacion_iud';
		$this->codigo_procedimiento = "'KP_OBLIGA_INS'";
		
		//echo 'XXXXXXXX  '.$id_tipo_obligacion;
		//exit;

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("$id_tipo_obligacion");
		$this->var->add_param("$id_planilla");
		$this->var->add_param("'$id_comprobante'");
        $this->var->add_param("'$monto'");
        $this->var->add_param("'$estado_reg'");
        $this->var->add_param("'$observaciones'");
        $this->var->add_param("$id_cuenta_bancaria");
        $this->var->add_param("'$tipo_pago'");
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
	 * Nombre de la funci�n:	ModificarObligacion
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_Obligacion
	 * Autor:				    Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		11-08-2010
	 */
	function ModificarObligacion($id_obligacion,$id_tipo_obligacion,$id_planilla,$id_comprobante,$monto,$estado_reg,$observaciones,$id_cuenta_bancaria,$tipo_pago)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_obligacion_iud';
		$this->codigo_procedimiento = "'KP_OBLIGA_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_obligacion);
		$this->var->add_param("$id_tipo_obligacion");
		$this->var->add_param("$id_planilla");
		$this->var->add_param("'$id_comprobante'");
        $this->var->add_param("'$monto'");
        $this->var->add_param("'$estado_reg'");
        $this->var->add_param("'$observaciones'");
        $this->var->add_param("$id_cuenta_bancaria");
		$this->var->add_param("'$tipo_pago'");
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
	 * Nombre de la funci�n:	EliminarObligacion
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tkp_Obligacion
	 * Autor:				    Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		11-08-2010
	 */
	function EliminarObligacion($id_obligacion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_obligacion_iud';
		$this->codigo_procedimiento = "'KP_OBLIGA_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_obligacion);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
        $this->var->add_param("NULL");
        $this->var->add_param("NULL");

        $this->var->add_param("NULL");//'$observaciones'");
        $this->var->add_param("NULL");//$id_cuenta_bancaria);
		$this->var->add_param("NULL");//tipo_pago
		$this->var->add_param("null");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	
	function PagarObligacion($id_obligacion,$id_tipo_obligacion,$id_planilla,$id_comprobante,$monto,$estado_reg,$observaciones,$id_cuenta_bancaria,$tipo_pago,$fecha_pago)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_obligacion_iud';
		$this->codigo_procedimiento = "'KP_PAGOBL_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_obligacion);
		$this->var->add_param("$id_tipo_obligacion");
		$this->var->add_param("$id_planilla");
		$this->var->add_param("'$id_comprobante'");
        $this->var->add_param("'$monto'");
        $this->var->add_param("'$estado_reg'");
        $this->var->add_param("'$observaciones'");
        $this->var->add_param("$id_cuenta_bancaria");
        $this->var->add_param("'$tipo_pago'");
        $this->var->add_param("'$fecha_pago'");
	
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	
}
?>