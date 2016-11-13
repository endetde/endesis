<?php
/**
 * Nombre de la clase:	cls_DBRepDocumentos.php
 * Prop�sito:			Permite ejecutar  el listado de los documentos  de un comprobante de la tabla tct_tct_documento
 * Autor:				Ana Maria villegas
 * Fecha creaci�n:		2009-05-15 10:20:36
 */

 
class cls_DBRepDocumentos
{
	var $salida;
	var $query;
	var $var;
	var $nombre_funcion;
	var $codigo_procedimiento;
	var $decodificar;
	
	function __construct()
	{
		$this->decodificar=$decodificar;
	}
	
	/**
	 * Nombre de la funci�n:	Listar el Detalle de los documentos.
	 * Prop�sito:				Desplegar los registros de tct_documento
	 * Autor:				    Ana Maria
	 * Fecha de creaci�n:		2009-05-15 10:22:36
	 */
	function ListarRepDocumentosDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_comprobante,$id_moneda)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_rep_documentos_sel';
		$this->codigo_procedimiento = "'CT_RDOCVA_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

		//Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '',"'%'","'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'","'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'","'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'","'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'","'$id_actividad'"));//id_actividad
		 $this->var->add_param($id_comprobante);//id_comprobante
        $this->var->add_param($id_moneda);//id_moneda
        
		//Carga la definici�n de columnas con sus tipos de datos
        $this->var->add_def_cols('nro_documento',' BIGINT');
		//$this->var->add_def_cols('tipo_documento',' text');
		$this->var->add_def_cols('tipo_documento',' varchar');
        $this->var->add_def_cols('razon_social','VARCHAR');
        $this->var->add_def_cols('nro_nit',' VARCHAR(30)');
        $this->var->add_def_cols('nro_autorizacion',' VARCHAR(20)');
        $this->var->add_def_cols('codigo_control',' VARCHAR(20)');
        $this->var->add_def_cols('poliza_dui',' VARCHAR(20)');//10
        $this->var->add_def_cols('formulario',' VARCHAR(20)');
        $this->var->add_def_cols('fecha_documento','text');
        $this->var->add_def_cols('importe_total','NUMERIC(18,2)'); 
        $this->var->add_def_cols('importe_ice','NUMERIC(18,2)');
        $this->var->add_def_cols('importe_no_gravado','NUMERIC(18,2)');
        $this->var->add_def_cols('importe_sujeto','NUMERIC(18,2)');
        $this->var->add_def_cols('importe_credito','NUMERIC(18,2)');//20
        $this->var->add_def_cols('importe_iue','NUMERIC(18,2)');
        $this->var->add_def_cols('importe_it','NUMERIC(18,2)');
        $this->var->add_def_cols('importe_debito','NUMERIC(18,2) ');	
        $this->var->add_def_cols('id_documento','INTEGER'); //1
        $this->var->add_def_cols('id_transaccion',' INTEGER');
        $this->var->add_def_cols('id_documento_valor','INTEGER');
        $this->var->add_def_cols('id_moneda','INTEGER ');
        $this->var->add_def_cols('tipo_retencion',' NUMERIC(2,0)');
        $this->var->add_def_cols('estado_documento ','INTEGER');
		
    	//Ejecuta la funci�n de consulta
		//$res = $this->var->criterio_funcion='0=0';
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	  /*echo $this->query;
		exit();*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarRepDocumentosDet
	 * Prop�sito:				Contar los registros de tct_documento
	 * Autor:				    Ana Maria Villegas Quispe
	 * Fecha de creaci�n:		2008-09-16 17:55:36
	 */
	function ContarRepDocumentosDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_comprobante,$id_moneda)
	{
		$this->salida = "";
   	    $this->nombre_funcion = 'f_tct_rep_documentos_sel';
		$this->codigo_procedimiento = "'CT_RDOCVA_COUNT'";

		
		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

		//Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '',"'%'","'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'","'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'","'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'","'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'","'$id_actividad'"));//id_actividad

		 $this->var->add_param($id_comprobante);//id_comprobante
        $this->var->add_param($id_moneda);//id_moneda
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('total','bigint');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n
		$this->salida = $this->var->salida;

		//Si la ejecuci�n fue satisfactoria modifica la salida para que solo devuelva el total de la consulta
		if($res)
		{
			$this->salida = $this->var->salida[0][0];
		}

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

	/*echo $this->query;
		exit();*/
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	SUMAR el Detalle de los documentos.
	 * Prop�sito:				Desplegar los registros de tct_documento
	 * Autor:				    Ana Maria
	 * Fecha de creaci�n:		2009-05-15 10:22:36
	 */
	function SumDocumentosDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_comprobante,$id_moneda)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_rep_documentos_sel';
		$this->codigo_procedimiento = "'CT_RDOCSUM_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

		//Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '',"'%'","'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'","'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'","'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'","'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'","'$id_actividad'"));//id_actividad
		 $this->var->add_param($id_comprobante);//id_comprobante
        $this->var->add_param($id_moneda);//id_moneda
        
		//Carga la definici�n de columnas con sus tipos de datos
         $this->var->add_def_cols('importe_total','NUMERIC(18,2)'); 
        $this->var->add_def_cols('importe_ice','NUMERIC(18,2)');
        $this->var->add_def_cols('importe_no_gravado','NUMERIC(18,2)');
        $this->var->add_def_cols('importe_sujeto','NUMERIC(18,2)');
        $this->var->add_def_cols('importe_credito','NUMERIC(18,2)');//20
        $this->var->add_def_cols('importe_iue','NUMERIC(18,2)');
        $this->var->add_def_cols('importe_it','NUMERIC(18,2)');
        $this->var->add_def_cols('importe_debito','NUMERIC(18,2) ');	
      
    	//Ejecuta la funci�n de consulta
		//$res = $this->var->criterio_funcion='0=0';
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	  /* echo $this->query;
		exit();*/
		return $res;
	}

}?>