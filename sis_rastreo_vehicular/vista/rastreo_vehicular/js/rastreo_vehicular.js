/**
 * 
 * 
 */
function pagina_rastreo_vehicular(idContenedor, direccion, paramConfig, sessionVar) 
{  
	var vectorAtributos = new Array;

	// ////////////////////////////////////////////////////////////
	// --------- INICIAMOS LAYOUT MAESTRO -----------//
	// ////////////////////////////////////////////////////////////
	// Inicia Layout
	var config = {
		titulo_maestro : 'Rastreo Vehicular'
	};
	//console.log(sessionVar);
	layout = new DocsLayoutProceso(idContenedor);
	layout.init(config);
	// //////////////////////
	// INICIAMOS HERENCIA //
	// //////////////////////
	// / HEREDAMOS DE LA CLASE MADRE
	this.pagina = BaseParametrosReporte;
	// -- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE
	// ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig, vectorAtributos, layout, idContenedor);

	// /////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	// /////////////////////////////////

	// ////////////////////////////////////////////////////////////////////////////
	// ---------------------- DEFINICI�N DE FUNCIONES -------------------------
	// //
	// aqu� se parametrizan las funciones que se ejecutan en la clase madre //
	// ////////////////////////////////////////////////////////////////////////////
	
	// datos necesarios para el filtro
	var paramFunciones = {
//			Save:{url:direccion+'../../../control/comprobante/ActionGuardarRegistroComprobante.php',
//			params:{session:sessionVar}
//			},
		Formulario : {
			html_apply : 'dlgInfo-' + idContenedor,
			height : '70%',
			abrir_pestana : true, // abrir pestana
			titulo_pestana : 'Rastreo Vehicular',
			fileUpload : false,
			width : '70%',
			columnas : [ '47%' ],
			minWidth : 150,
			minHeight : 200,
			closable : true,
			titulo : 'Rastreo vehicular',
			grupos : [],
			method: 'POST',
			url : 'http://dev-rastreo.ende.bo',
			parametros: 'session = ' + sessionVar
		}
	};
	// -------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//



	this.getElementos = function() {
		return elementos;
	};

	this.setPagina = function(elemento) {
		elementos.push(elemento);
	};
	// -------------- FIN DEFINICI�N DE FUNCIONES PROPIAS --------------//
	this.Init(); // iniciamos la clase madre
	this.InitFunciones(paramFunciones);

	this.iniciaFormulario();
	
	var cm_getBoton = this.getBoton;
	
	ContenedorPrincipal.getContenedorPrincipal().addListener('layout',
			this.onResizePrimario);
}
