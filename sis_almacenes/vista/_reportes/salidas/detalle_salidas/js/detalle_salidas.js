/**
 * Nombre:		  	    pagina_detalle_salidas.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2007-10-18 21:00:48
 */
function pagina_detalle_salidas(idContenedor,direccion,paramConfig)
{	var vectorAtributos=new Array;
	var data_ep;
	   
	ds_almacen = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../../control/almacen/ActionListarAlmacenEP.php?origen=filtro'}),
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_almacen',
			totalRecords: 'TotalCount'
		}, ['id_almacen','nombre','descripcion'])
		});

	ds_almacen_ep= new Ext.data.Store({proxy:new Ext.data.HttpProxy({url:direccion+'../../../../../control/almacen_ep/ActionListarAlmacenEp.php?origen=filtro'}),
	reader: new Ext.data.XmlReader({
		record:'ROWS',
		id:'id_almacen_ep',
		totalRecords:'TotalCount'		
	},['id_almacen_ep','descripcion'])
	});
		ds_almacen_logico = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../../control/almacen_logico/ActionListarAlmacenLogicoFisEP.php?origen=filtro'}),
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_almacen_logico',
			totalRecords: 'TotalCount'
		}, ['id_almacen_logico','nombre','descripcion','desc_tipo_almacen'])
		});

	
	//FUNCIONES RENDER
	
	function render_id_almacen(value, p, record){return String.format('{0}', record.data['desc_almacen']);}
	function render_id_almacen_ep(value, p, record){return String.format('{0}', record.data['descripcion']);}
	function render_id_almacen_logico(value, p, record){return String.format('{0}', record.data['desc_almacen_logico']);}
		
	// Definici�n de datos //
	/////////////////////////
	// hidden id_almacen
	//en la posici�n 0 siempre esta la llave primaria
	
	
	vectorAtributos[0]= {
			validacion: {
				name:'id_almacen',
				fieldLabel:'Almac�n F�sico',
				allowBlank:true,
				emptyText:'Almac�n F�sico...',
				name: 'id_almacen',     //indica la columna del store principal ds del que proviane el id
				desc: 'desc_almacen', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_almacen,
				valueField: 'id_almacen',
				displayField: 'nombre',
				queryParam: 'filterValue_0',
				filterCol:'ALMACE.nombre#ALMACE.descripcion',
				
				typeAhead:true,
				forceSelection:false,
				//tpl: resultTplAlmacen,
				mode:'remote',
				queryDelay:150,
				pageSize:100,
				minListWidth:200,
				grow:true,
				width:200,//'100%',
				//grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_id_almacen,
				grid_visible:false,
				grid_editable:false,
				width_grid:100 // ancho de columna en el gris
			},
			tipo:'ComboBox',
			filtro_0:false,
			filtro_1:false,
			filterColValue:'ALMACE.nombre',
			defecto: '',
			save_as:'txt_id_almacen',
			id_grupo:0
			
		};
		filterCols_almacen_ep=new Array();
		filterValues_almacen_ep=new Array();
		filterCols_almacen_ep[0]='ALMACE.id_almacen';
		filterValues_almacen_ep[0]='x';

		//txt_almacen_ep
		vectorAtributos[1]= {
			validacion: {
				name:'id_almacen_ep',
				fieldLabel:'Almac�n EP',
				allowBlank:true,
				emptyText:'Almac�n EP...',
				name: 'id_almacen_ep',     //indica la columna del store principal ds del que proviane el id
				desc: 'descripcion', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_almacen_ep,
				valueField: 'id_almacen_ep',
				displayField: 'descripcion',
				queryParam: 'filterValue_0',
				filterCol:'ALMACE.nombre#ALMACE.descripcion',
				filterCols:filterCols_almacen_ep,
				filterValues:filterValues_almacen_ep,
				typeAhead:true,
				forceSelection:false,
				//tpl: resultTplAlmacen,
				mode:'remote',
				queryDelay:150,
				pageSize:100,
				minListWidth:200,
				grow:true,
				width:200,//'100%',
				//grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_id_almacen_ep,
				grid_visible:false,
				grid_editable:false,
				width_grid:100 // ancho de columna en el gris
			},
			tipo:'ComboBox',
			filtro_0:false,
			filtro_1:false,
			filterColValue:'ALMAEP.descripcion',
			defecto: '',
			save_as:'txt_id_almacen_ep',
			id_grupo:0
			
		};
		filterCols_almacen_logico=new Array();
		filterValues_almacen_logico=new Array();
		filterCols_almacen_logico[0]='ALMAEP.id_almacen_ep';
		filterValues_almacen_logico[0]='x';
		
		//txt almacen logico
		vectorAtributos[2]= {
			validacion: {
				name:'id_almacen_logico',
				fieldLabel:'Almac�n L�gico',
				allowBlank:false,
				emptyText:'Almac�n L�gico...',
				name: 'id_almacen_logico',     //indica la columna del store principal ds del que proviane el id
				desc: 'desc_almacen_logico', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_almacen_logico,
				valueField: 'id_almacen_logico',
				displayField: 'nombre',
				queryParam: 'filterValue_0',
				filterCol:'ALMLOG.codigo#ALMLOG.nombre#ALMLOG.descripcion',
				filterCols:filterCols_almacen_logico,
				filterValues:filterValues_almacen_logico,
				typeAhead:true,
				forceSelection:true,
				//tpl: resultTplAlmacenLogico,
				mode:'remote',
				queryDelay:150,
				pageSize:100,
				minListWidth:200,
				grow:true,
				width:200,
				//grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_id_almacen_logico,
				grid_visible:true,
				grid_editable:false,
				width_grid:100 // ancho de columna en el gris
			},
			tipo:'ComboBox',
			filtro_0:true,
			filtro_1:true,
			filterColValue:'ALMLOG.codigo',
			defecto: '',
			save_as:'txt_id_almacen_logico',
			id_grupo:0
			
		};
		

	vectorAtributos[3]= {
		validacion: {
			name: 'estado_ingreso',
			fieldLabel: 'Estado del Ingreso',
			allowBlank: false,
			typeAhead: false,
			lazyRender: true,
			forceSelection: true,
			mode: 'local',
			triggerAction: 'all',
			//store: new Ext.data.SimpleStore({fields: ['atributo', 'valor'],data : Ext.detalle_salidas_combo.estado}),
			store: new Ext.data.SimpleStore({fields: ['atributo', 'valor'],data : [

			                                                                       ['Borrador', 'Borrador'],
			                                                                       ['Pendiente', 'Pendiente'],
			                                                                       ['Aprobado', 'Aprobado'],
			                                                                       ['Rechazado', 'Rechazado'],
			                                                                       ['Provisional', 'Provisional'],
			                                                                       ['Entregado', 'Entregado'],
			                                                                       ['Finalizado', 'Finalizado']
			                                                                   ]}),
			valueField:'valor',
			displayField:'atributo',
			width: 120,
			minChars : 0
		},
		tipo:'ComboBox',
		save_as:'txt_estado',
		id_grupo:1
	}
	
	vectorAtributos[4]= {
			validacion:{
				name:'fecha_desde',
				fieldLabel:'Fecha Desde',
				allowBlank:true,
				format: 'd/m/Y', //formato para validacion
				minValue: '01/01/1900',
				disabledDaysText: 'D�a no v�lido',
				grid_visible:true,
				grid_editable:true,
				renderer: formatDate,
				width_grid:85,
				disabled:false
			},
			tipo:'DateField',
			dateFormat:'m-d-Y',
			defecto:'',
			save_as:'txt_fecha_desde',
			id_grupo:1
		};
		
	
	
vectorAtributos[5]= {
			validacion:{
				name:'fecha_hasta',
				fieldLabel:'Fecha Hasta',
				allowBlank:true,
				format: 'd/m/Y', //formato para validacion
				minValue: '01/01/1900',
				disabledDaysText: 'D�a no v�lido',
				grid_visible:true,
				grid_editable:true,
				renderer: formatDate,
				width_grid:85,
				disabled:false
			},
			tipo:'DateField',
			dateFormat:'m-d-Y',
			defecto:'',
			save_as:'txt_fecha_hasta',
			id_grupo:1
		};
		

		
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
		titulo_maestro:'Detalle de Salidas'
		
	};
	layout_detalle_salidas=new DocsLayoutProceso(idContenedor);
	layout_detalle_salidas.init(config);
	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////
	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina = BaseParametrosReporte;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,layout_detalle_salidas,idContenedor);
	
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
	
	///////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	///////////////////////////////////
	
    //////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////
	
	function obtenerTitulo()
	{
		//var combo_financiador = ClaseMadre_getComponente('id_financiador');
		var titulo = "Detalle de Salidas";
		
		return titulo;
	}
	
	//datos necesarios para el filtro
	var paramFunciones = {
		
		Formulario:{html_apply:'dlgInfo-'+idContenedor,
		height:'70%',
		url:direccion+'../../../../../control/_reportes/detalle_salidas/ActionReporteDetalleSalidas.php',
		abrir_pestana:true, //abrir pestana
		titulo_pestana:obtenerTitulo,
		fileUpload:false,
		width:'70%',
		columnas:['47%','47%'],
		minWidth:150,minHeight:200,	closable:true,titulo:'Salidas',
		grupos:[{
			tituloGrupo:'Almacen',
			columna: 0,
			id_grupo:0
		},
		{	tituloGrupo:'Datos Salida',
			columna:1,
			id_grupo:1
		}
		
		
		]}};
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	
	//Para manejo de eventos
	function iniciarEventosFormularios(){	
		//para iniciar eventos en el formulario
		combo_almacen = ClaseMadre_getComponente('id_almacen');
		combo_almacen_ep= ClaseMadre_getComponente('id_almacen_ep');
		combo_almacen_logico = ClaseMadre_getComponente('id_almacen_logico');
		

		var onAlmacenSelect = function(e) {
					var id = combo_almacen.getValue();
					if(id=='') id='x';
					combo_almacen_ep.filterValues[0] =  id;
					combo_almacen_ep.modificado = true;
					combo_almacen.modificado=true;
					
					var params1= new Array();
					params1['id_almacen_ep']='%';	
					params1['descripcion']='Todos los Almacenes EP';
					var aux1= new Ext.data.Record(params1,'%');
					combo_almacen_ep.store.add(aux1);
					combo_almacen_ep.setValue('%');
					
					
					var  params2= new Array();
					params2['id_almacen_logico'] = '%';
					params2['nombre'] = 'Todos los Almacenes L�gicos';
					var aux2 = new Ext.data.Record(params2,'%');
					combo_almacen_logico.store.add(aux2)
					combo_almacen_logico.setValue('%');
				};
				
				
				
			var onAlmacenEPSelect=function(e){
				var id= combo_almacen_ep.getValue();
				if(id=='') id='x';
				combo_almacen_logico.filterValues[0]=id;
				combo_almacen_logico.modificado=true;
				combo_almacen_ep.modificado=true;
				
				
				var params2= new Array();
				params2['id_almacen_logico']='%';
				params2['nombre']='Todos los Almacenes L�gicos';
				var aux2= new Ext.data.Record(params2,'%');
				combo_almacen_logico.store.add(aux2);
				combo_almacen_logico.setValue('%');
			}
		
		
		combo_almacen.on('select', onAlmacenSelect);
		combo_almacen.on('change', onAlmacenSelect);
		
		combo_almacen_ep.on('select',onAlmacenEPSelect);
		combo_almacen_ep.on('change',onAlmacenEPSelect);
		
   				
	}
	

			
	 //para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_detalle_salidas.getLayout();};
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
