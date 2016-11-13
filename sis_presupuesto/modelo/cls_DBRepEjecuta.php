<?php
/**
 * Nombre de la clase:	cls_DBRepEjecuta.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tt_tpr_datos
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2013-11-04 08:54:28
 */

 
class cls_DBRepEjecuta
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
	 * Nombre de la funci�n:	ListarDatos
	 * Prop�sito:				Desplegar los registros de tt_tpr_datos
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2013-11-04 08:54:28
	 */
	function ListarDatos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$sw_admi,$sw_listado,$id_parametro,$ids_tipo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_repeje_datos_sel';
		$this->codigo_procedimiento = "'PR_DATOS_SEL'";

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
		
		$this->var->add_param("'$sw_admi'");//pr_sw_admi
		$this->var->add_param("'$sw_listado'");//pr_sw_listado
		$this->var->add_param($id_parametro);//pr_id_gestion
		$this->var->add_param("'$ids_tipo'");//pr_ids_tipo
		
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_datos','INTEGER');
		$this->var->add_def_cols('codigo','VARCHAR');
		$this->var->add_def_cols('nombre','VARCHAR');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	/*	echo $this->query; exit();*/
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarDatos
	 * Prop�sito:				Contar los registros de tt_tpr_datos
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2013-11-04 08:54:28
	 */
	function ContarDatos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$sw_admi,$sw_listado,$id_parametro,$ids_tipo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_repeje_datos_sel';
		$this->codigo_procedimiento = "'PR_DATOS_COUNT'";

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
		
		$this->var->add_param("'$sw_admi'");//pr_sw_admi
		$this->var->add_param("'$sw_listado'");//pr_sw_listado
		$this->var->add_param($id_parametro);//pr_id_gestion
		$this->var->add_param("'$ids_tipo'");//pr_ids_tipo
		
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