/**
* Nombre:		  	    pagina_salida_main.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
* Fecha creaci�n:		2007-10-25 15:08:17
*/
function pagina_salida_pedido_unidad_cons(idContenedor,direccion,paramConfig)
{
	var vectorAtributos=new Array;
	var componentes=new Array();
	var data_ep;
	var ds;
	var elementos=new Array();
	var sw=0;

	var combo_almacen,combo_almacen_logico,combo_solicitante,combo_contratista,combo_empleado,combo_institucion;
	var combo_motivo_salida,combo_motivo_salida_cuenta,cmb_ep,cmb_subactividad,cmb_tramo_subactividad,cmb_tramo_unidad_constructiva;

	/////////////////
	//  DATA STORE //
	/////////////////
	ds=new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy:new Ext.data.HttpProxy({url:direccion+'../../../control/salida/ActionListarSalidaPedido.php'}),
		// aqui se define la estructura del XML
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_salida',totalRecords:'TotalCount'},
		[
		// define el mapeo de XML a las etiquetas (campos)
		'id_salida',
		'correlativo_sal',
		'correlativo_vale',
		'descripcion',
		'contabilizar',
		'contabilizado',
		'estado_salida',
		'tipo_entrega',
		'estado_registro',
		'motivo_cancelacion',
		'id_responsable_almacen',
		'desc_responsable_almacen',
		'id_almacen_logico',
		'desc_almacen_logico',
		'id_empleado',
		'desc_empleado',
		'id_firma_autorizada',
		'desc_firma_autorizada',
		'id_contratista',
		'desc_contratista',
		'id_tipo_material',
		'desc_tipo_material',
		'id_institucion',
		'desc_institucion',
		'desc_subactividad',
		'id_subactividad',
		'id_motivo_salida_cuenta',
		'desc_motivo_salida_cuenta',
		'nro_cuenta',
		'id_motivo_salida',
		'desc_motivo_salida',
		'desc_almacen',
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
		'observaciones',
		'tipo_pedido',
		'receptor',
		'id_tramo_subactividad',
		'id_tramo_unidad_constructiva',
		'desc_tramo',
		'desc_unidad_cons'
		]),remoteSort:true
	});
	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros,
			tipo_pedido:'Tipo Unidad Constructiva'
		}
	});
	//DATA STORE COMBOS
	ds_almacen=new Ext.data.Store({proxy:new Ext.data.HttpProxy({url:direccion+'../../../control/almacen/ActionListarAlmacenEP.php'}),reader:new Ext.data.XmlReader({record:'ROWS',id:'idalmacen',totalRecords:'TotalCount'}, ['id_almacen','nombre','descripcion'])});
	ds_almacen_logico=new Ext.data.Store({proxy:new Ext.data.HttpProxy({url:direccion+'../../../control/almacen_logico/ActionListarAlmacenLogicoFisEP.php'}),reader:new Ext.data.XmlReader({record:'ROWS',id:'id_almacen_logico',totalRecords:'TotalCount'}, ['id_almacen_logico','codigo','bloqueado','nombre','descripcion','estado_registro','fecha_reg','obsevaciones','id_almacen_ep','id_tipo_almacen'])});
	ds_contratista = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url:direccion+'../../../../sis_parametros/control/contratista/ActionListarContratista.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_contratista',totalRecords: 'TotalCount'},  ['id_contratista','codigo','observaciones','estado_registro','fecha_reg','id_institucion','id_persona','nombre_contratista','pagina_web','email','direccion'])});
	ds_empleado = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_kardex_personal/control/empleado/ActionListarEmpleado.php'}),reader: new Ext.data.XmlReader({record:'ROWS',id:'id_empleado',totalRecords:'TotalCount'}, ['id_empleado','id_persona','codigo_empleado','desc_persona'])});
	ds_institucion = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/institucion/ActionListarInstitucion.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_institucion',totalRecords: 'TotalCount'}, ['id_institucion','direccion','doc_id','nombre','casilla','telefono1','telefono2','celular1','celular2','fax','email1','email2','pag_web','observaciones','fecha_registro','hora_registro','fecha_ultima_modificacion','hora_ultima_modificacion','estado_institucion','id_persona'])});
	ds_motivo_salida=new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/motivo_salida/ActionListarMotivoSalidaEP.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_motivo_salida',totalRecords: 'TotalCount'}, ['id_motivo_salida','nombre','descripcion','fecha_reg'])});
	ds_motivo_salida_cuenta = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/motivo_salida_cuenta/ActionListarMotivoSalidaCuenta.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_motivo_salida_cuenta',totalRecords: 'TotalCount'}, ['id_motivo_salida_cuenta','desc_cuenta','descripcion','fecha_reg','codigo_ep'])});
	ds_tipo_material = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/tipo_material/ActionListarTipoMaterial.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_tipo_material',totalRecords: 'TotalCount'}, ['id_tipo_material','nombre','descripcion','observaciones','fecha_reg'])});
	ds_subactividad = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/subactividad/ActionListarSubactividad.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_subactividad',totalRecords: 'TotalCount'}, ['id_subactividad','codigo','descripcion','observaciones','fecha_reg'])});
	ds_tramo_subactividad = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../..//control/tramo_subactividad/ActionListarTramoSubactividad_det.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_tramo_subactividad',totalRecords: 'TotalCount'}, ['id_tramo_subactividad','desc_tramo','desc_subactividad','codigo_tramo','id_tramo'])});
	ds_tramo_unidad_constructiva = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../..//control/tramo_unidad_constructiva/ActionListarTramoUnidadConstructiva_det.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_tramo_unidad_constructiva',totalRecords: 'TotalCount'}, ['id_tramo_unidad_constructiva','desc_unidad_constructiva','desc_tipo_unidad_constructiva'])});

	//FUNCIONES RENDER
	function render_id_almacen(value, p, record){return String.format('{0}', record.data['desc_almacen'])}
	function render_id_almacen_logico(value, p, record){return String.format('{0}', record.data['desc_almacen_logico'])}
	function render_id_contratista(value, p, record){return String.format('{0}', record.data['desc_contratista'])}
	function render_id_empleado(value, p, record){return String.format('{0}', record.data['desc_empleado'])}
	function render_id_institucion(value, p, record){return String.format('{0}', record.data['desc_institucion'])}
	function render_id_motivo_salida_cuenta(value, p, record){return String.format('{0}', record.data['desc_motivo_salida_cuenta'])}
	function render_id_motivo_salida(value, p, record){return String.format('{0}', record.data['desc_motivo_salida'])}
	function render_id_tipo_material(value, p, record){return String.format('{0}', record.data['desc_tipo_material'])}
	function render_observaciones(value, p, record){return String.format('<b><font color="#FF0000">{0}</font></b>', record.data['observaciones'])}
	function render_id_subactividad(value, p, record){return String.format('{0}', record.data['desc_subactividad'])}
	function render_id_tramo_subactividad(value, p, record){return String.format('{0}', record.data['desc_tramo'])}
	function render_id_tramo_unidad_constructiva(value, p, record){return String.format('{0}', record.data['desc_unidad_cons'])}

	// Template combo
	var resultTplAlmacen = new Ext.Template('<div class="search-item">','<b><i>{nombre}</i></b>','<br><FONT COLOR="#B5A642">{descripcion}</FONT>','</div>');
	var resultTplAlmacenLogico = new Ext.Template('<div class="search-item">','<b><i>{nombre}</i></b>','<br><FONT COLOR="#B5A642">{descripcion}','<br>{desc_tipo_almacen}</FONT>','</div>');
	var resultTplContratista = new Ext.Template('<div class="search-item">','<b><i>{nombre_contratista}</i></b>','<br><FONT COLOR="#B5A642">{codigo}','<br>{email}','<br>{direccion}</FONT>','</div>');
	var resultTplInstitucion = new Ext.Template('<div class="search-item">','<b><i>{nombre}</i></b>','<br><FONT COLOR="#B5A642">{pag_web}','<br>{direccion}</FONT>','</div>');
	var resultTplEmpleado = new Ext.Template('<div class="search-item">','<b><i>{codigo_empleado}</i></b>','<br><FONT COLOR="#B5A642">{desc_persona}</FONT>','</div>');
	var resultTplTipoMaterial = new Ext.Template('<div class="search-item">','<b><i>{nombre}</i></b>','<br><FONT COLOR="#B5A642">{descripcion}</FONT>','</div>');
	var resultTplMotivoSalida = new Ext.Template('<div class="search-item">','<b><i>{nombre}</i></b>','<br><FONT COLOR="#B5A642">{descripcion}</FONT>','</div>');
	var resultTplMotivoSalidaCuenta = new Ext.Template('<div class="search-item">','<b><i>{descripcion}</i></b>','<br><FONT COLOR="#B5A642">{desc_cuenta}','<br>{codigo_ep}</FONT>','</div>');
	var resultTplSubactividad = new Ext.Template('<div class="search-item">','<b>{descripcion}</b>','<br><FONT COLOR="#B5A642">{codigo}</FONT>','</div>');
	var resultTplTramoSubactividad = new Ext.Template('<div class="search-item">','<b>{codigo_tramo}</b>','<br><FONT COLOR="#B5A642">{desc_tramo}</FONT>','</div>');
	var resultTplTramoUnidadConstructiva = new Ext.Template('<div class="search-item">','<b>{desc_unidad_constructiva}</b>','<br><FONT COLOR="#B5A642">{desc_tipo_unidad_constructiva}</FONT>','</div>');

	/////////////////////////
	// Definici�n de datos //
	/////////////////////////

	vectorAtributos[0]={
		validacion:{
			labelSeparator:'',
			name:'id_salida',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false
		},
		tipo:'Field',
		filtro_0:false,
		save_as:'hidden_id_salida'
	};

	vectorAtributos[8]={
		validacion:{
			name:'descripcion',
			fieldLabel:'Descripci�n',
			allowBlank:false,
			maxLength:200,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:true,
			grid_indice:11,
			width_grid:220
		},
		tipo:'TextArea',
		filtro_0:false,
		filtro_1:false,
		filterColValue:'SALIDA.descripcion',
		save_as:'txt_descripcion',
		id_grupo:4
	};

	vectorAtributos[2]={
		validacion:{
			fieldLabel:'Almacen F�sico',
			allowBlank:true,
			emptyText:'Almacen F�sico...',
			name:'id_almacen',
			desc:'desc_almacen',
			store:ds_almacen,
			valueField:'id_almacen',
			displayField:'nombre',
			queryParam:'filterValue_0',
			filterCol:'ALMACE.nombre#ALMACE.descripcion',
			typeAhead:true,
			forceSelection:false,
			tpl: resultTplAlmacen,
			mode:'remote',
			queryDelay:250,
			pageSize:100,
			minListWidth:450,
			grow:true,
			width:300,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1,
			triggerAction:'all',
			editable:true,
			renderer:render_id_almacen,
			grid_visible:true,
			grid_editable:false,
			grid_indice:2,
			width_grid:140
		},
		tipo:'ComboBox',
		filtro_0:true,
		filterColValue:'ALMACE.nombre#ALMACE.descripcion',
		defecto:'',
		save_as:'txt_id_almacen',
		id_grupo:2
	};


	filterCols_almacen_logico=new Array();
	filterValues_almacen_logico=new Array();
	filterCols_almacen_logico[0]='ALMACE.id_almacen';
	filterValues_almacen_logico[0]='%';

	vectorAtributos[3]={
		validacion:{
			fieldLabel:'Almacen L�gico',
			allowBlank:false,
			emptyText:'Almacen L�gico...',
			name:'id_almacen_logico',
			desc:'desc_almacen_logico',
			store:ds_almacen_logico,
			valueField:'id_almacen_logico',
			displayField:'nombre',
			queryParam:'filterValue_0',
			filterCol:'ALMLOG.codigo#ALMLOG.nombre#ALMLOG.descripcion',
			filterCols:filterCols_almacen_logico,
			filterValues:filterValues_almacen_logico,
			typeAhead:true,
			forceSelection:true,
			tpl: resultTplAlmacenLogico,
			mode:'remote',
			queryDelay:250,
			pageSize:100,
			minListWidth:450,
			grow:true,
			width:300,
			//grow:true,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1,
			triggerAction:'all',
			editable:true,
			renderer:render_id_almacen_logico,
			grid_visible:true,
			grid_editable:false,
			grid_indice:3,
			width_grid:140
		},
		tipo:'ComboBox',
		filtro_0:true,
		filterColValue:'ALMLOG.codigo#ALMLOG.nombre#ALMLOG.descripcion',
		defecto: '',
		save_as:'txt_id_almacen_logico',
		id_grupo:2
	};

	vectorAtributos[4]= {
		validacion: {
			name:'solicitante',
			fieldLabel:'Solicitante',
			allowBlank:false,
			typeAhead: true,
			loadMask: true,
			triggerAction: 'all',
			//store: new Ext.data.SimpleStore({fields: ['ID','valor'],data : Ext.salida_pedido_unidad_cons_combo.solicitante}),
			store: new Ext.data.SimpleStore({fields: ['ID','valor'],data : [['contratista','Contratista'],['empleado','Funcionario'],['institucion','Instituci�n']]}),
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			forceSelection:true,
			grid_visible:false,
			grid_editable:false,
			width_grid:60
		},
		tipo:'ComboBox',
		filtro_0:false,
		filtro_1:false,
		filterColValue:'',
		defecto:'constratista',
		save_as:'',
		id_grupo:1
	};

	vectorAtributos[5]= {
		validacion: {
			name:'id_empleado',
			fieldLabel:'Funcionario',
			allowBlank:true,
			emptyText:'Funcionario...',
			desc: 'desc_empleado',
			store:ds_empleado,
			valueField: 'id_empleado',
			displayField: 'desc_persona',
			queryParam: 'filterValue_0',
			filterCol:'PERSON.nombre#PERSON.apellido_paterno#PERSON.apellido_materno#EMPLEA.codigo_empleado',
			tpl:resultTplEmpleado,
			typeAhead:false,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:10,
			minListWidth:450,
			grow:true,
			width:300,
			//grow:true,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1,
			triggerAction:'all',
			editable:true,
			renderer:render_id_empleado,
			grid_visible:true,
			grid_editable:false,
			grid_indice:4,
			width_grid:200
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'EMPLEA.id_persona#PERSON.nombre#PERSOn.apellido_paterno#PERSON.apellido_materno',
		defecto: '',
		save_as:'txt_id_empleado',
		id_grupo:1
	};

	vectorAtributos[6]= {
		validacion: {
			name:'id_contratista',
			fieldLabel:'Contratista',
			allowBlank:true,
			emptyText:'Contratista...',
			desc: 'desc_contratista',
			store:ds_contratista,
			valueField: 'id_contratista',
			displayField: 'nombre_contratista',
			queryParam: 'filterValue_0',
			filterCol:'CONTRA.codigo#INSTIT.nombre#INSTIT.pag_web#INSTIT.email1#INSTIT.direccion#PERSON.pag_web#INSTIT.email1',
			tpl:resultTplContratista,
			typeAhead:false,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:10,
			minListWidth:450,
			grow:true,
			width:300,
			//grow:true,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1,
			triggerAction:'all',
			editable:true,
			renderer:render_id_contratista,
			grid_visible:true,
			grid_editable:false,
			grid_indice:5,
			width_grid:200
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'CONTRA.codigo',
		defecto: '',
		save_as:'txt_id_contratista',
		id_grupo:1
	};

	vectorAtributos[7]= {
		validacion: {
			name:'id_institucion',
			fieldLabel:'Instituci�n',
			allowBlank:true,
			emptyText:'Instituci�n...',
			desc: 'desc_institucion',
			store:ds_institucion,
			valueField: 'id_institucion',
			displayField: 'nombre',
			queryParam: 'filterValue_0',
			filterCol:'INSTIT.nombre#INSTIT.casilla',
			tpl:resultTplInstitucion,
			typeAhead:true,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:10,
			minListWidth:450,
			grow:true,
			width:300,
			//grow:true,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1,
			triggerAction:'all',
			editable:true,
			renderer:render_id_institucion,
			grid_visible:true,
			grid_editable:false,
			grid_indice:6,
			width_grid:200
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'INSTIT.nombre',
		defecto: '',
		save_as:'txt_id_institucion',
		id_grupo:1
	};

	vectorAtributos[1]={
		validacion: {
			name:'id_tipo_material',
			fieldLabel:'Tipo Material',
			allowBlank:false,
			emptyText:'Tipo Material...',
			desc: 'desc_tipo_material',
			store:ds_tipo_material,
			valueField: 'id_tipo_material',
			displayField: 'nombre',
			queryParam: 'filterValue_0',
			filterCol:'TIPMAT.nombre#TIPMAT.descripcion',
			tpl:resultTplTipoMaterial,
			typeAhead:true,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:10,
			minListWidth:450,
			grow:true,
			width:200,
			//grow:true,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1,
			triggerAction:'all',
			editable:true,
			renderer:render_id_tipo_material,
			grid_visible:true,
			grid_editable:true,
			grid_indice:9,
			width_grid:110
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'TIPMAT.nombre',
		defecto: '',
		save_as:'txt_id_tipo_material',
		id_grupo:4
	};

	vectorAtributos[9]= {
		validacion: {
			fieldLabel:'Motivo salida',
			allowBlank:true,
			emptyText:'Motivo Salida ...',
			name: 'id_motivo_salida',
			desc: 'desc_motivo_salida',
			store:ds_motivo_salida,
			valueField: 'id_motivo_salida',
			displayField: 'descripcion',
			queryParam: 'filterValue_0',
			filterCol:'MOTSAL.descripcion',
			tpl:resultTplMotivoSalida,
			typeAhead:true,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:10,
			minListWidth:450,
			grow:true,
			width:250,
			//grow:true,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1,
			triggerAction:'all',
			editable:true,
			renderer:render_id_motivo_salida,
			grid_visible:true,
			grid_editable:false,
			grid_indice:7,
			width_grid:200
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'MOTSAL.descripcion',
		defecto: '',
		save_as:'txt_id_motivo_salida',
		id_grupo:3
	};

	filterCols_motivo_salida_cuenta=new Array();
	filterValues_motivo_salida_cuenta=new Array();
	filterCols_motivo_salida_cuenta[0]='MOTSAL.id_motivo_salida';
	filterValues_motivo_salida_cuenta[0]='%';

	vectorAtributos[10]={
		validacion:{
			fieldLabel:'Cuenta',
			allowBlank:false,
			emptyText:'Cuenta ...',
			name:'id_motivo_salida_cuenta',
			desc:'desc_motivo_salida_cuenta',
			store:ds_motivo_salida_cuenta,
			valueField: 'id_motivo_salida_cuenta',
			displayField: 'descripcion',
			queryParam: 'filterValue_0',
			filterCol:'MOSACU.descripcion',
			tpl:resultTplMotivoSalidaCuenta,
			filterCols:filterCols_motivo_salida_cuenta,
			filterValues:filterValues_motivo_salida_cuenta,
			typeAhead:true,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:10,
			minListWidth:450,
			grow:true,
			width:300,
			resizable:true,
			minChars:1,
			triggerAction:'all',
			editable:true,
			renderer:render_id_motivo_salida_cuenta,
			grid_visible:true,
			grid_editable:false,
			grid_indice:8,
			width_grid:200
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'MOSACU.descripcion',
		defecto: '',
		save_as:'txt_id_motivo_salida_cuenta',
		id_grupo:3
	};

	vectorAtributos[11]={
		validacion:{
			fieldLabel: 'Estructura Program�tica',
			allowBlank: false,
			vtype:"texto",
			emptyText:'Estructura Program�tica',
			name: 'id_ep',
			minChars: 1,
			triggerAction: 'all',
			editable: false,
			grid_editable:false,
			grid_visible:true,
			grid_indice:18
		},
		tipo: 'epField',
		save_as:'hidden_id_ep1',
		id_grupo:0
	};

	vectorAtributos[12]={
		validacion:{
			name:'observaciones',
			fieldLabel:'Observaciones',
			allowBlank:true,
			maxLength:250,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			disabled:false,
			renderer:render_observaciones,
			grid_visible:false,
			grid_editable:false,
			grid_indice:12,
			width_grid:250
		},
		form:true,
		tipo:'TextArea',
		filtro_0:false,
		filterColValue:'SALIDA.observaciones',
		id_grupo:0,
		save_as:'txt_observaciones'
	};

	vectorAtributos[13]={
		validacion:{
			name:'tipo_pedido',
			fieldLabel:'Tipo pedido',
			allowBlank:true,
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
		tipo:'TextField',
		defecto:'Tipo Unidad Constructiva',
		save_as:'txt_tipo_pedido',
		id_grupo:0
	};

	vectorAtributos[14]={
		validacion:{
			name:'receptor',
			fieldLabel:'Receptor',
			allowBlank:true,
			maxLength:70,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			disabled:false,
			grid_visible:true,
			grid_editable:true,
			grid_indice:11,
			width_grid:250,
			width:'100%'
		},
		form:true,
		tipo:'TextField',
		filtro_0:false,
		filterColValue:'SALIDA.receptor',
		id_grupo:4,
		save_as:'txt_receptor'
	};

	filterCols_subactividad=new Array();
	filterValues_subactividad=new Array();
	filterCols_subactividad[0]='PROGRA.id_programa';
	filterValues_subactividad[0]='x';
	filterCols_subactividad[1]='PROYEC.id_proyecto';
	filterValues_subactividad[1]='x';
	filterCols_subactividad[2]='ACTIVI.id_actividad';
	filterValues_subactividad[2]='x';
	vectorAtributos[15]= {
		validacion: {
			fieldLabel:'Subactividad',
			allowBlank:true,
			emptyText:'Subactividad...',
			name: 'id_subactividad',
			desc: 'desc_subactividad',
			store:ds_subactividad,
			valueField: 'id_subactividad',
			displayField: 'descripcion',
			queryParam: 'filterValue_0',
			filterCol:'SUBACT.descripcion',
			tpl:resultTplSubactividad,
			filterCols:filterCols_subactividad,
			filterValues:filterValues_subactividad,
			typeAhead:true,
			forceSelection:false,
			mode:'remote',
			queryDelay:250,
			pageSize:10,
			minListWidth:450,
			grow:true,
			width:250,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1,
			triggerAction:'all',
			editable:true,
			renderer:render_id_subactividad,
			grid_visible:true,
			grid_editable:false,
			grid_indice:12,
			width_grid:200
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'SUBACT.descripcion',
		defecto: '',
		save_as:'txt_id_subactividad',
		id_grupo:4
	};

	filterCols_tramo_subactividad=new Array();
	filterValues_tramo_subactividad=new Array();
	filterCols_tramo_subactividad[0]='SUBACT.id_subactividad';
	filterValues_tramo_subactividad[0]='x';
	vectorAtributos[16]= {
		validacion: {
			fieldLabel:'Tramo',
			allowBlank:true,
			emptyText:'Tramo...',
			name: 'id_tramo_subactividad',
			desc: 'desc_tramo',
			store:ds_tramo_subactividad,
			valueField: 'id_tramo_subactividad',
			displayField: 'desc_tramo',
			queryParam: 'filterValue_0',
			filterCol:'TRAMO.descripcion',
			tpl:resultTplTramoSubactividad,
			filterCols:filterCols_tramo_subactividad,
			filterValues:filterValues_tramo_subactividad,
			typeAhead:true,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:10,
			minListWidth:450,
			grow:true,
			width:250,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1,
			triggerAction:'all',
			editable:true,
			renderer:render_id_tramo_subactividad,
			grid_visible:true,
			grid_editable:false,
			grid_indice:13,
			width_grid:200
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'TRAMO.descripcion',
		defecto: '',
		save_as:'txt_id_tramo_subactividad',
		id_grupo:4
	};

	filterCols_tramo_unidad_constructiva=new Array();
	filterValues_tramo_unidad_constructiva=new Array();
	filterCols_tramo_unidad_constructiva[0]='TRAMO.id_tramo';
	filterValues_tramo_unidad_constructiva[0]='x';
	vectorAtributos[17]= {
		validacion: {
			fieldLabel:'Unidad Constructiva',
			allowBlank:true,
			emptyText:'Unidad Constructiva...',
			name: 'id_tramo_unidad_constructiva',
			desc: 'desc_unidad_constructiva',
			store:ds_tramo_unidad_constructiva,
			valueField: 'id_tramo_unidad_constructiva',
			displayField: 'desc_unidad_constructiva',
			queryParam: 'filterValue_0',
			filterCol:'TRAMO.codigo',
			tpl:resultTplTramoUnidadConstructiva,
			filterCols:filterCols_tramo_unidad_constructiva,
			filterValues:filterValues_tramo_unidad_constructiva,
			typeAhead:true,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:10,
			minListWidth:450,
			grow:true,
			width:250,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1,
			triggerAction:'all',
			editable:true,
			renderer:render_id_tramo_unidad_constructiva,
			grid_visible:true,
			grid_editable:false,
			grid_indice:14,
			width_grid:200
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'TRAMO.descripcion',
		defecto: '',
		save_as:'txt_id_tramo_unidad_constructiva',
		id_grupo:4
	};

	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	function formatDate(value){
		return value ? value.dateFormat('d/m/Y') : ''
	};
	//////////////////////////////////////////////////////////////
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
	//////////////////////////////////////////////////////////////
	//Inicia Layout
	var config={titulo_maestro:'Pedido',grid_maestro:'grid-'+idContenedor};
	layout_salida=new DocsLayoutMaestro(idContenedor);
	layout_salida.init(config);
	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////
	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina = Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,ds,layout_salida,idContenedor);
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
	var getSelectionModel=this.getSelectionModel;
	var Cm_EnableSelect=this.EnableSelect;
	var Cm_getComponente=this.getComponente;
	var Cm_conexionFailure=this.conexionFailure;
	var Cm_btnNew=this.btnNew;
	var Cm_btnEdit=this.btnEdit;
	var Cm_onResize=this.onResize;
	var Cm_btnActualizar = this.btnActualizar;

	var Cm_getGrid=this.getGrid;
	var Cm_getDialog=this.getDialog;
	var Cm_getFormulario=this.getFormulario;
	var CM_mostrarComponente=this.mostrarComponente;
	var CM_ocultarComponente=this.ocultarComponente;
	var Cm_Destroy=this.Destroy;
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
		btnEliminar:{url:direccion+'../../../control/salida/ActionEliminarSalida.php',parametros:'&tipo_pedido=Tipo Unidad Constructiva&tipo='},
		Save:{url:direccion+'../../../control/salida/ActionGuardarSalidaPedido.php',parametros:'&tipo_pedido=Tipo Unidad Constructiva&tipo='},
		ConfirmSave:{url:direccion+'../../../control/salida/ActionGuardarSalidaPedido.php',parametros:'&tipo_pedido=Tipo Unidad Constructiva&tipo='},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,height:'60%',width:'50%',columnas:['96%'],
		grupos:[{tituloGrupo:'Estructura Program�tica',columna:0,id_grupo:0},
		{tituloGrupo:'Origen Pedido',columna:0,id_grupo:1},
		{tituloGrupo:'Almac�n',columna:0,id_grupo:2},
		{tituloGrupo:'Motivo de Salida',columna:0,id_grupo:3},
		{tituloGrupo:'Datos Pedido',columna:0,id_grupo:4}
		],
		minWidth:150,minHeight:200,	closable:true,titulo:'Pedido'}
	};
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	function btn_salida_detalle(){
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			var data='m_id_salida='+SelectionsRecord.data.id_salida;
			data=data+'&m_descripcion='+SelectionsRecord.data.descripcion;
			data=data+'&m_id_almacen_logico='+SelectionsRecord.data.id_almacen_logico;
			var ParamVentana={Ventana:{width:'90%',height:'70%'}}
			layout_salida.loadWindows(direccion+'../../salida_pedido_detalle/salida_pedido_unidad_cons_arb.php?'+data,'Detalles Material Solicitud',ParamVentana);
			layout_salida.getVentana().on('resize',function(){layout_salida.getLayout().layout()})
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
		}
	}
	//Para manejo de eventos
	function iniciarEventosFormularios(){
		combo_almacen = Cm_getComponente('id_almacen');
		combo_almacen_logico = Cm_getComponente('id_almacen_logico');
		combo_solicitante = Cm_getComponente('solicitante');
		combo_contratista = Cm_getComponente('id_contratista');
		combo_empleado = Cm_getComponente('id_empleado');
		combo_institucion = Cm_getComponente('id_institucion');
		combo_motivo_salida = Cm_getComponente('id_motivo_salida');
		combo_motivo_salida_cuenta = Cm_getComponente('id_motivo_salida_cuenta');
		cmb_ep=Cm_getComponente('id_ep');
		cmb_subactividad=Cm_getComponente('id_subactividad');
		cmb_tramo_subactividad=Cm_getComponente('id_tramo_subactividad');
		cmb_tramo_unidad_constructiva=Cm_getComponente('id_tramo_unidad_constructiva');

		var onMotivoSalidaSelect=function(e){
			var id = combo_motivo_salida.getValue();
			combo_motivo_salida_cuenta.filterValues[0] =  id;
			combo_motivo_salida_cuenta.modificado = true;
			combo_motivo_salida_cuenta.enable();
			combo_motivo_salida_cuenta.setValue('');
			combo_motivo_salida.modificado=true
		};

		var onAlmacenSelect=function(e) {
			var id = combo_almacen.getValue();
			combo_almacen_logico.filterValues[0] =  id;
			combo_almacen_logico.modificado = true;
			combo_almacen_logico.enable();//almacen logico
			combo_almacen_logico.setValue('');
			combo_almacen.modificado=true
		};

		var onSolicitanteSelect=function(e){
			var valor = combo_solicitante.getValue();
			componentes[5].enable();
			componentes[6].enable();
			componentes[7].enable();
			if(valor == 'empleado'){

				CM_mostrarComponente(componentes[5]);//empleado
				CM_ocultarComponente(componentes[6]);//contratista
				CM_ocultarComponente(componentes[7])//institucion
			}else if (valor == 'contratista'){
				CM_ocultarComponente(componentes[5]);//empleado
				CM_mostrarComponente(componentes[6]);//contratista
				CM_ocultarComponente(componentes[7])//institucion
			}else if(valor == 'institucion'){
				CM_ocultarComponente(componentes[5]);//empleado
				CM_ocultarComponente(componentes[6]);//contratista
				CM_mostrarComponente(componentes[7])//institucion
			};
		}

		var onSolicitanteChange = function(e){
			var valor = combo_solicitante.getValue();
			if(valor == 'contratista'){
				combo_empleado.reset();
				combo_institucion.reset()
			}else if(valor == 'empleado'){
				combo_contratista.reset();
				combo_institucion.reset()
			}else if(valor == 'institucion'){
				combo_empleado.setValue('');
				combo_contratista.setValue('')
			}
		};

		var onEpSelect = function(e){
			var ep=cmb_ep.getValue();
			data_ep='id_financiador='+ep['id_financiador']+'&id_regional='+ep['id_regional']+'&id_programa='+ep['id_programa']+'&id_proyecto='+ep['id_proyecto']+'&id_actividad='+ep['id_actividad'];
			//Actualiza los datastore de los combos para filtrar por EP
			actualizar_ds_combos();
			//Limpia los valores de los combos
			combo_almacen.setValue('');
			combo_almacen_logico.setValue('');
			combo_motivo_salida.setValue('');
			combo_motivo_salida_cuenta.setValue('');
			combo_empleado.setValue('');
			//Notifica que se modific� combo para que vuelva a sacar los datos de la BD
			combo_almacen.modificado=true;
			combo_almacen.enable();
			combo_almacen_logico.modificado=true;
			combo_motivo_salida.modificado=true;
			combo_motivo_salida.enable();
			combo_motivo_salida_cuenta.modificado=true;
			combo_empleado.modificado=true;
			componentes[4].enable()//solicitante

			//Actualiza par�metro de filtro del combo de subactividad
			cmb_subactividad.modificado=true;
			cmb_subactividad.setValue('');
			filterValues_subactividad[0]=ep['id_programa'];
			filterValues_subactividad[1]=ep['id_proyecto'];
			filterValues_subactividad[2]=ep['id_actividad'];

			//Limpia y actualiza los otros combos
			cmb_tramo_subactividad.setValue('');
			cmb_tramo_unidad_constructiva.setValue('');
			cmb_tramo_subactividad.modificado=true;
			cmb_tramo_unidad_constructiva.modificado=true;
			filterValues_tramo_subactividad[0]='x';
			filterValues_tramo_unidad_constructiva[0]='x';
		};

		var onSubactividadSelect = function(e){
			var idSubAct=cmb_subactividad.getValue();
			//Actualiza par�metro de filtro del combo de subactividad
			cmb_tramo_subactividad.modificado=true;
			cmb_tramo_subactividad.setValue('');
			filterValues_tramo_subactividad[0]=idSubAct
			//Limpia y actualiza los otros combos
			cmb_tramo_unidad_constructiva.setValue('');
			cmb_tramo_unidad_constructiva.modificado=true;
			filterValues_tramo_unidad_constructiva[0]='x';
		};

		var onTramoSubactSelect = function(e){
			var idTramoSubAct=cmb_tramo_subactividad.getValue();
			var aux;
			aux=cmb_tramo_subactividad.store.getById(idTramoSubAct).data;
			//Actualiza par�metro de filtro del combo de subactividad&
			cmb_tramo_unidad_constructiva.modificado=true;
			filterValues_tramo_unidad_constructiva[0]=aux['id_tramo']
		};

		combo_almacen.on('select', onAlmacenSelect);
		combo_almacen.on('change', onAlmacenSelect);
		combo_solicitante.on('select', onSolicitanteSelect);
		combo_solicitante.on('change', onSolicitanteSelect);
		combo_contratista.on('change',onSolicitanteChange);
		combo_institucion.on('change',onSolicitanteChange);
		combo_empleado.on('change',onSolicitanteChange);
		combo_motivo_salida.on('select',onMotivoSalidaSelect);
		combo_motivo_salida.on('change',onMotivoSalidaSelect);
		cmb_ep.on('change',onEpSelect);
		cmb_subactividad.on('select',onSubactividadSelect);
		cmb_tramo_subactividad.on('select',onTramoSubactSelect)
	}

	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	this.btnNew=function(){
		//S�lo muestra el contratista por defecto
		CM_ocultarComponente(componentes[5]);//empleado
		CM_mostrarComponente(componentes[6]);//contratista
		CM_ocultarComponente(componentes[7]);//instituci�n
		CM_ocultarComponente(componentes[12]);//observaciones
		CM_ocultarComponente(componentes[13]);//observaciones
		componentes[2].disable();//almacen fisico
		componentes[3].disable();//almacen logico
		componentes[9].disable();//motivo salida
		componentes[10].disable();//motivo salida cuenta
		componentes[4].disable();//solicitante
		componentes[5].disable();//empleado
		componentes[6].disable();//contratista
		componentes[7].disable();//institucion
		Cm_btnNew()
	}
	//Sobrecarga del edit, para desplegar el origen del ingreso
	this.btnEdit=function(){
		CM_ocultarComponente(componentes[12]);//observaciones
		CM_ocultarComponente(componentes[13]);//observaciones
		componentes[2].enable();//almacen fisico
		componentes[3].enable();//almacen logico
		componentes[9].enable();//motivo salida
		componentes[10].enable();//motivo salida cuenta
		componentes[4].enable();//solicitante
		componentes[5].enable();//empleado
		componentes[6].enable();//contratista
		componentes[7].enable();//institucion
		var sm=getSelectionModel();
		var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			if(SelectionsRecord.data.id_institucion!=''){
				combo_solicitante.setValue('Instituci�n');
				CM_ocultarComponente(componentes[5]);//empleado
				CM_ocultarComponente(componentes[6]);//contratista
				CM_mostrarComponente(componentes[7])//instituci�n
			}
			else if(SelectionsRecord.data.id_contratista!=''){
				combo_solicitante.setValue('Contratista');
				CM_ocultarComponente(componentes[5]);//empleado
				CM_mostrarComponente(componentes[6]);//contratista
				CM_ocultarComponente(componentes[7])//instituci�n
			}
			else if(SelectionsRecord.data.id_empleado!=''){
				combo_solicitante.setValue('Funcionario');
				CM_mostrarComponente(componentes[5]);//empleado
				CM_ocultarComponente(componentes[6]);//contratista
				CM_ocultarComponente(componentes[7])//instituci�n
			}
		}
		else{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
		}

		Cm_btnEdit()
	};

	this.EnableSelect=function(selModel,row,selected){
		Cm_EnableSelect(selModel,row,selected)
		var ep=cmb_ep.getValue();
		data_ep='id_financiador='+ep['id_financiador']+'&id_regional='+ep['id_regional']+'&id_programa='+ep['id_programa']+'&id_proyecto='+ep['id_proyecto']+'&id_actividad='+ep['id_actividad'];
		//Actualiza los datastore de los combos para filtrar por EP
		actualizar_ds_combos();
		combo_motivo_salida_cuenta.filterValues[0]=combo_motivo_salida.getValue();
		var id=combo_almacen.getValue();
		combo_almacen_logico.filterValues[0] =  id;
		combo_almacen.modificado=true;
		combo_almacen_logico.modificado=true;
		combo_motivo_salida.modificado=true;
		combo_motivo_salida_cuenta.modificado=true;
		combo_empleado.modificado=true

	};

	//funci�n para terminar la orden de ingreso
	function btn_fin_ped(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		if(NumSelect!=0){
			if(confirm("�Est� seguro de terminar el Pedido?")){
				var SelectionsRecord=sm.getSelected();
				var data=SelectionsRecord.data.id_salida;
				Ext.Ajax.request({
					url:direccion+"../../../control/salida/ActionGuardarSalidaPedidoFin.php?hidden_id_salida_0="+data,
					method:'GET',
					success:terminado,
					failure:Cm_conexionFailure,
					timeout:100000//TIEMPO DE ESPERA PARA DAR FALLO
				})
			}
		}
		else{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
		}
	}

	function terminado(resp){
		Ext.MessageBox.hide();
		Ext.MessageBox.alert('Estado', '<br>Finalizaci�n satisfactoria del Pedido.<br>');
		Cm_btnActualizar()
	}


	//funci�n para verificar y reservar los materailes del pedido
	function btn_ver(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		if(NumSelect!=0){
			if(confirm("�Est� seguro de verficar?\nEste proceso puede tardar varios minutos!")){
				var SelectionsRecord=sm.getSelected();
				Ext.Ajax.request({
					url:direccion+"../../../control/salida/ActionVerificarExistenciasUc.php?id_salida="+SelectionsRecord.data.id_salida+"&id_almacen_logico="+SelectionsRecord.data.id_almacen_logico,
					method:'GET',
					success:verificado,
					failure:Cm_conexionFailure,
					timeout:100000//TIEMPO DE ESPERA PARA DAR FALLO
				})
			}
		}
		else{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
		}
	}

	function verificado(resp){
		Ext.MessageBox.hide();
		var regreso = Ext.util.JSON.decode(resp.responseText);
		if(regreso.mensaje=='true'){
			Ext.MessageBox.alert('Estado', 'Se realizo la verificacion de forma exitosa')
		}
		else{
			alert("reporte de faltantes")
		}
		Cm_btnActualizar()

	}

	function btn_pedido_almacen(){
		datax = "hidden_id_salida=" + Cm_getComponente('id_salida').getValue();
		window.open(direccion+'../../../control/_reportes/pedidos/ActionReportePedidos.php?'+datax)
	}

	function actualizar_ds_combos(){	//actualiza el data store de almac�n y almac�n l�gico en funci�n de la EP seleccionada
		var datos=Ext.urlDecode(decodeURIComponent(data_ep));
		Ext.apply(combo_almacen.store.baseParams,datos);
		Ext.apply(combo_almacen_logico.store.baseParams,datos);
		Ext.apply(combo_motivo_salida.store.baseParams,datos);
		Ext.apply(combo_motivo_salida_cuenta.baseParams,datos);
		Ext.apply(combo_empleado.store.baseParams,datos)
	}

	//Obtener los componentes del formulario
	function InitPaginaSalidaPedido(){
		grid=Cm_getGrid();
		dialog=Cm_getDialog();
		sm=getSelectionModel();
		formulario=Cm_getFormulario();
		for(i=0;i<vectorAtributos.length;i++){
			componentes[i]=Cm_getComponente(vectorAtributos[i].validacion.name)
		}
		CM_ocultarComponente(componentes[5]);//empleado
		CM_ocultarComponente(componentes[7])//instituci�n
	}

	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){
		return layout_orden_ingreso_sol.getLayout()
	};

	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_salida.getLayout()};
	//para el manejo de hijos
	this.getPagina=function(idContenedorHijo){
		var tam_elementos=elementos.length;
		for(i=0;i<tam_elementos;i++){
			if(elementos[i].idContenedor==idContenedorHijo){
				return elementos[i]
			}
		}
	};
	this.Destroy=function(){delete this.pagina;	Cm_Destroy()};
	this.getElementos=function(){return elementos};
	this.setPagina=function(elemento){elementos.push(elemento)};
	//-------------- FIN DEFINICI�N DE FUNCIONES PROPIAS --------------//
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	this.InitFunciones(paramFunciones);
	//para agregar botones
	this.AdicionarBoton('../../../lib/imagenes/detalle.png','Detalle del Pedido',btn_salida_detalle,true,'salida_detalle','');
	this.AdicionarBoton('../../../lib/imagenes/lightning.png','Verificar Existencias Tipo de Unidad Constructiva',btn_ver,true,'vr','');
	this.AdicionarBoton('../../../lib/imagenes/book_next.png','Finalizar el Pedido',btn_fin_ped,true,'ter_ped','');
	this.AdicionarBoton('../../../lib/imagenes/logo_pdf2.bmp','Imprimir Vale',btn_pedido_almacen,true,'rep_ped','');

	this.iniciaFormulario();
	iniciarEventosFormularios();
	InitPaginaSalidaPedido();
	layout_salida.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario)
}