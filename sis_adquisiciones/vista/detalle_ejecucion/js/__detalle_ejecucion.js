/**
 * Nombre:		  	    pagina_recibo_caja.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2009-10-27 11:50:07
 */
function pagina_detalle_ejecucion(idContenedor,direccion,paramConfig,maestro){
	var Atributos=new Array,sw=0;
	var componentes=new Array;
	var fecha=new Date();
	var grid;
	var reporte; //reporte 0:sin reporte, reporte 1: vista previa, reporte 2: reporte oficial
	var cm;
	var vista2='solicitud_efectivo';
	var tipo_recibo;
	var id_cuenta;
	var datos_reporte;
	var tipo_recibo;
	var etiqueta;
	var vista;
	var id;
	
	id=maestro.id;
	vista=maestro.vista;

	//---DATA STORE
	var ds = new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/detalle_ejecucion/ActionListarDetalleEjecucion.php'}),
		reader: new Ext.data.XmlReader({
		record: 'ROWS',id:'id_partida_ejecucion',totalRecords:'TotalCount'
		},[		
		'id_solicitud_compra_det',
		'id_partida_ejecucion',
		'gestion',
		'nro_solicitud',
		'desc_detalle',
		'importe_total',
		'saldo',
		'importe_eje_rev',
		'id_adjudicacion'
		]),remoteSort:true});

	if(vista=='devengado_fin' || vista=='devengado')
		etiqueta='Importe a Devengar';
	else if(vista=='pagado')
		etiqueta='Importe a Pagar';
	else
	 	etiqueta='Importe a Revertir';
	
	/////////////////////////
	// Definici�n de datos //
	/////////////////////////
	
	// hidden id_cuenta_doc
	//en la posici�n 0 siempre esta la llave primaria

	Atributos[0]={
		validacion:{
			labelSeparator:'',
			name: 'id_solicitud_compra_det',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		save_as:'id_solicitud_compra_det'
	};
	
	Atributos[1]={
		validacion:{
			labelSeparator:'',
			name: 'id_partida_ejecucion',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		save_as:'id_partida_ejecucion'
	};
	

	Atributos[2]={
			validacion:{
			name:'gestion',
			fieldLabel:'Gesti�n',
			grid_visible:true,
			grid_editable:false,
			width_grid:80
			
		},
		tipo:'Field',
		form: false,
		filtro_0:true,
		filterColValue:'gestion'	
	};
	

	Atributos[3]={
			validacion:{
			name:'nro_solicitud',
			fieldLabel:'N� Sol.',
			grid_visible:true,
			grid_editable:false,
			width_grid:80
			
		},
		tipo:'Field',
		form: false,
		filtro_0:true,
		filterColValue:'num_solicitud'	
	};
	

	Atributos[4]={
			validacion:{
			name:'desc_detalle',
			fieldLabel:'Detalle',
			grid_visible:true,
			grid_editable:false,
			width_grid:200
			
		},
		tipo:'Field',
		form: false,
		filtro_0:true,
		filterColValue:'desc_detalle'	
	};

	
	Atributos[5]={
			validacion:{
			name:'importe_total',
			fieldLabel:'Importe Total',
			grid_visible:true,
			grid_editable:false,
			width_grid:120
			
		},
		tipo:'NumberField',
		form: false,
		filtro_0:false
	};
	
	Atributos[6]={
			validacion:{
			name:'saldo',
			fieldLabel:'Saldo',
			grid_visible:true,
			grid_editable:false,
			width_grid:120
		},
		tipo:'NumberField',
		form: false,
		filtro_0:false
	};
	Atributos[7]={
		validacion:{
			labelSeparator:'',
			name: 'id_adjudicacion',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		save_as:'id_adjudicacion'
	};
	if(vista!='devengado_fin'){
		Atributos[8]={
				validacion:{
					name:'importe_eje_rev',
					fieldLabel:etiqueta,
					grid_visible:true,
					grid_editable:true,
					width_grid:120
				
				},
				tipo:'NumberField',
				form: false,
				filtro_0:false
			};
	}
	
	
		
	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	var config={titulo_maestro:'detalle_ejecucion',grid_maestro:'grid-'+idContenedor};
		
	var layout_detalle_ejecucion=new DocsLayoutMaestro(idContenedor);
	layout_detalle_ejecucion.init(config);
	
	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////

	
	this.pagina=Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,Atributos,ds,layout_detalle_ejecucion,idContenedor);
	var CM_getComponente=this.getComponente;
	var getSelectionModel=this.getSelectionModel;
	var cm_EnableSelect=this.EnableSelect;
	var CM_btnNew=this.btnNew;
	var CM_btnEdit=this.btnEdit;
	var CM_ocultarGrupo=this.ocultarGrupo;
	var CM_mostrarGrupo=this.mostrarGrupo;
	var cm_mostrarComponente=this.mostrarComponente;
	var cm_ocultarComponente=this.ocultarComponente;
	var CM_getGrid=this.getGrid;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_btnActualizar=this.btnActualizar;
	var CM_getColumnNum=this.getColumnNum;
	var CM_getFormulario=this.getFormulario;
	var CM_InitFunciones=this.InitFunciones;
	var CM_Save=this.Save;
	var CM_saveSuccess=this.saveSuccess;
	

	///////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	///////////////////////////////////
	
	if(vista=='devengado_fin'){
		var paramMenu={
			
			
		};
		
	}
	else{
		var paramMenu={
			guardar:{crear:true,separador:false}		
		};
	}


	//////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////
	
	//datos necesarios para el filtro
	var paramFunciones={
		ConfirmSave:{url:direccion+'../../../control/detalle_ejecucion/ActionGuardarDetalleEjecucion.php',parametros:'&vista='+vista+'&id='+id},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,height:'55%',columnas:['95%'],width:'45%',minWidth:350,minHeight:400,closable:true,titulo:'detalle_ejecucion',
			grupos:[
			{
				tituloGrupo:'Oculto',
				columna:0,
				id_grupo:0
			}
			]
		}};
	
	this.reload=function(m){
		
		var datos=Ext.urlDecode(decodeURIComponent(m));
		id=datos.id;	
		vista=datos.vista;
		ds.lastOptions={
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				estado:vista,
				id:id
			}
		};
		this.btnActualizar();
		
		paramFunciones.ConfirmSave.parametros='&vista='+vista+'&id='+id;
		this.InitFunciones(paramFunciones);
		//Ext.MessageBox.alert('Atenci�n', 'Todos los importes mostrados en esta pantalla son en Bs.');
			
	};
	
	this.postreload=function(){
		Ext.MessageBox.alert('Atenci�n', 'Todos los importes mostrados en esta pantalla son en Bs.');
	};

	
		
	
		
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//

	
	//Para manejo de eventos
	function iniciarEventosFormularios()
	{	
			Ext.MessageBox.alert('Atenci�n', 'Todos los importes mostrados en esta pantalla son en Bs.');
			grid=CM_getGrid();
			grid.on('validateedit',validarImportes);
			
			
	}
	function validarImportes(e){
		
		var datos=e.record.data;
		if(parseFloat(e.value)>parseFloat(datos.saldo)){
			Ext.MessageBox.alert('Atenci�n', 'El importe a ejecutar o revertir no puede ser mayor al saldo');
			return false;
		}
		return true;
	}
	
	
	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_detalle_ejecucion.getLayout()};
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	var CM_getBoton=this.getBoton;
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	this.InitFunciones(paramFunciones);
	
	ds.load({
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				estado:vista,
				id:id
			}
		});
			
	this.iniciaFormulario();
	iniciarEventosFormularios();
	layout_detalle_ejecucion.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}