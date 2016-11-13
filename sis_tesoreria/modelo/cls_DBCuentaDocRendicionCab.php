<?php
/**
 * Nombre de la clase:	cls_DBCuentaDocRendicionCab.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tts_tts_cuenta_doc
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2009-10-27 19:06:46
 */

 
class cls_DBCuentaDocRendicionCab
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
	 * Nombre de la funci�n:	ListarCuentaDocRendicion
	 * Prop�sito:				Desplegar los registros de tts_cuenta_doc
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2009-10-27 19:06:46
	 */
	function ListarCuentaDocRendicionCab($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_cuenta_doc_sel';
		$this->codigo_procedimiento = "'TS_RENCAB_SEL'";

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
		$this->var->add_param("NULL");

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_cuenta_doc','int4');
		$this->var->add_def_cols('fecha_ini','date');
		$this->var->add_def_cols('fecha_fin','date');
		$this->var->add_def_cols('fecha_sol','date');
		$this->var->add_def_cols('id_usuario_rendicion','integer');
		$this->var->add_def_cols('desc_usuario','text');
		$this->var->add_def_cols('estado','varchar');
		$this->var->add_def_cols('nro_documento','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('id_depto','integer');
		$this->var->add_def_cols('desc_depto','varchar');
		$this->var->add_def_cols('fk_id_cuenta_doc','int4');
		$this->var->add_def_cols('id_presupuesto','int4');
		$this->var->add_def_cols('desc_presupuesto','text');
		$this->var->add_def_cols('id_empleado','int4');
		$this->var->add_def_cols('desc_empleado','text');
		$this->var->add_def_cols('id_moneda','int4');
		$this->var->add_def_cols('desc_moneda','varchar');
		$this->var->add_def_cols('id_comprobante','int4');
		$this->var->add_def_cols('tipo_cuenta_doc','varchar');
		$this->var->add_def_cols('id_parametro','int4');
		$this->var->add_def_cols('desc_parametro','numeric');
		$this->var->add_def_cols('id_autorizacion','integer');
		$this->var->add_def_cols('desc_autorizacion','text');
		$this->var->add_def_cols('tipo_contrato','varchar');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo $this->query;
		exit;*/
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarCuentaDocRendicion
	 * Prop�sito:				Contar los registros de tts_cuenta_doc
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2009-10-27 19:06:46
	 */
	function ContarCuentaDocRendicionCab($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_cuenta_doc_sel';
		$this->codigo_procedimiento = "'TS_RENCAB_COUNT'";

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
		$this->var->add_param("NULL");
		
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
	
	/**
	 * Nombre de la funci�n:	InsertarCuentaDocRendicion
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tts_cuenta_doc
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2009-10-27 19:06:46
	 */
	function InsertarCuentaDocRendicionCab($fecha_ini,$fecha_fin,$observaciones,$fk_id_cuenta_doc,$tipo_cuenta_doc,$fecha_sol,$tipo_contrato)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_cuenta_doc_iud';
		$this->codigo_procedimiento = "'TS_RENCAB_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("'$fecha_ini'");
		$this->var->add_param("'$fecha_fin'");
		$this->var->add_param("NULL");
		$this->var->add_param("'$tipo_contrato'");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("NULL");
		$this->var->add_param("'$tipo_cuenta_doc'");
		$this->var->add_param($fk_id_cuenta_doc);
		$this->var->add_param("NULL");
		$this->var->add_param("'$fecha_sol'");
		$this->var->add_param("NULL");//fa_solicitud
		$this->var->add_param("NULL");//id_caja
		$this->var->add_param("NULL");//id_cajero
		$this->var->add_param("NULL");//id_cuenta_bancaria
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//id_proveedor
		$this->var->add_param("NULL");//importe_entregado
		$this->var->add_param("NULL");//id_autorizacion
		$this->var->add_param("NULL");//nombre_cheque
		$this->var->add_param("NULL");//tipo_rendicion
		
		//echo "asdasd:".$fk_id_cuenta_doc;
		//exit;

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
       /*if($_SESSION['ss_id_usuario']==131){
		     echo $this->query;
			 exit;
        }*/		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarCuentaDocRendicion
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tts_cuenta_doc
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2009-10-27 19:06:46
	 */
	function ModificarCuentaDocRendicionCab($id_cuenta_doc,$fecha_ini,$fecha_fin,$observaciones,$fk_id_cuenta_doc,$fecha_sol,$id_autorizacion,$tipo_contrato)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_cuenta_doc_iud';
		$this->codigo_procedimiento = "'TS_RENCAB_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("$id_cuenta_doc");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("'$fecha_ini'");
		$this->var->add_param("'$fecha_fin'");
		$this->var->add_param("NULL");
		$this->var->add_param("'$tipo_contrato'");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("$fk_id_cuenta_doc");
		$this->var->add_param("NULL");
		$this->var->add_param("'$fecha_sol'");
		$this->var->add_param("NULL");//fa_solicitud
		$this->var->add_param("NULL");//id_caja
		$this->var->add_param("NULL");//id_cajero
		$this->var->add_param("NULL");//id_cuenta_bancaria
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//id_proveedor
		$this->var->add_param("NULL");//importe_entregado
		$this->var->add_param($id_autorizacion);//id_autorizacion
		$this->var->add_param("NULL");//nombre_cheque
		$this->var->add_param("NULL");//tipo_rendicion

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
/*if($_SESSION['ss_id_usuario']==131){
		     echo $this->query;
			 exit;
        }*/		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarCuentaDocRendicion
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tts_cuenta_doc
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2009-10-27 19:06:46
	 */
	function EliminarCuentaDocRendicionCab($id_cuenta_doc)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_cuenta_doc_iud';
		$this->codigo_procedimiento = "'TS_RENCAB_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("$id_cuenta_doc");
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
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//fa_solicitud
		$this->var->add_param("NULL");//id_caja
		$this->var->add_param("NULL");//id_cajero
		$this->var->add_param("NULL");//id_cuenta_bancaria
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//id_proveedor
		$this->var->add_param("NULL");//importe_entregado
		$this->var->add_param("NULL");//id_autorizacion
		$this->var->add_param("NULL");//nombre_cheque
		$this->var->add_param("NULL");//tipo_rendicion

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarCuentaDocRendicion
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tts_cuenta_doc
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2009-10-27 19:06:46
	 */
	function ValidarCuentaDocRendicionCab($operacion_sql,$id_cuenta_doc,$fecha_ini,$fecha_fin,$nro_documento,$fk_id_cuenta_doc)
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
				//Validar id_cuenta_doc - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_cuenta_doc");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cuenta_doc", $id_cuenta_doc))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar fecha_ini - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_ini");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_ini", $fecha_ini))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fecha_fin - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_fin");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_fin", $fecha_fin))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar nro_documento - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nro_documento");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "nro_documento", $nro_documento))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fk_id_cuenta_doc - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fk_id_cuenta_doc");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "fk_id_cuenta_doc", $fk_id_cuenta_doc))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_cuenta_doc - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_cuenta_doc");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cuenta_doc", $id_cuenta_doc))
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
