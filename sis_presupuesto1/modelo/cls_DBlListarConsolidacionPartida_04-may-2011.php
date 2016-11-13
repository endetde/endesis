<?php
/**
 * Nombre de la clase:	cls_DBDestino.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpr_tpr_destino
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-07-04 08:54:28
 */

 
class cls_DBlListarConsolidacionPartida
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
	 * Nombre de la funci�n:	ListarDestino
	 * Prop�sito:				Desplegar los registros de tpr_destino
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 08:54:28
	 */
	function ListarConsiliacionPartida($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad ,$tipo_pres ,$id_parametro,$id_moneda,$ids_fuente_financiamiento,$ids_u_o,$ids_financiador,$ids_regional,$ids_programa,$ids_proyecto,$ids_actividad,$sw_vista,$ids_concepto_colectivo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_listar_cons_partida_pro_new';
		$this->codigo_procedimiento = "'PR_CONSPAR_SEL'";

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
		$this->var->add_param("$tipo_pres");//raiz
		$this->var->add_param("$id_parametro");//raiz
		$this->var->add_param("$id_moneda");//raiz
		$this->var->add_param("'$ids_fuente_financiamiento'");//raiz
		$this->var->add_param("'$ids_u_o'");//raiz
		$this->var->add_param("'$ids_financiador'");//raiz
		$this->var->add_param("'$ids_regional'");//raiz
		$this->var->add_param("'$ids_programa'");//raiz
		$this->var->add_param("'$ids_proyecto'");//raiz
		$this->var->add_param("'$ids_actividad'");//raiz
		$this->var->add_param("'$sw_vista'");//raiz
		$this->var->add_param("'$ids_concepto_colectivo'");//raiz
		
	 		
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_partida','INTEGER');
		$this->var->add_def_cols('codigo_partida','VARCHAR');
		$this->var->add_def_cols('nombre_partida','text');
		$this->var->add_def_cols('desc_partida','VARCHAR');
		$this->var->add_def_cols('nivel_partida','NUMERIC');
		$this->var->add_def_cols('sw_transaccional','NUMERIC');
		$this->var->add_def_cols('tipo_partida','NUMERIC');
		$this->var->add_def_cols('id_parametro','INTEGER');
		$this->var->add_def_cols('id_partida_padre','INTEGER');
		$this->var->add_def_cols('tipo_memoria','NUMERIC');
		$this->var->add_def_cols('sw_movimiento ','NUMERIC');
		$this->var->add_def_cols('id_concepto_colectivo','INTEGER');   
 		$this->var->add_def_cols('mes_01 ','NUMERIC');
		$this->var->add_def_cols('mes_02 ','NUMERIC');
		$this->var->add_def_cols('mes_03 ','NUMERIC');
		$this->var->add_def_cols('mes_04 ','NUMERIC');
		$this->var->add_def_cols('mes_05 ','NUMERIC');
		$this->var->add_def_cols('mes_06 ','NUMERIC');
		$this->var->add_def_cols('mes_07 ','NUMERIC');
		$this->var->add_def_cols('mes_08 ','NUMERIC');
		$this->var->add_def_cols('mes_09 ','NUMERIC');
		$this->var->add_def_cols('mes_10 ','NUMERIC');
		$this->var->add_def_cols('mes_11 ','NUMERIC');
		$this->var->add_def_cols('mes_12 ','NUMERIC');
		$this->var->add_def_cols('total ','NUMERIC');
 
	
		
		
   
 
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo $this->query;
		exit();*/

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarDestino
	 * Prop�sito:				Contar los registros de tpr_destino
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 08:54:28
	 */
	function ContarConsiliacionPartida($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad ,$tipo_pres ,$id_parametro,$id_moneda,$ids_fuente_financiamiento,$ids_u_o,$ids_financiador,$ids_regional,$ids_programa,$ids_proyecto,$ids_actividad,$sw_vista,$ids_concepto_colectivo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_listar_cons_partida_pro';
		$this->codigo_procedimiento = "'PR_CONSPAR_COUNT'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

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
		$this->var->add_param("$tipo_pres");//raiz
		$this->var->add_param("$id_parametro");//raiz
		$this->var->add_param("$id_moneda");//raiz
		$this->var->add_param("'$ids_fuente_financiamiento'");//raiz
		$this->var->add_param("'$ids_u_o'");//raiz
		$this->var->add_param("'$ids_financiador'");//raiz
		$this->var->add_param("'$ids_regional'");//raiz
		$this->var->add_param("'$ids_programa'");//raiz
		$this->var->add_param("'$ids_proyecto'");//raiz
		$this->var->add_param("'$ids_actividad'");//raiz
		$this->var->add_param("'$sw_vista'");//raiz
		$this->var->add_param("'$ids_concepto_colectivo'");//raiz
		
		
      
		
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
	/*	echo $this->query;
		exit();*/
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	InsertarDestino
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_destino
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 08:54:28
	 */
	
}?>