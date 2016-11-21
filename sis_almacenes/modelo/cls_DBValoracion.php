<?php
/**
 * Nombre de la clase:	cls_DBValoracion.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tal_tal_almacen
 * Autor:				RCM
 * Fecha creaci�n:		31/03/2009
 */

class cls_DBValoracion
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
	 * Nombre de la funci�n:	ReporteValoracionSaldos
	 * Prop�sito:				Desplegar los registros de tal_almacen
	 * Autor:				    RCM
	 * Fecha de creaci�n:		31/03/2009
	 */
	function ReporteValoracionSaldos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_parametro_almacen,$id_ep,$id_almacen,$id_almacen_logico,$fecha)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_valoracion_sel';
		$this->codigo_procedimiento = "'AL_VALSAL_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = 'NULL';
		$this->var->puntero = 'NULL';
		$this->var->sortcol = 'NULL';
		$this->var->sortdir = 'NULL';
		$this->var->criterio_filtro = 'NULL';

		//Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '','NULL',"'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '','NULL',"'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '','NULL',"'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '','NULL',"'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '','NULL',"'$id_actividad'"));//id_actividad
		$this->var->add_param($id_parametro_almacen);
		$this->var->add_param("'$id_ep'");
		$this->var->add_param("'$id_almacen_logico'");
		$this->var->add_param("'$fecha'");
/*
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_item','integer');
		$this->var->add_def_cols('fecha','date');
		$this->var->add_def_cols('ingresos','numeric');
		$this->var->add_def_cols('salidas','numeric');
		$this->var->add_def_cols('final','varchar');
		$this->var->add_def_cols('almacen','varchar');
		$this->var->add_def_cols('almacen_log','varchar');
		$this->var->add_def_cols('fecha_rep','varchar');
		$this->var->add_def_cols('gestion','varchar');
		$this->var->add_def_cols('nombre_item','varchar');
		$this->var->add_def_cols('desc_item','varchar');
		$this->var->add_def_cols('un_med_bas','varchar');
		$this->var->add_def_cols('saldo_fis','numeric');
		$this->var->add_def_cols('costo','numeric');
		$this->var->add_def_cols('saldo_eco','numeric');*/
		//$this->var->add_def_cols('fecha_finalizado_exacta','timestamp');
		
		$this->var->add_def_cols('id_item','integer');
		$this->var->add_def_cols('ingresos','numeric');
		$this->var->add_def_cols('salidas','numeric');
		$this->var->add_def_cols('costo_ingreso','numeric');
	    $this->var->add_def_cols('costo_salida','numeric');
	    $this->var->add_def_cols('almacen','varchar');
		$this->var->add_def_cols('almacen_log','varchar');
		$this->var->add_def_cols('fecha_rep','varchar');
		$this->var->add_def_cols('gestion','varchar');
		$this->var->add_def_cols('nombre_item','varchar');
		$this->var->add_def_cols('desc_item','varchar');
		$this->var->add_def_cols('un_med_bas','varchar');
		
		
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