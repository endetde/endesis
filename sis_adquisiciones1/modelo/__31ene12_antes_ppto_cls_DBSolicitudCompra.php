<?php
/**
 * Nombre de la clase:	cls_DBSolicitudCompra.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tad_tad_solicitud_compra
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-05-12 10:00:27
 */

 
class cls_DBSolicitudCompra
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
	 * Nombre de la funci�n:	ListarSolicitudCompra
	 * Prop�sito:				Desplegar los registros de tad_solicitud_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 10:00:27
	 */
	function ListarSolicitudCompra($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empresa)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_sel';
		$this->codigo_procedimiento = "'AD_SOLADQ_SEL'";

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
		$this->var->add_param($id_empresa);//id_empresa
		

		$this->var->add_def_cols('id_solicitud_compra','int4');
		//$this->var->add_def_cols('desc_solicitud_compra','int4');
		$this->var->add_def_cols('precio_total','numeric');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('fecha_venc','date');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('hora_reg','time');
		$this->var->add_def_cols('localidad','varchar');
		$this->var->add_def_cols('num_solicitud','int4');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('estado_vigente_solicitud','varchar');
		$this->var->add_def_cols('tipo_adjudicacion','varchar');
		$this->var->add_def_cols('modalidad','varchar');
		//$this->var->add_def_cols('id_solicitud_compra_ant','int4');
		$this->var->add_def_cols('id_tipo_categoria_adq','int4');
		$this->var->add_def_cols('desc_tipo_categoria_adq','varchar');
		$this->var->add_def_cols('id_empleado_frppa_solicitante','int4');
		$this->var->add_def_cols('solicitante','text');
		$this->var->add_def_cols('id_moneda','int4');
		$this->var->add_def_cols('desc_moneda','varchar');
		//$this->var->add_def_cols('id_rpa','int4');
		//$this->var->add_def_cols('desc_rpa','text');
		$this->var->add_def_cols('id_usuario_transcriptor','int4');
		$this->var->add_def_cols('transcriptor','text');
		
		$this->var->add_def_cols('id_unidad_organizacional','int4');
		$this->var->add_def_cols('desc_unidad_organizacional','varchar');
		$this->var->add_def_cols('id_empleado_frppa_pre_aprobacion','int4');
		$this->var->add_def_cols('encargado_pre_aprobacion','text');
		$this->var->add_def_cols('id_empleado_frppa_aprobacion','int4');
		$this->var->add_def_cols('encargado_aprobacion','text');
		$this->var->add_def_cols('id_empleado_frppa_gfa','int4');
		$this->var->add_def_cols('gfa','text');
	/*	$this->var->add_def_cols('codigo_sicoes','varchar');
		$this->var->add_def_cols('siguiente_estado','varchar');
	*/	$this->var->add_def_cols('periodo','int4');
		$this->var->add_def_cols('gestion','int4');
	/*	$this->var->add_def_cols('num_solicitud_sis','int4');*/
		$this->var->add_def_cols('id_frppa','int4');
	
	
		$this->var->add_def_cols('id_tipo_adq','int4');
		$this->var->add_def_cols('desc_tipo_adq','varchar');
		$this->var->add_def_cols('tipo_adq','varchar');
		$this->var->add_def_cols('simbolo','varchar');
		$this->var->add_def_cols('observaciones_estado','text');
		//$this->var->add_def_cols('tipo_cambio','numeric');
    	/*$this->var->add_def_cols('codigo_financiador','varchar');
		$this->var->add_def_cols('codigo_regional','varchar');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('codigo_proyecto','varchar');
		$this->var->add_def_cols('codigo_actividad','varchar');*/
		$this->var->add_def_cols('id_parametro_adquisicion','int4');
		$this->var->add_def_cols('id_periodo','int4');
		
		$this->var->add_def_cols('id_moneda_base','int4');
		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		$this->var->add_def_cols('id_orden_trabajo','int4');
		$this->var->add_def_cols('desc_orden','varchar');
		$this->var->add_def_cols('id_almacen_logico','int4');
		$this->var->add_def_cols('desc_almacen_logico','varchar');
		$this->var->add_def_cols('desc_almacen','varchar');
		$this->var->add_def_cols('id_almacen','int4');
		$this->var->add_def_cols('id_financiador','integer');
		$this->var->add_def_cols('id_regional','integer');
		$this->var->add_def_cols('id_programa','integer');
		$this->var->add_def_cols('id_proyecto','integer');
		$this->var->add_def_cols('id_actividad','integer');
		$this->var->add_def_cols('id_empleado','integer');
		$this->var->add_def_cols('id_uo_gerencia','integer');
		$this->var->add_def_cols('id_depto','integer');
		$this->var->add_def_cols('desc_depto','varchar');
		$this->var->add_def_cols('proveedores_propuestos','text');
		$this->var->add_def_cols('comite_calificacion','text');
		$this->var->add_def_cols('comite_recepcion','text');
		$this->var->add_def_cols('tiene_presupuesto','numeric');
		$this->var->add_def_cols('avance','varchar');
		$this->var->add_def_cols('id_avance','int4');
		$this->var->add_def_cols('nro_avance','varchar');
	//	$this->var->add_def_cols('tipo_presu','varchar');
	
		$this->var->add_def_cols('id_correspondencia','int4[]');
		$this->var->add_def_cols('correspondencia_asociada','varchar');
		$this->var->add_def_cols('id_presupuesto','integer');
		$this->var->add_def_cols('desc_presupuesto','text');
		$this->var->add_def_cols('id_gestion','integer');
		$this->var->add_def_cols('nro_solicitud_cadena','varchar');		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarSolicitudCompra
	 * Prop�sito:				Contar los registros de tad_solicitud_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 10:00:27
	 */
	function ContarSolicitudCompra($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empresa)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_sel';
		$this->codigo_procedimiento = "'AD_SOLADQ_COUNT'";

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
		$this->var->add_param($id_empresa);//id_empresa

		
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
	
		function VerificarDetalleProceso($id_solicitud_compra)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_sel';
		$this->codigo_procedimiento = "'AD_VDEPRO_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = 10;
		$this->var->puntero = 0;
		$this->var->sortcol = "''";
		$this->var->sortdir = "''";
		$this->var->criterio_filtro = "'$id_solicitud_compra'";
		
		$id_financiador='';
		$id_regional='';
		$id_programa='';
		$id_proyecto='';
		$id_actividad='';
		//Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '',"'%'","'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'","'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'","'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'","'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'","'$id_actividad'"));//id_actividad
		$this->var->add_param("NULL");//id_empresa
		
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('respuesta','text');

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
	 * Nombre de la funci�n:	ListarSolicitudCompra
	 * Prop�sito:				Desplegar los registros de tad_solicitud_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 10:00:27
	 */
	function ListarSolicitudCompraTer($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empresa,$id_proceso_compra_v)
	{         
           


        $this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_ter_sel';
		$this->codigo_procedimiento = "'AD_SOLADQTER_SEL'";

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
		$this->var->add_param($id_empresa);//id_empresa
		$this->var->add_param($id_proceso_compra_v);//id_proceso_compra
		
      
		
		
		
		//Carga la definici�n de columnas con sus tipos de datos

		
		$this->var->add_def_cols('id_solicitud_compra','int4');
		$this->var->add_def_cols('fecha_reg','date');
							$this->var->add_def_cols('hora_reg','time');
							$this->var->add_def_cols('localidad','varchar');
							$this->var->add_def_cols('num_solicitud','int4');
							$this->var->add_def_cols('estado_reg','varchar');
							$this->var->add_def_cols('estado_vigente_solicitud','varchar');
							$this->var->add_def_cols('solicitante','text');
							$this->var->add_def_cols('siguiente_estado','varchar');
							$this->var->add_def_cols('periodo','int4');
							$this->var->add_def_cols('gestion','int4');
							$this->var->add_def_cols('num_solicitud_sis','int4');
							$this->var->add_def_cols('id_fina_regi_prog_proy_acti','int4');
							$this->var->add_def_cols('id_parametro_adquisicion','int4');
							$this->var->add_def_cols('id_periodo','int4');
							$this->var->add_def_cols('id_tipo_adq','int4');
							$this->var->add_def_cols('norma','varchar');
							$this->var->add_def_cols('id_depto','int4');
		
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		
//	  echo $this->query;
//      //echo $id_proceso_compra;
//     exit;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ListarCompraRapida
	 * Prop�sito:				Desplegar los registros de tad_solicitud_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-06-30 12:06:41
	 */
	function ListarCompraRapida($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empresa)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_sel';
		$this->codigo_procedimiento = "'AD_COMRAP_SEL'";

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
		$this->var->add_param($id_empresa);//id_empresa

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_solicitud_compra','int4');
		$this->var->add_def_cols('num_solicitud','int4');
		$this->var->add_def_cols('id_fina_regi_prog_proy_acti','int4');
		$this->var->add_def_cols('id_empleado_frppa_solicitante','int4');
		$this->var->add_def_cols('desc_empleado_tpm_frppa','text');
		
		$this->var->add_def_cols('id_rpa','int4');
		
		$this->var->add_def_cols('localidad','varchar');
		$this->var->add_def_cols('id_moneda','int4');
		$this->var->add_def_cols('desc_moneda','varchar');
		$this->var->add_def_cols('id_unidad_organizacional','int4');
		$this->var->add_def_cols('desc_unidad_organizacional','varchar');
		$this->var->add_def_cols('id_tipo_categoria_adq','int4');
		$this->var->add_def_cols('desc_tipo_categoria_adq','varchar');
		$this->var->add_def_cols('tipo_adjudicacion','varchar');
		$this->var->add_def_cols('tipo_adq','varchar');
		$this->var->add_def_cols('observaciones','text');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('id_financiador','integer');
		$this->var->add_def_cols('id_regional','integer');
		$this->var->add_def_cols('id_programa','integer');
		$this->var->add_def_cols('id_proyecto','integer');
		$this->var->add_def_cols('id_actividad','integer');
		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		$this->var->add_def_cols('codigo_financiador','varchar');
		$this->var->add_def_cols('codigo_regional','varchar');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('codigo_proyecto','varchar');
		$this->var->add_def_cols('codigo_actividad','varchar');
		$this->var->add_def_cols('periodo','int4');
		$this->var->add_def_cols('gestion','int4');
		$this->var->add_def_cols('categoria','varchar');
		$this->var->add_def_cols('permite_agrupar','int4');
        $this->var->add_def_cols('avance','varchar');
        $this->var->add_def_cols('gestion_sgte','bigint');
        $this->var->add_def_cols('id_depto','int4');
        $this->var->add_def_cols('nro_solicitud_cadena','varchar');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
//		echo $this->query;
//		exit;
		
		return $res;
	}

	
	
	
	/**
	 * Nombre de la funci�n:	ContarCompraRapida
	 * Prop�sito:				Contar los registros de tad_solicitud_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-01 12:09:14
	 */
	function ContarCompraRapida($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empresa)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_sel';
		$this->codigo_procedimiento = "'AD_COMRAP_COUNT'";

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
		$this->var->add_param($id_empresa);//id_empresa

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
	 * Nombre de la funci�n:	ContarSolicitudCompra
	 * Prop�sito:				Contar los registros de tad_solicitud_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 10:00:27
	 */
	function ContarSolicitudCompraTer($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empresa,$id_proceso_compra_v)
	{
		
		
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_ter_sel';
		$this->codigo_procedimiento = "'AD_SOLADQTER_COUNT'";

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
		$this->var->add_param($id_empresa);//id_empresa
		$this->var->add_param($id_proceso_compra_v);//id_proceso_compra
		
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

//		  echo "XXXb        $this->query";
//       //echo $id_proceso_compra;
//       exit;
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
		/**
	 * Nombre de la funci�n:	Reporte SolicitudCompra
	 * Prop�sito:				Desplegar los registros de tad_solicitud_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-06-17 11:36:27
	 */
	function ListarRepSolicitudCompra($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_sel';
		$this->codigo_procedimiento = "'AD_REPSOL_SEL'";

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
		$this->var->add_param("0");//id_empresa
	
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_solicitud_compra','int4');
		$this->var->add_def_cols('num_solicitud','text');
		$this->var->add_def_cols('localidad','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('hora_reg','time');
		$this->var->add_def_cols('nombre_unidad','varchar');
		$this->var->add_def_cols('nombre_solicitante','varchar');
		$this->var->add_def_cols('nombre_aprobacion','varchar');
		$this->var->add_def_cols('tipo_adq','varchar');
		$this->var->add_def_cols('cargo_empleado_solicitante','varchar');
		$this->var->add_def_cols('cargo_empleado_aprobador','varchar');
		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		
		$this->var->add_def_cols('dia','text');
		$this->var->add_def_cols('mes','text');
		$this->var->add_def_cols('ano','text');
		$this->var->add_def_cols('monto_total','numeric');
		$this->var->add_def_cols('moneda','varchar');
		
		
		$this->var->add_def_cols('codigo_depto','varchar');
		$this->var->add_def_cols('modalidad','varchar');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('comite_calificacion','text');
		$this->var->add_def_cols('proveedores_propuestos','text');
		$this->var->add_def_cols('reformular','integer');
		$this->var->add_def_cols('comite_recepcion','text');
		$this->var->add_def_cols('gestion','integer');
		$this->var->add_def_cols('nro_generacion_sc','integer');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	/*	echo $this->query;
		exit();*/
		return $res;
		
	}
	
	function ListarRepVerificacionCompra($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_sel';
		$this->codigo_procedimiento = "'AD_REPVER_SEL'";

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
		$this->var->add_param("0");//id_empresa
		
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_solicitud_compra','int4');
		$this->var->add_def_cols('num_solicitud','text');
		$this->var->add_def_cols('localidad','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('hora_reg','time');
		$this->var->add_def_cols('nombre_unidad','varchar');
		$this->var->add_def_cols('nombre_solicitante','text');
		$this->var->add_def_cols('nombre_aprobacion','text');
		$this->var->add_def_cols('tipo_adq','varchar');
		$this->var->add_def_cols('moneda','varchar');
		
		
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		
		return $res;
		
	}
	
	/**
	 * Nombre de la funci�n:	InsertarSolicitudCompra
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tad_solicitud_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 10:00:27
	 */
	/*function InsertarSolicitudCompra($id_solicitud_compra,$precio_total,$observaciones,$fecha_venc,$fecha_reg,$hora_reg,$localidad,$num_solicitud,$estado_reg,$estado_vigente_solicitud,$tipo_adjudicacion,$modalidad,$id_solicitud_compra_ant,$id_tipo_categoria_adq,$id_empleado_frppa_solicitante,$id_moneda,$id_rpa,$id_empleado_frppa_transcriptor,$id_unidad_organizacional,$id_empleado_frppa_pre_aprobacion,$id_empleado_frppa_aprobacion,$id_empleado_frppa_gfa,$codigo_sicoes,$siguiente_estado,$periodo,$gestion,$num_solicitud_sis,$id_frppa,$id_tipo_adq,$txt_id_fin,$txt_id_reg,$txt_id_prog,$txt_id_proy,$txt_id_act,$id_empresa,$id_orden_trabajo,$id_almacen_logico,$id_uo_gerencia,$id_depto,$proveedores_propuestos,$comite_calificacion,$comite_recepcion,$avance,$tipo_presu)*/
	function InsertarSolicitudCompra($id_solicitud_compra, $precio_total, $observaciones, $fecha_venc, $fecha_reg, $hora_reg, $localidad, $num_solicitud, $estado_reg, $estado_vigente_solicitud, $tipo_adjudicacion, $modalidad,  $id_tipo_categoria_adq, $id_empleado_frppa_solicitante, $id_moneda, $id_rpa, $id_empleado_frppa_transcriptor,  $id_unidad_organizacional, $id_empleado_frppa_pre_aprobacion, $id_empleado_frppa_aprobacion, $id_empleado_frppa_gfa, $periodo, $gestion, $id_presupuesto,$id_tipo_adq,$id_empresa,$id_orden_trabajo,$id_almacen_logico,$id_uo_gerencia,$id_depto,$proveedores_propuestos,$comite_calificacion,$comite_recepcion,$avance,$id_correspondencia)
	{//
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_iud';
		$this->codigo_procedimiento = "'AD_SOLADQ_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		/*$this->var->add_param("NULL");
		$this->var->add_param($precio_total);
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$fecha_venc'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param("'$hora_reg'");
		$this->var->add_param("'$localidad'");
		$this->var->add_param($num_solicitud);
		$this->var->add_param("'$estado_reg'");
		$this->var->add_param("'$estado_vigente_solicitud'");
		
		$this->var->add_param("'$tipo_adjudicacion'");
		$this->var->add_param("'$modalidad'");
		$this->var->add_param($id_solicitud_compra_ant);
		$this->var->add_param($id_tipo_categoria_adq);
		$this->var->add_param($id_empleado_frppa_solicitante);
		$this->var->add_param($id_moneda);
		$this->var->add_param($id_rpa);
		$this->var->add_param($id_empleado_frppa_transcriptor);
		$this->var->add_param($id_unidad_organizacional);
		$this->var->add_param($id_empleado_frppa_pre_aprobacion);
		
		$this->var->add_param($id_empleado_frppa_aprobacion);
		$this->var->add_param($id_empleado_frppa_gfa);
		$this->var->add_param("'$codigo_sicoes'");
		$this->var->add_param("'$siguiente_estado'");
		$this->var->add_param($periodo);
		$this->var->add_param($gestion);
		$this->var->add_param($num_solicitud_sis);
		$this->var->add_param("'$id_frppa'");
		$this->var->add_param("$id_tipo_adq");
		$this->var->add_param("$txt_id_fin");
		
		$this->var->add_param("$txt_id_reg");
		$this->var->add_param("$txt_id_prog");
		$this->var->add_param("$txt_id_proy");
		$this->var->add_param("$txt_id_act");
		$this->var->add_param($id_empresa);
		$this->var->add_param($id_orden_trabajo);
		$this->var->add_param($id_almacen_logico);
        $this->var->add_param($id_uo_gerencia);
        $this->var->add_param("NULL");//id_comprador
        $this->var->add_param("NULL");//permite_agrupar
        $this->var->add_param($id_depto);//id_depto
        $this->var->add_param("'$proveedores_propuestos'");//proveedores_prop
        $this->var->add_param("'$comite_calificacion'");//
        $this->var->add_param("'$comite_recepcion'");//
        $this->var->add_param("'$avance'");//tipo_recibo
        $this->var->add_param("'$tipo_presu'");//tipo_presu*/
		$this->var->add_param("NULL");
		$this->var->add_param($precio_total);
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$fecha_venc'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param("'$hora_reg'");
		$this->var->add_param("'$localidad'"); 
		$this->var->add_param($num_solicitud);
		$this->var->add_param("'$estado_reg'");
		$this->var->add_param("'$estado_vigente_solicitud'");//10
		
		$this->var->add_param("'$tipo_adjudicacion'");
		$this->var->add_param("'$modalidad'");
		$this->var->add_param($id_tipo_categoria_adq);
		$this->var->add_param($id_empleado_frppa_solicitante);
		$this->var->add_param($id_moneda);
		$this->var->add_param($id_rpa);
		$this->var->add_param($id_empleado_frppa_transcriptor);
		$this->var->add_param($id_unidad_organizacional);
		$this->var->add_param($id_empleado_frppa_pre_aprobacion);
		$this->var->add_param($id_empleado_frppa_aprobacion);//20
		
		$this->var->add_param($id_empleado_frppa_gfa);
		$this->var->add_param("null");
		$this->var->add_param($periodo);
		$this->var->add_param($gestion);
		$this->var->add_param('null');
		$this->var->add_param("'$id_presupuesto'");
		$this->var->add_param("$id_tipo_adq");
		$this->var->add_param($id_empresa);
		$this->var->add_param($id_orden_trabajo);
		$this->var->add_param($id_almacen_logico);//30
		
        $this->var->add_param($id_uo_gerencia);
        $this->var->add_param("NULL");//id_comprador
        $this->var->add_param("NULL");//permite_agrupar
        $this->var->add_param($id_depto);//id_depto
        $this->var->add_param("'$proveedores_propuestos'");//proveedores_prop
        $this->var->add_param("'$comite_calificacion'");//
        $this->var->add_param("'$comite_recepcion'");//
        $this->var->add_param("'$avance'");//tipo_recibo
       if(isset($id_correspondencia)){
		$this->var->add_param_array($id_correspondencia);
		}
		else{
			$this->var->add_param_array("NULL");//id_correspondencia_asociada
		}
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
//		echo $this->query;
//		exit;
//
		return $res;
	}
	
	/*function ModificarCompraRapida($id_solicitud_compra,$codigo_proceso,$observaciones_proceso,$id_empresa,$pago_variable)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_iud';
		$this->codigo_procedimiento = "'AD_COMRAP_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_solicitud_compra);
		$this->var->add_param("NULL");
		$this->var->add_param("'$observaciones_proceso'");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("'$codigo_proceso'");
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
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("$id_empresa");//id_empresa
		$this->var->add_param("NULL");//id_orden_trabajo
		$this->var->add_param("NULL");//id_almacen_logico
		$this->var->add_param("NULL");//($id_uo_gerencia);
		$this->var->add_param("NULL");//id_comprador
		$this->var->add_param("NULL");//permite_agrupar
		$this->var->add_param("NULL");//id_depto
		
		$this->var->add_param("NULL");//proveedores_prop
        $this->var->add_param("NULL");//
        $this->var->add_param("NULL");//
        $this->var->add_param("'$pago_variable'");//tipo_recibo  o  $pago_variable
        $this->var->add_param("NULL");//tipo_presu

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}*/
	
	function ModificarCompraRapida($id_solicitud_compra,$codigo_proceso,$observaciones_proceso,$id_empresa,$pago_variable,$fecha_reg)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_iud';
		$this->codigo_procedimiento = "'AD_COMRAP_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_solicitud_compra);
		$this->var->add_param("NULL");
		$this->var->add_param("'$observaciones_proceso'");
		$this->var->add_param("NULL");
		$this->var->add_param("'$fecha_reg'");//modificado 21/04/2010 : para regsitrar la fecha del proceso
		
		$this->var->add_param("NULL");
		$this->var->add_param("'$codigo_proceso'");
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
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("$id_empresa");//id_empresa
		$this->var->add_param("NULL");//id_orden_trabajo
		$this->var->add_param("NULL");//id_almacen_logico
		$this->var->add_param("NULL");//($id_uo_gerencia);
		$this->var->add_param("NULL");//id_comprador
		$this->var->add_param("NULL");//permite_agrupar
		$this->var->add_param("NULL");//id_depto
		
		$this->var->add_param("NULL");//proveedores_prop
        $this->var->add_param("NULL");//
        $this->var->add_param("NULL");//
        $this->var->add_param("'$pago_variable'");//tipo_recibo  o  $pago_variable
        $this->var->add_param("NULL");//tipo_presu

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
//echo $this->query; exit;
		return $res;
	}
	
	function ModificarModalidadCompra($id_solicitud_compra,$id_tipo_categoria_adq,$p_agrupar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_iud';
		$this->codigo_procedimiento = "'AD_SADQMOD_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_solicitud_compra);//id_solicitud_compra
	    $this->var->add_param("NULL");//precio_total
		$this->var->add_param("NULL");//observaciones
		$this->var->add_param("NULL");//fecha_venc
		$this->var->add_param("NULL");//fecha_reg
		$this->var->add_param("NULL");//hora_reg
		$this->var->add_param("NULL");//localidad
		$this->var->add_param("NULL");//num_solicitud
		$this->var->add_param("NULL");//estado_reg
		
		$this->var->add_param("NULL");//estado_vigente_solicitud
		$this->var->add_param("NULL");//tipo_adjudicacion
		$this->var->add_param("NULL");//modalidad  (nacional,internacioal)
		$this->var->add_param("NULL");//id_solicitud_compra_anterior
		$this->var->add_param($id_tipo_categoria_adq);//ad_id_tipo_categoria_adq
		$this->var->add_param("NULL");//id_empleado_frrpa_solicitante
		$this->var->add_param("NULL");//id_moneda
		$this->var->add_param("NULL");//id_rpa
		$this->var->add_param("NULL");//id_usuario_transcriptor
		$this->var->add_param("NULL");//id_unidad_organizacional
		
		$this->var->add_param("NULL");//id_empleado_frrpa_pre_aprobacion
		$this->var->add_param("NULL");//id_empleado_frppa_aprobacion
		$this->var->add_param("NULL");//id_enpleado_frppa_gfa
		$this->var->add_param("NULL");//codigo_sicoes
		$this->var->add_param("NULL");//suguiente_estado
		$this->var->add_param("NULL");//ad_periodo
		$this->var->add_param("NULL");//gestion
		$this->var->add_param("NULL");//num_solicitud_sis
		$this->var->add_param("NULL");//id_frppa
		$this->var->add_param("NULL");//id_tipo_adq
		$this->var->add_param("NULL");//id_fin
		
		$this->var->add_param("NULL");//id_reg
		$this->var->add_param("NULL");//id_prog
		$this->var->add_param("NULL");//id_proy
		$this->var->add_param("NULL");//id_act
		$this->var->add_param("NULL");//id_empresa
		$this->var->add_param("NULL");//id_orden_trabajo
		$this->var->add_param("NULL");//id_almacen_logico
		$this->var->add_param("NULL");//$id_uo_gerencia;
		$this->var->add_param("NULL");//id_comprador		
		$this->var->add_param("$p_agrupar");//permite_agrupar
		$this->var->add_param("NULL");//id_depto
		$this->var->add_param("NULL");//proveedores_prop
        $this->var->add_param("NULL");//
        $this->var->add_param("NULL");//
          $this->var->add_param("NULL");//tipo_recibo
        $this->var->add_param("NULL");//tipo_presu

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		
		$this->query = $this->var->query;
		

		return $res;
	}
	
	
	
	/*function ModificarCompraRapidaSimplificada($id_solicitud_compra,$codigo_proceso,$observaciones_proceso,$id_empresa,$id_comprador,$tipo_recibo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_iud';
		$this->codigo_procedimiento = "'AD_COMRAPSIMP_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_solicitud_compra);
		$this->var->add_param("NULL");
		$this->var->add_param("'$observaciones_proceso'");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("'$codigo_proceso'");
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
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("$id_empresa");//id_empresa
		$this->var->add_param("NULL");//id_orden_trabajo
		$this->var->add_param("NULL");//id_almacen_logico
		$this->var->add_param("NULL");//($id_uo_gerencia);
		$this->var->add_param($id_comprador);//id_comprador
		$this->var->add_param("NULL");//permite_agrupar
		$this->var->add_param("NULL");//id_depto
		$this->var->add_param("NULL");//proveedores_prop
        $this->var->add_param("NULL");//
        $this->var->add_param("NULL");//
        $this->var->add_param("'$tipo_recibo'");//tipo_recibo
        $this->var->add_param("NULL");//tipo_presu

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}*/
	
	function ModificarCompraRapidaSimplificada($id_solicitud_compra,$codigo_proceso,$observaciones_proceso,$id_empresa,$id_comprador,$tipo_recibo,$fecha_reg)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_iud';
		$this->codigo_procedimiento = "'AD_COMRAPSIMP_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_solicitud_compra);
		$this->var->add_param("NULL");
		$this->var->add_param("'$observaciones_proceso'");
		$this->var->add_param("NULL");
		
		$this->var->add_param("'$fecha_reg'");//modificado 21/04/2010 :cambio por FER fechas/numeros editables
		$this->var->add_param("NULL");
		$this->var->add_param("'$codigo_proceso'");
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
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("$id_empresa");//id_empresa
		$this->var->add_param("NULL");//id_orden_trabajo
		$this->var->add_param("NULL");//id_almacen_logico
		$this->var->add_param("NULL");//($id_uo_gerencia);
		$this->var->add_param($id_comprador);//id_comprador
		$this->var->add_param("NULL");//permite_agrupar
		$this->var->add_param("NULL");//id_depto
		$this->var->add_param("NULL");//proveedores_prop
        $this->var->add_param("NULL");//
        $this->var->add_param("NULL");//
        $this->var->add_param("'$tipo_recibo'");//tipo_recibo
        $this->var->add_param("NULL");//tipo_presu

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	
	/**
	 * Nombre de la funci�n:	FinalizarSolicitudCompra
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tad_solicitud_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 10:00:27
	 */
	function FinalizarSolicitudCompra($id_solicitud_compra)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_iud';
		$this->codigo_procedimiento = "'AD_SOADFI_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("$id_solicitud_compra");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//id_empresa
		
		$this->var->add_param("NULL");//id_orden_trabajo
		$this->var->add_param("NULL");//id_almacen_logico
		$this->var->add_param("NULL");//($id_uo_gerencia);
		$this->var->add_param("NULL");//id_comprador
		$this->var->add_param("NULL");//permite_agrupar
		$this->var->add_param("NULL");//id_depto
		$this->var->add_param("NULL");//proveedores_prop
        $this->var->add_param("NULL");//
        $this->var->add_param("NULL");//
          $this->var->add_param("NULL");//tipo_recibo
        $this->var->add_param("NULL");//tipo_presu
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	
	
	/**
	 * Nombre de la funci�n:	ModificarSolicitudCompra
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tad_solicitud_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 10:00:27
	 *//*
	function ModificarSolicitudCompra($id_solicitud_compra,$precio_total,$observaciones,$fecha_venc,$fecha_reg,$hora_reg,$localidad,$num_solicitud,$estado_reg,$estado_vigente_solicitud,$tipo_adjudicacion,$modalidad,$id_solicitud_compra_ant,$id_tipo_categoria_adq,$id_empleado_frppa_solicitante,$id_moneda,$id_rpa,$id_empleado_frppa_transcriptor,$id_unidad_organizacional,$id_empleado_frppa_pre_aprobacion,$id_empleado_frppa_aprobacion,$id_empleado_frppa_gfa,$codigo_sicoes,$siguiente_estado,$periodo,$gestion,$num_solicitud_sis,$id_frppa,$id_tipo_adq,$txt_id_fin,$txt_id_reg,$txt_id_prog,$txt_id_proy,$txt_id_act,$id_empresa,$id_orden_trabajo,$id_almacen_logico,$id_uo_gerencia,$id_depto,$proveedores_propuestos,$comite_calificacion,$comite_recepcion,$avance,$tipo_presu)*/
	function ModificarSolicitudCompra($id_solicitud_compra, $precio_total, $observaciones, $fecha_venc, $fecha_reg, $hora_reg, $localidad, $num_solicitud, $estado_reg, $estado_vigente_solicitud, $tipo_adjudicacion, $modalidad,  $id_tipo_categoria_adq, $id_empleado_frppa_solicitante, $id_moneda, $id_rpa, $id_empleado_frppa_transcriptor,  $id_unidad_organizacional, $id_empleado_frppa_pre_aprobacion, $id_empleado_frppa_aprobacion, $id_empleado_frppa_gfa, $periodo, $gestion,  $id_presupuesto,$id_tipo_adq,$id_empresa,$id_orden_trabajo,$id_almacen_logico,$id_uo_gerencia,$id_depto,$proveedores_propuestos,$comite_calificacion,$comite_recepcion,$avance,$id_correspondencia)
	{                              
	    //
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_iud';
		$this->codigo_procedimiento = "'AD_SOLADQ_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		/*$this->var->add_param($id_solicitud_compra);
		$this->var->add_param($precio_total);
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$fecha_venc'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param("'$hora_reg'");
		$this->var->add_param("'$localidad'");
		$this->var->add_param($num_solicitud);
		$this->var->add_param("'$estado_reg'");
		$this->var->add_param("'$estado_vigente_solicitud'");//
		$this->var->add_param("'$tipo_adjudicacion'");
		$this->var->add_param("'$modalidad'");
		$this->var->add_param($id_solicitud_compra_ant);
		$this->var->add_param($id_tipo_categoria_adq);
		$this->var->add_param($id_empleado_frppa_solicitante);
		$this->var->add_param($id_moneda);
		$this->var->add_param($id_rpa);
		$this->var->add_param($id_empleado_frppa_transcriptor);
		$this->var->add_param($id_unidad_organizacional);
		$this->var->add_param($id_empleado_frppa_pre_aprobacion);//
		$this->var->add_param($id_empleado_frppa_aprobacion);
		$this->var->add_param($id_empleado_frppa_gfa);
		$this->var->add_param("'$codigo_sicoes'");
		$this->var->add_param("'$siguiente_estado'");
		$this->var->add_param($periodo);
		$this->var->add_param($gestion);
		$this->var->add_param($num_solicitud_sis);
		$this->var->add_param("'$id_frppa'");
		$this->var->add_param("'$id_tipo_adq'");
		$this->var->add_param("$txt_id_fin");//
		$this->var->add_param("$txt_id_reg");
		$this->var->add_param("$txt_id_prog");
		$this->var->add_param("$txt_id_proy");
		$this->var->add_param("$txt_id_act");
		$this->var->add_param($id_empresa);//id_empresa
		$this->var->add_param($id_orden_trabajo);//id_orden_trabajo
		$this->var->add_param($id_almacen_logico);//id_almacen_logico
		$this->var->add_param($id_uo_gerencia);
		 $this->var->add_param("NULL");//id_comprador
		 $this->var->add_param("NULL");//permite_agrupar
		 $this->var->add_param($id_depto);//id_depto
		 $this->var->add_param("'$proveedores_propuestos'");//proveedores_prop
        $this->var->add_param("'$comite_calificacion'");//
        $this->var->add_param("'$comite_recepcion'");//
         $this->var->add_param("'$avance'");//tipo_recibo
         $this->var->add_param("'$tipo_presu'");//tipo_presu*/
		$this->var->add_param($id_solicitud_compra);//6
		$this->var->add_param($precio_total);//7
		$this->var->add_param("'$observaciones'");//8
		$this->var->add_param("'$fecha_venc'");//9
		$this->var->add_param("'$fecha_reg'");//0
		$this->var->add_param("'$hora_reg'");//11
		$this->var->add_param("'$localidad'");//12
		$this->var->add_param($num_solicitud);//13
		$this->var->add_param("'$estado_reg'");//14
		$this->var->add_param("'$estado_vigente_solicitud'");//15
		
		$this->var->add_param("'$tipo_adjudicacion'");//16
		$this->var->add_param("'$modalidad'");//17
		$this->var->add_param($id_tipo_categoria_adq);//18
		$this->var->add_param($id_empleado_frppa_solicitante);//19
		$this->var->add_param($id_moneda);//20
		$this->var->add_param($id_rpa);//21
		$this->var->add_param($id_empleado_frppa_transcriptor);//22
		$this->var->add_param($id_unidad_organizacional);//23
		$this->var->add_param($id_empleado_frppa_pre_aprobacion);//24
		$this->var->add_param($id_empleado_frppa_aprobacion);//25
		
		$this->var->add_param($id_empleado_frppa_gfa);//26
		$this->var->add_param("null");//27
		$this->var->add_param($periodo);//28
		$this->var->add_param($gestion);//29
		$this->var->add_param("null");//30
		$this->var->add_param("'$id_presupuesto'");//31
		$this->var->add_param("'$id_tipo_adq'");//32
		$this->var->add_param($id_empresa);//id_empresa 33
		$this->var->add_param($id_orden_trabajo);//id_orden_trabajo
		$this->var->add_param($id_almacen_logico);//id_almacen_logico
		
		$this->var->add_param($id_uo_gerencia);//36
		$this->var->add_param("NULL");//id_comprador
		$this->var->add_param("NULL");//permite_agrupar
		$this->var->add_param($id_depto);//id_depto
		$this->var->add_param("'$proveedores_propuestos'");//proveedores_prop
        $this->var->add_param("'$comite_calificacion'");//41
        $this->var->add_param("'$comite_recepcion'");//42
        $this->var->add_param("'$avance'");//tipo_recibo
         
         if(isset($id_correspondencia)){
		$this->var->add_param_array($id_correspondencia);
		}
		else{
			$this->var->add_param_array("NULL");//id_correspondencia_asociada
		}
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
	return $res;
	}
	
	
	/**
	 * Nombre de la funci�n:	ModificarSolicitudCompra
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tad_solicitud_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 10:00:27
	 */
	/*function ModificarSolicitudCompraRPA($id_solicitud_compra,$id_rpa)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_iud';
		$this->codigo_procedimiento = "'AD_SOLRPA_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_solicitud_compra);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($id_rpa);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//id_empresa
		$this->var->add_param("NULL");//id_orden_trabajo
		$this->var->add_param("NULL");//id_almacen_logico
		$this->var->add_param("NULL");//($id_uo_gerencia);
		$this->var->add_param("NULL");//id_comprador
		$this->var->add_param("NULL");//permite_agrupar
		$this->var->add_param("NULL");//id_depto
		$this->var->add_param("NULL");//proveedores_prop
        $this->var->add_param("NULL");//
        $this->var->add_param("NULL");//
          $this->var->add_param("NULL");//tipo_recibo
         $this->var->add_param("NULL");//tipo_presu
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}*/
	function ModificarSolicitudCompraRPA($id_solicitud_compra,$id_rpa,$comite_calificacion,$id_tipo_categoria_adq,$id_empleado_aprobacion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_iud';
		$this->codigo_procedimiento = "'AD_SOADFI_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_solicitud_compra);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($id_tipo_categoria_adq);//id_tipo_cat_adq
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("null");//21
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		$this->var->add_param($id_empleado_aprobacion);
		
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//id_empresa
		$this->var->add_param("NULL");//id_orden_trabajo
		$this->var->add_param("NULL");//id_almacen_logico
		
		$this->var->add_param("NULL");//($id_uo_gerencia);
		$this->var->add_param("NULL");//id_comprador
		$this->var->add_param("NULL");//permite_agrupar
		$this->var->add_param("NULL");//id_depto
		$this->var->add_param("NULL");//proveedores_prop
        $this->var->add_param("'$comite_calificacion'");//comite_calif
        $this->var->add_param("NULL");//
        $this->var->add_param("NULL");//tipo_recibo
        if(isset($id_rpa)){
		$this->var->add_param_array($id_rpa);
		}
		else{
			$this->var->add_param_array("NULL");//id_correspondencia_asociada
		}
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
/*echo $this->query;
exit;*/
		return $res;
	}
	
	
	/**
	 * Nombre de la funci�n:	EliminarSolicitudCompra
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tad_solicitud_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 10:00:27
	 */
	function EliminarSolicitudCompra($id_solicitud_compra)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_iud';
		$this->codigo_procedimiento = "'AD_SOLADQ_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_solicitud_compra);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//id_empresa
		$this->var->add_param("NULL");//id_orden_trabajo
		$this->var->add_param("NULL");//id_almacen_logico
		$this->var->add_param("NULL");//($id_uo_gerencia);
	    $this->var->add_param("NULL");//id_comprador
		$this->var->add_param("NULL");//permite_agrupar
		$this->var->add_param("NULL");//id_depto
		$this->var->add_param("NULL");//proveedores_propuestos
		$this->var->add_param("NULL");//comite_calificacion
		$this->var->add_param("NULL");//comite_recepcion
		  $this->var->add_param("NULL");//tipo_recibo
		$this->var->add_param("NULL");//tipo_presu

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	function AnularSolicitud($id_solicitud_compra,$observaciones)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_iud';
		$this->codigo_procedimiento = "'AD_ANUSOL_PRO'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_solicitud_compra);
		$this->var->add_param("NULL");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//id_empresa
		$this->var->add_param("NULL");//id_orden_trabajo
		$this->var->add_param("NULL");//id_almacen_logico
		$this->var->add_param("NULL");//($id_uo_gerencia);
		$this->var->add_param("NULL");//id_comprador
		$this->var->add_param("NULL");//permite_agrupar
		$this->var->add_param("NULL");//id_depto
		$this->var->add_param("NULL");//proveedores_propuestos
		$this->var->add_param("NULL");//comite_calificacion
		$this->var->add_param("NULL");//comite_recepcion
		  $this->var->add_param("NULL");//tipo_recibo
		$this->var->add_param("NULL");//tipo_presu
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarSolicitudCompra
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tad_solicitud_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 10:00:27
	 */
	/*function ValidarSolicitudCompra($operacion_sql,$id_solicitud_compra,$precio_total,$observaciones,$fecha_venc,$fecha_reg,$hora_reg,$localidad,$num_solicitud,$estado_reg,$estado_vigente_solicitud,$tipo_adjudicacion,$modalidad,$id_solicitud_compra_ant,$id_tipo_categoria_adq,$id_empleado_frppa_solicitante,$id_moneda,$id_rpa,$id_empleado_frppa_transcriptor,$id_unidad_organizacional,$id_empleado_frppa_pre_aprobacion,$id_empleado_frppa_aprobacion,$id_empleado_frppa_gfa,$codigo_sicoes,$siguiente_estado,$periodo,$gestion,$num_solicitud_sis,$id_frppa)*/
	function ValidarSolicitudCompra($operacion_sql,$id_solicitud_compra,$precio_total,$observaciones,$fecha_venc,$fecha_reg,$hora_reg,$localidad,$num_solicitud,$estado_reg,$estado_vigente_solicitud,$tipo_adjudicacion,$modalidad,$id_solicitud_compra_ant,$id_tipo_categoria_adq,$id_empleado_frppa_solicitante,$id_moneda,$id_rpa,$id_empleado_frppa_transcriptor,$id_unidad_organizacional,$id_empleado_frppa_pre_aprobacion,$id_empleado_frppa_aprobacion,$id_empleado_frppa_gfa,$periodo,$gestion,$id_presupuesto)
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
				//Validar id_solicitud_compra - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_solicitud_compra");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_solicitud_compra", $id_solicitud_compra))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

		

			//Validar fecha_venc - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_venc");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_venc", $fecha_venc))
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


			//Validar localidad - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("localidad");
			$tipo_dato->set_MaxLength(50);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "localidad", $localidad))
			{
				$this->salida = $valid->salida;
				return false;
			}

		

			//Validar estado_reg - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_reg");
			$tipo_dato->set_MaxLength(18);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado_reg", $estado_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}

			

			//Validar modalidad - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("modalidad");
			$tipo_dato->set_MaxLength(30);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "modalidad", $modalidad))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_solicitud_compra_ant - tipo int4
		/*	$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_solicitud_compra_ant");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_solicitud_compra_ant", $id_solicitud_compra_ant))
			{
				$this->salida = $valid->salida;
				return false;
			}*/

			//Validar id_tipo_tipo_adq - tipo int4
		/*	$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_tipo_tipo_adq");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_adq", $id_tipo_categoria_adq))
			{
				$this->salida = $valid->salida;
				return false;
			}*/

			//Validar id_empleado_frppa_solicitante - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado_frppa_solicitante");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado_frppa_solicitante", $id_empleado_frppa_solicitante))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_moneda - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_moneda");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_moneda", $id_moneda))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_rpa - tipo int4
			/*$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_rpa");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_rpa", $id_rpa))
			{
				$this->salida = $valid->salida;
				return false;
			}*/

			//Validar id_empleado_frppa_transcriptor - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_usuario_transcriptor");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_usuario_transcriptor", $id_empleado_frppa_transcriptor))
			{
				$this->salida = $valid->salida;
				return false;
			}

			

			//Validar id_unidad_organizacional - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_unidad_organizacional");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_unidad_organizacional", $id_unidad_organizacional))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_empleado_frppa_pre_aprobacion - tipo int4
			/*$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado_frppa_pre_aprobacion");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado_frppa_pre_aprobacion", $id_empleado_frppa_pre_aprobacion))
			{
				$this->salida = $valid->salida;
				return false;
			}*/

			//Validar id_empleado_frppa_aprobacion - tipo int4
			/*$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado_frppa_aprobacion");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado_frppa_aprobacion", $id_empleado_frppa_aprobacion))
			{
				$this->salida = $valid->salida;
				return false;
			}*/

			//Validar id_empleado_frppa_gfa - tipo int4
			/*$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado_frppa_gfa");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado_frppa_gfa", $id_empleado_frppa_gfa))
			{
				$this->salida = $valid->salida;
				return false;
			}*/

			//Validar id_estado_compra_categoria_adq - tipo int4
		/*	$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_estado_compra_categoria_adq");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_estado_compra_categoria_adq", $id_estado_compra_categoria_adq))
			{
				$this->salida = $valid->salida;
				return false;
			}*/

			//Validar codigo_sicoes - tipo varchar
		/*	$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("codigo_sicoes");
			$tipo_dato->set_MaxLength(30);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "codigo_sicoes", $codigo_sicoes))
			{
				$this->salida = $valid->salida;
				return false;
			}*/

			//Validar siguiente_estado - tipo varchar
			/*$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("siguiente_estado");
			$tipo_dato->set_MaxLength(18);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "siguiente_estado", $siguiente_estado))
			{
				$this->salida = $valid->salida;
				return false;
			}*/

			//Validar periodo - tipo int4
		/*	$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("periodo");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "periodo", $periodo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar gestion - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("gestion");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "gestion", $gestion))
			{
				$this->salida = $valid->salida;
				return false;
			}*/

			//Validar num_solicitud_sis - tipo int4
			/*$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("num_solicitud_sis");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "num_solicitud_sis", $num_solicitud_sis))
			{
				$this->salida = $valid->salida;
				return false;
			}*/

			
			//Validaci�n de reglas de datos

			//Validar modalidad
			$check = array ("Nacional","Internacional");
			if(!in_array($modalidad,$check))
			{
				$this->salida[0] = "f";
				$this->salida[1] = "Error de validaci�n en columna 'modalidad': El valor no est� dentro del dominio definido";
				$this->salida[2] = "ORIGEN = $this->nombre_archivo";
				$this->salida[3] = "PROC = ValidarSolicitudCompra";
				$this->salida[4] = "NIVEL = 3";
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_solicitud_compra - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_solicitud_compra");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_solicitud_compra", $id_solicitud_compra))
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
	function ListarSeguimientoSolicitud($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$vista)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_sel';
		
		if($vista=='verificacion')
		$this->codigo_procedimiento = "'AD_VERSOL_SEL'";
		elseif($vista=='preaprobacion')
		$this->codigo_procedimiento = "'AD_PRESOL_SEL'";
		elseif($vista=='visto_bueno')
		
		$this->codigo_procedimiento = "'AD_VERTEC_SEL'";
		elseif ($vista=='aprobacion')
		$this->codigo_procedimiento = "'AD_APRSOL_SEL'";
		elseif ($vista=='seguimiento_solicitud_per')
		$this->codigo_procedimiento = "'AD_SEGPER_SEL'";
		else 
		$this->codigo_procedimiento = "'AD_SEGSOL_SEL'";
		

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
		$this->var->add_param("NULL");//id_empresa

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_solicitud_compra','int4');
		$this->var->add_def_cols('observaciones','text');
		$this->var->add_def_cols('localidad','varchar');
		$this->var->add_def_cols('siguiente_estado','varchar');
		$this->var->add_def_cols('tipo_adjudicacion','varchar');
		$this->var->add_def_cols('id_tipo_categoria_adq','int4');
		$this->var->add_def_cols('desc_tipo_categoria_adq','varchar');
		$this->var->add_def_cols('id_empleado_frppa_solicitante','int4');
		$this->var->add_def_cols('desc_empleado_tpm_frppa','text');
		$this->var->add_def_cols('id_moneda','int4');
		$this->var->add_def_cols('desc_moneda','varchar');
		$this->var->add_def_cols('id_rpa','int4');
		$this->var->add_def_cols('desc_rpa','text');
		
		$this->var->add_def_cols('id_unidad_organizacional','int4');
		$this->var->add_def_cols('desc_unidad_organizacional','varchar');
		$this->var->add_def_cols('id_fina_regi_prog_proy_acti','int4');
		$this->var->add_def_cols('desc_fina_regi_prog_proy_acti','int4');
		$this->var->add_def_cols('id_financiador','integer');
		$this->var->add_def_cols('id_regional','integer');
		$this->var->add_def_cols('id_programa','integer');
		$this->var->add_def_cols('id_proyecto','integer');
		$this->var->add_def_cols('id_actividad','integer');
		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		$this->var->add_def_cols('codigo_financiador','varchar');
		$this->var->add_def_cols('codigo_regional','varchar');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('codigo_proyecto','varchar');
		$this->var->add_def_cols('codigo_actividad','varchar');
		$this->var->add_def_cols('tipo_adq','varchar');
		$this->var->add_def_cols('num_solicitud','int4');
		$this->var->add_def_cols('estado','varchar');
		$this->var->add_def_cols('reformulacion','int4');
		$this->var->add_def_cols('periodo','int4');
		$this->var->add_def_cols('fecha_estado','date');
		$this->var->add_def_cols('gestion','integer');
		$this->var->add_def_cols('tiene_presupuesto','numeric');
		$this->var->add_def_cols('permite_agrupar','integer');
		$this->var->add_def_cols('justificacion','varchar');
		
		$this->var->add_def_cols('dias_min','integer');
		$this->var->add_def_cols('dias_max','integer');
		$this->var->add_def_cols('dias','integer');
		$this->var->add_def_cols('aprobador','text');//nuevo
		$this->var->add_def_cols('preaprobador','text');//nuevo
		$this->var->add_def_cols('fecha_sol','date');//nuevo
		$this->var->add_def_cols('monto_total','numeric');//nuevo
		$this->var->add_def_cols('tiene_suplente','int4');//nuevo
		$this->var->add_def_cols('suplente','text');//nuevo
		
		$this->var->add_def_cols('transcriptor','text');//nuevo
		$this->var->add_def_cols('nro_solicitud_cadena','varchar');
		
		/*
		$this->var->add_def_cols('id_solicitud_compra','int4');
		$this->var->add_def_cols('observaciones','text');
		$this->var->add_def_cols('localidad','varchar');
		$this->var->add_def_cols('siguiente_estado','varchar');
		$this->var->add_def_cols('tipo_adjudicacion','varchar');
		$this->var->add_def_cols('id_tipo_categoria_adq','int4');
		$this->var->add_def_cols('desc_tipo_categoria_adq','varchar');
		$this->var->add_def_cols('id_empleado_frppa_solicitante','int4');
		$this->var->add_def_cols('desc_empleado_tpm_frppa','text');
		$this->var->add_def_cols('id_moneda','int4');
		$this->var->add_def_cols('desc_moneda','varchar');
		
		$this->var->add_def_cols('id_unidad_organizacional','int4');
		$this->var->add_def_cols('desc_unidad_organizacional','varchar');
		$this->var->add_def_cols('id_fina_regi_prog_proy_acti','int4');
		$this->var->add_def_cols('desc_fina_regi_prog_proy_acti','int4');
//		$this->var->add_def_cols('id_financiador','integer');
//		$this->var->add_def_cols('id_regional','integer');
//		$this->var->add_def_cols('id_programa','integer');
//		$this->var->add_def_cols('id_proyecto','integer');
//		$this->var->add_def_cols('id_actividad','integer');
		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
//		$this->var->add_def_cols('codigo_financiador','varchar');
//		$this->var->add_def_cols('codigo_regional','varchar');
//		$this->var->add_def_cols('codigo_programa','varchar');
//		$this->var->add_def_cols('codigo_proyecto','varchar');
//		$this->var->add_def_cols('codigo_actividad','varchar');
		$this->var->add_def_cols('tipo_adq','varchar');
		$this->var->add_def_cols('num_solicitud','int4');
		$this->var->add_def_cols('estado','varchar');
		$this->var->add_def_cols('reformulacion','int4');
		$this->var->add_def_cols('periodo','int4');
		$this->var->add_def_cols('fecha_estado','date');
		$this->var->add_def_cols('gestion','integer');
		$this->var->add_def_cols('tiene_presupuesto','numeric');
		$this->var->add_def_cols('permite_agrupar','integer');
		$this->var->add_def_cols('justificacion','varchar');
		
		$this->var->add_def_cols('dias_min','integer');
		$this->var->add_def_cols('dias_max','integer');
		$this->var->add_def_cols('dias','integer');
		$this->var->add_def_cols('aprobador','text');//nuevo
		$this->var->add_def_cols('preaprobador','text');//nuevo
		$this->var->add_def_cols('fecha_sol','date');//nuevo
		$this->var->add_def_cols('monto_total','numeric');//nuevo
		$this->var->add_def_cols('tiene_suplente','int4');//nuevo
		$this->var->add_def_cols('suplente','text');//nuevo
		$this->var->add_def_cols('fecha_venc','date');//fecha_venc
		$this->var->add_def_cols('hora_reg','time');//nuevo
		$this->var->add_def_cols('usuario_reg','text');//nuevo
		$this->var->add_def_cols('depto','text');//nuevo		
		*/
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
//		echo $this->query;
//		exit;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarSeguimientoSolicitud
	 * Prop�sito:				Contar los registros de tad_solicitud_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-15 19:30:38
	 */
	function ContarSeguimientoSolicitud($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$vista)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_sel';
		if($vista=='verificacion')
		$this->codigo_procedimiento = "'AD_VERSOL_COUNT'";
		elseif($vista=='preaprobacion')
		$this->codigo_procedimiento = "'AD_PRESOL_COUNT'";
		elseif ($vista=='aprobacion')
		$this->codigo_procedimiento = "'AD_APRSOL_COUNT'";
		elseif ($vista=='seguimiento_solicitud_per')
		$this->codigo_procedimiento = "'AD_SEGPER_COUNT'";
		else 
		$this->codigo_procedimiento = "'AD_SEGSOL_COUNT'";

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

		$this->var->add_param("NULL");
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
	 * Nombre de la funci�n:	ModificarSeguimientoSolicitud
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tad_solicitud_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-15 19:30:38
	 */
	function ModificarSeguimientoSolicitud($id_solicitud_compra,$operacion,$observaciones)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_iud';
		if($operacion=='preaprobar' or $operacion=='visto_bueno'){
			$this->codigo_procedimiento = "'AD_PRESOL_UPD'";
		}
		if($operacion=='aprobar'){
			$this->codigo_procedimiento = "'AD_APRSOL_UPD'";
		}
		if($operacion=='suspender'){
			$this->codigo_procedimiento = "'AD_SUSSOL_UPD'";
		}
		if($operacion=='cancelar'){
			$this->codigo_procedimiento = "'AD_CANSOL_UPD'";
		}
		if($operacion=='aprobar_presupuesto'){
			$this->codigo_procedimiento = "'AD_VERAPR_UPD'";
		}
		if($operacion=='correccion'){
			$this->codigo_procedimiento = "'AD_CORSOL_UPD'";
		}

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_solicitud_compra);
		$this->var->add_param("NULL");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("'$operacion'");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//id_empresa
		$this->var->add_param("NULL");//id_orden_trabajo
		$this->var->add_param("NULL");//id_almacen_logico
		$this->var->add_param("NULL");//($id_uo_gerencia);
		$this->var->add_param("NULL");//id_comprador
		$this->var->add_param("NULL");//permite_agrupar
		$this->var->add_param("NULL");//id_depto
		$this->var->add_param("NULL");//proveedores_propuestos
		$this->var->add_param("NULL");//comite_calificacion
		$this->var->add_param("NULL");//comite_recepcion
		$this->var->add_param("NULL");//tipo_recibo
		$this->var->add_param("NULL");//tipo_presu
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		exit();*/
		return $res;
	}
	
	
	/**
	 * Nombre de la funci�n:	ValidarSeguimientoSolicitud
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tad_solicitud_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-15 19:30:38
	 */
	function ValidarSeguimientoSolicitud($operacion_sql,$id_solicitud_compra,$observaciones,$localidad,$estado_vigente_solicitud,$tipo_adjudicacion,$id_tipo_categoria_adq,$id_empleado_frppa_solicitante,$id_moneda,$id_rpa,$id_unidad_organizacional,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
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
				//Validar id_solicitud_compra - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_solicitud_compra");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_solicitud_compra", $id_solicitud_compra))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar observaciones - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("observaciones");
			$tipo_dato->set_MaxLength(300);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "observaciones", $observaciones))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar localidad - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("localidad");
			$tipo_dato->set_MaxLength(50);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "localidad", $localidad))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar estado_vigente_solicitud - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_vigente_solicitud");
			$tipo_dato->set_MaxLength(30);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado_vigente_solicitud", $estado_vigente_solicitud))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar tipo_adjudicacion - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("tipo_adjudicacion");
			$tipo_dato->set_MaxLength(30);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "tipo_adjudicacion", $tipo_adjudicacion))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_tipo_categoria_adq - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_tipo_categoria_adq");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_categoria_adq", $id_tipo_categoria_adq))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_empleado_frppa_solicitante - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado_frppa_solicitante");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado_frppa_solicitante", $id_empleado_frppa_solicitante))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_moneda - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_moneda");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_moneda", $id_moneda))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_rpa - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_rpa");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_rpa", $id_rpa))
			{
				$this->salida = $valid->salida;
				return false;
			}

			

			//Validar id_unidad_organizacional - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_unidad_organizacional");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_unidad_organizacional", $id_unidad_organizacional))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_financiador - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_financiador");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_financiador", $id_financiador))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_regional - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_regional");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_regional", $id_regional))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_programa - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_programa");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_programa", $id_programa))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_proyecto - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_proyecto");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_proyecto", $id_proyecto))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_actividad - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_actividad");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_actividad", $id_actividad))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_solicitud_compra - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_solicitud_compra");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_solicitud_compra", $id_solicitud_compra))
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

	function RepSolicitudProceso($id_proceso_compra,$id_solicitud_compra,$tipo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_comprometido_sol_rep_sel';
		
		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,"");
        
    	$this->var->add_param($id_proceso_compra);//id_item
    	$this->var->add_param($id_solicitud_compra);//id_item
		$this->var->add_param($tipo);//id_servicio

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_solicitud_compra','int4'); //0
		$this->var->add_def_cols('num_solicitud','text');//1
		$this->var->add_def_cols('localidad','varchar');//2
		$this->var->add_def_cols('fecha_reg','date');//3
		$this->var->add_def_cols('hora_reg','time');//4
		$this->var->add_def_cols('nombre_unidad','varchar');//5
		$this->var->add_def_cols('nombre_solicitante','varchar');//6
		$this->var->add_def_cols('nombre_aprobacion','varchar');//7
		$this->var->add_def_cols('tipo_adq','varchar');//8
		$this->var->add_def_cols('cargo_empleado_solicitante','varchar');//9
		$this->var->add_def_cols('cargo_empleado_aprobador','varchar');//10
		$this->var->add_def_cols('nombre_financiador','varchar');//11
		$this->var->add_def_cols('nombre_regional','varchar');//12
		$this->var->add_def_cols('nombre_programa','varchar');//13
		$this->var->add_def_cols('nombre_proyecto','varchar');//14
		$this->var->add_def_cols('nombre_actividad','varchar');//15
		
		$this->var->add_def_cols('dia','text');//16
		$this->var->add_def_cols('mes','text');//17
		$this->var->add_def_cols('ano','text');//18
		$this->var->add_def_cols('monto_total','numeric');//19
		$this->var->add_def_cols('moneda','varchar');//20
		
		
		$this->var->add_def_cols('codigo_depto','varchar');//21
		$this->var->add_def_cols('modalidad','varchar');//22
		$this->var->add_def_cols('reformular','integer');//23
		$this->var->add_def_cols('gestion_comprometido','numeric');//24
		$this->var->add_def_cols('codigo_proceso','varchar');//25
		$this->var->add_def_cols('id_proceso_compra','integer');//26
		
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query_sss();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
//echo $this->query;
//exit;
		return $res;
	}
	
	
	function RepPartidaProceso($id_proceso_compra,$id_solicitud_compra,$tipo)
	{ 
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_comprometido_sol_rep_sel';
		
		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,"");
        
    	$this->var->add_param($id_proceso_compra);//id_item
		$this->var->add_param($id_solicitud_compra);//id_item
		$this->var->add_param($tipo);//id_servicio

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('descripcion', 'text');
		//$this->var->add_def_cols('id_partida', 'integer');
		$this->var->add_def_cols('codigo_partida','varchar');
		$this->var->add_def_cols('nombre_partida','varchar');
		$this->var->add_def_cols('monto_comprometido','numeric');
		$this->var->add_def_cols('fecha','text');
		$this->var->add_def_cols('id_solicitud_compra_det','integer');//27
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query_sss();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
//		echo $this->query;
//		exit;
		return $res;
	}
	
	function ContarTotalSolicitudCompra($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_solicitud_compra)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_compra_sel';
		$this->codigo_procedimiento = "'AD_SOLTOT_SEL'";

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
		$this->var->add_param($id_solicitud_compra);//id_empresa

		
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('nombre_categoria','varchar');
		$this->var->add_def_cols('id_tipo_categoria','int4');
		$this->var->add_def_cols('doc_respaldo','varchar');
		$this->var->add_def_cols('monto_total','numeric');
		$this->var->add_def_cols('correspondencia','varchar');
		$this->var->add_def_cols('cambiar_aprobador','varchar');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n
		$this->salida = $this->var->salida;

		//Si la ejecuci�n fue satisfactoria modifica la salida para que solo devuelva el total de la consulta
		if($res)
		{
			$this->salida = $this->var->salida;
		}

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
}?>
