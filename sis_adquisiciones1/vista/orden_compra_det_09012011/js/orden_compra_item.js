/**
 * Nombre:		  	    pagina_orden_compra_det.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-05-28 17:32:05
 */
function pagina_orden_compra_item(idContenedor,direccion,paramConfig,maestro,idContenedorPadre)
{
	var Atributos=new Array,sw=0;
	var num_cotizaciones=0;
	var on=0;
	var pagina="";
	var bloquear='no';
	var componentes=new Array;
	var fin_rev=0; //bandera para finalizar o revertir pagos, para finalizar fin_rev=1, para revertir fin_rev=2
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
		'precio_total_adjudicado',
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
		{name: 'fecha_cotizacion',type:'date',dateFormat:'Y-m-d'},
		'categoria','num_pagos','precio_total_moneda_cotizada','todo_pagado','falta_anular','precio_total_adjudicado','numeracion_periodo','id_auxiliar','pago_completado','factura_total','num_autoriza_factura','cod_control_factura',{name: 'fecha_factura',type:'date',dateFormat:'Y-m-d'},'numeracion_oc','precio_total_adjudicado_con_impuestos','justificacion_adjudicacion','tipo_pago','id_caja','caja','id_cajero','cajero','avance','id_depto_tesoro','depto_tesoro','cant_pagos_def','habilita_otra_gestion','tipo_documento','desc_documento','por_adelanto','por_retgar','estado_adelanto','estado_retgar','avance_habilitado','nro_contrato','tiene_contrato','con_contrato','total_aa','total_as','monto_adelanto_moneda_cotizada','total_dcto_anticipo',
		{name: 'fecha_ini_ctto',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_fin_ctto',type:'date',dateFormat:'Y-m-d'},	
		'estado_devengado'
		]),remoteSort:true});

	//carga datos XML
	
	// DEFINICI�N DATOS DEL MAESTRO


	
	//DATA STORE COMBOS

 
		var ds_caja = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_tesoreria/control/caja/ActionListarCaja.php'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_caja',totalRecords: 'TotalCount'},['id_caja','desc_moneda','tipo_caja','desc_unidad_organizacional'])
		});

		var ds_cajero = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_tesoreria/control/cajero/ActionListarCajero.php'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_cajero',totalRecords: 'TotalCount'},['id_cajero','nombre_persona','apellido_paterno_persona','apellido_materno_persona','codigo_empleado_empleado','desc_empleado'])
		});

		function render_id_caja(value, p, record){return String.format('{0}', record.data['caja']);}
		var tpl_id_caja=new Ext.Template('<div class="search-item">','<b><i>{desc_unidad_organizacional}</i></b>','<br><FONT COLOR="#B5A642">{desc_moneda}</FONT>','</div>');

		function render_id_cajero(value, p, record){return String.format('{0}', record.data['cajero']);}
		var tpl_id_cajero=new Ext.Template('<div class="search-item">','<b><i>{nombre_persona} </b></i>','<b><i>{apellido_paterno_persona} </b></i>','<b><i>{apellido_materno_persona} </b></i>','<br><FONT COLOR="#B5A642">{codigo_empleado_empleado}</FONT>','</div>');
	
	
		
		var ds_depto_tesoro = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/depto/ActionListarDepartamento.php?tesoro=1'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_caja',totalRecords: 'TotalCount'},['id_depto','codigo_depto','nombre_depto'])
		});
		
		function render_id_depto_tesoro(value, p, record){return String.format('{0}', record.data['depto_tesoro']);}
		var tpl_id_depto_tesoro=new Ext.Template('<div class="search-item">','<b><i>{codigo_depto} </b></i>,<br><FONT COLOR="#B5A642">{nombre_depto}</FONT>','</div>');
	
	    
		var ds_tipo_plantilla = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_contabilidad/control/plantilla/ActionListarPlantilla.php'}),reader:new Ext.data.XmlReader({record:'ROWS',id:'tipo_plantilla',totalRecords: 'TotalCount'},['id_plantilla','tipo_plantilla','desc_plantilla'])});
        function render_tipo_plantilla(value, p, record){return String.format('{0}', record.data['desc_documento']);}
		var tpl_tipo_plantilla=new Ext.Template('<div class="search-item">','<b><i>{desc_plantilla}</i></b>','</div>');

		
	/////////////////////////
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
	
	
	
	// txt id_proceso_compra   ==> deberia ser fiel
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
	
	
//	Atributos[2]={
//		validacion:{
//			//fieldLabel: 'Id',
//			labelSeparator:'',
//			name: 'id_tipo_categoria_adq',
//			inputType:'hidden',
//			grid_visible:false, 
//			grid_editable:false
//		},
//		tipo: 'Field',
//		filtro_0:false,
//		defecto:maestro.id_tipo_categoria_adq,
//		save_as:'id_tipo_categoria_adq'
//	};
	

	
	
	// txt num_cotizacion
//	Atributos[3]={//==> SI
//		validacion:{
//			name:'num_cotizacion',
//			fieldLabel:'No Cotizacion ',
//			allowBlank:true,
//			maxLength:50,
//			minLength:0,
//			selectOnFocus:true,
//			allowDecimals:false,
//			decimalPrecision:2,//para numeros float
//			allowNegative:false,
//			minValue:0,
//			vtype:'texto',
//			grid_visible:false,
//			grid_editable:false,
//			width_grid:80,
//			width:'100%',
//			disabled:true,
//			grid_indice:2
//		},
//		tipo: 'TextField',
//		form: true,
//		filtro_0:true,
//		defecto:maestro.num_cotizacion,
//		filterColValue:'COTIZA.num_cotizacion#COTIZA.periodo',
//		save_as:'num_cotizacion',
//		id_grupo:0  //1
//	};
	
	
	
	
	Atributos[2]={//==> SI
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
			width:'90%',
			disabled:true,
			grid_indice:3
		},
		tipo: 'TextField',
		form: true,
		filtro_0:true,
		filterColValue:'PROVEE.desc_proveedor',
		save_as:'id_proveedor',
		id_grupo:3  //1
	};
	
	// txt fecha_validez_oferta ==> se usa
	Atributos[3]= {
		validacion:{
			name:'precio_total_adjudicado_con_impuestos',
			fieldLabel:'Precio Total',
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
			width:'100%',
			disabled:true,
			grid_indice:4
		},
		tipo: 'NumberField',
		form: true,
		filtro_0:false,
		id_grupo:5
	};
	
	
	Atributos[4]={//==> SI
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
			width:'100%',
			disabled:true,
			grid_indice:5
		},
		tipo: 'TextField',
		form: true,
		filtro_0:false,
		//defecto:maestro.num_cotizacion,
		filterColValue:'MONEDA.nombre',
		save_as:'id_monedas',
		id_grupo:0  //1
	};

	
	

	// txt tipo_entrega  ==> se usa
	Atributos[5]={
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
		id_grupo:5
	};


    Atributos[6]={//==> se usa//30
			validacion: {
			name:'tipo_pago',
			fieldLabel:'Tipo de Pago',
			allowBlank:false,
			typeAhead:true,
			loadMask:true,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[['caja','Pago en Caja'],['devengado','Cheque'],['transferencia','Transferencia Bancaria'],['avance','Cuenta Documentada']]}),
			valueField:'ID',
			displayField:'valor',
			onSelect:function(record){
				
				getComponente('tipo_pago').setValue(record.data.ID);
				getComponente('tipo_pago').collapse();
				
				if(record.data.ID=='caja'){
					cambiar_tipo('caja');
				}
				else if(record.data.ID=='devengado'||record.data.ID=='transferencia'){
					cambiar_tipo('devengado');
					CM_mostrarComponente(getComponente('factura_total'));
				}
				else{
					cambiar_tipo('avance');
				}
			
			},
			forceSelection:true,
			grid_visible:true,
			grid_editable:false,
			align:'center',
			width_grid:80,
			grid_indice:8,
			width:180,
			disabled:false,
			renderer:tipo_pago
		},
		tipo:'ComboBox',
		form: true,
		defecto:'devengado',
		save_as:'tipo_pago',
		id_grupo:1
	};
	

	var fCol=new Array();
		var fVal=new Array();
		fCol[0]='PLANT.sw_compro';
		fVal[0]='1';




		Atributos[7]={
			validacion:{
				name:'tipo_documento',
				fieldLabel:'Tipo Documento',
				allowBlank:false,
				emptyText:'Documento...',
				desc: 'desc_documento',
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
				grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_tipo_plantilla,
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				//width:'30%',
				grid_indice:13
			},
			tipo:'ComboBox',
			form: true,
			filtro_0:true,
			filterColValue:'PLANTI.desc_plantilla',
			id_grupo:4
		};
	


	// txt garantia
//	Atributos[10]={//==> SI//11
//		validacion:{
//			name:'garantia',
//			fieldLabel:'Garantia',
//			allowBlank:true,
//			maxLength:200,
//			minLength:0,
//			selectOnFocus:true,
//			vtype:'texto',
//			grid_visible:false,
//			grid_editable:false,
//			width_grid:100,
//			width:'100%',
//			disable:false,
//			grid_indice:13	
//		},
//		tipo: 'TextField',
//		form: true,
//		filtro_0:false,
//		filterColValue:'COTIZA.garantia',
//		save_as:'garantia',
//		id_grupo:0
//	};

	
	// txt lugar_entrega ==> se usa
	Atributos[8]={//14
		validacion:{
			name:'lugar_entrega',
			fieldLabel:'Lugar de Entrega',
			allowBlank:true,
			maxLength:300,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:false,
			grid_editable:false,
			width_grid:100,
			width:'100%',
			disabled:false,
			grid_indice:14
		},
		tipo: 'TextField',
		form: true,
		filtro_0:true,
		
		filterColValue:'COTIZA.lugar_entrega',
		save_as:'lugar_entrega',
		id_grupo:5  //1
		
	};
	
	
// txt estado_vigente
	Atributos[9]={//==>SI//16
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
//	Atributos[13]={//==> SI//17
//		validacion:{
//			name:'estado_reg',
//			fieldLabel:'Estado Reg',
//			allowBlank:false,
//			maxLength:30,
//			minLength:0,
//			selectOnFocus:true,
//			vtype:'texto',
//			grid_visible:false,
//			grid_editable:false,
//			width_grid:100,
//			width:'100%',
//			disable:false		
//		},
//		tipo: 'TextField',
//		form: true,
//		filtro_0:false,
//		filterColValue:'COTIZA.estado_reg',
//		save_as:'estado_reg',
//		defecto:'activo',
//		id_grupo:0
//	};


	
	Atributos[10]={//18
		validacion:{
			name:'desc_proveedor',
			fieldLabel:'Nombre Pago',
			allowBlank:true,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:false,
			grid_editable:false,
			width_grid:85,
			width:'90%',
			disabled:false,
			grid_indice:17		
		},
		tipo: 'TextField',
		form: true,
		filtro_0:false,
		filterColValue:'nombre_pago',
		save_as:'nombre_pago',
		id_grupo:3
	};
	
	Atributos[11]={//26
		validacion:{
			name:'numeracion_oc',
			fieldLabel:'Orden Compra',
			allowBlank:true,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:85,
			align:'right',
			width:'100%',
			disabled:false,
			grid_indice:7		
		},
		tipo: 'TextField',
		form: true,
		defecto:1,
		filtro_0:false,
		filterColValue:'num_orden_compra',
		save_as:'num_orden_compra',
		id_grupo:0
	};
//	Atributos[16]={//27
//		validacion:{
//			name:'categoria',
//			fieldLabel:'Modalidad',
//			allowBlank:false,
//			maxLength:30,
//			minLength:0,
//			selectOnFocus:true,
//			vtype:'texto',
//			grid_visible:false,
//			grid_editable:false,
//			width_grid:100,
//			width:'100%',
//			disabled:true,
//			grid_indice:1		
//		},
//		tipo: 'TextField',
//		filtro_0:false,
//		save_as:'categoria',
//		id_grupo:5
//	};
	// txt observaciones
	Atributos[12]={//==>SI//29
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
			disabled:false,
			grid_indice:60
		},
		tipo: 'TextArea',
		form: true,
		filtro_0:true,
		defecto:maestro.lugar_entrega,
		filterColValue:'COTIZA.observaciones',
		save_as:'observaciones',
		defecto:'-',
		id_grupo:5  //1
	};

// txt forma_pago ==se usa
	Atributos[13]={//9
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
			width:'90%',
			disable:false,
			grid_indice:11	
		},
		tipo: 'TextField',
		form: true,
		filtro_0:false,
		filterColValue:'COTIZA.forma_pago',
		save_as:'forma_pago',
		id_grupo:1
	};	
	
	
	
	
	Atributos[14]={//31
			validacion:{
				name:'id_depto_tesoro',
				fieldLabel:'Departamento de Tesoreria',
				allowBlank:false,
				emptyText:'Depto Tesoreria...',
				desc: 'depto_tesoro', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_depto_tesoro,
				valueField: 'id_depto',
				displayField: 'nombre_depto',
				queryParam: 'filterValue_0',
				filterCol:'DEPTO_TES.codigo_depto#DEPTO_TES.nombre_depto',
				typeAhead:true,
				tpl:tpl_id_depto_tesoro,
				forceSelection:true,
				onSelect:function(record){
					getComponente('id_caja').reset();
					componentes[14].setValue(record.data.id_depto);
					componentes[14].collapse();
					ds_caja.baseParams={m_id_depto:record.data.id_depto};
					componentes[15].modificado=true;
									
				},
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
				renderer:render_id_depto_tesoro,
				grid_visible:true,
				grid_editable:false,
				width_grid:120,
				width:180,
				disabled:false

			},
			tipo:'ComboBox',
			form: true,
			filtro_0:true,
			filterColValue:'DEPTO_TES.nombre_depto#DEPTO_TES.codigo_depto',
			save_as:'id_depto_tesoro',
			id_grupo:1
		};
	
	
	

		Atributos[15]={//31
			validacion:{
				name:'id_caja',
				fieldLabel:'Caja',
				allowBlank:false,
				emptyText:'Caja...',
				desc: 'caja', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_caja,
				valueField: 'id_caja',
				displayField: 'desc_unidad_organizacional',
				queryParam: 'filterValue_0',
				filterCol:'UO.nombre_unidad',
				typeAhead:true,
				tpl:tpl_id_caja,
				forceSelection:true,
				onSelect:function(record){
					getComponente('id_cajero').reset();
					componentes[15].setValue(record.data.id_caja);
					componentes[15].collapse();
					ds_cajero.baseParams={m_id_caja:record.data.id_caja};
					componentes[16].modificado=true;
									
				},
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
				renderer:render_id_caja,
				grid_visible:true,
				grid_editable:false,
				width_grid:120,
				width:180

			},
			tipo:'ComboBox',
			form: true,
			filtro_0:true,
			filterColValue:'UO.nombre_unidad',
			save_as:'id_caja',
			id_grupo:2
		};
		// txt id_cajero
		Atributos[16]={//32
			validacion:{
				name:'id_cajero',
				fieldLabel:'Cajero',
				allowBlank:false,
				emptyText:'Cajero...',
				desc: 'cajero', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_cajero,
				valueField: 'id_cajero',
				displayField: 'desc_empleado',
				queryParam: 'filterValue_0',
				filterCol:'PER_CAJ.nombre_completo',
				typeAhead:true,
				tpl:tpl_id_cajero,
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
				renderer:render_id_cajero,
				grid_visible:true,
				grid_editable:false,
				width_grid:130,
				width:180

			},
			tipo:'ComboBox',
			form: true,
			filtro_0:true,
			filterColValue:'PER_CAJ.nombre_completo',
			save_as:'id_cajero',
			id_grupo:2
		};
	
	
//	Atributos[22]= {//31
//		validacion:{
//			name:'precio_total_moneda_cotizada',
//			fieldLabel:'Precio Total',
//			allowBlank:true,
//			maxLength:18,
//			minLength:0,
//			selectOnFocus:true,
//			allowDecimals:false,
//			decimalPrecision:2,//para numeros float
//			allowNegative:false,
//			minValue:0,
//			vtype:'texto',
//			grid_visible:false,
//			grid_editable:false,
//			width_grid:90,
//			width:'100%',
//			disable:false,
//			grid_indice:8
//		},
//		tipo: 'NumberField',
//		form: true,
//		filtro_0:false,
//		filterColValue:'COTIZA.precio_total_moneda_cotizada',
//		save_as:'precio_total_moneda_cotizada',
//		id_grupo:0
//	};
	
	
	//todo_pagado==> permitir� finalizar el plan de pagos
	Atributos[17]={//32
		validacion:{
			//fieldLabel: 'Id',
			labelSeparator:'',
			name: 'todo_pagado',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		save_as:'todo_pagado'
	};
	
	
//	Atributos[24]={//33
//		validacion:{
//			//fieldLabel: 'Id',
//			labelSeparator:'',
//			name: 'falta_anular',
//			inputType:'hidden',
//			grid_visible:false, 
//			grid_editable:false
//		},
//		tipo: 'Field',
//		filtro_0:false,
//		save_as:'falta_anular'
//	};
	
	Atributos[18]={//==> SI//36
		validacion:{
			name:'num_factura',
			fieldLabel:'N� Factura',
			allowBlank:false,
			maxLength:150,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			decimalPrecision:0,//para numeros float
			allowNegative:false,
			minValue:0,
			vtype:'texto',
			grid_visible:false,
			grid_editable:false,
			width_grid:80,
			width:'80%',
			disabled:false
			
		},
		tipo: 'NumberField',
		form: true,
		filtro_0:false,
		filterColValue:'COTIZA.num_factura',
		save_as:'num_factura',
		id_grupo:4  //1
	};
	
	
	Atributos[19]={//35
		validacion:{
			name:'numeracion_periodo',
			fieldLabel:'Periodo/No Cot.',
			allowBlank:true,
			maxLength:30,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:85,
			align:'right',
			width:'100%',
			disabled:false,
			grid_indice:2
		},
		tipo: 'TextField',
		form:true,
		filtro_0:false,
		filterColValue_0:'COTIZA.num_cotizacion#COTIZA.periodo',
		save_as:'numeracion_periodo',
		id_grupo:0
	};
	
	
	Atributos[20]={//34
		validacion:{
			name:'factura_total',
			fieldLabel:'Factura por el Total',
			allowBlank:true,
			typeAhead:true,
			loadMask:true,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({
				fields:['ID', 'valor'],
				data:Ext.orden_compra_combo.factura_total
			}),
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			onSelect:function(record){
					getComponente('factura_total').setValue(record.data.ID);
					
					componentes[20].collapse();
					if(record.data.ID=='si'){
						
						NoBlancosGrupo(4);
						CM_mostrarGrupo('Factura');
					}else{
						resetGrupo(4);
						SiBlancosGrupo(4);
						CM_ocultarGrupo('Factura');
					}
									
				},
			forceSelection:true,
			grid_visible:true, 
			grid_indice:13,
			width_grid:110,
			width:163,
			grid_editable:false 
		},
		tipo:'ComboBox',
		filtro_0:false,
		defecto:'no',
		save_as:'factura_total',
		id_grupo:3
	};
	
//	Atributos[28]={//37
//		validacion:{//==>NO
//			name:'num_autoriza_factura',
//			fieldLabel:'No de Autorizaci�n',
//			allowBlank:true,
//			maxLength:15,
//			minLength:0,
//			selectOnFocus:true,
//			allowDecimals:false,
//			decimalPrecision:0,//para numeros float
//			allowNegative:false,
//			minValue:0,
//			vtype:'texto',
//			grid_visible:false,
//			grid_editable:true,
//			width_grid:105,
//			width:'100%',
//			disabled:false,
//			grid_indice:14
//			
//		},
//		tipo: 'NumberField',
//		form: true,
//		save_as:'num_autoriza_factura',
//		filtro_0:false,
//		id_grupo:0
//	};
//	
//	Atributos[29]={//==> SI//38
//		validacion:{
//			name:'cod_control_factura',
//			fieldLabel:'Codigo de Control',
//			allowBlank:true,
//			maxLength:20,
//			minLength:0,
//			selectOnFocus:true,
//			allowDecimals:false,
//			decimalPrecision:2,//para numeros float
//			allowNegative:false,
//			minValue:0,
//			vtype:'texto',
//			grid_visible:false,
//			grid_editable:true,
//			width_grid:90,
//			width:'100%',
//			disabled:false,
//			grid_indice:15
//			
//		},
//		tipo: 'TextField',
//		form: true,
//		filtro_0:false,
//		save_as:'cod_control_factura',
//		id_grupo:0 //1
//	};
	
	
	Atributos[21]= {//39
		validacion:{
			name:'fecha_orden_compra',
			fieldLabel:'Fecha Orden Compra',
			allowBlank:false,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:true,
			grid_editable:true,
			renderer: formatDate,
			width_grid:97,
			disabled:false,
			grid_indice:16,
			width:163
		},
		form:true,
		tipo:'DateField',
		filtro_0:false,
		filterColValue:'COTIZA.fecha_orden_compra',
		dateFormat:'m-d-Y',
		defecto:' ',
		save_as:'fecha_orden_compra',
		id_grupo:5
	};
	
//	Atributos[31]={//40
//			validacion:{
//				name:'gestion',
//				fieldLabel:'Gesti�n',
//				allowBlank:true,
//				maxLength:20,
//				minLength:0,
//				selectOnFocus:true,
//				vtype:'texto',
//				grid_visible:false,
//				grid_editable:false,
//				width_grid:55,
//				align:'right',
//				width:'100%',
//				disabled:true,
//				grid_indice:1
//			},
//			tipo: 'TextField',
//			form: false,
//			filtro_0:true,
//			filterColValue:'PROCOM.gestion'
//			
//		};
		
		// txt num_pagos
	Atributos[22]={//==> SI//42
		validacion:{
			name:'num_pagos',
			fieldLabel:'N� Pagos',
			allowBlank:true,
			maxLength:3,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			decimalPrecision:0,//para numeros float
			allowNegative:false,
			minValue:1,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			align:'right',
			width_grid:100,
			width:'90%',
			disabled:false,
			grid_indice:15
		},
		tipo: 'NumberField',
		form: true,
		defecto:1,
		filtro_0:false,
		filterColValue:'COTIZA.num_pagos',
		save_as:'num_pagos',
		id_grupo:1  //1
	};
	

	
	Atributos[23]={//==> SI//42
		validacion:{
			name:'por_adelanto',
			fieldLabel:'% Adelanto',
			allowBlank:true,
			maxLength:20,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:true,
			decimalPrecision:9,//para numeros float
			allowNegative:false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			align:'right',
			width_grid:100,
			width:'90%',
			disabled:false,
			grid_indice:16
		},
		tipo: 'NumberField',
		form: true,
		defecto:0,
		filtro_0:false,
		filterColValue:'COTIZA.por_adelanto',
		save_as:'por_adelanto',
		id_grupo:6  //1
	};
	
	
	Atributos[24]={//==> SI//42
		validacion:{
			name:'por_retgar',
			fieldLabel:'% Retenci�n por Garantia',
			allowBlank:true,
			maxLength:15,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:true,
			decimalPrecision:2,//para numeros float
			allowNegative:false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			align:'right',
			width_grid:100,
			width:'90%',
			disabled:false,
			grid_indice:17
		},
		tipo: 'NumberField',
		form: true,
		defecto:0,
		filtro_0:false,
		filterColValue:'COTIZA.por_retgar',
		save_as:'por_retgar',
		id_grupo:6  //1
	};
	
	
	Atributos[25]={//40
			validacion:{
				name:'estado_adelanto',
				fieldLabel:'Estado Adelanto',
				allowBlank:true,
				maxLength:20,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:55,
				align:'right',
				width:'100%',
				disabled:true
				
			},
			tipo: 'TextField',
			filtro_0:false,
			filterColValue:'COTIZA.estado_adelanto',
			id_grupo:0
			
		};
		
		
		
		Atributos[26]={//40
			validacion:{
				name:'estado_retgar',
				fieldLabel:'Estado RetGar',
				allowBlank:true,
				maxLength:20,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:55,
				align:'right',
				width:'100%',
				disabled:true
				
			},
			tipo: 'TextField',
			filtro_0:false,
			filterColValue:'COTIZA.estado_retgar',
			id_grupo:0
		};
	
		
	
	 Atributos[27]={//==> se usa//30
			validacion: {
			name:'con_contrato',
			fieldLabel:'Contrato',
			allowBlank:false,
			typeAhead:true,
			loadMask:true,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[['si','si'],['no','no']]}),
			
			valueField:'ID',
			displayField:'valor',
			forceSelection:true,
			grid_visible:true,
			grid_editable:false,
			align:'center',
			width_grid:80,
			grid_indice:8,
			width:150,
			disabled:false

		},
		tipo:'ComboBox',
		form: true,
		defecto:'no',
		save_as:'con_contrato',
		id_grupo:7
	};
	
	
	Atributos[28]= {
		validacion:{
			name:'nro_contrato',
			fieldLabel:'N� contrato',
			allowBlank:true,
			maxLength:20,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:80,
			width:'70%',
			disabled:false,
			grid_indice:6
		},
		tipo: 'NumberField',
		form: true,
		filtro_0:false,
		id_grupo:7
	};
	
	Atributos[29]={//==> SI//42
		validacion:{
			name:'monto_adelanto_moneda_cotizada',
			fieldLabel:'Monto de Adelanto',
			allowBlank:true,
			maxLength:20,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:true,
			decimalPrecision:2,//para numeros float
			allowNegative:false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			align:'right',
			width_grid:100,
			width:'90%',
			disabled:false,
			grid_indice:18
		},
		tipo: 'NumberField',
		form: true,
		defecto:0,
		id_grupo:6  //1
	};
	
	
	Atributos[30]= {//39
		validacion:{
			name:'fecha_ini_ctto',
			fieldLabel:'Inicio Servicio',
			allowBlank:true,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:false,
			grid_editable:true,
			renderer: formatDate,
			width_grid:97,
			disabled:false,
			width:163
		},
		form:true,
		tipo:'DateField',
		filtro_0:false,
		filterColValue:'COTIZA.fecha_ini_ctto',
		dateFormat:'m-d-Y',
		defecto:' ',
		save_as:'fecha_ini_ctto',
		id_grupo:7
	};
	
	
	Atributos[31]= {//39
		validacion:{
			name:'fecha_fin_ctto',
			fieldLabel:'Fin Servicio',
			allowBlank:true,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:false,
			grid_editable:true,
			renderer: formatDate,
			width_grid:97,
			disabled:false,
			width:163
		},
		form:true,
		tipo:'DateField',
		filtro_0:false,
		filterColValue:'COTIZA.fecha_fin_ctto',
		dateFormat:'m-d-Y',
		defecto:' ',
		save_as:'fecha_fin_ctto',
		id_grupo:7
	};
	
	Atributos[32]= {//39
		validacion:{
			name:'plan_pago',
			fieldLabel:'Pago Variable',
			allowBlank:false,
			grid_visible:false,
			disabled:true,
			width:120
		},
		form:true,
		tipo:'Field',
		id_grupo:8
	};
	
	Atributos[33]= {//39
		validacion:{
			name:'importe_devengar',
			fieldLabel:'Importe a Devengar',
			allowBlank:false,
			grid_visible:false,
			disabled:true,
			width:120
		},
		form:true,
		tipo:'Field',
		id_grupo:8
	};
	
	Atributos[34]= {//39
		validacion:{
			name:'gestion',
			fieldLabel:'Gestion Devengado',
			allowBlank:false,
			grid_visible:false,
			disabled:true,
			width:120
		},
		form:true,
		tipo:'Field',
		id_grupo:8
	};
	
	Atributos[35]= {//39
		validacion:{
			name:'moneda',
			fieldLabel:'Moneda',
			allowBlank:false,
			grid_visible:false,
			disabled:true,
			width:120
		},
		form:true,
		tipo:'Field',
		id_grupo:8
	};
	
	
	
	Atributos[36]= {//39
		validacion:{
			name:'fecha_devengado',
			fieldLabel:'Fecha de devengado',
			allowBlank:true,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:false,
			disabled:false,
			width:163
		},
		form:true,
		tipo:'DateField',
		dateFormat:'m-d-Y',
		id_grupo:8
	};
	
	Atributos[37]={//==>SI//29
		validacion:{
			name:'observaciones_devengado',
			fieldLabel:'Observaciones Devengado',
			allowBlank:true,
			maxLength:300,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:false,
			width:'100%',
			disabled:false
		},
		tipo: 'TextArea',
		form: true,
		id_grupo:8  //1
	};
	
	Atributos[38]={
		validacion:{
			//fieldLabel: 'Id',
			labelSeparator:'',
			name: 'id_gestion',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		save_as:'id_gestion'
	};
	
	
	
	
	//----------- FUNCIONES RENDER
	
	function formatDate(value){return value?value.dateFormat('d/m/Y'):''};
	
			
	function tipo_pago(val,cell,record,row,colum,store){
					if(val=='caja')
					  return 'Pago en Caja';	
					
					else if(val=='avance')
					  return 'Cuenta Documentada';    
					else if(val=='devengado')
					   return 'Cheque';
					else
					   return 'Transferencia Bancaria';	
					    
					
	};

	//---------- INICIAMOS LAYOUT DETALLE
	var config={titulo_maestro:'Orden de Compra',grid_maestro:'grid-'+idContenedor, urlHijo:'../../../sis_adquisiciones/vista/plan_pago/plan_pago.php'};
	
	layout_orden_compra_det= new DocsLayoutMaestroDeatalle(idContenedor,idContenedorPadre);
	layout_orden_compra_det.init(config);
	
	//---------- INICIAMOS HERENCIA
	this.pagina = Pagina;
	this.pagina(paramConfig,Atributos,ds,layout_orden_compra_det,idContenedor);
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
	var CM_dialog= this.getDialog;
	var CM_saveSuccess=this.saveSuccess;
	var enableSelect=this.EnableSelect;
	var CM_getFormulario=this.getFormulario;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	
	
	
//DEFINICI�N DE LA BARRA DE MEN�
	var paramMenu={
	
	actualizar:{crear:true,separador:false}};
//DEFINICI�N DE FUNCIONES
	
	var paramFunciones={
	Save:{url:direccion+'../../../control/cotizacion/ActionGuardarCotizacionOrdenCompra.php',parametros:'&m_id_proceso_compra='+maestro.id_proceso_compra},
	
	Formulario:{html_apply:'dlgInfo-'+idContenedor,height:500,width:680,minWidth:450,minHeight:230,	closable:true,titulo:'Orden compra',columnas:['46%','46%'],
	grupos:[{
			tituloGrupo:'Oculto',
			columna:0,
			id_grupo:0
		},{
			tituloGrupo:'Definici�n de Pago',
			columna:0,
			id_grupo:1
		},
		{
			tituloGrupo:'Cajas',
			columna:0,
			id_grupo:2
		},{
			tituloGrupo:'Proveedor',
			columna:0,
			id_grupo:3
		},{
			tituloGrupo:'Factura',
			columna:0,
			id_grupo:4
		},
		{
			tituloGrupo:'Orden de Compra',
			columna:1,
			id_grupo:5
		},{
			tituloGrupo:'Retenciones',
			columna:1,
			id_grupo:6
		},
		{
			tituloGrupo:'Contrato',
			columna:0,
			id_grupo:7
		},
		{
			tituloGrupo:'Datos Devengado',
			columna:1,
			id_grupo:8
		}
		
	]}};
	
	//-------------- Sobrecarga de funciones --------------------//
	this.reload=function(params){
		
		var datos=Ext.urlDecode(decodeURIComponent(params));
		maestro.id_proceso_compra=datos.m_id_proceso_compra;
		maestro.codigo_procedo=datos.m_codigo_proceso;
		maestro.num_proceso=datos.m_num_proceso;
		maestro.tipo_adq=datos.m_tipo_adq;
		//maestro.id_tipo_categoria_adq=datos.m_id_tipo_categoria_adq;
		maestro.lugar_entrega=datos.m_lugar_entrega;
		maestro.id_moneda=datos.m_id_moneda;
		maestro.desc_moneda=datos.m_desc_moneda;
		maestro.num_cotizacion=datos.m_num_cotizacion;
		maestro.factura_total=datos.m_factura_total;
		maestro.avance=datos.m_avance;
		

		ds.lastOptions={
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_proceso_compra:maestro.id_proceso_compra,
				adjudicacion:'si'
			}
		};
		
		_CP.getPagina(layout_orden_compra_det.getIdContentHijo()).pagina.limpiarStore()
		this.btnActualizar();
		
		iniciarEventosFormularios();

		
		Atributos[1].defecto=maestro.id_proceso_compra;		
		
		paramFunciones.Save.parametros='&m_id_proceso_compra='+maestro.id_proceso_compra
		this.iniciarEventosFormularios;
		this.InitFunciones(paramFunciones);
		
	};
	
	
//	function btn_anular_cotizacion(){
//		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
//		var SelectionsRecord=sm.getSelected();
//		if(NumSelect!=0){
//			var dialog=CM_dialog();
//			dialog.buttons[0].setText('Anular Cotizacion');
//			dialog.buttons[0].enable();
//			var msj='';
//			if(maestro.ejecutado=='si'){ msj='El presupuesto ya fue revertido para esta solicitud, al anular esta cotizacion, el presupuesto restante tambien ser� revertido.\n';}
//            else{msj='';}
//			if(confirm(msj+"Esta seguro de anular la cotizacion?")){
//				var data="cantidad_ids=1&id_cotizacion="+SelectionsRecord.data.id_cotizacion+'&anular=1';
//					Ext.Ajax.request({url:direccion+"../../../control/cotizacion/ActionTerminarCotizacion.php",
//					params:data,
//					method:'POST',
//					failure:CM_conexionFailure,
//					success:exito,
//					timeout:100000000
//					});	
//			}
//		}
//		else{
//		  Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
//	   }
//	   this.btnActualizar;
//    }

      function exito(resp){
       
					Ext.MessageBox.alert('Estado','Anulacion completada');		
					ds.load({
						params:{
							start:0,
							limit: paramConfig.TamanoPagina,
							CantFiltros:paramConfig.CantFiltros,
							m_id_proceso_compra:maestro.id_proceso_compra,
							adjudicacion:'si'
						}
					});
				
		}
	
	
function btn_orden_compra(){
	
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		var SelectionsRecord=sm.getSelected();
		if(NumSelect!=0){
			CM_getFormulario().url=direccion+'../../../control/cotizacion/ActionGuardarCotizacionOrdenCompra.php';
			if(SelectionsRecord.data.estado_vigente=='formulacion_pp' || SelectionsRecord.data.estado_vigente=='en_pago'){
						CM_ocultarGrupo('Definici�n de Pago');
			   			CM_ocultarGrupo('Cajas');
			   			CM_ocultarGrupo('Proveedor');
			   			CM_ocultarGrupo('Factura');
			   			CM_mostrarGrupo('Orden de Compra');
			   			  getComponente('lugar_entrega').disable();
			   			  getComponente('tipo_entrega').disable();
			   			  getComponente('observaciones').disable();
			   			CM_ocultarGrupo('Retenciones');
			   			CM_mostrarGrupo('Contrato');
			   			CM_ocultarGrupo('Datos Devengado');
			   			getComponente('fecha_orden_compra').minValue=getComponente('fecha_orden_compra').getValue();
			   			getComponente('fecha_orden_compra').maxValue=getComponente('fecha_orden_compra').getValue();
			   			SiBlancosTodos();
			   			CM_btnEdit();
    					var dialog=CM_dialog();
    					dialog.buttons[0].setText('Guardar Datos');
    					dialog.buttons[0].enable();
			}else{
			//getComponente('monto_adelanto_moneda_cotizada').enable();
						getComponente('lugar_entrega').enable();
			   			getComponente('tipo_entrega').enable();
			   			getComponente('observaciones').enable();
			   if(parseFloat(SelectionsRecord.data.id_auxiliar)>0){
					getComponente('tipo_pago').disabled=false;
					getComponente('num_pagos').disabled=false;
					getComponente('id_depto_tesoro').modificado=true;
					getComponente('id_depto_tesoro').allowBlank=false;
					ds_depto_tesoro.baseParams={
						estado:2,id_cotizacion:SelectionsRecord.data.id_cotizacion
					}
					//FER-MOD-AD-07 (23/04/2010)
					getComponente('fecha_orden_compra').setValue('01/01/'+SelectionsRecord.data.gestion);
					getComponente('fecha_orden_compra').minValue=getComponente('fecha_orden_compra').getValue();
					getComponente('fecha_orden_compra').setValue(new Date());
					getComponente('fecha_orden_compra').maxValue=getComponente('fecha_orden_compra').getValue();
					if(SelectionsRecord.data.fecha_orden_compra !=null || SelectionsRecord.data.fecha_orden_compra !=undefined){
						getComponente('fecha_orden_compra').setValue(SelectionsRecord.data.fecha_orden_compra);
					}else{
						getComponente('fecha_orden_compra').setValue('');
					}
					getComponente('fecha_orden_compra').allowBlank=false;
					if(SelectionsRecord.data.tipo_pago=='avance' || maestro.avance=='si'){//condiciones por tipo_pago
						if(maestro.avance=='si'){
							if(parseFloat(SelectionsRecord.data.avance_habilitado)){
						  		cambiar_tipo('avance_proceso');
						 		on='si';
							}else{
						  		Ext.MessageBox.alert('Estado','El proceso corresponde a una soliciud a ser rendida con Cuenta Documentada, verifique que ya se haya emitido un cheque para esa cuenta documentada');	
						  		on='no';
							}
						}
						else{
							cambiar_tipo('avance');
							on='si';
						}
					}
					else if(SelectionsRecord.data.tipo_pago=='caja'){
							cambiar_tipo('caja');
							on='si';
						}
						else{
							cambiar_tipo('devengado');
							on='si';
							if(SelectionsRecord.data.factura_total=='si'){
								CM_mostrarGrupo('Factura');
								NoBlancosGrupo(4);
							}
					
							if(parseFloat(SelectionsRecord.data.tiene_contrato)>0){
								NoBlancosGrupo(7);
							}else{
								SiBlancosGrupo(7);
							}
						}
				
					if(on=='si'){
						CM_btnEdit();
    					var dialog=CM_dialog();
    					dialog.buttons[0].setText('Guardar Datos');
    					dialog.buttons[0].enable();
					}
    		}else{
			    Ext.MessageBox.alert('Estado','El proveedor necesita tener una cuenta-auxiliar asociada para que se emita la Orden de Compra correspondiente');
			}
		}//estado in (formulacion, en_pago)
	}else{
		  Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
	}
	
	this.btnActualizar;
}



	function btn_orden_compra_rep(){
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		var SelectionsRecord=sm.getSelected();
		
		if(NumSelect>0){
		    var data='m_id_cotizacion='+SelectionsRecord.data.id_cotizacion;
			pagina=direccion+'../../../control/cotizacion/reporte/ActionPDFOrdenCompra.php?'+data;
			window.open(pagina);
		}else{
		    Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
	}
	
}

	function btn_plan_pago_rep(){
			//var data='cantidad_ids=1&id_proceso_compra_0='+getComponente('id_proceso_compra').getValue();
				var sm=getSelectionModel();
				var NumSelect=sm.getCount();
				if(NumSelect!=0){
					var SelectionsRecord=sm.getSelected();
					var data='m_id_cotizacion='+SelectionsRecord.data.id_cotizacion;
						window.open(direccion+'../../../control/plan_pago/reporte/ActionPDFPlanPago1.php?'+data)	
				}
				else{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un Proceso')
				}
			}	
			

			
	function btn_almacenes(){
	
		var sm=getSelectionModel();
		var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
            var data='m_id_cotizacion='+SelectionsRecord.data.id_cotizacion;
           
			window.open(direccion+'../../../control/cotizacion/reporte/ActionPDFIngresos1.php?'+data)	
				//validar que antes de poder ingresar a Plan de PAgos, se deba realizar el registro de ingreso de material
		}else{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un Proceso')
		}
	}	
			
			
	function btn_plan_pago(){
		this.btnActualizar;
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		if(NumSelect!=0){
		  var SelectionsRecord=sm.getSelected();
			if(SelectionsRecord.data.estado_vigente!='finalizado'){
			  if(SelectionsRecord.data.estado_vigente=='orden_compra' || SelectionsRecord.data.estado_vigente=='en_pago'){
				var data='m_id_cotizacion='+SelectionsRecord.data.id_cotizacion;
				data=data+'&m_observaciones='+SelectionsRecord.data.observaciones;
				data =data+'&m_num_pagos='+SelectionsRecord.data.num_pagos;
				data =data+'&m_factura_total='+SelectionsRecord.data.factura_total;
				data =data+'&m_desc_moneda='+maestro.desc_moneda;
				data =data+'&m_tipo_documento='+maestro.tipo_documento;
				data =data+'&m_tipo_pago='+maestro.tipo_pago;
				var ParamVentana={Ventana:{width:'90%',height:'70%'}};
				layout_orden_compra_det.loadWindows(direccion+'../../../../sis_adquisiciones/vista/plan_pago/plan_pago.php?'+data,'Plan de Pagos',ParamVentana);
				layout_orden_compra_det.getVentana().on('resize',function(){
					layout_orden_compra_det.getLayout().layout();
				})
			  }else{
				Ext.MessageBox.alert('Estado', 'Solo cotizaciones con orden de compra pueden definir Plan de Pagos')
			  }
			}else{
				Ext.MessageBox.alert('Estado','Solo registros que no esten finalizados');
			}
		}
		else{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
			}
		}
		
		
	function btn_devengar(){
		var sm=getSelectionModel(); 
		var NumSelect=sm.getCount();
		var SelectionsRecord=sm.getSelected();
		
		if(NumSelect==1)
		{			
				Ext.Ajax.request({
					url:direccion+"../../../control/cotizacion/ActionVerificarDevengado.php",
					success:cargar_respuesta,
					params:{'id_cotizacion':sm.getSelected().data.id_cotizacion},
					failure:ClaseMadre_conexionFailure,
					timeout:paramConfig.TiempoEspera
				})
			
		}
		else
		{
			Ext.MessageBox.alert('Estado','Antes debe seleccionar un Vale.')
		}		
		
		
	}
	
	function cargar_respuesta(resp){
		
		Ext.MessageBox.hide();
		if(resp.responseXML !=undefined && resp.responseXML !=null && resp.responseXML.documentElement !=null && resp.responseXML.documentElement !=undefined)
		{
			var root=resp.responseXML.documentElement;
			var mensaje='�Est� seguro de comprometer el importe de la rendici�n del recibo?';
			if(root.getElementsByTagName('respuesta')[0].firstChild.nodeValue=='-1')
			{
				Ext.MessageBox.alert('Estado',root.getElementsByTagName('mensaje')[0].firstChild.nodeValue)
			}
			else 
			{
				//aqui se define el control al que se llamara
				CM_getFormulario().url=direccion+'../../../control/plan_pago/ActionRegistrarDevengado.php';
				cambiar_tipo('devengar_cotizacion');
				componentes[33].setValue(root.getElementsByTagName('importe')[0].firstChild.nodeValue);
				componentes[34].setValue(root.getElementsByTagName('gestion')[0].firstChild.nodeValue);
				componentes[35].setValue(root.getElementsByTagName('moneda')[0].firstChild.nodeValue);
				componentes[32].setValue(root.getElementsByTagName('tipo')[0].firstChild.nodeValue);
				componentes[38].setValue(root.getElementsByTagName('id_gestion')[0].firstChild.nodeValue);
				CM_btnEdit();
    			var dialog=CM_dialog();
    			dialog.buttons[0].setText('Devengar Saldo');
    			dialog.buttons[0].enable();				
			}						
		}
	}
		
		
			
		
	//Para manejo de eventos
	function iniciarEventosFormularios(){
		
		for (var i=0;i<Atributos.length;i++){
			componentes[i]=getComponente(Atributos[i].validacion.name);
			
		}
		CM_ocultarGrupo('Oculto');
		getComponente('observaciones').setValue('');
	 	getComponente('num_pagos').minValue=1;
		getSelectionModel().on('rowdeselect',function(){
						if(_CP.getPagina(layout_orden_compra_det.getIdContentHijo()).pagina.limpiarStore()){
							if(bloquear=='si'){
							   _CP.getPagina(layout_orden_compra_det.getIdContentHijo()).pagina.bloquearMenu();
							}else{
								_CP.getPagina(layout_orden_compra_det.getIdContentHijo()).pagina.desbloquearMenu();
							}
						}
					})
		getComponente('con_contrato').setValue('no');
		getComponente('con_contrato').allowBlank=true;
				
		var onConCtto=function(e){
			
			if(e.value=='si'){
				getComponente('nro_contrato').allowBlank=false;
			}
			else{
				getComponente('nro_contrato').allowBlank=true;				
				getComponente('nro_contrato').clearInvalid();
				getComponente('nro_contrato').reset();
			}
		}
		
		
		var onPorAdelanto=function(e,n,o){ 
			if(n>100){
				alert('El porcentaje de anticipo no puede ser mayor a 100');
				getComponente('monto_adelanto_moneda_cotizada').setValue(0);
			}else{
				getComponente('monto_adelanto_moneda_cotizada').setValue(getComponente('precio_total_adjudicado_con_impuestos').getValue()*n/100);
			}
		}
		
		var onAdelanto=function(e,n,o){
			if(n>getComponente('precio_total_adjudicado_con_impuestos').getValue()){
				alert('El monto del anticipo no puede superar el total adjudicado');
				getComponente('por_adelanto').setValue(0);
			}else{
				getComponente('por_adelanto').setValue(n*100/getComponente('precio_total_adjudicado_con_impuestos').getValue());
			}
		}
		getComponente('con_contrato').on('change',onConCtto);
		getComponente('por_adelanto').on('change',onPorAdelanto);
		getComponente('monto_adelanto_moneda_cotizada').on('change',onAdelanto);
			
	}
	
	this.EnableSelect=function(x,z,y){
		_CP.getPagina(layout_orden_compra_det.getIdContentHijo()).pagina.reload(y.data);
		enable(x,z,y);
	}
	
	function cambiar_tipo(tipo){
		
		if(tipo=='caja'){
			getComponente('num_pagos').disable();
			getComponente('nro_contrato').allowBlank=true;
			getComponente('nro_contrato').reset();
			getComponente('num_pagos').setValue(1);
			getComponente('factura_total').setValue('no');
			CM_ocultarComponente(getComponente('factura_total'));
			SiBlancosTodos();
			NoBlancosGrupo(1);
			NoBlancosGrupo(2);
			NoBlancosGrupo(3);
			NoBlancosGrupo(5);
			resetGrupo(4);
			resetGrupo(6);
			resetGrupo(7);
			CM_mostrarGrupo('Cajas');
			CM_ocultarGrupo('Factura');
			CM_ocultarGrupo('Retenciones');
			CM_mostrarGrupo('Definici�n de Pago');
			CM_mostrarGrupo('Proveedor');
			CM_mostrarGrupo('Orden de Compra');
			CM_ocultarGrupo('Contrato');
			CM_ocultarGrupo('Datos Devengado');
		}
		else if(tipo=='devengado')
		{
			CM_mostrarComponente(getComponente('factura_total'));
			getComponente('num_pagos').enable();
			SiBlancosTodos();
			NoBlancosGrupo(1);
			NoBlancosGrupo(3);
			NoBlancosGrupo(5);
			NoBlancosGrupo(6);
			CM_ocultarGrupo('Cajas');
			CM_ocultarGrupo('Factura');
			CM_mostrarGrupo('Retenciones');
			CM_mostrarGrupo('Definici�n de Pago');
			CM_mostrarGrupo('Proveedor');
			CM_mostrarGrupo('Orden de Compra');
			CM_ocultarGrupo('Datos Devengado');
			
			
		}
		else if(tipo=='devengar_cotizacion')
		{
			getComponente('num_pagos').enable();
			SiBlancosTodos();
			NoBlancosGrupo(4);
			resetGrupo(4);
			CM_ocultarGrupo('Cajas');
			CM_mostrarGrupo('Factura');
			CM_ocultarGrupo('Retenciones');
			CM_ocultarGrupo('Definici�n de Pago');
			CM_ocultarGrupo('Proveedor');
			CM_ocultarGrupo('Orden de Compra');
			CM_ocultarGrupo('Contrato');
			CM_mostrarGrupo('Datos Devengado');
			
			
		}
		else{
			getComponente('nro_contrato').allowBlank=true;
			getComponente('nro_contrato').reset();
			if(tipo=='avance_proceso'){
				getComponente('tipo_pago').setValue('avance');
				getComponente('tipo_pago').disable();
				getComponente('num_pagos').disable();
				getComponente('num_pagos').setValue(1);
					
			}
			getComponente('factura_total').setValue('no');
			CM_ocultarComponente(getComponente('factura_total'));
			SiBlancosTodos();
			NoBlancosGrupo(1);
			NoBlancosGrupo(3);
			NoBlancosGrupo(5);
			resetGrupo(2);
			resetGrupo(4);
			resetGrupo(6);
			resetGrupo(7);
			CM_ocultarGrupo('Cajas');
			CM_ocultarGrupo('Factura');
			CM_ocultarGrupo('Retenciones');
			CM_mostrarGrupo('Definici�n de Pago');
			CM_mostrarGrupo('Proveedor');
			CM_mostrarGrupo('Orden de Compra');
			CM_ocultarGrupo('Contrato');
			CM_ocultarGrupo('Datos Devengado');
		}
	}
	
	
			
	function btn_revertir(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		this.btnActualizar;
		
		if(NumSelect!=0){
		    if(confirm('Est� seguro de revertir la Adjudicaci�nn?')){
		      var SelectionsRecord=sm.getSelected();
			  fin_rev=2;
			 //if(SelectionsRecord.data.)
			   	var data='cantidad_ids=1'+'&id_cotizacion='+SelectionsRecord.data.id_cotizacion+'&id_proceso_compra='+SelectionsRecord.data.id_proceso_compra;
							Ext.Ajax.request({url:direccion+"../../../control/cotizacion/ActionRevertirAdjudicacion.php",
							params:data,
							method:'POST',
							failure:CM_conexionFailure,
							success:revertido,
							timeout:100000000});
		    }
		}
	   else{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
		}
	}			
	

	
	function btn_resolucion_adjudicacion(){
				this.btnActualizar;
				var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
				var SelectionsRecord=sm.getSelected();
				
					if(NumSelect!=0){

                        window.open(direccion+'../../../control/adjudicacion/ActionPDFAdjudicacion.php?m_id_cotizacion='+SelectionsRecord.data.id_cotizacion);

					}else{
							Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
						}
	}
	
	function SiBlancosTodos(){
		for (var i=0;i<componentes.length;i++){
			if (Atributos[i].form!=false){
				componentes[i].allowBlank=true;
			}
			
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
	
	function resetGrupo(grupo)
	{
			for (var i=0;i<componentes.length;i++){
				if(Atributos[i].id_grupo==grupo)
					componentes[i].reset();
			}		
	}
	
			
			

	

			function btn_adelanto(){
				
				var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
				var SelectionsRecord=sm.getSelected();
				
					if(NumSelect!=0){
							var data1='cantidad_ids=1'+'&id_cotizacion='+SelectionsRecord.data.id_cotizacion+'&m_id_proceso_compra='+maestro.id_proceso_compra;
							Ext.Ajax.request({url:direccion+"../../../control/cotizacion/ActionPagarAdelanto.php",
							params:data1,
							method:'POST',
							failure:CM_conexionFailure,
							success:revertido,
							timeout:100000000});


					}else{
							Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
						}
			}

			
	function revertido(resp){
	    if(resp.responseXML!=undefined && resp.responseXML!=null&& resp.responseXML.documentElement!=null &&resp.responseXML.documentElement!=undefined){
				var root=resp.responseXML.documentElement;
	
				  if(root.getElementsByTagName('error')[0].firstChild.nodeValue=='false'){
				  	  if(root.getElementsByTagName('mensaje')[0].firstChild.nodeValue=='t'){
				      	alert('Finalizaci�n exitosa');
				  	  }else{
				  	  	alert(root.getElementsByTagName('mensaje')[0].firstChild.nodeValue);
				  	  }
				  }
				   ds.load({
						params:{
							start:0,
							limit: paramConfig.TamanoPagina,
							CantFiltros:paramConfig.CantFiltros,
							m_id_proceso_compra:maestro.id_proceso_compra,
							adjudicacion:'si'
						}
					});
	    }
	    
	}
	
	
	function btn_fin_serv(){
				
				var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
				var SelectionsRecord=sm.getSelected();
					if(NumSelect!=0){
						
							if(parseFloat(SelectionsRecord.data.todo_pagado)<parseFloat(SelectionsRecord.data.precio_total_adjudicado_con_impuestos)){
								if(confirm('El servicio tiene pagos pendientes que seran revertidos si lo finaliza. Desea Continuar?')){
							
									var data1='cantidad_ids=1'+'&id_cotizacion='+SelectionsRecord.data.id_cotizacion+'&fin=1';
									Ext.Ajax.request({url:direccion+"../../../control/cotizacion/ActionTerminarCotizacion.php",
									params:data1,
									method:'POST',
									failure:CM_conexionFailure,
									success:revertido,
									timeout:100000000});		
								}
							}else{
								alert("no hay importe a revertir");
							}
							


					}else{
							Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
						}
	}
	
	function btn_anticipo(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		var SelectionsRecord=sm.getSelected();
		
		if(NumSelect>0){
		  var data='id_cotizacion_rep_anticipo='+SelectionsRecord.data.id_cotizacion;
			pagina=direccion+'../../../control/cotizacion/reporte/ActionPDFAnticipo.php?'+data;
			window.open(pagina);
			}else
		{
		    Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
	    }
	}
	

	function salta(){
		ContenedorPrincipal.getPagina(idContenedorPadre).pagina.btnActualizar();
	}
	
	
	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_orden_compra_det.getLayout()};
	//para el manejo de hijos
	
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	this.InitFunciones(paramFunciones);
	//para agregar botones
	    
	    //this.AdicionarBoton('../../../lib/imagenes/cancel.png','Anular',btn_anular_cotizacion,true,'anular','Anular Cotizaci�n');
	    this.AdicionarBoton('../../../lib/imagenes/print.gif','Nota Adjudicaci�n',btn_resolucion_adjudicacion,true,'resolucion_adjudicacion','Adjudicaci�n');	
	    this.AdicionarBoton('../../../lib/imagenes/detalle.png','Datos Compra',btn_orden_compra,true,'orden_compra','Datos Compra');
		this.AdicionarBoton('../../../lib/imagenes/volver.png','Revertir OC',btn_revertir,true,'revertir','Rev. Adjudicaci�n');
        this.AdicionarBoton('../../../lib/imagenes/print.gif','Rep Orden Compra',btn_orden_compra_rep,true,'orden_compra_rep','OC');
		this.AdicionarBoton('../../../lib/imagenes/print.gif','Orden Ingreso Almacenes',btn_almacenes,true,'registro_almacenes','Ingreso Almac�n');
		this.AdicionarBoton('../../../lib/imagenes/print.gif','Reporte Plan de Pagos',btn_plan_pago_rep,true,'plan_pago_rep','Cronograma Pagos');
		this.AdicionarBoton('../../../lib/imagenes/a_table.png','Pago Adelanto',btn_adelanto,true,'adelanto','Pago Adelanto');
		this.AdicionarBoton('../../../lib/imagenes/print.gif','Anticipo',btn_anticipo,true,'anticipo','Sol.Anticipo');
		this.AdicionarBoton('../../../lib/imagenes/a_table.png','Devengar',btn_devengar,true,'devengar','Devengar Saldo');
		this.AdicionarBoton('../../../lib/imagenes/book_next.png','Fin Servicio',btn_fin_serv,true,'fin_serv','Fin Servicio');
		
		
		var CM_getBoton=this.getBoton;
		CM_getBoton('orden_compra-'+idContenedor).enable();
		CM_getBoton('orden_compra_rep-'+idContenedor).disable();
		CM_getBoton('plan_pago_rep-'+idContenedor).disable();
		CM_getBoton('registro_almacenes-'+idContenedor).disable();
		//CM_getBoton('anular-'+idContenedor).enable();
		CM_getBoton('revertir-'+idContenedor).enable();
		
		function  enable(sel,row,selected){
		    var record=selected.data; 
			if(selected&&record!=-1){
				CM_getBoton('adelanto-'+idContenedor).enable();
				CM_getBoton('anticipo-'+idContenedor).enable();
				CM_getBoton('devengar-'+idContenedor).enable();						
      			//CM_getBoton('anular-'+idContenedor).enable();
			    CM_getBoton('revertir-'+idContenedor).enable();
			     CM_getBoton('fin_serv-'+idContenedor).disable();
			   			if(record.estado_vigente=='adjudicado'){
			   				bloquear='si';
			   				CM_getBoton('revertir-'+idContenedor).enable();
			   				CM_getBoton('orden_compra-'+idContenedor).enable();
			   				CM_getBoton('orden_compra_rep-'+idContenedor).disable();
			   				CM_getBoton('plan_pago_rep-'+idContenedor).disable();
			   				CM_getBoton('registro_almacenes-'+idContenedor).disable();
			   				CM_getBoton('devengar-'+idContenedor).disable();
			   				//CM_getBoton('anular-'+idContenedor).enable();
			   			}else 
			   				{//OC, en_pago, formulacion
			   					CM_getBoton('orden_compra_rep-'+idContenedor).enable();
			   					//CM_getBoton('anular-'+idContenedor).disable();
			   					CM_getBoton('plan_pago_rep-'+idContenedor).enable();
			   					CM_getBoton('registro_almacenes-'+idContenedor).enable();
			   					CM_getBoton('orden_compra-'+idContenedor).enable();
			   				if(record.estado_vigente=='orden_compra'){
			   					bloquear='no';
			   					CM_getBoton('revertir-'+idContenedor).enable();
			   					CM_getBoton('devengar-'+idContenedor).disable();
			   					if(parseFloat(record.por_adelanto)>0 || parseFloat(record.monto_adelanto)>0){
			   						CM_getBoton('anticipo-'+idContenedor).enable();
        							if(record.estado_adelanto=='pagado'||record.estado_adelanto=='solicitado'){
											bloquear='no';
											CM_getBoton('adelanto-'+idContenedor).disable();	
											
									}else{
											CM_getBoton('adelanto-'+idContenedor).enable();
											
											bloquear='si';										}	
								}else{
									CM_getBoton('adelanto-'+idContenedor).disable();	
									
									bloquear='no';
								}
			   				}else 
			   					{ 	bloquear='si';
			   						
			   					
			   					
			   					//CM_getBoton('orden_compra-'+idContenedor).disable();
			   					/**/
									
			   						
			   					
			   					/**/
			   						CM_getBoton('adelanto-'+idContenedor).disable();	
			   						if(record.estado_vigente=='formulacion_pp'){
			   							CM_getBoton('revertir-'+idContenedor).disable();
			   							CM_getBoton('plan_pago_rep-'+idContenedor).enable();
			   						}else if(record.estado_vigente=='en_pago'){
			   							CM_getBoton('fin_serv-'+idContenedor).enable();
			   							CM_getBoton('revertir-'+idContenedor).disable();
			   						}
			   					}
			   			}
			   			if(record.estado_devengado=='pendiente'){
			    			bloquear='si';
			    		}
			   			
						if(bloquear=='si'){
							
							_CP.getPagina(layout_orden_compra_det.getIdContentHijo()).pagina.bloquearMenu();
						}else{
							
							_CP.getPagina(layout_orden_compra_det.getIdContentHijo()).pagina.desbloquearMenu();
						}
				}
			enableSelect(sel,row,selected);
		}
	
	
        
        
	this.iniciaFormulario();
	iniciarEventosFormularios();
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros,
			m_id_proceso_compra:maestro.id_proceso_compra,
			adjudicacion:'si'
		}
	});
	layout_orden_compra_det.getLayout().addListener('layout',this.onResize);
	layout_orden_compra_det.getVentana().addListener('beforehide',salta);
	ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario);
	
}