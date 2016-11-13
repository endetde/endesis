<?php 
/**
 * Nombre:		  	    solicitud_compra_personal_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-05-09 09:11:12
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
    echo "id_usuario='$id_usuario';";
	?>
var fa=false;
<?php if($_SESSION["ss_filtro_avanzado"]!=''){echo 'fa='.$_SESSION["ss_filtro_avanzado"].';';}?>
var paramConfig={TamanoPagina:ContenedorPrincipal.getConfig().ss_tam_pag,TiempoEspera:ContenedorPrincipal.getConfig().ss_tiempo_espera,CantFiltros:1,FiltroEstructura:false,FiltroAvanzado:fa};
var empleado={
	    	id_empleado:<?php echo $id_empleado;?>, rol_adm:'<?php echo $rol_adm;?>',nombre_usuario:'<?php echo $nombre_usuario;?>'}
var elemento={pagina:new pagina_papeleta_pago(idContenedor,direccion,empleado,paramConfig),idContenedor:idContenedor};
ContenedorPrincipal.setPagina(elemento);


}
Ext.onReady(main,main);
function pagina_papeleta_pago(idContenedor,direccion,empleado,paramConfig)
{
	var vectorAtributos = new Array;
	var ContPes = 1;
	var cmp_fecha_ini;
	var	cmp_fecha_fin;
	 var cmp_tipo_reporte,cmp_id_empleado,cmp_nombre_usuario;
	 var ds_planilla,ds_empleado;
	 var layout_rep_papeleta_pago;
	//////////////////////////////////////////////////////////////
	// ------------------  PAR�METROS --------------------------//
	// Definici�n de todos los tipos de datos que se maneja    //
	//////////////////////////////////////////////////////////////
	
	var ds_empleado=new Ext.data.Store({
		proxy:new Ext.data.HttpProxy({url:direccion+'../../../../../sis_kardex_personal/control/empleado/ActionListarFuncionario.php'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_empleado',totalRecords:'TotalCount'},['id_empleado','desc_persona','nombre_cargo'])
	});
    var ds_planilla=new Ext.data.Store({
		proxy:new Ext.data.HttpProxy({url:direccion+'../../../../../sis_kardex_personal/control/planilla/ActionListarPlanilla.php'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_planilla',totalRecords:'TotalCount'},['id_planilla','gestion','periodo_lite','resumen_periodo'])
	});
	var tpl_planilla=new Ext.Template('<div class="search-item">','GESTION: {gestion}<br>','<b><FONT COLOR="#B5A642">PERIODO: {periodo_lite}</FONT></b>','</div>');
	var tpl_empleado=new Ext.Template('<div class="search-item">','{desc_persona}</b>','</div>');
	/////////// hidden id_tipo_activo//////
	//en la posici�n 0 siempre tiene que estar la llave primaria
	/////DATA STORE////////////
	//Define las columnas a desplegar
	/////////// txt codigo//////
	
		vectorAtributos[0]={
		validacion:{
			labelSeparator:'',
			name:'id_empleado',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo:'Field',
		filtro_0:false,
		defecto:empleado.id_empleado,
		save_as:'txt_id_empleado',
		id_grupo:1
	};
    vectorAtributos[1]={
		validacion:{
			name:'nombre_usuario',
			fieldLabel:'Funcionario',
			allowBlank:false,
			maxLength:200,
			minLength:0,
			selectOnFocus:true,
			vtype:'text',
			width:'80%',
			disabled:true
		},
		tipo:'TextField',
		save_as:'nombre_usuario',
		defecto:empleado.nombre_usuario,
		id_grupo:1
	};
	vectorAtributos[2]={
		validacion:{
			fieldLabel:'Periodo',
			allowBlank:false,
			vtype:"texto",
			emptyText:'Gesti�n - Periodo...',
			name:'id_planilla',
			desc:'gestion',
			store:ds_planilla,
			valueField:'id_planilla',
			displayField:'resumen_periodo', 
			typeAhead:false,
			forceSelection:true,
			tpl:tpl_planilla,
			mode:'remote',
			queryDelay:50,
			pageSize:10,
			minListWidth:300,
			resizable:true,
			minChars:0,
			triggerAction:'all',
			editable:true,
			width:300
		},
		id_grupo:0,
		save_as:'txt_id_planilla',
		tipo:'ComboBox'
	};
	
	
	
	
 
	//////////////////////////////////////////////////////////////
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
	//////////////////////////////////////////////////////////////

	function formatDate(value){	return value ? value.dateFormat('d/m/Y'):''}
	
	// ---------- Inicia Layout ---------------//
	var config=
	{
		titulo_maestro:"Papeleta de Pago"
	};
	layout_rep_papeleta_pago=new DocsLayoutProceso(idContenedor);
	layout_rep_papeleta_pago.init(config);

	//////////////////////////////////////////////////////////////
	//---------         INICIAMOS HERENCIA           -----------//
	//////////////////////////////////////////////////////////////

	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina=BaseParametrosReporte;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,layout_rep_papeleta_pago,idContenedor);

	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//

	var ClaseMadre_conexionFailure = this.conexionFailure; // para heredar de la clase madre la funcion eliminarSucces de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
	var ClaseMadre_getComponente = this.getComponente;
	var CM_ocultarComponente=this.ocultarComponente;
	var CM_ocultarGrupo=this.ocultarGrupo;
	var CM_mostrarGrupo=this.mostrarGrupo;

	//ds_parametro.addListener('loadexception',  ClaseMadre_conexionFailure); //se recibe un error	
	
	//////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////

	var paramFunciones = {

		Formulario:{
			labelWidth: 75, //ancho del label
		 	url:direccion+'../../../../control/planilla/papeleta_pago.php',
			abrir_pestana:true, //abrir pestana
			titulo_pestana:'Papeleta de Pago',
			fileUpload:false,
			columnas:['40%','40%'],			
			grupos:[
			{
				tituloGrupo:'Elija la Gesti�n y Periodo',
				columna:0,
				id_grupo:0
			},
			
			{
				tituloGrupo:'Funcionario',
				columna:1,
				id_grupo:1
			}
			],
			parametros:'',
			
		}
	}

	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//

	function iniciarEventosFormularios(){			 			
		
		cmp_id_empleado = ClaseMadre_getComponente('id_empleado');
		
		
			cmp_id_empleado.disabled=true;
			cmp_nombre_usuario = ClaseMadre_getComponente('nombre_usuario');
		cmp_id_empleado.setValue(empleado.id_empleado);
		cmp_nombre_usuario.setValue(empleado.nombre_usuario);
		
		
		
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
