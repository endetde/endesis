/**
* Nombre:		  	    pagina_orden_ingreso_aprob.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
* Fecha creaci�n:		2007-10-17 12:31:23
*/
function pagina_ingreso_pend(idContenedor,direccion,paramConfig)
{
	var vectorAtributos=new Array;
	var ds;
	var elementos=new Array();
	var sw=0;
	var dlgAnular;
	var v_obs;
	var cont=0;

	/////////////////
	//  DATA STORE //
	/////////////////
	ds = new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/ingreso/ActionListarIngresoPend.php'}),
		// aqui se define la estructura del XML
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_ingreso',
			totalRecords: 'TotalCount'
		}, [
		// define el mapeo de XML a las etiquetas (campos)
		'id_ingreso',
		'descripcion',
		'costo_total',
		'contabilizar',
		'estado_ingreso',
		'cod_inf_tec',
		'resumen_inf_tec',
		{name: 'fecha_borrador',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_pendiente',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_aprobado_rechazado',type:'date',dateFormat:'Y-m-d'},
		'id_proveedor',
		'desc_proveedor',
		'id_contratista',
		'desc_contratista',
		'id_empleado',
		'desc_empleado',
		'id_almacen_logico',
		'desc_almacen_logico',
		'id_firma_autorizada',
		'desc_firma_autorizada',
		'id_institucion',
		'desc_institucion',
		'id_motivo_ingreso_cuenta',
		'desc_motivo_ingreso_cuenta',
		'nombre_proveedor',
		'nombre_contratista',
		'nro_cuenta',
		'desc_motivo_ingreso',
		'desc_almacen',
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
		'orden_compra',
		'observaciones',
		'id_usuario'
		]),remoteSort:true
	});

	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros
		}
	});

	/////////////////////////
	// Definici�n de datos //
	/////////////////////////

	vectorAtributos[0] = {
		validacion:{
			labelSeparator:'',
			name: 'id_ingreso',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false,
			grid_indice:0
		},
		form:true,
		tipo: 'Field',
		filtro_0:false,
		save_as:'hidden_id_ingreso'
	};

	vectorAtributos[1]= {
		validacion: {
			name:'desc_almacen',
			fieldLabel:'Almac�n F�sico',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			grid_indice:1
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filterColValue:'ALMACE.nombre',
		save_as:'txt_id_almacen'
	};

	vectorAtributos[2]= {
		validacion: {
			name:'desc_almacen_logico',
			fieldLabel:'Almac�n L�gico',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			grid_indice:2
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filterColValue:'ALMLOG.nombre',
		save_as:'txt_id_almacen_logico'
	};

	vectorAtributos[3]= {
		validacion:{
			name:'fecha_pendiente',
			fieldLabel:'Fecha pendiente',
			grid_visible:true,
			grid_editable:false,
			renderer: formatDate,
			width_grid:85,
			grid_indice:19
		},
		form:false,
		tipo:'Field',
		filtro_0:false,
		filterColValue:'INGRES.fecha_pendiente',
		save_as:'txt_fecha_pendiente'
	};

	vectorAtributos[4]= {
		validacion:{
			name:'descripcion',
			fieldLabel:'Descripci�n',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			grid_indice:4
		},
		form:false,
		tipo: 'Field',
		filtro_0:false,
		filterColValue:'INGRES.descripcion',
		save_as:'txt_descripcion'
	};

	vectorAtributos[5]= {
		validacion: {
			name:'desc_motivo_ingreso',
			fieldLabel:'Motivo ingreso',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			grid_indice:5
		},
		form:false,
		tipo:'Field',
		filtro_0:false,
		filterColValue:'MOTING.nombre',
		save_as:'txt_id_motivo_ingreso'
	};

	vectorAtributos[6]= {
		validacion: {
			name:'desc_motivo_ingreso_cuenta',
			fieldLabel:'Cuenta',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			grid_indice:6
		},
		form:false,
		tipo:'Field',
		filtro_0:false,
		filterColValue:'MOTING.nombre',
		save_as:'txt_id_motivo_ingreso'
	};

	vectorAtributos[7]= {
		validacion:{
			name:'orden_compra',
			fieldLabel:'Orden de Compra',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			grid_indice:7
		},
		form:false,
		tipo: 'Field',
		filtro_0:true,
		filterColValue:'INGRES.orden_compra',
		save_as:'txt_orden_compra'
	};

	vectorAtributos[8]= {
		validacion: {
			name:'desc_empleado',
			fieldLabel:'Empleado',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			grid_indice:8
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filterColValue:'EMPLEA.id_persona#PERSON1.nombre#PERSON1.apellido_paterno#PERSON1.apellido_materno',
		save_as:'txt_id_empleado'
	};

	vectorAtributos[9]= {
		validacion: {
			name:'desc_institucion',
			fieldLabel:'Instituci�n',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			grid_indice:9
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filterColValue:'INSTIT.nombre',
		save_as:'txt_id_institucion'
	};

	vectorAtributos[10]= {
		validacion: {
			name:'desc_proveedor',
			fieldLabel:'Proveedor',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			grid_indice:10
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filterColValue:'PROVEE.codigo',
		save_as:'txt_id_proveedor'
	};

	vectorAtributos[11]= {
		validacion: {
			name:'desc_contratista',
			fieldLabel:'Contratista',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			grid_indice:11
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filterColValue:'CONTRA.codigo',
		save_as:'txt_id_contratista'
	};

	vectorAtributos[12]= {
		validacion:{
			name:'costo_total',
			fieldLabel:'Costo total',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			grid_indice:12
		},
		form:false,
		tipo: 'Field',
		filtro_0:true,
		filterColValue:'INGRES.costo_total',
		save_as:'txt_costo_total'
	};

	vectorAtributos[13]= {
		validacion:{
			name:'observaciones',
			fieldLabel:'Observaciones',
			allowBlank:false,
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			grid_indice:13,
			width:'95%'
		},
		tipo: 'Field',
		filtro_0:false,
		filterColValue:'INGRES.observaciones',
		save_as:'txt_observaciones'
	};

	vectorAtributos[14]= {
		validacion: {
			name:'desc_firma_autorizada',
			fieldLabel:'Firma Autorizada',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			grid_indice:14
		},
		form:false,
		tipo:'Field',
		filtro_0:true,
		filterColValue:'FIRAUT.descripcion#PERSON.nombre#PERSON.apellido_paterno#PERSON.apellido_materno',
		save_as:'txt_id_firma_autorizada'
	};

	vectorAtributos[15]= {
		validacion: {
			name:'contabilizar',
			fieldLabel:'Contabilizar',
			grid_visible:true,
			grid_editable:false,
			width_grid:60,
			grid_indice:15
		},
		form:false,
		tipo:'Field',
		filtro_0:false,
		filterColValue:'INGRES.contabilizar',
		save_as:'txt_contabilizar'
	};

	vectorAtributos[16]= {
		validacion:{
			name:'cod_inf_tec',
			fieldLabel:'C�digo Informe T�cnico',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			grid_indice:16
		},
		form:false,
		tipo: 'Field',
		filtro_0:true,
		filterColValue:'INGRES.cod_inf_tec',
		save_as:'txt_cod_inf_tec'
	};

	vectorAtributos[17]= {
		validacion:{
			name:'resumen_inf_tec',
			fieldLabel:'Resumen Inf T�cnico',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			grid_indice:17
		},
		form:false,
		tipo: 'Field',
		filtro_0:false,
		filterColValue:'INGRES.resumen_inf_tec',
		save_as:'txt_resumen_inf_tec'
	};

	vectorAtributos[18]= {
		validacion:{
			name:'fecha_borrador',
			fieldLabel:'Fecha Borrador',
			grid_visible:true,
			renderer: formatDate,
			grid_editable:false,
			width_grid:100,
			grid_indice:18
		},
		form:false,
		tipo: 'Field',
		filtro_0:false,
		filterColValue:'INGRES.fecha_borrador',
		save_as:'txt_fecha_borrador'
	};

	vectorAtributos[19]= {
		validacion:{
			name: 'nombre_financiador',
			fieldLabel: 'Financiador',
			grid_visible:true,
			grid_editable:false,
			width_grid:150,
			grid_indice:20
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_nombre_financiador'
	}
	vectorAtributos[20]= {
		validacion:{
			name: 'nombre_regional',
			fieldLabel: 'Regional',
			grid_visible:true,
			grid_editable:false,
			width_grid:150,
			grid_indice:21
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_nombre_regional'
	}

	vectorAtributos[21]= {
		validacion:{
			name: 'nombre_programa',
			fieldLabel: 'Programa',
			grid_visible:true,
			grid_editable:false,
			width_grid:150,
			grid_indice:22
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_nombre_programa'
	}

	vectorAtributos[22]= {
		validacion:{
			name: 'nombre_proyecto',
			fieldLabel: 'Proyecto',
			grid_visible:true,
			grid_editable:false,
			width_grid:150,
			grid_indice:23
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_nombre_proyecto'
	}

	vectorAtributos[23]= {
		validacion:{
			name: 'nombre_actividad',
			fieldLabel: 'Actividad',
			grid_visible:true,
			grid_editable:false,
			width_grid:150,
			grid_indice:24
		},
		form:false,
		tipo: 'Field',
		save_as:'txt_nombre_actividad'
	}

	// txt fecha_aprobado_rechazado
	vectorAtributos[24]= {
		validacion:{
			name:'fecha_aprobado_rechazado',
			fieldLabel:'Fecha Aprobaci�n',
			grid_visible:true,
			renderer: formatDate,
			grid_editable:false,
			width_grid:100,
			grid_indice:3
		},
		form:false,
		tipo: 'Field',
		filtro_0:false,
		filterColValue:'INGRES.fecha_aprobado_rechazado',
		save_as:'txt_fecha_aprobado_rechazado'
	};


	vectorAtributos[25]={
		validacion:{
			name:'desc_almacen_logico',
			fieldLabel:'Desc Almacen Logico',
			allowBlank:false,
			maxLength:200,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:false,
			grid_editable:true,
			grid_indice:10,
			align:'center',
			width_grid:100
		},
		tipo:'Field',
		save_as:'txt_desc_almacen_logico',
		id_grupo:0
	};
	vectorAtributos[26]={
		validacion:{
			name:'desc_almacen',
			fieldLabel:'Desc Almacen',
			allowBlank:false,
			maxLength:200,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:false,
			grid_editable:true,
			grid_indice:10,
			align:'center',
			width_grid:100
		},
		tipo:'Field',
		save_as:'txt_desc_almacen',
		id_grupo:0
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
	var config = {
		titulo_maestro:'Aprobaci�n de Orden de Ingreso',
		grid_maestro:'grid-'+idContenedor
	};
	layout_orden_ingreso_aprob=new DocsLayoutMaestro(idContenedor);
	layout_orden_ingreso_aprob.init(config);

	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////

	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina = Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,ds,layout_orden_ingreso_aprob,idContenedor);
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
	var getSelectionModel=this.getSelectionModel;
	var ClaseMadre_getComponente=this.getComponente;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_btnNew=this.btnNew;
	var ClaseMadre_btnEdit=this.btnEdit;
	var ClaseMadre_onResize=this.onResize;

	var ClaseMadre_btnActualizar = this.btnActualizar;

	///////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	///////////////////////////////////

	var paramMenu={
		//guardar:{crear:true,separador:false},
		//editar:{crear:true,separador:false},
		actualizar:{crear:true,separador:false}
	};


	//////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////

	//datos necesarios para el filtro
	var paramFunciones = {
		btnEliminar:{url:direccion+'../../../control/ingreso/ActionEliminarIngreso.php'},
		//Save:{url:direccion+'../../../control/ingreso/ActionGuardarOrdenIngresoAprob.php'},
		Save:{url:direccion+'../../../control/ingreso/ActionAnularIngreso.php'},
		ConfirmSave:{url:direccion+'../../../control/ingreso/ActionGuardarOrdenIngresoAprob.php'},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,height:'30%',
		columnas:['97%'],grupos:[{tituloGrupo:'Almac�n',columna:0,id_grupo:0}],width:'40%',
		minWidth:150,minHeight:200,	closable:true,titulo:'Aprobaci�n de Orden Ingreso'}
	};

	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	function btn_ingreso_pend_det(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();

		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			var data='m_id_ingreso='+SelectionsRecord.data.id_ingreso;
			data=data+'&m_almacen_fisico='+SelectionsRecord.data.desc_almacen;
			data=data+'&m_almacen_logico='+SelectionsRecord.data.desc_almacen_logico;
			data=data+'&m_descripcion='+SelectionsRecord.data.descripcion;

			var ParamVentana={Ventana:{width:'70%',height:'60%'}}
			layout_orden_ingreso_aprob.loadWindows(direccion+'../../../vista/orden_ingreso_aprob_det/orden_ingreso_aprob_det.php?'+data,'Detalle Orden Ingreso',ParamVentana);
			layout_orden_ingreso_aprob.getVentana().on('resize',function(){
				layout_orden_ingreso_aprob.getLayout().layout();
			})
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		}
	}

	function btn_confirm_ing()
	{
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();

		if(NumSelect!=0)
		{
			if(confirm("�Est� seguro de Confirmar el Ingreso?"))
			{
				var SelectionsRecord=sm.getSelected();
				var data=SelectionsRecord.data.id_ingreso
				Ext.Ajax.request({
					url:direccion+"../../../control/ingreso/ActionConfirmarIngresoPend.php?hidden_id_ingreso_0="+data,
					method:'GET',
					success:confirm_terminado,
					failure:ClaseMadre_conexionFailure,
					timeout:100000//TIEMPO DE ESPERA PARA DAR FALLO
				});
			}
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		}
	}

	function confirm_terminado(resp)
	{
		Ext.MessageBox.hide();
		Ext.MessageBox.alert('Estado', '<br>Confirmaci�n existosa.<br>');
		ClaseMadre_btnActualizar();
	}

	function btn_anular()
	{
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();

		if(NumSelect!=0)
		{
			if(confirm("�Est� seguro de Anular el Ingreso?"))
			{
				var SelectionsRecord=sm.getSelected();
				var data='hidden_id_ingreso_0='+SelectionsRecord.data.id_ingreso;
				data=data+'&txt_observaciones_0='+v_obs;
				Ext.Ajax.request({
					url:direccion+"../../../control/ingreso/ActionAnularIngreso.php?"+data,
					method:'GET',
					success:confirm_anulado,
					failure:ClaseMadre_conexionFailure,
					timeout:100000//TIEMPO DE ESPERA PARA DAR FALLO
				});
				dlgAnular.hide()
			}
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
		}
	}

	function btn_frm_anular()
	{
		var sm=getSelectionModel();
		var NumSelect=sm.getCount();
		if(NumSelect!=0)
		{
			if(cont==0)
			{
				var marcas="<div class='x-dlg-hd'>Anular Ingreso</div>";
				var otro = 'id_anul_'+idContenedor;
				var div_dlgAnular=Ext.DomHelper.append(document.body,{tag:'div',id:otro,html:marcas});

				var div_center=Ext.DomHelper.append(otro,{tag:'div',id:'centro'+idContenedor,class:'x-dlg-bd'});
				dlgAnular = new Ext.LayoutDialog(div_dlgAnular, {
					fittoframe:true,
					modal: true,
					autoTabs: true,
					resizable:false,
					width: 540,
					height: 200,
					shadow: false,
					fixedCenter:true,
					constraIntoviewport: true,
					draggable: true,
					proxyDrag: true,
					closable: true,
					center: {
						split: false,
						titlebar: false,
						autoScroll: true
					}

				});
				ext_formFil=Ext.DomHelper.append(document.body,{tag:'div',html:"<div align='center' class='x-dlg-bd'><br><div id='extformFil-"+config.nombre+"'></div></div>"});

				txt_obs=new Ext.form.TextArea({
					fieldLabel: 'Motivo Anulaci�n',
					allowBlank: false,
					name: 'observaciones',
					maxLength:300,
					width:'95%'
				});
				var layout = dlgAnular.getLayout();
				layout.beginUpdate();
				layout.add('center', new Ext.ContentPanel(ext_formFil));

				var formFil=new Ext.form.Form({labelWidth:90});
				formFil.add(txt_obs);
				formFil.render('extformFil-'+config.nombre);

				dlgAnular.addKeyListener(27, dlgAnular.hide, dlgAnular); // ESC can also close the dialog
				dlgAnular.addButton('Aceptar', obtener_motivo, dlgAnular);
				dlgAnular.addButton('Cancelar', dlgAnular.hide, dlgAnular);

				layout.endUpdate();
				cont=1;
				dlgAnular.show()
			}
			else
			{
				dlgAnular.show()
			}
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		}

		function obtener_motivo()
		{
			if(txt_obs.isValid())
			{
				v_obs=txt_obs.getValue();
				btn_anular()
			}
		}
	}

	function confirm_anulado(resp)
	{
		Ext.MessageBox.hide();
		Ext.MessageBox.alert('Estado', '<br>Anulaci�n realizada.<br>');
		ClaseMadre_btnActualizar()
	}

	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){
		return layout_orden_ingreso_aprob.getLayout();
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
	this.getElementos=function(){return elementos;};
	this.setPagina=function(elemento){elementos.push(elemento)};

	//-------------- FIN DEFINICI�N DE FUNCIONES PROPIAS --------------//
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	this.InitFunciones(paramFunciones);
	//para agregar botones

	this.AdicionarBoton('../../../lib/imagenes/detalle.png','Detalle del Ingreso',btn_ingreso_pend_det,true,'ingreso_pend_det','');
	this.AdicionarBoton('../../../lib/imagenes/ok.png','Confirmar el Ingreso',btn_confirm_ing,true,'Confirmar Ingreso','');
	this.AdicionarBoton('../../../lib/imagenes/cancel.png','Anular el Ingreso',btn_frm_anular,false,'Anular Ingreso','');

	this.iniciaFormulario();
	layout_orden_ingreso_aprob.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}