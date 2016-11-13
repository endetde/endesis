<?php
/**
 * Nombre de la Clase:	cls_DBConceptoFactura.php
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tct_actualizacion
 * Autor:				Ana Maria Villegas Quispe
 * Fecha creaci�n:		13/12/2010
 */
class cls_DBConceptoFactura
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
	function InsertarConceptoFactura($id_concepto_factura,$nombre_concepto,$tipo_concepto,$id_lugar,$nombre_lugar,$id_categoria_cliente,$nombre_categoria_cliente,$id_sistema_distribucione)
	{
		$this->salida = "";
		$this->nombre_funcion = 'cobra.f_tcb_concepto_factura_iud';
		$this->codigo_procedimiento = "'CT_CONFAC_INS'";
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$nombre_concepto'");
		$this->var->add_param("'$tipo_concepto'");
		$this->var->add_param("'$id_lugar'");
		$this->var->add_param("'$nombre_lugar'");
		$this->var->add_param("'$id_categoria_cliente'");
		$this->var->add_param("'$nombre_categoria_cliente'");
		$this->var->add_param("'$id_sistema_distribucione'");
		
		
		

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
	function ModificarConceptoFactura($id_concepto_factura,$nombre_concepto,$tipo_concepto,$id_lugar,$nombre_lugar,$id_categoria_cliente,$nombre_categoria_cliente,$id_sistema_distribucione)
	{
		 
		$this->salida = "";
		$this->nombre_funcion = 'cobra.f_tcb_concepto_factura_iud';
		$this->codigo_procedimiento = "'CT_CONFAC_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("$id_concepto_factura");
		$this->var->add_param("'$nombre_concepto'");
		$this->var->add_param("'$tipo_concepto'");
		$this->var->add_param("'$id_lugar'");
		$this->var->add_param("'$nombre_lugar'");
		$this->var->add_param("'$id_categoria_cliente'");
		$this->var->add_param("'$nombre_categoria_cliente'");
		$this->var->add_param("'$id_sistema_distribucione'");
		
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
	function EliminarConceptoFactura($id_concepto_factura)
	{
		$this->salida = "";
		$this->nombre_funcion = 'cobra.f_tcb_concepto_factura_iud';
		$this->codigo_procedimiento = "'CT_CONFAC_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_concepto_factura);
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
	function ListarConceptoFactura($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'cobra.f_tcb_concepto_factura_sel';
		$this->codigo_procedimiento = "'CB_CONFAC_SEL'";

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
		$this->var->add_def_cols('id_concepto_factura','integer');
		$this->var->add_def_cols('nombre_concepto','varchar');
		$this->var->add_def_cols('id_lugar','varchar');
		$this->var->add_def_cols('id_sistema_distribucion','varchar');
		$this->var->add_def_cols('tipo_concepto','varchar');
		$this->var->add_def_cols('id_categoria_cliente','varchar');
		$this->var->add_def_cols('nombre_lugar','varchar');
		$this->var->add_def_cols('nombre_categoria_cliente','varchar');
		$this->var->add_def_cols('nombre_sistema_distribucion','varchar');


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
	function ContarConceptoFactura($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'cobra.f_tcb_concepto_factura_sel';
		$this->codigo_procedimiento = "'CB_CONFAC_COUNT'";

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