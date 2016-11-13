/**
 * Nombre:		  	    pagina_empleado_trabajo.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Mercedes Zambrana Meneses
 * Fecha creaci�n:		02-09-2010
 */
function pagina_empleado_trabajo(idContenedor,direccion,paramConfig, busqueda,idContenedorPadre){
	var vectorAtributos=new Array;
	var ds;
	var elementos=new Array();
	
	var combo_persona,txt_codigo_empleado,txt_nombre_tipo_documento;
    var txt_doc_id,txt_email1;
    var maestro=new Array();
	var sw=0;
	var componentes=new Array;
	var dialog;
	var form;
	
	/////////////////
	//  DATA STORE //
	/////////////////
	ds=new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy:new Ext.data.HttpProxy({url:direccion+'../../../control/empleado_trabajo/ActionListarEmpleadoTrabajo.php'}),
		// aqui se define la estructura del XML
		reader:new Ext.data.XmlReader({
			record:'ROWS',
			id:'id_empleado_trabajo',
			totalRecords:'TotalCount'
		},[
		// define el mapeo de XML a las etiquetas (campos)
		'id_empleado_trabajo',
		'id_empleado',
		
		'descripcion','cargo',
		'id_institucion',
		'tipo_institucion',
		
		{name:'fecha_ini',type:'date',dateFormat:'Y-m-d'},
		{name:'fecha_fin',type:'date',dateFormat:'Y-m-d'},
		'desc_institucion','desc_empleado','nombre_institucion','direccion_institucion'
		]),remoteSort:true});

	//DATA STORE COMBOS   	
	
	ds_institucion = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/institucion/ActionListarInstitucion.php'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_institucion',
		totalRecords: 'TotalCount'
	}, ['id_institucion','tdoc_id','doc_id','nombre','casilla','telefono1','telefono2','celular1','celular2','fax','email1','email2','pag_web','observaciones','fecha_registro','hora_registro','fecha_ultima_modificacion','hora_ultima_modificacion','estado_institucion','id_persona'])
	});
	//FUNCIONES RENDER
	
	function render_id_institucion(value, p, record){return String.format('{0}', record.data['desc_institucion']);}
	
	function render_financiado(value){
		if(value=='si'){value='Si'	}
		else if(value=='no'){	value='No'		}
		else if(value=='parcial'){value='Parcial'}
		return value
	}
	
	function render_tipo_institucion(value)
	{
		if(value=='privado'){value='Privado'	}
		else if(value=='publico'){value='P�blico'	}
		return value
	}
	
    
	vectorAtributos[0]={
		validacion:{
			labelSeparator:'',
			name:'id_empleado_trabajo',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo:'Field',
		filtro_0:false
	};
// txt id_empleado
	vectorAtributos[1]={
		validacion:{
			name:'id_empleado',
			labelSeparator:'',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false,
			disabled:true
		},
		tipo:'Field',
		filtro_0:false,
		defecto:maestro.id_empleado,
		save_as:'id_empleado'
	};
	
	
    
	vectorAtributos[2]= {
		validacion: {
			name:'tipo_institucion',
			emptyText:'Tipo Institucion',
			fieldLabel:'Tipo Institucion',
			allowBlank:false,
			typeAhead: true,
			loadMask: true,
			triggerAction: 'all',
			
			store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[
			['publico','Publico'],['privado','Privado']
			]}),
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			renderer:render_tipo_institucion,
			forceSelection:true,
			grid_visible:true,
			grid_editable:false,
			width_grid:100
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:false,
		filterColValue:'EMPTRA.tipo_institucion',
		save_as:'tipo_institucion',
		id_grupo:0
		};
	
		vectorAtributos[3]= {
				validacion: {
				name:'id_institucion',
				fieldLabel:'Instituci�n',
				allowBlank:false,
				emptyText:'Instituci�n...',
				name: 'id_institucion',     //indica la columna del store principal ds del que proviane el id
				desc: 'desc_institucion', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_institucion,
				valueField: 'id_institucion',
				displayField: 'nombre',
				queryParam: 'filterValue_0',
				filterCol:'INSTIT.nombre#INSTIT.casilla',
				typeAhead:true,
				forceSelection:true,
				mode:'remote',
				queryDelay:250,
				pageSize:150,
				minListWidth:450,
				grow:true,
				width:'100%',
				confTrigguer:{
						url:direccion+'../../../../sis_parametros/vista/institucion/institucion.php?tipo=sel_per',
					    paramTri:'prueba:XXX',		
					    title:'Instituciones',
					    param:{width:800,height:800},
					    idContenedor:idContenedor
					   // baseParams={tipo:'si'}
					   // clase_vista:'pagina_persona'
				},
				//grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_id_institucion,
				grid_visible:true,
				grid_editable:false,
				width_grid:150 // ancho de columna en el gris
	
			},
			tipo:'ComboTrigger',
			filtro_0:false,
			filtro_1:false,
			filterColValue:'INSTIT.nombre',
			defecto: '',
			form:true,
			save_as:'id_institucion',
			id_grupo:0
			
		};

	vectorAtributos[4]={
		validacion:{
			name:'nombre_institucion',
			fieldLabel:'Nombre Instituci�n',
			allowBlank:true,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:250,
			width:250
		},
		tipo:'TextField',
		filtro_0:false,
		filtro_1:false,
		form:false,
		id_grupo:0
		
	};
	
	vectorAtributos[5]={
		validacion:{
			name:'direccion_institucion',
			fieldLabel:'Direcci�n Instituci�n',
			allowBlank:true,
			maxLength:200,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:250,
			width:250
		},
		tipo:'TextField',
		filtro_0:false,
		filtro_1:false,
		//filterColValue:'UNIORG.nombre_cargo'	
		form:false,
		id_grupo:0
	};
				
vectorAtributos[6]={
		validacion:{
			name:'cargo',
			fieldLabel:'Cargo',
			allowBlank:false,
			
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width:250,
			width_grid:200
		},
		tipo:'TextField',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'EMPTRA.cargo',
		id_grupo:1
	};
		
vectorAtributos[7]={
		validacion:{
			name:'descripcion',
			fieldLabel:'Principales Funciones',
			allowBlank:true,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width:'100%',
			height:270,
			width_grid:150
		},
		tipo:'TextArea',
		filtro_0:true,
		filtro_1:true,
		id_grupo:1,
		filterColValue:'EMPTRA.descripcion'	
	};
	// txt fecha_registro
	vectorAtributos[8]={
		validacion:{
			name:'fecha_ini',
			fieldLabel:'Fecha Inicio',
			allowBlank:false,
			format:'d/m/Y', //formato para validacion
			minValue:'01/01/1900',
			disabledDaysText:'D�a no v�lido',
			grid_visible:true,
			grid_editable:false,
			renderer:formatDate,
			width:150,
			width_grid:95,
			disabled:false
		},
		tipo:'DateField',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'EMPTRA.fecha_ini',
		dateFormat:'m-d-Y',
		defecto:'',
		id_grupo:1,
		save_as:'fecha_ini'
	};	
	
	vectorAtributos[9]={
		validacion:{
			name:'fecha_fin',
			fieldLabel:'Fecha Fin',
			allowBlank:false,
			format:'d/m/Y', //formato para validacion
			minValue:'01/01/1900',
			disabledDaysText:'D�a no v�lido',
			grid_visible:true,
			grid_editable:false,
			renderer:formatDate,
			width:150,
			width_grid:95,
			disabled:false
		},
		tipo:'DateField',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'EMPTRA.fecha_fin',
		dateFormat:'m-d-Y',
		defecto:'',
		id_grupo:1,
		save_as:'fecha_fin'
	};	

	vectorAtributos[10]={
		validacion:{
			name:'id_persona',
			labelSeparator:'',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false,
			disabled:true
		},
		tipo:'Field',
		filtro_0:false,
		defecto:maestro.id_persona,
		save_as:'id_persona'
	};
	
	
	//5ago11
	vectorAtributos[11]=
	{
		validacion:{
			name: 'numero',
			labelSeparator:'',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false		
		},
		tipo: 'Field',
		form: true,
		filtro_0:false,
		save_as:'numero'
	};
	vectorAtributos[12]=
	{
		validacion:{
			name: 'extension',
			labelSeparator:'',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false		
		},
		tipo: 'Field',
		form: true,
		filtro_0:false,
		save_as:'extension'
	};
	// ----------            FUNCIONES RENDER    ---------------//
	function formatDate(value){
		return value ? value.dateFormat('d/m/Y') : '';
	};
	
	
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
	//Inicia Layout
	/*var config={
		titulo_maestro:'Empleado Cuenta',
		grid_maestro:'grid-'+idContenedor
	};*/
	//var config={titulo_maestro:'Empleado (Maestro)',titulo_detalle:'Trabajo (Detalle)',grid_maestro:'grid-'+idContenedor};
	if(busqueda=='si'){
	var config={titulo_maestro:'Trabajo',grid_maestro:'grid-'+idContenedor,urlHijo:'../../../sis_kardex_personal/vista/empleado_capacitacion/empleado_capacitacion.php?buscar=si',title_hijo:'Estudios Realizados'};	
	}else{
	  var config={titulo_maestro:'Trabajo',grid_maestro:'grid-'+idContenedor,urlHijo:'../../../sis_kardex_personal/vista/empleado_capacitacion/empleado_capacitacion.php',title_hijo:'Estudios Realizados'};	
	}
	
		//var config={titulo_maestro:'Curriculum',grid_maestro:'grid-'+idContenedor,urlHijo:'../../../sis_kardex_personal/vista/empleado_capacitacion/empleado_capacitacion.php'};
		//var config={titulo_maestro:'Curriculum',grid_maestro:'grid-'+idContenedor,urlHijo:'../../../sis_kardex_personal/vista/empleado_trabajo/empleado_trabajo.php'};
		layout_empleado_trabajo=new DocsLayoutMaestroDeatalle(idContenedor,idContenedorPadre);
	
	
	//var layout_empleado_trabajo=new DocsLayoutMaestro(idContenedor);
	layout_empleado_trabajo.init(config);
	// INICIAMOS HERENCIA //
	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina=Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,ds,layout_empleado_trabajo,idContenedor);
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
	
	
	var getSelectionModel=this.getSelectionModel;
	var getComponente=this.getComponente;
	var CM_ocultarComponente=this.ocultarComponente;
	var CM_mostrarComponente=this.mostrarComponente;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	
	var ClaseMadre_btnNew=this.btnNew;
	var ClaseMadre_btnEdit=this.btnEdit;
	var ClaseMadre_onResize=this.onResize;
	var ClaseMadre_SaveAndOther=this.SaveAndOther;
	
	var cm_EnableSelect=this.EnableSelect;
	var cm_DeselectRow=this.DeselectRow;
	var etGrid=this.getGrid;
	
	
	
	if(busqueda=='si'){
	   var paramMenu={
		
		actualizar:{crear:true,separador:false}
	};	
	}else{
	// DEFINICI�N DE LA BARRA DE MEN�//
	var paramMenu={
		guardar:{crear:true,separador:false},
		nuevo:{crear:true,separador:true},
		editar:{crear:true,separador:false},
		eliminar:{crear:true,separador:false},
		actualizar:{crear:true,separador:false}
	};
	}
	
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//datos necesarios para el filtro
	var paramFunciones={
		btnEliminar:{url:direccion+'../../../control/empleado_trabajo/ActionEliminarEmpleadoTrabajo.php',parametros:'&m_id_empleado='+maestro.id_empleado+'&m_id_persona='+maestro.id_persona},
	Save:{url:direccion+'../../../control/empleado_trabajo/ActionGuardarEmpleadoTrabajo.php',parametros:'&m_id_empleado='+maestro.id_empleado+'&m_id_persona='+maestro.id_persona},
	ConfirmSave:{url:direccion+'../../../control/empleado_trabajo/ActionGuardarEmpleadoTrabajo.php',parametros:'&m_id_empleado='+maestro.id_empleado+'&m_id_persona='+maestro.id_persona},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,
		height:300,	//alto
		width:400,
		//minWidth:400,
		//minHeight:300,	
		closable:true,
		titulo:'Funcionario Trabajo',
		grupos:[
		  {
			tituloGrupo:'Datos de Instituci�n',
			columna:0,
			id_grupo:1
		  },{
			tituloGrupo:'Datos de Trabajo',
			columna:0,
			id_grupo:0
		  }]}
	};	
	
	this.reload=function(m)
	{
			maestro=m;			
	
			ds.lastOptions={
				params:{
					start:0,
					limit: paramConfig.TamanoPagina,
					CantFiltros:paramConfig.CantFiltros,
					m_id_empleado:maestro.id_empleado,
					m_id_persona:maestro.id_persona	
					//05ago11
					,m_numero:maestro.numero,
					m_extension:maestro.extension 
					
				}
			};			
				
		  
			
			_CP.getPagina(layout_empleado_trabajo.getIdContentHijo()).pagina.reload(m);
		    _CP.getPagina(layout_empleado_trabajo.getIdContentHijo()).pagina.desbloquearMenu();	
			
		   
			
			this.btnActualizar();
			vectorAtributos[1].defecto=maestro.id_empleado;
			vectorAtributos[10].defecto=maestro.id_persona;
			vectorAtributos[11].defecto=maestro.numero;
			vectorAtributos[12].defecto=maestro.extension;
			
			paramFunciones.btnEliminar.parametros='&m_id_empleado='+maestro.id_empleado+'&m_id_persona='+maestro.id_persona;
			paramFunciones.Save.parametros='&m_id_empleado='+maestro.id_empleado+'&m_id_persona='+maestro.id_persona;
			paramFunciones.ConfirmSave.parametros='&m_id_empleado='+maestro.id_empleado+'&m_id_persona='+maestro.id_persona;			
			
			this.InitFunciones(paramFunciones);
			
	};
		
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//		
	//Para manejo de eventos
	function iniciarEventosFormularios()
	{
		    var emptra_grid=etGrid();
			if(busqueda=='si'){
			   emptra_grid.getColumnModel().setHidden(2,true);
			   emptra_grid.getColumnModel().setHidden(3,true);
			   emptra_grid.getColumnModel().setHidden(0,true);
			}
		
		
		//nombre_institucion=getComponente('nombre_institucion');
		//direccion_institucion=getComponente('direccion_institucion');
		cmb_institucion=getComponente('id_institucion');
		
		
		var onInstitucion=function(e){
		
		}
		cmb_institucion.on('select',onInstitucion);
	}

	
	this.btnNew=function(){
		getComponente('id_institucion').enable();
		ClaseMadre_btnNew()
	};
	this.btnEdit=function(){
		getComponente('id_institucion').enable();
		ClaseMadre_btnEdit()
	};
	
	
	
	/*this.EnableSelect=function(sm,row,rec){
		
		var sm=getSelectionModel();
		var NumSelect=sm.getCount();	
		
		//enable(sm,row,rec);
		cm_EnableSelect(sm,row,rec); 
		
		if(maestro.id_empleado!=''){ alert("es empleado")
		  	CM_getBoton('relacion_familiar-'+idContenedor).enable();
		}else{ alert("no es empleado")
		  	CM_getBoton('relacion_familiar-'+idContenedor).disable();
		}
		
	}*/

	/*this.DeselectRow=function(sm,row){ 
		var sm=getSelectionModel();
		
		cm_DeselectRow(sm,row); 
		
		  if(_CP.getPagina(layout_empleado_trabajo.getIdContentHijo()).pagina.limpiarStore()){
		   _CP.getPagina(layout_empleado_trabajo.getIdContentHijo()).pagina.bloquearMenu();	}
			
	}*/
	
	//5ago11
	function btn_datos_personales(){
				var sm=getSelectionModel();
				var filas=ds.getModifiedRecords();
				var cont=filas.length;
				var NumSelect=sm.getCount();
				if(maestro.id_persona!=''){

					var SelectionsRecord=sm.getSelected();
					var data='m_id_persona='+maestro.id_persona;
					data=data+ '&numero='+maestro.numero+'&extension='+maestro.extension;
					data=data+'&tipo_reporte=datos_personales';
					
						//alert (ClaseMadre_getComponente('numero').getValue());	
					window.open(direccion+'../../../../sis_kardex_personal/control/empleado/ActionPDFEmpleadosCV.php?'+data)

				}
				else
				{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar a persona');
				}
			}
			
	function btn_relacion_familiar()
	{
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		if(maestro.id_empleado!='')
		{
			var SelectionsRecord=sm.getSelected();
			var data='id_empleado='+maestro.id_empleado;
			
			var ParamVentana={Ventana:{width:'60%',height:'70%'}}
			layout_persona.loadWindows(direccion+'../../../../sis_kardex_personal/vista/relacion_familiar/relacion_familiar.php?'+data,'Relacion Familiar',ParamVentana);
            layout_persona.getVentana().on('resize',function(){layout_persona.getLayout().layout()})
		}
		else
		{
			Ext.MessageBox.alert('Estado','Antes debe seleccionar un funcionario')
		}
	}
	
	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){
		return layout_empleado_trabajo.getLayout()
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
	
	this.getElementos=function(){return elementos};
	this.setPagina=function(elemento){elementos.push(elemento)};
	
	//-------------- FIN DEFINICI�N DE FUNCIONES PROPIAS --------------//
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	this.InitFunciones(paramFunciones);
	
	//para agregar botones
	this.iniciaFormulario();
	iniciarEventosFormularios();
	
	//5ago11
	
	var CM_getBoton=this.getBoton;
	if(busqueda=='si'){
	    this.AdicionarBoton('../../../lib/imagenes/print.gif','Datos Personales',btn_datos_personales,true,'datos_personales','Datos Personales');
	    this.AdicionarBoton('../../../lib/imagenes/user_div.png','Relacion Familiar',btn_relacion_familiar,true,'relacion_familiar','Relacion Familiar');
	}
	
	layout_empleado_trabajo.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario)
	
	
	
}