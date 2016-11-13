<?php 
/**
 * Nombre:		  	    parametro_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-07-02 22:12:49
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
<?php if($_SESSION["ss_filtro_avanzado"]!=''){echo 'fa='.$_SESSION["ss_filtro_avanzado"].';';}?>
var paramConfig={TamanoPagina:_CP.getConfig().ss_tam_pag,TiempoEspera:_CP.getConfig().ss_tiempo_espera,CantFiltros:1,FiltroEstructura:false,FiltroAvanzado:fa};
var elemento={pagina:new parametro_tesoro(idContenedor,direccion,paramConfig),idContenedor:idContenedor};
_CP.setPagina(elemento);
}
Ext.onReady(main,main);

//view added
/**
 * Nombre:		  	    pagina_parametro.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-07-02 22:12:49
 */
function parametro_tesoro(idContenedor,direccion,paramConfig){
	var Atributos=new Array,sw=0;
	var cmpIdParametro;		
	var cmpIdGestion;		
	var cmpCantidadNivel;		
	var cmpEstadoGestion;
	var cmpGestionTesoro;
	var componentes=new Array;
	//---DATA STORE
	var ds = new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/parametro/ActionListarParametro.php'}),
		reader: new Ext.data.XmlReader({
		record: 'ROWS',id:'id_parametro',totalRecords:'TotalCount'
		},[		
		'id_parametro',
		'id_gestion',
		'gestion',
		'cantidad_nivel',
		'estado_gestion',
		'gestion_tesoro',
		'max_sol_pendientes_viatico',
		'max_sol_pendientes_fa',
		'descuento_viaticos',
		'dias_aplica_descuento',
		'porcentaje_descuento',
		'max_sol_pendientes_efe',
		'sw_detiene',
		{name: 'fecha_del',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_al',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_fin_viaje',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_fin_viaje_al',type:'date',dateFormat:'Y-m-d'}
		]),remoteSort:true});
	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros
		}
	});
	//DATA STORE COMBOS
    var ds_gestion = new Ext.data.Store({proxy:new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/gestion/ActionListarGestion.php'}),
			reader:new Ext.data.XmlReader({record:'ROWS',id:'id_gestion',totalRecords:'TotalCount'},['id_gestion','id_empresa','id_moneda_base','gestion','estado_ges_gral'])
	});
	//FUNCIONES RENDER
		function render_id_gestion(value, p, record){return String.format('{0}', record.data['gestion']);}
		var tpl_id_gestion=new Ext.Template('<div class="search-item">','<b><i>{gestion}</i></b>','<br><FONT COLOR="#B5A642"><b>Estado: </b>{estado_ges_gral}</FONT>','</div>');
	////////////////FUNCIONES RENDER ////////////
	function renderEstado(value, p, record){
		if(value == 1)
		{return  "Abierto"}
		if(value == 2)
		{return  "Cerrado"}
	}
	
	function renderDetiene(value, p, record){
		if(value == '0'){return  "Ninguno"}
		if(value == 'EF'){return  "Efectivo"}
		if(value == 'SV'){return  "Vi�ticos"}
		if(value == 'FA'){return  "Fondo Avance"}
		if(value == 'EF-FA'){return  "Efectivo y F.Avance"}
		if(value == 'EF-SV'){return  "Efectivo y Viatico"}
		if(value == 'SV-FA'){return  "Vi�tico y F.Avance"}
		if(value == 'ALL'){return  "Todos"}
	}
	/////////////////////////
	// Definici�n de datos //
	/////////////////////////
	// hidden id_parametro
	//en la posici�n 0 siempre esta la llave primaria
	Atributos[0]={
		validacion:{
			labelSeparator:'',
			name:'id_parametro',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo:'Field',
		filtro_0:false,
		save_as:'id_parametro'
	};
	Atributos[1]={
			validacion:{
			name:'id_gestion',
			fieldLabel:'Gesti�n',
			allowBlank:false,			
			emptyText:'Gesti�n...',
			desc:'gestion', //indica la columna del store principal ds del que proviane la descripcion
			store:ds_gestion,
			valueField:'id_gestion',
			displayField:'gestion',
			filterCol:'GESTIO.gestion',
			typeAhead:true,
			tpl:tpl_id_gestion,
			forceSelection:true,
			mode:'remote',
			onSelect:function(record){cmpIdGestion.setValue(record.data.id_gestion);cmpGestionTesoro.setValue(record.data.gestion);cmpIdGestion.collapse();},
			queryDelay:250,
			pageSize:10,
			minListWidth:250,
			grow:true,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
			triggerAction:'all',
			editable:true,
			renderer:render_id_gestion,
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			width:250,
			disabled:false
			},
		tipo:'ComboBox',
		form:true,
		filtro_0:true,
		filterColValue:'GESTIO.gestion',
		save_as:'id_gestion'
	}; 	

// txt estado_gral
	Atributos[2]={
			validacion: {
			name:'cantidad_nivel',
			fieldLabel:'Cantidad de Niveles',
			allowBlank:false,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:150,
			width:200,
			disabled:false	
		},
		tipo:'NumberField',
		form:true,
		filtro_0:true,
		filterColValue:'PARAME.cantidad_nivel',
		save_as:'cantidad_nivel'
	};															
// txt estado_gral
	Atributos[3]={
			validacion: {
			name:'estado_gestion',
			fieldLabel:'Estado',
			allowBlank:false,
			typeAhead:true,
			loadMask:true,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[['1','Abierto'],['2','Cerrado']]}),
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			renderer:renderEstado,	//aumentado 
			forceSelection:true,
			grid_visible:true,
			grid_editable:false,
			width_grid:150,
			minListWidth:100,
			disable:false
		},
		tipo:'ComboBox',
		form:true,
		filtro_0:true,
		filterColValue:'PARAME.estado_gestion',
		save_as:'estado_gestion'
	};
// txt gestion_pres
	Atributos[4]={
		validacion:{
			name:'gestion_tesoro',
			fieldLabel:'Gesti�n Tesorer�a',
			allowBlank:true,
			maxLength:4,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:0,
			grid_visible:false,
			grid_editable:false,
			width_grid:180,
			width:200,
			disabled:false
		},
		tipo:'NumberField',
		form:true,
		filtro_0:true,
		filterColValue:'PARAME.gestion_tesoro',
		save_as:'gestion_tesoro'
	};

	
	Atributos[5]={
		validacion:{
			name:'max_sol_pendientes_viatico',
			fieldLabel:'Max. # de Vi�ticos sin Finalizar',
			allowBlank:true,
			maxLength:2,
			minLength:1,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:1,
			grid_visible:true,
			grid_editable:true,
			width_grid:180,
			width:200,
			disabled:false
		},
		tipo:'NumberField',
		form:true,
		filtro_0:false
	};	
	
	Atributos[6]={
		validacion:{
			name:'max_sol_pendientes_fa',
			fieldLabel:'Max. # de F.A. sin Finalizar',
			allowBlank:true,
			maxLength:2,
			minLength:1,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:1,
			grid_visible:true,
			grid_editable:true,
			width_grid:180,
			width:200,
			disabled:false
		},
		tipo:'NumberField',
		form:true,
		filtro_0:false
	};
	
	Atributos[7]={
		validacion:{
			name:'max_sol_pendientes_efe',
			fieldLabel:'Max. # de Efectivos sin Finalizar',
			allowBlank:true,
			maxLength:2,
			minLength:1,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:1,
			grid_visible:true,
			grid_editable:true,
			width_grid:180,
			width:200,
			disabled:false
		},
		tipo:'NumberField',
		form:true,
		filtro_0:false
	};	

	Atributos[8]={
		validacion: {
			name:'descuento_viaticos',
			fieldLabel:'Aplicar Descuento por Vi�ticos',
			allowBlank:false,
			typeAhead:true,
			loadMask:true,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[['si','si'],['no','no']]}),
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			forceSelection:true,
			grid_visible:true,
			grid_editable:false,
			width_grid:150,
			minListWidth:100,
			disable:false
		},
		tipo:'ComboBox',
		defecto:'no',
		form:true,
		filtro_0:false
	};
	
	Atributos[9]={
		validacion:{
			name:'dias_aplica_descuento',
			fieldLabel:'# de d�as para descontar',
			allowBlank:false,
			maxLength:2,
			minLength:1,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:1,
			grid_visible:true,
			grid_editable:true,
			width_grid:180,
			width:200,
			disabled:false
		},
		tipo:'NumberField',
		form:true,
		filtro_0:false,
		id_grupo:1
	};	
	
	Atributos[10]={
		validacion:{
			name:'porcentaje_descuento',
			fieldLabel:'% a Pagar con Descuento',
			allowBlank:false,
			maxLength:2,
			minLength:1,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:1,
			grid_visible:true,
			grid_editable:true,
			width_grid:180,
			width:200,
			disabled:false
		},
		tipo:'NumberField',
		form:true,
		filtro_0:false,
		id_grupo:1
	};
	
	Atributos[11]={
		validacion: {
			name:'sw_detiene',
			fieldLabel:'Detener Solicitud',
			allowBlank:false,
			typeAhead:true,
			loadMask:true,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[['0','Ninguno'],['EF','Efectivo'],['SV','Vi�ticos'],['FA','Fondos Avance'],['EF-SV','Efectivo y Vi�tico'],
			                                                            ['EF-FA','Efectivo y F.Avance'],['SV-FA','Vi�tico y F.Avance'],['ALL','Todos']]}),
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			renderer:renderDetiene,	//aumentado 
			forceSelection:true,
			grid_visible:true,
			grid_editable:true,
			width_grid:150,
			minListWidth:100,
			disable:false
		},
		tipo:'ComboBox',
		form:false,
		filtro_0:false,
		save_as:'sw_detiene'
	};
	
	Atributos[12]= {
		validacion:{
			name:'fecha_del',
			fieldLabel:'Suspende DEL',
			allowBlank:false,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:true,
			grid_editable:true,
			renderer: formatDate,
			width_grid:100,
			disabled:false	
		},
		form:false,
		tipo:'DateField',
		filtro_0:false,
		dateFormat:'m-d-Y'		
	};
	
	Atributos[13]= {
		validacion:{
			name:'fecha_al',
			fieldLabel:'Suspende AL',
			allowBlank:false,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:true,
			grid_editable:true,
			renderer: formatDate,
			width_grid:100,
			disabled:false		
		},
		form:false,
		tipo:'DateField',
		filtro_0:false,
		dateFormat:'m-d-Y',
		id_grupo:0		
	};
	Atributos[12]= {
			validacion:{
				name:'fecha_del',
				fieldLabel:'Suspende DEL',
				allowBlank:false,
				format: 'd/m/Y', //formato para validacion
				minValue: '01/01/1900',
				disabledDaysText: 'D�a no v�lido',
				grid_visible:true,
				grid_editable:true,
				renderer: formatDate,
				width_grid:100,
				disabled:false	
			},
			form:false,
			tipo:'DateField',
			filtro_0:false,
			dateFormat:'m-d-Y'		
		};
		
		Atributos[13]= {
			validacion:{
				name:'fecha_al',
				fieldLabel:'Suspende AL',
				allowBlank:false,
				format: 'd/m/Y', //formato para validacion
				minValue: '01/01/1900',
				disabledDaysText: 'D�a no v�lido',
				grid_visible:true,
				grid_editable:true,
				renderer: formatDate,
				width_grid:100,
				disabled:false		
			},
			form:false,
			tipo:'DateField',
			filtro_0:false,
			dateFormat:'m-d-Y',
			id_grupo:0		
		};
		Atributos[14]= {
				validacion:{
					name:'fecha_fin_viaje',
					fieldLabel:'Fecha Fin de Viaje Del',
					allowBlank:false,
					format: 'd/m/Y', //formato para validacion
					minValue: '01/01/1900',
					disabledDaysText: 'D�a no v�lido',
					grid_visible:true,
					grid_editable:true,
					renderer: formatDate,
					width_grid:100,
					disabled:false	
				},
				form:false,
				tipo:'DateField',
				filtro_0:false,
				dateFormat:'m-d-Y'		
			};
			
			Atributos[15]= {
				validacion:{
					name:'fecha_fin_viaje_al',
					fieldLabel:'Fecha Fin de Viaje Al',
					allowBlank:false,
					format: 'd/m/Y', //formato para validacion
					minValue: '01/01/1900',
					disabledDaysText: 'D�a no v�lido',
					grid_visible:true,
					grid_editable:true,
					renderer: formatDate,
					width_grid:100,
					disabled:false		
				},
				form:false,
				tipo:'DateField',
				filtro_0:false,
				dateFormat:'m-d-Y',
				id_grupo:0		
			};
			
	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	function formatDate(value){return value?value.dateFormat('d/m/Y'):''};
	//---------- INICIAMOS LAYOUT DETALLE
	var config={titulo_maestro:'Par�metro de Tesorer�a',grid_maestro:'grid-'+idContenedor};
	var layout_parametro_tesoro=new DocsLayoutMaestro(idContenedor);
	layout_parametro_tesoro.init(config);
	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////
	this.pagina=Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,Atributos,ds,layout_parametro_tesoro,idContenedor);
	var getComponente=this.getComponente;
	var getSelectionModel=this.getSelectionModel;
	var ClaseMadre_btnNew=this.btnNew;
	var ClaseMadre_btnEdit=this.btnEdit;
	var ClaseMadre_btnEliminar=this.btnEliminar;
	var CM_getComponente=this.getComponente;
	var CM_ocultarComponente=this.ocultarComponente;
	var CM_ocultarGrupo=this.ocultarGrupo;
	var CM_mostrarGrupo=this.mostrarGrupo;
	///////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	///////////////////////////////////
	var paramMenu={
		guardar:{crear:true,separador:false},
		nuevo:{crear:true,separador:true},		
		eliminar:{crear:true,separador:false},
		actualizar:{crear:true,separador:false}
	};
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//datos necesarios para el filtro
	var paramFunciones={
		btnEliminar:{url:direccion+'../../../control/parametro/ActionEliminarParametro.php'},
		Save:{url:direccion+'../../../control/parametro/ActionGuardarParametro.php'},
		ConfirmSave:{url:direccion+'../../../control/parametro/ActionGuardarParametro.php'},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,
		height:400,width:480,minWidth:150,minHeight:200,
		closable:true,titulo:'Par�metro de Tesorer�a',
		grupos:[
			{
				tituloGrupo:'Datos Generales',
				columna:0,
				id_grupo:0
			},
			{
				tituloGrupo:'Datos Descuento',
				columna:0,
				id_grupo:1
			}
		]}};
	
	this.btnNew=function()
	{
		CM_ocultarComponente(cmpGestionTesoro);
		CM_ocultarGrupo('Datos Descuento');
		SiBlancosGrupo(1);						
		ClaseMadre_btnNew();		
	};
	this.btnEdit=function()
	{
		if(componentes[8]=='si'){
			CM_mostrarGrupo('Datos Descuento');
			NoBlancosGrupo(1);
		}
		else{
			CM_ocultarGrupo('Datos Descuento');
			SiBlancosGrupo(1);
		}
		
		ClaseMadre_btnEdit();		
	};
		
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	function btn_digitos_nivel_recursos(){
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			var data='m_id_parametro='+SelectionsRecord.data.id_parametro;
			data=data+'&m_gestion_tesoro='+SelectionsRecord.data.gestion_tesoro;
			data=data+'&m_estado_gestion='+SelectionsRecord.data.estado_gestion;			
			var ParamVentana={Ventana:{width:'50%',height:'60%'}}			
			layout_parametro_tesoro.loadWindows(direccion+'../../../../sis_tesoreria/vista/nivel_oec/nivel_oec.php?'+data,'Niveles',ParamVentana);
		}
		else
		{
			Ext.MessageBox.alert('ESTADO', 'Antes debe seleccionar una Gesti�n.');
		}
	}	

	//Para manejo de eventos
	function iniciarEventosFormularios(){
		//para iniciar eventos en el formulario
		cmpIdParametro=getComponente('id_parametro');		
		cmpIdGestion=getComponente('id_gestion');		
		cmpCantidadNivel=getComponente('cantidad_nivel');		
		cmpEstadoGestion=getComponente('estado_gestion');
		cmpGestionTesoro=getComponente('gestion_tesoro');
		for (var i=0;i<Atributos.length;i++){
			componentes[i]=CM_getComponente(Atributos[i].validacion.name);
		}
		componentes[8].on('select',evento_sw_viatico);
	}
	function evento_sw_viatico(combo, record, index){
		if(record.data.ID=='si'){
			CM_mostrarGrupo('Datos Descuento');
			NoBlancosGrupo(1);
		}
		else{
			CM_ocultarGrupo('Datos Descuento');
			SiBlancosGrupo(1);
		}
	}
	
	function SiBlancosGrupo(grupo){
		for (var i=0;i<componentes.length;i++){
			
			if(Atributos[i].id_grupo==grupo)
			componentes[i].allowBlank=true;
		}
	}
	function NoBlancosGrupo(grupo){
		for (var i=0;i<componentes.length;i++){
			if(Atributos[i].id_grupo==grupo)
				componentes[i].allowBlank=Atributos[i].validacion.allowBlank;
		}
	}

	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_parametro_tesoro.getLayout()};
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	this.InitFunciones(paramFunciones);
	//para agregar botones	
	this.AdicionarBoton('../../../lib/imagenes/list-items.gif','Niveles de Tesorer�a',btn_digitos_nivel_recursos,true,'cantidad_nivel','Niveles Tesorer�a');		
	this.iniciaFormulario(); 
	iniciarEventosFormularios();
	layout_parametro_tesoro.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}
