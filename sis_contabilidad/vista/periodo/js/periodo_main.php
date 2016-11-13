<?php
/**
 * Nombre:		  	    periodo_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista del Hijo
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-12-01 14:49:33
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
var maestro={id_gestion:<?php echo $id_gestion;?>,gestion:decodeURIComponent('<?php echo $gestion;?>'),desc_empresa:decodeURIComponent('<?php echo $desc_empresa;?>')};
idContenedorPadre='<?php echo $idContenedorPadre;?>';
var elemento={idContenedor:idContenedor,pagina:new pagina_periodo(idContenedor,direccion,paramConfig,maestro,idContenedorPadre)};
_CP.setPagina(elemento);
}
Ext.onReady(main,main);

/**
 * Nombre:		  	    pagina_periodo.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-12-01 14:49:33
 */
function pagina_periodo(idContenedor,direccion,paramConfig,maestro,idContenedorPadre)
{
	var Atributos=new Array,sw=0;
	var componentes=new Array;
	/////////////////
	//  DATA STORE //
	/////////////////
	var ds = new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/periodo/ActionListarPeriodo.php'}),
		// aqui se define la estructura del XML
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_periodo',
			totalRecords: 'TotalCount'
		}, [
		// define el mapeo de XML a las etiquetas (campos)
				'id_periodo',
		'id_gestion',
		'desc_gestion',
		'periodo',
		{name: 'fecha_inicio',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_final',type:'date',dateFormat:'Y-m-d'},
		'estado_peri_gral'
		]),remoteSort:true});
	
	// DEFINICI�N DATOS DEL MAESTRO
	function negrita(value){return '<span style="color:red;font-size:10pt"><b>'+value+'</b></span>';}
	function italic(value){return '<i>'+value+'</i>';}
	
	//DATA STORE COMBOS

    var ds_gestion = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/gestion/ActionListarGestion.php'}),
			reader:new Ext.data.XmlReader({record:'ROWS',id:'id_gestion',totalRecords: 'TotalCount'},['id_gestion','denominacion','gestion'])
	});

	//FUNCIONES RENDER
	function render_id_gestion(value, p, record){return String.format('{0}', record.data['desc_gestion']);}
	var tpl_id_gestion=new Ext.Template('<div class="search-item">','<FONT COLOR="#B5A642">{denominacion}</FONT><br>','<FONT COLOR="#B5A642">{gestion}</FONT>','</div>');
	
	/////////////////////////
	// Definici�n de datos //
	/////////////////////////
	
	// hidden id_periodo
	//en la posici�n 0 siempre esta la llave primaria

	Atributos[0]={
		validacion:{
			labelSeparator:'',
			name: 'id_periodo',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false
	};

	// txt id_gestion
	Atributos[1]={
		validacion:{
			name:'id_gestion',
			labelSeparator:'',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false,
			disabled:true
		},
		tipo:'Field',
		filtro_0:false,
		defecto:maestro.id_gestion
	};

	// txt periodo
	Atributos[2]={
		validacion:{
			name:'periodo',
			fieldLabel:'Periodo',
			allowBlank:false,
			maxLength:50,
			align:'right', 
			minLength:0,
			selectOnFocus:true,
			allowDecimals:false,
			allowNegative:false,
			minValue:0,
			grid_visible:true,
			grid_editable:false,
			width_grid:75,
			width:'100%',
			disabled:false,
			grid_indice:2		
		},
		tipo: 'NumberField',
		form: false,
		filtro_0:true,
		filterColValue:'PERIOD.periodo'
	};

	// txt fecha_inicio
	Atributos[3]= {
		validacion:{
			name:'fecha_inicio',
			fieldLabel:'Fecha Inicio',
			allowBlank:false,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:true,
			grid_editable:false,
			renderer: formatDate,
			align:'center',
			width_grid:100,
			disabled:false,
			grid_indice:3			
		},
		form:true,
		tipo:'DateField',
		filtro_0:true,
		filterColValue:'PERIOD.fecha_inicio',
		dateFormat:'m-d-Y',
		defecto:''
	};

	// txt fecha_final
	Atributos[4]= {
		validacion:{
			name:'fecha_final',
			fieldLabel:'Fecha Final',
			allowBlank:false,
			format: 'd/m/Y', //formato para validacion
			minValue: '01/01/1900',
			disabledDaysText: 'D�a no v�lido',
			grid_visible:true,
			grid_editable:false,
			renderer: formatDate,
			align:'center',
			width_grid:100,
			disabled:false,
			grid_indice:4			
		},
		form:true,
		tipo:'DateField',
		filtro_0:true,
		filterColValue:'PERIOD.fecha_final',
		dateFormat:'m-d-Y',
		defecto:''
	};

	// txt estado_peri_gral
	Atributos[5]={
			validacion: {
			name:'estado_peri_gral',
			fieldLabel:'Estado',
			grid_visible:true,
			grid_editable:false,
			align:'center',
			width_grid:100,
			grid_indice:5			
		},
		tipo:'Field',
		form: false,
		filtro_0:true,
		filterColValue:'PERIOD.estado_peri_gral',
		defecto:'abierto'
	};
	
	Atributos[6]={
		validacion:{
			name:'desc_gestion',
			fieldLabel:'Gesti�n',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			align:'center',
			grid_indice:1		
		},
		tipo:'Field',
		filtro_0:true,
		form:false,		
		filterColValue:'GESTIO.gestion'
	};
	
	Atributos[7]={
		validacion:{
			name:'accion',
			labelSeparator:'',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false,
			disabled:true
		},
		tipo:'Field',
		filtro_0:false
	};
	
	//----------- FUNCIONES RENDER
	function formatDate(value){return value?value.dateFormat('d/m/Y'):''};

	//---------- INICIAMOS LAYOUT DETALLE
	var config={titulo_maestro:'Gesti�n (Maestro)',grid_maestro:'grid-'+idContenedor,urlHijo:'../../../sis_contabilidad/vista/periodo/periodo_subsistema.php'};
	var layout_periodo = new DocsLayoutMaestroDeatalle(idContenedor,idContenedorPadre);
	layout_periodo.init(config);
	
	//---------- INICIAMOS HERENCIA
	this.pagina = Pagina;
	this.pagina(paramConfig,Atributos,ds,layout_periodo,idContenedor);
	var CM_getComponente=this.getComponente;
	var getSelectionModel=this.getSelectionModel;
	var cm_EnableSelect=this.EnableSelect;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_saveSuccess=this.saveSuccess;
	
	//DEFINICI�N DE LA BARRA DE MEN�
	var paramMenu={actualizar:{crear:true,separador:false}};

	//DEFINICI�N DE FUNCIONES
	var paramFunciones={
	btnEliminar:{url:direccion+'../../../control/periodo/ActionEliminarPeriodo.php',parametros:'&id_gestion='+maestro.id_gestion},
	Save:{url:direccion+'../../../control/periodo/ActionGuardarPeriodo.php',parametros:'&id_gestion='+maestro.id_gestion},
	ConfirmSave:{url:direccion+'../../../control/periodo/ActionGuardarPeriodo.php',parametros:'&id_gestion='+maestro.id_gestion},
	Formulario:{html_apply:'dlgInfo-'+idContenedor,height:340,width:480,minWidth:150,minHeight:200,	closable:true,titulo:'periodo'}};
	
	//-------------- Sobrecarga de funciones --------------------//
	this.reload=function(params){
		Ext.apply(maestro,Ext.urlDecode(decodeURIComponent(params)));
		ds.lastOptions={
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				id_gestion:maestro.id_gestion
			}
		};
		this.btnActualizar();
		
		Atributos[1].defecto=maestro.id_gestion;

		paramFunciones.btnEliminar.parametros='&id_gestion='+maestro.id_gestion;
		paramFunciones.Save.parametros='&id_gestion='+maestro.id_gestion;
		paramFunciones.ConfirmSave.parametros='&id_gestion='+maestro.id_gestion;
		this.InitFunciones(paramFunciones)
	};
	
	//Para manejo de eventos
	function iniciarEventosFormularios(){	
		getSelectionModel().on('rowdeselect',function(){
			if(_CP.getPagina(layout_periodo.getIdContentHijo()).pagina.limpiarStore()){
				_CP.getPagina(layout_periodo.getIdContentHijo()).pagina.bloquearMenu()
			}
		})
				
		for (var i=0;i<Atributos.length;i++){
			componentes[i]=CM_getComponente(Atributos[i].validacion.name);
		}
	}
	
	this.EnableSelect=function(sm,row,rec){
		cm_EnableSelect(sm,row,rec);
		_CP.getPagina(layout_periodo.getIdContentHijo()).pagina.reload(rec.data);
		_CP.getPagina(layout_periodo.getIdContentHijo()).pagina.desbloquearMenu();
	}
	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_periodo.getLayout()};
	//para el manejo de hijos
	
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	this.InitFunciones(paramFunciones);
	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros,
			id_gestion:maestro.id_gestion
		}
	});
	function btn_abrir_periodo(){
		//loading
		Ext.MessageBox.show({
			title: 'Espere Por Favor...',
			msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Abriendo Periodo...</div>",
			width:150,
			height:200,
			closable:false
		});
		
		Ext.Ajax.request({
			url:direccion+"../../../control/periodo/ActionGuardarPeriodo.php",
			success:miSuccess,
			params:{'accion':1,'id_gestion':maestro.id_gestion},
			failure:ClaseMadre_conexionFailure,
			timeout:paramConfig.TiempoEspera
		})
	}
	
	function btn_cerrar_periodo(){
		//loading
		Ext.MessageBox.show({
			title: 'Espere Por Favor...',
			msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Cerrando Periodo...</div>",
			width:150,
			height:200,
			closable:false
		});
		
		Ext.Ajax.request({
			url:direccion+"../../../control/periodo/ActionGuardarPeriodo.php",
			success:miSuccess,
			params:{'accion':1,'id_gestion':maestro.id_gestion},
			failure:ClaseMadre_conexionFailure,
			timeout:paramConfig.TiempoEspera
		})
	}
	
	function miSuccess(resp){
		Ext.MessageBox.hide();
		if(resp.responseXML&&resp.responseXML.documentElement){
			ds.load(ds.lastOptions);
		}else{
			ClaseMadre_conexionFailure(resp);
		}
	}
	
	//para agregar botones
	this.AdicionarBoton('../../../lib/imagenes/a_table_gear.png','Pre-Abrir Siguiente Periodo',btn_abrir_periodo,true,'abrir_periodo','Pre-Abrir Siguiente Periodo');
	this.AdicionarBoton('../../../lib/imagenes/a_table_gear.png','Cerrar Ultimo Periodo',btn_cerrar_periodo,true,'cerrar_periodo','Cerrar Ultimo Periodo');

	this.iniciaFormulario();
	iniciarEventosFormularios();
	layout_periodo.getLayout().addListener('layout',this.onResize);
	ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario);
}