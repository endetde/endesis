/**
* Nombre de archivo:	    depreciacion2_comprobante.js
* Prop�sito:				generador de la vista emergente
* Fecha de Creaci�n:		10/01/2013
* Autor:					Elmer Velasquez
*/

function pagina_depreciacion_comprobante(idContenedor,direccion,paramConfig,maestro,idContenedorPadre){

	var Atributos=new Array,sw=0; 
	var componentes=new Array;

	var TodasRegionales=false;
	
	/////////////////
	//  DATA STORE //
	/////////////////
	var ds = new Ext.data.Store({
		// asigna url de donde se cargaran los datos
		proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/activo_fijo_comprobante/ActionListarRegionalesActivoFijoDepreciacion.php?m_id_grupo_depreciacion='+maestro.id_grupo_depreciacion+'&txt_mes_fin='+maestro.mes_fin+'&txt_ano_fin='+maestro.ano_fin}),
		
		// aqui se define la estructura del XML
		reader: new Ext.data.XmlReader({
			record: 'ROWS',
			id: 'codigo_regional',
			totalRecords: 'TotalCount'
		}, [
		// define el mapeo de XML a las etiqutas (campos)
		'codigo_regional',
		'estado_registro',
		'ids_comprobantes',
		
		]),

		remoteSort: true // metodo de ordenacion remoto
	});
	
	// DEFINICI�N DATOS DEL MAESTRO

	function negrita(value){return '<span style="color:red;font-size:10pt"><b>'+value+'</b></span>';}
	function italic(value){return '<i>'+value+'</i>';}
	var div_grid_detalle=Ext.DomHelper.append(idContenedor,{tag:'div',id:'grid_detalle-'+idContenedor});
	Ext.DomHelper.applyStyles(div_grid_detalle,'background-color:#FFFFFF');
	var data_maestro=[['Id Grupo Depreciacion','   '+maestro.id_grupo_depreciacion+'   '],['Departamento','   '+maestro.desc_depto]];
	

	//DATA STORE COMBOS

	/////DATA STORE COMBOS////////////
	
	//FUNCIONES RENDER
	function renderEmpleado(value, p, record){return String.format('{0}', record.data['nombre_completo']);}
	function render_deposito(value, p, record){return String.format('{0}', record.data['nombre_deposito']);}
	
	/////////////////////////
	// Definici�n de datos //
	/////////////////////////

	//en la posici�n 0 siempre esta la llave primaria

		// id_activo_fijo_empleado
	    Atributos[0] = {
			validacion:{
				fieldLabel: 'Id Comprobante',
				name: 'ids_comprobantes',
				width_grid:100,
				grid_visible:true, // se muestra en el grid
				grid_editable:false
	
			},
			tipo: 'TextField',
			form:false,
			filtro_0:true,
			filterColValue:'vkp.apellido_paterno'
		};
		
		Atributos[1]={
				validacion:{
				labelSeparator:'',
				name: 'codigo_regional',
				inputType:'hidden',
				grid_visible:false, // se muestra en el grid
				grid_editable:false //es editable en el grid
			},
			tipo: 'Field',
			save_as:'hidden_codigo_regional',
			filtro_0:false
		};
		
		// nombre_completo
		Atributos[2] = {
			validacion:{
				fieldLabel: 'Regional',
				name: 'codigo_regional',
				width_grid:250,
				grid_visible:true, // se muestra en el grid
				grid_editable:false
	
			},
			tipo: 'TextField',
			form:false,
			filtro_0:true,
			filterColValue:'vkp.apellido_paterno'
		};
		
		// nombre_deposito
		Atributos[3] = {
			validacion:{
				fieldLabel: 'Estado',
				name: 'estado_registro',
				width_grid:180,
				grid_visible:true, // se muestra en el grid
				grid_editable:false
	
			},
			tipo: 'TextField',
			form:false,
			filtro_0:true,
			filterColValue:'dep.nombre_deposito'
		};

		/*Atributos[4]={
				validacion:{
				labelSeparator:'',
				name: 'id_depreciacion_comprobante',
				inputType:'hidden',
				grid_visible:false, // se muestra en el grid
				grid_editable:false //es editable en el grid
			},
			tipo: 'Field',
			save_as:'hidden_codigo_regional',
			filtro_0:false
		};*/

	//----------- FUNCIONES RENDER
	function formatDate(value){return value?value.dateFormat('d/m/Y'):''};

	//---------- INICIAMOS LAYOUT DETALLE
	var config={titulo_maestro:'Parametros Generales',titulo_detalle:'Regionales',grid_maestro:'grid-'+idContenedor};
	var layout = new DocsLayoutDetalle(idContenedor,idContenedorPadre);
	layout.init(config);


	//---------- INICIAMOS HERENCIA
	this.pagina = Pagina;
	this.pagina(paramConfig,Atributos,ds,layout,idContenedor);
	var ClaseMadre_getComponente=this.getComponente;
	var getSelectionModel=this.getSelectionModel;
	var EstehtmlMaestro=this.htmlMaestro;
	var ClaseMadre_btnNew=this.btnNew;
	var CM_btnEdit=this.btnEdit;
	var CM_btnAct=this.btnActualizar;
	var CM_mostrarComp=this.mostrarComponente;
	var CM_ocultarComp=this.ocultarComponente;
	var CM_conexionFailure=this.conexionFailure;
	var CM_grid=this.getGrid;
	var CM_ocultarGrupo=this.ocultarGrupo;
	var CM_mostrarGrupo=this.mostrarGrupo;
	var ClaseMadre_conexionFailure=this.conexionFailure;
	var cm_Save = this.Save;
	//DEFINICI�N DE LA BARRA DE MEN�
	
	var paramMenu={
		actualizar:{crear:true,separador:false}
	};
		
	//DEFINICI�N DE FUNCIONES
	Ext.DomHelper.overwrite('grid_detalle-'+idContenedor,EstehtmlMaestro(data_maestro));
	
	var paramFunciones={
		btnEliminar:{
			url:direccion+"../../../control/activo_fijo_empleado/ActionEliminaActivoFijoEmpleado.php"
		},
		Save:{
			//url:direccion+"../../../control/activo_fijo_comprobante/ActionRegistrarComprobantesContables.php",
			url:obtenerDireccion,timeout:100000000
		},
		ConfirmSave:{
			url:direccion+"../../../control/activo_fijo_empleado/ActionSaveActivoFijoEmpleado.php"
		},
		Formulario:{html_apply:'dlgInfo-'+idContenedor,
		width:450,
			height:250,
			minWidth:150,
			minHeight:200,
			closable:true,
			columnas:[400],
			grupos:[
			{
				tituloGrupo:'Datos generales',
				columna:0,
				id_grupo:0
			}]
		}};

	//-------------- Sobrecarga de funciones --------------------//

	this.reload=function(params)
	{
		var datos=Ext.urlDecode(decodeURIComponent(params));

		maestro.id_grupo_depreciacion=datos.maestro_id_grupo_depreciacion;
		maestro.desc_depto=datos.maestro_desc_depto;
		maestro.mes_fin=datos.maestro_mes_fin;
		maestro.ano_fin=datos.maestro_ano_fin;
		

		ds.lastOptions={
			params:{
				start:0,
				limit: paramConfig.TamanoPagina,
				CantFiltros:paramConfig.CantFiltros,
				m_id_grupo_depreciacion: maestro.id_grupo_depreciacion,
				txt_mes_fin : maestro.mes_fin,
				txt_ano_fin : maestro.ano_fin,
				maestro_codigo_regional: maestro.codigo_regional
			}
		};
		this.btnActualizar();
		data_maestro=[['Id Grupo Depreciacion','   '+maestro.id_grupo_depreciacion+'   '],['Departamento','   '+maestro.desc_depto]];
		Ext.DomHelper.overwrite('grid_detalle-'+idContenedor,EstehtmlMaestro(data_maestro));
		Atributos[1].defecto=maestro.codigo_regional;
		
		this.InitFunciones(paramFunciones);
	};
	
	function btn_generar()
	{
		var sm=getSelectionModel();
		var filas = ds.getModifiedRecords();
		var cont = filas.length;
		var NumSelect=sm.getCount();
		if(NumSelect!=0)
		{
			var SelectionsRecord  = sm.getSelected(); //es el primer registro selecionado
		
			
			var id_grupo_depreciacion = maestro.id_grupo_depreciacion;
			var fecha_hasta = maestro.mes_fin+"/01/"+maestro.ano_fin;
			var codigo_regional =  SelectionsRecord.data.codigo_regional;
		
			TodasRegionales = false;
			
			if(SelectionsRecord.data.estado_registro == 'pendiente')
				cm_Save();				
			else
				Ext.MessageBox.alert('Estado','La regional seleccionada ya tiene comprobantes registrados !!!');
		}
		else
		{
			Ext.MessageBox.alert('Estado','Antes debe seleccionar un item');
		}
			
	}
	
	function btn_respaldo()        
	{
		var sm=getSelectionModel();
		var filas = ds.getModifiedRecords();
		var cont = filas.length;
		var NumSelect=sm.getCount();
		if(NumSelect!=0)
		{
			var SelectionsRecord  = sm.getSelected(); //es el primer registro selecionado
			var id_grupo_depreciacion = maestro.id_grupo_depreciacion;
			var fecha_hasta = maestro.mes_fin+"/01/"+maestro.ano_fin;
			var codigo_regional =  SelectionsRecord.data.codigo_regional;
			
			var data="txt_mes_fin="+maestro.mes_fin;
			data = data + "&txt_ano_fin="+maestro.ano_fin;
			data = data + "&txt_desc_depto="+maestro.desc_depto;
			data = data + "&txt_desc_usuario="+maestro.desc_usuario;
			data = data + "&txt_fecha_reg="+maestro.fecha_reg;
			data = data + "&txt_proyecto="+maestro.proyecto;
			
			if(SelectionsRecord.data.estado_registro == 'pendiente')
			//desaparecer el boton
				//CM_getBoton('respaldo-'+idContenedor).disable(); 
				Ext.MessageBox.alert('Estado','Se debe Generar comprobantes del proceso de depreciacion antes de tener el respaldo');
			else 
			{
				if(SelectionsRecord.data.estado_registro == 'registrado')
					{
						window.open(direccion+'../../../../sis_activos_fijos/control/_reportes/activo_fijo_depreciacion/ActionPDFRespaldoDepreciacion.php?id_grupo_depreciacion='+id_grupo_depreciacion+"&fecha_hasta="+fecha_hasta+"&codigo_regional="+codigo_regional+"&"+data);
					}
			}
		}
		else
		{
			Ext.MessageBox.alert('Estado','Antes debe seleccionar un registro');
		}
	}
	
	function obtenerDireccion(){
		
		//Ext.MessageBox.alert('Estado','Se genero correctamente' );
		
		var sm=getSelectionModel();
		var SelectionsRecord  = sm.getSelected(); //es el primer registro selecionado
		
		var id_grupo_dep = maestro.id_grupo_depreciacion;
		var fecha_h = maestro.mes_fin+"/01/"+maestro.ano_fin;
		
		var codigo_r = '%';
		if(!TodasRegionales)
			codigo_r =  SelectionsRecord.data.codigo_regional;
		
		var resp = direccion+"../../../control/activo_fijo_comprobante/ActionRegistrarComprobantesContables.php?id_grupo_depreciacion="+id_grupo_dep+"&fecha_hasta="+fecha_h+"&codigo_regional="+codigo_r;
		
		return resp;
	}
	
	
	
	function btn_generar_todo()
	{
		var sm=getSelectionModel();
		TodasRegionales = true;
		cm_Save();
		
		//Ext.MessageBox.alert('Estado',ds.getCount());
			
	}

	//Para manejo de eventos
	function iniciarEventosFormularios()
	{
		h_txt_fecha_reg = ClaseMadre_getComponente('fecha_reg');		
	}
	
	function get_fecha_bd()
	{
				
		Ext.Ajax.request({
					url:'../../../lib/lib_control/action/ActionObtenerFechaBD.php',
					method:'POST',
					success:cargar_fecha_bd,
					failure:ClaseMadre_conexionFailure,
					timeout:100000//TIEMPO DE ESPERA PARA DAR FALLO
				});
	}

	//Carga la fecha obtenida
	function cargar_fecha_bd(resp)
	{
		if(resp.responseXML != undefined && resp.responseXML != null && resp.responseXML.documentElement != null && resp.responseXML.documentElement != undefined)
		{
			var root = resp.responseXML.documentElement;
			if(h_txt_fecha_reg.getValue()=="")
			{
				h_txt_fecha_reg.setValue(root.getElementsByTagName('fecha')[0].firstChild.nodeValue);
			}
		}
	}
	
	this.btnNew = function()
	{
		
		ClaseMadre_btnNew()
		get_fecha_bd()
	}
	//para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout.getLayout()};
	//para el manejo de hijos

	this.Init(); //iniciamos la clase madre
	this.InitBarraMenu(paramMenu);
	this.InitFunciones(paramFunciones);
	var CM_getBoton=this.getBoton;
	this.AdicionarBoton("../../../lib/imagenes/bricks.png",'<b>Generar<b>',btn_generar,true,'generar','Generar');
	this.AdicionarBoton("../../../lib/imagenes/print.gif",'<b>Respaldo<b>',btn_respaldo,true,'respaldo','Respaldo'); 
	
	//carga datos XML
	ds.load({
		params:{
			start:0,
			limit: paramConfig.TamanoPagina,
			CantFiltros:paramConfig.CantFiltros,
			m_id_grupo_depreciacion: maestro.id_grupo_depreciacion,
			txt_mes_fin : maestro.mes_fin,
			txt_ano_fin : maestro.ano_fin
		}
	});


	this.iniciaFormulario();
	iniciarEventosFormularios();
	layout.getLayout().addListener('layout',this.onResize);
	layout.getVentana(idContenedor).on('resize',function(){layout.getLayout().layout()})
			
	
}

