<?php
/**
 * Nombre:		  	    orden_compra_main.php
 * Prop�sito: 			pagina que arranca la configuracion de la vista del Hijo
 * Autor:				Generado Automaticamente
 * Fecha creaci�n:		2008-05-28 17:32:05
 *
 */
session_start();
?>
//<script>
var paginaTipoActivo;

	function main(){
	 	<?php
		//obtenemos la ruta absoluta
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$dir = "http://$host$uri/";
		echo "\nvar direccion='$dir';";
	    echo "var idContenedor='$idContenedor';";
	?>
var fa=false;
<?php if($_SESSION["ss_filtro_avanzado"]!=''){echo 'fa='.$_SESSION["ss_filtro_avanzado"].';';}?>	
var paramConfig={TamanoPagina:_CP.getConfig().ss_tam_pag,TiempoEspera:_CP.getConfig().ss_tiempo_espera,CantFiltros:1,FiltroEstructura:false,FiltroAvanzado:fa};
var maestro={id_proceso_compra:<?php echo $m_id_proceso_compra;?>,num_proceso:'<?php echo $m_num_proceso;?>',codigo_proceso:'<?php echo $m_codigo_proceso;?>',tipo_adq:'<?php echo $m_tipo_adq;?>',id_tipo_categoria_adq:'<?php echo $m_id_tipo_categoria_adq;?>',lugar_entrega:'<?php echo $m_lugar_entrega;?>',id_moneda:'<?php echo $m_id_moneda;?>',desc_moneda:'<?php echo $m_desc_moneda;?>',num_cotizacion:<?php echo $m_num_cotizacion;?>,ejecutado:'<?php echo $m_ejecutado;?>',id_depto:'<?php echo $m_id_depto;?>',avance:'<?php echo $m_avance;?>',tipo:'<?php echo $m_tipo;?>'};idContenedorPadre='<?php echo $idContenedorPadre;?>';
var elemento={idContenedor:idContenedor,pagina:new pagina_orden_compra_item(idContenedor,direccion,paramConfig,maestro,idContenedorPadre)};
_CP.setPagina(elemento);
}
Ext.onReady(main,main);