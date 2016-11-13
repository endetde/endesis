/**
* Nombre:		  	    pagina_proceso_compra_mul_det.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
* Fecha creaci�n:		2008-05-20 17:42:43
*/
function p_proceso_compra_mul_item_det(idContenedor,direccion,paramConfig,idContenedorPadre)
{        
	
	var Atributos=new Array,sw_grup=true,gridG,gSm,id_SCD,ds_g,gDlg;
	var maestro;

	/////////////////
	//  DATA STORE //
	/////////////////
	var ds=new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy:new Ext.data.HttpProxy({url: direccion+'../../../control/proceso_compra_det/ActionListarProcesoCompraMulIteDet.php'}),
		// aqui se define la estructura del XML
		reader:new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_proceso_compra_det',
			totalRecords: 'TotalCount'},[
			'id_proceso_compra_det',
			'id_proceso_compra',
			'cantidad',
			'precio_referencial_total',
			'estado_reg',
			'id_item',
			'id_unidad_medida_base',
			'codigo_item',
			'nombre_item',
			'nombre_id3',
			'nombre_id2',
			'nombre_id1',
			'nombre_subg',
			'nombre_grupo',
			'nombre_supg',
			'nombre_unid_base',
			'precio_total_moneda_seleccionada','descripcion'
			]),remoteSort:true});
			/////////////////////////
			// Definici�n de datos //
			/////////////////////////
			// hidden id_proceso_compra_det
			//en la posici�n 0 siempre esta la llave primaria
			Atributos[0]={
				validacion:{
					//fieldLabel: 'Id',
					labelSeparator:'',
					name: 'id_proceso_compra_det',
					inputType:'hidden',
					grid_visible:false,
					grid_editable:false
				},
				tipo: 'Field',
				filtro_0:false,
				save_as:'id_proceso_compra_det'
			};
			Atributos[1]={
				validacion:{
					labelSeparator:'',
					name: 'id_item',
					inputType:'hidden',
					grid_visible:false,
					grid_editable:false
				},
				tipo: 'Field',
				filtro_0:false,
				save_as:'id_proceso_compra_det'
			};
			// txt id_item
			Atributos[2]={
				validacion:{
					name:'codigo_item',
					fieldLabel:'Codigo Item',
					grid_visible:true,
					grid_editable:false,
					width_grid:100,
                    grid_indice:1
				},
				tipo:'Field',
				form:false,
				filtro_0:true,
				filterColValue:'ITEM.codigo'
			};
			// txt id_item
			Atributos[3]={
				validacion:{
					name:'nombre_supg',
					fieldLabel:'Super Grupo',
					grid_visible:true,
					grid_editable:false,
					width_grid:120
				},
				tipo:'Field',
				form:false,
				filtro_0:true,
				filterColValue:'SUPGRU.nombre'
			};
			Atributos[4]={
				validacion:{
					name:'nombre_grupo',
					fieldLabel:'Grupo',
					grid_visible:true,
					grid_editable:false,
					width_grid:120
				},
				tipo:'Field',
				form:false,
				filtro_0:true,
				filterColValue:'G.nombre'
			};
			Atributos[5]={
				validacion:{
					name:'nombre_subg',
					fieldLabel:'Sub Grupo',
					grid_visible:true,
					grid_editable:false,
					width_grid:120
				},
				tipo:'Field',
				form:false,
				filtro_0:true,
				filterColValue:'SUB.nombre'
			};
			Atributos[6]={
				validacion:{
					name:'nombre_id1',
					fieldLabel:'ID 1',
					grid_visible:true,
					grid_editable:false,
					width_grid:120
				},
				tipo:'Field',
				form:false,
				filtro_0:true,
				filterColValue:'ID1.nombre'
			};
			Atributos[7]={
				validacion:{
					name:'nombre_id2',
					fieldLabel:'ID 2',
					grid_visible:true,
					grid_editable:false,
					width_grid:120

				},
				tipo:'Field',
				form:false,
				filtro_0:true,
				filterColValue:'ID2.nombre'
			};
			Atributos[8]={
				validacion:{
					name:'nombre_id3',
					fieldLabel:'ID 3',
					grid_visible:true,
					grid_editable:false,
					width_grid:120

				},
				tipo:'Field',
				form:false,
				filtro_0:true,
				filterColValue:'ID3.nombre'
			};
			// txt id_item
			Atributos[9]={
				validacion:{
					name:'nombre_item',
					fieldLabel:'Item',
					grid_visible:false,
					grid_editable:false,
					width_grid:120
				},
				tipo:'Field',
				form:false,
				filtro_0:true,
				filterColValue:'ITEM.nombre'
			};
			// txt cantidad
			Atributos[10]={
				validacion:{
					name:'cantidad',
					fieldLabel:'Cantidad',
					grid_visible:true,
					grid_editable:false,
					width_grid:100,
					grid_indice:4,
					align:'right'
				},
				tipo:'Field',
				form:false,
				filtro_0:true,
				filterColValue:'PROCOMDET.cantidad'
			};
			Atributos[11]={
				validacion:{
					name:'nombre_unid_base',
					fieldLabel:'Unidad Medida',
					grid_visible:true,
					grid_editable:false,
					width_grid:100,
					grid_indice:3
				},
				tipo:'Field',
				form:false,
				filtro_0:true,
				filterColValue:'UMB.nombre'
			};
			// txt precio_referencial_total
			Atributos[12]={
				validacion:{
					name:'precio_referencial_total',
					fieldLabel:'Precio Ref. Total Bs.',
					grid_visible:true,
					grid_editable:false,
					width_grid:100,
					grid_indice:5,
					decimalPrecision:2,//para numeros float
					align:'right'
				},
				tipo:'Field',
				form:true,
				filtro_0:true,
				filterColValue:'PROCOMDET.precio_referencial_total'
			};
			// txt estado_reg
			Atributos[14]={
				validacion:{
					name:'estado_reg',
					fieldLabel:'Estado',
					grid_visible:true,
					grid_editable:false,
					width_grid:100
				},
				tipo:'TextField',
				form: false,
				filtro_0:true,
				filterColValue:'PROCOMDET.estado_reg'
			};
			// txt precio_total_moneda_seleccionada
			Atributos[13]={
				validacion:{
					name:'precio_total_moneda_seleccionada',
					fieldLabel:'PT. Moneda Seleccionada',
					grid_visible:true,
					grid_editable:false,
					width_grid:120,
					grid_indice:5,
					decimalPrecision:2,//para numeros float
					align:'right'
				},
				tipo:'TextField',
				form: false,
				filtro_0:true,
				filterColValue:'precio_total_moneda_seleccionada'
			};
			Atributos[14]={
				validacion:{
					name:'descripcion',
					fieldLabel:'Descripcion Item',
					grid_visible:true,
					grid_editable:false,
					width_grid:100,
					grid_indice:2
				},
				tipo:'Field',
				form:false,
				filtro_0:true,
				filterColValue:'ITEM.descripcion'
			};
			
			//----------- FUNCIONES RENDER

			function formatDate(value){return value?value.dateFormat('d/m/Y'):''};
			//---------- INICIAMOS LAYOUT DETALLE
			var config={titulo_maestro:'Iniciar Procedimiento de Compra M�ltiple (Maestro)',titulo_detalle:'Procedimiento Detalle (Detalle)',grid_maestro:'grid-'+idContenedor};
			var layout_proceso_compra_mul_det = new DocsLayoutMaestro(idContenedor)
			layout_proceso_compra_mul_det.init(config);
			//---------- INICIAMOS HERENCIA
			this.pagina = Pagina;
			this.pagina(paramConfig,Atributos,ds,layout_proceso_compra_mul_det,idContenedor);
			var getComponente=this.getComponente;
			var getSelectionModel=this.getSelectionModel;
			var getGrid=this.getGrid;
//			var EstehtmlMaestro=this.htmlMaestro;
			//DEFINICI�N DE LA BARRA DE MEN�
			var paramMenu={actualizar:{crear:true,separador:false}};
			//DEFINICI�N DE FUNCIONES
			var paramFunciones={
				//				Formulario:{html_apply:'dlgInfo-'+idContenedor,height:340,width:480,minWidth:150,minHeight:200,	closable:true,titulo:'proceso_compra_mul_det'}
			};
			//-------------- Sobrecarga de funciones --------------------//
			this.reload=function(m){
				maestro=m;
				ds.lastOptions={
					params:{
						start:0,
						limit: paramConfig.TamanoPagina,
						CantFiltros:paramConfig.CantFiltros,
						m_id_proceso_compra:maestro.id_proceso_compra
					}
				};
				this.btnActualizar();
				if(maestro.id_moneda==1){
					getGrid().getColumnModel().setHidden(4,true);
				}
				else{
					getGrid().getColumnModel().setHidden(4,false);
				}
			};
			
			function btn_caracteristica(){
				var sm=getSelectionModel(),NumSelect=sm.getCount();
				if(NumSelect!=0){
					var record=sm.getSelected();
					if(sw_grup){
						InitDetalleGrupo(record.data.id_proceso_compra_det,record.data.id_item)
					}
					else{
						//mostra ventana de grupos
						reloadDetalleGrupo(record.data.id_proceso_compra_det,record.data.id_item)
					}
				}
				else{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
				}
			}
			//ventana del detaalle grup
			function InitDetalleGrupo(id_proceso_compra_det,id_item){
				//crear ventana para para manejar grupos
				//var Win=Ext.DomHelper.append(document.body,{tag:'div',id:"gDlg-"+idContenedor,html:"<div id=gcenter-"+idContenedor+" ><div id=grid_g-"+idContenedor+"></div></div>"},true);
				//var Win=Ext.DomHelper.append(document.body,{tag:'div',id:"gsDlg-"+idContenedor,html:"<div id=grid_gs-"+idContenedor+"></div>"},true);
				//	var Win=Ext.DomHelper.append(document.body,{tag:'div',id:"gsDlg-"+idContenedor,html:"<div id=grid_gs-"+idContenedor+"></div>"},true);
				var Win=Ext.DomHelper.append(document.body,{tag:'div',id:"gsDlg-"+idContenedor},true);
				var dGrid=Ext.DomHelper.append("gsDlg-"+idContenedor,{tag:'div',id:"grid_gs-"+idContenedor},true);
				gDlg = new Ext.LayoutDialog(Win,{
					title:'Solicitudes Agrupadas',
					modal: true,
					autoTabs: true,
					resizable:true,
					width: 400,
					height: 200,
					shadow: false,
					fixedCenter:true,
					constraIntoviewport: true,
					closable: true,
					center:{split:false,titlebar:false,autoScroll:true,fitToFrame:true}
				});
				//gDlg.addKeyListener(27,function(){gDlg.hide()});//ESC
				function formatSol(value,p,record){return "<div><a href=\"javascript:pProItemMul.openWindows('../../../sis_adquisiciones/vista/caracteristica/caracteristica_min.php?m_id_solicitud_compra_det="+record.data.id_solicitud_compra_det+"')\">[ "+record.data.periodo+"/"+record.data.num_solicitud+ " , " +record.data.periodo+"  ]</a></div>"}
				function formatAdj(value,p,record){return "<div><a href=\"javascript:pProItemMul.openWinCot('../../../sis_adquisiciones/vista/cotizacion/cotizacion_min.php?m_id_cotizacion_det="+record.data.id_cotizacion_det+"')\">"+record.data.cantidad_adjudicada+"</a></div>"}
				//function formatSolicitud(value,p,record){return "<div><input type="button" value="Enviar"  onclick='javascript:pProItemMul.openCaracteristica("+record[id_solicitud_compra_det]+")'/></div>")
				//var datos=Ext.urlDecode(decodeURIComponent(params));
				ds_g = new Ext.data.Store({
					proxy: new Ext.data.HttpProxy({url:direccion+'../../../control/grupo_sp_det/ActionListarGrupoSpDet.php'}),
					// aqui se define la estructura del XML
					reader: new Ext.data.XmlReader({record:'ROWS',id:'id_grupo_sp_det',totalRecords:'TotalCount'},[
					'id_grupo_sp_det',
					'id_solicitud_compra_det',
					'cantidad_adjudicada',
					'cantidad_sol',
					'num_solicitud_sis',
					'num_solicitud',
					'periodo'
					]),remoteSort:false});
					ds_g.load({params:{start:0,limit:25,id_proceso_compra:maestro.id_proceso_compra,id_proceso_compra_det:id_proceso_compra_det,id_item:id_item}});
					var cmG = new Ext.grid.ColumnModel([{header:"Solicitud (Num Solicitud, Num Solicitud Sis)",width:250,dataIndex:'num_solicitud',renderer:formatSol},{header:"Catidad Solicitada",width:120,dataIndex:'cantidad_sol'},{header:"Cantidad Adjudicada",width:120,dataIndex:'cantidad_adjudicada',renderer:formatAdj}]);
					gSm=new Ext.grid.RowSelectionModel({singleSelect:true});
					var glayout=gDlg.getLayout();
					//gridG=new Ext.grid.Grid("grid_g-"+idContenedor,{ds:ds_g,cm:cmG,selModel:gSm});
					//gridG=new Ext.grid.Grid("grid_gs-"+idContenedor,{ds:ds_g,cm:cmG,selModel:gSm,autoHeight:false});
					gDlg.getLayout().layout();
					gDlg.getLayout().getRegion('center').getEl()
					gridG=new Ext.grid.Grid(dGrid,{ds:ds_g,cm:cmG,selModel:gSm,autoHeight:false});
					var g_panel=new Ext.GridPanel(gridG,{fitToFrame:true,closable:false});
					gDlg.show();
					glayout.add('center',g_panel);
					gridG.render();
					// add a paging toolbar to the grid's footer
					var gPaging=new Ext.PagingToolbar(gridG.getView().getFooterPanel(true),ds_g, {
						displayInfo:true,
						displayMsg:'Solicitudes {0} - {1} de {2}',
						emptyMsg:"No hay Solicitudes"
					});
					sw_grup=false
			}
			function reloadDetalleGrupo(id_proceso_compra_det,id_item){
				gSm.clearSelections();
				gDlg.show();
				ds_g.reload({params:{
					start:0,
					limit:100,
					id_proceso_compra:maestro.id_proceso_compra,
					id_item:id_item,
					id_proceso_compra_det:id_proceso_compra_det
				}});
				gridG.autoSize()
				gridG.getView().layout()
	}
			this.openWindows = function(dir){
				var ParamVentana={ventana:{width:'90%',height:'90%'}};
				layout_proceso_compra_mul_det.loadWindows(direccion+dir,'Caracteristicas Adicionales',ParamVentana)
			}
			this.openWinCot = function(dir){
				var ParamVentana={ventana:{width:'90%',height:'90%'}};
				layout_proceso_compra_mul_det.loadWindows(direccion+dir,'Datos Cotizacion',ParamVentana)
			}
			//Para manejo de eventos
			function iniciarEventosFormularios(){
				//para iniciar eventos en el formulario
			}
			//para que los hijos puedan ajustarse al tama�o
			this.getLayout=function(){return layout_proceso_compra_mul_det.getLayout()};
			//para el manejo de hijos
			this.Init(); //iniciamos la clase madre
			this.InitBarraMenu(paramMenu);
			this.InitFunciones(paramFunciones);
			//para agregar botones
			this.AdicionarBoton('../../../lib/imagenes/menu-show.gif','Caracter�sticas Detalle',btn_caracteristica,true,'caracteristica','');
			this.iniciaFormulario();
			iniciarEventosFormularios();
			this.bloquearMenu();
			layout_proceso_compra_mul_det.getLayout().addListener('layout',this.onResize);
			//ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario)
			ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario);	
}