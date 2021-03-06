/**
* Nombre:		  	    pagina_cotizacion_det.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
* Fecha creaci�n:		2008-05-28 17:32:15
*/
function pagina_cotizacion_det(idContenedor,direccion,paramConfig,maestro,idContenedorPadre)
{
	var Atributos=new Array,sw=0;
	var sw_grup=true,gridG,gSm,id_SCD,ds_g,gDlg;
	var cantidad=0;
	var adj=0;
	var bandera=false;
	
	/////////////////
	//  DATA STORE //
	/////////////////
	var ds = new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/cotizacion_det/ActionListarCotizacionDet.php'}),
		// aqui se define la estructura del XML
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			//id: 'id_cotizacion_det',
			id:'id_item',
			totalRecords: 'TotalCount'

		}, [
		// define el mapeo de XML a las etiquetas (campos)
		
		'supergrupo', 'gru','subgrupo','id1','id2','id3','codigo','id_item','cantidad_solicitada',
		'cantidad','garantia','id_item_cotizado','observaciones','precio','tiempo_entrega','observado','item','id_cotizacion','nombre_cotizado',
		'num_convocatoria','id_adjudicacion'
		,'id_item_aprobado','estado','id_proceso_compra','desc_moneda', 'precio_moneda_cotizada'
		
		]),remoteSort:true});

		//carga datos XML
		ds.load({
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_cotizacion:maestro.id_cotizacion,
				id_proveedor:maestro.id_proveedor
				
			}
		});
		// DEFINICI�N DATOS DEL MAESTRO

		var div_grid_detalle=Ext.DomHelper.append(idContenedor,{tag:'div',id:'grid_detalle-'+idContenedor},true);
		Ext.DomHelper.applyStyles(div_grid_detalle,"background-color:#FFFFFF");
	
		//DATA STORE COMBOS

		var ds_item = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../sis_almacenes/control/item/ActionListarItem.php'}),
		reader: new Ext.data.XmlReader({record:'ROWS',id:'id_item',totalRecords:'TotalCount'},['id_item','codigo','nombre','descripcion','precio_venta_almacen','costo_estimado','stock_min','observaciones','nivel_convertido','estado_registro','fecha_reg','id_unidad_medida_base','id_id3','id_id2','id_id1','id_subgrupo','id_grupo','id_supergrupo','peso_kg','mat_bajo_responsabilidad'])
		});

		//FUNCIONES RENDER

		function render_id_item(value, p, record){return String.format('{0}', record.data['desc_item']);}
		var tpl_id_item=new Ext.Template('<div class="search-item">','<b><i>{codigo}</i></b>','<br><FONT COLOR="#B5A642">{nombre}</FONT>','</div>');


		/////////////////////////
		// Definici�n de datos //
		/////////////////////////

		// hidden id_cotizacion_det
		//en la posici�n 0 siempre esta la llave primaria

		Atributos[0]={
			validacion:{
				//fieldLabel: 'Id',
				labelSeparator:'',
				name: 'id_item',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'item.id_item',
			id_grupo:0
		};


		Atributos[1]={
			validacion:{
				name:'codigo',
				fieldLabel:'Codigo Item',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:90,
				width:'100%',
				disable:false,
				grid_indice:1
			},
			tipo: 'TextField',
			form:false,
			filtro_0:false,
			id_grupo:3
		};


		/********/
		Atributos[2]={
			validacion:{
				name:'supergrupo',
				fieldLabel:'Supergrupo',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:80,
				width:'100%',
				disable:false,
				grid_indice:2
			},
			tipo: 'TextField',
			form: false,
			filtro_0:false,
			id_grupo:0
		};


		Atributos[3]={
			validacion:{
				name:'gru',
				fieldLabel:'Grupo',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:75,
				width:'100%',
				disable:false,
				grid_indice:3
			},
			tipo: 'TextField',
			form:false,
			filtro_0:false,
			id_grupo:0
		};



		Atributos[4]={
			validacion:{
				name:'subgrupo',
				fieldLabel:'Subgrupo',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:85,
				width:'100%',
				disable:false,
				grid_indice:4
			},
			tipo: 'TextField',
			form:false,
			filtro_0:false,
			id_grupo:0
		};


		Atributos[5]={
			validacion:{
				name:'id1',
				fieldLabel:'ID1',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:40,
				width:'100%',
				disable:false,
				grid_indice:5
			},
			tipo: 'TextField',
			form:false,
			filtro_0:false,
			id_grupo:0
		};


		Atributos[6]={
			validacion:{
				name:'id2',
				fieldLabel:'ID2',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:40,
				width:'100%',
				disable:false,
				grid_indice:6
			},
			tipo: 'TextField',
			form:false,
			filtro_0:false,
			id_grupo:0
		};


		Atributos[7]={
			validacion:{
				name:'id3',
				fieldLabel:'ID3',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:40,
				width:'100%',
				disable:false,
				grid_indice:7
			},
			tipo: 'TextField',
			form:false,
			filtro_0:false,
			id_grupo:0
		};



		Atributos[8]={
			validacion:{
				name:'item',
				fieldLabel:'Item',
				allowBlank:false,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				width:'100%',
				disabled:true,
				grid_indice:1
			},
			tipo: 'TextField',
			form:true,
			filtro_0:true,
			filterColValue:'item.nombre',
			save_as:'item',
			id_grupo:1
		};



		Atributos[9]={
			validacion:{
				name:' _solicitada',
				fieldLabel:'Cant. Sol.',
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
				align:'right',
				width_grid:65,
				width:'40%',
				disabled:true,
				grid_indice:9
			},
			tipo:'NumberField',
			form: true,
			filtro_0:true,
			filterColValue:'PRODET.cantidad',
			save_as:'cantidad_solicitada',
			id_grupo:1
		};


		// txt cantidad
		Atributos[10]={
			validacion:{
				name:'cantidad',
				fieldLabel:'Cant. Cot.',
				allowBlank:false,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:false,
				decimalPrecision:0,//para numeros float
				allowNegative:false,
				minValue:1,
				vtype:'texto',
				align:'right',
				grid_visible:true,
				grid_editable:true,
				width_grid:70,
				width:'40%',
				disabled:false,
				grid_indice:10,
				renderer:cantidad_cotizada
			},
			tipo: 'NumberField',
			form: true,
			filtro_0:true,
			filterColValue:'COTDET.cantidad',
			save_as:'cantidad',
			id_grupo:3
		};

		// txt precio
		Atributos[11]={
			validacion:{
				name:'precio_moneda_cotizada',
				fieldLabel:'Precio Unitario',
				allowBlank:false,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:1,
				vtype:'texto',
				grid_visible:true,
				grid_editable:true,
				width_grid:95,
				width:'40%',
				disabled:false,
				align:'right',
				grid_indice:11,
				renderer:precio_cotizado
			},
			tipo: 'NumberField',
			form:true,
			filtro_0:true,
			filterColValue:'COTDET.precio',
			save_as:'precio',
			id_grupo:3
		};

		// txt tiempo_entrega
		Atributos[12]={
			validacion:{
				name:'tiempo_entrega',
				fieldLabel:'Tiempo Entrega Pedido(dias)',
				allowBlank:true,
				maxLength:3,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:false,
				decimalPrecision:0,
				allowDecimals:false,
				grid_editable:false,
				width_grid:100,
				width:'40%',
				disabled:false,
				grid_indice:12
			},
			tipo: 'NumberField',
			form:true,
			filtro_0:false,
			filterColValue:'COTDET.tiempo_entrega',
			save_as:'tiempo_entrega',
			id_grupo:0
		};

		// txt garantia
		Atributos[13]={
			validacion:{
				name:'garantia',
				fieldLabel:'Garantia',
				allowBlank:true,
				maxLength:300,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:true,
				width_grid:100,
				width:'100%',
				disabled:false,
				grid_indice:13//,
				//renderer:cadenas
			},
			tipo: 'TextArea',
			form:true,
			defecto:' ',
			filtro_0:true,
			filterColValue:'COTDET.garantia',
			save_as:'garantia',
			id_grupo:3
		};

		// txt observado
		Atributos[14]={
			validacion:{
				name:'observado',
				fieldLabel:'Observado',
				allowBlank:false,
				typeAhead:true,
				loadMask:true,
				triggerAction:'all',
				store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[['si','si'],['no','no']]}),
				valueField:'ID',
				displayField:'valor',
				lazyRender:true,
				forceSelection:true,
				grid_visible:true,
				grid_editable:true,
				width_grid:82,
				align:'center',
				pageSize:100,
				minListWidth:'100%',
				disabled:false,
				grid_indice:15
			},
			tipo:'ComboBox',
			form:true,
			filtro_0:true,
			filterColValue:'COTDET.observado',
			defecto:'si',
			save_as:'observado',
			id_grupo:3
		};


		// txt observaciones
		Atributos[15]={
			validacion:{
				name:'observaciones',
				fieldLabel:'Observaciones',
				allowBlank:true,
				maxLength:500,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:true,
				width_grid:105,
				width:'100%',
				disable:false,
				grid_indice:14
			},
			tipo: 'TextArea',
			form:true,
			filtro_0:true,
			filterColValue:'COTDET.observaciones',
			save_as:'observaciones',
			id_grupo:3
		};

		// txt id_cotizacion
		Atributos[16]={
			validacion:{
				name:'id_cotizacion',
				labelSeparator:'',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false,
				disabled:true
			},
			tipo:'Field',
			filtro_0:false,
			defecto:maestro.id_cotizacion,
			save_as:'id_cotizacion',
			id_grupo:0
		};
	//	 txt id_item_aprobado
		Atributos[17]={
			validacion:{
				name:'id_item_aprobado',
				fieldLabel:'Id Item',
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
				width_grid:100,
				width:'100%',
				disable:false
			},
			tipo: 'NumberField',
			form:true,
			filtro_0:false,
			filterColValue:'COTDET.id_item_aprobado',
			save_as:'id_item_aprobado',
			id_grupo:0
		};


		// txt id_proceso_compra_det
	/*	Atributos[18]={
			validacion:{
				name:'id_proceso_compra_det',
				fieldLabel:'id_proceso_compra_det',
				allowBlank:false,
				emptyText:'id_proceso_compra_det...',
				desc: 'desc_proceso_compra_det', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_proceso_compra_det,
				valueField: 'id_proceso_compra_det',
				displayField: 'id_proceso_compra_det',
				queryParam: 'filterValue_0',
				filterCol:'SERVIC.nombre#SERVIC.descripcion',
				typeAhead:true,
				tpl:tpl_id_proceso_compra_det,
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
				renderer:render_id_proceso_compra_det,
				grid_visible:false,
				grid_editable:false,
				width_grid:100,
				width:'100%',
				disable:false
			},
			tipo:'ComboBox',
			form:false,
			filtro_0:false,
			filterColValue:'SERVIC_10.nombre#SERVIC_10.descripcion',
			save_as:'id_proceso_compra_det',
			id_grupo:0
		};
		// txt estado_reg
		Atributos[19]={
			validacion:{
				name:'estado_reg',
				fieldLabel:'estado_reg',
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
			form:false,
			filtro_0:false,
			filterColValue:'COTDET.estado_reg',
			save_as:'estado_reg',
			id_grupo:0
		};
		// txt estado
		Atributos[20]={
			validacion:{
				name:'estado',
				fieldLabel:'estado',
				allowBlank:false,
				maxLength:50,
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
			form:false,
			filtro_0:false,
			filterColValue:'COTDET.estado',
			save_as:'estado',
			id_grupo:0
		};




		Atributos[22]={
			validacion:{
				name:'cantidad_adjudicada',
				fieldLabel:'Cantidad Adjudicada',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:0,//para numeros float
				allowNegative:false,
				
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				width:'40%',
				disable:false,
				grid_indice:21
			},
			tipo: 'NumberField',
			form: false,
			filtro_0:false,
			filterColValue:'COTDET.cantidad_adjudicada',
			save_as:'cantidad_adjudicada',
			id_grupo:4
		};
*/
		Atributos[18]={
			validacion:{
				name:'id_item_cotizado',
				desc:'nombre_cotizado',
				fieldLabel:'Codigo Item',
				allowBlank:true,
				maxLength:100,
				minLength:0,
				store:ds_item,
				valueField: 'id_item',
				displayField: 'nombre',
				renderer:render_id_item,
				selectOnFocus:true,
				vtype:"texto",
				grid_visible:false,
				grid_editable:false,
				width_grid:90,
				width:200,
				pageSize:10,
				direccion:direccion,
				grid_indice:20,
				disabled:false
			},
			tipo:'LovItemsAlm',
			save_as:'id_item_cotizado',
			form:true,
			filtro_0:false,
			defecto:'',
			filterColValue:'item_cotizado.nombre',
			id_grupo:2
		};


		Atributos[19]={
			validacion:{
				name:'nombre_cotizado',
				fieldLabel:'Item Cotizado',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:95,
				width:'100%',
				disabled:false
			},
			tipo: 'TextField',
			form: false,
			filtro_0:false,
			filterColValue:'',
			save_as:'nombre_cotizado',
			id_grupo:0
		};



		Atributos[20]={
			validacion:{
				name:'detalle',
				fieldLabel:'Detalle',
				allowBlank:true,
				maxLength:500,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:100,
				width:'100%',
				disabled:true,
				grid_indice:15
			},
			tipo: 'TextArea',
			form:true,
			filtro_0:false,
			save_as:'detalle',
			id_grupo:2
		};

/*
		Atributos[25]={
			validacion:{
				//fieldLabel: 'Id',
				labelSeparator:'',
				name: 'id_solicitud_compra_det',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'id_solicitud_compra_det',
			id_grupo:0
		};
		
		Atributos[26]={
			validacion:{
				//fieldLabel: 'Id',
				labelSeparator:'',
				name: 'monto_aprobado',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:100,
				disabled:false,
			},
			tipo: 'NumberField',
			filtro_0:false,
			save_as:'monto_aprobado',
			id_grupo:0
		};
	*/	
		Atributos[21]={
			validacion:{
				//fieldLabel: 'Id',
				labelSeparator:'',
				name: 'num_convocatoria',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'num_convocatoria',
			id_grupo:0
		};
		
		/*
		Atributos[28]={
			validacion:{
				//fieldLabel: 'Id',
				labelSeparator:'',
				name: 'id_adjudicacion',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'id_adjudicacion',
			id_grupo:0
		};
*/
		
		Atributos[22]={
			validacion:{
				//fieldLabel: 'Id',
				labelSeparator:'',
				name: 'estado',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'estado',
			id_grupo:0
		};

		Atributos[23]={
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
			save_as:'id_proceso_compra',
			id_grupo:0
		};
		
		
		Atributos[24]={
			validacion:{
				name:'desc_moneda',
				fieldLabel:'Moneda',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:100,
				width:'100%',
				disabled:true
			},
			tipo: 'TextField',
			form:true,
			filtro_0:false,
			id_grupo:1
		};
		
		
		Atributos[25]={
			validacion:{
				name:'precio',
				fieldLabel:'Precio Unitario Bs.',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:1,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				align:'right',
				width:'40%',
				disabled:true
			},
			tipo: 'NumberField',
			form:true,
			filtro_0:false,
			save_as:'precio_',
			id_grupo:1
		};

		//----------- FUNCIONES RENDER

		function formatDate(value){return value?value.dateFormat('d/m/Y'):''};
		
		
		

		//---------- INICIAMOS LAYOUT DETALLE
		var config={titulo_maestro:'Cotizaciones ',titulo_detalle:'Detalle de Cotizaciones',grid_maestro:'grid-'+idContenedor};
		var layout_cotizacion_det = new DocsLayoutDetalle(idContenedor,idContenedorPadre);
		layout_cotizacion_det.init(config);



		//---------- INICIAMOS HERENCIA
		this.pagina = Pagina;
		this.pagina(paramConfig,Atributos,ds,layout_cotizacion_det,idContenedor);
		var getComponente=this.getComponente;
		var getSelectionModel=this.getSelectionModel;
		var CM_btnNew=this.btnNew;
		var CM_btnEdit=this.btnEdit;
		var CM_ocultarGrupo=this.ocultarGrupo;
		var CM_mostrarGrupo=this.mostrarGrupo;
		var CM_ocultarComponente=this.ocultarComponente;
		var CM_mostrarComponente=this.mostrarComponente;
		var Cm_conexionFailure=this.conexionFailure;
		var getDialog=this.getDialog;
		var getGrid=this.getGrid;
		var enableSelect=this.EnableSelect;
		var EstehtmlMaestro=this.htmlMaestro;
		//DEFINICI�N DE LA BARRA DE MEN�
		var paramMenu={
			guardar:{crear:true,separador:true},
			actualizar:{crear:true,separador:false}
		};
		//DEFINICI�N DE FUNCIONES

		var paramFunciones={
			btnEliminar:{url:direccion+'../../../control/cotizacion_det/ActionEliminarCotizacionDet.php',parametros:'&m_id_cotizacion='+maestro.id_cotizacion},
			Save:{url:direccion+'../../../control/cotizacion_det/ActionGuardarCotizacionDet.php',parametros:'&m_id_cotizacion='+maestro.id_cotizacion},
			ConfirmSave:{url:direccion+'../../../control/cotizacion_det/ActionGuardarCotizacionDet.php',parametros:'&m_id_cotizacion='+maestro.id_cotizacion},
			Formulario:{html_apply:'dlgInfo-'+idContenedor,height:340,width:480,minWidth:560,minHeight:222,	closable:true,titulo:'Detalle de Cotizaci�n',
			grupos:[{
				tituloGrupo:'Oculto',
				columna:0,
				id_grupo:0
			},{
				tituloGrupo:'Detalle Solicitud',
				columna:0,
				id_grupo:1
			},
			{	tituloGrupo:'Reformular',
				columna:0,
				id_grupo:3
			},
			{	tituloGrupo:'Detalle de Cotizaci�n',
				columna:0,
				id_grupo:4
			},
			{	tituloGrupo:'Adjudicacion',
				columna:0,
				id_grupo:2
			}]}};

			
			var ds_maestro = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_adquisiciones/control/cotizacion/ActionListarCotizacion.php?id_cotizacion='+maestro.id_cotizacion}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_cotizacion',totalRecords: 'TotalCount'},['id_cotizacion',
		'forma_pago','num_cotizacion',
		'desc_proveedor','desc_tipo_categoria_adq','lugar_entrega','desc_moneda'
		])
		});

		ds_maestro.load({
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_cotizacion:maestro.id_cotizacion

			},
			callback:cargar_maestro
		});

		function cargar_maestro(){
			data1=[['N� Cotizacion',ds_maestro.getAt(0).get('num_cotizacion')],  ['Categoria',ds_maestro.getAt(0).get('desc_tipo_categoria_adq')],  
			 ['Forma Pago',ds_maestro.getAt(0).get('forma_pago')],['Proveedor',ds_maestro.getAt(0).get('desc_proveedor')],   ['Lugar Entrega',ds_maestro.getAt(0).get('lugar_entrega')],['Moneda',ds_maestro.getAt(0).get('desc_moneda')]  ];
			Ext.DomHelper.overwrite('grid_detalle-'+idContenedor,EstehtmlMaestro(data1));
		}
			
			//-------------- Sobrecarga de funciones --------------------//
			this.reload=function(params){
				
				this.btnActualizar();
				var datos=Ext.urlDecode(decodeURIComponent(params));
				maestro.id_cotizacion=datos.m_id_cotizacion;
				maestro.observaciones=datos.m_observaciones;
				maestro.num_proceso=datos.m_num_proceso;
				maestro.desc_proveedor=datos.m_desc_proveedor;
				maestro.estado_vigente=datos.m_estado_vigente;
				maestro.id_moneda=datos.m_id_moneda;
				maestro.id_moneda_base=datos.m_id_moneda_base;
				maestro.id_proveedor=datos.m_id_proveedor;
				
				ds_maestro.load({
				params:{
					start:0,
					limit: paramConfig.TamanoPagina,
					CantFiltros:paramConfig.CantFiltros,
					id_cotizacion:maestro.id_cotizacion,
					id_proveedor:maestro.id_proveedor

				},
				callback:cargar_maestro
			}); 
				ds.lastOptions={
					params:{
						start:0,
						limit: paramConfig.TamanoPagina,
						CantFiltros:paramConfig.CantFiltros,
						m_id_cotizacion:maestro.id_cotizacion,
						id_proveedor:maestro.id_proveedor
					}
				};
				this.btnActualizar();
				iniciarEventosFormularios();
		
				
				Atributos[16].defecto=maestro.id_cotizacion;
				
				paramFunciones.btnEliminar.parametros='&m_id_cotizacion='+maestro.id_cotizacion;
				paramFunciones.Save.parametros='&m_id_cotizacion='+maestro.id_cotizacion;
				paramFunciones.ConfirmSave.parametros='&m_id_cotizacion='+maestro.id_cotizacion;

				this.iniciarEventosFormularios;
				this.InitFunciones(paramFunciones)
			};
			
			
		function cantidad_cotizada(val,cell,record,row,colum,store){
			if(record.data.cantidad==0){
				return '<span style="color:red;font-size:8pt">' + val + '</span>';
			}else{
				return val;
			}
				
		}
		
		function precio_cotizado(val,cell,record,row,colum,store){
			 	
			if(record.data.precio_moneda_cotizada>0){
				return val;
		    }else {
			 	return '<span style="color:red;font-size:8pt">' + val + '</span>';
			}
		}
		
		
		function cadenas(val,cell,record,row,colum,store){
			//if(colum==11){
				var cadena='sin garantia';
					if(record.data.garantia=='falta_definir'){
						return '<span style="color:red;font-size:8pt">' + val + '</span>';
					}else{
						return val;
					}
				
			//}
		}

		
		
			//Para manejo de eventos
			function iniciarEventosFormularios(){
				//para iniciar eventos en el formulario
				
				

				txt_cantidad_solicitada=getComponente('cantidad_solicitada');
				txt_cantidad=getComponente('cantidad');
				var txt_cantidad_adjudicada;
				txt_descripcion=getComponente('detalle');
				cmb_Item=getComponente('id_item_cotizado');

				
				var verificarCant=function(e){
						if(e.column==8){
							
							if(parseFloat(e.record.data.cantidad_solicitada)>=parseFloat(e.record.data.cantidad)){
					    	}else{
					   			//if((parseFloat(e.value))>(parseFloat(e.record.data.cantidad))){
					   			//getComponente('cantidad').markInvalid('Cantidad excesiva...'); 
					   			Ext.MessageBox.alert('Cantidad','la cantidad a cotizar no debe ser mayor a '+e.record.data.cantidad_solicitada);
						        	  e.record.set('cantidad', e.originalValue);
								   }
					   			//}
				    	  }
					}
				
				gridG=getGrid();
				gridG.on('afteredit',verificarCant);
		
				
				
				
				
				

				var onItemSelect=function(e){

					rec=cmb_Item.lov.getSelect();

					//txt_precio.setValue(rec["costo_estimado"]);

					txt_descripcion.setValue(rec["descripcion"] +'\n(Supergrupo: '+rec["nombre_supg"]+' -  Grupo:'+rec["nombre_grupo"]+' -  Subgrupo:'+rec["nombre_subg"]+' -  ID1:'+rec["nombre_id1"]+' -  ID2:'+rec["nombre_id2"]+' -  ID3:'+rec["nombre_id3"]+')');

					//getComponente('id_item_cotizado').setValue(rec["id_item"]);

					get_caracteristicas_item(rec["id_item"]);

				};

				function get_caracteristicas_item($id_item){

					Ext.Ajax.request({
						url:direccion+"../../../../sis_almacenes/control/caracteristica_item/ActionListarCaracteristicaItem.php?maestro_id_item="+$id_item,
						method:'GET',
						success:cargar_caracteristicas,
						failure:Cm_conexionFailure,
						timeout:1000000000
					});
				}

				function cargar_caracteristicas(resp){
					//Ext.MessageBox.hide();
					if(resp.responseXML != undefined && resp.responseXML != null && resp.responseXML.documentElement != null && resp.responseXML.documentElement != undefined)
					{
						var root = resp.responseXML.documentElement;

						if(root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue >0){
							txt_descripcion.setValue(txt_descripcion.getValue()+ '\n\nTipo Caracteristica:'+ root.getElementsByTagName('desc_tipo_caracteristica')[0].firstChild.nodeValue+ '\nCaracteristica:'+ root.getElementsByTagName('desc_caracteristica')[0].firstChild.nodeValue);

						}
					}
				}




				var onCantidad=function(){

					//txt_cantidad_adjudicada.allowBlank=true;
					if(txt_cantidad.getValue() >txt_cantidad_solicitada.getValue()){
						txt_cantidad.markInvalid("La cantidad cotizada no puede ser mayor a la solicitada");

						var Dialog= getDialog();
						//gDlg.buttons[0].disable();
					}
					else{
						txt_cantidad.clearInvalid();

						var Dialog= getDialog();
						//gDlg.buttons[0].enable();
					}
				}


				var onCantidadAdj=function(){
					//txt_cantidad_adjudicada.allowBlank=false;
					if(txt_cantidad_adjudicada.getValue() >txt_cantidad.getValue()){

						txt_cantidad_adjudicada.markInvalid("La cantidad adjudicada no puede ser mayor a "+txt_cantidad.getValue());
						txt_cantidad_adjudicada.allowBlank=false;

						var Dialog= getDialog();
						//gDlg.buttons[0].disable();
					}
					else{
						txt_cantidad_adjudicada.clearInvalid();

						//txt_precio.enable();
						//txt_tiempo.enable();
						var Dialog= getDialog();
						
						//gDlg.buttons[0].enable();
					}
				}


			//	txt_cantidad.on('change', onCantidad);
//				txt_cantidad.on('blur', onCantidad);
		//		txt_cantidad_adjudicada.on('change', onCantidadAdj);
			//	txt_cantidad_adjudicada.on('blur', onCantidadAdj);

				cmb_Item.on('change',onItemSelect);
				cmb_Item.on('select',onItemSelect);

			}





			this.btnNew=function(){
				CM_ocultarGrupo('Oculto');
				CM_ocultarGrupo('Adjudicacion');
				CM_ocultarGrupo('Reformular');
				CM_btnNew();
			}

			this.btnEdit=function(){
				CM_ocultarGrupo('Oculto');
				CM_ocultarGrupo('Adjudicacion');
				CM_ocultarGrupo('Reformular');
				//getComponente('tiempo_entrega'),enable();
				//getComponente('precio').enable();
				CM_btnEdit();
			}


			




			function btn_cotizar_otro(){
				
				var sm=getSelectionModel();
				var filas=ds.getModifiedRecords();
				var cont=filas.length;
				var NumSelect=sm.getCount();
				if(NumSelect!=0){
					var SelectionsRecord=sm.getSelected();
					//if(maestro.estado_vigente=='aperturado' || SelectionsRecord.data.estado=='cotizado'){   ////descomentar, esta verificaci�n debe ser contemplada
					
					//verificar si ya fu� ape
				
					CM_ocultarGrupo('Oculto');
					CM_ocultarGrupo('Adjudicacion');
					CM_mostrarGrupo('Detalle Solicitud');
					CM_mostrarGrupo('Detalle de Cotizaci�n');
					CM_mostrarGrupo('Reformular');
					
					getComponente('id_item_cotizado').allowBlank=false;
					getComponente('precio_moneda_cotizada').enable();
					getComponente('cantidad').enable();
					getComponente('tiempo_entrega').enable();
					getComponente('cantidad').maxValue=getComponente('cantidad_solicitada').getValue();
					CM_mostrarComponente(getComponente('cantidad_solicitada'));
					CM_mostrarComponente(getComponente('garantia'));
					CM_mostrarComponente(getComponente('observado'));
					CM_mostrarComponente(getComponente('observaciones'));
					if(SelectionsRecord.data.precio>0){
						CM_mostrarComponente(getComponente('precio'));
						getComponente('precio').disable();
					}else{
						CM_ocultarComponente(getComponente('precio'));
					}
					CM_btnEdit();
					/*}
				else{
					Ext.MessageBox.alert('Estado', 'Solo cotizaciones que esten en estado aperturado')
				}*/
				}
				else{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
				}
			}
			
				
//			
					
			
			this.EnableSelect=function(x,z,y){
		   		enable(x,z,y)
			}
			
			function salta(){
				ContenedorPrincipal.getPagina(idContenedorPadre).pagina.btnActualizar();
			}
			
			//para que los hijos puedan ajustarse al tama�o
			this.getLayout=function(){return layout_cotizacion_det.getLayout()};
			//para el manejo de hijos

			this.Init(); //iniciamos la clase madre
			this.InitBarraMenu(paramMenu);
			this.InitFunciones(paramFunciones);
			//para agregar botones
		//	this.AdicionarBoton('../../../lib/imagenes/menu-show.gif','Registro de Cotizaciones',btn_cotizacion_reg,true,'registro_cotizacion_item','Registro Propuestas');
			this.AdicionarBoton('../../../lib/imagenes/menu-show.gif','Cotizar Otro Item',btn_cotizar_otro,true,'cotizar_otro_item','Cotizar Otro Item');
			var CM_getBoton=this.getBoton;
			//CM_getBoton('registro_cotizacion_item-'+idContenedor).enable();
			CM_getBoton('cotizar_otro_item-'+idContenedor).enable();
			
			function  enable(sel,row,selected){
				var record=selected.data; 
					if(selected&&record!=-1){
						//CM_getBoton('registro_cotizacion_item-'+idContenedor).enable();
						CM_getBoton('cotizar_otro_item-'+idContenedor).enable();
						/*if(record.id_item_cotizado>0){
									CM_getBoton('registro_cotizacion_item-'+idContenedor).disable();
								}*/
						}
					enableSelect(sel,row,selected);
			}
	
			
			this.iniciaFormulario();
			iniciarEventosFormularios();
			layout_cotizacion_det.getLayout().addListener('layout',this.onResize);
			layout_cotizacion_det.getVentana().addListener('beforehide',salta);
			ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario);

}
