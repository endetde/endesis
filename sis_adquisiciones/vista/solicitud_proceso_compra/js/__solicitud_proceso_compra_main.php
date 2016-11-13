<?php
/**
 * Nombre:		  	    solicitud_proceso_compra_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista del Hijo
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-05-19 15:28:40
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
var paramConfig={TamanoPagina:_CP.getConfig().ss_tam_pag,TiempoEspera:_CP.getConfig().ss_tiempo_espera,CantFiltros:1,FiltroEstructura:true,FiltroAvanzado:fa};
var maestro={id_proceso_compra:<?php echo $m_id_proceso_compra;?>,id_tipo_categoria_adq:'<?php echo $m_id_tipo_categoria_adq;?>',codigo_proceso:'<?php echo $m_codigo_proceso;?>',id_moneda:decodeURIComponent('<?php echo $m_id_moneda;?>'),id_tipo_adq:'<?php echo $m_id_tipo_adq;?>',desc_moneda:decodeURIComponent('<?php echo $m_desc_moneda;?>'),desc_tipo_adq:decodeURIComponent('<?php echo $m_desc_tipo_adq;?>'),gestion:'<?php echo $m_gestion;?>',id_gestion:<?php echo $m_id_gestion;?>,id_parametro_adquisicion:<?php echo $m_id_parametro_adquisicion;?>};
idContenedorPadre='<?php echo $idContenedorPadre;?>';
var elemento={idContenedor:idContenedor,pagina:new pagina_solicitud_proceso_compra(idContenedor,direccion,paramConfig,maestro,idContenedorPadre)};
_CP.setPagina(elemento);
}
Ext.onReady(main,main);



/**
* Nombre:		  	    pagina_solicitud_proceso_compra.js
* Prop�sito: 			pagina objeto principal
* Autor:				Rensi Arteaga Copari
* Fecha creaci�n:		2008-05-19 15:28:41
*/
function pagina_solicitud_proceso_compra(idContenedor,direccion,paramConfig,maestro,idContenedorPadre)
{
	var Atributos=new Array,sw=0,cpm_solicitud;
	/////////////////
	//  DATA STORE //
	/////////////////
	var ds = new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/solicitud_proceso_compra/ActionListarSolicitudProcesoCompra.php'}),
		// aqui se define la estructura del XML
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_solicitud_proceso_compra',
			totalRecords: 'TotalCount'
		}, [
		// define el mapeo de XML a las etiquetas (campos)
		'id_solicitud_proceso_compra',
		{name: 'fecha_reg',type:'date',dateFormat:'Y-m-d'},
		'id_solicitud_compra',
		'id_proceso_compra',
		'num_solicitud_sis',
		'num_solicitud',
		'id_fina_regi_prog_proy_acti',
		'solicitante',
		'id_prog_proy_acti',
		'id_financiador',
		'id_regional',
		'id_programa',
		'id_proyecto',
		'id_actividad',
		'nombre_financiador',
		'nombre_regional',
		'nombre_programa',
		'nombre_proyecto',
		'nombre_actividad',
		'codigo_financiador',
		'codigo_regional',
		'codigo_programa',
		'codigo_proyecto',
		'codigo_actividad',
		'id_empleado_frppa_solicitante',
		'id_tipo_adq',
		'desc_tipo_adq',
		'tipo_adq',
		'id_moneda',
		'simbolo_moneda',
		{name: 'fecha_sol',type:'date',dateFormat:'Y-m-d'},
		//{name: 'hora_sol',type:'time',dateFormat:'h:m:s'}
		'hora_sol'
		]),remoteSort:true});

		//carga datos XML
		ds.load({
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_proceso_compra:maestro.id_proceso_compra
			}
		});


		var ds_solicitud_compra = new Ext.data.Store(
		{proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/solicitud_compra/ActionListarSolicitudCompraTer.php'}),
		reader: new Ext.data.XmlReader({record:'ROWS',id:'id_solicitud_compra',totalRecords:'TotalCount'},['id_solicitud_compra','solicitante','desc_moneda','simbolo','id_tipo_adq','num_solicitud','num_solicitud_sis','id_moneda','fecha_reg']),
		baseParams:{id_proceso_compra:maestro.id_proceso_compra}});



		//crea el tag del maestro
		var div_grid_detalle=Ext.DomHelper.append(idContenedor,{tag:'div',id:'grid_detalle-'+idContenedor},true);
		Ext.DomHelper.applyStyles(div_grid_detalle,"background-color:#FFFFFF");

		//FUNCIONES RENDER

		function render_solicitud_compra(value, p, record){return String.format('{0}', record.data['solicitante']);}
		var tpl_solicitud_compra=new Ext.Template('<div class="search-item">','<b>{solicitante}</b>',
		'<br><b><FONT COLOR="#B5A642">N� Solicitud Sis: </b> <i>{num_solicitud_sis}</i></FONT>',
		'<br><b><FONT COLOR="#B5A642">N� Solicitud: </b> <i>{num_solicitud}</i></FONT>',
		'<br><b><FONT COLOR="#B5A642">Pedido en: </b><i>{desc_moneda}</i></FONT>',
		'<br><b><FONT COLOR="#B5A642">Fecha Solicitud: </b> <i>{fecha_reg}<i></FONT>','</div>');
		;

		/////////////////////////
		// Definici�n de datos //
		/////////////////////////

		// hidden id_solicitud_proceso_compra
		//en la posici�n 0 siempre esta la llave primaria

		Atributos[0]={
			validacion:{
				//fieldLabel: 'Id',
				labelSeparator:'',
				name: 'id_solicitud_proceso_compra',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'id_solicitud_proceso_compra'
		};

		// txt id_solicitud_compra
		var fCols=new Array();
		var fVal=new Array();
		fCols[0]='SOLADQ.id_tipo_adq';
		fVal[0]=maestro.id_tipo_adq;
		fCols[1]='SOLADQ.id_parametro_adquisicion';
		fVal[1]=maestro.id_parametro_adquisicion;
		Atributos[1]={
			validacion:{
				name:'id_solicitud_compra',
				fieldLabel:'Solicitud de Compra',
				allowBlank:false,
				emptyText:'Solicitud de Compra...',
				desc: 'solicitante', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_solicitud_compra,
				valueField: 'id_solicitud_compra',
				displayField: 'solicitante',
				queryParam: 'filterValue_0',
				filterCol:'PERSON.nombre#PERSON.apellido_paterno#PERSON.apellido_materno#SOLADQ.num_solicitud#SOLADQ.num_solicitud_sis',
				filterCols:fCols,
				filterValues:fVal,
				typeAhead:true,
				tpl:tpl_solicitud_compra,
				forceSelection:true,
				mode:'remote',
				queryDelay:250,
				pageSize:20,
				minListWidth:'100%',
				grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_solicitud_compra,
				grid_visible:true,
				grid_editable:false,
				width_grid:300,
				width:'100%',
				disable:true,
				grid_indice:2
			},
			tipo:'ComboBox',
			form: true,
			filtro_0:true,
			filterColValue:'PERSON.nombre#PERSON.apellido_paterno#PERSON.apellido_materno',
			save_as:'id_solicitud_compra'
		};
		// txt id_proceso_compra
		Atributos[2]={
			validacion:{
				name:'id_proceso_compra',
				labelSeparator:'',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false,
				disabled:true
			},
			tipo:'Field',
			filtro_0:false,
			defecto:maestro.id_proceso_compra,
			save_as:'id_proceso_compra'
		};


		Atributos[3]={
			validacion:{
				name:'num_solicitud',
				fieldLabel:'N� Solicitud',
				grid_visible:true,
				grid_editable:false,
				disabled:true
			},
			form:false,
			tipo:'Field',
			filtro_0:true,
			filterColValue:'SOLCOM.num_solicitud'

		};

		Atributos[4]={
			validacion:{
				name:'num_solicitud_sis',
				fieldLabel:'N� Solicitud Sis',
				grid_visible:true,
				grid_editable:false,
				disabled:true
			},
			form:false,
			tipo:'Field',
			filtro_0:true,
			filterColValue:'SOLCOM.num_solicitud_sis',
		};

		// txt fecha_reg
		Atributos[5]= {
			validacion:{
				name:'fecha_sol',
				fieldLabel:'Fecha Solicitud',
				format: 'd/m/Y',
				grid_visible:true,
				grid_editable:false,
				renderer: formatDate,
				width_grid:85

			},
			form:false,
			tipo:'DateField',
			filtro_0:true,
			filterColValue:'SOLCOM.fecha_reg',
			dateFormat:'m-d-Y'
		};

		Atributos[6]={
			validacion:{
				name:'hora_sol',
				fieldLabel:'Hora Solicitud',
				grid_visible:true,
				grid_editable:false
			},
			form:false,
			tipo:'Field',
			filtro_0:true,
			filterColValue:'SOLCOM.hora_reg',
		};

		Atributos[7]={
			validacion:{
				name:'simbolo_moneda',
				fieldLabel:'Moneda',
				grid_visible:true,
				grid_editable:false
			},
			form:false,
			tipo:'Field',
			filtro_0:true,
			filterColValue:'MONEDA.simbolo',
		};



		Atributos[8]={
			validacion:{
				name:'nombre_financiador',
				fieldLabel:'Financiador',
				grid_visible:true,
				grid_editable:false
			},
			form:false,
			tipo:'Field',
			filtro_0:false
		};

		Atributos[9]={
			validacion:{
				name:'nombre_regional',
				fieldLabel:'Regional',
				grid_visible:true,
				grid_editable:false
			},
			form:false,
			tipo:'Field',
			filtro_0:false
		};


		Atributos[10]={
			validacion:{
				name:'nombre_programa',
				fieldLabel:'Programa',
				grid_visible:true,
				grid_editable:false
			},
			form:false,
			tipo:'Field',
			filtro_0:false
		};

		Atributos[11]={
			validacion:{
				name:'nombre_proyecto',
				fieldLabel:'Sub Programa',
				grid_visible:true,
				grid_editable:false
			},
			form:false,
			tipo:'Field',
			filtro_0:false
		};

		Atributos[12]={
			validacion:{
				name:'nombre_actividad',
				fieldLabel:'Actividad',
				grid_visible:true,
				grid_editable:false
			},
			form:false,
			tipo:'Field',
			filtro_0:false
		};
		// txt fecha_reg
		Atributos[13]={
			validacion:{
				name:'fecha_reg',
				fieldLabel:'Fecha registro',
				format: 'd/m/Y', //formato para validacion
				grid_visible:true,
				grid_editable:false,
				renderer: formatDate,
				width_grid:85
			},
			form:false,
			tipo:'DateField',
			filtro_0:true,
			filterColValue:'SOPRCOM.fecha_reg',
			dateFormat:'m-d-Y',
			save_as:'fecha_reg'
		};








		//----------- FUNCIONES RENDER

		function formatDate(value){return value?value.dateFormat('d/m/Y'):''};

		//---------- INICIAMOS LAYOUT DETALLE
		var config={titulo_maestro:'Procedimiento de Compra',titulo_detalle:'Solicitudes de Compra',grid_maestro:'grid-'+idContenedor};
		var layout_solicitud_proceso_compra = new DocsLayoutDetalleEP(idContenedor,idContenedorPadre);
		layout_solicitud_proceso_compra.init(config);



		//---------- INICIAMOS HERENCIA
		this.pagina = Pagina;
		this.pagina(paramConfig,Atributos,ds,layout_solicitud_proceso_compra,idContenedor);
		var getComponente=this.getComponente;
		var getSelectionModel=this.getSelectionModel;
		var EstehtmlMaestro=this.htmlMaestro;
		var CM_btnNew=this.btnNew;
		//DEFINICI�N DE LA BARRA DE MEN�
		var paramMenu={guardar:{crear:true,separador:false},nuevo:{crear:true,separador:true},eliminar:{crear:true,separador:false},actualizar:{crear:true,separador:false}};

		function cargar_maestro(){
			Ext.DomHelper.overwrite('grid_detalle-'+idContenedor,EstehtmlMaestro([['id_proceso_compra',maestro.id_proceso_compra],['C�digo de Proceso',maestro.codigo_proceso],['Moneda Proceso',maestro.desc_moneda],['Tipo Adquisici�n',maestro.desc_tipo_adq]]));
		}
		cargar_maestro();



		//DEFINICI�N DE FUNCIONES

		var paramFunciones={
			btnEliminar:{url:direccion+'../../../control/solicitud_proceso_compra/ActionEliminarSolicitudProcesoCompra.php',parametros:'&m_id_proceso_compra='+maestro.id_proceso_compra},
			Save:{url:direccion+'../../../control/solicitud_proceso_compra/ActionGuardarSolicitudProcesoCompra.php',parametros:'&m_id_proceso_compra='+maestro.id_proceso_compra},
			ConfirmSave:{url:direccion+'../../../control/solicitud_proceso_compra/ActionGuardarSolicitudProcesoCompra.php',parametros:'&m_id_proceso_compra='+maestro.id_proceso_compra},
			Formulario:{html_apply:'dlgInfo-'+idContenedor,height:340,width:480,minWidth:150,minHeight:200,	closable:true,titulo:'solicitud_proceso_compra'}};

			//-------------- Sobrecarga de funciones --------------------//
			this.reload=function(params){
				var datos=Ext.urlDecode(decodeURIComponent(params));
				maestro.id_proceso_compra=datos.m_id_proceso_compra;
				maestro.id_tipo_categoria_adq=datos.m_id_tipo_categoria_adq;
				maestro.codigo_proceso=datos.m_codigo_proceso;
				maestro.id_moneda=datos.m_id_moneda;
				maestro.desc_moneda=datos.m_desc_moneda;
				maestro.id_tipo_adq=datos.m_id_tipo_adq;
				maestro.desc_tipo_adq=datos.m_desc_tipo_adq;
				maestro.gestion=datos.gestion;
				maestro.id_parametro_adquisicion=datos.m_id_parametro_adquisicion;
				maestro.id_gestion=datos.m_id_gestion;
				cargar_maestro();

				Atributos[2].defecto=datos.m_id_proceso_compra;

				Atributos[1].validacion.filterValues[0]=maestro.id_tipo_adq;
				Atributos[1].validacion.filterValues[1]=maestro.id_parametro_adquisicion;				
				cpm_solicitud.store.baseParams.id_proceso_compra=maestro.id_proceso_compra;

				ds.lastOptions={
					params:{
						start:0,
						limit: paramConfig.TamanoPagina,
						CantFiltros:paramConfig.CantFiltros,
						m_id_proceso_compra:maestro.id_proceso_compra
					}
				};
				this.btnActualizar();
				paramFunciones.btnEliminar.parametros='&m_id_proceso_compra='+maestro.id_proceso_compra;
				paramFunciones.Save.parametros='&m_id_proceso_compra='+maestro.id_proceso_compra;
				paramFunciones.ConfirmSave.parametros='&m_id_proceso_compra='+maestro.id_proceso_compra;
				this.InitFunciones(paramFunciones)
			};
			
			this.btnNew=function(){
				getComponente('id_solicitud_compra').modificado=true;
				CM_btnNew()
		
			};
			
			function btn_solicitud_compra_det(){
				var sm=getSelectionModel(),filas=ds.getModifiedRecords(),cont=filas.length,NumSelect=sm.getCount();
				if(NumSelect!=0){
					var SelectionsRecord=sm.getSelected();
					var data='m_id_solicitud_proceso_compra='+SelectionsRecord.data.id_solicitud_proceso_compra;
					data=data+'&m_id_solicitud_compra='+SelectionsRecord.data.id_solicitud_compra;
					data=data+'&m_id_proceso_compra='+SelectionsRecord.data.id_proceso_compra;
					data=data+'&m_id_tipo_adq='+SelectionsRecord.data.id_tipo_adq;
					data=data+'&m_id_moneda='+SelectionsRecord.data.id_moneda;
					data=data+'&m_tipo_adq='+SelectionsRecord.data.tipo_adq;
					data=data+'&m_simbolo='+SelectionsRecord.data.simbolo_moneda;

					data=data+'&m_solicitante='+SelectionsRecord.data.solicitante;
					data=data+'&m_num_solicitud='+SelectionsRecord.data.num_solicitud;
					data=data+'&m_num_solicitud_sis='+SelectionsRecord.data.num_solicitud_sis;
					data=data+'&m_fecha_sol='+SelectionsRecord.data.fecha_sol;
					var url='';
					if(SelectionsRecord.data.tipo_adq=='Bien'){
						url='../../../../sis_adquisiciones/vista/solicitud_compra_det/solicitud_compra_mul_item_det.php?'+data
					}else{
						url='../../../../sis_adquisiciones/vista/solicitud_compra_det/solicitud_compra_mul_serv_det.php?'+data
					}
					var ParamVentana={ventana:{width:'90%',height:'90%'}};
					layout_solicitud_proceso_compra.loadWindows(direccion+url,'Detalle de Solicitud de Compra',ParamVentana);
					layout_solicitud_proceso_compra.getVentana().on('resize',function(){
						layout_solicitud_proceso_compra.getLayout().layout()
					})
				}
				else{
					Ext.MessageBox.alert('Estado','Antes debes seleccionar un item.')
				}
			}

			//Para manejo de eventos
			function iniciarEventosFormularios(){
				//para iniciar eventos en el formulario
				cpm_solicitud=getComponente('id_solicitud_compra')
			}

			//para que los hijos puedan ajustarse al tama�o
			this.getLayout=function(){return layout_solicitud_proceso_compra.getLayout()};
			//para el manejo de hijos

			this.Init(); //iniciamos la clase madre
			this.InitBarraMenu(paramMenu);
			this.InitFunciones(paramFunciones);
			//para agregar botones

			this.AdicionarBoton('../../../lib/imagenes/menu-show.gif','Detalle de Solicitud de Compra',btn_solicitud_compra_det,true,'solicitud_compra_det','');

			this.iniciaFormulario();
			iniciarEventosFormularios();
			layout_solicitud_proceso_compra.getLayout().addListener('layout',this.onResize);
			ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario);

}