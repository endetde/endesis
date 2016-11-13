function GenerarReporteLlamadasLinea(idContenedor,direccion,paramConfig){
	var vectorAtributos=new Array;
	var ContPes=1;
	var layout_rep_llamadas_linea,h_txt_gestion,h_txt_mes,ds_linea;
	// ------------------  PAR�METROS --------------------------//
	/////DATA STORE////////////
	ds_linea=new Ext.data.Store({
		proxy:new Ext.data.HttpProxy({url:direccion+'../../../../../sis_telefonico/control/linea/ActionListarLineaDis.php'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_linea',totalRecords:'TotalCount'},['puerto_linea','empresa','numero_telefono'])
	});
	var resultTplLinea=new Ext.Template('<div class="search-item">','<b><i>{empresa}</i></b>','<br><FONT COLOR="#B5A642">{numero_telefono}</FONT>','</div>');
	/////////// txt linea//////
	vectorAtributos[0]={
		validacion:{
			fieldLabel:'Compa�ia - N�mero',
			allowBlank:false,
			vtype:"texto",
			emptyText:'Linea...',
			name:'numero_telefono',
			desc:'numero_telefono',
			store:ds_linea,
			valueField:'puerto_linea',
			displayField:'numero_telefono',
			filterCol:'numero_telefono',
			typeAhead:false,
			forceSelection:true,
			tpl:resultTplLinea,
			mode:'remote',
			queryDelay:50,
			pageSize:10,
			minListWidth:300,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:0,
			triggerAction:'all',
			editable:true
		},
		id_grupo:0,
		save_as:'txt_linea',
		tipo: 'ComboBox'
	};
	//////// mes /////////
	vectorAtributos[1]={
		validacion:{
			name:'mes',
			fieldLabel:'Mes',
			loadMask:true,
			emptyText:'Mes...',
			allowBlank:false,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({fields:['ID','nombre'],data:[['1','Enero'],['2','Febrero'],['3','Marzo'],['4','Abril'],['5','Mayo'],['6','Junio'],['7','Julio'],['8','Agosto'],['9','Septiembre'],['10','Octubre'],['11','Noviembre'],['12','Diciembre']]}),
			valueField:'ID',
			displayField:'nombre',
			lazyRender:true,
			forceSelection:true
		},
		id_grupo:1,
		tipo:'ComboBox',
		save_as:'txt_mes',
		defecto:""
	};
	vectorAtributos[2]={
		validacion:{
			name:'gestion',
			fieldLabel:'Gesti�n',
			vtype:'texto',
			emptyText:'Gesti�n...',
			allowBlank:false,
			loadMask:true,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({fields:['valor'],data:
			for(var i=2008;i<=2150;i ++){
			       Ext.llamadas_linea_combo.gestion.push([i])
			  }}),
			valueField:'valor',
			displayField:'valor',
			forceSelection:true,
			width:100
		},
		tipo:'ComboBox',
		defecto:'',
		id_grupo:1,
		save_as:'txt_gestion'
	};
	// ----------            FUNCIONES RENDER    ---------------//
	function formatDate(value){return value ? value.dateFormat('d/m/Y'):''}
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
	var config={titulo_maestro:"Llamadas por L�nea"};
	layout_rep_llamadas_linea=new DocsLayoutProceso(idContenedor);
	layout_rep_llamadas_linea.init(config);
	//---------         INICIAMOS HERENCIA           -----------//
	this.pagina=BaseParametrosReporte;
    this.pagina(paramConfig,vectorAtributos,layout_rep_llamadas_linea,idContenedor);
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_getComponente=this.getComponente;
	ds_linea.addListener('loadexception',ClaseMadre_conexionFailure);
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	function iniciarEventosFormularios(){
		h_txt_gestion=ClaseMadre_getComponente('gestion');
		h_txt_mes=ClaseMadre_getComponente('mes');
		var mess=new Date();
		var anio=new Date();
		anio=anio.getFullYear();
		mess=mess.getMonth();
		mess=mess+1;
		h_txt_gestion.setValue(anio);
		h_txt_mes.setValue(mess)		
	}
	//------  sobrecargo la clase madre obtenerTitulo  para las pestanas-----------------//
	function obtenerTitulo(){
		var titulo="Llamadas por L�nea "+ContPes;
		ContPes ++;
		return titulo
	}
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	var paramFunciones={
		Formulario:{labelWidth:75,url:direccion+'../../../../../sis_telefonico/control/_reportes/llamadas_linea/ActionRptLlamadasLinea.php',abrir_pestana:true,titulo_pestana:obtenerTitulo,fileUpload:false,columnas:[320,280],
			        grupos:[{tituloGrupo:'L�nea Telef�nica',columna:0,id_grupo:0},{tituloGrupo:'Mes',columna:1,id_grupo:1}],parametros:''}
	};
	this.Init();
	this.InitFunciones(paramFunciones);
	this.iniciaFormulario();
	iniciarEventosFormularios();
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario)
}