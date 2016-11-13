/**
 * Nombre: aprobacion_solicitud.js Autor: Ruddy Ljan Bravo Fecha creaci�n:
 * 25-09-2013
 */

function PaginaAprobacionSolicitud(idContenedor, direccion, paramConfig) {
	var sm;
	var vectorAtributos = new Array();
	var ds;
	var layout_aprobacion_solicitud;

	// DATA STORE //
	ds = new Ext.data.Store(
			{
				proxy : new Ext.data.HttpProxy(
						{
							url : direccion+ '../../../control/solicitud_salida/ActionListarSolicitudSalida.php'
						}),
				reader : new Ext.data.XmlReader({
					record : 'ROWS',
					id : 'id_solicitud_salida',
					totalRecords : 'TotalCount'
				}, [ 'id_solicitud_salida', 'id_almacen',
						'id_unidad_organizacional', 'uo_empleado',
						'id_empleado', 'nombre_empleado', 'cargo_empleado',
						'id_aprobador', 'uo_aprobador', 'nombre_aprobador',
						'cargo_empleado', 'id_aprobador', 'uo_aprobador',
						'nombre_aprobador', 'descripcion', 'estado',
						'usuario_reg', 'usuario_mod', {
							name : 'fecha_mod',
							type : 'date',
							dateFormat : 'd-m-Y h:i:s a'
						}, {
							name : 'fecha_reg',
							type : 'date',
							dateFormat : 'd-m-Y h:i:s a'
						}, {
							name : 'fecha_solicitud',
							type : 'date',
							dateFormat : 'd-m-Y h:i:s a'
						} ]),
				remoteSort : true
			});

	// Carga los datos en el DataStore.
	ds.load({
		params : {
			start : 0,
			limit : paramConfig.TamanoPagina,
			CantFiltros : paramConfig.CantFiltros,
			nombreVista : "aprobacion_solicitud"
		}
	});

	// PAR�METROS DEL FORMULARIO Y EL GRID//
	vectorAtributos = [
			{
				validacion : {
					labelSeparator : '',
					name : 'id_solicitud_salida',
					inputType : 'hidden',
					grid_visible : false,
					grid_editable : false
				},
				tipo : 'Field',
				filtro_0 : false,
				form : true,
				save_as : 'hidden_id_solicitud_salida'
			},
			{
				validacion : {
					labelSeparator : '',
					name : 'id_almacen',
					inputType : 'hidden',
					grid_visible : false,
					grid_editable : false
				},
				defecto : 1,
				tipo : 'Field',
				filtro_0 : false,
				form : true,
				save_as : 'hidden_id_almacen'
			},
			{
				validacion : {
					name : 'id_unidad_organizacional',
					fieldLabel : 'Unidad Organizacional',
					allowBlank : false,
					emptyText : 'Unidad Organizacional...',
					desc : 'uo_empleado',
					store : new Ext.data.Store(
							{
								proxy : new Ext.data.HttpProxy(
										{
											url : direccion
													+ '../../../../sis_kardex_personal/control/unidad_organizacional/ActionListarUnidadOrganizacional.php'
										}),
								reader : new Ext.data.XmlReader({
									record : 'ROWS',
									id : 'id_documento',
									totalRecords : 'TotalCount'
								}, [ 'id_unidad_organizacional',
										'nombre_unidad' ])
							}),
					valueField : 'id_unidad_organizacional',
					displayField : 'nombre_unidad',
					queryParam : 'filterValue_0',
					filterCol : 'uniorg.nombre_unidad',
					typeAhead : false,
					forceSelection : true,
					mode : 'remote',
					queryDelay : 250,
					pageSize : 10,
					minListWidth : 450,
					width : 285,
					resizable : false,
					minChars : 2,
					triggerAction : 'all',
					grid_visible : false,
					grid_editable : false,
					width_grid : 200
				},
				tipo : 'ComboBox',
				form : true,
				save_as : 'hidden_id_unidad_organizacional'
			},
			{
				validacion : {
					name : 'uo_empleado',
					fieldLabel : 'Unidad Organizacional',
					align : 'left',
					grid_visible : true,
					grid_editable : false,
					width_grid : 280
				},
				tipo : 'TextField',
				filtro_0 : true,
				filterColValue : 'uo.nombre_unidad',
				form : false
			},
			{
				validacion : {
					name : 'id_empleado',
					fieldLabel : 'Empleado',
					allowBlank : false,
					emptyText : 'Empleado...',
					desc : 'nombre_empleado',
					store : new Ext.data.Store(
							{
								proxy : new Ext.data.HttpProxy(
										{
											url : direccion
													+ '../../../../sis_kardex_personal/control/empleado/ActionListarEmpleado.php'
										}),
								reader : new Ext.data.XmlReader({
									record : 'ROWS',
									id : 'id_empleado',
									totalRecords : 'TotalCount'
								}, [ 'id_empleado', 'desc_persona' ])
							}),
					valueField : 'id_empleado',
					displayField : 'desc_persona',
					queryParam : 'filterValue_0',
					filterCol : 'PERSON.nombre#PERSON.apellido_paterno#PERSON.apellido_materno',
					typeAhead : false,
					forceSelection : true,
					mode : 'remote',
					queryDelay : 250,
					pageSize : 10,
					minListWidth : 450,
					width : 285,
					resizable : false,
					minChars : 2,
					triggerAction : 'all',
					grid_visible : false,
					grid_editable : false,
					width_grid : 100
				},
				tipo : 'ComboBox',
				form : true,
				save_as : 'hidden_id_empleado'
			},
			{
				validacion : {
					name : 'nombre_empleado',
					fieldLabel : 'Solicitante',
					grid_visible : true,
					grid_editable : false,
					width_grid : 250
				},
				tipo : 'TextField',
				filtro_0 : true,
				filterColValue : 'peremp.nombre#peremp.apellido_paterno#peremp.apellido_materno',
				form : false
			},
			{
				validacion : {
					name : 'cargo_empleado',
					fieldLabel : 'Cargo Solicitante',
					grid_visible : true,
					grid_editable : false,
					width_grid : 200
				},
				tipo : 'TextField',
				filtro_0 : true,
				filterColValue : 'sol.cargo_empleado',
				form : false
			},
			{
				validacion : {
					name : 'id_aprobador',
					fieldLabel : 'Aprobador',
					allowBlank : false,
					emptyText : 'Aprobador...',
					desc : 'nombre_aprobador',
					store : new Ext.data.Store(
							{
								proxy : new Ext.data.HttpProxy(
										{
											url : direccion
													+ '../../../../sis_parametros/control/config_aprobador/ActionListarConfigAprobador.php'
										}),
								reader : new Ext.data.XmlReader({
									record : 'ROWS',
									id : 'id_config_aprobador',
									totalRecords : 'TotalCount'
								}, [ 'id_config_aprobador', 'id_empleado',
										'nombre_completo' ])
							}),
					valueField : 'id_config_aprobador',
					displayField : 'nombre_completo',
					queryParam : 'filterValue_0',
					filterCol : 'EMPLEA.nombre_completo',
					typeAhead : false,
					forceSelection : true,
					mode : 'remote',
					queryDelay : 250,
					pageSize : 10,
					minListWidth : 450,
					width : 285,
					resizable : false,
					minChars : 2,
					triggerAction : 'all',
					grid_visible : false,
					grid_editable : false,
					width_grid : 100
				},
				tipo : 'ComboBox',
				form : true,
				save_as : 'hidden_id_aprobador'
			},
			{
				validacion : {
					name : 'nombre_aprobador',
					fieldLabel : 'Aprobador',
					grid_visible : true,
					grid_editable : false,
					width_grid : 250
				},
				tipo : 'TextField',
				filtro_0 : true,
				filterColValue : 'peremp2.nombre#peremp2.apellido_paterno#peremp2.apellido_materno',
				form : false
			},
			{
				validacion : {
					name : 'uo_aprobador',
					fieldLabel : 'U.O. Aprobador',
					grid_visible : true,
					grid_editable : false,
					width_grid : 250
				},
				tipo : 'TextField',
				filtro_0 : true,
				filterColValue : 'uo2.nombre_unidad',
				form : false
			},
			{

				validacion : {
					name : 'fecha_solicitud',
					fieldLabel : 'Fecha Solicitud',
					allowBlank : false,
					format : 'd/m/Y',
					minValue : '01/01/1900',
					disabledDaysText : 'D�a no v�lido',
					grid_visible : true,
					grid_editable : false,
					renderer : formatDate,
					width_grid : 150,
					disabled : false,
					align : 'center',
					width : '50%'
				},
				form : true,
				tipo : 'DateField',
				filtro_0 : true,
				filterColValue : 'sol.fecha_solicitud',
				dateFormat : 'm-d-Y',
				save_as : 'txt_fecha_solicitud'
			},
			{
				validacion : {
					name : 'descripcion',
					fieldLabel : 'Descripcion',
					allowBlank : false,
					typeAhead : true,
					align : 'left',
					grid_visible : true,
					grid_editable : false,
					width_grid : 200,
					width : 285
				},
				tipo : 'TextArea',
				filtro_0 : true,
				filterColValue : 'sol.descripcion',
				form : true,
				save_as : 'txt_descripcion'
			},
			{
				validacion : {
					name : 'estado',
					fieldLabel : 'Estado',
					grid_visible : true,
					grid_editable : false,
					width_grid : 130,
					renderer : renderEstado
				},
				tipo : 'TextField',
				filtro_0 : true,
				filterColValue : 'sol.estado',
				form : false
			},
			{
				validacion : {
					name : 'usuario_reg',
					fieldLabel : 'Responsable Registro',
					align : 'left',
					grid_visible : true,
					grid_editable : false,
					width_grid : 200
				},
				tipo : 'TextField',
				filtro_0 : true,
				filterColValue : 'per.nombre#per.apellido_paterno#per.apellido_materno',
				form : false
			},
			{
				validacion : {
					name : 'fecha_reg',
					fieldLabel : 'Fecha Registro',
					format : 'd/m/Y',
					minValue : '01/01/1900',
					grid_visible : true,
					grid_editable : false,
					renderer : formatDate,
					align : 'center',
					width_grid : 150
				},
				tipo : 'DateField',
				form : false,
				filtro_0 : true,
				filterColValue : 'sol.fecha_reg',
				dateFormat : 'm-d-Y'
			},
			{
				validacion : {
					name : 'usuario_mod',
					fieldLabel : 'Responsable Modificaci�n',
					align : 'left',
					grid_visible : true,
					grid_editable : false,
					width_grid : 200
				},
				tipo : 'TextField',
				filtro_0 : true,
				filterColValue : 'per2.nombre#per2.apellido_paterno#per2.apellido_materno',
				form : false
			}, {
				validacion : {
					name : 'fecha_mod',
					fieldLabel : 'Fecha Modificaci�n',
					format : 'd/m/Y',
					minValue : '01/01/1900',
					grid_visible : true,
					grid_editable : false,
					renderer : formatDate,
					align : 'center',
					width_grid : 150
				},
				tipo : 'DateField',
				form : false,
				filtro_0 : true,
				filterColValue : 'sol.fecha_mod',
				dateFormat : 'm-d-Y'
			} ];
	// ---------- INICIAMOS LAYOUT DETALLE
	var config = {
		titulo_maestro : 'Aprobacion de Solicitud',
		grid_maestro : 'grid-' + idContenedor,
		urlHijo : '../../../sis_almain/vista/detalle_solicitud/detalle_solicitud.php'
	};
	layout_aprobacion_solicitud = new DocsLayoutMaestroDeatalle(idContenedor);
	layout_aprobacion_solicitud.init(config);

	this.pagina = Pagina;
	this.pagina(paramConfig, vectorAtributos, ds, layout_aprobacion_solicitud,
			idContenedor);
	var cm_EnableSelect = this.EnableSelect;
	var cm_DeselectRow = this.DeselectRow;
	var cm_getSelectionModel = this.getSelectionModel;
	var cm_conexionFailure = this.conexionFailure;
	var cm_eliminarSuccess = this.eliminarSucess;
	var cm_btnActualizar = this.btnActualizar;
	var cm_btnNew = this.btnNew;
	var cm_getcomponente = this.getComponente;
	var cm_btnEliminar = this.btnEliminar;

	this.EnableSelect = function(selEvent, rowIndex, selectedRow) {
		cm_EnableSelect(selEvent, rowIndex, selectedRow);
		_CP.getPagina(layout_aprobacion_solicitud.getIdContentHijo()).pagina
				.reload(selectedRow.data);
		_CP.getPagina(layout_aprobacion_solicitud.getIdContentHijo()).pagina
				.desbloquearMenu();

		var btnAprobarSolicitud = cm_getBoton('AprobarSolicitud-'
				+ idContenedor);

		btnAprobarSolicitud.enable();

		if (selectedRow.data.estado == "pendiente_aprobacion") {
		} else if (selectedRow.data.estado == "pendiente_entrega") {

			cm_DesbloquearMenu();
		}

		var btnRechazarSolicitud = cm_getBoton('RechazarSolicitud-'
				+ idContenedor);

		btnRechazarSolicitud.enable();

		if (selectedRow.data.estado == "pendiente_aprobacion") {
		} else if (selectedRow.data.estado == "borrador") {

			cm_DesbloquearMenu();
		}

	}
	this.DeselectRow = function(n, n1) {
		cm_DeselectRow(n, n1);
		_CP.getPagina(layout_aprobacion_solicitud.getIdContentHijo()).pagina
				.limpiarStore();
		_CP.getPagina(layout_aprobacion_solicitud.getIdContentHijo()).pagina
				.bloquearMenu();
	};
	// ----------- DEFINICI�N DE LA BARRA DE MEN� ----------- //
	var paramMenu = {
		actualizar : {
			crear : true,
			separador : false
		}
	};

	function formatDate(value) {
		return value ? value.dateFormat('d/m/Y h:i:s a') : '';
	}
	;

	// funciones render
	function renderEstado(component, value, record) {
		var estado;
		if (record.data['estado'] == 'pendiente_aprobacion') {
			estado = 'Pendiente aprobacion';
		}
		return String.format('{0}', estado);
	}
	// ---------------------- DEFINICI�N DE FUNCIONES -------------------------
	var paramFunciones = {
		btnEliminar : {
			url : direccion+ "../../../control/solicitud_salida/ActionEliminarSolicitudSalida.php"
		},
		Save : {
			url : direccion+ "../../../control/solicitud_salida/ActionGuardarSolicitudSalida.php"
		},
		ConfirmSave : {
			url : direccion+ "../../../control/solicitud_salida/ActionGuardarSolicitudSalida.php"
		},
		Formulario : {
			titulo : 'Aprobacion Solicitud',
			html_apply : "dlgInfo-" + idContenedor,
			width : 470,
			height : 350,
			columnas : [ '95%' ],
			closable : true
		}
	};

	// -------------- FIN DEFINICI�N DE FUNCIONES PROPIAS --------------//
	this.Init();
	this.InitBarraMenu(paramMenu);
	this.InitFunciones(paramFunciones);
	this.iniciaFormulario();
	var cm_BloquearMenu = this.BloquearMenu;
	var cm_DesbloquearMenu = this.DesbloquearMenu;
	var cm_getBoton = this.getBoton;
	// Botones adicionales en el menu

	this.AdicionarBoton('../../../lib/imagenes/terminar.png',
			'Aprobar Solicitud', btnAprobarSolicitud, false,
			'AprobarSolicitud', 'Aprobar Solicitud');
	cm_getBoton('AprobarSolicitud-' + idContenedor).disable();

	function successAprobarSolicitud() {
		alert('entra al success');
	}
	function btnAprobarSolicitud() {
		var sm = cm_getSelectionModel();
		Ext.MessageBox
				.confirm(
						'Atenci�n',
						'Esta seguro de aprobar la solicitud seleccionada?',
						function(btn) {
							if (btn == 'yes') {
								var data = "id_solicitud_salida="
										+ sm.getSelected().data.id_solicitud_salida;
								Ext.Ajax
										.request({
											url : direccion
													+ "../../../control/solicitud_salida/ActionAprobarSolicitudClick.php",
											params : data,
											method : 'POST',
											success : cm_eliminarSuccess,
											failure : cm_conexionFailure,
											timeout : 10000
										});
							}
						});
	}

	this.AdicionarBoton('../../../lib/imagenes/volver.png',
			'Rechazar Solicitud', btnRechazarSolicitud, false,
			'RechazarSolicitud', 'Rechazar Solicitud');
	cm_getBoton('RechazarSolicitud-' + idContenedor).disable();

	function successRechazarSolicitud() {
		alert('entra al success');
	}
	function btnRechazarSolicitud() {
		var sm = cm_getSelectionModel();
		Ext.MessageBox
				.confirm(
						'Atenci�n',
						'Esta seguro de rechazar la solicitud seleccionada?',
						function(btn) {
							if (btn == 'yes') {
								var data = "id_solicitud_salida="
										+ sm.getSelected().data.id_solicitud_salida;
								Ext.Ajax
										.request({
											url : direccion+ "../../../control/solicitud_salida/ActionRechazarSolicitudClick.php",
											params : data,
											method : 'POST',
											success : cm_eliminarSuccess,
											failure : cm_conexionFailure,
											timeout : 10000
										});
							}
						});
	}

	layout_aprobacion_solicitud.getLayout().addListener('layout', this.onResize);
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',
			this.onResizePrimario);
}