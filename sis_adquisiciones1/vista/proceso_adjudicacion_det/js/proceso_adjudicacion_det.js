/**
 * Nombre:		  	    pagina_proceso_adjudicacion_Det.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-05-28 17:32:05
 */
function pagina_proceso_adjudicacion_det(idContenedor,direccion,paramConfig,maestro,idContenedorPadre)
{
	var Atributos=new Array,sw=0;
	var num_cotizaciones=0;
	var on=0;
	var mensaje;
	/////////////////
	//  DATA STORE //
	/////////////////
	var ds = new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/cotizacion/ActionListarCotizacion.php'}),
		// aqui se define la estructura del XML
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_cotizacion',
			totalRecords: 'TotalCount'

		}, [
		// define el mapeo de XML a las etiquetas (campos)
				'id_cotizacion',
		{name: 'fecha_venc',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_reg',type:'date',dateFormat:'Y-m-d'},
		'impuestos',
		'garantia',
		'lugar_entrega',
		'forma_pago',
		'tiempo_validez_oferta',
		{name: 'fecha_entrega',type:'date',dateFormat:'Y-m-d'},
		'tipo_entrega',
		'observaciones',
		'id_proceso_compra',
		'desc_proceso_compra',
		'id_moneda',
		'desc_moneda',
		'id_proveedor',
		'desc_proveedor',
		'id_tipo_categoria_adq',
		'desc_tipo_categoria_adq',
		'precio_total_moneda_cotizada',
		'figura_acta',
		'num_factura',
		'num_orden_compra',
		'estado_vigente',
		'estado_reg',
		'nombre_pago',
		'siguiente_estado',
		'periodo',
		'gestion',
		'num_orden_compra_sis',
		'num_cotizacion',
		{name: 'fecha_orden_compra',type:'date',dateFormat:'Y-m-d'},
		'direccion_proveedor','mail_proveedor','telefono1_proveedor','telefono2_proveedor','fax_proveedor',
		{name: 'fecha_cotizacion',type:'date',dateFormat:'Y-m-d'},'num_detalle_cotizado',
		'precio_total','id_moneda_base','numeracion_periodo','num_detalle_cotizado_gral', 'num_detalle_adjudicado_gral','se_adjudica','num_detalle_adjudicado','cantidad_sol'
		
		]),remoteSort:true});

	//carga datos XML
	
	// DEFINICI�N DATOS DEL MAESTRO
	var div_grid_detalle=Ext.DomHelper.append(idContenedor,{tag:'div',id:'grid_detalle-'+idContenedor},true);
		Ext.DomHelper.applyStyles(div_grid_detalle,"background-color:#FFFFFF");
	
	////////////////////////
	// Definici�n de datos //
	/////////////////////////

	// hidden id_cotizacion
	//en la posici�n 0 siempre esta la llave primaria

	Atributos[0]={
		validacion:{
			//fieldLabel: 'Id',
			labelSeparator:'',
			name: 'id_cotizacion',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		save_as:'id_cotizacion'
	};
	
	//txt id_proceso_compra   ==> deberia ser fiel
	Atributos[1]={
		validacion:{
			//fieldLabel: 'Id',
			labelSeparator:'',
			name: 'id_proceso_compra',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		defecto:maestro.id_proceso_compra,
		save_as:'id_proceso_compra'
	};
	
	//txt id_tipo_categoria_adq  ==> field
	Atributos[2]={
		validacion:{
			//fieldLabel: 'Id',
			labelSeparator:'',
			name: 'id_tipo_categoria_adq',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		defecto:maestro.id_tipo_categoria_adq,
		save_as:'id_tipo_categoria_adq'
	};
	
	
	//txt num_cotizacion
	Atributos[3]={//==> SI
		validacion:{
			name:'num_cotizacion',
			fieldLabel:'N� Cotizacion ',
			allowBlank:true,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			decimalPrecision:2,//para numeros float
			allowNegative:false,
			minValue:0,
			vtype:'texto',
			grid_visible:false,
			grid_editable:false,
			width_grid:80,
			width:'40%',
			disabled:true,
			grid_indice:2
		},
		tipo: 'TextField',
		form: true,
		filtro_0:true,
		defecto:maestro.num_cotizacion,
		filterColValue:'COTIZA.num_cotizacion#COTIZA.periodo',
		save_as:'num_cotizacion',
		id_grupo:1  //1
	};
	
	
	Atributos[4]={//==> SI
		validacion:{
			name:'desc_proveedor',
			fieldLabel:'Proveedor',
			allowBlank:true,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			decimalPrecision:0,//para numeros float
			allowNegative:false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			width:'40%',
			disabled:true,
			grid_indice:3
		},
		tipo: 'TextField',
		form: true,
		filtro_0:true,
		filterColValue:'PERSON_15.apellido_paterno#PERSON_15.apellido_materno#PERSON_15.nombre#INSTIT.nombre',
		save_as:'id_proveedor',
		id_grupo:1  //1
	};
	
	//txt fecha_validez_oferta ==> se usa
	Atributos[5]= {
		validacion:{
			name:'tiempo_validez_oferta',
			fieldLabel:'Validez Oferta',
			allowBlank:true,
			maxLength:3,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			decimalPrecision:0,//para numeros float
			allowNegative:false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			width:'60%',
			disable:false,
			grid_indice:8
		},
		tipo: 'TextField',
		form: true,
		filtro_0:false,
		filterColValue:'COTIZA.tiempo_validez_oferta',
		save_as:'tiempo_validez_oferta',
		id_grupo:5
	};
	
	//txt id_moneda  ==> se va a escoger
	Atributos[6]={//==> SI
		validacion:{
			name:'desc_moneda',
			fieldLabel:'Moneda',
			allowBlank:true,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			decimalPrecision:0,//para numeros float
			allowNegative:false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			width:'40%',
			disabled:true,
			grid_indice:5
		},
		tipo: 'TextField',
		form: true,
		filtro_0:false,
		defecto:maestro.num_cotizacion,
		filterColValue:'MONEDA.nombre',
		save_as:'id_monedas',
		id_grupo:0  //1
	};
	

	//txt tipo_entrega  ==> se usa
	Atributos[7]={
		validacion:{
			name:'tipo_entrega',
			fieldLabel:'Tiempo Entrega',
			allowBlank:true,
			maxLength:120,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			width:'100%',
			disabled:false,
			grid_indice:9		
		},
		tipo: 'TextField',
		form: true,
		filtro_0:false,
		filterColValue:'COTIZA.tipo_entrega',
		save_as:'tipo_entrega',
		id_grupo:3
	};

	//txt fecha_entrega ==> se usa
	Atributos[8]= {
		validacion:{
			name:'fecha_entrega',
			fieldLabel:'Fecha Entrega',
			allowBlank:true,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:true,
			grid_editable:false,
			renderer: formatDate,
			width_grid:85,
			disabled:false,
			grid_indice:10		
		},
		form:true,
		tipo:'DateField',
		filtro_0:false,
		filterColValue:'COTIZA.fecha_entrega',
		dateFormat:'m-d-Y',
		defecto:' ',
		save_as:'fecha_entrega',
		id_grupo:3
	};
	
	
	//txt forma_pago ==se usa
	Atributos[9]={
		validacion:{
			name:'forma_pago',
			fieldLabel:'Forma de Pago',
			allowBlank:true,
			maxLength:120,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			width:'100%',
			disable:false,
			grid_indice:11	
		},
		tipo: 'TextField',
		form: true,
		filtro_0:false,
		filterColValue:'COTIZA.forma_pago',
		save_as:'forma_pago',
		id_grupo:4
	};

	
	//txt impuestos
	Atributos[10]={//==> se usa
			validacion: {
			name:'impuestos',
			fieldLabel:'Impuesto',
			allowBlank:true,
			typeAhead:true,
			loadMask:true,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[['si','si'],['no','no']]}),
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			forceSelection:true,
			grid_visible:false,
			grid_editable:false,
			width_grid:70,
			pageSize:100,
			minListWidth:'100%',
			disable:false,
			grid_indice:12		
		},
		tipo:'ComboBox',
		form: true,
		filtro_0:false,
		filterColValue:'COTIZA.impuestos',
		defecto:'si',
		save_as:'impuestos',
		id_grupo:4
	};
	


// txt garantia
	Atributos[11]={//==> SI
		validacion:{
			name:'garantia',
			fieldLabel:'Garantia',
			allowBlank:true,
			maxLength:200,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			width:'100%',
			disable:false,
			grid_indice:13	
		},
		tipo: 'TextField',
		form: true,
		filtro_0:false,
		filterColValue:'COTIZA.garantia',
		save_as:'garantia',
		id_grupo:5
	};

	
	// txt figura_acta
	Atributos[12]={//==>SI
		validacion:{
			name:'se_adjudica',
			fieldLabel:'Se adjudica',
			allowBlank:true,
			maxLength:10,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			width:'100%',
			disable:false,
			renderer:formatBoolean,
			grid_indice:2	
		},
		tipo: 'TextField',
		form: true,
		filtro_0:false,
		filterColValue:'COTIZA.se_adjudica',
		save_as:'se_adjudica',
		id_grupo:0
	};


	
// txt fecha_venc
	Atributos[13]= {//==>SI
		validacion:{
			name:'fecha_venc',
			fieldLabel:'Fecha Vencimiento',
			allowBlank:false,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:false,
			grid_editable:false,
			renderer: formatDate,
			width_grid:85,
			disabled:false		,
			grid_indice:40
		},
		form:true,
		tipo:'DateField',
		filtro_0:false,
		filterColValue:'COTIZA.fecha_venc',
		dateFormat:'m-d-Y',
		defecto:'',
		save_as:'fecha_venc',
		id_grupo:1  //1
	};
	
	// txt lugar_entrega ==> se usa
	Atributos[14]={
		validacion:{
			name:'lugar_entrega',
			fieldLabel:'Lugar de Entrega',
			allowBlank:true,
			maxLength:300,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			width:'60%',
			disabled:false,
			grid_indice:14
		},
		tipo: 'TextArea',
		form: true,
		filtro_0:true,
		
		filterColValue:'COTIZA.lugar_entrega',
		save_as:'lugar_entrega',
		id_grupo:1  //1
		
	};
	
	
	
// txt fecha_reg
	Atributos[15]= {//==>SI
		validacion:{
			name:'fecha_reg',
			fieldLabel:'Fecha registro',
			allowBlank:true,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:true,
			grid_editable:false,
			renderer: formatDate,
			width_grid:85,
			disabled:true		
		},
		form:false,
		tipo:'DateField',
		filtro_0:true,
		filterColValue:'COTIZA.fecha_reg',
		dateFormat:'m-d-Y',
		defecto:'',
		save_as:'fecha_reg',
		id_grupo:0
	};



// txt estado_vigente
	Atributos[16]={//==>SI
		validacion:{
			name:'estado_vigente',
			fieldLabel:'Estado',
			allowBlank:true,
			maxLength:30,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			width:'100%',
			renderer:formatAdjudicado,
			disable:false,
			grid_indice:2
		},
		tipo: 'TextField',
		form: true,
		filtro_0:false,
		filterColValue:'COTIZA.estado_vigente',
		save_as:'estado_vigente',
		id_grupo:0
	};
// txt estado_reg
	Atributos[17]={//==> SI
		validacion:{
			name:'estado_reg',
			fieldLabel:'Estado Reg',
			allowBlank:false,
			maxLength:30,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:false,
			grid_editable:false,
			width_grid:100,
			width:'100%',
			disable:false		
		},
		tipo: 'TextField',
		form: true,
		filtro_0:false,
		filterColValue:'COTIZA.estado_reg',
		save_as:'estado_reg',
		defecto:'activo',
		id_grupo:0
	};

// txt observaciones
	Atributos[18]={//==>SI
		validacion:{
			name:'observaciones',
			fieldLabel:'Observaciones',
			allowBlank:true,
			maxLength:300,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:false,
			grid_editable:false,
			width_grid:100,
			width:'100%',
			disabled:true,
			grid_indice:60
		},
		tipo: 'TextArea',
		form: true,
		filtro_0:true,
		defecto:maestro.lugar_entrega,
		filterColValue:'COTIZA.observaciones',
		save_as:'observaciones',
		defecto:'-',
		id_grupo:0  //1
	};

	
	
	Atributos[19]={
		validacion:{
			//fieldLabel: 'Id',
			labelSeparator:'',
			name: 'num_proceso',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		defecto:maestro.num_proceso,
		save_as:'num_proceso'
	};
	
	
	
	/*************/
	
	Atributos[20]={
		validacion:{
			name:'direccion_proveedor',
			fieldLabel:'Direccion',
			allowBlank:true,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			width:'100%',
			disabled:true,
			grid_indice:3		
		},
		tipo: 'TextArea',
		form: true,
		filtro_0:false,
		filterColValue:'',
		save_as:'',
		id_grupo:2
	};

	
	Atributos[21]={
		validacion:{
			name:'mail_proveedor',
			fieldLabel:'Email',
			allowBlank:true,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:false,
			grid_editable:false,
			width_grid:100,
			width:'100%',
			disabled:true,
			grid_indice:4		
		},
		tipo: 'TextField',
		form: true,
		filtro_0:false,
		filterColValue:'',
		save_as:'',
		id_grupo:2
	};
	
	
	
	Atributos[22]={
		validacion:{
			name:'telefono1_proveedor',
			fieldLabel:'Telef. 1',
			allowBlank:true,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:50,
			width:'100%',
			disabled:true,
			grid_indice:5		
		},
		tipo: 'TextField',
		form: true,
		filtro_0:false,
		filterColValue:'',
		save_as:'',
		id_grupo:2
	};
	
	
	Atributos[23]={
		validacion:{
			name:'telefono2_proveedor',
			fieldLabel:'Telef. 2',
			allowBlank:true,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:false,
			grid_editable:false,
			width_grid:50,
			width:'100%',
			disabled:true,
			grid_indice:6		
		},
		tipo: 'TextField',
		form: true,
		filtro_0:false,
		filterColValue:'',
		save_as:'',
		id_grupo:2
	};
	
	
	Atributos[24]={
		validacion:{
			name:'fax_proveedor',
			fieldLabel:'Fax',
			allowBlank:true,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:65,
			width:'100%',
			disabled:true,
			grid_indice:7		
		},
		tipo: 'TextField',
		form: true,
		filtro_0:false,
		filterColValue:'',
		save_as:'',
		id_grupo:2
	};
	
	
	
	Atributos[25]= {
		validacion:{
			name:'fecha_cotizacion',
			fieldLabel:'Fecha Cotizacion',
			allowBlank:true,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:true,
			grid_editable:false,
			renderer: formatDate,
			width_grid:85,
			disabled:false,
			grid_indice:10		
		},
		form:true,
		tipo:'DateField',
		filtro_0:false,
		filterColValue:'COTIZA.fecha_cotizacion',
		dateFormat:'m-d-Y',
		defecto:' ',
		save_as:'fecha_cotizacion',
		id_grupo:3
	};
	
	
	Atributos[26]={
		validacion:{//==>NO
			name:'num_detalle_cotizado',
			fieldLabel:'num_detalle_cotizado',
			allowBlank:true,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			decimalPrecision:0,//para numeros float
			allowNegative:false,
			minValue:0,
			vtype:'texto',
			grid_visible:false,
			grid_editable:false,
			width_grid:100,
			width:'100%',
			disable:false		
		},
		tipo: 'NumberField',
		form: true,
		filtro_0:false,
		id_grupo:0
	};
	
	
	Atributos[27]={
		validacion:{
			name:'numeracion_periodo',
			fieldLabel:'Periodo/N� Sol.',
			allowBlank:true,
			maxLength:30,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:65,
			align:'right',
			width:'40%',
			disable:false,
			grid_indice:1
		},
		tipo: 'TextField',
		form:true,
		filtro_0:false,
		filterColValue_0:'COTIZA.num_cotizacion#COTIZA.periodo',
		save_as:'numeracion_periodo',
		id_grupo:0
	};
	
	
	Atributos[28]={
		validacion:{//==>NO
			name:'num_detalle_cotizado_gral',
			fieldLabel:'num_detalle_cotizado_gral',
			allowBlank:true,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			decimalPrecision:0,//para numeros float
			allowNegative:false,
			minValue:0,
			vtype:'texto',
			grid_visible:false,
			grid_editable:false,
			width_grid:100,
			width:'100%',
			disable:false		
		},
		tipo: 'NumberField',
		form: true,
		filtro_0:false,
		id_grupo:0
	};
	
	
	Atributos[29]={
		validacion:{
			labelSeparator:'',
			name: 'id_moneda_base',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		save_as:'id_moneda_base',
		id_grupo:0
	};
	
	
	Atributos[30]={
		validacion:{
			name:'precio_total',
			fieldLabel:'Precio Total',
			allowBlank:true,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:true,
			decimalPrecision:2,//para numeros float
			allowNegative:false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:95,
			width:'100%',
			disabled:false,
			grid_indice:7
		},
		tipo: 'NumberField',
		form: true,
		filtro_0:false,
		filterColValue:'COTIZA.precio_total',
		save_as:'precio_total',
		id_grupo:0
	};
	
	Atributos[31]={
			validacion:{
				name:'gestion',
				fieldLabel:'Gesti�n',
				allowBlank:true,
				maxLength:20,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:55,
				align:'right',
				width:'40%',
				disabled:true,
				grid_indice:1
			},
			tipo: 'TextField',
			form: false,
			filtro_0:true,
			filterColValue:'PROCOM.gestion'
			
		};
	//----------- FUNCIONES RENDER
	
	function formatDate(value){return value?value.dateFormat('d/m/Y'):''};
	function formatBoolean(value){
	    if(value=='true'){return 'si';}
	    else{
	        return 'no';
	    }
	}
	
	function formatAdjudicado(val,cell,record,row,colum,store){
		   if((record.data.num_detalle_adjudicado_gral<record.data.cantidad_sol) &&(record.data.se_adjudica=='si' ||record.data.se_adjudica=='true')){
			  return '<span style="color:red;font-size:8pt">' + val + '</span>';
	       }else{
	          return val;
	    	}
	   };
	

	//---------- INICIAMOS LAYOUT DETALLE
	var config={titulo_maestro:'Proceso de Adjudicacion',titulo_detalle:'Adjudicacion',grid_maestro:'grid-'+idContenedor};
	layout_proceso_adjudicacion_det = new DocsLayoutDetalle(idContenedor,idContenedorPadre);
	layout_proceso_adjudicacion_det.init(config);
	
	
	
	//---------- INICIAMOS HERENCIA
	this.pagina = Pagina;
	this.pagina(paramConfig,Atributos,ds,layout_proceso_adjudicacion_det,idContenedor);
	var getComponente=this.getComponente;
	var getSelectionModel=this.getSelectionModel;
	var CM_btnNew=this.btnNew;
	var CM_btnEdit=this.btnEdit;
	var CM_btnDelete=this.btnDelete;
	var CM_ocultarGrupo=this.ocultarGrupo;
	var CM_mostrarGrupo=this.mostrarGrupo;
	var CM_conexionFailure=this.conexionFailure;
	var CM_ocultarComponente=this.ocultarComponente;
	var CM_mostrarComponente=this.mostrarComponente;
	var getDialog=this.getDialog;
	var EstehtmlMaestro=this.htmlMaestro;
	var enableSelect=this.EnableSelect;
//DEFINICI�N DE LA BARRA DE MEN�
	var paramMenu={
		
		actualizar:{crear:true,separador:false}
	};
//DEFINICI�N DE FUNCIONES
	
	var paramFunciones={
	//btnEliminar:{url:direccion+'../../../control/cotizacion/ActionEliminarCotizacion.php',parametros:'&m_id_proceso_compra='+maestro.id_proceso_compra},
	//Save:{url:direccion+'../../../control/cotizacion/ActionGuardarCotizacion.php',parametros:'&m_id_proceso_compra='+maestro.id_proceso_compra},
	//ConfirmSave:{url:direccion+'../../../control/cotizacion/ActionGuardarCotizacion.php',parametros:'&m_id_proceso_compra='+maestro.id_proceso_compra},
	Formulario:{html_apply:'dlgInfo-'+idContenedor,height:340,width:480,minWidth:150,minHeight:200,	closable:true,titulo:'cotizacion',
	grupos:[{
			tituloGrupo:'Oculto',
			columna:0,
			id_grupo:0
		},{
			tituloGrupo:'Cotizacion',
			columna:0,
			id_grupo:1
		},
		{
			tituloGrupo:'Datos Proveedor',
			columna:0,
			id_grupo:2
		},
		{
			tituloGrupo:'Datos Entrega Pedido',
			columna:0,
			id_grupo:3
		},
		{
			tituloGrupo:'Pago',
			columna:0,
			id_grupo:4
		},
		{
			tituloGrupo:'Datos Oferta',
			columna:0,
			id_grupo:5
		}
	]}};
	
	
	var ds_maestro = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_adquisiciones/control/proceso_compra/ActionListarProcesoCompra.php?id_proceso_compra='+maestro.id_proceso_compra}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_proceso_compra',totalRecords: 'TotalCount'},['id_proceso_compra',
		'num_proceso','codigo_proceso',
		'observaciones','desc_moneda','desc_tipo_adq'
		])
		});

		ds_maestro.load({
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_proceso_compra:maestro.id_proceso_compra

			},
			callback:cargar_maestro
		});

		function cargar_maestro(){
			
			
		
				data1=[['N� Proceso',ds_maestro.getAt(0).get('num_proceso')],  ['Cod. Proceso',ds_maestro.getAt(0).get('codigo_proceso')],   ['Moneda',ds_maestro.getAt(0).get('desc_moneda')],   ['Descripcion',ds_maestro.getAt(0).get('observaciones')], ['Tipo Adquisicion',ds_maestro.getAt(0).get('desc_tipo_adq')],  ];


		Ext.DomHelper.overwrite('grid_detalle-'+idContenedor,EstehtmlMaestro(data1));

		}
	
	//-------------- Sobrecarga de funciones --------------------//
	this.reload=function(params){
		
		var datos=Ext.urlDecode(decodeURIComponent(params));
		maestro.id_proceso_compra=datos.m_id_proceso_compra;
		maestro.codigo_procedo=datos.m_codigo_proceso;
		maestro.num_proceso=datos.m_num_proceso;
		maestro.tipo_adq=datos.m_tipo_adq;
		maestro.id_tipo_categoria_adq=datos.m_id_tipo_categoria_adq;
		maestro.lugar_entrega=datos.m_lugar_entrega;
		maestro.id_moneda=datos.m_id_moneda;
		maestro.desc_moneda=datos.m_desc_moneda;
		maestro.num_cotizacion=datos.m_num_cotizacion;
		maestro.id_moneda_base=datos.m_id_moneda_base;
		ds_maestro.load({
				params:{
					start:0,
					limit: paramConfig.TamanoPagina,
					CantFiltros:paramConfig.CantFiltros,
					id_proceso_compra:maestro.id_proceso_compra
					
				},
				callback:cargar_maestro
			});
		ds.lastOptions={
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_proceso_compra:maestro.id_proceso_compra,
				proceso_adj:'si'
			}
		};
		this.btnActualizar();
		iniciarEventosFormularios();
		
		
		Atributos[1].defecto=maestro.id_proceso_compra;		
		this.iniciarEventosFormularios;
		this.InitFunciones(paramFunciones);
		
	};
	
	function btn_anular_cotizacion(){
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		var SelectionsRecord=sm.getSelected();
		if(NumSelect!=0){
			var dialog=getDialog();
			dialog.buttons[0].setText('Anular Cotizacion');
			dialog.buttons[0].enable();
			var msj='';
			if(maestro.ejecutado=='si'){ msj='El presupuesto ya fue revertido para esta solicitud, al anular esta cotizacion, el presupuesto restante tambien ser� revertido.\n';}
            else{msj='';}
			if(confirm(msj+"Esta seguro de anular la cotizacion?")){
				var data="cantidad_ids=1&id_cotizacion="+SelectionsRecord.data.id_cotizacion+'&anular=1';
					Ext.Ajax.request({url:direccion+"../../../control/cotizacion/ActionTerminarCotizacion.php",
					params:data,
					method:'POST',
					failure:CM_conexionFailure,
					success:exito,
					timeout:100000000
					});	
			}
		}
		else{
		  Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
	   }
	   this.btnActualizar;
    }

    function exito(resp){
		  if(resp.responseXML!=undefined && resp.responseXML!=null&& resp.responseXML.documentElement!=null &&resp.responseXML.documentElement!=undefined){
				var root=resp.responseXML.documentElement;
				if(root.getElementsByTagName('error')[0].firstChild.nodeValue=='false'){
					Ext.MessageBox.alert('Estado','Anulacion completada');		
					ds.load({
						params:{
							start:0,
							limit: paramConfig.TamanoPagina,
							CantFiltros:paramConfig.CantFiltros,
							m_id_proceso_compra:maestro.id_proceso_compra,
							proceso_adj:'si'
						}
					});
				}
			}
		}

	function exito1(resp){
		  if(resp.responseXML!=undefined && resp.responseXML!=null&& resp.responseXML.documentElement!=null &&resp.responseXML.documentElement!=undefined){
				var root=resp.responseXML.documentElement;
				if(root.getElementsByTagName('error')[0].firstChild.nodeValue=='false'){
					Ext.MessageBox.alert('Estado',root.getElementsByTagName('mensaje')[0].firstChild.nodeValue);		
					this.btnActualizar;
				}
				
				ds.load({
						params:{
							start:0,
							limit: paramConfig.TamanoPagina,
							CantFiltros:paramConfig.CantFiltros,
							m_id_proceso_compra:maestro.id_proceso_compra,
							proceso_adj:'si'
						}
					});
			}
		}

		
	function btn_adjudicacion(){
		this.btnActualizar;
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			var data='m_id_cotizacion='+SelectionsRecord.data.id_cotizacion;
			data=data+'&m_observaciones='+SelectionsRecord.data.observaciones;
			data=data+'&m_num_proceso='+maestro.num_proceso;
			data=data+'&m_desc_proveedor='+SelectionsRecord.data.desc_proveedor;
			data=data+'&m_estado_vigente='+SelectionsRecord.data.estado_vigente;
			data=data+'&m_desc_moneda='+SelectionsRecord.data.desc_moneda;
			data=data+'&m_id_moneda='+SelectionsRecord.data.id_moneda;
			data=data+'&m_id_moneda_base='+SelectionsRecord.data.id_moneda_base;
			
			
			var ParamVentana={Ventana:{width:'90%',height:'70%'}};
			if(SelectionsRecord.data.estado_vigente!='finalizado'){
				if(SelectionsRecord.data.estado_vigente=='orden_compra' || SelectionsRecord.data.estado_vigente=='en_pago'){Ext.MessageBox.alert('Estado', 'El registro esta en '+SelectionsRecord.data.estado_vigente);}
				else{
					if(SelectionsRecord.data.tipo_entrega!=''){
			   		  if(maestro.ejecutado=='no'){
			   		      //adjudicar todo lo que cotiz� este proveedor
			   		      if(confirm("Esta seguro de adjudicar todo el proceso a este proveedor?")){
                				var data="cantidad_ids=1&id_cotizacion="+SelectionsRecord.data.id_cotizacion+"&m_id_proceso_compra="+SelectionsRecord.data.id_proceso_compra;
                					Ext.Ajax.request({url:direccion+"../../../control/cotizacion/ActionAdjudicarTodo.php",
                					params:data,
                					method:'POST',
                					failure:CM_conexionFailure,
                					success:exito1,
                					timeout:100000000
                					});	
                			}
			   		    }else{
			   		      Ext.MessageBox.alert('Estado','No es posible ajudicar mas detalles, el Presupuesto fu� revertido');
			   		  }
		          }else{
					Ext.MessageBox.alert('Estado', 'Antes del registro de detalle, primero se debe registrar la propuesta');
				  }
			   }
			}else{
				Ext.MessageBox.alert('Estado', 'Solo cotizaciones no finalizadas')
			}
		}
		else{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
			}
	}
		
		
		
	function btn_adjudicacion_det(){
		this.btnActualizar;
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			var data='m_id_cotizacion='+SelectionsRecord.data.id_cotizacion;
			data=data+'&m_observaciones='+SelectionsRecord.data.observaciones;
			data=data+'&m_num_proceso='+maestro.num_proceso;
			data=data+'&m_desc_proveedor='+SelectionsRecord.data.desc_proveedor;
			data=data+'&m_estado_vigente='+SelectionsRecord.data.estado_vigente;
			data=data+'&m_desc_moneda='+SelectionsRecord.data.desc_moneda;
			data=data+'&m_id_moneda='+SelectionsRecord.data.id_moneda;
			data=data+'&m_id_moneda_base='+SelectionsRecord.data.id_moneda_base;
			
			
			var ParamVentana={Ventana:{width:'90%',height:'70%'}};
			if(SelectionsRecord.data.estado_vigente!='finalizado'){
				if(SelectionsRecord.data.estado_vigente=='orden_compra' || SelectionsRecord.data.estado_vigente=='en_pago'){Ext.MessageBox.alert('Estado', 'El registro esta en '+SelectionsRecord.data.estado_vigente);}
				else{
					if(SelectionsRecord.data.tipo_entrega!=''){
			   		  if(maestro.ejecutado=='no'){
						  if(maestro.tipo_adq=='Bien'){
				 				layout_proceso_adjudicacion_det.loadWindows(direccion+'../../../../sis_adquisiciones/vista/adjudicacion/adjudicacion_item.php?'+data,'Detalle de Cotizaciones',ParamVentana);
						  }else{
								layout_proceso_adjudicacion_det.loadWindows(direccion+'../../../../sis_adquisiciones/vista/adjudicacion/adjudicacion_serv.php?'+data,'Detalle de Cotizaciones',ParamVentana);
						  }
							layout_proceso_adjudicacion_det.getVentana().on('resize',function(){
							layout_proceso_adjudicacion_det.getLayout().layout();})
			   		  }else{
			   		      Ext.MessageBox.alert('Estado','No es posible ajudicar mas detalles, el Presupuesto fu� revertido');
			   		  }
		
				}else{
					Ext.MessageBox.alert('Estado', 'Antes del registro de detalle, primero se debe registrar la propuesta');
				}
			
				}
			}else{
				Ext.MessageBox.alert('Estado', 'Solo cotizaciones no finalizadas')
			}
		}
		else{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
			}
	}


	function btn_fin_adjud(){
	    this.btnActualizar;
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			if(SelectionsRecord.data.estado_vigente!='finalizado'){
				if(SelectionsRecord.data.estado_vigente=='cotizado'){
					if(SelectionsRecord.data.num_detalle_adjudicado>0  || SelectionsRecord.data.num_detalle_adjudicado_gral>0){
					    
						if(SelectionsRecord.data.num_detalle_adjudicado>0){
						    mensaje='Finalizaci�n de adjudicaci�n satisfactoria';
						}else{
						    mensaje='No se adjudic� ningun detalle, la cotizaci�n ser� finalizada';
						}
						if(confirm("�Est� seguro de finalizar el registro?")){
				   	    	var data='m_id_cotizacion='+SelectionsRecord.data.id_cotizacion;
							data=data+'&m_observaciones='+SelectionsRecord.data.observaciones;
							var data='cantidad_ids=1&id_cotizacion_0='+SelectionsRecord.data.id_cotizacion+'&estado_vigente_0=adjudicado&m_id_proceso_compra='+maestro.id_proceso_compra;
								Ext.Ajax.request({url:direccion+"../../../control/cotizacion/ActionGuardarCotizacion.php",
								params:data,
								method:'GET',
								success:finalizado,
								failure:CM_conexionFailure,
								timeout:100000000});
								
								
							
						}
					}else{
						Ext.MessageBox.alert('Estado', 'No se adjudic� ningun detalle a�n')
					}
						
				}else{
					Ext.MessageBox.alert('Estado', 'El registro ya est� '+SelectionsRecord.data.estado_vigente);
				}
			}else{
				Ext.MessageBox.alert('Estado', 'La adjudicaci�n para la cotizaci�n ya fu� finalizada')
			}
		}
		else{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
		}
	}
	
	
	function finalizado(resp){
		if(resp.responseXML!=undefined && resp.responseXML!=null&& resp.responseXML.documentElement!=null &&resp.responseXML.documentElement!=undefined){
			var root=resp.responseXML.documentElement;
						
			if((root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue)>0){
				  	Ext.MessageBox.alert('Estado',mensaje);
				  	ds.load({
						params:{
							start:0,
							limit: paramConfig.TamanoPagina,
							CantFiltros:paramConfig.CantFiltros,
							m_id_proceso_compra:maestro.id_proceso_compra,
							proceso_adj:'si'
						}
					});
		 	}
		}
	}
	
		function verificarCotizacion(){
			
			Ext.Ajax.request({
			   url:direccion+"../../../control/cotizacion/ActionListarCotizacion.php?m_id_proceso_compra="+maestro.id_proceso_compra,
			   method:'GET',
			   success:verificar,
			   failure:CM_conexionFailure,
			   timeout:100000000
			})
		}
		
		function verificar(resp){
			
			
			if(resp.responseXML!=undefined && resp.responseXML!=null&& resp.responseXML.documentElement!=null &&resp.responseXML.documentElement!=undefined){
				var root=resp.responseXML.documentElement;
				num_cotizaciones=root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue;
				
				
				if(on==0){
					
				  if((root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue)>0){
				  	
				  	 CM_ocultarComponente(getComponente('fecha_venc'));
				  	 getComponente('fecha_venc').allowBlank=true;
				  	 getComponente('lugar_entrega').setValue(root.getElementsByTagName('lugar_entrega')[0].firstChild.nodeValue);
				  	 getComponente('lugar_entrega').disable();
				  	
				  }else{
				  	 CM_mostrarComponente(getComponente('fecha_venc'));
				  	 getComponente('lugar_entrega').setValue('');
				  	 getComponente('lugar_entrega').enable();
				  	 getComponente('lugar_entrega').allowBlank=false;
				  }
				}
				
			}
		}
		
		
	
			
	
		
	//Para manejo de eventos
	function iniciarEventosFormularios(){	
	    mensaje='';
		txt_id_moneda_base=getComponente('id_moneda_base');
		//para iniciar eventos en el formulario
		txt_fecha=getComponente('fecha_cotizacion');
		cmbMoneda=getComponente('id_moneda');
		//ds_proveedor.baseParams={tipo_adq:maestro.tipo_adq, id_proceso_compra:maestro.id_proceso_compra};
	 	num_cotizaciones=0;
	 	on=0;
	}
	this.EnableSelect=function(x,z,y){
		   enable(x,z,y)
	}
	
     function salta(){
       ContenedorPrincipal.getPagina(idContenedorPadre).pagina.btnActualizar();
	}
	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_proceso_adjudicacion_det.getLayout()};
	//para el manejo de hijos
	
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	this.InitFunciones(paramFunciones);
	//para agregar botones

		this.AdicionarBoton('../../../lib/imagenes/cancel.png','Anular',btn_anular_cotizacion,true,'anular','Anular Cotizacion');
        this.AdicionarBoton('../../../lib/imagenes/ok.png','Adjudicacion',btn_adjudicacion,true,'adjudicacion','Adjudicar');
		this.AdicionarBoton('../../../lib/imagenes/detalle.png','Detalle de Adjudicacion',btn_adjudicacion_det,true,'adjudicacion_det','Adjudicar Detalle');
		
		this.AdicionarBoton('../../../lib/imagenes/book_next.png','Finalizar Adjudicacion',btn_fin_adjud,true,'finalizar_adjudicacion','Fin Adjudicacion');

		var CM_getBoton=this.getBoton;
	       
	
        	function  enable(sel,row,selected){
        		var record=selected.data; 
        			if(selected&&record!=-1){
        			  
        			  
        			    CM_getBoton('anular-'+idContenedor).enable();
    	                CM_getBoton('adjudicacion_det-'+idContenedor).enable();
    	                CM_getBoton('finalizar_adjudicacion-'+idContenedor).enable();
    	                CM_getBoton('adjudicacion-'+idContenedor).enable();
    	                if(maestro.ejecutado=='no'){
    	                   if(record.estado_vigente=='en_pago' || record.estado_vigente=='finalizado'){
        	                    CM_getBoton('adjudicacion_det-'+idContenedor).disable();
        	                    CM_getBoton('adjudicacion-'+idContenedor).disable();
            	                CM_getBoton('finalizar_adjudicacion-'+idContenedor).disable();
            	                CM_getBoton('anular-'+idContenedor).disable();
        	                }else{
        	                    if(record.estado_vigente=='anulado' ||record.estado_vigente=='invitado'||record.estado_vigente=='aperturado'||record.estado_vigente=='orden_compra'){
                					CM_getBoton('adjudicacion_det-'+idContenedor).disable();
                					CM_getBoton('adjudicacion-'+idContenedor).disable();
                	                CM_getBoton('finalizar_adjudicacion-'+idContenedor).disable();
                	                
        	                        if(record.estado_vigente=='anulado' || record.estado_vigente=='orden_compra'){
                					  CM_getBoton('anular-'+idContenedor).disable();  
                					}else{
                					    CM_getBoton('anular-'+idContenedor).enable();
                					}
                				}else{
                				  //  if(record.se_adjudica=='true'){
                				        if(record.estado_vigente=='adjudicado'){
                    				       CM_getBoton('adjudicacion_det-'+idContenedor).disable();
                    				       CM_getBoton('adjudicacion-'+idContenedor).disable();
                    	                   CM_getBoton('finalizar_adjudicacion-'+idContenedor).disable();
                    	                   CM_getBoton('anular-'+idContenedor).enable();
                    				    }else{
                    				        if(parseFloat(record.cantidad_sol)>parseFloat(record.num_detalle_adjudicado_gral)){
                    				             CM_getBoton('adjudicacion_det-'+idContenedor).enable();
                    				             CM_getBoton('adjudicacion-'+idContenedor).enable();
                    	                         CM_getBoton('finalizar_adjudicacion-'+idContenedor).enable();
                    	                         CM_getBoton('anular-'+idContenedor).enable();  
                    				        }else{
                    				            if(parseFloat(record.cantidad_sol)!=parseFloat(record.num_detalle_adjudicado)){
                    				                alert('Ya se adjudic� el total de lo solicitado');
                    				            }
                    				        }
                    				    }
                				  /*  }else{
                				        CM_getBoton('adjudicacion_det-'+idContenedor).disable();
                    	                CM_getBoton('finalizar_adjudicacion-'+idContenedor).disable();
                    	                CM_getBoton('anular-'+idContenedor).enable();
                				    }*/
                				}
        	                }
    	                }else{
    	                    CM_getBoton('adjudicacion_det-'+idContenedor).disable();
                    	    CM_getBoton('finalizar_adjudicacion-'+idContenedor).disable();
                    	    CM_getBoton('anular-'+idContenedor).enable();
                    	    CM_getBoton('adjudicacion-'+idContenedor).disable();
    	                }
        			}
        			enableSelect(sel,row,selected);
        		}
	
		
	this.iniciaFormulario();
	
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros,
			m_id_proceso_compra:maestro.id_proceso_compra,
			proceso_adj:'si'
		}
	});
	
	iniciarEventosFormularios();
	layout_proceso_adjudicacion_det.getLayout().addListener('layout',this.onResize);
	layout_proceso_adjudicacion_det.getVentana().addListener('beforehide',salta);
	ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario);
	
}
