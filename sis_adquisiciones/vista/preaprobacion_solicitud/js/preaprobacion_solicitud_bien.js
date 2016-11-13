/**
 * Nombre:		  	    pagina_preaprobacion_solicitud.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-05-15 19:39:24fobservacioens
 */
function pagina_preaprobacion_solicitud_bien(idContenedor,direccion,paramConfig,id_empleado){
	var Atributos=new Array,sw=0;
	var observaciones='';
	var data='';
	//---DATA STORE
	var ds = new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/seguimiento_solicitud/ActionListarSeguimientoSolicitud.php'}),
		reader: new Ext.data.XmlReader({
		record: 'ROWS',id:'id_solicitud_compra',totalRecords:'TotalCount'
		},[		
				'id_solicitud_compra',
		'justificacion',
		'localidad',
		'siguiente_estado',
		'tipo_adjudicacion',
		'id_tipo_categoria_adq',
		'desc_tipo_categoria_adq',
		'id_empleado_frppa_solicitante',
		'desc_empleado_tpm_frppa',
		'id_moneda',
		'desc_moneda',
		'id_rpa',
		'desc_rpa',
		'id_cuenta',
		'desc_cuenta',
		'id_unidad_organizacional',
		'desc_unidad_organizacional',
		'reformulacion',
		'dias_max',
		'dias_min',
		'dias',
		'id_financiador',
		'id_regional',
		'id_programa',
		'id_proyecto',
		'id_actividad',
		'nombre_financiador',
		'nombre_regional',
		'nombre_programa',
		'nombre_proyecto',
		'nombre_actividad',
		'codigo_financiador',
		'codigo_regional',
		'codigo_programa',
		'codigo_proyecto',
		'codigo_actividad',
		'tipo_adq',
		'num_solicitud',
		'estado',
		'numeracion_periodo',
		'gestion',
		{name: 'fecha_sol',type:'date',dateFormat:'Y-m-d'},
		'preaprobador',
		'tiene_presupuesto',
		'aprobador','tiene_suplente','suplente','transcriptor','nro_solicitud_cadena'
		]),remoteSort:true});

	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros,
			filtro:"SEGSOL.siguiente_estado like 'pre_aprobado' and SEGSOL.estado_vigente_solicitud not like 'borrador'",
			vista:'preaprobacion',
			bien:'1'
		}
	});
	//DATA STORE COMBOS

	/////////////////////////
	// Definici�n de datos //
	/////////////////////////
	function negrita(val,cell,record,row,colum,store){
			
			
			if(record.get('tiene_presupuesto')=='0'){
					return '<b>' + val + '</b>';
			}
			else
			{
				return val;
			}
		}
		
	// hidden id_solicitud_compra
	//en la posici�n 0 siempre esta la llave primaria

	Atributos[0]={
		validacion:{
			labelSeparator:'',
			name: 'id_solicitud_compra',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		save_as:'id_solicitud_compra'
	};

   
	
	
	
// txt id_empleado_frppa_solicitante
	Atributos[3]={
			validacion:{
			name:'desc_empleado_tpm_frppa',
			fieldLabel:'Solicitante',
			grid_visible:true,
			renderer:negrita,
			width_grid:120,
			grid_indice:2
				
		},
		tipo: 'Field',
		form: false,
		filtro_0:true,
		filterColValue:'EMPLEP_6.apellido_paterno#EMPLEP_6.apellido_materno#EMPLEP_6.nombre'
	};
	
	// txt id_unidad_organizacional
	Atributos[2]={
			validacion:{
			name:'desc_unidad_organizacional',
			fieldLabel:'Unidad Organizacional',
			grid_visible:true,
			width_grid:120,
			grid_indice:7	
		},
		tipo:'Field',
		form: false,
		filtro_0:true,
		filtro_1:true,
		filterColValue:'UNIORG.nombre_unidad'
	};
	
	
		// txt num_solicitud
	Atributos[1]={
		validacion:{
			name:'nro_solicitud_cadena',
			fieldLabel:'Per�odo/N� Sol.',
			align:'right',
			grid_visible:true,
			width_grid:90,
			grid_indice:1,
			renderer:negrita
		},
		tipo: 'Field',
		form: false,
		filtro_0:true,
		filtro_1:true,
		filterColValue:'SEGSOL.nro_solicitud_cadena'

	};
	Atributos[4]={
		validacion:{
			labelSeparator:'',
			fieldLabel:'Adquisicion',
			name: 'tipo_adq',
			inputType:'hidden',
			grid_visible:false
			
		},
		tipo: 'Field',
		filtro_0:true,
		form:false
	};
	
	
// txt id_tipo_categoria_adq
	Atributos[5]={
			validacion:{
			name:'desc_tipo_categoria_adq',
			fieldLabel:'Categoria',
			grid_visible:true,
			width_grid:120,
			grid_indice:3,
			renderer:negrita	
		},
		tipo:'Field',
		form: false,
		filtro_0:true,
		filtro_1:true,
		filterColValue:'TIPCAT.nombre'
	};

// txt id_rpa
	Atributos[6]={
			validacion:{
			name:'gestion',
			fieldLabel:'Gesti�n',
			grid_visible:true,
			width_grid:100,
			width:'80%',
			grid_indice:10	
		},
		tipo:'Field',
		form: false,
		filtro_0:true,
		filtro_1:true,
		filterColValue:'SEGSOL.gestion'
	};


	
	// txt localidad
	Atributos[7]={
		validacion:{
			name:'estado',
			fieldLabel:'Estado',
			grid_visible:true,
			width_grid:100,
			width:'45%',
			grid_indice:9		
		},
		tipo: 'Field',
		form: false,
		filtro_0:true,
		filtro_1:true,
		filterColValue:'ESTCOM.nombre'
	};
	
	// txt estado_vigente_solicitud
	Atributos[8]={
		validacion:{
			name:'aprobador',
			fieldLabel:'Encargado Aprobaci�n',
			grid_visible:false,
			width_grid:130,
			grid_indice:12		
		},
		tipo: 'Field',
		form: false,
		filtro_0:true,
		filtro_1:true,
		filterColValue:'APRO.nombre_completo'
	};
	
	
	// txt id_moneda
	Atributos[9]={
			validacion:{
			name:'desc_moneda',
			fieldLabel:'Moneda',
			grid_visible:true,
			width_grid:120,
			grid_indice:6		
		},
		tipo:'Field',
		form: false,
		filtro_0:true,
		filtro_1:true,
		filterColValue:'MONEDA.nombre'
	};
	
	Atributos[10]={
		validacion:{
			fieldLabel:'Estructura Programatica',
			allowBlank:false,
			emptyText:'Estructura Program�tica',
			name:'id_fina_regi_prog_proy_acti',
			minChars:1,
			triggerAction:'all',
			editable:false,
			grid_visible:true,
			grid_editable:false,
			grid_indice:8,		
			width:300
			},
			tipo:'epField',
			save_as:'id_ep'
		};
	
		
	// txt localidad
	Atributos[11]={
		validacion:{
			name:'fecha_sol',
			fieldLabel:'Fecha',
			grid_visible:true,
			renderer: formatDate,
			width_grid:80,
			grid_indice:5
			
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'SEGSOL.fecha_reg'
	};
	
	
	// txt observaciones
	Atributos[12]={
		validacion:{
			name:'justificacion',
			fieldLabel:'Justificaci�n',
			grid_visible:true,
			width_grid:100,
			grid_indice:4		
		},
		tipo: 'Field',
		form: false,
		filtro_0:true,
		filtro_1:true,
		filterColValue:'SEGSOL.observaciones'
	};
	
	
	 Atributos[13]={
		validacion:{
			name:'preaprobador',
			fieldLabel:'Encargado Preaprobaci�n',
			grid_visible:false,
			width_grid:130,
			grid_indice:11
		},
		tipo: 'NumberField',
		form: false,
		filtro_0:true,
		filterColValue:'PREA.nombre_completo'
	};
	

// txt id_fina_regi_prog_proy_acti
	
	
		Atributos[14]={
			validacion:{
				name:'suplente',
				fieldLabel:'Empleado Suplente',
				grid_visible:true,
				width_grid:100
			},
			tipo: 'Field',
			form: false,
			filtro_0:false,
			filtro_1:false
		};
	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	function formatDate(value){
		return value ? value.dateFormat('d/m/Y') : '';
	};

	//---------- INICIAMOS LAYOUT DETALLE
	var config={titulo_maestro:'preaprobacion_solicitud',grid_maestro:'grid-'+idContenedor,urlHijo:'../../../sis_adquisiciones/vista/detalle_solicitud_bien/detalle_seguimiento_solicitud_bien_det.php?refo=0'};
	var layout_preaprobacion_solicitud_bien=new DocsLayoutMaestroDeatalle(idContenedor);
	layout_preaprobacion_solicitud_bien.init(config);

	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////

	
	this.pagina=Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,Atributos,ds,layout_preaprobacion_solicitud_bien,idContenedor);
	var getComponente=this.getComponente;
	var getSelectionModel=this.getSelectionModel;
	var CM_saveSuccess=this.saveSuccess;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_btnEdit=this.btnEdit;
	var ClaseMadre_btnActualizar=this.btnActualizar;
	var CM_enableSelect=this.EnableSelect;

	///////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	///////////////////////////////////

	var paramMenu={
		actualizar:{crear:true,separador:false}
	};


	//////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////
	
	//datos necesarios para el filtro
	var paramFunciones={
		btnEliminar:{url:direccion+'../../../control/seguimiento_solicitud/ActionEliminarSeguimientoSolicitud.php'},
		Save:{url:direccion+'../../../control/seguimiento_solicitud/ActionGuardarSeguimientoSolicitud.php?vista=preaprobacion'},
		ConfirmSave:{url:direccion+'../../../control/seguimiento_solicitud/ActionGuardarSeguimientoSolicitud.php?vista=preaprobacion'},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,height:200,columnas:['90%'],
			grupos:[{tituloGrupo:'Datos',columna:0,id_grupo:0},
					{tituloGrupo:'Estructura Programatica',columna:0,id_grupo:0},
					{tituloGrupo:'Observaciones',columna:0,id_grupo:2},
					{tituloGrupo:'Designacion de Suplente',columna:0,id_grupo:3}
			],width:'50%',minWidth:150,minHeight:100,	closable:true,titulo:'preaprobacion_solicitud'}};
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	
	function btn_anular_solicitud(){
		data='';
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			   data='cantidad_ids=1&hidden_id_solicitud_compra_0='+SelectionsRecord.data.id_solicitud_compra;
			     Ext.MessageBox.show({
                    title: 'Observaciones de Anulaci�n',
                    msg: 'Ingrese observaciones de anulaci�n:',
                    width:300,
                    buttons: Ext.MessageBox.OK,
                    multiline: true,
                    fn: getObservaciones1
                 });
		}
		else{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		} 
	}
	function getObservaciones1(btn,text){
		if(btn!='cancel'){
		observaciones=text;
		data=data+'&observaciones_0='+observaciones;
		
			Ext.Ajax.request({
			url:direccion+"../../../control/seguimiento_solicitud/ActionAnularSolicitud.php?"+data,
			method:'GET',
			success:esteSuccess,
			failure:ClaseMadre_conexionFailure,
			timeout:100000000
		});}		
		
		
	}
	
	function esteSuccess(resp){
		if(resp.responseXML&&resp.responseXML.documentElement){
			ClaseMadre_btnActualizar();
		}
		else{
			ClaseMadre_conexionFailure();
		}
	}
	
	//Para manejo de eventos
	function iniciarEventosFormularios(){
	
	   getSelectionModel().on('rowdeselect',function(){
					if(_CP.getPagina(layout_preaprobacion_solicitud_bien.getIdContentHijo()).pagina.limpiarStore()){
						_CP.getPagina(layout_preaprobacion_solicitud_bien.getIdContentHijo()).pagina.bloquearMenu()
					}
				})
	   
	}

	this.EnableSelect=function(x,z,y){
		CM_enableSelect(x,z,y);
		_CP.getPagina(layout_preaprobacion_solicitud_bien.getIdContentHijo()).pagina.reload(y.data);
		_CP.getPagina(layout_preaprobacion_solicitud_bien.getIdContentHijo()).pagina.desbloquearMenu();
	}	
	
	
	function btn_cancelar(){
		data='';
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			Ext.MessageBox.show({
           title: 'Observaciones',
           msg: 'Ingrese observaciones a la solicitud:',
           width:300,
           buttons: Ext.MessageBox.OK,
           multiline: true,
           fn: getObservaciones
           
       });
			data='id_solicitud_compra='+SelectionsRecord.data.id_solicitud_compra;
			data=data+'&operacion=cancelar';
			data=data+'&vista=preaprobacion';
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		} 
	}
	
	
	
	function btn_aprobar(){
		data='';
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			if(parseFloat(SelectionsRecord.data.tiene_presupuesto)>0){
			  
			        Ext.MessageBox.show({
                    title: 'Observaciones de Pre-Aprobaci�n',
                    msg: 'Ingrese observaciones para pre-aprobacion:',
                    width:300,
                    buttons: Ext.MessageBox.OK,
                    multiline: true,
                    allowBlank:false,
                    fn: getObservaciones
                    });

                    data='id_solicitud_compra='+SelectionsRecord.data.id_solicitud_compra;
			        data=data+'&operacion=preaprobar';
			        data=data+'&vista=preaprobacion';
			
			}else{
			    if(confirm('No tiene suficiente presupuesto para esta solicitud, desea continuar?')){
			     Ext.MessageBox.show({
                    title: 'Observaciones de Pre-Aprobaci�n',
                    msg: 'Ingrese observaciones para pre-aprobacion:',
                    width:300,
                    buttons: Ext.MessageBox.OK,
                    multiline: true,
                    allowBlank:false,
                    fn: getObservaciones
                    });

                    data='id_solicitud_compra='+SelectionsRecord.data.id_solicitud_compra;
			        data=data+'&operacion=preaprobar';
			        data=data+'&vista=preaprobacion';
			    }
			}
			
		}
		else{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		} 
	}
	
	function btn_correccion(){
		data='';
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			Ext.MessageBox.show({
           title: 'Observaciones de Correcci�n',
           msg: 'Ingrese observaciones para correcci�n:',
           width:300,
           buttons: Ext.MessageBox.OK,
           multiline: true,
           fn: getObservaciones
           
       });
			data='id_solicitud_compra='+SelectionsRecord.data.id_solicitud_compra;
			data=data+'&operacion=correccion';
			data=data+'&vista=preaprobacion';
			
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		} 
	}
	
	
	function getObservaciones(btn,text){
		if(btn!='cancel'){
		observaciones=text;
		data=data+'&observaciones='+observaciones;
		data=data+"&filtro=ESTCOM.nombre like 'pendiente_pre_aprobacion'";
		data=data+'&vista=preaprobacion';
			Ext.Ajax.request({
			url:direccion+"../../../control/seguimiento_solicitud/ActionGuardarSeguimientoSolicitud.php?"+data,
			method:'GET',
			success:esteSuccess,
			failure:ClaseMadre_conexionFailure,
			timeout:100000000
		});}		
	}
	function esteSuccess(resp){
		if(resp.responseXML&&resp.responseXML.documentElement){
			ClaseMadre_btnActualizar();
		}
		else{
			ClaseMadre_conexionFailure();
		}
	}
	function btn_verificar(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		if(NumSelect!=0){
						
			var SelectionsRecord=sm.getSelected();
			
			var data='m_id_solicitud_compra='+SelectionsRecord.data.id_solicitud_compra;
							
			window.open(direccion+'../../../control/solicitud_compra/reporte/ActionPDFSolicitudVerNuevo.php?'+data)	
			
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		}
	}
	
	/* A�adido por: Ana Maria Villegas Quispe
	   Fecha: 01/03/2011
	
	*/
	function btn_historial_rep(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		if(NumSelect!=0){
						
			var SelectionsRecord=sm.getSelected();
			var data='id_solicitud_compra='+SelectionsRecord.data.id_solicitud_compra;
			window.open(direccion+'../../../control/estado_proceso/reporte/ActionPDFHistorial.php?'+data)	
			
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		}
	}
	//fin AVQ
	
	function btn_suplente(){
		var data='id_empleado='+id_empleado+'&subsis=COMPRO&vista=pre';
		var ParamVentana={Ventana:{width:450,height:200}};
		layout_preaprobacion_solicitud_bien.loadWindows(direccion+'../../../../sis_adquisiciones/vista/suplente/suplente.php?'+data,'Suplente',ParamVentana)
	}
	

	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_preaprobacion_solicitud_bien.getLayout()};
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	this.InitFunciones(paramFunciones);
	//para agregar botones
	
	//this.AdicionarBoton('../../../lib/imagenes/detalle.png','Detalle Solicitud',btn_solicitud_compra_det,true,'solicitud_compra_det','Detalle');
	
	this.AdicionarBoton('../../../lib/imagenes/ok.png','Preaprobar',btn_aprobar,true,'preaprobacion','Pre-aprobacion');
	this.AdicionarBoton('../../../lib/imagenes/det.ico','Solicitar Correcci�n',btn_correccion,true,'pedir_correccion','Correcci�n');
    this.AdicionarBoton('../../../lib/imagenes/cancel.png','Anular Solicitud',btn_anular_solicitud,true,'anular_solicitud','Anulaci�n');			
	this.AdicionarBoton('../../../lib/imagenes/print.gif','Vista Previa Solicitud',btn_verificar,true,'ver_preprb','Verificar');
	this.AdicionarBoton('../../../lib/imagenes/user.png','Suplente',btn_suplente,true,'suplente','Designar Suplente');
    this.AdicionarBoton('../../../lib/imagenes/print.gif','Historial Reporte',btn_historial_rep,true,'historial_reporte','Historial'); //a�adido avq
    
		
	this.iniciaFormulario();
	iniciarEventosFormularios();

	layout_preaprobacion_solicitud_bien.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}