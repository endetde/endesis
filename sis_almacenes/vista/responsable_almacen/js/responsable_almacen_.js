	+/**
 * Nombre:		  	    pagina_responsable_almacen_main.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2007-10-12 15:53:20
 */
function pagina_responsable_almacen(idContenedor,direccion,paramConfig){
	var vectorAtributos=new Array;
	var ds,layout_responsable_almacen,txt_fecha_reg;
	var elementos=new Array();
	var componentes=new Array();
	var sw=0;
	//  DATA STORE //
	ds=new Ext.data.Store({
		proxy:new Ext.data.HttpProxy({url:direccion+'../../../control/responsable_almacen/ActionListarResponsableAlmacen.php'}),
		reader:new Ext.data.XmlReader({
			record:'ROWS',
			id:'id_responsable_almacen',
			totalRecords:'TotalCount'
		},[
		'id_responsable_almacen',
		'estado',
		'cargo',
		{name:'fecha_asignacion',type:'date',dateFormat:'Y-m-d'},
		{name:'fecha_reg',type:'date',dateFormat:'Y-m-d'},
		'observaciones',
		'id_almacen',
		'desc_almacen',
		'desc_empleado',
		'id_empleado',
		'nombre_completo',
		]),remoteSort:true});
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros
		}
	});
	//DATA STORE COMBOS
    ds_almacen=new Ext.data.Store({proxy:new Ext.data.HttpProxy({url:direccion+'../../../control/almacen/ActionListarAlmacen.php'}),
			reader:new Ext.data.XmlReader({record:'ROWS',id:'id_almacen',totalRecords:'TotalCount'},['id_almacen','codigo','nombre','descripcion','direccion','via_fil_max','via_col_max','bloqueado','bloquear','cerrado','nro_prest_pendientes','nro_ing_no_finalizados','nro_sal_no_finalizadas','observaciones','fecha_ultimo_inventario','fecha_reg','id_regional','desc_regional'])
	});
    ds_empleado=new Ext.data.Store({proxy:new Ext.data.HttpProxy({url:direccion+'../../../../sis_kardex_personal/control/empleado/ActionListarEmpleado.php'}),
			reader:new Ext.data.XmlReader({record:'ROWS',id:'id_empleado',totalRecords:'TotalCount'},['id_empleado','id_persona','desc_persona','codigo_empleado','nombre_tipo_documento','doc_id','email1'])
	});
	//FUNCIONES RENDER
			function render_id_almacen(value,p,record){return String.format('{0}',record.data['desc_almacen'])}
			function render_id_empleado(value,p,record){return String.format('{0}',record.data['nombre_completo'])}
	var resultTplAlmacen=new Ext.Template('<div class="search-item">','<b>{nombre}</b>','<br><FONT COLOR="#B5A642"><b>C�digo: </b>{codigo}</FONT>','<br><FONT COLOR="#B5A642"><b>Descripci�n: </b>{descripcion}</FONT>','<br><FONT COLOR="#B5A642"><b>Regional: </b>{desc_regional}</FONT>','</div>');
	var resultTplEmpleado=new Ext.Template('<div class="search-item">','<b>{desc_persona}</b>','<br><FONT COLOR="#B5A642"><b>C�digo: </b>{codigo_empleado}</FONT>','<br><FONT COLOR="#B5A642"><b>{nombre_tipo_documento}: </b>{doc_id}</FONT>','<br><FONT COLOR="#B5A642"><b>Email: </b>{email1}</FONT>','</div>');
	// Definici�n de datos //
    // hidden id_responsable_almacen
	vectorAtributos[0]={
		validacion:{
			labelSeparator:'',
			name:'id_responsable_almacen',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo:'Field',
		filtro_0:false,
		save_as:'hidden_id_responsable_almacen'
	};
	// txt id_almacen
	vectorAtributos[1]={
			validacion:{
			name:'id_almacen',
			fieldLabel:'Almac�n',
			allowBlank:false,			
			emptyText:'Almacen...',
			name:'id_almacen',
			desc:'desc_almacen',
			store:ds_almacen,
			valueField:'id_almacen',
			displayField:'nombre',
			queryParam:'filterValue_0',
			filterCol:'ALMACE.nombre#ALMACE.descripcion#ALMACE.codigo#REGION.nombre_regional',
			typeAhead:true,
			forceSelection:true,
			tpl:resultTplAlmacen,
			mode:'remote',
			queryDelay:250,
			pageSize:10,
			minListWidth:250,
			grow:true,
			width:'60%',
			resizable:true,
			minChars:1,
			triggerAction:'all',
			editable:true,
			renderer:render_id_almacen,
			grid_visible:true,
			grid_editable:true,
			width_grid:100
			},
		tipo:'ComboBox',
		filtro_0:true,
		filterColValue:'ALMACE.nombre',
		defecto:'',
		save_as:'txt_id_almacen'
	};
	// txt id_empleado
	vectorAtributos[2]={
			validacion:{
			name:'id_empleado',
			fieldLabel:'Funcionario',
			allowBlank:false,			
			emptyText:'Empleado...',
			name:'id_empleado',
			desc:'nombre_completo',
			store:ds_empleado,
			valueField:'id_empleado',
			displayField:'desc_persona',
			queryParam:'filterValue_0',
			filterCol:'PERSON.nombre#PERSON.apellido_paterno#PERSON.apellido_materno#PERSON.doc_id#PERSON.email1#EMPLEA.codigo_empleado',
			typeAhead:true,
			forceSelection:true,
			tpl:resultTplEmpleado,
			mode:'remote',
			queryDelay:250,
			pageSize:10,
			minListWidth:250,
			grow:true,
			width:'60%',
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1,
			triggerAction:'all',
			editable:true,
			renderer:render_id_empleado,
			grid_visible:true,
			grid_editable:true,
			width_grid:215
			},
		tipo:'ComboBox',
		filtro_0:true,
		filterColValue:'PER.nombre#PER.apellido_paterno#PER.apellido_materno#PER.doc_id#PER.email1',
		defecto: '',
		save_as:'txt_id_empleado'
	};
// txt cargo
	vectorAtributos[3]={
			validacion: {
			name:'cargo',
			fieldLabel:'Cargo',
			allowBlank:false,
			typeAhead: true,
			loadMask: true,
			triggerAction: 'all',
			store: new Ext.data.SimpleStore({fields:['ID','valor'],data:Ext.responsable_almacen_combo.cargo}),
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			forceSelection:true,
			grid_visible:true,
			grid_editable:true,
			width_grid:100,
			width:300
		},
		tipo:'ComboBox',
		filtro_0:true,
		filterColValue:'RESALM.cargo',
		defecto:'Jefe de Almacen',
		save_as:'txt_cargo'
	};
	// txt estado
	vectorAtributos[4]={
			validacion:{
			name:'estado',
			fieldLabel:'Estado',
			allowBlank:false,
			typeAhead:true,
			loadMask:true,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({fields:['ID','valor'],data:Ext.responsable_almacen_combo.estado}),
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			forceSelection:true,
			grid_visible:true,
			grid_editable:true,
			width_grid:60
		},
		tipo:'ComboBox',
		filtro_0:false,
		filterColValue:'RESALM.estado',
		defecto:'activo',
		save_as:'txt_estado'
	};
// txt fecha_asignacion
	vectorAtributos[5]={
		validacion:{
			name:'fecha_asignacion',
			fieldLabel:'Fecha de Asignaci�n',
			allowBlank:false,
			format:'d/m/Y',
			minValue:'01/01/1900',
			grid_visible:true,
			grid_editable:true,
			renderer:formatDate,
			width_grid:125,
			disabled:false
		},
		tipo:'DateField',
		filtro_0:true,
		filterColValue:'RESALM.fecha_asignacion',
		dateFormat:'m-d-Y',
		defecto:'',
		save_as:'txt_fecha_asignacion'
	};
	// txt fecha_reg
	vectorAtributos[6]={
		validacion:{
			name:'fecha_reg',
			fieldLabel:'Fecha de Registro',
			allowBlank:true,
			format:'d/m/Y',
			minValue:'01/01/1900',
			grid_visible:true,
			grid_editable:true,
			renderer:formatDate,
			width_grid:110,
			disabled:true
		},
		tipo:'DateField',
		filtro_0:true,
		filterColValue:'RESALM.fecha_reg',
		dateFormat:'m-d-Y',
		defecto:'',
		save_as:'txt_fecha_reg'
	};
	// ----------            FUNCIONES RENDER    ---------------//
	function formatDate(value){return value ? value.dateFormat('d/m/Y'):''}
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
	var config={titulo_maestro:'Responsable del Almacen',grid_maestro:'grid-'+idContenedor};
	layout_responsable_almacen=new DocsLayoutMaestro(idContenedor);
	layout_responsable_almacen.init(config);
	// INICIAMOS HERENCIA //
	this.pagina = Pagina;
	this.pagina(paramConfig,vectorAtributos,ds,layout_responsable_almacen,idContenedor);
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
	var getSelectionModel=this.getSelectionModel;
	var ClaseMadre_getComponente=this.getComponente;
	var ClaseMadre_getDialog=this.getDialog;
	var ClaseMadre_save=this.Save;
	var ClaseMadre_getGrid=this.getGrid;
	var ClaseMadre_getFormulario=this.getFormulario;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_btnNew=this.btnNew;
	var ClaseMadre_onResize=this.onResize;
	var ClaseMadre_SaveAndOther=this.SaveAndOther;
	var CM_mostrarComponente=this.mostrarComponente;
	var CM_ocultarComponente=this.ocultarComponente;
	var ClaseMadre_btnEdit=this.btnEdit;
	var ClaseMadre_btnEliminar = this.btnEliminar;
	var ClaseMadre_btnActualizar = this.btnActualizar;
	// DEFINICI�N DE LA BARRA DE MEN�//
	var paramMenu={guardar:{crear:true,separador:false},nuevo:{crear:true,separador:true},editar:{crear:true,separador:false},eliminar:{crear:true,separador:false},actualizar:{crear:true,separador:false}};
    //----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	var paramFunciones={
		btnEliminar:{url:direccion+'../../../control/responsable_almacen/ActionEliminarResponsableAlmacen.php'},
		Save:{url:direccion+'../../../control/responsable_almacen/ActionGuardarResponsableAlmacen.php'},
		ConfirmSave:{url:direccion+'../../../control/responsable_almacen/ActionGuardarResponsableAlmacen.php'},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,width:480,height:340,minWidth:150,minHeight:200,closable:true,titulo: 'Responsable Almacen'}
	};
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	function iniciarEventosFormularios(){
		txt_fecha_reg=ClaseMadre_getComponente('fecha_reg')
	}
	this.getLayout=function(){
		return layout_responsable_almacen.getLayout();
	};
   this.btnNew=function(){
  	CM_ocultarComponente(txt_fecha_reg);
	ClaseMadre_btnNew()
	};	
	 this.btnEdit=function(){
	 	CM_ocultarComponente(txt_fecha_reg);
		ClaseMadre_btnEdit()
	};	
	this.getPagina=function(idContenedorHijo){
		var tam_elementos=elementos.length;
		for(var i=0;i<tam_elementos;i++){
			if(elementos[i].idContenedor==idContenedorHijo){
				return elementos[i]
			}
		}
	};
	this.getElementos=function(){return elementos;};
	this.setPagina=function(elemento){elementos.push(elemento);};
				//-------------- FIN DEFINICI�N DE FUNCIONES PROPIAS --------------//
				this.Init();
				this.InitBarraMenu(paramMenu);
				this.InitFunciones(paramFunciones);
				this.iniciaFormulario();
				iniciarEventosFormularios();
				layout_responsable_almacen.getLayout().addListener('layout',this.onResize);
				ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario)
}