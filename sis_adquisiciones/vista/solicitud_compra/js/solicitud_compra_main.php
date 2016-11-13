<?php 
/**
 * Nombre:		  	    solicitud_compra_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-05-09 09:11:12
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
    //echo "id_usuario='$id_usuario';";
    
	?>
var fa=false;
<?php if($_SESSION["ss_filtro_avanzado"]!=''){echo 'fa='.$_SESSION["ss_filtro_avanzado"].';';}?>
var paramConfig={TamanoPagina:_CP.getConfig().ss_tam_pag,TiempoEspera:_CP.getConfig().ss_tiempo_espera,CantFiltros:2,FiltroEstructura:true,FiltroAvanzado:fa};
var usuario={
	    	id_usuario:<?php echo $_SESSION['ss_id_usuario'];?>,
	    	id_empresa:<?php echo $_SESSION['ss_id_empresa'];?>,
	    	id_empleado:<?php echo $_SESSION['ss_id_empleado'];?>,
	    	lugar:"<?php echo $_SESSION['ss_nombre_lugar'];?>", nombre_empleado:"<?php echo $_SESSION['ss_nombre_empleado'];?>",
	    	paterno_empleado:"<?php echo $_SESSION["ss_paterno_empleado"];?>",
	    	materno_empleado:"<?php echo $_SESSION["ss_materno_empleado"];?>"}
var elemento={pagina:new pagina_solicitud_compra(idContenedor,direccion,usuario,paramConfig),idContenedor:idContenedor};
_CP.setPagina(elemento);


}
Ext.onReady(main,main);


/**
* Nombre:		  	    pagina_solicitud_compra_main.js
* Prop�sito: 			pagina objeto principal
* Autor:				Generado Automaticamente
* Fecha creaci�n:		2008-05-09 09:11:12
*/

//modificar  el onSelect de solicitante para que cuando elija id_tipo_categoria filtre despues los RPAs en base a la categoria que eligi� y seguir
// modificando en la BD para que guarde!!
function pagina_solicitud_compra(idContenedor,direccion,usuario,paramConfig){
	var Atributos=new Array,sw=0;
	var data_ep;
	var txt_emp=0;

	//---DATA STORE
	var ds = new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/solicitud_compra/ActionListarSolicitudCompra.php'}),
		reader: new Ext.data.XmlReader({
			record: 'ROWS',id:'id_solicitud_compra',totalRecords:'TotalCount'
		},[
		'id_solicitud_compra',
		'desc_solicitud_compra',
		'precio_total',
		'observaciones',
		{name: 'fecha_venc',type:'date',dateFormat:'Y-m-d'},
		{name: 'fecha_reg',type:'date',dateFormat:'Y-m-d'},
		'hora_reg',
		'localidad',
		'num_solicitud',
		'estado_reg',
		'estado_vigente_solicitud',
		'tipo_adjudicacion',
		'modalidad',
		//'id_solicitud_compra_ant',
		'id_tipo_categoria_adq',
		'desc_tipo_categoria_adq',
		'id_empleado_frppa_solicitante',
		'solicitante',
		'id_moneda',
		'desc_moneda',
		'id_correspondencia',
		'desc_correspondencia',
		'id_usuario_transcriptor',
		'transcriptor',
		'id_unidad_organizacional',
		'desc_unidad_organizacional',
		'id_empleado_frppa_pre_aprobacion',
		'encargado_pre_aprobacion',
		'id_empleado_frppa_aprobacion',
		'encargado_aprobacion',
		'id_empleado_frppa_gfa',
		'gfa',
		/*'codigo_sicoes',
		'siguiente_estado',*/
		'periodo',
		'gestion',
		//'num_solicitud_sis',
		'tiene_presupuesto',
		'id_financiador','id_regional','id_programa','id_proyecto','id_actividad',/*'codigo_financiador','codigo_regional','codigo_programa','codigo_proyecto','codigo_actividad','codigo_financiador','codigo_regional','codigo_programa','codigo_proyecto','codigo_actividad',*/
		'id_tipo_adq',
		'desc_tipo_adq',
		'tipo_adq',
		'simbolo',
		'id_frppa',
		'observaciones_estado', 'tipo_cambio','id_parametro_adquisicion','id_periodo','id_moneda_base','numeracion_periodo','nombre_financiador','nombre_regional','nombre_programa','nombre_proyecto','nombre_actividad',
		'id_orden_trabajo','desc_orden','id_almacen_logico','desc_almacen_logico','desc_almacen','id_almacen','id_empleado','id_uo_gerencia','id_ep','id_depto','desc_depto','proveedores_propuestos','comite_calificacion','comite_recepcion','avance','id_avance','nro_avance'
		//,'tipo_presu'
,'id_correspondencia','id_presupuesto','desc_presupuesto','correspondencia_asociada','id_gestion','es_item','nro_solicitud_cadena'
		]),remoteSort:true});

		//carga datos XML
		
		//DATA STORE COMBOS

		var ds_empleado_tpm_frppa_solicitante = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_kardex_personal/control/empleado/ActionListarEmpleados.php'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_empleado',totalRecords: 'TotalCount'},['id_empleado','id_persona','desc_persona','codigo_empleado','nombre_tipo_documento','doc_id', 'email'])
		});

		var ds_moneda = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/moneda/ActionListarMoneda.php?estado=activo'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_moneda',totalRecords: 'TotalCount'},['id_moneda','nombre','simbolo','estado','origen','prioridad'])
		});

		
		var ds_tipo_adq = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/tipo_adq/ActionListarTipoAdq.php'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_tipo_adq',totalRecords: 'TotalCount'},['id_tipo_adq','nombre','observaciones','tipo_adq','descripcion','fecha_reg'])
		});


		var ds_orden_trabajo= new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_contabilidad/control/orden_trabajo/ActionListarOrdenTrabajo.php'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_orden_trabajo',totalRecords: 'TotalCount'},['id_orden_trabajo','desc_orden','motivo_orden','fecha_inicio','fecha_final','estado_orden','id_usuario','desc_usuario'])
		});


		/*ds_almacen_logico = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_almacenes/control/almacen_logico/ActionListarAlmacenLogicoFisEPM.php'}),
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'id_almacen_logico',
			totalRecords: 'TotalCount'
		}, ['id_almacen_logico','codigo','bloqueado','nombre','descripcion','estado_registro','fecha_reg','obsevaciones','id_almacen_ep','id_tipo_almacen'])
		});*/


		//ds_almacen=new Ext.data.Store({proxy:new Ext.data.HttpProxy({url:direccion+'../../../../sis_almacenes/control/almacen_ep/ActionListarAlmacenEp.php'}),reader:new Ext.data.XmlReader({record:'ROWS',id:'id_almacen',totalRecords:'TotalCount'}, ['id_almacen','desc_almacen','descripcion','id_financiador','id_regional','id_programa','id_proyecto','id_actividad'])});

		var ds_gestion_paradq= new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/parametro_adquisicion/ActionListarGestionParametroAdq.php'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_parametro_adquisicion',totalRecords: 'TotalCount'},['id_parametro_adquisicion','gestion','id_gestion'])
		});

		var ds_depto = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/depto_ep/ActionListarDepartamentoEP.php'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_depto_ep',totalRecords: 'TotalCount'},['id_depto_ep','id_depto','desc_depto','estado','desc_ep'])
		});

		
		
		//ago11
		
		var ds_presupuesto = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_presupuesto/control/presupuesto/ActionListarComboPresupuesto.php'}),
	reader:new Ext.data.XmlReader({record:'ROWS',id:'id_presupuesto',totalRecords: 'TotalCount'},['id_presupuesto','tipo_pres','estado_pres','id_unidad_organizacional','nombre_unidad','id_fina_regi_prog_proy_acti',
																																								'desc_epe','id_fuente_financiamiento','sigla','estado_gral','gestion_pres','id_parametro','id_gestion','desc_presupuesto',
																																								'nombre_financiador', 'nombre_regional', 'nombre_programa', 'nombre_proyecto', 'nombre_actividad',
																																								'id_categoria_prog','cod_categoria_prog',   'cp_cod_programa','cp_cod_proyecto','cp_cod_actividad',
																																								'cp_cod_organismo_fin','cp_cod_fuente_financiamiento','codigo_sisin'
																																								]),baseParams:{m_sw_rendicion:'si',sw_inv_gasto:'si'}
	});

var ds_correspondencia = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_flujo/control/correspondencia/ActionListarCorrespondencia.php?sol=1&vista=enviado&tipo=interna'}),
	reader:new Ext.data.XmlReader({record:'ROWS',id:'id_correspondencia',totalRecords: 'TotalCount'},['id_correspondencia','numero','desc_empleado','desc_documento','referencia'])
	});
	
	var ds_tipo_categoria_adq = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/tipo_categoria_adq/ActionListarTipoCategoriaAdq.php?tipo=sol'}),
			reader:new Ext.data.XmlReader({record:'ROWS',id:'id_tipo_categoria_adq',totalRecords: 'TotalCount'},['id_tipo_categoria_adq','fecha_reg','id_categoria_adq','estado_categoria','tipo','nombre','desc_categoria_adq','doc_respaldo'])
	});
	
	
	var ds_empleado_aprobador = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_kardex_personal/control/empleado/ActionListarEmpleado.php'}),
		reader:new Ext.data.XmlReader({record:'ROWS',id:'id_empleado',totalRecords: 'TotalCount'},['id_empleado','id_persona','desc_persona','codigo_empleado','nombre_tipo_documento','doc_id', 'email'])
		});
	
		//FUNCIONES RENDER

		function render_id_empleado_frppa_solicitante(value, p, record){ 
			if(record.get('tiene_presupuesto')=='0'){ 
				return '<b>'+record.data['solicitante']+'</b>' } 
			else{ 
				if(record.get('estado_vigente_solicitud')=='aprobado'){
				  return '<span style="color:green;font-size:8pt">' + record.data['solicitante'] + '</span>';	
				}else{
				
				return String.format('{0}', record.data['solicitante']);
				}
			}
		}
		var tpl_id_empleado_frppa_solicitante=new Ext.Template('<div class="search-item">','<b><i>{desc_persona}</i></b>','<br><FONT COLOR="#B5A642">{doc_id}</FONT>','</div>');

		function render_id_moneda(value, p, record){return String.format('{0}', record.data['desc_moneda']);}
		var tpl_id_moneda=new Ext.Template('<div class="search-item">','<b><i>{nombre}</i></b>','<br><FONT COLOR="#B5A642">{simbolo}</FONT>','</div>');

		function render_id_tipo_adq(value, p, record){ 
			if(record.get('tiene_presupuesto')=='0'){ 
				return '<b>'+record.data['desc_tipo_adq']+'</b>' 
			} else{ 
				if(record.get('estado_vigente_solicitud')=='aprobado'){
				  return '<span style="color:green;font-size:8pt">' +record.data['desc_tipo_adq'] + '</span>';	
				}else{
				  return String.format('{0}', record.data['desc_tipo_adq']);}
			}
		}
		var tpl_id_tipo_adq=new Ext.Template('<div class="search-item">','<b><i>{nombre}</i></b>','<br><FONT COLOR="#B5A642">{tipo_adq}</FONT>','</div>');


		function render_id_orden_trabajo(value, p, record){return String.format('{0}', record.data['desc_orden']);}
		var tpl_id_orden_trabajo=new Ext.Template('<div class="search-item">','<b><i>{desc_orden}</i></b>','<br><FONT COLOR="#B5A642">{motivo_orden}</FONT>','</div>');
		//function render_id_almacen_logico(value, p, record){return String.format('{0}', record.data['desc_almacen_logico']);}
		//var tpl_id_almacen_logico=new Ext.Template('<div class="search-item">','<b><i>{codigo}</i></b>','<br><FONT COLOR="#B5A642">{nombre}</FONT>','</div>');

		//function render_id_almacen(value, p, record){return String.format('{0}', record.data['desc_almacen'])}
		//var resultTplAlmacen = new Ext.Template('<div class="search-item">','<b>{desc_almacen}</b>','<br><FONT COLOR="#B5A642">{descripcion}</FONT>','</div>');

		function render_id_gestion_paradq(value, p, record){return String.format('{0}', record.data['gestion'])}
		var tpl_gestionParadq = new Ext.Template('<div class="search-item">','<b>{gestion}</b>','</div>');

		function render_id_depto(value, p, record){return String.format('{0}', record.data['desc_depto']);}
		var tpl_id_depto=new Ext.Template('<div class="search-item">','{desc_depto}','</div>');


		//8ago11
		function render_id_correspondencia(value, p, record){return String.format('{0}', record.data['correspondencia_asociada']);}
		var tpl_id_correspondencia=new Ext.Template('<div class="search-item">','<b>{desc_documento} -','{numero}</b>','<br><FONT COLOR="#B5A642">{desc_empleado}</FONT>','<br>{referencia}','</div>');
		
		
		function render_id_presupuesto(value, p, record){ 
			if(record.get('estado_regis')=='2'){ 
				return '<span style="color:red;font-size:8pt">' + record.data['desc_presupuesto']+ '</span>';
			}else { 
				return record.data['desc_presupuesto'];}
		}
		
		var tpl_id_presupuesto=new Ext.Template('<div class="search-item">',
		'<b>{nombre_unidad}</b>',
		'<br><b>Gesti�n: </b><FONT COLOR="#B5A642">{gestion_pres}</FONT>',
		'<br><b>Tipo Presupuesto: </b><FONT COLOR="#B50000">{tipo_pres}</FONT>',
		'<br><b>Fuente de Financiamiento: </b><FONT COLOR="#B5A642">{sigla}</FONT>',
		//'<br> <b>Unidad Organizacional: </b><FONT COLOR="#B5A642">{nombre_unidad}</FONT>',
		'<br>  <b>EP:  </b><FONT COLOR="#B5A642">{desc_epe}</FONT></b>',
		'<br>  <FONT COLOR="#B50000">{nombre_financiador}</FONT>',
		'<br>  <FONT COLOR="#B5A642">{nombre_regional}</FONT>',
		'<br>  <FONT COLOR="#B5A642">{nombre_programa}</FONT>',
		'<br>  <FONT COLOR="#B50000">{nombre_proyecto}</FONT>',
		'<br>  <FONT COLOR="#B5A642">{nombre_actividad}</FONT>',
		'<br><FONT COLOR="#B50000"><b>Cat. Programatica: </b>{cod_categoria_prog}</FONT>',  
		'<br><FONT COLOR="#B50000"><b>Identificador: </b>{id_presupuesto}</FONT>',  
		'</div>');

		
		function render_id_tipo_categoria_adq(val,cell,record,row,colum,store){
			if(record.get('reformulacion')=='1'){
				return '<span style="color:red;font-size:8pt">' + record.data['desc_tipo_categoria_adq']+ '</span>';
			}else {
				if(record.get('estado_vigente_solicitud')=='aprobado'){
				  return '<span style="color:green;font-size:8pt">' + record.data['desc_tipo_categoria_adq'] + '</span>';	
				}else{
					return record.data['desc_tipo_categoria_adq'];}
				}
		 }


		var tpl_id_tipo_categoria_adq=new Ext.Template('<div class="search-item">','<b><i>{desc_categoria_adq}</i></b>','<br><FONT COLOR="#B5A642">{tipo}</FONT>','</div>');

		
		function render_id_empleado_aprobador(value, p, record){
			if(record.get('tiene_presupuesto')=='0'){
				return '<b>'+record.data['encargado_aprobacion']+'</b>' } 
			else{
				if(record.get('estado_vigente_solicitud')=='aprobado'){
				  return '<span style="color:green;font-size:8pt">' + record.data['encargado_aprobacion'] + '</span>';	
				}else{
			  	  return String.format('{0}', record.data['encargado_aprobacion']);
				}
			}
		}
		
		
		var tpl_id_empleado_aprobador=new Ext.Template('<div class="search-item">','<b><i>{desc_persona}</i></b>','<br><FONT COLOR="#B5A642">{doc_id}</FONT>','</div>');
		
		
		function negrita(val,cell,record,row,colum,store){

			if(record.get('tiene_presupuesto')=='0'){
				return '<b>' + val + '</b>';
			}
			else
			{
				if(record.get('estado_vigente_solicitud')=='aprobado'){
				  return '<span style="color:green;font-size:8pt">' + val + '</span>';	
				}else{
					return val;					
				}
				
				
				
			}
		}


		
		/////////////////////////
		// Definici�n de datos //
		/////////////////////////

		// hidden id_solicitud_compra
		//en la posici�n 0 siempre esta la llave primaria

		Atributos[0]={
			validacion:{
				labelSeparator:'',
				name: 'id_solicitud_compra',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'id_solicitud_compra',
			id_grupo:2
		};

		
		Atributos[1]={//35
			validacion:{
				name:'numeracion_periodo',
				fieldLabel:'Periodo/N�Sol',
				allowBlank:true,
				maxLength:30,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:80,
				align:'right',
				width:'40%',
				disabled:false,
				grid_indice:1,
				renderer:negrita
			},
			tipo: 'TextField',
			form:false,
			filtro_0:true,
			filtro_1:true,
			filterColValue:'SOLADQ.periodo#SOLADQ.num_solicitud#SOLADQ.nro_solicitud_cadena',
			save_as:'numeracion_periodo',
			id_grupo:0
		};


		Atributos[2]={
			validacion:{
				name:'id_empleado_frppa_solicitante',
				fieldLabel:'Solicitante',
				allowBlank:false,
				emptyText:'Solicitante...',
				desc: 'solicitante', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_empleado_tpm_frppa_solicitante,
				valueField: 'id_empleado',
				displayField: 'desc_persona',
				queryParam: 'filterValue_0',
				filterCol:'EMPLEA.id_empleado#PERSON.nombre#PERSON.apellido_paterno#PERSON.apellido_materno',
				typeAhead:false,
				tpl:tpl_id_empleado_frppa_solicitante,
				forceSelection:true,
				mode:'remote',
				queryDelay:250,
				pageSize:100,
				minListWidth:'100%',
				grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_id_empleado_frppa_solicitante,
				grid_visible:true,
				grid_editable:false,
				width_grid:220,
				width:250,
				disabled:false,
				grid_indice:2
			},
			tipo:'ComboBox',
			form: true,
			filtro_0:true,
			filtro_1:true,
			filterColValue:'emp_solicitante.nombre#emp_solicitante.apellido_paterno#emp_solicitante.apellido_materno',
			save_as:'id_empleado_frppa_solicitante',
			id_grupo:0
		};
		filterCols_centro=new Array();
		filterValues_centro=new Array();
		filterCols_centro[0]='EMPLEA.id_empleado';
		filterValues_centro[0]='%';


		Atributos[3]={//22
			validacion:{
				name:'id_tipo_adq',
				fieldLabel:'Tipo de Adquisici�n',
				allowBlank:false,
				emptyText:'Tipo Adquisici�n...',
				desc: 'desc_tipo_adq', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_tipo_adq,
				valueField: 'id_tipo_adq',
				displayField: 'nombre',
				queryParam: 'filterValue_0',
				filterCol:'TIPADQ.nombre',
				typeAhead:true,
				tpl:tpl_id_tipo_adq,
				forceSelection:true,
				onSelect:function(record){

					getComponente('id_tipo_adq').setValue(record.data.id_tipo_adq);
					getComponente('tipo_adq').setValue(record.data.tipo_adq);

					
					getComponente('id_tipo_adq').collapse();
				},
				mode:'remote',
				queryDelay:250,
				pageSize:100,
				minListWidth:'80%',
				grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_id_tipo_adq,
				grid_visible:true,
				grid_editable:false,
				width_grid:120,
				width:250,
				disabled:true,
				grid_indice:3
			},
			tipo:'ComboBox',
			form: true,
			filtro_0:true,
			filtro_1:true,
			filterColValue:'tipo.nombre',
			save_as:'id_tipo_adq',
			id_grupo:1
		};


		// txt localidad
		Atributos[4]={
			validacion:{
				name:'localidad',
				fieldLabel:'Localidad',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				//store:ds_regional,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:100,
				width:250,
				disabled:true

			},
			tipo: 'TextField',
			form: true,
			filtro_0:false,
			defecto:usuario.lugar,
			filtro_1:false,
			filterColValue:'SOLADQ.localidad',
			save_as:'localidad',
			id_grupo:0
		};

		// txt id_moneda
		Atributos[5]={
			validacion:{
				name:'id_moneda',
				fieldLabel:'Moneda',
				allowBlank:false,
				emptyText:'Moneda...',
				desc: 'desc_moneda', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_moneda,
				valueField: 'id_moneda',
				displayField: 'nombre',
				queryParam: 'filterValue_0',
				filterCol:'MONEDA.nombre',
				typeAhead:true,
				tpl:tpl_id_moneda,
				forceSelection:true,
				mode:'remote',
				queryDelay:250,
				pageSize:100,
				minListWidth:'80%',
				grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_id_moneda,
				grid_visible:true,
				grid_editable:false,
				width_grid:90,
				width:'80%',
				disabled:false,
				grid_indice:5/**/
			},
			tipo:'ComboBox',
			form: true,
			//defecto:'Bolivianos',
			filtro_0:true,
			filtro_1:true,
			filterColValue:'MONEDA.nombre',
			save_as:'id_moneda',
			id_grupo:3
		};

		Atributos[6]={
			validacion:{
				name:'desc_unidad_organizacional',
				fieldLabel:'Centro Autorizador',
				allowBlank:true,
				maxLength:120,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:160,
				width:250,
				disabled:true,
				grid_indice:4
			},
			tipo:'TextField',
			form: true,
			filtro_0:true,
			filtro_1:true,
			filterColValue:'UNIORG.nombre_unidad',
			save_as:'desc_unidad_organizacional',
			id_grupo:0
		};

		// txt id_empleado_frppa_pre_aprobacion
		Atributos[7]={
			validacion:{
				name:'encargado_pre_aprobacion',
				fieldLabel:'Encargado Pre Aprobaci�n',
				allowBlank:true,
				maxLength:120,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:160,
				width:'80%',
				disabled:true

			},
			tipo:'TextField',
			form: false,
			filtro_0:false,
			filtro_1:false,
			filterColValue:'person3.nombre#person3.apellido_paterno#person3.apellido_materno',
			save_as:'empleado_frppa_pre_aprobacion',
			id_grupo:2
		};

		//txt id_empleado_frppa_aprobacion
		Atributos[8]={
			validacion:{
				name:'id_empleado_frppa_aprobacion',
				fieldLabel:'Aprobador',
				allowBlank:false,
				emptyText:'Aprobador...',
				desc: 'encargado_aprobacion', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_empleado_aprobador,
				valueField: 'id_empleado',
				displayField: 'desc_persona',
				queryParam: 'filterValue_0',
				filterCol:'EMPLEA.id_empleado#PERSON.nombre#PERSON.apellido_paterno#PERSON.apellido_materno',
				typeAhead:false,
				tpl:tpl_id_empleado_aprobador,
				forceSelection:true,
				mode:'remote',
				queryDelay:250,
				pageSize:100,
				minListWidth:'100%',
				grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_id_empleado_aprobador,
				grid_visible:true,
				grid_editable:false,
				width_grid:220,
				width:250,
				disabled:false,
				grid_indice:2
			},
			tipo:'ComboBox',
			form: true,
			filtro_0:true,
			filtro_1:true,
			filterColValue:'emp_solicitante.nombre#emp_solicitante.apellido_paterno#emp_solicitante.apellido_materno',
			save_as:'id_empleado_aprobacion',
			id_grupo:4
		};
		


		Atributos[9]={
			validacion:{
				name:'gfa',
				fieldLabel:'GFA',
				allowBlank:true,
				maxLength:160,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:160,
				width:'80%',
				disabled:true

			},
			tipo:'TextField',
			form: false,
			filtro_0:false,
			filtro_1:false,
			filterColValue:'PERSON5.nombre#PERSON5.apellido_paterno#PERSON5.apellido_materno',
			save_as:'empleado_frppa_gfa',
			id_grupo:2
		};

		// txt precio_total
		Atributos[10]={
			validacion:{
				name:'precio_total',
				fieldLabel:'Precio Total',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:true,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:70,
				width:'40%',
				align:'right',
				disabled:false

			},
			tipo: 'NumberField',
			form: false,
			defecto:0,
			filtro_0:false,
			filtro_1:false,
			filterColValue:'SOLADQ.precio_total',
			save_as:'precio_total',
			id_grupo:0
		};

		// txt observaciones
		Atributos[12]={//23
			validacion:{
				name:'observaciones',
				fieldLabel:'Justificaci�n/ Observaciones del Pedido',
				allowBlank:false,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:true,
				width_grid:100,
				width:'100%',
				disabled:false,
				grid_indice:7

			},
			tipo: 'TextArea',
			form: true,
			filtro_0:false,
			filtro_1:false,
			filterColValue:'SOLADQ.observaciones',
			save_as:'observaciones',
			id_grupo:3
		};

		Atributos[11]= {
			validacion: {
				name:'id_orden_trabajo',
				fieldLabel:'Orden de Trabajo (OT)',
				allowBlank:true,
				emptyText:'OT...',
				name: 'id_orden_trabajo',     //indica la columna del store principal ds del que proviane el id
				desc: 'desc_orden', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_orden_trabajo,
				valueField: 'id_orden_trabajo',
				displayField: 'desc_orden',
				queryParam: 'filterValue_0',
				filterCol:'ORDTRA.desc_orden#ORDTRA.motivo_orden',
				typeAhead:false,
				forceSelection:true,
				mode:'remote',
				queryDelay:250,
				pageSize:30,
				minListWidth:450,
				grow:true,
				width:'100%',
				tpl:tpl_id_orden_trabajo,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_id_orden_trabajo,
				grid_visible:false,
				grid_editable:false,
				grid_indice:21,
				width_grid:100 // ancho de columna en el gris
			},
			tipo:'ComboBox',
			filtro_0:false,
			filtro_1:false,
			filterColValue:'OT.desc_orden',
			defecto: '',
			save_as:'id_orden_trabajo',
			id_grupo:3
		};

		/*Atributos[13]={//37
			validacion:{
				fieldLabel:'Almacen F�sico',
				allowBlank:true,
				emptyText:'Almacen F�sico...',
				name:'id_almacen',
				desc:'desc_almacen',
				store:ds_almacen,
				valueField:'id_almacen',
				displayField:'desc_almacen',
				queryParam:'filterValue_0',
				filterCol:'ALMACE.nombre#ALMAEP.descripcion',
				typeAhead:true,
				forceSelection:true,
				tpl: resultTplAlmacen,
				mode:'remote',
				queryDelay:250,
				pageSize:100,
				minListWidth:450,
				grow:true,
				width:250,
				resizable:true,
				queryParam:'filterValue_0',
				onSelect:function(record){
					getComponente('id_almacen').setValue(record.data.id_almacen);
					getComponente('id_almacen_logico').setValue('');
					getComponente('id_almacen_logico').filterValues[0] =  record.data.id_almacen;
					//console.log(getComponente('id_unidad_organizacional').getValue());
					ds_almacen_logico.baseParams={
						id_uo:getComponente('id_unidad_organizacional').getValue(),
						id_financiador:record.data.id_financiador,
						id_regional:record.data.id_regional,
						id_programa:record.data.id_programa,
						id_proyecto:record.data.id_proyecto,
						id_actividad:record.data.id_actividad
					
					}
					
					ds_almacen_logico.modificado = true;
					getComponente('id_almacen_logico').modificado=true;
					getComponente('id_almacen_logico').enable();//almacen logico
					getComponente('id_almacen').collapse()
				},
				
				
				minChars:1,
				triggerAction:'all',
				disabled:true,
				renderer:render_id_almacen,
				grid_visible:false,
				grid_editable:false,
				width_grid:140
			},
			tipo:'ComboBox',
			filtro_0:false,
			form:true,
			filtro_1:false,
			filterColValue:'ALMACE.nombre#ALMAEP.descripcion',
			//defecto:'',
			save_as:'id_almacen',
			id_grupo:1
		};

		filterCols_almacen_logico=new Array();
		filterValues_almacen_logico=new Array();
		filterCols_almacen_logico[0]='ALMACE.id_almacen';
		filterValues_almacen_logico[0]='%';

		Atributos[14]= {//38
			validacion: {
				name:'id_almacen_logico',
				fieldLabel:'Almac�n L�gico',
				allowBlank:true,
				emptyText:'Id Almac�n L�gico...',
				name: 'id_almacen_logico', //indica la columna del store principal ds del que proviane el id
				desc: 'desc_almacen_logico', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_almacen_logico,
				valueField: 'id_almacen_logico',
				displayField: 'nombre',
				queryParam: 'filterValue_0',
				filterCol:'ALMLOG.codigo#ALMLOG.nombre#ALMLOG.descripcion',
				filterCols:filterCols_almacen_logico,
				filterValues:filterValues_almacen_logico,
				typeAhead:true,
				forceSelection:true,
				mode:'remote',
				queryDelay:250,
				pageSize:100,
				minListWidth:450,
				grow:true,
				width:250,
				tpl:tpl_id_almacen_logico,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				disabled:true,
				renderer:render_id_almacen_logico,
				grid_visible:true,
				grid_editable:false,
				grid_indice:9,
				width_grid:100 // ancho de columna en el gris
			},
			tipo:'ComboBox',
			filtro_0:true,
			filtro_1:true,
			form:true,
			filterColValue:'ALMLOG.codigo#ALMLOG.nombre',
			//defecto: '',
			save_as:'id_almacen_logico',
			id_grupo:1
		};

*/
		Atributos[13]={
			validacion:{
				name:'modalidad',
				fieldLabel:'Modalidad',
				allowBlank:true,
				typeAhead:true,
				loadMask:true,
				triggerAction:'all',
				//store:new Ext.data.SimpleStore({fields:['ID', 'valor'],data:Ext.solicitud_compra_combo.modalidad}),
				store:new Ext.data.SimpleStore({fields:['ID', 'valor'],data:[['Nacional','Nacional'],['Internacional','Internacional']]}),
				valueField:'ID',
				displayField:'valor',
				lazyRender:true,
				forceSelection:true,
				grid_visible:false,
				width_grid:75,
				grid_editable:false
			},
			tipo:'ComboBox',
			filtro_0:false,
			filtro_1:false,
			defecto:'Nacional',
			filterColValue:'SOLADQ.modalidad',
			save_as:'modalidad',
			id_grupo:2
			//		id_grupo:3
		};




		Atributos[14]={
			validacion:{
				name:'tipo_adjudicacion',
				fieldLabel:'Adjudicacion',
				allowBlank:true,
				typeAhead:true,
				loadMask:true,
				triggerAction:'all',
				//store:new Ext.data.SimpleStore({fields:['ID', 'valor'],data:Ext.solicitud_compra_combo.tipo_adjudicacion}),
				store:new Ext.data.SimpleStore({fields:['ID', 'valor'],data:[['total','total'],['lotes','lotes'],['item','item']]}),
				valueField:'ID',
				displayField:'valor',
				lazyRender:true,
				forceSelection:true,
				width_grid:75,
				grid_visible:true,
				grid_indice:10,
				grid_editable:false
			},
			tipo:'ComboBox',
			defecto:'total',
			filtro_0:true,
			filtro_1:true,
			filterColValue:'SOLADQ.tipo_adjudicacion',
			save_as:'tipo_adjudicacion',
			id_grupo:1
		};


		Atributos[15]={
			validacion:{
				name:'id_parametro_adquisicion',
				fieldLabel:'Gestion',
				allowBlank:false,
				emptyText:'Gestion...',
				desc: 'gestion', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_gestion_paradq,
				valueField: 'id_parametro_adquisicion',
				displayField: 'gestion',
				queryParam: 'filterValue_0',
				typeAhead:true,
				tpl:tpl_gestionParadq,
				forceSelection:true,
				mode:'remote',
				queryDelay:250,
				pageSize:100,
				minListWidth:'80%',
				grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_id_gestion_paradq,
				grid_visible:false,
				grid_editable:false,
				width_grid:45,
				width:'80%',
				disabled:false,
				grid_indice:25/**/
			},
			tipo:'ComboBox',
			form: true,
			//defecto:'Bolivianos',
			filtro_0:true,
			filtro_1:true,
			filterColValue:'SOLADQ.gestion',
			save_as:'id_parametro_adquisicion',
			id_grupo:1
		};


		// txt fecha_reg
		Atributos[16]= {
			validacion:{
				name:'fecha_reg',
				fieldLabel:'Fecha',
				allowBlank:true,
				format: 'd/m/Y', //formato para validacion
				minValue: '01/01/1900',
				disabledDaysText: 'D�a no v�lido',
				grid_visible:true,
				grid_editable:false,
				renderer: formatDate,
				width:150,
				disabled:false,
				width_grid:65,

			},
			form:true,
			tipo:'DateField',
			filtro_0:true,
			filtro_1:true,
			filterColValue:'SOLADQ.fecha_reg',
			dateFormat:'m-d-Y',
			defecto:'',
			save_as:'fecha_reg',
			id_grupo:1
		};



		// txt num_solicitud
		Atributos[17]={
			validacion:{
				name:'num_solicitud',
				fieldLabel:'N� Solicitud',
				allowBlank:true,
				maxLength:50,
				minLength:0,
				selectOnFocus:true,
				allowDecimals:false,
				decimalPrecision:2,//para numeros float
				allowNegative:false,
				minValue:0,
				vtype:'texto',
				align:'right',
				grid_visible:false,
				grid_editable:false,
				width_grid:70,
				width:'30%',
				disabled:false

			},
			tipo: 'NumberField',
			form: true,
			filtro_0:false,
			filtro_1:false,
			filterColValue:'SOLADQ.num_solicitud',
			save_as:'num_solicitud',
			id_grupo:2
		};


		// txt id_presupuesto
	Atributos[18]={
			validacion:{
			name:'id_presupuesto',
			fieldLabel:'Presupuesto',
			allowBlank:false,			
			//emptyText:'Presupuesto...',
			desc: 'desc_presupuesto', //indica la columna del store principal ds del que proviane la descripcion
			store:ds_presupuesto,
			valueField: 'id_presupuesto',
			displayField: 'desc_presupuesto',
			queryParam: 'filterValue_0',
			filterCol:'presup.desc_presupuesto#presup.id_presupuesto#CATPRO.cod_categoria_prog',
			typeAhead:false,
			tpl:tpl_id_presupuesto,
			forceSelection:true,
			mode:'remote',
			queryDelay:360,
			pageSize:10,
			minListWidth:400,
			grow:true,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
			triggerAction:'all',
			editable:true,
			renderer:render_id_presupuesto,
			onSelect:function(record){
				
				getComponente('localidad').setValue(record.data.nombre_regional);
				getComponente('id_presupuesto').setValue(record.data.id_presupuesto);
				getComponente('id_unidad_organizacional').setValue(record.data.id_unidad_organizacional);
			
				
				getComponente('id_depto').setValue('');
				
				getComponente('id_depto').enable();
					   Ext.Ajax.request({
    						url:direccion+"../../../../sis_parametros/control/depto_ep/ActionListarDepartamentoEP.php?id_ep="+record.data.id_fina_regi_prog_proy_acti+"&subsistema=compro",
    						method:'GET',
    						success:cargar_depto_compra,
    						failure:Cm_conexionFailure,
    						timeout:100000000//TIEMPO DE ESPERA PARA DAR FALLO
					   });
				
				ds_depto.baseParams={id_ep:record.data.id_fina_regi_prog_proy_acti,subsistema:'compro'};
				if(record.data.tipo_pres=='Inversion' && record.data.obliga_ot=='si'){
					getComponente('id_orden_trabajo').allowBlank=false;

				}else{
					getComponente('id_orden_trabajo').allowBlank=true;
				}
				
				getComponente('id_tipo_adq').enable();
				
				getComponente('id_presupuesto').collapse()
			},
			
			
			grid_visible:true,
			grid_editable:false,
			width_grid:400,
			width:250,
			disabled:true,
			grid_indice:3		
		},
		tipo:'ComboBox',
		form: true,
		filtro_0:true,
		filterColValue:'CUDOC.desc_presupuesto',
		save_as:'id_presupuesto',
		id_grupo:0		
	};


		// txt id_empleado_frppa_transcriptor
		Atributos[19]={
			validacion:{
				labelSeparator:'',
				name: 'id_usuario_transcriptor',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			filtro_1:false,
			defecto:usuario.id_usuario,
			save_as:'id_usuario_transcriptor',
			id_grupo:2
		};


		// txt estado_vigente_solicitud
		Atributos[20]={
			validacion:{
				name:'estado_vigente_solicitud',
				fieldLabel:'Estado Sol.',
				allowBlank:true,
				maxLength:30,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:false,
				width_grid:80,
				width:'40%',
				disabled:false,
				grid_indice:6
			},
			tipo: 'TextField',
			form: true,
			filtro_0:false,
			filtro_1:false,
			filterColValue:'SOLADQ.estado_vigente_solicitud',
			save_as:'estado_vigente_solicitud',
			id_grupo:2
		};

		// txt estado_reg
		Atributos[21]={
			validacion:{
				name:'estado_reg',
				fieldLabel:'Estado Reg',
				allowBlank:true,
				maxLength:30,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:false,
				grid_editable:false,
				width_grid:100,
				width:'40%',
				disabled:false

			},
			tipo: 'TextField',
			form: true,
			filtro_0:false,
			filtro_1:false,
			filterColValue:'SOLADQ.estado_reg',
			save_as:'estado_reg',
			id_grupo:2
		};

		// txt hora_reg
		Atributos[22]={
			validacion:{
				name:'hora_reg',
				fieldLabel:'Hora',
				allowBlank:true,
				maxLength:8,
				minLength:0,
				selectOnFocus:true,
				vtype:'time',
				grid_visible:true,
				grid_editable:false,
				width_grid:72,
				width:150,
				disabled:false

			},
			tipo:'TextField',
			form:true,
			filtro_0:true,
			filtro_1:true,
			filterColValue:'SOLADQ.hora_reg',
			save_as:'hora_reg',
			id_grupo:2
		};



		Atributos[23]={
			validacion:{
			name:'id_tipo_categoria_adq',
			fieldLabel:'Categoria',
			allowBlank:false,			
			emptyText:'Categoria...',
			desc: 'desc_tipo_categoria_adq', //indica la columna del store principal ds del que proviane la descripcion
			store:ds_tipo_categoria_adq,
			valueField: 'id_tipo_categoria_adq',
			displayField: 'desc_categoria_adq',
			queryParam: 'filterValue_0',
			filterCol:'CATADQ.nombre',
			typeAhead:true,
			tpl:tpl_id_tipo_categoria_adq,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:100,
			minListWidth:'80%',
			grow:true,
			resizable:true,
			queryParam:'filterValue_0',
			minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
			triggerAction:'all',
			editable:true,
			renderer:render_id_tipo_categoria_adq,
			grid_visible:true,
			grid_editable:false,
			width_grid:90,
			width:'80%',
			disabled:false,
			grid_indice:7/**/
		},
		tipo:'ComboBox',
		form: true,
		//defecto:'Bolivianos',
		filtro_0:true,
		filtro_1:true,
		filterColValue:'CATADQ.nombre',
		save_as:'id_tipo_categoria_adq',
		id_grupo:4
	};



		// txt periodo
		Atributos[24]={//24
			validacion:{
				name:'periodo',
				fieldLabel:'Periodo',
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
				width_grid:70,
				align:'right',
				width:'30%',
				disabled:false

			},
			tipo: 'NumberField',
			form: false,
			filtro_0:false,
			filtro_1:false,
			filterColValue:'SOLADQ.periodo',
			save_as:'periodo',
			id_grupo:1
		};


		/*// txt id_correspondencia
		Atributos[27]={//27
			validacion:{
				name:'id_correspondencia',
				fieldLabel:'Doc. Respaldo',
				allowBlank:true,
				emptyText:'Doc. Respaldo...',
				desc: 'desc_doc_respaldo', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_correspondencia,
				valueField: 'id_correspondencia',
				displayField: 'desc_correspondencia',
				queryParam: 'filterValue_0',
				filterCol:'PERSON.nombre#PERSON.apellido_paterno#PERSON.apellido_materno',
				typeAhead:true,
				tpl:tpl_id_correspondencia,
				forceSelection:true,
				mode:'remote',
				queryDelay:250,
				pageSize:100,
				minListWidth:'80%',
				grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				renderer:render_id_correspondencia,
				grid_visible:false,
				grid_editable:false,
				width_grid:120,
				width:'80%',
				disabled:false

			},
			tipo:'ComboBox',
			form: true,
			filtro_0:false,
			filtro_1:false,
			defecto:'',
			filterColValue:'PERSON5.nombre#PERSON5.apellido_paterno#PERSON5.apellido_materno',
			save_as:'id_correspondencia',
			id_grupo:4
		};*/


		Atributos[26]={//28
			validacion:{
				name:'tipo_adq',
				fieldLabel:'Tipo',
				grid_visible:false,
				grid_editable:false,
				disabled:true,
				width:'100%',
				width_grid:150
			},
			tipo:'Field',
			filtro_0:false,
			filtro_1:false,
			save_as:'tipo',
			id_grupo:2
		};


		Atributos[27]={//
			validacion:{
				name:'observaciones_estado',
				fieldLabel:'Observaciones Estado',
				allowBlank:true,
				maxLength:300,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:true,
				width_grid:100,
				width:'100%',
				disabled:false,
				grid_indice:8
			},
			tipo: 'TextArea',
			form: false,
			filtro_0:false,
			filtro_1:false,
			filterColValue:'ESTPRO.observaciones',
			save_as:'observaciones_estado',
			id_grupo:3
		};

/*


		Atributos[30]={//34
			validacion:{
				name:'id_empresa',
				labelSeparator:'',
				grid_visible:false,
				inputType:'hidden',
				grid_editable:false,
				disabled:true

			},
			tipo:'Field',
			filtro_0:false,
			filtro_1:false,
			save_as:'id_empresa',
			defecto:usuario.id_empresa,
			id_grupo:3

		};

*/
		Atributos[28]={//36
			validacion:{
				labelSeparator:'',
				name: 'id_moneda_base',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			filtro_1:false,
			save_as:'id_moneda_base',
			id_grupo:0
		};


		/*Atributos[31]={//39
			validacion:{
				labelSeparator:'',
				name: 'id_empleado_frppa_pre_aprobacion',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			filtro_1:false,
			save_as:'id_empleado_frppa_pre_aprobacion',
			id_grupo:3
		};*/


		/*Atributos[32]={//40
			validacion:{
				labelSeparator:'',
				name: 'id_empleado_frppa_aprobacion',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			filtro_1:false,
			save_as:'id_empleado_frppa_aprobacion',
			id_grupo:3
		};*/


		/*Atributos[32]={//41
			validacion:{
				labelSeparator:'',
				name: 'id_empleado_frppa_gfa',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			filtro_1:false,
			save_as:'id_empleado_frppa_gfa',
			id_grupo:3
		};*/

		Atributos[29]={//42
			validacion:{
				labelSeparator:'',
				name: 'es_modificacion',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			filtro_1:false,
			save_as:'es_modificacion',
			id_grupo:2
		};

		Atributos[30]={//43
			validacion:{
				labelSeparator:'',
				name: 'id_unidad_organizacional',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			filtro_1:false,
			save_as:'id_unidad_organizacional',
			id_grupo:2
		};

		// txt fecha_venc
		Atributos[31]= {
			validacion:{
				name:'fecha_venc',
				fieldLabel:'Fecha Venc.',
				allowBlank:true,
				format: 'd/m/Y', //formato para validacion
				minValue: '01/01/1900',
				disabledDaysText: 'D�a no v�lido',
				grid_visible:false,
				grid_editable:false,
				renderer: formatDate,
				width_grid:85,
				disabled:false

			},
			form:true,
			tipo:'DateField',
			filtro_0:false,
			filtro_1:false,
			filterColValue:'SOLADQ.fecha_venc',
			dateFormat:'m-d-Y',
			defecto:'',
			save_as:'fecha_venc',
			id_grupo:2
		};

		Atributos[32]={
			validacion:{
				labelSeparator:'',
				name: 'id_empleado',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'id_emp',
			id_grupo:2
		};

		Atributos[33]={
			validacion:{
				labelSeparator:'',
				name: 'id_uo_gerencia',
				inputType:'hidden',
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'id_uo_gerencia',
			id_grupo:2
		};

		// txt id_solicitud_compra_ant
		/*Atributos[39]={//20
			validacion:{
				name:'id_solicitud_compra_ant',
				fieldLabel:'N�Sol. Anterior',
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
				width:'30%',
				disabled:true

			},
			tipo: 'NumberField',
			form: false,
			filtro_0:false,
			filtro_1:false,
			filterColValue:'SOLADQ.id_solicitud_compra_ant',
			save_as:'id_solicitud_compra_ant',
			id_grupo:2
		};*/

		Atributos[34]={
			validacion:{
				labelSeparator:'',
				name: 'gestion',
				fieldLabel:'Gesti�n',
				inputType:'hidden',
				grid_visible:true,
				grid_editable:false,
				width_grid:45,
			},
			tipo: 'Field',
			filtro_0:false,
			save_as:'gestion',
			id_grupo:2
		};


		Atributos[35]={
			validacion:{
				name:'id_depto',
				fieldLabel:'Unidad Responsable de Compra',
				allowBlank:false,
				emptyText:'Responsable de Compra...',
				desc: 'desc_depto', //indica la columna del store principal ds del que proviane la descripcion
				store:ds_depto,
				valueField: 'id_depto',
				displayField: 'desc_depto',
				queryParam: 'filterValue_0',
				filterCol:'DEPTO.id_depto#DEPTO.nombre_depto',
				typeAhead:false,
				tpl:tpl_id_depto,
				forceSelection:true,
				mode:'remote',
				queryDelay:250,
				pageSize:100,
				minListWidth:'80%',
				grow:true,
				resizable:true,
				queryParam:'filterValue_0',
				minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
				editable:true,
				renderer:render_id_depto,
				grid_visible:true,
				grid_editable:false,
				width_grid:220,
				width:250,
				disabled:false,
				grid_indice:5
			},
			tipo:'ComboBox',
			form: true,
			filtro_0:false,
			filtro_1:false,
			filterColValue:'DEP.nombre',
			save_as:'id_depto',
			id_grupo:0
		};




		Atributos[36]={//44
			validacion:{
				name:'proveedores_propuestos',
				fieldLabel:'Proveedores Propuestos',
				allowBlank:true,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:true,
				width_grid:100,
				width:'100%',
				disabled:false,
				grid_indice:20

			},
			tipo: 'TextArea',
			form: true,
			filtro_0:false,
			filtro_1:false,
			filterColValue:'SOLADQ.proveedores_propuestos',
			save_as:'proveedores_propuestos',
			id_grupo:3
		};

		Atributos[37]={//45
			validacion:{
				name:'comite_calificacion',
				fieldLabel:'Comit� de Calificaci�n',
				allowBlank:true,
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:true,
				width_grid:100,
				width:'100%',
				disabled:false,
				grid_indice:21

			},
			tipo: 'TextArea',
			form: true,
			filtro_0:false,
			filtro_1:false,
			filterColValue:'SOLADQ.comite_calificacion',
			save_as:'comite_calificacion',
			id_grupo:4
		};


		Atributos[38]={//46
			validacion:{
				name:'comite_recepcion',
				fieldLabel:'Comit� de Recepci�n',
				allowBlank:false, //12oct2015 a peticion de Adolfo Perez
				minLength:0,
				selectOnFocus:true,
				vtype:'texto',
				grid_visible:true,
				grid_editable:true,
				width_grid:100,
				width:'100%',
				disabled:false,
				grid_indice:20

			},
			tipo: 'TextArea',
			form: true,
			filtro_0:false,
			filtro_1:false,
			filterColValue:'SOLADQ.comite_recepcion',
			save_as:'comite_recepcion',
			id_grupo:3
		};
		

	
	Atributos[39]={
			validacion:{
				name:'avance',
				fieldLabel:'Cta Documentada',
				allowBlank:true,
				typeAhead:true,
				loadMask:true,
				triggerAction:'all',
				store:new Ext.data.SimpleStore({fields:['ID', 'valor'],data:[['si','si'],['no','no']]}),
				valueField:'ID',
				displayField:'valor',
				lazyRender:true,
				forceSelection:true,
				grid_visible:true,
				width:250,
				width_grid:95,
				align:'center',
				disabled:true,
				grid_editable:false
			},
			tipo:'ComboBox',
			defecto:'no',
			filtro_0:true,
			filterColValue:'SOLADQ.avance',
			form:true
			
			
		};
		
		Atributos[25]={
			validacion:{
				name:'id_correspondencia',
				fieldLabel:'Correspondencia Asociada',
				allowBlank:true,
				store:ds_correspondencia,	
				maestroValField:'correspondencia_asociada',
				valueField: 'id_correspondencia',
				//displayField: 'desc_persona',				
				queryParam: 'filterValue_0',
				filterCol:'CORRE.numero#EMPLE.nombre_completo#CORRE.referencia#DOCUME.documento',
				typeAhead:false,
				tpl:tpl_id_correspondencia,				
				defValor:function(val,record){					
					var text = record['numero']+' -> '+record['referencia'];
					return text;				
				},							
				mode:'remote',
				queryDelay:250,
				pageSize:100,
				minListWidth:'100%',
				grow:true,
				resizable:true,
				grid_visible:true,
				grid_editable:false,
				renderer:render_id_correspondencia,
				queryParam:'filterValue_0',
				minChars:3, ///caracteres m�nimos requeridos para iniciar la busqueda
				triggerAction:'all',
			    width:'85%',
			    width_grid:150
			},
			tipo:'ComboMultiple2',
			form: true,
			filtro_0:false,
			filtro_1:false
			,id_grupo:4
			
	};
		
		Atributos[40]={
				validacion:{
					labelSeparator:'',
					name: 'correo',
					fieldLabel:'Correo',
					inputType:'hidden',
					grid_visible:true,
					grid_editable:false,
					width_grid:45,
				},
				tipo: 'Field',
				filtro_0:false,
				save_as:'correo',
				id_grupo:2
			};

		Atributos[41]={
				validacion:{
					labelSeparator:'',
					name: 'usuario_fin',
					fieldLabel:'Usuario Fin',
					inputType:'hidden',
					grid_visible:true,
					grid_editable:false,
					width_grid:45,
				},
				tipo: 'Field',
				filtro_0:false,
				save_as:'usuario_fin',
				id_grupo:2
			};

		
			Atributos[42]={
				validacion:{
					labelSeparator:'',
					name: 'tipo_adq_fin',
					fieldLabel:'tipo_adq_fin',
					inputType:'hidden',
					grid_visible:true,
					grid_editable:false,
					width_grid:45,
				},
				tipo: 'Field',
				filtro_0:false,
				save_as:'tipo_adq_fin',
				id_grupo:2
			};

		Atributos[43]={
				validacion:{
					labelSeparator:'',
					name: 'nro_fin',
					fieldLabel:'nro_fin',
					inputType:'hidden',
					grid_visible:true,
					grid_editable:false,
					width_grid:45,
				},
				tipo: 'Field',
				filtro_0:false,
				save_as:'nro_fin',
				id_grupo:2
			};



		Atributos[44]={
				validacion:{
					labelSeparator:'',
					name: 'monto_fin',
					fieldLabel:'monto_fin',
					inputType:'hidden',
					grid_visible:true,
					grid_editable:false,
					width_grid:45,
				},
				tipo: 'Field',
				filtro_0:false,
				save_as:'monto_fin',
				id_grupo:2 
			};

		Atributos[45]={
				validacion:{
					labelSeparator:'',
					name: 'solicitante_fin',
					fieldLabel:'solicitante_fin',
					inputType:'hidden',
					grid_visible:true,
					grid_editable:false,
					width_grid:45,
				},
				tipo: 'Field',
				filtro_0:false,
				save_as:'solicitante_fin',
				id_grupo:2 
			};
		
		//////////////////////////////////////////////////////////////
		// ----------            FUNCIONES RENDER    ---------------//
		//////////////////////////////////////////////////////////////
		function formatDate(value){return value?value.dateFormat('d/m/Y'):''};

		//---------- INICIAMOS LAYOUT DETALLE
		var config={titulo_maestro:'Solicitud de Compra',grid_maestro:'grid-'+idContenedor};
		var layout_solicitud_compra=new DocsLayoutMaestroEP(idContenedor);
		layout_solicitud_compra.init(config);

		////////////////////////
		// INICIAMOS HERENCIA //
		////////////////////////


		this.pagina=Pagina;
		//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
		this.pagina(paramConfig,Atributos,ds,layout_solicitud_compra,idContenedor);
		var getComponente=this.getComponente;
		var getSelectionModel=this.getSelectionModel;
		var CM_btnNew=this.btnNew;
		var CM_btnEdit=this.btnEdit;
		var CM_ocultarGrupo=this.ocultarGrupo;
		var CM_mostrarGrupo=this.mostrarGrupo;
		var CM_ocultarComponente=this.ocultarComponente;
		var CM_mostrarComponente= this.mostrarComponente;
		var Cm_conexionFailure=this.conexionFailure;
		//var ClaseMadre_conexionFailure=this.conexionFailure;
		var Cm_btnActualizar=this.btnActualizar;
		var getGrid=this.getGrid;
		var getDialog= this.getDialog;
		var enableSelect=this.EnableSelect;
		var cm_success=this.saveSuccess;
		///////////////////////////////////
		// DEFINICI�N DE LA BARRA DE MEN�//
		///////////////////////////////////

		var paramMenu={
			guardar:{crear:true,separador:false},
			nuevo:{crear:true,separador:true},
			editar:{crear:true,separador:false},
			eliminar:{crear:true,separador:false},
			actualizar:{crear:true,separador:false}
		};


		//////////////////////////////////////////////////////////////////////////////
		//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
		//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
		//////////////////////////////////////////////////////////////////////////////

		//datos necesarios para el filtro
		var paramFunciones={
			btnEliminar:{url:direccion+'../../../control/solicitud_compra/ActionEliminarSolicitudCompra.php'},
			Save:{url:direccion+'../../../control/solicitud_compra/ActionGuardarSolicitudCompra.php'},
			ConfirmSave:{url:direccion+'../../../control/solicitud_compra/ActionGuardarSolicitudCompra.php'},
			Formulario:{html_apply:'dlgInfo-'+idContenedor,height:'55%',columnas:['47%','47%'],
			grupos:[
			{
				tituloGrupo:'Origen Solicitud',
				columna:0,
				id_grupo:1
			},{
				tituloGrupo:'Solicitud',
				columna:0,
				id_grupo:0
			},{
				tituloGrupo:'Oculto',
				columna:1,
				id_grupo:3
			},
			{
				tituloGrupo:'Detalle Solicitud',
				columna:1,
				id_grupo:2
			},
			{
				tituloGrupo:'Doc. Respaldo',
				columna:1,
				id_grupo:4
			}
			],
			width:'75%',minWidth:350,minHeight:400,closable:true,titulo:'Solicitud de Compra'}};
			//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//

			function btn_solicitud_compra_det(){
				var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
				if(NumSelect!=0){

					var SelectionsRecord=sm.getSelected();

					var data='m_id_solicitud_compra='+SelectionsRecord.data.id_solicitud_compra;
					data=data+'&m_localidad='+SelectionsRecord.data.localidad;
					data=data+'&m_num_solicitud='+SelectionsRecord.data.num_solicitud;
					data=data+'&m_solicitante='+SelectionsRecord.data.solicitante;
					data=data+'&m_id_tipo_adq='+SelectionsRecord.data.id_tipo_adq;
					data=data+'&m_tipo_adq='+SelectionsRecord.data.tipo_adq;
					data=data+'&m_simbolo='+SelectionsRecord.data.simbolo;
					data=data+'&m_fecha_reg='+SelectionsRecord.data.fecha_reg.dateFormat('d/m/Y');
					data=data+'&m_tipo_cambio='+SelectionsRecord.data.tipo_cambio;
					data=data+'&m_id_moneda='+SelectionsRecord.data.id_moneda;
					data=data+'&m_id_moneda_base='+SelectionsRecord.data.id_moneda_base;
					data=data+'&m_avance='+SelectionsRecord.data.avance;
					data=data+'&mi_gestion='+SelectionsRecord.data.gestion;
					data=data+'&es_item='+SelectionsRecord.data.es_item;
					

					var ParamVentana={Ventana:{width:'90%',height:'70%'}}
					if(SelectionsRecord.data.estado_vigente_solicitud=='borrador'){
						//if(SelectionsRecord.data.tipo_adq=='Bien'){
							//layout_solicitud_compra.loadWindows(direccion+'../../../../sis_adquisiciones/vista/solicitud_compra_det/solicitud_compra_item_det.php?'+data,'Detalle de Solicitud',ParamVentana);
						//}else{
							layout_solicitud_compra.loadWindows(direccion+'../../../../sis_adquisiciones/vista/solicitud_compra_det/solicitud_compra_serv_det.php?'+data,'Detalle de Solicitud',ParamVentana);
						//}

						layout_solicitud_compra.getVentana().on('resize',function(){
							layout_solicitud_compra.getLayout().layout();
						})
					}else{
						Ext.MessageBox.alert('Estado', 'Solo Solicitudes en estado borrador pueden continuar accediendo a detalle');
					}
				}
				else
				{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
				}
			}


			function btn_reporte_solicitud_compra(){
				var sm=getSelectionModel();
				var filas=ds.getModifiedRecords();
				var cont=filas.length;
				var NumSelect=sm.getCount();
				if(NumSelect!=0){

					var SelectionsRecord=sm.getSelected();
					var data='m_id_solicitud_compra='+SelectionsRecord.data.id_solicitud_compra;

					if(SelectionsRecord.data.tipo_adq=='Bien'){

						window.open(direccion+'../../../control/solicitud_compra/reporte/ActionPDFSolicitud.php?'+data)
					}else{

						window.open(direccion+'../../../control/solicitud_compra/reporte/ActionPDFSolicitud.php?'+data)
					}
				}
				else{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
				}
			}
			
			
			
			
			
			//Para manejo de eventos
			function iniciarEventosFormularios(){
				//getComponente('id_ep').reset();
				ds_tipo_adq.baseParams={
					con_servicios:'si'
				}

				//para iniciar eventos en el formulario
				var txt_num_solicitud=getComponente('num_solicitud');//
				var txt_fecha=getComponente('fecha_reg');
				var txt_hora=getComponente('hora_reg');
				var txt_periodo=getComponente('periodo');//
				var gestion_adq=getComponente('id_parametro_adquisicion');//
				var txt_localidad=getComponente('localidad');
				var cmb_ep=getComponente('id_presupuesto');
				//cmbUO=getComponente('id_unidad_organizacional');
				var cmbTranscriptor=getComponente('id_usuario_transcriptor');//
				var cmbSolicitante=getComponente('id_empleado_frppa_solicitante');
				//var cmbEPA=getComponente('id_empleado_frppa_pre_aprobacion');//
				//var cmbEA=getComponente('id_empleado_frppa_aprobacion');//
				//var cmbGFA=getComponente('id_empleado_frppa_gfa');//
				var cmbCorrespondencia=getComponente('id_correspondencia');//
				var cmbMoneda=getComponente('id_moneda');

				var txt_id_tipo_adquisicion=getComponente('id_tipo_adq');
				var txt_fecha_ini=getComponente('fecha_venc');
				var txt_id_moneda_base=getComponente('id_moneda_base');

				//var combo_almacen=getComponente('id_almacen');
				//var combo_almacen_logico=getComponente('id_almacen_logico');
				var txt_empleado=getComponente('id_empleado');
                var txt_avance=getComponente('avance');
				var cmb_categoria=getComponente('id_tipo_categoria_adq');
                
                
				
				var onSolicitanteSelect=function(e){

					

					var id= cmbSolicitante.getValue();
					
					if(id>0){
						    txt_emp=id;
							//cmb_ep.enable();
							txt_empleado.setValue(id);
							
							Ext.Ajax.request({
								url:direccion+"../../../../sis_kardex_personal/control/unidad_organizacional/ActionListarCentro.php?id_empleado="+id,
		
								method:'GET',
								success:cargar_centro,
								failure:Cm_conexionFailure,
								timeout:100000000//TIEMPO DE ESPERA PARA DAR FALLO
							});
					}
				};
				cmbSolicitante.on('select',onSolicitanteSelect);



				function cargar_centro(resp){
					Ext.MessageBox.hide();
					if(resp.responseXML != undefined && resp.responseXML != null && resp.responseXML.documentElement != null && resp.responseXML.documentElement != undefined){
						var root = resp.responseXML.documentElement;
						if((root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue)>0){
                           
                            
							getComponente('desc_unidad_organizacional').setValue(root.getElementsByTagName('centro')[0].firstChild.nodeValue);
							getComponente('id_unidad_organizacional').setValue(root.getElementsByTagName('id_uo_ppto')[0].firstChild.nodeValue);
							getComponente('id_uo_gerencia').setValue(root.getElementsByTagName('id_unidad_organizacional_aprueba')[0].firstChild.nodeValue);
							
							getComponente('id_presupuesto').reset();
							getComponente('id_presupuesto').enable();
							getComponente('id_depto').reset();
							getComponente('id_depto').disable();
						//	getComponente('id_almacen').reset();
							
							ds_presupuesto.modificado=true;
							ds_presupuesto.baseParams={
								m_nombre_vista:'rendicion_viaticos1',
								m_id_uo:getComponente('id_unidad_organizacional').getValue(),
								m_id_solicitante:getComponente('id_empleado_frppa_solicitante').getValue(),
								id_gestion:root.getElementsByTagName('id_gestion')[0].firstChild.nodeValue
							}
							getComponente('id_presupuesto').modificado=true;
							
						}else{
							alert("El solicitante no pertenece a ninguna Unidad Organizacional, asociada a la EP, es necesaria dicha asignacion para continuar con su solicitud");
							
							getComponente('desc_unidad_organizacional').setValue('');
							getComponente('id_unidad_organizacional').setValue('');
							getComponente('id_uo_gerencia').setValue('');
							getComponente('id_depto').setValue('');
							
							//getComponente('localidad').reset();
						}
					}
				}

				var onMonedaSelect=function(e){
					get_tipo_cambio(e.value);
					//getMonedaPrincipal();
				}

				cmbMoneda.on('select',onMonedaSelect);
				cmbMoneda.on('change',onMonedaSelect);

				txt_fecha.on('change',onMonedaSelect);
				txt_fecha.on('select',onMonedaSelect);


				var onGestion=function(c,r,i){
					if(parseFloat(r.data.gestion)>0){
						get_fecha_adq(r.data.gestion);
						ds_presupuesto.modificado=true;
						ds_presupuesto.baseParams={
						m_nombre_vista:'rendicion_viaticos1',
						m_id_uo:getComponente('id_unidad_organizacional').getValue(),
						m_id_solicitante:getComponente('id_empleado_frppa_solicitante').getValue(),
						id_gestion:r.data.id_gestion
					}
				ds_presupuesto.modificado=true;
						
						
					}
				}
				gestion_adq.on('select',onGestion);
				//gestion_adq.on('change',onGestion);
				
				
				
				
				var onCategoria=function(c,r,i){
					if(r.data.doc_respaldo=='si'){
						CM_mostrarComponente(getComponente('comite_calificacion'));
						getComponente('comite_calificacion').allowBlank=false;
						getComponente('id_correspondencia').allowBlank=false;
					}else{
						CM_ocultarComponente(getComponente('comite_calificacion'));
						getComponente('id_correspondencia').allowBlank=true;
						getComponente('id_correspondencia').reset();
						getComponente('comite_calificacion').allowBlank=true;
						getComponente('comite_calificacion').reset();
					}
				}
				
				cmb_categoria.on ('select',onCategoria);
				

			}


			
			
				function cargar_depto_compra(resp){
						Ext.MessageBox.hide();
						if(resp.responseXML != undefined && resp.responseXML != null && resp.responseXML.documentElement != null && resp.responseXML.documentElement != undefined){
							var root = resp.responseXML.documentElement;
							if((root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue)>0){

								getComponente('id_depto').setValue(root.getElementsByTagName('id_depto')[0].firstChild.nodeValue);
								getComponente('id_depto').setRawValue(root.getElementsByTagName('desc_depto')[0].firstChild.nodeValue);
								getComponente('id_depto').modificado=true;
							}else{
								getComponente('id_depto').reset();
							}
						}
					}

			//funci�n para terminar la orden de ingreso
			function btn_fin_ped(){
				CM_ocultarGrupo('Origen Solicitud');
				var sm=getSelectionModel();
				var NumSelect=sm.getCount();
				if(NumSelect!=0){

					var SelectionsRecord=sm.getSelected();

					if(SelectionsRecord.data.estado_vigente_solicitud=='borrador'){

						var data=SelectionsRecord.data.id_solicitud_compra;
						
						Ext.Ajax.request({
								url:direccion+"../../../control/solicitud_compra/ActionObtenerTotalSolicitudCompra.php?id_solicitud_compra="+data,
								method:'GET',
								success:cant_total,
								failure:Cm_conexionFailure,
								timeout:100000//TIEMPO DE ESPERA PARA DAR FALLO
							})
					
					}

				}

				else{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.')
				}
			}
			function btn_correccion(){
				data='';
				var sm=getSelectionModel();var filas=ds.getModifiedRecords();var cont=filas.length;var NumSelect=sm.getCount();
				if(NumSelect!=0){
					var SelectionsRecord=sm.getSelected();
					if(SelectionsRecord.data.estado_vigente_solicitud!='aprobado'){

					var SelectionsRecord=sm.getSelected();
					Ext.MessageBox.show({
						title: 'Observaciones de Correcci�n',
						msg: 'Ingrese observaciones para correcci�n:',
						width:300,
						buttons: Ext.MessageBox.OK,
						multiline: true,
						fn: getObservacionesC

					});
					data='id_solicitud_compra='+SelectionsRecord.data.id_solicitud_compra;
					data=data+'&operacion=correccion';


				  }
					else 
					{
						Ext.MessageBox.alert('Estado', 'La solicitud esta aprobada, Para su reversi�n consulte con el Encargado de Bienes y Servicios');
					}
				}	
				else
				{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
				}
			}
			function getObservacionesC(btn,text){
				if(btn!='cancel'){
					observaciones=text;

					data=data+'&observaciones='+observaciones;
					data=data+"&filtro=ESTCOM.nombre like 'pendiente_pre_aprobacion'";

					Ext.Ajax.request({
						url:direccion+"../../../control/seguimiento_solicitud/ActionGuardarSeguimientoSolicitud.php?"+data,
						method:'GET',
						success:esteSuccessC,
						failure:Cm_conexionFailure,
						timeout:100000000
					});}
			}
			function esteSuccessC(resp){
				if(resp.responseXML&&resp.responseXML.documentElement){

					Cm_btnActualizar();
				}
				else{
					Cm_conexionFailure();
				}
			}
             function cant_total(resp){
             	
             	var sm=getSelectionModel();
				var NumSelect=sm.getCount();
				var SelectionsRecord=sm.getSelected();
				var data=SelectionsRecord.data.id_solicitud_compra;
							var root = resp.responseXML.documentElement;
							    CM_mostrarGrupo('Origen Solicitud');
								CM_mostrarGrupo('Doc. Respaldo');
								CM_ocultarGrupo('Oculto');
								CM_ocultarGrupo('Solicitud');
								CM_ocultarGrupo('Detalle Solicitud');
								
							
							if((root.getElementsByTagName('doc_respaldo')[0].firstChild.nodeValue)!='si'){
								 /*Ext.MessageBox.show({
								title: 'Espere por favor...',
								msg:"<div><img src='../../../lib/ext-yui/resources/images/default/grid/loading.gif'/> Guardando...</div>",
								width:150,
								height:200,
								closable:false
							});

							Ext.Ajax.request({
								url:direccion+"../../../control/solicitud_compra/ActionGuardarSolicitudCompraFin.php?hidden_id_solicitud_compra_0="+data,
								method:'GET',
								success:terminado,
								failure:Cm_conexionFailure,
								timeout:100000//TIEMPO DE ESPERA PARA DAR FALLO
							})
							}else{*/
								 
								 getComponente('id_correspondencia').setValue('');
								 getComponente('id_empleado_frppa_aprobacion').allowBlank=false;
								 getComponente('id_correspondencia').reset();
								 getComponente('id_correspondencia').allowBlank=true;
								 getComponente('comite_calificacion').setValue('');
								 getComponente('comite_calificacion').reset();
								 getComponente('comite_calificacion').allowBlank=true;
								// CM_ocultarComponente(getComponente('id_correspondencia'));
								 CM_ocultarComponente(getComponente('comite_calificacion'));
							}else{
								
								 if(root.getElementsByTagName('correspondencia')[0].firstChild.nodeValue=='si'){
								 	getComponente('id_correspondencia').allowBlank=false;
								 }else{
								 	getComponente('id_correspondencia').allowBlank=true;
								 }
								 
								 getComponente('comite_calificacion').allowBlank=false;
								 CM_mostrarComponente(getComponente('id_correspondencia'));
								 CM_mostrarComponente(getComponente('comite_calificacion'));
							}
								
							if(root.getElementsByTagName('cambiar_aprobador')[0].firstChild.nodeValue=='si'){
								CM_mostrarComponente(getComponente('id_empleado_frppa_aprobacion'));
								getComponente('id_empleado_frppa_aprobacion').setValue('');
								ds_empleado_aprobador.modificado=true;
								ds_empleado_aprobador.baseParams={
									autorizacion:'si',
									tipo:'solicitud_compra',
									id_presupuesto:SelectionsRecord.data.id_presupuesto,
									id_empleado:SelectionsRecord.data.id_empleado,
									monto_total:root.getElementsByTagName('monto_total')[0].firstChild.nodeValue,
									diesel:root.getElementsByTagName('diesel')[0].firstChild.nodeValue
								}
								ds_empleado_aprobador.modificado=true;
								getComponente('id_empleado_frppa_aprobacion').modificado=true;
								
							}else{
								CM_ocultarComponente(getComponente('id_empleado_frppa_aprobacion'));
							}
								
								getComponente('id_empleado_frppa_solicitante').disable();
								getComponente('id_depto').disable();
								getComponente('id_presupuesto').disable();
								//getComponente('avance').disable();  
								getComponente('es_modificacion').setValue('');
								getComponente('id_tipo_categoria_adq').setValue(root.getElementsByTagName('id_tipo_categoria')[0].firstChild.nodeValue);
								getComponente('id_tipo_categoria_adq').setRawValue(root.getElementsByTagName('nombre_categoria')[0].firstChild.nodeValue);

								CM_mostrarComponente(getComponente('comite_recepcion'));
								CM_btnEdit();
								
								getComponente('correo').setValue(root.getElementsByTagName('correo')[0].firstChild.nodeValue);
								getComponente('usuario_fin').setValue(usuario.nombre_empleado +' '+usuario.paterno_empleado+' ' +usuario.materno_empleado);
								getComponente('monto_fin').setValue(root.getElementsByTagName('monto_total')[0].firstChild.nodeValue+' '+SelectionsRecord.data.desc_moneda);
								getComponente('nro_fin').setValue(SelectionsRecord.data.nro_solicitud_cadena+'-'+SelectionsRecord.data.gestion);
								getComponente('tipo_adq_fin').setValue(SelectionsRecord.data.desc_tipo_adq);
								getComponente('solicitante_fin').setValue(SelectionsRecord.data.solicitante);
								
							
			}
						  
			
			
			function terminado(resp){
				Ext.MessageBox.hide();
				getComponente('es_modificacion').setValue('');


				if(resp.responseXML != undefined && resp.responseXML != null && resp.responseXML.documentElement != null && resp.responseXML.documentElement != undefined){
					var root = resp.responseXML.documentElement;
					if((root.getElementsByTagName('error')[0].firstChild.nodeValue)=='false'){
						ds.load({
							params:{
								start:0,
								limit: paramConfig.TamanoPagina,
								CantFiltros:paramConfig.CantFiltros,
								id_empresa:usuario.id_empresa
							}
						});
					}
				}
			}



			function get_fecha_adq(gestion){
				
				Ext.Ajax.request({
					url:direccion+"../../../../sis_adquisiciones/control/parametro_adquisicion/ActionObtenerGestionAdq.php?m_gestion="+gestion,
					method:'GET',
					success:cargar_fecha_adq,
					failure:Cm_conexionFailure,
					timeout:100000000//TIEMPO DE ESPERA PARA DAR FALLO
				});
			}

			function cargar_fecha_adq(resp){
				//Ext.MessageBox.hide();
				if(resp.responseXML != undefined && resp.responseXML != null && resp.responseXML.documentElement != null && resp.responseXML.documentElement != undefined){
					var root = resp.responseXML.documentElement;
					if((root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue)>0){
						
						if(getComponente('id_solicitud_compra').getValue()>0){
							getComponente('fecha_reg').setValue(root.getElementsByTagName('fecha')[0].firstChild.nodeValue);
							if(root.getElementsByTagName('cargo')[0].firstChild.nodeValue=='administrador_compro'){
								getComponente('fecha_reg').enable();
								getComponente('id_parametro_adquisicion').enable();
							}else{
								getComponente('fecha_reg').disable();
								getComponente('id_parametro_adquisicion').disable();
							}
						}else{
							getComponente('fecha_reg').setValue(root.getElementsByTagName('fecha_ini')[0].firstChild.nodeValue);
							//getComponente('fecha_reg').minValue=getComponente('fecha_reg').getValue();
							getComponente('fecha_reg').setValue(root.getElementsByTagName('fecha')[0].firstChild.nodeValue);
							getComponente('id_moneda').setValue(root.getElementsByTagName('id_moneda')[0].firstChild.nodeValue);
							getComponente('id_moneda').setRawValue(root.getElementsByTagName('nombre_moneda')[0].firstChild.nodeValue);
							getComponente('id_parametro_adquisicion').setValue(root.getElementsByTagName('id_parametro_adq')[0].firstChild.nodeValue);
							getComponente('id_parametro_adquisicion').setRawValue(root.getElementsByTagName('gestion')[0].firstChild.nodeValue);

							getComponente('gestion').setValue(root.getElementsByTagName('gestion')[0].firstChild.nodeValue);

							//getComponente('hora_reg').setValue(root.getElementsByTagName('hora')[0].firstChild.nodeValue);
							getComponente('id_moneda_base').setValue(root.getElementsByTagName('id_moneda')[0].firstChild.nodeValue);
						}
						
						if(root.getElementsByTagName('cargo')[0].firstChild.nodeValue=='administrador_compro'){
							getComponente('fecha_reg').enable();
						}else{
							getComponente('fecha_reg').disable();
						}
						
						
					}else{
						alert("No existe una gestion activa para Adquisiciones para "+getComponente('gestion').getValue());

					}
				}
			}


			function get_tipo_cambio(moneda){
				Ext.Ajax.request({
					url:direccion+"../../../../sis_parametros/control/tipo_cambio/ActionListarTipoCambio.php?fecha_solicitud="+getComponente('fecha_reg').getValue().dateFormat('m-d-Y')+'&id_moneda='+moneda,
					method:'GET',
					success:cargar_tipo_cambio,
					failure:Cm_conexionFailure,
					timeout:100000//TIEMPO DE ESPERA PARA DAR FALLO
				});
			}

			function cargar_tipo_cambio(resp){
				//Ext.MessageBox.hide();
				if(resp.responseXML != undefined && resp.responseXML != null && resp.responseXML.documentElement != null && resp.responseXML.documentElement != undefined){
					var root = resp.responseXML.documentElement;

					if(root.getElementsByTagName('TotalCount')[0].firstChild.nodeValue<1 &&(getComponente('id_moneda').getValue()!=getComponente('id_moneda_base').getValue())){
						getComponente('id_moneda').markInvalid("No existe tipo de cambio para la fecha seleccionada");

						getDialog().buttons[0].hide();
						getDialog().buttons[1].hide();
					}
					else{
						getComponente('id_moneda').clearInvalid();
						getDialog().buttons[0].show();
						getDialog().buttons[1].show();
					}
				}
			}
			
			this.btnNew=function(){
				CM_ocultarGrupo('Oculto');
				CM_ocultarGrupo('Doc. Respaldo');
				CM_mostrarGrupo('Origen Solicitud');
				CM_mostrarGrupo('Solicitud');
				CM_mostrarGrupo('Detalle Solicitud');
				//getComponente('id_ep').setValue('');
				getComponente('id_empleado_frppa_solicitante').setValue('');
				getComponente('id_unidad_organizacional').markInvalid('campo nulo');
				getComponente('id_correspondencia').allowBlank=true;
				//getComponente('id_ep').disable();
				getComponente('id_depto').disable();
				getComponente('id_unidad_organizacional').disable();
				getComponente('id_unidad_organizacional').setValue('');
				getComponente('id_orden_trabajo').allowBlank=true;
				
				
				getComponente('localidad').setValue(usuario.lugar);
				getComponente('id_parametro_adquisicion').enable();
				getComponente('fecha_reg').disable();
				
				getComponente('id_empleado_frppa_solicitante').enable();
				getComponente('id_empleado_frppa_aprobacion').allowBlank=true;
				getComponente('id_tipo_categoria_adq').allowBlank=true;
				getComponente('id_depto').enable();
				//getComponente('avance').enable();
					
				getComponente('id_correspondencia').allowBlank=true;
				getComponente('comite_calificacion').allowBlank=true;
				CM_mostrarComponente(getComponente('comite_recepcion'));
				//get_fecha_bd();
				get_fecha_adq(0);
				CM_btnNew();
			}



			this.btnEdit=function(){
				var sm=getSelectionModel();
				var filas=ds.getModifiedRecords();
				var cont=filas.length;
				var NumSelect=sm.getCount();
				if(NumSelect!=0){
					var SelectionsRecord=sm.getSelected();
					if(SelectionsRecord.data.estado_vigente_solicitud=='borrador'){
						getComponente('id_parametro_adquisicion').disable();
						getComponente('id_depto').enable();
						CM_ocultarGrupo('Oculto');
						CM_ocultarGrupo('Estructura Programatica');
						CM_ocultarGrupo('Doc. Respaldo');
						CM_mostrarGrupo('Origen Solicitud');
						CM_mostrarGrupo('Solicitud');
						CM_mostrarGrupo('Detalle Solicitud');
						getComponente('fecha_reg').disable();
						getComponente('id_presupuesto').enable();
						
						
						getComponente('id_empleado_frppa_solicitante').enable();
						getComponente('id_depto').enable();
						//getComponente('avance').enable();
						ds_presupuesto.baseParams={
								m_nombre_vista:'rendicion_viaticos1',
								m_id_uo:SelectionsRecord.data.id_unidad_organizacional,
								m_id_solicitante:SelectionsRecord.data.id_empleado_frppa_solicitante,
								id_gestion:SelectionsRecord.data.id_gestion
							}
						ds_presupuesto.modificado=true;
						
						//get_fecha_adq(0);
						
						getComponente('id_tipo_adq').enable();
						getComponente('id_correspondencia').allowBlank=true;
						getComponente('comite_calificacion').allowBlank=true;
						getComponente('id_tipo_categoria_adq').allowBlank=true;

						
						getComponente('es_modificacion').setValue('modificacion');
						getComponente('id_empleado_frppa_aprobacion').allowBlank=true;
						getComponente('id_tipo_categoria_adq').allowBlank=true;
						

						/*ds_almacen.baseParams={
							id_fina_regi_prog_proy_acti:SelectionsRecord.data.id_frppa
						}
						ds_almacen.modificado=true;
						
						//ds_ep.baseParams={id_ep:SelectionsRecord.data.id_frppa};
						ds_almacen_logico.baseParams={
							id_uo:SelectionsRecord.data.id_uo_gerencia,
							id_financiador:SelectionsRecord.data.id_financiador,
							id_regional:SelectionsRecord.data.id_regional,
							id_programa:SelectionsRecord.data.id_programa,
							id_proyecto:SelectionsRecord.data.id_proyecto,
							id_actividad:SelectionsRecord.data.id_actividad
						}
						ds_almacen_logico.modificado=true;*/
						CM_mostrarComponente(getComponente('comite_recepcion'));
						
						CM_btnEdit();
					}else{
						Ext.MessageBox.alert('Estado','Solo solicitudes en estado borrador');
					}
				}else{
					Ext.MessageBox.alert('Estado','Antes debe seleccionar un item');
				}
			}

			function btn_verificar(){
				var sm=getSelectionModel();
				var filas=ds.getModifiedRecords();
				var cont=filas.length;
				var NumSelect=sm.getCount();
				if(NumSelect!=0){

					var SelectionsRecord=sm.getSelected();
					var data='m_id_solicitud_compra='+SelectionsRecord.data.id_solicitud_compra;

					if(SelectionsRecord.data.estado_vigente_solicitud=='aprobado'){
						data=data+'&tipo_repo=1';
					}
					window.open(direccion+'../../../control/solicitud_compra/reporte/ActionPDFSolicitudVerNuevo.php?'+data)

				}
				else
				{
					Ext.MessageBox.alert('Estado', 'Antes debe seleccionar un item.');
				}
			}

		this.EnableSelect=function(x,z,y){
			enable(x,z,y)
		}
			


			//para que los hijos puedan ajustarse al tama�o
			this.getLayout=function(){return layout_solicitud_compra.getLayout()};
			this.Init(); //iniciamos la clase madre
			this.InitBarraMenu(paramMenu);
			//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
			this.InitFunciones(paramFunciones);
			//para agregar botones


			this.AdicionarBoton('../../../lib/imagenes/detalle.png','Detalle de Solicitud',btn_solicitud_compra_det,true,'solicitud_compra_det','');
			this.AdicionarBoton('../../../lib/imagenes/print.gif','Vista Previa Solicitud',btn_verificar,true,'ver_presol','Verificar');
			this.AdicionarBoton('../../../lib/imagenes/book_next.png','Finalizar el Pedido',btn_fin_ped,true,'fin_ped','');
			this.AdicionarBoton('../../../lib/imagenes/det.ico','Solicitar Correcci�n',btn_correccion,true,'pedir_correccion','Correcci�n');
			var CM_getBoton=this.getBoton;

			function  enable(sel,row,selected){
			var record=selected.data;
			
			if(selected&&record!=-1){
				if (record.estado_vigente_solicitud=='borrador'){
					CM_getBoton('solicitud_compra_det-'+idContenedor).enable();
					CM_getBoton('pedir_correccion-'+idContenedor).disable();
					CM_getBoton('fin_ped-'+idContenedor).enable();
					CM_getBoton('eliminar-'+idContenedor).enable();
					CM_getBoton('editar-'+idContenedor).enable();
					CM_getBoton('guardar-'+idContenedor).enable();
					
				}else{
					CM_getBoton('solicitud_compra_det-'+idContenedor).disable();
					
					CM_getBoton('fin_ped-'+idContenedor).disable();
					CM_getBoton('eliminar-'+idContenedor).disable();
					CM_getBoton('editar-'+idContenedor).disable();
					CM_getBoton('guardar-'+idContenedor).disable();
					CM_getBoton('pedir_correccion-'+idContenedor).enable();
				}
								
			}
			enableSelect(sel,row,selected);
		}
			
			
			
			this.iniciaFormulario();
			iniciarEventosFormularios();
ds.load({
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				id_empresa:usuario.id_empresa
			}
		});
			
			layout_solicitud_compra.getLayout().addListener('layout',this.onResize);//aregla la forma en que se ve el grid dentro del layout


			ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}