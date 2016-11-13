/*
**********************************************************
Nombre de la funci�n:	Ext.onReady()
Prop�sito:				Funcion que invoca la definicion del layout (las pantalas)
Tipo Detalle (tiene un norte reservado para los datos de un maestro)


Valores de Retorno:		 Doc - > objeto de funciones necesarias para el manejo de pantalla

Fecha de Creaci�n:		25 - 04 - 07
Versi�n:				2.0.0
Autor:					Rensi Arteaga Copari
**********************************************************
*/

function DocsLayoutDetalleEP(idContenedor,idContenedorPadre){
	var layout,div_layout;
	this.center_detalle;
	var pesta�as=Array();
	var config={
		titulo_maestro:"",
		titulo_detalle:"",
		grid_detalle:"",
		grid_maestro:""
	};
	var idVentana;
	var pagHijo=new Array();
	this.init=function(param){
		Ext.state.Manager.setProvider(new Ext.state.CookieProvider());
		if(param.titulo_maestro){config.titulo_maestro=param.titulo_maestro}
		if(param.titulo_detalle){config.titulo_detalle=param.titulo_detalle}
		config.grid_detalle='grid_detalle-'+idContenedor;
		config.grid_maestro='grid-'+idContenedor;
		div_layout=Ext.DomHelper.append(idContenedor,{tag:'div',id:'layout-'+idContenedor});
		layout=new Ext.BorderLayout(div_layout,{
			north:{
				split:true,
				initialSize:110,
				minSize:100,
				maxSize:200,
				titlebar:true,
				collapsible:true,
				collapsedTitle:config.titulo_maestro,
				autoScroll:true,
				animate:false
			},
			center:{
				split:false,
				titlebar:true,
				autoTabs:true,
				autoScroll:true,
				resizeTabs:true,
				tabPosition:'top'
			},
			south:{
				split:false,
				initialSize:27,
				titlebar: false
			}
		});
		layout.beginUpdate();
		var div_grid_maestro=Ext.DomHelper.append(div_layout,{tag:'div',id:config.grid_maestro});
		var div_filtro=Ext.DomHelper.append(div_layout,{tag:'div',id:"filtro-"+idContenedor});
		layout.add('north',new Ext.ContentPanel(config.grid_detalle,{fitToFrame:true,title:config.titulo_maestro,closable: false}));
		layout.add('center',new Ext.ContentPanel(div_grid_maestro,{fitToFrame:true,closable:false,title:config.titulo_detalle}));
		layout.add('south', new Ext.ContentPanel(div_filtro, "Filtro"));
		this.center_detalle=layout.getRegion('center');
		layout.endUpdate()
	};
	
	//Cargar Pesta�a Adicional
	this.loadTab=function(url,title){
		tabs=this.center_detalle.getTabs();
		var tam=0;
		if(tabs){tam= tabs.getCount()}
		var sw=false; //indica que no existe la pesta�a
		var indice;// para capturar el indice de la pesta�a
		if(tam>0){
			for(var i=0;i<tam;i++){
				if(pesta�as[tabs.getTab(i).id]==title){
					sw=true;
					indice=i;
					break
				}
			}
		}
		if(!sw){ //si no exite la pesta�a, abrimos una y la registramos
			var iframe=Ext.DomHelper.append(idContenedor,{tag:'iframe',frameBorder:0,src:url});
			layout.add('center',new  Ext.ContentPanel(iframe,{title:title,closable:true}));
			tabs=this.center.getTabs();
			if(tam==0){tam=1}
			pesta�as[tabs.getTab(tam).id]=title
		}
		else{//si existe la pesta�a le damos el foco
			tabs.activate(indice)
		}
	};
	
//Carga Ventana Adicional
	this.loadWindows=function(url,title,param,nombre_clase,init_pag){
		
		_CP.loadWindows(url,title,param,idContenedor,nombre_clase,init_pag)		
	};
	
	this.getVentana=function(){
		return _CP.getVentana()
	};

	this.getFoco=function(){return this.foco};
	this.getLayout=function(){return layout};
}