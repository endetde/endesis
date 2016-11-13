<?php
/**
 * Nombre:		  	    detalle_seguimiento_solicitud_det_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista del Hijo
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-05-16 11:58:27
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
<?php if($_SESSION["ss_filtro_avanzado"]!=''){echo 'fa='.$_SESSION["ss_filtro_avanzado"].';';}?>	
var paramConfig={TamanoPagina:_CP.getConfig().ss_tam_pag,TiempoEspera:_CP.getConfig().ss_tiempo_espera,CantFiltros:1,FiltroEstructura:false,FiltroAvanzado:fa};

idContenedorPadre='<?php echo $idContenedorPadre;?>';
refo='<?php echo $refo;?>';
var elemento={idContenedor:idContenedor,pagina:new pagina_detalle_seguimiento_solicitud_det(idContenedor,direccion,paramConfig,idContenedorPadre,refo)};
_CP.setPagina(elemento);
}
Ext.onReady(main,main);



/**
 * Nombre:		  	    pagina_detalle_seguimiento_solicitud_det.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-05-16 11:58:28
 */
function pagina_detalle_seguimiento_solicitud_det(idContenedor,direccion,paramConfig,idContenedorPadre,refo)
{
	var Atributos=new Array,sw=0;
	var maestro;
	/////////////////
	//  DATA STORE //
	/////////////////
	var ds = new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/solicitud_compra_det/ActionListarSolicitudCompraDet_det.php'}),
		// aqui se define la estructura del XML
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_solicitud_compra_det',
			totalRecords: 'TotalCount'

		}, [
		// define el mapeo de XML a las etiquetas (campos)
		'id_solicitud_compra_det',
		'desc_solicitud_compra_det',
		'cantidad',
		'precio_referencial_estimado',
		{name: 'fecha_reg',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_inicio_serv',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_fin_serv',type:'date',dateFormat:'Y-m-d'},
		'descripcion_item',
		'partida_presupuestaria',
		'estado_reg',
		'pac_verificado',
		'id_solicitud_compra',
		'desc_solicitud_compra',
		'id_servicio',
		'desc_servicio',
		'id_item',
		'item',
		'desc_item',
		'monto_aprobado',
		'supergrupo',
		'grupo',
		'subgrupo',
		'id1',
		'id2',
		'id3', 'precio_referencial_moneda_seleccionada',
		'precio_total_moneda_seleccionada',
		'precio_total_referencial',
		'especificaciones_tecnicas',
		'abreviatura',
		'codigo_partida',
		'desc_cuenta',
		'reformular',
		'desc_item_reformulado',
		'monto_ref_reformulado',
		'motivo_ref',
		'tipo_servicio',
		'desc_servicio_reformulado','precio_referencial_total_as','total_gestion'
		

		]),remoteSort:true});


	
		/////////////////////////
		// Definici�n de datos //
		/////////////////////////

		// hidden id_solicitud_compra_det
		//en la posici�n 0 siempre esta la llave primaria

		Atributos[0]={
			validacion:{
				//fieldLabel: 'Id',
				labelSeparator:'',
				name: 'id_solicitud_compra_det',
				inputType:'hidden'
				
			},
			tipo: 'Field',
			filtro_0:false
		};

		Atributos[1]={
			validacion:{
				name:'tipo_servicio',
				fieldLabel:'Tipo Item/Servicio',
				grid_visible:true,
				width_grid:150,
				grid_indice:1
			},
			tipo: 'Field',
			form: false,
			filtro_0:true,
			filterColValue:'TIPSER.nombre'
		};

		Atributos[2]={
			validacion:{
				name:'desc_servicio',
				fieldLabel:'Item/Servicio',
				grid_visible:true,
				width_grid:250,
			    grid_indice:2
			},
			tipo: 'Field',
			form: false,
			filtro_0:true,
			filterColValue:'SERVIC.codigo#SERVIC.nombre'
		};



		Atributos[3]={
				validacion:{
					name:'desc_item',
					
					fieldLabel:'C�digo Item',
					
					grid_visible:true,
					
					width_grid:90,
					width:200,
					
					grid_indice:3
				},
				tipo:'Field',
				
				filtro_0:true,
				form: false,
				filterColValue:'ITTEM.codigo#ITTEM.nombre'
				
			};
			Atributos[4]={
					validacion:{
						name:'item',
						fieldLabel:'Item',
						
						grid_visible:true,
						
						width_grid:100,
						
						grid_indice:4
					},
					tipo: 'Field',
					form: false,
					filterColValue:'ITTEM.codigo#ITTEM.nombre',
					filtro_0:true
					
				};

		
		// txt cantidad
		Atributos[5]={
			validacion:{
				name:'cantidad',
				fieldLabel:'Cantidad',
				grid_visible:true,
				width_grid:100,
			    grid_indice:6	
			},
			tipo: 'Field',
			form: false,
			filtro_0:true,
			filterColValue:'SOLDET.cantidad'
		};
	
	Atributos[6]={
		validacion:{
			name:'precio_referencial_moneda_seleccionada',
			fieldLabel:'Precio Unitario',
			grid_visible:true,
			width_grid:115,
			align:'right',
			grid_indice:6	
		},
		tipo: 'Field',
		form: false,
		filtro_0:false
		
	};

		// txt monto_aprobado
		Atributos[7]={
			validacion:{
				name:'precio_total_moneda_seleccionada',
				fieldLabel:'Precio Total',
				grid_visible:true,
				width_grid:100,
				align:'right',
				grid_indice:7
				
			},
			tipo: 'Field',
			form: true,
			filtro_0:false
		};


		// txt partida_presupuestaria
		Atributos[8]={
			validacion:{
				name:'codigo_partida',
				fieldLabel:'Partida',
				grid_visible:true,
				width_grid:130,
				grid_indice:8
			},
			tipo: 'Field',
			form: false,
			filtro_0:true,
			filterColValue:'PARTID.codigo_partida#PARTID.nombre_partida'
		};

		
		// txt id_solicitud_compra
		Atributos[9]={
			validacion:{
				name:'id_solicitud_compra',
				labelSeparator:'',
				inputType:'hidden'
			},
			tipo:'Field',
			filtro_0:false
		};



		Atributos[10]={
			validacion:{
				name:'fecha_fin_serv',
				fieldLabel:'Fecha Fin',
				grid_visible:true,
				width_grid:80,
				grid_indice:13,
				renderer:formatDate
			},
			form:false,
			tipo:'Field',
			filtro_0:false
		};

	
	
		// txt estado_reg
		Atributos[11]={
			validacion:{
				name:'estado_reg',
				fieldLabel:'Estado',
				grid_visible:true,
				width_grid:100,
				grid_indice:10
			},
			tipo: 'Field',
			form: false,
			filtro_0:true,
			filterColValue:'SOLDET.estado_reg'
		};
		// txt fecha_reg
		Atributos[12]= {
			validacion:{
				name:'especificaciones_tecnicas',
				fieldLabel:'Especificaciones T�cnicas',
				grid_visible:true,
				width_grid:200,
				grid_indice:5
			},
			form:false,
			tipo:'Field',
			filtro_0:true,
			filterColValue:'SOLDET.especificaciones_tecnicas'
		};
		
		Atributos[13]= {
			validacion:{
				name:'fecha_inicio_serv',
				fieldLabel:'Fecha Inicio',
				grid_visible:true,
				width_grid:80,
				grid_indice:12,
				renderer:formatDate
			},
			form:false,
			tipo:'Field',
			filtro_0:false
		};
		
		// txt partida_presupuestaria
		Atributos[14]={
			validacion:{
				name:'desc_cuenta',
				fieldLabel:'Cuenta',
				grid_visible:true,
				width_grid:130,
				grid_indice:9
			},
			tipo: 'Field',
			form: false,
			filtro_0:true,
			filterColValue:'CUENTA.desc_cuenta'
		};
		
		// txt partida_presupuestaria
		Atributos[15]={
			validacion: {
			name:'reformular',
			fieldLabel:'Reformulaci�n',
			grid_visible:true,
			width_grid:100,
			grid_indice:20	
		},
		tipo:'Field',
		form: false,
		filtro_0:true,
		filterColValue:'SOLDET.reformular'
	};
		
			
			
	Atributos[16]={
		validacion:{
			name:'desc_servicio_reformulado',
			fieldLabel:'Servicio Reformulado',
			grid_visible:true,
			width_grid:100,
			grid_indice:21
		},
		tipo: 'TextArea',
		form: false
	};
		
	Atributos[17]={
		validacion:{
			name:'monto_ref_reformulado',
			fieldLabel:'Precio Total Reformulado',
			grid_visible:true,
			width_grid:110,
			grid_indice:22
		},
		tipo: 'Field',
		form: false,
		filtro_0:true,
		filterColValue:'SOLDET.monto_ref_reformulado'
	};
		
		Atributos[18]={
			validacion:{
				name:'motivo_ref',
				fieldLabel:'Motivo Reformulaci�n',
				grid_visible:true,
				width_grid:100,
				grid_indice:23
			},
			tipo: 'TextArea',
			form: false,
			filtro_0:true,
			filterColValue:'SOLDET.motivo_ref'
		};
		
		Atributos[19]= {
			validacion:{
				name:'abreviatura',
				fieldLabel:'Unid. Med.',
				grid_visible:true,
				width_grid:80,
				grid_indice:7
			},
			form:false,
			tipo:'Field',
			filtro_0:false
		};
		
		
		Atributos[20]={
			validacion:{
				name:'precio_referencial_total_as',
				fieldLabel:'Precio Total Gestion Siguiente',
				grid_visible:true,
				width_grid:100,
				align:'right',
				grid_indice:15
				
			},
			tipo: 'Field',
			form: false,
			filtro_0:false
		};
		
		Atributos[21]={
			validacion:{
				name:'total_gestion',
				fieldLabel:'Precio Total Gestion Actual',
				grid_visible:true,
				width_grid:100,
				align:'right',
				grid_indice:16
				
			},
			tipo: 'Field',
			form:false,
			filtro_0:false
		};
	
	//----------- FUNCIONES RENDER
	
	function formatDate(value){return value?value.dateFormat('d/m/Y'):''};

	//---------- INICIAMOS LAYOUT DETALLE
	var config={titulo_maestro:'Seguimiento de Solicitudes Servicios (Maestro)',titulo_detalle:'Detalle Solicitud Servicios(Detalle)',grid_maestro:'grid-'+idContenedor};
	var layout_detalle_seguimiento_solicitud_serv = new DocsLayoutMaestro(idContenedor);
	layout_detalle_seguimiento_solicitud_serv.init(config);
	
	
	
	//---------- INICIAMOS HERENCIA
	this.pagina = Pagina;
	this.pagina(paramConfig,Atributos,ds,layout_detalle_seguimiento_solicitud_serv,idContenedor);
	var getComponente=this.getComponente;
	var getSelectionModel=this.getSelectionModel;
	var CM_getCM=this.getColumnModel;
	var CM_getColumnNum=this.getColumnNum;
	var CM_getColumnModel=this.getColumnModel;
	var getGrid=this.getGrid;
//DEFINICI�N DE LA BARRA DE MEN�
	var paramMenu={actualizar:{crear:true,separador:false}};
//DEFINICI�N DE FUNCIONES
		
		
	var paramFunciones={
	};
	
	//-------------- Sobrecarga de funciones --------------------//
	this.reload=function(m){
		maestro=m;

		ds.lastOptions={
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_solicitud_compra:maestro.id_solicitud_compra,
				vista:1
			}
		};
		this.btnActualizar();
		
		if(maestro.es_item==0 ){ 
			CM_getCM().setHidden(0,false);
			CM_getCM().setHidden(1,false);
			
			CM_getCM().setHidden(2,true);
			CM_getCM().setHidden(3,true);
		}else{ 
			
				//hideColumns([[CM_getColumnNum('tipo_servicio'),true]]);
			CM_getCM().setHidden(0,true);
			CM_getCM().setHidden(1,true);
			CM_getCM().setHidden(2,false);
			CM_getCM().setHidden(3,false);
		}
		
		//iniciarEventosFormularios();
		this.InitFunciones(paramFunciones)
	};
	function btn_caracteristica(){
		var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
		if(NumSelect!=0){
			var SelectionsRecord=sm.getSelected();
			var data='m_id_solicitud_compra_det='+SelectionsRecord.data.id_solicitud_compra_det;
			
			var ParamVentana={ventana:{width:'90%',height:'70%'}};
			layout_detalle_seguimiento_solicitud_serv.loadWindows(direccion+'../../../vista/caracteristica/caracteristica_min.php?'+data,'Caracter�sticas Adicionales',ParamVentana);
layout_detalle_seguimiento_solicitud_serv.getVentana().on('resize',function(){
			layout_detalle_seguimiento_solicitud_serv.getLayout().layout();
				})
		}
		else{
		Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
	}
		}
	
	//Para manejo de eventos
	function iniciarEventosFormularios(){	
		//alert('entra');
		if(refo=='0'){
			
				CM_getCM().setHidden(11,true);
				CM_getCM().setHidden(12,true);
				CM_getCM().setHidden(13,true);
				CM_getCM().setHidden(14,true);
			}
		
	}


	/*function hideColumns(colIndexes){
		cm.totalWidth = null;
		grid=getGrid();
		vista_grid=grid.getView();
		for(var i=0;i<colIndexes.length;i++){
			cm.config[colIndexes[i][0]].hidden = colIndexes[i][1];
			
	        var cid = vista_grid.getColumnId(colIndexes[i][0]);
	        
	        if(colIndexes[i][1]){
	        	vista_grid.css.updateRule(vista_grid.tdSelector+cid, "display", "none");
	        	vista_grid.css.updateRule(vista_grid.splitSelector+cid, "display", "none");
	        }
	        else{
	        	vista_grid.css.updateRule(vista_grid.tdSelector+cid, "display", "");
	        	vista_grid.css.updateRule(vista_grid.splitSelector+cid, "display", "");
	        }
	        
		}
        if(Ext.isSafari){
            vista_grid.updateHeaders();
        }
        vista_grid.updateSplitters();
        vista_grid.layout();
    }*/

	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_detalle_seguimiento_solicitud_serv.getLayout()};
	//para el manejo de hijos
	
	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	this.InitFunciones(paramFunciones);
	//para agregar botones
	
		this.AdicionarBoton('../../../lib/imagenes/list-items.gif','Caracter�sticas Adicionales',btn_caracteristica,true,'caracteristica','');

	this.iniciaFormulario();
	iniciarEventosFormularios();
	this.bloquearMenu();
	layout_detalle_seguimiento_solicitud_serv.getLayout().addListener('layout',this.onResize);
	ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario);
	
}