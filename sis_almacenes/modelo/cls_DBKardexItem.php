<?php
/**
 * Nombre de la clase:	cls_DBKardexItem.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad del reporte material entregado
 * Autor:				avq
 * Fecha creaci�n:		2009-1-22 17:48
 */

class cls_DBKardexItem
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
	 * Nombre de la funci�n:	ReporteKardexItemDetalle
	 * Prop�sito:				Desplegar los registros del detalle de salida
	 * Autor:				    avq
	 * Fecha de creaci�n:		2009-1-22 17:48
	 */
	function ReporteKardexItemDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_parametro_almacen,$id_fina_regi_prog_proy_acti,$id_almacen_logico,$id_almacen,$id_item,$fecha_desde,$fecha_hasta)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_kardex_item_sel';
		$this->codigo_procedimiento = "'AL_REKAFI_SEL'";

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
		$this->var->add_param($id_parametro_almacen);//id_parametro_almacen
        $this->var->add_param($id_fina_regi_prog_proy_acti);//id_fina_regi_prog_proy_acti
        $this->var->add_param($id_almacen_logico);
        $this->var->add_param($id_almacen);
        $this->var->add_param($id_item);
        $this->var->add_param("'$fecha_desde'");
        $this->var->add_param("'$fecha_hasta'");
	

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('fecha','text');
		$this->var->add_def_cols('codigo','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('cant_entrada','numeric');
		$this->var->add_def_cols('cant_salida','numeric');
		$this->var->add_def_cols('saldo','numeric');
		$this->var->add_def_cols('precio_unitario','numeric');
		$this->var->add_def_cols('costo_debe','numeric');
		$this->var->add_def_cols('costo_haber','numeric');
		$this->var->add_def_cols('saldo_costo','numeric');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*if ($_SESSION['ss_id_usuario']==131){
		echo $this->query;
		exit;  
		}*/
		return $res;
	}
}?>