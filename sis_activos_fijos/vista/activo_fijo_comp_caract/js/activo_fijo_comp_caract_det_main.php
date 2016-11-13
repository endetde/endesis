<?php
/**
 * Nombre:		  	    cotizacion_det_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista del Hijo
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-05-28 17:32:14
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
idContenedorPadre='<?php echo $idContenedorPadre;?>';
var elemento={idContenedor:idContenedor,pagina:new pag_af_comp_caract(idContenedor,direccion,paramConfig,idContenedorPadre)};
_CP.setPagina(elemento);
}
Ext.onReady(main,main);


/**
* Nombre:		  	    pagina_cotizacion_det.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
*/
function pag_af_comp_caract(idContenedor,direccion,paramConfig,idContenedorPadre){
	var Atributos=new Array;
	var maestro;

	var ds = new Ext.data.Store({
		// asigna url de donde se cargaran los datos

		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/activo_fijo_comp_caract/ActionListaActivoFijoCompCaract.php'}),

		// aqui se define la estructura del XML
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_activo_fijo_comp_caract',
			totalRecords: 'TotalCount'

		}, [
		// define el mapeo de XML a las etiqutas (campos)
		{name: 'descripcion', type: 'string'},
		'id_activo_fijo_comp_caract',
		'descripcion',
		'id_caracteristica',
		'id_componente',
		'des_caracteristica',
		'des_componente'
		]),

		remoteSort: true});


	
		/////DATA STORE COMBOS////////////
	ds_caracteristicas_comp = new Ext.data.Store({
		// asigna url de donde se cargaran los datos

		proxy: new Ext.data.HttpProxy({url:direccion+ '../../../control/caracteristicas/ActionListaCaracteristicas.php'}),
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_caracteristica',
			totalRecords: 'TotalCount'

		}, ['id_caracteristica','descripcion'])

	});
	
	

	////////////////FUNCIONES RENDER ////////////
	function renderCaracteristicas(value, p, record){return String.format('{0}', record.data['des_caracteristica']);}


	//////////////////////////////////////////////////////////////
	// ------------------  PAR�METROS --------------------------//
	// Definici�n de todos los tipos de datos que se maneja    //
	//////////////////////////////////////////////////////////////

	/////////// hidden id_persona//////
	//en la posici�n 0 siempre tiene que estar la llave primaria

	Atributos[0] = {
		validacion:{
			//fieldLabel: 'Id',
			labelSeparator:'',
			name: 'id_activo_fijo_comp_caract',
			inputType:'hidden',
			grid_visible:false, // se muestra en el grid
			grid_editable:false //es editable en el grid

		},
		tipo: 'Field',
		filtro_0:false,
		save_as:'hidden_id_activo_fijo_comp_caract'
	};
	
	/////////// hidden_id_caracteristica//////

	Atributos[1]= {
		validacion:{
			fieldLabel: 'Caracter�stica',
			allowBlank: false,
			vtype:"texto",
			emptyText:'Caracter�stica...',
			name: 'id_caracteristica',     //indica la columna del store principal "ds" del que proviane el id
			desc: 'descripcion', //indica la columna del store principal "ds" del que proviane la descripcion
			store:ds_caracteristicas_comp,
			valueField: 'id_caracteristica',
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
			minChars : 0, ///caracteres m�nimos requeridos para iniciar la busqueda
			triggerAction: 'all',
			editable : true,
			renderer: renderCaracteristicas,
			grid_visible:true, // se muestra en el grid
			grid_editable:false, //es editable en el grid,
			width_grid:120 // ancho de columna en el gris
		},
		tipo: 'ComboBox',
		save_as:'txt_id_caracteristica'
	};
	
	/////////// txt descripcion//////
	Atributos[2]= {
		validacion:{
			name: 'descripcion',
			fieldLabel: 'Descripci�n',
			allowBlank: false,
			maxLength:100,
			minLength:0,
			selectOnFocus:true,
			//vtype:"alphaLatino",
			vtype:"texto",
			grid_visible:true, // se muestra en el grid
			grid_editable:true, //es editable en el grid,
			width_grid:200 // ancho de columna en el gris
		},
		tipo: 'TextArea',//cambiar por TextArea(pero es muy grande...)
		filtro_0:true,
		filtro_1:true,
		filterColValue:'cc.descripcion',
		save_as:'txt_descripcion'
	};

	///////////////////////
	Atributos[3] = {
		validacion:{
			name: 'id_componente',
			labelSeparator:'',
			inputType:"hidden",
			grid_visible:false, // se muestra en el grid
			grid_editable:false //es editable en el grid
		},
		tipo: 'Field',
		save_as:'txt_id_componente'
	};
	
	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	function formatDate(value){
		return value?value.dateFormat('d/m/Y') : '';
	};


	//////////////////////////////////////////////////////////////
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
	//////////////////////////////////////////////////////////////


		var config={titulo_maestro:'Componente(Maestro) ',grid_maestro:'grid-'+idContenedor};
		var layout_af_comp_caract = new DocsLayoutMaestro(idContenedor,idContenedorPadre);
		layout_af_comp_caract.init(config);

	//////////////////////////////////////////////////////////////
	//---------         INICIAMOS HERENCIA           -----------//
	//////////////////////////////////////////////////////////////

	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina = Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,Atributos,ds,layout_af_comp_caract,idContenedor);

	
	var getDialog=this.getDialog;
		var getGrid=this.getGrid;
		var enableSelect=this.EnableSelect;
		var EstehtmlMaestro=this.htmlMaestro;
	//////////////////////////////////////////////////////////////
	// -----------   DEFINICI�N DE LA BARRA DE MEN� ----------- //
	//////////////////////////////////////////////////////////////

	var paramMenu = {
		guardar:{
			crear : true, //para ver si se creara el boton
			separador:false
		},
		nuevo: {
			crear : true, //para ver si se creara el boton
			separador:true
		},
		editar:{
			crear : true, //para ver si se creara el boton
			separador:false
		},
		eliminar:{
			crear : true, //para ver si se creara el boton
			separador:false
		},

		actualizar:{
			crear :true,
			separador:false
		}
	};


	//////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////
	
	var paramFunciones={
			btnEliminar:{url:direccion+'../../../control/activo_fijo_comp_caract/ActionEliminaActivoFijoCompCaract.php'},
			Save:{url:direccion+'../../../control/activo_fijo_comp_caract/ActionSaveActivoFijoCompCaract.php'},
			ConfirmSave:{url:direccion+'../../../control/activo_fijo_comp_caract/ActionSaveActivoFijoCompCaract.php'},
			Formulario:{html_apply:'dlgInfo-'+idContenedor,height:340,width:480,minWidth:560,minHeight:222,	closable:true,titulo:'Caracteristicas'}};


	//-------------- FIN DEFINICI�N DE FUNCIONES PROPIAS --------------//

	this.reload=function(m){
			    maestro=m;
				ds.lastOptions={
					params:{
						start:0,
						limit: paramConfig.TamanoPagina,
						CantFiltros:paramConfig.CantFiltros,
						maestro_id_componente:maestro.id_componente
						
						
						
					}
				};
				this.btnActualizar();
				//iniciarEventosFormularios();


				Atributos[3].defecto=maestro.id_componente;

				paramFunciones.btnEliminar.parametros='&txt_id_componente='+maestro.id_componente;
				paramFunciones.Save.parametros='&txt_id_componente='+maestro.id_componente;
				paramFunciones.ConfirmSave.parametros='&txt_id_componente='+maestro.id_componente;

				
				this.InitFunciones(paramFunciones)
			};
	//-------------- FIN DEFINICI�N DE FUNCIONES PROPIAS --------------//
	this.getLayout=function(){return layout_af_comp_caract.getLayout()};
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	this.InitFunciones(paramFunciones);
	
	this.iniciaFormulario();
	
	layout_af_comp_caract.getLayout().addListener('layout',this.onResize);
	
	ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario);
}
