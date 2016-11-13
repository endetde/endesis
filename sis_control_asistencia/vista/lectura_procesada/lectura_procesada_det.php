<?php
/**
* Nombre de archivo:	    ActivoFijo.php
* Prop�sito:				Contenedor HTML de los objetos de la vista
* Fecha de Creaci�n:		25-06-2007
*/
session_start();
?> 

<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">-->
  <html>
<head>
<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">--> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf8">-->
<title>Lecturas Procesadas</title>


<?php 
include_once('../../../lib/lib_vista/includes_vista.php');
?>
   <script src="../../../lib/ext-yui/build/locale/ext-lang-sp-min_lt.js" type="text/javascript"></script>
   <script type="text/javascript" src="../../../lib/js/lib.js"></script>
   <script type="text/javascript" src="../../../lib/js/Funciones6.js"></script>	
   <script type="text/javascript" src="../../../lib/layout/LayoutDetalle.js"></script>
   <script type="text/javascript" src="../../../lib/js/libLovV4.js"></script>
   
   
   <script type="text/javascript" src="js/lectura_procesada_det_js.php"></script>	
    <!--  combos -->
   <script type="text/javascript" src="js/lectura_procesadaCombo.js" ></script>	
    
   
  <style type="text/css">
	body {font:normal 9pt verdana; margin:0;padding:0;border:0px none;overflow:hidden;}
	#header{
	  

	    border-bottom: 1px solid #083772;
	    padding:5px 4px;
	}
	#footer{
	   
	    border-top: 1px solid #083772;
	    padding:2px 4px;
	    color:white;
	    font:normal 8pt arial,helvetica;
    }
	
	#content p {
	    margin:5px;
	}

    .x-layout-panel-north, .x-layout-panel-south, #content .x-layout-panel-center{
        border:0px none;
    }
    #content .x-layout-panel-south{
        border-top:1px solid #aca899;
    }
    #content .x-layout-panel-center{
        border-bottom:1px solid #aca899;
    }
    .ylayout-panel-south  {
	BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px; BACKGROUND-COLOR: #c3daf9
}

    #Layer1 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:1;
}
    
     .x-layout-collapsed-west{
   background-image: url(../../../lib/images/menu.gif);
   background-repeat:no-repeat;
   background-position:center;
}

.x-layout-collapsed-east{
   background-image: url(../../../lib/images/ayuda.gif);
   background-repeat:no-repeat;
   background-position:center;
}
  </style>  
</head>
<body>
 


   <!-- para armar el data combo -->
   
   <!-- NORTE -->
	 <!--<div id="maestro" class="ylayout-panel-south"></div>-->
   
   	  <!--Basic dialog-->
   
   		 <div id="dlgInfo" style="visibility:hidden;position:absolute;top:0px;">
			  <div class="x-dlg-hd">Lecturas del Reloj</div>
          		<div class="x-dlg-bd">
          			<!--formulario-->
          			<div id="form-ct2_dlgInfo">
	        		</div>
        		</div>
         	</div>
		</div> 
	<div id="dlgTransfe" style="visibility:hidden;position:absolute;top:0px;">
			  <div class="x-dlg-hd">Lecturas Procesadas</div>
          		<div class="x-dlg-bd">
          			<!--formulario-->
          			<div id="form-ct3">
	        		</div>
        		</div>
         	</div>
		</div> 
	
<!-- fin dialog-->
    
 <div id="content">
	   <div id ="container"></div>
    	<!--fin container -->
        	<!--GRID-->
        	
    		<div id="ext-grid"></div>
    		<!-- FIN GRID-->
    		<!--filtro-->
    		 <div id="filtro" class="ylayout-panel-south">
          			<div class="x-form-clear"></div>
			</div>
            <!-- fin del filtro> -->
            <div id="maestro" class="ylayout-panel-south"></div>
   </div><!-- fin content -->
   
   <input type="hidden" name="maestro_id_lectura_reloj" id="maestro_id_lectura_reloj"  value="<?php echo $maestro_id_lectura_reloj;?>"/>
   <input type="hidden" name="codigo_empleado" id="codigo_empleado" value="<?php echo $codigo_empleado;?>"/>
   <input type="hidden" name="maestro_fecha" id="maestro_fecha" value="<?php echo $maestro_fecha;?>"/>
   <input type="hidden" name="maestro_hora" id="maestro_hora" value="<?php echo $maestro_hora;?>" />
   <input type="hidden" name="maestro_tipo_movimiento" id="maestro_tipo_movimiento" value="<?php echo $maestro_tipo_movimiento;?>" />
   
</body>
</html>