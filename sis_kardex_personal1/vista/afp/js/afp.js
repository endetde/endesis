/**
 * Nombre:		  	    pagina_afp.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Mercedes Zambrana Meneses
 * Fecha creaci�n:		11-08-2010
 */
function pagina_afp(idContenedor,direccion,paramConfig){
	var Atributos=new Array,sw=0;
	
	//---DATA STORE
	var ds = new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/afp/ActionListarAfp.php'}),
		reader: new Ext.data.XmlReader({
		record: 'ROWS',id:'id_afp',totalRecords:'TotalCount'
		},[		
				'id_afp',
		'nombre',
		'estado_reg',
		{name: 'fecha_reg',type:'date',dateFormat:'Y-m-d'},'codigo'
		
		]),remoteSort:true});

	

	//FUNCIONES RENDER
	function render_estado_reg(value)
	{
		if(value=='activo'){value='Activo'	}
		else if(value=='inactivo'){value='Inactivo'	}
		return value
	}
	
	/////////////////////////
	// Definici�n de datos //
	/////////////////////////
	
	// hidden id_columna_tipo
	//en la posici�n 0 siempre esta la llave primaria

	Atributos[0]={
		validacion:{
			labelSeparator:'',
			name: 'id_afp',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false
		
	};

	Atributos[1]={
		validacion:{
			name:'codigo',
			fieldLabel:'Codigo',
			allowBlank:true,
			maxLength:250,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:150,
			width:'100%',
			disabled:false		
		},
		tipo: 'TextField',
		form: true,
		filtro_0:true,
		filterColValue:'afp.codigo'
		
	};
	
// txt nombre
	Atributos[2]={
		validacion:{
			name:'nombre',
			fieldLabel:'Nombre',
			allowBlank:true,
			maxLength:250,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:150,
			width:'100%',
			disabled:false		
		},
		tipo: 'TextField',
		form: true,
		filtro_0:true,
		filterColValue:'afp.nombre'
		
	};

	Atributos[3]= {
		validacion: {
			name:'estado_reg',			
			fieldLabel:'Estado',
			allowBlank:false,
			typeAhead: true,
			loadMask: true,
			triggerAction: 'all',			
			store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[['activo','Activo'],['inactivo','Inactivo']]}),
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			renderer:render_estado_reg,
			forceSelection:true,
			grid_visible:true,
			grid_editable:false,
			width_grid:90
			
		},
		tipo:'ComboBox',
		filtro_0:true,		
		filterColValue:'afp.estado_reg'		
	};
	
// txt fecha_reg
	Atributos[4]= {
		validacion:{
			name:'fecha_reg',
			fieldLabel:'Fecha Registro',
			allowBlank:true,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:true,
			grid_editable:false,
			renderer: formatDate,
			width_grid:100,
			disabled:true		
		},
		form:false,
		tipo:'DateField',
		filtro_0:true,
		filterColValue:'afp.fecha_reg',
		dateFormat:'m-d-Y',
		defecto:''
		
	};

	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	function formatDate(value){return value?value.dateFormat('d/m/Y'):''};

	//---------- INICIAMOS LAYOUT DETALLE
	var config={titulo_maestro:'columna_tipo',grid_maestro:'grid-'+idContenedor};
	var layout_afp=new DocsLayoutMaestro(idContenedor);
	layout_afp.init(config);

	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////

	
	this.pagina=Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,Atributos,ds,layout_afp,idContenedor);
	var getComponente=this.getComponente;
	var getSelectionModel=this.getSelectionModel;

	///////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	///////////////////////////////////

	var paramMenu={
		guardar:{crear:true,separador:false},
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
	var paramFunciones={
		btnEliminar:{url:direccion+'../../../control/afp/ActionEliminarAfp.php'},
		Save:{url:direccion+'../../../control/afp/ActionGuardarAfp.php'},
		ConfirmSave:{url:direccion+'../../../control/afp/ActionGuardarAfp.php'},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,height:300,width:480,minWidth:150,minHeight:200,	closable:true,titulo:'AFP'}};
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//

	//Para manejo de eventos
	function iniciarEventosFormularios(){
	//para iniciar eventos en el formulario
	}

	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_afp.getLayout()};
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
	layout_afp.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}