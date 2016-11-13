/**
* Nombre:		  	    pagina_cotizacion_det.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
* Fecha creaci�n:		2008-05-28 17:32:15
*/


function pagina_plan_pago(idContenedor,direccion,paramConfig,idContenedorPadre)
{
	var Atributos=new Array,sw=0;
	var sw_grup=true,gridG,gSm,id_SCD,ds_g,gDlg;
	var cantidad=0;
	var adj=0;
	var bandera=false;
	var  num_pago=0, maestro;
	var retencion_original;

	var habilita_fin_pagoI;
	var cant_pagosI;
	var id_cotizacionI;
	var txt_precio,txt_falta_pagar,	txt_num_pagos,txt_fecha_pago,txt_fecha_pagado,txt_tipo_pago,txt_gestion,txt_tipo_plantilla,txt_monto_original;
	var p_consultores=0;
	var total_aa;
	var total_as;	
	var total_adj;
	/////////////////
	//  DATA STORE //
	/////////////////
	var ds = new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/plan_pago/ActionListarPlanPago.php'}),
		reader: new Ext.data.XmlReader({
			record: 'ROWS',id:'id_plan_pago',totalRecords:'TotalCount'
		},[
		'id_plan_pago',
		'tipo_pago',
		'nro_cuota',
		{name: 'fecha_pago',type:'date',dateFormat:'Y-m-d'},
		'monto',
		'estado',
		'desc_cotizacion',
		'id_cotizacion','precio_total','monto_a_pagar','cuota_a_pagar','pagado','falta_pagar', 'num_pagos',{name: 'fecha_pagado',type:'date',dateFormat:'Y-m-d'},'estado_vigente','num_factura','observaciones',
		'boleta_garantia','num_autoriza_factura','cod_control_factura','id_gestion','gestion','obs_conta',
		{name: 'fecha_factura',type:'date',dateFormat:'Y-m-d'},
		'multas',
		 'cantidad_entregada',
		 'tipo_adq','pago_simplificado','impuestos','monto_original',
		 'retencion_bien','tipo_plantilla','desc_plantilla','id_cuenta_doc',
		 'motivo','por_anticipo','por_retgar','retencion','descuento_anticipo',
		 'monto_no_pagado','pago_integrado',{name: 'fecha_devengado',type:'date',dateFormat:'Y-m-d'},
		 'id_comprobante','id_comprobante_pago','id_planilla'

		]),remoteSort:true});

		var ds_tipo_plantilla = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_contabilidad/control/plantilla/ActionListarPlantilla.php'}),reader:new Ext.data.XmlReader({record:'ROWS',id:'tipo_plantilla',totalRecords: 'TotalCount'},['id_plantilla','tipo_plantilla','desc_plantilla'])});

		var ds_avance = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_tesoreria/control/cuenta_doc/ActionListarSolicitudViaticos2.php?tipo_cuenta_doc=solicitud_avance&estado_fa=pagado'}),reader:new Ext.data.XmlReader({record:'ROWS',id:'id_cuenta_doc',totalRecords: 'TotalCount'},['id_cuenta_doc','nro_documento','motivo','desc_empleado'])});

		//FUNCIONES RENDER


		var ds_gestion = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/gestion/ActionListarGestion.php'}),reader:new Ext.data.XmlReader({record:'ROWS',id:'id_gestion',totalRecords: 'TotalCount'},['id_gestion','id_empresa','id_moneda_base','gestion','estado_ges_gral'])});

		function render_id_gestion(value, p, record){return String.format('{0}', record.data['gestion']);}
		var tpl_id_gestion=new Ext.Template('<div class="search-item">','<b><i>{gestion}</i></b>','<br><FONT COLOR="#B5A642"><b>Estado: </b>{estado_ges_gral}</FONT>','</div>');

		function render_avance(value, p, record){return String.format('{0}', record.data['motivo']);}
		var tpl_id_avance=new Ext.Template('<div class="search-item">',
		'<span>Nro: {nro_documento}  </span></br>','<tt> Concepto: {motivo} </tt> ','Solicitante:{desc_empleado}<br/>',
		'</div>');


		function render_tipo_plantilla(value, p, record){return String.format('{0}', record.data['desc_plantilla']);}
		var tpl_tipo_plantilla=new Ext.Template('<div class="search-item">','<b><i>{desc_plantilla}</i></b>','</div>');


		///////////////////////
		// Definici�n de datos //
		/////////////////////////

		// hidden id_cotizacion_det
		//en la posici�n 0 siempre esta la llave primaria

		Atributos[0]={
			validacion:{
				labelSeparator:'',
				name: 'id_plan_pago',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'id_plan_pago'
		};
		// txt tipo_pago
		Atributos[1]={
			validacion:{
				name:'tipo_pago',
				fieldLabel:'Tipo de Pago',
				allowBlank:true,
				typeAhead:true,
				loadMask:true,
				triggerAction:'all',
				store:new Ext.data.SimpleStore({
					fields:['ID', 'valor'],
					data:Ext.plan_pago_combo.tipo_pago
				}),
				valueField:'ID',
				displayField:'valor',
				lazyRender:true,
				forceSelection:true,
				grid_visible:true,
				grid_indice:4,
				width_grid:75,
				grid_editable:false
			},
			tipo:'ComboBox',
			filtro_0:true,
			defecto:'normal',
			filterColValue:'plapag.tipo_pago',
			save_as:'tipo_pago',
			id_grupo:1
		};

		// txt nro_cuota
		Atributos[2]={
			validacion:{
				name:'nro_cuota',
				fieldLabel:'Cuota',
				allowBlank:false,
				maxLength:18,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:false,
				decimalPrecision:0,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:45,
				width:'60%',
				disabled:true,
				grid_indice:1
			},
			tipo: 'NumberField',
			form: true,
			filtro_0:true,
			filterColValue:'plapag.nro_cuota',
			save_as:'nro_cuota',
			id_grupo:1
		};


		Atributos[3]={
			validacion:{
				name:'monto_original',
				fieldLabel:'Monto',
				allowBlank:false,
				maxLength:18,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:55,
				width:'60%',
				disabled:false,
				grid_indice:2
			},
			tipo: 'NumberField',
			form: true,
			filtro_0:true,
			filterColValue:'plapag.monto_original',
			save_as:'monto_original',
			id_grupo:1
		};


		Atributos[4]={
			validacion:{
				name:'retencion',
				fieldLabel:'Retenci�n',
				allowBlank:false,
				maxLength:18,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,

				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:55,
				width:'60%',
				disabled:true,
				grid_indice:2
			},
			tipo: 'NumberField',
			form: true,
			filtro_0:false,
			save_as:'retencion_bien',
			id_grupo:1
		};


		// txt monto
		Atributos[5]={
			validacion:{
				name:'monto',
				fieldLabel:'Liquido Pagable',
				allowBlank:false,
				maxLength:18,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				width:'60%',
				disabled:true,
				grid_indice:3,
				align:'right'
			},
			tipo: 'NumberField',
			form: true,
			filtro_0:true,
			filterColValue:'plapag.monto',
			id_grupo:1
		};
		// txt fecha_pago
		Atributos[6]= {
			validacion:{
				name:'fecha_pago',
				fieldLabel:'Fecha Tentativa de Pago',
				allowBlank:false,
				format: 'd/m/Y', //formato para validacion
				minValue: '01/01/1900',
				disabledDaysText: 'D�a no v�lido',
				grid_visible:false,
				grid_editable:false,
				renderer: formatDate,
				width_grid:85,
				width:'60%',
				disabled:false,
				grid_indice:4
			},
			form:true,
			tipo:'DateField',
			filtro_0:true,
			filterColValue:'plapag.fecha_pago',
			dateFormat:'m-d-Y',
			defecto:'',
			save_as:'fecha_pago',
			id_grupo:1
		};

		// txt estado
		Atributos[7]={
			validacion: {
				name:'estado',
				fieldLabel:'Estado',
				allowBlank:false,
				typeAhead: true,
				loadMask: true,
				triggerAction: 'all',
				valueField:'ID',
				displayField:'valor',
				lazyRender:true,
				forceSelection:true,
				grid_visible:true,
				grid_editable:false,
				width_grid:65, // ancho de columna en el gris
				disabled:false,
				width:'60%',
				grid_indice:3
			},
			tipo: 'TextField',
			form: true,
			filtro_0:true,
			defecto:'pendiente',
			filterColValue:'plapag.estado',
			save_as:'estado',
			id_grupo:1
		};

		// txt id_cotizacion
		Atributos[8]={
			validacion:{
				labelSeparator:'',
				name: 'id_cotizacion',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'id_cotizacion',

			id_grupo:1
		};

		// txtprecio_total
		Atributos[9]={
			validacion:{
				name:'precio_total',
				fieldLabel:'Precio Total',
				allowBlank:false,
				maxLength:18,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:80,
				width:'60%',
				disabled:true,
				grid_indice:5
			},
			tipo: 'NumberField',

			filtro_0:true,
			filterColValue:'cotiza.precio_total',
			save_as:'precio_total',
			id_grupo:5
		};


		Atributos[10]={
			validacion:{
				name:'pagado',
				fieldLabel:'Pagado',
				allowBlank:false,
				maxLength:18,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:100,
				width:'60%',
				disabled:true,
				grid_indice:5
			},
			tipo: 'NumberField',
			filtro_0:false,
			id_grupo:5

		};


		Atributos[11]={
			validacion:{
				name:'falta_pagar',
				fieldLabel:'Falta Pagar',
				allowBlank:false,
				maxLength:18,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:100,
				width:'60%',
				disabled:true,
				grid_indice:5
			},
			tipo: 'NumberField',
			filtro_0:false,
			id_grupo:5
		};

		Atributos[12]={
			validacion:{
				name:'num_pagos',
				fieldLabel:'N� Pagos',
				allowBlank:false,
				maxLength:18,
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
				width:'60%',
				disabled:true,
				grid_indice:5
			},
			tipo: 'NumberField',
			filtro_0:false,
			id_grupo:0
		};


		Atributos[13]={
			validacion:{
				name:'cuota_a_pagar',
				fieldLabel:'Cuota a pagar',
				allowBlank:false,
				maxLength:18,
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
				width:'60%',
				disabled:true,
				grid_indice:5
			},
			tipo: 'NumberField',
			filtro_0:false,
			id_grupo:0
		};

		Atributos[14]= {
			validacion:{
				name:'fecha_pagado',
				fieldLabel:'Fecha de Pago',
				allowBlank:true,
				format: 'd/m/Y', //formato para validacion
				minValue: '01/01/1900',
				disabledDaysText: 'D�a no v�lido',
				grid_visible:true,
				grid_editable:false,
				renderer: formatDate,
				width_grid:85,
				disabled:false,
				width:'60%',
				grid_indice:6
			},
			form:true,
			tipo:'DateField',
			filtro_0:true,
			filterColValue:'plapag.fecha_pagado',
			dateFormat:'m-d-Y',
			defecto:'',
			save_as:'fecha_pagado',
			id_grupo:2
		};

		Atributos[15]={
			validacion:{
				name:'num_pago',
				fieldLabel:'N� Pago',
				allowBlank:false,
				maxLength:18,
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
				width:'45%',
				disabled:true,
				grid_indice:5
			},
			tipo: 'NumberField',
			filtro_0:false,
			id_grupo:0
		};


		Atributos[16]={
			validacion:{
				name:'estado_vigente',
				fieldLabel:'Estado Cotizacion',
				allowBlank:false,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:100,
				width:'45%',
				disable:false,
				grid_indice:3
			},
			tipo: 'TextField',
			form: false,
			filtro_0:false,
			id_grupo:0
		};

		/*
		Atributos[17]={//==> se usa
		validacion: {
		name:'impuestos',
		fieldLabel:'Impuesto',
		allowBlank:true,
		typeAhead:true,
		loadMask:true,
		triggerAction:'all',
		store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[[0,'Proforma de Factura'],[1,'Factura c/ IVA'],[2,'Factura s/ IVA'],[3,'Recibo sin Retencion'],[4,'Recibo Retencion Bienes']]}),
		valueField:'ID',
		displayField:'valor',
		lazyRender:true,
		forceSelection:true,
		grid_visible:true,
		grid_editable:true,
		width_grid:70,
		disable:false,
		grid_indice:13,
		renderer:impuesto
		},
		tipo:'ComboBox',
		form: true,
		filtro_0:false,
		filterColValue:'PLAPAG.impuestos',
		defecto:0,
		save_as:'impuestos',
		id_grupo:3
		};*/



		var fCol=new Array();
		var fVal=new Array();
		fCol[0]='PLANT.sw_compro';
		fVal[0]='1';




		Atributos[17]={
			validacion:{
				name:'tipo_plantilla',
				fieldLabel:'Tipo Documento',
				allowBlank:false,
				emptyText:'Documento...',
				desc: 'desc_plantilla',
				store:ds_tipo_plantilla,
				valueField: 'tipo_plantilla',
				displayField: 'desc_plantilla',
				queryParam: 'filterValue_0',
				filterCol:'PLANT.tipo_plantilla#PLANT.desc_plantilla',
				filterCols:fCol,
				filterValues:fVal,
				typeAhead:true,
				tpl:tpl_tipo_plantilla,
				forceSelection:true,
				mode:'remote',
				queryDelay:250,
				pageSize:100,
				minListWidth:'50%',
				grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_tipo_plantilla,
				align:'right',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				width:'50%',
				grid_indice:13
			},
			tipo:'ComboBox',
			form: true,
			filtro_0:true,
			filterColValue:'PLAPAG.tipo_plantilla',
			id_grupo:3
		};


		Atributos[18]={
			validacion:{
				name:'num_factura',
				fieldLabel:'N� Documento',
				allowBlank:true,
				maxLength:18,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:false,
				decimalPrecision:0,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:85,
				width:'60%',
				disabled:false,
				grid_indice:7
			},
			tipo: 'NumberField',
			form: true,
			filtro_0:true,
			filterColValue:'plapag.num_factura',
			save_as:'num_factura',
			id_grupo:3
		};


		Atributos[19]={
			validacion:{
				name:'observaciones',
				fieldLabel:'Observaciones',
				allowBlank:true,
				maxLength:50000,
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
			tipo: 'TextArea',
			form: true,
			filtro_0:false,
			id_grupo:2
		};

		Atributos[20]={
			validacion:{
				name:'boleta_garantia',
				fieldLabel:'Boleta de Garantia',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:105,
				width:'100%',
				disable:false,
				grid_indice:6
			},
			tipo: 'TextArea',
			form: true,
			filtro_0:false,
			id_grupo:4
		};

		Atributos[21]={
			validacion:{//==>NO
				name:'num_autoriza_factura',
				fieldLabel:'N� de Autorizaci�n',
				allowBlank:true,
				maxLength:15,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:false,
				decimalPrecision:0,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:110,
				width:'60%',
				disabled:false,
				grid_indice:8
			},
			tipo: 'NumberField',
			form: true,
			save_as:'num_autoriza_factura',
			filtro_0:false,
			id_grupo:0
		};

		Atributos[22]={//==> SI
			validacion:{
				name:'cod_control_factura',
				fieldLabel:'Codigo de Control',
				allowBlank:true,
				maxLength:20,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:false,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:110,
				width:'60%',
				disabled:false,
				grid_indice:9
			},
			tipo: 'TextField',
			form: true,
			filtro_0:false,
			save_as:'cod_control_factura',
			id_grupo:0 //1
		};


		Atributos[23]= {
			validacion:{
				name:'fecha_factura',
				fieldLabel:'Fecha Documento',
				allowBlank:true,
				format: 'd/m/Y', //formato para validacion
				minValue: '01/01/1900',
				disabledDaysText: 'D�a no v�lido',
				grid_visible:true,
				grid_editable:false,
				renderer: formatDate,
				width_grid:97,
				disabled:false,
				grid_indice:10
			},
			form:true,
			tipo:'DateField',
			filtro_0:false,
			filterColValue:'COTIZA.fecha_factura',
			dateFormat:'m-d-Y',
			defecto:' ',
			save_as:'fecha_factura',
			id_grupo:3
		};

		Atributos[24]={
			validacion:{
				name:'multas',
				fieldLabel:'Multas',
				allowBlank:true,
				maxLength:18,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,

				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:55,
				width:'30%',
				disabled:false,
				grid_indice:2
			},
			tipo: 'NumberField',
			form: true,
			defecto:0,
			filtro_0:false,
			filterColValue:'plapag.multas',
			save_as:'multas',
			id_grupo:1
		};


		Atributos[25]={
			validacion:{
				labelSeparator:'',
				name: 'pago_simplificado',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			defecto:0,
			save_as:'pago_simplificado'
		};

		Atributos[26]={
			validacion:{
				labelSeparator:'',
				name: 'id_proceso_compra',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			defecto:0,
			save_as:'id_proceso_compra'
		};

		Atributos[27]={
			validacion:{
				name:'id_gestion',
				fieldLabel:'Gesti�n',
				allowBlank:false,
				emptyText:'Gesti�n...',
				desc: 'gestion', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_gestion,
				valueField: 'id_gestion',
				displayField: 'gestion',
				queryParam: 'filterValue_0',
				filterCol:'GESTI.gestion',
				typeAhead:true,
				tpl:tpl_id_gestion,
				forceSelection:true,
				mode:'remote',
				queryDelay:250,
				pageSize:100,
				minListWidth:'50%',
				grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_id_gestion,
				align:'right',
				grid_visible:true,
				grid_editable:false,
				width_grid:65,
				width:'50%',
				disabled:false,
				grid_indice:1
			},
			tipo:'ComboBox',
			form: true,
			filtro_0:true,
			filterColValue:'GESTI.gestion',
			save_as:'id_gestion',
			id_grupo:1
		};

		Atributos[28]={
			validacion:{
				name:'obs_conta',
				label: 'Observaciones Contabilidad',
				grid_visible:true,
				grid_editable:false
			},
			tipo: 'TextArea',
			filtro_0:true,
			filterColValue:'plapag.obs_conta',
			form:false,
			save_as:'obs_conta'
		};
				
		Atributos[29]={
			validacion:{
				name:'id_cuenta_doc',
				fieldLabel:'Fondo en Avance',
				allowBlank:false,
				emptyText:'Fondo...',
				desc: 'motivo', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_avance,
				valueField: 'id_cuenta_doc',
				displayField: 'motivo',
				queryParam: 'filterValue_0',
				filterCol:'CUDOC.motivo,CUDOC.nro_documento',
				typeAhead:true,
				tpl:tpl_id_avance,
				forceSelection:true,
				mode:'remote',
				queryDelay:250,
				pageSize:100,
				minListWidth:'50%',
				grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_avance,
				align:'right',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				width:'50%',
				disabled:false,
				grid_indice:6
			},
			tipo:'ComboBox',
			form: true,
			save_as:'id_cuenta_doc',
			id_grupo:6
		};

		
		Atributos[30]={
			validacion:{
				name:'por_anticipo',
				fieldLabel: '% Anticipo',
				grid_visible:true,
				grid_editable:false
			},
			tipo: 'TextField',
			filtro_0:true,
			filterColValue:'plapag.por_anticipo',
			form:true,
			save_as:'por_anticipo',
			id_grupo:5
			
		};

		
		Atributos[31]={
			validacion:{
				name:'por_retgar',
				fieldLabel: '% Garantia',
				grid_visible:true,
				grid_editable:false
			},
			tipo: 'TextField',
			filtro_0:true,
			filterColValue:'plapag.por_retgar',
			form:true,
			save_as:'por_retgar',
			id_grupo:5
		};
		
	
		Atributos[32]={
			validacion:{
				name:'descuento_anticipo',
				fieldLabel: 'Dcto. Anticipo',
				grid_visible:true,
				grid_editable:false,
				allowDecimals:true,
				allowNegative:false
			},
			tipo: 'NumberField',
			filtro_0:true,
			filterColValue:'plapag.descuento_anticipo',
			form:true,
			save_as:'descuento_anticipo',
			id_grupo:2
		};
		
		
		Atributos[33]={
			validacion:{
				name:'total_dcto_anticipo',
				labelSeparator:'',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'total_dcto_anticipo'
			
		};
		
		Atributos[34]={
			validacion:{
				name:'monto_no_pagado',
				fieldLabel:'Importe No Pagado',
				allowBlank:true,
				maxLength:18,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				width:'60%',
				disabled:false,
				grid_indice:2,
				align:'right'
			},
			tipo: 'NumberField',
			defecto:0,
			form: true,
			filtro_0:true,
			filterColValue:'plapag.monto_no_pagado',
			id_grupo:1
		};
		
		Atributos[35]={
			validacion:{
				labelSeparator:'',
				name: 'accion',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'accion'
		};
		Atributos[36]= {
			validacion:{
				name:'fecha_devengado',
				fieldLabel:'Fecha Devengado',
				allowBlank:true,
				format: 'd/m/Y', //formato para validacion
				minValue: '01/01/1900',
				disabledDaysText: 'D�a no v�lido',
				grid_visible:true,
				grid_editable:false,
				renderer: formatDate,
				width_grid:85,
				disabled:false,
				width:'60%',
				grid_indice:6
			},
			form:true,
			tipo:'DateField',
			filtro_0:true,
			filterColValue:'plapag.fecha_devengado',
			dateFormat:'m-d-Y',
			defecto:'',
			save_as:'fecha_devengado',
			id_grupo:2
		};
		
		
		//----------- FUNCIONES RENDER

		function formatDate(value){return value?value.dateFormat('d/m/Y'):''};

		function impuesto(val,cell,record,row,colum,store){
			if(val==0){
				return 'Proforma de Factura';
			}
			if(val==1){
				return 'Factura c/ IVA';
			}
			if(val==2){
				return 'Factura s/IVA';
			}
			if(val==3){
				return 'Recibo sin retencion';
			}
			if(val==4){
				return 'Recibo con retencion Bien';
			}else{
				return 'Recibo con retencion Servicio';
			}
		};
		//---------- INICIAMOS LAYOUT DETALLE
		var config={titulo_maestro:'Detalle - Orden de Compra',grid_maestro:'grid-'+idContenedor};
		layout_plan_pago= new DocsLayoutMaestro(idContenedor,idContenedorPadre);
		layout_plan_pago.init(config);

		//---------- INICIAMOS HERENCIA
		this.pagina = Pagina;
		this.pagina(paramConfig,Atributos,ds,layout_plan_pago,idContenedor);
		var getComponente=this.getComponente;
		var getSelectionModel=this.getSelectionModel;
		var CM_btnNew=this.btnNew;
		var CM_btnEdit=this.btnEdit;
		var CM_ocultarGrupo=this.ocultarGrupo;
		var CM_mostrarGrupo=this.mostrarGrupo;
		var CM_ocultarComponente=this.ocultarComponente;
		var CM_mostrarComponente=this.mostrarComponente;
		var Cm_conexionFailure=this.conexionFailure;
		var CM_btnEliminar=this.btnEliminar;
		var CM_saveSuccess=this.saveSuccess;
		var getDialog=this.getDialog;
		var EstehtmlMaestro=this.htmlMaestro;
		var getGrid=this.getGrid;
		var enableSelect=this.EnableSelect;
		//DEFINICI�N DE LA BARRA DE MEN�
		var paramMenu={
			/*nuevo:{crear:true,separador:true},
			eliminar:{crear:true,separador:false},*/
			actualizar:{crear:true,separador:false}
		};
		//DEFINICI�N DE FUNCIONES

		var paramFunciones={
			btnEliminar:{url:direccion+'../../../control/plan_pago/ActionEliminarPlanPago.php',parametros:'&m_id_cotizacion='+Atributos[8]},
			Save:{url:direccion+'../../../control/plan_pago/ActionGuardarPlanPago.php',parametros:'&m_id_cotizacion='+Atributos[8], success:miSuccess},
			ConfirmSave:{url:direccion+'../../../control/plan_pago/ActionGuardarPlanPago.php',parametros:'&m_id_cotizacion='+Atributos[8]},
			Formulario:{html_apply:'dlgInfo-'+idContenedor,height:450,width:780,minWidth:'25%',minHeight:222,columnas:['47%','47%'],	closable:true,titulo:'Detalle de Pagos',
			grupos:[{
				tituloGrupo:'Oculto',
				columna:0,
				id_grupo:0
			},
			{
				tituloGrupo:'Datos de Pago',
				columna:0,
				id_grupo:1
			},
			{
				tituloGrupo:'Pagos',
				columna:1,
				id_grupo:2
			},{
				tituloGrupo:'Datos Factura',
				columna:1,
				id_grupo:3
			},{
				tituloGrupo:'Datos Boleta de Garantia',
				columna:1,
				id_grupo:4
			},
			{
				tituloGrupo:'Total a Pagar',
				columna:1,
				id_grupo:5
			},
			{
				tituloGrupo:'Fondos en Avance',
				columna:1,
				id_grupo:6
			}]}
		};


		//-------------- Sobrecarga de funciones --------------------//
		this.reload=function(m){
			maestro=m;
			
			//getComponente('total_aa').setValue(maestro.total_aa);
			ds.lastOptions={
				params:{
					start:0,
					limit: paramConfig.TamanoPagina,
					CantFiltros:paramConfig.CantFiltros,
					m_id_cotizacion:maestro.id_cotizacion
				}
			};
			
			if(parseFloat(maestro.prox_pago)>0){
				p_consultores=1;
			}else{
				p_consultores=0;
			}
			this.btnActualizar();
			id_cotizacionI=maestro.id_cotizacion;
			Atributos[26].defecto=maestro.id_proceso_compra;
			Atributos[8].defecto=maestro.id_cotizacion;
			Atributos[33].defecto=maestro.total_dcto_anticipo;
			
			if(parseFloat(maestro.tipo_plantilla)>0){
				Atributos[17].defecto=maestro.tipo_plantilla;
			}else{
				Atributos[17].defecto=maestro.tipo_documento;
			}
			Atributos[18].defecto=maestro.num_factura;
			ds_gestion.baseParams={
				tipo_vista:'plan_pago',
				sgte_gestion:maestro.habilita_otra_gestion
			}

			cant_pagosI=maestro.num_pagos;
			
			if(maestro.num_pagos==maestro.cant_pagos_def){
				if(parseFloat(maestro.por_adelanto)>0){
					if(maestro.estado_adelanto=='pagado'){
					   habilita_fin_pagoI='si';
					}else{
					   habilita_fin_pagoI='sino';
					}
				}else{
					habilita_fin_pagoI='si';
				}
			}else{
				habilita_fin_pagoI='no';
			}
			
			total_aa=maestro.total_aa;
			total_as=maestro.total_as;
			total_adj=maestro.precio_total_adjudicado;
			//alert(maestro.tipo_pago+"");
			/*if(maestro.estado_vigente=='formulacion_pp'){
				CM_getBoton('rev_pagos-'+idContenedor).enable();
			}
			else{
				alert(maestro.estado_vigente);
				CM_getBoton('rev_pagos-'+idContenedor).disable();
			}*/

			paramFunciones.btnEliminar.parametros='&m_id_cotizacion='+maestro.id_cotizacion;
			paramFunciones.Save.parametros='&m_id_cotizacion='+maestro.id_cotizacion;
			paramFunciones.ConfirmSave.parametros='&m_id_cotizacion='+maestro.id_cotizacion;
			//iniciarEventosFormularios();
			this.iniciarEventosFormularios;
			this.InitFunciones(paramFunciones)
		};

		//Para manejo de eventos
		function iniciarEventosFormularios(){

			//para iniciar eventos en el formulario
			var txt_monto=getComponente('monto');

			txt_precio=getComponente('precio_total');
			txt_falta_pagar=getComponente('falta_pagar');
			txt_num_pagos=getComponente('num_pagos');
			txt_fecha_pago=getComponente('fecha_pago');
			txt_fecha_pagado=getComponente('fecha_pagado');
			txt_tipo_pago=getComponente('tipo_pago');
			txt_gestion=getComponente('id_gestion');
			txt_tipo_plantilla=getComponente('tipo_plantilla');
			txt_monto_original=getComponente('monto_original');

			
/*
			var verificarMonto=function(e){
				if(parseFloat(txt_monto_original.getValue())>parseFloat(txt_falta_pagar.getValue())){
					txt_monto_original.markInvalid('Monto a pagar no puede ser mayor a '+txt_falta_pagar.getValue());
				}else{
					var retencion_b=0;
					getComponente('monto').setValue(getComponente('monto_original').getValue()-retencion_b);
				}


			}*/

			//rac: comentamos momentanemamente esta funcion y su llamada


			var calcularRetencion=function(x){
				
				Ext.Ajax.request({
					url:direccion+"../../../../sis_contabilidad/control/plantilla/ActionCalculaSujetoLiquido.php",
					params:{ "importe":txt_monto_original.getValue(),
					         "tipo_documento":x.getValue(),
					         "sw_sujeto_liquido":2},
					method:'GET',
					success:calcularRetencionSuccess,
					failure:Cm_conexionFailure,
					timeout:100000000
				})
			}
 
			var calcularRetencionSuccess=function(resp){

			
				var regreso = Ext.util.JSON.decode(resp.responseText)
		        var retencion = getComponente('monto_original').getValue() - regreso.importe;
				getComponente('retencion').setValue(retencion);
				getComponente('monto').setValue(regreso.importe);
			}




			//txt_monto_original.on('change',verificarMonto);
			//txt_monto.on('change',verificarMonto);



			txt_tipo_plantilla.on('change',calcularRetencion);
			
			var calcularDcto=function(e,n,o){
	
				if((parseFloat(n)+parseFloat(maestro.total_dcto_anticipo))>parseFloat(maestro.monto_adelanto_moneda_cotizada)){
					alert("El importe maximo debe ser "+(parseFloat(maestro.monto_adelanto_moneda_cotizada)-parseFloat(maestro.total_dcto_anticipo)));
					getComponente('descuento_anticipo').setValue(o);
					//getComponente('por_anticipo').setValue(0);
				}else{
					getComponente('por_anticipo').setValue(n/getComponente('monto').getValue()*100);
				}
			}
			
			getComponente('descuento_anticipo').on('change',calcularDcto);
			
			
			var porAnticipo=function(e,n,o){
				
				if(n>0){
					
				 	getComponente('descuento_anticipo').setValue(getComponente('monto').getValue()*n/100);
					if((parseFloat(getComponente('descuento_anticipo').getValue())+parseFloat(maestro.total_dcto_anticipo))>parseFloat(maestro.monto_adelanto_moneda_cotizada)){
						alert("El importe maximo debe ser "+(parseFloat(maestro.monto_adelanto_moneda_cotizada)-parseFloat(maestro.total_dcto_anticipo)));
						getComponente('por_anticipo').setValue(o);
						getComponente('descuento_anticipo').setValue(getComponente('monto').getValue()*o/100);
					}
				}else{
					getComponente('descuento_anticipo').setValue(0);
				}
			}
			
			getComponente('por_anticipo').on('change',porAnticipo)
			gridG=getGrid();


			var onTipoPago=function(e){
				
				if(maestro.factura_total=='no'){
					if(e.value=='normal'){
						CM_ocultarGrupo('Datos Boleta de Garantia');
						CM_mostrarGrupo('Datos Factura');
						getComponente('num_factura').allowBlank=false;
						getComponente('num_autoriza_factura').allowBlank=true;
						getComponente('fecha_factura').allowBlank=false;
						getComponente('boleta_garantia').allowBlank=true;

						getComponente('boleta_garantia').clearInvalid();
					}else{
						CM_mostrarGrupo('Datos Boleta de Garantia');
						CM_ocultarGrupo('Datos Factura');
						getComponente('num_factura').allowBlank=true;
						getComponente('num_autoriza_factura').allowBlank=true;
						getComponente('fecha_factura').allowBlank=true;
						getComponente('boleta_garantia').allowBlank=false;

						getComponente('fecha_factura').clearInvalid();
						getComponente('num_factura').clearInvalid();
						getComponente('num_autoriza_factura').clearInvalid();

					}
				}else{
					CM_ocultarGrupo('Datos Factura');
					CM_ocultarGrupo('Datos Boleta de Garantia');
					getComponente('fecha_factura').clearInvalid();
					getComponente('num_factura').clearInvalid();
					getComponente('num_autoriza_factura').clearInvalid();
					getComponente('boleta_garantia').clearInvalid();
				}
			}
			//txt_tipo_pago.on('select',onTipoPago);
			//txt_tipo_pago.on('change',onTipoPago);


		}



		this.btnNew=function(){
			
			CM_btnNew();
			
			CM_ocultarGrupo('Oculto');

			CM_mostrarGrupo('Datos de Pago');
			CM_mostrarGrupo('Total a Pagar');
			CM_ocultarGrupo('Pagos');
			
			CM_ocultarGrupo('Datos Boleta de Garantia');
			CM_ocultarGrupo('Datos Factura');
			CM_ocultarGrupo('Fondos en Avance');
			
			//CM_mostrarComponente(getComponente('por_anticipo'));
			//CM_mostrarComponente(getComponente('por_retgar'));
			
			getComponente('num_factura').allowBlank=true;
			getComponente('id_cuenta_doc').allowBlank=true;

			getComponente('observaciones').allowBlank=true;

			txt_tipo_plantilla.disable();

			getComponente('estado').disable();

			CM_ocultarComponente(getComponente('fecha_pagado'));
			CM_ocultarComponente(getComponente('monto_no_pagado'));

			getComponente('fecha_pagado').allowBlank=true;

			getComponente('fecha_pago').allowBlank=false;
			getComponente('fecha_pago').enable();

			getComponente('tipo_pago').enable();
			getComponente('num_autoriza_factura').allowBlank=true;
			getComponente('fecha_factura').allowBlank=true;
			getComponente('id_gestion').enable();
			
			//RAC:para ver desbloque ar el boton en cada new
			txt_monto_original.enable();
			
			CM_ocultarComponente(getComponente('multas'));
			var dialog=getDialog();
			dialog.buttons[0].setText('Guardar');

			_CP.loadingShow();
			
			Ext.Ajax.request({
				url:direccion+"../../../control/plan_pago/ActionListarPlanPagoCuota.php?m_id_cotizacion="+maestro.id_cotizacion,
				method:'GET',
				success:verificar,
				failure:Cm_conexionFailure,
				timeout:100000000
			});


			function verificar(resp){
				Ext.MessageBox.hide();
				if(resp.responseXML!=undefined && resp.responseXML!=null&& resp.responseXML.documentElement!=null &&resp.responseXML.documentElement!=undefined){
					var root=resp.responseXML.documentElement;

					if((root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue)>0){
						get_fecha_adq();
						CM_btnNew();
						if(parseFloat((root.getElementsByTagName('monto')[0].firstChild.nodeValue))>0 ){

							txt_fecha_pagado.setValue(root.getElementsByTagName('fecha_reg_cotizacion')[0].firstChild.nodeValue);
							txt_fecha_pago.minValue=txt_fecha_pagado.getValue();
							txt_fecha_pagado.setValue('');
							getComponente('por_anticipo').setValue(root.getElementsByTagName('por_anticipo')[0].firstChild.nodeValue);
							getComponente('por_retgar').setValue(root.getElementsByTagName('por_retgar')[0].firstChild.nodeValue);
							
							if(maestro.tipo_pago!='caja')	{
//							    if(parseFloat(root.getElementsByTagName('cuota_a_pagar')[0].firstChild.nodeValue)<2){
//									CM_mostrarComponente(getComponente('por_anticipo'));
//							  	}else{
//									CM_ocultarComponente(getComponente('por_anticipo'));
//							  	}
							}else{
//								CM_ocultarComponente(getComponente('por_retgar'));
//								CM_ocultarComponente(getComponente('por_anticipo'));
							}
							
							
								
							if((parseFloat(root.getElementsByTagName('cuota_a_pagar')[0].firstChild.nodeValue))>(parseFloat(root.getElementsByTagName('num_pagos')[0].firstChild.nodeValue))){

								getComponente('monto_original').disable();
								getDialog().hide();
								alert('Ya se complet� la definici�n de cuotas a pagar');

							}else{
								
								getComponente('num_pagos').setValue(root.getElementsByTagName('num_pagos')[0].firstChild.nodeValue);
								getComponente('cuota_a_pagar').setValue(root.getElementsByTagName('cuota_a_pagar')[0].firstChild.nodeValue);
	
								
								if(parseFloat(getComponente('cuota_a_pagar').getValue())<=1){
									
									if(parseFloat(getComponente('num_pagos'))>1){
										getComponente('tipo_pago').enable();
									}else{
										getComponente('tipo_pago').disable();
									}
									
								}else{
									
									getComponente('tipo_pago').disable();
								
								}
								var Dialog= getDialog();
								Dialog.show();}
						}

						if((root.getElementsByTagName('cuota_a_pagar')[0].firstChild.nodeValue)>(root.getElementsByTagName('num_pagos')[0].firstChild.nodeValue) &&(parseFloat(root.getElementsByTagName('falta_pagar')[0].firstChild.nodeValue)<=0)){

							getComponente('monto_original').disable();
							getDialog().hide();
						}

						getComponente('nro_cuota').setValue(root.getElementsByTagName('cuota_a_pagar')[0].firstChild.nodeValue);

						getComponente('precio_total').setValue(root.getElementsByTagName('precio_total')[0].firstChild.nodeValue);
						getComponente('pagado').setValue(root.getElementsByTagName('pagado')[0].firstChild.nodeValue);
						getComponente('falta_pagar').setValue(root.getElementsByTagName('falta_pagar')[0].firstChild.nodeValue);
						if(parseFloat(root.getElementsByTagName('falta_pagar')[0].firstChild.nodeValue)<parseFloat(root.getElementsByTagName('monto_a_pagar')[0].firstChild.nodeValue)){
							getComponente('monto_original').setValue(root.getElementsByTagName('falta_pagar')[0].firstChild.nodeValue);
						}
						else{
							getComponente('monto_original').setValue(root.getElementsByTagName('monto_a_pagar')[0].firstChild.nodeValue);

						}



						//RAC:Se quitan los campos de impuestos, y retenciones de bien u servicios

						getComponente('monto').setValue(getComponente('monto_original').getValue());
						getComponente('retencion').setValue(0);

						getComponente('por_anticipo').setValue(root.getElementsByTagName('por_anticipo')[0].firstChild.nodeValue);
						getComponente('por_retgar').setValue(root.getElementsByTagName('por_retgar')[0].firstChild.nodeValue);
						


					}
				}
			}
		}


		function miSuccess(resp){

			CM_saveSuccess(resp);
			if(getComponente('estado').getValue()=='pagado'){
				var data='m_id_plan_pago='+getComponente('id_plan_pago').getValue();
				window.open(direccion+'../../../control/cotizacion/reporte/ActionPDFSolicitudPago.php?'+data)
			}
			salta();
		}

		function btn_provisional(){
			var sm=getSelectionModel();
			var NumSelect=sm.getCount();
			if(NumSelect>0){
				var data='m_id_plan_pago='+getComponente('id_plan_pago').getValue();
				window.open(direccion+'../../../control/cotizacion/reporte/ActionPDFSolicitudPago.php?'+data)
			}
			else{
				alert('Antes debe seleccionar un item');
			}
		}

		function get_fecha_adq(){
			_CP.loadingShow('Cargando Fecha ...');
			
			
			Ext.Ajax.request({
				url:direccion+"../../../../sis_adquisiciones/control/parametro_adquisicion/ActionObtenerGestionAdq.php?id_empresa="+maestro.id_empresa,
				method:'GET',
				success:cargar_fecha_adq,
				failure:Cm_conexionFailure,
				timeout:100000000//TIEMPO DE ESPERA PARA DAR FALLO
			});
		}

		function cargar_fecha_adq(resp){
			  Ext.MessageBox.hide();
			if(resp.responseXML != undefined && resp.responseXML != null && resp.responseXML.documentElement != null && resp.responseXML.documentElement != undefined){
				var root = resp.responseXML.documentElement;
				if((root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue)>0){
					txt_fecha_pagado.setValue(root.getElementsByTagName('fecha')[0].firstChild.nodeValue);
					txt_fecha_pagado.setValue('');
				}
			}
		}

/*	this.btnEdit=function(){
			
			alert('ENTRA')
			
			var sm=getSelectionModel();
			var filas=ds.getModifiedRecords();
			var cont=filas.length;
			var NumSelect=sm.getCount();
			var SelectionsRecord=sm.getSelected();

			CM_ocultarGrupo('Oculto');
			CM_mostrarGrupo('Datos de Pago');
			CM_mostrarGrupo('Total a Pagar');
			CM_ocultarGrupo('Pagos');
			CM_ocultarGrupo('Datos Boleta de Garantia');
			CM_ocultarGrupo('Datos Factura');
			CM_ocultarComponente(getComponente('fecha_pagado'));
			getComponente('monto_original').enable();
			var dialog=getDialog();
			dialog.buttons[0].setText('Guardar');

			if(NumSelect>0){
				if(SelectionsRecord.data.estado=='pendiente'){
					CM_ocultarGrupo('Pagos');
					getComponente('fecha_pago').enable();
					getComponente('num_factura').allowBlank=true;
					getComponente('observaciones').allowBlank=true;
					txt_tipo_plantilla.enable();

				}else{
					CM_mostrarGrupo('Pagos');
					getComponente('fecha_pago').disable();
				}

				if(getComponente('estado').getValue()=='pendiente'){
					getComponente('estado').disable();

					if(getComponente('num_pagos').getValue()==getComponente('nro_cuota').getValue()){
						getComponente('monto_original').disable();
					}else{
						getComponente('monto_original').enable();
					}

					CM_btnEdit();
				}else{
					getComponente('monto_original').disable();
					getComponente('estado').disable();
					CM_btnEdit();
				}
			}else{
				alert('Antes debe seleccionar un item');
			}
		}

*/

		this.btnEliminar=function(){
			var sm=getSelectionModel();
			var filas=ds.getModifiedRecords();
			var cont=filas.length;
			var NumSelect=sm.getCount();
			var SelectionsRecord=sm.getSelected();

			if(SelectionsRecord.data.estado!='pendiente'){
				alert('solo pagos pendientes pueden eliminarse');
			}else{
				CM_btnEliminar();
				salta();
			}
		}


		function obtenerCuota(){
			_CP.loadingShow('Obteniendo Cuota ...');
			
			Ext.Ajax.request({
				url:direccion+"../../../control/plan_pago/ActionListarPlanPagoCuota.php?m_id_cotizacion="+maestro.id_cotizacion,
				method:'GET',
				success:verificar,
				failure:Cm_conexionFailure,
				timeout:100000000
			})
		}

		function btnDevengar(){
			getComponente('accion').setValue('devengar');
			pagarBtn();
			
		}
		function btnDevPagar(){
			getComponente('accion').setValue('devengar-pagar');
			pagarBtn();
		}
		function btnPagar(){
			getComponente('accion').setValue('pagar');
			CM_save();
		}

	
		function pagarBtn(){
			CM_ocultarGrupo('Oculto');
			//CM_ocultarGrupo('Total a Pagar');
			CM_mostrarGrupo('Pagos');
			CM_ocultarGrupo('Datos Boleta de Garantia');
			if(getComponente('accion').getValue()=='devengar'){
				CM_mostrarComponente(getComponente('fecha_devengado'));
				getComponente('fecha_devengado').allowBlank=false
			}
			else{
				CM_ocultarComponente(getComponente('fecha_devengado'));
				getComponente('fecha_devengado').allowBlank=true
				
			}
			//CM_ocultarGrupo('Datos Factura');
			getComponente('id_gestion').disable();
			txt_tipo_plantilla.enable();
			CM_mostrarComponente(getComponente('monto_no_pagado'));
			
			
			this.btnActualizar;
			var sm=getSelectionModel();
			var filas=ds.getModifiedRecords();
			var cont=filas.length;
			var NumSelect=sm.getCount();
			var SelectionsRecord=sm.getSelected();
			CM_ocultarComponente(getComponente('precio_total'));
			CM_ocultarComponente(getComponente('pagado'));
			CM_ocultarComponente(getComponente('falta_pagar'));
			if(NumSelect!=0){
				if(SelectionsRecord.data.estado!='anulado'){
					retencion_original=SelectionsRecord.data.retencion;
					getComponente('descuento_anticipo').setValue(SelectionsRecord.data.monto*SelectionsRecord.data.por_anticipo/100);
					if((parseFloat(maestro.monto_adelanto_moneda_cotizada)-(parseFloat(maestro.total_dcto_anticipo)+parseFloat(getComponente('descuento_anticipo').getValue())))<0){
						getComponente('descuento_anticipo').setValue(0);
						getComponente('por_anticipo').setValue(0);
					}
					
					getComponente('multas').maxValue=SelectionsRecord.data.monto;
					CM_mostrarComponente(getComponente('multas'));

					getComponente('tipo_pago').disable();
					if(maestro.tipo_pago=='avance' && (SelectionsRecord.data.id_cuenta_doc=='' || SelectionsRecord.data.id_cuenta_doc==undefined)){
						CM_mostrarGrupo('Fondos en Avance');
						getComponente('id_cuenta_doc').allowBlank=false;
						getComponente('id_cuenta_doc').modificado=true;
						ds_avance.baseParams={
							tipo:'plan_pago',id_cotizacion:maestro.id_cotizacion,id_depto:maestro.id_depto_tesoro
						}	
					}
					else{
						CM_ocultarGrupo('Fondos en Avance');
						getComponente('id_cuenta_doc').allowBlank=true;	
					}
					

					if(maestro.factura_total=='no'){
						if(SelectionsRecord.data.tipo_pago=='normal'){
							CM_mostrarGrupo('Datos Factura');
							getComponente('num_factura').allowBlank=false;
							getComponente('num_autoriza_factura').allowBlank=true;
							getComponente('boleta_garantia').allowBlank=true;
							CM_ocultarGrupo('Datos Boleta de Garantia');
							getComponente('boleta_garantia').clearInvalid();
						}else{
							CM_mostrarGrupo('Datos Boleta de Garantia');
							getComponente('num_factura').allowBlank=true;
							getComponente('num_autoriza_factura').allowBlank=true;
							getComponente('fecha_factura').allowBlank=true;
							CM_ocultarGrupo('Datos Factura');
							getComponente('num_factura').clearInvalid();
							getComponente('num_autoriza_factura').clearInvalid();
							getComponente('fecha_factura').clearInvalid();
						}
					}else{
						
					    if(parseFloat(maestro.tipo_plantilla)>0){
					    	getComponente('tipo_plantilla').setValue(maestro.tipo_plantilla);
					    }else{
							getComponente('tipo_plantilla').setValue(maestro.tipo_documento);
					    }
						getComponente('num_factura').setValue(maestro.num_factura);
					    getComponente('fecha_factura').setValue(maestro.fecha_factura);
						CM_ocultarGrupo('Datos Boleta de Garantia');
						CM_ocultarGrupo('Datos Factura');
						getComponente('num_factura').allowBlank=true;
						getComponente('num_autoriza_factura').allowBlank=true;
						getComponente('fecha_factura').allowBlank=true;
						getComponente('boleta_garantia').clearInvalid();
					}

					getComponente('observaciones').allowBlank=true;
					verificarNumPago();
				}
				else{
					alert('El pago fue anulado')
				}
			}
			else{
				alert('Antes debe seleccionar un item.')
			}
		}





		function verificarNumPago(){
			
			_CP.loadingShow('Verificando N�mero de Pago');
			
			
			Ext.Ajax.request({
				url:direccion+"../../../control/plan_pago/ActionListarNumPagos.php?m_id_cotizacion="+maestro.id_cotizacion,
				method:'GET',
				success:verificarPago,
				failure:Cm_conexionFailure,
				timeout:100000000
			})
		}

		function verificarPago(resp){
			if(resp.responseXML!=undefined && resp.responseXML!=null&& resp.responseXML.documentElement!=null &&resp.responseXML.documentElement!=undefined){


				//rac: comentado por que elcampo se eliminara
				//cmbImpuesto.setValue(0);

                 Ext.MessageBox.hide();

				var root=resp.responseXML.documentElement;
				var sm=getSelectionModel();
				var SelectionsRecord=sm.getSelected();
				var dialog=getDialog();
				dialog.buttons[0].setText('Efectuar Pago');
				getComponente('estado').disable();
				
					_CP.loadingShow('Obteniendo Fecha...');
					
					
				Ext.Ajax.request({
					
					url:direccion+"../../../../lib/lib_control/action/ActionObtenerFechaBD.php",
					method:'GET',
					success:function cargar_fecha_bd(resp1){
						
					  Ext.MessageBox.hide();

						if(resp1.responseXML != undefined && resp1.responseXML != null && resp1.responseXML.documentElement != null && resp1.responseXML.documentElement != undefined)
						{
							var root1 = resp1.responseXML.documentElement;
							getComponente('fecha_pagado').setValue(root1.getElementsByTagName('fecha')[0].firstChild.nodeValue);
						}
					},
					failure:Cm_conexionFailure,
					timeout:100000000//TIEMPO DE ESPERA PARA DAR FALLO
				});



				if((root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue)>0){
					getComponente('num_pago').setValue(root.getElementsByTagName('num_pago')[0].firstChild.nodeValue);

					if(SelectionsRecord.data.nro_cuota==parseFloat(getComponente('num_pago').getValue()+1)){
						getComponente('monto_original').disable();
						CM_mostrarComponente(getComponente('fecha_pagado'));
						getComponente('fecha_pago').disable();
						getComponente('fecha_pagado').allowBlank=false;
						getComponente('estado').setValue('devengado');
						getComponente('estado').disable();
						CM_mostrarComponente(getComponente('fecha_pagado'));
						CM_btnEdit();

					}else{
						if(SelectionsRecord.data.estado!='devengado'){
							alert('El pago a efectuar deberia ser el '+parseFloat(getComponente('num_pago').getValue()+1));
						}else{
							alert('Ya se procedi� con el pago');
						}
					}
				}else{if(parseFloat(SelectionsRecord.data.nro_cuota)==1){
					if(SelectionsRecord.data.tipo_pago=='normal'){
						if(SelectionsRecord.data.tipo_adq=='Bien'){

							pagar();

							alert('para efectuar el pago, es necesaria la entrega del total adjudicado');

						}else{
							pagar();
						}
					}else{
						pagar();
					}
				}else{
					alert('El pago a efectuar deberia ser el 1');
				}
				}
			}
		}

		function pagar(){

			if (maestro.estado_adelanto!='no'){
				
				   getComponente('descuento_anticipo').setValue((getComponente('monto').getValue()*maestro.por_adelanto)/100);			   
				   CM_mostrarComponente(getComponente('por_anticipo'));
				   getComponente('por_anticipo').setValue(maestro.por_adelanto);
				   getComponente('por_anticipo').allowBlank=false;
			}
			else{
				CM_ocultarComponente(getComponente('por_anticipo'));
				getComponente('por_anticipo').allowBlank=true;
			}
			CM_mostrarComponente(getComponente('fecha_pagado'));
			getComponente('fecha_pago').disable();
			getComponente('fecha_pagado').allowBlank=false;
			getComponente('monto_original').disable();
			getComponente('estado').setValue('devengado');
			CM_btnEdit();
		}




		
		function btn_reporte_comprobante(){
			var sm=getSelectionModel();
			var filas=ds.getModifiedRecords();
			var cont=filas.length;
			var NumSelect=sm.getCount();
			if(NumSelect!=0){
 			
 				
				var SelectionsRecord=sm.getSelected();
					if(SelectionsRecord.data.id_comprobante!=''){
						var data='m_id_comprobante='+SelectionsRecord.data.id_comprobante;
						    if(parseFloat(SelectionsRecord.data.id_planilla)>0){
						    	data=data+'&m_momento_cbte=3&m_id_moneda=1&m_desc_clases=COMPROBANTE DIARIO';
						    }else{
							data=data+'&m_vista=plan_pagos'}
				  			window.open(direccion+'../../../../sis_contabilidad/control/comprobante/reporte/ActionPDFComprobante.php?'+data)
					}
					else{
						Ext.MessageBox.alert('Estado', 'El plan de pagos no tiene un comprobante asociado.');
					}
			}
			else{
				Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
			}
		}
		
		
		function btn_reporte_comprobante_pago(){
			var sm=getSelectionModel();
			var filas=ds.getModifiedRecords();
			var cont=filas.length;
			var NumSelect=sm.getCount();
			if(NumSelect!=0){
 			
 				
				var SelectionsRecord=sm.getSelected();
					if(SelectionsRecord.data.id_comprobante_pago!=''){
						var data='m_id_comprobante='+SelectionsRecord.data.id_comprobante_pago;
						    data=data+'&m_momento_cbte=4&m_id_moneda=1&m_desc_clases=COMPROBANTE PAGO'
				  			window.open(direccion+'../../../../sis_contabilidad/control/comprobante/reporte/ActionPDFComprobante.php?'+data)
					}
					else{
						Ext.MessageBox.alert('Estado', 'El plan de pagos no tiene un comprobante asociado.');
					}
			}
			else{
				Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
			}
		}
	
		this.EnableSelect=function(x,z,y){
			enable(x,z,y)
		}

		function salta(){ 
			
			_CP.getPagina(idContenedorPadre).pagina.btnActualizar();

		ds.lastOptions={
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_cotizacion:maestro.id_cotizacion
			}
		};
		}

		//para que los hijos puedan ajustarse al tama�o
		this.getLayout=function(){return layout_plan_pago.getLayout()};
		//para el manejo de hijos

		this.Init(); //iniciamos la clase madre
		this.InitBarraMenu(paramMenu);
		this.InitFunciones(paramFunciones);
		//para agregar botones
		this.AdicionarBoton('../../../lib/imagenes/print.gif','Reporte de Solicitud de Pago',btn_provisional,true,'provisional','Sol. Pago');
		
		this.AdicionarBoton('../../../lib/imagenes/print.gif','Reporte de Comprobante',btn_reporte_comprobante,true,'comprobante','Comprobante de Diario');	
		
		this.AdicionarBoton('../../../lib/imagenes/print.gif','Reporte de Comprobante',btn_reporte_comprobante_pago,true,'comprobante_pago','Comprobante de Pago');	
		
		//this.AdicionarBoton('../../../lib/imagenes/menu-show.gif','Anular',btn_anular,true,'anular','Anular Pago');

		var CM_getBoton=this.getBoton;
		
		function  enable(sel,row,selected){
			var record=selected.data;
			if(selected&&record!=-1){

				if(maestro.estado_vigente=='orden_compra'){
					if(record.estado=='pendiente'){
						//CM_getBoton('eliminar-'+idContenedor).enable();
						CM_getBoton('provisional-'+idContenedor).disable();
						
						CM_getBoton('comprobante-'+idContenedor).disable();
					}else{
						//CM_getBoton('eliminar-'+idContenedor).disable();
						CM_getBoton('provisional-'+idContenedor).enable();
						if (record.id_comprobante==''){
							CM_getBoton('comprobante-'+idContenedor).disable();	
						}else
						{
							CM_getBoton('comprobante-'+idContenedor).enable();
						}
						
					}

				}else{
					if(record.estado=='pendiente'){
						
						//CM_getBoton('pagar-'+idContenedor).disable();
						CM_getBoton('provisional-'+idContenedor).disable();
						CM_getBoton('comprobante-'+idContenedor).disable();
					}else if(record.estado=='devengado_tesoro'){
						if (record.id_comprobante==''){
							CM_getBoton('comprobante-'+idContenedor).disable();	
						}else
						{
							CM_getBoton('comprobante-'+idContenedor).enable();
						}
						//CM_getBoton('provisional-'+idContenedor).enable();
						CM_getBoton('comprobante-'+idContenedor).enable();
						
					}
					else{
						if (record.id_comprobante==''){
							CM_getBoton('comprobante-'+idContenedor).disable();	
						}else
						{
							CM_getBoton('comprobante-'+idContenedor).enable();
						}
						//CM_getBoton('provisional-'+idContenedor).enable();
						CM_getBoton('comprobante-'+idContenedor).enable();
						
					}
				}
			}
			enableSelect(sel,row,selected);
		}
		this.iniciaFormulario();
		iniciarEventosFormularios();


		layout_plan_pago.getLayout().addListener('layout',this.onResize);
		ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario);

}