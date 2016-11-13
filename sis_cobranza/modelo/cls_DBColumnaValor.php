<?php
/**
 * Nombre de la Clase:	cls_DBColumnaValor.php
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tct_actualizacion
 * Autor:				Ana Maria Villegas Quispe
 * Fecha creaci�n:		13/12/2010
 */
class cls_DBColumnaValor
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
	 * Nombre de la funci�n:	InsertarSistemadistribucion
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tct_auxiliar
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-31 11:01:39
	 */
	function InsertarColumnaValor($id_columna_valor, $id_concepto_factura, $id_tipo_facturacion_cobranza, $id_cuenta, $id_partida, $id_auxiliar, $id_presupuesto, $sw_presto, $sw_fecha_separativa, $sw_estado, $id_usuario, $fecha_reg, $nombre_columna, $calculo_conta, $calculo_presto, $sw_debe_haber)
	{
		$this->salida = "";
		$this->nombre_funcion = 'cobra.f_tcb_columna_valor_iud';
		$this->codigo_procedimiento = "'CT_CONVAL_INS'";
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("$id_concepto_factura");
		$this->var->add_param("$id_tipo_facturacion_cobranza");
		$this->var->add_param("$id_cuenta");
		$this->var->add_param("$id_partida");
		$this->var->add_param("$id_auxiliar");
		$this->var->add_param("$id_presupuesto");
		$this->var->add_param("'$sw_presto'");
		$this->var->add_param("'$sw_fecha_separativa'");
		$this->var->add_param("'$sw_estado'");
		$this->var->add_param("'$nombre_columna'");
		$this->var->add_param("'$calculo_conta'");
		$this->var->add_param("'$calculo_presto'");
		$this->var->add_param("'$sw_debe_haber'");


		
		
		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarAuxiliar
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tct_auxiliar
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-31 11:01:39
	 */
	function ModificarColumnaValor($id_columna_valor, $id_concepto_factura, $id_tipo_facturacion_cobranza, $id_cuenta, $id_partida, $id_auxiliar, $id_presupuesto, $sw_presto, $sw_fecha_separativa, $sw_estado, $id_usuario, $fecha_reg, $nombre_columna, $calculo_conta, $calculo_presto, $sw_debe_haber)
	{
		 
		$this->salida = "";
		$this->nombre_funcion = 'cobra.f_tcb_columna_valor_iud';
		$this->codigo_procedimiento = "'CT_CONVAL_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("$id_columna_valor");
		$this->var->add_param("$id_concepto_factura");
		$this->var->add_param("$id_tipo_facturacion_cobranza");
		$this->var->add_param("$id_cuenta");
		$this->var->add_param("$id_partida");
		$this->var->add_param("$id_auxiliar");
		$this->var->add_param("$id_presupuesto");
		$this->var->add_param("'$sw_presto'");
		$this->var->add_param("'$sw_fecha_separativa'");
		$this->var->add_param("'$sw_estado'");
		$this->var->add_param("'$nombre_columna'");
		$this->var->add_param("'$calculo_conta'");
		$this->var->add_param("'$calculo_presto'");
		$this->var->add_param("'$sw_debe_haber'");


		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarAuxiliar
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tct_auxiliar
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-31 11:01:39
	 */
	function EliminarColumnaValor($id_columna_valor)
	{
		$this->salida = "";
		$this->nombre_funcion = 'cobra.f_tcb_columna_valor_iud';
		$this->codigo_procedimiento = "'CT_CONVAL_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_columna_valor);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
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
	 * Nombre de la funci�n:	ListarConceptoFactura
	 * Prop�sito:				Desplegar los registros de tct_actualizacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		
	 */
	function ListarColumnaValor($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'cobra.f_tcb_columna_valor_sel';
		$this->codigo_procedimiento = "'CB_COLVAL_SEL'";

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
		$this->var->add_def_cols('id_columna_valor','integer');
		$this->var->add_def_cols('id_concepto_factura','integer');
		$this->var->add_def_cols('nombre_concepto','varchar');
		$this->var->add_def_cols('id_tipo_facturacion_cobranza','integer');
		$this->var->add_def_cols('nombre_proceso','varchar');
		$this->var->add_def_cols('id_cuenta','integer');
		$this->var->add_def_cols('nombre_cuenta','text');
		$this->var->add_def_cols('id_partida','integer');
		$this->var->add_def_cols('nombre_partida','text');
		$this->var->add_def_cols('id_auxiliar','integer');
		$this->var->add_def_cols('nombre_auxiliar','text');
		$this->var->add_def_cols('id_presupuesto','integer');
		$this->var->add_def_cols('desc_presupuesto','text');
		$this->var->add_def_cols('sw_presto','varchar');
		$this->var->add_def_cols('sw_fecha_separativa','varchar');
		$this->var->add_def_cols('sw_estado','varchar');
		$this->var->add_def_cols('id_usuario','integer');
		$this->var->add_def_cols('nombre_completo','text');
		$this->var->add_def_cols('fecha_reg','TIMESTAMP');
		$this->var->add_def_cols('nombre_columna','varchar');
		$this->var->add_def_cols('calculo_conta','varchar');
		$this->var->add_def_cols('calculo_presto','varchar');
		$this->var->add_def_cols('sw_debe_haber','varchar');





		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//echo $this->query;
		//exit;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarActualizacion
	 * Prop�sito:				Contar los registros de tct_actualizacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-31 11:01:39
	 */
	function ContarColumnaValor($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'cobra.f_tcb_columna_valor_sel';
		$this->codigo_procedimiento = "'CB_COLVAL_COUNT'";

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
	
	
}?>