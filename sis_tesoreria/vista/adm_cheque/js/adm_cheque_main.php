<?php 
/**
 * Nombre:		  	    adm_cheque_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista
 * Autor:				RCM
 * Fecha creaci�n:		09/11/2009
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
var elemento={pagina:new pagina_adm_cheque(idContenedor,direccion,paramConfig),idContenedor:idContenedor};
_CP.setPagina(elemento);
}
Ext.onReady(main,main);

//view added

/**
 * Nombre:		  	    pagina_adm_cheque.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				RCM
 * Fecha creaci�n:		09/11/2009
 */
function pagina_adm_cheque(idContenedor,direccion,paramConfig){
	var Atributos=new Array,sw=0;
	var componentes=new Array();

	var monedas_for=new Ext.form.MonedaField(
			{
				name:'importe',
				fieldLabel:'valor',	
				allowBlank:false,
				align:'right', 
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:2,
				allowNegative:true,
				minValue:-1000000000000}	
			);

	//---DATA STORE
	var ds = new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/adm_cheque/ActionListarAdmCheque.php'}),
		reader: new Ext.data.XmlReader({
		record: 'ROWS',id:'id_cheque',totalRecords:'TotalCount'
		},[		
		'tipo',
		'id_cheque',
		'id_cuenta_bancaria',
		//'fecha_cheque',
		{name: 'fecha_cheque',type:'date',dateFormat:'Y-m-d'},
		'nombre_cheque',
		'nro_cheque',
		'importe_cheque',
		'id',
		'fecha_desde',
		'fecha_hasta',
		'descripcion',
		'observaciones',
		'id_empleado_origen',
		'desc_empleado_origen',
		'codigo',
		'moneda',
		'tipo_especifico',
		'id_moneda',
		'banco',
		'nro_cuenta_banco',
		'estado',
		'tipo_largo',
		'id_depto',
		'nombre_depto'
		]),remoteSort:true});

	//DATA STORE COMBOS
	var ds_ges_cta=new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_tesoreria/control/cuenta_bancaria/ActionListarCuentaBancaria.php'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_cuenta_bancaria',totalRecords: 'TotalCount+100'},
				['id_cuenta_bancaria','id_institucion','desc_institucion','id_cuenta','desc_cuenta',
				 'nro_cheque','estado_cuenta','nro_cuenta_banco','id_moneda','nombre_moneda','gestion']),baseParams:{m_id_gestion:-2}
	});
    
	var tpl_ges_cta=new Ext.Template('<div class="search-item">'
			,'<b>Cuenta: </b><FONT COLOR="#B5A642">{nro_cuenta_banco}</FONT><br>',
			'<b>Banco: </b><FONT COLOR="#B5A642">{desc_institucion}</FONT><br>',
			'<b>Gestion: </b><FONT COLOR="#B5A642">{gestion}</FONT><br>','</div>');
	
	//FUNCIONES RENDER
	function render_tipo_especifico(value, p, record){
		return record.data['tipo_largo'];
	}
	
	function render_id_depto(value, p, record){
		return record.data['nombre_depto'];
	}
	
	function render_total(value,cell,record,row,colum,store){
		if(value < 0){return  '<span style="color:red;">' + monedas_for.formatMoneda(value)+'</span>'}	
		if(value >= 0){return monedas_for.formatMoneda(value)}
	}

	//ATRIBUTOS
	Atributos[0]={
		validacion:{
			labelSeparator:'',
			name: 'id_cheque',
			fieldLabel:'Identificador Cheque',
			inputType:'hidden',
			grid_visible:true, 
			grid_editable:false
		},
		tipo: 'Field',
		filtro_0:false
	};
	
	Atributos[1]={
			validacion:{
				labelSeparator:'',
				name: 'tipo',
				inputType:'hidden',
				grid_visible:false, 
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false
		};
	
	Atributos[2]={
			validacion:{
				labelSeparator:'',
				name: 'id_cuenta_bancaria',
				inputType:'hidden',
				grid_visible:false, 
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false
		};
	
	Atributos[3]={
			validacion:{
				labelSeparator:'',
				name: 'id',
				inputType:'hidden',
				grid_visible:false, 
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false
		};
	
	Atributos[4]={
			validacion:{
				labelSeparator:'',
				name: 'id_empleado_origen',
				inputType:'hidden',
				grid_visible:false, 
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false
		};
	
	Atributos[5]={//1
			validacion:{
				name:'fecha_cheque',
				fieldLabel:'Fecha Cheque',
				grid_visible:true,
				grid_editable:false,
				width_grid:90,
				renderer:formatDate
			},
			tipo:'Field',
			filtro_0:true
		};
	
	Atributos[6]={//2
			validacion:{
				name:'nro_cheque',
				fieldLabel:'Nro.Cheque',
				grid_visible:true,
				grid_editable:false,
				width_grid:80
			},
			tipo:'Field',
			filtro_0:true
		};
	
	Atributos[7]={//3
			validacion:{
				name:'desc_empleado_origen',
				fieldLabel:'Solicitante',
				grid_visible:true,
				grid_editable:false,
				width_grid:250
			},
			tipo:'Field',
			filtro_0:true
		};
	
	Atributos[8]={//4
			validacion:{
				name:'nombre_cheque',
				fieldLabel:'Beneficiario',
				grid_visible:true,
				grid_editable:false,
				width_grid:250
			},
			tipo:'Field',
			filtro_0:true
		};
	
	Atributos[9]={//5
			validacion:{
				name:'importe_cheque',
				fieldLabel:'Importe',
				grid_visible:true,
				grid_editable:false,
				width_grid:120,
				align:'right',
				renderer: render_total
			},
			tipo:'Field',
			filtro_0:true
		};

	Atributos[10]={//6
			validacion:{
				name:'moneda',
				fieldLabel:'Moneda',
				grid_visible:true,
				grid_editable:false,
				width_grid:100
			},
			tipo:'Field',
			filtro_0:true
		};
	
	Atributos[11]={//7
			validacion:{
				name:'codigo',
				fieldLabel:'Nro.Documento',
				grid_visible:true,
				grid_editable:false,
				width_grid:100
			},
			tipo:'Field',
			filtro_0:true
		};
	
	Atributos[12]={//8
			validacion:{
				name:'fecha_desde',
				fieldLabel:'Fecha Desde',
				grid_visible:true,
				grid_editable:false,
				width_grid:90
			},
			tipo:'Field',
			filtro_0:true
		};
	
	Atributos[13]={//9
			validacion:{
				name:'fecha_hasta',
				fieldLabel:'Fecha Hasta',
				grid_visible:true,
				grid_editable:false,
				width_grid:90
			},
			tipo:'Field',
			filtro_0:true
		};
	
	Atributos[14]={//10
			validacion:{
				name:'descripcion',
				fieldLabel:'Descripci�n',
				grid_visible:true,
				grid_editable:false,
				width_grid:250
			},
			tipo:'Field',
			filtro_0:true
		};
	
	Atributos[15]={//11
			validacion:{
				name:'observaciones',
				fieldLabel:'Observaciones',
				grid_visible:true,
				grid_editable:false,
				width_grid:250
			},
			tipo:'Field',
			filtro_0:true
		};
	
	Atributos[16]={//12
			validacion:{
				name:'tipo_especifico',
				fieldLabel:'Tipo',
				grid_visible:true,
				grid_editable:false,
				width_grid:150,
				renderer:render_tipo_especifico
			},
			tipo:'Field',
			filtro_0:true
		};

	Atributos[17]={
			validacion:{
				name:'estado',
				fieldLabel:'Estado Cta.Doc.',
				grid_visible:false,
				grid_editable:false,
				width_grid:80
			},
			tipo:'Field',
			filtro_0:true
		};
	
	Atributos[18]={//12
			validacion:{
				name:'id_depto',
				fieldLabel:'Departamento',
				grid_visible:true,
				grid_editable:false,
				width_grid:250,
				renderer:render_id_depto
			},
			tipo:'Field',
			filtro_0:true,
			filterColValue:'nombre_depto',
		};
	
	// ----------     FUNCIONES RENDER    ---------------//
	function formatDate(value){return value?value.dateFormat('d/m/Y'):''};

	//---------- INICIAMOS LAYOUT DETALLE
	var config={titulo_maestro:'Administraci�n de Cheques',grid_maestro:'grid-'+idContenedor};
	var layout_caja=new DocsLayoutMaestro(idContenedor);
	layout_caja.init(config);

	// INICIAMOS HERENCIA //
		
	this.pagina=Pagina;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,Atributos,ds,layout_caja,idContenedor);
	var getComponente=this.getComponente;
	var getSelectionModel=this.getSelectionModel;
	var CM_ocultarComponente=this.ocultarComponente;
	var CM_mostrarComponente=this.mostrarComponente;
	var btnNew=this.btnNew;
	var btnEdit=this.btnEdit;
	var btnEliminar=this.btnEliminar;
	var ClaseMadre_getGrid=this.getGrid;
	var ClaseMadre_getDialog=this.getDialog;
	var ClaseMadre_getFormulario=this.getFormulario;
	var ClaseMadre_getComponente=this.getComponente;
	var ClaseMadre_btnNew=this.btnNew;
	var ClaseMadre_btnEdit=this.btnEdit;
	var ClaseMadre_btnEliminar=this.btnEliminar;
	var ClaseMadre_save=this.Save;
	var CM_ocultarGrupo=this.ocultarGrupo;
	var CM_mostrarGrupo=this.mostrarGrupo;
	var CM_ocultarFormulario=this.ocultarFormulario;
	var CM_btnActualizar = this.btnActualizar;
	var CM_conexionFailure = this.conexionFailure;

	// DEFINICI�N DE LA BARRA DE MEN�//
	
	var paramMenu={
		actualizar:{crear:true,separador:false}
	};


	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
		
	//datos necesarios para el filtro
	var paramFunciones={
		btnEliminar:{url:direccion+'../../../control/caja/ActionEliminarCaja.php'},
		Save:{url:direccion+'../../../control/caja/ActionGuardarCaja.php'},
		ConfirmSave:{url:direccion+'../../../control/caja/ActionGuardarCaja.php'},
		Formulario:{
		html_apply:'dlgInfo-'+idContenedor,
		height:400,width:480,
		minWidth:150,minHeight:200,
		closable:true,titulo:'caja',
		grupos:[{tituloGrupo:'Cheque',columna:0,id_grupo:0}]
		}
	};
	
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	function btn_imp_cheque(){
		var sm=getSelectionModel();
		var NumSelect=sm.getCount();
		var SelectionsRecord=sm.getSelected();	
		if(NumSelect!=0){
			if(confirm('�Est� seguro de imprimir el cheque?')){
				var data='&m_id_cheque='+SelectionsRecord.data.id_cheque;
				data=data+'&m_id_moneda='+SelectionsRecord.data.id_moneda;
				
				//Despliegue de gif de procesamiento
				Ext.MessageBox.show({
					title: 'Procesando',
					msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Imprimiendo cheque...</div>",
					width:350,
					height:200,
					closable:false
				});
				
				//Llamada as�ncrona para ejecutar la acci�n posterior a la impresi�n del cheque
				Ext.Ajax.request({
					url:direccion+'../../../../sis_tesoreria/control/adm_cheque/ActionFinImpresionCheque.php',
					params:{tipo:SelectionsRecord.data.tipo,
							tipo_especifico:SelectionsRecord.data.tipo_especifico,
							id:SelectionsRecord.data.id
							},
					method:'POST',
					success: function(result, request){
								window.open(direccion+'../../../../sis_tesoreria/control/avance/reporte/ActionPDFCheque.php?'+data);
								Ext.MessageBox.hide();
								CM_btnActualizar();
					},
					failure:CM_conexionFailure,
					timeout:100000
				})
			}
		}
	}
	//Para manejo de eventos
	function iniciarEventosFormularios(){//para iniciar eventos en el formulario
		
	}
	
	var ges_cta = new Ext.form.ComboBox({
		store: ds_ges_cta,
		limit: paramConfig.TamanoPagina+100,
		displayField:'nro_cuenta_banco',
		typeAhead: true,
		mode: 'remote',
		triggerAction: 'all',
		emptyText:'Cuenta Bancaria ...',
		queryParam: 'filterValue_0',
		filterCol:'CUENTA.nro_cuenta#CUENTA.descripcion#CUEBAN.nro_cuenta_banco#INSTIT.nombre',
		selectOnFocus:true,
		width:230,
		valueField: 'id_cuenta_bancaria',
		tpl:tpl_ges_cta
	});
	
	ges_cta.on('select',function (combo, record, index)
	{
		g_id_cuenta_bancaria=ges_cta.getValue();
		
		ds.load({
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_cuenta_bancaria:g_id_cuenta_bancaria
			}
		});
	});
	
	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_caja.getLayout()};
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	this.InitFunciones(paramFunciones);
	
	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros,
			m_id_cuenta_bancaria:-2
		}
	});
	
	//para agregar botones
	this.AdicionarBotonCombo(ges_cta,'cuenta');
	this.AdicionarBoton('../../../lib/imagenes/print.gif','Impresi�n Cheque',btn_imp_cheque,true,'cheque','');

	this.iniciaFormulario();
	iniciarEventosFormularios();
	layout_caja.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}