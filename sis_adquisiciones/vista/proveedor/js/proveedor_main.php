<?php 
/**
 * Nombre:		  	    proveedor_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2007-10-17 10:31:08
 *
 */
session_start();
?>
//<script>
var paginaTipoActivo;

	function main(){
	 	<?php
		//obtenemos la ruta absoluta
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$dir = "http://$host$uri/";
		echo "\nvar direccion='$dir';";
	    echo "var idContenedor='$idContenedor';";
	?>
var paramConfig={TamanoPagina:20,TiempoEspera:10000,CantFiltros:2,FiltroEstructura:false,FiltroAvanzado:<?php echo $_SESSION["ss_filtro_avanzado"];?>};
var elemento={pagina:new pagina_proveedor(idContenedor,direccion,paramConfig),idContenedor:idContenedor};
ContenedorPrincipal.setPagina(elemento);
}
Ext.onReady(main,main);


/**
* Nombre:		  	    pagina_proveedor_main.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
* Fecha creaci�n:		2007-10-17 10:31:08
*/
function pagina_proveedor(idContenedor,direccion,paramConfig)
{	var vectorAtributos=new Array;
var ds;
var elementos=new Array();
var componentes=new Array();
var sw=0;
var ds_pais;
var ds_ciudad;
/////////////////
//  DATA STORE //
/////////////////
ds = new Ext.data.Store({
	// asigna url de donde se cargaran los datos
	proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/proveedor/ActionListarProveedor.php'}),
	// aqui se define la estructura del XML
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_proveedor',
		totalRecords: 'TotalCount'
	}, [
	// define el mapeo de XML a las etiquetas (campos)
	'id_proveedor',
	'codigo',
	'observaciones',
	{name: 'fecha_reg',type:'date',dateFormat:'Y-m-d'},
	'id_institucion',
			'desc_institucion',
			'desc_persona',
	'nombre_proveedor',
	'id_persona',
	'nombre_persona',
	'usuario',
	'contrasena',
	'confirmado',
	'nombre_pago','direccion_proveedor','telefono1_proveedor','telefono2_proveedor','mail_proveedor','fax_proveedor',

	'casilla_proveedor',
	'celular1_proveedor',
	'celular2_proveedor',
	'email2_proveedor',
	'pag_web_proveedor',
	'nombre_contacto',
	'direccion_contacto',
	'telefono_contacto',
	'email_contacto',
	'tipo_contacto',
	'id_contacto','con_contacto',
	'id_depto',
	'ciudad',
	'pais',
	'rubro',
	'rubro1',
	'rubro2','tipo_doc_identificacion','doc_id'
	,'paterno','materno','nombre','id_tipo_doc_identificacion','id_tipo_doc_institucion','id'
	]),remoteSort:true});
	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros
		}
	});

	//DATA STORE COMBOS
	ds_institucion = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/institucion/ActionListarInstitucion.php'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_institucion',
		totalRecords: 'TotalCount'
	}, ['id_institucion','tdoc_id','doc_id','nombre','casilla','telefono1','telefono2','celular1','celular2','fax','email1','email2','pag_web','observaciones','fecha_registro','hora_registro','fecha_ultima_modificacion','hora_ultima_modificacion','estado_institucion','id_persona'])
	});
	
	
	/*ENDE-0001: 24/08/2012: Adicion en store de campo desc_tipo_doc_identificacion*/
	ds_persona = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_seguridad/control/persona/ActionListarPersona.php'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_persona',
		totalRecords: 'TotalCount'
	}, ['id_persona','apellido_paterno','apellido_materno','nombre','fecha_nacimiento','foto_persona','doc_id','genero','casilla','telefono1','telefono2','celular1','celular2','pag_web','email1','email2','email3','fecha_registro','hora_registro','fecha_ultima_modificacion','hora_ultima_modificacion','observaciones','id_tipo_doc_identificacion','desc_per','direccion','desc_tipo_doc_identificacion'])
	});



	ds_contacto = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_seguridad/control/persona/ActionListarPersona.php'}),
	reader: new Ext.data.XmlReader({
		record: 'ROWS',
		id: 'id_persona',
		totalRecords: 'TotalCount'
	}, ['id_persona','apellido_paterno','apellido_materno','nombre','fecha_nacimiento','foto_persona','doc_id','genero','casilla','telefono1','telefono2','celular1','celular2','pag_web','email1','email2','email3','fecha_registro','hora_registro','fecha_ultima_modificacion','hora_ultima_modificacion','observaciones','id_tipo_doc_identificacion','desc_per','direccion'])
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


	ds_rubro=new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_adquisiciones/control/proveedor/ActionListarRubros.php'}),
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id',
			totalRecords: 'TotalCount'
		}, ['id','id_tipo_servicio','id_supergrupo','nombre','tipo'])
	});
	
	/*ds_tipo_doc_institucion = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/tipo_doc_institucion/ActionListarTipoDocInstitucion.php'}),
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
	});*/

	//FUNCIONES RENDER
	function render_id_institucion(value, p, record){return String.format('{0}', record.data['desc_institucion']);}
	function render_id_persona(value, p, record){return String.format('{0}', record.data['desc_persona']);}
	//function renderHaber(value, p, record){return String.format('{0}', record.data['nombre_cuenta']);}
	function renderCiudad(value, p, record){return String.format('{0}', record.data['ciudad'])}
	function renderPais(value, p, record){return String.format('{0}', record.data['pais'])}
	function render_id_contacto(value, p, record){return String.format('{0}', record.data['nombre_contacto']);}
	//function render_id_tipo_doc(value, p, record){return String.format('{0}', record.data['tipo_doc_identificacion']);}
	function render_rubro(value, p, record){return String.format('{0}', record.data['rubro']);}
	
	
	
	
	var tpl_id_persona=new Ext.Template('<div class="search-item">','{nombre} ','{apellido_paterno} ','{apellido_materno}','</div>');
	
	/////////////////////////
	// Definici�n de datos //
	/////////////////////////
	// hidden id_proveedor
	//en la posici�n 0 siempre esta la llave primaria
	vectorAtributos[0]= {
		validacion:{
			//fieldLabel: 'Id',
			labelSeparator:'',
			name: 'id_proveedor',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false

		},
		tipo: 'Field',
		filtro_0:false,
		id_grupo:0,
		save_as:'hidden_id_proveedor'
	};

	// txt codigo
	


	vectorAtributos[1]= {
		validacion: {
			name:'persona_institucion',
			fieldLabel:'Tipo Contratista',
			allowBlank:true,
			typeAhead: true,
			loadMask: true,
			triggerAction: 'all',

			//store: new Ext.data.SimpleStore({fields: ['ID','valor'],data : Ext.proveedor_combo.persona_institucion}),
			store: new Ext.data.SimpleStore({fields: ['ID','valor'],data : [['persona','Persona'],['institucion','Instituci�n']]}),
			valueField:'ID',
			displayField:'valor',
			lazyRender:true,
			forceSelection:true,
			grid_visible:false,
			grid_editable:false,
			width_grid:110, // ancho de columna en el gris
			disabled:true,
			grid_indice:2
		},
		tipo:'ComboBox',
		filterColValue:'CONTRA.estado_registro',
		save_as:'persona_institucion',
		id_grupo:0
	};

	vectorAtributos[2]= {
			validacion:{
				//fieldLabel: 'Id',
				fieldLabel:'Codigo',
				name: 'codigo',
				inputType:'hidden',
				grid_visible:true,
				grid_editable:false

			},
			tipo: 'Field',
			filtro_0:false,
			form:false,
			id_grupo:2,
			save_as:'codigo'
		};
	// txt id_institucion4
	vectorAtributos[3]= {
			validacion: {
					name:'id_institucion',
					fieldLabel:'Instituci�n',
					allowBlank:true,
					emptyText:'Instituci�n...',
					desc: 'desc_institucion', //indica la columna del store principal ds del que proviane la descripcion
					store:ds_institucion,
					valueField: 'id_institucion',
					displayField: 'nombre',
					queryParam: 'filterValue_0',
					filterCol:'INSTIT.nombre#INSTIT.casilla',
					forceSelection:false,
					mode:'remote',
					queryDelay:200,
					pageSize:150,
					minListWidth:'100%',
					grow:true,
					resizable:true,
					queryParam:'filterValue_0',
					minChars:3, ///caracteres m�nimos requeridos para iniciar la busqueda
					triggerAction:'all',
					editable:true,
					renderer:render_id_institucion,
					grid_visible:true,
					grid_editable:false,
					width_grid:150, // ancho de columna en el gris
					width:200,
					grid_indice:12,
					confTrigguer:{
						url:direccion+'../../../../sis_parametros/vista/institucion/institucion.php',
					    paramTri:'prueba:XXX',		
					    title:'Personas',
					    param:{width:800,height:800},
					    idContenedor:idContenedor,
					   // clase_vista:'pagina_persona'
					}	
		
				},
				tipo:'ComboTrigger',
				form:true,
				id_grupo:0,
				filtro_0:true,
				filtro_1:true,
				filterColValue:'INSTIT.nombre'
			};

	// txt id_persona5
		vectorAtributos[4]={
				validacion:{
				name:'id_persona',
				fieldLabel:'Persona Natural',
				allowBlank:true,			
				emptyText:'Persona...',
				desc: 'desc_persona', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_persona,
				valueField: 'id_persona',
				displayField: 'desc_per',
				queryParam: 'filterValue_0',
				filterCol:'PERSON.apellido_paterno#PERSON.apellido_materno#PERSON.nombre',
				typeAhead:false,
				tpl:tpl_id_persona,
				forceSelection:false,
				mode:'remote',
				queryDelay:200,
				pageSize:100,
				minListWidth:'100%',
				grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_id_persona,
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				width:200,
				disabled:false,
				grid_indice:13,
				confTrigguer:{
						url:direccion+'../../../../sis_seguridad/vista/persona/persona.php',
					    paramTri:'prueba:XXX',		
					    title:'Personas',
					    param:{width:800,height:800},
					    idContenedor:idContenedor,
					   // clase_vista:'pagina_persona'
					}		
			},
			tipo:'ComboTrigger',
			form: true,
			filtro_0:true,
			filtro_1:true,
			filterColValue:'PERSON.apellido_paterno#PERSON.apellido_materno#PERSON.nombre',
			id_grupo:0
			
		};


		
		
		
		vectorAtributos[5]= {
				validacion:{
					//fieldLabel: 'Id',
					fieldLabel:'Tipo Doc.',
					name: 'tipo_doc_identificacion',
					grid_visible:true,
					grid_editable:false

				},
				tipo: 'Field',
				filtro_0:false,
				id_grupo:2,
				save_as:'tipo_doc_identificacion'
			};
		
		vectorAtributos[6]= {
				validacion:{
					//fieldLabel: 'Id',
					fieldLabel:'N� Doc.',
					name: 'doc_id',
					grid_visible:true,
					grid_editable:false

				},
				tipo: 'Field',
				filtro_0:false,
				id_grupo:2,
				disabled:true,
				save_as:'doc_id'
			};
		
		
		
		
		
		vectorAtributos[7]= {
				validacion:{
					//fieldLabel: 'Id',
					fieldLabel:'Direccion',
					inputType:'hidden',
					name: 'direccion_proveedor',
					grid_visible:true,
					grid_editable:false

				},
				tipo: 'Field',
				filtro_0:false,
				id_grupo:2,
				save_as:'direccion_proveedor'
			};
		

		vectorAtributos[8]= {
				validacion:{
					//fieldLabel: 'Id',
					fieldLabel:'Correo',
					name: 'email_proveedor',
					grid_visible:true,
					grid_editable:false

				},
				tipo: 'Field',
				filtro_0:false,
				id_grupo:2,
				save_as:'email_proveedor'
			};
		
		
		vectorAtributos[9]= {
				validacion:{
					//fieldLabel: 'Id',
					fieldLabel:'Telefono',
					name: 'telefono1_proveedor',
					grid_visible:true,
					editable:false,
					grid_editable:false

				},
				tipo: 'Field',
				filtro_0:false,
				id_grupo:2,
				save_as:'telefono1_proveedor'
			};
		
		vectorAtributos[10]= {
				validacion:{
					//fieldLabel: 'Id',
					fieldLabel:'Telefono 2',
					name: 'telefono2_proveedor',
					grid_visible:true,
					grid_editable:false

				},
				tipo: 'Field',
				filtro_0:false,
				id_grupo:2,
				save_as:'telefono2_proveedor'
			};
		
		

		
		
		vectorAtributos[11]= {
				validacion:{
					//fieldLabel: 'Id',
					fieldLabel:'Celular',
					name: 'celular1_proveedor',
					grid_visible:true,
					grid_editable:false

				},
				tipo: 'Field',
				filtro_0:false,
				id_grupo:2,
				save_as:'celular1_proveedor'
			};
		
		
		vectorAtributos[12]={
				validacion:{
					fieldLabel: 'Pais',
					allowBlank: false,
					vtype:"texto",
					emptyText:'Pais...',
					name: 'pais',
					desc: 'pais',
					store:ds_pais,
					valueField: 'id_lugar',
					displayField: 'nombre',
					queryParam: 'filterValue_0',
					filterCol:'LUGARR.nombre',
					typeAhead: true,
					onSelect:function(record){
						componentes[13].reset();
						componentes[12].setValue(record.data.id_lugar);
						componentes[12].collapse();
						ds_ciudad.baseParams.padre=record.data.id_lugar;
						componentes[13].modificado=true;
						componentes[13].enable();
					},
					forceSelection : true,
					mode: 'remote',
					queryDelay: 450,
					pageSize: 400,
					minListWidth : 350,
					resizable: true,
					queryParam: 'filterValue_0',
					minChars : 1,
					triggerAction: 'all',
					editable : true,
					renderer: renderPais,
					grid_visible:true,
					grid_editable:false,
					width_grid:80
				},
				tipo: 'ComboBox',
				filtro_0:false,
				filtro_1:false,
				filterColValue:'pais.nombre',
				save_as:'id_pais',
				id_grupo:1
			};

			vectorAtributos[13]={
				validacion:{
					fieldLabel: 'Ciudad',
					allowBlank: false,
					vtype:"texto",
					emptyText:'Ciudad...',
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
					triggerAction: 'all',
					editable : true,
					renderer: renderCiudad,
					grid_visible:true,
					grid_editable:false,
					width_grid:120 ,
					disabled:true
				},
				tipo: 'ComboBox',
				filtro_0:false,
				filtro_1:true,
				filterColValue:'lugar.nombre',
				save_as:'id_depto',
				id_grupo:1
			};

			vectorAtributos[14]={
				validacion:{
					fieldLabel: 'Rubro',
					allowBlank: false,
					vtype:"texto",
					emptyText:'Rubro...',
					name: 'id',
					desc: 'rubro',
					store:ds_rubro,
					valueField: 'id',
					displayField: 'nombre',
					queryParam: 'filterValue_0',
					filterCol:'rubro.nombre',
					typeAhead: false,
					forceSelection : false,
					onSelect:function(record){

						if(record.data.tipo=='bien'){
							componentes[14].setValue(record.data.id_supergrupo);
						}else{
							componentes[14].setValue(record.data.id_tipo_servicio);
						}
						componentes[21].setValue(record.data.tipo);
						componentes[14].setRawValue(record.data.nombre);
						componentes[14].collapse();

					},
					mode: 'remote',
					queryDelay: 450,
					pageSize: 400,
					minListWidth : 300,
					renderer:render_rubro,
					resizable: true,
					queryParam: 'filterValue_0',
					minChars : 1,
					grid_visible:true,
					triggerAction: 'all'

				},
				tipo: 'ComboBox',
				filtro_1:true,
				filterColValue:'T_PROV.rubro#T_PROV.rubro1#T_PROV.rubro2',
				save_as:'id_rubro',
				id_grupo:1
			};

			vectorAtributos[15]={
				validacion:{
					name:'rubro1',
					fieldLabel:'Rubro 1',
					allowBlank:true,
					maxLength:150,
					minLength:0,
					selectOnFocus:true,
					vtype:'texto',
					grid_visible:true,
					grid_editable:true,
					width_grid:100

				},
				tipo: 'TextField',
				filtro_0:false,
				filterColValue:'PROVEE.rubro1',
				save_as:'rubro1',
				id_grupo:1
			};

			vectorAtributos[16]={
				validacion:{
					name:'rubro2',
					fieldLabel:'Rubro 2',
					allowBlank:true,
					maxLength:150,
					minLength:0,
					selectOnFocus:true,
					vtype:'texto',
					grid_visible:true,
					grid_editable:true,
					width_grid:100

				},
				tipo: 'TextField',
				filtro_0:false,
				filterColValue:'PROVEE.rubro2',
				save_as:'rubro2',
				id_grupo:1
			};
			
				// txt nombre_pago
			vectorAtributos[17]= {
				validacion:{
					name:'nombre_pago',
					fieldLabel:'Nombre Pago',
					allowBlank:true,
					maxLength:150,
					minLength:0,
					selectOnFocus:true,
					vtype:'texto',
					grid_visible:true,
					width:'90%',
					grid_editable:true,
					width_grid:200

				},
				tipo: 'TextField',
				filtro_0:false,
				filtro_1:true,
				filterColValue:'PROVEE.nombre_pago',
				save_as:'nombre_pago',
				id_grupo:0
			};
		
		
	vectorAtributos[18]= {
		validacion:{
			name:'fax_proveedor',
			fieldLabel:'Fax',
			allowBlank:true,
			maxLength:20,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			width:'90%',
			grid_editable:false,
			width_grid:100
		},
		tipo: 'TextField',
		filtro_0:false,
		filtro_1:false,
		filterColValue:'PROVEE.fax_proveedor',
		save_as:'fax_proveedor',
		id_grupo:0
	};

	

	vectorAtributos[19]= {
		validacion:{
			name:'casilla_proveedor',
			fieldLabel:'Casilla',
			allowBlank:true,
			maxLength:20,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			width:'90%',
			grid_visible:true,
			grid_editable:false,
			width_grid:100
		},
		tipo: 'TextField',
		filtro_0:true,
		filtro_1:false,
		filterColValue:'INSTIT.casilla#PERSON.casilla',
		save_as:'casilla_proveedor',
		id_grupo:0
	};






	vectorAtributos[20]= {
		validacion:{
			name:'observaciones',
			fieldLabel:'Observaciones',
			allowBlank:true,
			maxLength:200,
			minLength:0,
			selectOnFocus:true,
			width:'90%',
			vtype:'texto',
			grid_visible:true,
			grid_editable:true,
			width_grid:200


		},
		tipo: 'TextArea',
		filtro_0:false,
		filtro_1:true,
		filterColValue:'PROVEE.observaciones',
		save_as:'observaciones',
		id_grupo:0
	};

	
	
	vectorAtributos[21]={
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
			form:true,
			save_as:'tipo',
			id_grupo:1
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
		titulo_maestro:'proveedor',
		grid_maestro:'grid-'+idContenedor
	};
	layout_proveedor=new DocsLayoutMaestro(idContenedor);
	layout_proveedor.init(config);

	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////
	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina = Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,ds,layout_proveedor,idContenedor);
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
	var getSelectionModel=this.getSelectionModel;
	var ClaseMadre_getComponente=this.getComponente;
	var ClaseMadre_getDialog=this.getDialog;
	var ClaseMadre_save=this.Save;
	var ClaseMadre_getGrid=this.getGrid;
	var ClaseMadre_getFormulario=this.getFormulario;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_btnNew=this.btnNew;
	var ClaseMadre_onResize=this.onResize;
	var ClaseMadre_SaveAndOther=this.SaveAndOther;
	var CM_mostrarComponente=this.mostrarComponente;
	var CM_ocultarComponente=this.ocultarComponente;
	var CM_ocultarTodosComponente=this.ocultarTodosComponente;
	var CM_mostrarTodosComponente=this.mostrarTodosComponente;
	var ClaseMadre_btnEdit=this.btnEdit;
	var ClaseMadre_btnEliminar = this.btnEliminar;
	var ClaseMadre_btnActualizar = this.btnActualizar;
	var CM_ocultarGrupo=this.ocultarGrupo;
	var CM_mostrarGrupo=this.mostrarGrupo;
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
	var paramFunciones = {
		btnEliminar:{url:direccion+'../../../control/proveedor/ActionEliminarProveedor.php'},
		Save:{url:direccion+'../../../control/proveedor/ActionGuardarProveedor.php'},
		ConfirmSave:{url:direccion+'../../../control/proveedor/ActionGuardarProveedor.php'},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,height:'55%',columnas:['47%','47%'],


		grupos:[{
			tituloGrupo:'Datos de Proveedor',
			columna:0,
			id_grupo:0
		},{
			tituloGrupo:'Registro de Proveedor',
			columna:1,
			id_grupo:0
		},{
			tituloGrupo:'Datos',
			columna:0,
			id_grupo:2
		}
		],width:'65%',minWidth:350,minHeight:400,closable:true,titulo:'Proveedor'}};


		//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
		//Para manejo de eventos
		function iniciarEventosFormularios(){

			combo_persona_institucion= ClaseMadre_getComponente('persona_institucion');

			function persona_institucion(){
				   
				if(combo_persona_institucion.getValue()=='persona'){
					CM_mostrarComponente(ClaseMadre_getComponente('id_persona'));
					ClaseMadre_getComponente('id_institucion').setValue('');
					CM_ocultarComponente(ClaseMadre_getComponente('id_institucion'));
					
					ClaseMadre_getComponente('id_institucion').disable();
					ClaseMadre_getComponente('id_persona').enable();
					
				}
				else{
					CM_mostrarComponente(ClaseMadre_getComponente('id_institucion'));
					
					CM_ocultarComponente(ClaseMadre_getComponente('id_persona'));
					ClaseMadre_getComponente('id_persona').setValue('');
					ClaseMadre_getComponente('id_institucion').enable();
					ClaseMadre_getComponente('id_persona').disable();
					
				}
			}

			combo_persona_institucion.on('select',persona_institucion);
			combo_persona_institucion.on('change',persona_institucion);

			

			

			

			for(i=0;i<vectorAtributos.length;i++){

				componentes[i]=ClaseMadre_getComponente(vectorAtributos[i].validacion.name);

			}

		}


		//para que los hijos puedan ajustarse al tama�o
		this.getLayout=function(){
			return layout_proveedor.getLayout();
		};
		function iniciarProveedor()
		{	grid=ClaseMadre_getGrid();
		dialog=ClaseMadre_getDialog();
		sm=getSelectionModel();
		formulario=ClaseMadre_getFormulario();


		}
		this.btnNew = function(){

			//CM_ocultarGrupo('Registro de Proveedor');

			CM_mostrarGrupo('Datos de Proveedor');
			CM_ocultarGrupo('Datos');
			CM_ocultarComponente(ClaseMadre_getComponente('id_persona'));
			CM_ocultarComponente(ClaseMadre_getComponente('id_institucion'));
			ClaseMadre_getComponente('id_institucion').enable();
			ClaseMadre_getComponente('id_persona').enable();
			ClaseMadre_getComponente('persona_institucion').allowBlank=false;
			ClaseMadre_getComponente('persona_institucion').enable();
			
						
			CM_mostrarGrupo('Registro de Proveedor');
			var dialog=ClaseMadre_getDialog();
			dialog.setContentSize('75%','65%');
			ClaseMadre_btnNew();
		}

		this.btnEdit = function(){
			var sm=getSelectionModel();
			var filas=ds.getModifiedRecords();
			var cont=filas.length;
			var NumSelect=sm.getCount();
			if(NumSelect!=0){
				
			    CM_mostrarGrupo('Registro de Proveedor');
			    CM_ocultarGrupo('Datos');
				var SelectionsRecord=sm.getSelected();
				
				ClaseMadre_getComponente('persona_institucion').disable();
				//CM_ocultarComponente(ClaseMadre_getComponente('tipo_doc_identificacion'));
				CM_ocultarComponente(ClaseMadre_getComponente('id_persona'));
				CM_ocultarComponente(ClaseMadre_getComponente('id_institucion'));
				if(SelectionsRecord.data.rubro!='' && SelectionsRecord.data.rubro!=null){
					ClaseMadre_getComponente('id').setRawValue(SelectionsRecord.data.rubro);
					ClaseMadre_getComponente('id').setValue(SelectionsRecord.data.id);
				}
				
				
				if(SelectionsRecord.data.pais!='' && SelectionsRecord.data.pais!=null){
					ClaseMadre_getComponente('pais').setValue(SelectionsRecord.data.pais);
				}
				if(SelectionsRecord.data.id_persona>0){
					ClaseMadre_getComponente('persona_institucion').setValue('Persona');
					
										
					CM_ocultarComponente(ClaseMadre_getComponente('id_institucion'));
					CM_mostrarComponente(ClaseMadre_getComponente('id_persona'));
					
					
				}else{
					//ClaseMadre_getComponente('tipo_doc_identificacion')
					ClaseMadre_getComponente('persona_institucion').setValue('Institucion'); 
					
					CM_ocultarComponente(ClaseMadre_getComponente('id_persona'));
					CM_mostrarComponente(ClaseMadre_getComponente('id_institucion'));
				}

				var dialog=ClaseMadre_getDialog();
				dialog.setContentSize('75%','65%');
				ClaseMadre_btnEdit();
			}
		}


		function btnItem(){
			ClaseMadre_getComponente('persona_institucion').allowBlank=true;
			var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
			if(NumSelect!=0){
				var SelectionsRecord=sm.getSelected();
				var data='m_id_proveedor='+SelectionsRecord.data.id_proveedor;
				data=data+'&m_codigo='+SelectionsRecord.data.codigo;
				if(SelectionsRecord.data.id_persona>0){
					data=data+'&m_nombre_proveedor='+SelectionsRecord.data.desc_persona;
				}
				if(SelectionsRecord.data.id_institucion>0){
					data=data+'&m_nombre_proveedor='+SelectionsRecord.data.desc_institucion;
				}

				var ParamVentana={Ventana:{width:'90%',height:'70%'}}
				layout_proveedor.loadWindows(direccion+'../../../../sis_adquisiciones/vista/item_proveedor/item_proveedor_det.php?'+data,'Productos',ParamVentana);
				layout_proveedor.getVentana().on('resize',function(){
					layout_proveedor.getLayout().layout();
				})
			}
			else
			{
				Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
			}

		}

		function btnServicio(){
			ClaseMadre_getComponente('persona_institucion').allowBlank=true;
			var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
			if(NumSelect!=0){
				var SelectionsRecord=sm.getSelected();
				var data='m_id_proveedor='+SelectionsRecord.data.id_proveedor;
				data=data+'&m_codigo='+SelectionsRecord.data.codigo;
				if(SelectionsRecord.data.id_persona>0){
					data=data+'&m_nombre_proveedor='+SelectionsRecord.data.desc_persona;
				}
				if(SelectionsRecord.data.id_institucion>0){
					data=data+'&m_nombre_proveedor='+SelectionsRecord.data.desc_institucion;
				}

				var ParamVentana={Ventana:{width:'90%',height:'70%'}}
				layout_proveedor.loadWindows(direccion+'../../../../sis_adquisiciones/vista/servicio_proveedor/servicio_proveedor_det.php?'+data,'Servicios',ParamVentana);
				layout_proveedor.getVentana().on('resize',function(){
					layout_proveedor.getLayout().layout();
				})
			}
			else{
				Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
			}
		}






		//para el manejo de hijos
		this.getPagina=function(idContenedorHijo){
			var tam_elementos=elementos.length;
			for(i=0;i<tam_elementos;i++){
				if(elementos[i].idContenedor==idContenedorHijo){
					return elementos[i];
				}
			}
		};

		this.getElementos=function(){return elementos;};
		this.setPagina=function(elemento){elementos.push(elemento);};
		//-------------- FIN DEFINICI�N DE FUNCIONES PROPIAS --------------//
		iniciarProveedor();
		this.Init(); //iniciamos la clase madre
		this.InitBarraMenu(paramMenu);
		//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
		this.InitFunciones(paramFunciones);
		//para agregar botones

		this.iniciaFormulario();
		iniciarEventosFormularios();
		ds_pais.baseParams={nivel_padre:0};

		this.AdicionarBoton('../../../lib/imagenes/bricks.png','Items por Proveedor',btnItem,true, 'btnItem','Item');
		this.AdicionarBoton('../../../lib/imagenes/menu-show.gif','Servicios por Proveedor',btnServicio,true, 'btnServicio','Servicio');

		layout_proveedor.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
		ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}