/**
* Nombre:		  	    pagina_proceso_compra_serv_main.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
* Fecha creaci�n:		2008-05-13 18:03:05
*/
function pagina_proceso_compra_serv(idContenedor,direccion,paramConfig){
	var Atributos=new Array,sw=0;
	var on, cotizacion;
	var obs;
	var bandera;
	var dialog;
	//---DATA STORE
	var ds = new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/proceso_compra/ActionListarProcesoCompra.php'}),
		reader: new Ext.data.XmlReader({
			record: 'ROWS',id:'id_proceso_compra',totalRecords:'TotalCount'
		},[
		'id_proceso_compra',
		'observaciones',
		'codigo_proceso',
		{name: 'fecha_reg',type:'date',dateFormat:'Y-m-d'},
		'estado_vigente',
		'id_tipo_categoria_adq',
		'desc_tipo_categoria_adq',
		'id_categoria_adq',
		'desc_categoria_adq',
		'id_moneda',
		'desc_moneda',
		'num_cotizacion',
		'num_proceso',
		'siguiente_estado',
		'periodo',
		'gestion',
		'num_cotizacion_sis',
		'num_proceso_sis',
		{name: 'fecha_proc',type:'date',dateFormat:'Y-m-d'},
		'desc_tipo_adq',
		'tipo_adq',
		'id_tipo_adq','id_proceso_compra_ant','num_convocatoria','id_cotizacion','id_moneda_base','numeracion_periodo_proceso','proceso_cotizado','ejecutado','proceso_adjudicado','observaciones_acta','numeracion_periodo_cotizacion','num_sol_por_proc'
		]),remoteSort:true});


		//DATA STORE COMBOS
		/////////////////////////
		// Definici�n de datos //
		/////////////////////////


		// hidden id_proceso_compra
		//en la posici�n 0 siempre esta la llave primaria
		Atributos[0]={
			validacion:{
				labelSeparator:'',
				name: 'id_proceso_compra',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'id_proceso_compra'
		};

		Atributos[1]={//18
			validacion:{
				name:'numeracion_periodo_proceso',
				fieldLabel:'Periodo/N� Proc.',
				allowBlank:true,
				maxLength:30,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:95,
				width:'40%',
				disabled:false,
				grid_indice:1
			},
			tipo: 'TextField',
			form:false,
			filtro_0:true,
			filterColValue:'PROCOM.periodo#PROCOM.num_proceso',
			save_as:'numeracion_periodo'
		};

		// txt codigo_proceso
		Atributos[2]={
			validacion:{
				name:'codigo_proceso',
				fieldLabel:'C�digo de Proceso',
				allowBlank:false,
				maxLength:20,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:120,
				width:'100%',
				disabled:true,
				grid_indice:2
			},
			tipo: 'TextField',
			form:false,
			filtro_0:true,
			filterColValue:'PROCOM.codigo_proceso',
			save_as:'codigo_proceso'
		};

		Atributos[3]={
			validacion:{
				name:'desc_categoria_adq',
				fieldLabel:'Categor�a',
				allowBlank:false,
				maxLength:300,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:120,
				width:'100%',
				disabled:true
			},
			tipo: 'TextField',
			form:false,
			filtro_0:true,
			filterColValue:'CATADQ.nombre',
			save_as:'id_categoria_adq'
		};


		// txt id_moneda
		Atributos[4]={
			validacion:{
				name:'desc_moneda',
				fieldLabel:'Moneda',
				allowBlank:false,
				maxLength:200,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:105,
				width:'100%',
				disabled:true
			},
			tipo: 'TextField',
			form:false,
			filtro_0:true,
			filterColValue:'MONEDA.nombre',
			save_as:'id_moneda'
		};

		// txt num_proceso
		Atributos[5]={
			validacion:{
				name:'num_proceso',
				fieldLabel:'N� Proceso',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:false,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:100,
				width:'100%',
				disabled:true
			},
			tipo: 'NumberField',
			form: false,
			filtro_0:false,
			filterColValue:'PROCOM.num_proceso',
			save_as:'num_proceso'
		};

		// txt num_cotizacion
		Atributos[6]={
			validacion:{
				name:'numeracion_periodo_cotizacion',
				fieldLabel:'N� Cotizaci�n',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:false,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				align:'right',
				width_grid:85,
				width:'100%',
				disabled:true
			},
			tipo: 'NumberField',
			form: false,
			filtro_0:false,
			filterColValue:'PROCOM.num_cotizacion#PROCOM.periodo',
			save_as:'num_cotizacion'
		};

		// txt observaciones
		Atributos[7]={//16
			validacion:{
				name:'num_convocatoria',
				fieldLabel:'N� Convocatoria',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:false,
				decimalPrecision:0,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:95,
				align:'center',
				width:'100%',
				disabled:true
			},
			tipo: 'NumberField',
			form: false,
			filtro_0:true,
			filterColValue:'PROCOM.num_convocatoria',
			save_as:'num_convocatoria'
		};

		// txt fecha_reg
		Atributos[8]= {
			validacion:{
				name:'fecha_reg',
				fieldLabel:'Fecha registro',
				allowBlank:true,
				format: 'd/m/Y', //formato para validacion
				minValue: '01/01/1900',
				disabledDaysText: 'D�a no v�lido',
				grid_visible:false,
				grid_editable:false,
				renderer: formatDate,
				width_grid:85,
				disabled:true
			},
			form:false,
			tipo:'DateField',
			filtro_0:false,
			filterColValue:'PROCOM.fecha_reg',
			dateFormat:'m-d-Y',
			defecto:'',
			save_as:'fecha_reg'
		};

		Atributos[9]={
			validacion:{
				name:'desc_tipo_adq',
				fieldLabel:'Tipo de Adquisici�n',
				allowBlank:false,
				maxLength:300,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:120,
				width:'100%',
				disabled:true
			},
			tipo: 'TextField',
			form:false,
			filtro_0:true,
			filterColValue:'TIPADQ.nombre',
			save_as:'id_tipo_adq'
		};
		// txt estado_vigente//14
		Atributos[10]={
			validacion:{
				name:'estado_vigente',
				fieldLabel:'Estado Vigente',
				allowBlank:false,
				maxLength:18,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:100,
				width:'100%',
				disabled:true
			},
			tipo: 'TextField',
			form: false,
			filtro_0:false,
			filterColValue:'PROCOM.estado_vigente',
			save_as:'estado_vigente'
		};

		Atributos[11]={
			validacion:{
				name:'ejecutado',
				fieldLabel:'Presupuesto Ejecutado',
				allowBlank:false,
				maxLength:2,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				align:'center',
				width_grid:125,
				width:'100%',
				disabled:true
			},
			tipo: 'TextField',
			form: false,
			filtro_0:false,
			filterColValue:'PROCOM.ejecutado',
			save_as:'ejecutado'
		};

		Atributos[12]={
			validacion:{
				name:'observaciones',
				fieldLabel:'Observaciones',
				maxLength:25000,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:120,
				width:'100%',
				disabled:false,
				grid_indice:5
			},
			tipo: 'TextArea',
			form: true,
			filtro_0:true,
			filterColValue:'PROCOM.observaciones',
			save_as:'observaciones'
		};



		Atributos[13]={//17
			validacion:{
				name:'id_cotizacion',
				fieldLabel:'id_cotizacion',
				allowBlank:false,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:false,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:100,
				width:'100%',
				disabled:true
			},
			tipo: 'NumberField',
			form: false,
			filtro_0:false
		};


		Atributos[14]={
			validacion:{
				labelSeparator:'',
				name: 'obs',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'obs',
			defecto:0
		};


		Atributos[15]={
			validacion:{
				name:'observaciones_acta',
				fieldLabel:'Observaciones de Acta',
				maxLength:25000,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:120,
				width:'100%',
				disabled:false
			},
			tipo: 'TextArea',
			form: true,
			filtro_0:false,
			filterColValue:'PROCOM.observaciones_acta',
			save_as:'observaciones_acta'
		};

		Atributos[16]={
			validacion:{
				name:'gestion',
				fieldLabel:'Gesti�n',
				allowBlank:true,
				maxLength:20,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:55,
				align:'right',
				width:'40%',
				disabled:true
				
			},
			tipo: 'TextField',
			form: false,
			filtro_0:true,
			filterColValue:'PROCOM.gestion'

		};
		
		Atributos[17]={
			validacion:{
				labelSeparator:'',
				name: 'num_sol_por_proc',
				inputType:'hidden',
				fieldLabel:'Periodo/N�Solicitudes',
				grid_visible:true,
				grid_editable:false,
				grid_indice:1
			},
			tipo: 'Field',
			filtro_0:true,
			filterColValue:'SOLCOM.periodo#SOLCOM.num_solicitud',
			save_as:'num_sol_por_proc'
		};
		//////////////////////////////////////////////////////////////
		// ----------            FUNCIONES RENDER    ---------------//
		//////////////////////////////////////////////////////////////
		function formatDate(value){return value?value.dateFormat('d/m/Y'):''};

		//---------- INICIAMOS LAYOUT DETALLE
		var config={titulo_maestro:'Proceso de Servicios',grid_maestro:'grid-'+idContenedor,
		urlHijo:'../../../sis_adquisiciones/vista/proceso_compra_det/proceso_compra_mul_serv_det.php'};
		var layout_proceso_compra_serv=new DocsLayoutMaestroDeatalle(idContenedor);
		layout_proceso_compra_serv.init(config);

		////////////////////////
		// INICIAMOS HERENCIA //
		////////////////////////


		this.pagina=Pagina;
		//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
		this.pagina(paramConfig,Atributos,ds,layout_proceso_compra_serv,idContenedor);
		var getComponente=this.getComponente;
		var getSelectionModel=this.getSelectionModel;
		var CM_saveSuccess=this.saveSuccess;
		var cm_conexionFailure=this.conexionFailure;
		var ClaseMadre_btnEdit=this.btnEdit;
		var cmbtnActualizar=this.btnActualizar;
		var Cm_getDialog=this.getDialog;
		var CM_ocultarComponente=this.ocultarComponente;
		var CM_mostrarComponente=this.mostrarComponente;


		var enableSelect=this.EnableSelect;
		///////////////////////////////////
		// DEFINICI�N DE LA BARRA DE MEN�//
		///////////////////////////////////

		var paramMenu={
			actualizar:{crear:true,separador:false}
		};


		//////////////////////////////////////////////////////////////////////////////
		//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
		//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
		//////////////////////////////////////////////////////////////////////////////

		//datos necesarios para el filtro
		var paramFunciones={
			btnEliminar:{url:direccion+'../../../control/proceso_compra/ActionEliminarProcesoCompra.php'},
			Save:{url:direccion+'../../../control/proceso_compra/ActionGuardarProcesoCompraAnular.php'},
			ConfirmSave:{url:direccion+'../../../control/proceso_compra/ActionGuardarProcesoCompraAnular.php'},
			Formulario:{html_apply:'dlgInfo-'+idContenedor,height:250,width:480,minWidth:150,minHeight:200,	closable:true,titulo:'proceso_compra',
			grupos:[{
				tituloGrupo:'Proceso',
				columna:0,
				id_grupo:0
			}]
			}};


			//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//

			function btn_lista_compras(){
				this.btnActualizar;
				var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
				if(NumSelect!=0){
					var SelectionsRecord=sm.getSelected();
					var data='m_id_proceso_compra='+SelectionsRecord.data.id_proceso_compra;
					var ParamVentana={Ventana:{width:'90%',height:'70%'}}
						window.open(direccion+'../../../control/proceso_compra/reporte/ActionPDFListaCompras.php?'+data)
					layout_proceso_compra_serv.getVentana().on('resize',function(){
						layout_proceso_compra_serv.getLayout().layout();
					})
				}
				else
				{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
				}
			}




			function btn_anular_proceso(){
				var sm=getSelectionModel();
				var filas=ds.getModifiedRecords();
				var cont=filas.length;
				var NumSelect=sm.getCount();
				if(NumSelect!=0){
					var SelectionsRecord=sm.getSelected();
					var data=SelectionsRecord.data.id_proceso_compra;

					if(SelectionsRecord.data.proceso_adjudicado>0&&SelectionsRecord.data.proceso_adjudicado!=''&& SelectionsRecord.data.proceso_adjudicado!=undefined){
						Ext.MessageBox.alert('Estado','No es posible anular el proceso, tiene adjudicaciones en curso');
					}else{
						if(confirm("�Est� seguro de anular el proceso?")){
							Ext.MessageBox.hide();
							dialog.setTitle("Anular Proceso");
							CM_ocultarComponente(getComponente('observaciones_acta'));
							CM_ocultarComponente(getComponente('num_sol_por_proc'));
							CM_mostrarComponente(getComponente('observaciones'));
							getComponente('observaciones').setValue('');
							getComponente('observaciones').allowBlank=false;
							dialog.buttons[0].enable();
							dialog.buttons[0].setText("Solicitar Anulacion");
							getComponente('id_proceso_compra').setValue(data);
							getComponente('obs').setValue(0);
							Ext.MessageBox.hide();
							ClaseMadre_btnEdit();

						}
					}
				}
				else{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
				}
			}



			function btn_cotizacion(){
				this.btnActualizar;
				on=1;


				var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
				if(NumSelect!=0){


					var SelectionsRecord=sm.getSelected();
					var data='m_id_proceso_compra='+SelectionsRecord.data.id_proceso_compra;
					data=data+'&m_codigo_proceso='+SelectionsRecord.data.codigo_proceso;
					data=data+'&m_num_proceso='+SelectionsRecord.data.num_proceso;
					data=data+'&m_tipo_adq='+SelectionsRecord.data.tipo_adq;
					data=data+'&m_id_tipo_categoria_adq='+SelectionsRecord.data.id_tipo_categoria_adq;
					data=data+'&m_lugar_entrega='+SelectionsRecord.data.lugar_entrega;
					data=data+'&m_id_moneda='+SelectionsRecord.data.id_moneda;
					data=data+'&m_desc_moneda='+SelectionsRecord.data.desc_moneda;
					data=data+'&m_num_cotizacion='+SelectionsRecord.data.num_cotizacion;
					data=data+'&m_id_moneda_base='+SelectionsRecord.data.id_moneda_base;
					data=data+'&m_ejecutado='+SelectionsRecord.data.ejecutado;
					data=data+'&m_periodo='+SelectionsRecord.data.periodo;
					var ParamVentana={Ventana:{width:'90%',height:'70%'}}
						layout_proceso_compra_serv.loadWindows(direccion+'../../../../sis_adquisiciones/vista/cotizacion/cotizacion_serv_dir.php?'+data,'Cotizacion de Proceso',ParamVentana);
					
					layout_proceso_compra_serv.getVentana().on('resize',function(){
						layout_proceso_compra_serv.getLayout().layout();
					});

				}else{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
				}

			}


			function verificarCotizacion(){
				Ext.Ajax.request({
					url:direccion+"../../../control/cotizacion/ActionListarCotizacion.php?m_id_proceso_compra="+getComponente('id_proceso_compra').getValue(),
					method:'GET',
					success:verificar,
					failure:cm_conexionFailure,
					timeout:100000000
				})

			}

			function verificar(resp){
				//alert("tiene que llegar...");
				//Ext.MessageBox.hide();
				if(resp.responseXML!=undefined && resp.responseXML!=null&& resp.responseXML.documentElement!=null &&resp.responseXML.documentElement!=undefined){
					var root=resp.responseXML.documentElement;
					//alert("el total es: "+root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue);
					if(root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue>0){
						//if(root.getElementsByTagName('estado_vigente')[0].firstChild.nodeValue=='invitado'){
						if(on==2){//acta

							var sm=getSelectionModel();
							var NumSelect=sm.getCount();
							var SelectionsRecord=sm.getSelected();
							Ext.MessageBox.show({
								title: 'Observaciones',
								msg: 'Ingrese observaciones a la solicitud:',
								width:300,
								buttons: Ext.MessageBox.OK,
								multiline: true,
								fn: getObservaciones
							});
							//}
						}else{
							//}
							//else{

							//	if(root.getElementsByTagName('estado_vigente')[0].firstChild.nodeValue=='cotizado' || root.getElementsByTagName('estado_vigente')[0].firstChild.nodeValue=='adjudicado'){

							if(on==3){

								//llamar al reporte de todas las cotizaciones para el proceso actual y luego cambiar de estado
								var data='cantidad_ids=1&id_proceso_compra_0='+getComponente('id_proceso_compra').getValue();
								var sm=getSelectionModel();
								var NumSelect=sm.getCount();
								if(NumSelect!=0){
									var SelectionsRecord=sm.getSelected();
									var data='m_id_proceso_compra='+SelectionsRecord.data.id_proceso_compra;
                                        data=data+'&m_tipo_adq='+SelectionsRecord.data.tipo_adq;
                                       // alert (data);
									window.open(direccion+'../../../control/cotizacion/reporte/ActionPDFCuadroComparativo.php?'+data);
									window.open(direccion+'../../../control/cotizacion/reporte/ActionPDFCuadroComparativo_x_Item.php?'+data)
								}
								else{
									Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un Proceso')
								}

							}

							//								if(on==2){
							//									bandera=1;
							//									//Ext.MessageBox.alert('Estado','Ya se procedi� con la generaci�n del Acta de Apertura');
							//									var data='cantidad_ids=1&id_proceso_compra_0='+getComponente('id_proceso_compra').getValue();
							//									var sm=getSelectionModel();
							//									var NumSelect=sm.getCount();
							//									if(NumSelect!=0){
							//										var SelectionsRecord=sm.getSelected();
							//										var data='m_id_proceso_compra='+SelectionsRecord.data.id_proceso_compra;
							//										window.open(direccion+'../../../control/cotizacion/reporte/ActionPDFActaApertura.php?'+data)
							//
							//									}
							//								}

							//}

							//}
							//}
							//					}else{
							//						if(on==3){//Ext.MessageBox.alert('Estado', 'No hay cotizaciones registradas para generar cuadro comparativo')
							//
							//
							//							var data='cantidad_ids=1&id_proceso_compra_0='+getComponente('id_proceso_compra').getValue();
							//							var sm=getSelectionModel();
							//							var NumSelect=sm.getCount();
							//							if(NumSelect!=0){
							//								var SelectionsRecord=sm.getSelected();
							//								var data='m_id_proceso_compra='+SelectionsRecord.data.id_proceso_compra;
							//								window.open(direccion+'../../../control/cotizacion/reporte/ActionPDFCuadroComparativo.php?'+data)
							//
							//							}
							//						}
							//
						}
					}
				}
			}

			function getObservaciones(btn,text){
				if(btn!='cancel'){
					observaciones=text;
					var data='cantidad_ids=1&id_proceso_compra_0='+getComponente('id_proceso_compra').getValue()+'&id_cotizacion_0=0&figura_acta_0=&observaciones_acta_0='+observaciones;
					Ext.Ajax.request({url:direccion+"../../../control/cotizacion/ActionGuardarEstadoCotizacion.php",
					params:data,
					method:'POST',
					success:acta,
					failure:cm_conexionFailure,
					timeout:100000000});
				}
			}







			function btn_acta_apertura(){//cuando el estado de la cotizacion es invitado
				var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
				if(NumSelect!=0){
					var SelectionsRecord=sm.getSelected();
					this.btnActualizar;
					on=2;
					cotizacion=false;
					verificarCotizacion();
				}else{
					Ext.MessageBox.alert('Estado','Antes debe seleccionar un item');
				}

			}


			function acta(resp){
				var data='cantidad_ids=1&id_proceso_compra_0='+getComponente('id_proceso_compra').getValue();
				var sm=getSelectionModel();
				var NumSelect=sm.getCount();


				if(NumSelect!=0){
					var SelectionsRecord=sm.getSelected();
					var data='m_id_proceso_compra='+SelectionsRecord.data.id_proceso_compra;
					window.open(direccion+'../../../control/cotizacion/reporte/ActionPDFActaApertura.php?'+data)
				}
			}





			function btn_cuadro_comparativo(){

				var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
				if(NumSelect!=0){

					//cuando ya se hayan realizado el registro de propuestas==> el estado sea cotizado
					on=3;
					cotizacion=false;
					verificarCotizacion();
				}else{
					Ext.MessageBox.alert('Estado','Antes debe seleccionar un item');
				}
			}

			//N-esima convocatoria
			function btn_n_conv(){
				var sm=getSelectionModel();
				var NumSelect=sm.getCount();
				if(NumSelect!=0){

					if(confirm('�Esta seguro de crear una nueva convocatoria para este proceso?')){
						obs=1;
						//	var record=sm.getSelected();
						/*dialog.setTitle("Antecedentes de Proceso");
						getComponente('id_proceso_compra').setValue(record.data.id_proceso_compra);
						CM_ocultarComponente(getComponente('observaciones_acta'));
						CM_mostrarComponente(getComponente('observaciones'));
						getComponente('obs').setValue(1);
						ClaseMadre_btnEdit();*/

						var record=sm.getSelected();
						Ext.MessageBox.show({
							title: 'Espere Por Favor...',
							msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Verificando...</div>",
							width:150,
							height:200,
							closable:false
						});



						Ext.Ajax.request(
						{url:direccion+"../../../control/proceso_compra/ActionNuevaConvocatoria.php",
						params:{id_proceso_compra:record.data.id_proceso_compra},
						argument:{sm:sm,men:'Fue Creada la nueva convocatoria'},
						method:'POST',
						success:s_proc,
						failure:cm_conexionFailure,
						timeout:100000000
						})


					}

				}
				else{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un Proceso')
				}
			}


			//			 function miSuccess(resp){
			//			    if(obs==1){
			//			       Ext.MessageBox.hide();
			//                   CM_saveSuccess(resp);
			//
			//			         var sm=getSelectionModel();
			//				     var NumSelect=sm.getCount();
			//
			//				  	 var record=sm.getSelected();
			////                    Ext.MessageBox.show({
			////							title: 'Espere Por Favor...',
			////							msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Verificando...</div>",
			////							width:150,
			////							height:200,
			////							closable:false
			////						});
			//
			//                        var data = "cant_ids=1&id_proceso_compra_0=" + getComponente('id_proceso_compra').getValue();
			//				        window.open(direccion+'../../../control/proceso_compra/reporte/ActionPDFNuevaConvocatoria.php?'+data);
			//
			//						Ext.Ajax.request(
			//						{url:direccion+"../../../control/proceso_compra/ActionNuevaConvocatoria.php",
			//						params:{id_proceso_compra:getComponente('id_proceso_compra').getValue()},
			//						argument:{sm:sm,men:'Fue Creada la nueva convocatoria'},
			//						method:'POST',
			//						success:s_proc,
			//						failure:cm_conexionFailure,
			//						timeout:100000000
			//						})
			//        }else{
			//            getComponente('observaciones').setValue(0);
			//            CM_saveSuccess(resp);
			//            Ext.MessageBox.hide();
			//        }
			//    obs=0;
			//}

			//Revertir presuuesto
			function btn_revertir(){
				var sm=getSelectionModel();
				var NumSelect=sm.getCount();
				if(NumSelect=getSelectionModel().getCount()!=0){
					if(confirm(' �Esta seguro de revertir el presupuesto  no  ejectutado? \n Ya no se podran realizar adjudicaciones ni pagos \n y ser�n anulados los detalles de solicitud involucrados')){
						var record=sm.getSelected();
						Ext.MessageBox.show({
							title: 'Espere Por Favor...',
							msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Verificando...</div>",
							width:150,
							height:200,
							closable:false
						});
						Ext.Ajax.request(
						{url:direccion+"../../../control/proceso_compra/ActionRevertirPresupuesto.php",
						params:{num_convocatoria:record.data.num_convocatoria,id_proceso_compra:record.data.id_proceso_compra},
						argument:{sm:sm,men:'El presupuesto fue revertido con exito'},
						method:'POST',
						success:s_proc,
						failure:cm_conexionFailure,
						timeout:100000000
						})
					}
				}else{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un Proceso')
				}
			}



			function s_proc(resp){
				var sm=resp.argument.sm;
				Ext.MessageBox.hide();
				var regreso = Ext.util.JSON.decode(resp.responseText);
				if(regreso.success){
					alert(resp.argument.men);
					cmbtnActualizar()
				}
			}

			function btn_finalizar_proceso(){
				if(NumSelect=getSelectionModel().getCount()!=0){
					var SelectionsRecord=getSelectionModel().getSelected();
					if(SelectionsRecord.data.ejecutado=='si'){
						if(confirm('�Esta seguro de finalizar el proceso?')){
							var sm=getSelectionModel();
							var record=sm.getSelected();
							Ext.Ajax.request({url:direccion+"../../../control/proceso_compra/ActionFinalizarProcesoCompra.php",
							params:{id_proceso_compra:record.data.id_proceso_compra},
							argument:{sm:sm,men:'Finalizado con exito'},
							method:'POST',
							success:s_proc,
							failure:cm_conexionFailure,
							timeout:100000000
							})
						}
					}else{
						Ext.MessageBox.alert('Estado', 'Antes debe revertir el presupuesto que no se ejecut� para este proceso');
					}
				}
				else{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un Proceso');
				}
			}



//			function btn_proceso_compra_det(){
//				var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
//				if(NumSelect!=0){
//					var SelectionsRecord=sm.getSelected();
//					var data='m_id_proceso_compra='+SelectionsRecord.data.id_proceso_compra;
//					data=data+'&m_id_tipo_categoria_adq='+SelectionsRecord.data.id_tipo_categoria_adq;
//					data=data+'&m_codigo_proceso='+SelectionsRecord.data.codigo_proceso;
//					data=data+'&m_id_moneda='+SelectionsRecord.data.id_moneda;
//					data=data+'&m_id_tipo_adq='+SelectionsRecord.data.id_tipo_adq;
//					data=data+'&m_desc_moneda='+SelectionsRecord.data.desc_moneda;
//					data=data+'&m_desc_tipo_adq='+SelectionsRecord.data.desc_tipo_adq;
//					var url='../../../../sis_adquisiciones/vista/proceso_compra_det/proceso_compra_mul_serv_det.php?'+data
//					
//
//					var ParamVentana={Ventana:{width:'90%',height:'70%'}}
//					layout_proceso_compra_serv.loadWindows(direccion+url,'Procedimiento Detalle',ParamVentana);
//					layout_proceso_compra_serv.getVentana().on('resize',function(){
//						layout_proceso_compra_serv.getLayout().layout();
//					})
//				}
//				else{
//					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
//				}
//			}


			//Para manejo de eventos
			function iniciarEventosFormularios(){
				//para iniciar eventos en el formulario
				dialog=Cm_getDialog();
				obs=0;
				
				getSelectionModel().on('rowdeselect',function(){
				
					if(_CP.getPagina(layout_proceso_compra_serv.getIdContentHijo()).pagina.limpiarStore()){
						_CP.getPagina(layout_proceso_compra_serv.getIdContentHijo()).pagina.bloquearMenu()
					}
				})
			}



			this.EnableSelect=function(x,z,y){
				enable(x,z,y);
				_CP.getPagina(layout_proceso_compra_serv.getIdContentHijo()).pagina.reload(y.data);
				_CP.getPagina(layout_proceso_compra_serv.getIdContentHijo()).pagina.desbloquearMenu();
			}

			function btn_reporte_cotizacion(){
				var sm=getSelectionModel();
				var filas=ds.getModifiedRecords();
				var cont=filas.length;
				var NumSelect=sm.getCount();
				if(NumSelect!=0){

					var SelectionsRecord=sm.getSelected();
					var data='m_id_proceso_compra='+SelectionsRecord.data.id_proceso_compra;
					window.open(direccion+'../../../control/cotizacion/reporte/ActionPDFCotizacion.php?'+data)
				}
				else{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
				}
			}

			//para que los hijos puedan ajustarse al tama�o
			this.getLayout=function(){return layout_proceso_compra_serv.getLayout()};
			this.Init(); //iniciamos la clase madre
			this.InitBarraMenu(paramMenu);
			//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
			this.InitFunciones(paramFunciones);
			//para agregar botones

	
			this.AdicionarBoton('../../../lib/imagenes/cancel.png','Anulaci�n de Proceso',btn_anular_proceso,true,'anular_proceso','Anular');
			this.AdicionarBoton('../../../lib/imagenes/copy.png','Cotizaciones',btn_cotizacion,true,'cotizacion','Cotizaciones');
			this.AdicionarBoton('../../../lib/imagenes/nuevo.png','Nueva Convocatoria',btn_n_conv,true,'n_conv','Nueva Conv.');
			this.AdicionarBoton('../../../lib/imagenes/volver.png','Revertir Presupuesto Sobrante',btn_revertir,true,'n_rever','Revertir');
			this.AdicionarBoton('../../../lib/imagenes/book_next.png','Finalizar Proceso',btn_finalizar_proceso,true,'finalizar_proceso','Finalizar');

			this.AdicionarBoton('../../../lib/imagenes/print.gif','Lista de Compra',btn_lista_compras,true,'lista_compra','Lista');
			this.AdicionarBoton('../../../lib/imagenes/print.gif','Cotizaciones para Invitaci�n',btn_reporte_cotizacion,true,'reporte_cotizacion','Cotizaciones');
			this.AdicionarBoton('../../../lib/imagenes/print.gif','Acta de Apertura',btn_acta_apertura,true,'acta_apertura','Acta');
			this.AdicionarBoton('../../../lib/imagenes/print.gif','Cuadro Comparativo',btn_cuadro_comparativo,true,'cuadro_comparativo','Cuadro');

			var CM_getBoton=this.getBoton;
			CM_getBoton('anular_proceso-'+idContenedor).enable();
			CM_getBoton('cotizacion-'+idContenedor).enable();
			CM_getBoton('acta_apertura-'+idContenedor).enable();
			CM_getBoton('cuadro_comparativo-'+idContenedor).enable();
			CM_getBoton('finalizar_proceso-'+idContenedor).enable();
			CM_getBoton('n_conv-'+idContenedor).enable();

			function  enable(sel,row,selected){
				var record=selected.data;

				if(selected&&record!=-1){

					CM_getBoton('anular_proceso-'+idContenedor).enable();
					CM_getBoton('cotizacion-'+idContenedor).enable();
					CM_getBoton('acta_apertura-'+idContenedor).enable();
					CM_getBoton('cuadro_comparativo-'+idContenedor).enable();
					CM_getBoton('finalizar_proceso-'+idContenedor).enable();
					CM_getBoton('n_rever-'+idContenedor).enable();
					CM_getBoton('n_conv-'+idContenedor).enable();
					if(record.ejecutado=='no'){
						if(record.estado_vigente=='anulado'){
							CM_getBoton('anular_proceso-'+idContenedor).disable();
							CM_getBoton('cotizacion-'+idContenedor).disable();
							CM_getBoton('acta_apertura-'+idContenedor).disable();
							CM_getBoton('cuadro_comparativo-'+idContenedor).disable();
							CM_getBoton('finalizar_proceso-'+idContenedor).enable();
							CM_getBoton('n_rever-'+idContenedor).disable();
							CM_getBoton('n_conv-'+idContenedor).disable();

						}else{
							CM_getBoton('n_rever-'+idContenedor).enable();
							if(record.proceso_cotizado>0){
								CM_getBoton('cuadro_comparativo-'+idContenedor).enable();
							}else{
								CM_getBoton('cuadro_comparativo-'+idContenedor).disable();
							}
							if(record.id_cotizacion>0){
								CM_getBoton('n_rever-'+idContenedor).enable();
								CM_getBoton('anular_proceso-'+idContenedor).enable();
								CM_getBoton('acta_apertura-'+idContenedor).enable();

							}else{
								CM_getBoton('anular_proceso-'+idContenedor).enable();
								CM_getBoton('acta_apertura-'+idContenedor).disable();
								CM_getBoton('cuadro_comparativo-'+idContenedor).disable();
							}
						}
					}else{
						CM_getBoton('anular_proceso-'+idContenedor).disable();
						CM_getBoton('cotizacion-'+idContenedor).disable();
						CM_getBoton('acta_apertura-'+idContenedor).disable();
						CM_getBoton('cuadro_comparativo-'+idContenedor).disable();
						CM_getBoton('finalizar_proceso-'+idContenedor).enable();
						CM_getBoton('n_rever-'+idContenedor).disable();
						CM_getBoton('n_conv-'+idContenedor).disable();
					}

				}
				enableSelect(sel,row,selected);
			}

			this.iniciaFormulario();
			iniciarEventosFormularios();

			//carga datos XML
			ds.load({
				params:{
					start:0,
					limit: paramConfig.TamanoPagina,
					CantFiltros:paramConfig.CantFiltros,
					estado:'en_proceso',/////////////el estado debe ser en_proceso....
					estado_proceso:'inicio',
					tipo:'servicio'

				}
			});
			layout_proceso_compra_serv.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout
			
			ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
			
}