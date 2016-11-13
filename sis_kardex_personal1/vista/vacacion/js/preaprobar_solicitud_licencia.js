/**
 * Nombre:		  	    pagina_preaprobar_solicitud_licencia.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2007-10-18 09:06:57
 */
function pagina_preaprobar_solicitud_licencia(idContenedor,direccion,paramConfig){
	var Atributos=new Array;
	var ds;
	var elementos=new Array();
	var layout_preaprobar_solicitud_licencia;
	var sw=0;
	var componentes=new Array;
	var data;
	
	/////////////////
	//  DATA STORE //
	/////////////////
	var ds=new Ext.data.Store({
		proxy:new Ext.data.HttpProxy({url: direccion+'../../../control/vacacion/ActionListarAprobarSolicitudLicencia.php?tipo=preaprobar'}),
		reader:new Ext.data.XmlReader({
		record:'ROWS',id:'id_horario',totalRecords:'TotalCount'
		},[		
		'id_empleado',
		'nombre_completo',
		'id_tipo_horario',
		'nombre_tipo_horario',
		'id_vacacion',
		'id_empleado_aprobacion'
		]),remoteSort:true});
		
	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros
		}
	});
	
	//DATA STORE COMBOS
      
	//FUNCIONES RENDER	
	function render_id_tipo_horario(value,p,record){return String.format('{0}',record.data['nombre_tipo_horario'])}
	function render_id_empleado(value,p,record){return String.format('{0}',record.data['nombre_completo'])}
	// Definici�n de datos //		
	Atributos[0]={
			validacion:{
			name:'id_empleado',
			fieldLabel:'Solicitante',
			allowBlank:false,	
			renderer:render_id_empleado,
			grid_visible:true,
			grid_editable:false,
			width_grid:200
		},
		tipo:'TextField',
		filtro_0:true,
		filterColValue:'EMPLEA.nombre_completo'
	};
// txt id_gestion
	Atributos[1]={
			validacion:{
			name:'id_tipo_horario',
			fieldLabel:'Tipo Licencia',
			allowBlank:false,	
			renderer:render_id_tipo_horario,
			grid_visible:true,
			grid_editable:false,
			width_grid:150
		},
		tipo:'TextField',
		filtro_0:true,
		filterColValue:'TIPHOR.nombre'
	};
	Atributos[2]={
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
	Atributos[3]={
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
	// ----------            FUNCIONES RENDER    ---------------//
	function formatDate(value){
		return value ? value.dateFormat('d/m/Y') : '';
	};
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//	
	var config={titulo_maestro:'Vacaciones',grid_maestro:'grid-'+idContenedor,urlHijo:'../../../sis_kardex_personal/vista/vacacion/preaprobar_solicitud_licencia_det.php'};
	layout_preaprobar_solicitud_licencia=new DocsLayoutMaestroDeatalle(idContenedor);
	layout_preaprobar_solicitud_licencia.init(config);
	
	
	// INICIAMOS HERENCIA //
	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina=Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,Atributos,ds,layout_preaprobar_solicitud_licencia,idContenedor);
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
	var getSelectionModel=this.getSelectionModel;
	var ClaseMadre_getComponente=this.getComponente;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_btnNew=this.btnNew;
	var ClaseMadre_btnEdit=this.btnEdit;
	var ClaseMadre_onResize=this.onResize;
	var ClaseMadre_btnActualizar=this.btnActualizar;
	var ClaseMadre_clearSelections=this.clearSelections;
	var CM_mostrarComponente=this.mostrarComponente;
	var CM_ocultarComponente=this.ocultarComponente;
	var ClaseMadre_SaveAndOther=this.SaveAndOther;
	var cm_EnableSelect=this.EnableSelect;
	// DEFINICI�N DE LA BARRA DE MEN�//
	var paramMenu={
		//guardar:{crear:true,separador:false},
		//nuevo:{crear:true,separador:true},
		//editar:{crear:true,separador:false},
		//eliminar:{crear:true,separador:false},
		actualizar:{crear:true,separador:false}
	};
	
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//datos necesarios para el filtro
	var paramFunciones={
		//btnEliminar:{url:direccion+'../../../control/horario/ActionEliminarHorario.php'},
		//Save:{url:direccion+'../../../control/horario/ActionGuardarHorario.php'},
		//ConfirmSave:{url:direccion+'../../../control/horario/ActionGuardarHorario.php'},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,
		height:300,	//alto
		width:400,				
		closable:true,
		titulo:'Aprueba Solicitud'}
	};	
		
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	
	
	//Para manejo de eventos
	function iniciarEventosFormularios(){
		for(var i=0; i<Atributos.length; i++)
		{
			componentes[i]=ClaseMadre_getComponente(Atributos[i].validacion.name)
		}
		
		//para iniciar eventos en el formulario
		getSelectionModel().on('rowdeselect',function()
		{
			if(_CP.getPagina(layout_preaprobar_solicitud_licencia.getIdContentHijo()).pagina.limpiarStore())
			{
				//_CP.getPagina(layout_solicitud_licencia.getIdContentHijo()).pagina.limpiarStore();
				_CP.getPagina(layout_preaprobar_solicitud_licencia.getIdContentHijo()).pagina.bloquearMenu()
			}
			
		} )	
	}
	this.EnableSelect=function(sm,row,rec){
		var sm=getSelectionModel();
		var NumSelect=sm.getCount();	
		cm_EnableSelect(sm,row,rec);
		
		 _CP.getPagina(layout_preaprobar_solicitud_licencia.getIdContentHijo()).pagina.desbloquearMenu()
		  
		_CP.getPagina(layout_preaprobar_solicitud_licencia.getIdContentHijo()).pagina.reload(rec.data);
				
	}
	function btn_aprobar(){
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			if(confirm("Est� seguro de preaprobar la solicitud del funcionario "+SelectionsRecord.data.nombre_completo+"?")){
					data='cantidad_ids=1&hidden_id_vacacion_0='+SelectionsRecord.data.id_vacacion;
				    data=data+'&hidden_id_tipo_horario_0='+SelectionsRecord.data.id_tipo_horario;
				    data=data+'&hidden_id_empleado_0='+SelectionsRecord.data.id_empleado;
				    data=data+'&hidden_id_empleado_aprobacion_0='+SelectionsRecord.data.id_empleado_aprobacion;
				    data=data+'&tipo=preaprueba';				
				Ext.Ajax.request({url:direccion+"../../../control/vacacion/ActionAprobarSolicitudLicenciaDet.php",								
			    params:data,
			    success:finaliza_aprobacion,
			    method:'POST',
			    failure:ClaseMadre_conexionFailure,
			    timeout:100000});
			 }		 
		}
	   else{
		Ext.MessageBox.alert('Estado','Antes debe seleccionar un registro.')
	    }
	    ClaseMadre_clearSelections()
	}
	function btn_correccion(){
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			if(confirm("Est� seguro enviar a correcci�n la solicitud del funcionario "+SelectionsRecord.data.nombre_completo+"?")){
				 data='cantidad_ids=1&hidden_id_vacacion_0='+SelectionsRecord.data.id_vacacion;
				    data=data+'&hidden_id_tipo_horario_0='+SelectionsRecord.data.id_tipo_horario;
				    data=data+'&hidden_id_empleado_0='+SelectionsRecord.data.id_empleado;
				    data=data+'&hidden_id_empleado_aprobacion_0='+SelectionsRecord.data.id_empleado_aprobacion;
				    data=data+'&tipo=corrige_pre';
				Ext.Ajax.request({url:direccion+"../../../control/vacacion/ActionAprobarSolicitudLicenciaDet.php",
			    params:data,
			    success:finaliza_correccion,
			    method:'POST',
			    failure:ClaseMadre_conexionFailure,
			    timeout:100000});
			 }						
		}
	   else{
		Ext.MessageBox.alert('Estado','Antes debe seleccionar un registro.')
	    }
	    ClaseMadre_clearSelections()
	}
	function finaliza_aprobacion(){
		Ext.MessageBox.alert('Estado','La solicitud se preaprob� satisfactoriamente');	
		ClaseMadre_btnActualizar();		 
	}	
	
	function finaliza_correccion(){
		Ext.MessageBox.alert('Estado','La solicitud se envi� a corregir satisfactoriamente');		
		 ClaseMadre_btnActualizar();		 
	}
	
	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){
		return layout_preaprobar_solicitud_licencia.getLayout()
	};
	
	//para el manejo de hijos
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
	
	//-------------- FIN DEFINICI�N DE FUNCIONES PROPIAS --------------//
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	this.InitFunciones(paramFunciones);
	//para agregar botones
	this.AdicionarBoton('../../../lib/imagenes/ok.png','Preaprobar Solicitud',btn_aprobar,true,'aprobar_solicitud','Preaprobaci�n');
	this.AdicionarBoton('../../../lib/imagenes/det.ico','Solicitar Correcci�n',btn_correccion,true,'pedir_correccion','Correcci�n');
	this.iniciaFormulario();
	iniciarEventosFormularios();
	layout_preaprobar_solicitud_licencia.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario)
}