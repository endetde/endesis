<?php
/**
 * Nombre de la clase:	cls_DBIngresoDetalle.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tal_tal_ingreso_detalle
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-10-17 12:32:39
 */

class cls_DBIngresoDetalle
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
	 * Nombre de la funci�n:	ListarIngresoDetalle
	 * Prop�sito:				Desplegar los registros de tal_ingreso_detalle
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 12:32:39
	 */
	function ListarIngresoDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_ingreso_detalle_sel';
		$this->codigo_procedimiento = "'AL_INGDET_SEL'";

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
		$this->var->add_def_cols('id_ingreso_detalle','int4');
		$this->var->add_def_cols('cantidad','numeric');
		$this->var->add_def_cols('costo','numeric');
		$this->var->add_def_cols('precio_venta','numeric');
		$this->var->add_def_cols('costo_unitario','numeric');
		$this->var->add_def_cols('precio_venta_unitario','numeric');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_ingreso','int4');
		$this->var->add_def_cols('desc_ingreso','varchar');
		$this->var->add_def_cols('id_item','int4');
		$this->var->add_def_cols('desc_item','varchar');
		$this->var->add_def_cols('estado_item','varchar');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('nombre_supg','varchar');
		$this->var->add_def_cols('nombre_grupo','varchar');
		$this->var->add_def_cols('nombre_subg','varchar');
		$this->var->add_def_cols('nombre_id1','varchar');
		$this->var->add_def_cols('nombre_id2','varchar');
		$this->var->add_def_cols('nombre_id3','varchar');
		$this->var->add_def_cols('unidad_medida','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarIngresoDetalle
	 * Prop�sito:				Contar los registros de tal_ingreso_detalle
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 12:32:39
	 */
	function ContarIngresoDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_ingreso_detalle_sel';
		$this->codigo_procedimiento = "'AL_INGDET_COUNT'";
		
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
	
	/**
	 * Nombre de la funci�n:	InsertarIngresoDetalle
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_ingreso_detalle
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 12:32:39
	 */
	function InsertarIngresoDetalle($id_ingreso_detalle,$cantidad,$costo,$precio_venta,$costo_unitario,$precio_venta_unitario,$observaciones,$fecha_reg,$id_ingreso,$id_item)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_ingreso_detalle_iud';
		$this->codigo_procedimiento = "'AL_INGDET_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($cantidad);
		$this->var->add_param($costo);
		$this->var->add_param($precio_venta);
		$this->var->add_param($costo_unitario);
		$this->var->add_param($precio_venta_unitario);
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_ingreso);
		$this->var->add_param($id_item);
		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarIngresoDetalle
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_ingreso_detalle
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 12:32:39
	 */
	function ModificarIngresoDetalle($id_ingreso_detalle,$cantidad,$costo,$precio_venta,$costo_unitario,$precio_venta_unitario,$observaciones,$fecha_reg,$id_ingreso,$id_item)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_ingreso_detalle_iud';
		$this->codigo_procedimiento = "'AL_INGDET_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_ingreso_detalle);
		$this->var->add_param($cantidad);
		$this->var->add_param($costo);
		$this->var->add_param($precio_venta);
		$this->var->add_param($costo_unitario);
		$this->var->add_param($precio_venta_unitario);
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_ingreso);
		$this->var->add_param($id_item);
	
		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarIngresoDetalle
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_ingreso_detalle
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 12:32:39
	 */
	function EliminarIngresoDetalle($id_ingreso_detalle)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_ingreso_detalle_iud';
		$this->codigo_procedimiento = "'AL_INGDET_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_ingreso_detalle);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
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
	 * Nombre de la funci�n:	Detalle Reporte 
	 * Prop�sito:				Desplegar el detalle del ingreso para reporte Vale de Ingreso de Materiales
	 * Autor:				    RCM
	 * Fecha de creaci�n:		25/06/2008
	 */
	function ListarIngresoDetalleReporte($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_ingreso_detalle_sel';
		$this->codigo_procedimiento = "'AL_IDETRP_SEL'";

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
		$this->var->add_def_cols('nombre','varchar');//0
		$this->var->add_def_cols('cantidad','numeric');//3
		$this->var->add_def_cols('unidad_med','varchar');//5
		$this->var->add_def_cols('calidad','varchar');//7
		$this->var->add_def_cols('nueva_desc','varchar');//8
		$this->var->add_def_cols('peso_neto','numeric');//4
		$this->var->add_def_cols('costo_unitario','numeric');//10
		$this->var->add_def_cols('costo','numeric');//9
		
		$this->var->add_def_cols('peso_kg','numeric');//2
		$this->var->add_def_cols('codigo','varchar');//6
		$this->var->add_def_cols('descripcion','text');//1
		
		
		
		

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		//echo "query: ".$this->query;
		//exit;
		return $res;
	}
	
		/**
	 * Nombre de la funci�n:	Resumen Detalle  de Ingresos Reporte 
	 * Prop�sito:				Desplegar el resumen detalle del ingreso por origen 
	 * Autor:				    ARV
	 * Fecha de creaci�n:		20/02/2009
	 */
	function ListarResumenIngresoReporte($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)//,$id_parametro_almacen,$fecha_desde,$fecha_hasta,$id_almacen,$id_almacen_logico)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_ingreso_sel';
		$this->codigo_procedimiento = "'AL_RESING_SEL'";

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
		
	/*	$this->var->add_param($id_parametro_almacen);//id_parametro_almacen
		$this->var->add_param("'$fecha_desde'");
        $this->var->add_param("'$fecha_hasta'");
        $this->var->add_param($id_almacen);
        $this->var->add_param($id_almacen_logico);*/
     
        
        /*$this->var->add_param($id_proveedor);//id_proveedor
        $this->var->add_param($id_contratista);//id_contratista
        $this->var->add_param($id_empleado);//id_empleado
        $this->var->add_param($id_institucion);//id_institucion*/
  
        
                     
                          
		//Carga la definici�n de columnas con sus tipos de datos
				
		$this->var->add_def_cols('id_ingreso','integer');//0
		$this->var->add_def_cols('correlativo_ing','varchar');//3
		$this->var->add_def_cols('nombre','varchar');//5
		$this->var->add_def_cols('costo','numeric');//7
		$this->var->add_def_cols('cantidad','numeric');//7
		$this->var->add_def_cols('fecha_finalizado_cancelado','date');//8
		
		
		
		
		

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		//echo "query: ".$this->query;
		//exit;
		return $res;
	}
	
	
	/**
	 * Nombre de la funci�n:	ObtenerIngresoItem
	 * Prop�sito:				Devuelve la cantidad ingresada de un item espec�fico
	 * Autor:				    RCM
	 * Fecha de creaci�n:		15/07/2008
	 */
	function ObtenerIngresoItem($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_ingreso_detalle_sel';
		$this->codigo_procedimiento = "'AL_ITEING_SEL'";

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
		$this->var->add_def_cols('cantidad','numeric');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo "query: ".$this->query;
		exit;*/
		
		return $res;
	}
	
	
	/**
	 * Nombre de la funci�n:	ValidarIngresoDetalle
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tal_ingreso_detalle
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 12:32:39
	 */
	function ValidarIngresoDetalle($operacion_sql,$id_ingreso_detalle,$cantidad,$costo,$precio_venta,$costo_unitario,$precio_venta_unitario,$observaciones,$fecha_reg,$id_ingreso,$id_item)
	{
		$this->salida = "";
		$valid = new cls_validacion_serv();

		//Clase para validar el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();
	
		//Ejecuta la validaci�n por el tipo de operaci�n
		if($operacion_sql=='insert' || $operacion_sql=='update')
		{
			if($operacion_sql == 'update')
			{
				//Validar id_ingreso_detalle - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_ingreso_detalle");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_ingreso_detalle", $id_ingreso_detalle))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar cantidad - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("cantidad");
			$tipo_dato->set_MaxLength(1179650);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "cantidad", $cantidad))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar costo - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("costo");
			$tipo_dato->set_MaxLength(1179650);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "costo", $costo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar precio_venta - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("precio_venta");
			$tipo_dato->set_MaxLength(1179650);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "precio_venta", $precio_venta))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar costo_unitario - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("costo_unitario");
			$tipo_dato->set_MaxLength(1179650);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "costo_unitario", $costo_unitario))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar precio_venta_unitario - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("precio_venta_unitario");
			$tipo_dato->set_MaxLength(1179650);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "precio_venta_unitario", $precio_venta_unitario))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fecha_reg - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_reg");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_reg", $fecha_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_ingreso - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_ingreso");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_ingreso", $id_ingreso))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_item - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_item");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_item", $id_item))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_ingreso_detalle - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_ingreso_detalle");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_ingreso_detalle", $id_ingreso_detalle))
			{
				$this->salida = $valid->salida;
				return false;
			}
		
			//Validaci�n exitosa
			return true;	
		}
		else
		{
			return false;
		}
	}
}?>