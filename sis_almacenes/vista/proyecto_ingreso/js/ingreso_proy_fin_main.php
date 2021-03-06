<?php 
/**
 * Nombre:		  	    orden_ingreso_sol_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2007-10-17 12:31:23
 *
 */
session_start();
?>
//<script>
function main(){
	<?php
	//obtenemos la ruta absoluta
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$dir = "http://$host$uri/";
	echo "\nvar direccion='$dir';";
	echo "var idContenedor='$idContenedor';";
	?>
	var fa=false;
	<?php if($_SESSION["ss_filtro_avanzado"]!=''){
		echo 'fa='.$_SESSION["ss_filtro_avanzado"].';';
	}
	?>
	var paramConfig={TamanoPagina:20,TiempoEspera:10000,CantFiltros:3,FiltroEstructura:false,FiltroAvanzado:fa};
	var elemento={pagina:new pagina_ingreso_proy(idContenedor,direccion,paramConfig),idContenedor:'<?php echo $idContenedor;?>'};
	ContenedorPrincipal.setPagina(elemento);
}
Ext.onReady(main,main);

/**
* Nombre:		  	    pagina_orden_ingreso_sol.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
* Fecha creaci�n:		2007-10-17 12:31:23
*/
function pagina_ingreso_proy(idContenedor,direccion,paramConfig)
{
	var vectorAtributos=new Array;
	var componentes=new Array();
	var data_ep;
	var ds;
	var elementos=new Array();
	var sw=0;
	var tipo_ord='General';

	var txt_importacion,txt_flete,txt_seguro,txt_gastos_alm,txt_gastos_aduana,txt_iva,txt_rep_form;
	var	txt_peso_neto,txt_tot_import,txt_tot_nacionaliz,cmb_mon_imp,txt_dui,txt_monto_tot_factura,txt_codigo_mot_ing, txt_tipo_costeo;

	/////////////////
	//  DATA STORE //
	/////////////////
	ds = new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/ingreso/ActionListarIngresoProyFin.php'}),
		// aqui se define la estructura del XML
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_ingreso',
			totalRecords: 'TotalCount'

		}, ['id_ingreso',
		'descripcion',
		'costo_total',
		'estado_ingreso',
		'cod_inf_tec',
		'resumen_inf_tec',
		{name: 'fecha_borrador',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_reg',type:'date',dateFormat:'Y-m-d'},
		'id_proveedor',
		'desc_proveedor',
		'id_contratista',
		'desc_contratista',
		'id_empleado',
		'desc_empleado',
		'id_almacen_logico',
		'desc_almacen_logico',
		'id_institucion',
		'desc_institucion',
		'id_motivo_ingreso_cuenta',
		'desc_motivo_ingreso_cuenta',
		'nombre_proveedor',
		'nombre_contratista',
		'nro_cuenta',
		'desc_motivo_ingreso',
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
		'orden_compra',
		'observaciones',
		'id_usuario',
		'contabilizar_tipo_almacen',
		'num_factura',
		{name: 'fecha_factura',type:'date',dateFormat:'Y-m-d'},
		'responsable',
		'correlativo_ing',
		{name: 'fecha_finalizado_cancelado',type:'date',dateFormat:'Y-m-d'},
		'importacion',
		'flete',
		'seguro',
		'gastos_alm',
		'gastos_aduana',
		'iva',
		'rep_form',
		'peso_neto',
		'tot_importacion',
		'tot_nacionaliz',
		'id_moneda_import',
		'id_moneda_nacionaliz',
		'desc_moneda_import',
		'desc_moneda_nacionaliz',
		'dui',
		'monto_tot_factura',
		'codigo_mot_ing',
		'gestion',
		'tipo_costeo'
		]),remoteSort:true
	});

	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros,
			tipo: tipo_ord
		}
	});

	//DATA STORE COMBOS
	ds_almacen = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/almacen/ActionListarAlmacenEP.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_almacen',totalRecords: 'TotalCount'}, ['id_almacen','nombre','descripcion'])});
	ds_almacen_logico = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/almacen_logico/ActionListarAlmacenLogicoFisEPM.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_almacen_logico',totalRecords: 'TotalCount'}, ['id_almacen_logico','nombre','descripcion','desc_tipo_almacen'])});
	ds_proveedor = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_adquisiciones/control/proveedor/ActionListarProveedor.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_proveedor',totalRecords: 'TotalCount'}, ['id_proveedor','codigo','observaciones','fecha_reg','id_institucion','id_persona','desc_persona','nombre_proveedor'])});
	ds_contratista = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/contratista/ActionListarContratista.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_contratista',totalRecords: 'TotalCount'}, ['id_contratista','codigo','observaciones','estado_registro','fecha_reg','id_institucion','id_persona','nombre_contratista','pagina_web','email','direccion'])});
	ds_empleado = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_kardex_personal/control/empleado/ActionListarEmpleadoEP.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_empleado',totalRecords: 'TotalCount'}, ['id_empleado','id_persona','codigo_empleado','desc_persona'])});
	ds_institucion = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/institucion/ActionListarInstitucion.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_institucion',totalRecords: 'TotalCount'}, ['id_institucion','direccion','doc_id','nombre','casilla','telefono1','telefono2','celular1','celular2','fax','email1','email2','pag_web','observaciones','fecha_registro','hora_registro','fecha_ultima_modificacion','hora_ultima_modificacion','estado_institucion','id_persona'])});
	ds_motivo_ingreso_cuenta = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/motivo_ingreso_cuenta/ActionListarMotivoIngresoCuenta.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_motivo_ingreso_cuenta',totalRecords: 'TotalCount'}, ['id_motivo_ingreso_cuenta','desc_cuenta','descripcion','fecha_reg','codigo_ep'])});
	ds_motivo_ingreso = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/motivo_ingreso/ActionListarMotivoIngresoEP.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_motivo_ingreso',totalRecords: 'TotalCount'}, ['id_motivo_ingreso','nombre','descripcion','fecha_reg','tipo'])});
	ds_moneda_import = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/moneda/ActionListarMoneda.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_moneda',totalRecords: 'TotalCount'}, ['id_moneda','nombre','simbolo','estado','prioridad'])});

	//FUNCIONES RENDER
	function render_id_almacen(value, p, record){return String.format('{0}', record.data['desc_almacen']);}
	function render_id_almacen_logico(value, p, record){return String.format('{0}', record.data['desc_almacen_logico']);}
	function render_id_proveedor(value, p, record){return String.format('{0}', record.data['nombre_proveedor']);}
	function render_id_contratista(value, p, record){return String.format('{0}', record.data['nombre_contratista']);}
	function render_id_empleado(value, p, record){return String.format('{0}', record.data['desc_empleado']);}
	function render_id_institucion(value, p, record){return String.format('{0}', record.data['desc_institucion']);}
	function render_id_motivo_ingreso_cuenta(value, p, record){return String.format('{0}', record.data['desc_motivo_ingreso_cuenta']);}
	function render_id_motivo_ingreso(value, p, record){return String.format('{0}', record.data['desc_motivo_ingreso']);}
	function render_id_moneda_import(value, p, record){return String.format('{0}', record.data['desc_moneda_import']);}
	function render_observaciones(value, p, record){return String.format('<b><font color="#FF0000">{0}</font></b>', record.data['observaciones'])}

	//TEMPLATE COMBOS
	var resultTplAlmacen = new Ext.Template('<div class="search-item">','<b><i>{nombre}</i></b>','<br><FONT COLOR="#B5A642">{descripcion}</FONT>','</div>');
	var resultTplAlmacenLogico = new Ext.Template('<div class="search-item">','<b><i>{nombre}</i></b>','<br><FONT COLOR="#B5A642">{descripcion}','<br>{desc_tipo_almacen}</FONT>','</div>');
	var resultTplProveedor = new Ext.Template('<div class="search-item">','<b><i>{codigo}</i></b>','<br><FONT COLOR="#B5A642">{nombre_proveedor}</FONT>','</div>');
	var resultTplContratista = new Ext.Template('<div class="search-item">','<b><i>{nombre_contratista}</i></b>','<br><FONT COLOR="#B5A642">{codigo}','<br>{email}','<br>{direccion}</FONT>','</div>');
	var resultTplInstitucion = new Ext.Template('<div class="search-item">','<b><i>{nombre}</i></b>','<br><FONT COLOR="#B5A642">{email1}','<br>{pag_web}','<br>{direccion}</FONT>','</div>');
	var resultTplEmpleado = new Ext.Template('<div class="search-item">','<b><i>{codigo_empleado}</i></b>','<br><FONT COLOR="#B5A642">{desc_persona}</FONT>','</div>');
	var resultTplMotivoIngreso = new Ext.Template('<div class="search-item">','<b><i>{nombre}</i></b>','<br><FONT COLOR="#B5A642">{descripcion}</FONT>','</div>');
	var resultTplMotivoIngresoCuenta = new Ext.Template('<div class="search-item">','<b><i>{descripcion}</i></b>','<br><FONT COLOR="#B5A642">{desc_cuenta}','<br>{codigo_ep}</FONT>','</div>');
	var resultTplMonedaImport = new Ext.Template('<div class="search-item">','<b>{nombre}</b>','<br><FONT COLOR="#B5A642">S�mbolo: {simbolo}','<br>Prioridad: {prioridad}</FONT>','</div>');

	/////////////////////////
	// Definici�n de datos //
	/////////////////////////
	vectorAtributos[0]={
		validacion:{
			labelSeparator:'',
			fieldLabel:'ID',
			name: 'id_ingreso',
			inputType:'hidden',
			grid_visible:true,
			grid_editable:false,
			grid_indice:1,
			width_grid:40
		},
		tipo: 'Field',
		filtro_0:false,
		save_as:'hidden_id_ingreso',
		id_grupo:0
	};

	filterCols_almacen=new Array();
	filterValues_almacen=new Array();
	vectorAtributos[1]= {
		validacion: {
			fieldLabel:'Almac�n F�sico',
			allowBlank:true,
			emptyText:'Almac�n F�sico...',
			name: 'id_almacen',
			desc: 'desc_almacen',
			store:ds_almacen,
			valueField: 'id_almacen',
			displayField: 'nombre',
			queryParam: 'filterValue_0',
			filterCol:'ALMACE.nombre',
			filterCols:filterCols_almacen,
			filterValues:filterValues_almacen,
			typeAhead:true,
			forceSelection:false,
			tpl: resultTplAlmacen,
			mode:'remote',
			queryDelay:250,
			pageSize:20,
			minListWidth:450,
			grow:true,
			width:300,
			resizable:true,
			minChars:1,
			triggerAction:'all',
			editable:true,
			renderer:render_id_almacen,
			grid_visible:true,
			grid_editable:false,
			grid_indice:4,
			width_grid:100, // ancho de columna en el gris
			disabled:true
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'ALMACE.nombre',
		defecto: '',
		save_as:'txt_id_almacen',
		id_grupo:3
	};

	filterCols_almacen_logico=new Array();
	filterValues_almacen_logico=new Array();
	filterCols_almacen_logico[0]='ALMACE.id_almacen';
	filterValues_almacen_logico[0]='x';
	vectorAtributos[2]= {
		validacion: {
			name:'id_almacen_logico',
			fieldLabel:'Almac�n L�gico',
			allowBlank:false,
			emptyText:'Almac�n L�gico...',
			name: 'id_almacen_logico',
			desc: 'desc_almacen_logico',
			store:ds_almacen_logico,
			valueField: 'id_almacen_logico',
			displayField: 'nombre',
			queryParam: 'filterValue_0',
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
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1,
			triggerAction:'all',
			editable:true,
			renderer:render_id_almacen_logico,
			grid_visible:true,
			grid_editable:false,
			grid_indice:6,
			width_grid:100, // ancho de columna en el gris
			disabled:true
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'ALMLOG.codigo#ALMLOG.nombre',
		defecto: '',
		save_as:'txt_id_almacen_logico',
		id_grupo:3
	};

	vectorAtributos[3]= {
		validacion:{
			name:'descripcion',
			fieldLabel:'Concepto',
			allowBlank:false,
			maxLength:200,
			minLength:0,
			width:'100%',
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:7,
			width_grid:100,
			disabled:true
		},
		tipo: 'TextArea',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'INGRES.descripcion',
		save_as:'txt_descripcion',
		id_grupo:4
	};

	vectorAtributos[4]= {
		validacion:{
			name:'costo_total',
			fieldLabel:'Costo total',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			decimalPrecision :2,
			allowNegative: false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:19,
			width_grid:100,
			disabled:true
		},
		tipo: 'NumberField',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'INGRES.costo_total',
		save_as:'txt_costo_total',
		id_grupo:4
	};

	vectorAtributos[5]= {
		validacion:{
			name:'orden_compra',
			fieldLabel:'N� Contrato/ Ord. Compra',
			allowBlank:true,
			maxLength:20,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:9,
			width_grid:130,
			disabled:true
		},
		tipo: 'TextField',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'INGRES.orden_compra',
		save_as:'txt_orden_compra',
		id_grupo:4
	};

	vectorAtributos[6]= {
		validacion:{
			name:'observaciones',
			fieldLabel:'Observaciones',
			allowBlank:true,
			maxLength:300,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			disabled:false,
			renderer:render_observaciones,
			grid_visible:true,
			grid_editable:false,
			grid_indice:16,
			width_grid:100,
			width:'100%'
		},
		form:true,
		tipo:'TextArea',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'INGRES.observaciones',
		save_as:'txt_observaciones',
		id_grupo:4
	};

	vectorAtributos[7]= {
		validacion:{
			name:'fecha_reg',
			fieldLabel:'Fecha registro',
			allowBlank:true,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:false,
			grid_editable:false,
			grid_indice:32,
			renderer: formatDate,
			width_grid:85,
			disabled:true
		},
		tipo:'DateField',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'INGRES.fecha_reg',
		dateFormat:'m-d-Y',
		defecto:'',
		save_as:'txt_fecha_reg',
		id_grupo:4
	};

	vectorAtributos[8]= {
		validacion: {
			name:'solicitante',
			fieldLabel:'Origen',
			allowBlank:false,
			typeAhead: true,
			loadMask: true,
			triggerAction: 'all',
			//store: new Ext.data.SimpleStore({fields: ['ID','valor'],data : Ext.ingreso_proy_combo.solicitante}),
			store: new Ext.data.SimpleStore({fields: ['ID','valor'],data : [['contratista','Contratista'],['proveedor','Proveedor'],['empleado','Funcionario'],['institucion','Instituci�n']]}),
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			forceSelection:true,
			grid_visible:false,
			grid_editable:false,
			width:300,
			width_grid:60, // ancho de columna en el gris
			disabled:true
		},
		tipo:'ComboBox',
		filtro_0:false,
		filterColValue:'',
		defecto:'Constratista',
		save_as:'',
		id_grupo:1
	};

	vectorAtributos[9]= {
		validacion: {
			name:'id_proveedor',
			fieldLabel:'Proveedor',
			allowBlank:true,
			emptyText:'Proveedor...',
			name: 'id_proveedor',
			desc: 'desc_proveedor',
			store:ds_proveedor,
			valueField: 'id_proveedor',
			displayField: 'nombre_proveedor',
			queryParam: 'filterValue_0',
			filterCol:'PROVEE.codigo#PROVEE.observaciones',
			tpl: resultTplProveedor,
			typeAhead:true,
			forceSelection:true,
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
			renderer:render_id_proveedor,
			grid_visible:true,
			grid_editable:false,
			grid_indice:11,
			width_grid:100, // ancho de columna en el gris
			disabled:true
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'PROVEE.codigo',
		defecto: '',
		save_as:'txt_id_proveedor',
		id_grupo:1
	};

	vectorAtributos[10]= {
		validacion: {
			name:'id_contratista',
			fieldLabel:'Contratista',
			allowBlank:true,
			emptyText:'Contratista...',
			name: 'id_contratista',
			desc: 'desc_contratista',
			store:ds_contratista,
			valueField: 'id_contratista',
			displayField: 'nombre_contratista',
			queryParam: 'filterValue_0',
			filterCol:'CONTRA.codigo#INSTIT.nombre#INSTIT.pag_web#INSTIT.email1#INSTIT.direccion#PERSON.pag_web#INSTIT.email1',
			tpl: resultTplContratista,
			typeAhead:true,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:10,
			minListWidth:450,
			grow:true,
			width:300,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
			triggerAction:'all',
			editable:true,
			renderer:render_id_contratista,
			grid_visible:true,
			grid_editable:false,
			grid_indice:12,
			width_grid:100, // ancho de columna en el gris
			disabled:true
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'CONTRA.codigo',
		defecto: '',
		save_as:'txt_id_contratista',
		id_grupo:1
	};

	vectorAtributos[11]= {
		validacion: {
			name:'id_empleado',
			fieldLabel:'Funcionario',
			allowBlank:true,
			emptyText:'Funcionario...',
			name: 'id_empleado',
			desc: 'desc_empleado',
			store:ds_empleado,
			valueField: 'id_empleado',
			displayField: 'desc_persona',
			queryParam: 'filterValue_0',
			filterCol:'EMPLEA.id_persona#EMPLEA.codigo_empleado#PERSON.nombre#PERSON.apellido_paterno#PERSON.apellido_materno',
			tpl: resultTplEmpleado,
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
			renderer:render_id_empleado,
			grid_visible:true,
			grid_editable:false,
			grid_indice:13,
			width_grid:100, // ancho de columna en el gris
			disabled:true
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'EMPLEA.id_persona',
		defecto: '',
		save_as:'txt_id_empleado',
		id_grupo:1
	};

	vectorAtributos[12]= {
		validacion: {
			name:'id_institucion',
			fieldLabel:'Instituci�n',
			allowBlank:true,
			emptyText:'Instituci�n...',
			name: 'id_institucion',
			desc: 'desc_institucion',
			store:ds_institucion,
			valueField: 'id_institucion',
			displayField: 'nombre',
			queryParam: 'filterValue_0',
			filterCol:'INSTIT.nombre#INSTIT.pag_web#INSTIT.email1#INSTIT.direccion',
			tpl: resultTplInstitucion,
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
			grid_indice:14,
			width_grid:100,
			disabled:true
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'INSTIT.nombre',
		defecto: '',
		save_as:'txt_id_institucion',
		id_grupo:1
	};

	filterCols_motivo_ingreso=new Array();
	filterValues_motivo_ingreso=new Array();
	vectorAtributos[13]= {
		validacion: {
			fieldLabel:'Motivo ingreso',
			allowBlank:true,
			emptyText:'Motivo Ingreso ...',
			name: 'id_motivo_ingreso',
			desc: 'desc_motivo_ingreso',
			store:ds_motivo_ingreso,
			valueField: 'id_motivo_ingreso',
			displayField: 'descripcion',
			queryParam: 'filterValue_0',
			filterCol:'MOTING.nombre',
			tpl:resultTplMotivoIngreso,
			filterCols:filterCols_motivo_ingreso,
			filterValues:filterValues_motivo_ingreso,
			typeAhead:true,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:100,
			minListWidth:450,
			grow:true,
			width:300,
			//grow:true,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
			triggerAction:'all',
			editable:true,
			renderer:render_id_motivo_ingreso,
			grid_visible:true,
			grid_editable:false,
			grid_indice:15,
			width_grid:100, // ancho de columna en el gris
			disabled:true
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'MOTING.nombre',
		defecto: '',
		save_as:'txt_id_motivo_ingreso',
		id_grupo:2
	};

	filterCols_motivo_ingreso_cuenta=new Array();
	filterValues_motivo_ingreso_cuenta=new Array();
	filterCols_motivo_ingreso_cuenta[0]='MOTING.id_motivo_ingreso';
	filterValues_motivo_ingreso_cuenta[0]='%';
	vectorAtributos[14]={
		validacion: {
			name:'id_motivo_ingreso_cuenta',
			fieldLabel:'Cuenta',
			allowBlank:false,
			emptyText:'Cuenta ...',
			name: 'id_motivo_ingreso_cuenta',
			desc: 'desc_motivo_ingreso_cuenta',
			store:ds_motivo_ingreso_cuenta,
			valueField: 'id_motivo_ingreso_cuenta',
			displayField: 'descripcion',
			queryParam: 'filterValue_0',
			filterCol:'MINGCU.descripcion',
			tpl:resultTplMotivoIngresoCuenta,
			filterCols:filterCols_motivo_ingreso_cuenta,
			filterValues:filterValues_motivo_ingreso_cuenta,
			typeAhead:true,
			forceSelection:true,
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
			renderer:render_id_motivo_ingreso_cuenta,
			grid_visible:true,
			grid_editable:false,
			grid_indice:15,
			width_grid:100,
			disabled:true
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'MOINCU.descripcion',
		defecto: '',
		save_as:'txt_id_motivo_ingreso_cuenta',
		id_grupo:2
	};

	vectorAtributos[15]= {
		validacion:{
			fieldLabel: 'EP',
			allowBlank: false,
			vtype:"texto",
			emptyText:'Estructura Program�tica',
			name: 'id_ep',
			minChars: 1,
			triggerAction: 'all',
			editable: false,
			grid_editable:false,
			grid_visible:false,
			grid_indice:14,
			width:300,
			disabled:true
		},
		tipo: 'epField',
		save_as:'hidden_id_ep1',
		id_grupo:0
	}

	vectorAtributos[16]={
		validacion:{
			name:'contabilizar_tipo_almacen',
			fieldLabel:'Contabilizar Tipo Almac�n',
			allowBlank:false,
			maxLength:200,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:false,
			grid_editable:false,
			grid_indice:10,
			align:'center',
			width_grid:100,
			disabled:true
		},
		tipo:'Field',
		save_as:'txt_contabilizar_tipo_almacen',
		id_grupo:0
	};

	vectorAtributos[17]={
		validacion:{
			name:'desc_almacen_logico',
			fieldLabel:'Desc Almacen Logico',
			allowBlank:false,
			maxLength:200,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:false,
			grid_editable:false,
			grid_indice:10,
			align:'center',
			width_grid:100,
			disabled:true
		},
		tipo:'Field',
		save_as:'txt_desc_almacen_logico',
		id_grupo:0
	};

	vectorAtributos[18]={
		validacion:{
			name:'desc_almacen',
			fieldLabel:'Desc Almacen',
			allowBlank:false,
			maxLength:200,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:false,
			grid_editable:false,
			grid_indice:10,
			align:'center',
			width_grid:100,
			disabled:true
		},
		tipo:'Field',
		save_as:'txt_desc_almacen',
		id_grupo:0
	};

	vectorAtributos[19]={
		validacion:{
			name:'estado_ingreso',
			fieldLabel:'Estado ingreso',
			allowBlank:false,
			maxLength:200,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:33,
			align:'center',
			width_grid:100,
			disabled:true
		},
		tipo:'Field',
		save_as:'txt_estado_ingreso',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		id_grupo:4
	};

	vectorAtributos[20]= {
		validacion:{
			name:'num_factura',
			fieldLabel:'Nota de Remisi�n/ Factura',
			allowBlank:false,
			maxLength:30,
			minLength:0,
			width:150,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:8,
			width_grid:130,
			disabled:true
		},
		tipo: 'TextField',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'INGRES.num_factura',
		save_as:'txt_num_factura',
		id_grupo:4
	};

	vectorAtributos[21]= {
		validacion:{
			name:'fecha_factura',
			fieldLabel:'Fecha Factura',
			allowBlank:false,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:true,
			grid_editable:false,
			grid_indice:31,
			renderer: formatDate,
			width_grid:85,
			disabled:true
		},
		tipo:'DateField',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'INGRES.fecha_factura',
		dateFormat:'m-d-Y',
		defecto:'',
		save_as:'txt_fecha_factura',
		id_grupo:4
	};

	vectorAtributos[22]= {
		validacion:{
			name:'responsable',
			fieldLabel:'Entregado por',
			allowBlank:true,
			maxLength:50,
			minLength:0,
			width:'100%',
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:10,
			width_grid:100,
			disabled:true
		},
		tipo: 'TextField',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'INGRES.responsable',
		save_as:'txt_responsable',
		id_grupo:4
	};

	vectorAtributos[23]= {
		validacion:{
			name:'correlativo_ing',
			fieldLabel:'C�digo',
			allowBlank:true,
			maxLength:200,
			minLength:0,
			width:100,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:2,
			width_grid:70,
			disabled:true
		},
		tipo: 'Field',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'INGRES.correlativo_ing',
		save_as:'txt_correlativo_ing',
		id_grupo:0
	};

	vectorAtributos[24]= {
		validacion:{
			name:'fecha_finalizado_cancelado',
			fieldLabel:'Fecha Ingreso',
			allowBlank:true,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:true,
			grid_editable:false,
			grid_indice:5,
			renderer: formatDate,
			width_grid:85,
			disabled:true
		},
		tipo:'DateField',
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'INGRES.fecha_finalizado_cancelado',
		dateFormat:'m-d-Y',
		defecto:'',
		save_as:'txt_fecha_finalizado_cancelado',
		id_grupo:4
	};

	vectorAtributos[25]= {
		validacion:{
			name:'peso_neto',
			fieldLabel:'Peso Neto(kg)',
			allowBlank:true,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:true,
			decimalPrecision :2,
			allowNegative: false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:20,
			width_grid:100,
			align:'right'
		},
		tipo: 'NumberField',
		filtro_0:false,
		save_as:'txt_peso_neto',
		id_grupo:5
	};

	vectorAtributos[26]= {
		validacion: {
			fieldLabel:'Moneda Importaci�n',
			allowBlank:false,
			emptyText:'Moneda importaci�n ...',
			name: 'id_moneda_import',
			desc: 'desc_moneda_import',
			store:ds_moneda_import,
			valueField: 'id_moneda',
			displayField: 'nombre',
			queryParam: 'filterValue_0',
			filterCol:'MONEDA.nombre',
			tpl:resultTplMonedaImport,
			typeAhead:true,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:10,
			minListWidth:450,
			grow:true,
			width:300,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
			triggerAction:'all',
			editable:true,
			renderer:render_id_moneda_import,
			grid_visible:true,
			grid_editable:false,
			grid_indice:18,
			width_grid:100, // ancho de columna en el grid
		},
		tipo:'ComboBox',
		filtro_0:false,
		save_as:'txt_id_moneda_import',
		id_grupo:5
	};

	vectorAtributos[27]= {
		validacion:{
			name:'importacion',
			fieldLabel:'Importaci�n',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:true,
			decimalPrecision :2,
			allowNegative: false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:21,
			width_grid:100,
			align:'right',
			renderer: 'usMoney'
		},
		tipo: 'NumberField',
		filtro_0:false,
		save_as:'txt_importacion',
		id_grupo:5
	};

	vectorAtributos[28]= {
		validacion:{
			name:'flete',
			fieldLabel:'Flete',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:true,
			decimalPrecision :2,
			allowNegative: false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:22,
			width_grid:100,
			align:'right',
			renderer: 'usMoney'
		},
		tipo: 'NumberField',
		filtro_0:false,
		save_as:'txt_flete',
		id_grupo:5
	};

	vectorAtributos[29]= {
		validacion:{
			name:'seguro',
			fieldLabel:'Seguro',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:true,
			decimalPrecision :2,
			allowNegative: false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:23,
			width_grid:100,
			align:'right',
			renderer: 'usMoney'
		},
		tipo: 'NumberField',
		filtro_0:false,
		save_as:'txt_seguro',
		id_grupo:5
	};

	vectorAtributos[30]= {
		validacion:{
			name:'dui',
			fieldLabel:'DUI',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			width:'40%',
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:17,
			width_grid:100
		},
		tipo: 'TextField',
		filtro_0:true,
		filterColValue:'INGRES.dui',
		save_as:'txt_dui',
		id_grupo:6
	};

	vectorAtributos[31]= {
		validacion:{
			name:'gastos_alm',
			fieldLabel:'Gastos Almacenaje',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:true,
			decimalPrecision :2,
			allowNegative: false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:24,
			width_grid:100,
			align:'right',
			renderer: 'usMoney'
		},
		tipo: 'NumberField',
		filtro_0:false,
		save_as:'txt_gastos_alm',
		id_grupo:6
	};

	vectorAtributos[32]= {
		validacion:{
			name:'gastos_aduana',
			fieldLabel:'Gastos Aduana',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:true,
			decimalPrecision :2,
			allowNegative: false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:25,
			width_grid:100,
			align:'right',
			renderer: 'usMoney'
		},
		tipo: 'NumberField',
		filtro_0:false,
		save_as:'txt_gastos_aduana',
		id_grupo:6
	};

	vectorAtributos[33]= {
		validacion:{
			name:'iva',
			fieldLabel:'IVA',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:true,
			decimalPrecision :2,
			allowNegative: false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:26,
			width_grid:100,
			align:'right',
			renderer: 'usMoney'
		},
		tipo: 'NumberField',
		filtro_0:false,
		save_as:'txt_iva',
		id_grupo:6
	};

	vectorAtributos[34]= {
		validacion:{
			name:'rep_form',
			fieldLabel:'Reposici�n Formulario',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:true,
			decimalPrecision :2,
			allowNegative: false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:27,
			width_grid:100,
			align:'right',
			renderer: 'usMoney'
		},
		tipo: 'NumberField',
		filtro_0:false,
		save_as:'txt_rep_form',
		id_grupo:6
	};

	vectorAtributos[35]= {
		validacion:{
			name:'tot_importacion',
			fieldLabel:'Total Importaci�n',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:true,
			decimalPrecision :2,
			allowNegative: false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:28,
			width_grid:100,
			disabled:true,
			align:'right',
			renderer: 'usMoney'
		},
		tipo: 'NumberField',
		filtro_0:false,
		save_as:'txt_tot_importacion',
		id_grupo:5
	};

	vectorAtributos[36]= {
		validacion:{
			name:'tot_nacionaliz',
			fieldLabel:'Total Nacionalizaci�n',
			allowBlank:true,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:true,
			decimalPrecision :2,
			allowNegative: false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:29,
			width_grid:100,
			disabled:true,
			align:'right',
			renderer: 'usMoney'
		},
		tipo: 'NumberField',
		filtro_0:false,
		save_as:'txt_tot_nacionaliz',
		id_grupo:6
	};

	vectorAtributos[37]= {
		validacion:{
			name:'monto_tot_factura',
			fieldLabel:'Total Factura (Bs)',
			allowBlank:true,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:true,
			decimalPrecision :2,
			allowNegative: false,
			minValue:0,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			grid_indice:30,
			width_grid:100,
			align:'right'
		},
		tipo: 'NumberField',
		filtro_0:false,
		save_as:'txt_monto_tot_factura',
		id_grupo:7
	};

	vectorAtributos[38]={
		validacion:{
			name:'codigo_mot_ing',
			fieldLabel:'C�digo Motivo Ingreso',
			allowBlank:false,
			maxLength:200,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:false,
			grid_editable:false,
			grid_indice:10,
			align:'center',
			width_grid:100
		},
		tipo:'Field',
		save_as:'txt_codigo_mot_ing',
		id_grupo:0
	};

	vectorAtributos[39]={
		validacion:{
			name: 'gestion',
			fieldLabel:'Gesti�n',
			grid_visible:true,
			grid_editable:false,
			grid_indice:3,
			width_grid:50
		},
		tipo: 'Field',
		form:false,
		filtro_0:true,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'PARALM.gestion',
		save_as:'gestion'
	};
	
	vectorAtributos[40]= {
		validacion: {
			name:'tipo_costeo',
			fieldLabel:'Tipo Costeo',
			allowBlank:false,
			typeAhead: true,
			loadMask: true,
			triggerAction: 'all',
			store: new Ext.data.SimpleStore({fields: ['ID','valor'],data : [['peso','peso'],['precio','precio']]}),
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			forceSelection:true,
			grid_visible:false,
			grid_editable:false,
			width:300,
			width_grid:60 // ancho de columna en el gris
		},
		tipo:'ComboBox',
		filtro_0:false,
		filtro_1:true,
		filtro_2:true,
		filterColValue:'',
		defecto:'peso',
		save_as:'txt_tipo_costeo',
		id_grupo: 8
	};





	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	function formatDate(value){
		return value ? value.dateFormat('d/m/Y') : '';
	};

	//////////////////////////////////////////////////////////////
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
	//////////////////////////////////////////////////////////////
	//Inicia Layout
	var config = {
		titulo_maestro:'Solicitud Orden Ingreso',
		grid_maestro:'grid-'+idContenedor
	};
	layout_orden_ingreso_sol=new DocsLayoutMaestro(idContenedor);
	layout_orden_ingreso_sol.init(config);

	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////

	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina = Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,ds,layout_orden_ingreso_sol,idContenedor);
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
	var getSelectionModel=this.getSelectionModel;
	var ClaseMadre_getComponente=this.getComponente;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_btnNew=this.btnNew;
	var ClaseMadre_btnEdit=this.btnEdit;
	var ClaseMadre_onResize=this.onResize;
	var ClaseMadre_btnActualizar = this.btnActualizar;
	var ClaseMadre_getGrid=this.getGrid;
	var ClaseMadre_getDialog=this.getDialog;
	var ClaseMadre_getFormulario=this.getFormulario;
	var CM_mostrarComponente=this.mostrarComponente;
	var CM_ocultarComponente=this.ocultarComponente;
	var CM_EnableSelect=this.EnableSelect;
	var CM_ocultarGrupo=this.ocultarGrupo;
	var CM_mostrarGrupo=this.mostrarGrupo;

	///////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	///////////////////////////////////

	var paramMenu={
		//guardar:{crear:true,separador:false},
		//nuevo:{crear:true,separador:true},
		editar:{crear:true,separador:false},
		//eliminar:{crear:true,separador:false},
		actualizar:{crear:true,separador:false}
	};


	//////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////

	//datos necesarios para el filtro
	var paramFunciones = {
		btnEliminar:{url:direccion+'../../../control/ingreso/ActionEliminarIngreso.php',parametros:'&tipo='+tipo_ord},
		Save:{url:direccion+'../../../control/ingreso/ActionGuardarDatosValIng.php',parametros:'&tipo='+tipo_ord},
		ConfirmSave:{url:direccion+'../../../control/ingreso/ActionGuardarOrdenIngresoProy.php',parametros:'&tipo='+tipo_ord},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,height:'60%',width:'50%',
		columnas:['96%'],
		grupos:[
		{tituloGrupo:'Estructura Program�tica',columna:0,id_grupo:0},
		{tituloGrupo:'Origen Orden Ingreso',columna:0,id_grupo:1},
		{tituloGrupo:'Motivo de Ingreso',columna:0,id_grupo:2},
		{tituloGrupo:'Almac�n',columna:0,id_grupo:3},
		{tituloGrupo:'Datos ingreso',columna:0,id_grupo:4},
		{tituloGrupo:'Valoraci�n I: Importaci�n',columna:0,id_grupo:5},
		{tituloGrupo:'Valoraci�n II: Nacionalizaci�n',columna:0,id_grupo:6},
		{tituloGrupo:'Valoraci�n',columna:0,id_grupo:7},
		{tituloGrupo:'Tipo Costeo',columna:0,id_grupo:8}
		],
		minWidth:150,minHeight:200,	closable:true,titulo:'Solicitud Orden Ingreso'}
	};

	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//

	function btn_ingreso_proy_det(){
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
			data=data+'&m_contabilizar_tipo_almacen='+SelectionsRecord.data.contabilizar_tipo_almacen;

			var ParamVentana={Ventana:{width:'90%',height:'80%'}}
			layout_orden_ingreso_sol.loadWindows(direccion+'../../../vista/orden_ingreso_sol_det/orden_ingreso_sol_det_fin.php?'+data,'Detalle Ingreso',ParamVentana);
			layout_orden_ingreso_sol.getVentana().on('resize',function(){
				layout_orden_ingreso_sol.getLayout().layout()
			})
		}
		else{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		}
	}

	//funci�n para la Valoraci�n de los Ingresos
	function btn_val_ing(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		if(NumSelect!=0){
			if(confirm("�Est� seguro de ejecutar la Valoraci�n de Ingresos?")){
				var SelectionsRecord=sm.getSelected();
				var data=SelectionsRecord.data.id_ingreso
				Ext.Ajax.request({
					url:direccion+"../../../control/ingreso/ActionValorarIngreso.php?hidden_id_ingreso_0="+data,
					method:'GET',
					success:finval,
					failure:ClaseMadre_conexionFailure,
					timeout:100000//TIEMPO DE ESPERA PARA DAR FALLO
				});
			}
		}
		else{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
		}
	}

	function finval(resp){
		Ext.MessageBox.hide();
		Ext.MessageBox.alert('Estado', '<br>Valoraci�n realizada con �xito.<br>');
		ClaseMadre_btnActualizar()

	}

	function iniciarEventosFormularios(){
		txt_importacion = ClaseMadre_getComponente('importacion');
		txt_flete = ClaseMadre_getComponente('flete');
		txt_seguro = ClaseMadre_getComponente('seguro');
		txt_gastos_alm = ClaseMadre_getComponente('gastos_alm');
		txt_gastos_aduana = ClaseMadre_getComponente('gastos_aduana');
		txt_iva = ClaseMadre_getComponente('iva');
		txt_rep_form = ClaseMadre_getComponente('rep_form');
		txt_peso_neto = ClaseMadre_getComponente('peso_neto');
		txt_tot_import = ClaseMadre_getComponente('tot_importacion');
		txt_tot_nacionaliz = ClaseMadre_getComponente('tot_nacionaliz');
		cmb_mon_imp=ClaseMadre_getComponente('id_moneda_import');
		txt_dui = ClaseMadre_getComponente('dui');
		txt_monto_tot_factura = ClaseMadre_getComponente('monto_tot_factura');
		txt_codigo_mot_ing = ClaseMadre_getComponente('codigo_mot_ing');
		txt_tipo_costeo = ClaseMadre_getComponente('tipo_costeo');
		

		var onActTotalImportacion = function (e){
			var vimport=isNaN(parseFloat(txt_importacion.getValue())) ? 0: parseFloat(txt_importacion.getValue());
			var vflete=isNaN(parseFloat(txt_flete.getValue())) ? 0 : parseFloat(txt_flete.getValue());
			var vseguro=isNaN(parseFloat(txt_seguro.getValue())) ? 0 : parseFloat(txt_seguro.getValue());

			txt_tot_import.setValue(vimport + vflete + vseguro);
		};

		var onActTotalNacionaliz = function (e){
			var vgastos_alm=isNaN(parseFloat(txt_gastos_alm.getValue())) ? 0: parseFloat(txt_gastos_alm.getValue());
			var vgastos_aduana=isNaN(parseFloat(txt_gastos_aduana.getValue())) ? 0 : parseFloat(txt_gastos_aduana.getValue());
			var viva=isNaN(parseFloat(txt_iva.getValue())) ? 0 : parseFloat(txt_iva.getValue());
			var vrep_form=isNaN(parseFloat(txt_rep_form.getValue())) ? 0 : parseFloat(txt_rep_form.getValue());

			txt_tot_nacionaliz.setValue(vgastos_alm+vgastos_aduana+viva+vrep_form);
		};

		txt_importacion.on('blur',onActTotalImportacion);
		txt_flete.on('blur',onActTotalImportacion);
		txt_seguro.on('blur',onActTotalImportacion);
		txt_gastos_alm.on('blur',onActTotalNacionaliz);
		txt_gastos_aduana.on('blur',onActTotalNacionaliz);
		txt_iva.on('blur',onActTotalNacionaliz);
		txt_rep_form.on('blur',onActTotalNacionaliz);
	}

	//Sobrecarga del edit, para desplegar el origen del ingreso
	this.btnEdit = function()
	{
		var sm=getSelectionModel();
		var NumSelect=sm.getCount();
		var SelectionsRecord=sm.getSelected();

		CM_ocultarGrupo('Estructura Program�tica');
		CM_ocultarGrupo('Origen Orden Ingreso');
		CM_ocultarGrupo('Motivo de Ingreso');
		CM_ocultarGrupo('Almac�n');
		CM_ocultarGrupo('Datos ingreso');
		CM_ocultarGrupo('Valoraci�n I: Importaci�n');
		CM_ocultarGrupo('Valoraci�n II: Nacionalizaci�n');
		CM_ocultarGrupo('Valoraci�n');
		CM_ocultarGrupo('Tipo Costeo');

		if(NumSelect!=0)
		{
			if(SelectionsRecord.data.codigo_mot_ing=='IMP')
			{
					CM_mostrarGrupo('Valoraci�n I: Importaci�n');
					CM_mostrarGrupo('Valoraci�n II: Nacionalizaci�n');
					cmb_mon_imp.allowBlank=false;
					txt_importacion.allowBlank=false;
					txt_flete.allowBlank=false;
					txt_seguro.allowBlank=false;					
					txt_dui.allowBlank=false;
					txt_gastos_alm.allowBlank=false;
					txt_gastos_aduana.allowBlank=false;
					txt_iva.allowBlank=false;
					txt_rep_form.allowBlank=false;
			}
			else
			{
					CM_mostrarGrupo('Valoraci�n');
					cmb_mon_imp.allowBlank=true;
					txt_importacion.allowBlank=true;
					txt_flete.allowBlank=true;
					txt_seguro.allowBlank=true;					
					txt_dui.allowBlank=true;
					txt_gastos_alm.allowBlank=true;
					txt_gastos_aduana.allowBlank=true;
					txt_iva.allowBlank=true;
					txt_rep_form.allowBlank=true;
			}
			CM_mostrarGrupo('Tipo Costeo');
			ClaseMadre_btnEdit()
		}
		else
		{
			Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
		}
	};

	function btn_nota_ingreso(){
		var idIngreso = ClaseMadre_getComponente('id_ingreso').getValue();

		/*var n = getSm().getSelectedNode();
		if(n){*/
		if(idIngreso!=''){
			var data='maestro_id_ingreso='+idIngreso;
			
			window.open(direccion+'../../../control/_reportes/ingresos_fisico/ActionIngresos.php?'+data)
		}
		else{
			Ext.MessageBox.alert('Estado', 'Debe seleccionar una salida.')
		}
	}

	function btn_ingreso_val(){
		var idIngreso = ClaseMadre_getComponente('id_ingreso').getValue();
		if(idIngreso!=''){
			var data='maestro_id_ingreso='+idIngreso;
			window.open(direccion+'../../../control/_reportes/ingresos_fisico/ActionIngresosValorado.php?'+data)
		}
		else{
			Ext.MessageBox.alert('Estado', 'Debe seleccionar una salida.')
		}
	}

	function actualizar_ds_combos(){
		var datos=Ext.urlDecode(decodeURIComponent(data_ep));
		Ext.apply(combo_almacen.store.baseParams,datos);
		Ext.apply(combo_almacen_logico.store.baseParams,datos)
		Ext.apply(combo_motivo_ingreso.store.baseParams,datos)
		Ext.apply(combo_motivo_ingreso_cuenta.baseParams,datos)
		Ext.apply(combo_empleado.store.baseParams,datos)
	}

	//Obtener los componentes del formulario
	function InitPaginaIngresoSolicitud()
	{
		grid=ClaseMadre_getGrid();
		dialog=ClaseMadre_getDialog();
		sm=getSelectionModel();
		formulario=ClaseMadre_getFormulario();
		for(i=0;i<vectorAtributos.length;i++){
			componentes[i]=ClaseMadre_getComponente(vectorAtributos[i].validacion.name);
		}

		CM_ocultarComponente(componentes[4]);//Costo total
		CM_ocultarComponente(componentes[7]);//Fecha reg
		CM_ocultarComponente(componentes[9]);//Id proveedor
		CM_ocultarComponente(componentes[11]);//Id empleado
		CM_ocultarComponente(componentes[12])//Id instituci�n
	}
	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){
		return layout_orden_ingreso_sol.getLayout()
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
	this.AdicionarBoton('../../../lib/imagenes/detalle.png','Detalle Ingreso',btn_ingreso_proy_det,true,'ingreso_proy_det','');
	this.AdicionarBoton('../../../lib/imagenes/logo_pdf2.bmp','Imprimir Nota de Ingreso',btn_nota_ingreso,true,'rep_ing','');
	this.AdicionarBoton('../../../lib/imagenes/script_gear.png','Valoraci�n del Ingreso',btn_val_ing,true,'val_ing','');
	this.AdicionarBoton('../../../lib/imagenes/logo_pdf2.bmp','Imprimir Ingreso Valorado',btn_ingreso_val,true,'rep_ing_val','');
	//this.AdicionarBoton('../../../lib/imagenes/book_next.png','Finalizar Ingreso',btn_fin_ord_ing,true,'term_solicitud','');

	this.iniciaFormulario();
	iniciarEventosFormularios();
	InitPaginaIngresoSolicitud();
	layout_orden_ingreso_sol.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}