/**
 * Nombre:		  	    ReporteCodigoBarras.js
 * Prop�sito: 			pagina objeto principal
 * Autor:				Silvia Ximena Ortiz Fern�ndez
 * Fecha creaci�n:		02/02/2011
 */

function ReporteCodigoBarras(idContenedor,direccion,paramConfig)
{	var vectorAtributos=new Array;
    var Atributos=new Array;
    var componentes= new Array();

	var datax;
	
	//C�digo
	vectorAtributos[0] = {
			validacion:{
				fieldLabel: 'Codigo',
				allowBlank: false,
				vtype:"texto",
				emptyText:'Codigo...',
				name: 'codigo',     //indica la columna del store principal "ds" del que proviene el id
				selectOnFocus:true,
				valueField: 'codigo',
				displayField: 'codigo',
				queryParam: 'filterValue_0',
				filterCol:'codigo',
				typeAhead: true,
				forceSelection : true,
				//mode: 'remote',
				queryDelay: 50,
				pageSize: 10,
				minListWidth : 300,
				resizable: true,
				queryParam: 'filterValue_0',
				minChars : 0, ///caracteres m�nimos requeridos para iniciar la b�squeda
				triggerAction: 'all',
				editable : true
			},
			id_grupo:0,
			save_as:'codigo',
			tipo: 'TextField'
	};	
	/*//Combo: tama�o
	vectorAtributos[1] = {
			validacion: {
				name: 'tamano',
				fieldLabel: 'Tama�o',
				emptyText:'Tama�o...',
				typeAhead: true,
				allowBlank: false,
				loadMask: true,
				triggerAction: 'all',
				store: new Ext.data.SimpleStore({
					fields: ['ID', 'Valor'],
					data : Ext.CodigoBarras128Combo.tamano // from states.js
				}),
				valueField:'Valor',
				displayField:'ID',
				lazyRender:true,
				forceSelection:true
			},
			id_grupo:0,
			tipo:'ComboBox',
			defecto: 'Mediano',
			save_as:'txt_tamano'
		}
	*/
	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	function formatDate(value){
		return value ? value.dateFormat('d/m/Y') : '';
	};
	//////////////////////////////////////////////////////////////
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
	//////////////////////////////////////////////////////////////
	//Inicia Layout
	var config={
		titulo_maestro:'C�digo de Barras de los Activos Fijos'
	};
	layout_codigo_barras_128=new DocsLayoutProceso(idContenedor);
	layout_codigo_barras_128.init(config);
	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////
	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina = BaseParametrosReporte;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,layout_codigo_barras_128,idContenedor);
	
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
    var getSelectionModel=this.getSelectionModel;	
	var ClaseMadre_getDialog=this.getDialog;
	var ClaseMadre_save=this.Save;
	var ClaseMadre_getGrid=this.getGrid;
	var ClaseMadre_getFormulario=this.getFormulario;	
	var ClaseMadre_btnNew=this.btnNew;
	var ClaseMadre_onResize=this.onResize;
	var ClaseMadre_SaveAndOther=this.SaveAndOther;
	var CM_mostrarComponente=this.mostrarComponente;
	var CM_ocultarComponente=this.ocultarComponente;
	var CM_ocultarTodosComponente=this.ocultarTodosComponente;
	var CM_mostrarTodosComponente=this.mostrarTodosComponente;
	var ClaseMadre_btnEdit=this.btnEdit;
	var ClaseMadre_btnEliminar = this.btnEliminar;
	var ClaseMadre_btnActualizar = this.btnActualizar;
	var ClaseMadre_submit = this.submit;
	var CM_ocultarGrupo=this.ocultarGrupo;
	var CM_mostrarGrupo=this.mostrarGrupo;
	
	var ClaseMadre_conexionFailure = this.conexionFailure; // para heredar de la clase madre la funcion eliminarSucces de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
	var ClaseMadre_getComponente = this.getComponente;
	
	///////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	///////////////////////////////////
	
    //////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////
	
	function obtenerTitulo()
	{
		var titulo = "C�digo Barras";
		return titulo;
	}		
	
	//datos necesarios para el filtro
	var paramFunciones = {
		
		Formulario:{html_apply:'dlgInfo-'+idContenedor,
		height:'70%',
		url:direccion+'../../../../control/_reportes/codigo_barras_128/ActionPDFCodigoBarras128.php',
					
	    abrir_pestana:true, //abrir pestana
		titulo_pestana:obtenerTitulo,
		
		fileUpload:true,
		width:'60%',
		columnas:['47%','47%'],
		minWidth:150,
		minHeight:200,	
		closable:true,
		titulo:'C�digo Barras',		
		grupos:[
			{	
				tituloGrupo:'Activo Fijo', columna:0, id_grupo:0	
			}			
		]
		}	
	};
	
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	
	//Para manejo de eventos
	
   //para que los hijos puedan ajustarse al tama�o
	this.getLayout=function(){return layout_codigo_barras_128.getLayout();};
	//para el manejo de hijos
	this.getPagina=function(idContenedorHijo){
		var tam_elementos=elementos.length;
		for(i=0;i<tam_elementos;i++){
			if(elementos[i].idContenedor==idContenedorHijo){
				return elementos[i];
			}
		}
	};
	this.getElementos=function(){return elementos;};
	this.setPagina=function(elemento){elementos.push(elemento);};
				//-------------- FIN DEFINICI�N DE FUNCIONES PROPIAS --------------//
				this.Init(); //iniciamos la clase madre
				//this.InitBarraMenu(paramMenu);
				//InitBarraMenu(array DE PAR�METROS PARA LAS FUNCIONES DE LA CLASE MADRE);

				this.InitFunciones(paramFunciones);
				//para agregar botones
				
				this.iniciaFormulario();
				//iniciarEventosFormularios();
				ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}