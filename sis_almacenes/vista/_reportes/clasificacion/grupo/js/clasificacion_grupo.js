/**
 * Nombre:		  	    pagina_clasificacion_grupo.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				
 * Fecha creaci�n:		2007-11-26 
 */
function pagina_clasificacion_grupo(idContenedor,direccion,paramConfig)
{	var vectorAtributos=new Array;

	var datax;
   
	 ds_supergrupo= new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../../control/supergrupo/ActionListarSuperGrupo.php?origen=filtro'}),
			reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_supergrupo',
			totalRecords: 'TotalCount'
		}, ['id_supergrupo','codigo','nombre','descripcion'])
	});
	
	ds_grupo= new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../../control/grupo/ActionListarGrupo.php?origen=filtro'}),
			reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_grupo',
			totalRecords: 'TotalCount'
		}, ['id_grupo','codigo','nombre','descripcion'])
	});
	
		
	function renderSupergrupo(value, p, record){return String.format('{0}', record.data['nombre']);}
	function renderGrupo(value, p, record){return String.format('{0}', record.data['nombre']);}
		
	// Definici�n de datos //
	/////////////////////////
	//en la posici�n 0 siempre esta la llave primaria
	
	var param_id_supergrupo={
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
		id_grupo:0
	};
	vectorAtributos[0] = param_id_supergrupo;
	filterCols_grupo=new Array();
	filterValues_grupo=new Array();
	filterCols_grupo[0]='SUPGRU.id_supergrupo';
	filterValues_grupo[0]='%';
	

	var param_id_grupo={
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
		id_grupo:0
	};
	//vectorAtributos[1] = param_id_grupo;
	
	
	
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
		titulo_maestro:'Clasificaci�n de Grupos'
		
	};
	layout_clasificacion_grupo=new DocsLayoutProceso(idContenedor);
	layout_clasificacion_grupo.init(config);
	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////
	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina = BaseParametrosReporte;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,layout_clasificacion_grupo,idContenedor);
	
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
	
	///////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	///////////////////////////////////
	
    //////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////
	
	
	function obtenerTitulo()
	{
		
		var titulo = "Clasificaci�n de Grupos";
		return titulo;
	}
	
	//datos necesarios para el filtro
	var paramFunciones = {
		
		Formulario:{html_apply:'dlgInfo-'+idContenedor,
		height:'70%',
		url:direccion+'../../../../../control/_reportes/clasificacion_grupo/ActionClasificacionGrupo.php?'+datax,
				
	//	window.open(direccion+'../../../../../control/_reportes/clasificacion_supergrupo/ActionClasificacionSupergrupo.php?txt_id_supergrupo='+combo_supergrupo.getValue()),
		abrir_pestana:true, //abrir pestana
		titulo_pestana:obtenerTitulo,
		
		fileUpload:true,
		width:'60%',
		columnas:['50%'],
		minWidth:150,minHeight:200,	closable:true,titulo:'Clasificacion Grupo',
		grupos:[{
			tituloGrupo:'Clasificaci�n de Grupos',
			columna: 0,
			id_grupo:0
		}
		]}};
		
		
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	
	//Para manejo de eventos

		function iniciarEventosFormularios(){	
		//para iniciar eventos en el formulario
		combo_supergrupo= ClaseMadre_getComponente('id_supergrupo');
		//combo_grupo= ClaseMadre_getComponente('id_grupo');
		   				
		
		var onSupergrupoSelect = function(e) {
			var id = combo_supergrupo.getValue()
			
			//combo_grupo.filterValues[0] =  id;
			//combo_grupo.modificado = true;
						
			var  params1 = new Array();
			params1['id_grupo'] = '%';
			params1['nombre'] = 'Todos los Grupos';
			var aux1 = new Ext.data.Record(params1,'%');
			//combo_grupo.store.add(aux1)
			//combo_grupo.setValue('%');
			///////
				
			

		};
		
		
		
		 function clasificacion(){
		    datax = "txt_id_supergrupo=" + combo_supergrupo.getValue();
				
		 }
		
		combo_supergrupo.on('select',clasificacion);
		combo_supergrupo.on('change',clasificacion);
		
		combo_supergrupo.on('select',onSupergrupoSelect);
		combo_supergrupo.on('change',onSupergrupoSelect);
		
	}
	
   //para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_clasificacion_grupo.getLayout();};
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