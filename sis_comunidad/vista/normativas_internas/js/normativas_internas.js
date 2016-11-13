/**
 * Nombre:		  	    pagina_tipo_adq.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Morgan Huascar Checa Lopez
 * Fecha creaci�n:		2013-05-16 11:47:21
 */
function pagina_normativa_interna(idContenedor,direccion,paramConfig){
	var Atributos=new Array,sw=0;
	
	//---DATA STORE
	var ds = new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/normativas_internas/ActionListarNormativaInterna.php'}),
		reader: new Ext.data.XmlReader({
		record: 'ROWS',id:'id_normativa_interna',totalRecords:'TotalCount'
		},[		
		'id_normativa_interna',
		'nombre_categoria_normativa',
		'descripcion_categoria',
		{name: 'fecha_registro',type:'date',dateFormat:'Y-m-d'}

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

	//FUNCIONES RENDER
	
	
	/////////////////////////
	// Definici�n de datos //
	/////////////////////////
	
	// hidden id_tipo_adq
	//en la posici�n 0 siempre esta la llave primaria

	Atributos[0]={
			validacion:{
		labelSeparator:'',
		fieldLabel:'CODIGO',
		name: 'id_normativa_interna',
		inputType:'hidden',
		//fieldLabel:'ID NORMATIVA',
		grid_visible:true, 
		width_grid:100,
		grid_editable:false
	},
	tipo: 'Field',
	//form:false,
	filtro_0:false,
	save_as:'id_normativa_interna'
	};
	
	
// txt nombre
	Atributos[1]={
		validacion:{
			name:'nombre_categoria_normativa',
			fieldLabel:'NOMBRE CATEGORIA',
			allowBlank:false,
			maxLength:30,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:true,
			width_grid:200,
			width:'85%',
			disable:false,
			grid_indice:1		
		},
		tipo: 'TextField',
		form: true,
		filtro_0:true,
		filterColValue:'NI.nombre_categoria_normativa'
	};
	
	// txt codigo
	Atributos[2]={
		validacion:{
			name:'descripcion_categoria',
			fieldLabel:'DESCRIPCION',
			allowBlank:false,
			maxLength:700,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:300,
			width:300,
			disabled:false,
			grid_indice:2		
		},
		tipo: 'TextArea',
		form: true,
		filtro_0:true,
		filterColValue:'NI.descripcion_categoria'
	};

// txt fecha_reg
	Atributos[3]= {
		validacion:{
			name:'fecha_registro',
			fieldLabel:'FECHA DE REGISTRO',
			allowBlank:true,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:true,
			renderer: formatDate,
			width_grid:150,
			disabled:true,
			grid_indice:3		
		},
		form:false,
		tipo:'DateField',
		filtro_0:true,
		filterColValue:'NI.fecha_registro',
		dateFormat:'m-d-Y'
	};

	
	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	function formatDate(value){return value?value.dateFormat('d/m/Y'):''};

	//---------- INICIAMOS LAYOUT DETALLE
	//var config={titulo_maestro:'tipo_adq',grid_maestro:'grid-'+idContenedor};
	var config={titulo_maestro:'tipo_adq',grid_maestro:'grid-'+idContenedor,urlHijo:'../../../sis_comunidad/vista/sub_categoria_normativa/sub_categoria_normativa_det.php'};
	//var layout_tipo_adq=new DocsLayoutMaestro(idContenedor);
	var layout_tipo_adq=new DocsLayoutMaestroDeatalle(idContenedor);
	layout_tipo_adq.init(config);

	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////

	
	this.pagina=Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,Atributos,ds,layout_tipo_adq,idContenedor);
	var getComponente=this.getComponente;
	var getSelectionModel=this.getSelectionModel;
	var CM_conexionFailure=this.conexionFailure;
	var CM_btnNew=this.btnNew;
	var CM_btnEdit=this.btnEdit;
	var Cm_getDialog=this.getDialog;

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
		btnEliminar:{url:direccion+'../../../control/normativas_internas/ActionEliminarNormativaInterna.php'},
		Save:{url:direccion+'../../../control/normativas_internas/ActionGuardarNormativaInterna.php'},
		ConfirmSave:{url:direccion+'../../../control/normativas_internas/ActionGuardarNormativaInterna.php'},
		Formulario:{html_apply:'dlgInfo-'+idContenedor, height:300, width:480,minWidth:150,minHeight:200, 	closable:true,titulo:'Normativas Internas'}};
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
function btn_tipo_servicio(){
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			var data='m_id_normativa_interna='+SelectionsRecord.data.id_normativa_interna;
			data=data+'&m_nombre_categoria_normativa='+SelectionsRecord.data.nombre_categoria_normativa;
			data=data+'&m_descripcion_categoria_normativa='+SelectionsRecord.data.descripcion_categoria;
           // data=data+'&m_codigo='+SelectionsRecord.data.codigo;
			var ParamVentana={Ventana:{width:'85%',height:'70%'}}
			layout_tipo_adq.loadWindows(direccion+'../../../../sis_comunidad/vista/sub_categoria_normativa/sub_categoria_normativa_det.php?'+data,'Tipos de Normativas',ParamVentana);
			layout_tipo_adq.getVentana().on('resize',function(){
			layout_tipo_adq.getLayout().layout();
			})
		}
	else
	{
		Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
	}
	}
	
	//Para manejo de eventos
	function iniciarEventosFormularios(){
	//para iniciar eventos en el formulario
				dialog=Cm_getDialog();
				getSelectionModel().on('rowdeselect',function(){
				
					if(_CP.getPagina(layout_tipo_adq.getIdContentHijo()).pagina.limpiarStore()){
						_CP.getPagina(layout_tipo_adq.getIdContentHijo()).pagina.bloquearMenu()
					}
				})
	}
	this.EnableSelect=function(x,z,y){
			 enable(x,z,y);
			 _CP.getPagina(layout_tipo_adq.getIdContentHijo()).pagina.reload(y.data);
				_CP.getPagina(layout_tipo_adq.getIdContentHijo()).pagina.desbloquearMenu();
		    }
	//para llamar al boton New
/*this.btnEdit=function(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			var data=SelectionsRecord.data.id_normativa_interna;
        		
			verificar_NumTipServicios();
			verificar_NumTipSolicitudes();
			
			CM_btnEdit();
			}
				else{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
				}
		}
		
	//para verificar
function verificar_NumTipServicios()
		{
	   		var sm=getSelectionModel();
	   		var filas=ds.getModifiedRecords();
	   		var cont=filas.length;
	   		var NumSelect=sm.getCount();
	   		var SelectionsRecord=sm.getSelected();
	   		var data='m_id_normativa_interna='+SelectionsRecord.data.id_normativa_interna;
	
		Ext.Ajax.request({
			url:direccion+"../../../control/sub_categoria_normativa/ActionListarSubCategoriaNormativa_det.php?"+data,
			method:'GET',
			success:verificar,
			failure:CM_conexionFailure,
			timeout:100000//TIEMPO DE ESPERA PARA DAR FALLO
			});
		}

	function verificar(resp){
		//	Ext.MessageBox.hide();
			if(resp.responseXML!=undefined && resp.responseXML!=null&& resp.responseXML.documentElement!=null &&resp.responseXML.documentElement!=undefined){
				var root=resp.responseXML.documentElement;
				num_tipo_servicios=root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue;
				
				//if(on==0){
					
				  if((root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue)>0){
				  	
				  	 
				  	// getComponente('codigo').setValue(root.getElementsByTagName('codigo')[0].firstChild.nodeValue);
				  	 getComponente('codigo').disable();
				    //CM_ocultarComponente(getComponente('fecha_venc'));	
				  	
				  }else{
				 	 getComponente('codigo').enable();
				 	 
				}
				
			}
		}		
/* para verificar si el tipo de adquisici�n se encuentra en  en solicitudes */ 
/* function verificar_NumTipSolicitudes()
		{
	   		var sm=getSelectionModel();
	   		var filas=ds.getModifiedRecords();
	   		var cont=filas.length;
	   		var NumSelect=sm.getCount();
	   		var SelectionsRecord=sm.getSelected();
	   		var data='m_id_tipo_adq='+SelectionsRecord.data.id_tipo_adq+'&tipo=tipo_adq';
	
		Ext.Ajax.request({
			url:direccion+"../../../control/solicitud_compra/ActionListarSolicitudCompra.php?"+data,
			method:'GET',
			success:verificarSol,
			failure:CM_conexionFailure,
			timeout:100000//TIEMPO DE ESPERA PARA DAR FALLO
			});
		}

	function verificarSol(resp){
		//	Ext.MessageBox.hide();
			if(resp.responseXML!=undefined && resp.responseXML!=null&& resp.responseXML.documentElement!=null &&resp.responseXML.documentElement!=undefined){
				var root=resp.responseXML.documentElement;
				num_tipo_servicios=root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue;
				
				//if(on==0){
					
				  if((root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue)>0){
				  	
				  	 
				  	// getComponente('codigo').setValue(root.getElementsByTagName('codigo')[0].firstChild.nodeValue);
				  	 getComponente('tipo_adq').disable();
				    //CM_ocultarComponente(getComponente('fecha_venc'));	
				  	
				  }else{
				 	 getComponente('tipo_adq').enable();
				 	 
				}
				
			}
		}*/				
//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_tipo_adq.getLayout()};
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	this.InitFunciones(paramFunciones);
	//para agregar botones
	
	//	this.AdicionarBoton('../../../lib/imagenes/menu-show.gif','Tipos de Servicio',btn_tipo_servicio,true,'tipo_servicio','');

	function  enable(sel,row,selected){
				var record=selected.data; 
			}	
	this.iniciaFormulario();
	iniciarEventosFormularios();
	layout_tipo_adq.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}