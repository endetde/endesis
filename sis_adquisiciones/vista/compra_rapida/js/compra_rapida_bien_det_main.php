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
var elemento={idContenedor:idContenedor,pagina:new pag_cpm_rap_bi_dt(idContenedor,direccion,paramConfig,idContenedorPadre)};
_CP.setPagina(elemento);
}
Ext.onReady(main,main);

/**
* Nombre:		  	    pagina_detalle_seguimiento_solicitud_det.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
* Fecha creaci�n:		2008-05-16 11:58:28
*/
function pag_cpm_rap_bi_dt(idContenedor,direccion,paramConfig,idContenedorPadre){
	
	var Atributos=new Array,maestro,sw=0;
	/////////////////
	//  DATA STORE //
	/////////////////
	var ds = new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/solicitud_compra_det/ActionListarSolicitudCompraDet_det.php?simplificado=1'}),
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
		'id3',
		'abreviatura',
		'desc_cuenta',
		'precio_referencial_moneda_seleccionada',
		'precio_total_moneda_seleccionada',
		'especificaciones_tecnicas'

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
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false
		};
		
		Atributos[1]={
			validacion:{
				name:'desc_item',
				fieldLabel:'C�digo',
				grid_visible:true,
				grid_editable:false,
				width_grid:85,
				grid_indice:1
			},
			tipo: 'Field',
			form: false,
			filtro_0:true,
			filterColValue:'ITEM.codigo'
		};
		
		Atributos[2]={
			validacion:{
				name:'descripcion_item',
				fieldLabel:'Descripci�n',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				grid_indice:2
			},
			tipo: 'Field',
			form: false,
			filtro_0:true,
			filterColValue:'ITEM.descripcion_item'
		};
		
		Atributos[3]={
				validacion:{
					name:'tipo_servicio',
					fieldLabel:'Tipo de Servicio',
					
					grid_visible:true,
					grid_editable:false,
					width_grid:120,
					grid_indice:3
				},
				tipo: 'Field',
				form: false,
				filterColValue:'TIPSER.nombre',
				filtro_0:true
			};

		Atributos[4]={
			validacion:{
				name:'desc_servicio',
				fieldLabel:'Servicio',
				grid_visible:true,
				grid_editable:false,
				width_grid:130,
				grid_indice:4
			},
			tipo:'Field',
			filtro_0:true,
			filterColValue:'SERVIC.codigo#SERVIC.nombre'
		};
		
		
		// txt cantidad
		Atributos[5]={
			validacion:{
				name:'cantidad',
				fieldLabel:'Cantidad',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				disable:false,
				grid_indice:6
			},
			tipo: 'Field',
			form: false,
			filtro_0:true,
			filterColValue:'SOLDET.cantidad'
		};
		
		// txt precio_referencial_estimado
		Atributos[6]={
			validacion:{
			name:'precio_referencial_moneda_seleccionada',
			fieldLabel:'Precio Unitario',
			grid_visible:true,
			width_grid:115,
			align:'right',
			grid_indice:7	
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
				grid_indice:6
				
			},
			tipo: 'Field',
			form: false,
			filtro_0:false
		};
	

		// txt partida_presupuestaria
		Atributos[8]={
			validacion:{
				name:'partida_presupuestaria',
				fieldLabel:'Partida Presupuestaria',
				grid_visible:true,
				grid_editable:false,
				width_grid:130,
				grid_indice:10
			},
			tipo: 'Field',
			form: false,
			filtro_0:true,
			filterColValue:'SOLDET.partida_presupuestaria'
		};
		
		// txt pac_verificado
		Atributos[9]={
			validacion:{
				name:'desc_cuenta',
				fieldLabel:'Cuenta',
				grid_visible:true,
				width_grid:130,
				grid_indice:11
			},
			tipo: 'Field',
			form: false,
			filtro_0:true,
			filterColValue:'CUENTA.desc_cuenta'
		};
		// txt id_solicitud_compra
		Atributos[10]={
			validacion:{
				name:'id_solicitud_compra',
				labelSeparator:'',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false,
				disabled:true
			},
			tipo:'Field',
			form: false,
			filtro_0:false
		};



		Atributos[11]={
			validacion:{
				name:'supergrupo',
				fieldLabel:'Supergrupo',
				width_grid:100,
				grid_indice:12
			},
			tipo: 'Field',
			form: false
		};




		Atributos[12]={
			validacion:{
				name:'grupo',
				fieldLabel:'Grupo',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				grid_indice:13
			},
			tipo: 'TextField',
			form: false
		};



		Atributos[13]={
			validacion:{
				name:'subgrupo',
				fieldLabel:'Subgrupo',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				grid_indice:14
			},
			tipo: 'Field',
			form: false
		};


		Atributos[14]={
			validacion:{
				name:'id1',
				fieldLabel:'ID1',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				grid_indice:15
			},
			tipo: 'Field',
			form: false
		};


		Atributos[15]={
			validacion:{
				name:'id2',
				fieldLabel:'ID2',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				grid_indice:16
			},
			tipo: 'Field',
			form: false
		};


		Atributos[16]={
			validacion:{
				name:'id3',
				fieldLabel:'ID3',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				grid_indice:17
			},
			tipo: 'Field',
			form: false
		};
		
		
		Atributos[17]={
			validacion:{
				name:'item',
				fieldLabel:'item',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				grid_indice:18
			},
			tipo: 'Field',
			form: false
		};
		// txt estado_reg
		Atributos[18]={
			validacion:{
				name:'estado_reg',
				fieldLabel:'Estado',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				grid_indice:19
			},
			tipo: 'Field',
			form: false,
			filtro_0:true,
			filterColValue:'SOLDET.estado_reg'
		};
		// txt fecha_reg
		Atributos[19]= {
			validacion:{
				name:'abreviatura',
				fieldLabel:'Unid. Med.',
				grid_visible:true,
				width_grid:80,
				grid_indice:9
			},
			form:false,
			tipo:'Field',
			filtro_0:false
		};
		
		
		Atributos[20]= {
			validacion:{
				name:'especificaciones_tecnicas',
				fieldLabel:'Especificaciones T�cnicas',
				grid_visible:true,
				width_grid:115,
				grid_indice:5
			},
			form:false,
			tipo:'Field',
			filtro_0:true,
			filterColValue:'SOLDET.especificaciones_tecnicas'
		};
		



		//----------- FUNCIONES RENDER

		function formatDate(value){return value?value.dateFormat('d/m/Y'):''};

		//---------- INICIAMOS LAYOUT DETALLE
		var config={titulo_maestro:'Seguimiento de Solicitudes (Maestro)',titulo_detalle:'Detalle Solicitud (Detalle)',grid_maestro:'grid-'+idContenedor};
		var lay_cpm_rap_bi_dt = new DocsLayoutMaestro(idContenedor);
		lay_cpm_rap_bi_dt.init(config);



		//---------- INICIAMOS HERENCIA
		this.pagina = Pagina;
		this.pagina(paramConfig,Atributos,ds,lay_cpm_rap_bi_dt,idContenedor);
		var getSelectionModel=this.getSelectionModel;
		var CM_getCM=this.getColumnModel;
		
		//DEFINICI�N DE LA BARRA DE MEN�
		var paramMenu={actualizar:{crear:true,separador:false}};





		var paramFunciones={btnEliminar:{url:direccion+'../../../control/solicitud_compra_det/ActionAnularSolicitudCompraDet.php'}};

		//-------------- Sobrecarga de funciones --------------------//
		this.reload=function(m){
			maestro=m;

			ds.lastOptions={
				params:{
					start:0,
					limit: paramConfig.TamanoPagina,
					CantFiltros:paramConfig.CantFiltros,
					m_id_solicitud_compra:maestro.id_solicitud_compra
				}
			};
			this.btnActualizar();

			Atributos[10].defecto=maestro.id_solicitud_compra;
			paramFunciones.btnEliminar.parametros='&m_id_solicitud_compra='+maestro.id_solicitud_compra;
			this.InitFunciones(paramFunciones);
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
			
		};
		function btn_caracteristica(){
			var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
			if(NumSelect!=0){
				var SelectionsRecord=sm.getSelected();
				var data='m_id_solicitud_compra_det='+SelectionsRecord.data.id_solicitud_compra_det;

				var ParamVentana={ventana:{width:'90%',height:'70%'}};
				lay_cpm_rap_bi_dt.loadWindows(direccion+'../../../vista/caracteristica/caracteristica_min.php?'+data,'Caracter�sticas Adicionales',ParamVentana);
				lay_cpm_rap_bi_dt.getVentana().on('resize',function(){
					lay_cpm_rap_bi_dt.getLayout().layout();
				})
			}
			else{
				Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
			}
		}



		//para que los hijos puedan ajustarse al tama�o
		this.getLayout=function(){return lay_cpm_rap_bi_dt.getLayout()};
		//para el manejo de hijos

		this.Init(); //iniciamos la clase madre
		this.InitBarraMenu(paramMenu);
		this.InitFunciones(paramFunciones);
		//para agregar botones

		this.AdicionarBoton('../../../lib/imagenes/list-items.gif','Caracter�sticas Adicionales',btn_caracteristica,true,'caracteristica','');
		this.AdicionarBoton('../../../lib/imagenes/cancel.png','Anular Detalle',this.btnEliminar,true,'anular_detalle','');

		this.iniciaFormulario();
		this.bloquearMenu();
		lay_cpm_rap_bi_dt.getLayout().addListener('layout',this.onResize);
		ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario);

}
