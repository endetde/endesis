/**
 * Nombre:		  	    pagina_orden_compra_det.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-05-28 17:32:05
 */
function pagina_orden_compra_tasa(idContenedor,direccion,paramConfig,maestro,idContenedorPadre)
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
		'categoria','num_pagos','precio_total_moneda_cotizada','todo_pagado','falta_anular','precio_total_adjudicado','numeracion_periodo','id_auxiliar','pago_completado','factura_total','num_autoriza_factura','cod_control_factura',{name: 'fecha_factura',type:'date',dateFormat:'Y-m-d'},'numeracion_oc','precio_total_adjudicado_con_impuestos','justificacion_adjudicacion','tipo_pago','id_caja','caja','id_cajero','cajero','avance','id_depto_tesoro','depto_tesoro','cant_pagos_def','habilita_otra_gestion','tipo_documento','desc_documento','por_adelanto','por_retgar','estado_adelanto','estado_retgar','avance_habilitado','monto_adelanto','monto_adelanto_moneda_cotizada','nro_contrato','con_contrato','total_dcto_anticipo'
		]),remoteSort:true});

	//carga datos XML
	
	// DEFINICI�N DATOS DEL MAESTRO


	
	//DATA STORE COMBOS

 
	
		var ds_depto_tesoro = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/depto/ActionListarDepartamento.php?tesoro=1'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_caja',totalRecords: 'TotalCount'},['id_depto','codigo_depto','nombre_depto'])
		});
		
		function render_id_depto_tesoro(value, p, record){return String.format('{0}', record.data['depto_tesoro']);}
		var tpl_id_depto_tesoro=new Ext.Template('<div class="search-item">','<b><i>{codigo_depto} </b></i>,<br><FONT COLOR="#B5A642">{nombre_depto}</FONT>','</div>');
			
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
	
	 Atributos[2]={//==> se usa//30
			validacion: {
			name:'tipo_pago',
			fieldLabel:'Tipo de Pago',
			allowBlank:false,
			typeAhead:true,
			loadMask:true,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[['devengado','Cheque'],['transferencia','Transferencia Bancaria']]}),
			valueField:'ID',
			displayField:'valor',
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
	
	
	Atributos[3]={//9
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
	
	
	Atributos[4]={//31
			validacion:{
				name:'id_depto_tesoro',
				fieldLabel:'Departamento de Tesoreria',
				allowBlank:true,
				emptyText:'Depto Tesoreria...',
				desc: 'depto_tesoro', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_depto_tesoro,
				valueField: 'id_depto',
				displayField: 'nombre_depto',
				queryParam: 'filterValue_0',
				filterCol:'DEPTO_TESORO.codigo_depto#DEPTO_TESORO.nombre_depto',
				typeAhead:true,
				tpl:tpl_id_depto_tesoro,
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
			filterColValue:'DEPTO.nombre_depto#DEPTO.codigo_depto',
			save_as:'id_depto_tesoro',
			id_grupo:1
		};
	
	Atributos[5]={//==> SI
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
		filterColValue:'PERSON_15.apellido_paterno#PERSON_15.apellido_materno#PERSON_15.nombre#INSTIT.nombre',
		save_as:'id_proveedor',
		id_grupo:2  //1
	};
	
	// txt fecha_validez_oferta ==> se usa
	Atributos[6]= {
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
		id_grupo:3
	};
	
	
	Atributos[7]={//==> SI
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
		defecto:maestro.num_cotizacion,
		filterColValue:'MONEDA.nombre',
		save_as:'id_monedas',
		id_grupo:0  //1
	};

	
	

	// txt tipo_entrega  ==> se usa
	Atributos[8]={
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


   

	// txt lugar_entrega ==> se usa
	Atributos[9]={//14
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
		id_grupo:3  //1
		
	};
	
	
// txt estado_vigente
	Atributos[10]={//==>SI//16
		validacion:{
			name:'estado_vigente',
			fieldLabel:'Estado',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			width:'100%',
			disable:false,
			grid_indice:2	
		},
		tipo: 'TextField',
		form: false
	};


	
	Atributos[11]={//18
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
		id_grupo:2
	};
	
	Atributos[12]={//26
		validacion:{
			name:'numeracion_oc',
			fieldLabel:'Orden Compra',
			grid_visible:true,
			grid_editable:false,
			width_grid:85,
			align:'right',
			width:'100%',
			disabled:false,
			grid_indice:7		
		},
		tipo: 'TextField',
		form: false
	};
	Atributos[13]={//27
		validacion:{
			name:'categoria',
			fieldLabel:'Modalidad',
			allowBlank:false,
			maxLength:30,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:false,
			grid_editable:false,
			width_grid:100,
			width:'100%',
			disabled:true,
			grid_indice:1		
		},
		tipo: 'TextField',
		filtro_0:false,
		save_as:'categoria',
		id_grupo:3
	};
	// txt observaciones
	Atributos[14]={//==>SI//29
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
		id_grupo:3  //1
	};

// txt forma_pago ==se usa
	
	
	//todo_pagado==> permitir� finalizar el plan de pagos
	Atributos[15]={//32
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
	
	
	Atributos[16]={//33
		validacion:{
			//fieldLabel: 'Id',
			labelSeparator:'',
			name: 'falta_anular',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		save_as:'falta_anular'
	};
	
		
	Atributos[17]={//35
		validacion:{
			name:'numeracion_periodo',
			fieldLabel:'Periodo/No Cot.',
			grid_visible:true,
			grid_editable:false,
			width_grid:85,
			align:'right',
			grid_indice:2
		},
		tipo: 'TextField',
		form:false
	};
	
	Atributos[18]={//==> SI//42
		validacion:{
			name:'por_adelanto',
			fieldLabel:'% Adelanto',
			allowBlank:true,
			maxLength:5,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
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
			grid_indice:16
		},
		tipo: 'NumberField',
		form: true,
		defecto:0,
		filtro_0:false,
		filterColValue:'COTIZA.por_adelanto',
		save_as:'por_adelanto',
		id_grupo:4  //1
	};
	
	
	Atributos[19]={//==> SI//42
		validacion:{
			name:'por_retgar',
			fieldLabel:'% Retenci�n por Garantia',
			allowBlank:true,
			maxLength:5,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
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
		id_grupo:4  //1
	};
	
	Atributos[20]={//==> SI//42
		validacion:{
			name:'monto_adelanto_moneda_cotizada',
			fieldLabel:'Monto de Adelanto',
			allowBlank:true,
			maxLength:10,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
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
		id_grupo:4  //1
	};
	
	
	Atributos[21]={//40
			validacion:{
				name:'estado_adelanto',
				fieldLabel:'Estado Adelanto',
				allowBlank:true,
				maxLength:20,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
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
		
		
		
		Atributos[22]={//40
			validacion:{
				name:'estado_retgar',
				fieldLabel:'Estado RetGar',
				allowBlank:true,
				maxLength:20,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
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
		
	Atributos[23]={
		validacion:{
			//fieldLabel: 'Id',
			labelSeparator:'',
			name: 'factura_total',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false
		
	};
	Atributos[24]={//==> se usa//30
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
		id_grupo:5
	};
	
	Atributos[25]= {
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
		id_grupo:5
	};
	
		
		
	
	
	//----------- FUNCIONES RENDER
	
	function formatDate(value){return value?value.dateFormat('d/m/Y'):''};
	
			
	function tipo_pago(val,cell,record,row,colum,store){
					  
					if(val=='devengado')
					   return 'Cheque';
					else
					   return 'Transferencia Bancaria';	
					    
					
	};

	//---------- INICIAMOS LAYOUT DETALLE
	var config={titulo_maestro:'Orden de Compra',grid_maestro:'grid-'+idContenedor, urlHijo:'../../../sis_adquisiciones/vista/plan_pago/plan_pago_tasa.php'};
	
	var layout_orden_compra_det= new DocsLayoutMaestroDeatalle(idContenedor,idContenedorPadre);
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
	
	
	
//DEFINICI�N DE LA BARRA DE MEN�
	var paramMenu={
	
	actualizar:{crear:true,separador:false}};
//DEFINICI�N DE FUNCIONES
	
	var paramFunciones={
	Save:{url:direccion+'../../../control/cotizacion/ActionGuardarCotizacionOrdenCompra.php',parametros:'&m_id_proceso_compra='+maestro.id_proceso_compra},
	
	Formulario:{html_apply:'dlgInfo-'+idContenedor,height:370,width:680,minWidth:450,minHeight:230,	closable:true,titulo:'Orden compra',columnas:['47%','47%'],
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
			tituloGrupo:'Proveedor',
			columna:0,
			id_grupo:2
		},
		{
			tituloGrupo:'Orden de Compra',
			columna:1,
			id_grupo:3
		},{
			tituloGrupo:'Retenciones',
			columna:1,
			id_grupo:4
		},{
			tituloGrupo:'Contrato',
			columna:1,
			id_grupo:5
		}
		
	]}};
	
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
		maestro.factura_total=datos.m_factura_total;
		maestro.avance=datos.m_avance;
		

		ds.lastOptions={
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_proceso_compra:maestro.id_proceso_compra
				//adjudicacion:'si'
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
	
	
	
	
	
function btn_orden_compra(){
	
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		var SelectionsRecord=sm.getSelected();
		if(NumSelect!=0){
			
			if(parseFloat(SelectionsRecord.data.id_auxiliar)>0){
					ds_depto_tesoro.baseParams={
						estado:2,id_cotizacion:SelectionsRecord.data.id_cotizacion
					}
					getComponente('id_depto_tesoro').modificado=true;
					getComponente('factura_total').setValue('no');
					CM_btnEdit();
    				var dialog=CM_dialog();
    				dialog.buttons[0].setText('Guardar Datos');
    				dialog.buttons[0].enable();
    			
    			
			}else{
			    Ext.MessageBox.alert('Estado','El proveedor necesita tener una cuenta-auxiliar asociada para que se emita la Orden de Compra correspondiente');
			}
		}else{
		  Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
	    }
	this.btnActualizar;
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
			
			
				
		
	//Para manejo de eventos
	function iniciarEventosFormularios(){
		
		for (var i=0;i<Atributos.length;i++){
			componentes[i]=getComponente(Atributos[i].validacion.name);
			
		}
		CM_ocultarGrupo('Oculto');
		getComponente('observaciones').setValue('');
	 	getSelectionModel().on('rowdeselect',function(){
						if(_CP.getPagina(layout_orden_compra_det.getIdContentHijo()).pagina.limpiarStore()){
							if(bloquear=='si'){
							   _CP.getPagina(layout_orden_compra_det.getIdContentHijo()).pagina.bloquearMenu();
							}else{
								_CP.getPagina(layout_orden_compra_det.getIdContentHijo()).pagina.desbloquearMenu();
							}
						}
					})
				
	}
	
	this.EnableSelect=function(x,z,y){
		_CP.getPagina(layout_orden_compra_det.getIdContentHijo()).pagina.reload(y.data);
		enable(x,z,y);
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

			
	function revertido(resp){
	    if(resp.responseXML!=undefined && resp.responseXML!=null&& resp.responseXML.documentElement!=null &&resp.responseXML.documentElement!=undefined){
				var root=resp.responseXML.documentElement;
	
				  if(root.getElementsByTagName('error')[0].firstChild.nodeValue=='false'){
				      alert(root.getElementsByTagName('mensaje')[0].firstChild.nodeValue);
				  }
				   ds.load({
						params:{
							start:0,
							limit: paramConfig.TamanoPagina,
							CantFiltros:paramConfig.CantFiltros,
							m_id_proceso_compra:maestro.id_proceso_compra,
						//	adjudicacion:'si',
							m_tipo:'1'
						}
					});
	    }
	    
	}

	function btn_fin_serv(){
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		var SelectionsRecord=sm.getSelected();
			if(NumSelect!=0){
				if(SelectionsRecord.data.todo_pagado<SelectionsRecord.data.precio_total_adjudicado_con_impuestos){
					if(confirm('El servicio tiene pagos pendientes que seran revertidos si lo finaliza. Desea Continuar?')){
						var data1='cantidad_ids=1'+'&id_cotizacion='+SelectionsRecord.data.id_cotizacion+'&fin=1';
									Ext.Ajax.request({url:direccion+"../../../control/cotizacion/ActionTerminarCotizacion.php",
									params:data1,
									method:'POST',
									failure:CM_conexionFailure,
									success:revertido,
									timeout:100000000});		
								}
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
	    
	    
	    this.AdicionarBoton('../../../lib/imagenes/print.gif','Nota Adjudicaci�n',btn_resolucion_adjudicacion,true,'resolucion_adjudicacion','Nota de Adjudicaci�n');	
	    this.AdicionarBoton('../../../lib/imagenes/print.gif','Rep Orden Compra',btn_orden_compra_rep,true,'orden_compra_rep','OC');
	  //  this.AdicionarBoton('../../../lib/imagenes/volver.png','Revertir OC',btn_revertir,true,'revertir','Revertir Adjudicaci�n');
	    this.AdicionarBoton('../../../lib/imagenes/book_next.png','Pagar Adelanto',btn_adelanto,true,'adelanto','Pagar Adelanto');
	    //this.AdicionarBoton('../../../lib/imagenes/book_next.png','Fin Servicio',btn_fin_serv,true,'fin_serv','Fin Servicio');
     	 this.AdicionarBoton('../../../lib/imagenes/print.gif','Anticipo',btn_anticipo,true,'anticipo','Anticipo');
     	 
     	 	
		var CM_getBoton=this.getBoton;
		CM_getBoton('orden_compra-'+idContenedor).enable();
		//CM_getBoton('orden_compra_rep-'+idContenedor).disable();
		CM_getBoton('revertir-'+idContenedor).enable();
		
		function  enable(sel,row,selected){
		    var record=selected.data;
		    if(selected&&record!=-1){
				CM_getBoton('adelanto-'+idContenedor).enable();					
				CM_getBoton('fin_serv-'+idContenedor).disable();		
			    CM_getBoton('revertir-'+idContenedor).enable();
			    
			    if((record.estado_vigente=='en_pago')){
			    	CM_getBoton('adelanto-'+idContenedor).disable();
			    	CM_getBoton('fin_serv-'+idContenedor).enable();		
					bloquear='no';
					CM_getBoton('orden_compra-'+idContenedor).disable();
					CM_getBoton('revertir-'+idContenedor).disable();
			    }
			    else{
			    	if(record.estado_vigente=='orden_compra'){
			    		if(record.estado_adelanto=='pendiente')
			    			CM_getBoton('adelanto-'+idContenedor).enable();	
			    		bloquear='no';
			    	}
			    	else{
			    		CM_getBoton('adelanto-'+idContenedor).disable();
			    		bloquear='si';
			    	}
			    	CM_getBoton('orden_compra-'+idContenedor).enable();
					CM_getBoton('revertir-'+idContenedor).enable();	
			    	
			    }
			    
			    if(bloquear=='si')
						_CP.getPagina(layout_orden_compra_det.getIdContentHijo()).pagina.bloquearMenu();
				else		
						_CP.getPagina(layout_orden_compra_det.getIdContentHijo()).pagina.desbloquearMenu();
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
		//	adjudicacion:'si',
			m_tipo:'1'
		}
	});
	layout_orden_compra_det.getLayout().addListener('layout',this.onResize);
	layout_orden_compra_det.getVentana().addListener('beforehide',salta);
	ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario);
	
}