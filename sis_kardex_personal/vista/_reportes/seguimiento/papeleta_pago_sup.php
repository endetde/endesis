<?php
/**
* Nombre de archivo:	    formulacion_ejecucion.php.php
* Prop�sito:				Contenedor HTML de los objetos de la vista
* Fecha de Creaci�n:		25-06-2007
*/
session_start();


?>
<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">-->
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-15'>
<title>Reporte de Papeleta de Pago</title>
<script type="text/javascript" src="../../../sis_kardex_personal/vista/_reportes/seguimiento/js/papeleta_pago_sup_main.php?idContenedor=<?php echo "$idContenedor";?>&id_empleado=<?php echo $_SESSION["ss_id_empleado"];?>&rol_adm=<?php echo $_SESSION["ss_rol_adm"];?>&nombre_usuario=<?php echo $_SESSION["ss_nombre_usuario"];?>"></script>
</head>
<body>
</body>
</html>
