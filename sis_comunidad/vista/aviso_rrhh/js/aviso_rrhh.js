/**
 * Nombre:		  	    avisoRRHH.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Morgan Huascar Checa Lopez
 * Fecha creaci�n:		14/05/2013
 */
function pagina_aviso_rrhh(idContenedor,direccion,paramConfig){
	var Atributos=new Array,sw=0;
	
	//---DATA STORE
	var ds = new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/aviso_rrhh/ActionListarAvisoRRHH.php'}),
		reader: new Ext.data.XmlReader({
		record: 'ROWS',id:'id_paviso_rrhh',totalRecords:'TotalCount'
		},[		
		'id_aviso_rrhh',
		'nombre_aviso_rrhh',
		'descripcion_aviso_rrhh',
		'rrhh_ruta_archivo',
		{name: 'rrhh_fecha_registro',
		 type:'date',dateFormat:'Y-m-d'}
		
		]),remoteSort:true});

	//FUNCIONES RENDER
	function rutaEnlace(val) { if(val!="")

	{return '<a href="'+ direccion+"../../../../../comunidadEnde/vista/archivos/avisoRecursosHumanos/"+val+'" target = "_blank">'+val+'</a>';}}
	
	/////////////////////////
	// Definici�n de datos //
	/////////////////////////
	
	// hidden id_columna_tipo
	//en la posici�n 0 siempre esta la llave primaria

	Atributos[0]={
		validacion:{
			labelSeparator:'',
			name: 'id_aviso_rrhh',
			inputType:'hidden',
			//fieldLabel:'ID',
			grid_visible:true, 
			grid_editable:false
	},
	tipo: 'Field',
	filtro_0:false
		
	};
	
	// txt nombre
	Atributos[1]={
		validacion:{
			name:'nombre_aviso_rrhh',
			fieldLabel:'NOMBRE AVISO',
			allowBlank:false,
			maxLength:400,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:400,
			width:'100%',
			disabled:false		
		},
		tipo: 'TextField',
		form: true,
		filtro_0:true,
		filterColValue:'RRHH.nombre_aviso_rrhh'
		
	};
	
	Atributos[2]={
			validacion:{
				name:'descripcion_aviso_rrhh',
				fieldLabel:'DESCRIPCION AVISO',
				allowBlank:false,
				maxLength:400,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:400,
				width:'100%',
				disabled:false		
			},
			tipo: 'TextField',
			form: true,
			filtro_0:true,
			filterColValue:'RRHH.descripcion_aviso_rrhh'
			
		};
	
	Atributos[3]={
			validacion:{
			name:'rrhh_ruta_archivo',			
			fieldLabel:'ARCHIVO',
			allowBlank:false,
			//lazyRender:true,
			inputType:'file',
			maxLength:200,
			renderer:rutaEnlace,
			//forceSelection:true,
			grid_visible:true,
			grid_editable:false,
			width_grid:100
		
		},
		tipo:'Field',
		form: true,
		save_as:'txt_archivo'
			
	};

	Atributos[4]= {
		validacion:{
			name:'rrhh_fecha_registro',
			fieldLabel:'FECHA REGISTRO',
			allowBlank:true,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:true,
			grid_editable:false,
			renderer: formatDate,
			width_grid:120,
			disabled:false		
		},
		form:false,
		tipo:'DateField',
		filtro_0:true,
		filterColValue:'RRHH.rrhh_fecha_registro',
		dateFormat:'d/m/Y',
		defecto:''
		
	};
	

	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	function formatDate(value){return value?value.dateFormat('d/m/Y'):''};

	//---------- INICIAMOS LAYOUT DETALLE
	var config={titulo_maestro:'columna_tipo',grid_maestro:'grid-'+idContenedor};
	var layout_tipo_obligacion=new DocsLayoutMaestro(idContenedor);
	layout_tipo_obligacion.init(config);

	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////

	
	this.pagina=Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,Atributos,ds,layout_tipo_obligacion,idContenedor);
	var getComponente=this.getComponente;
	var getSelectionModel=this.getSelectionModel;

	///////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	///////////////////////////////////

	var paramMenu={
		guardar:{crear:true,separador:false},
		nuevo:{crear:true,separador:true},
		editar:{crear:true,separador:false},
		eliminar:{crear:true,separador:false},
		actualizar:{crear:true,separador:false}
	};


	//////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////
	
	//datos necesarios para el filtro
	var paramFunciones={
		btnEliminar:{url:direccion+'../../../control/aviso_rrhh/ActionEliminarAvisoRRHH.php'},
		Save:{url:direccion+'../../../control/aviso_rrhh/ActionGuardarAvisoRRHH.php'},
		ConfirmSave:{url:direccion+'../../../control/aviso_rrhh/ActionGuardarAvisoRRHH.php'},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,height:300,width:480,minWidth:150,minHeight:200,fileUpload:true, upload:true,	closable:true,titulo:'AVISO RECURSOS HUMANOS'}};
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//

	//Para manejo de eventos
	function iniciarEventosFormularios(){
	//para iniciar eventos en el formulario
	}

	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_tipo_obligacion.getLayout()};
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	this.InitFunciones(paramFunciones);
	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros
		}
	});
	
	//para agregar botones
	
	this.iniciaFormulario();
	iniciarEventosFormularios();
	layout_tipo_obligacion.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}