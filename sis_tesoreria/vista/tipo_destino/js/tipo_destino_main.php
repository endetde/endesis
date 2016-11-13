<?php 
/**
 * Nombre:		  	    tipo_destino_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2009-10-27 12:25:02
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
<?php if($_SESSION["ss_filtro_avanzado"]!=''){echo 'fa='.$_SESSION["ss_filtro_avanzado"].';';}?>
var paramConfig={TamanoPagina:_CP.getConfig().ss_tam_pag,TiempoEspera:_CP.getConfig().ss_tiempo_espera,CantFiltros:1,FiltroEstructura:false,FiltroAvanzado:fa};
var elemento={pagina:new pagina_tipo_destino(idContenedor,direccion,paramConfig),idContenedor:idContenedor};
_CP.setPagina(elemento);
}
Ext.onReady(main,main);

//view added

/**
 * Nombre:		  	    pagina_tipo_destino.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2009-10-27 12:25:02
 */
function pagina_tipo_destino(idContenedor,direccion,paramConfig){
	var Atributos=new Array,sw=0;
	
	//---DATA STORE
	var ds = new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/tipo_destino/ActionListarTipoDestino.php'}),
		reader: new Ext.data.XmlReader({
		record: 'ROWS',id:'id_tipo_destino',totalRecords:'TotalCount'
		},[		
		'id_tipo_destino',
		'codigo',
		'descripcion',
		'id_moneda',
		'desc_moneda',
		{name: 'fecha_reg',type:'date',dateFormat:'Y-m-d'},
		'id_usr_reg',
		'apellido_paterno_persona',
		'apellido_materno_persona',
		'nombre_persona',
		'apellido_paterno_usuario',
		'apellido_materno_usuario',
		'nombre_usuario',
		'desc_usuario',
		'tipo_destino',
		'estado'
		]),remoteSort:true,baseParams:{vista:'tipo_destino'}});

	
	//DATA STORE COMBOS

    var ds_moneda = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/moneda/ActionListarMoneda.php'}),
			reader:new Ext.data.XmlReader({record:'ROWS',id:'id_moneda',totalRecords: 'TotalCount'},['id_moneda','nombre','simbolo','estado','origen','prioridad'])
	});

	//FUNCIONES RENDER
	
		function render_id_moneda(value, p, record){return String.format('{0}', record.data['desc_moneda']);}
		var tpl_id_moneda=new Ext.Template('<div class="search-item">','<FONT COLOR="#B5A642">{nombre}</FONT><br>','</div>');
		
		function render_usuario(value,p,record){return String.format('{0}', record.data['desc_usuario']);}
		function render_fecha_reg(value,p,record){return value.dateFormat('d/m/Y');}
		
		
function render_tipo_destino(value, p, record){
			
			if(record.get('tipo_destino')=='nacional'){
				return String.format('{0}', 'Nacional');
             
             } 
			else{
				return String.format('{0}', 'Exterior');
			
				
			}
			
		}
		
function render_estado(value, p, record){
			
			if(record.get('estado')=='activo'){
				return String.format('{0}', 'Activo');
             
             } 
			else{
				return String.format('{0}', 'Inactivo');
			
				
			}
			
		}
	
	/////////////////////////
	// Definici�n de datos //
	/////////////////////////
	
	// hidden id_tipo_destino
	//en la posici�n 0 siempre esta la llave primaria

	Atributos[0]={
		validacion:{
			labelSeparator:'',
			name: 'id_tipo_destino',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false
		
	};
// txt codigo
	Atributos[1]={
		validacion:{
			name:'codigo',
			fieldLabel:'C�digo',
			allowBlank:false,
			maxLength:15,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:200,
			width:'100%',
			disabled:false		
		},
		tipo: 'TextField',
		form: true,
		filtro_0:true,
		filterColValue:'TIPDES.codigo'
		
	};
// txt descripcion
	Atributos[2]={
		validacion:{
			name:'descripcion',
			fieldLabel:'Descripci�n',
			allowBlank:true,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:120,
			width:'100%',
			disabled:false		
		},
		tipo: 'TextField',
		form: true,
		filtro_0:true,
		filterColValue:'TIPDES.descripcion'
		
	};
// txt id_moneda
	Atributos[3]={
			validacion:{
			name:'id_moneda',
			fieldLabel:'Moneda',
			allowBlank:true,			
			emptyText:'Moneda...',
			desc: 'desc_moneda', //indica la columna del store principal ds del que proviane la descripcion
			store:ds_moneda,
			valueField: 'id_moneda',
			displayField: 'nombre',
			queryParam: 'filterValue_0',
			filterCol:'MONEDA.nombre',
			typeAhead:true,
			tpl:tpl_id_moneda,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:100,
			minListWidth:'100%',
			grow:true,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
			triggerAction:'all',
			editable:true,
			renderer:render_id_moneda,
			grid_visible:true,
			grid_editable:false,
			width_grid:150,
			width:'100%',
			disabled:false		
		},
		tipo:'ComboBox',
		form: true,
		filtro_0:true,
		filterColValue:'MONEDA.nombre'
		
	};
// txt fecha_reg
	Atributos[4]={
		validacion:{
			name: 'fecha_reg', //indica la columna del store principal ds del que proviane la descripcion
			fieldLabel:'Fecha registro',
			grid_visible:true,
			grid_editable:false,
			width_grid:120,
			renderer:render_fecha_reg
		},
		tipo:'Field',
		filtro_0:true,
		form:false,
		dateFormat:'m-d-Y',
		filterColValue:'TIPDES.fecha_reg',
	};
// txt id_usr_reg
	Atributos[5]={
		validacion:{
			name: 'id_usr_reg', //indica la columna del store principal ds del que proviane la descripcion
			fieldLabel:'Usuario Registro',
			grid_visible:true,
			grid_editable:false,
			width_grid:200,
			renderer:render_usuario
		},
		tipo:'Field',
		filtro_0:true,
		form:false,		
		filterColValue:'TIPDES.id_usr_reg',
	};
	Atributos[6]={
			validacion:{
				name:'tipo_destino',
				fieldLabel:'Tipo Destino',
				allowBlank:false,
				typeAhead:true,
				loadMask:true,
				triggerAction:'all',
				store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[['nacional','Nacional'],['exterior','Exterior']]}),
				valueField:'ID',
				displayField:'valor',
				lazyRender:true,
				forceSelection:true,
				grid_visible:true,
				grid_editable:false,
				width_grid:120,
				renderer:render_tipo_destino,
				disabled:false		
			},
			tipo: 'ComboBox',
			form: true,
			filtro_0:true,
			filterColValue:'TIPDES.tipo_destino',
			defecto:'nacional'
			//id_grupo:1		
		};
		
	Atributos[7]={
			validacion:{
				name:'estado',
				fieldLabel:'Estado',
				allowBlank:false,
				typeAhead:true,
				loadMask:true,
				triggerAction:'all',
				store:new Ext.data.SimpleStore({fields:['ID','valor'],data:[['activo','Activo'],['inactivo','Inactivo']]}),
				valueField:'ID',
				displayField:'valor',
				lazyRender:true,
				forceSelection:true,
				grid_visible:true,
				grid_editable:false,
				width_grid:120,
				renderer:render_estado,
				disabled:false		
			},
			tipo: 'ComboBox',
			form: true,
			filtro_0:true,
			filterColValue:'TIPDES.estado',
			defecto:'activo'
			//id_grupo:1		
		};
	
	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	function formatDate(value){return value?value.dateFormat('d/m/Y'):''};

	//---------- INICIAMOS LAYOUT DETALLE
	var config={titulo_maestro:'Tipo Destino',grid_maestro:'grid-'+idContenedor};
	var layout_tipo_destino=new DocsLayoutMaestro(idContenedor);
	layout_tipo_destino.init(config);

	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////

	
	this.pagina=Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,Atributos,ds,layout_tipo_destino,idContenedor);
	var getComponente=this.getComponente;
	var getSelectionModel=this.getSelectionModel;

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
		btnEliminar:{url:direccion+'../../../control/tipo_destino/ActionEliminarTipoDestino.php'},
		Save:{url:direccion+'../../../control/tipo_destino/ActionGuardarTipoDestino.php'},
		ConfirmSave:{url:direccion+'../../../control/tipo_destino/ActionGuardarTipoDestino.php'},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,height:400,width:480,minWidth:150,minHeight:200,	closable:true,titulo:'Tipo Destino'}};
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
function btn_categoria_tipo_destino(){
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			var data='id_tipo_destino='+SelectionsRecord.data.id_tipo_destino;
			data=data+'&descripcion='+SelectionsRecord.data.descripcion;

			var ParamVentana={Ventana:{width:'90%',height:'70%'}}
			layout_tipo_destino.loadWindows(direccion+'../../../../sis_tesoreria/vista/categoria_tipo_destino/categoria_tipo_destino.php?'+data,'Categor�a/Tipo destino',ParamVentana);

		}
	else
	{
		Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
	}
	}
	
	//Para manejo de eventos
	function iniciarEventosFormularios(){
	//para iniciar eventos en el formulario
	}

	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_tipo_destino.getLayout()};
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	this.InitFunciones(paramFunciones);
	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros
		}
	});
	
	//para agregar botones
	
		this.AdicionarBoton('../../../lib/imagenes/menu-show.gif','Categor�a/Tipo destino',btn_categoria_tipo_destino,true,'categoria_tipo_destino','');

	this.iniciaFormulario();
	iniciarEventosFormularios();
	layout_tipo_destino.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}