<?php
/**
 * Nombre de la clase:	cls_DBAlmacen.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tal_tal_almacen
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-10-11 09:24:52
 */

class cls_DBAlmacenGestion
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
	 * Nombre de la funci�n:	ListarAlmacenGestion
	 * Prop�sito:				Desplegar los registros de tal_almacen
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-11 09:24:52
	 */
	function ListarAlmacenGestion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_almacen)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_almacen_gestion_sel';
		$this->codigo_procedimiento = "'AL_ALMGES_SEL'";

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
		$this->var->add_param($func->iif($id_financiador == '','NULL',$id_financiador));//id_financiador
		$this->var->add_param($func->iif($id_regional == '','NULL',$id_regional));//id_regional
		$this->var->add_param($func->iif($id_programa == '','NULL',$id_programa));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '','NULL',$id_proyecto));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '','NULL',$id_actividad));//id_actividad
		$this->var->add_param("$id_almacen");//id_almacen

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_almacen','int4');
		$this->var->add_def_cols('codigo','varchar');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('direccion','varchar');
		$this->var->add_def_cols('bloqueado','varchar');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('gestion','varchar');
        $this->var->add_def_cols('fecha_apertura','date');
		$this->var->add_def_cols('fecha_cierre','date');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarAlmacen
	 * Prop�sito:				Contar los registros de tal_almacen
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-11 09:24:52
	 */
	function ContarAlmacenGestion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_almacen)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_almacen_gestion_sel';
		$this->codigo_procedimiento = "'AL_ALMGES_COUNT'";

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
		$this->var->add_param($func->iif($id_financiador == '', "'%'", "'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional    == '', "'%'", "'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa    == '', "'%'", "'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto    == '', "'%'", "'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad   == '', "'%'", "'$id_actividad'"));//id_actividad
		$this->var->add_param("$id_almacen");//id_almacen
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