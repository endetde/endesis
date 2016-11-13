/*
**********************************************************
Nombre de la funci�n:	DocsLayoutMaestro()
Prop�sito:				Funcion que invoca la definicion del layout para el manejo de arboles
Tipo Maestro
Valores de Retorno:		Doc - > objeto de funciones necesarias para el manejo de pantalla
Fecha de Creaci�n:		10 - 12 - 07
Versi�n:				2.0.0
Autor:					Rensi Arteaga Copari
**********************************************************
*/
function DocsLayoutArb(idContenedor){
	this.center;
	var layout,div_layout;
	var innerLayout,div_innerLayout;
	var config={titulo:""};
	var idVentana;
	var pagHijo=new Array();

	this.init=function(param){
		if(!param.titulo){
			config.titulo=param.titulo
		}
		
		div_layout=Ext.DomHelper.append(idContenedor,{tag:'div',id:'layout-'+idContenedor});
		layout=new Ext.BorderLayout(div_layout,{
				north:{
				initialSize:27				
			},
			center:{
				titlebar:false,
				autoScroll:true,
				useShim:true,
				tabPosition:'top',
				alwaysShowTabs:false,
				closeOnTab:true,
				fitToFrame:true
			}
		});

		layout.beginUpdate();
		
		var div_ctree=Ext.DomHelper.append(div_layout,{tag:'div',id:'ctree-'+idContenedor});
		layout.add('north', new Ext.ContentPanel(div_ctree,{closable:false}));
		var div_tree=Ext.DomHelper.append(div_layout,{tag:'div',id:'tree-'+idContenedor});
		layout.add('center', new Ext.ContentPanel(div_tree,{closable:false/*,fitToFrame:true*/,autoScroll:true,title:config.titulo_maestro}));
		layout.restoreState();
		layout.endUpdate();
	};
		/*//Carga Pesta�a Adicional
	this.loadWindows=function(url,title,param){
		var sw=false;var _url=url.split('?');
		for(var i=0;i<pagHijo.length;i++){
			
			if(pagHijo[i].url==_url[0]){				
				var paginaHijo = ContenedorPrincipal.getPagina(pagHijo[i].idContenedor)
				if(!paginaHijo){
				     paginaHijo=ContenedorPrincipal.getPagina(idContenedor).pagina.getPagina(pagHijo[i].idContenedor)				     
				}
				
				paginaHijo.pagina.reload(_url[1]);
				pagHijo[i].ventana.show();
				sw=true;
				idVentana=pagHijo[i].idContenedor;				
				return pagHijo[i].ventana;
			}
		}

		if(!sw){
			var	Ventana={
				modal:true,
				width:600,                                                          
				height:400,
				shadow:true,
				minWidth:300,
				minHeight:300,
				proxyDrag:true
			};


			if(param.Ventana){
				if(param.Ventana.modal){Ventana.modal=param.Ventana.modal}
				if(param.Ventana.width){Ventana.width=param.Ventana.width}
				if(param.Ventana.height){Ventana.height=param.Ventana.height}
				if(param.Ventana.shadow){Ventana.shadow=param.Ventana.shadow}
				if(param.Ventana.minWidth){Ventana.minWidth=param.Ventana.minWidth}
				if(param.Ventana.minHeight){Ventana.minHeight=param.Ventana.minHeight}
				if(param.Ventana.proxyDrag){Ventana.proxyDrag=param.Ventana.proxyDrag}
			}

			var Win = Ext.DomHelper.append(div_layout,{tag:'div'},true);
			var contenedor_panel_hijo=new Ext.ContentPanel(Win,{title:title,fitToFrame:true,closable:true,background:true});
			contenedor_panel_hijo.load({
				url:url,
				method:'POST',
				params:{idContenedorPadre:idContenedor,idContenedor:contenedor_panel_hijo.getId()},
				scripts:true
			});

			
			var idVentaHij=contenedor_panel_hijo.getId();

			marcas_html="<div class='x-dlg-hd'>"+title+"</div><div class='x-dlg-bd'><div id='ven-"+idVentaHij+"'></div></div>";
			var div_dlgInfo=Ext.DomHelper.append(document.body,{tag:'div',id:"v-"+idVentaHij,background:true,html:marcas_html});
			var ventana= new Ext.LayoutDialog('ven-'+idVentaHij,{
				modal:Ventana.modal,
				width:Ventana.width,
				height:Ventana.height,
				shadow:Ventana.shadow,
				minWidth:Ventana.minWidth,
				minHeight:Ventana.minHeight,
				proxyDrag:Ventana.proxyDrag,
				fitToFrame:true,
				center:{
					titlebar:false,
					autoScroll:true,
					tabPosition:'top',
					alwaysShowTabs:false,
					closeOnTab:true,
					//resizeTabs:true,
					fitToFrame:true}
			});
			
			

			ventana.getLayout().beginUpdate();
			ventana.getLayout().add('center',contenedor_panel_hijo)
			//  new Ext.ContentPanel(Ext.id(),{autoCreate:true, title: 'Another Tab', background:true}));
			ventana.getLayout().endUpdate();
			ventana.show();
			ventana.addListener('beforehide',function(){
			ContenedorPrincipal.deletePagina(contenedor_panel_hijo.getId());Win.remove();contenedor_panel_hijo.destroy()});
			ventana.addKeyListener(27,ventana.hide,ventana);
			idVentana=contenedor_panel_hijo.getId();
			var params={url:_url[0],idContenedor:contenedor_panel_hijo.getId(),ventana:ventana};
			pagHijo.push(params);
			return ventana;
		}

		

	};
	
	this.getVentana=function(){
		for(var i=0;i<pagHijo.length;i++){
			if(pagHijo[i].idContenedor==idVentana){
				return pagHijo[i].ventana;			
				break
			}
		}
	};*/
		
			//Carga Ventana Adicional
	this.loadWindows=function(url,title,param){
		_CP.loadWindows(url,title,param,idContenedor,idContenedor)		
	};
	
	this.getVentana=function(){
		return _CP.getVentana()
	};
	
	this.getLayout=function(){return layout};

}