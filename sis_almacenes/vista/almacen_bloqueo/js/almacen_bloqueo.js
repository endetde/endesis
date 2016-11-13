/**
* Nombre:		  	    pagina_almacen_main.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
* Fecha creaci�n:		2007-10-18 21:00:48
*/
function pagina_almacen_bloqueo(idContenedor,direccion,paramConfig)
{var vectorAtributos=new Array;
var ds;
var elementos=new Array();
var componentes=new Array();
var sw=0;
//  DATA STORE //
ds = new Ext.data.Store({
	// asigna url de donde se cargaran los datos
	proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/almacen/ActionListarAlmacenBloqueo.php'}),
	// aqui se define la estructura del XML
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_almacen',
		totalRecords: 'TotalCount'
	}, [
	// define el mapeo de XML a las etiquetas (campos)
	'id_almacen',
	'codigo',
	'nombre',
	'bloqueado',
	'cerrado'
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
	ds_regional = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/regional/ActionListarRegional.php'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_regional',
		totalRecords: 'TotalCount'
	}, ['id_regional','codigo_regional','nombre_regional','descripcion_regional','fecha_registro','hora_registro','fecha_ultima_modificacion','hora_ultima_modificacion'])
	});
	//FUNCIONES RENDER
	function render_id_regional(value, p, record){return String.format('{0}', record.data['desc_regional']);}
	// Template combo
	var resultTplRegional=new Ext.Template(
	'<div class="search-item">',
	'<b><i>{nombre_regional}</i></b>',
	'<br><FONT COLOR="#B5A642">{codigo_regional}</FONT>',
	'</div>'
	);
	// Definici�n de datos //
	// hidden id_almacen
	//en la posici�n 0 siempre esta la llave primaria
	vectorAtributos[0] = {
		validacion:{
			//fieldLabel: 'Id',
			labelSeparator:'',
			name: 'id_almacen',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		save_as:'hidden_id_almacen'
	};
	// txt codigo
	vectorAtributos[1] = {
		validacion:{
			name:'codigo',
			fieldLabel:'C�digo',
			allowBlank:false,
			maxLength:20,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:85
		},
		tipo: 'TextField',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'ALMACE.codigo',
		save_as:'txt_codigo'
	};
	// txt nombre
	vectorAtributos[2] = {
		validacion:{
			name:'nombre',
			fieldLabel:'Nombre',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:true,
			width_grid:105,
			width:'100%'
		},
		tipo: 'TextField',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'ALMACE.nombre',
		save_as:'txt_nombre'
	};
	// txt bloqueado7
	vectorAtributos[3] = {
		validacion: {
			name:'bloqueado',
			fieldLabel:'Bloqueado',
			allowBlank:false,
			typeAhead: true,
			loadMask: true,
			triggerAction: 'all',
			//store: new Ext.data.SimpleStore({fields: ['ID','valor'],data : Ext.almacen_combo.bloqueado}),
			store: new Ext.data.SimpleStore({fields: ['ID','valor'],data : [['si','si'],['no','no']]}),
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			forceSelection:true,
			grid_visible:true,
			grid_editable:true,
			width_grid:80 // ancho de columna en el gris
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:false,
		filterColValue:'ALMACE.bloqueado',
		defecto:'no',
		save_as:'txt_bloqueado'
	};
	// txt cerrado8
	vectorAtributos[4] = {
		validacion: {
			name:'cerrado',
			fieldLabel:'Cerrado',
			allowBlank:false,
			typeAhead: true,
			loadMask: true,
			triggerAction: 'all',
			//store: new Ext.data.SimpleStore({fields: ['ID','valor'],data : Ext.almacen_combo.cerrado}),
			store: new Ext.data.SimpleStore({fields: ['ID','valor'],data : [['No','No'],['Definitivo','Definitivo'],['Periodico','Periodico'],['Gestion','Gestion']]}),
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			forceSelection:true,
			grid_visible:false,
			grid_editable:true,
			width_grid:80 // ancho de columna en el gris
		},
		tipo:'ComboBox',
		filtro_0:false,
		filtro_1:false,
		filterColValue:'ALMACE.cerrado',
		defecto:'No',
		save_as:'txt_cerrado'
	};
	
// ----------            FUNCIONES RENDER    ---------------//
	function formatDate(value){
		return value ? value.dateFormat('d/m/Y') : '';
	};
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
	//Inicia Layout
	var config={
		titulo_maestro:'Almacen',
		grid_maestro:'grid-'+idContenedor
	};
	layout_almacen_bloqueo=new DocsLayoutMaestro(idContenedor);
	layout_almacen_bloqueo.init(config);
	// INICIAMOS HERENCIA //
	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina = Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,ds,layout_almacen_bloqueo,idContenedor);
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
	var CM_ocultarTodosComponente=this.ocultarTodosComponente;
	var CM_mostrarTodosComponente=this.mostrarTodosComponente;
	var ClaseMadre_btnEdit=this.btnEdit;
	var ClaseMadre_btnEliminar = this.btnEliminar;
	var ClaseMadre_btnActualizar = this.btnActualizar;
	// DEFINICI�N DE LA BARRA DE MEN�//
	var paramMenu={
		guardar:{crear:true,separador:false},
		editar:{crear:true,separador:false},
		actualizar:{crear:true,separador:false}
	};
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//datos necesarios para el filtro
	var paramFunciones = {
		btnEliminar:{url:direccion+'../../../control/almacen/ActionEliminarAlmacen.php'},
		Save:{url:direccion+'../../../control/almacen/ActionGuardarAlmacenBloqueo.php'},
		ConfirmSave:{url:direccion+'../../../control/almacen/ActionGuardarAlmacenBloqueo.php'},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,
		height:'45%',
		width:'45%',
		minWidth:150,minHeight:150,	closable:true,titulo:'Almacen'}
	};
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	function iniciarPaginaAlmacenBloqueo(){
		grid=ClaseMadre_getGrid();
		dialog=ClaseMadre_getDialog();
		sm=getSelectionModel();
		formulario=ClaseMadre_getFormulario();
		for(i=0;i<vectorAtributos.length-1;i++){
			componentes[i]=ClaseMadre_getComponente(vectorAtributos[i+1].validacion.name);
		}
	}
	this.btnEdit = function()
	{	ClaseMadre_getComponente(componentes[0].disable());
		ClaseMadre_getComponente(componentes[1].disable());
		CM_ocultarComponente(componentes[3]);
		ClaseMadre_btnEdit();
	}
	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_almacen_bloqueo.getLayout();};
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
	this.iniciaFormulario();
	iniciarPaginaAlmacenBloqueo();
	layout_almacen_bloqueo.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}