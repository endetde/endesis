<?php 
/**
 * Nombre:		  	    cuenta_sigma_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2013-10-31 11:01:41
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
	    echo "var idSub='$idSub';";
	?>
var fa=false;
<?php if($_SESSION["ss_filtro_avanzado"]!=''){echo 'fa='.$_SESSION["ss_filtro_avanzado"].';';}?>
var paramConfig={TamanoPagina:20,TiempoEspera:10000,CantFiltros:1,FiltroEstructura:false,FiltroAvanzado:fa,idSub:decodeURI(idSub)};
var elemento={pagina:new pagina_cuenta_sigma(idContenedor,direccion,paramConfig),idContenedor:idContenedor};
ContenedorPrincipal.setPagina(elemento);
}
Ext.onReady(main,main);

/**
 * Nombre:		  	    pagina_cuenta_sigma_main.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2013-10-31 11:01:41
 */
function pagina_cuenta_sigma(idContenedor,direccion,paramConfig)
{
	var vectorAtributos=new Array;
	var ds;
	var elementos=new Array();
	var sw=0;
	
	/////////////////
	//  DATA STORE //
	/////////////////
	ds=new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy:new Ext.data.HttpProxy({url:direccion+'../../../control/cuenta_sigma/ActionListarCuentaSigma.php'}),
		// aqui se define la estructura del XML
		reader:new Ext.data.XmlReader({
			record:'ROWS',
			id:'id_cuenta_sigma',
			totalRecords:'TotalCount'
		},[
		// define el mapeo de XML a las etiquetas (campos)
		'id_cuenta_sigma',
		'nro_cuenta_sigma',
		'nombre_cuenta_sigma',
		'estado_cuenta_sigma'		
		]),remoteSort:true
	});
	
	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit:paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros
		}
	});
	
	function render_estado_cuenta_sigma(value){
		if(value==1){value='Activo' }
		if(value==2){value='Inactivo' }
		
		return value
	}
	/////////////////////////
	// Definici�n de datos //
	/////////////////////////
	vectorAtributos[0]={
		validacion:{
			labelSeparator:'',
			name:'id_cuenta_sigma',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		save_as:'hidden_id_cuenta_sigma'
	};
	
	// txt nro_cuenta_sigma
	vectorAtributos[1]={
		validacion:{
			name:'nro_cuenta_sigma',
			fieldLabel:'C�digo',
			allowBlank:false,
			maxLength:15,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:100
		},
		tipo:'TextField',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'CSIGMA.nro_cuenta_sigma',
		save_as:'txt_nro_cuenta_sigma'
	};
	
	// txt_nombre_cuenta_sigma
	vectorAtributos[2]={
		validacion:{
			name:'nombre_cuenta_sigma',
			fieldLabel:'Cuenta',
			allowBlank:false,
			maxLength:100,
			minLength:0,
			width:'100%',
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:true,
			width_grid:350
		},
		tipo:'TextArea',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'CSIGMA.nombre_cuenta_sigma',
		save_as:'txt_nombre_cuenta_sigma'
	};
	
	// txt estado
	vectorAtributos[3]={
		validacion:{
			name:'estado_cuenta_sigma',
			fieldLabel:'Estado',
			allowBlank:false,
			typeAhead:true,
			loadMask:true,
			triggerAction:'all',
			store:new Ext.data.SimpleStore({fields:['id','valor'],data:[['1','Activo'],['2','Inactivo']]}),
			mode:'local',
			valueField:'id',
			displayField:'valor',
			lazyRender:true,
			grid_visible:true,
			renderer:render_estado_cuenta_sigma,
			grid_editable:false,
			forceSelection:true,
			width:80
		},
		tipo:'ComboBox',
		save_as:'txt_estado_cuenta_sigma',
		defecto:'1'
	};
	
	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	function formatDate(value){return value ? value.dateFormat('d/m/Y'):''};
	
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
	//Inicia Layout
	var config={titulo_maestro:'CuentaSigma',grid_maestro:'grid-'+idContenedor};
	var layout_cuenta_sigma=new DocsLayoutMaestro(idContenedor);
	layout_cuenta_sigma.init(config);
	
	// INICIAMOS HERENCIA //
	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina=Pagina;
	
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,ds,layout_cuenta_sigma,idContenedor);
	
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
	var getSelectionModel=this.getSelectionModel;
	var ClaseMadre_getComponente=this.getComponente;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_btnNew=this.btnNew;
	var ClaseMadre_onResize=this.onResize;
	var ClaseMadre_SaveAndOther=this.SaveAndOther;
	
	// DEFINICI�N DE LA BARRA DE MEN�//
	var paramMenu={
		guardar:{crear:true,separador:false},
		nuevo:{crear:true,separador:true},
		editar:{crear:true,separador:false},
		eliminar:{crear:true,separador:false},
		actualizar:{crear:true,separador:true},
		excel:{crear:true,separador:false}
	};
	
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//datos necesarios para el filtro
	var paramFunciones={
		btnEliminar:{url:direccion+'../../../control/cuenta_sigma/ActionEliminarCuentaSigma.php'},
		Save:{url:direccion+'../../../control/cuenta_sigma/ActionGuardarCuentaSigma.php'},
		ConfirmSave:{url:direccion+'../../../control/cuenta_sigma/ActionGuardarCuentaSigma.php'},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,height:250,width:400,minWidth:150,minHeight:200,	closable:true,titulo:'Cuentas de Sigma'}};
	
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	//Para manejo de eventos
	function iniciarEventosFormularios(){
	//para iniciar eventos en el formulario
	}
	
	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_cuenta_sigma.getLayout();};
	
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
	this.iniciaFormulario();
	iniciarEventosFormularios();
	layout_cuenta_sigma.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario)
}