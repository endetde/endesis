<?php
/**
 * Nombre:		  	    eeff_nota_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista del Hijo
 * Autor:				MTSLC
 * Fecha creaci�n:		2013-03-07 
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
	<?php if($_SESSION["ss_filtro_avanzado"]!=''){
		echo 'fa='.$_SESSION["ss_filtro_avanzado"].';';
	}
	?>
	var paramConfig={
		TamanoPagina:20,
		TiempoEspera:10000,
		CantFiltros:1,
		FiltroEstructura:false,
		FiltroAvanzado:fa
	};
	var maestro={
		id_eeff:'<?php echo $m_id_eeff;?>',
		desges_act:'<?php echo $m_desges_act;?>',
		desges_ant:'<?php echo $m_desges_ant;?>',
		nombre_eeff:'<?php echo $m_nombre_eeff;?>'
	};
	var elemento={idContenedor:idContenedor,pagina:new pagina_eeff_nota(idContenedor,direccion,paramConfig,maestro,'<?php echo $idContenedorPadre;?>')};
	ContenedorPrincipal.setPagina(elemento);
}
Ext.onReady(main,main);

/**
* Nombre:		  	    pagina_eeff_nota.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
* Fecha creaci�n:		2013-03-13 18:03:05
*/
function pagina_eeff_nota(idContenedor,direccion,paramConfig,maestro,idContenedorPadre){ 
	var vectorAtributos=new Array;
	var ds,ds_auxiliar;
	var elementos=new Array();
	var componentes=new Array();
	var combo_auxiliar;
	var sw=0;
	
	//  DATA STORE //
	ds=new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy:new Ext.data.HttpProxy({url:direccion+'../../../control/eeff_compara/ActionListarEeffNota.php'}),
		// aqui se define la estructura del XML
		reader:new Ext.data.XmlReader({
			record:'ROWS',
			id:'id_eeff_nota',
			totalRecords:'TotalCount'
		},[
		'id_eeff_nota',
		'id_eeff',
		'nota_nro',
		'nota_texto'
		]),remoteSort:true});
	
	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit:paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros,
			m_id_eeff:maestro.id_eeff
		}
	});	
	
	// DEFINICI�N DATOS DEL MAESTRO
	var cmMaestro=new Ext.grid.ColumnModel([
	{header:"Atributo",width:150,sortable:false,renderer:negrita,locked:false,dataIndex:'atributo'},
	{header:"Valor",width:300,sortable:false,renderer:italic,locked:false,dataIndex:'valor'}
	]);	
	function negrita(value){
		return '<span style="color:red;font-size:10pt"><b>'+value+'</b></span>'
	}
	function italic(value){
		return '<i>'+value+'</i>'
	}	
	var div_grid_detalle=Ext.DomHelper.append(idContenedor,{tag:'div',id:'grid_detalle-'+idContenedor});
	var gridMaestro=new Ext.grid.Grid(div_grid_detalle,{ds:new Ext.data.SimpleStore({fields:['atributo','valor'],data:[['Estado Financiero:',maestro.nombre_eeff],['Gesti�n Vigente:',maestro.desges_act],['Gesti�n Anterior:',maestro.desges_ant]]}),cm:cmMaestro});
	gridMaestro.render();
	
	//DATA STORE COMBOS	
	
	//FUNCIONES RENDER
	
	// Definici�n de datos //
	//en la posicion 0 siempre esta la llave primaria
	vectorAtributos[0]={
		validacion:{
			labelSeparator:'',
			name:'id_eeff_nota',
			inputType:'hidden',
			grid_visible:false, 
			grid_editable:false
		},
		tipo:'Field',
		filtro_0:false,
		save_as:'id_eeff_nota'
	};
	
	vectorAtributos[1]={
		validacion:{
			name:'id_eeff',
			labelSeparator:'',
			inputType:'hidden',
			grid_visible:false,
			grid_editable:false,
			disabled:true
		},
		tipo:'Field',
		filtro_0:false,
		defecto:maestro.id_eeff,
		save_as:'id_eeff'
	};
	
	vectorAtributos[2]={
		validacion:{
			name:'nota_nro',
			fieldLabel:'Nro. Nota',
			allowBlank:false,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:100,
			width:100,
			align:'right',
			disabled:false
		},
		tipo: 'TextField',
		form:true,
		filtro_0:true,
		filterColValue:'EFN.nota_nro',
		save_as:'nota_nro'
	};
	
	vectorAtributos[3]={
		validacion:{
			name:'nota_texto',
			fieldLabel:'Nota',
			allowBlank:false,
			minLength:0,
			selectOnFocus:true,
			vtype:'texto',
			grid_visible:true,
			grid_editable:false,
			width_grid:500,
			width:300,
			disabled:false
		},
		tipo: 'TextArea',
		form:true,
		filtro_0:false,
		save_as:'nota_texto'
	};
	   	
	//----------- FUNCIONES RENDER-----------//	
	function formatDate(value){return value ? value.dateFormat('d-m-Y'):''};
	
	//---------- INICIAMOS LAYOUT DETALLE-----------//
	var config={
		titulo_maestro:'EEFF Comparativo (Maestro)',
		titulo_detalle:'Notas al Estado Financiero (Detalle)',
		grid_maestro:'grid-'+idContenedor
	};
	layout_eeff_nota=new DocsLayoutDetalle(idContenedor,idContenedorPadre);
	layout_eeff_nota.init(config);	
	
	//---------- INICIAMOS HERENCIA------------//
	this.pagina=Pagina;
	this.pagina(paramConfig,vectorAtributos,ds,layout_eeff_nota,idContenedor);
	
	var getSelectionModel=this.getSelectionModel;
	var ClaseMadre_getComponente=this.getComponente;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var ClaseMadre_btnNew=this.btnNew;
	var ClaseMadre_btnEdit=this.btnEdit;
	var ClaseMadre_btnEliminar=this.btnEliminar;
	var CM_mostrarComponente=this.mostrarComponente;
	var CM_ocultarComponente=this.ocultarComponente;
	var CM_ocultarTodosComponente=this.ocultarTodosComponente;
	var ClaseMadre_getGrid=this.getGrid;
	var ClaseMadre_getFormulario=this.getFormulario;
	var ClaseMadre_getDialog=this.getDialog;
	var ClaseMadre_onResize=this.onResize;
	var ClaseMadre_SaveAndOther=this.SaveAndOther;
	
	//-------- DEFINICI�N DE LA BARRA DE MEN�------------//	
	var paramMenu={
		//guardar:{crear:true,separador:false},
		nuevo:{crear:true,separador:true},
		editar:{crear:true,separador:false},
		eliminar:{crear:true,separador:false},
		actualizar:{crear:true,separador:false}
	};
	
	//--------- DEFINICI�N DE FUNCIONES------------------//
	//datos necesarios para el filtro
	var paramFunciones={
		btnEliminar:{url:direccion+'../../../control/eeff_compara/ActionEliminarEeffNota.php',parametros:'&id_eeff='+maestro.id_eeff},
		Save:{url:direccion+'../../../control/eeff_compara/ActionGuardarEeffNota.php',parametros:'&id_eeff='+maestro.id_eeff},
		ConfirmSave:{url:direccion+'../../../control/eeff_compara/ActionGuardarEeffNota.php',parametros:'&id_eeff='+maestro.id_eeff},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,width:500,height:250,closable:true,titulo:'Registro de Notas'}
	};
	
	//-------------- Sobrecarga de funciones --------------------//
	this.reload=function(params){
		var datos=Ext.urlDecode(decodeURIComponent(params));
		maestro.id_eeff = datos.m_id_eeff;
		maestro.nombre_eeff = datos.m_nombre_eeff;
		maestro.desges_act = datos.m_desges_act;
		maestro.desges_ant = datos.m_desges_ant;
		
		gridMaestro.getDataSource().removeAll()
		gridMaestro.getDataSource().loadData([['Estado Financiero:',maestro.nombre_eeff],['Gesti�n Vigente:',maestro.desges_act],['Gesti�n Anterior:',maestro.desges_ant]]);
		
		vectorAtributos[1].defecto=maestro.id_eeff;
		
		var paramFunciones={
				btnEliminar:{url:direccion+'../../../control/eeff_compara/ActionEliminarEeffNota.php',parametros:'&id_eeff='+maestro.id_eeff},
				Save:{url:direccion+'../../../control/eeff_compara/ActionGuardarEeffNota.php',parametros:'&id_eeff='+maestro.id_eeff},
				ConfirmSave:{url:direccion+'../../../control/eeff_compara/ActionGuardarEeffNota.php',parametros:'&id_eeff='+maestro.id_eeff},
				Formulario:{html_apply:'dlgInfo-'+idContenedor,width:500,height:250,closable:true,titulo:'Registro de Notas'}
		};
		this.InitFunciones(paramFunciones)
		
		ds.lastOptions={
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_eeff:maestro.id_eeff
		}};
		
		this.btnActualizar()
	};
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	//Para manejo de eventos
	//para iniciar eventos en el formulario
	function iniciarEventosFormularios(){}
	
	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){
		return layout_eeff_nota.getLayout()
	};
	
	//para el manejo de hijos
	this.getPagina=function(idContenedorHijo){
		var tam_elementos=elementos.length;
		for(i=0;i<tam_elementos;i++){
			if(elementos[i].idContenedor==idContenedorHijo){
				return elementos[i]
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
	layout_eeff_nota.getLayout().addListener('layout',this.onResize);
	ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario)	
}