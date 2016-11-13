<?php 
/**
 * Nombre:		  	    documento_reten_det_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2013.03.26 17:55:38
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
	echo "var id='$id';";
	echo "var idSub='$idSub';";
    ?>
	var fa=false;
	
	<?php if($_SESSION["ss_filtro_avanzado"]!=''){echo 'fa='.$_SESSION["ss_filtro_avanzado"].';';}?>
	
	var paramConfig={TamanoPagina:_CP.getConfig().ss_tam_pag,
		TiempoEspera:_CP.getConfig().ss_tiempo_espera,
		CantFiltros:1,
		FiltroEstructura:false,
		FiltroAvanzado:fa};
	
	var result = "";
	var pestana=_CP.getPestana(id);
	var maestro={
		id_depto:'<?php echo utf8_decode($m_id_depto);?>',
		id_gestion:'<?php echo utf8_decode($m_id_gestion);?>',
		id_periodo:'<?php echo utf8_decode($m_id_periodo);?>',
		id_moneda:'<?php echo utf8_decode($m_id_moneda);?>',
		id_usuario:'<?php echo $m_id_usuario;?>',
		codigo_depto:'<?php echo utf8_decode($m_codigo_depto);?>',
		desc_depto:'<?php echo $m_desc_depto;?>',
		desc_gestion:'<?php echo $m_desc_gestion;?>',
		desc_periodo:'<?php echo utf8_decode($m_desc_periodo);?>',
		desc_moneda:'<?php echo utf8_decode($m_desc_moneda);?>',
		desc_usuario:'<?php echo $m_desc_usuario;?>',
		doc_id:'<?php echo $m_doc_id;?>',
		sw_retencion:'<?php echo utf8_decode($m_sw_retencion);?>',
		por_comprobante:'<?php echo $m_por_comprobante;?>',
	 	toda_gestion:'<?php echo $m_toda_gestion;?>',
		tipo_reporte:'<?php echo $m_tipo_reporte;?>',
		sw_totales:'<?php echo $m_sw_totales;?>'
	};
	
	idContenedorPadre='<?php echo $idContenedorPadre;?>';
	var elemento={pagina:new pagina_documento_reten_det(idContenedor,direccion,paramConfig,maestro,idContenedorPadre),idContenedor:idContenedor};
	_CP.setPagina(elemento);
}
Ext.onReady(main,main);

/**
* Nombre:		  	    pagina_documento_iva.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
* Fecha creaci�n:		2008-09-16 17:55:38
*/
function pagina_documento_reten_det(idContenedor,direccion,paramConfig,maestro,idContenedorPadre){
	var Atributos=new Array,sw=0;
	var g_comprobante;
	var filtro;
	
	var monedas_for=new Ext.form.MonedaField({
		name:'mes_01',
		fieldLabel:'Enero',	
		allowBlank:false,
		align:'right', 
		maxLength:50,
		minLength:0,
		selectOnFocus:true,
		allowDecimals:true,
		decimalPrecision:2,
		allowNegative:true,
		minValue:-1000000000000	
	});
	
	//---DATA STORE
	 var ds = new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/documento/ActionListarDocumentoReten.php'}),
		reader: new Ext.data.XmlReader({
		record: 'ROWS',id:'id_documento',totalRecords:'TotalCount'
		},[
		'desc_comprobante',
		'id_documento',
		{name: 'fecha_documento',type:'date',dateFormat:'Y-m-d'},
		'desc_plantilla',		
		'nro_documento',
		'razon_social',
		'importe_total',
		'importe_iue',
		'importe_it',
		'importe_credito',
		'importe_neto'
		]),remoteSort:true
	 });
	 
	//--RENDER
	function render_total(value,cell,record,row,colum,store){
		if(value < 0){
		return  '<span style="color:red;">' +monedas_for.formatMoneda(value)+'</span>'}	
		if(value >= 0){return monedas_for.formatMoneda(value)}
	}
	 
	//carga datos XML
	// txt desc_comprobate
	Atributos[0]={
		validacion:{
			name:'desc_comprobante',
			fieldLabel:'N� Cbte.',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:0,
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			width:100,
			disabled:true
		},
		tipo: 'NumberField',
		filtro_0:true,
		filterColValue:'desc_comprobante',
		save_as:'desc_comprobante'
	};
	
	Atributos[1]={
		validacion:{
			name:'desc_plantilla',
			fieldLabel:'Retenci�n',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:0,
			grid_visible:true,
			grid_editable:false,
			width_grid:220, 
			width:100,
			disabled:false
		},
		tipo: 'TextField',
		filtro_0:true,
		filterColValue:'PLAN.desc_plantilla',
		save_as:'desc_plantilla'
	};
	
	Atributos[2]={
		validacion:{
			name:'razon_social',
			fieldLabel:'Razon Social',
			allowBlank:false,
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:0,
			grid_visible:true,
			grid_editable:true,
			width_grid:250,
			width:100,
			disabled:false
		},
		tipo: 'TextField',
		filtro_0:true,
		filterColValue:'DOC.razon_social',
		save_as:'razon_social'
	};
	
	Atributos[3]= {
		validacion:{
			name:'fecha_documento',
			fieldLabel:'Fecha',
			allowBlank:false,
			align:'right',
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:true,
			grid_editable:true,
			renderer: formatDate,
			width_grid:85,
			disabled:false
		},
		tipo:'DateField',
		filtro_0:false,
		filterColValue:'DOC.fecha_documento',
		dateFormat:'m-d-Y',
		defecto:'',
		save_as:'fecha_documento'
	};
	
	Atributos[4]={
		validacion:{
			name:'nro_documento',
			fieldLabel:'N� Recibo',
			allowBlank:false,
			align:'right',
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:0,
			grid_visible:true,
			grid_editable:true,
			width_grid:90,
			width:100,
			disabled:false
		},
		tipo: 'NumberField',
		filtro_0:true,
		filterColValue:'DOC.nro_documento',
		save_as:'nro_documento'
	};

	Atributos[5]={
		validacion:{
			name:'importe_total',
			fieldLabel:'Importe Total',
			allowBlank:false, 
			align:'right',
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:0,
			grid_visible:true,
			grid_editable:false,
			renderer: render_total,
			width_grid:130,
			width:100,
			disabled:true
		},
		tipo: 'NumberField',
		filtro_0:true,
		filterColValue:'DOCVAL.importe_total',
		save_as:'importe_avance'
	};

	Atributos[6]={
		validacion:{
			name:'importe_iue',
			fieldLabel:'Importe IUE',
			allowBlank:false,
			align:'right',
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:0,
			grid_visible:true,
			grid_editable:false,
			renderer: render_total,
			width_grid:130,
			width:100,
			disabled:true
		},
		tipo: 'NumberField',
		filtro_0:false,
		filterColValue:'DOCVAL.importe_iue',
		save_as:'importe_iue'
	};
		
	Atributos[7]={
		validacion:{
			name:'importe_it',
			fieldLabel:'Importe IT',
			allowBlank:false,
			align:'right',
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:0,
			grid_visible:true,
			grid_editable:false,
			renderer: render_total,
			width_grid:130,
			width:100,
			disabled:true
		},
		tipo: 'NumberField',
		filtro_0:false,
		filterColValue:'DOCVAL.importe_it',
		save_as:'importe_it'
	};
	
	Atributos[8]={
		validacion:{
			name:'importe_credito',
			fieldLabel:'RC-IVA',
			allowBlank:false,
			align:'right',
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:0,
			grid_visible:true,
			grid_editable:false,
			renderer: render_total,
			width_grid:130,
			width:100,
			disabled:true
		},
		tipo: 'NumberField',
		filtro_0:false,
		filterColValue:'DOCVAL.importe_credito',
		save_as:'importe_credito'
	};
	
	Atributos[9]={
		validacion:{
			name:'importe_neto',
			fieldLabel:'Importe L�quido',
			allowBlank:false,
			align:'right',
			maxLength:50,
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:0,
			grid_visible:true,
			grid_editable:false,
			renderer: render_total,
			width_grid:130,
			width:100,
			disabled:true
		},
		tipo: 'NumberField',
		filtro_0:false,
		filterColValue:'DOCVAL.importe_neto',
		save_as:'importe_neto'
	};

	Atributos[10]={
		validacion:{
			labelSeparator:'',
			name: 'id_documento',
			fieldLabel:'ID Documento',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false,
		save_as:'id_documento'
	};
 
	// ----------            FUNCIONES RENDER    ---------------//
	function formatDate(value){return value?value.dateFormat('d/m/Y'):''};
	
	//---------- INICIAMOS LAYOUT DETALLE
	var config = {
		titulo_maestro:'Documentos de Retenci�n',
		grid_maestro:'grid-'+idContenedor
	};
    layout_documento_reten_det=new DocsLayoutMaestro(idContenedor,idContenedorPadre);
    layout_documento_reten_det.init(config);

	// INICIAMOS HERENCIA //
	this.pagina=Pagina;
	this.pagina(paramConfig,Atributos,ds,layout_documento_reten_det,idContenedor);
	var getComponente=this.getComponente;
	var getSelectionModel=this.getSelectionModel;
	var ClaseMadre_btnNew=this.btnNew;
	var CM_btnEdit=this.btnEdit;
	var CM_saveSuccess=this.saveSuccess;
	var CM_ocultarGrupo=this.ocultarGrupo;
	var CM_mostrarGrupo=this.mostrarGrupo;
	var CM_ocultarComponente=this.ocultarComponente;
	var CM_mostrarComponente= this.mostrarComponente;
	var Cm_conexionFailure=this.conexionFailure;
	var Cm_btnActualizar=this.btnActualizar;
	var getGrid=this.getGrid;
	var getDialog= this.getDialog;
	
	// DEFINICI�N DE LA BARRA DE MEN�//
	var paramMenu={
		guardar:{crear:true,separador:false},	
		actualizar:{crear:true,separador:false}
	};
	
	var paramFunciones={
		btnEliminar:{
			url:direccion+"../../../control/categoria/ActionEliminarDocumento.php"
		},
		Save:{
			url:direccion+"../../../control/documento/ActionGuardarDocumentoIva.php"
		},
		ConfirmSave:{
			url:direccion+"../../../control/documento/ActionGuardarDocumentoIva.php"
		},
		Formulario:{
			titulo:'Documentos de Retenci�n',
			html_apply:"dlgInfo-"+idContenedor,
			width:'40%',
			height:'50%',
			minWidth:150,
			minHeight:100,
			columnas:['95%'],
			closable:true
		}
	};
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //

	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	//Para manejo de eventos
	this.reload=function(m){
		var datos=Ext.urlDecode(decodeURIComponent(m));
		maestro=datos;
		
		ds.lastOptions={
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_depto:maestro.id_depto,
				m_gestion:maestro.desc_gestion,
				m_periodo:maestro.id_periodo,
				m_id_moneda:maestro.id_moneda,
				sw_retencion:maestro.sw_retencion,
				por_comprobante:maestro.por_comprobante,
				toda_gestion:maestro.toda_gestion,
				sw_totales:maestro.sw_totales
			}
		};
		this.btnActualizar();
	};
	
	function iniciarEventosFormularios(){}
	
	function btn_reporte_jasper(){
		var sm=getSelectionModel();
		var filas=ds.getModifiedRecords();
		var cont=filas.length;
		var NumSelect=sm.getCount();
		
		if (maestro.sw_totales == 'false'){
				window.open(direccion+'../../../control/documento/reporte/ActionPDFLibroRetenJasper.php?id_depto='+maestro.id_depto+'&id_periodo='+maestro.id_periodo+
				'&id_moneda='+maestro.id_moneda+'&id_usuario='+maestro.id_usuario+'&sw_retencion='+maestro.sw_retencion+
				'&desc_usuario='+maestro.desc_usuario+'&doc_id='+maestro.doc_id+'&desc_gestion='+maestro.desc_gestion+'&desc_periodo='+maestro.desc_periodo+
				'&por_comprobante='+maestro.por_comprobante+'&toda_gestion='+maestro.toda_gestion+'&tipo_reporte='+maestro.tipo_reporte);
		}
	}
	
	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_documento_reten_det.getLayout()};
	
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	this.InitFunciones(paramFunciones);
	
	this.iniciaFormulario();
	iniciarEventosFormularios();
	
	this.AdicionarBoton('../../../lib/imagenes/print.gif','Libro de Retenciones (pdf, xls, doc)',btn_reporte_jasper,true,'reporte_libro_jasper','Reporte');
	
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros,
			m_id_depto:maestro.id_depto,
			m_gestion:maestro.desc_gestion,
			m_periodo:maestro.id_periodo,
			m_id_moneda:maestro.id_moneda,
			sw_retencion:maestro.sw_retencion,
			por_comprobante:maestro.por_comprobante,
			toda_gestion:maestro.toda_gestion,
			sw_totales:maestro.sw_totales
		}
	});
	
	layout_documento_reten_det.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}
