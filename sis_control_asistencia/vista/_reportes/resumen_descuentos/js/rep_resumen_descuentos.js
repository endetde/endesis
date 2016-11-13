function GenerarReporteResumenDescuentos(idContenedor,direccion,paramConfig){
	var vectorAtributos=new Array;
	var ContPes=1;
	var h_txt_fecha_ini;
	var	h_txt_fecha_fin;
   	//////////////////////////////////////////////////////////////
	// ------------------  PAR�METROS --------------------------//
	// Definici�n de todos los tipos de datos que se maneja    //
	//////////////////////////////////////////////////////////////
	/////////// hidden id_tipo_activo//////
	//en la posici�n 0 siempre tiene que estar la llave primaria
	/////DATA STORE////////////
///////// fecha_ini /////////
	vectorAtributos[0]={
		validacion:{
			name:'fecha_ini',
			fieldLabel:'Fecha',
			allowBlank:false,
			format:'d/m/Y', //formato para validacion
			minValue:'01/01/1900',
			disabledDays:[0,2,3,4,5, 6],
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
		dateFormat:'m-d-Y', //formato de fecha que env�a para guardar
		defecto:"" // valor por default para este campo
	};
	///////// fecha /////////
	vectorAtributos[1]={
		validacion:{
			name:'fecha_fin',
			fieldLabel:'Fecha',
			allowBlank:false,
			format:'d/m/Y', //formato para validacion
			minValue:'01/01/1900',
			disabledDays:[0,1,2,3,4, 6],
			disabledDaysText:'D�a no v�lido',
			grid_visible:true,// se muestra en el grid
			grid_editable:false,//es editable en el grid,
			renderer:formatDate,
			width:85,// ancho de columna en el grid
			disabled:true
		},
		id_grupo:1,
		tipo:'TextField',
		save_as:'txt_fecha_fin',
		dateFormat:'m-d-Y', //formato de fecha que env�a para guardar
		defecto:"" // valor por default para este campo
	};	
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
		titulo_maestro:"Resumen Semanal de Descuentos"
	};
	layout_rep_resumen_descuentos=new DocsLayoutProceso(idContenedor);
	layout_rep_resumen_descuentos.init(config);
	//////////////////////////////////////////////////////////////
	//---------         INICIAMOS HERENCIA           -----------//
	//////////////////////////////////////////////////////////////
	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina=BaseParametrosReporte;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
    this.pagina(paramConfig,vectorAtributos,layout_rep_resumen_descuentos,idContenedor);
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
	var ClaseMadre_conexionFailure = this.conexionFailure; // para heredar de la clase madre la funcion eliminarSucces de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
	var ClaseMadre_getComponente = this.getComponente;
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	//Para manejo de eventos
	function get_fecha(fecha)
	{
		var fecha=new Date(fecha);
		var dia;
		var mes;
		var anio;
		var fecha_res;
		dia=fecha.getDate();
		if(dia<10){dia="0"+dia;}
		mes=fecha.getMonth()+1;
		if(mes<10){mes="0"+mes;}
		anio=fecha.getFullYear();
      	fecha_res=mes+"/"+dia+"/"+anio;
		return fecha_res;
	}
function iniciarEventosFormularios()
	{
		h_txt_fecha_ini=ClaseMadre_getComponente('fecha_ini');
		h_txt_fecha_fin=ClaseMadre_getComponente('fecha_fin');	
        function opcion_obs()
		{
         var fecha=h_txt_fecha_ini.getValue();
         var dt=new Date(fecha).add(Date.DAY,4);
         var fecha_fin=get_fecha(dt);
         h_txt_fecha_fin.setValue(fecha_fin);
        }
		h_txt_fecha_ini.on('change',opcion_obs);
		h_txt_fecha_ini.on('select',opcion_obs);	
	}	
	//------  sobrecargo la clase madre obtenerTitulo  para las pestanas-----------------//
	function obtenerTitulo()
	{
		//var combo_financiador = ClaseMadre_getComponente('id_financiador');
		var titulo="Resumen Semanal de Descuentos "+ContPes;
		ContPes ++;
		return titulo;
	}
	//////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////
	var paramFunciones={
		Formulario:{
			labelWidth: 75, //ancho del label
			url:direccion+'../../../../../sis_control_asistencia/control/_reportes/resumen_descuentos/ResumenDescuento.php',
			abrir_pestana:true, //abrir pestana
			titulo_pestana:obtenerTitulo,
			fileUpload:false,
			columnas:[320,280],
			grupos:[{tituloGrupo:'Fecha Inicio',columna:0,id_grupo:0},
					{tituloGrupo:'Fecha Fin',columna:1,id_grupo:1}],
			parametros: ''
		}
	}
	//InitBarraMenu(array BOTONES DISPONIBLES);
	this.Init(); //iniciamos la clase madre
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	this.InitFunciones(paramFunciones);
    //Se agrega el bot�n para la generaci�n del reporte
	this.iniciaFormulario();
	iniciarEventosFormularios();
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}