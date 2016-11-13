function GenerarReporteTiempoExtra(idContenedor,direccion,paramConfig)
{

	var vectorAtributos = new Array;
	var ContPes = 1;
	var ds_empleado;
	var h_txt_fecha_ini;
	var	h_txt_fecha_fin;
    var txt_id_gerencia,txt_nombre,txt_descripcion_gerencia,txt_codigo,txt_button,combo_empleado,txt_rol;
	//////////////////////////////////////////////////////////////
	// ------------------  PAR�METROS --------------------------//
	// Definici�n de todos los tipos de datos que se maneja    //
	//////////////////////////////////////////////////////////////

	/////////// hidden id_tipo_activo//////
	//en la posici�n 0 siempre tiene que estar la llave primaria
	/////DATA STORE////////////
	ds_empleado=new Ext.data.Store({
		proxy:new Ext.data.HttpProxy({url:direccion+'../../../../../sis_kardex_personal/control/empleado/ActionListarFuncionario.php'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_empleado',totalRecords:'TotalCount'},['id_empleado','id_persona','desc_persona'])
	});
	//Define las columnas a desplegar
	/////////// txt codigo//////
   /* var filterCols_funcionario=new Array();
	var filterValues_funcionario=new Array();
	filterCols_funcionario[0]='EMPEXT.id_gerencia';
	filterValues_funcionario[0]='%';*/
	vectorAtributos[0]={
		validacion:{
			fieldLabel:'Funcionario',
			allowBlank:false,
			vtype:"texto",
			emptyText:'Funcionario...',
			name:'id_empleado',
			desc:'desc_persona',
			store:ds_empleado,
			valueField:'id_empleado',
			displayField:'desc_persona',
			queryParam:'filterValue_0',
			filterCol:'FUNCIO.desc_persona',
			/*filterCols:filterCols_funcionario,
			filterValues:filterValues_funcionario,*/
			typeAhead:false,
			forceSelection:true,
			//tpl:resultTplEmp,
			mode:'remote',
			queryDelay:50,
			pageSize:10,
			minListWidth:300,
			resizable:true,
			minChars:0,
			triggerAction:'all',
			editable:true
		},
		id_grupo:2,
		save_as:'txt_id_empleado',
		tipo:'ComboBox'
	};
///////// fecha_ini /////////
	var paramFechaIni = {
		validacion:{
			name:'fecha_ini',
			fieldLabel:'Fecha',
			allowBlank:false,
			format:'d/m/Y', //formato para validacion
			minValue:'01/01/1900',
			//disabledDays:[0, 6],
			disabledDaysText:'D�a no v�lido',
			grid_visible:true,// se muestra en el grid
			grid_editable:false,//es editable en el grid,
			renderer:formatDate,
			width_grid:120,// ancho de columna en el grid
			disabled:false
		},
		id_grupo:0,
		tipo:'DateField',
		save_as:'txt_fecha_ini',
		dateFormat:'m/d/Y', //formato de fecha que env�a para guardar
		defecto:"" // valor por default para este campo
	};
	vectorAtributos[1] = paramFechaIni;
	///////// fecha /////////
	var paramFechaFin = {
		validacion:{
			name:'fecha_fin',
			fieldLabel:'Fecha',
			allowBlank:false,
			format:'d/m/Y', //formato para validacion
			minValue:'01/01/1900',
			//disabledDays:[0, 6],
			disabledDaysText:'D�a no v�lido',
			grid_visible:true,// se muestra en el grid
			grid_editable:false,//es editable en el grid,
			renderer:formatDate,
			width_grid:120,// ancho de columna en el grid
			disabled:false
		},
		id_grupo:1,
		tipo:'DateField',
		save_as:'txt_fecha_fin',
		dateFormat:'m/d/Y', //formato de fecha que env�a para guardar
		defecto:"" // valor por default para este campo
	};
	vectorAtributos[2] = paramFechaFin;
	
		/////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	function formatDate(value){
		return value ? value.dateFormat('d/m/Y') : '';
	};

	//////////////////////////////////////////////////////////////
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
	//////////////////////////////////////////////////////////////


	// ---------- Inicia Layout ---------------//
	var config = {
		titulo_maestro:"Total de Tiempo Extra Trabajado"
	};
	layout_rep_tiempo_extra=new DocsLayoutProceso(idContenedor);
	layout_rep_tiempo_extra.init(config);

	//////////////////////////////////////////////////////////////
	//---------         INICIAMOS HERENCIA           -----------//
	//////////////////////////////////////////////////////////////

	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina=BaseParametrosReporte;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
    this.pagina(paramConfig,vectorAtributos,layout_rep_tiempo_extra,idContenedor);

	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//


	var ClaseMadre_conexionFailure = this.conexionFailure; // para heredar de la clase madre la funcion eliminarSucces de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
	var ClaseMadre_getComponente = this.getComponente;


	ds_empleado.addListener('loadexception',  ClaseMadre_conexionFailure); //se recibe un error
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//

	function iniciarEventosFormularios()
	{
		h_txt_fecha_ini = ClaseMadre_getComponente('fecha_ini');
		h_txt_fecha_fin = ClaseMadre_getComponente('fecha_fin');
		combo_empleado=ClaseMadre_getComponente('id_empleado');
		var $mes = new Date();
		$mes = $mes.getMonth();
		$mes=$mes+1;
		var $primera_fecha = new Date();
		$primera_fecha ='01/0'+$mes+'/'+$primera_fecha.getFullYear();
		h_txt_fecha_ini.setValue($primera_fecha);
		var $fecha_actual = new Date();
		$fecha_actual =$fecha_actual.getDate()+'/0'+$mes+'/'+$fecha_actual.getFullYear();
		h_txt_fecha_fin.setValue($fecha_actual);


	}
function eventosAjax(){
		Ext.lib.Ajax.request('POST','../../../sis_telefonico/control/_reportes/llamadas_gerencia/ActionGerencia.php?asistencia=si',
		                     {success:gerencia,failure:this.conexionFailure})
	}
	var InitFunciones=this.InitFunciones;
    //Se agrega el bot�n para la generaci�n del reporte
	var iniciaFormulario=this.iniciaFormulario;
	//------  sobrecargo la clase madre obtenerTitulo  para las pestanas-----------------//
	function obtenerTitulo()
	{
		//var combo_financiador = ClaseMadre_getComponente('id_financiador');
		var titulo = "Total de Tiempo Extra Trabajado "+ ContPes;
		ContPes ++;
		return titulo;
	}


	//////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////
function gerencia(resp){
		var regreso=Ext.util.JSON.decode(resp.responseText);
		txt_id_gerencia=regreso.id_gerencia;
		txt_nombre=regreso.nombre_gerencia;
		txt_codigo=regreso.codigo;
		txt_descripcion_gerencia=regreso.descripcion;
		txt_rol=regreso.rol;
		var paramFunciones={
 		    Formulario:{
			labelWidth: 75, //ancho del label
			url:direccion+'../../../../../sis_control_asistencia/control/_reportes/tiempo_extra/TiempoExtra.php',
			abrir_pestana:true, //abrir pestana
			titulo_pestana:obtenerTitulo,
			fileUpload:false,
			columnas:[320,280],
			grupos:[
			{
				tituloGrupo:'Fecha Inicio',
				columna:0,
				id_grupo:0
			},
			{
				tituloGrupo:'Fecha Fin',
				columna:0,
				id_grupo:1
			},
			{
				tituloGrupo:'Funcionario',
				columna:1,
				id_grupo:2
			}],
			parametros: ''
		}
	};
		InitFunciones(paramFunciones);
		iniciaFormulario();
		iniciarEventosFormularios();
		if(txt_codigo=='null'){
			Ext.Msg.show({
			title:'Estado',
			msg:'El Usuario no pertenece a ninguna Gerencia.',
			minWidth:300,
			maxWidth :800,
			buttons: Ext.Msg.OK
		})
		 txt_button=ClaseMadre_getForm();
		 txt_button.buttons[0].disable()
		}
		if(txt_codigo=='GGN' || txt_codigo=='GTI' || txt_rol==1){
			/*combo_empleado.filterValues[0]=txt_id_gerencia;
			combo_empleado.modificado=true;*/
			combo_empleado.enable()
		}
		else{
			combo_empleado.filterValues[0]=txt_id_gerencia;
			combo_empleado.modificado=true
		}
	}
	


//InitBarraMenu(array BOTONES DISPONIBLES);
	this.Init(); //iniciamos la clase madre
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	eventosAjax();
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);	
}