/*
****************************************************************************************************
Nombre de la clase:	    LOV
Prop�sito:				Lista de valores parametrizable para la b�squeda de IDS para llaves for�neas
M�todos:
Fecha de Creaci�n:		04 - 05 - 07
Versi�n:				2.0.1
Autor:					Rensi Arteaga Copari
****************************************************************************************************
*/
function LovPartidas(paramConfig){
	////////////////// DEFINICON   LOV  //////////////////
	var configuracion={
		nombre: '', //nombre del componente se utiliza para genera los sub nombres para los componentes
		store:'', //direccion para generar el STORE
		title:'',   //titulo que va en el GRID
		datos:[],
		pageSize:10
	};
	var contenedor;//para el componeten que va contener la descripcion del id
	var value=new Array();
	var v_temp=new Array();
	var valsel=new Array();
	if(paramConfig.nombre!==null){configuracion.nombre=paramConfig.nombre}
	if(paramConfig.store!==null){configuracion.store=paramConfig.store}
	if(paramConfig.title!==null){configuracion.title= paramConfig.title}
	if(paramConfig.datos!==null){configuracion.datos= paramConfig.datos}
	if(paramConfig.filterCols!==null){configuracion.filterCols= paramConfig.filterCols}
	if(paramConfig.filterValues!==null){configuracion.filterValues= paramConfig.filterValues}
	if(paramConfig.pageSize!==null){configuracion.pageSize= paramConfig.pageSize}
	var paramLOV={
		modal:true,
		autoTabs:false,
		width:750,
		height:350,
		shadow:false,
		minWidth:400,
		minHeight:300,
		fixedCenter: true,
		constraIntoviewport: true,
		draggable:true,
		proxyDrag: true,
		closable:true,
		center_split: false,
		center_titlebar: false,
		center_autoscroll: true,
		south_split: false,
		south_titlebar: false
	};
	var smLOV;// para el selecion model
	var cmLOV;// para el colum model
	var dsLOV; //para el DATA STORE
	var dom_dlgLOV; // elemento en el DOM que contendra el dialogo del LOV
	var dom_gridLOV;// elemento en el DOM que contendra el grid del LOV
	var dlgLOV=false;//dialogo para el formulario
	var gridLOV;
	var layoutLOV;
	//FUNCION INIT LOV//
	this.iniciaLOV=function(){
		var atiqueta_html="<div id='dlgLOV_" + configuracion.nombre + "'><div class='x-dlg-hd'>"+ configuracion.title + "</div><div id='gridLOV_"+configuracion.nombre+"'></div></div>";
		Ext.DomHelper.insertHtml('afterBegin',document.body,atiqueta_html);
		dom_dlgLOV=Ext.get('dlgLOV_'+configuracion.nombre);
		dom_gridLOV=Ext.get('gridLOV_'+configuracion.nombre);
		var showBtn;
		if(!dlgLOV){ // lazy initialize the dialog and only create it once
			dlgLOV=new Ext.LayoutDialog(dom_dlgLOV,{
				modal:paramLOV.modal,
				autoTabs:paramLOV.autoTabs,
				width:paramLOV.width,
				height:paramLOV.height,
				shadow:paramLOV.shadow,
				minWidth:paramLOV.minWidth,
				minHeight:paramLOV.minHeight,
				fixedCenter:paramLOV.fixedCenter,
				constraIntoviewport:paramLOV.constraIntoviewport,
				draggable:paramLOV.draggable,
				proxyDrag:paramLOV.proxyDrag,
				closable:paramLOV.closable,
				east:{
				},
				center:{
					split:paramLOV.center_split,
					titlebar:paramLOV.center_titlebar,
					autoScroll:paramLOV.center_autoscroll
				}
			});
			dlgLOV.addKeyListener(27,ocultarLOV);//tecla escape
			dlgLOV.addButton('Seleccionar',Seleccionar);
			dlgLOV.addButton('Cancelar',ocultarLOV);
			dlgLOV.on('beforehide',function(tab,e){
				var ColFiltro=configuracion.datos[0].dataIndex;
				if(configuracion.datos[0].filterColValue!==undefined){
					ColFiltro=configuracion.datos[0].filterColValue
				}
				dsLOV.lastOptions={
					params:{
						start:0,
						limit:configuracion.pageSize,
						CantFiltros:7,
						filterCol_0: ColFiltro,
						filterValue_0: ''
					}
				};
				ActualizaVariablesFiltro();
				return true
			});
			d_formFil=Ext.DomHelper.append(document.body,{tag:'div',html:"<div align='center' class='x-dlg-bd'><br><div id='formFil-"+configuracion.nombre+"'></div></div>"});
			layoutLOV=dlgLOV.getLayout();
			layoutLOV.beginUpdate();
			layoutLOV.add('east',new Ext.ContentPanel(d_formFil));
			layoutLOV.add('center',new Ext.ContentPanel(dom_gridLOV,{fitToFrame:true, closable: false, title:configuracion.title}));
			layoutLOV.endUpdate()
		}
		//  DATA STORE LOV
		//Se forma el array para el xml con los par�metros de entrada
		var xml=new Array();
		for(var i=0;i<configuracion.datos.length;i++){
			xml[i]=configuracion.datos[i].dataIndex
		}
		dsLOV=configuracion.store;
		//se definen los parametros iniciales de carga
		dsLOV.lastOptions={
			params:{
				start:0,
				limit:configuracion.pageSize,
				CantFiltros:7,
				filterCol_0:xml[0],
				filterValue_0:''}
		};
		ActualizaVariablesFiltro();
		dsLOV.addListener('loadexception',conexionFailure); //se recibe un error
		//COLUMN MODEL
		//Al cargar el COlumn model, no cargamos la columna del ID
		var datos_column=new Array;
		for(i=0;i<configuracion.datos.length;i++){
			datos_column[i]=configuracion.datos[i]
		}
		cmLOV=new Ext.grid.DefaultColumnModel(datos_column);
		// se establece por defecto que las columnas sean ordenables
		cmLOV.defaultSortable=true;
		//SELECTION MODEL
		//El SelectionModel es para la selecion
		smLOV=new Ext.grid.RowSelectionModel({singleSelect:true});
		//Detecta el evento de una fila seleccionada
		smLOV.addListener('rowselect', EnableSelectLOV); //se marca un registro
		//Se crea un grid editable
		gridLOV=new Ext.grid.EditorGrid(dom_gridLOV,{
			ds: dsLOV,
			cm: cmLOV,
			selModel: smLOV,
			enableColLock:false
		});
		//Dibuja el grid
		gridLOV.render();
		/////manejo de eventos de layoput
		function onResize(){
			var gridView=gridLOV.getView();
			gridView.layout()
		}
		layoutLOV.addListener('layout',onResize);
		//Crea barra de paginaci�n
		var gridFootLOV=gridLOV.getView().getFooterPanel(true);
		//Agrega la barra de paginaci�n al pie
		var pagingLOV=new Ext.PagingToolbar(gridFootLOV, dsLOV,{
			pageSize: configuracion.pageSize,
			displayInfo: false,
			displayMsg: 'registros {0} - {1} de {2}',
			emptyMsg: "No hay registros para mostrar"
		});
		InitFiltro(pagingLOV);
	};var iniciaLOV=this.iniciaLOV;
	function InitFiltro(Barra){
		Barra.addSeparator();
		// llena los elementos en el combo
		var atributosLov = configuracion.datos.length;
		var quickMenuItems=new Array();
		quickMenuItems.push(new Ext.menu.CheckItem({ value:'filterAvanzado',text:'Filtro Avanzado', checked:false }));
		quickMenuItems.push('-');
		quickMenuItems.push('<b class="menu-title">Filtrar Por :</b>');
		for(var j=2;j<atributosLov;j++){
			//cambio para filtrar por un valor diferente al nombre de columna
			v=configuracion.datos[j].dataIndex;
			if(configuracion.datos[j].filterColValue){
				value=configuracion.datos[j].filterColValue
			}
			text=configuracion.datos[j].header;
			if(v!='usado'&&v!='nuevo'&&v!='total'){
				if(j==2){
					quickMenuItems.push(new Ext.menu.CheckItem({value:v,text:text,checked:true}))
				}
				else{
					quickMenuItems.push(new Ext.menu.CheckItem({value:v,text:text,checked:false}))
				}
			}
		}
		var quickMenuX = new Ext.menu.Menu({
			id: 'quickMenu_'+configuracion.nombre,
			items: quickMenuItems
		});
		Barra.add({
			text: 'Filtro',
			tooltip: 'Columnas por las que se filtra',
			icon: '../../../lib/images/m.png',
			cls: 'x-btn-text-icon btn-search-icon',
			menu: quickMenuX
		});
		var sftb=Barra.addDom({
			tag: 'input',
			id: 'quicksearch_'+configuracion.nombre,
			type: 'text',
			size: 30,
			value: '',
			style: 'background: #F0F0F9;'
		});
		var searchBox=new Ext.form.Field({
			emptyText:"Type to quicksearch"
		});
		searchBox.applyTo('quicksearch_'+configuracion.nombre);
		var onFilteringBeforeQuery=function(e){
			var sw=true; //primera vez que entra al for
			var filterCol="";
			var cuentaCol=0;
			var filterAvanzado=quickMenuItems[0].checked;
			for(var p=1,items=quickMenuItems,len=items.length;p<len;p++){
				if(items[p].checked){
					cuentaCol++;
					if(sw){
						filterCol=items[p].value;
						sw=false
					}
					else{
						filterCol=filterCol+"#"+items[p].value
					}
				}
			}
			if(cuentaCol===0){
				searchBox.setValue("");
				searchBox.disable()
			}
			else{
				searchBox.enable()
			}
			dsLOV.lastOptions.params["filterCol_0"]=filterCol;
			dsLOV.lastOptions.params["filterValue_0"]=searchBox.getValue();
			dsLOV.lastOptions.params["filterAvanzado_0"]=filterAvanzado;
			dsLOV.lastOptions.params.start=0;
			dsLOV.load(dsLOV.lastOptions)
		};
		searchBox.el.addKeyListener(13, onFilteringBeforeQuery)
	}
	/////////////////// FUNCIONES /////////////////////////
	this.ocultarLOV=function(){
		dlgLOV.hide()
	};var ocultarLOV=this.ocultarLOV;
	//Funci�n que muestra el LOV
	this.loadLOV=function(ds){
		ds.load(ds.lastOptions)
	};var loadLOV = this.loadLOV;
	//Funcion que se llama al seleccionar una fila
	this.EnableSelectLOV=function(selModel,row,selected){
		var SelectionsRecordLOV=selModel.getSelected(); //es el primer registro seleccionado
		if(selected && SelectionsRecordLOV!=-1){
			v_temp[0]=SelectionsRecordLOV.data[configuracion.datos[0].dataIndex];
			v_temp[1]=SelectionsRecordLOV.data[configuracion.datos[1].dataIndex];
			v_temp[2]=SelectionsRecordLOV.data[configuracion.datos[4].dataIndex];
			valsel=SelectionsRecordLOV.data//retorna valores seleccionados
		}
	};var EnableSelectLOV=this.EnableSelectLOV;
	//Funci�n que se ejecuta al oprimir seleccionar
	this.Seleccionar=function(){
		var NumSelect=smLOV.getCount(); //recupera la cantidad de filas selecionadas
		if(NumSelect!=0){
			value={id:v_temp[0],desc:v_temp[1],tipo:v_temp[2]};
			if(value.tipo==1){
				contenedor.setValue(value);
				if(paramConfig.origen=='grid'){
					paramConfig.sm.getSelected().set(paramConfig.name,value.id)//= value_id;
				}
				contenedor.fireEvent("change");
				ocultarLOV()
			}
			else{
				Ext.MessageBox.alert('Estado', 'Debe seleccionar una Partida de Movimiento.')
			}
		}
		else{
			Ext.MessageBox.alert('Estado', 'Antes seleccione una Partida.')
		}
	};var Seleccionar=this.Seleccionar;
	//iniciamos el LOV
	iniciaLOV();
	this.smLOV=smLOV;// para el selecion model
	this.cmLOV=cmLOV;// para el colum model
	this.dsLOV=dsLOV; //para el DATA STORE
	this.gridLOV=gridLOV;//dialogo para el formulario
	this.mostrarLOV=function(cajaValue){
		contenedor=cajaValue; //contenedor del value
		ActualizaVariablesFiltro();
		this.dsLOV.load(this.dsLOV.lastOptions);
		this.smLOV.clearSelections();
		dlgLOV.show()
	};var mostrarLOV=this.mostrarLOV;
	function ActualizaVariablesFiltro(){
		for(var k=0;k<configuracion.filterValues.length;k++){
			var indice=k+dsLOV.lastOptions.params.CantFiltros;
			dsLOV.lastOptions.params["filterCol_"+indice]=configuracion.filterCols[k];
			dsLOV.lastOptions.params["filterValue_"+indice]=configuracion.filterValues[k];
			dsLOV.lastOptions.params["filterAvanzado_"+indice]=true
		}
		dsLOV.lastOptions.params.CantFiltros=configuracion.filterValues.length+dsLOV.lastOptions.params.CantFiltros
	}
	this.modifica_filterCols=function(indice,valor){
		configuracion.filterCols[indice]=valor
	};var modifica_filterCols=this.modifica_filterCols;
	this.modifica_filterValues=function(indice,valor){
		configuracion.filterValues[indice]=valor
	};var modifica_filterValues=this.modifica_filterValues;
	this.getSelect=function(){
		return valsel
	};getSelect=this.getSelect;
	function conexionFailure(resp1,resp2,resp3){
		ContenedorPrincipal.conexionFailure(resp1,resp2,resp3)
	}this.conexionFailure=conexionFailure;
	function setValores(x){
		value=x!==undefined&&x!==''?x:new Array()
	}this.setValores=setValores;
	function getValores(){
		return value['id']
	}this.getValores=getValores;
}
//---------------      COMPONET LOV          -------------------------- //
//   inicia los elementos para la contruccion del LOV                   //
Ext.form.LovPartida=function(config){
	Ext.form.LovPartida.superclass.constructor.call(this, config);
	this.nombre=this.getId();
	var data=[{dataIndex:"id_partida",
	filterColValue:"id_partida",
	header:"ID",
	width:1
	},{
		dataIndex:"desc_partida", /// modificar con el de activo_fijo
		filterColValue:"desc_partida",
		header:"Descripci�n",
		width:1
	},{
		dataIndex:"codigo_partida", /// modificar con el de activo_fijo
		filterColValue:"codigo_partida",
		header:"C�digo",
		width:75
	},{	dataIndex:"nombre_partida", /// modificar con el de activo_fijo
	filterColValue:"nombre_partida",
	renderer:formatNombre,
	header:"Partida",
	width:485
	},{
		dataIndex:"sw_transaccional", /// modificar con el de activo_fijo
		filterColValue:"sw_transaccional",
		renderer:formatTransaccion,
		header:"Transacci�n",
		width:80
	},{
		dataIndex:"sw_movimiento", /// modificar con el de activo_fijo
		filterColValue:"sw_movimiento",
		renderer:formatMovimiento,
		header:"Movimiento",
		width:80
	}
	];
	var url=this.direccion+'../../../../sis_presupuesto/control/partida/ActionListarParField.php';
	var datos = ['id_partida','desc_partida','codigo_partida','nombre_partida','sw_transaccional','sw_movimiento'];
	if(this.tipo=='gasto'){
		var url=this.direccion+'../../../../sis_presupuesto/control/partida/ActionListarParFieldGasto.php';
	}
	configuracion={
		nombre:this.nombre, //nombre del componente se utiliza para genera los sub nombres para los componentes
		store:new Ext.data.Store({
			proxy:new Ext.data.HttpProxy({url:url}),
			reader: new Ext.data.XmlReader({record:'ROWS',totalRecords:'TotalCount'},datos),
			origen:this.origen, //contenedor del value
			sm:this.sm, //contenedor del value
			name:this.name,
			remoteSort: true // metodo de ordenacion remoto
		}),
		title:'Partida Presupuestaria',//titulo que va en el GRID
		datos:data,//definicion de datos      //definicion de datos
		filterCols:this.filterCols,        //columnas extras para el filtro
		filterValues:this.filterValues,        //valores extra para el filtro
		pageSize: this.pageSize,
		contenedor_id:this.contenedor_id, //contenedor del value
		origen:this.origen, //contenedor del value
		sm:this.sm, //contenedor del value
		name:this.name, //contenedor del value
		direccion:this.direccion //direccion para las url's
	};
	this.lov=new LovPartidas(configuracion);
};
function formatTransaccion(value){
	if(value==1){
		value='Movimiento'
	}
	else{
		value='Titular'
	}
	return value
}
function formatNombre(value){
	value='<pre><font face="Arial">'+value+'</font></pre>';
	return value
}
function formatMovimiento(value){
	if(value==1){
		value='Presupuesto'
	}
	else{
		value='Flujo'
	}
	return value
}
Ext.extend(Ext.form.LovPartida,Ext.form.TriggerField,{
	defaultAutoCreate:{tag:"input",type:"text",size:"24",autocomplete:"off"},
	direccion:"",
	nombre:undefined, //nombre del componente se utiliza para genera los sub nombres para los componentes
	store:undefined,
	tipo:'ingreso',//por defecto se dice que es para ingresos salida
	title:'Partida Presupuestaria',//titulo que va en el GRID
	datos:[],//definicion de datos
	filterCols:[],//columnas extras para el filtro
	filterValues:[],//valores extra para el filtro
	pageSize:10,//tama�o de pagina
	paramLOV:{//paramatros para configurar el LOV
		modal:false,
		autoTabs:false,
		width:750,
		height:350,
		shadow:false,
		minWidth:400,
		minHeight:300,
		fixedCenter: true,
		constraIntoviewport: true,
		draggable:true,
		proxyDrag: true,
		closable:true,
		center_split: false,
		center_titlebar: false,
		center_autoscroll: true,
		south_split: false,
		south_titlebar: false
	},
	smLOV:undefined,// para el selecion model
	cmLOV:undefined,// para el colum model
	dsLOV:undefined, //para el DATA STORE
	dom_dlgLOV:undefined, // elemento en el DOM que contendra el dialogo del LOV
	dom_gridLOV:undefined,// elemento en el DOM que contendra el grid del LOV
	dlgLOV:false,//dialogo para el formulario
	gridLOV:undefined,
	layoutLOV:undefined,
	pagingLOV:undefined,
	triggerClass:'x-form-search-trigger',
	editable:false,
	//se ejecuta al oprimir el boton
	onTriggerClick:function(){
		if(!this.disabled){
			this.lov.mostrarLOV(this)
		}

	},
	initEvents:function(){
	this.keyNav=new Ext.KeyNav(this.el,{
	"enter":function(e){this.lov.mostrarLOV(this)},
	"esc":function(e){this.lov.ocultarLOV()}
	});
	Ext.form.ComboBox.superclass.initEvents.call(this);
	//this.el.dom.setAttribute('readOnly',true);
	//this.el.addClass('x-combo-noedit')
	},
	setValue:function(x) {
		if(x&&x.id!==undefined)
		{v={id:x.id,desc:x.desc}}
		else
		{v={id:x,desc:x}}this.lov.setValores(v);
		Ext.form.LovPartida.superclass.setValue.call(this,v.desc)
	},
	setText:function(t){
		Ext.form.LovPartida.superclass.setValue.call(this,t)
	},
	getValue : function(){
		var rx=this.lov.getValores();
		return rx?rx:''
	}
});