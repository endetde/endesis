//<script>
function main(){
	 <?php
	//obtenemos la ruta absoluta
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$dir = "http://$host$uri/";
	echo "\nvar direccion=\"$dir\";";
	echo "var idContenedor='$idContenedor';";
	?>

var paramConfig={TiempoEspera:10000};
var elemento={pagina:new pagina_items_proveedores(idContenedor,direccion,paramConfig),idContenedor:idContenedor};
ContenedorPrincipal.setPagina(elemento);
}
Ext.onReady(main,main);


/**
 * Nombre:		  	    pagina_items_proveedores.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Ana Maria Villegas Quispe
 * Fecha creaci�n:		16/09/2009
 */
function pagina_items_proveedores(idContenedor,direccion,paramConfig)
{	var vectorAtributos=new Array;
    var Atributos=new Array;
    var componentes= new Array();

	var datax;
   //proxy:new Ext.data.HttpProxy({url:direccion+'../../../../../sis_parametros/control/depto/ActionListarDepartamento.php?oc=si'}),
		
	 ds_supergrupo= new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../../sis_almacenes/control/supergrupo/ActionListarSuperGrupo.php?origen=filtro'}),
			reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_supergrupo',
			totalRecords: 'TotalCount'
		}, ['id_supergrupo','codigo','nombre','descripcion'])
	});
	
	ds_grupo= new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../../sis_almacenes/control/grupo/ActionListarGrupo.php?origen=filtro'}),
			reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_grupo',
			totalRecords: 'TotalCount'
		}, ['id_grupo','codigo','nombre','descripcion'])
	});
	
	
	ds_subgrupo= new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../../sis_almacenes/control/subgrupo/ActionListarSubGrupo.php?origen=filtro'}),
			reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_subgrupo',
			totalRecords: 'TotalCount'
		}, ['id_subgrupo','codigo','nombre','descripcion'])
	});
	
	
	ds_id1= new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../../sis_almacenes/control/id1/ActionListarId1.php?origen=filtro'}),
			reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_id1',
			totalRecords: 'TotalCount'
		}, ['id_id1','codigo','nombre','descripcion'])
	});
		
	ds_id2= new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../../sis_almacenes/control/id2/ActionListarId2.php?origen=filtro'}),
			reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_id2',
			totalRecords: 'TotalCount'
		}, ['id_id2','codigo','nombre','descripcion'])
	});
		
	ds_id3= new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../../sis_almacenes/control/id3/ActionListarId3.php?origen=filtro'}),
			reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_id3',
			totalRecords: 'TotalCount'
		}, ['id_id3','codigo','nombre','descripcion'])
	});
	
	/*ds_item= new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../../sis_almacenes/control/item/ActionListarItem.php?origen=filtro'}),
			reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_item',
			totalRecords: 'TotalCount'
		}, ['id_item','codigo','nombre','descripcion'])
	});*/
	var ds_item = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_almacenes/control/item/ActionListarItem.php'}),
			reader: new Ext.data.XmlReader({record:'ROWS',id:'id_item',totalRecords:'TotalCount'},['id_item','codigo','nombre','descripcion','precio_venta_almacen','costo_estimado','stock_min','observaciones','nivel_convertido','estado_registro','fecha_reg','id_unidad_medida_base','id_id3','id_id2','id_id1','id_subgrupo','id_grupo','id_supergrupo','peso_kg','mat_bajo_responsabilidad'])
	});
	
	function renderSupergrupo(value, p, record){return String.format('{0}', record.data['nombre']);}
	function renderGrupo(value, p, record){return String.format('{0}', record.data['nombre']);}
	function renderSubgrupo(value, p, record){return String.format('{0}', record.data['nombre']);}	
	function renderId1(value, p, record){return String.format('{0}', record.data['nombre']);}	
	function renderId2(value, p, record){return String.format('{0}', record.data['nombre']);}	
	function renderId3(value, p, record){return String.format('{0}', record.data['nombre']);}	
	function renderItem(value, p, record){return String.format('{0}', record.data['nombre']);}	
	function render_id_item(value, p, record){return String.format('{0}', record.data['desc_item']);}
	// Definici�n de datos //
	/////////////////////////
	//en la posici�n 0 siempre esta la llave primaria
	vectorAtributos[0]={
		validacion:{
			name:'sw_item_clasificacion',
			fieldLabel:'Consulta',
			allowBlank:false,
			typeAhead:true,
			loadMask:true,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({fields:['id','valor'],data:[['0','Item'],['1','Clasificaci�n']]}),
			onSelect: function(record){ClaseMadre_getComponente('sw_item_clasificacion').setValue(record.data.id);
			                           ClaseMadre_getComponente('sw_item_clasificacion').collapse();
			           if (record.data.id==0){
				CM_mostrarGrupo('Item');
				CM_ocultarGrupo('Clasificaci�n Item');
				SiBlancosGrupo(1);
				NoBlancosGrupo(2);
				
			}else{
				CM_mostrarGrupo('Clasificaci�n Item');
				CM_ocultarGrupo('Item');
				SiBlancosGrupo(2);
				NoBlancosGrupo(1);
			}},		
			valueField:'id',
			displayField:'valor',
			lazyRender:true,
			grid_visible:true,
			grid_editable:false,
			forceSelection:true,
			width_grid:50,
			width:'50%'
			
		},
		tipo:'ComboBox',
		save_as:'sw_item_clasificacion',
		id_grupo:0
		};
	vectorAtributos[1]={
		validacion:{
			fieldLabel:'Supergrupos',
			allowBlank:false,
			vtype:'texto',
			emptyText:'Supergrupo...',
			name:'id_supergrupo',
			desc:'nombre',
			store:ds_supergrupo,
			valueField:'id_supergrupo',
			displayField:'nombre',
			queryParam:'filterValue_0',
			filterCol:'nombre',
			typeAhead:true,
			forceSelection:true,
			renderer:renderSupergrupo,
			mode:'remote',
			queryDelay:50,
			pageSize:10,
			minListWidth:300,
			width:200,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:0,
			triggerAction:'all',
			editable:true,
			grid_visible:true,
			grid_editable:false,
			width_grid:180
		},
		
		save_as:'txt_id_supergrupo',
		tipo:'ComboBox',
		id_grupo:1
	};
	//vectorAtributos[0] = param_id_supergrupo;
	filterCols_grupo=new Array();
	filterValues_grupo=new Array();
	filterCols_grupo[0]='SUPGRU.id_supergrupo';
	filterValues_grupo[0]='%';
	

	vectorAtributos[2]={
		validacion:{
			fieldLabel:'Grupos',
			allowBlank:false,
			vtype:'texto',
			emptyText:'Grupo...',
			name:'id_grupo',
			desc:'nombre',
			store:ds_grupo,
			valueField:'id_grupo',
			displayField:'nombre',
			queryParam:'filterValue_0',
			filterCol:'nombre',
			filterCols:filterCols_grupo,
			filterValues:filterValues_grupo,
			typeAhead:true,
			forceSelection:true,
			renderer:renderGrupo,
			mode:'remote',
			queryDelay:50,
			pageSize:10,
			minListWidth:300,
			width:200,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:0,
			triggerAction:'all',
			editable:true,
			grid_visible:true,
			grid_editable:false,
			width_grid:180
		},
		
		save_as:'txt_id_grupo',
		tipo:'ComboBox',
		id_grupo:1
	};
	//vectorAtributos[1] = param_id_grupo;
	filterCols_subgrupo=new Array();
	filterValues_subgrupo=new Array();
	filterCols_subgrupo[0]='SUPGRU.id_supergrupo';
	filterValues_subgrupo[0]='%';
	filterCols_subgrupo[1]='G.id_grupo';
	filterValues_subgrupo[1]='%';
	
	vectorAtributos[3]={
		validacion:{
			fieldLabel:'Subgrupos',
			allowBlank:false,
			vtype:'texto',
			emptyText:'Subgrupo...',
			name:'id_subgrupo',
			desc:'nombre',
			store:ds_subgrupo,
			valueField:'id_subgrupo',
			displayField:'nombre',
			queryParam:'filterValue_0',
			filterCol:'nombre',
			filterCols:filterCols_subgrupo,
			filterValues:filterValues_subgrupo,
			typeAhead:true,
			forceSelection:true,
			renderer:renderSubgrupo,
			mode:'remote',
			queryDelay:50,
			pageSize:10,
			minListWidth:300,
			width:200,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:0,
			triggerAction:'all',
			editable:true,
			grid_visible:true,
			grid_editable:false,
			width_grid:180
		},
		
		save_as:'txt_id_subgrupo',
		tipo:'ComboBox',
		id_grupo:1
	};
	//vectorAtributos[2] = param_id_subgrupo;
	filterCols_id1=new Array();
	filterValues_id1=new Array();
	filterCols_id1[0]='SUPGRU.id_supergrupo';
	filterValues_id1[0]='%';
	filterCols_id1[1]='G.id_grupo';
	filterValues_id1[1]='%';
	filterCols_id1[2]='sub.id_subgrupo';
	filterValues_id1[2]='%';
	
	vectorAtributos[4]={
		validacion:{
			fieldLabel:'ID1',
			allowBlank:false,
			vtype:'texto',
			emptyText:'ID1...',
			name:'id_id1',
			desc:'nombre',
			store:ds_id1,
			valueField:'id_id1',
			displayField:'nombre',
			queryParam:'filterValue_0',
			filterCol:'nombre',
			filterCols:filterCols_id1,
			filterValues:filterValues_id1,
			typeAhead:true,
			forceSelection:true,
			renderer:renderId1,
			mode:'remote',
			queryDelay:50,
			pageSize:10,
			minListWidth:300,
			width:200,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:0,
			triggerAction:'all',
			editable:true,
			grid_visible:true,
			grid_editable:false,
			width_grid:180
		},
		
		save_as:'txt_id_id1',
		tipo:'ComboBox',
		id_grupo:1
	};
	//vectorAtributos[3] = param_id_id1;
	filterCols_id2=new Array();
	filterValues_id2=new Array();
	filterCols_id2[0]='SUPGRU.id_supergrupo';
	filterValues_id2[0]='%';
	filterCols_id2[1]='G.id_grupo';
	filterValues_id2[1]='%';
	filterCols_id2[2]='sub.id_subgrupo';
	filterValues_id2[2]='%';
	filterCols_id2[3]='id1.id_id1';
	filterValues_id2[3]='%';
	
	vectorAtributos[5]={
		validacion:{
			fieldLabel:'ID2',
			allowBlank:false,
			vtype:'texto',
			emptyText:'ID2...',
			name:'id_id2',
			desc:'nombre',
			store:ds_id2,
			valueField:'id_id2',
			displayField:'nombre',
			queryParam:'filterValue_0',
			filterCol:'nombre',
			filterCols:filterCols_id2,
			filterValues:filterValues_id2,
			typeAhead:true,
			forceSelection:true,
			renderer:renderId2,
			mode:'remote',
			queryDelay:50,
			pageSize:10,
			minListWidth:300,
			width:200,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:0,
			triggerAction:'all',
			editable:true,
			grid_visible:true,
			grid_editable:false,
			width_grid:180
		},
		
		save_as:'txt_id_id2',
		tipo:'ComboBox',
		id_grupo:1
	};
	//vectorAtributos[4] = param_id_id2;
	filterCols_id3=new Array();
	filterValues_id3=new Array();
	filterCols_id3[0]='SUPGRU.id_supergrupo';
	filterValues_id3[0]='%';
	filterCols_id3[1]='G.id_grupo';
	filterValues_id3[1]='%';
	filterCols_id3[2]='sub.id_subgrupo';
	filterValues_id3[2]='%';
	filterCols_id3[3]='id1.id_id1';
	filterValues_id3[3]='%';
	filterCols_id3[4]='id2.id_id2';
	filterValues_id3[4]='%';
	
	
	vectorAtributos[6]={
		validacion:{
			fieldLabel:'ID3',
			allowBlank:false,
			vtype:'texto',
			emptyText:'ID3...',
			name:'id_id3',
			desc:'nombre',
			store:ds_id3,
			valueField:'id_id3',
			displayField:'nombre',
			queryParam:'filterValue_0',
			filterCol:'nombre',
			filterCols:filterCols_id3,
			filterValues:filterValues_id3,
			typeAhead:true,
			forceSelection:true,
			renderer:renderId3,
			mode:'remote',
			queryDelay:50,
			pageSize:10,
			minListWidth:300,
			width:200,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:0,
			triggerAction:'all',
			editable:true,
			grid_visible:true,
			grid_editable:false,
			width_grid:180
		},
		
		save_as:'txt_id_id3',
		tipo:'ComboBox',
		id_grupo:1
	};
	//vectorAtributos[5] = param_id_id3;
	filterCols_item=new Array();
	filterValues_item=new Array();
	filterCols_item[0]='SUPGRU.id_supergrupo';
	filterValues_item[0]='%';
	filterCols_item[1]='G.id_grupo';
	filterValues_item[1]='%';
	filterCols_item[2]='sub.id_subgrupo';
	filterValues_item[2]='%';
	filterCols_item[3]='id1.id_id1';
	filterValues_item[3]='%';
	filterCols_item[4]='id2.id_id2';
	filterValues_item[4]='%';
	filterCols_item[5]='id3.id_id3';
	filterValues_item[5]='%';
	
/*	var param_id_item={
		validacion:{
			fieldLabel:'Item',
			allowBlank:false,
			vtype:'texto',
			emptyText:'Item...',
			name:'id_item',
			desc:'nombre',
			store:ds_item,
			valueField:'id_item',
			displayField:'nombre',
			queryParam:'filterValue_0',
			filterCol:'nombre',
			filterCols:filterCols_item,
			filterValues:filterValues_item,
			typeAhead:true,
			forceSelection:true,
			renderer:renderItem,
			mode:'remote',
			queryDelay:50,
			pageSize:10,
			minListWidth:300,
			width:200,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:0,
			triggerAction:'all',
			editable:true,
			grid_visible:true,
			grid_editable:false,
			width_grid:180
		},
		
		save_as:'txt_id_item',
		tipo:'ComboBox',
		id_grupo:0
	};
	*/
	
	vectorAtributos[7]={
		validacion:{
			name:'id_item',
			desc:'descripcion_item',
			fieldLabel:'C�digo Item',
			allowBlank:false,
			maxLength:500,
			minLength:0,
			store:ds_item,
			valueField: 'id_item',
			displayField: 'descripcion',
			renderer:render_id_item,
			selectOnFocus:true,
			vtype:"texto",
			grid_visible:true,
			grid_editable:false,
			width_grid:120,
			width:200,
			pageSize:10,
			direccion:direccion+'../',
			
			grid_indice:1
			},
		tipo:'LovItemsAlm',
		save_as:'id_item',
		filtro_0:true,
		defecto:'',
		filterColValue:'ITTEM.codigo#ITTEM.nombre',
		id_grupo:2
	};
	
	 vectorAtributos[8]={
		validacion:{
			labelSeparator:'',
			name:'supergrupo',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false
		},
		tipo:'Field',
		filtro_0:false,
		save_as:'supergrupo'
	};	
	vectorAtributos[9]={
		validacion:{
			labelSeparator:'',
			name:'grupo',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false
		},
		tipo:'Field',
		filtro_0:false,
		save_as:'grupo'
	};	
	
	vectorAtributos[10]={
		validacion:{
			labelSeparator:'',
			name:'subgrupo',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false
		},
		tipo:'Field',
		filtro_0:false,
		save_as:'subgrupo'
	};	
	
	vectorAtributos[11]={
		validacion:{
			labelSeparator:'',
			name:'id1',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false
		},
		tipo:'Field',
		filtro_0:false,
		save_as:'id1'
	};	
	vectorAtributos[12]={
		validacion:{
			labelSeparator:'',
			name:'id2',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false
		},
		tipo:'Field',
		filtro_0:false,
		save_as:'id2'
	};

	vectorAtributos[13]={
		validacion:{
			labelSeparator:'',
			name:'id3',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false
		},
		tipo:'Field',
		filtro_0:false,
		save_as:'id3'
	};
//	vectorAtributos[6] = param_id_item;
	
	
	
	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	function formatDate(value){
		return value ? value.dateFormat('d/m/Y') : '';
	};
	//////////////////////////////////////////////////////////////
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
	//////////////////////////////////////////////////////////////
	//Inicia Layout
	var config={
		titulo_maestro:'Clasificaci�n Item'
		
	};
	layout_items_proveedores=new DocsLayoutProceso(idContenedor);
	layout_items_proveedores.init(config);
	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////
	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina = BaseParametrosReporte;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,layout_items_proveedores,idContenedor);
	
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
    var getSelectionModel=this.getSelectionModel;
	var ClaseMadre_getComponente=this.getComponente;
	var ClaseMadre_getDialog=this.getDialog;
	var ClaseMadre_save=this.Save;
	var ClaseMadre_getGrid=this.getGrid;
	var ClaseMadre_getFormulario=this.getFormulario;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_btnNew=this.btnNew;
	var ClaseMadre_onResize=this.onResize;
	var ClaseMadre_SaveAndOther=this.SaveAndOther;
	var CM_mostrarComponente=this.mostrarComponente;
	var CM_ocultarComponente=this.ocultarComponente;
	var CM_ocultarTodosComponente=this.ocultarTodosComponente;
	var CM_mostrarTodosComponente=this.mostrarTodosComponente;
	var ClaseMadre_btnEdit=this.btnEdit;
	var ClaseMadre_btnEliminar = this.btnEliminar;
	var ClaseMadre_btnActualizar = this.btnActualizar;
	var ClaseMadre_submit = this.submit;
	var CM_ocultarGrupo=this.ocultarGrupo;
	var CM_mostrarGrupo=this.mostrarGrupo;
	
	///////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	///////////////////////////////////
	
    //////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////
	
	
	function obtenerTitulo()
	{
		
		var titulo = "Clasificaci�n Item";
		return titulo;
	}
	
	//datos necesarios para el filtro
	var paramFunciones = {
		
		Formulario:{html_apply:'dlgInfo-'+idContenedor,
		height:'70%',
		url:direccion+'../../../../control/_reportes/item/ActionPDFReporteItemsProveedor.php?'+datax,
					
	    abrir_pestana:true, //abrir pestana
		titulo_pestana:obtenerTitulo,
		
		fileUpload:true,
		width:'60%',
		columnas:['47%','47%'],
		minWidth:150,minHeight:200,	closable:true,titulo:'Reporte Items Proveedores',
		
		grupos:[
			{
				tituloGrupo:'Criterio de Selecci�n',
				columna:0,
				id_grupo:0
			},{
				tituloGrupo:'Clasificaci�n Item',
				columna:0,
				id_grupo:1
			},{
				tituloGrupo:'Item',
				columna:1,
				id_grupo:2
			}
		]}
	
	};
		
		
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	
	//Para manejo de eventos

		function iniciarEventosFormularios(){
			
        for (var i=0;i<vectorAtributos.length;i++){
			
			componentes[i]=ClaseMadre_getComponente(vectorAtributos[i].validacion.name);
		}	
		CM_ocultarGrupo('Clasificaci�n Item');
		CM_ocultarGrupo('Item');		
		//para iniciar eventos en el formulario
		combo_supergrupo= ClaseMadre_getComponente('id_supergrupo');
		combo_grupo= ClaseMadre_getComponente('id_grupo');
		combo_subgrupo= ClaseMadre_getComponente('id_subgrupo');	  
		combo_id1= ClaseMadre_getComponente('id_id1'); 				
		combo_id2= ClaseMadre_getComponente('id_id2'); 		
		combo_id3= ClaseMadre_getComponente('id_id3'); 	
		combo_item_clasificacion=ClaseMadre_getComponente('sw_item_clasificacion');	
		
		cmp_supergrupo= ClaseMadre_getComponente('supergrupo');
		cmp_grupo= ClaseMadre_getComponente('grupo');
		cmp_subgrupo= ClaseMadre_getComponente('subgrupo');	  
		cmp_id1= ClaseMadre_getComponente('id1'); 				
		cmp_id2= ClaseMadre_getComponente('id2'); 		
		cmp_id3= ClaseMadre_getComponente('id3'); 
		
			
		
		//combo_item= ClaseMadre_getComponente('id_item'); 
		/*SiBlancosGrupo(1);
		SiBlancosGrupo(2);*/
		/*var onItemClasificacionSelect = function(e) {
			var id = combo_item_clasificacion.getValue()
			//alert(id);
			if (id==0){
				CM_mostrarGrupo('Item');
				CM_ocultarGrupo('Clasificaci�n Item');
				SiBlancosGrupo(1);
				NoBlancosGrupo(2);
				
			}else{
				CM_mostrarGrupo('Clasificaci�n Item');
				CM_ocultarGrupo('Item');
				SiBlancosGrupo(2);
				NoBlancosGrupo(1);
			}
			
			
			

		};*/
		
		
		var onSupergrupoSelect = function(e) {
			var id = combo_supergrupo.getValue()
			
			combo_grupo.filterValues[0] =  id;
			combo_grupo.modificado = true;
						
			var  params1 = new Array();
			params1['id_grupo'] = '%';
			params1['nombre'] = 'Todos los Grupos';
			//params1['nombre'] = 'Todos los Grupos';
			var aux1 = new Ext.data.Record(params1,'%');
			combo_grupo.store.add(aux1)
			combo_grupo.setValue('%');
			///////
			var  params0 = new Array();
			params0['id_subgrupo'] = '%';
			params0['nombre'] = 'Todos los Subgrupos';
			var aux0 = new Ext.data.Record(params0,'%');
			combo_subgrupo.store.add(aux0)
			combo_subgrupo.setValue('%');	
			
			
			var params2 = new Array();
			params2['id_id1']='%';
			params2['nombre']= 'Todo ID1';
			var aux2 = new Ext.data.Record(params2,'%');
			combo_id1.store.add(aux2);
			combo_id1.setValue('%');
			
			
			var params3 = new Array();
			params3['id_id2']='%';
			params3['nombre']='Todo ID2';
			var aux3= new Ext.data.Record(params3,'%');
			combo_id2.store.add(aux3);
			combo_id2.setValue('%');
			
			
			var params4 = new Array();
			params4['id_id3']='%';
			params4['nombre']='Todo ID3';
			var aux4= new Ext.data.Record(params4,'%');
			combo_id3.store.add(aux4);
			combo_id3.setValue('%');
			
			var params5= new Array();
			params5['id_item']='%';
			params5['nombre']='Todos los Items';
			var aux5 = new Ext.data.Record(params5,'%');
			
			cmp_supergrupo.setValue(combo_supergrupo.store.getById(id).data.nombre);
			cmp_grupo.setValue('Todos');
			cmp_subgrupo.setValue('Todos');
			cmp_id1.setValue('Todos');
			cmp_id2.setValue('Todos');
			cmp_id3.setValue('Todos');
			//alert(cmp_supergrupo.getValue());
			//combo_item.store.add(aux5);
			//combo_item.setValue('%');
			

		};
		
		var onGrupoSelect = function(e) {
			var id = combo_grupo.getValue()
		
			combo_grupo.filterValues[1] =  id;
			combo_grupo.modificado = true;
			combo_subgrupo.filterValues[1] =  id;
			combo_subgrupo.modificado = true;
			
			
			var  params0 = new Array();
			params0['id_subgrupo'] = '%';
			params0['nombre'] = 'Todos los Subgrupos';
			var aux0 = new Ext.data.Record(params0,'%');
			combo_subgrupo.store.add(aux0)
			combo_subgrupo.setValue('%');
			///////
			
			var params2 = new Array();
			params2['id_id1']='%';
			params2['nombre']= 'Todos ID1';
			var aux2 = new Ext.data.Record(params2,'%');
			combo_id1.store.add(aux2);
			combo_id1.setValue('%');
			
			
			var params3 = new Array();
			params3['id_id2']='%';
			params3['nombre']='Todo ID2';
			var aux3= new Ext.data.Record(params3,'%');
			combo_id2.store.add(aux3);
			combo_id2.setValue('%');
			
			var params4 = new Array();
			params4['id_id3']='%';
			params4['nombre']='Todo ID3';
			var aux4= new Ext.data.Record(params4,'%');
			combo_id3.store.add(aux4);
			combo_id3.setValue('%');
			
			var params5= new Array();
			params5['id_item']='%';
			params5['nombre']='Todos los Items';
			var aux5 = new Ext.data.Record(params5,'%');
			
			cmp_grupo.setValue(combo_grupo.store.getById(id).data.nombre);
			cmp_subgrupo.setValue('Todos');
			cmp_id1.setValue('Todos');
			cmp_id2.setValue('Todos');
			cmp_id3.setValue('Todos');
			//alert(cmp_grupo.getValue());
			//combo_item.store.add(aux5);
			//combo_item.setValue('%');
		};
		
		
		
		var onSubgrupoSelect = function(e){
			var id= combo_subgrupo.getValue();
			
			combo_grupo.filterValues[0]=combo_supergrupo.getValue();
			combo_subgrupo.filterValues[1] = combo_grupo.getValue();
			combo_subgrupo.modificado=true;
			combo_id1.filterValues[2]=id;
			combo_id1.modificado=true;
			
			var params2 = new Array();
			params2['id_id1']='%';
			params2['nombre']= 'Todos ID1';
			var aux2 = new Ext.data.Record(params2,'%');
			combo_id1.store.add(aux2);
			combo_id1.setValue('%');
			
			var params3 = new Array();
			params3['id_id2']='%';
			params3['nombre']='Todo ID2';
			var aux3= new Ext.data.Record(params3,'%');
			combo_id2.store.add(aux3);
			combo_id2.setValue('%');
			
			var params4 = new Array();
			params4['id_id3']='%';
			params4['nombre']='Todo ID3';
			var aux4= new Ext.data.Record(params4,'%');
			combo_id3.store.add(aux4);
			combo_id3.setValue('%');
			
			var params5= new Array();
			params5['id_item']='%';
			params5['nombre']='Todos los Items';
			var aux5 = new Ext.data.Record(params5,'%');
			//combo_item.store.add(aux5);
			//combo_item.setValue('%');
			cmp_subgrupo.setValue(combo_subgrupo.store.getById(id).data.nombre);
			//alert(cmp_subgrupo.getValue());
			
			cmp_id1.setValue('Todos');
			cmp_id2.setValue('Todos');
			cmp_id3.setValue('Todos');
			
		}
		
		var onId1Select = function(e){
			
			var id= combo_id1.getValue();
			combo_grupo.filterValues[0]= combo_supergrupo.getValue();
			combo_subgrupo.filterValues[1] = combo_grupo.getValue();
			combo_id1.filterValues[2] = combo_subgrupo.getValue();
			combo_id1.modificado=true;
			combo_id2.filterValues[3]=id;
			combo_id2.modificado=true;
			
			var params3 = new Array();
			params3['id_id2']='%';
			params3['nombre']='Todo ID2';
			var aux3= new Ext.data.Record(params3,'%');
			combo_id2.store.add(aux3);
			combo_id2.setValue('%');
			
			var params4 = new Array();
			params4['id_id3']='%';
			params4['nombre']='Todo ID3';
			var aux4= new Ext.data.Record(params4,'%');
			combo_id3.store.add(aux4);
			combo_id3.setValue('%');
			
			var params5= new Array();
			params5['id_item']='%';
			params5['nombre']='Todos los Items';
			var aux5 = new Ext.data.Record(params5,'%');
			//combo_item.store.add(aux5);
			//combo_item.setValue('%');
			cmp_id1.setValue(combo_id1.store.getById(id).data.nombre);
			
			cmp_id2.setValue('Todos');
			cmp_id3.setValue('Todos');
			
		}
		
		var onId2Select = function(e){
			var id= combo_id2.getValue();
			combo_grupo.filterValues[0]=combo_supergrupo.getValue();
			combo_subgrupo.filterValues[1] = combo_grupo.getValue();
			combo_id1.filterValues[2]= combo_subgrupo.getValue();
			combo_id2.filterValues[3]=combo_id1.getValue();
			combo_id2.modificado=true;
			combo_id3.filterValues[4]=id;
			combo_id3.modificado=true;
			
			var params4 = new Array();
			params4['id_id3']='%';
			params4['nombre']='Todo ID3';
			var aux4= new Ext.data.Record(params4,'%');
			combo_id3.store.add(aux4);
			combo_id3.setValue('%');
			
			var params5= new Array();
			params5['id_item']='%';
			params5['nombre']='Todos los Items';
			var aux5 = new Ext.data.Record(params5,'%');
			//combo_item.store.add(aux5);
			//combo_item.setValue('%');
			cmp_id2.setValue(combo_id2.store.getById(id).data.nombre);
			
			cmp_id3.setValue('Todos');
		}
		
		var onId3Select = function(e){
			var id= combo_id3.getValue();
			combo_grupo.filterValues[0]=combo_supergrupo.getValue();
			combo_subgrupo.filterValues[1] = combo_grupo.getValue();
			combo_id1.filterValues[2]= combo_subgrupo.getValue();
			combo_id2.filterValues[3]=combo_id1.getValue();
			combo_id3.filterValues[4]=combo_id2.getValue();
			combo_id3.modificado=true;
			//combo_item.filterValues[1]=id;
			//combo_item.modificado=true;
			
			var params5= new Array();
			params5['id_item']='%';
			params5['nombre']='Todos los Items';
			var aux5 = new Ext.data.Record(params5,'%');
			cmp_id3.setValue(combo_id3.store.getById(id).data.nombre);
			
			
		}
		
		
		function clasificacion(){
		    datax = "txt_id_supergrupo=" + combo_supergrupo.getValue()+'&txt_id_grupo='+combo_grupo.getValue()+'&txt_id_subgrupo='+combo_subgrupo.getValue()+'&txt_id_id1='+combo_id1.getValue()+'&txt_id_id2='+combo_id2.getValue()+'&txt_id_id3='+combo_id3+'&txt_sw_item_clasificacion='+combo_item_clasificacion.getValue();
			
		 }
		
		//combo_item.on('select',clasificacion);
		//combo_item.on('change',clasificacion);
		//onItemClasificacionSelect
		//combo_item_clasificacion.on('select',onItemClasificacionSelect);
		
		combo_supergrupo.on('select',onSupergrupoSelect);
		combo_supergrupo.on('change',onSupergrupoSelect);
		
		combo_grupo.on('select',onGrupoSelect);
		combo_grupo.on('change',onGrupoSelect);
		
		combo_subgrupo.on('select',onSubgrupoSelect);
		combo_subgrupo.on('change',onSubgrupoSelect);
		
		combo_id1.on('select',onId1Select);
		combo_id1.on('change',onId1Select);
	
		combo_id2.on('select',onId2Select);
		combo_id2.on('change',onId2Select);
		
		combo_id3.on('select',onId3Select);
		combo_id3.on('change',onId3Select);
			
	}
	function SiBlancosGrupo(grupo){
		for (var i=0;i<componentes.length;i++){
			//alert('Entra');
			if(vectorAtributos[i].id_grupo==grupo)
			componentes[i].allowBlank=true;
		}
		
	}
	function NoBlancosGrupo(grupo){
		for (var i=0;i<componentes.length;i++){
			if(vectorAtributos[i].id_grupo==grupo)
				componentes[i].allowBlank=vectorAtributos[i].validacion.allowBlank;
		}
	}
	
   //para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_items_proveedores.getLayout();};
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
				//-------------- FIN DEFINICI�N DE FUNCIONES PROPIAS --------------//
				this.Init(); //iniciamos la clase madre
				//this.InitBarraMenu(paramMenu);
				//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
				
				
				this.InitFunciones(paramFunciones);
				//para agregar botones
				
				this.iniciaFormulario();
				iniciarEventosFormularios();
				//layout_almacen.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
				ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}