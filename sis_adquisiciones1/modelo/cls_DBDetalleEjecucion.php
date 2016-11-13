<?php
/**
 * Nombre de la clase:	cls_DBComprador.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tad_tad_comprador
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-11-17 11:14:48
 */

 
class cls_DBDetalleEjecucion
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
	 * Nombre de la funci�n:	ListarComprador
	 * Prop�sito:				Desplegar los registros de tad_comprador
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-17 11:14:48
	 */
	function ListarDetalleEjecucion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id,$estado)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_detalle_ejecucion_sel';
		$this->codigo_procedimiento = "'AD_DETEJE_SEL'";

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
		$this->var->add_param($id);
		$this->var->add_param("'$estado'");

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_solicitud_compra_det','int4');
		$this->var->add_def_cols('id_partida_ejecucion','int4');
		$this->var->add_def_cols('id_adjudicacion','int4');
		$this->var->add_def_cols('gestion','numeric');
		$this->var->add_def_cols('nro_solicitud','varchar');
		$this->var->add_def_cols('desc_detalle','varchar');
		$this->var->add_def_cols('ano','int4');
		$this->var->add_def_cols('importe_eje_rev','numeric');
		$this->var->add_def_cols('importe_total','numeric');
		$this->var->add_def_cols('saldo','numeric');
		
				
		

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
			
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarComprador
	 * Prop�sito:				Contar los registros de tad_comprador
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-17 11:14:48
	 */
	function ContarDetalleEjecucion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id,$estado)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_detalle_ejecucion_sel';
		$this->codigo_procedimiento = "'AD_DETEJE_COUNT'";

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
		$this->var->add_param($id);
		$this->var->add_param("'$estado'");
		
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
	 * Nombre de la funci�n:	ModificarComprador
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tad_comprador
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-17 11:14:48
	 */
	function ModificarDetalleEjecucion($id_solicitud_compra_det,$id_partida_ejecucion,$id_adjudicacion,$saldo,$importe_eje_rev,$vista,$id)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_detalle_ejecucion_iud';
		$this->codigo_procedimiento = "'AD_DETEJE_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_solicitud_compra_det);
		$this->var->add_param($id_partida_ejecucion);
		$this->var->add_param($id_adjudicacion);
		$this->var->add_param($saldo);
		$this->var->add_param($importe_eje_rev);
		$this->var->add_param("'$vista'");
		$this->var->add_param($id);
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//echo $this->query;

		return $res;
	}	
	
	
	
}?>