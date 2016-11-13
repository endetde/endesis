/**
 * Nombre:		  	    pagina_proveedor_cuenta_detalle.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-12-16 16:05:58
 */
function pagina_proveedor_cuenta_detalle(idContenedor,direccion,paramConfig)
{
	var Atributos=new Array,sw=0;
	var maestro=new Array();
	var componentes=new Array();
	var dialog;
	var form;
	/////////////////
	//  DATA STORE //
	/////////////////
	var ds = new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/proveedor_cuenta_auxiliar/ActionListarProveedorCuentaDetalle.php'}),
		// aqui se define la estructura del XML
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_proveedor_cuenta_auxiliar',
			totalRecords: 'TotalCount'

		}, [
		// define el mapeo de XML a las etiquetas (campos)
		'id_proveedor_cuenta_auxiliar',
		'id_proveedor',
		'desc_proveedor',
		'id_cuenta',
		'desc_cuenta',
		'id_auxiliar',
		'desc_auxiliar',
		'id_gestion',
		'denominacion_empresa',
		'gestion_gestion',
		'desc_gestion',
		{name: 'fecha_reg',type:'date',dateFormat:'Y-m-d'},'tipo',
		'id_cuenta_anticipo',
		'desc_cta_anticipo',
		'id_cuenta_garantia',
		'desc_cta_garantia',
		'id_cuenta_descuento',
		'desc_cta_descuento'
		]),remoteSort:true});

	 
	// DEFINICI�N DATOS DEL MAESTRO	
	
	//DATA STORE COMBOS

    var ds_cuenta = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_contabilidad/control/cuenta/ActionListarCuenta.php'}),
    reader:new Ext.data.XmlReader({record:'ROWS',id:'id_cuenta',totalRecords: 'TotalCount'},
    ['id_cuenta','nro_cuenta','nombre_cuenta','desc_cta2','desc_cuenta','nivel_cuenta','tipo_cuenta',
    'sw_transaccional','id_cuenta_padre','id_parametro','id_moneda','descripcion',
    'sw_oec','sw_aux'
    ]),baseParams:{sw_transaccional:1}});
    
    var ds_cuenta_ant = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_contabilidad/control/cuenta/ActionListarCuenta.php'}),
    reader:new Ext.data.XmlReader({record:'ROWS',id:'id_cuenta',totalRecords: 'TotalCount'},
    ['id_cuenta','nro_cuenta','nombre_cuenta','desc_cta2','desc_cuenta','nivel_cuenta','tipo_cuenta',
    'sw_transaccional','id_cuenta_padre','id_parametro','id_moneda','descripcion',
    'sw_oec','sw_aux'
    ]),baseParams:{sw_transaccional:1}});
    
    var ds_cuenta_gar = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_contabilidad/control/cuenta/ActionListarCuenta.php'}),
    reader:new Ext.data.XmlReader({record:'ROWS',id:'id_cuenta',totalRecords: 'TotalCount'},
    ['id_cuenta','nro_cuenta','nombre_cuenta','desc_cta2','desc_cuenta','nivel_cuenta','tipo_cuenta',
    'sw_transaccional','id_cuenta_padre','id_parametro','id_moneda','descripcion',
    'sw_oec','sw_aux'
    ]),baseParams:{sw_transaccional:1}});
    
    var ds_cuenta_desc = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_contabilidad/control/cuenta/ActionListarCuenta.php'}),
    reader:new Ext.data.XmlReader({record:'ROWS',id:'id_cuenta',totalRecords: 'TotalCount'},
    ['id_cuenta','nro_cuenta','nombre_cuenta','desc_cta2','desc_cuenta','nivel_cuenta','tipo_cuenta',
    'sw_transaccional','id_cuenta_padre','id_parametro','id_moneda','descripcion',
    'sw_oec','sw_aux'
    ]),baseParams:{sw_transaccional:1}});
    

    var ds_auxiliar = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_contabilidad/control/auxiliar/ActionListarAuxiliar.php'}),
			reader:new Ext.data.XmlReader({record:'ROWS',id:'id_auxiliar',totalRecords: 'TotalCount'},['id_auxiliar','codigo_auxiliar','nombre_auxiliar','estado_auxiliar'])
	});

    var ds_gestion = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/gestion/ActionListarGestion.php'}),
			reader:new Ext.data.XmlReader({record:'ROWS',id:'id_gestion',totalRecords: 'TotalCount'},['id_gestion','denominacion','gestion','estado_ges_gral'])
	});

	//FUNCIONES RENDER
	
		
		function render_id_cuenta(value, p, record){return String.format('{0}', record.data['desc_cuenta']);}
		var tpl_id_cuenta=new Ext.Template('<div name={1} class="search-item">','<b><i>{nombre_cuenta}</b></i><br>','<FONT COLOR="#B5A642">{nro_cuenta}</FONT>','</div>');
		
		function render_id_cuenta_ant(value, p, record){return String.format('{0}', record.data['desc_cta_anticipo']);}
		var tpl_id_cuenta_ant=new Ext.Template('<div class="search-item">','<b><i>{nombre_cuenta}</b></i><br>','<FONT COLOR="#B5A642">{nro_cuenta}</FONT>','</div>');
		function render_id_cuenta_gar(value, p, record){return String.format('{0}', record.data['desc_cta_garantia']);}
		var tpl_id_cuenta_gar=new Ext.Template('<div class="search-item">','<b><i>{nombre_cuenta}</b></i><br>','<FONT COLOR="#B5A642">{nro_cuenta}</FONT>','</div>');
		
		function render_id_cuenta_desc(value, p, record){return String.format('{0}', record.data['desc_cta_descuento']);}
		var tpl_id_cuenta_desc=new Ext.Template('<div class="search-item">','<b><i>{nombre_cuenta}</b></i><br>','<FONT COLOR="#B5A642">{nro_cuenta}</FONT>','</div>');
		
		function render_id_auxiliar(value, p, record){return String.format('{0}', record.data['desc_auxiliar']);}
		var tpl_id_auxiliar=new Ext.Template('<div class="search-item">','<b><i>{nombre_auxiliar}</b></i><br>','<FONT COLOR="#B5A642">{codigo_auxiliar}</FONT>','</div>');

		function render_id_gestion(value, p, record){return String.format('{0}', record.data['desc_gestion']);}
		var tpl_id_gestion=new Ext.Template('<div class="search-item">','<b><i>{gestion}</b></i>','<FONT COLOR="#B5A642">{denominacion}</FONT>','</div>');

	
	/////////////////////////
	// Definici�n de datos //
	/////////////////////////
	
	// hidden id_proveedor_cuenta_auxiliar
	//en la posici�n 0 siempre esta la llave primaria

	Atributos[0]={
		validacion:{
			labelSeparator:'',
			name: 'id_proveedor_cuenta_auxiliar',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false
	};
	
	// txt id_proveedor
	Atributos[1]={
		validacion:{
			name:'id_proveedor',
			labelSeparator:'',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false,
			disabled:true
		},
		tipo:'Field',
		filtro_0:false,
		defecto:maestro.id_proveedor
	};
	
	// txt id_gestion
	Atributos[2]={
			validacion:{
			name:'id_gestion',
			fieldLabel:'Gesti�n',
			allowBlank:false,			
			//emptyText:'Gesti�n...',
			desc: 'desc_gestion', //indica la columna del store principal ds del que proviane la descripcion
			store:ds_gestion,
			valueField: 'id_gestion',
			displayField: 'gestion',
			queryParam: 'filterValue_0',
			filterCol:'EMPRES.denominacion#GESTIO.gestion',
			typeAhead:true,
			tpl:tpl_id_gestion,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:100,
			minListWidth:'100%',
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
			width:'100%',
			disabled:false		
		},
		tipo:'ComboBox',
		form: true,
		filtro_0:true,
		filterColValue:'EMPRES_4.denominacion#GESTIO_4.gestion'
	};
	
// txt id_cuenta
		filterCols_servicio=new Array();
	    filterValues_servicio=new Array();
	    filterCols_servicio[0]='PARAME.id_gestion';
	    filterValues_servicio[0]='%';
	    

	Atributos[3]={
		validacion:{
			name:'id_cuenta',
			desc:'desc_cuenta',
			allowBlank:false,
			fieldLabel:'Cuenta',
			tipo:'ingreso',//determina el action a llamar
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			vtype:"texto",
			width:200,
			pageSize:10,
			direccion:direccion,
			grid_visible:true,
			width_grid:200,
			renderer:render_id_cuenta,
			filterCols:filterCols_servicio,
				filterValues:filterValues_servicio,
			disabled:true,
			onSelect:function(record){ 				
				//Ext.form.LovItemsAlm.superclass.setValue.call(this,v.desc)
				componentes[3].setValue({id:record.data.id_cuenta,desc:record.data.desc_cuenta});				
				componentes[3].collapse();				
				ds_auxiliar.baseParams={cuenta:record.data.id_cuenta};				
				componentes[4].modificado=true;
				componentes[4].setValue('');
				componentes[4].setDisabled(false);	 	
			}	
		},
		tipo:'LovCuenta',
		save_as:'id_cuenta',
		id_grupo:0
	};
// txt id_auxiliar
	Atributos[4]= {
			validacion: {
			name:'id_auxiliar',
			fieldLabel:'Auxiliar',
			allowBlank:false,			
			//emptyText:'Auxiliar...',
			desc: 'desc_auxiliar', //indica la columna del store principal ds del que proviane la descripcion
			store:ds_auxiliar,
			valueField: 'id_auxiliar',
			displayField: 'nombre_auxiliar',
			queryParam: 'filterValue_0',
			filterCol:'AUXILI.codigo_auxiliar#AUXILI.nombre_auxiliar',
			typeAhead:false,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:100,
			minListWidth:450,
			grow:true,
			width:'100%',
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
			triggerAction:'all',
			grid_visible:true,
			renderer:render_id_auxiliar,
			disabled:true,
			width_grid:200 // ancho de columna en el gris
			
		},
		tipo:'ComboBox',
		id_grupo:0,
		save_as:'id_auxiliar',
		filtro_0:true,
		filterColValue:'AUXILI.codigo_auxiliar#AUXILI.nombre_auxiliar'
	};
	
	Atributos[5]={//==> se usa
			validacion: {
			name:'tipo',
			fieldLabel:'Bien/Servicio',
			allowBlank:false,
			typeAhead:true,
			loadMask:true,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[['Bien','Bien'],['Servicio','Servicio']]}),
			valueField:'ID',
			displayField:'valor',
			//lazyRender:true,
			forceSelection:true,
			grid_visible:true,
			grid_editable:true,
			width_grid:110,
			pageSize:100,
			//minListWidth:'100%',
			disable:false
		},
		tipo:'ComboBox',
		form: true,
		filtro_0:true,
		filterColValue:'PROCUA.tipo',
		save_as:'tipo'
	};

	// txt fecha_reg
	Atributos[6]={
		validacion:{
			name: 'fecha_reg', //indica la columna del store principal ds del que proviane la descripcion
			fieldLabel:'Fecha Registro',
			grid_visible:true,
			grid_editable:false,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			width_grid:100,
			renderer:formatDate		
		},
		tipo:'DateField',
		filtro_0:true,
		dateFormat:'m-d-Y',
		form:false,		
		filterColValue:'PROCUA.fecha_reg',
	};
	
	Atributos[7]={
			validacion:{
 			name:'id_cuenta_anticipo',
			fieldLabel:'Cuenta Anticipo',
			allowBlank:true,			
			//emptyText:'Cuenta Anticipo...',
			desc: 'desc_cta_anticipo', 		
			store:ds_cuenta_ant,
			valueField: 'id_cuenta',
			displayField: 'desc_cta2',
			queryParam: 'filterValue_0',
			filterCol:'cuenta.nro_cuenta#cuenta.nombre_cuenta',
		 	typeAhead:false,
			triggerAction:'all',
			tpl:tpl_id_cuenta_ant,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:5,
			minListWidth:'100%',
			grow:true,
			resizable:true,
			minChars:1,
			editable:true,
			renderer:render_id_cuenta_ant,
 			grid_visible:true,
 	 		grid_editable:true,
			width_grid:150,
			lazyRender:true,
      		width:'100%',
			disabled:true		
		}, 
		tipo:'ComboBox',
		form: true,
		filtro_0:true, 
		filterColValue:'cuenta.id_cuenta_anticipo',
		save_as:'id_cuenta_anticipo'
	};
	
	Atributos[8]={
			validacion:{
 			name:'id_cuenta_garantia',
			fieldLabel:'Cuenta Garantia',
			allowBlank:true,			
			//emptyText:'Cuenta Garantia...',
			desc: 'desc_cta_garantia', 		
			store:ds_cuenta_gar,
			valueField: 'id_cuenta',
			displayField: 'desc_cta2',
			queryParam: 'filterValue_0',
			filterCol:'cuenta.nro_cuenta#cuenta.nombre_cuenta',
		 	typeAhead:false,
			triggerAction:'all',
			tpl:tpl_id_cuenta_gar,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:5,
			minListWidth:'100%',
			grow:true,
			resizable:true,
			minChars:1,
			editable:true,
			renderer:render_id_cuenta_gar,
 			grid_visible:true,
 	 		grid_editable:true,
			width_grid:150,
			lazyRender:true,
      		width:'100%',
			disabled:true		
		}, 
		tipo:'ComboBox',
		form: true,
		filtro_0:true,	 
		filterColValue:'cuenta.id_cuenta_garantia',
		save_as:'id_cuenta_garantia'
	}; 
	 
	
	Atributos[9]={
			validacion:{
 			name:'id_cuenta_descuento',
			fieldLabel:'Cuenta Descuento',
			allowBlank:true,			
			//emptyText:'Cuenta Anticipo...',
			desc: 'desc_cta_descuento', 		
			store:ds_cuenta_desc,
			valueField: 'id_cuenta',
			displayField: 'desc_cta2',
			queryParam: 'filterValue_0',
			filterCol:'cuenta.nro_cuenta#cuenta.nombre_cuenta',
		 	typeAhead:false,
			triggerAction:'all',
			tpl:tpl_id_cuenta_ant,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:5,
			minListWidth:'100%',
			grow:true,
			resizable:true,
			minChars:1,
			editable:true,
			renderer:render_id_cuenta_desc,
 			grid_visible:true,
 	 		grid_editable:true,
			width_grid:150,
			lazyRender:true,
      		width:'100%',
			disabled:true		
		}, 
		tipo:'ComboBox',
		form: true,
		filtro_0:true, 
		filterColValue:'cuenta.id_cuenta_descuento',
		save_as:'id_cuenta_descuento'
	};
	//----------- FUNCIONES RENDER
	
	function formatDate(value){return value?value.dateFormat('d/m/Y'):''};

	//---------- INICIAMOS LAYOUT DETALLE
	var config={titulo_maestro:'Proveedor-Cuenta (Maestro)',titulo_detalle:'proveedor_cuenta_detalle (Detalle)',grid_maestro:'grid-'+idContenedor};
	var layout_proveedor_cuenta_detalle = new DocsLayoutMaestro(idContenedor);
	layout_proveedor_cuenta_detalle.init(config);
	
	
	
	//---------- INICIAMOS HERENCIA
	this.pagina = Pagina;
	this.pagina(paramConfig,Atributos,ds,layout_proveedor_cuenta_detalle,idContenedor);
	var getComponente=this.getComponente;
	var getSelectionModel=this.getSelectionModel;
	var EstehtmlMaestro=this.htmlMaestro;
	var ClaseMadre_getComponente=this.getComponente;
	var cm_btnNew=this.btnNew;
	var cm_btnEdit=this.btnEdit;
	var getDialog=this.getDialog;
	var getForm=this.getFormulario;
	var mostrarFormulario=this.mostrarFormulario;
//DEFINICI�N DE LA BARRA DE MEN�
	var paramMenu={guardar:{crear:true,separador:false},nuevo:{crear:true,separador:true},editar:{crear:true,separador:false},eliminar:{crear:true,separador:false},actualizar:{crear:true,separador:false}};
//DEFINICI�N DE FUNCIONES
	
	var paramFunciones={
	btnEliminar:{url:direccion+'../../../control/proveedor_cuenta_auxiliar/ActionEliminarProveedorCuentaDetalle.php',parametros:'&id_proveedor='+maestro.id_proveedor},
	Save:{url:direccion+'../../../control/proveedor_cuenta_auxiliar/ActionGuardarProveedorCuentaDetalle.php',parametros:'&id_proveedor='+maestro.id_proveedor},
	ConfirmSave:{url:direccion+'../../../control/proveedor_cuenta_auxiliar/ActionGuardarProveedorCuentaDetalle.php',parametros:'&id_proveedor='+maestro.id_proveedor},
	Formulario:{html_apply:'dlgInfo-'+idContenedor,height:340,width:480,minWidth:150,minHeight:200,	closable:true,titulo:'proveedor_cuenta_detalle'}};
	
	//-------------- Sobrecarga de funciones --------------------//
	this.reload=function(m){
		maestro=m;
		ds.lastOptions={
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				id_proveedor:maestro.id_proveedor
			}
		};
		this.btnActualizar();
		
		Atributos[1].defecto=maestro.id_proveedor;

		paramFunciones.btnEliminar.parametros='&id_proveedor='+maestro.id_proveedor;
		paramFunciones.Save.parametros='&id_proveedor='+maestro.id_proveedor;
		paramFunciones.ConfirmSave.parametros='&id_proveedor='+maestro.id_proveedor;
		this.InitFunciones(paramFunciones)
	};
	
	//Para manejo de eventos
	function iniciarEventosFormularios(){	
	//para iniciar eventos en el formulario
		for(var i=0; i<Atributos.length; i++){
			componentes[i]=ClaseMadre_getComponente(Atributos[i].validacion.name)
		}

		componentes[2].on('select',evento_gestion);		
		dialog=getDialog();
		form=getForm();
	}
	
	function evento_gestion( combo, record, index )
	{	
		//combo cuenta						
		componentes[3].store.baseParams={m_id_gestion:record.data.id_gestion};
		componentes[3].modificado=true;
		componentes[3].setValue('');			
		componentes[3].setDisabled(false);	

		//combo auxiliar
		componentes[4].modificado=true;
		componentes[4].setValue('');			
		componentes[4].setDisabled(true);	
		
		//combo cuenta anticipo						
		componentes[7].store.baseParams={m_id_gestion:record.data.id_gestion,sw_transaccional:1};
		componentes[7].modificado=true;
		componentes[7].setValue('');			
		componentes[7].setDisabled(false);	
		
		//combo cuenta garantia						
		componentes[8].store.baseParams={m_id_gestion:record.data.id_gestion,sw_transaccional:1};
		componentes[8].modificado=true;
		componentes[8].setValue('');			
		componentes[8].setDisabled(false);	
		
		
		componentes[9].store.baseParams={m_id_gestion:record.data.id_gestion,sw_transaccional:1};
		componentes[9].modificado=true;
		componentes[9].setValue('');			
		componentes[9].setDisabled(false);	
 	} 

	this.btnNew=function()
	{
		ds_gestion.load({callback:otraFuncion});
	}
	
	function otraFuncion()
	{
		var sm=getSelectionModel();
			//dlgInfo.buttons[0].disable();
			dialog.buttons[1].show();
			sm.clearSelections();//limpiar selecion
			form.reset();
			var cont=ds_gestion.getTotalCount();
			
			for(var i=0;i<cont;i++){
				
				if(ds_gestion.getAt(i).get('estado_ges_gral')=='abierto'){
					
					//componentes[2].setValue(ds_gestion.getAt(i).get('id_gestion'));
				}
			}
			var filas=ds.getModifiedRecords();//recupera la catidad de modificaciones hechas
			var cont=filas.length;
			if(cont>0){//verifica si existen modificaciones hechas en los registros del grid
				if(confirm("Tiene registros pendientes sin guardar que se perderan, desea continuar?")){
					mostrarFormulario()
				}
			}
			else{
				mostrarFormulario()
			}
	}
	
	this.btnEdit=function()
	{
		if(componentes[2].getValue()>0){
			  var serv =getComponente('id_cuenta');
		      serv.lov.modifica_filterValues(0,'%');
			  getComponente('id_cuenta').filterValues[0] =componentes[2].getValue();
			  getComponente('id_cuenta').modificado = true;
			  		componentes[3].setDisabled(false);
			
			/*ds_cuenta.lov.baseParams={m_id_gestion:componentes[2].getValue()};
			ds_cuenta.modificado=true;
	
			*/
			
			//combo auxiliar
			if(componentes[3].getValue()>0){
			  componentes[4].modificado=true;
			  componentes[4].setDisabled(false);	
			  ds_auxiliar.baseParams={cuenta:componentes[3].getValue()};
			  
			}
		
			//combo cuenta anticipo						
			ds_cuenta_ant.baseParams={m_id_gestion:componentes[2].getValue(),sw_transaccional:1};
			ds_cuenta_ant.modificado=true;
			
			componentes[7].setDisabled(false);	
		
			//combo cuenta garantia						
			ds_cuenta_gar.baseParams={m_id_gestion:componentes[2].getValue(),sw_transaccional:1};
			ds_cuenta_gar.modificado=true;
						
			componentes[8].setDisabled(false);	
		
		
			ds_cuenta_desc.baseParams={m_id_gestion:componentes[2].getValue(),sw_transaccional:1};
			ds_cuenta_desc.modificado=true;
						
			componentes[9].setDisabled(false);	
		}
		cm_btnEdit();
	}
	
	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_proveedor_cuenta_detalle.getLayout()};
	//para el manejo de hijos
	
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	this.InitFunciones(paramFunciones);
	//carga datos XML
	
	ds_gestion.baseParams={estado:'abierto'};	
	
	
	//para agregar botones
	
	this.iniciaFormulario();
	iniciarEventosFormularios();
	this.bloquearMenu();
	layout_proveedor_cuenta_detalle.getLayout().addListener('layout',this.onResize);
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
	
}