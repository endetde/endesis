<?php 
/**
 * Nombre:		  	    transferencia_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2007-11-21 08:59:18
 *
 */
session_start();
?>
//<script>
function main(){
	<?php
	//obtenemos la ruta absoluta
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$dir = "http://$host$uri/";
	echo "\nvar direccion='$dir';";
	echo "var idContenedor='$idContenedor';";
	?>
	var fa=false;
	<?php if($_SESSION["ss_filtro_avanzado"]!=''){
		echo 'fa='.$_SESSION["ss_filtro_avanzado"].';';
	}
	?>
	var paramConfig={TamanoPagina:20,TiempoEspera:10000,CantFiltros:1,FiltroEstructura:false,FiltroAvanzado:fa};
	var elemento={pagina:new pagina_transferencia_seg(idContenedor,direccion,paramConfig),idContenedor:idContenedor};
	ContenedorPrincipal.setPagina(elemento);
}
Ext.onReady(main,main);


/**
* Nombre:		  	    pagina_transferencia_main.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
* Fecha creaci�n:		2007-11-21 08:59:18
*/
function pagina_transferencia_seg(idContenedor,direccion,paramConfig)
{
	var vectorAtributos=new Array;
	var ds;
	var elementos=new Array();
	var sw=0;
	var data_ep_origen;
	var data_ep_destino;
	var componentes=new Array();
	/////////////////
	//  DATA STORE //
	/////////////////
	ds = new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/transferencia/ActionListarTransfSeguimiento.php'}),
		// aqui se define la estructura del XML
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_transferencia',
			totalRecords: 'TotalCount'
		}, [
		// define el mapeo de XML a las etiquetas (campos)
		'id_transferencia',
		'prestamo',
		'estado_transferencia',
		'motivo',
		'descripcion',
		'observaciones',
		{name: 'fecha_pendiente_sal',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_pendiente_ing',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_finalizado_anulado',type:'date',dateFormat:'Y-m-d'},
		'id_empleado',
		'desc_empleado',
		'id_firma_autorizada_transf',
		'desc_firma_autorizada',
		'id_almacen_logico',
		'desc_almacen_logico_orig',
		'id_almacen_logico_destino',
		'desc_almacen_logico_dest',
		'id_motivo_ingreso_cuenta',
		'desc_motivo_ingreso_cuenta',
		'desc_almacen_orig',
		'nombre_financiador',
		'nombre_regional',
		'nombre_programa',
		'nombre_proyecto',
		'nombre_actividad',
		'id_financiador',
		'id_regional',
		'id_programa',
		'id_proyecto',
		'id_actividad',
		'codigo_financiador',
		'codigo_regional',
		'codigo_programa',
		'codigo_proyecto',
		'codigo_actividad',
		'desc_almacen_dest',
		'nombre_financiador_dest',
		'nombre_regional_dest',
		'nombre_programa_dest',
		'nombre_proyecto_dest',
		'nombre_actividad_dest',
		'id_financiador_dest',
		'id_regional_dest',
		'id_programa_dest',
		'id_proyecto_dest',
		'id_actividad_dest',
		'codigo_financiador_dest',
		'codigo_regional_dest',
		'codigo_programa_dest',
		'codigo_proyecto_dest',

		'codigo_actividad_dest',
		{name: 'fecha_borrador',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_pendiente',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_rechazado',type:'date',dateFormat:'Y-m-d'},
		'id_ingreso',
		'id_salida',
		'id_tipo_material',
		'desc_tipo_material',
		'id_motivo_salida_cuenta',
		'desc_motivo_salida_cuenta',
		'desc_motivo_ingreso',
		'desc_motivo_salida',
		'correlativo_ing',
		'correlativo_sal',
		{name: 'id_transferencia_dev',type:'int'},
		//'id_transferencia_dev',		
		'tipo_transferencia',
		'importe_abierto'
		

		]),remoteSort:true
	});

	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros
		}
	});

	/////////////////////////
	// Definici�n de datos //
	/////////////////////////

	// hidden id_transferencia
	//en la posici�n 0 siempre esta la llave primaria

	vectorAtributos=[{
		validacion:{
			//fieldLabel: 'Id',
			labelSeparator:'',
			name: 'id_transferencia',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		filtro_0:false,
		id_grupo:3,
		save_as:'hidden_id_transferencia'
	},
	{
		validacion: {
			name:'tipo_transferencia',
			fieldLabel:'Tipo Transferencia',
			allowBlank:false,
			typeAhead: true,
			loadMask: true,
			triggerAction: 'all',			
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			width:100,
			forceSelection:true,
			grid_visible:true,
			grid_indice:1,
			width_grid:100, // ancho de columna en el gris
			renderer: function(value, p, record){
				
			    	if(record.data.tipo_transferencia == 'prestamo'){
			    	    if(record.data.estado_transferencia == 'Finalizado' && record.data.id_transferencia_dev > 0 ){
			    	    	return String.format('<font color = "green"><b>{0}</b></font>', value) 
			    	    }
			    	    else{
			    	       return String.format('<font color = "red"><b>{0}</b></font>', value) 	
			    	    }
				       
				       
				    }	
				
				    return String.format('<font color = "bralck"><b>{0}</b></font>', value)   
				
			}
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'TRANSF.tipo_transferencia'
	},
	{
		validacion: {
			name: 'importe_abierto',
			fieldLabel: 'Importes Abiertos',
			allowBlank: false,
			typeAhead: true,
			valueField: 'ID',
			displayField: 'valor',
			lazyRender: true,
			width: 100,
			forceSelection: true,
			disabled: true,
			grid_visible: true,
			grid_indice: 1,
			renderer: function(value, p, record){
				console.log('.....',record.data.id_transferencia_dev)
			    	if(record.data.tipo_transferencia == 'prestamo'){
			    	    if(record.data.estado_transferencia == 'Finalizado' && record.data.id_transferencia_dev  > 0){
			    	    	return String.format('<font color = "green"><b>{0}</b></font>', value) 
			    	    }
			    	    else{
			    	       return String.format('<font color = "red"><b>{0}</b></font>', value) 	
			    	    }
				       
				       
				    }	
				
				    return String.format('<font color = "bralck"><b>{0}</b></font>', value)   
				
			},
			width_grid: 100 // ancho de columna en el gris
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'TRANSF.importe_abierto'
	},
	{
		validacion:{
			name:'estado_transferencia',
			fieldLabel:'Estado',
			grid_visible:true,
			grid_editable:false,
			grid_indice:1,	
			renderer: function(value, p, record){
				console.log('.....',record.data.id_transferencia_dev)
			    	if(record.data.tipo_transferencia == 'prestamo'){
			    	    if(record.data.estado_transferencia == 'Finalizado' && record.data.id_transferencia_dev  > 0){
			    	    	return String.format('<font color = "green"><b>{0}</b></font>', value) 
			    	    }
			    	    else{
			    	       return String.format('<font color = "red"><b>{0}</b></font>', value) 	
			    	    }
				       
				       
				    }	
				
				    return String.format('<font color = "bralck"><b>{0}</b></font>', value)   
				
			},		
			width_grid:100
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filterColValue:'estado_transferencia',
		save_as:'txt_estado_transferencia',
		id_grupo:1
	},
	
	{
		validacion:{
			name:'desc_almacen_orig',
			fieldLabel:'Almacen F�sico Origen',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			grid_indice:1
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filterColValue:'ALMACE.nombre',
		save_as:'txt_desc_almacen_orig',
		id_grupo:0
	},
	{
		validacion:{
			name:'desc_almacen_dest',
			fieldLabel:'Almacen F�sico Destino',
			grid_visible:true,
			grid_editable:false,
			grid_indice:3,
			width_grid:100
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filterColValue:'ALMACE1.nombre',
		save_as:'txt_desc_almacen_dest',
		id_grupo:1
	},{
		validacion: {
			name:'desc_almacen_logico_orig',
			fieldLabel:'Almac�n L�gico Origen',
			grid_visible:true,
			grid_editable:true,
			grid_indice:2,
			width_grid:150
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filterColValue:'ALMLOG.nombre',
		defecto: '',
		save_as:'txt_desc_almacen_logico_orig',
		id_grupo:0
	},{
		validacion: {
			name:'desc_almacen_logico_dest',
			fieldLabel:'Almac�n L�gico Destino',
			grid_visible:true,
			grid_editable:true,
			grid_indice:4,
			width_grid:150
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filterColValue:'ALMLOG1.nombre',
		save_as:'txt_desc_almacen_logico_dest',
		id_grupo:1
	},{
		validacion: {
			name:'prestamo',
			fieldLabel:'Pr�stamo',
			grid_visible:true,
			grid_editable:true,
			grid_indice:6,
			width_grid:60
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filterColValue:'TRANSF.prestamo',
		save_as:'txt_prestamo',
		id_grupo:2
	},{
		validacion:{
			name:'motivo',
			fieldLabel:'Motivo',
			grid_visible:true,
			grid_editable:true,
			grid_indice:8,
			width_grid:120
		},
		form:false,
		tipo: 'Field',
		filtro_0:true,
		filterColValue:'TRANSF.motivo',
		save_as:'txt_motivo',
		id_grupo:2
	},{
		validacion:{
			name:'descripcion',
			fieldLabel:'Descripcion',
			grid_visible:true,
			grid_editable:true,
			grid_indice:5,
			width_grid:150
		},
		form:false,
		tipo: 'Field',
		filtro_0:false,
		filterColValue:'TRANSF.descripcion',
		save_as:'txt_descripcion',
		id_grupo:2
	},
	{
		validacion:{
			name:'observaciones',
			fieldLabel:'Observaciones',
			grid_visible:true,
			grid_editable:true,
			grid_indice:9,
			width_grid:150
		},
		form:false,
		tipo: 'Field',
		filtro_0:false,
		filterColValue:'TRANSF.observaciones',
		save_as:'txt_observaciones',
		id_grupo:2
	},
	{
		validacion: {
			name:'desc_empleado',
			fieldLabel:'Empleado',
			grid_visible:true,
			grid_editable:true,
			grid_indice:11,
			width_grid:130
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filterColValue:'PERSON1.nombre#PERSON1.apellido_paterno#PERSON1.apellido_materno',
		save_as:'txt_desc_empleado',
		id_grupo:4
	},
	{
		validacion:{
			name:'nombre_almacen',
			fieldLabel:'nombre_almacen',
			grid_visible:false,
			grid_editable:true,
			width_grid:150
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_nombre_almacen',
		id_grupo:3
	},
	{
		validacion:{
			name:'desc_almacen_logico_orig',
			fieldLabel:'Nombre Almacen Logico',
			grid_visible:false,
			grid_editable:true,
			width_grid:150
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_nombre_almacen_logico',
		id_grupo:3
	},
	{
		validacion:{
			name: 'nombre_financiador',
			fieldLabel: 'Financiador Origen',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_nombre_financiador',
		id_grupo:0
	},
	{
		validacion:{
			name: 'nombre_regional',
			fieldLabel: 'Regional Origen',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_nombre_regional',
		id_grupo:0
	},
	{
		validacion:{
			name: 'nombre_programa',
			fieldLabel: 'Programa Origen',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_nombre_programa',
		id_grupo:0
	},
	{
		validacion:{
			name: 'nombre_proyecto',
			fieldLabel: 'Proyecto Origen',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_id_nombre_proyecto',
		id_grupo:0
	},
	{
		validacion:{
			name: 'nombre_actividad',
			fieldLabel: 'Actividad Origen',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_nombre_actividad',
		id_grupo:0
	},
	{
		validacion:{
			name: 'nombre_financiador_dest',
			fieldLabel: 'Financiador Destino',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_nombre_financiador_dest',
		id_grupo:0
	},{
		validacion:{
			name: 'nombre_regional_dest',
			fieldLabel: 'Regional Destino',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_nombre_regional_dest',
		id_grupo:0
	},{
		validacion:{
			name: 'nombre_programa_dest',
			fieldLabel: 'Programa Destino',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_nombre_programa_dest',
		id_grupo:0
	},
	{
		validacion:{
			name: 'nombre_proyecto_dest',
			fieldLabel: 'Proyecto Destino',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_id_nombre_proyecto_dest',
		id_grupo:0
	},
	{
		validacion:{
			name: 'nombre_actividad_dest',
			fieldLabel: 'Actividad Destino',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_nombre_actividad_dest',
		id_grupo:0
	},
	{
		validacion:{
			name: 'desc_motivo_ingreso',
			fieldLabel: 'Motivo ingreso',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_desc_motivo_ingreso',
		id_grupo:0
	},
	{
		validacion:{
			name: 'desc_motivo_ingreso_cuenta',
			fieldLabel: 'Cuenta ingreso',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_desc_motivo_ingreso_cuenta',
		id_grupo:0
	},
	{
		validacion:{
			name: 'desc_motivo_salida',
			fieldLabel: 'Motivo salida',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_desc_motivo_salida',
		id_grupo:0
	},
	{
		validacion:{
			name: 'desc_motivo_salida_cuenta',
			fieldLabel: 'Cuenta salida',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_desc_motivo_salida_cuenta',
		id_grupo:0
	},
	{
		validacion:{
			name: 'desc_tipo_material',
			fieldLabel: 'Tipo material',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'TextField',
		filtro_0:true,
		filterColValue:'TIPMAT.nombre',
		save_as:'txt_desc_tipo_material',
		id_grupo:0
	},
	{
		validacion:{
			name: 'fecha_borrador',
			fieldLabel: 'Fecha borrador',
			renderer:formatDate,
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_fecha_borrador',
		id_grupo:0
	},
	{
		validacion:{
			name: 'estado_transferencia',
			fieldLabel: 'Estado Transferencia',
			grid_visible:false,
			grid_indice:5,
			grid_editable:false
		},
		form:false,
		filtro_0:false,
		tipo: 'Field',
		save_as:'txt_estado_transferencia',
		id_grupo:0
	},
	{
		validacion:{
			name: 'fecha_pendiente_sal',
			fieldLabel: 'Fecha pendiente salida',
			renderer:formatDate,
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_fecha_pendiente_sal',
		id_grupo:0
	},
	{
		validacion:{
			name: 'fecha_pendiente_ing',
			fieldLabel: 'Fecha pendiente ingreso',
			renderer:formatDate,
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_fecha_pendiente_ing',
		id_grupo:0
	},
	{
		validacion:{
			name: 'fecha_finalizado_anulado',
			fieldLabel: 'Fecha finalizado/anulado',
			renderer:formatDate,
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_fecha_finalizado_anulado',
		id_grupo:0
	},
	{
		validacion:{
			name: 'desc_firma_autorizada',
			fieldLabel: 'Firma autorizada',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_desc_firma_autorizada',
		id_grupo:0
	},
	{
		validacion:{
			name: 'fecha_pendiente',
			fieldLabel: 'Fecha pendiente aprobaci�n',
			renderer:formatDate,
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_fecha_pendiente',
		id_grupo:0
	},
	{
		validacion:{
			name: 'fecha_rechazado',
			fieldLabel: 'Fecha rechazado',
			renderer:formatDate,
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_fecha_rechazado',
		id_grupo:0
	},
	{
		validacion:{
			name: 'correlativo_sal',
			fieldLabel: 'Salida',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_correlativo_sal',
		id_grupo:0
	},
	{
		validacion:{
			name: 'correlativo_ing',
			fieldLabel: 'Ingreso',
			grid_visible:true,
			grid_indice:21,
			grid_editable:false
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_correlativo_ing',
		id_grupo:0
	}];

	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	function formatDate(value){
		return value ? value.dateFormat('d/m/Y') : '';
	};

	//////////////////////////////////////////////////////////////
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
	//////////////////////////////////////////////////////////////
	//Inicia Layout
	var config = {
		titulo_maestro:'transferencia',
		grid_maestro:'grid-'+idContenedor
	};
	layout_transferencia=new DocsLayoutMaestro(idContenedor);
	layout_transferencia.init(config);

	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////

	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina = Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,ds,layout_transferencia,idContenedor);
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
	var getSelectionModel=this.getSelectionModel;
	var ClaseMadre_getComponente=this.getComponente;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_btnNew=this.btnNew;
	var ClaseMadre_onResize=this.onResize;
	var ClaseMadre_SaveAndOther=this.SaveAndOther;
	var CM_ocultarGrupo=this.ocultarGrupo;
	var ClaseMadre_btnActualizar = this.btnActualizar;

	var ClaseMadre_getGrid=this.getGrid;
	var ClaseMadre_getDialog=this.getDialog;
	var ClaseMadre_getFormulario=this.getFormulario;

	var CM_ocultarComponente=this.ocultarComponente;

	///////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	///////////////////////////////////

	var paramMenu={
		actualizar:{crear:true,separador:false}
	};


	//////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////

	//datos necesarios para el filtro
	var paramFunciones = {
		Formulario:{html_apply:'dlgInfo-'+idContenedor,height:'80%',
		width:'80%',
		minWidth:150,minHeight:200,	closable:true,titulo:'transferencia',
		}
	};
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//


	function btn_transferencia_detalle(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();

		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			var data='m_id_transferencia='+SelectionsRecord.data.id_transferencia;
			data=data+'&m_id_almacen_logico='+SelectionsRecord.data.id_almacen_logico;
			data=data+'&m_almacen_logico='+SelectionsRecord.data.desc_almacen_logico_orig;

			var ParamVentana={Ventana:{width:'70%',height:'60%'}}
			layout_transferencia.loadWindows(direccion+'../../../vista/transferencia_aprob_det/transferencia_aprob_det.php?'+data,'Detalle Transferencia',ParamVentana);
			layout_transferencia.getVentana().on('resize',function(){
				layout_transferencia.getLayout().layout();
			})
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		}
	}
	
	
	function btn_gen_devolucion(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		if(NumSelect!=0){
			
				var SelectionsRecord=sm.getSelected();
				var data=SelectionsRecord.data.id_transferencia;
				
				console.log(SelectionsRecord.data.id_transferencia_dev,SelectionsRecord.data.tipo_transferencia,1, SelectionsRecord.data.id_transferencia_dev, 1,SelectionsRecord.data.estado_transferencia);
				console.log(SelectionsRecord.data.tipo_transferencia != 'prestamo' && SelectionsRecord.data.id_transferencia_dev == 0 && SelectionsRecord.data.estado_transferencia == 'Finalizado');
				
				if(SelectionsRecord.data.tipo_transferencia == 'prestamo' && SelectionsRecord.data.id_transferencia_dev == 0 && SelectionsRecord.data.estado_transferencia == 'Finalizado'){
					if(confirm("�Est� seguro de iniciar la devoluci�n?")){
							Ext.MessageBox.show({
								title: 'Ejecutando proceso',
								msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Registrando devoluci�n</div>",
								width:350,
								height:200,
								closable:false
							});
							
							Ext.Ajax.request({
								url:direccion+"../../../control/transferencia/ActionGenerarDevolucion.php?hidden_id_transferencia="+data,
								method:'GET',
								success:terminado,
								failure:ClaseMadre_conexionFailure,
								timeout:9999999//TIEMPO DE ESPERA PARA DAR FALLO
							})
                    }
				}
				else{
					alert('Solo puede generar devoluciones en transferencia de tipo prestamo finalizadas que no tenga devoluciones');
				}
				
			
		}
		else{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
		}
	}
	
	function terminado(resp){
		Ext.MessageBox.hide();
		Ext.MessageBox.alert('Estado', '<br>Se genero una transferencia de devoluci�n en borrador.<br>');
		ClaseMadre_btnActualizar()
	}


	function InitPaginaTransferencia()
	{
		grid=ClaseMadre_getGrid();
		dialog=ClaseMadre_getDialog();
		sm=getSelectionModel();
		formulario=ClaseMadre_getFormulario();
		for(i=0;i<vectorAtributos.length;i++){
			componentes[i]=ClaseMadre_getComponente(vectorAtributos[i].validacion.name);
		}


		//CM_ocultarComponente(componentes[9]);//Id proveedor
	}

	this.btnNew=function(){

		CM_ocultarGrupo('Oculto');
		ClaseMadre_btnNew();
	}

	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_transferencia.getLayout();};
	//para el manejo de hijos
	this.getPagina=function(idContenedorHijo){
		var tam_elementos=elementos.length;
		for(i=0;i<tam_elementos;i++){
			if(elementos[i].idContenedor==idContenedorHijo){
				return elementos[i];
			}
		}
	};
	this.getElementos=function(){return elementos;};
	this.setPagina=function(elemento){elementos.push(elemento);};

	//-------------- FIN DEFINICI�N DE FUNCIONES PROPIAS --------------//
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	this.InitFunciones(paramFunciones);
	//para agregar botones
	this.AdicionarBoton('../../../lib/imagenes/detalle.png','Detalle de la Transferencia',btn_transferencia_detalle,true,'transferencia_detalle','');	
	this.AdicionarBoton('../../../lib/imagenes/proc.png','Generar Devoluci�n',btn_gen_devolucion,true,'ter_gen_dev','');
	
	this.iniciaFormulario();
	InitPaginaTransferencia();
	layout_transferencia.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}

