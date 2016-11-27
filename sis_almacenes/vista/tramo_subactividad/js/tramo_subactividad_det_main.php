<?php
/**
 * Nombre:		  	    tramo_subactividad_det_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista del Hijo
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-03-31 11:15:42
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
	
	var fa=false;
	<?php
	if($_SESSION["ss_filtro_avanzado"]==''){
		echo 'fa='.$_SESSION["ss_filtro_avanzado"].';';
	}
	
	?>
	
var paramConfig={TamanoPagina:20,TiempoEspera:10000,CantFiltros:1,FiltroEstructura:false,FiltroAvanzado:fa};
var maestro={
	     	id_tramo:<?php echo $m_id_tramo;?>,codigo:'<?php echo $m_codigo;?>',
	     	descripcion:'<?php echo $m_descripcion;?>',
	     	desc_programa_proyecto_actividad:'<?php echo $m_desc_programa_proyecto_actividad;?>',
	     	id_prog_proy_acti:<?php echo $m_id_prog_proy_acti?>
	     	};
idContenedorPadre='<?php echo $idContenedorPadre;?>';
var elemento={idContenedor:idContenedor,pagina:new pagina_tramo_subactividad_det(idContenedor,direccion,paramConfig,maestro,idContenedorPadre)};
//ContenedorPrincipal.getPagina(idContenedorPadre).pagina.setPagina(elemento);
ContenedorPrincipal.setPagina(elemento);
}
Ext.onReady(main,main);


/**
 * Nombre:		  	    pagina_tramo_subactividad_det.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-03-31 11:15:42
 */
function pagina_tramo_subactividad_det(idContenedor,direccion,paramConfig,maestro,idContenedorPadre)
{
	var vectorAtributos=new Array;
	var ds;
	var elementos=new Array();
	var sw=0;
	/////////////////
	//  DATA STORE //
	/////////////////
	ds = new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/tramo_subactividad/ActionListarTramoSubactividad_det.php'}),
		// aqui se define la estructura del XML
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_tramo_subactividad',
			totalRecords: 'TotalCount'

		}, [
		// define el mapeo de XML a las etiquetas (campos)
				'id_tramo_subactividad',
		{name: 'fecha_reg',type:'date',dateFormat:'Y-m-d'},
		'id_subactividad',
		'desc_subactividad',
		'desc_tramo',
		'id_tramo'

		]),remoteSort:true});

	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros,
			m_id_tramo:maestro.id_tramo
		}
	});
	// DEFINICI�N DATOS DEL MAESTRO
//var dataMaestro=[['Id.Tramo',maestro.id_tramo],['C�digo',maestro.codigo],['Descripci�n',maestro.descripcion]];

//	var dsMaestro = new Ext.data.Store({proxy: new Ext.data.MemoryProxy(dataMaestro),reader: new Ext.data.ArrayReader({id:0},[{name:'atributo'},{name:'valor'}])});
//	dsMaestro.load();
	var cmMaestro = new Ext.grid.ColumnModel([{header:"Atributo",width:150,sortable:false,renderer:negrita,locked:false,dataIndex:'atributo'},{header:"Valor",width: 300,sortable:false,renderer:italic,locked:false,dataIndex:'valor'}]);
	function negrita(value){return '<span style="color:red;font-size:10pt"><b>'+value+'</b></span>';}
	function italic(value){return '<i>'+value+'</i>';}
	var div_grid_detalle=Ext.DomHelper.append(idContenedor,{tag:'div',id:'grid_detalle-'+idContenedor});
	var gridMaestro=new Ext.grid.Grid(div_grid_detalle,{ds:new Ext.data.SimpleStore({fields:['atributo','valor'],data:[['Id.Tramo',maestro.id_tramo],['C�digo',maestro.codigo],['Descripci�n',maestro.descripcion]]}),cm:cmMaestro});
	gridMaestro.render();
	//DATA STORE COMBOS

    ds_subactividad = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/subactividad/ActionListarSubactividad.php'}),
			reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_subactividad',
			totalRecords: 'TotalCount'
		}, ['id_subactividad','codigo','direccion','descripcion','observaciones','fecha_reg','id_prog_proy_acti'])
	});

	//FUNCIONES RENDER
	
			function render_id_subactividad(value, p, record){return String.format('{0}', record.data['desc_subactividad']);};
	var resultTplSubActividad=new Ext.Template('<div class="search-item">','<b><i>{codigo}</i></b>','<br><FONT COLOR="#B5A642">{descripcion}</FONT>','</div>');
	/////////////////////////
	// Definici�n de datos //
	/////////////////////////
	
	// hidden id_tramo_subactividad
	//en la posici�n 0 siempre esta la llave primaria

	var param_id_tramo_subactividad = {
		validacion:{
			//fieldLabel: 'Id',
			labelSeparator:'',
			name: 'id_tramo_subactividad',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		save_as:'hidden_id_tramo_subactividad'
	};
	vectorAtributos[0] = param_id_tramo_subactividad;
// txt fecha_reg
	var param_fecha_reg= {
		validacion:{
			name:'fecha_reg',
			fieldLabel:'Fecha Registro',
			allowBlank:true,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:true,
			grid_editable:true,
			renderer: formatDate,
			width_grid:95,
			disabled:true,
			grid_indice:2
		},
		tipo:'DateField',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'TRASAC.fecha_reg',
		dateFormat:'m-d-Y',
		defecto:'',
		save_as:'txt_fecha_reg'
	};
	vectorAtributos[1] = param_fecha_reg;
// txt id_subactividad

    var filterCols_id_subactividad = new Array();
	var filterValues_id_subactividad = new Array();
	filterCols_id_subactividad[0]='SUBACT.id_prog_proy_acti';
	filterValues_id_subactividad[0]= maestro.id_prog_proy_acti;


	var param_id_subactividad= {
			validacion: {
			name:'id_subactividad',
			fieldLabel:'Subactividad',
			allowBlank:false,			
			emptyText:'Id.Subactividad...',
			desc: 'desc_subactividad', //indica la columna del store principal ds del que proviane la descripcion
			store:ds_subactividad,
			valueField: 'id_subactividad',
			displayField: 'descripcion',
			queryParam: 'filterValue_0',
			filterCol:'SUBACT.codigo#SUBACT.descripcion',
			filterCols:filterCols_id_subactividad,
			filterValues:filterValues_id_subactividad,
			typeAhead:true,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:100,
			minListWidth:450,
			grow:true,
			tpl:resultTplSubActividad,
			//width:'100%',
			//grow:true,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
			triggerAction:'all',
			editable:true,
			renderer:render_id_subactividad,
			grid_visible:true,
			grid_editable:true,
			grid_indice:1,
			width_grid:180 // ancho de columna en el gris
		},
		tipo:'ComboBox',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'SUBACT.codigo#SUBACT.descripcion',
		defecto: '',
		save_as:'txt_id_subactividad'
	};
	vectorAtributos[2] = param_id_subactividad;
// txt id_tramo
	var param_id_tramo= {
		validacion:{
			name:'id_tramo',
			labelSeparator:'',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false,
			disabled:true
		},
		tipo:'Field',
		filtro_0:false,
		defecto:maestro.id_tramo,
		save_as:'txt_id_tramo'
	};
	vectorAtributos[3] = param_id_tramo;

	
	//----------- FUNCIONES RENDER
	
	function formatDate(value){
		return value ? value.dateFormat('d/m/Y') : '';
	};

	//---------- INICIAMOS LAYOUT DETALLE
	var config={
		titulo_maestro:'Tramos (Maestro)',
		titulo_detalle:'Relaci�n Tramos Subactividad (Detalle)',
		grid_maestro:'grid-'+idContenedor
	};
	layout_tramo_subactividad = new DocsLayoutDetalle(idContenedor,idContenedorPadre);
	layout_tramo_subactividad.init(config);
	
	
	
	//---------- INICIAMOS HERENCIA
	this.pagina = Pagina;
	this.pagina(paramConfig,vectorAtributos,ds,layout_tramo_subactividad,idContenedor);
	var getSelectionModel=this.getSelectionModel;
	var ClaseMadre_getComponente=this.getComponente;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_btnNew=this.btnNew;
	var ClaseMadre_onResize=this.onResize;
	var ClaseMadre_SaveAndOther=this.SaveAndOther;
	//-------- DEFINICI�N DE LA BARRA DE MEN�
	

	var paramMenu={
		guardar:{crear:true,separador:false},
		nuevo:{crear:true,separador:true},
		editar:{crear:true,separador:false},
		eliminar:{crear:true,separador:false},
		actualizar:{crear:true,separador:false}
	};


	
	//--------- DEFINICI�N DE FUNCIONES
	//aqu� se parametrizan las funciones que se ejecutan en la clase madre
	
	//datos necesarios para el filtro
	var paramFunciones={
	btnEliminar:{url:direccion+'../../../control/tramo_subactividad/ActionEliminarTramoSubactividad.php',parametros:'&m_id_tramo='+maestro.id_tramo},
	Save:{url:direccion+'../../../control/tramo_subactividad/ActionGuardarTramoSubactividad.php',parametros:'&m_id_tramo='+maestro.id_tramo},
	ConfirmSave:{url:direccion+'../../../control/tramo_subactividad/ActionGuardarTramoSubactividad.php'},
	Formulario:{html_apply:'dlgInfo-'+idContenedor,height:340,
		width:480,
	
	
	minWidth:150,minHeight:200,closable:true,titulo: 'tramo_subactividad'}
	}
	
	this.reload=function(params){
		var datos=Ext.urlDecode(decodeURIComponent(params));
		maestro.id_tramo=datos.m_id_tramo;
		maestro.codigo=datos.m_codigo;
		maestro.descripcion=datos.m_descripcion;		
		maestro.id_prog_proy_acti =datos.m_id_prog_proy_acti;
		maestro.desc_programa_proyecto_actividad=datos.m_desc_programa_proyecto_actividad;
		
		var cmb_id_subactividad=ClaseMadre_getComponente('id_subactividad');
		
		
		ds.load({
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_tramo:maestro.id_tramo
			}
		});
		gridMaestro.getDataSource().removeAll();
		gridMaestro.getDataSource().loadData([['Id.Tramo',maestro.id_tramo],['C�digo',maestro.codigo],['Descripci�n',maestro.descripcion], ['Proyecto',maestro.desc_programa_proyecto_actividad]]);
		vectorAtributos[3].defecto=maestro.id_tramo;
		paramFunciones.btnEliminar.parametros='&m_id_tramo='+maestro.id_tramo;
		paramFunciones.Save.parametros='&m_id_tramo='+maestro.id_tramo;
		paramFunciones.ConfirmSave.parametros='&m_id_tramo='+maestro.id_tramo;
		this.InitFunciones(paramFunciones)
		
		cmb_id_subactividad.modificado = true;
		cmb_id_subactividad.filterValues[0] = maestro.id_prog_proy_acti;
	};
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//

	//Para manejo de eventos
	function iniciarEventosFormularios()
	{	
	//para iniciar eventos en el formulario
	}

	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){
		return layout_tramo_subactividad.getLayout();
	};



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
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	this.InitFunciones(paramFunciones);
	//para agregar botones
	
	this.iniciaFormulario();
	iniciarEventosFormularios();
	layout_tramo_subactividad.getLayout().addListener('layout',this.onResize);
	ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario);
	
}