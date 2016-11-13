<?php 
/**
 * Nombre:		  	    libro_diario_filtrar_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-09-16 17:55:38
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
	echo "var id='$id';";
	echo "var idSub='$idSub';";
    ?>
var fa=false;
<?php if($_SESSION["ss_filtro_avanzado"]!=''){echo 'fa='.$_SESSION["ss_filtro_avanzado"].';';}?>
var paramConfig={TamanoPagina:_CP.getConfig().ss_tam_pag,
TiempoEspera:_CP.getConfig().ss_tiempo_espera,
CantFiltros:1,
FiltroEstructura:false,
FiltroAvanzado:fa};
  var result = "";
  var pestana=_CP.getPestana(id);
elemento={pagina:new ConciliacionBancaria(idContenedor,direccion,paramConfig),idContenedor:idContenedor};
}

Ext.onReady(main,main);

//view added

function ConciliacionBancaria(idContenedor,direccion,paramConfig){
	var vectorAtributos=new Array();
	var txt_id_cuenta_bancaria;
	var	txt_fecha_inicio;
	var	txt_fecha_fin;
	var txt_id_moneda;
	var txt_desc_institucion;
	var txt_nro_cuenta_banco;
 var ds_cuenta_bancaria=new Ext.data.Store({proxy: new Ext.data.HttpProxy({url: direccion+'../../../control/cuenta_bancaria/ActionListarCuentaBancaria.php'}),
     reader:new Ext.data.XmlReader({record:'ROWS',id:'id_cuenta_bancaria',totalRecords: 'TotalCount'},['id_cuenta_bancaria','id_institucion','desc_institucion','id_cuenta','desc_cuenta','nro_cheque','estado_cuenta','nro_cuenta_banco','id_moneda'])
			});
var tpl_cuenta_bancaria=new Ext.Template('<div class="search-item">','<b><i>{desc_institucion}</i></b>','<br><FONT COLOR="#B5A642"><b>Nro Cuenta: </b>{nro_cuenta_banco}</FONT>','</div>');
// txt tipo_pres  
	 vectorAtributos[0]={
		validacion:{
			name:'id_cuenta_bancaria',
			fieldLabel:'Cuenta Bancaria',
			vtype:'texto',
			emptyText:'Cuenta Bancaria...',
			allowBlank:false,
			typeAhead:true,
			tpl:tpl_cuenta_bancaria,
			loadMask:true,
			triggerAction:'all',
			store:ds_cuenta_bancaria,
			valueField:'id_cuenta_bancaria',
			displayField:'desc_institucion',
			forceSelection:true,
			pageSize:10,
			width:250
		},
		tipo:'ComboBox',
		save_as:'id_cuenta_bancaria',
		id_grupo: 0
	};  
	// txt fecha_inicio
	vectorAtributos[1]={
		validacion:{
			name:'fecha_inicio',
			fieldLabel:'Fecha Inicio',
			allowBlank:false,
			format:'d/m/Y', //formato para validacion
			minValue:'01/01/1900'
		},
		tipo:'DateField',
		dateFormat:'m-d-Y',
		save_as:'txt_fecha_inicio'
			};
// txt fecha_fin
	vectorAtributos[2]={
		validacion:{
			name:'fecha_fin',
			fieldLabel:'Fecha Fin',
			allowBlank:false,
			format:'d/m/Y', //formato para validacion
			minValue:'01/01/1900'
		},
		tipo:'DateField',
		dateFormat:'m-d-Y',
		save_as:'txt_fecha_fin'
		};
     vectorAtributos[3]={
			validacion:{
				labelSeparator:'',
				name:'id_moneda',
				inputType:'hidden'
			},
			tipo:'Field',
			filtro_0:false,
			save_as:'id_moneda'
		};		
	//---------         INICIAMOS LAYOUT MAESTRO     -----------//
      function formatDate(value){return value?value.dateFormat('d/m/Y'):''};
	// ---------- Inicia Layout ---------------//
	var config={
		titulo_maestro:"Conciliacion Bancaria"
	};
	layout_conciliacion_bancaria=new DocsLayoutProceso(idContenedor);
	layout_conciliacion_bancaria.init(config);
	//---------         INICIAMOS HERENCIA           -----------//
	/// HEREDAMOS DE LA CLASE MADRE
	this.pagina=BaseParametrosReporte;
	//-- pagina (array PARAMETROS DE CONFIGURACION, array DEFINICION DE ATRIBUTOS, SELECTION MODEL, DATA STORE, COLUM MODEL)
	this.pagina(paramConfig,vectorAtributos,layout_conciliacion_bancaria,idContenedor);
	//--------------- HERENCIA DE LA CLASE MADRE ---------------------//
	var ClaseMadre_conexionFailure=this.conexionFailure; // para heredar de la clase madre la funcion eliminarSucces de esta forma se encuentra disponible tambien para los metodos y no solo para el contructor
	var ClaseMadre_getComponente=this.getComponente;
	var CM_ocultarComponente=this.ocultarComponente;
	//-------------- DEFINICI�N DE FUNCIONES PROPIAS --------------//
	function iniciarEventosFormularios(){
		txt_id_cuenta_bancaria=ClaseMadre_getComponente('id_cuenta_bancaria');
		txt_fecha_inicio=ClaseMadre_getComponente('fecha_inicio');
		txt_fecha_fin=ClaseMadre_getComponente('fecha_fin');
		txt_id_moneda=ClaseMadre_getComponente('id_moneda');
		var onCuentaBancariaSelect=function(combo,record,index){
			txt_id_moneda.setValue(record.data.id_moneda);
			txt_desc_institucion=record.data.desc_institucion;
	        txt_nro_cuenta_banco=record.data.nro_cuenta_banco				   
		};
		txt_id_cuenta_bancaria.on('select',onCuentaBancariaSelect);
	}
	//----------------------  DEFINICI�N DE FUNCIONES ------------------------- //
	//  aqu� se parametrizan las funciones que se ejecutan en la clase madre    //
	var paramFunciones={
		Formulario:{
			labelWidth:75, //ancho del label
			abrir_pestana:true, //abrir pestana
			titulo_pestana:'Conciliacion Bancaria',
			fileUpload:false,
			columnas:[450],
			grupos:[
			{
				tituloGrupo:'Datos de Cuenta Bancaria',
				columna:0,
				id_grupo:0
			}
			],
			parametros: '',
		submit:function (){	
					var data ='&m_id_cuenta_bancaria='+txt_id_cuenta_bancaria.getValue(); 
					 var mensaje="";
					if(txt_id_cuenta_bancaria.getValue()==""){mensaje+=" Debe elegir una cuenta bancaria";};
					if(mensaje==""){
  					   data +='&m_id_cuenta_bancaria='+txt_id_cuenta_bancaria.getValue();
					   data +='&m_fecha_inicio='+txt_fecha_inicio.getValue().dateFormat('m-d-Y');
					   data +='&m_fecha_fin='+txt_fecha_fin.getValue().dateFormat('m-d-Y');
					   data +='&m_id_moneda='+txt_id_moneda.getValue();
					   data +='&m_desc_institucion='+txt_desc_institucion;
					   data +='&m_nro_cuenta_banco='+txt_nro_cuenta_banco;
					   data +='&m_vista_cheque=1';
		               var ParamVentana={Ventana:{width:'90%',height:'70%'}}
				       layout_conciliacion_bancaria.loadWindows(direccion+'../../../../sis_tesoreria/vista/conciliacion_bancaria/conciliacion_bancaria_det.php?'+data,'Conciliaci�n Bancaria',ParamVentana)
			           }
		         else{alert(mensaje)}
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

