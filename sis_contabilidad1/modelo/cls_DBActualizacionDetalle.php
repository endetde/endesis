<?php
/**
 * Nombre de la Clase:	cls_DBActualizacion
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tct_actualizacion
 * Autor:				Ana Maria Villegas Quispe
 * Fecha creaci�n:		13/12/2010
 */
class cls_DBActualizacionDetalle
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
	 * Nombre de la funci�n:	ListarActualizacionDetalle
	 * Prop�sito:				Desplegar los registros de tct_actualizacion
	 * Autor:				    avq
	 * Fecha de creaci�n:		15/12/2010
	 */
	function ListarActualizacionDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_actualizacion_detalle_sel';
		$this->codigo_procedimiento = "'CT_ACTDET_SEL'";

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
	
		$this->var->add_def_cols('id_actualizacion_detalle','integer');
		$this->var->add_def_cols('id_actualizacion','integer');
		$this->var->add_def_cols('desc_presupuesto','text');
		$this->var->add_def_cols('cuenta','TEXT');
		$this->var->add_def_cols('auxiliar','text');
		$this->var->add_def_cols('desc_orden','varchar');
		$this->var->add_def_cols('cuenta_actualizacion','text');
		$this->var->add_def_cols('auxiliar_actualizacion','text');
		$this->var->add_def_cols('moneda','varchar');		
		$this->var->add_def_cols('saldo_moneda','numeric'); //saldo
		$this->var->add_def_cols('saldo_anterior','numeric');
		$this->var->add_def_cols('diferencial_actualizacion','numeric');
		$this->var->add_def_cols('valor_actualizado','numeric');
		
	 

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
	function ContarActualizacionDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_actualizacion_detalle_sel';
		$this->codigo_procedimiento = "'CT_ACTDET_COUNT'";

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
		//echo $this->query;
		//exit;
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	
}?>