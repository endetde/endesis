/*
* Nombre de archivo:	    adjunto.js
* Prop�sito:				
* Fecha de Creaci�n:		2010-12-20
* Autor:					Marcos A. Flores Valda
*/

function pagina_adjunto(idContenedor,direccion,paramConfig,maestro,idContenedorPadre)
{
	var vectorAtributos=new Array;
	var componentes=new Array();
	var maestro;
	var cmp_adjunto;

	//---DATA STORE
	var ds = new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/adjunto/ActionListarAdjunto.php'}),
		reader: new Ext.data.XmlReader({
		record: 'ROWS',id:'id_adjunto',totalRecords:'TotalCount'
		},[
		'id_adjunto',
		'nombre_doc',
		'observacion',
		{name:'fecha_reg',type:'date',dateFormat:'Y-m-d'},
		'estado_reg',
		'id_usuario_reg',
		'id_correspondencia',
		'nombre_archivo',
		'extension',
		'nombre_original',
		'desc_persona'
		]),remoteSort:true});
		
		
		var ds_correspondencia = new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/correspondencia/ActionListarCorrespondencia.php'}),
		// aqui se define la estructura del XML
		reader: new Ext.data.XmlReader({
			record: 'ROWS',	id: 'id_correspondencia', totalRecords: 'TotalCount'
		}, [
		// define el mapeo de XML a las etiquetas (campos)
			'id_correspondencia'
			]),remoteSort:true});		
				
	////////////////////////////////////
	// Definici�n de datos para el IUD//
	////////////////////////////////////	
	
	vectorAtributos[0]={
		validacion:{
			name: 'id_adjunto',
			labelSeparator:'',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false
		},
		tipo: 'Field',
		form: true,
		filtro_0:false,
		save_as:'id_adjunto'
	};
	
	vectorAtributos[1]={	
		validacion:{
			name:'nombre_doc',
			fieldLabel:'Nombre documento',
			allowBlank:false,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			width:'95%',
			vtype:'texto',
			grid_visible:true,
			grid_editable:true,
			width_grid:150
		},
		tipo: 'TextField',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'ADJUNT.nombre_doc',
		save_as:'nombre_doc'
	};
	
	vectorAtributos[2]={
			validacion:{
				name:'observacion',
				fieldLabel:'Observaci�n',
				allowBlank:true,
				maxLength:500,
				minLength:0,
				selectOnFocus:true,
				width:'95%',
				vtype:'texto',
				grid_visible:true,
				grid_editable:true,
				width_grid:200
			},
			tipo: 'TextArea',
			filtro_0:true,
			filtro_1:true,
			filterColValue:'ADJUNT.observacion',
			save_as:'observacion'
		};	
	
	vectorAtributos[3]= {
		validacion:{
			name:'fecha_reg',
			fieldLabel:'Fecha de Registro',
			allowBlank:true,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:false,
			renderer: formatDate,
			width_grid:105,
			disabled:true,
			grid_indice:2	
		},
		form:false,
		tipo:'DateField',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'ADJUNT.fecha_reg',
		dateFormat:'d-m-Y'
	};	
			
	vectorAtributos[4]={
		validacion:{
			name: 'id_correspondencia',
			labelSeparator:'',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false
		},
		tipo: 'Field',
		form: true,
		filtro_0:false,
		defecto: maestro.id_correspondencia,
		save_as:'id_correspondencia'
	};

//	vectorAtributos[4]={
//		validacion:{
//			name:'id_correspondencia',
//			fieldLabel:'Id corres',
//			allowBlank:false,
//			allowDecimals:false,			
//			maxLength:20,
//			minLength:0,
//			selectOnFocus:true,
//			width:'95%',
//			vtype:'texto',
//			grid_visible:true,
//			grid_editable:false,
//			width_grid:150
//		},
//		tipo: 'NumberField',
//		filtro_0:true,
//		filtro_1:true,
//		filterColValue:'ADJUNT.id_correspondencia',
//		save_as:'id_correspondencia'
//	};

	vectorAtributos[5]={
		validacion:{
			name:'archivo_adjunto',
			fieldLabel:'Adjunto',
			invalidText: 'Por favor seleccione un archivo',
			allowBlank:false,
			inputType:'file',			
			grid_visible:false,
			grid_editable:false
		},
		tipo: 'Field',
		save_as:'archivo_adjunto'
	};
	
	vectorAtributos[6]={
		validacion:{
			name: 'nombre_original',
			labelSeparator:'',
			inputType:'hidden',
			grid_visible:true,
			grid_editable:false,
			width_grid:300
		},
		tipo: 'Field',
		form: true,
		filtro_0:true,
		filtro_1:true,
		save_as:'nombre_original'
	};
	
	vectorAtributos[7]={
		validacion:{
			name: 'extension',
			labelSeparator:'',
			inputType:'hidden',
			grid_visible:true,
			grid_editable:false,
			width_grid:70
		},
		tipo: 'Field',
		form: true,
		filtro_0:true,
		filtro_1:true,
		save_as:'extension'
	};	
	
	vectorAtributos[8]={
		validacion:{
			name: 'desc_persona',
			labelSeparator:'',
			inputType:'hidden',
			grid_visible:true,
			grid_editable:false,
			width_grid:300
		},
		tipo: 'Field',
		form: true,
		filtro_0:true,
		filtro_1:true,
		save_as:'desc_persona'
	};	
	
	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	
	function formatDate(value){return value?value.dateFormat('d/m/Y'):''};

	//---------- INICIAMOS LAYOUT MAESTRO
	
	var config={
	 		titulo_maestro:'Adjunto',
	 		grid_maestro:'grid-'+idContenedor};
	var layout_adjunto = new DocsLayoutMaestro(idContenedor);
	layout_adjunto.init(config);	
	
	//---------- INICIAMOS LAYOUT DETALLE
//	var config = {
//			titulo_maestro:'Adjunto',
//			grid_maestro:'grid-'+idContenedor,
//			urlHijo:'../../../sis_flujo/vista/adjunto/visor.php'
//		};
//			
//	var layout_adjunto = new DocsLayoutMaestroDeatalle(idContenedor);
//	layout_adjunto.init(config);
	
	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////

	this.pagina=Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,ds,layout_adjunto,idContenedor);
	
	var getSelectionModel=this.getSelectionModel;
	var ClaseMadre_getComponente=this.getComponente;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_btnNew=this.btnNew;
	var ClaseMadre_btnEdit=this.btnEdit;	
	var ClaseMadre_Save=this.Save;	
	var ClaseMadre_onResize=this.onResize;
	var ClaseMadre_SaveAndOther=this.SaveAndOther;		
	var ClaseMadre_getDialog=this.getDialog;
	var ClaseMadre_getGrid=this.getGrid;
	var ClaseMadre_getFormulario=this.getFormulario;
	var CM_ocultarGrupo=this.ocultarGrupo;
	var CM_mostrarGrupo=this.mostrarGrupo;
	var CM_saveSuccess=this.saveSuccess;
	var CM_enableSelect=this.EnableSelect;

	///////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	///////////////////////////////////

	var paramMenu=
	{
		guardar:{crear:true,separador:false},
		nuevo:{crear:true,separador:true},
		editar:{crear:true,separador:false},
		eliminar:{crear:true,separador:false},
		actualizar:{crear:true,separador:false}
	};	
	
	//////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////
	function obtenerTitulo()
	{		
		var titulo = "Adjunto";
		return titulo;
	}	
	
	//datos necesarios para el filtro
	var paramFunciones={
		btnEliminar:{url:direccion+'../../../control/adjunto/ActionEliminarAdjunto.php?id_correspondencia='+maestro.id_correspondencia},		
		Save:{url:direccion+'../../../control/adjunto/ActionGuardarAdjunto.php'},				
		ConfirmSave:{url:direccion+'../../../control/adjunto/ActionGuardarAdjunto.php'},
		Formulario:{
			html_apply:'dlgInfo-'+idContenedor,
			height:300,width:450,minWidth:150,minHeight:200,	
			titulo_pestana:obtenerTitulo,	
			closable:true,			
			titulo:'Adjunto',
			upload:true
		}
	};
	
	function btnVerAdjunto()
	{
		//obtiene el selection model del grid
		var sm=getSelectionModel();
		
		//obtiene la cantidad de registros seleccionados
		var NumSelect=sm.getCount();
		
		if(NumSelect==1)
		{
			//obtiene el registro seleccionado
			var SelectionsRecord=sm.getSelected();
					
			var ParamVentana={Ventana:{width:'90%',height:'70%'}}				
					
			window.open(direccion+'../../../../sis_flujo/control/adjunto/arch_adjuntos/adjunto_'+SelectionsRecord.data.id_adjunto+'.'+SelectionsRecord.data.extension);
		}
		else if(NumSelect>1) 
		{
			Ext.MessageBox.alert('Estado', 'Tiene mas de un registro seleccionado.');
		}
		
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		}
	}
	
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	
	function iniciarEventosFormularios()
	{				
		grid=ClaseMadre_getGrid();
		dialog=ClaseMadre_getDialog();
		var sm=getSelectionModel();
		formulario=ClaseMadre_getFormulario();
		
		for(i=0;i<vectorAtributos.length-1;i++)
		{
			componentes[i]=ClaseMadre_getComponente(vectorAtributos[i].validacion.name)
		}	
	}
	
	this.btnNew = function()
	{		
		ClaseMadre_btnNew();
		
		if(componentes[5].getValue() == '')
		{
			componentes[5].markInvalid('Este campo es obligatorio');
		}
	}	
		
	this.btnEdit = function()
	{		
	    ClaseMadre_btnEdit();
	    componentes[5].reset();
	}
				
	this.reload=function(params){
		var datos=Ext.urlDecode(decodeURIComponent(params));
		maestro.id_correspondencia=datos.id_correspondencia;
   		ds.lastOptions={
   			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				id_correspondencia:maestro.id_correspondencia
			}
		};
		
   		ds_correspondencia.reload={
   				params:{
	   				start:0,
	   				limit:1,
	   				id_correspondencia: maestro.id_correspondencia
   			}
   		};
   		
   		paramFunciones.btnEliminar.url=direccion+'../../../control/adjunto/ActionEliminarAdjunto.php?id_correspondencia='+maestro.id_correspondencia;		
		
		vectorAtributos[4].defecto=maestro.id_correspondencia;
		this.btnActualizar();
		this.InitFunciones(paramFunciones)
	};
			
	this.getElementos = function(){return elementos};
	this.setPagina = function(elemento){elementos.push(elemento)};

    //para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_adjunto.getLayout()};
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	this.InitFunciones(paramFunciones);
	
	this.AdicionarBoton('../../../lib/imagenes/book.gif','Ver Adjunto',btnVerAdjunto,true,'ver_adjunto','Ver Adjunto');
		
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros,
			id_correspondencia:maestro.id_correspondencia
			}
		});
	
	this.iniciaFormulario();
	iniciarEventosFormularios();
		
	layout_adjunto.getLayout().addListener('layout',this.onResize);//arregla la ventana del grid dentro del layout
	_CP.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}