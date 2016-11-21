<?php
/**
 * Nombre de la clase:	cls_DBTransferencia.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tal_tal_transferencia
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-11-21 08:58:38
 */

class cls_DBTransferencia
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
	 * Nombre de la funci�n:	ListarTransferencia
	 * Prop�sito:				Desplegar los registros de tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function ListarTransfBorrador($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_sel';
		$this->codigo_procedimiento = "'AL_TRABOR_SEL'";

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
		$this->var->add_def_cols('id_transferencia','int4');
		$this->var->add_def_cols('prestamo','varchar');
		$this->var->add_def_cols('estado_transferencia','varchar');
		$this->var->add_def_cols('motivo','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('fecha_pendiente_sal','date');
		$this->var->add_def_cols('fecha_pendiente_ing','date');
		$this->var->add_def_cols('fecha_finalizado_anulado','date');
		$this->var->add_def_cols('id_empleado','int4');

		$this->var->add_def_cols('desc_empleado','text');
		$this->var->add_def_cols('id_firma_autorizada_transf','int4');
		$this->var->add_def_cols('desc_firma_autorizada','text');
		$this->var->add_def_cols('id_almacen_logico','int4');
		$this->var->add_def_cols('desc_almacen_logico_orig','varchar');
		$this->var->add_def_cols('id_almacen_logico_destino','int4');
		$this->var->add_def_cols('desc_almacen_logico_dest','varchar');
		$this->var->add_def_cols('id_motivo_ingreso_cuenta','int4');
		$this->var->add_def_cols('desc_motivo_ingreso_cuenta','varchar');
		$this->var->add_def_cols('desc_almacen_orig','varchar');

		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		$this->var->add_def_cols('id_financiador','int4');
		$this->var->add_def_cols('id_regional','int4');
		$this->var->add_def_cols('id_programa','int4');
		$this->var->add_def_cols('id_proyecto','int4');
		$this->var->add_def_cols('id_actividad','int4');

		$this->var->add_def_cols('codigo_financiador','varchar');
		$this->var->add_def_cols('codigo_regional','varchar');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('codigo_proyecto','varchar');
		$this->var->add_def_cols('codigo_actividad','varchar');
		$this->var->add_def_cols('desc_almacen_dest','varchar');
		$this->var->add_def_cols('nombre_financiador_dest','varchar');
		$this->var->add_def_cols('nombre_regional_dest','varchar');
		$this->var->add_def_cols('nombre_programa_dest','varchar');
		$this->var->add_def_cols('nombre_proyecto_dest','varchar');

		$this->var->add_def_cols('nombre_actividad_dest','varchar');
		$this->var->add_def_cols('id_financiador_dest','int4');
		$this->var->add_def_cols('id_regional_dest','int4');
		$this->var->add_def_cols('id_programa_dest','int4');
		$this->var->add_def_cols('id_proyecto_dest','int4');
		$this->var->add_def_cols('id_actividad_dest','int4');
		$this->var->add_def_cols('codigo_financiador_dest','varchar');
		$this->var->add_def_cols('codigo_regional_dest','varchar');
		$this->var->add_def_cols('codigo_programa_dest','varchar');
		$this->var->add_def_cols('codigo_proyecto_dest','varchar');

		$this->var->add_def_cols('codigo_actividad_dest','varchar');
		$this->var->add_def_cols('fecha_borrador','date');
		$this->var->add_def_cols('fecha_pendiente','date');
		$this->var->add_def_cols('fecha_rechazado','date');
		$this->var->add_def_cols('id_ingreso','int4');
		$this->var->add_def_cols('id_salida','int4');
		$this->var->add_def_cols('id_tipo_material','int4');
		$this->var->add_def_cols('desc_tipo_material','varchar');
		$this->var->add_def_cols('id_motivo_salida_cuenta','int4');
		$this->var->add_def_cols('desc_motivo_salida_cuenta','varchar');

		$this->var->add_def_cols('desc_motivo_ingreso','varchar');
		$this->var->add_def_cols('desc_motivo_salida','varchar');
		$this->var->add_def_cols('id_ingreso_prestamo','int4');
		$this->var->add_def_cols('id_salida_prestamo','int4');
		
		$this->var->add_def_cols('id_almacen_dest','int4');
       
        $this->var->add_def_cols('id_almacen_orig','int4');
		
		$this->var->add_def_cols('id_motivo_salida','int4');
       $this->var->add_def_cols('id_motivo_ingreso','int4');
       

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ListarTransferencia
	 * Prop�sito:				Desplegar los registros de tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function ListarTransfPendiente($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_sel';
		$this->codigo_procedimiento = "'AL_TRAPEN_SEL'";

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
		$this->var->add_def_cols('id_transferencia','int4');
		$this->var->add_def_cols('prestamo','varchar');
		$this->var->add_def_cols('estado_transferencia','varchar');
		$this->var->add_def_cols('motivo','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('fecha_pendiente_sal','date');
		$this->var->add_def_cols('fecha_pendiente_ing','date');
		$this->var->add_def_cols('fecha_finalizado_anulado','date');
		$this->var->add_def_cols('id_empleado','int4');

		$this->var->add_def_cols('desc_empleado','text');
		$this->var->add_def_cols('id_firma_autorizada_transf','int4');
		$this->var->add_def_cols('desc_firma_autorizada','text');
		$this->var->add_def_cols('id_almacen_logico','int4');
		$this->var->add_def_cols('desc_almacen_logico_orig','varchar');
		$this->var->add_def_cols('id_almacen_logico_destino','int4');
		$this->var->add_def_cols('desc_almacen_logico_dest','varchar');
		$this->var->add_def_cols('id_motivo_ingreso_cuenta','int4');
		$this->var->add_def_cols('desc_motivo_ingreso_cuenta','varchar');
		$this->var->add_def_cols('desc_almacen_orig','varchar');

		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		$this->var->add_def_cols('id_financiador','int4');
		$this->var->add_def_cols('id_regional','int4');
		$this->var->add_def_cols('id_programa','int4');
		$this->var->add_def_cols('id_proyecto','int4');
		$this->var->add_def_cols('id_actividad','int4');

		$this->var->add_def_cols('codigo_financiador','varchar');
		$this->var->add_def_cols('codigo_regional','varchar');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('codigo_proyecto','varchar');
		$this->var->add_def_cols('codigo_actividad','varchar');
		$this->var->add_def_cols('desc_almacen_dest','varchar');
		$this->var->add_def_cols('nombre_financiador_dest','varchar');
		$this->var->add_def_cols('nombre_regional_dest','varchar');
		$this->var->add_def_cols('nombre_programa_dest','varchar');
		$this->var->add_def_cols('nombre_proyecto_dest','varchar');

		$this->var->add_def_cols('nombre_actividad_dest','varchar');
		$this->var->add_def_cols('id_financiador_dest','int4');
		$this->var->add_def_cols('id_regional_dest','int4');
		$this->var->add_def_cols('id_programa_dest','int4');
		$this->var->add_def_cols('id_proyecto_dest','int4');
		$this->var->add_def_cols('id_actividad_dest','int4');
		$this->var->add_def_cols('codigo_financiador_dest','varchar');
		$this->var->add_def_cols('codigo_regional_dest','varchar');
		$this->var->add_def_cols('codigo_programa_dest','varchar');
		$this->var->add_def_cols('codigo_proyecto_dest','varchar');

		$this->var->add_def_cols('codigo_actividad_dest','varchar');
		$this->var->add_def_cols('fecha_borrador','date');
		$this->var->add_def_cols('fecha_pendiente','date');
		$this->var->add_def_cols('fecha_rechazado','date');
		$this->var->add_def_cols('id_ingreso','int4');
		$this->var->add_def_cols('id_salida','int4');
		$this->var->add_def_cols('id_tipo_material','int4');
		$this->var->add_def_cols('desc_tipo_material','varchar');
		$this->var->add_def_cols('id_motivo_salida_cuenta','int4');
		$this->var->add_def_cols('desc_motivo_salida_cuenta','varchar');

		$this->var->add_def_cols('desc_motivo_ingreso','varchar');
		$this->var->add_def_cols('desc_motivo_salida','varchar');
		$this->var->add_def_cols('id_ingreso_prestamo','int4');
		$this->var->add_def_cols('id_salida_prestamo','int4');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ListarTransferencia
	 * Prop�sito:				Desplegar los registros de tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function ListarTransfSeguimiento($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_sel';
		$this->codigo_procedimiento = "'AL_TRASEG_SEL'";

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
		$this->var->add_def_cols('id_transferencia','int4');
		$this->var->add_def_cols('prestamo','varchar');
		$this->var->add_def_cols('estado_transferencia','varchar');
		$this->var->add_def_cols('motivo','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('fecha_pendiente_sal','date');
		$this->var->add_def_cols('fecha_pendiente_ing','date');
		$this->var->add_def_cols('fecha_finalizado_anulado','date');
		$this->var->add_def_cols('id_empleado','int4');

		$this->var->add_def_cols('desc_empleado','text');
		$this->var->add_def_cols('id_firma_autorizada_transf','int4');
		$this->var->add_def_cols('desc_firma_autorizada','text');
		$this->var->add_def_cols('id_almacen_logico','int4');
		$this->var->add_def_cols('desc_almacen_logico_orig','varchar');
		$this->var->add_def_cols('id_almacen_logico_destino','int4');
		$this->var->add_def_cols('desc_almacen_logico_dest','varchar');
		$this->var->add_def_cols('id_motivo_ingreso_cuenta','int4');
		$this->var->add_def_cols('desc_motivo_ingreso_cuenta','varchar');
		$this->var->add_def_cols('desc_almacen_orig','varchar');

		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		$this->var->add_def_cols('id_financiador','int4');
		$this->var->add_def_cols('id_regional','int4');
		$this->var->add_def_cols('id_programa','int4');
		$this->var->add_def_cols('id_proyecto','int4');
		$this->var->add_def_cols('id_actividad','int4');

		$this->var->add_def_cols('codigo_financiador','varchar');
		$this->var->add_def_cols('codigo_regional','varchar');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('codigo_proyecto','varchar');
		$this->var->add_def_cols('codigo_actividad','varchar');
		$this->var->add_def_cols('desc_almacen_dest','varchar');
		$this->var->add_def_cols('nombre_financiador_dest','varchar');
		$this->var->add_def_cols('nombre_regional_dest','varchar');
		$this->var->add_def_cols('nombre_programa_dest','varchar');
		$this->var->add_def_cols('nombre_proyecto_dest','varchar');

		$this->var->add_def_cols('nombre_actividad_dest','varchar');
		$this->var->add_def_cols('id_financiador_dest','int4');
		$this->var->add_def_cols('id_regional_dest','int4');
		$this->var->add_def_cols('id_programa_dest','int4');
		$this->var->add_def_cols('id_proyecto_dest','int4');
		$this->var->add_def_cols('id_actividad_dest','int4');
		$this->var->add_def_cols('codigo_financiador_dest','varchar');
		$this->var->add_def_cols('codigo_regional_dest','varchar');
		$this->var->add_def_cols('codigo_programa_dest','varchar');
		$this->var->add_def_cols('codigo_proyecto_dest','varchar');

		$this->var->add_def_cols('codigo_actividad_dest','varchar');
		$this->var->add_def_cols('fecha_borrador','date');
		$this->var->add_def_cols('fecha_pendiente','date');
		$this->var->add_def_cols('fecha_rechazado','date');
		$this->var->add_def_cols('id_ingreso','int4');
		$this->var->add_def_cols('id_salida','int4');
		$this->var->add_def_cols('id_tipo_material','int4');
		$this->var->add_def_cols('desc_tipo_material','varchar');
		$this->var->add_def_cols('id_motivo_salida_cuenta','int4');
		$this->var->add_def_cols('desc_motivo_salida_cuenta','varchar');

		$this->var->add_def_cols('desc_motivo_ingreso','varchar');
		$this->var->add_def_cols('desc_motivo_salida','varchar');
		$this->var->add_def_cols('correlativo_ing','integer');
		$this->var->add_def_cols('correlativo_sal','integer');
		$this->var->add_def_cols('id_ingreso_prestamo','int4');
		$this->var->add_def_cols('id_salida_prestamo','int4');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ListarTransferencia
	 * Prop�sito:				Desplegar los registros de tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function ListarTransfPrestamoPend($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_sel';
		$this->codigo_procedimiento = "'AL_PREPEN_SEL'";

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
		$this->var->add_def_cols('id_transferencia','int4');
		$this->var->add_def_cols('prestamo','varchar');
		$this->var->add_def_cols('estado_transferencia','varchar');
		$this->var->add_def_cols('motivo','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('fecha_pendiente_sal','date');
		$this->var->add_def_cols('fecha_pendiente_ing','date');
		$this->var->add_def_cols('fecha_finalizado_anulado','date');
		$this->var->add_def_cols('id_empleado','int4');

		$this->var->add_def_cols('desc_empleado','text');
		$this->var->add_def_cols('id_firma_autorizada_transf','int4');
		$this->var->add_def_cols('desc_firma_autorizada','text');
		$this->var->add_def_cols('id_almacen_logico','int4');
		$this->var->add_def_cols('desc_almacen_logico_orig','varchar');
		$this->var->add_def_cols('id_almacen_logico_destino','int4');
		$this->var->add_def_cols('desc_almacen_logico_dest','varchar');
		$this->var->add_def_cols('id_motivo_ingreso_cuenta','int4');
		$this->var->add_def_cols('desc_motivo_ingreso_cuenta','varchar');
		$this->var->add_def_cols('desc_almacen_orig','varchar');

		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		$this->var->add_def_cols('id_financiador','int4');
		$this->var->add_def_cols('id_regional','int4');
		$this->var->add_def_cols('id_programa','int4');
		$this->var->add_def_cols('id_proyecto','int4');
		$this->var->add_def_cols('id_actividad','int4');

		$this->var->add_def_cols('codigo_financiador','varchar');
		$this->var->add_def_cols('codigo_regional','varchar');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('codigo_proyecto','varchar');
		$this->var->add_def_cols('codigo_actividad','varchar');
		$this->var->add_def_cols('desc_almacen_dest','varchar');
		$this->var->add_def_cols('nombre_financiador_dest','varchar');
		$this->var->add_def_cols('nombre_regional_dest','varchar');
		$this->var->add_def_cols('nombre_programa_dest','varchar');
		$this->var->add_def_cols('nombre_proyecto_dest','varchar');

		$this->var->add_def_cols('nombre_actividad_dest','varchar');
		$this->var->add_def_cols('id_financiador_dest','int4');
		$this->var->add_def_cols('id_regional_dest','int4');
		$this->var->add_def_cols('id_programa_dest','int4');
		$this->var->add_def_cols('id_proyecto_dest','int4');
		$this->var->add_def_cols('id_actividad_dest','int4');
		$this->var->add_def_cols('codigo_financiador_dest','varchar');
		$this->var->add_def_cols('codigo_regional_dest','varchar');
		$this->var->add_def_cols('codigo_programa_dest','varchar');
		$this->var->add_def_cols('codigo_proyecto_dest','varchar');

		$this->var->add_def_cols('codigo_actividad_dest','varchar');
		$this->var->add_def_cols('fecha_borrador','date');
		$this->var->add_def_cols('fecha_pendiente','date');
		$this->var->add_def_cols('fecha_rechazado','date');
		$this->var->add_def_cols('id_ingreso','int4');
		$this->var->add_def_cols('id_salida','int4');
		$this->var->add_def_cols('id_tipo_material','int4');
		$this->var->add_def_cols('desc_tipo_material','varchar');
		$this->var->add_def_cols('id_motivo_salida_cuenta','int4');
		$this->var->add_def_cols('desc_motivo_salida_cuenta','varchar');

		$this->var->add_def_cols('desc_motivo_ingreso','varchar');
		$this->var->add_def_cols('desc_motivo_salida','varchar');
		$this->var->add_def_cols('id_ingreso_prestamo','int4');
		$this->var->add_def_cols('id_salida_prestamo','int4');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
		/**
	 * Nombre de la funci�n:	ListarTransferencia
	 * Prop�sito:				Desplegar los registros de tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function ListarTransfPrestamoDev($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_sel';
		$this->codigo_procedimiento = "'AL_PREDEV_SEL'";

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
		$this->var->add_def_cols('id_transferencia','int4');
		$this->var->add_def_cols('prestamo','varchar');
		$this->var->add_def_cols('estado_transferencia','varchar');
		$this->var->add_def_cols('motivo','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('fecha_pendiente_sal','date');
		$this->var->add_def_cols('fecha_pendiente_ing','date');
		$this->var->add_def_cols('fecha_finalizado_anulado','date');
		$this->var->add_def_cols('id_empleado','int4');

		$this->var->add_def_cols('desc_empleado','text');
		$this->var->add_def_cols('id_firma_autorizada_transf','int4');
		$this->var->add_def_cols('desc_firma_autorizada','text');
		$this->var->add_def_cols('id_almacen_logico','int4');
		$this->var->add_def_cols('desc_almacen_logico_orig','varchar');
		$this->var->add_def_cols('id_almacen_logico_destino','int4');
		$this->var->add_def_cols('desc_almacen_logico_dest','varchar');
		$this->var->add_def_cols('id_motivo_ingreso_cuenta','int4');
		$this->var->add_def_cols('desc_motivo_ingreso_cuenta','varchar');
		$this->var->add_def_cols('desc_almacen_orig','varchar');

		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		$this->var->add_def_cols('id_financiador','int4');
		$this->var->add_def_cols('id_regional','int4');
		$this->var->add_def_cols('id_programa','int4');
		$this->var->add_def_cols('id_proyecto','int4');
		$this->var->add_def_cols('id_actividad','int4');

		$this->var->add_def_cols('codigo_financiador','varchar');
		$this->var->add_def_cols('codigo_regional','varchar');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('codigo_proyecto','varchar');
		$this->var->add_def_cols('codigo_actividad','varchar');
		$this->var->add_def_cols('desc_almacen_dest','varchar');
		$this->var->add_def_cols('nombre_financiador_dest','varchar');
		$this->var->add_def_cols('nombre_regional_dest','varchar');
		$this->var->add_def_cols('nombre_programa_dest','varchar');
		$this->var->add_def_cols('nombre_proyecto_dest','varchar');

		$this->var->add_def_cols('nombre_actividad_dest','varchar');
		$this->var->add_def_cols('id_financiador_dest','int4');
		$this->var->add_def_cols('id_regional_dest','int4');
		$this->var->add_def_cols('id_programa_dest','int4');
		$this->var->add_def_cols('id_proyecto_dest','int4');
		$this->var->add_def_cols('id_actividad_dest','int4');
		$this->var->add_def_cols('codigo_financiador_dest','varchar');
		$this->var->add_def_cols('codigo_regional_dest','varchar');
		$this->var->add_def_cols('codigo_programa_dest','varchar');
		$this->var->add_def_cols('codigo_proyecto_dest','varchar');

		$this->var->add_def_cols('codigo_actividad_dest','varchar');
		$this->var->add_def_cols('fecha_borrador','date');
		$this->var->add_def_cols('fecha_pendiente','date');
		$this->var->add_def_cols('fecha_rechazado','date');
		$this->var->add_def_cols('id_ingreso','int4');
		$this->var->add_def_cols('id_salida','int4');
		$this->var->add_def_cols('id_tipo_material','int4');
		$this->var->add_def_cols('desc_tipo_material','varchar');
		$this->var->add_def_cols('id_motivo_salida_cuenta','int4');
		$this->var->add_def_cols('desc_motivo_salida_cuenta','varchar');

		$this->var->add_def_cols('desc_motivo_ingreso','varchar');
		$this->var->add_def_cols('desc_motivo_salida','varchar');
		$this->var->add_def_cols('id_ingreso_prestamo','int4');
		$this->var->add_def_cols('id_salida_prestamo','int4');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarTransferencia
	 * Prop�sito:				Contar los registros de tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function ContarTransfBorrador($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_sel';
		$this->codigo_procedimiento = "'AL_TRABOR_COUNT'";

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
	 * Nombre de la funci�n:	ContarTransferencia
	 * Prop�sito:				Contar los registros de tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function ContarTransfPendiente($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_sel';
		$this->codigo_procedimiento = "'AL_TRAPEN_COUNT'";

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
	 * Nombre de la funci�n:	ContarTransferencia
	 * Prop�sito:				Contar los registros de tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function ContarTransfSeguimiento($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_sel';
		$this->codigo_procedimiento = "'AL_TRASEG_COUNT'";

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
	 * Nombre de la funci�n:	ContarTransferencia
	 * Prop�sito:				Contar los registros de tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function ContarTransfPrestamoPend($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_sel';
		$this->codigo_procedimiento = "'AL_PREPEN_COUNT'";

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
	 * Nombre de la funci�n:	ContarTransferencia
	 * Prop�sito:				Contar los registros de tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function ContarTransfPrestamoDev($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_sel';
		$this->codigo_procedimiento = "'AL_PREDEV_COUNT'";

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
	 * Nombre de la funci�n:	InsertarTransferencia
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function InsertarTransfBorrador($id_transferencia,$prestamo,$motivo,$descripcion,$observaciones,$id_empleado,$id_almacen_logico,$id_almacen_logico_destino,$id_motivo_ingreso_cuenta,$id_tipo_material,$id_motivo_salida_cuenta)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_iud';
		$this->codigo_procedimiento = "'AL_TRABOR_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$prestamo'");
		$this->var->add_param("NULL");
		$this->var->add_param("'$motivo'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($id_empleado);
		$this->var->add_param("NULL");
		$this->var->add_param($id_almacen_logico);
		$this->var->add_param($id_almacen_logico_destino);
		$this->var->add_param($id_motivo_ingreso_cuenta);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($id_tipo_material);
		$this->var->add_param($id_motivo_salida_cuenta);
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
	 * Nombre de la funci�n:	ModificarTransferencia
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function ModificarTransfBorrador($id_transferencia,$prestamo,$motivo,$descripcion,$observaciones,$id_empleado,$id_almacen_logico,$id_almacen_logico_destino,$id_motivo_ingreso_cuenta,$id_tipo_material,$id_motivo_salida_cuenta)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_iud';
		$this->codigo_procedimiento = "'AL_TRABOR_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_transferencia);
		$this->var->add_param("'$prestamo'");
		$this->var->add_param("NULL");
		$this->var->add_param("'$motivo'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($id_empleado);
		$this->var->add_param("NULL");
		$this->var->add_param($id_almacen_logico);
		$this->var->add_param($id_almacen_logico_destino);
		$this->var->add_param($id_motivo_ingreso_cuenta);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($id_tipo_material);
		$this->var->add_param($id_motivo_salida_cuenta);
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
	 * Nombre de la funci�n:	ListarTransferencia
	 * Prop�sito:				Desplegar los registros de tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function ListarBajasPendiente($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_sel';
		$this->codigo_procedimiento = "'AL_BAJPEN_SEL'";

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
		$this->var->add_def_cols('id_transferencia','int4');
		$this->var->add_def_cols('prestamo','varchar');
		$this->var->add_def_cols('estado_transferencia','varchar');
		$this->var->add_def_cols('motivo','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('fecha_pendiente_sal','date');
		$this->var->add_def_cols('fecha_pendiente_ing','date');
		$this->var->add_def_cols('fecha_finalizado_anulado','date');
		$this->var->add_def_cols('id_empleado','int4');

		$this->var->add_def_cols('desc_empleado','text');
		$this->var->add_def_cols('id_firma_autorizada_transf','int4');
		$this->var->add_def_cols('desc_firma_autorizada','text');
		$this->var->add_def_cols('id_almacen_logico','int4');
		$this->var->add_def_cols('desc_almacen_logico_orig','varchar');
		$this->var->add_def_cols('id_almacen_logico_destino','int4');
		$this->var->add_def_cols('desc_almacen_logico_dest','varchar');
		$this->var->add_def_cols('id_motivo_ingreso_cuenta','int4');
		$this->var->add_def_cols('desc_motivo_ingreso_cuenta','varchar');
		$this->var->add_def_cols('desc_almacen_orig','varchar');

		$this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		$this->var->add_def_cols('id_financiador','int4');
		$this->var->add_def_cols('id_regional','int4');
		$this->var->add_def_cols('id_programa','int4');
		$this->var->add_def_cols('id_proyecto','int4');
		$this->var->add_def_cols('id_actividad','int4');

		$this->var->add_def_cols('codigo_financiador','varchar');
		$this->var->add_def_cols('codigo_regional','varchar');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('codigo_proyecto','varchar');
		$this->var->add_def_cols('codigo_actividad','varchar');
		$this->var->add_def_cols('desc_almacen_dest','varchar');
		$this->var->add_def_cols('nombre_financiador_dest','varchar');
		$this->var->add_def_cols('nombre_regional_dest','varchar');
		$this->var->add_def_cols('nombre_programa_dest','varchar');
		$this->var->add_def_cols('nombre_proyecto_dest','varchar');

		$this->var->add_def_cols('nombre_actividad_dest','varchar');
		$this->var->add_def_cols('id_financiador_dest','int4');
		$this->var->add_def_cols('id_regional_dest','int4');
		$this->var->add_def_cols('id_programa_dest','int4');
		$this->var->add_def_cols('id_proyecto_dest','int4');
		$this->var->add_def_cols('id_actividad_dest','int4');
		$this->var->add_def_cols('codigo_financiador_dest','varchar');
		$this->var->add_def_cols('codigo_regional_dest','varchar');
		$this->var->add_def_cols('codigo_programa_dest','varchar');
		$this->var->add_def_cols('codigo_proyecto_dest','varchar');

		$this->var->add_def_cols('codigo_actividad_dest','varchar');
		$this->var->add_def_cols('fecha_borrador','date');
		$this->var->add_def_cols('fecha_pendiente','date');
		$this->var->add_def_cols('fecha_rechazado','date');
		$this->var->add_def_cols('id_ingreso','int4');
		$this->var->add_def_cols('id_salida','int4');
		$this->var->add_def_cols('id_tipo_material','int4');
		$this->var->add_def_cols('desc_tipo_material','varchar');
		$this->var->add_def_cols('id_motivo_salida_cuenta','int4');
		$this->var->add_def_cols('desc_motivo_salida_cuenta','varchar');

		$this->var->add_def_cols('desc_motivo_ingreso','varchar');
		$this->var->add_def_cols('desc_motivo_salida','varchar');
		$this->var->add_def_cols('id_ingreso_prestamo','int4');
		$this->var->add_def_cols('id_salida_prestamo','int4');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}

	function ContarBajasPendiente($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_sel';
		$this->codigo_procedimiento = "'AL_BAJPEN_COUNT'";

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
	 * Nombre de la funci�n:	ModificarTransferencia
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function GuardarBajasPend($id_transferencia,$motivo,$descripcion,$observaciones,$id_empleado,$id_almacen_logico,$id_motivo_ingreso_cuenta,$id_tipo_material)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_iud';
		$this->codigo_procedimiento = "'AL_BAJPEN_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL"); //id trans
		$this->var->add_param("NULL"); //prestamo
		$this->var->add_param("NULL"); //estado_transferencia
		$this->var->add_param("'$motivo'"); //motivo
		$this->var->add_param("'$descripcion'"); //descripcion
		$this->var->add_param("'$observaciones'"); //observacion
		$this->var->add_param("NULL"); //fecha_pendiente_sal
		$this->var->add_param("NULL"); //fecha_pendiente_ing
		$this->var->add_param("NULL");//fecha_finalizado_anulado
		$this->var->add_param($id_empleado);//id_empleado
		$this->var->add_param("NULL");//id_firma_autorizada_transf
		$this->var->add_param($id_almacen_logico);//id_almacen_logico
		$this->var->add_param("NULL");//id_almacen_logico_destino
		$this->var->add_param($id_motivo_ingreso_cuenta);//id_motivo_ingreso_cuenta
		$this->var->add_param("NULL");//fecha_borrador
		$this->var->add_param("NULL");//fecha_pendiente
		$this->var->add_param("NULL");//fecha_rechazado
		$this->var->add_param("NULL");//id_ingreso
		$this->var->add_param("NULL");//id_salida
		$this->var->add_param($id_tipo_material);//id_tipo_material
		$this->var->add_param("NULL");//id_motivo_salida_cuenta
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
	 * Nombre de la funci�n:	EliminarTransferencia
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function FinalizarBajasBorrador($id_transferencia)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_iud';
		$this->codigo_procedimiento = "'AL_BAJPEN_FIN'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_transferencia);
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

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	
	/**
	 * Nombre de la funci�n:	EliminarTransferencia
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function AprobarBajasPendiente($id_transferencia)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_iud';
		$this->codigo_procedimiento = "'AL_BAJPEN_APR'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_transferencia);
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

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	

	/**
	 * Nombre de la funci�n:	EliminarTransferencia
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function EliminarTransfBorrador($id_transferencia)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_iud';
		$this->codigo_procedimiento = "'AL_TRABOR_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_transferencia);
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

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	EliminarTransferencia
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function FinalizarTransfBorrador($id_transferencia)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_iud';
		$this->codigo_procedimiento = "'AL_TRABOR_FIN'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_transferencia);
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

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	

	/**
	 * Nombre de la funci�n:	EliminarTransferencia
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function AprobarTransfPendiente($id_transferencia)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_iud';
		$this->codigo_procedimiento = "'AL_TRAPEN_APR'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_transferencia);
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

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	EliminarTransferencia
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function RechazarTransfPendiente($id_transferencia)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_iud';
		$this->codigo_procedimiento = "'AL_TRAPEN_REC'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_transferencia);
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

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarTransferencia
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function FinalizarTransfPrestamoDev($id_transferencia)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_transferencia_iud';
		$this->codigo_procedimiento = "'AL_PREDEV_FIN'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_transferencia);
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

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarTransferencia
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tal_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-21 08:58:38
	 */
	function ValidarTransferencia($operacion_sql,$id_transferencia,$prestamo,$motivo,$descripcion,$observaciones,$id_empleado,$id_almacen_logico,$id_almacen_logico_destino,$id_motivo_ingreso_cuenta,$id_tipo_material,$id_motivo_salida_cuenta)
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
				//Validar id_transferencia - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_transferencia");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_transferencia", $id_transferencia))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			

			//Validar motivo - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("motivo");
			$tipo_dato->set_MaxLength(100);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "motivo", $motivo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar descripcion - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(100);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar observaciones - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("observaciones");
			$tipo_dato->set_MaxLength(200);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "observaciones", $observaciones))
			{
				$this->salida = $valid->salida;
				return false;
			}


			//Validar id_empleado - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado");
			$tipo_dato->set_MaxLength(1);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado", $id_empleado))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_almacen_logico - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_almacen_logico");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_almacen_logico", $id_almacen_logico))
			{
				$this->salida = $valid->salida;
				return false;
			}

			

			//Validar id_tipo_transferencia - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_motivo_ingreso_cuenta");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_motivo_ingreso_cuenta", $id_motivo_ingreso_cuenta))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_tipo_transferencia - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_tipo_material");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_material", $id_tipo_material))
			{
				$this->salida = $valid->salida;
				return false;
			}

			

			//Validaci�n de reglas de datos

			//Validar prestamo
			$check = array ("si","no");
			if(!in_array($prestamo,$check))
			{
				$this->salida[0] = "f";
				$this->salida[1] = "Error de validaci�n en columna 'prestamo': El valor no est� dentro del dominio definido";
				$this->salida[2] = "ORIGEN = $this->nombre_archivo";
				$this->salida[3] = "PROC = ValidarTransferencia";
				$this->salida[4] = "NIVEL = 3";
				return false;
			}

			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_transferencia - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_transferencia");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_transferencia", $id_transferencia))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='fin' || $operacion_sql=='aprob' || $operacion_sql=='rech' || $operacion_sql=='prest')
		{
			//Validar id_transferencia - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_transferencia");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_transferencia", $id_transferencia))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validaci�n exitosa
			return true;
		}
		
		elseif ($operacion_sql=='baja')
		{
			
			return true;
		}
		
		else
		{
			$this->salida[0] = "f";
			$this->salida[1] = "C�digo de validaci�n inexistente";
			$this->salida[2] = "ORIGEN = $this->nombre_archivo";
			$this->salida[3] = "PROC = ValidarTransferencia";
			$this->salida[4] = "NIVEL = 3";
			return false;
		}
	}
}?>