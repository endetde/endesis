<?php 
session_start();
?>
//<script>
function PaginaActivoFijo()
{	var vectorAtributos = new Array;
var sw=0;
var ds, combo_tipo_activo,	combo_sub_tipo_activo, h_txt_vida_util_origina,	h_txt_vida_util_restante, h_txt_tasa_depreciacion, h_txt_nombre_moneda,	h_txt_id_moneda,
h_txt_monto_compra_mon_orig, h_txt_monto_compra, h_txt_tipo_cambio,	h_txt_monto_actual,	h_txt_fecha_reg, combo_moneda_original,	combo_con_garantia,	h_txt_num_poliza_garantia,
h_txt_fecha_fin_gar, h_txt_fecha_ini_dep, h_txt_fecha_compra, h_txt_orden_compra, 	h_txt_codigo ;
//Configuraci�n p�gina
var paramConfig = {
	TamanoPagina:15, //para definir el tama�o de la p�gina
	TiempoEspera:10000,//tiempo de espera para dar fallo
	CantFiltros:2,//indica la cantidad de filtros que se tendr�n
	FiltroEstructura:true,//indica si se tiene los 5 combos que la filtra la estructura program�tica
	FiltroAvanzado:<?php echo $_SESSION["ss_filtro_avanzado"];?>,
	grid_html:'ext-grid'
};
//  DATA STORE      		//
// creaci�n del Data Store
<?php
//obtenemos la ruta absoluta
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$dir = "http://$host$uri/";
?>
ds = new Ext.data.Store({
	// asigna url de donde se cargaran los datos
	proxy: new Ext.data.HttpProxy({url: '<?php echo $dir?>../../../control/activo_fijo/ActionListaActivoFijo.php'}),
	// aqui se define la estructura del XML
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_activo_fijo',
		totalRecords: 'TotalCount'
	}, [
	// define el mapeo de XML a las etiquetas (campos)
	{name: 'descripcion', type: 'string'},
	'id_activo_fijo',
	'codigo',
	'descripcion',
	'descripcion_larga',
	'vida_util_original',
	'vida_util_restante',
	'tasa_depreciacion',
	{name: 'fecha_ultima_deprec', type: 'date', dateFormat: 'Y-m-d'}, //dateFormat en este caso es el formato en que lee desde el archivo XML
	'depreciacion_acum_ant',
	'depreciacion_acum',
	'depreciacion_periodo',
	'flag_revaloriz',
	'valor_rescate',
	{name: 'fecha_compra', type: 'date', dateFormat: 'Y-m-d'}, //dateFormat en este caso es el formato en que lee desde el archivo XML
	'monto_compra_mon_orig',
	'monto_compra',
	'monto_actual',
	'con_garantia',
	'num_poliza_garantia',
	{name: 'fecha_fin_gar', type: 'date', dateFormat: 'Y-m-d'}, //dateFormat en este caso es el formato en que lee desde el archivo XML
	{name: 'fecha_reg', type: 'date', dateFormat: 'Y-m-d'}, //dateFormat en este caso es el formato en que lee desde el archivo XML
	//'foto_activo',
	'num_factura',
	'tipo_cambio',
	'estado',
	'observaciones',
	'id_sub_tipo_activo',
	'id_institucion',
	'id_moneda',
	'id_moneda_original',
	'id_unidad_constructiva',
	'desc_tipo_activo',
	'desc_sub_tipo_activo',
	'desc_unidad_constructiva',
	'id_tipo_activo',
	'nombre_moneda',
	'nombre_moneda_orig',
	'simbolo_moneda',
	'simbolo_moneda_orig',
	'nombre_institucion',
	{name: 'fecha_ini_dep', type: 'date', dateFormat: 'Y-m-d'},//dateFormat en este caso es el formato en que lee desde el archivo XML
	'ubicacion_fisica',
	'orden_compra',
    'id_estado_funcional',
    'desc_estado_funcional',
	'responsable',
	'monto_compra_2',
	'monto_actual_2',
	'depreciacion_acum_2',
	'depreciacion_acum_ant_2',
	'depreciacion_periodo_2',
	'vida_util_2'
	
	]),
	remoteSort: true // metodo de ordenacion remoto
});

//carga los datos desde el archivo XML declarado en el Data Store
ds.load({
	params:{
		start:0,
		limit: paramConfig.TamanoPagina,
		CantFiltros:paramConfig.CantFiltros
	}
});
// ------------------  PAR�METROS --------------------------//
// Definici�n de todos los tipos de datos que se maneja    //
/////DATA STORE COMBOS////////////
ds_unidad_constructiva = new Ext.data.Store({
	// asigna url de donde se cargaran los datos
	proxy: new Ext.data.HttpProxy({url: '../../control/unidad_constructiva/ActionListaUnidadConstructiva.php'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_unidad_constructiva',
		totalRecords: 'TotalCount'

	}, ['id_unidad_constructiva','descripcion'])

});
ds_tipo_activo = new Ext.data.Store({
	// asigna url de donde se cargaran los datos
	proxy: new Ext.data.HttpProxy({url: '../../control/tipo_activo/ActionListaTipoActivo.php'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_tipo_activo',
		totalRecords: 'TotalCount'

	}, ['id_tipo_activo','descripcion','codigo'])

});
ds_sub_tipo_activo = new Ext.data.Store({
	// asigna url de donde se cargaran los datos

	proxy: new Ext.data.HttpProxy({url: '../../control/sub_tipo_activo/ActionListaSubtipoActivo.php'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_regional',
		totalRecords: 'TotalCount'

	}, ['id_sub_tipo_activo','descripcion','codigo','correlativo_act'])//,
});
ds_moneda_orig = new Ext.data.Store({
	// asigna url de donde se cargaran los datos

	proxy: new Ext.data.HttpProxy({url: '../../../sis_parametros/control/moneda/ActionListaMoneda.php'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_moneda',
		totalRecords: 'TotalCount'

	}, ['id_moneda','nombre'])//,
});
ds_moneda_princ = new Ext.data.Store({
	// asigna url de donde se cargaran los datos
	proxy: new Ext.data.HttpProxy({url: '../../../sis_parametros/control/moneda/ActionListaMoneda.php'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_moneda',
		totalRecords: 'TotalCount'

	}, ['id_moneda','nombre'])//,
});

ds_estado_funcional = new Ext.data.Store({
	// asigna url de donde se cargaran los datos
	proxy: new Ext.data.HttpProxy({url: '../../control/estado_funcional/ActionListaEstadoFuncional.php'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_estado_funcional',
		totalRecords: 'TotalCount'

	}, ['id_estado_funcional','descripcion'])//,
});
////////////////FUNCIONES RENDER ////////////
function renderUnidadConstructiva(value, p, record){return String.format('{0}', record.data['desc_unidad_constructiva']);}
function renderTipoActivo(value, p, record){return String.format('{0}', record.data['desc_tipo_activo']);}
function renderSubtipoActivo(value, p, record){return String.format('{0}', record.data['desc_sub_tipo_activo']);}
function renderMonedaOrig(value, p, record){return String.format('{0}', record.data['nombre_moneda_orig']);}
function renderEstadoFuncional(value, p, record){return String.format('{0}', record.data['desc_estado_funcional']);}
/////////// hidden id_tipo_activo//////
//en la posici�n 0 siempre tiene que estar la llave primaria
var paramId_activo_fijo = {
	validacion:{
		//fieldLabel: 'Id',
		labelSeparator:'',
		name: 'id_activo_fijo',
		inputType:'hidden',
		grid_visible:false, // se muestra en el grid
		grid_editable:false //es editable en el grid
	},
	tipo: 'Field',
	filtro_0:false,
	save_as:'hidden_id_activo_fijo'
}
vectorAtributos[0] = paramId_activo_fijo;
/////////// hidden_id_unidad_constructiva//////
/*var paramId_unidad_constructiva = {
validacion:{
fieldLabel: 'Unidad Constructiva',
allowBlank: true,
vtype:"texto",
emptyText:'Unidad Constructiva...',
name: 'id_unidad_constructiva',     //indica la columna del store principal "ds" del que proviane el id
desc: 'desc_unidad_constructiva', //indica la columna del store principal "ds" del que proviane la descripcion
store:ds_unidad_constructiva,
valueField: 'id_unidad_constructiva',
displayField: 'descripcion',
queryParam: 'filterValue_0',
filterCol:'descripcion',
typeAhead: true,
forceSelection: false,
mode: 'remote',
queryDelay: 50,
pageSize: 10,
minListWidth : 300,
resizable: true,
queryParam: 'filterValue_0',
minChars : 1, ///caracteres m�nimos requeridos para iniciar la busqueda
triggerAction: 'all',
renderer: renderUnidadConstructiva,
grid_visible:true, // se muestra en el grid
grid_editable:false, //es editable en el grid,
width_grid:120, // ancho de columna en el gris
grid_indice:5
},
tipo: 'ComboBox',
save_as:'hidden_id_unidad_constructiva'
}
vectorAtributos[1] = paramId_unidad_constructiva;*/
////////// txt orden_compra//////
var paramOrden_compra= {
	validacion:{
		name: 'orden_compra',
		fieldLabel: 'Orden de Compra',
		allowBlank: true,
		selectOnFocus:true,
		vtype:"texto",
		maxLength:20,
		minLength:0,
		width: 100,
		grid_visible:true, // se muestra en el grid
		grid_editable:true, //es editable en el grid,
		width_grid:120, // ancho de columna en el grid
		//grid_indice:21
		grid_indice:7
	},
	tipo: 'TextField',
	filtro_0:true,
	filterColValue:'AF.orden_compra',
	filtro_1:true,
	save_as:'txt_orden_compra',
	id_grupo: 1
}
vectorAtributos[1] = paramOrden_compra;

/////////// hidden_id_tipo_activo//////
var paramId_tipo_activo = {
	validacion:{
		fieldLabel: 'Tipo',
		allowBlank: false,
		vtype:"texto",
		emptyText:'Tipo de Activo...',
		name: 'id_tipo_activo',     //indica la columna del store principal "ds" del que proviane el id
		desc: 'desc_tipo_activo',//'codigo', //indica la columna del store principal "ds" del que proviane la descripcion
		store:ds_tipo_activo,
		valueField: 'id_tipo_activo',
		displayField: 'descripcion',
		queryParam: 'filterValue_0',
		filterCol:'codigo',
		typeAhead: true,
		forceSelection : true,
		mode: 'remote',
		queryDelay: 50,
		pageSize: 10,
		minListWidth : 300,
		resizable: true,
		queryParam: 'filterValue_0',
		minChars : 1, ///caracteres m�nimos requeridos para iniciar la busqueda
		triggerAction: 'all',
		renderer: renderTipoActivo,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:200, // ancho de columna en el gris
		//grid_indice:3
		grid_indice:13
	},
	tipo: 'ComboBox',
	filtro_0:true,
	save_as:'hidden_id_tipo_activo',
	filterColValue:'TIP.descripcion'
}
vectorAtributos[2] = paramId_tipo_activo;

filterCols_sub_tipo_activo = new Array();
filterValues_sub_tipo_activo= new Array();
filterCols_sub_tipo_activo[0] = 'tip.id_tipo_activo';
filterValues_sub_tipo_activo[0] = '%';
/////////// txt sub_tipo_activo//////
var paramId_sub_tipo_activo = {
	validacion:{
		fieldLabel: 'Subtipo',
		allowBlank: false,
		vtype:"texto",
		emptyText:'Subtipo...',
		name: 'id_sub_tipo_activo',     //indica la columna del store principal "ds" del que proviane el id
		desc: 'desc_sub_tipo_activo', //indica la columna del store principal "ds" del que proviane la descripcion
		store:ds_sub_tipo_activo,
		valueField: 'id_sub_tipo_activo',//'id_sub_tipo_activo',
		displayField: 'descripcion',//'codigo',
		queryParam: 'filterValue_0',
		filterCol:'sub.codigo',
		filterCols:filterCols_sub_tipo_activo,
		filterValues:filterValues_sub_tipo_activo,
		typeAhead: true,
		forceSelection : true,
		mode: 'remote',
		queryDelay: 50,
		pageSize: 10,
		minListWidth : 300,
		resizable: true,
		queryParam: 'filterValue_0',
		minChars : 1, ///caracteres minismo requeridos para iniciar la busqueda
		triggerAction: 'all',
		editable : true,
		renderer: renderSubtipoActivo,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:200, // ancho de columna en el gris
		//grid_indice:4
		grid_indice:14
	},
	tipo: 'ComboBox',
	save_as:'hidden_id_sub_tipo_activo'
}
vectorAtributos[3] = paramId_sub_tipo_activo;
/////////// txt codigo//////
var paramCodigo = {
	validacion:{
		name: 'codigo',
		fieldLabel: 'C�digo',
		allowBlank: false,
		maxLength:10,
		minLength:0,
		selectOnFocus:true,
		//vtype:"alphaLatino",
		vtype:"texto",
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:120, // ancho de columna en el gris
		disabled: true,
		grid_indice:0
	},
	tipo: 'TextField',
	filtro_0:true,
	filterColValue:'AF.codigo',
	filtro_1:true,
	save_as:'txt_codigo',
	id_grupo: 0
}
vectorAtributos[4] = paramCodigo;
/////////// txt descripcion//////
var paramDescripcion = {
	validacion:{
		name: 'descripcion',
		fieldLabel: 'Denominaci�n',
		allowBlank: false,
		maxLength:30,
		minLength:0,
		selectOnFocus:true,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: '100%',
		grid_visible:true, // se muestra en el grid
		grid_editable:true, //es editable en el grid,
		width_grid:200, // ancho de columna en el grid
		grid_indice:1
	},
	tipo: 'TextField',
	filtro_0:true,
	filterColValue:'AF.descripcion',
	filtro_1:true,
	save_as:'txt_descripcion',
	id_grupo: 0
}
vectorAtributos[5] = paramDescripcion;
////////// txt descripcion larga//////
var paramDescripcion_larga = {
	validacion:{
		name: 'descripcion_larga',
		fieldLabel: 'Descripci�n',
		allowBlank: true,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: '100%',
		grow: true,
		grid_visible:true, // se muestra en el grid
		grid_editable:true, //es editable en el grid,
		width_grid:350, // ancho de columna en el grid
		grid_indice:2
	},
	tipo: 'TextArea',
	filtro_0:true,
	filterColValue:'AF.descripcion_larga',
	filtro_1:true,
	save_as:'txt_descripcion_larga',
	id_grupo: 0
}
vectorAtributos[6] = paramDescripcion_larga;
////////// txt ubicacion fisica//////
var paramUbicacion_fisica = {
	validacion:{
		name: 'ubicacion_fisica',
		fieldLabel: 'Ubicaci�n f�sica',
		allowBlank: true,
		maxLength:300,
		minLength:0,
		selectOnFocus:true,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: '100%',
		grow: true,
		grid_visible:true, // se muestra en el grid
		grid_editable:true, //es editable en el grid,
		width_grid:250, // ancho de columna en el grid
		//grid_indice:6
		grid_indice:9
	},
	tipo: 'TextArea',
	filtro_0:true,
	filterColValue:'AF.ubicacion_fisica',
	filtro_1:true,
	save_as:'txt_ubicacion_fisica',
	id_grupo: 0
}
vectorAtributos[7] = paramUbicacion_fisica;
////////// txt vida_util_original//////
var paramVida_util_original = {
	validacion:{
		name: 'vida_util_original',
		fieldLabel: 'Vida �til Original (meses)',
		allowBlank: false,
		maxLength:50,
		minLength:0,
		selectOnFocus:true,
		allowDecimals: false,
		allowNegative: false,
		minValue: 1,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: '50%',
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:80, // ancho de columna en el grid
		//grid_indice:14
		grid_indice:4
	},
	tipo: 'NumberField',
	filtro_0:true,
	filterColValue:'AF.vida_util_original',
	filtro_1:true,
	save_as:'txt_vida_util_original',
	id_grupo: 3
}
vectorAtributos[8] = paramVida_util_original;



/*////////// txt vida_util_original//////Grover
var paramVida_util_original = {
validacion:{
name: 'vida_util_original',
fieldLabel: 'Vida �til Original (meses)',
allowBlank: false,
maxLength:50,
minLength:0,
selectOnFocus:true,
allowDecimals: false,
allowNegative: false,
minValue: 1,
//vtype:"alphaLatino",
vtype:"texto",
width: 30,
grid_visible:true, // se muestra en el grid
grid_editable:false, //es editable en el grid,
width_grid:120, // ancho de columna en el grid
grid_indice:14
},
tipo: 'NumberField',
filtro_0:true,
filterColValue:'AF.vida_util_original',
filtro_1:true,
save_as:'txt_vida_util_original',
id_grupo: 3
}
vectorAtributos[8] = paramVida_util_original;*/



////////// txt vida_util_restante//////
var paramVida_util_restante = {
	validacion:{
		name: 'vida_util_restante',
		fieldLabel: 'Vida �til Restante  (meses)',
		allowBlank: false,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		allowDecimals: false,
		allowNegative: false,
		minValue: 0,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: '30%',
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:150, // ancho de columna en el grid
		//grid_indice:8
		grid_indice:23
		//disabled: true
	},
	tipo: 'NumberField',
	filtro_0:true,
	filterColValue:'AF.vida_util_restante',
	filtro_1:true,
	save_as:'txt_vida_util_restante',
	id_grupo: 4
}
vectorAtributos[10] = paramVida_util_restante;
////////// txt tasa_depreciacion//////
var paramTasa_depreciacion = {
	validacion:{
		name: 'tasa_depreciacion',
		fieldLabel: 'Tasa Depreciaci�n',
		allowBlank: false,
		maxLength:800,
		minLength:0,
		selectOnFocus:true,
		allowDecimals: true,
		allowNegative: false,
		minValue: 0,
		maxValue: 1,
		decimalPrecision : 6,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: 80,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:120, // ancho de columna en el grid
		disabled: true,
		//grid_indice:12
		grid_indice:16
	},
	tipo: 'NumberField',
	filtro_0:false,
	filterColValue:'AF.tasa_depreciacion',
	filtro_1:false,
	save_as:'txt_tasa_depreciacion',
	id_grupo: 3
}
vectorAtributos[11] = paramTasa_depreciacion;
////////// txt fecha_ultima_deprec//////
var paramFecha_ultima_deprec = {
	validacion:{
		name: 'fecha_ultima_deprec',
		fieldLabel: 'Fecha �ltima Depreciaci�n',
		allowBlank: true,
		format: 'd/m/Y', //formato para validacion
		minValue: '01/01/1900',
		//disabledDays: [0, 7],
		disabledDaysText: 'D�a no v�lido',
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		renderer: formatDate,
		width_grid:120, // ancho de columna en el gris
		disabled: true,
		//grid_indice:13
		grid_indice:19
	},
	tipo: 'DateField',
	filtro_0:true,
	filterColValue:'AF.fecha_ultima_deprec',
	filtro_1:true,
	save_as:'txt_fecha_ultima_deprec',
	dateFormat:'m-d-Y', //formato de fecha que env�a para guardar
	defecto:"", // valor por default para este campo
	id_grupo:4
}
vectorAtributos[12] = paramFecha_ultima_deprec;
////////// txt depreciacion_acum_ant//////

var paramDepreciacion_acum_ant = {
	validacion:{
		name: 'depreciacion_acum_ant',
		fieldLabel: 'Depreciaci�n Acumulada anterior',
		allowBlank: false,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: 150,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:120, // ancho de columna en el grid
		disabled: true,
		//grid_indice:11
		grid_indice:20
	},
	tipo: 'NumberField',
	filtro_0:false,
	filterColValue:'AF.depreciacion_acum_ant',
	filtro_1:false,
	save_as:'txt_depreciacion_acum_ant',
	defecto: 0,
	id_grupo: 7
}
vectorAtributos[9] = paramDepreciacion_acum_ant;

////////// txt depreciacion_acum//////esto habilitar
var paramDepreciacion_acum = {
	validacion:{
		name: 'depreciacion_acum',
		fieldLabel: 'Depreciaci�n acumulada',
		allowBlank: false,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: '50%',
		grid_visible:true, // se muestra en el grid
		grid_editable:true, //es editable en el grid,
		width_grid:120, // ancho de columna en el grid
		//disabled: true,
		//grid_indice:9
		grid_indice:21
	},
	tipo: 'NumberField',
	filtro_0:true,
	filterColValue:'AF.depreciacion_acum',
	filtro_1:true,
	save_as:'txt_depreciacion_acum',
	defecto: 0,
	id_grupo: 7
}

vectorAtributos[13] = paramDepreciacion_acum;

////////// txt depreciacion_periodo//////
var paramDepreciacion_periodo = {
	validacion:{
		name: 'depreciacion_periodo',
		fieldLabel: 'Depreciaci�n per�odo',
		allowBlank: false,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: 150,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:120, // ancho de columna en el grid
		disabled: true,
		//grid_indice:10
		grid_indice:24
	},
	tipo: 'NumberField',
	filtro_0:false,
	filterColValue:'AF.depreciacion_periodo',
	filtro_1:false,
	save_as:'txt_depreciacion_periodo',
	defecto: 0,
	id_grupo: 7
}
//vectorAtributos[15] = paramDepreciacion_periodo;
vectorAtributos[14] = paramDepreciacion_periodo;
////////// txt monto_actual//////
var paramMonto_actual = {
	validacion:{
		name: 'monto_actual',
		fieldLabel: 'Valor actual',
		allowBlank: false,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		allowDecimals: true,
		allowNegative: false,
		minValue: 0,
		decimalPrecision : 6,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: 150,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:120, // ancho de columna en el grid
		disabled: true,
		//grid_indice:7
		grid_indice:22
	},
	tipo: 'NumberField',
	filtro_0:true,
	filterColValue:'AF.monto_actual',
	filtro_1:true,
	save_as:'txt_monto_actual',
	//id_grupo: 4
	id_grupo: 7
}
//vectorAtributos[9] = paramMonto_actual;
vectorAtributos[15] = paramMonto_actual;
////////// txt flag_revaloriz//////
var paramFlag_revaloriz = {
	validacion: {
		name: 'flag_revaloriz',
		fieldLabel: 'Revalorizado',
		typeAhead: true,
		loadMask: true,
		triggerAction: 'all',
		store: new Ext.data.SimpleStore({
			fields: ['si', 'no'],
			data : Ext.activo_fijoCombo.si_no // from states.js
		}),
		valueField:'si',
		displayField:'no',
		lazyRender:true,
		forceSelection:true,
		grid_visible:true, // se muestra en el grid
		grid_editable:true, //es editable en el grid,
		width_grid:70, // ancho de columna en el grid
		width: 60,
		//disabled: true,
		//grid_indice:27
		grid_indice:11
	},
	tipo:'ComboBox',
	filtro_0:true,
	filterColValue:'AF.flag_revaloriz',
	filtro_1:true,
	save_as:'txt_flag_revaloriz',
	defecto: 'no',
	id_grupo:0
}
vectorAtributos[16] = paramFlag_revaloriz;
////////// txt desc_moneda_principal//////
//Este campo solo sirve para desplegar la moneda principal
var paramDesc_moneda_principal = {
	validacion:{
		name: 'nombre_moneda',
		fieldLabel: 'Moneda principal',
		allowBlank: false,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: 150,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:120, // ancho de columna en el grid
		disabled: true,
		//grid_indice:26
		grid_indice:30
	},
	tipo: 'TextField',
	save_as:'txt_nombre_moneda',
	id_grupo: 2
}
vectorAtributos[17] = paramDesc_moneda_principal;
/////////// hidden_id_moneda_original//////
var paramId_moneda_original = {
	validacion:{
		fieldLabel: 'Moneda original',
		allowBlank: false,
		vtype:"texto",
		emptyText:'Moneda...',
		name: 'id_moneda_original',     //indica la columna del store principal "ds" del que proviene el id
		desc: 'nombre_moneda_orig', //indica la columna del store principal "ds" del que proviane la descripcion
		store:ds_moneda_orig,
		valueField: 'id_moneda',
		displayField: 'nombre',
		queryParam: 'filterValue_0',
		filterCol:'nombre',
		typeAhead: true,
		forceSelection : true,
		mode: 'remote',
		queryDelay: 50,
		pageSize: 10,
		minListWidth : 300,
		resizable: true,
		queryParam: 'filterValue_0',
		minChars : 1, ///caracteres m�nimos requeridos para iniciar la busqueda
		triggerAction: 'all',
		editable : true,
		renderer: renderMonedaOrig,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:120, // ancho de columna en el gris
		//grid_indice:17
		grid_indice:26
	},
	tipo: 'ComboBox',
	save_as:'hidden_id_moneda_original',
	defecto:'1',
	id_grupo: 1
}
vectorAtributos[18] = paramId_moneda_original;
////////// txt monto_compra_mon_orig//////
var paramMonto_compra_mon_orig = {
	validacion:{
		name: 'monto_compra_mon_orig',
		//fieldLabel: 'Valor compra (moneda original)',
		fieldLabel: 'Valor de Incorporaci�n',
		allowBlank: false,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		allowDecimals: true,
		allowNegative: false,
		minValue: 0,
		decimalPrecision : 6,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: 150,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:165, // ancho de columna en el grid
		//grid_indice:15
		grid_indice:3
	},
	tipo: 'NumberField',
	filtro_0:true,
	filterColValue:'AF.monto_compra_mon_orig',
	filtro_1:true,
	save_as:'txt_monto_compra_mon_orig',
	id_grupo: 1
}
vectorAtributos[19] = paramMonto_compra_mon_orig;
////////// txt fecha_compra//////
var paramFecha_compra = {
	validacion:{
		name: 'fecha_compra',
		fieldLabel: 'Fecha de Compra',
		allowBlank: false,
		format: 'd/m/Y', //formato para validacion
		minValue: '01/01/1900',
		//disabledDays: [0, 7],
		disabledDaysText: 'D�a no v�lido',
		grid_visible:true, // se muestra en el grid
		grid_editable:true, //es editable en el grid,
		renderer: formatDate,
		width_grid:120, // ancho de columna en el gris
		//grid_indice:20
		grid_indice:5
	},
	tipo: 'DateField',
	filtro_0:true,
	filterColValue:'AF.fecha_compra',
	filtro_1:true,
	save_as:'txt_fecha_compra',
	dateFormat:'m-d-Y', //formato de fecha que env�a para guardar
	defecto:"", // valor por default para este campo
	id_grupo:1
}
vectorAtributos[20] = paramFecha_compra;
////////// txt tipo_cambio//////
var paramTipo_cambio = {
	validacion:{
		name: 'tipo_cambio',
		fieldLabel: 'Tipo Cambio',
		allowBlank: false,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		allowDecimals: true,
		allowNegative: false,
		minValue: 0,
		decimalPrecision : 2,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: 50,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:120, // ancho de columna en el grid
		disabled: true,
		//grid_indice:19
		grid_indice:18
	},
	tipo: 'NumberField',
	filtro_0:false,
	filterColValue:'AF.tipo_cambio',
	filtro_1:false,
	save_as:'txt_tipo_cambio',
	id_grupo: 2
}
vectorAtributos[21] = paramTipo_cambio;
////////// txt monto_compra//////
var paramMonto_compra = {
	validacion:{
		name: 'monto_compra',
		fieldLabel: 'Valor compra (moneda principal)',
		allowBlank: false,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		allowDecimals: true,
		allowNegative: false,
		minValue: 0,
		decimalPrecision : 6,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: 150,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:165, // ancho de columna en el grid
		disabled: true,
		//grid_indice:18
		grid_indice:17
	},
	tipo: 'NumberField',
	filtro_0:true,
	filterColValue:'AF.monto_compra',
	filtro_1:true,
	save_as:'txt_monto_compra',
	id_grupo: 2
}
vectorAtributos[22] = paramMonto_compra;
////////// txt valor_rescate//////
var paramValor_rescate = {
	validacion:{
		name: 'valor_rescate',
		fieldLabel: 'Valor rescate (moneda principal)',
		allowBlank: false,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		allowDecimals: true,
		allowNegative: false,
		minValue: 0,
		decimalPrecision : 2,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: 150,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:165, // ancho de columna en el grid
		//grid_indice:16
		grid_indice:25
	},
	tipo: 'NumberField',
	filtro_0:false,
	filterColValue:'AF.valor_rescate',
	filtro_1:false,
	defecto: 1,
	save_as:'txt_valor_rescate',
	id_grupo: 3
}
vectorAtributos[23] = paramValor_rescate;
/////////////////////////////////////
var paramFecha_ini_dep = {
	validacion:{
		name: 'fecha_ini_dep',
		fieldLabel: 'Fecha Inicio Depreciaci�n',
		allowBlank: true,
		format: 'd/m/Y', //formato para validacion
		minValue: '01/01/1900',
		//disabledDays: [0, 7],
		disabledDaysText: 'D�a no v�lido',
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		renderer: formatDate,
		width_grid:130,// ancho de columna en el gris
		disabled:false,
		//grid_indice:22
		grid_indice:15
	},
	tipo: 'DateField',
	filtro_0:true,
	filterColValue:'AF.fecha_ini_dep',
	filtro_1:true,
	save_as:'txt_fecha_ini_dep',
	dateFormat:'m-d-Y', //formato de fecha que env�a para guardar
	defecto:"", // valor por default para este campo
	id_grupo:3
}
vectorAtributos[24] = paramFecha_ini_dep;
////////// txt con_garantia//////
var paramCon_garantia = {
	validacion: {
		name: 'con_garantia',
		fieldLabel: 'Tiene Garant�a',
		typeAhead: true,
		loadMask: true,
		allowBlank: false,
		triggerAction: 'all',
		store: new Ext.data.SimpleStore({
			fields: ['ID', 'valor'],
			data : Ext.activo_fijoCombo.si_no // from states.js
		}),
		valueField:'ID',
		displayField:'valor',
		lazyRender:true,
		forceSelection:true,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:75, // ancho de columna en el grid
		width: 60,
		//grid_indice:23
		grid_indice:27
	},
	tipo:'ComboBox',
	filtro_0:true,
	filterColValue:'AF.con_garantia',
	filtro_1:true,
	save_as:'txt_con_garantia',
	defecto: 'no',
	id_grupo:5
}
vectorAtributos[25] = paramCon_garantia;
////////// txt num_poliza_garantia//////
var paramNum_poliza_garantia = {
	validacion:{
		name: 'num_poliza_garantia',
		fieldLabel: 'P�liza de garant�a',
		allowBlank: true,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: 150,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:120, // ancho de columna en el grid
		disabled:true,
		//grid_indice:24
		grid_indice:28
	},
	tipo: 'TextField',
	filtro_0:false,
	filterColValue:'AF.num_poliza_garantia',
	filtro_1:false,
	save_as:'txt_num_poliza_garantia',
	id_grupo: 5
}
vectorAtributos[26] = paramNum_poliza_garantia;
////////// txt fecha_fin_gar//////
var paramFecha_fin_gar = {
	validacion:{
		name: 'fecha_fin_gar',
		fieldLabel: 'Fecha Fin Garant�a',
		allowBlank: true,
		format: 'd/m/Y', //formato para validacion
		minValue: '01/01/1900',
		//disabledDays: [0, 7],
		disabledDaysText: 'D�a no v�lido',
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		renderer: formatDate,
		width_grid:120, // ancho de columna en el gris
		disabled:true,
		//grid_indice:25
		grid_indice:29
	},
	tipo: 'DateField',
	filtro_0:true,
	filterColValue:'AF.fecha_fin_gar',
	filtro_1:true,
	save_as:'txt_fecha_fin_gar',
	dateFormat:'m-d-Y', //formato de fecha que env�a para guardar
	defecto:"", // valor por default para este campo
	id_grupo:5
}
vectorAtributos[27] = paramFecha_fin_gar;
////////// txt fecha_reg//////
/*	////////// txt foto_activo//////
var paramFoto_activo = {
validacion:{
name: 'foto_activo',
fieldLabel: 'Foto Activo Fijo',
allowBlank: false,
maxLength:500,
minLength:0,
selectOnFocus:true,
//vtype:"alphaLatino",
vtype:"texto",
width: 300,
grow: true,
grid_visible:true, // se muestra en el grid
grid_editable:true, //es editable en el grid,
width_grid:120 // ancho de columna en el grid
},
tipo: 'TextField',
filtro_0:true,
filtro_1:true,
save_as:'txt_foto_activo'
}
vectorAtributos[3] = paramFoto_activo;*/
////////// txt Num_factura//////
var paramNum_factura = {
	validacion:{
		name: 'num_factura',
		fieldLabel: 'Factura',
		allowBlank: true,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: 100,
		grid_visible:true, // se muestra en el grid
		grid_editable:true, //es editable en el grid,
		width_grid:120, // ancho de columna en el grid
		//grid_indice:21
		grid_indice:6
	},
	tipo: 'TextField',
	filtro_0:true,
	filterColValue:'AF.num_factura',
	filtro_1:true,
	save_as:'txt_num_factura',
	id_grupo: 1
}
vectorAtributos[28] = paramNum_factura;
////////// txt estado//////
var paramEstado = {
	validacion: {
		name: 'estado',
		fieldLabel: 'Estado',
		typeAhead: true,
		loadMask: true,
		triggerAction: 'all',
		store: new Ext.data.SimpleStore({
			fields: ['id', 'desc'],
			data : Ext.activo_fijoCombo.estado // from states.js
		}),
		valueField:'id',
		displayField:'desc',
		lazyRender:true,
		forceSelection:true,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:65, // ancho de columna en el gris
		//grid_indice:28
		grid_indice:10
	},
	tipo:'ComboBox',
	filtro_0:true,
	filterColValue:'AF.estado',
	filtro_1:true,
	save_as:'txt_estado',
	defecto:'en uso',
	id_grupo:0
}
vectorAtributos[29] = paramEstado;
////////// txt observaciones//////
var paramObservaciones = {
	validacion:{
		name: 'observaciones',
		fieldLabel: 'Observaciones',
		allowBlank: true,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: '100%',
		grow: true,
		grid_visible:true, // se muestra en el grid
		grid_editable:true, //es editable en el grid,
		width_grid:200, // ancho de columna en el grid
		//grid_indice:29
		grid_indice:12
	},
	tipo: 'TextArea',
	filtro_0:true,
	filterColValue:'AF.observaciones',
	filtro_1:true,
	save_as:'txt_observaciones',
	id_grupo: 9
}
vectorAtributos[30] = paramObservaciones;
////////// txt id_institucion//////
var paramId_institucion = {
	validacion:{
		//fieldLabel: 'Id',
		labelSeparator:'',
		name: 'id_institucion',
		inputType:'hidden',
		grid_visible:false, // se muestra en el grid
		grid_editable:false //es editable en el grid
	},
	tipo: 'Field',
	filtro_0:false,
	save_as:'hidden_id_institucion'
}
vectorAtributos[31] = paramId_institucion;
////////// txt id_moneda//////
var paramId_moneda = {
	validacion:{
		//fieldLabel: 'Id',
		labelSeparator:'',
		name: 'id_moneda',
		inputType:'hidden',
		grid_visible:false, // se muestra en el grid
		grid_editable:false //es editable en el grid
	},
	tipo: 'Field',
	filtro_0:false,
	save_as:'hidden_id_moneda'
}
vectorAtributos[32] = paramId_moneda;
////////// txt responsable//////
var paramResponsable = {
	validacion:{
		name: 'responsable',
		fieldLabel: 'Responsable',
		allowBlank: false,
		maxLength:200,
		minLength:0,
		selectOnFocus:true,
		//vtype:"alphaLatino",
		vtype:"texto",
		//width: 100,
		width: '100%',
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:200, // ancho de columna en el grid
		disabled: true,
		//grid_indice:29
		grid_indice:8
	},
	tipo: 'TextField',
	filtro_0:true,
	filtro_1:true,
	filterColValue:'responsable',
	save_as:'txt_responsable',
	id_grupo: 9
}
vectorAtributos[33] = paramResponsable;

////////////////////////////////////
var paramFecha_reg = {
	validacion:{
		name: 'fecha_reg',
		fieldLabel: 'Fecha registro',
		allowBlank: true,
		format: 'd/m/Y', //formato para validacion
		minValue: '01/01/1900',
		//disabledDays: [0, 7],
		disabledDaysText: 'D�a no v�lido',
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		renderer: formatDate,
		width_grid:120, // ancho de columna en el gris
		disabled: true,
		//grid_indice:30
		grid_indice:31
	},
	tipo: 'DateField',
	filtro_0:true,
	filterColValue:'AF.fecha_reg',
	filtro_1:true,
	save_as:'txt_fecha_reg',
	dateFormat:'m-d-Y', //formato de fecha que env�a para guardar
	defecto:"", // valor por default para este campo
	id_grupo:0
}
vectorAtributos[34] = paramFecha_reg;

var paramId_estado_funcional = {
	validacion:{
		fieldLabel: 'Estado Funcional',
		allowBlank: false,
		vtype:"texto",
		emptyText:'Estado Funcional...',
		name: 'id_estado_funcional',     //indica la columna del store principal "ds" del que proviane el id
		desc: 'desc_estado_funcional',//'codigo', //indica la columna del store principal "ds" del que proviane la descripcion
		store:ds_estado_funcional,
		valueField: 'id_estado_funcional',
		displayField: 'descripcion',
		queryParam: 'filterValue_0',
		filterCol:'descripcion',
		typeAhead: true,
		forceSelection : true,
		mode: 'remote',
		queryDelay: 50,
		pageSize: 10,
		minListWidth : 300,
		resizable: true,
		queryParam: 'filterValue_0',
		minChars : 1, ///caracteres m�nimos requeridos para iniciar la busqueda
		triggerAction: 'all',
		renderer: renderEstadoFuncional,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:200, // ancho de columna en el gris
		//grid_indice:3
		grid_indice:32
	},
	tipo: 'ComboBox',
	filtro_0:true,
	save_as:'hidden_id_estado_funcional',
	filterColValue:'EF.descripcion'
}
vectorAtributos[35] = paramId_estado_funcional;
/////////////////////////////////////////////////////////////////////////////////////////////
////////// txt monto_compra_2//////
var paramMonto_compra_2 = {
	validacion:{
		name: 'monto_compra_2',
		fieldLabel: 'Monto Compra Sec.',
		allowBlank: false,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		allowDecimals: true,
		allowNegative: false,
		minValue: 0,
		decimalPrecision : 6,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: 150,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:165, // ancho de columna en el grid
		//grid_indice:15
		grid_indice:32
	},
	tipo: 'NumberField',
	filtro_0:true,
	filterColValue:'AF.monto_compra_2',
	filtro_1:true,
	save_as:'txt_monto_compra_2',
	id_grupo: 8
}
vectorAtributos[36] = paramMonto_compra_2;

////////// txt monto_actual_2//////
var paramMonto_actual_2 = {
	validacion:{
		name: 'monto_actual_2',
		fieldLabel: 'Monto Actual Sec.',
		allowBlank: false,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		allowDecimals: true,
		allowNegative: false,
		minValue: 0,
		decimalPrecision : 6,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: 150,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:165, // ancho de columna en el grid
		disabled: true,
		grid_indice:33
	},
	tipo: 'NumberField',
	filtro_0:true,
	filterColValue:'AF.monto_actual_2',
	filtro_1:true,
	save_as:'txt_monto_actual_2',
	id_grupo: 8
}
vectorAtributos[37] = paramMonto_actual_2;
////////// txt depreciacion_acum_2//////esto habilitar
var paramDepreciacion_acum_2 = {
	validacion:{
		name: 'depreciacion_acum_2',
		fieldLabel: 'Depreciaci�n acumulada Sec.',
		allowBlank: false,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: '50%',
		grid_visible:true, // se muestra en el grid
		grid_editable:true, //es editable en el grid,
		width_grid:120, // ancho de columna en el grid
		disabled: true,
		grid_indice:34
	},
	tipo: 'NumberField',
	filtro_0:true,
	filterColValue:'AF.depreciacion_acum_2',
	filtro_1:true,
	save_as:'txt_depreciacion_acum_2',
	defecto: 0,
	id_grupo: 8
}
vectorAtributos[38] = paramDepreciacion_acum_2;
////////////////
var paramDepreciacion_acum_ant_2 = {
	validacion:{
		name: 'depreciacion_acum_ant_2',
		fieldLabel: 'Depreciaci�n Acumulada anterior Sec.',
		allowBlank: false,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: 150,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:120, // ancho de columna en el grid
		disabled: true,
		grid_indice:35
	},
	tipo: 'NumberField',
	filtro_0:false,
	filterColValue:'AF.depreciacion_acum_ant_2',
	filtro_1:false,
	save_as:'txt_depreciacion_acum_ant_2',
	defecto: 0,
	id_grupo: 8
}
vectorAtributos[39] = paramDepreciacion_acum_ant_2;
///////// txt depreciacion_periodo//////
var paramDepreciacion_periodo_2 = {
	validacion:{
		name: 'depreciacion_periodo_2',
		fieldLabel: 'Depreciaci�n per�odo Sec.',
		allowBlank: false,
		maxLength:500,
		minLength:0,
		selectOnFocus:true,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: 150,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:120, // ancho de columna en el grid
		disabled: true,
		grid_indice:36
	},
	tipo: 'NumberField',
	filtro_0:false,
	filterColValue:'AF.depreciacion_periodo_2',
	filtro_1:false,
	save_as:'txt_depreciacion_periodo_2',
	defecto: 0,
	id_grupo: 8
}
vectorAtributos[40] = paramDepreciacion_periodo_2;
//////////////////////////////////////////
var paramVida_util_2 = {
	validacion:{
		name: 'vida_util_2',
		fieldLabel: 'Vida �til Sec.',
		allowBlank: false,
		maxLength:50,
		minLength:0,
		selectOnFocus:true,
		allowDecimals: false,
		allowNegative: false,
		minValue: 1,
		//vtype:"alphaLatino",
		vtype:"texto",
		width: '50%',
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:80, // ancho de columna en el grid
		grid_indice:37
	},
	tipo: 'NumberField',
	filtro_0:true,
	filterColValue:'AF.vida_util_2',
	filtro_1:true,
	save_as:'txt_vida_util_2',
	defecto: 0,
	id_grupo: 8
}
vectorAtributos[41] = paramVida_util_2;




// ----------            FUNCIONES RENDER    ---------------//
function formatDate(value){
	return value ? value.dateFormat('d/m/Y') : '';
};
//---------         INICIAMOS LAYOUT MAESTRO     -----------//
// ---------- Inicia Layout ---------------//
var config = {
	titulo_maestro: "Alta de Activos Fijos",
	grid_maestro: paramConfig.grid_html,
	titulo_detalle: "Estructura Program�tica",
	grid_detalle:"ext-grid_ep" // es el grid en el que se arma la estrucutra programatica"
};
Docs.init(config); //se manda como par�metro el vector de configuraci�n
//---------         INICIAMOS HERENCIA           -----------//
/// HEREDAMOS DE LA CLASE MADRE
this.pagina = Pagina;
//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
this.pagina(paramConfig,vectorAtributos,ds);

//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
var ClaseMadre_mostrarFormulario= this.mostrarFormulario; //
var ClaseMadre_ocultarFormulario = this.ocultarFormulario ; //
var ClaseMadre_iniciaFormulario= this.iniciaFormulario; //
var ClaseMadre_btnActualizar = this.btnActualizar; // para heredar de la clase madre la funcion btnEdit de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_btnEdit = this.btnEdit; // para heredar de la clase madre la funcion btnEdit de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_btnEliminar = this.btnEliminar; // para heredar de la clase madre la funcion btnEliminar de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_eliminarSucces = this.eliminarSucess; // para heredar de la clase madre la funcion eliminarSucces de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_btnNew = this.btnNew; // para heredar de la clase madre la funcion brnNew de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_Save = this.Save; //
var ClaseMadre_SaveAndOther = this.SaveAndOther; //
var ClaseMadre_saveSuccess = this.SaveSuccess; // para heredar de la clase madre la funcion ConfirmSave de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_ConfirmSave = this.ConfirmSave; // para heredar de la clase madre la funcion ConfirmSave de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_conexionFailure = this.conexionFailure; // para heredar de la clase madre la funcion eliminarSucces de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_ValidarCampos = this.ValidarCampos; // para heredar de la clase madre la funcion btnEdit de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_limpiarInvalidos = this.limpiarInvalidos; // para heredar de la clase madre la funcion btnEdit de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_EnableSelect = this.EnableSelect; // para heredar de la clase madre la funcion btnEdit de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_getComponente = this.getComponente;
var getSelectionModel = this.getSelectionModel;
ds_tipo_activo.addListener('loadexception',  ClaseMadre_conexionFailure); //se recibe un error
ds_sub_tipo_activo.addListener('loadexception',  ClaseMadre_conexionFailure); //se recibe un error
// -----------   DEFINICI�N DE LA BARRA DE MEN� ----------- //
var paramMenu = {
	guardar:{	crear : true, //para ver si se creara el boton
	separador:false	},
	nuevo: {crear : true, //para ver si se creara el boton
	separador:true	},
	editar:{crear : true, //para ver si se creara el boton
	separador:false	},
	eliminar:{	crear : true, //para ver si se creara el boton
	separador:false	},
	actualizar:{crear :true,
	separador:false	}
};
//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
//datos necesarios para ell filtro
parametrosFiltro = "&filterValue_0="+ds.lastOptions.params.filterValue_0+"&filterCol_0="+ds.lastOptions.params.filterCol_0;
var paramFunciones = {
	btnEliminar:{	url:"../../control/activo_fijo/ActionEliminaActivoFijo.php"
	},
	Save:{	url:"../../control/activo_fijo/ActionSaveActivoFijo.php"
	},
	ConfirmSave:{	url:"../../control/activo_fijo/ActionSaveActivoFijo.php"
	},
	Formulario:{
		html_apply:"dlgInfo",
		//width:870,
		width:'90%',
		height:470,
		minWidth:150,
		minHeight:200,
		labelWidth: 75, //ancho del label
		closable:true,
		//columnas:[420,400],
		columnas:['47%','47%'],
		grupos:[
		{	tituloGrupo:'Informaci�n General del Activo Fijo',columna:0,	id_grupo:0	},
		{	tituloGrupo:'Datos de adquisici�n',columna:0,	id_grupo:1	},
		{	tituloGrupo:'Datos de adquisici�n en moneda principal',	columna:0,	id_grupo:2	},
		{	tituloGrupo:'Datos de depreciaci�n',columna:0,	id_grupo:3	},
		{	tituloGrupo:'Datos vigentes',columna:1,	id_grupo:4	},
		{	tituloGrupo:'Garant�a',	columna:1,	id_grupo:5	},
		{	tituloGrupo:'Foto Activo Fijo',columna:1,	id_grupo:6	},
		{	tituloGrupo:'Datos Depreciaci�n',columna:1,	id_grupo:7	},
		{	tituloGrupo:'Datos Depreciaci�n Secundaria',columna:1,	id_grupo:8	},
		{	tituloGrupo:'Observaciones',columna:1,	id_grupo:9	}
		]
	}
}
//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
function get_fecha(fecha)
{	var fecha = new Date(fecha);
var dia;
var mes;
var anio;
var fecha_res;
dia = fecha.getDate();
mes = fecha.getMonth() + 1;
anio = fecha.getFullYear();
fecha_res = dia + "/" + mes + "/" + anio;
return fecha_res;
}
function iniciarEventosFormularios()
{	combo_tipo_activo=ClaseMadre_getComponente('id_tipo_activo');
combo_sub_tipo_activo=ClaseMadre_getComponente('id_sub_tipo_activo');
h_txt_vida_util_original=ClaseMadre_getComponente('vida_util_original');
h_txt_vida_util_restante=ClaseMadre_getComponente('vida_util_restante');
h_txt_tasa_depreciacion=ClaseMadre_getComponente('tasa_depreciacion');
h_txt_nombre_moneda=ClaseMadre_getComponente('nombre_moneda');
h_txt_id_moneda=ClaseMadre_getComponente('id_moneda');
h_txt_monto_compra_mon_orig=ClaseMadre_getComponente('monto_compra_mon_orig');
h_txt_monto_compra=ClaseMadre_getComponente('monto_compra');
h_txt_tipo_cambio=ClaseMadre_getComponente('tipo_cambio');
h_txt_monto_actual=ClaseMadre_getComponente('monto_actual');
h_txt_fecha_reg=ClaseMadre_getComponente('fecha_reg');
combo_moneda_original=ClaseMadre_getComponente('id_moneda_original');
combo_con_garantia = ClaseMadre_getComponente('con_garantia');
h_txt_num_poliza_garantia = ClaseMadre_getComponente('num_poliza_garantia');
h_txt_fecha_fin_gar = ClaseMadre_getComponente('fecha_fin_gar');
h_txt_fecha_ini_dep = ClaseMadre_getComponente('fecha_ini_dep');
h_txt_fecha_compra = ClaseMadre_getComponente('fecha_compra');
h_txt_orden_compra = ClaseMadre_getComponente('orden_compra');
h_txt_codigo = ClaseMadre_getComponente('codigo');
h_txt_correlativo_act=ClaseMadre_getComponente('correlativo_act');
h_txt_monto_compra_2=ClaseMadre_getComponente('monto_compra_2');
h_txt_monto_actual_2=ClaseMadre_getComponente('monto_actual_2');
h_txt_depreciacion_acum_2=ClaseMadre_getComponente('depreciacion_acum_2');
h_txt_depreciacion_acum_ant_2=ClaseMadre_getComponente('depreciacion_acum_ant_2');
h_txt_depreciacion_periodo_2=ClaseMadre_getComponente('depreciacion_periodo_2');
h_txt_vida_util_2=ClaseMadre_getComponente('vida_util_2');

////////////////////////////////////
//combo_estado =ClaseMadre_getComponente('estado');

var onTipoActivoSelect = function(e) {
	var id = combo_tipo_activo.getValue();
	combo_sub_tipo_activo.setValue("");
	combo_sub_tipo_activo.filterValues[0] =  id;
	combo_sub_tipo_activo.modificado = true;
	get_datos_tipo();

};
function get_datos_tipo()
{	var postData;
h_txt_codigo.setValue("");
if(combo_tipo_activo.getValue() == undefined || combo_tipo_activo.getValue() == null || combo_tipo_activo.getValue() == "")
{	postData = "CantFiltros=1&filterCol_0=id_activo_fijo&filterValue_0= ' '";
}
else
{	postData = "CantFiltros=1&filterCol_0=id_tipo_activo&filterValue_0="+combo_tipo_activo.getValue();
}
var hcallback =
{	success:  cargar_tipo_activo_data,
failure:  ClaseMadre_conexionFailure,
timeout:  100000//TIEMPO DE ESPERA PARA DAR FALLO
};
YAHOO.util.Connect.asyncRequest('POST', '../../control/tipo_activo/ActionListaTipoActivo.php', hcallback, postData);
}

//Carga los datos de de sub tipo de activo como sugerencia
function cargar_tipo_activo_data(resp)
{	Ext.MessageBox.hide();
if(resp.responseXML != undefined && resp.responseXML != null && resp.responseXML.documentElement != null && resp.responseXML.documentElement != undefined)
{	var root = resp.responseXML.documentElement;
h_txt_codigo.setValue(root.getElementsByTagName('codigo')[0].firstChild.nodeValue);
}
}
//Obtiene los datos vigentes
function get_datos_subtipo()
{	var postData;
get_datos_tipo();
if(combo_sub_tipo_activo.getValue() == undefined || combo_sub_tipo_activo.getValue() == null || combo_sub_tipo_activo.getValue() == "")
{	postData = "CantFiltros=1&filterCol_0=id_activo_fijo&filterValue_0= ' '";
}
else
{	postData = "CantFiltros=1&filterCol_0=id_sub_tipo_activo&filterValue_0="+combo_sub_tipo_activo.getValue();
}
var hcallback =
{	success:  cargar_sub_tipo_activo_data,
failure:  ClaseMadre_conexionFailure,
timeout:  100000//TIEMPO DE ESPERA PARA DAR FALLO
};
YAHOO.util.Connect.asyncRequest('POST', '../../control/sub_tipo_activo/ActionListaSubtipoActivo.php', hcallback, postData);
}

//Carga los datos de de sub tipo de activo como sugerencia
function cargar_sub_tipo_activo_data(resp)
{	Ext.MessageBox.hide();
if(resp.responseXML != undefined && resp.responseXML != null && resp.responseXML.documentElement != null && resp.responseXML.documentElement != undefined)
{	var root = resp.responseXML.documentElement;
h_txt_vida_util_original.setValue(root.getElementsByTagName('vida_util')[0].firstChild.nodeValue);
h_txt_vida_util_restante.setValue(root.getElementsByTagName('vida_util')[0].firstChild.nodeValue);
h_txt_tasa_depreciacion.setValue(root.getElementsByTagName('tasa_depreciacion')[0].firstChild.nodeValue);
txt_codtipo=h_txt_codigo.getValue();
h_txt_codigo.setValue(root.getElementsByTagName('codigo')[0].firstChild.nodeValue);
h_txt_responsable.setValue(root.getElementsByTagName('responsable')[0].firstChild.nodeValue);
}
}
//Obtiene la moneda principal
/*function convertir_monto()
{	var postData;
fecha = get_fecha(h_txt_fecha_reg.getValue());
if(fecha!='NaN/NaN/NaN' || fecha!='')
{
postData = "&fecha=" + fecha + "&monto="+h_txt_monto_compra_mon_orig.getValue()+"&id_moneda1="+h_txt_id_moneda.getValue()+"&id_moneda2="+combo_moneda_original.getValue()+"&tipo=O";
var hcallback =
{	success:  cargar_monto_convertido,
failure:  ClaseMadre_conexionFailure,
timeout:  100000//TIEMPO DE ESPERA PARA DAR FALLO
};
YAHOO.util.Connect.asyncRequest('POST', '../../../lib/lib_control/action/ActionConvertirMonedas.php', hcallback, postData);
}

}*/

function convertir_monto()
{	var postData;
var fecha = get_fecha(h_txt_fecha_reg.getValue());
postData = "fecha=" + fecha + "&monto="+h_txt_monto_compra_mon_orig.getValue()+"&id_moneda1="+h_txt_id_moneda.getValue()+"&id_moneda2="+combo_moneda_original.getValue()+"&tipo=O";
var hcallback =
{	success:  cargar_monto_convertido,
failure:  ClaseMadre_conexionFailure,
timeout:  100000//TIEMPO DE ESPERA PARA DAR FALLO
};
YAHOO.util.Connect.asyncRequest('POST', '../../../lib/lib_control/action/ActionConvertirMonedas.php', hcallback, postData);
}
//Carga el monto convertido
function cargar_monto_convertido(resp)
{	Ext.MessageBox.hide();
if(resp.responseXML != undefined && resp.responseXML != null && resp.responseXML.documentElement != null && resp.responseXML.documentElement != undefined)
{
	var root = resp.responseXML.documentElement;
	if(root.getElementsByTagName('monto')[0].firstChild != undefined && root.getElementsByTagName('monto')[0].firstChild != null)
	{
		h_txt_monto_compra.setValue(root.getElementsByTagName('monto')[0].firstChild.nodeValue);
		h_txt_monto_actual.setValue(root.getElementsByTagName('monto')[0].firstChild.nodeValue);
	}
	else{
		h_txt_monto_compra.setValue('');
		h_txt_monto_actual.setValue('');
	}
}
}
//Funci�n que deshabilta los controles de p�liza de garant�a y fecha fin garant�a si se elige no
function garantia()
{	if(combo_con_garantia.getValue() == 'si')
{	h_txt_num_poliza_garantia.enable();
h_txt_fecha_fin_gar.enable();
}
else
{	h_txt_num_poliza_garantia.setValue("");
h_txt_fecha_fin_gar.setValue("");
h_txt_num_poliza_garantia.disable();
h_txt_fecha_fin_gar.disable();
}
}
function calcular_tasa_dep()
{	if(h_txt_vida_util_original.getValue() != undefined && h_txt_vida_util_original.getValue() != null)
{//Copia el valor en vida util restante

	//h_txt_vida_util_restante.setValue(h_txt_vida_util_original.getValue());

	if(h_txt_vida_util_original.getValue() != "")
	{h_txt_tasa_depreciacion.setValue(redondear(100/h_txt_vida_util_original.getValue(),6));
	}
	else
	{	h_txt_tasa_depreciacion.setValue("");	}
}
else
{	h_txt_tasa_depreciacion.setValue("");	}
}
//Define los eventos de los componentes y las acciones a ejecutar
//combo_tipo_activo.on('valid', get_fecha_bd);
combo_tipo_activo.on('select', onTipoActivoSelect);
combo_tipo_activo.on('change', onTipoActivoSelect);
combo_sub_tipo_activo.on('select', get_datos_subtipo);
combo_sub_tipo_activo.on('change', get_datos_subtipo);
h_txt_monto_compra_mon_orig.on('change', convertir_monto);
combo_moneda_original.on('select', get_tipo_cambio);
combo_moneda_original.on('change', get_tipo_cambio);
combo_con_garantia.on('change', garantia);
combo_con_garantia.on('select', garantia);
h_txt_vida_util_original.on('valid',calcular_tasa_dep);
h_txt_fecha_compra.on('change', cargar_fecha_ini_dep);//valid
h_txt_fecha_compra.on('change',get_tipo_cambio);
h_txt_monto_compra_mon_orig.on('change',get_tipo_cambio);
}

//Funci�n que obtiene la fecha de la base de datos
function get_fecha_bd()
{var hcallback =
{	success:  cargar_fecha_bd,
failure:  ClaseMadre_conexionFailure,
timeout:  100000//TIEMPO DE ESPERA PARA DAR FALLO
};

YAHOO.util.Connect.asyncRequest('GET', '../../../lib/lib_control/action/ActionObtenerFechaBD.php', hcallback);
}
//Carga la fecha obtenida
function cargar_fecha_bd(resp)
{ if(resp.responseXML != undefined && resp.responseXML != null && resp.responseXML.documentElement != null && resp.responseXML.documentElement != undefined)
{	var root = resp.responseXML.documentElement;
if(h_txt_fecha_reg.getValue()=="")
{	h_txt_fecha_reg.setValue(root.getElementsByTagName('fecha')[0].firstChild.nodeValue);
h_txt_fecha_compra.setValue(root.getElementsByTagName('fecha')[0].firstChild.nodeValue);
}
}
}
//Obtiene la moneda principal
function get_moneda_principal()
{	var postData;
postData = "";
var hcallback =
{	success:  cargar_moneda_principal,
failure:  ClaseMadre_conexionFailure,
timeout:  100000//TIEMPO DE ESPERA PARA DAR FALLO
};
YAHOO.util.Connect.asyncRequest('POST', '../../../lib/lib_control/action/ActionObtenerMonedaPrincipal.php', hcallback, postData);
}
//Carga la moneda principal
function cargar_moneda_principal(resp)
{	Ext.MessageBox.hide();
if(resp.responseXML != undefined && resp.responseXML != null && resp.responseXML.documentElement != null && resp.responseXML.documentElement != undefined)
{	var root = resp.responseXML.documentElement;
h_txt_nombre_moneda.setValue(root.getElementsByTagName('nombre')[0].firstChild.nodeValue);
h_txt_id_moneda.setValue(root.getElementsByTagName('id_moneda')[0].firstChild.nodeValue);
}
}
//////////////////////////////////////////////////////
//Obtiene el tipo de cambio con el que se hace la conversi�n de los montos
/*function get_tipo_cambio()
{	var postData;
var fecha = get_fecha(h_txt_fecha_compra.getValue());
if(fecha!='NaN/NaN/NaN' || fecha!='')
{
postData = "fecha=" + fecha + "&id_moneda1=" + h_txt_id_moneda.getValue()  + "&id_moneda2=" + combo_moneda_original.getValue() + "&tipo=O";
var hcallback =
{	success:  cargar_tipo_cambio,
failure:  ClaseMadre_conexionFailure,
timeout:  100000//TIEMPO DE ESPERA PARA DAR FALLO
};
YAHOO.util.Connect.asyncRequest('POST', '../../../lib/lib_control/action/ActionObtenerTipoCambio.php', hcallback, postData);
}

}*/
function get_tipo_cambio()
{	var postData;
var fecha = get_fecha(h_txt_fecha_compra.getValue());
postData = "fecha=" + fecha + "&id_moneda1=" + h_txt_id_moneda.getValue()  + "&id_moneda2=" + combo_moneda_original.getValue() + "&tipo=O";
var hcallback =
{	success:  cargar_tipo_cambio,
failure:  ClaseMadre_conexionFailure,
timeout:  100000//TIEMPO DE ESPERA PARA DAR FALLO
};
YAHOO.util.Connect.asyncRequest('POST', '../../../lib/lib_control/action/ActionObtenerTipoCambio.php', hcallback, postData);
}
//Carga el tipo de cambio obtenido en los componentes
function cargar_tipo_cambio(resp)
{//alert(resp.responseXML.documentElement.getElementsByTagName('tipo_cambio')[0].firstChild.nodeValue);
	Ext.MessageBox.hide();
	if(resp.responseXML != undefined && resp.responseXML != null && resp.responseXML.documentElement != null && resp.responseXML.documentElement != undefined)
	{	var root = resp.responseXML.documentElement;
	if(root.getElementsByTagName('tipo_cambio')[0].firstChild.nodeValue != 0) {
		if(root.getElementsByTagName('tipo_cambio')[0].firstChild != undefined && root.getElementsByTagName('tipo_cambio')[0].firstChild != null)
		{	h_txt_tipo_cambio.setValue(root.getElementsByTagName('tipo_cambio')[0].firstChild.nodeValue);
		}
		else
		{	if(root.getElementsByTagName('tipo_cambio')[0].firstChild != 0  && root.getElementsByTagName('tipo_cambio')[0].firstChild != null)
		{	h_txt_tipo_cambio.setValue(root.getElementsByTagName('tipo_cambio')[0].firstChild.nodeValue);
		}
		else
		{	h_txt_tipo_cambio.setValue("");
		//Ext.MessageBox.alert('Tipo de cambio no definido', 'No existe el tipo de cambio para la fecha y moneda especificada.');
		Ext.Msg.show({
			title: 'Tipo de cambio no definido',
			msg: "No existe el tipo de cambio para la fecha y moneda especificada",
			minWidth:300,
			buttons: Ext.Msg.OK
		});
		}
		}
		//Recalcula el monto en la moneda principal
		if(h_txt_monto_compra_mon_orig.getValue() != "" && h_txt_tipo_cambio.getValue())
		{	h_txt_monto_compra.setValue(h_txt_monto_compra_mon_orig.getValue() * h_txt_tipo_cambio.getValue());
		h_txt_monto_actual.setValue(h_txt_monto_compra_mon_orig.getValue() * h_txt_tipo_cambio.getValue());
		}
	}
	else
	{	h_txt_tipo_cambio.setValue("");
	Ext.Msg.show({
		title: 'Tipo de cambio no definido',
		msg: "No existe el tipo de cambio para la fecha y moneda especificada",
		minWidth:300,
		buttons: Ext.Msg.OK
	});
	}
	}
}
//Funci�n que coloca la fecha de inicio de depreciaci�n igual que la fecha de compra
function cargar_fecha_ini_dep()
{	if(h_txt_fecha_compra.getValue() != " ")
{	h_txt_fecha_ini_dep.setValue(h_txt_fecha_compra.getValue());
}
//}
else
{		h_txt_fecha_ini_dep.setValue('');
}
}
this.btnNew = function()
{	ClaseMadre_btnNew();
get_fecha_bd();
get_moneda_principal();
if (sw==0)
{	//Carga el valor por defecto a la moneda principal como Bolivianos
	var  params = new Array();
	params['id_moneda'] = 1;
	params['nombre'] = 'Bolivianos';
	var aux = new Ext.data.Record(params,1);
	combo_moneda_original.store.add(aux)
	combo_moneda_original.setValue(1);
	sw=1;
}
if(combo_moneda_original.getValue() != "")
{	h_txt_tipo_cambio.setValue("1");
}
}

this.btnSave = function()
{
	ClaseMadre_Save();
	alert(session.getValue("cod_activo_fijo_grabar"));
}


/*this.btnEdit = function()
{
h_txt_vida_util_restante.setValue(h_txt_vida_util_restante.getValue());
ClaseMadre_btnEdit();

}*/

//Abre la ventana de Subtipos de Activos
function btnCaracteristicas()
{	var sm = getSelectionModel();
var filas = ds.getModifiedRecords();
var cont = filas.length;
var NumSelect = sm.getCount(); //recupera la cantidad de filas selecionadas
//sm.clearSelections() ;//limpiar las selecciones realizadas
if(NumSelect != 0)//Verifica si hay filas seleccionadas
{		var SelectionsRecord  = sm.getSelected(); //es el primer registro selecionado
var data = "maestro_id_activo_fijo=" + SelectionsRecord.data.id_activo_fijo;
data = data + "&maestro_codigo=" + SelectionsRecord.data.codigo;
data = data + "&maestro_descripcion=" + SelectionsRecord.data.descripcion;
data = data + "&maestro_descripcion_larga=" + SelectionsRecord.data.descripcion_larga;
data = data + "&maestro_id_tipo_activo=" + SelectionsRecord.data.id_tipo_activo;
//Abre la pesta�a del detalle
Docs.loadTab('../activo_fijo_caracteristicas/activo_fijo_caracteristicas_det.php?'+data, "Definici�n de Caracter�sticas [" + SelectionsRecord.data.codigo + "]");
}
else
{	Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
}
}
//Abre la ventana de Componentes
function btnComponentes()
{	var sm = getSelectionModel();
var filas = ds.getModifiedRecords();
var cont = filas.length;
var NumSelect = sm.getCount(); //recupera la cantidad de filas selecionadas
//sm.clearSelections() ;//limpiar las selecciones realizadas

if(NumSelect != 0)//Verifica si hay filas seleccionadas
{	var SelectionsRecord  = sm.getSelected(); //es el primer registro selecionado
var data = "maestro_id_activo_fijo=" + SelectionsRecord.data.id_activo_fijo;
data = data + "&maestro_codigo=" + SelectionsRecord.data.codigo;
data = data + "&maestro_descripcion=" + SelectionsRecord.data.descripcion;
data = data + "&maestro_descripcion_larga=" + SelectionsRecord.data.descripcion_larga;
data = data + "&maestro_id_tipo_activo=" + SelectionsRecord.data.id_tipo_activo;
//Abre la pesta�a del detalle
Docs.loadTab('../activo_fijo_componentes/activo_fijo_componentes_det.php?'+data, "Componentes [" + SelectionsRecord.data.codigo + "]");
}
else
{	Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')		}
}
//Abre la ventana de Responsables

function btnResponsables()
{	var sm = getSelectionModel();
var filas = ds.getModifiedRecords();
var cont = filas.length;
var NumSelect = sm.getCount(); //recupera la cantidad de filas selecionadas
//sm.clearSelections() ;//limpiar las selecciones realizadas
if(NumSelect != 0)//Verifica si hay filas seleccionadas
{	var SelectionsRecord  = sm.getSelected(); //es el primer registro selecionado
var data = "maestro_id_activo_fijo=" + SelectionsRecord.data.id_activo_fijo;
data = data + "&maestro_codigo=" + SelectionsRecord.data.codigo;
data = data + "&maestro_descripcion=" + SelectionsRecord.data.descripcion;
data = data + "&maestro_descripcion_larga=" + SelectionsRecord.data.descripcion_larga;
//Abre la pesta�a del detalle
Docs.loadTab('../activo_fijo_empleado/activo_fijo_empleado_det.php?'+data, "Responsables [" + SelectionsRecord.data.codigo + "]");
}
else
{		Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');		}
}


//Abre la ventana de Reparaciones
function btnReparaciones()
{	var sm = getSelectionModel();
var filas = ds.getModifiedRecords();
var cont = filas.length;
var NumSelect = sm.getCount(); //recupera la cantidad de filas selecionadas
//sm.clearSelections() ;//limpiar las selecciones realizadas
if(NumSelect != 0)//Verifica si hay filas seleccionadas
{	var SelectionsRecord  = sm.getSelected(); //es el primer registro selecionado
var data = "maestro_id_activo_fijo=" + SelectionsRecord.data.id_activo_fijo;
data = data + "&maestro_codigo=" + SelectionsRecord.data.codigo;
data = data + "&maestro_descripcion=" + SelectionsRecord.data.descripcion;
data = data + "&maestro_descripcion_larga=" + SelectionsRecord.data.descripcion_larga;
//Abre la pesta�a del detalle
Docs.loadTab('../reparacion/reparacion_det.php?'+data, "Reparaciones [" + SelectionsRecord.data.codigo + "]");
}
else
{		Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
}
}
this.btnActualizar = function()
{   ClaseMadre_btnActualizar();
obj_ep.btnActualizar();
}
/////////////////////////////////////////

//InitBarraMenu(array BOTONES DISPONIBLES);
this.Init(); //iniciamos la clase madre
this.InitBarraMenu(paramMenu);
//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
this.InitFunciones(paramFunciones);
//Se agrega el bot�n para el acceso al detalle (SubTipo de Activos)
this.AdicionarBoton("../../../lib/imagenes/menu-show.gif",'<b>Definici�n de Caracter�sticas<b>',btnCaracteristicas,true,'caracteristicas','Definici�n de Caracter�sticas');
this.AdicionarBoton("../../../lib/imagenes/menu-show.gif",'<b>Registro de Componentes<b>',btnComponentes,true,'componentes','Registro de Componentes');
this.AdicionarBoton("../../../lib/imagenes/menu-show.gif",'<b>Asignaci�n a Responsables<b>',btnResponsables,true,'responsables','Asignaci�n a Responsables');
this.AdicionarBoton("../../../lib/imagenes/menu-show.gif",'<b>Reparaciones<b>',btnReparaciones,true,'reparaciones','Reparaciones');
this.iniciaFormulario();
iniciarEventosFormularios()
innerLayout.addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
var sm = getSelectionModel();
function cambioSM (){
	//var sm = selModel;
	var NumSelect = sm.getCount(); //recupera la cantidad de filas selecionadas
	if(NumSelect != 0)//Verifica si hay filas seleccionadas
	{	var SelectionsRecord  = sm.getSelected(); //es el primer registro selecionado
	obj_ep.ActualizarEP(SelectionsRecord.data.id_activo_fijo);
	}
	else
	{	obj_ep.ActualizarEP(' ');
	}
}
sm.on("selectionchange",cambioSM);
ds.on("load",cambioSM);
}
///////////ESTRUCTURA PROGRAMATICA ////////////////
function PaginaEstructuraProgramatica()
{	var vectorAtributos = new Array;
var ds;
//Configuraci�n p�gina
var paramConfig = {
	TamanoPagina:20, //para definir el tama�o de la p�gina
	TiempoEspera:10000,//tiempo de espera para dar fallo
	CantFiltros:0,//indica la cantidad de filtros que se tendr�n
	FiltroEstructura:false,//indica si se tiene los 5 combos que la filtra la estructura program�tica
	FormularioEstructura:false,//indica si se tiene el los 5 combos de la estructura programatica en los formulario para que sean incluidos en las modificaciiones e iliminaciones
	FiltroAvanzado:false,
	grid_html:'ext-grid_ep'
};
//  DATA STORE      		//
// creaci�n del Data Store
<?php
//obtenemos la ruta absoluta
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$dir = "http://$host$uri/";
?>
ds = new Ext.data.Store({
	// asigna url de donde se cargaran los datos
	//proxy: new Ext.data.HttpProxy({url: '<?php echo $dir?>../../../control/activo_fijo/ActionListaActivoFijo.php'}),
	proxy: new Ext.data.HttpProxy({url: '<?php echo $dir?>../../../control/activo_fijo_tpm_frppa/ActionListaActivoFijoTpmFrppa.php'}),
	// aqui se define la estructura del XML
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_activo_fijo_frppa',
		totalRecords: 'TotalCount'

	}, [
	// define el mapeo de XML a las etiquetas (campos)
	{name: 'descripcion', type: 'string'},
	'id_activo_fijo_frppa',
	'id_activo_fijo',
	'id_financiador',
	'nombre_financiador',
	'id_regional',
	'nombre_regional',
	'id_programa',
	'nombre_programa',
	'id_proyecto',
	'nombre_proyecto',
	'id_actividad',
	'nombre_actividad'
	]),
	remoteSort: true // metodo de ordenacion remoto
});
//carga los datos desde el archivo XML declaraqdo en el Data Store
ds.load({
	params:{
		start:0,
		limit: paramConfig.TamanoPagina,
		//			CantFiltros:paramConfig.CantFiltros,
		CantFiltros:1,
		filterAvanzado_0:true,
		filterCol_0:"id_activo_fijo",
		filterValue_0:' ',
		hidden_id_activo_fijo:' '
	}
});
// ------------------  PAR�METROS --------------------------//
// Definici�n de todos los tipos de datos que se maneja    //
/////////// hidden id_tipo_activo//////
//en la posici�n 0 siempre tiene que estar la llave primaria
/////DATA STORE////////////
ds_financiador = new Ext.data.Store({
	// asigna url de donde se cargaran los datos
	proxy: new Ext.data.HttpProxy({url: '../../../sis_parametros/control/financiador/ActionListaFinanciadorEP.php'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_financiador',
		totalRecords: 'TotalCount'

	}, ['id_financiador','nombre_financiador','codigo_financiador'])

})
ds_regional = new Ext.data.Store({
	// asigna url de donde se cargaran los datos
	proxy: new Ext.data.HttpProxy({url: '../../../sis_parametros/control/regional/ActionListaRegionalEP.php'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_regional',
		totalRecords: 'TotalCount'

	}, ['id_regional','nombre_regional'])//,
})
ds_programa = new Ext.data.Store({
	// asigna url de donde se cargaran los datos
	proxy: new Ext.data.HttpProxy({url: '../../../sis_parametros/control/programa/ActionListaProgramaEP.php'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_programa',
		totalRecords: 'TotalCount'
	}, ['id_programa','nombre_programa'])//,
})
ds_proyecto = new Ext.data.Store({
	// asigna url de donde se cargaran los datos
	proxy: new Ext.data.HttpProxy({url: '../../../sis_parametros/control/proyecto/ActionListaProyectoEP.php'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_proyecto',
		totalRecords: 'TotalCount'
	}, ['id_proyecto','nombre_proyecto'])//,
})
ds_actividad = new Ext.data.Store({
	// asigna url de donde se cargaran los datos
	proxy: new Ext.data.HttpProxy({url: '../../../sis_parametros/control/actividad/ActionListaActividadEP.php'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_actividad',
		totalRecords: 'TotalCount'

	}, ['id_actividad','nombre_actividad'])//,
})
////////////////FUNCIONES RENDER ////////////
function renderFinanciador(value, p, record){return String.format('{0}', record.data['nombre_financiador']);}
function renderRegional(value, p, record){return String.format('{0}', record.data['nombre_regional']);}
function renderPrograma(value, p, record){return String.format('{0}', record.data['nombre_programa']);}
function renderProyecto(value, p, record){return String.format('{0}', record.data['nombre_proyecto']);}
function renderActividad(value, p, record){return String.format('{0}', record.data['nombre_actividad']);}
var paramId_activo_fijo = {
	validacion:{
		//fieldLabel: 'Id',
		labelSeparator:'',
		name: 'id_activo_fijo_frppa',
		inputType:'hidden',
		grid_visible:false, // se muestra en el grid
		grid_editable:false //es editable en el grid
	},
	tipo: 'Field',
	filtro_0:true,
	save_as:'hidden_id_activo_fijo_frppa'
}
vectorAtributos[0] = paramId_activo_fijo;
/////////// txt codigo//////
var paramId_financiador = {
	validacion:{
		fieldLabel: 'Financiador',
		allowBlank: false,
		vtype:"texto",
		emptyText:'Financiador...',
		name: 'id_financiador',     //indica la columna del store principal "ds" del que proviane el id
		desc: 'nombre_financiador', //indica la columna del store principal "ds" del que proviane la descripcion
		store:ds_financiador,
		valueField: 'id_financiador',
		displayField: 'nombre_financiador',
		queryParam: 'filterValue_0',
		filterCol:'nombre_financiador',
		typeAhead: true,
		forceSelection :true,
		mode: 'remote',
		queryDelay: 50,
		pageSize: 10,
		minListWidth : 300,
		resizable: true,
		queryParam: 'filterValue_0',
		minChars : 1, ///caracteres minismo requeridos para iniciar la busqueda
		triggerAction: 'all',
		editable : true,
		renderer: renderFinanciador,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:120 // ancho de columna en el gris
	},
	tipo: 'ComboBox',
	save_as:'hidden_id_financiador'
}
vectorAtributos[1] = paramId_financiador;

filterCols_regional = new Array();
filterValues_regional = new Array();
filterCols_regional[0] = 'frppa.id_financiador';
filterValues_regional[0] = '%';
var paramId_regional = {
	validacion:{
		fieldLabel: 'Regional',
		allowBlank: false,
		vtype:"texto",
		emptyText:'Regional...',
		name: 'id_regional',     //indica la columna del store principal "ds" del que proviane el id
		desc: 'nombre_regional', //indica la columna del store principal "ds" del que proviane la descripcion
		store:ds_regional,
		valueField: 'id_regional',
		displayField: 'nombre_regional',
		queryParam: 'filterValue_0',
		filterCol:'nombre_regional',
		filterCols:filterCols_regional,
		filterValues:filterValues_regional,
		typeAhead: true,
		forceSelection : true,
		mode: 'remote',
		queryDelay: 50,
		pageSize: 10,
		minListWidth : 300,
		resizable: true,
		queryParam: 'filterValue_0',
		minChars : 1, ///caracteres minismo requeridos para iniciar la busqueda
		triggerAction: 'all',
		editable : true,
		renderer: renderRegional,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:120 // ancho de columna en el gris
	},
	tipo: 'ComboBox',
	save_as:'hidden_id_regional'
}
vectorAtributos[2] = paramId_regional;

filterCols_programa= new Array();
filterValues_programa= new Array();
filterCols_programa[0] = 'frppa.id_financiador';
filterValues_programa[0] = '%';
filterCols_programa[1] = 'frppa.id_regional';
filterValues_programa[1] = '%';

var paramId_programa= {
	validacion:{
		fieldLabel: 'Programa',
		allowBlank: false,
		vtype:"texto",
		emptyText:'Programa...',
		name: 'id_programa',     //indica la columna del store principal "ds" del que proviane el id
		desc: 'nombre_programa', //indica la columna del store principal "ds" del que proviane la descripcion
		store:ds_programa,
		valueField: 'id_programa',
		displayField: 'nombre_programa',
		queryParam: 'filterValue_0',
		filterCol:'nombre_programa',
		filterCols:filterCols_programa,
		filterValues:filterValues_programa,
		typeAhead: true,
		forceSelection :true,
		mode: 'remote',
		queryDelay: 50,
		pageSize: 10,
		minListWidth : 300,
		resizable: true,
		queryParam: 'filterValue_0',
		minChars : 1, ///caracteres minismo requeridos para iniciar la busqueda
		triggerAction: 'all',
		editable : true,
		renderer: renderPrograma,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:120 // ancho de columna en el gris
	},
	tipo: 'ComboBox',
	save_as:'hidden_id_programa'
}
vectorAtributos[3] = paramId_programa;

filterCols_proyecto= new Array();
filterValues_proyecto= new Array();
filterCols_proyecto[0] = 'frppa.id_financiador';
filterValues_proyecto[0] = '%';
filterCols_proyecto[1] = 'frppa.id_regional';
filterValues_proyecto[1] = '%';
filterCols_proyecto[2] = 'ppa.id_programa';
filterValues_proyecto[2] = '%';
var paramId_proyecto= {
	validacion:{
		fieldLabel: 'Proyecto',
		allowBlank: false,
		vtype:"texto",
		emptyText:'Proyecto...',
		name: 'id_proyecto',     //indica la columna del store principal "ds" del que proviane el id
		desc: 'nombre_proyecto', //indica la columna del store principal "ds" del que proviane la descripcion
		store:ds_proyecto,
		valueField: 'id_proyecto',
		displayField: 'nombre_proyecto',
		queryParam: 'filterValue_0',
		filterCol:'nombre_proyecto',
		filterCols:filterCols_proyecto,
		filterValues:filterValues_proyecto,
		typeAhead: true,
		forceSelection :true,
		mode: 'remote',
		queryDelay: 50,
		pageSize: 10,
		minListWidth : 300,
		resizable: true,
		queryParam: 'filterValue_0',
		minChars : 1, ///caracteres minismo requeridos para iniciar la busqueda
		triggerAction: 'all',
		editable : true,
		renderer: renderProyecto,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:120 // ancho de columna en el gris
	},
	tipo: 'ComboBox',
	save_as:'hidden_id_proyecto'
}
vectorAtributos[4] = paramId_proyecto;

filterCols_actividad= new Array();
filterValues_actividad= new Array();
filterCols_actividad[0] = 'frppa.id_financiador';
filterValues_actividad[0] = '%';
filterCols_actividad[1] = 'frppa.id_regional';
filterValues_actividad[1] = '%';
filterCols_actividad[2] = 'ppa.id_programa';
filterValues_actividad[2] = '%';
filterCols_actividad[3] = 'ppa.id_proyecto';
filterValues_actividad[3] = '%';


var paramId_actividad= {
	validacion:{
		fieldLabel: 'Actividad',
		allowBlank: false,
		vtype:"texto",
		emptyText:'Actividad...',
		name: 'id_actividad',     //indica la columna del store principal "ds" del que proviane el id
		desc: 'nombre_actividad', //indica la columna del store principal "ds" del que proviane la descripcion
		store:ds_actividad ,
		valueField: 'id_actividad',
		displayField: 'nombre_actividad',
		queryParam: 'filterValue_0',
		filterCol:'nombre_actividad',
		filterCols:filterCols_actividad,
		filterValues:filterValues_actividad,
		typeAhead: true,
		forceSelection : true,
		mode: 'remote',
		queryDelay: 50,
		pageSize: 10,
		minListWidth : 300,
		resizable: true,
		queryParam: 'filterValue_0',
		minChars : 1, ///caracteres minismo requeridos para iniciar la busqueda
		triggerAction: 'all',
		editable : true,
		renderer: renderActividad,
		grid_visible:true, // se muestra en el grid
		grid_editable:false, //es editable en el grid,
		width_grid:120 // ancho de columna en el gris
	},
	tipo: 'ComboBox',
	save_as:'hidden_id_actividad'
}
vectorAtributos[5] = paramId_actividad;
// ----------            FUNCIONES RENDER    ---------------//
function formatDate(value){
	return value ? value.dateFormat('d/m/Y') : '';
};
//---------         INICIAMOS LAYOUT MAESTRO     -----------//
/*
// ---------- Inicia Layout ---------------//
var config = {
titulo_maestro:"Estructura Programatica",
grid_maestro:"ext-grid"
};
Docs.init(config); //se manda como par�metro el vector de configuraci�n
*/
//---------         INICIAMOS HERENCIA           -----------//
/// HEREDAMOS DE LA CLASE MADRE
this.pagina = Pagina;
//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
this.pagina(paramConfig,vectorAtributos,ds);
//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
var ClaseMadre_mostrarFormulario= this.mostrarFormulario; //
var ClaseMadre_ocultarFormulario = this.ocultarFormulario ; //
var ClaseMadre_iniciaFormulario= this.iniciaFormulario; //
var ClaseMadre_btnActualizar = this.btnActualizar; // para heredar de la clase madre la funcion btnEdit de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_btnEdit = this.btnEdit; // para heredar de la clase madre la funcion btnEdit de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_btnEliminar = this.btnEliminar; // para heredar de la clase madre la funcion btnEliminar de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_eliminarSucces = this.eliminarSucess; // para heredar de la clase madre la funcion eliminarSucces de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_btnNew = this.btnNew; // para heredar de la clase madre la funcion brnNew de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_Save = this.Save; //
var ClaseMadre_SaveAndOther = this.SaveAndOther; //
var ClaseMadre_saveSuccess = this.SaveSuccess; // para heredar de la clase madre la funcion ConfirmSave de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_ConfirmSave = this.ConfirmSave; // para heredar de la clase madre la funcion ConfirmSave de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_conexionFailure = this.conexionFailure; // para heredar de la clase madre la funcion eliminarSucces de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_ValidarCampos = this.ValidarCampos; // para heredar de la clase madre la funcion btnEdit de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_limpiarInvalidos = this.limpiarInvalidos; // para heredar de la clase madre la funcion btnEdit de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var  ClaseMadre_getComponente = this.getComponente;
var getSelectionModel = this.getSelectionModel;
ds_financiador.addListener('loadexception',  ClaseMadre_conexionFailure); //se recibe un error
ds_regional.addListener('loadexception',  ClaseMadre_conexionFailure); //se recibe un error
ds_programa.addListener('loadexception',  ClaseMadre_conexionFailure); //se recibe un error
ds_proyecto.addListener('loadexception',  ClaseMadre_conexionFailure); //se recibe un error
ds_actividad.addListener('loadexception',  ClaseMadre_conexionFailure); //se recibe un error
// -----------   DEFINICI�N DE LA BARRA DE MEN� ----------- //
var paramMenu = {
	//		guardar:{
	//			crear : false, //para ver si se creara el boton
	//			separador:false
	//		},
	nuevo: {	crear : true, //para ver si se creara el boton
	separador:true
	},
	editar:{	crear : true, //para ver si se creara el boton
	separador:false
	},
	eliminar:{		crear : true, //para ver si se creara el boton
	separador:false
	},
	actualizar:{
		crear :true,
		separador:false
	}
};
//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
//datos necesarios para ell filtro
parametrosFiltro = "&filterValue_0="+ds.lastOptions.params.filterValue_0+"&filterCol_0="+ds.lastOptions.params.filterCol_0;
var paramFunciones = {
	btnEliminar:{		url:"../../control/activo_fijo_tpm_frppa/ActionEliminaActivoFijoTpmFrppa.php",
	parametros_ds:['hidden_id_activo_fijo']
	},
	Save:{		url:"../../control/activo_fijo_tpm_frppa/ActionSaveActivoFijoTpmFrppa.php",
	parametros_ds:['hidden_id_activo_fijo']
	},
	ConfirmSave:{		url:"../../control/activo_fijo_tpm_frppa/ActionSaveActivoFijoTpmFrppa/.php",
	parametros_ds:['hidden_id_activo_fijo']
	},
	Formulario:{
		html_apply:"dlgInfo_ep",
		width:330,
		height:300,
		minWidth:150,
		minHeight:200,
		labelWidth: 75, //ancho del label
		closable:true,
		columnas:[280],
		grupos:[
		{	tituloGrupo:'Estructura Programatica',
		columna:0,
		id_grupo:0
		}]
	}
}
//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
function iniciarEventosFormularios()
{	combo_financiador = ClaseMadre_getComponente('id_financiador');
combo_regional = ClaseMadre_getComponente('id_regional');
combo_programa = ClaseMadre_getComponente('id_programa');
combo_proyecto = ClaseMadre_getComponente('id_proyecto');
combo_actividad = ClaseMadre_getComponente('id_actividad');
var onFinanciadorSelect = function(e) {
	var id = combo_financiador.getValue()
	combo_regional.filterValues[0] =  id;
	combo_regional.modificado = true;
	combo_programa.filterValues[0] =  id;
	combo_programa.modificado = true;
	combo_proyecto.filterValues[0] =  id;
	combo_proyecto.modificado = true;
	combo_actividad.filterValues[0] =  id;
	combo_actividad.modificado = true;
	combo_regional.setValue('');
	combo_programa.setValue('');
	combo_proyecto.setValue('');
	combo_actividad.setValue('');
};
var onRegionalSelect = function(e) {
	var id = combo_regional.getValue()
	combo_programa.filterValues[1] =  id;
	combo_programa.modificado = true;
	combo_proyecto.filterValues[1] =  id;
	combo_proyecto.modificado = true;
	combo_actividad.filterValues[1] =  id;
	combo_actividad.modificado = true;
	combo_programa.setValue('');
	combo_proyecto.setValue('');
	combo_actividad.setValue('');
};
var onProgramaSelect = function(e) {
	var id = combo_programa.getValue()
	combo_proyecto.filterValues[2] =  id;
	combo_proyecto.modificado = true;
	combo_actividad.filterValues[2] =  id;
	combo_actividad.modificado = true;
	combo_proyecto.setValue('');
	combo_actividad.setValue('');
};
var onProyectoSelect = function(e) {
	var id = combo_proyecto.getValue()
	combo_actividad.filterValues[3] =  id;
	combo_actividad.modificado = true;
	combo_actividad.setValue('');
};
combo_financiador.on('select', onFinanciadorSelect);
combo_financiador.on('change', onFinanciadorSelect);
combo_regional.on('select', onRegionalSelect);
combo_regional.on('change', onRegionalSelect);
combo_programa.on('select', onProgramaSelect);
combo_programa.on('change', onProgramaSelect);
combo_proyecto.on('select', onProyectoSelect);
combo_proyecto.on('change', onProyectoSelect);
}
//----------------      FUNCION ENABLE SELECT       ----------------------//
//Funcion que se llama al seleccionar una fila (para eliminar por ejemplo)//
///-- sobre cargo la funcion madre  enable select ////
this.EnableSelect = function(selModel, row, selected)
{	var SelectionsRecord  = selModel.getSelected(); //es el primer registro selecionado
if(selected && SelectionsRecord != -1)
{	hidden_id_activo_fijo_frppa = ClaseMadre_getComponente('id_activo_fijo_frppa');
combo_financiador = ClaseMadre_getComponente('id_financiador');
combo_regional = ClaseMadre_getComponente('id_regional');
combo_programa = ClaseMadre_getComponente('id_programa');
combo_proyecto = ClaseMadre_getComponente('id_proyecto');
combo_actividad = ClaseMadre_getComponente('id_actividad');
hidden_id_activo_fijo_frppa.setValue(SelectionsRecord.data['id_activo_fijo_frppa']);
if(combo_financiador.store.getById(SelectionsRecord.data['id_financiador']) === undefined)
{	var  params = new Array();
params[combo_financiador.valueField] = SelectionsRecord.data['id_financiador'];
params[combo_financiador.displayField] = SelectionsRecord.data['nombre_financiador'];
var aux = new Ext.data.Record(params,SelectionsRecord.data['id_financiador']);
combo_financiador.store.add(aux)
}
combo_financiador.setValue(SelectionsRecord.data['id_financiador']);
if(combo_regional.store.getById(SelectionsRecord.data['id_regional']) === undefined)
{	var  params = new Array();
params[combo_regional.valueField] = SelectionsRecord.data['id_regional'];
params[combo_regional.displayField] = SelectionsRecord.data['nombre_regional'];
var aux = new Ext.data.Record(params,SelectionsRecord.data['id_regional']);
combo_regional.store.add(aux)
}
combo_regional.setValue(SelectionsRecord.data['id_regional']);
if(combo_programa.store.getById(SelectionsRecord.data['id_programa']) === undefined)
{	var  params = new Array();
params[combo_programa.valueField] = SelectionsRecord.data['id_programa'];
params[combo_programa.displayField] = SelectionsRecord.data['nombre_programa'];
var aux = new Ext.data.Record(params,SelectionsRecord.data['id_programa']);
combo_programa.store.add(aux)
}
combo_programa.setValue(SelectionsRecord.data['id_programa']);
if(combo_proyecto.store.getById(SelectionsRecord.data['id_proyecto']) === undefined)
{	var  params = new Array();
params[combo_proyecto.valueField] = SelectionsRecord.data['id_proyecto'];
params[combo_proyecto.displayField] = SelectionsRecord.data['nombre_proyecto'];
var aux = new Ext.data.Record(params,SelectionsRecord.data['id_proyecto']);
combo_proyecto.store.add(aux)
}
combo_proyecto.setValue(SelectionsRecord.data['id_proyecto']);

if(combo_actividad.store.getById(SelectionsRecord.data['id_actividad']) === undefined)
{	var  params = new Array();
params[combo_actividad.valueField] = SelectionsRecord.data['id_actividad'];
params[combo_actividad.displayField] = SelectionsRecord.data['nombre_actividad'];
var aux = new Ext.data.Record(params,SelectionsRecord.data['id_actividad']);
combo_actividad.store.add(aux)
}
combo_actividad.setValue(SelectionsRecord.data['id_actividad']);
//------------ parametriza los valores iniciales para la estructura programatica ------------//
//--actualiza el id de financiador --/
combo_regional.filterValues[0] =  SelectionsRecord.data['id_financiador'];
combo_regional.modificado = true;
combo_programa.filterValues[0] =  SelectionsRecord.data['id_financiador'];
combo_programa.modificado = true;
combo_proyecto.filterValues[0] =  SelectionsRecord.data['id_financiador'];
combo_proyecto.modificado = true;
combo_actividad.filterValues[0] =  SelectionsRecord.data['id_financiador'];
combo_actividad.modificado = true;
//--actualiza el id de regional--/
combo_programa.filterValues[1] =  SelectionsRecord.data['id_regional'];
combo_programa.modificado = true;
combo_proyecto.filterValues[1] =  SelectionsRecord.data['id_regional'];
combo_proyecto.modificado = true;
combo_actividad.filterValues[1] =  SelectionsRecord.data['id_regional'];
combo_actividad.modificado = true;
//--actualiza el id de programa--/
combo_proyecto.filterValues[2] =  SelectionsRecord.data['id_programa'];
combo_proyecto.modificado = true;
combo_actividad.filterValues[2] =  SelectionsRecord.data['id_programa'];
combo_actividad.modificado = true;
//--actualiza el id de proyecto--/
combo_actividad.filterValues[3] =  SelectionsRecord.data['id_proyecto'];
combo_actividad.modificado = true;
}
}
this.ActualizarEP = function(id)
{	ds.lastOptions.params.filterValue_0=id;
ds.lastOptions.params.hidden_id_activo_fijo=id;
ClaseMadre_btnActualizar();
//alert(this.getBarra().buttons)
var boton_nuevo = this.getBoton('nuevo_ext-grid_ep')
var boton_editar = this.getBoton('editar_ext-grid_ep')
var boton_eliminar = this.getBoton('eliminar_ext-grid_ep')
if(id==" ")
{	boton_nuevo.disable()
boton_editar.disable()
boton_eliminar.disable()
}
else
{	boton_nuevo.enable()
boton_editar.enable()
boton_eliminar.enable()
}
}
//-------------- FIN DEFINICI�N DE FUNCIONES PROPIAS --------------//
//InitBarraMenu(array BOTONES DISPONIBLES);
this.Init(); //iniciamos la clase madre
this.InitBarraMenu(paramMenu);
//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
this.InitFunciones(paramFunciones);
//Se agrega el bot�n para el acceso al detalle (SubTipo de Activos)
this.iniciaFormulario();
epLayout.addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
iniciarEventosFormularios()
}
var obj_pagina;
var obj_ep;
function main ()
{	obj_pagina = new PaginaActivoFijo();
obj_ep = new PaginaEstructuraProgramatica();
}
YAHOO.util.Event.on(window, 'load', main); //arranca todo