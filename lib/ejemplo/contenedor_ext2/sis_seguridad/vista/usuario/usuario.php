<?php
/**
* Nombre de archivo:	    parametro_almacen
* Prop�sito:				Contenedor HTML de los objetos de la vista
* Fecha de Creaci�n:		2007-10-18 15:38:46
* Autor:					Rensi Arteaga Copari
*/
session_start();
?>
<script type='text/javascript' src='../../../sis_seguridad/vista/usuario/js/usuario.js'></script>
<script type='text/javascript' src='../../../sis_seguridad/vista/usuario/js/usuario_main.php?idContenedor=<?php echo $_POST["idContenedor"];?>'></script>
<div id="pag-<?php echo  $_POST["idContenedor"];?>"></div>