/**
* Nombre:		  	    pagina_ingreso_detalle_det.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
* Fecha creaci�n:		2007-10-17 12:33:25
*/
function pagina_orden_ingreso_aprob_det(idContenedor,direccion,paramConfig,maestro,idContenedorPadre)
{
	var vectorAtributos=new Array;
	var ds;
	var elementos=new Array();
	var sw=0;
	/////////////////
	//  DATA STORE //
	/////////////////
	ds = new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/ingreso_detalle/ActionListarOrdenIngresoSolDet.php'}),
		// aqui se define la estructura del XML
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_ingreso_detalle',
			totalRecords: 'TotalCount'

		}, [
		// define el mapeo de XML a las etiquetas (campos)
		'id_ingreso_detalle',
		'cantidad',
		'costo',
		'precio_venta',
		'costo_unitario',
		'precio_venta_unitario',
		{name: 'fecha_reg',type:'date',dateFormat:'Y-m-d'},
		'id_ingreso',
		'desc_ingreso',
		'desc_item',
		'id_item'

		]),remoteSort:true});

		//carga datos XML
		ds.load({
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_ingreso:maestro.id_ingreso
			}
		});
		// DEFINICI�N DATOS DEL MAESTRO
		var dataMaestro=[['C�digo',maestro.codigo],['Descripci�n',maestro.descripcion]];

		var dsMaestro = new Ext.data.Store({proxy: new Ext.data.MemoryProxy(dataMaestro),reader: new Ext.data.ArrayReader({id:0},[{name:'atributo'},{name:'valor'}])});
		dsMaestro.load();
		var cmMaestro = new Ext.grid.ColumnModel([{header:"Atributo",width:150,sortable:false,renderer:negrita,locked:false,dataIndex:'atributo'},{header:"Valor",width: 300,sortable:false,renderer:italic,locked:false,dataIndex:'valor'}]);
		function negrita(value){return '<span style="color:red;font-size:10pt"><b>'+value+'</b></span>';}
		function italic(value){return '<i>'+value+'</i>';}
		var div_grid_detalle=Ext.DomHelper.append(idContenedor,{tag:'div',id:'grid_detalle-'+idContenedor});
		var gridMaestro=new Ext.grid.Grid(div_grid_detalle,{ds:dsMaestro,cm:cmMaestro});
		gridMaestro.render();
		//DATA STORE COMBOS

		ds_item = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/item/ActionListarItem.php'}),
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_item',
			totalRecords: 'TotalCount'
		}, ['id_item','codigo','nombre','descripcion','precio_venta_almacen','costo_estimado','costo_almacen','stock_min','stock_total','observaciones','nivel_convertido','estado_item','estado_registro','fecha_reg','id_unidad_medida_base','id_id3','id_id2','id_id1','id_subgrupo','id_grupo','id_supergrupo'])
		});

		//FUNCIONES RENDER

		function render_id_item(value, p, record){return String.format('{0}', record.data['desc_item']);};

		/////////////////////////
		// Definici�n de datos //
		/////////////////////////

		// hidden id_ingreso_detalle
		//en la posici�n 0 siempre esta la llave primaria

		vectorAtributos[0] = {
			validacion:{
				//fieldLabel: 'Id',
				labelSeparator:'',
				name: 'id_ingreso_detalle',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'hidden_id_ingreso_detalle'
		};
		// txt cantidad
		vectorAtributos[1]= {
			validacion:{
				name:'cantidad',
				fieldLabel:'Cantidad',
				allowBlank:false,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision :2,//para numeros float
				allowNegative: false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:100
			},
			tipo: 'NumberField',
			filtro_0:true,
			filtro_1:true,
			filterColValue:'INGDET.cantidad',
			save_as:'txt_cantidad'
		};
		// txt costo
		vectorAtributos[2]= {
			validacion:{
				name:'costo',
				fieldLabel:'Costo',
				allowBlank:false,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision :2,//para numeros float
				allowNegative: false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:100
			},
			tipo: 'NumberField',
			filtro_0:true,
			filtro_1:true,
			filterColValue:'INGDET.costo',
			save_as:'txt_costo'
		};
		// txt precio_venta
		vectorAtributos[3] = {
			validacion:{
				name:'precio_venta',
				fieldLabel:'Precio venta',
				allowBlank:false,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision :2,//para numeros float
				allowNegative: false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:100
			},
			tipo: 'NumberField',
			filtro_0:true,
			filtro_1:true,
			filterColValue:'INGDET.precio_venta',
			save_as:'txt_precio_venta'
		};
		// txt costo_unitario
		vectorAtributos[4]= {
			validacion:{
				name:'costo_unitario',
				fieldLabel:'Costo unitario',
				allowBlank:false,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision :2,//para numeros float
				allowNegative: false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:100
			},
			tipo: 'NumberField',
			filtro_0:true,
			filtro_1:true,
			filterColValue:'INGDET.costo_unitario',
			save_as:'txt_costo_unitario'
		};
		// txt precio_venta_unitario
		vectorAtributos[5]= {
			validacion:{
				name:'precio_venta_unitario',
				fieldLabel:'Precio venta unitario',
				allowBlank:false,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision :2,//para numeros float
				allowNegative: false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:100
			},
			tipo: 'NumberField',
			filtro_0:true,
			filtro_1:true,
			filterColValue:'INGDET.precio_venta_unitario',
			save_as:'txt_precio_venta_unitario'
		};
		// txt fecha_reg
		vectorAtributos[6] = {
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
				width_grid:85
			},
			tipo:'DateField',
			filtro_0:true,
			filtro_1:true,
			filterColValue:'INGDET.fecha_reg',
			dateFormat:'m-d-Y',
			defecto:'',
			save_as:'txt_fecha_reg'
		};
		// txt id_ingreso
		vectorAtributos[7]= {
			validacion:{
				name:'id_ingreso',
				labelSeparator:'',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false,
				disabled:true
			},
			tipo:'Field',
			filtro_0:false,
			defecto:maestro.id_ingreso,
			save_as:'txt_id_ingreso'
		};
		// txt id_item
		vectorAtributos[8] = {
			validacion: {
				name:'id_item',
				fieldLabel:'Material',
				allowBlank:false,
				emptyText:'id_item...',
				name: 'id_item',     //indica la columna del store principal ds del que proviane el id
				desc: 'desc_item', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_item,
				valueField: 'id_item',
				displayField: 'codigo',
				queryParam: 'filterValue_0',
				filterCol:'ITEM.codigo#ITEM.nombre#ITEM.descripcion',
				typeAhead:true,
				forceSelection:true,
				mode:'remote',
				queryDelay:250,
				pageSize:100,
				minListWidth:450,
				grow:true,
				width:'100%',
				//grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_id_item,
				grid_visible:true,
				grid_editable:false,
				width_grid:100 // ancho de columna en el gris
			},
			tipo:'ComboBox',
			filtro_0:true,
			filtro_1:true,
			filterColValue:'ITEM.codigo',
			defecto: '',
			save_as:'txt_id_item'
		};
		
		//----------- FUNCIONES RENDER

		function formatDate(value){
			return value ? value.dateFormat('d/m/Y') : '';
		};

		//---------- INICIAMOS LAYOUT DETALLE
		var config={
			titulo_maestro:'Aprobar Orden de Ingreso (Maestro)',
			titulo_detalle:'Detalle Orden Ingreso (Aprobaci�n) (Detalle)',
			grid_maestro:'grid-'+idContenedor
		};
		layout_ingreso_detalle = new DocsLayoutDetalle(idContenedor,idContenedorPadre);
		layout_ingreso_detalle.init(config);



		//---------- INICIAMOS HERENCIA
		this.pagina = Pagina;
		this.pagina(paramConfig,vectorAtributos,ds,layout_ingreso_detalle,idContenedor);
		var getSelectionModel=this.getSelectionModel;
		var ClaseMadre_getComponente=this.getComponente;
		var ClaseMadre_conexionFailure=this.conexionFailure;
		var ClaseMadre_btnNew=this.btnNew;
		var ClaseMadre_onResize=this.onResize;
		var ClaseMadre_SaveAndOther=this.SaveAndOther;
		//-------- DEFINICI�N DE LA BARRA DE MEN�


		var paramMenu={
			//guardar:{crear:true,separador:false},
			//nuevo:{crear:true,separador:true},
			//editar:{crear:true,separador:false},
			//eliminar:{crear:true,separador:false},
			actualizar:{crear:true,separador:false}
		};



		//--------- DEFINICI�N DE FUNCIONES
		//aqu� se parametrizan las funciones que se ejecutan en la clase madre

		//datos necesarios para el filtro
		var paramFunciones={
			btnEliminar:{url:direccion+'../../../control/ingreso_detalle/ActionEliminarIngresoDetalle.php',parametros:'&m_id_ingreso='+maestro.id_ingreso},
			Save:{url:direccion+'../../../control/ingreso_detalle/ActionGuardarOrdenIngresoSolDet.php',parametros:'&m_id_ingreso='+maestro.id_ingreso},
			ConfirmSave:{url:direccion+'../../../control/ingreso_detalle/ActionGuardarOrdenIngresoSolDet.php'},
			Formulario:{html_apply:'dlgInfo-'+idContenedor,height:340, width:480, minWidth:150,minHeight:200,closable:true,titulo: 'ingreso_detalle'}
		}
		
		this.reload=function(params){
		var datos=Ext.urlDecode(decodeURIComponent(params));
		maestro.id_ingreso=datos.m_id_ingreso;
		maestro.codigo=datos.m_codigo;
		maestro.descripcion= datos.m_descripcion;		
		ds.load({
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_ingreso:maestro.id_ingreso }
		});
		gridMaestro.getDataSource().removeAll()
		gridMaestro.getDataSource().loadData([['Ingreso',maestro.id_ingreso],['Codigo',maestro.codigo],['Descripcion',maestro.descripcion]]);
		vectorAtributos[7].defecto=maestro.id_ingreso;
		var paramFunciones={
			btnEliminar:{url:direccion+'../../../control/ingreso_detalle/ActionEliminarIngresoDetalle.php',parametros:'&m_id_ingreso='+maestro.id_ingreso},
			Save:{url:direccion+'../../../control/ingreso_detalle/ActionGuardarOrdenIngresoSolDet.php',parametros:'&m_id_ingreso='+maestro.id_ingreso},
			ConfirmSave:{url:direccion+'../../../control/ingreso_detalle/ActionGuardarOrdenIngresoSolDet.php'},
			Formulario:{html_apply:'dlgInfo-'+idContenedor,height:340, width:480, minWidth:150,minHeight:200,closable:true,titulo: 'ingreso_detalle'}
		};
		this.InitFunciones(paramFunciones)
	};
		//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//

		//Para manejo de eventos
		function iniciarEventosFormularios()
		{
			//para iniciar eventos en el formulario
		}

		//para que los hijos puedan ajustarse al tama�o
		this.getLayout=function(){
			return layout_ingreso_detalle.getLayout();
		};



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
		this.Init(); //iniciamos la clase madre
		this.InitBarraMenu(paramMenu);
		this.InitFunciones(paramFunciones);
		//para agregar botones

		this.iniciaFormulario();
		iniciarEventosFormularios();
		layout_ingreso_detalle.getLayout().addListener('layout',this.onResize);
		ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario);
}