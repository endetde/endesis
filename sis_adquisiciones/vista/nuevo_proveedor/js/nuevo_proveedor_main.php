//<script>
function main(){
	 <?php
	//obtenemos la ruta absoluta
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$dir = "http://$host$uri/";
	echo "\nvar direccion=\"$dir\";";
	echo "var idContenedor='$idContenedor';";
	?>

var paramConfig={//TiempoEspera:10000

/*TamanoPagina:_CP.getConfig().ss_tam_pag,
	TiempoEspera:_CP.getConfig().ss_tiempo_espera,
	CantFiltros:1,
	FiltroEstructura:false*/
};
var elemento={pagina:new PaginaNuevoProveedor(idContenedor,direccion,paramConfig),idContenedor:idContenedor};
ContenedorPrincipal.setPagina(elemento);
//_CP.setPagina(elemento);
}
Ext.onReady(main,main);


function PaginaNuevoProveedor(idContenedor,direccion,paramConfig){
	var Atributos=new Array();
	var componentes= new Array();

	// Definici�n de todos los tipos de datos que se maneja
	// hidden id_tipo_activo
	//en la posici�n 0 siempre tiene que estar la llave primaria
	//DATA STORE
	ds_tipo_doc_institucion = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/tipo_doc_institucion/ActionListarTipoDocInstitucion.php'}),
			reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_tipo_doc_institucion',
			totalRecords: 'TotalCount'
		}, ['id_tipo_doc_institucion','nombre_tipo_doc','observacion'])
	});
	ds_tipo_doc_identificacion = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_seguridad/control/tipo_doc_identificacion/ActionListarTipoDocIdentificacion.php'}),
			reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_tipo_doc_identificacion',
			totalRecords: 'TotalCount'
		}, ['id_tipo_doc_identificacion','nombre_tipo_documento','descripcion','fecha_registro','hora_registro','fecha_ultima_modificacion','hora_ultima_modificacion'])
	});
	
	
	ds_ciudad=new Ext.data.Store({		
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_seguridad/control/lugar/ActionListarLugar.php'}),
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_lugar',
			totalRecords: 'TotalCount'
		}, [{name:'id_lugar',mapping: 'id_lugar'},
			{name:'nombre',mapping: 'nombre'},
			{name:'codigo',mapping: 'codigo'}])
	});
	
	ds_pais=new Ext.data.Store({		
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_seguridad/control/lugar/ActionListarLugar.php'}),
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_lugar',
			totalRecords: 'TotalCount'
		}, [{name:'id_lugar',mapping: 'id_lugar'},
			{name:'nombre',mapping: 'nombre'},
			{name:'codigo',mapping: 'codigo'}])
	});
	
	
	ds_rubro= new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_adquisiciones/control/proveedor/ActionListarRubros.php'}),
			reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id',
			totalRecords: 'TotalCount'
		}, ['id','id_tipo_servicio','id_supergrupo','nombre','tipo'])
	});
	
	//
	
	Atributos[0]={
			validacion: {
			name:'tipo_proveedor',
			fieldLabel:'Tipo Proveedor',
			allowBlank:false,
			typeAhead:true,
			loadMask:true,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[['empresa','Persona Juridica'],['persona','Persona Natural']]}),
			onSelect: function(record){componentes[0].setValue(record.data.ID);componentes[0].collapse();  CM_mostrarGrupo('Datos Contacto'); if(record.data.ID=='empresa'){provEmpresa();}else{provPersona();}},
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			forceSelection:true
		},
		tipo:'ComboBox',
		save_as:'tipo_proveedor',
		id_grupo:0
	};
	
	
	
	// txt nombre
	Atributos[1]= {
		validacion:{
			name:'nombre_ins',
			fieldLabel:'Nombre',
			allowBlank:false,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'100%' 
		},
		tipo: 'TextField',
		
		save_as:'nombre_ins',
		id_grupo:2
	};
	
	// txt direccion
	Atributos[2]= {
		validacion:{
			name:'direccion_ins',
			fieldLabel:'Direcci�n',
			allowBlank:false,
			maxLength:200,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'100%'
		},
		tipo: 'TextArea',
		save_as:'direccion_ins',
		id_grupo:2
	};
	// txt id_tipo_doc_institucion
	Atributos[3]= {
			validacion: {
			name:'id_tipo_doc_institucion',
			fieldLabel:'Tipo Doc. Instituci�n',
			allowBlank:false,			
			emptyText:'Tipo Documento de Instituci�n...',
			desc: 'desc_tipo_doc_institucion', //indica la columna del store principal ds del que proviane la descripcion
			store:ds_tipo_doc_institucion,
			valueField: 'id_tipo_doc_institucion',
			displayField: 'nombre_tipo_doc',
			queryParam: 'filterValue_0',
			filterCol:'TIDOINS.nombre_tipo_doc',
			typeAhead:true,
			forceSelection:true,
			mode:'remote',
			//queryDelay:50,
			pageSize:50,
			//minListWidth:50,
			grow:true,
			width:'100%',
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1, 
			triggerAction:'all'
			
		},
		tipo:'ComboBox',
		save_as:'id_tipo_doc_institucion',
		id_grupo:2
	};
	
	Atributos[4]= {
		validacion:{
			name:'doc_id',
			fieldLabel:'Doc. Identificaci�n',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		save_as:'doc_id',
		id_grupo:2
	};
	
	
	Atributos[5]={
			validacion: {
			name:'con_contacto',
			fieldLabel:'Persona de Contacto',
			allowBlank:true,
			typeAhead:true,
			loadMask:true,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[['si','si'],['no','no']]}),
			onSelect: function(record){componentes[5].setValue(record.data.ID);componentes[5].collapse();if(record.data.ID=='si'){CM_mostrarGrupo('Datos Persona Contacto');NoBlancosGrupo(4);}else{CM_ocultarGrupo('Datos Persona Contacto');SiBlancosGrupo(4);}},
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			forceSelection:true
		},
		tipo:'ComboBox',
		save_as:'con_contacto',
		defecto:'no',
		id_grupo:2
	};
	
	// txt telefono1
	Atributos[6]= {
		validacion:{
			name:'telefono1',
			fieldLabel:'Telefono 1',
			allowBlank:true,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		save_as:'telefono1',
		id_grupo:3
	};
	
// txt telefono2
	Atributos[7]= {
		validacion:{
			name:'telefono2',
			fieldLabel:'Telefono 2',
			allowBlank:true,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		save_as:'telefono2',
		id_grupo:3
	};
	
// txt celular1
	Atributos[8]= {
		validacion:{
			name:'celular1',
			fieldLabel:'Celular 1',
			allowBlank:true,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		save_as:'celular1',
		id_grupo:3
	};
	
// txt celular2
	Atributos[9] = {
		validacion:{
			name:'celular2',
			fieldLabel:'Celular 2',
			allowBlank:true,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		save_as:'celular2',
		id_grupo:3
	};
	
// txt fax
	Atributos[10]= {
		validacion:{
			name:'fax',
			fieldLabel:'Fax',
			allowBlank:true,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		save_as:'fax',
		id_grupo:3
	};
	
// txt email1
	Atributos[11]= {
		validacion:{
			name:'email1',
			fieldLabel:'Email 1',
			allowBlank:true,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			vtype:'email',
			width:'100%'
		},
		tipo: 'TextField',
		save_as:'email1',
		id_grupo:3
	};
	
// txt email2
	Atributos[12] = {
		validacion:{
			name:'email2',
			fieldLabel:'Email 2',
			allowBlank:true,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			vtype:'email',
			width:'100%'
		},
		tipo: 'TextField',
		save_as:'email2',
		id_grupo:3
	};

// txt pag_web
	Atributos[13]= {
		validacion:{
			name:'pag_web',
			fieldLabel:'Pagina Web',
			allowBlank:true,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'100%'
		},
		tipo: 'TextField',
		save_as:'pag_web',
		id_grupo:3
	};
	
	// txt apellido_paterno
	Atributos[14]= {
		validacion:{
			name:'apellido_paterno',
			fieldLabel:'Apellido Paterno',
			allowBlank:true,
			maxLength:30,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		save_as:'apellido_paterno',
		id_grupo:1
	};
	
// txt apellido_materno
	Atributos[15]= {
		validacion:{
			name:'apellido_materno',
			fieldLabel:'Apellido Materno',
			allowBlank:false,
			maxLength:30,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		filterColValue:'PERSON.apellido_materno',
		save_as:'apellido_materno',
		id_grupo:1
	};
	
// txt nombre
	Atributos[16]= {
		validacion:{
			name:'nombre_p',
			fieldLabel:'Nombre',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		save_as:'nombre_p',
		id_grupo:1
	};
	
	
	
	Atributos[17]= {
			validacion: {
			name:'id_tipo_doc_identificacion',
			fieldLabel:'Doc. Identificaci�n',
			allowBlank:false,			
			emptyText:'Doc. Identificaci�n...',
			desc: 'desc_tipo_doc_identificacion', //indica la columna del store principal ds del que proviane la descripcion
			store:ds_tipo_doc_identificacion,
			valueField: 'id_tipo_doc_identificacion',
			displayField: 'nombre_tipo_documento',
			queryParam: 'filterValue_0',
			filterCol:'TIDOID.nombre_tipo_documento',
			typeAhead:true,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:100,
			minListWidth:250,
			grow:true,
			width:'100%',
			//grow:true,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
			triggerAction:'all',
			editable:true
			
		},
		tipo:'ComboBox',
		save_as:'id_tipo_doc_identificacion',
		id_grupo:1
	};
	
	Atributos[18]= {
		validacion:{
			name:'doc_id_p',
			fieldLabel:'N� Doc. Identificaci�n',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		save_as:'doc_id_p',
		id_grupo:1
	};
	
	// txt casilla
//	Atributos[19]= {
//		validacion:{
//			name:'casilla_p',
//			fieldLabel:'Casilla',
//			allowBlank:true,
//			maxLength:20,
//			minLength:0,
//			selectOnFocus:true,
//			vtype:'texto',
//			width:'80%'
//		},
//		tipo: 'TextField',
//		save_as:'casilla_p',
//		id_grupo:4
//	};
//	
// txt telefono1
//	Atributos[19]= {
//		validacion:{
//			name:'telefono1_p',
//			fieldLabel:'Telefono 1',
//			allowBlank:true,
//			maxLength:20,
//			minLength:0,
//			selectOnFocus:true,
//			vtype:'texto',
//			width:'80%'
//		},
//		tipo: 'TextField',
//		save_as:'telefono1_p',
//		id_grupo:3
//	};
	
// txt telefono2
//	Atributos[20]= {
//		validacion:{
//			name:'telefono2_p',
//			fieldLabel:'Telefono2',
//			allowBlank:true,
//			maxLength:20,
//			minLength:0,
//			selectOnFocus:true,
//			vtype:'texto',
//			width:'80%'
//		},
//		tipo: 'TextField',
//		save_as:'telefono2_p',
//		id_grupo:3
//	};
//	
// txt celular1
//	Atributos[19]= {
//		validacion:{
//			name:'celular1_p',
//			fieldLabel:'Celular 1',
//			allowBlank:true,
//			maxLength:20,
//			minLength:0,
//			selectOnFocus:true,
//			vtype:'texto',
//			width:'80%'
//		},
//		tipo: 'TextField',
//		save_as:'celular1_p',
//		id_grupo:3
//	};
	
// txt celular2
//	Atributos[23]= {
//		validacion:{
//			name:'celular2_p',
//			fieldLabel:'Celular 2',
//			allowBlank:true,
//			maxLength:20,
//			minLength:0,
//			selectOnFocus:true,
//			vtype:'texto',
//			width:'80%'
//		},
//		tipo: 'TextField',
//		save_as:'celular2_p',
//		id_grupo:4
//	};
//	
// txt pag_web
//	Atributos[22]= {
//		validacion:{
//			name:'pag_web_p',
//			fieldLabel:'Pagina Web',
//			allowBlank:true,
//			maxLength:50,
//			minLength:0,
//			selectOnFocus:true,
//			vtype:'texto',
//			width:'80%'
//		},
//		tipo: 'TextField',
//		save_as:'pag_web_p',
//		id_grupo:3
//	};
	
// txt email1
//	Atributos[23]= {
//		validacion:{
//			name:'email1_p',
//			fieldLabel:'Email 1',
//			allowBlank:true,
//			maxLength:100,
//			minLength:0,
//			selectOnFocus:true,
//			vtype:'email',
//			width:'80%'
//		},
//		tipo: 'TextField',
//		save_as:'email1_p',
//		id_grupo:3
//	};
	
// txt email2
//	Atributos[24]= {
//		validacion:{
//			name:'email2_p',
//			fieldLabel:'Email 2',
//			allowBlank:true,
//			maxLength:100,
//			minLength:0,
//			selectOnFocus:true,
//			vtype:'email',
//			width:'80%'
//		},
//		tipo: 'TextField',
//		save_as:'email2_p',
//		id_grupo:3
//	};

	// txt apellido_paterno
	Atributos[19]= {
		validacion:{
			name:'apellido_paterno_c',
			fieldLabel:'Apellido Paterno',
			allowBlank:true,
			maxLength:30,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		save_as:'apellido_paterno_c',
		id_grupo:4
	};
	
// txt apellido_materno
	Atributos[20]= {
		validacion:{
			name:'apellido_materno_c',
			fieldLabel:'Apellido Materno',
			allowBlank:false,
			maxLength:30,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		filterColValue:'PERSON.apellido_materno',
		save_as:'apellido_materno_c',
		id_grupo:4
	};
	
// txt nombre
	Atributos[21]= {
		validacion:{
			name:'nombre_c',
			fieldLabel:'Nombre',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		save_as:'nombre_c',
		id_grupo:4
	};
	
	
	
	
	
// txt telefono1
	Atributos[22]= {
		validacion:{
			name:'telefono1_c',
			fieldLabel:'Telefono 1',
			allowBlank:false,
			maxLength:20,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		save_as:'telefono1_c',
		id_grupo:4
	};
	

	
// txt celular1
	Atributos[23]= {
		validacion:{
			name:'celular1_c',
			fieldLabel:'Celular 1',
			allowBlank:true,
			maxLength:20,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		save_as:'celular1_c',
		id_grupo:4
	};
	
// txt celular2
//	Atributos[32]= {
//		validacion:{
//			name:'celular2_c',
//			fieldLabel:'Celular 2',
//			allowBlank:true,
//			maxLength:20,
//			minLength:0,
//			selectOnFocus:true,
//			vtype:'texto',
//			width:'80%'
//		},
//		tipo: 'TextField',
//		save_as:'celular2_c',
//		id_grupo:3
//	};
//	

	
// txt email1
	Atributos[24]= {
		validacion:{
			name:'email1_c',
			fieldLabel:'Email 1',
			allowBlank:true,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			vtype:'email',
			width:'80%'
		},
		tipo: 'TextField',
		save_as:'email1_c',
		id_grupo:4
	};
	
// txt email2
//	Atributos[34]= {
//		validacion:{
//			name:'email2_c',
//			fieldLabel:'Email 2',
//			allowBlank:true,
//			maxLength:100,
//			minLength:0,
//			selectOnFocus:true,
//			vtype:'email',
//			width:'80%'
//		},
//		tipo: 'TextField',
//		save_as:'email2_c',
//		id_grupo:3
//	};
	
		// txt nombre
	Atributos[25]= {
		validacion:{
			name:'tipo_contacto',
			fieldLabel:'Tipo Contacto',
			allowBlank:false,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		
		save_as:'tipo_contacto',
		id_grupo:4
	};
	
	
	// txt nombre
//	Atributos[35]= {
//		validacion:{
//			name:'codigo',
//			fieldLabel:'C�digo Proveedor',
//			allowBlank:true,
//			maxLength:100,
//			minLength:0,
//			selectOnFocus:true,
//			vtype:'texto',
//			width:'80%'
//		},
//		tipo: 'TextField',
//		defecto:' ',
//		
//		save_as:'codigo',
//		id_grupo:4
//	};
//	
//	// txt nombre
//	
//
//	// txt observaciones
//	Atributos[37]= {
//		validacion:{
//			name:'observaciones',
//			fieldLabel:'Observaciones',
//			allowBlank:true,
//			maxLength:200,
//			minLength:0,
//			selectOnFocus:true,
//			vtype:'texto',
//			width:'100%'
//		},
//		tipo: 'TextArea',
//		save_as:'observaciones',
//		id_grupo:4
//	};
	

	
	
	
	Atributos[26]= {
		validacion:{
			name:'direccion_p',
			fieldLabel:'Direcci�n',
			allowBlank:false,
			maxLength:200,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'100%'
		},
		tipo: 'TextArea',
		save_as:'direccion_p',
		id_grupo:1
	};
	
	Atributos[27]= {
		validacion:{
			name:'direccion_c',
			fieldLabel:'Direcci�n',
			allowBlank:true,
			maxLength:200,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'100%'
		},
		tipo: 'TextField',
		save_as:'direccion_c',
		id_grupo:4
	};
	
	Atributos[28]={
		validacion:{
			fieldLabel: 'Pais',
			allowBlank: false,
			vtype:"texto",
			emptyText:'Pais...',
			name: 'id_lugar',  
			desc: 'pais', 
			store:ds_pais,
			valueField: 'id_lugar',
			displayField: 'nombre',
			queryParam: 'filterValue_0',
			filterCol:'LUGARR.nombre',
			typeAhead: true,   
			onSelect:function(record){
				CM_getComponente('id_depto').reset();
				componentes[28].setValue(record.data.id_lugar);
				
				ds_ciudad.baseParams.padre=record.data.id_lugar;
				CM_getComponente('id_depto').modificado=true;
				componentes[28].collapse();
			},
			forceSelection : true,
			mode: 'remote',
			queryDelay: 250,
			pageSize: 250,
			minListWidth : 250,
			resizable: true,
			queryParam: 'filterValue_0',
			minChars : 1, 
			triggerAction: 'all'
		},
		tipo: 'ComboBox',
		save_as:'id_pais',
		id_grupo:0
	};
	
	Atributos[29]={
		validacion:{
			fieldLabel: 'Ciudad',
			allowBlank: false,
			vtype:"texto",
			emptyText:'Zon...',
			name: 'id_depto',  
			desc: 'ciudad', 
			store:ds_ciudad,
			valueField: 'id_lugar',
			displayField: 'nombre',
			queryParam: 'filterValue_0',
			filterCol:'LUGARR.nombre',
			typeAhead: true,
			forceSelection : true,
			mode: 'remote',
			queryDelay: 450,
			pageSize: 400,
			minListWidth : 300,
			resizable: true,
			queryParam: 'filterValue_0',
			minChars : 1, 
			triggerAction: 'all'
			 
		},
		tipo: 'ComboBox',
		save_as:'id_depto',
		id_grupo:0
	};
	
	Atributos[30]={
		validacion:{
			fieldLabel: 'Rubro',
			allowBlank: false,
			vtype:"texto",
			emptyText:'Rubro...',
			name: 'id',  
			desc: 'ciudad', 
			store:ds_rubro,
			valueField: 'id',
			displayField: 'nombre',
			queryParam: 'filterValue_0',
			filterCol:'rubro.nombre',
			typeAhead: false,
			forceSelection : false,
			onSelect:function(record){
				
				if(record.data.tipo=='bien'){
					componentes[30].setValue(record.data.id_supergrupo);
				}else{
					componentes[30].setValue(record.data.id_tipo_servicio);
				}
				componentes[33].setValue(record.data.tipo);
				componentes[30].setRawValue(record.data.nombre);
				componentes[30].collapse();
			
			},
			mode: 'remote',
			queryDelay: 450,
			pageSize: 400,
			minListWidth : 300,
			resizable: true,
			queryParam: 'filterValue_0',
			minChars : 1, 
			triggerAction: 'all'
			 
		},
		tipo: 'ComboBox',
		save_as:'id_rubro',
		id_grupo:0
	};
	
//	Atributos[43]={
//		validacion:{
//			name:'rubro',
//			fieldLabel:'Rubro',
//			allowBlank:false,
//			maxLength:150,
//			minLength:0,
//			selectOnFocus:true,
//			vtype:'texto'
//			
//		},
//		tipo: 'TextField',
//		save_as:'rubro',
//		id_grupo:0
//	};
	
	Atributos[31]={
		validacion:{
			name:'rubro1',
			fieldLabel:'Rubro 1',
			allowBlank:true,
			maxLength:150,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto'
			
		},
		tipo: 'TextField',
		save_as:'rubro1',
		id_grupo:3
	};
	
	Atributos[32]={
		validacion:{
			name:'rubro2',
			fieldLabel:'Rubro 2',
			allowBlank:true,
			maxLength:150,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto'
			
		},
		tipo: 'TextField',
		save_as:'rubro2',
		id_grupo:3
	};
	
	
	Atributos[33]={
		validacion:{
			name:'tipo',
			allowBlank:false,
			maxLength:150,
			minLength:0,
			inputType:'hidden',
			selectOnFocus:true,
			labelSeparator:''
		},
		tipo: 'Field',
		save_as:'tipo',
		id_grupo:3
	};
	
	Atributos[34]= {
		validacion:{
			name:'nombre_pago',
			fieldLabel:'Nombre Pago',
			allowBlank:true,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'80%'
		},
		tipo: 'TextField',
		
		save_as:'nombre_pago',
		id_grupo:3
	};
	
	Atributos[35]= {
			validacion:{
				name:'codigo',
				fieldLabel:'C�digo',
				allowBlank:false,
				maxLength:20,
				minLength:1,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:true,
				width_grid:120,
				width:'80%'
			},
			tipo: 'TextField',
			filtro_0:true,
			filtro_1:true,
			filterColValue:'INSTIT.codigo',
			save_as:'codigo',
			id_grupo:2
		};
	//////////////////////////////////////////////////////////////
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
	//////////////////////////////////////////////////////////////


	// ---------- Inicia Layout ---------------//
//	var config={
//		titulo_maestro:"Nuevo Proveedor"
//	};
	var config={
		titulo_maestro:"Nuevo Proveedor"
		//titulo_maestro:'Solicitud de Compra',grid_maestro:'grid-'+idContenedor,urlHijo:'../../../sis_adquisiciones/vista/solicitud_compra_bien/sol_compra_bien_det.php'
};
	layout_pagina_nuevo_proveedor=new DocsLayoutProceso(idContenedor);
	layout_pagina_nuevo_proveedor.init(config);

	//////////////////////////////////////////////////////////////
	//---------         INICIAMOS HERENCIA           -----------//
	//////////////////////////////////////////////////////////////

	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina=BaseParametrosReporte;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,Atributos,layout_pagina_nuevo_proveedor,idContenedor);

	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//

	var ClaseMadre_conexionFailure=this.conexionFailure; // para heredar de la clase madre la funcion eliminarSucces de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
	
	var CM_ocultarGrupo=this.ocultarGrupo;
	var CM_mostrarGrupo=this.mostrarGrupo;
	var CM_getComponente=this.getComponente;
	var CM_ocultarComponente=this.ocultarComponente;
	var CM_mostrarComponente=this.mostrarComponente;
	
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	function iniciarEventosFormularios(){
		//CM_ocultarComponente(getComponente('codigo'));
		for (var i=0;i<Atributos.length;i++){
			
			componentes[i]=CM_getComponente(Atributos[i].validacion.name);
		}
		
		
		CM_ocultarGrupo('Datos Empresa');
		CM_ocultarGrupo('Datos Persona');
		CM_ocultarGrupo('Datos Persona Contacto');
		CM_ocultarGrupo('Datos Contacto');
	//	CM_ocultarComponente(componentes[1]);
		
	}
	
	
	function provEmpresa(){
		//CM_mostrarComponente(componentes[5]);
		componentes[5].setValue('no');
		componentes[5].allowBlank=false;
		SiBlancosTodos();
		NoBlancosGrupo(0);
		NoBlancosGrupo(2);
		CM_ocultarGrupo('Datos Persona');
		CM_mostrarGrupo('Datos Empresa');
	}
	function provPersona(){
		//componentes[1].allowBlank=true;
		//CM_ocultarComponente(componentes[1]);
		SiBlancosTodos();
		NoBlancosGrupo(1);
		NoBlancosGrupo(0);
		CM_mostrarGrupo('Datos Persona');
		CM_ocultarGrupo('Datos Empresa');
		CM_ocultarGrupo('Datos Persona Contacto');
	}
	function SiBlancosTodos(){
		for (var i=0;i<componentes.length;i++){
			
			componentes[i].allowBlank=true;
		}
	}
	function SiBlancosGrupo(grupo){
		for (var i=0;i<componentes.length;i++){
			if(Atributos[i].id_grupo==grupo)
			componentes[i].allowBlank=true;
		}
	}
	function NoBlancosGrupo(grupo){
		for (var i=0;i<componentes.length;i++){
			if(Atributos[i].id_grupo==grupo)
				componentes[i].allowBlank=Atributos[i].validacion.allowBlank;
		}
	}


	//////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////

	var paramFunciones = {

		Formulario:{
			labelWidth: 75, //ancho del label
			url:direccion+'../../../control/proveedor/ActionGuardarNuevoProveedor.php',
			abrir_pestana:false, //abrir pestana
		//	titulo_pestana:obtenerTitulo,
			titulo_pestana:'Nuevo Proveedor',
			fileUpload:false,
			success:retorno,
			columnas:[305,305],
			//submit:abrirReportes,
			grupos:[
			{tituloGrupo:'Datos Generales',
			 columna:0,
			 id_grupo:0
			},
			{tituloGrupo:'Datos Persona',
			 columna:0,
			 id_grupo:1},
			 {tituloGrupo:'Datos Empresa',
			 columna:0,
			 id_grupo:2},
			 {tituloGrupo:'Datos Contacto',
			 columna:1,
			 id_grupo:3},
			 {tituloGrupo:'Datos Persona Contacto',
			 columna:1,
			 id_grupo:4}
			],
			parametros: ''
		}
	}
	function retorno(){
		for(var i=0;i<componentes.length;i++){
			componentes[i].reset();
		}
		Ext.Msg.show({
			title:'Estado',
			msg:'Proveedor Insertado satisfactoriamente.',
			minWidth:300,
			maxWidth :800,
			buttons: Ext.Msg.OK
		})
	}
	
	

	//InitBarraMenu(array BOTONES DISPONIBLES);
	this.Init(); //iniciamos la clase madre
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	this.InitFunciones(paramFunciones);
    //Se agrega el bot�n para la generaci�n del reporte
	this.iniciaFormulario();
	iniciarEventosFormularios();
	ds_pais.baseParams={nivel_padre:0};
	layout_pagina_nuevo_proveedor.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}
