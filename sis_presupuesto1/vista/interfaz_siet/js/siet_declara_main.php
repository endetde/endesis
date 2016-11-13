<?php 
/**
 * Nombre:		  	    proyecto_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2007-11-06 15:33:00
 *
 */
session_start();
?>
//<script>
//var paginaTipoActivo;

	function main(){
	 	<?php
		//obtenemos la ruta absoluta
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$dir = "http://$host$uri/";
		echo "\nvar direccion='$dir';";
	    echo "var idContenedor='$idContenedor';";
	?>
	
	var fa;
	<?php if($_SESSION["ss_filtro_avanzado"]!=''){
		echo 'fa='.$_SESSION["ss_filtro_avanzado"].';';
	}
	?>
var paramConfig={TamanoPagina:20,TiempoEspera:10000,CantFiltros:1,FiltroEstructura:false,FiltroAvanzado:fa};
var elemento={pagina:new pagina_interfaz_siet_declara(idContenedor,direccion,paramConfig),idContenedor:idContenedor};
ContenedorPrincipal.setPagina(elemento);
}
Ext.onReady(main,main);

/**
 * Nombre:		  	    pagina_proyecto_main.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2007-11-06 15:33:00
 */
function pagina_interfaz_siet_declara(idContenedor,direccion,paramConfig)
{
	var vectorAtributos=new Array;
	
	var elementos=new Array();
	var sw=0;
	var dialog;
	var formulario;
	var componentes=new Array();
	
	
	/////////////////
	//  DATA STORE //
	/////////////////
	
	var ds = new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_presupuesto/control/interfaz_siet/ActionListarSietDeclara.php'}),
		// aqui se define la estructura del XML
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_siet_declara',
			totalRecords: 'TotalCount'
		}, [
		// define el mapeo de XML a las etiquetas (campos)
			'id_siet_declara',
			'id_gestion',
			'gestion',
			'id_periodo',
			'periodo',
			'id_usuario',
			'nombre_completo',
			'estado',
			'fecha_declara',
			'periodo_lite',
			'id_parametro',
			'tipo_declara'
			
    		]),remoteSort:true});
			
	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros,
			
		}
	});
	//DATA STORE COMBOS
	var ds_gestion = 	new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/gestion/ActionListarGestion.php'}),
        reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_gestion',	totalRecords: 'TotalCount'},
                 ['id_gestion','gestion']),remoteSort:true});
	
	var ds_periodo = 	new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/periodo/ActionListarPeriodo.php'}),
		                                   reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_periodo',	totalRecords: 'TotalCount'},
				                                    ['id_periodo','id_gestion','periodo',{name: 'fecha_inicio',type:'date',dateFormat:'Y-m-d'},{name: 'fecha_final',type:'date',dateFormat:'Y-m-d'},'estado_peri_gral','periodo_lite']),remoteSort:true});

	function render_id_gestion(value, p, record){return String.format('{0}', record.data['gestion']);}
	function render_id_periodo(value, p, record){return String.format('{0}', record.data['periodo_lite']);}
	

	
	
	/////////////////////////
	// Definici�n de datos //
	/////////////////////////
	vectorAtributos[0]= {
		validacion:{
			labelSeparator:'',
			name: 'id_siet_declara',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		save_as:'txt_id_siet_declara',
		id_grupo:0
	};
	
// desc_usuario
	vectorAtributos[1]= {
		validacion:{
			name:'nombre_completo',
			fieldLabel:'Usuario',
			desc: 'nombre_completo',
			displayField: 'nombre_completo',
			
			allowBlank:false,
			maxLength:10,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'55%',
			grid_visible:true,
			grid_editable:false,
			disabled:true,
			width_grid:70,
					
		},
		form:false,	
		tipo: 'TextField',
		filtro_0:true,
		filterColValue:' USUARI.nombre_completo',
		save_as:'txt_id_usuario',
		id_grupo:0
	};
	

	
	vectorAtributos[2]= {
			validacion: {
			name:'id_gestion',
			fieldLabel:'Gestion',
			allowBlank:true,			
			emptyText:'Gestion...',
			desc: 'gestion', //indica la columna del store principal ds del que proviane la descripcion
			store:ds_gestion,
			valueField: 'id_gestion',
			displayField: 'gestion',
			queryParam: 'filterValue_0',
			filterCol:'gestion',
			typeAhead:true,
			forceSelection:false,
			mode:'remote',
			queryDelay:250,
			pageSize:100,
			minListWidth:450,
			grow:true,
			width:'100%',
			//grow:true,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
			triggerAction:'all',
			editable:true,
			renderer:render_id_gestion,
			grid_visible:true,
			grid_editable:false,
			width_grid:220 // ancho de columna en el gris
		},
		tipo:'ComboBox',
		filtro_0:true,
		
		filterColValue:'gestion',
		defecto: '',
		save_as:'txt_id_gestion',
		id_grupo:0
	};
	
	
	
	vectorAtributos[3]= {
			validacion: {
			name:'id_periodo',
			fieldLabel:'Periodo',
			allowBlank:true,			
			emptyText:'Periodo...',
			desc: 'periodo_lite', //indica la columna del store principal ds del que proviane la descripcion
			store:ds_periodo,
			valueField: 'id_periodo',
			displayField: 'periodo_lite',
			queryParam: 'filterValue_0',
			filterCol:'periodo',
			typeAhead:true,
			forceSelection:false,
			mode:'remote',
			queryDelay:250,
			pageSize:100,
			minListWidth:450,
			grow:true,
			width:'100%',
			//grow:true,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
			triggerAction:'all',
			editable:true,
			renderer:render_id_periodo,
			grid_visible:true,
			grid_editable:false,
			width_grid:220 // ancho de columna en el gris
		},
		tipo:'ComboBox',
		filtro_0:false,
		
		filterColValue:'PERIOD.periodo',
		defecto: '',
		save_as:'txt_id_periodo',
		id_grupo:0
	};
	vectorAtributos[4]= {
			validacion:{
				name:'estado',
				fieldLabel:'Estado',
				allowBlank:false,
				maxLength:10,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				width:'55%',
				grid_visible:true,
				grid_editable:false,
				disabled:true,
				width_grid:70,
						
			},
			form:false,	
			tipo: 'TextField',
			filtro_0:true,
			filterColValue:'estado',
			save_as:'txt_estado',
			id_grupo:0
		};
	vectorAtributos[5]= {
			validacion:{
				name:'fecha_declara',
				fieldLabel:'Fecha Registro',
				allowBlank:false,
				maxLength:10,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				width:'55%',
				grid_visible:true,
				grid_editable:false,
				disabled:true,
				width_grid:70,
						
			},
			form:false,	
			tipo: 'TextField',
			filtro_0:false,
			filterColValue:'fecha_declara',
			save_as:'txt_fecha_declara',
			id_grupo:0
		};
	vectorAtributos[6]={
			validacion: {
				name:'tipo_declara',
				fieldLabel:'Tipo',
				allowBlank:true,
				emptyText:'Tipo...',
				typeAhead:true,
				loadMask:true,
				triggerAction:'all',
				store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[['gasto','Gasto'],['recurso','Recursos'],['traspaso','Traspaso']]}),
				valueField:'ID',
				displayField:'valor',
				lazyRender:true,
				forceSelection:true,
				grid_visible:true,
				grid_editable:false,
				width_grid:250,
				minListWidth:100,
				disable:false
			},
			tipo:'ComboBox',
			form: true,
			filtro_0:false,
			filterColValue:'tipo_declara',
			save_as:'txt_tipo_declara',
			id_grupo:0 
		};		
	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	function formatDate(value){
		return value ? value.dateFormat('d/m/Y') : ''
	};

	//////////////////////////////////////////////////////////////
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
	//////////////////////////////////////////////////////////////

	
	var config={titulo_maestro:'Proyecto',grid_maestro:'grid-'+idContenedor,urlHijo:'../../../sis_presupuesto/vista/interfaz_siet/siet_cbte.php'};
	var layout_interfaz_siet_declara=new DocsLayoutMaestroDeatalle(idContenedor);
	layout_interfaz_siet_declara.init(config);

	
	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////

	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina = Pagina;
	this.pagina(paramConfig,vectorAtributos,ds,layout_interfaz_siet_declara,idContenedor);
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
	var getSelectionModel=this.getSelectionModel;
	var ClaseMadre_getComponente=this.getComponente;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_btnNew=this.btnNew;
	var ClaseMadre_onResize=this.onResize;
	var ClaseMadre_SaveAndOther=this.SaveAndOther;
	var ClaseMadre_btnEdit=this.btnEdit;
	var ClaseMadre_getDialog=this.getDialog;
	var ClaseMadre_getGrid=this.getGrid;
	var ClaseMadre_getFormulario=this.getFormulario;
	var CM_ocultarGrupo=this.ocultarGrupo;
	var CM_mostrarGrupo=this.mostrarGrupo;
	var CM_ocultarComp=this.ocultarComponente;
	var CM_mostrarComp=this.mostrarComponente;
	var CM_saveSuccess=this.saveSuccess;
	var cm_EnableSelect=this.EnableSelect;
	var CM_conexionFailure=this.conexionFailure;
	var enableSelect=this.EnableSelect;
	///////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	///////////////////////////////////

	var paramMenu={
		//guardar:{crear:true,separador:false},
		nuevo:{crear:true,separador:true},
		editar:{crear:true,separador:false},
		//eliminar:{crear:true,separador:false},
		actualizar:{crear:true,separador:false}
	};


	//////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////
	
	//datos necesarios para el filtro
	var paramFunciones = {
		btnEliminar:{url:direccion+'../../../../sis_presupuesto/control/interfaz_siet/ActionEliminarSietDeclara.php'},
		Save:{url:direccion+'../../../../sis_presupuesto/control/interfaz_siet/ActionGuardarSietDeclara.php'},
		ConfirmSave:{url:direccion+'../../../../sis_presupuesto/control/interfaz_siet/ActionGuardarSietDeclara.php'},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,height:'65%',
		width:'45%',columnas:['95%'],
			minWidth:150,minHeight:200,	closable:true,titulo:'SietDeclara',
		grupos:[{
				tituloGrupo:'Datos',
				columna:0,
				id_grupo:0}]}};
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//

	//Para manejo de eventos
	function iniciarEventosFormularios()
	{
		
		for(var i=0; i<vectorAtributos.length; i++){
			componentes[i]=ClaseMadre_getComponente(vectorAtributos[i].validacion.name)
		}
		componentes[2].on('select',evento_gestion);		//parametro		
	}
	function evento_gestion( combo, record, index ){
			var id = record.data.id_gestion;
		
			
			componentes[3].store.baseParams={id_gestion:record.data.id_gestion};
			componentes[3].modificado=true;
			componentes[3].setValue('');
			componentes[3].setDisabled(false);			
		
		
	}	
this.EnableSelect=function(sm,row,rec){
		
		_CP.getPagina(layout_interfaz_siet_declara.getIdContentHijo()).pagina.reload(rec.data);
		enable(sm,row,rec)
	}
	

		//para que los hijos puedan ajustarse al tama�o
		this.getLayout=function(){return layout_interfaz_siet_declara.getLayout()};
			function  enable(sel,row,selected){
			var record=selected.data;
			
			
			cm_EnableSelect(sel,row,selected);
		}
	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_interfaz_siet_declara.getLayout()};
	//para el manejo de hijos
	this.getPagina=function(idContenedorHijo){
		var tam_elementos=elementos.length;
		for(i=0;i<tam_elementos;i++){
			if(elementos[i].idContenedor==idContenedorHijo){
				return elementos[i]
			}
		}
	};
	/*********************************reporte por transacciones ****************/
	function btn_rep_transacciones()
	{
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		
		if(NumSelect!=0)
		{
			var SelectionsRecord=sm.getSelected();
			var data='id_siet_declara='+SelectionsRecord.data.id_siet_declara;
		        data=data+'&reporte=transferencias';
		        data=data+'&periodo='+SelectionsRecord.data.periodo_lite;	
		        data=data+'&gestion='+SelectionsRecord.data.gestion;					
		       
				
			Ext.MessageBox.show({
				title: 'Imprimiendo',
				msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Generando reporte ...</div>",
				width:300,
				height:200,
				closable:false
			});
			
			window.open(direccion+'../../../control/_reportes/interfaz_siet/ActionPDF_RepFlujoCaja.php?'+data);					
		
			Ext.MessageBox.hide();		
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		}
	}
	
	/**************************************** boton rep resumen *****************************/
	function btn_rep_resumen()
	{
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		
		if(NumSelect!=0)
		{
			var SelectionsRecord=sm.getSelected();
			var data='id_siet_cbte=%';	
		        data=data+'&id_siet_declara='+SelectionsRecord.data.id_siet_declara;
		        data=data+'&reporte=resumen';				
		        data=data+'&tipo_declara='+SelectionsRecord.data.tipo_declara;
		        
				
			Ext.MessageBox.show({
				title: 'Imprimiendo',
				msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Generando reporte ...</div>",
				width:300,
				height:200,
				closable:false
			});
			
			window.open(direccion+'../../../control/_reportes/interfaz_siet/ActionPDF_RepFlujoCaja.php?'+data);					
		
			Ext.MessageBox.hide();		
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		}
	}
	/**********************************fin rep resumen************************/
	/*********************************reporte por oec ****************/
	function btn_rep_oec()
	{
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		
		if(NumSelect!=0)
		{
			var SelectionsRecord=sm.getSelected();
			var data='id_siet_cbte=%';	
		        data=data+'&id_siet_declara='+SelectionsRecord.data.id_siet_declara;
		        data=data+'&reporte=oec';					
		        data=data+'&tipo_declara='+SelectionsRecord.data.tipo_declara;
		        
				
			Ext.MessageBox.show({
				title: 'Imprimiendo',
				msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Generando reporte ...</div>",
				width:300,
				height:200,
				closable:false
			});
			
			window.open(direccion+'../../../control/_reportes/interfaz_siet/ActionPDF_RepFlujoCaja.php?'+data);					
		
			Ext.MessageBox.hide();		
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		}
	}
	/*****************************fin rep oec ****************************/
	/*********************************reporte por comprobante ****************/
	function btn_rep_cbte()
	{
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		
		if(NumSelect!=0)
		{
			var SelectionsRecord=sm.getSelected();
			var data='id_siet_cbte=%';	
		        data=data+'&id_siet_declara='+SelectionsRecord.data.id_siet_declara;
		        data=data+'&reporte=cbte';					
		        data=data+'&tipo_declara='+SelectionsRecord.data.tipo_declara;
		        
			Ext.MessageBox.show({
				title: 'Imprimiendo',
				msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Generando reporte ...</div>",
				width:300,
				height:200,
				closable:false
			});
			
			window.open(direccion+'../../../control/_reportes/interfaz_siet/ActionPDF_RepFlujoCaja.php?'+data);					
		
			Ext.MessageBox.hide();		
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		}
	}
	/*****************************fin rep cbte ****************************/
	//btn_rep_flujo_caja
	/*********************************reporte por comprobante ****************/
	function btn_rep_flujo_caja()
	{
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		
		if(NumSelect!=0)
		{
			var SelectionsRecord=sm.getSelected();
			var data='id_siet_cbte=%';	
		        data=data+'&id_siet_declara='+SelectionsRecord.data.id_siet_declara;
		        data=data+'&reporte=flujo';					
		        data=data+'&tipo_declara='+SelectionsRecord.data.tipo_declara;
		        
			Ext.MessageBox.show({
				title: 'Imprimiendo',
				msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Generando reporte ...</div>",
				width:300,
				height:200,
				closable:false
			});
			
			window.open(direccion+'../../../control/_reportes/interfaz_siet/ActionPDF_RepFlujoCaja.php?'+data);					
		
			Ext.MessageBox.hide();		
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		}
	}
	/*****************************fin rep cbte ****************************/
	/*function btn_gen_arch(){
		var sm=getSelectionModel();
		var NumSelect=sm.getCount();
		var SelectionsRecord=sm.getSelected();
		
		if(NumSelect==1){
			if(confirm('�Est� seguro de generar los Archivos para SIET?')){
				Ext.MessageBox.show({
					title: 'Procesando',
					msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Generando archivos...</div>",
					width:200,
					height:200,
					closable:false
				});
				Ext.Ajax.request({
					//txt
					//url:direccion+"../../../control/interfaz_siet/ActionGenerarArchivos.php",
					//
					url:direccion+"../../../control/interfaz_siet/ActionExcelReportesSIET.php",
					method:'POST',
					params:{cantidad_ids:'1',id_siet_declara:SelectionsRecord.data.id_siet_declara},
					success:function(resp){
						var root = resp.responseXML.documentElement;
						var error = root.getElementsByTagName('error')[0].firstChild.nodeValue;
						if(error=='1'){
							Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje_error')[0].firstChild.nodeValue);
							return;
						} else {
							Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje')[0].firstChild.nodeValue);
						}
					},
					failure:CM_conexionFailure,
					timeout:100000000
				});
			}
			
		} else{
			Ext.MessageBox.alert('Atenci�n', 'Antes debe seleccionar un item.');
		} 

	}*/
	function btn_gen_arch()
	{
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		
		if(NumSelect!=0)
		{
			var SelectionsRecord=sm.getSelected();
			var data='id_siet_cbte=%';	
		        data=data+'&id_siet_declara='+SelectionsRecord.data.id_siet_declara;
		        data=data+'&reporte=flujo';					
		        data=data+'&tipo_declara='+SelectionsRecord.data.tipo_declara;
		        
			Ext.MessageBox.show({
				title: 'Imprimiendo',
				msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Generando reporte ...</div>",
				width:300,
				height:200,
				closable:false
			});
			//url:direccion+"../../../control/interfaz_siet/ActionExcelReportesSIET.php",
			
			window.open(direccion+'../../../control/interfaz_siet/ActionExcelReportesSIET.php?'+data);					
		
			Ext.MessageBox.hide();		
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		}
	}
	
	/*****************************************GENERACION DE CBTES ***************/
  	function btn_gen_cbtes_pagados()
	{
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		var SelectionsRecord=sm.getSelected();
		
		if(NumSelect!=0)
		{			
			var sw=false;
			if(confirm('Esta seguro de MIGRAR COMPROBANTES?'))
				sw=true
				Ext.MessageBox.show({
					title: 'Procesando',
					msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Procesando...</div>",
					width:200,
					height:200,
					closable:false
				});
				
			if(sw)
			{
				var SelectionsRecord=sm.getSelections(); 			
	 			var arr_id_siet_declara = new Array;
	 			var arr_id_siet_declara_id_gestion = new Array;
	 			var arr_id_siet_declara_id_periodo = new Array;
	 			var arr_id_siet_declara_tipo_declara = new Array;
	 			for(var i=0 ; i<NumSelect ; i++)
	 			{
					arr_id_siet_declara[i]=SelectionsRecord[i].data.id_siet_declara;
					arr_id_siet_declara_id_gestion[i]=SelectionsRecord[i].data.id_gestion;
					arr_id_siet_declara_id_periodo[i]=SelectionsRecord[i].data.id_periodo;
					arr_id_siet_declara_tipo_declara[i]=SelectionsRecord[i].data.tipo_declara;
					
	 				Ext.Ajax.request({
					url:direccion+"../../../control/interfaz_siet/ActionGuardarSietCbte.php",
					method:'POST',
					params:{cantidad_ids:NumSelect,id_siet_declara_0:arr_id_siet_declara[i],id_gestion_0:arr_id_siet_declara_id_gestion[i],id_periodo_0:arr_id_siet_declara_id_periodo[i],tipo_declara_0:arr_id_siet_declara_tipo_declara[i],tipo_generacion_0:'todos'},
					success:function(resp){
						var root = resp.responseXML.documentElement;
						var error = root.getElementsByTagName('error')[0].firstChild.nodeValue;
						if(error=='1'){
							Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje_error')[0].firstChild.nodeValue);
							return;
						} else {
							Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje')[0].firstChild.nodeValue);
						}
					},
					failure:ClaseMadre_conexionFailure,
					timeout:100000000
					});				
	 			}
			} else{
				Ext.MessageBox.alert('Atenci�n', 'Antes debe seleccionar una declaraci�n.');
			} 

		}
	}	

/************************************************************ finalizar *********************/
function btn_finalizar(){
				var sm=getSelectionModel();
				var NumSelect=sm.getCount();
				var SelectionsRecord=sm.getSelected();
				
				if(NumSelect==1){
					if(confirm('�Est� seguro de finalizar la declaraci�n?')){
						Ext.MessageBox.show({
							title: 'Procesando',
							msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Procesando...</div>",
							width:200,
							height:200,
							closable:false
						});
						Ext.Ajax.request({
							url:direccion+"../../../control/interfaz_siet/ActionGuardarSietDeclara.php",
							method:'POST',
							params:{cantidad_ids:'1',txt_id_siet_declara_0:SelectionsRecord.data.id_siet_declara,txt_estado_0:'finalizar'},
							success:function(resp){
								var root = resp.responseXML.documentElement;
								var error = root.getElementsByTagName('error')[0].firstChild.nodeValue;
								if(error=='1'){
									Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje_error')[0].firstChild.nodeValue);
									return;
								} else {
									Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje')[0].firstChild.nodeValue);
								}
							},
							failure:CM_conexionFailure,
							timeout:100000000
						});
					}
					
				} else{
					Ext.MessageBox.alert('Atenci�n', 'Antes debe seleccionar una declaraci�n.');
				} 

			}
					
		


  	/**********************************************************fin finalizar********************/	
//--------------VISTA Detalle de Traspasos --------------//


function btn_traspasos(){
	var sm=getSelectionModel();
	var filas=ds.getModifiedRecords();
	var cont=filas.length;
	var NumSelect=sm.getCount();
	if(NumSelect!=0){ 

		var SelectionsRecord=sm.getSelected();
		/*var data='m_id_moneda=1';
		    data=data+'&m_nombre=Bs';*/
		  
       var data='m_id_siet_declara='+SelectionsRecord.data.id_siet_declara;	
           data=data+'&m_tipo_declara='+SelectionsRecord.data.tipo_declara;
           data=data+'&m_periodo='+SelectionsRecord.data.periodo_lite;
           data=data+'&m_gestion='+SelectionsRecord.data.gestion;
          
			
	    var ParamVentana={Ventana:{width:'90%',height:'70%'}}
	            //layout_siet_cbte.loadWindows(direccion+'../../../../sis_parametros/vista/tipo_cambio/tipo_cambio_det.php?'+data,'Tipo de Cambio',ParamVentana);
	 
	    layout_interfaz_siet_declara.loadWindows(direccion+'../../../../sis_presupuesto/vista/interfaz_siet/siet_traspasos.php?'+data,'Detalle de Traspasos',ParamVentana);
	    layout_interfaz_siet_declara.getVentana().on('resize',function(){
	    layout_interfaz_siet_declara.getLayout().layout();
			});
		
	}
	else
	{
		Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
	}
}

/**************************Extracci�n de Fondos en Avance del Fondo Rotatorio *********************/
function btn_div_caj_fa()
{
	var sm=getSelectionModel();
	var filas=ds.getModifiedRecords();
	var cont=filas.length;
	var NumSelect=sm.getCount();
	var SelectionsRecord=sm.getSelected();
	
		var sw=false;
		if(confirm('Esta seguro de Extraer Fondos en Avance de Fondos Rotatorios'))
			sw=true
			Ext.MessageBox.show({
				title: 'Procesando',
				msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Procesando...</div>",
				width:200,
				height:200,
				closable:false
			});
			
		if(sw)
		{
			var SelectionsRecord=sm.getSelected(); 			
 			//var arr_id_siet_declara = new Array;
 			//var arr_id_siet_declara_tipo_declara = new Array;
 				var id_siet_declara=SelectionsRecord.data.id_siet_declara;
				var id_gestion=SelectionsRecord.data.id_gestion;
				var id_periodo=SelectionsRecord.data.id_periodo;
				var tipo_declara=SelectionsRecord.data.tipo_declara;
				
 				Ext.Ajax.request({
				url:direccion+"../../../control/interfaz_siet/ActionExtraerFAdeFR.php",
				method:'POST',
				params:{cantidad_ids:1,id_siet_declara_0:id_siet_declara,id_gestion_0:id_gestion,id_periodo_0:id_periodo,tipo_declara_0:tipo_declara,tipo_ext_0:'extraer'},
				success:function(resp){
					var root = resp.responseXML.documentElement;
					var error = root.getElementsByTagName('error')[0].firstChild.nodeValue;
					if(error=='1'){
						Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje_error')[0].firstChild.nodeValue);
						return;
					} else {
						Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje')[0].firstChild.nodeValue);
					}
				},
				failure:ClaseMadre_conexionFailure,
				timeout:100000000
				});				
 			
		
	}
}	

/**************************Unir Fondos en Avance al Fondo Rotatorio Original *********************/
function btn_unir_caj_fa()
{
	var sm=getSelectionModel();
	var filas=ds.getModifiedRecords();
	var cont=filas.length;
	var NumSelect=sm.getCount();
	var SelectionsRecord=sm.getSelected();
	
		var sw=false;
		if(confirm('Esta seguro de Unir Fondos en Avance de Fondos Rotatorios'))
			sw=true
			Ext.MessageBox.show({
				title: 'Procesando',
				msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Procesando...</div>",
				width:200,
				height:200,
				closable:false
			});
			
		if(sw)
		{
			var SelectionsRecord=sm.getSelected(); 			
 			//var arr_id_siet_declara = new Array;
 			//var arr_id_siet_declara_tipo_declara = new Array;
 				var id_siet_declara=SelectionsRecord.data.id_siet_declara;
				var id_gestion=SelectionsRecord.data.id_gestion;
				var id_periodo=SelectionsRecord.data.id_periodo;
				var tipo_declara=SelectionsRecord.data.tipo_declara;
				
 				Ext.Ajax.request({
				url:direccion+"../../../control/interfaz_siet/ActionExtraerFAdeFR.php",
				method:'POST',
				params:{cantidad_ids:1,id_siet_declara_0:id_siet_declara,id_gestion_0:id_gestion,id_periodo_0:id_periodo,tipo_declara_0:tipo_declara,tipo_ext_0:'unir'},
				success:function(resp){
					var root = resp.responseXML.documentElement;
					var error = root.getElementsByTagName('error')[0].firstChild.nodeValue;
					if(error=='1'){
						Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje_error')[0].firstChild.nodeValue);
						return;
					} else {
						Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje')[0].firstChild.nodeValue);
					}
				},
				failure:ClaseMadre_conexionFailure,
				timeout:100000000
				});				
 			
		
	}
}	
/*********************************************************************************generar partidas****************/
function btn_gen_partidas(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		var SelectionsRecord=sm.getSelected();
		
			if(confirm('Esta seguro de Generar Partidas A los comprobantes Validados?')){
				
				Ext.MessageBox.show({
					title: 'Procesando',
					msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Procesando...</div>",
					width:200,
					height:200,
					closable:false
				})};
				
	 			
	 				var id_siet_declara=SelectionsRecord.data.id_siet_declara;
					var periodo_lite=SelectionsRecord.data.periodo_lite;
					var gestion=SelectionsRecord.data.gestion;
					
					
	 				Ext.Ajax.request({
	 					url:direccion+"../../../control/interfaz_siet/ActionGenerarSietPartidas.php",
					method:'POST',
					params:{cantidad_ids:1,id_siet_declara_0:id_siet_declara,periodo_lite_0:periodo_lite,gestion_0:gestion},
					success:function(resp){
						var root = resp.responseXML.documentElement;
						var error = root.getElementsByTagName('error')[0].firstChild.nodeValue;
						if(error=='1'){
							Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje_error')[0].firstChild.nodeValue);
							return;
						} else {
							Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje')[0].firstChild.nodeValue);
						}
					},
					failure:ClaseMadre_conexionFailure,
					timeout:100000000
					});				
	 			
			
}	


/********************fin generar partidas************************/

/*********************************************************************************generar partidas de excel****************/
function btn_gen_partidas_excel(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		var SelectionsRecord=sm.getSelected();
		
			if(confirm('Esta seguro de MIGRAR COMPROBANTES?')){
				
				Ext.MessageBox.show({
					title: 'Procesando',
					msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Procesando...</div>",
					width:200,
					height:200,
					closable:false
				})};
				//var SelectionsRecord=sm.getSelections(); 			
	 			/*var arr_id_siet_declara = new Array;
	 			var arr_id_siet_declara_id_gestion = new Array;
	 			var arr_id_siet_declara_id_periodo = new Array;
	 			var arr_id_siet_declara_tipo_declara = new Array;*/
	 				var id_siet_declara=SelectionsRecord.data.id_siet_declara;
					var periodo_lite=SelectionsRecord.data.periodo_lite;
					var gestion=SelectionsRecord.data.gestion;
					var tipo_declara=SelectionsRecord.data.tipo_declara;
					
					
	 				Ext.Ajax.request({
	 					url:direccion+"../../../control/interfaz_siet/ActionGuardarCbtesPartidasExcel.php",
					method:'POST',
					params:{cantidad_ids:1,id_siet_declara:id_siet_declara,periodo_lite:periodo_lite,gestion:gestion,tipo_declara:tipo_declara},
					success:function(resp){
						var root = resp.responseXML.documentElement;
						var error = root.getElementsByTagName('error')[0].firstChild.nodeValue;
						if(error=='1'){
							Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje_error')[0].firstChild.nodeValue);
							return;
						} else {
							Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje')[0].firstChild.nodeValue);
						}
					},
					failure:ClaseMadre_conexionFailure,
					timeout:100000000
					});				
	 			
			
}	


/********************fin generar excel************************/
/*********************************************************************************generar oecs****************/
function btn_gen_oecs(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		var SelectionsRecord=sm.getSelected();
		
			if(confirm('Esta seguro de Generar OECs A los comprobantes Validados?')){
				
				Ext.MessageBox.show({
					title: 'Procesando',
					msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Procesando...</div>",
					width:200,
					height:200,
					closable:false
				})};
				
	 			
	 				var id_siet_declara=SelectionsRecord.data.id_siet_declara;
					var periodo_lite=SelectionsRecord.data.periodo_lite;
					var gestion=SelectionsRecord.data.gestion;
					
					
	 				Ext.Ajax.request({
	 					url:direccion+"../../../control/interfaz_siet/ActionGenerarSietOECs.php",
					method:'POST',
					params:{cantidad_ids:1,id_siet_declara_0:id_siet_declara,periodo_lite:periodo_lite,gestion:gestion},
					success:function(resp){
						var root = resp.responseXML.documentElement;
						var error = root.getElementsByTagName('error')[0].firstChild.nodeValue;
						if(error=='1'){
							Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje_error')[0].firstChild.nodeValue);
							return;
						} else {
							Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje')[0].firstChild.nodeValue);
						}
					},
					failure:ClaseMadre_conexionFailure,
					timeout:100000000
					});				
	 			
			
}	


/********************fin generar oecs************************/
/*********************************************************************************generar backups****************/
function btn_generar_backup_eb(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		var SelectionsRecord=sm.getSelected();
		
			if(confirm('Esta seguro de Generar El Backup de Extractos Bancarios?')){
				
				Ext.MessageBox.show({
					title: 'Procesando',
					msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Procesando...</div>",
					width:200,
					height:200,
					closable:false
				})};
				
	 			
	 				var id_siet_declara=SelectionsRecord.data.id_siet_declara;
					var id_periodo=SelectionsRecord.data.id_periodo;
					
					
	 				Ext.Ajax.request({
	 					url:direccion+"../../../control/interfaz_siet/ActionGenerarExtractoBancario.php",
					method:'POST',
					params:{cantidad_ids:1,id_siet_declara_0:id_siet_declara,id_periodo_0:id_periodo,accion_0:'generar_backup'},
					success:function(resp){
						var root = resp.responseXML.documentElement;
						var error = root.getElementsByTagName('error')[0].firstChild.nodeValue;
						if(error=='1'){
							Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje_error')[0].firstChild.nodeValue);
							return;
						} else {
							Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje')[0].firstChild.nodeValue);
						}
					},
					failure:ClaseMadre_conexionFailure,
					timeout:100000000
					});				
	 			
			
}	


/********************fin generar backups************************/
/*********************************************************************************subir extracto bancario****************/
function btn_subir_backup_eb(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		var SelectionsRecord=sm.getSelected();
		
			if(confirm('Esta seguro de Subir El Backup de Extractos Bancarios?')){
				
				Ext.MessageBox.show({
					title: 'Procesando',
					msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Procesando...</div>",
					width:200,
					height:200,
					closable:false
				})};
				
	 			
	 				var id_siet_declara=SelectionsRecord.data.id_siet_declara;
					var id_periodo=SelectionsRecord.data.id_periodo;
					
					
	 				Ext.Ajax.request({
	 					url:direccion+"../../../control/interfaz_siet/ActionGenerarExtractoBancario.php",
					method:'POST',
					params:{cantidad_ids:1,id_siet_declara_0:id_siet_declara,id_periodo_0:id_periodo,accion_0:'subir_backup'},
					success:function(resp){
						var root = resp.responseXML.documentElement;
						var error = root.getElementsByTagName('error')[0].firstChild.nodeValue;
						if(error=='1'){
							Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje_error')[0].firstChild.nodeValue);
							return;
						} else {
							Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje')[0].firstChild.nodeValue);
						}
					},
					failure:ClaseMadre_conexionFailure,
					timeout:100000000
					});				
	 			
			
}	


/********************fin generar backups************************/
/*********************************reporte por comprobante ****************/
function btn_rep_seguimiento_fa()
{
	var sm=getSelectionModel();
	var filas=ds.getModifiedRecords();
	var cont=filas.length;
	var NumSelect=sm.getCount();
	
	if(NumSelect!=0)
	{
		var SelectionsRecord=sm.getSelected();
		var data='id_siet_cbte=%';	
	        data=data+'&id_siet_declara='+SelectionsRecord.data.id_siet_declara;
	        data=data+'&reporte=seguimiento_fa';					
	        data=data+'&tipo_declara='+SelectionsRecord.data.tipo_declara;
	        
		Ext.MessageBox.show({
			title: 'Imprimiendo',
			msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Generando reporte ...</div>",
			width:300,
			height:200,
			closable:false
		});
		
		window.open(direccion+'../../../control/_reportes/interfaz_siet/ActionPDF_RepFlujoCaja.php?'+data);					
	
		Ext.MessageBox.hide();		
	}
	else
	{
		Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
	}
}

function btn_rep_seguimiento_fa_excel()
{
	var sm=getSelectionModel();
	var filas=ds.getModifiedRecords();
	var cont=filas.length;
	var NumSelect=sm.getCount();
	
	if(NumSelect!=0)
	{
		var SelectionsRecord=sm.getSelected();
		var data='id_siet_cbte=%';	
	        data=data+'&id_siet_declara='+SelectionsRecord.data.id_siet_declara;
	        data=data+'&reporte=seguimiento_fa';					
	        data=data+'&tipo_declara='+SelectionsRecord.data.tipo_declara;
	        
		Ext.MessageBox.show({
			title: 'Imprimiendo',
			msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Generando reporte ...</div>",
			width:300,
			height:200,
			closable:false
		});
		
		window.open(direccion+'../../../control/interfaz_siet/ActionExcelSeguimientoFA.php?'+data);					
	
		Ext.MessageBox.hide();		
	}
	else
	{
		Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
	}
}


function btn_rep_fa_anual_excel()
{
	var sm=getSelectionModel();
	var filas=ds.getModifiedRecords();
	var cont=filas.length;
	var NumSelect=sm.getCount();
	
	if(NumSelect!=0)
	{
		var SelectionsRecord=sm.getSelected();
		var data='id_siet_cbte=%';	
	        data=data+'&id_siet_declara='+SelectionsRecord.data.id_siet_declara;
	        data=data+'&reporte=fa_anual';					
	        data=data+'&tipo_declara='+SelectionsRecord.data.tipo_declara;
	        
		Ext.MessageBox.show({
			title: 'Imprimiendo',
			msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Generando reporte ...</div>",
			width:300,
			height:200,
			closable:false
		});
		
		window.open(direccion+'../../../control/interfaz_siet/ActionExcelFAAnual.php?'+data);					
	
		Ext.MessageBox.hide();		
	}
	else
	{
		Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
	}
}

function btn_rep_div_fr()
{
	var sm=getSelectionModel();
	var filas=ds.getModifiedRecords();
	var cont=filas.length;
	var NumSelect=sm.getCount();
	
	if(NumSelect!=0)
	{
		var SelectionsRecord=sm.getSelected();
		var data='id_siet_cbte=%';	
	        data=data+'&id_siet_declara='+SelectionsRecord.data.id_siet_declara;
	        data=data+'&reporte=division_fr';					
	        data=data+'&tipo_declara='+SelectionsRecord.data.tipo_declara;
	        
		Ext.MessageBox.show({
			title: 'Imprimiendo',
			msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Generando reporte ...</div>",
			width:300,
			height:200,
			closable:false
		});
		
		window.open(direccion+'../../../control/_reportes/interfaz_siet/ActionPDF_RepFlujoCaja.php?'+data);					
	
		Ext.MessageBox.hide();		
	}
	else
	{
		Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
	}
}
/*************************************************************************BOTON PARA GENERAR NROS DE DOCUMENTOS PARA PRESENTACI�N AL SIET***************************/

function btn_gen_nros_documentos(){
	var sm=getSelectionModel();
	var filas=ds.getModifiedRecords();
	var cont=filas.length;
	var NumSelect=sm.getCount();
	var SelectionsRecord=sm.getSelected();
	
		if(confirm('Esta seguro de GENERAR NROS PARA PRESENTAR SIET?')){
			
			Ext.MessageBox.show({
				title: 'Procesando',
				msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Procesando...</div>",
				width:200,
				height:200,
				closable:false
			})};
			
 				var id_siet_declara=SelectionsRecord.data.id_siet_declara;
				var periodo_lite=SelectionsRecord.data.periodo_lite;
				var gestion=SelectionsRecord.data.gestion;
				
				Ext.Ajax.request({
				url:direccion+"../../../control/interfaz_siet/ActionGuardarSietDeclara.php",
				method:'POST',
				params:{cantidad_ids:'1',txt_id_siet_declara_0:id_siet_declara,txt_estado_0:'generar_nros'},
					success:function(resp){
					var root = resp.responseXML.documentElement;
					var error = root.getElementsByTagName('error')[0].firstChild.nodeValue;
					if(error=='1'){
						Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje_error')[0].firstChild.nodeValue);
						return;
					} else {
						Ext.MessageBox.alert('Informaci�n',root.getElementsByTagName('mensaje')[0].firstChild.nodeValue);
					}
				},
				failure:ClaseMadre_conexionFailure,
				timeout:100000000
				});				
 			
		
}	
/*   FIN GENERAR NROS DE DOCUMENTOS */


  	function cambio_Success(resp)
		{
			Ext.MessageBox.hide();
			if(resp.responseXML&&resp.responseXML.documentElement)
			{								
				ClaseMadre_btnActualizar();
			}
			else
			{
				ClaseMadre_conexionFailure();
			}
		}	
	this.getElementos=function(){return elementos};
	this.setPagina=function(elemento){elementos.push(elemento)};

				//-------------- FIN DEFINICI�N DE FUNCIONES PROPIAS --------------//
	/*this.EnableSelect=function(x,z,y){
		enable(x,z,y)
	}
	*/
				this.Init(); //iniciamos la clase madre
				this.InitBarraMenu(paramMenu);
				this.InitFunciones(paramFunciones);
			 
				 	
			//	this.AdicionarBoton('../../../lib/imagenes/print.gif','Imprime Las transacciones realizadas',btn_rep_transacciones,true,'btn_rep_transacciones','Reporte Transacciones');
				 this.AdicionarMenuBotonSimple({text:'Extractos B.', 
				        nombre:'Extractos B.',
				        icon:'../../../lib/imagenes/det.ico',
				        cls: 'x-btn-text-icon bmenu', // icon and text class
				        items:[{ text:'Generar Backup ',
				     	       nombre:'btn_generar_backup_eb',
				     	       handler:btn_generar_backup_eb,
				     	       icon:'../../../lib/imagenes/copy.png',
				     	      // cls:'x-btn-text-icon'
				     	       cls: 'x-btn-icon',
				     	      },
				     	       {   text:'Subir Extractos B.',
				         	       nombre:'btn_subir_backup_eb',
				         	       handler:btn_subir_backup_eb,
				         	       icon:'../../../lib/imagenes/book_next.png',
				         	       // cls:'x-btn-text-icon'
				         	       cls: 'x-btn-icon',
				         	    }
				     	   ] 
				          });
				
				this.AdicionarBoton('../../../lib/imagenes/copy.png','Procesa Cbtes',btn_gen_cbtes_pagados,true,'gen_cbtes_pagados','Generar Cbtes.');
				this.AdicionarMenuBotonSimple({text:'Fondos en Avance', 
			        nombre:'Fondos en Avance',
			        icon:'../../../lib/imagenes/det.ico',
			        cls: 'x-btn-text-icon bmenu', // icon and text class
			        items:[{ text:'Extraer FA de FR ',
			     	       nombre:'div_caj_fa',
			     	       handler:btn_div_caj_fa,
			     	       icon:'../../../lib/imagenes/copy.png',
			     	      // cls:'x-btn-text-icon'
			     	       cls: 'x-btn-icon',
			     	      },
				     	     /*{ text:'Deshacer la Extracci�n de FR ',
				     	       nombre:'unir_caj_fa',
				     	       handler:btn_unir_caj_fa,
				     	       icon:'../../../lib/imagenes/copy.png',
				     	      // cls:'x-btn-text-icon'
				     	       cls: 'x-btn-icon',
				     	      },*/
				     	     {   text:'Divisi�n de Fondos Rotatorios',
			         	       nombre:'btn_rep_div_fr',
			         	       handler:btn_rep_div_fr,
			         	       icon:'../../../lib/imagenes/print.gif',
			         	       // cls:'x-btn-text-icon'
			         	       cls: 'x-btn-icon',
			         	    },
				         	   
					     	     {   text:'Seguimiento de Fondos en Avance',
				         	       nombre:'btn_rep_seguimiento_fa',
				         	       handler:btn_rep_seguimiento_fa,
				         	       icon:'../../../lib/imagenes/print.gif',
				         	       // cls:'x-btn-text-icon'
				         	       cls: 'x-btn-icon',
				         	    },
			     	       {   text:'Seguimiento de Fondos en Avance',
			         	       nombre:'btn_rep_seguimiento_fa_excel',
			         	       handler:btn_rep_seguimiento_fa_excel,
			         	       icon:'../../../lib/imagenes/excel_16x16.gif',
			         	       // cls:'x-btn-text-icon'
			         	       cls: 'x-btn-icon',
			         	    },
				     	       {   text:'Fondos en Avance Anual',
				         	       nombre:'btn_rep_fa_anual_excel',
				         	       handler:btn_rep_fa_anual_excel,
				         	       icon:'../../../lib/imagenes/excel_16x16.gif',
				         	       // cls:'x-btn-text-icon'
				         	       cls: 'x-btn-icon',
				         	    }
			     	   ] 
			          });
				//this.AdicionarBoton('../../../lib/imagenes/copy.png','Finalizar',btn_div_caj_fa,true,'div_caj_fa','F. Rotatorios');
				 this.AdicionarBoton('../../../lib/imagenes/detalle.png','Traspasos',btn_traspasos,true,'Traspasos','Traspasos');
				 this.AdicionarMenuBotonSimple({text:'Partidas', 
				        nombre:'Partidas',
				        icon:'../../../lib/imagenes/det.ico',
				        cls: 'x-btn-text-icon bmenu', // icon and text class
				        items:[{ text:'Generar Partidas ',
				     	       nombre:'btn_gen_partidas',
				     	       handler:btn_gen_partidas,
				     	       icon:'../../../lib/imagenes/copy.png',
				     	      // cls:'x-btn-text-icon'
				     	       cls: 'x-btn-icon',
				     	      },
				     	       {   text:'Procesa Excel Partidas',
				         	       nombre:'btn_gen_partidas_excel',
				         	       handler:btn_gen_partidas_excel,
				         	       icon:'../../../lib/imagenes/book_next.png',
				         	       // cls:'x-btn-text-icon'
				         	       cls: 'x-btn-icon',
				         	    }
				     	   ] 
				          });
				 this.AdicionarMenuBotonSimple({text:'OECs', 
				        nombre:'OEC',
				        icon:'../../../lib/imagenes/det.ico',
				        cls: 'x-btn-text-icon bmenu', // icon and text class
				        items:[{ text:'Generar OEC ',
				     	       nombre:'btn_gen_oecs',
				     	       handler:btn_gen_oecs,
				     	       icon:'../../../lib/imagenes/copy.png',
				     	      // cls:'x-btn-text-icon'
				     	       cls: 'x-btn-icon',
				     	      }
				     	   ] 
				          });  
				  // this.AdicionarBoton('../../../lib/imagenes/copy.png','Procesa Excel Partidas',btn_gen_partidas_excel,true,'gen_partidas_excel','Proc. Excel');
				//this.AdicionarBoton('../../../lib/imagenes/print.gif','Imprime el Resumen de Comprobantes ',btn_rep_resumen,true,'btn_rep_resumen','Reporte Resumen');
				//this.AdicionarBoton('../../../lib/imagenes/print.gif','Imprime por Codigo OEC',btn_rep_oec,true,'rep_oec','Reporte OEC');
				//this.AdicionarBoton('../../../lib/imagenes/print.gif','Imprime por Comprobante',btn_rep_cbte,true,'rep_cbte','Reporte Comprobante');
				//this.AdicionarBoton('../../../lib/imagenes/print.gif','Reporte Flujo de Caja',btn_rep_flujo_caja,true,'rep_cbte','Reporte Flujo de Caja');
				this.AdicionarMenuBotonSimple({text:'Reportes', 
			        nombre:'Reportes',
			        icon:'../../../lib/imagenes/det.ico',
			        cls: 'x-btn-text-icon bmenu', // icon and text class
			        items:[{ text:'Imprime el Resumen de Comprobantes ',
			     	       nombre:'btn_rep_resumen',
			     	       handler:btn_rep_resumen,
			     	       icon:'../../../lib/imagenes/print.gif',
			     	      // cls:'x-btn-text-icon'
			     	       cls: 'x-btn-icon',
			     	      },
			     	       {   text:'Imprime por Codigo OEC',
			         	       nombre:'btn_rep_oec',
			         	       handler:btn_rep_oec,
			         	       icon:'../../../lib/imagenes/print.gif',
			         	       // cls:'x-btn-text-icon'
			         	       cls: 'x-btn-icon',
			         	    },
			         	    {   text:'Imprime por Comprobante',
			           	       nombre:'btn_rep_cbte',
			           	       handler:btn_rep_cbte,
			           	       icon:'../../../lib/imagenes/print.gif',
			           	       // cls:'x-btn-text-icon'
			           	       cls: 'x-btn-icon',
			           	    },
			             	  {   text:'Reporte Flujo de Caja',
			             	       nombre:'btn_rep_flujo_caja',
			             	       handler:btn_rep_flujo_caja,
			             	       icon:'../../../lib/imagenes/print.gif',
			             	       // cls:'x-btn-text-icon'
			             	       cls: 'x-btn-icon',
			             	    }/*,
			             	  {   text:'Validar OEC',
			             	       nombre:'btn_validar_sino',
			             	       handler:btn_validar_sino,
			             	       icon:'../../../lib/imagenes/ok.png',
			             	       // cls:'x-btn-text-icon'
			             	       cls: 'x-btn-icon',
			             	    }*/
			     	   ] 
			          });
				this.AdicionarBoton('../../../lib/imagenes/a_table_gear.png','Genera Nros de Documentos y Secuenciales al Reporte Final',btn_gen_nros_documentos,true,'gen_nros','Generar Nros.');
				this.AdicionarBoton('../../../lib/imagenes/carpeta.png','Genera los Archivos txt para la subida a la interfaz SIET',btn_gen_arch,true,'gen_arch','Generar Archivos');
				this.AdicionarBoton('../../../lib/imagenes/ok.png','Finalizar',btn_finalizar,true,'finalizar declaracion','Finalizar');
				var CM_getBoton=this.getBoton;
                

			function  enable(sel,row,selected){
					var record=selected.data;
					
					if(selected&&record!=-1){
						if (record.estado=='finalizado'){
							
							CM_getBoton('btn_gen_partidas-'+idContenedor).disable();
							CM_getBoton('btn_gen_partidas_excel-'+idContenedor).disable();
							
						}else{
                        	CM_getBoton('btn_gen_partidas-'+idContenedor).enable();
                        	CM_getBoton('btn_gen_partidas_excel-'+idContenedor).enable();
						}

                    
					}

					
					//enableSelect(sel,row,selected);
				}
							
				this.iniciaFormulario();
				iniciarEventosFormularios();
				layout_interfaz_siet_declara.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
				ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario)
}