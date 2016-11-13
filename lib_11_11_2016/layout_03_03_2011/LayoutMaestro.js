/*
**********************************************************
Nombre de la funci�n:	DocsLayoutMaestro()
Prop�sito:				Funcion que invoca la definicion del layout (las pantallas)
Tipo Maestro
Valores de Retorno:		 Doc - > objeto de funciones necesarias para el manejo de pantalla
Fecha de Creaci�n:		25 - 04 - 07
Versi�n:				2.0.0
Autor:					Rensi Arteaga Copari
**********************************************************
*/
function DocsLayoutMaestro(idContenedor){
	this.center;
	this.foco; //esta variable nos indicara el id de la pesta�a que tiene el foco
	var layout,div_layout;
	var innerLayout,div_innerLayout;
	var pestanas=Array();
	var config={titulo_maestro:"",grid_maestro:'grid'};
	var idVentana;
	var pagHijo=new Array();
	this.init=function(param){
		if(param.titulo_maestro){config.titulo_maestro=param.titulo_maestro}
		config.grid_maestro='grid-'+idContenedor;
		
		//document.body
		div_layout=Ext.DomHelper.append(idContenedor,{tag:'div',id:'layout-'+idContenedor});
		
		
		
		layout=new Ext.BorderLayout(div_layout,{
			center:{
				titlebar:false,
				autoScroll:false,
				tabPosition:'top',
				alwaysShowTabs:false,
				syncHeightBeforeShow:true,
				closeOnTab:true,
				//resizeTabs:true,
				fitToFrame:true
			}
		});

		layout.beginUpdate();
		var div_grid=Ext.DomHelper.append(div_layout,{tag:'div',id:config.grid_maestro});
		layout.add('center', new Ext.ContentPanel(div_grid,{closable:false,fitToFrame:true,title:config.titulo_maestro}));
		//layout.add('center', new Ext.ContentPanel(idContenedor,{closable:false,fitToFrame:true,title:config.titulo_maestro}));
		this.center=layout.getRegion('center');
		layout.restoreState();
		layout.endUpdate()
	};
	//Carga Pesta�a hijo
	this.loadTab=function(url,title){
		tabs=this.center.getTabs();
		//numero de pesta�as existentes en el contenedor se subsistemas
		var tam=0;
		if(tabs){tam=tabs.getCount()}
		var sw=false;//indica que no existe la pesta�a
		var indice;//para capturar el indice de la pesta�a
		if(tam>0){
			for(var i=0;i<tam;i++){
				if(pestanas[tabs.getTab(i).id]==title){
					sw=true;
					indice=i;
					break
				}
			}
		}
		if(!sw){ //si no exite la pesta�a, abrimos una y la registramos
			var frame=Ext.DomHelper.append(div_layout,{tag:'div'});
			var contenedor_panel_hijo=new Ext.ContentPanel(frame,{title:title,fitToFrame:true,closable:true});
			contenedor_panel_hijo.load({
				url:url,
				method:'POST',
				params:{idContenedorPadre:idContenedor,idContenedor:contenedor_panel_hijo.getId()},
				scripts:true
			});
			layout.beginUpdate();
			layout.add('center',contenedor_panel_hijo);
			layout.restoreState();
			layout.endUpdate();
			tabs=this.center.getTabs();
			if(tam==0){tam=1}
			pestanas[tabs.getTab(tam).id]=title;
			this.foco=tabs.getTab(tam).id;
			////para acyualizar el contenido de la pesta�a
			var foco=tabs.getTab(tam).id;
			//creamos el evento active para el cada pesta�a nueva
			//cuando se activada (tome el foco) tenemos que actualizar el contenido
			tabs.getTab(foco).on('activate',function(){
				ContenedorPrincipal.getPagina(idContenedor).pagina.getPagina(foco).pagina.btnActualizar()
			})
		}
		else{//si existe la pesta�a le damos el foco
			tabs.activate(indice)
		}
	};


	//Carga Ventana Adicional
	this.loadWindows=function(url,title,param){
		_CP.loadWindows(url,title,param,idContenedor,idContenedor)		
	};
	
	this.getVentana=function(){
		return _CP.getVentana()
	};
	this.getFoco=function(){return this.foco};
	this.getLayout=function(){return layout}
}