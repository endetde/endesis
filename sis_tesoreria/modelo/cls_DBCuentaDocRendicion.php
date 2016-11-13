<?php
/**
 * Nombre de la clase:	cls_DBCuentaDocRendicion.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tts_tts_devengado_dcto
 * Autor:				RCM
 * Fecha creaci�n:		19/10/2009
 */


class cls_DBCuentaDocRendicion
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
	 * Nombre de la funci�n:	ListarDevengarServicios
	 * Prop�sito:				Desplegar los registros de tts_devengado
	 * Autor:				    RCM
	 * Fecha de creaci�n:		29/10/2009
	 */
	function ListarCuentaDocRendicion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_cuenta_doc_rendicion_sel';
		$this->codigo_procedimiento = "'TS_CUEREN_SEL'";

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

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_cuenta_doc_rendicion','int4');
		$this->var->add_def_cols('id_cuenta_doc','int4');
		$this->var->add_def_cols('id_documento','int4');
		$this->var->add_def_cols('fecha_reg','text');
		$this->var->add_def_cols('id_transaccion','int4');
		$this->var->add_def_cols('tipo_documento','numeric');
		$this->var->add_def_cols('nro_documento','bigint');
		$this->var->add_def_cols('fecha_documento','text');
		$this->var->add_def_cols('razon_social','varchar');
		$this->var->add_def_cols('nro_nit','varchar');
		$this->var->add_def_cols('nro_autorizacion','varchar');
		$this->var->add_def_cols('codigo_control','varchar');
		$this->var->add_def_cols('poliza_dui','varchar');
		$this->var->add_def_cols('formulario','varchar');
		$this->var->add_def_cols('tipo_retencion','numeric');
		$this->var->add_def_cols('estado_documento','integer');
		$this->var->add_def_cols('id_documento_valor','integer');
		$this->var->add_def_cols('importe_total','numeric');
		$this->var->add_def_cols('importe_ice','numeric');
		$this->var->add_def_cols('importe_exento','numeric');
		$this->var->add_def_cols('importe_sujeto','numeric');
		$this->var->add_def_cols('importe_credito','numeric');
		$this->var->add_def_cols('importe_iue','numeric');
		$this->var->add_def_cols('importe_it','numeric');
		$this->var->add_def_cols('importe_debito','numeric');
		$this->var->add_def_cols('desc_tipo_documento','varchar');
		$this->var->add_def_cols('id_moneda','integer');
		$this->var->add_def_cols('desc_moneda','varchar');
		$this->var->add_def_cols('importe_rendicion','numeric');
		
		$this->var->add_def_cols('id_presupuesto','integer');
		$this->var->add_def_cols('desc_presupuesto','text');
		$this->var->add_def_cols('id_concepto_ingas','integer');
		$this->var->add_def_cols('desc_concepto_ingas','text');
		$this->var->add_def_cols('id_orden_trabajo','integer');
		$this->var->add_def_cols('desc_orden_trabajo','varchar');
		$this->var->add_def_cols('importe_total_ren','numeric');
		$this->var->add_def_cols('estado','varchar');
		
		$this->var->add_def_cols('id_partida','int4');	      
		$this->var->add_def_cols('desc_partida','text');
		$this->var->add_def_cols('id_cuenta','int4');		
 		$this->var->add_def_cols('desc_cuenta','text');
 		$this->var->add_def_cols('id_auxiliar','int4');
 		$this->var->add_def_cols('desc_auxiliar','text');
 		$this->var->add_def_cols('fecha_ini','date');
 		$this->var->add_def_cols('fecha_fin','date');
 		$this->var->add_def_cols('sw_viatico','varchar');
 		$this->var->add_def_cols('importe_retencion','numeric');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo "query:".$this->query;
		exit;*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ObtenerDatosProveedor
	 * Prop�sito:				Desplegar los registros de tts_devengado
	 * Autor:				    RCM
	 * Fecha de creaci�n:		29/10/2009
	 */
	function ObtenerDatosProveedor($nit)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_cuenta_doc_rendicion_sel';
		$this->codigo_procedimiento = "'TS_DATPROV_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		$cant=1;
		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero =  $cant;
		$this->var->sortcol =  "''";
		$this->var->sortdir = "''";
		$this->var->criterio_filtro = "'$nit'";

		//Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '',"'%'","'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'","'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'","'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'","'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'","'$id_actividad'"));//id_actividad

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('resultado','int4');
		$this->var->add_def_cols('razon_social','varchar');
		$this->var->add_def_cols('nro_autoriza','varchar');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo "query:".$this->query;
		exit;*/
		
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarCuentaDocRendicion
	 * Prop�sito:				Contar los registros de tts_devengado
	 * Autor:				    RCM
	 * Fecha de creaci�n:		29/10/2009
	 */
	function ContarCuentaDocRendicion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_cuenta_doc_rendicion_sel';
		$this->codigo_procedimiento = "'TS_CUEREN_COUNT'";
		
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

		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	function ListarImportesTotalesRendicion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_cuenta_doc_rendicion_sel';
		$this->codigo_procedimiento = "'TS_IMPTOTREN_SEL'";

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

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_cuenta_doc','int4');		
		$this->var->add_def_cols('importe_total','numeric');
		$this->var->add_def_cols('importe_ice','numeric');
		$this->var->add_def_cols('importe_exento','numeric');
		$this->var->add_def_cols('importe_sujeto','numeric');
		$this->var->add_def_cols('importe_credito','numeric');
		$this->var->add_def_cols('importe_iue','numeric');
		$this->var->add_def_cols('importe_it','numeric');
		$this->var->add_def_cols('importe_debito','numeric');		
		$this->var->add_def_cols('importe_rendicion','numeric');		
		$this->var->add_def_cols('importe_total_ren','numeric');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		//echo "query:".$this->query;
		//exit;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	EliminarRendiciones
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tts_caja_regis
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-11-06 19:01:07
	 */
	function MarcarRendiciones($id_cuenta_doc_rendicion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_cuenta_doc_rendicion_iud';
		$this->codigo_procedimiento = "'TS_MARCDR_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_cuenta_doc_rendicion);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		
		//Ejecuta la funcion
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarRegistroDocumento
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tct_documento
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-09-16 17:57:13
	 */
	function ModificarDocumentoCuentaDocRendicion($id_cuenta_doc_rendicion,$nro_documento,$fecha_documento,$razon_social,$nro_nit,$nro_autorizacion,$codigo_control,$id_orden_trabajo,$fecha_ini,$fecha_fin,$importe_retencion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_cuenta_doc_rendicion_iud';
		$this->codigo_procedimiento = "'TS_DOCREN_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_cuenta_doc_rendicion);
		$this->var->add_param("NULL");
		$this->var->add_param($nro_documento);
		$this->var->add_param("'$fecha_documento'");
		$this->var->add_param("'$razon_social'");
		$this->var->add_param("'$nro_nit'");
		$this->var->add_param("'$nro_autorizacion'");
		$this->var->add_param("'$codigo_control'");
		$this->var->add_param("$id_orden_trabajo");
		$this->var->add_param("'$fecha_ini'");
		$this->var->add_param("'$fecha_fin'");
		$this->var->add_param($importe_retencion);
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarDevengarServicios
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tts_devengado
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-21 15:43:26
	 */
	function ValidarDevengarServicios($operacion_sql,$id_devengado,$id_concepto_ingas,$id_moneda,$importe_devengado,$estado_devengado,$id_proveedor,$tipo_devengado)
	{
		$this->salida = "";
		$valid = new cls_validacion_serv();

		//Clase para validar el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();

		//Ejecuta la validaci�n por el tipo de operaci�n
		if($operacion_sql=='insert' || $operacion_sql=='update')
		{
			if($operacion_sql == 'update')
			{
				//Validar id_devengado - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_devengado");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_devengado", $id_devengado))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_concepto_ingas - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_concepto_ingas");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_concepto_ingas", $id_concepto_ingas))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_moneda - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_moneda");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_moneda", $id_moneda))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar importe_devengado - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("importe_devengado");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "importe_devengado", $importe_devengado))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_proveedor - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_proveedor");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_proveedor", $id_proveedor))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_devengado - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_devengado");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_devengado", $id_devengado))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validaci�n exitosa
			return true;
		}
		else
		{
			return false;
		}
	}
}?>