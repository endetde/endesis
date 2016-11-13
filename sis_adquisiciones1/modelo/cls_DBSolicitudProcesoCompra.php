<?php
/**
 * Nombre de la clase:	cls_DBSolicitudProcesoCompra.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tad_tad_solicitud_proceso_compra
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-05-19 15:28:38
 */

 
class cls_DBSolicitudProcesoCompra
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
	 * Nombre de la funci�n:	ListarSolicitudProcesoCompra
	 * Prop�sito:				Desplegar los registros de tad_solicitud_proceso_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-19 15:28:38
	 */
	function ListarSolicitudProcesoCompra($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_proceso_compra_sel';
		$this->codigo_procedimiento = "'AD_SOPRCOM_SEL'";

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

		
		
       $this->var->add_def_cols(' id_solicitud_proceso_compra','int4');
       $this->var->add_def_cols('fecha_reg','date');
       $this->var->add_def_cols('id_solicitud_compra','int4');
       $this->var->add_def_cols('id_proceso_compra','int4');
	   $this->var->add_def_cols('num_solicitud_sis','int4');
	   $this->var->add_def_cols('num_solicitud','int4');
	   $this->var->add_def_cols('id_fina_regi_prog_proy_acti','int4');
	   $this->var->add_def_cols('solicitante','text');
	   $this->var->add_def_cols('id_prog_proy_acti','int4');
	   $this->var->add_def_cols('id_financiador','int4');
	   $this->var->add_def_cols('id_regional','int4');
	   $this->var->add_def_cols('id_programa','int4');
	   $this->var->add_def_cols('id_proyecto','int4');
	   $this->var->add_def_cols('id_actividad','int4');
	   $this->var->add_def_cols('nombre_financiador','varchar');
	   $this->var->add_def_cols('nombre_regional','varchar');
       $this->var->add_def_cols('nombre_programa','varchar');
	   $this->var->add_def_cols('nombre_proyecto','varchar');
	   $this->var->add_def_cols('nombre_actividad','varchar');
	   $this->var->add_def_cols('codigo_financiador','varchar');
	   $this->var->add_def_cols('codigo_regional','varchar');
	   $this->var->add_def_cols('codigo_programa','varchar');
	   $this->var->add_def_cols('codigo_proyecto','varchar');
       $this->var->add_def_cols('codigo_actividad','varchar');
	   $this->var->add_def_cols('id_empleado_frppa_solicitante','int4');
	   $this->var->add_def_cols('id_tipo_adq','int4');
	   $this->var->add_def_cols('desc_tipo_adq','varchar');
	   $this->var->add_def_cols('tipo_adq','varchar');
	   $this->var->add_def_cols('id_moneda','int4');
	   $this->var->add_def_cols('simbolo_moneda','varchar');
	   $this->var->add_def_cols('fecha_sol','date');
       $this->var->add_def_cols('hora_sol','time');
       $this->var->add_def_cols('periodo_sol','int4');
	   $this->var->add_def_cols('id_parametro_adquisicion','int4');
	   

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarSolicitudProcesoCompra
	 * Prop�sito:				Contar los registros de tad_solicitud_proceso_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-19 15:28:38
	 */
	function ContarSolicitudProcesoCompra($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_proceso_compra_sel';
		$this->codigo_procedimiento = "'AD_SOPRCOM_COUNT'";

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
	
	/**
	 * Nombre de la funci�n:	InsertarSolicitudProcesoCompra
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tad_solicitud_proceso_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-19 15:28:38
	 */
	function InsertarSolicitudProcesoCompra($id_solicitud_proceso_compra,$fecha_reg,$id_solicitud_compra,$id_proceso_compra)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_proceso_compra_iud';
		$this->codigo_procedimiento = "'AD_SOPRCOM_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_solicitud_compra);
		$this->var->add_param($id_proceso_compra);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarSolicitudProcesoCompra
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tad_solicitud_proceso_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-19 15:28:38
	 */
	function ModificarSolicitudProcesoCompra($id_solicitud_proceso_compra,$fecha_reg,$id_solicitud_compra,$id_proceso_compra)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_proceso_compra_iud';
		$this->codigo_procedimiento = "'AD_SOPRCOM_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_solicitud_proceso_compra);
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_solicitud_compra);
		$this->var->add_param($id_proceso_compra);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarSolicitudProcesoCompra
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tad_solicitud_proceso_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-19 15:28:38
	 */
	function EliminarSolicitudProcesoCompra($id_solicitud_proceso_compra)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_solicitud_proceso_compra_iud';
		$this->codigo_procedimiento = "'AD_SOPRCOM_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_solicitud_proceso_compra);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarSolicitudProcesoCompra
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tad_solicitud_proceso_compra
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-19 15:28:38
	 */
	function ValidarSolicitudProcesoCompra($operacion_sql,$id_solicitud_proceso_compra,$fecha_reg,$id_solicitud_compra,$id_proceso_compra)
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
				//Validar id_solicitud_proceso_compra - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_solicitud_proceso_compra");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_solicitud_proceso_compra", $id_solicitud_proceso_compra))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar fecha_reg - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_reg");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_reg", $fecha_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_solicitud_compra - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_solicitud_compra");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_solicitud_compra", $id_solicitud_compra))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_proceso_compra - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_proceso_compra");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_proceso_compra", $id_proceso_compra))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_solicitud_proceso_compra - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_solicitud_proceso_compra");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_solicitud_proceso_compra", $id_solicitud_proceso_compra))
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