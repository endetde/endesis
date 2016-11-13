<?php
/**
 * Nombre de la clase:	cls_DBProcesoCompra.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tad_tad_proceso_compra
 * Autor:				Ana Maria
 * Fecha creaci�n:		2008-05-13 18:03:04
 */

 
class cls_DBCuadroComparativo
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
	
	/**funciones para el reporte lista de compras
	 * Nombre de la funci�n:	ListarProcesoRep
	 * Prop�sito:				Desplegar los registros de tad_proceso_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-13 18:03:04
	 */
	function ListarCCItem($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_cuadro_comparativo_sel';
		$this->codigo_procedimiento = "'AD_CCITEM_SEL'";

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
		$this->var->add_def_cols('id_proceso_compra_det','int');
		//$this->var->add_def_cols('nombre_item','varchar');
		$this->var->add_def_cols('descripcion_item','text');
		$this->var->add_def_cols('cantidad_sol','numeric');
		$this->var->add_def_cols('precio_unitario','numeric');
		$this->var->add_def_cols('precio_total','numeric');
		$this->var->add_def_cols('reformulado','varchar');
		
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	/*	echo $this->query;
		exit;*/
		return $res;
	}
		/**funciones para el reporte lista de compras
	 * Nombre de la funci�n:	ListarProcesoRep
	 * Prop�sito:				Desplegar los registros de tad_proceso_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-13 18:03:04
	 */
	function ListarCCProveedores($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_cuadro_comparativo_sel';
		$this->codigo_procedimiento = "'AD_CCPROV_SEL'";

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
		$this->var->add_def_cols('id_cotizacion_det','integer');
		$this->var->add_def_cols('id_proveedor','integer');
		$this->var->add_def_cols('nombre_proveedor','text');
		$this->var->add_def_cols('precio_minimo','numeric');
		$this->var->add_def_cols('observaciones','varchar');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		exit;*/
		return $res;
	}

		/**funciones para el reporte lista de compras
	 * Nombre de la funci�n:	ListarProcesoRep
	 * Prop�sito:				Desplegar los registros de tad_proceso_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-13 18:03:04
	 */
	function ListarCCProveedoresOfertas($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_cuadro_comparativo_sel';
		$this->codigo_procedimiento = "'AD_CCPROF_SEL'";

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
		$this->var->add_def_cols('id_item','int');
		//$this->var->add_def_cols('nombre_item','varchar');
		$this->var->add_def_cols('descripcion_item','varchar');
		$this->var->add_def_cols('cantidad_cot','numeric');
		$this->var->add_def_cols('unidad','varchar');
		$this->var->add_def_cols('precio_unitario','numeric');
		$this->var->add_def_cols('precio_total','numeric');
		$this->var->add_def_cols('id_item_cotizado','int');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		exit;*/
		return $res;
	}
		/**funciones para el reporte lista de compras
	 * Nombre de la funci�n:	ListarProcesoRep
	 * Prop�sito:				Desplegar los registros de tad_proceso_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-13 18:03:04
	 */
	function ListarCCProveedoresDetallePropuesta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_cuadro_comparativo_sel';
		$this->codigo_procedimiento = "'AD_CCPRDP_SEL'";

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
		/*$this->var->add_def_cols('id_item','int');
		$this->var->add_def_cols('nombre_item','varchar');
		*/
		$this->var->add_def_cols('descripcion_item','text');
		$this->var->add_def_cols('cantidad_cot','numeric');
		$this->var->add_def_cols('unidad','varchar');
		$this->var->add_def_cols('precio_unitario','numeric');
		$this->var->add_def_cols('precio_total','numeric');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		exit;*/
		return $res;
	}
		/**funciones para el reporte lista de compras
	 * Nombre de la funci�n:	ListarCuadroComparativoSErvicio
	 * Prop�sito:				Desplegar los registros de tad_proceso_compra
	 * Autor:				    avq
	 * Fecha de creaci�n:		2008-05-13 18:03:04
	 */
	function ListarCCServicio($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_cuadro_comparativo_sel';
		$this->codigo_procedimiento = "'AD_CCSERV_SEL'";

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
		$this->var->add_def_cols('id_proceso_compra_det','int');
		//$this->var->add_def_cols('nombre_item','varchar');
		$this->var->add_def_cols('descripcion_servicio','text');
		$this->var->add_def_cols('cantidad_sol','numeric');
		$this->var->add_def_cols('precio_unitario','numeric');
		$this->var->add_def_cols('precio_total','numeric');
		$this->var->add_def_cols('reformulado','varchar');
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	/*	echo $this->query;
		exit;*/
		return $res;
	}
	
		/**funciones para el reporte lista de compras
	 * Nombre de la funci�n:	ListarProcesoRep
	 * Prop�sito:				Desplegar los registros de tad_proceso_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-13 18:03:04
	 */
	function ListarCCProveedoresServicios($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_cuadro_comparativo_sel';
		$this->codigo_procedimiento = "'AD_CCPRSE_SEL'";

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
		$this->var->add_def_cols('id_servicio','int');
		//$this->var->add_def_cols('nombre_item','varchar');
		$this->var->add_def_cols('descripcion_servicio','text');
		$this->var->add_def_cols('cantidad_cot','numeric');
		$this->var->add_def_cols('unidad','varchar');
		$this->var->add_def_cols('precio_unitario','numeric');
		$this->var->add_def_cols('precio_total','numeric');
		$this->var->add_def_cols('id_item_cotizado','int');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	/*	echo $this->query;
		exit;*/
		return $res;
	}

	/**funciones para el reporte lista de compras
	 * Nombre de la funci�n:	ListarProcesoRep
	 * Prop�sito:				Desplegar los registros de tad_proceso_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-13 18:03:04
	 */
	function ListarCCProveedoresDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_cuadro_comparativo_sel';
		$this->codigo_procedimiento = "'AD_CCPROVDE_SEL'";

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
		$this->var->add_def_cols('nombre_proveedor','text');
		//$this->var->add_def_cols('nombre_item','varchar');
		$this->var->add_def_cols('fecha_entrega','date');
		//$this->var->add_def_cols('garantia','varchar');
		$this->var->add_def_cols('lugar_entrega','varchar');
		$this->var->add_def_cols('forma_pago','varchar');
		$this->var->add_def_cols('tiempo_validez_oferta','varchar');
		$this->var->add_def_cols('garantia','varchar');
		$this->var->add_def_cols('observaciones','text');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		exit;*/
		return $res;
	}
		
}?>
