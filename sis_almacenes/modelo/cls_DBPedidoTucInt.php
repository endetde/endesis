<?php
/**
 * Nombre de la clase:	cls_DBPedidoTucInt.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla val_tal_kardex_logico
 * Autor:				RAC
 * Fecha creaci�n:		29/12/2016
 */

class cls_DBPedidoTucInt
{
	var $salida;
	var $query;
	var $var;
	var $nombre_funcion;
	var $codigo_procedimiento;
	var $decodificar;
	
	function __construct()
	{
		$this->decodificar=$decodificar;
	}
	
	/**
	 * Nombre de la funci�n:	ListarParametroAlmacenLogico
	 * Prop�sito:				Desplegar los registros de f_tal_parametro_almacen_logico_sel
	 * Autor:				    rac
	 * Fecha de creaci�n:		03/12/2016
	 */
	function ListarPedidoTucInt($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_pedido_tuc_int_sel';
		$this->codigo_procedimiento = "'AL_PEDTUCINT_SEL'";
		
		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
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
		$this->var->add_def_cols('id_pedido_tuc_int','integer');
	    $this->var->add_def_cols('id_salida','integer');
	    $this->var->add_def_cols('id_orden_salida_uc_detalle','integer');
	    $this->var->add_def_cols('id_tipo_unidad_constructiva','integer');
	    $this->var->add_def_cols('id_item','integer');
	    $this->var->add_def_cols('cantidad_solicitada','integer');
	    $this->var->add_def_cols('nuevo','integer');
	    $this->var->add_def_cols('fecha_reg','date');
	    $this->var->add_def_cols('usado','integer');
	    $this->var->add_def_cols('demasia','integer');
	    $this->var->add_def_cols('sw_autorizado','varchar');
	    $this->var->add_def_cols('sw_entregado','varchar');
	    $this->var->add_def_cols('id_salida_complementaria','integer');
	    $this->var->add_def_cols('nombre','varchar');
	    $this->var->add_def_cols('codigo','varchar');
	    $this->var->add_def_cols('descripcion','varchar');
	    $this->var->add_def_cols('correlativo_sal_com','varchar'); 
				
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		//echo "sql:". $this->query;
	
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarKardexLogico
	 * Prop�sito:				Contar los registros de f_tal_parametro_almacen_logico_sel
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-26 15:20:16
	 */
	function ContarPedidoTucInt($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_pedido_tuc_int_sel';
		$this->codigo_procedimiento = "'AL_PEDTUCINT_COUNT'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
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
		$this->var->add_def_cols('totales','bigint');

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
	 * Nombre de la funci�n:	autorizarSalida
	 * Prop�sito:				autoriza la no entrega de material por faltantes
	 * Autor:				    RAC
	 * Fecha de creaci�n:		29/12/2016
	 */
	function ActionAutorizaPedido($id_pedido_tuc_int)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_pedido_tuc_int_iud';
		$this->codigo_procedimiento = "'AL_AUTPEDITUC_IUD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_pedido_tuc_int);
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
	 * Nombre de la funci�n:	GenerarSalidaPendiente
	 * Prop�sito:				genera una salida simple con los item no entregados
	 * Autor:				    RAC
	 * Fecha de creaci�n:		30/12/2016
	 */
	function GenerarSalidaPendiente($id_salida)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_pedido_tuc_int_iud';
		$this->codigo_procedimiento = "'AL_GENSALIPEN_IUD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);	
		
		$this->var->add_param("NULL");		
		$this->var->add_param($id_salida);
		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	
	 /**
	 * Nombre de la funci�n:	GenerarSalidaPendiente
	 * Prop�sito:				genera una salida simple con los item no entregados
	 * Autor:				    RAC
	 * Fecha de creaci�n:		30/12/2016
	 */
	function EliminarPedidoTucInt($id_pedido_tuc_int)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_pedido_tuc_int_iud';
		$this->codigo_procedimiento = "'AL_PEDTUCINT_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);	
		
		
		$this->var->add_param($id_pedido_tuc_int);
		$this->var->add_param("NULL");		
		

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