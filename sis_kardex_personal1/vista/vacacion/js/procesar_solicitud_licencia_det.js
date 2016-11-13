/**
 * Nombre:		  	    pagina_solicitud_licencia_det.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2010-08-17 09:25:59
 */
function pagina_procesar_solicitud_licencia_det(idContenedor,direccion,paramConfig,idContenedorPadre){
	var Atributos=new Array,sw=0;
	var elementos=new Array();
	var componentes=new Array;
	var layout_procesar_solicitud_licencia_det;
	var maestro=new Array();
	var sw=0;
	//---DATA STORE
	var ds=new Ext.data.Store({
		proxy:new Ext.data.HttpProxy({url: direccion+'../../../control/vacacion/ActionListarAprobarSolicitudLicenciaDet.php?tipo=procesar'}),
		reader:new Ext.data.XmlReader({
		record:'ROWS',id:'id_horario',totalRecords:'TotalCount'
		},[		
		'id_horario',
		'id_empleado',
		'id_tipo_horario',
		'id_vacacion',
		'id_empleado_aprobacion',
		{name:'fecha_inicio',type:'date',dateFormat:'Y-m-d'},
		{name:'fecha_fin',type:'date',dateFormat:'Y-m-d'},
		'tipo_periodo',
		'horas_por_dia',
		{name:'fecha_reg',type:'date',dateFormat:'Y-m-d'},
		'observaciones',
		'estado_reg'
		]),remoteSort:true});
	//DATA STORE COMBOS	
	//FUNCIONES RENDER
	function render_estado_reg(value){
		if(value=='borrador'){value='Borrador'	}
		if(value=='pendiente_aprobacion'){value='Pendiente Aprobaci�n'}
		if(value=='aprobado'){value='Aprobado'}
		if(value=='en_proceso'){value='En Proceso'}
		if(value=='reformulado'){value='Reformulado'}
		if(value=='finalizado'){value='Finalizado'}
		if(value=='inactivo'){value='Inactivo'}
		return value
	} 
	function render_tipo_periodo(value){
		if(value=='dia_completo'){value='Dia Completo'}
		else{
			if(value=='manana'){value='Ma�ana'}
		    else{value='Tarde'} }
		return value
	} 
	/////////////////////////
	// Definici�n de datos //
	/////////////////////////
	
	// hidden id_vacacion
	//en la posici�n 0 siempre esta la llave primaria

	Atributos[0]={
		validacion:{
			labelSeparator:'',
			name:'id_horario',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo:'Field',
		filtro_0:false		
	};
	Atributos[1]={
		validacion:{
			labelSeparator:'',
			name:'id_empleado',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false		
	};
// txt id_gestion
	Atributos[2]={
		validacion:{
			labelSeparator:'',
			name:'id_tipo_horario',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false		
	};
	Atributos[3]={
		validacion:{
			labelSeparator:'',
			name:'id_vacacion',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo:'Field',
		filtro_0:false		
	};
	Atributos[4]={
		validacion:{
			labelSeparator:'',
			name:'id_empleado_aprobacion',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo:'Field',
		filtro_0:false		
	};
	Atributos[5]= {	
		validacion:{
			name:'fecha_inicio',
			fieldLabel:'Fecha Inicio',
			allowBlank:true,
			format:'d/m/Y', //formato para validacion
			minValue:'01/01/1900',
			disabledDaysText:'D�a no v�lido',
			grid_visible:true,
			grid_editable:false,
		    renderer:formatDate,
			width_grid:100
		},
		filtro_0:true,
		filtro_1:true,
		filterColValue:'HORARI.fecha_inicio',
		tipo:'DateField',
		dateFormat:'m-d-Y'	
	};
	
// txt total_dias
	Atributos[6]= {	
		validacion:{
			name:'fecha_fin',
			fieldLabel:'Fecha Fin',
			allowBlank:true,
			format:'d/m/Y', //formato para validacion
			minValue:'01/01/1900',
			disabledDaysText:'D�a no v�lido',
			grid_visible:true,
			grid_editable:false,
		    renderer:formatDate,
			width_grid:100
		},
		filtro_0:true,
		filtro_1:true,
		filterColValue:'HORARI.fecha_fin',
		tipo:'DateField',
		dateFormat:'m-d-Y'	
	};
	Atributos[7]={
			validacion: {
			name:'tipo_periodo',
			fieldLabel:'Periodo',
			allowBlank:true,
			typeAhead:true,
			loadMask:true,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[['dia_completo','Dia Completo'],['manana','Ma�ana'],['tarde','Tarde']]}),
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			forceSelection:true,
			grid_visible:true,
			grid_editable:false,
			renderer:render_tipo_periodo,
			width_grid:150,
			disabled:false
		},
		tipo:'ComboBox',
		filtro_0:true,
		filterColValue:'HORARI.tipo_periodo'
	};
	Atributos[8]={
		validacion:{
			name:'horas_por_dia',
			fieldLabel:'Total Dias',
			allowBlank:true,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			//vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:100
			},
			form:false,
		tipo:'TextField',
		filtro_0:true,
		filterColValue:'HORARI.horas_por_dia'
	};
	Atributos[9]={
		validacion:{
			name:'observaciones',
			fieldLabel:'Observaciones',
			allowBlank:true,
			maxLength:255,
			minLength:0,
			selectOnFocus:true,
			//vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:200
		},
		tipo:'TextArea',
		filtro_0:true,
		filterColValue:'HORARI.observaciones'
	};
	Atributos[10]={
		validacion:{
			name:'estado_reg',			
			fieldLabel:'Estado',
			allowBlank:true,
			selectOnFocus:true,
			//vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			renderer:render_estado_reg,
			width_grid:100
		},
		form:false,
		tipo:'TextField',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'HORARI.estado_reg'
	};
	Atributos[11]= {	
		validacion:{
			name:'fecha_reg',
			fieldLabel:'Fecha Registro',
			allowBlank:true,
			format:'d/m/Y', //formato para validacion
			minValue:'01/01/1900',
			disabledDaysText:'D�a no v�lido',
			grid_visible:true,
			grid_editable:false,
		    renderer:formatDate,
			width_grid:100
		},
		form:false,
		filtro_0:true,
		filtro_1:true,
		filterColValue:'HORARI.fecha_reg',
		tipo:'DateField',
		dateFormat:'m-d-Y'	
	};
	Atributos[12]={
		validacion:{
			labelSeparator:'',
			name:'num_solicitud',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo:'Field',
		filtro_0:false		
	};
	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	function formatDate(value){return value?value.dateFormat('d/m/Y'):''};
	//---------- INICIAMOS LAYOUT DETALLE
	var config={titulo_maestro:'Solicitud Licencias',grid_maestro:'grid-'+idContenedor};
	layout_procesar_solicitud_licencia_det=new DocsLayoutMaestro(idContenedor,idContenedorPadre);
	layout_procesar_solicitud_licencia_det.init(config);
	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////
	this.pagina=Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,Atributos,ds,layout_procesar_solicitud_licencia_det,idContenedor);
	var getComponente=this.getComponente;
	var getSelectionModel=this.getSelectionModel;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_btnActualizar=this.btnActualizar;
	var ClaseMadre_saveSuccess=this.saveSuccess;
	var ClaseMadre_eliminarSuccess=this.eliminarSucess;
	var CMenableSelect=this.EnableSelect;
	var getDialog=this.getDialog;
	var getForm=this.getFormulario;
	var ClaseMadre_limpiar=this.limpiarStore;	
	var ClaseMadre_clearSelections=this.clearSelections;
	///////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	///////////////////////////////////
	var paramMenu={
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
	//datos necesarios para el filtro
	var paramFunciones={
		btnEliminar:{url:direccion+'../../../control/vacacion/ActionEliminarReformulaSolicitudLicenciaDet.php'},
		Save:{url:direccion+'../../../control/vacacion/ActionGuardarReformulaSolicitudLicenciaDet.php'},
		ConfirmSave:{url:direccion+'../../../control/vacacion/ActionReformulaGuardarSolicitudLicenciaDet.php'},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,height:300,width:480,minWidth:150,minHeight:200,	closable:true,titulo:'Solicitud Licencia'}};
	this.reload=function(m){
		maestro=m;
		ds.lastOptions={
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_vacacion:maestro.id_vacacion,
				m_id_tipo_horario:maestro.id_tipo_horario,
				m_id_empleado_aprobacion:maestro.id_empleado_aprobacion,
				m_num_solicitud:maestro.num_solicitud
			}
		};
		this.btnActualizar();
		//data_maestro=[['Nro.Documento',maestro.nro_documento],['Raz�n social',maestro.razon_social],['Fecha documento',maestro.fecha_documento],['Importe factura',maestro.importe_total],['Moneda',maestro.desc_moneda]];
		//Ext.DomHelper.overwrite('grid_detalle-'+idContenedor,EstehtmlMaestro(data_maestro));
		Atributos[2].defecto=maestro.id_tipo_horario;
		Atributos[3].defecto=maestro.id_vacacion;
		Atributos[4].defecto=maestro.id_empleado_aprobacion;
		Atributos[12].defecto=maestro.num_solicitud;
		paramFunciones.btnEliminar.parametros='&m_id_vacacion='+maestro.id_vacacion+'&m_id_tipo_horario='+maestro.id_tipo_horario+'&m_id_empleado_aprobacion='+maestro.id_empleado_aprobacion+'&m_num_solicitud='+maestro.num_solicitud;
		paramFunciones.Save.parametros='&m_id_vacacion='+maestro.id_vacacion+'&m_id_tipo_horario='+maestro.id_tipo_horario+'&m_id_empleado_aprobacion='+maestro.id_empleado_aprobacion+'&m_num_solicitud='+maestro.num_solicitud;
		paramFunciones.ConfirmSave.parametros='&m_id_vacacion='+maestro.id_vacacion+'&m_id_tipo_horario='+maestro.id_tipo_horario+'&m_id_empleado_aprobacion='+maestro.id_empleado_aprobacion+'&m_num_solicitud='+maestro.num_solicitud;			
		
		this.InitFunciones(paramFunciones);
	};	
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	//Para manejo de eventos
	function iniciarEventosFormularios(){
	//para iniciar eventos en el formulario
	for(i=0;i<Atributos.length;i++)
		{			
			componentes[i]=getComponente(Atributos[i].validacion.name);			
		}
		sm=getSelectionModel();
	}
	
	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_procesar_solicitud_licencia_det.getLayout()};
	this.getPagina=function(idContenedorHijo)
	{
		var tam_elementos=elementos.length;
		for(i=0;i<tam_elementos;i++)
		{
			if(elementos[i].idContenedor==idContenedorHijo)
			{
				return elementos[i]
			}
		}
	};
	this.getElementos=function(){return elementos};
	this.setPagina=function(elemento){elementos.push(elemento)};
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	this.InitFunciones(paramFunciones);
	//para agregar botones
	
	this.iniciaFormulario();
	iniciarEventosFormularios();
	this.bloquearMenu();
	layout_procesar_solicitud_licencia_det.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}