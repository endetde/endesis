<?php 
/**
 * Nombre:		  	    plan_pago_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-05-28 17:32:19
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
//var maestro={id_cotizacion:<?php echo $m_id_cotizacion;?>,observaciones:'<?php echo $m_observaciones;?>',num_proceso:'<?php echo $m_num_proceso;?>',desc_proveedor:'<?php echo $m_desc_proveedor;?>',estado_vigente:'<?php echo $m_estado_vigente;?>',moneda:decodeURIComponent('<?php echo $m_desc_moneda;?>'),num_pagos:<?php echo $m_num_pagos;?>,id_empresa:<?php echo $_SESSION['ss_id_empresa'];?>,factura_total:'<?php echo $m_factura_total;?>',desc_moneda:'<?php echo $m_desc_moneda;?>',tipo_plantilla:'<?php echo $m_tipo_plantilla;?>'};
var idContenedorPadre='<?php echo $idContenedorPadre;?>';
var elemento={idContenedor:idContenedor,pagina:new pagina_planilla_det(idContenedor,direccion,paramConfig,idContenedorPadre)};
_CP.setPagina(elemento);
}
Ext.onReady(main,main);

function pagina_planilla_det(idContenedor,direccion,paramConfig,idContenedorPadre)
{
	var Atributos=new Array,sw=0, maestro;
	var sw_grup=true,gridG,gSm,id_SCD,ds_g,gDlg;
	
	
	/////////////////
	//  DATA STORE //
	/////////////////
	var ds = new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/cotizacion/ActionListarConsultores.php'}),
		reader: new Ext.data.XmlReader({
			record: 'ROWS',id:'id_cotizacion',totalRecords:'TotalCount'
		},[
		'id_cotizacion',
		'desc_proveedor',
		'num_os',
		'codigo_proceso',
		'observaciones','num_sol','prox_pago',
		{name: 'fecha_prox_pago',type:'date',dateFormat:'Y-m-d'},'id_planilla','nro_contrato','id_plan_pago','monto',{name: 'fecha_pagado',type:'date',dateFormat:'Y-m-d'},'tipo_plantilla','num_factura',{name: 'fecha_factura',type:'date',dateFormat:'Y-m-d'},'desc_plantilla','id_moneda','nit','desc_moneda','tipo','id_documento','por_anticipo','por_retgar','multas','anticipo_cot','retgar_cot','obs_descuentos','cuenta_bancaria'
,'monto_no_pagado'
		]),remoteSort:true});

		var ds_consultor = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/cotizacion/ActionListarConsultores.php'}),reader:new Ext.data.XmlReader({record:'ROWS',id:'id_cotizacion',totalRecords: 'TotalCount'},['id_cotizacion','desc_proveedor','num_os','codigo_proceso','prox_pago','id_plan_pago','por_anticipo','por_retgar','anticipo_cot','retgar_cot','monto','id_documento','cuenta_bancaria'])});
		
		var ds_tipo_plantilla = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_contabilidad/control/plantilla/ActionListarPlantilla.php'}),reader:new Ext.data.XmlReader({record:'ROWS',id:'tipo_plantilla',totalRecords: 'TotalCount'},['id_plantilla','tipo_plantilla','desc_plantilla'])});

		//FUNCIONES RENDER

		
		function render_consultor(value, p, record){
			if(parseFloat(record.data['id_documento'])>0){
				return String.format('{0}', record.data['desc_proveedor']);
			}else{
				return '<span style="color:red;font-size:8pt">' + record.data['desc_proveedor'] + '</span>';
			}
		}
		var tpl_consultor=new Ext.Template('<div class="search-item">','<b><i>Proceso: {codigo_proceso}</i></b>','<br><FONT COLOR="#B5A642"><b>N� OS: </b>{num_os}</FONT>','<br><b><i>Consultor:{desc_proveedor}</i></b>','<br><FONT COLOR="#B5A642"><b>N� Pago: </b>{prox_pago}</FONT>','</div>');

		function render_tipo_plantilla(value, p, record){return String.format('{0}', record.data['desc_plantilla']);}
		var tpl_tipo_plantilla=new Ext.Template('<div class="search-item">','<b><i>{desc_plantilla}</i></b>','</div>');

		
		
		
		///////////////////////
		// Definici�n de datos //
		/////////////////////////

		// hidden id_cotizacion_det
		//en la posici�n 0 siempre esta la llave primaria

		Atributos[0]={
			validacion:{
				labelSeparator:'',
				name: 'id_plan_pago',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'id_plan_pago'
		};
		
		
		// txt tipo_pago
		Atributos[1]={
			validacion:{
				name:'id_cotizacion',
				fieldLabel:'Consultor',
				allowBlank:false,
				emptyText:'Consultor...',
				desc: 'desc_proveedor', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_consultor,
				valueField: 'id_cotizacion',
				displayField: 'desc_proveedor',
				queryParam: 'filterValue_0',
				filterCol:'prov.desc_proveedor#PLA.nro_cuota#p.codigo_proceso',
				onSelect: function(record){
					
										   getComponente('por_anticipo').setValue(record.data.anticipo_cot);
										   getComponente('por_retgar').setValue(record.data.retgar_cot);
										   getComponente('monto').setValue(record.data.monto);
										   getComponente('id_cotizacion').setValue(record.data.id_cotizacion);
										   getComponente('id_cotizacion').setRawValue(record.data.desc_proveedor);
										   getComponente('prox_pago').setValue(record.data.prox_pago);
										   getComponente('id_plan_pago').setValue(record.data.id_plan_pago);
										   getComponente('cuenta_bancaria').setValue(record.data.cuenta_bancaria);
										  
										   getComponente('id_cotizacion').collapse(); 
				},
				onChange: function(record){
										   getComponente('id_cotizacion').setValue(record.data.id_cotizacion);
										   getComponente('prox_pago').setValue(record.data.prox_pago);
										   getComponente('id_plan_pago').setValue(record.data.id_plan_pago);
										   getComponente('id_cotizacion').setRawValue(record.data.desc_proveedor);
										   getComponente('por_anticipo').setValue(record.data.anticipo_cot);
										   getComponente('por_retgar').setValue(record.data.retgar_cot);
										  getComponente('cuenta_bancaria').setValue(record.data.cuenta_bancaria);
										   getComponente('id_cotizacion').collapse(); 
				},
				typeAhead:false,
				tpl:tpl_consultor,
				forceSelection:true,
				mode:'remote',
				queryDelay:120,
				pageSize:100,
				minListWidth:'100%',
				grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_consultor,
				grid_visible:true,
				grid_editable:false,
				width_grid:250,
				width:'100%',
				disabled:false,
				grid_indice:3
			},
			tipo:'ComboBox',
			form: true,
			filtro_0:true,
			filterColValue:'prov.desc_proveedor',
			save_as:'id_cotizacion'
			
		};
		
		Atributos[2]={
			validacion:{
				labelSeparator:'',
				name: 'id_planilla',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'id_planilla'
		};
		
		Atributos[3]={
			validacion:{
				labelSeparator:'',
				name: 'num_os',
				fieldLabel:'Orden Servicio',
				inputType:'hidden',
				grid_visible:true,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			form:false,
			save_as:'num_os'
		};
		

		Atributos[4]={
			validacion:{
				labelSeparator:'',
				name: 'codigo_proceso',
				fieldLabel:'Proceso',
				inputType:'hidden',
				grid_visible:true,
				grid_editable:false,
				grid_indice:1
			},
			tipo: 'Field',
			filtro_0:false,
			form:false,
			save_as:'codigo_proceso'
		};
		
		
		Atributos[5]={
			validacion:{
				labelSeparator:'',
				name: 'nro_contrato',
				fieldLabel:'N� Contrato',
				inputType:'hidden',
				grid_visible:true,
				grid_editable:false,
				align:'right'
			},
			tipo: 'Field',
			form:false,
			filtro_0:false,
			save_as:'nro_contrato'
		};

		
		
		
		Atributos[6]={
			validacion:{
				name: 'prox_pago',
				fieldLabel:'N� Pago',
				//inputType:'hidden',
				grid_visible:true,
				grid_editable:false,
				width_grid:55,
				align:'right',
				disabled:true
			},
			tipo: 'TextField',
			filtro_0:false,
			form:true,
			save_as:'prox_pago'
		};
		
		
		Atributos[7]={
			validacion:{
				name: 'monto',
				fieldLabel:'Importe Pago',
				//inputType:'hidden',
				grid_visible:true,
				grid_editable:false,
				disabled:true,
				align:'right'
			},
			tipo: 'Field',
			form:true,
			filtro_0:false,
			save_as:'monto'
		};
		
		
		 Atributos[8]= {
			validacion:{
				name:'fecha_pagado',
				fieldLabel:'Fecha de Pago',
				allowBlank:false,
				format: 'd/m/Y', //formato para validacion
				minValue: '01/01/1900',
				disabledDaysText: 'D�a no v�lido',
				grid_visible:true,
				grid_editable:false,
				renderer: formatDate,
				width_grid:85,
				disabled:false,
				width:202
			},
			form:true,
			tipo:'DateField',
			filtro_0:false,
			filterColValue:'PLANIL.fecha_planilla',
			dateFormat:'m-d-Y',
			defecto:'',
			save_as:'fecha_pagado'
		};
		
		var fCol=new Array();
		var fVal=new Array();
		fCol[0]='PLANT.sw_compro';
		fVal[0]='1';
		
		Atributos[9]={
			validacion:{
				name:'tipo_plantilla',
				fieldLabel:'Documento',
				allowBlank:false,
				emptyText:'Documento...',
				desc: 'desc_plantilla',
				store:ds_tipo_plantilla,
				valueField: 'tipo_plantilla',
				displayField: 'desc_plantilla',
				queryParam: 'filterValue_0',
				filterCol:'PLANT.tipo_plantilla#PLANT.desc_plantilla',
				filterCols:fCol,
				filterValues:fVal,
				typeAhead:true,
				tpl:tpl_tipo_plantilla,
				forceSelection:true,
				mode:'remote',
				queryDelay:250,
				pageSize:100,
				minListWidth:'50%',
				grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_tipo_plantilla,
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				width:'50%'
				
			},
			tipo:'ComboBox',
			form: true,
			filtro_0:true,
			filterColValue:'PLANPA.tipo_plantilla'

		};
		
		Atributos[10]={
			validacion:{
				name:'num_factura',
				fieldLabel:'N� Documento',
				allowBlank:true,
				maxLength:18,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:false,
				decimalPrecision:0,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:85,
				disabled:false,
				width:202
			},
			tipo: 'NumberField',
			form: true,
			defecto:0,
			filtro_0:true,
			filterColValue:'plapag.num_factura',
			save_as:'num_factura'
			
		};
		 Atributos[11]= {
			validacion:{
				name:'fecha_factura',
				fieldLabel:'Fecha de Factura',
				allowBlank:true,
				format: 'd/m/Y', //formato para validacion
				minValue: '01/01/1900',
				disabledDaysText: 'D�a no v�lido',
				grid_visible:true,
				grid_editable:false,
				renderer: formatDate,
				width_grid:85,
				disabled:false,
				width:202
			},
			form:true,
			tipo:'DateField',
			filtro_0:false,
			filterColValue:'PLANIL.fecha_planilla',
			dateFormat:'m-d-Y',
			defecto:'',
			save_as:'fecha_factura'
		};

		
		Atributos[12]={
			validacion:{
				labelSeparator:'',
				name: 'id_documento',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'id_documento'
		};
		
		Atributos[13]={
			validacion:{
				name:'por_anticipo',
				fieldLabel:'% Adelanto',
				allowBlank:true,
				maxLength:18,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:85,
				disabled:true,
				width:202
			},
			tipo: 'NumberField',
			form: true,
			defecto:0,
			filtro_0:true,
			filterColValue:'plapag.por_anticipo',
			save_as:'por_anticipo'
		};
		
		
		Atributos[14]={
			validacion:{
				name:'por_retgar',
				fieldLabel:'% Garantia',
				allowBlank:true,
				maxLength:18,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:85,
				disabled:false,
				width:202
			},
			tipo: 'NumberField',
			form: true,
			defecto:0,
			filtro_0:true,
			filterColValue:'plapag.por_retgar',
			save_as:'por_retgar'
		};
		
		
		Atributos[16]={
			validacion:{
				name:'multas',
				fieldLabel:'Otros Descuentos',
				allowBlank:true,
				maxLength:18,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:85,
				disabled:false,
				width:202
			},
			tipo: 'NumberField',
			form: true,
			defecto:0,
			filtro_0:true,
			filterColValue:'plapag.multas',
			save_as:'multas'
		};
		
		
		Atributos[17]={
			validacion:{
				name:'obs_descuentos',
				fieldLabel:'Observaciones Otros Dsctos',
				allowBlank:true,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:100,
				width:'100%',
				disable:false
			},
			tipo: 'TextArea',
			form: true,
			filtro_0:false
		};
		
		Atributos[18]={
			validacion:{
				name: 'cuenta_bancaria',
				fieldLabel:'Cta. Bancaria',
				//inputType:'hidden',
				allowBlank:true,
				grid_visible:true,
				grid_editable:false,
				width_grid:55,
				align:'right',
				disabled:true
			},
			tipo: 'TextField',
			filtro_0:false,
			form:true,
			save_as:'cuenta_bancaria'
		};
		
		Atributos[15]={
				validacion:{
					name:'monto_no_pagado',
					fieldLabel:'Desc. Atraso',
					allowBlank:true,
					maxLength:18,
					minLength:0,
					selectOnFocus:true,
					allowDecimals:true,
					decimalPrecision:2,//para numeros float
					allowNegative:false,
					minValue:0,
					vtype:'texto',
					grid_visible:true,
					grid_editable:false,
					width_grid:100,
					width:'60%',
					disabled:false,
					
					align:'right'
				},
				tipo: 'NumberField',
				defecto:0,
				form: true,
				filtro_0:true,
				filterColValue:'plapag.monto_no_pagado'
				
			};
		
		
		//----------- FUNCIONES RENDER

		function formatDate(value){return value?value.dateFormat('d/m/Y'):''};

		
		//---------- INICIAMOS LAYOUT DETALLE


		var config={titulo_maestro:'Detalle - Planilla',grid_maestro:'grid-'+idContenedor};
		layout_planilla_det= new DocsLayoutMaestro(idContenedor);
		layout_planilla_det.init(config);

		//---------- INICIAMOS HERENCIA
		this.pagina = Pagina;
		this.pagina(paramConfig,Atributos,ds,layout_planilla_det,idContenedor);
		var getComponente=this.getComponente;
		var getSelectionModel=this.getSelectionModel;
		var CM_btnNew=this.btnNew;
		var CM_btnEdit=this.btnEdit;
		var CM_ocultarGrupo=this.ocultarGrupo;
		var CM_mostrarGrupo=this.mostrarGrupo;
		var CM_ocultarComponente=this.ocultarComponente;
		var CM_mostrarComponente=this.mostrarComponente;
		var Cm_conexionFailure=this.conexionFailure;
		var CM_btnEliminar=this.btnEliminar;
		var CM_saveSuccess=this.saveSuccess;
		var getDialog=this.getDialog;
		var EstehtmlMaestro=this.htmlMaestro;
		var getGrid=this.getGrid;
		var enableSelect=this.EnableSelect;
		//DEFINICI�N DE LA BARRA DE MEN�
		var paramMenu={
			nuevo:{crear:true,separador:true},
			editar:{crear:true,separador:false},
			eliminar:{crear:true,separador:false},
			actualizar:{crear:true,separador:false}
		};
		//DEFINICI�N DE FUNCIONES

		var paramFunciones={
			btnEliminar:{url:direccion+'../../../control/planilla/ActionEliminarPlanillaDet.php',parametros:'&m_id_planilla='+Atributos[2]},
			Save:{url:direccion+'../../../control/planilla/ActionGuardarPlanillaDet.php',parametros:'&m_id_planilla='+Atributos[2]+'&en_planilla=no'},
			ConfirmSave:{url:direccion+'../../../control/planilla/ActionGuardarPlanillaDet.php',parametros:'&m_id_planilla='+Atributos[2]},
			Formulario:{html_apply:'dlgInfo-'+idContenedor,height:300,width:420,minWidth:'25%',minHeight:222,columnas:['90%'],	closable:true,titulo:'Detalle de Pagos',
			grupos:[{
				tituloGrupo:'Datos de Pago',
				columna:0,
				id_grupo:0
			}
]
			}
		};


		//-------------- Sobrecarga de funciones --------------------//
		this.reload=function(m){
			
			maestro=m;
		
			ds.lastOptions={
				params:{
					start:0,
					limit: paramConfig.TamanoPagina,
					CantFiltros:paramConfig.CantFiltros,
					en_planilla:'si',
					m_id_planilla:maestro.id_planilla
				}
			};
			this.btnActualizar();
			ds_consultor.baseParams={
				m_id_planilla:maestro.id_planilla,
				m_id_depto_tesoro:maestro.id_depto_tesoro
			}
			Atributos[2].defecto=maestro.id_planilla;
			

			paramFunciones.btnEliminar.parametros='&m_id_planilla='+maestro.id_planilla+'&m_id_depto_tesoro='+maestro.id_depto_tesoro;
			paramFunciones.ConfirmSave.parametros='&m_id_planilla='+maestro.id_planilla+'&m_id_depto_tesoro='+maestro.id_depto_tesoro;
			paramFunciones.Save.parametros='&m_id_planilla='+maestro.id_planilla;
			//iniciarEventosFormularios();
			this.iniciarEventosFormularios;
			this.InitFunciones(paramFunciones)
		};

		//Para manejo de eventos
		function iniciarEventosFormularios(){
			cmbCotizacion=getComponente('id_cotizacion');
			txt_nro_cuota=getComponente('prox_pago');
		}


		this.EnableSelect=function(x,z,y){
			enable(x,z,y)
		}

		//function salta(){ _CP.getPagina(idContenedorPadre).pagina.btnActualizar();

			ds.lastOptions={
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				en_planilla:'si'
			}
		};
		
		
		this.btnNew=function(){
			
			//CM_ocultarComponente(getComponente('num_factura'));
			//CM_ocultarComponente(getComponente('fecha_factura'));
			getComponente('tipo_plantilla').enable();
			getComponente('id_cotizacion').modificado=true;
				Ext.Ajax.request({
					
					url:direccion+"../../../../lib/lib_control/action/ActionObtenerFechaBD.php",
					method:'GET',
					success:function cargar_fecha_bd(resp1){
						
					  Ext.MessageBox.hide();

						if(resp1.responseXML != undefined && resp1.responseXML != null && resp1.responseXML.documentElement != null && resp1.responseXML.documentElement != undefined)
						{
							var root1 = resp1.responseXML.documentElement;
							getComponente('fecha_pagado').setValue(root1.getElementsByTagName('fecha')[0].firstChild.nodeValue);
						}
					},
					failure:Cm_conexionFailure,
					timeout:100000000//TIEMPO DE ESPERA PARA DAR FALLO
				});
				
				
				CM_btnNew();
		}

		
		this.btnEdit=function(){
			
			var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();	
			if(NumSelect!=0){		
				var SelectionsRecord=sm.getSelected();
//				if(parseFloat(SelectionsRecord.data.id_documento)>0){
//					getComponente('tipo_plantilla').disable();
//					getComponente('num_factura').disable();
//					getComponente('fecha_factura').disable();
//					CM_mostrarComponente(getComponente('num_factura'));
//					CM_mostrarComponente(getComponente('fecha_factura'));
//					
//				}else{
//					getComponente('tipo_plantilla').disable();
//					getComponente('num_factura').disable();
//					getComponente('fecha_factura').disable();
//					CM_ocultarComponente(getComponente('num_factura'));
//					CM_ocultarComponente(getComponente('fecha_factura'));
//				}
				
				CM_btnEdit();
			}
		}
		
		
		function btn_doc_editar(){
			var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
			if(NumSelect!=0){		
				var SelectionsRecord=sm.getSelected();
						var data='m_nombre_tabla=compro.tad_plan_pago';
						data=data+'&m_nombre_campo=id_plan_pago';
						data=data+'&m_id_plan_pago='+SelectionsRecord.data.id_plan_pago;
						data=data+'&m_id_moneda='+SelectionsRecord.data.id_moneda;
						if(SelectionsRecord.data.id_documento>0){
							data=data+'&m_id_documento='+SelectionsRecord.data.id_documento;
							data=data+'&m_nuevo=no';
						}else{
							data=data+'&m_id_documento=0';
							data=data+'&m_nuevo=si';
						}
						data=data+'&m_importe='+SelectionsRecord.data.monto;
						
						data=data+'&m_tipo_documento='+SelectionsRecord.data.tipo_plantilla;
						data=data+'&m_nit='+SelectionsRecord.data.nit;
						data=data+'&m_razon_social='+SelectionsRecord.data.desc_proveedor;
						data=data+'&m_compro=si';
						data=data+'&m_desc_plantilla='+SelectionsRecord.data.desc_plantilla;
						data=data+'&m_desc_moneda='+SelectionsRecord.data.desc_moneda;
						data=data+'&m_tipo='+SelectionsRecord.data.tipo;
						data=data+'&m_tipo_doc_fijo=si';
						data=data+'&id_plan_pago='+SelectionsRecord.data_id_plan_pago;
						
						var ParamVentana={Ventana:{width:450,height:400}};
						layout_planilla_det.loadWindows(direccion+'../../../../sis_contabilidad/vista/documento/documento.php?'+data,'Documentos',ParamVentana)
				}
		}

		//para que los hijos puedan ajustarse al tama�o
		this.getLayout=function(){return layout_planilla_det.getLayout()};
		//para el manejo de hijos

		this.Init(); //iniciamos la clase madre
		this.InitBarraMenu(paramMenu);
		this.InitFunciones(paramFunciones);
		//para agregar botones

		var CM_getBoton=this.getBoton;
		this.AdicionarBoton('../../../lib/imagenes/copy.png','<b>Editar</b>',btn_doc_editar,false,'documento','Datos de Documento');

		function  enable(sel,row,selected){
			var record=selected.data;
			if(selected&&record!=-1){
//				if(parseFloat(record.id_documento)>0){
//					CM_getBoton('documento-'+idContenedor).disable();
//				}else{
//					CM_getBoton('documento-'+idContenedor).enable();
//				}
			}
			enableSelect(sel,row,selected);
		}
		this.iniciaFormulario();
		iniciarEventosFormularios();


		layout_planilla_det.getLayout().addListener('layout',this.onResize);
		ContenedorPrincipal.getPagina(idContenedorPadre).pagina.getLayout().addListener('layout',this.onResizePrimario);

}