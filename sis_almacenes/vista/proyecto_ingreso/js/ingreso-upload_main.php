//<script>
<?php session_start(); ?>
function main(){
	 <?php
	//obtenemos la ruta absoluta
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$dir = "http://$host$uri/";
	echo "\nvar direccion=\"$dir\";";
	echo "var idContenedor='$idContenedor';";
	?>

var paramConfig={TiempoEspera:10000};
var maestro={
		id_ingreso:<?php echo $id_ingreso;?>
		}
var idContenedorPadre='<?php echo $idContenedorPadre;?>';

var elemento={
	pagina:new pagina_ingreso_upload(idContenedor,direccion,paramConfig,maestro,idContenedorPadre),
	idContenedor:idContenedor};
ContenedorPrincipal.setPagina(elemento);
}
Ext.onReady(main,main);

/**
 * Nombre:		  	    
 * Prop�sito: 			
 * Autor:				Rensi Arteaga
 * Fecha creaci�n:		22/12/2016
 */
function pagina_ingreso_upload(idContenedor,direccion,paramConfig,maestro,idContenedorPadre)
{	
	var vectorAtributos=new Array;
    var Atributos=new Array;
    var componentes= new Array();
	
    vectorAtributos[0]=
    {
			validacion:
			{
				name:'ingreso_detalle',
				fieldLabel:'Ingreso Detalle',
				invalidText: 'Por favor seleccione un archivo',
				allowBlank:true,
				inputType:'file',			
				grid_visible:false,
				grid_editable:false
			},
			tipo: 'Field',
			save_as:'txt_ingreso_detalle'
		};
	
	//////////////////////////////////////////////////////////////
	// ----------            FUNCIONES RENDER    ---------------//
	//////////////////////////////////////////////////////////////
	function formatDate(value){	return value ? value.dateFormat('d/m/Y') : ''; };
	//////////////////////////////////////////////////////////////
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
	//////////////////////////////////////////////////////////////
	//Inicia Layout
	var config={ titulo_maestro:'Listar Documentos' };
	var layout_ingreso_detalle = new DocsLayoutProceso(idContenedor);
	layout_ingreso_detalle.init(config);
	////////////////////////
	// INICIAMOS HERENCIA //
	////////////////////////
	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina = BaseParametrosReporte;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,layout_ingreso_detalle,idContenedor);
	
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
	var CM_ocultarGrupo=this.ocultarGrupo;
	var CM_mostrarGrupo=this.mostrarGrupo;
	var ClaseMadre_getComponente = this.getComponente;
	///////////////////////////////////
	// DEFINICI�N DE LA BARRA DE MEN�//
	///////////////////////////////////
	
    //////////////////////////////////////////////////////////////////////////////
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	//////////////////////////////////////////////////////////////////////////////
	
	function obtenerTitulo()
	{	var titulo = "Listar Documento";	return titulo;	}
	
	function retorno(resp1,resp2,resp3,resp4,j,k){
		  Ext.MessageBox.hide();
		  var root = resp1.responseXML.documentElement
          if(root.getElementsByTagName('error')[0].firstChild.nodeValue == 'true'){
          	
          	 Ext.Msg.show({
						title: 'ALERTA',
						msg: "<pre><font face='Arial'> "+root.getElementsByTagName('mensaje')[0].firstChild.nodeValue+"</font></pre>" ,
						//msg: mensaje ,
						minWidth:300,
						minHeight:200,
						maxWidth :800,
						minHeight:600,
						buttons: Ext.Msg.OK
						//width: 300,
					});
          	 
          	 
          	 
          } 
          else{          	
			var ventana = _CP.getVentana(idContenedor);
			ventana.hide();
			var paginaPadre = _CP.getPagina(idContenedorPadre);
			paginaPadre.pagina.btnActualizar();
          }
		
		
		
		
	}
	
	function fallo(resp1,resp2,resp3,resp4){
		alert('fallo')
		_CP.conexionFailure(resp1,resp2,resp3,resp4);
	}
	//datos necesarios para el filtro
	var paramFunciones = {
		
		Formulario:{
			html_apply:'dlgInfo-'+idContenedor,
			height:70,
			url:direccion+'../../../control/ingreso/ActionImportarDetalle.php?id_ingreso='+maestro.id_ingreso,
		    abrir_pestana:false, //abrir pestana
			//titulo_pestana:obtenerTitulo,
			fileUpload:true,
			width:150,
			columnas:['90%'],
			minWidth:150,
			minHeight:100,
			closable:true,
			upload:true,
			success: retorno,
			failure: fallo,
			titulo:'Listar Documento',
			grupos:[
					{
						tituloGrupo:'Subir Archivo',
						columna:0,
						id_grupo:0
					}
				]}
	};

	
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	this.reload=function(params){
		componentes[0].reset();
		var datos=Ext.urlDecode(decodeURIComponent(params));
		maestro.id_persona=datos.id_persona;
   		paramFunciones.Formulario.url=direccion+'../../../control/ingreso/ActionImportarDetalle.php?id_ingreso='+maestro.id_ingreso;
		this.InitFunciones(paramFunciones);
	};

	
	//Para manejo de eventos

  	function iniciarEventosFormularios()
  	{
		for (var i=0;i<vectorAtributos.length;i++)
		{
			componentes[i]=ClaseMadre_getComponente(vectorAtributos[i].validacion.name);
		}
	}
	
	this.getElementos=function(){return elementos;};
	this.setPagina=function(elemento){elementos.push(elemento);};
			//-------------- FIN DEFINICI�N DE FUNCIONES PROPIAS --------------//
			this.Init(); //iniciamos la clase madre
			
			
			this.InitFunciones(paramFunciones);
			//para agregar botones
			
			this.iniciaFormulario();
			iniciarEventosFormularios();
			ContenedorPrincipal.getContenedorPrincipal().addListener('layout',this.onResizePrimario);
}
