/*
**********************************************************
Nombre de la funci�n:	Ext.onReady()
Prop�sito:				Funcion que invoca la definicion del layout (las pantallas)
Tipo Maestro


Valores de Retorno:		 Doc - > objeto de funciones necesarias para el manejo de pantalla

Fecha de Creaci�n:		25 - 04 - 07
Versi�n:				2.0.0
Autor:					Rensi Arteaga Copari
**********************************************************
*/
function DocsLayoutMaestroDetalleEP(idContenedor){
	
	this.center;
	this.foco; //esta variable nos indicara el id de la pesta�a que tiene el foco
	var layout,div_layout;
	var innerLayout,div_innerLayout;
	var pestanas=Array();
	var config={titulo_maestro:"",grid_maestro:'grid'};
	var idVentana;
		var contenSur;
	var pagHijo=new Array();
	var tabHijo=new Array();
	this.init=function(param){
		if(param.titulo_maestro){config.titulo_maestro=param.titulo_maestro}
		config.grid_maestro='grid-'+idContenedor;
		div_layout=Ext.DomHelper.append(idContenedor,{tag:'div',id:'layout-'+idContenedor});
		layout=new Ext.BorderLayout(div_layout,{
			center:{
				titlebar:false,
				autoScroll:false,
				tabPosition:'top',
				alwaysShowTabs:false,
				closeOnTab:true,
				//resizeTabs:true,
				fitToFrame:true
			},
			south:{
					split:true,
					autoScroll:true,
					initialSize: '50%',
					minSize: 175,
					maxSize: 500,
					titlebar: true,
					collapsible: true,
					animate: false,
					fitToFrame:true,
					cmargins: {top:2,bottom:2,right:2,left:2},
					collapsed:false
				}
		});
		div_innerLayout=Ext.DomHelper.append(idContenedor,{tag:'div',id:'innerLayout-'+idContenedor});
		innerLayout=new Ext.BorderLayout(div_innerLayout,{
			center:{
				split:false,
				titlebar: false,
				fitToFrame:true,
				autoTabs:true,
				resizeTabs: true,
				autoScroll:false,
				tabPosition: 'top'
			},
			south:{
				split:false,
				initialSize:27,
				titlebar: false
			}
		});

		var div_filtro=Ext.DomHelper.append(div_layout,{tag:'div',id:"filtro-"+idContenedor});
		var div_grid=Ext.DomHelper.append(div_layout,{tag:'div',id:config.grid_maestro});
		var div_grid_det=Ext.DomHelper.append(div_layout,{tag:'div'},true);	
		
		
		innerLayout.add('center', new Ext.ContentPanel(div_grid,{closable:false,fitToFrame:true,title:config.titulo_maestro}));
		innerLayout.add('south', new Ext.ContentPanel(div_filtro, "Filtro"));
		
		
		layout.add('center', new Ext.NestedLayoutPanel(innerLayout,{title:config.titulo_maestro}));
		
		contenSur=new Ext.ContentPanel(div_grid_det,{closable:false,fitToFrame:true,background:true})

				
		contenSur.load({
					url:param.urlHijo,
					method:'POST',
					params:{idContenedorPadre:idContenedor,idContenedor:contenSur.getId()},
					scripts:true
				});
	
		layout.add('south',contenSur );
		
		
		
		this.center=layout.getRegion('center');
		

	};
	//Carga Pesta�a hijo
	//Carga Pesta�a Adicional
	this.loadTab=function(url,title,pag,maestro,paramConfig,direccion){
		tabs=this.center.getTabs();
		//numero de pesta�as existentes en el contenedor se subsistemas
		var tam=0;
		if(tabs!=undefined){tam=tabs.getCount()}
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
			//buscar si el url ya fue abierto
			var contenedor_panel_hijo;
			var sw_url=false,_url=url.split('?'),tabHijo_ind;
			for(var i=0;i<tabHijo.length;i++){
				if(tabHijo[i].url==_url[0]){
					sw_url=true;
					tabHijo_ind=i;
					break
				}
			}

			if(sw_url){
				//si el url ya fue abierto instanciar solamente otro objeto de la misma clase
				//utilizar los atributos extras
				contenedor_panel_hijo=new Ext.ContentPanel(frame,{title:title,fitToFrame:true,closable:true});
				ContenedorPrincipal.getPagina(idContenedor).pagina.setPagina({
					idContenedor:contenedor_panel_hijo.getId(),
					pagina:new pag(contenedor_panel_hijo.getId(),direccion,paramConfig,maestro,idContenedor)
				});
			}else{
				//si no	abrir normalmente [traer todos los datos desde el server]
				contenedor_panel_hijo=new Ext.ContentPanel(frame,{title:title,fitToFrame:true,closable:true});
				contenedor_panel_hijo.load({
					url:url,
					method:'POST',
					params:{idContenedorPadre:idContenedor,idContenedor:contenedor_panel_hijo.getId()},
					scripts:true
				});
				tabHijo.push({url:_url[0],id:contenedor_panel_hijo.getId(),panel:contenedor_panel_hijo})
			}
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

	this.loadWindows=function(url,title,param,nombre_clase,init_pag){
		//_CP.loadWindows(url,title,param,idContenedor,idContenedor)	
		_CP.loadWindows(url,title,param,idContenedor,nombre_clase,init_pag)			
	};
	
	this.getVentana=function(){
		return _CP.getVentana()
	};
	
	this.getIdContentHijo=function(){
		return contenSur.getId()
	}

	this.getFoco=function(){return this.foco};
	this.getLayout=function(){return layout};
}