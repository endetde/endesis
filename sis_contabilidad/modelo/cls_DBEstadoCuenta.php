<?php
/**
 * Nombre de la clase:	cls_DBEstadoCuenta.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tct_tct_cheque
 * Autor:				JoS� A. Mita H.
 * Fecha creaci�n:		2008-12-08 11:24:35
 */

 
class cls_DBEstadoCuenta
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
	 * Nombre de la funci�n:	ListarEstadoCuenta
	 * Prop�sito:				Desplegar los registros de tct_cheque
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 11:24:35
	 */
	function ListarEstadoCuenta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_cuenta,$id_moneda,$id_ep,$id_uo,$fecha_del,$fecha_al)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_reporte_estado_cuenta';
		$this->codigo_procedimiento = "'PR_ESCUTR_SEL'";

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
		
		$this->var->add_param($func->iif($id_cuenta == '','NULL',$id_cuenta));
		$this->var->add_param($func->iif($id_moneda == '','NULL',$id_moneda));
		$this->var->add_param($func->iif($id_ep == '','NULL',$id_ep));
		$this->var->add_param($func->iif($id_uo == '','NULL',$id_uo));
		$this->var->add_param($func->iif($fecha_del == '','NULL',"'$fecha_del'"));
		$this->var->add_param($func->iif($fecha_al == '','NULL',"'$fecha_al'"));
//echo 'ep-'.$id_ep.'moneda-'.$id_moneda;
	
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_cuenta','int4');
		$this->var->add_def_cols('nro_cuenta','varchar');
		$this->var->add_def_cols('nombre_cuenta','varchar');
		$this->var->add_def_cols('nombre_unidad','varchar');
		$this->var->add_def_cols('saldo','numeric');
		$this->var->add_def_cols('ep','text');
		$this->var->add_def_cols('codigo_auxiliar','varchar');
        $this->var->add_def_cols('nombre_auxiliar','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	
		//echo $this->query;exit;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarEstadoCuenta
	 * Prop�sito:				Contar los registros de tct_cheque
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 11:24:35
	 */
	function ContarEstadoCuenta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_cuenta,$id_moneda,$id_ep,$id_uo,$fecha_del,$fecha_al)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_reporte_estado_cuenta';
		$this->codigo_procedimiento = "'PR_ESCUTR_COUNT'";

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

		$this->var->add_param($func->iif($id_cuenta == '','NULL',$id_cuenta));
		$this->var->add_param($func->iif($id_moneda == '','NULL',$id_moneda));
		$this->var->add_param($func->iif($id_ep == '','NULL',$id_ep));
		$this->var->add_param($func->iif($id_uo == '','NULL',$id_uo));
		$this->var->add_param($func->iif($fecha_del == '','NULL',"'$fecha_del'"));
		$this->var->add_param($func->iif($fecha_al == '','NULL',"'$fecha_al'"));
		
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
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	
	function ListarEstadoAuxiliar($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_auxiliar,$id_moneda,$id_ep,$id_uo,$fecha_del,$fecha_al)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_reporte_estado_auxiliar';
		$this->codigo_procedimiento = "'PR_ESTAUX_SEL'";

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
		
		$this->var->add_param($func->iif($id_auxiliar == '','NULL',$id_auxiliar));
		$this->var->add_param($func->iif($id_moneda == '','NULL',$id_moneda));
		$this->var->add_param($func->iif($id_ep == '','NULL',$id_ep));
		$this->var->add_param($func->iif($id_uo == '','NULL',$id_uo));
		$this->var->add_param($func->iif($fecha_del == '','NULL',"'$fecha_del'"));
		$this->var->add_param($func->iif($fecha_al == '','NULL',"'$fecha_al'"));
//echo 'ep-'.$id_ep.'moneda-'.$id_moneda;
	
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_cuenta','int4');
		$this->var->add_def_cols('nro_cuenta','varchar');
		$this->var->add_def_cols('nombre_cuenta','varchar');
		$this->var->add_def_cols('nombre_unidad','varchar');
		$this->var->add_def_cols('saldo','numeric');
		$this->var->add_def_cols('ep','text');
		$this->var->add_def_cols('codigo_auxiliar','varchar');
        $this->var->add_def_cols('nombre_auxiliar','varchar');
        $this->var->add_def_cols('id_auxiliar','int4');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	
		//echo $this->query;exit;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarEstadoAuxiliar
	 * Prop�sito:				Contar los registros de tct_cheque
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-17 11:24:35
	 */
	function ContarEstadoAuxiliar($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_auxiliar,$id_moneda,$id_ep,$id_uo,$fecha_del,$fecha_al)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_reporte_estado_auxiliar';
		$this->codigo_procedimiento = "'PR_ESTAUX_COUNT'";

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

		$this->var->add_param($func->iif($id_auxiliar == '','NULL',$id_auxiliar));
		$this->var->add_param($func->iif($id_moneda == '','NULL',$id_moneda));
		$this->var->add_param($func->iif($id_ep == '','NULL',$id_ep));
		$this->var->add_param($func->iif($id_uo == '','NULL',$id_uo));
		$this->var->add_param($func->iif($fecha_del == '','NULL',"'$fecha_del'"));
		$this->var->add_param($func->iif($fecha_al == '','NULL',"'$fecha_al'"));
		
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
		//echo $this->query;exit;
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
}?>