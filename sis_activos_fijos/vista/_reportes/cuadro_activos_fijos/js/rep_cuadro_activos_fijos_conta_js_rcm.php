//<script>
function GenerarReporteCuadroActivosFijosConta()
{	var vectorAtributos = new Array;
var ContPes = 1;
//Configuraci�n p�gina
paramConfig = {
	TiempoEspera:10000//tiempo de espera para dar fallo
};

//// ------------------  PAR�METROS --------------------------//
// Definici�n de todos los tipos de datos que se maneja    //
/////////// hidden id_tipo_activo//////
//en la posici�n 0 siempre tiene que estar la llave primaria
ds_financiador = new Ext.data.Store({
	// asigna url de donde se cargaran los datos

	proxy: new Ext.data.HttpProxy({url: '../../../../sis_parametros/control/financiador/ActionListaFinanciadorEP.php?origen=filtro'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_financiador',
		totalRecords: 'TotalCount'

	}, ['id_financiador','nombre_financiador','codigo_financiador'])

})
ds_regional = new Ext.data.Store({
	// asigna url de donde se cargaran los datos

	proxy: new Ext.data.HttpProxy({url: '../../../../sis_parametros/control/regional/ActionListaRegionalEP.php?origen=filtro'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_regional',
		totalRecords: 'TotalCount'

	}, ['id_regional','nombre_regional'])//,
})

ds_programa = new Ext.data.Store({
	// asigna url de donde se cargaran los datos
	proxy: new Ext.data.HttpProxy({url: '../../../../sis_parametros/control/programa/ActionListaProgramaEP.php?origen=filtro'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_programa',
		totalRecords: 'TotalCount'

	}, ['id_programa','nombre_programa'])//,
})

ds_proyecto = new Ext.data.Store({
	// asigna url de donde se cargaran los datos
	proxy: new Ext.data.HttpProxy({url: '../../../../sis_parametros/control/proyecto/ActionListaProyectoEP.php?origen=filtro'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_proyecto',
		totalRecords: 'TotalCount'

	}, ['id_proyecto','nombre_proyecto'])//,
})

ds_auxiliar = new Ext.data.Store({
	// asigna url de donde se cargaran los datos

	proxy: new Ext.data.HttpProxy({url: '../../../../sis_activos_fijos/control/auxiliar/ActionListaAuxiliarCom.php?origen=filtro'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_auxiliar',
		totalRecords: 'TotalCount'

	}, ['id','id_auxiliar','descrip','desc_auxiliar'])

})

///////////// txt codigo//////
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
		forceSelection : true,
		mode: 'remote',
		queryDelay: 50,
		pageSize: 10,
		minListWidth : 300,
		resizable: true,
		queryParam: 'filterValue_0',
		minChars : 0, ///caracteres minismo requeridos para iniciar la busqueda
		triggerAction: 'all',
		editable : true
	},
	id_grupo:0,
	save_as:'hidden_id_financiador',
	tipo: 'ComboBox'
}
//vectorAtributos[4] = paramId_financiador;
vectorAtributos[0] = paramId_financiador;

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
		minChars : 0, ///caracteres minismo requeridos para iniciar la busqueda
		triggerAction: 'all',
		editable : true
	},
	id_grupo:0,
	save_as:'hidden_id_regional',
	tipo: 'ComboBox'
}
vectorAtributos[1] = paramId_regional;

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
		forceSelection : true,
		mode: 'remote',
		queryDelay: 50,
		pageSize: 10,
		minListWidth : 300,
		resizable: true,
		queryParam: 'filterValue_0',
		minChars : 0, ///caracteres minismo requeridos para iniciar la busqueda
		triggerAction: 'all',
		editable : true
	},
	id_grupo:0,
	save_as:'hidden_id_programa',
	tipo: 'ComboBox'
}
//vectorAtributos[6] = paramId_programa;
vectorAtributos[2] = paramId_programa;

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
		forceSelection : true,
		mode: 'remote',
		queryDelay: 50,
		pageSize: 10,
		minListWidth : 300,
		resizable: true,
		queryParam: 'filterValue_0',
		minChars : 0, ///caracteres minismo requeridos para iniciar la busqueda
		triggerAction: 'all',
		editable : true
	},
	id_grupo:0,
	save_as:'hidden_id_proyecto',
	tipo: 'ComboBox'
}
vectorAtributos[3] = paramId_proyecto;

///////////// Auxiliar//////
var paramAuxiliar = {
	validacion:{
		fieldLabel: 'Auxiliar',
		allowBlank: false,
		vtype:"texto",
		emptyText:'Auxiliar...',
		name: 'id_auxiliar',     //indica la columna del store principal "ds" del que proviane el id
		desc: 'desc_auxiliar', //indica la columna del store principal "ds" del que proviane la descripcion
		store:ds_auxiliar,
		valueField: 'id',
		displayField: 'desc_auxiliar',
		queryParam: 'filterValue_0',
		filterCol:'descrip#id_auxiliar',
		typeAhead: false,
		forceSelection: false,
		mode: 'remote',
		queryDelay: 50,
		pageSize: 10,
		minListWidth : 300,
		resizable: true,
		queryParam: 'filterValue_0',
		minChars : 0, ///caracteres minismo requeridos para iniciar la busqueda
		triggerAction: 'all',
		editable : true
	},
	id_grupo:1,
	save_as:'hidden_id_auxiliar',
	tipo: 'ComboBox'
}
vectorAtributos[4] = paramAuxiliar;

var paramFecha={
	validacion:{
		name:'fecha',
		fieldLabel:'Per�odo',
		allowBlank:false,
		format: 'd/m/Y', //formato para validacion
		minValue: '01/01/1900',
		disabledDaysText: 'D�a no v�lido',
		grid_visible:true,
		grid_editable:false,
		renderer: formatDate,
		width_grid:85,
		disabled:false
	},
	id_grupo:1,
	tipo:'DateField',
	filtro_0:true,
	dateFormat:'m/d/Y',
	defecto:'',
	save_as:'txt_fecha'
};
vectorAtributos[5] = paramFecha;

var paramTipoRep = {
	validacion: {
		name: 'tipo_rep',
		fieldLabel: 'Tipo Reporte',
		allowBlank: false,
		triggerAction: 'all',
		store: new Ext.data.SimpleStore({
			fields: ['ID', 'valor'],
			data : Ext.proc_cuadroCombo.tipo_rep
		}),
		valueField:'ID',
		displayField:'valor',
		lazyRender:true,
		forceSelection:true,
		width_grid:75, // ancho de columna en el grid
		width: 120
	},
	tipo:'ComboBox',
	defecto:'Detalle',
	id_grupo:1,
	save_as:'txt_tipo_rep'
}
vectorAtributos[6] = paramTipoRep;

//// ----------            FUNCIONES RENDER    ---------------//
function formatDate(value){
	return value ? value.dateFormat('d/m/Y') : '';
};

// ---------- Inicia Layout ---------------//
var config = {
	titulo_maestro:"Par�metros Para la Incorporaci�n de Activos "
};
Docs.init(config); //se manda como par�metro el vector de configuraci�n


//---------         INICIAMOS HERENCIA           -----------//

/// HEREDAMOS DE LA CLASE MADRE
this.pagina=BaseParametrosReporte;
//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
this.pagina(paramConfig,vectorAtributos);

//--------------- HERENCIA DE LA CLASE MADRE ---------------------//


var ClaseMadre_conexionFailure = this.conexionFailure; // para heredar de la clase madre la funcion eliminarSucces de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
var ClaseMadre_getComponente = this.getComponente;


ds_financiador.addListener('loadexception',  ClaseMadre_conexionFailure); //se recibe un error
ds_regional.addListener('loadexception',  ClaseMadre_conexionFailure); //se recibe un error
ds_programa.addListener('loadexception',  ClaseMadre_conexionFailure); //se recibe un error
ds_proyecto.addListener('loadexception',  ClaseMadre_conexionFailure); //se recibe un error
//ds_actividad.addListener('loadexception',  ClaseMadre_conexionFailure); //se recibe un error
//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//

function iniciarEventosFormularios()
{
	combo_financiador = ClaseMadre_getComponente('id_financiador');
	combo_regional = ClaseMadre_getComponente('id_regional');
	combo_programa = ClaseMadre_getComponente('id_programa');
	combo_proyecto = ClaseMadre_getComponente('id_proyecto');
	v_tipo_rep = ClaseMadre_getComponente('tipo_rep');
	//combo_actividad = ClaseMadre_getComponente('id_actividad');
	
	v_tipo_rep.setValue('det');

	var onFinanciadorSelect = function(e) {
		var id = combo_financiador.getValue()
		combo_regional.filterValues[0] =  id;
		combo_regional.modificado = true;
		combo_programa.filterValues[0] =  id;
		combo_programa.modificado = true;
		combo_proyecto.filterValues[0] =  id;
		combo_proyecto.modificado = true;
		/*combo_actividad.filterValues[0] =  id;
		combo_actividad.modificado = true;*/


		//Carga el valor por defecto de la regional
		var  params0 = new Array();
		params0['id_regional'] = '%';
		params0['nombre_regional'] = 'Todos las Regionales';
		var aux0 = new Ext.data.Record(params0,'%');
		combo_regional.store.add(aux0)
		combo_regional.setValue('%');
		///////
		//Carga el valor por defecto del programa
		var  params1 = new Array();
		params1['id_programa'] = '%';
		params1['nombre_programa'] = 'Todos los Programas';
		var aux1 = new Ext.data.Record(params1,'%');
		combo_programa.store.add(aux1)
		combo_programa.setValue('%');
		///////
		//Carga el valor por defecto del proyecto
		var  params2 = new Array();
		params2['id_proyecto'] = '%';
		params2['nombre_proyecto'] = 'Todos los Proyectos';
		var aux2 = new Ext.data.Record(params2,'%');
		combo_proyecto.store.add(aux2)
		combo_proyecto.setValue('%');
		///////
		//Carga el valor por defecto de la actividad
		/*var  params3 = new Array();
		params3['id_actividad'] = '%';
		params3['nombre_actividad'] = 'Todos las Actividades';
		var aux3 = new Ext.data.Record(params3,'%');
		combo_actividad.store.add(aux3)
		combo_actividad.setValue('%');	*/

	};
	var onRegionalSelect = function(e) {
		var id = combo_regional.getValue()
		combo_programa.filterValues[1] =  id;
		combo_programa.modificado = true;
		combo_proyecto.filterValues[1] =  id;
		combo_proyecto.modificado = true;
		/*combo_actividad.filterValues[1] =  id;
		combo_actividad.modificado = true;
		combo_tipo.filterValues[1] =  id;
		combo_tipo.modificado = true;*/

		//Carga el valor por defecto del programa
		var  params1 = new Array();
		params1['id_programa'] = '%';
		params1['nombre_programa'] = 'Todos los Programas';
		var aux1 = new Ext.data.Record(params1,'%');
		combo_programa.store.add(aux1)
		combo_programa.setValue('%');
		///////
		//Carga el valor por defecto del proyecto
		var  params2 = new Array();
		params2['id_proyecto'] = '%';
		params2['nombre_proyecto'] = 'Todos los Proyectos';
		var aux2 = new Ext.data.Record(params2,'%');
		combo_proyecto.store.add(aux2)
		combo_proyecto.setValue('%');
		///////
		//Carga el valor por defecto de la actividad
		/*var  params3 = new Array();
		params3['id_actividad'] = '%';
		params3['nombre_actividad'] = 'Todos las Actividades';
		var aux3 = new Ext.data.Record(params3,'%');
		combo_actividad.store.add(aux3)
		combo_actividad.setValue('%');	*/


	};
	var onProgramaSelect = function(e) {
		var id = combo_programa.getValue()
		combo_proyecto.filterValues[2] =  id;
		combo_proyecto.modificado = true;
		/*combo_actividad.filterValues[2] =  id;
		combo_actividad.modificado = true;
		combo_tipo.filterValues[2] =  id;
		combo_tipo.modificado = true;*/

		//Carga el valor por defecto del proyecto
		var  params2 = new Array();
		params2['id_proyecto'] = '%';
		params2['nombre_proyecto'] = 'Todos los Proyectos';
		var aux2 = new Ext.data.Record(params2,'%');
		combo_proyecto.store.add(aux2)
		combo_proyecto.setValue('%');
		///////
		//Carga el valor por defecto de la actividad
		/*var  params3 = new Array();
		params3['id_actividad'] = '%';
		params3['nombre_actividad'] = 'Todos las Actividades';
		var aux3 = new Ext.data.Record(params3,'%');
		combo_actividad.store.add(aux3)
		combo_actividad.setValue('%');	*/


	};
	/*var onProyectoSelect = function(e) {
	var id = combo_proyecto.getValue()
	combo_actividad.filterValues[3] =  id;
	combo_actividad.modificado = true;
	combo_tipo.filterValues[3] =  id;
	combo_tipo.modificado = true;

	//Carga el valor por defecto de la actividad
	var  params3 = new Array();
	params3['id_actividad'] = '%';
	params3['nombre_actividad'] = 'Todos las Actividades';
	var aux3 = new Ext.data.Record(params3,'%');
	combo_actividad.store.add(aux3)
	combo_actividad.setValue('%');
	};*/


	/*var onActividadSelect = function(e) {
	var id = combo_actividad.getValue()
	combo_tipo.filterValues[4] =  id;
	combo_tipo.modificado = true;

	};
	*/

	combo_financiador.on('select', onFinanciadorSelect);
	combo_financiador.on('change', onFinanciadorSelect);
	combo_regional.on('select', onRegionalSelect);
	combo_regional.on('change', onRegionalSelect);
	combo_programa.on('select', onProgramaSelect);
	combo_programa.on('change', onProgramaSelect);
	/*combo_proyecto.on('select', onProyectoSelect);
	combo_proyecto.on('change', onProyectoSelect);*/
	/* combo_actividad.on('select', onActividadSelect);
	combo_actividad.on('change', onActividadSelect);*/

}


//------  sobrecargo la clase madre obtenerTitulo  para las pestanas-----------------//
function obtenerTitulo()
{
	//var combo_financiador = ClaseMadre_getComponente('mes_ini');
	//return combo_financiador.getValue();
	var titulo = "Cuadro de Activos Fijos "+ ContPes;
	ContPes ++;
	return titulo;
}


//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //

var paramFunciones = {

	Formulario:{
		labelWidth: 75, //ancho del label
		url:'../../../control/_reportes/activo_fijo_cuadro/ActionPDFActivoFijoCuadroConta.php',
		abrir_pestana:true, //abrir pestana
		titulo_pestana:obtenerTitulo,
		fileUpload:false,
		columnas:[380,380],
		grupos:[
		{
			tituloGrupo:'Estructura Program�tica',
			columna:0,
			id_grupo:0
		},
		{
			tituloGrupo:'Ingreso de Filtros para el Reporte',
			columna:1,
			id_grupo:1
		}],
		parametros: ''
	}
}


//InitBarraMenu(array BOTONES DISPONIBLES);
this.Init(); //iniciamos la clase madre
//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
this.InitFunciones(paramFunciones);

//Se agrega el bot�n para el acceso al detalle (SubTipo de Activos)

this.iniciaFormulario();

iniciarEventosFormularios();

innerLayout.addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
}

var obj_pagina;
function main ()
{	obj_pagina = new GenerarReporteCuadroActivosFijosConta();
}

YAHOO.util.Event.on(window, 'load', main); //arranca todo