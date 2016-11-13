function documento_iva(idContenedor,direccion,paramConfig,maestro){
	var vectorAtributos=new Array();
	var txt_fecha_inicio,txt_fecha_fin,txt_id_moneda;
	var id_parametro,id_periodo_subsistema,desc_periodo,desc_usuario,intGestion;
		
	//DATA STORE
	//aqui para clase comprobante
				var	ds_gestion = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/parametro/ActionListarParametro.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_parametro',totalRecords: 'TotalCount'}, ['id_parametro','id_gestion','desc_gestion','estado_gestion','gestion_conta'])});
	            var ds_periodo_subsis = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/periodo_subsistema/ActionListarPeriodoGestionSubsis.php'}),reader: new Ext.data.XmlReader({record: 'ROWS',id: 'id_periodo_subsistema',totalRecords: 'TotalCount'}, ['id_periodo_subsistema','id_periodo','desc_periodo','estado_periodo','periodo'])});
	

               var ds_moneda=new Ext.data.Store({proxy:new Ext.data.HttpProxy({url:direccion+'../../../../sis_parametros/control/moneda/ActionListarMoneda.php'}),
			   reader:new Ext.data.XmlReader({record:'ROWS',id:'id_moneda',totalRecords:'TotalCount'},['id_moneda','nombre','simbolo','estado','origen','prioridad'])
	           });
	           
	           var ds_usuario=new Ext.data.Store({proxy:new Ext.data.HttpProxy({url:direccion+'../../../../sis_parametros/control/depto_usuario/ActionListarDepartamentoUsuario.php'}),
			   reader:new Ext.data.XmlReader({record:'ROWS',id:'id_usuario',totalRecords:'TotalCount'},['id_depto_usuario','id_depto','desc_depto','id_usuario','desc_usuario','apellido_paterno_persona','apellido_materno_persona','nombre_persona','estado'])
	           });
	           
	        	var ds_depto = new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../../sis_parametros/control/depto/ActionListarDepartamento.php'}),
				reader: new Ext.data.XmlReader({record: 'ROWS',id:'id_depto',totalRecords:'TotalCount'},['id_depto','codigo_depto','nombre_depto','estado','id_subsistema','nombre_corto','nombre_largo']),baseParams:{m_id_subsistema:9}});
				function render_id_moneda(value,p,record){return String.format('{0}', record.data['desc_moneda'])}
				function render_id_depto(value, p, record){return String.format('{0}', record.data['nombre_depto']);}
				var tpl_id_depto=new Ext.Template('<div class="search-item">','<FONT COLOR="#B5A642"><b>Departamento Contable: </b></FONT"><br><FONT COLOR="#000000">{nombre_depto}</FONT>','</div>');				
				var tpl_id_clase_cbte=new Ext.Template('<div class="search-item">','<b><i>{desc_clase}</i></b>','<br><FONT COLOR="#B5A642"><b>Documento: </b>{desc_documento}</FONT>','</div>');
			    var tpl_id_moneda=new Ext.Template('<div class="search-item">','<b><i>{nombre}</i></b>','<br><FONT COLOR="#B5A642"><b>Abrev: </b>{simbolo}</FONT>','</div>');
			    var tpl_gestion=new Ext.Template('<div class="search-item">','<b><i>Gestion</i></b>','<br><FONT COLOR="#B5A642">{desc_gestion}</FONT>','</div>');
			    var tpl_id_usuario=new Ext.Template('<div class="search-item">','<b><i>Usuario:</i></b>','<br><FONT COLOR="#B5A642">{desc_usuario}</FONT>','</div>');


	
	// txt fecha_inicio
	
 vectorAtributos[0]={
			validacion:{
			name:'id_depto',
			fieldLabel:'Departamento',
			allowBlank:false,			
			emptyText:'Departamento...',
			desc: 'nombre_depto', //indica la columna del store principal ds del que proviane la descripcion
			store:ds_depto,
			valueField: 'id_depto',
			displayField: 'nombre_depto',
			queryParam: 'filterValue_0',
			//filterCol:'MONEDA.nombre',
			typeAhead:false,
			tpl:tpl_id_depto,
			forceSelection:true,
			mode:'remote',
			queryDelay:50,
			pageSize:50,
			minListWidth:'50%',
			grow:true,
			resizable:true,
			minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
			triggerAction:'all',
			editable:true,
			renderer:render_id_depto,
			grid_visible:false,
			grid_editable:true,
			width_grid:50,
			width:'30%',
			disable:false		
		},
		tipo:'ComboBox',
		form: true,
		filtro_0:true,
		//filterColValue:'MONEDA.nombre',
		save_as:'id_depto'
	};
		
	filterCols_parametro=new Array();
	filterValues_parametro=new Array();
	filterCols_parametro[0]='estado_gestion';
	filterValues_parametro[0]='2';
	vectorAtributos[1]= {
		validacion: {
			name: 'gestion',
			fieldLabel:'Gesti�n',
			allowBlank:false,
			emptyText:'Gesti�n...',
			desc: 'gestion',
			store:ds_gestion,
			valueField: 'id_parametro',
			displayField: 'desc_gestion',
			queryParam: 'filterValue_0',
			filterCols:filterCols_parametro,
			filterValues:filterValues_parametro,
			typeAhead:false,
			forceSelection:false,
			mode:'remote',
			queryDelay:250,
			pageSize:20,
			minListWidth:250,
			grow:true,
			width:150,
			minChars:1,
			triggerAction:'all',
			editable:true
		},
		tipo:'ComboBox',
		save_as:'id_parametro'
	};


	filterCols_periodo=new Array();
	filterValues_periodo=new Array();
	filterCols_periodo[0]='PERIOD.id_gestion';
	filterValues_periodo[0]='x';
	filterCols_periodo[1]='PERSIS.estado_periodo';
	filterValues_periodo[1]='abierto';
	filterCols_periodo[2]='PERSIS.id_subsistema';
	filterValues_periodo[2]='12';
	//filterCols_periodo[4]='PERIOD.estado_peri_gral';
	//filterValues_periodo[4]='abierto';

	vectorAtributos[2]= {
		validacion: {
			name: 'id_periodo_subsis',
			fieldLabel:'Per�odo',
			allowBlank:false,
			emptyText:'Per�odo...',
			desc: 'desc_periodo',
			store:ds_periodo_subsis,
			valueField: 'id_periodo_subsistema',
			displayField: 'desc_periodo',
			filterCols:filterCols_periodo,
			filterValues:filterValues_periodo,
			typeAhead:false,
			forceSelection:false,
			mode:'remote',
			queryDelay:250,
			pageSize:20,
			minListWidth:250,
			grow:true,
			width:150,
			minChars:1,
			triggerAction:'all',
			editable:true
		},
		tipo:'ComboBox',
		save_as:'id_periodo_subsis'
	};
	
	 vectorAtributos[3]={
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
			typeAhead:false,
			tpl:tpl_id_moneda,
			forceSelection:true,
			mode:'remote',
			queryDelay:250,
			pageSize:100,
			minListWidth:'50%',
			grow:true,
			resizable:true,
			minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
			triggerAction:'all',
			editable:true,
			renderer:render_id_moneda,
			grid_visible:false,
			grid_editable:true,
			width_grid:150,
			width:'50%',
			disable:false		
		},
		tipo:'ComboBox',
		form: true,
		filtro_0:true,
		filterColValue:'MONEDA.nombre',
		save_as:'id_moneda'
	};
	filterCols_usuario=new Array();
	filterValues_usuario=new Array();
	filterCols_usuario[0]='DEPTO.id_depto';
	filterValues_periodo[0]='x';
	
	vectorAtributos[4]={
			validacion:{
			name:'id_usuario',
			fieldLabel:'Usuario',
			allowBlank:false,			
			emptyText:'Usuario...',
			desc: 'desc_usuario', //indica la columna del store principal ds del que proviane la descripcion
			store:ds_usuario,
			valueField: 'id_usuario',
			displayField: 'desc_usuario',
			queryParam: 'filterValue_0',
			filterCol:'DEPTO.id_depto',
			filterCols:filterCols_usuario,
			filterValues:filterValues_usuario,
			typeAhead:false,
			tpl:tpl_id_usuario,
			forceSelection:true,
			mode:'remote',
			queryDelay:50,
			pageSize:50,
			minListWidth:'50%',
			grow:true,
			resizable:true,
			minChars:1, ///caracteres m�nimos requeridos para iniciar la busqueda
			triggerAction:'all',
			editable:true,
			//renderer:render_id_usuario,
			grid_visible:false,
			grid_editable:true,
			width_grid:50,
			width:'30%',
			disable:false		
		},
		tipo:'ComboBox',
		form: true,
		filtro_0:true,
		filterColValue:'DEPTO.id_depto',
		save_as:'id_usuario'
	};

	
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
function formatDate(value){return value?value.dateFormat('d/m/Y'):''};
	// ---------- Inicia Layout ---------------//
	var config={
		titulo_maestro:"Documento IVA"
	};
	layout_documento_iva=new DocsLayoutProceso(idContenedor);
	layout_documento_iva.init(config);
	//---------         INICIAMOS HERENCIA           -----------//
	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina=BaseParametrosReporte;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,documento_iva,idContenedor);
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
	var ClaseMadre_conexionFailure = this.conexionFailure; // para heredar de la clase madre la funcion eliminarSucces de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
	var ClaseMadre_getComponente = this.getComponente;
	var CM_ocultarComponente=this.ocultarComponente;
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	function iniciarEventosFormularios(){
	 	/*txt_fecha_inicio = ClaseMadre_getComponente('fecha_inicio');
		txt_fecha_fin = ClaseMadre_getComponente('fecha_fin');
		*/txt_id_moneda = ClaseMadre_getComponente('id_moneda');
		txt_id_depto = ClaseMadre_getComponente('id_depto');
		cmb_gestion = ClaseMadre_getComponente('gestion');
		//cmb_periodo = ClaseMadre_getComponente('id_periodo_subsis');
		//cmb_parametro = ClaseMadre_getComponente('id_parametro');
		cmb_periodo = ClaseMadre_getComponente('id_periodo_subsis');
		cmb_usuario = ClaseMadre_getComponente('id_usuario');
		var onGestionSelect = function(e) {
			var id = cmb_gestion.getValue();
			if(cmb_gestion.store.getById(id)!=undefined){
				id_gestion=cmb_gestion.store.getById(id).data.id_gestion;
				intGestion=cmb_gestion.store.getById(id).data.desc_gestion;
				
				cmb_periodo.filterValues[0]=id_gestion;
				cmb_periodo.modificado = true;
				cmb_periodo.setValue('');
			}
		};
		
		function set_desc_moneda(combo,record, index){txt_desc_moneda=record.data.nombre}
		var onDeptoSelect =function(e){
			var id_depto=txt_id_depto.getValue();
			if(txt_id_depto.store.getById(id_depto)!=undefined){
				cmb_usuario.filterValues[0]=id_depto;
				cmb_usuario.modificado = true;
				cmb_usuario.setValue('');
				txt_codigo_depto=txt_id_depto.store.getById(id_depto).data.codigo_depto;
				
			}
			
		}
		function set_desc_usuario(combo,record, index){
			desc_usuario=record.data.desc_usuario
		}
		function set_periodo(combo,record, index)
		{
			id_periodo=record.data.id_periodo_subsistema;
		    desc_periodo=record.data.desc_periodo;
		}
	//	function set_parametro_depto(combo,record, index){txt_codigo_depto=record.data.codigo_depto}
		txt_id_moneda.on('select',set_desc_moneda);
		txt_id_depto.on('select',onDeptoSelect);
		cmb_gestion.on('select',onGestionSelect);
		cmb_gestion.on('change',onGestionSelect);
		cmb_periodo.on('select',set_periodo);
		cmb_usuario.on('select',set_desc_usuario);
		//cmb_periodo.on('select',onPeriodoSelect);
		//cmb_periodo.on('change',onPeriodoSelect);
		
		
	}
    //----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
  
	var paramFunciones = {
		Formulario:{
			labelWidth: 75, //ancho del label
			abrir_pestana:true, //abrir pestana
			titulo_pestana:'Detalle Facturaci�n',
			fileUpload:false,
			columnas:[305,305],
			grupos:[
			{	//tituloGrupo:'Datos para obtener Libro Compras',
				tituloGrupo:maestro.titulo_doc_iva,
				columna:0,
				id_grupo:0
			}
			],
			parametros: '',
		submit:function (){	
			
			        var data ='&m_id_moneda='+txt_id_moneda.getValue(); 		
					var mensaje="";
					if(txt_id_moneda.getValue()==""){mensaje+=" Debe elegir una moneda";};
					/*if(txt_fecha_inicio.getValue()==""){mensaje+=" Debe elegir fecha inicio";};
					if(txt_fecha_fin.getValue()==""){mensaje+=" Debe elegir fecha fin";};
					*/if(txt_id_depto.getValue()==""){mensaje+=" Debe elegir departamento contable";};
					if(mensaje=="")
					{					
					
						data +='&m_id_gestion='+intGestion;
						data +='&m_id_periodo='+id_periodo;	
						data +='&m_desc_periodo='+desc_periodo;
						data +='&m_desc_usuario='+desc_usuario;
					
					data +='&m_desc_moneda='+txt_desc_moneda;
					data +='&m_id_depto='+txt_id_depto.getValue();
					data +='&m_codigo_depto='+txt_codigo_depto;
					data +='&vista='+maestro.vista;
					data +='&sw_debito_credito='+maestro.sw_debito_credito;

					alert(data);
					      
	 				var ParamVentana={Ventana:{width:'90%',height:'70%'}}
	 				  /*if(maestro.vista!='ventas')
    					{
    						layout_documento_iva.loadWindows(direccion+'../../../../sis_contabilidad/vista/documento_iva/documento_iva_compras.php?'+data,'Detalle Doc Compras',ParamVentana);
    					}else {
    					*/	layout_documento_iva.loadWindows(direccion+'../../../../sis_contabilidad/vista/documento_iva/documento_iva_compras.php?'+data,'Detalle Doc Compras',ParamVentana);
    					//}
				 	
			 		}
		else{alert(mensaje);}
		}
			
		}
	}
	//InitBarraMenu(array BOTONES DISPONIBLES);
	this.Init(); //iniciamos la clase madre
	//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);
	this.InitFunciones(paramFunciones);
    //Se agrega el bot�n para la generaci�n del reporte
	this.iniciaFormulario();
	iniciarEventosFormularios();
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}

