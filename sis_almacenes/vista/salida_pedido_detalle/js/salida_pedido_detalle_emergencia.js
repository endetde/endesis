/**
* Nombre:		  	    pagina_salida_detalle_det.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
* Fecha creaci�n:		2007-10-25 09:38:50
*/
function pagina_salida_pedido_detalle_emergencia(idContenedor,direccion,paramConfig,maestro,idContenedorPadre)
{
	var vectorAtributos=new Array;
	var ds;
	var elementos=new Array();
	var sw=0;
	var cantMaxNuevo=0;
	var cantMaxUsado=0;
	/////////////////
	//  DATA STORE //
	/////////////////
	ds=new Ext.data.Store({
		proxy:new Ext.data.HttpProxy({url: direccion+'../../../control/salida_detalle/ActionListarSalidaDetalle_det.php'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id: 'id_salida_detalle',totalRecords:'TotalCount'},[
		'id_salida_detalle',
		'costo',
		'costo_unitario',
		'precio_unitario',
		'cant_solicitada',
		'cant_entregada',
		'cant_consolidada',
		{name: 'fecha_solicitada',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_entregada',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_consolidada',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_reg',type:'date',dateFormat:'Y-m-d'},
		'id_item',
		'desc_item',
		'codigo_item',
		'id_salida',
		'desc_salida',
		'desc_unidad_constructiva',
		'id_unidad_constructiva',
		'estado_item',
		'nombre',
		'descripcion',
		'nombre_supg',
		'nombre_grupo',
		'nombre_subg',
		'nombre_id1',
		'nombre_id2',
		'nombre_id3'
		]),remoteSort:true});

		//carga datos XML
		ds.load({params:{start:0,limit:paramConfig.TamanoPagina,CantFiltros:paramConfig.CantFiltros,m_id_salida:maestro.id_salida}});

		// DEFINICI�N DATOS DEL MAESTRO
		/*var dataMaestro=[['Salida',maestro.id_salida],['Descripci�n',maestro.descripcion]];
		var dsMaestro = new Ext.data.Store({proxy: new Ext.data.MemoryProxy(dataMaestro),reader: new Ext.data.ArrayReader({id:0},[{name:'atributo'},{name:'valor'}])});
		dsMaestro.load();
		var cmMaestro = new Ext.grid.ColumnModel([{header:"Atributo",width:150,sortable:false,renderer:negrita,locked:false,dataIndex:'atributo'},{header:"Valor",width: 300,sortable:false,renderer:italic,locked:false,dataIndex:'valor'}]);
		function negrita(value){return '<span style="color:red;font-size:10pt"><b>'+value+'</b></span>'}
		function italic(value){return '<i>'+value+'</i>'}
		var div_grid_detalle=Ext.DomHelper.append(idContenedor,{tag:'div',id:'grid_detalle-'+idContenedor});
		var gridMaestro=new Ext.grid.Grid(div_grid_detalle,{ds:dsMaestro,cm:cmMaestro});
		gridMaestro.render();*/

		var cmMaestro = new Ext.grid.ColumnModel([{header:"Atributo",width:150,sortable:false,renderer:negrita,locked:false,dataIndex:'atributo'},{header:"Valor",width: 300,sortable:false,renderer:italic,locked:false,dataIndex:'valor'}]);
		function negrita(value){return '<span style="color:red;font-size:10pt"><b>'+value+'</b></span>'}
		function italic(value){return '<i>'+value+'</i>'}
		var div_grid_detalle=Ext.DomHelper.append(idContenedor,{tag:'div',id:'grid_detalle-'+idContenedor});
		var gridMaestro=new Ext.grid.Grid(div_grid_detalle,{ds:new Ext.data.SimpleStore({fields:['atributo','valor'],data:[['Salida',maestro.id_salida],['Almacen Logico',maestro.id_almacen_logico],['Descripci�n',maestro.descripcion]]}),cm:cmMaestro});
		gridMaestro.render();

		//DATA STORE COMBOS

		ds_item = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/item/ActionListarItem.php'}),
		reader: new Ext.data.XmlReader({record:'ROWS',
		id:'id_item',
		totalRecords: 'TotalCount'
		}, ['id_item','codigo','nombre','descripcion','precio_venta_almacen','costo_estimado','costo_almacen','stock_min','stock_total','observaciones','nivel_convertido','estado_item','estado_registro','fecha_reg','id_unidad_medida_base','id_id3','id_id2','id_id1','id_subgrupo','id_grupo','id_supergrupo'])
		});

		//FUNCIONES RENDER
		function render_id_item(value, p, record){return String.format('{0}', record.data['codigo_item'])}

		/////////////////////////
		// Definici�n de datos //
		/////////////////////////

		// hidden id_salida_detalle
		//en la posici�n 0 siempre esta la llave primaria

		vectorAtributos[0]={
			validacion:{
				labelSeparator:'',
				name: 'id_salida_detalle',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'hidden_id_salida_detalle'
		};

		// txt estado item
		vectorAtributos[1]={
			validacion:{
				name:'estado_item',
				fieldLabel:'Estado material',
				allowBlank:false,
				typeAhead: true,
				loadMask: true,
				triggerAction: 'all',
				//store: new Ext.data.SimpleStore({fields: ['ID','valor'],data : Ext.salida_pedido_detalle_combo.estado_item}),
				store: new Ext.data.SimpleStore({fields: ['ID','valor'],data : [['Nuevo','Nuevo'],['Usado','Usado']]}),
				valueField:'ID',
				displayField:'valor',
				lazyRender:true,
				forceSelection:true,
				grid_visible:true,
				grid_editable:true,
				width:100,
				grid_indice:2,
				width_grid:100 // ancho de columna en el grid
			},
			tipo:'ComboBox',
			filtro_0:true,
			filterColValue:'SALDET.estado_item',
			defecto:'Nuevo',
			save_as:'txt_estado_item',
			id_grupo:1
		};
		// txt cant_solicitada
		vectorAtributos[2]={
			validacion:{
				name:'cant_solicitada',
				fieldLabel:'Cantidad Entregada',
				allowBlank:false,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision :2,//para numeros float
				allowNegative: false,
				minValue:0,
				vtype:'texto',
				maxText:'Existencias insuficientes',
				width:'95%',
				grid_visible:true,
				grid_editable:true,
				width_grid:120,
				align:'right',
				grid_indice:3
			},
			tipo: 'NumberField',
			filtro_0:true,
			filterColValue:'SALDET.cant_entregada',
			save_as:'txt_cant_solicitada',
			id_grupo:1
		};



		fC= new Array();
		fV= new Array();
		fC[0]='id_almacen_logico';
		fV[0]=maestro.id_almacen_logico;

		//txt Desc del empleado
		vectorAtributos[3]={
			validacion:{
				name:'id_item',
				desc:'codigo_item',
				fieldLabel:'C�digo Material',
				valueField: 'id_item',
				displayField: 'codigo',
				tipo:'salida',//determina el action a llamar
				filterCols:fC,
				filterValues:fV,
				allowBlank:false,
				maxLength:100,
				minLength:0,
				selectOnFocus:true,
				vtype:"texto",
				grid_visible:true, // se muestra en el grid
				grid_editable:true, //es editable en el grid,
				width_grid:120, // ancho de columna en el grid
				width:200,
				pageSize:10,
				direccion:direccion,
				renderer:render_id_item,
				grid_indice:1
			},
			tipo:'LovItemsAlm',
			filtro_0:true,
			filterColValue:'ITEM.codigo',
			save_as:'txt_id_item'
		};

		vectorAtributos[4]={
			validacion:{
				name:'nombre',
				fieldLabel:'Nombre',
				grid_visible:false,
				grid_editable:false,
				disabled:true,
				width:'100%'
			},
			tipo:'TextField',
			filtro_0:false,
			save_as:'txt_nombre',
			id_grupo:0
		};


		// txt descripcion
		vectorAtributos[5]={
			validacion:{
				name:'descripcion',
				fieldLabel:'Descripci�n',
				grid_visible:false,
				grid_editable:false,
				disabled:true,
				width:'100%'
			},
			tipo:'Field',
			filtro_0:false,
			save_as:'txt_descripcion',
			id_grupo:0
		};

		// txt super grupo
		vectorAtributos[6]={
			validacion:{
				name:'nombre_supg',
				fieldLabel:'SuperGrupo',
				grid_visible:false,
				grid_editable:false,
				disabled:true,
				width:'100%'
			},
			tipo:'Field',
			filtro_0:false,
			save_as:'txt_super_grupo',
			id_grupo:0
		};
		// txt grupo
		vectorAtributos[7]={
			validacion:{
				name:'nombre_grupo',
				fieldLabel:'Grupo',
				grid_visible:false,
				grid_editable:false,
				disabled:true,
				width:'100%'
			},
			tipo:'Field',
			filtro_0:false,
			save_as:'txt_grupo',
			id_grupo:0
		};
		// txt sub grupo
		vectorAtributos[8]={
			validacion:{
				name:'nombre_subg',
				fieldLabel:'SubGrupo',
				grid_visible:false,
				grid_editable:false,
				disabled:true,
				width:'100%'
			},
			tipo:'Field',
			filtro_0:false,
			save_as:'txt_sub_grupo',
			id_grupo:0
		};

		// txt id1
		vectorAtributos[9]={
			validacion:{
				name:'nombre_id1',
				fieldLabel:'Identificador 1',
				grid_visible:false,
				grid_editable:false,
				disabled:true,
				width:'100%'
			},
			tipo:'Field',
			filtro_0:false,
			save_as:'txt_id1',
			id_grupo:0
		};


		// txt id2
		vectorAtributos[10]={
			validacion:{
				name:'nombre_id2',
				fieldLabel:'Identificador 2',
				grid_visible:false,
				grid_editable:false,
				disabled:true,
				width:'100%'
			},
			tipo:'Field',
			filtro_0:false,
			save_as:'txt_id2',
			id_grupo:0
		};
		// txt id3
		vectorAtributos[11]={
			validacion:{
				name:'nombre_id3',
				fieldLabel:'Identificador 3',
				grid_visible:false,
				grid_editable:false,
				disabled:true,
				width:'100%'
			},
			tipo:'Field',
			filtro_0:false,
			save_as:'txt_id3',
			id_grupo:0
		};

		//----------- FUNCIONES RENDER

		function formatDate(value){
			return value ? value.dateFormat('d/m/Y') : ''
		};

		//---------- INICIAMOS LAYOUT DETALLE
		var config={
			titulo_maestro:'Solicitar Material (Maestro)',
			titulo_detalle:'Detalle Solicitud de Material',
			grid_maestro:'grid-'+idContenedor
		};
		layout_salida_detalle = new DocsLayoutDetalle(idContenedor,idContenedorPadre);
		layout_salida_detalle.init(config);



		//---------- INICIAMOS HERENCIA
		this.pagina = Pagina;
		this.pagina(paramConfig,vectorAtributos,ds,layout_salida_detalle,idContenedor);
		//var getSelectionModel=this.getSelectionModel;
		var Cm_getComponente=this.getComponente;
		//var Cm_conexionFailure=this.conexionFailure;
		//var Cm_btnNew=this.btnNew;
		var Cm_onResize=this.onResize;
		//var Cm_SaveAndOther=this.SaveAndOther;
		var Cm_Destroy=this.Destroy;
		//-------- DEFINICI�N DE LA BARRA DE MEN�


		var paramMenu={
			guardar:{crear:true,separador:false},
			nuevo:{crear:true,separador:true},
			editar:{crear:true,separador:false},
			eliminar:{crear:true,separador:false},
			actualizar:{crear:true,separador:false}
		};



		//--------- DEFINICI�N DE FUNCIONES
		//aqu� se parametrizan las funciones que se ejecutan en la clase madre

		//datos necesarios para el filtro
		var paramFunciones={
			btnEliminar:{url:direccion+'../../../control/salida_detalle/ActionEliminarSalidaDetalle.php',parametros:'&m_id_salida='+maestro.id_salida},
			Save:{url:direccion+'../../../control/salida_detalle/ActionGuardarSalidaPedidoDetalle.php',parametros:'&m_id_salida='+maestro.id_salida},
			ConfirmSave:{url:direccion+'../../../control/salida_detalle/ActionGuardarSalidaPedidoDetalle.php',parametros:'&m_id_salida='+maestro.id_salida},
			Formulario:{html_apply:'dlgInfo-'+idContenedor,height:370,width:'80%',
			columnas:['60%','34%'],
			grupos:[
			{tituloGrupo:'Informaci�n del Material',columna:0,id_grupo:0},
			{tituloGrupo:'Datos Pedido',columna:1,id_grupo:1}
			],
			minWidth:150,minHeight:200,closable:true,titulo: 'Pedido - Materiales'}
		};

		this.reload=function(params){
			var datos=Ext.urlDecode(decodeURIComponent(params));
			maestro.id_salida=datos.m_id_salida;
			maestro.id_almacen_logico=datos.m_id_almacen_logico;
			maestro.descripcion=datos.m_descripcion;
			ds.load({
				params:{
					start:0,
					limit: paramConfig.TamanoPagina,
					CantFiltros:paramConfig.CantFiltros,
					m_id_salida:maestro.id_salida
				}
			});
			gridMaestro.getDataSource().removeAll()
			gridMaestro.getDataSource().loadData([['Salida',maestro.id_salida],['Almac�n L�gico',maestro.id_almacen_logico],['Descripci�n',maestro.descripcion]]);
			//vectorAtributos[9].defecto=maestro.id_ingreso;
			var paramFunciones={
				btnEliminar:{url:direccion+'../../../control/salida_detalle/ActionEliminarSalidaDetalle.php',parametros:'&m_id_salida='+maestro.id_salida},
				Save:{url:direccion+'../../../control/salida_detalle/ActionGuardarSalidaPedidoDetalle.php',parametros:'&m_id_salida='+maestro.id_salida},
				ConfirmSave:{url:direccion+'../../../control/salida_detalle/ActionGuardarSalidaPedidoDetalle.php',parametros:'&m_id_salida='+maestro.id_salida},
				Formulario:{html_apply:'dlgInfo-'+idContenedor,height:370,width:'80%',
				columnas:['60%','34%'],
				grupos:[
				{tituloGrupo:'Informaci�n del Material',columna:0,id_grupo:0},
				{tituloGrupo:'Datos Pedido',columna:1,id_grupo:1}
				],
				minWidth:150,minHeight:200,closable:true,titulo: 'Pedido - Materiales'}
			};
			this.InitFunciones(paramFunciones)
		};


		//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//

		//Para manejo de eventos
		function iniciarEventosFormularios(){
			//para iniciar eventos en el formulario
			txt_cant_sol=Cm_getComponente('cant_solicitada');
			cmb_estado_item=Cm_getComponente('estado_item');
			cmb_Item=Cm_getComponente('id_item');
			txt_nombre=Cm_getComponente('nombre');
			txt_descripcion=Cm_getComponente('descripcion');
			txt_super_grupo=Cm_getComponente('nombre_supg');
			txt_grupo=Cm_getComponente('nombre_grupo');
			txt_sub_grupo=Cm_getComponente('nombre_subg');
			txt_id1=Cm_getComponente('nombre_id1');
			txt_id2=Cm_getComponente('nombre_id2');
			txt_id3=Cm_getComponente('nombre_id3');

			var onItemSelect=function(e){
				rec=cmb_Item.lov.getSelect();
				//alert(rec["usado"]+ "  "+rec["nombre"]+" "+rec["nuevo"])
				txt_nombre.setValue(rec["nombre"]);
				txt_descripcion.setValue(rec["descripcion"]);
				txt_super_grupo.setValue(rec["nombre_supg"]);
				txt_grupo.setValue(rec["nombre_grupo"]);
				txt_sub_grupo.setValue(rec["nombre_subg"]);
				txt_id1.setValue(rec["nombre_id1"]);
				txt_id2.setValue(rec["nombre_id2"]);
				txt_id3.setValue(rec["nombre_id3"]);

				//obtiene las cantidades m�ximas y m�nimas
				cantMaxNuevo=rec["nuevo"];
				cantMaxUsado=rec["usado"];

				//Define la cantidad m�xima a solicitar
				if(cmb_estado_item.getValue()=='Nuevo')
				{txt_cant_sol.maxValue=cantMaxNuevo}
				else
				{txt_cant_sol.maxValue=cantMaxUsado}
			};

			var onEstadoChange=function(e){
				if(cmb_estado_item.getValue()=='Nuevo')
				{
					txt_cant_sol.maxValue=cantMaxNuevo
				}
				else{
					txt_cant_sol.maxValue=cantMaxUsado}
			}


			cmb_Item.on('change',onItemSelect);
			cmb_estado_item.on('select',onEstadoChange)
		}

		//para que los hijos puedan ajustarse al tama�o
		this.getLayout=function(){
			return layout_salida_detalle.getLayout()
		};



		//para el manejo de hijos
		this.getPagina=function(idContenedorHijo){
			var tam_elementos=elementos.length;
			for(i=0;i<tam_elementos;i++){
				if(elementos[i].idContenedor==idContenedorHijo){
					return elementos[i]
				}
			}
		};

		this.Destroy=function(){delete this.pagina;	Cm_Destroy()};
		this.getElementos=function(){return elementos};
		this.setPagina=function(elemento){elementos.push(elemento)};
		this.Init(); //iniciamos la clase madre
		this.InitBarraMenu(paramMenu);
		this.InitFunciones(paramFunciones);
		//para agregar botones

		this.iniciaFormulario();
		iniciarEventosFormularios();
		layout_salida_detalle.getLayout().addListener('layout',this.onResize);
		ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario)

}