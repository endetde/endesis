<?php
/**
 * Nombre de la clase:	cls_DBParametroAlmacenLogico.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla val_tal_kardex_logico
 * Autor:				RAC
 * Fecha creaci�n:		03/12/2016
 */

class cls_DBParametroAlmacenLogico
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
	function ListarParametroAlmacenLogico($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_parametro_almacen_logico_sel';
		$this->codigo_procedimiento = "'AL_PALOG_SEL'";
		
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
		$this->var->add_def_cols('id_parametro_almacen_logico','integer');
		$this->var->add_def_cols('id_almacen_logico','integer');
		$this->var->add_def_cols('id_parametro_almacen','integer');
		$this->var->add_def_cols('estado','varchar');
		$this->var->add_def_cols('gestion','varchar');
		
		
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
	function ContarParametroAlmacenLogico($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_parametro_almacen_logico_sel';
		$this->codigo_procedimiento = "'AL_PALOG_COUNT'";

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
	 * Nombre de la funci�n:	CerrarGestionLogica
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_parametro_almacen_logico
	 * Autor:				    RAC
	 * Fecha de creaci�n:		06/12/2016
	 */
	function CerrarGestionLogica($id_parametro_almacen_logico)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_parametro_almacen_logico_iud';
		$this->codigo_procedimiento = "'AL_CERALMLOG_IUD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_parametro_almacen_logico);
		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	
	 /**
	 * Nombre de la funci�n:	RevalorarGestionLogica
	 * Prop�sito:				Hace el re calculo de promedios ponderados desde el primer ingreso hasta la ultima salida para obtener lso costos reales
	 * Autor:				    RAC
	 * Fecha de creaci�n:		06/12/2016
	 */
	function RevalorarGestionLogica($id_parametro_almacen_logico)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_parametro_almacen_logico_iud';
		$this->codigo_procedimiento = "'AL_REVLOG_IUD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_parametro_almacen_logico);
		

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