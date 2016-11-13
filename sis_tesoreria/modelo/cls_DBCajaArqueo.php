<?php
/**
 * Nombre de la clase:	cls_DBCajaArqueo.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tts_tts_caja_arqueo
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-10-23 15:28:02
 */

 
class cls_DBCajaArqueo
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
	 * Nombre de la funci�n:	ListarArqueo
	 * Prop�sito:				Desplegar los registros de tts_caja_arqueo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-23 15:28:02
	 */
	function ListarArqueo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_caja_arqueo_sel';
		$this->codigo_procedimiento = "'TS_ARQUEO_SEL'";

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
		$this->var->add_def_cols('id_caja_arqueo','int4');
		$this->var->add_def_cols('id_caja','int4');
		$this->var->add_def_cols('nombre_unidad_unidad_organizacional','varchar');
		$this->var->add_def_cols('desc_caja','varchar');
		$this->var->add_def_cols('id_cajero','int4');
		$this->var->add_def_cols('apellido_paterno_persona','varchar');
		$this->var->add_def_cols('apellido_materno_persona','varchar');
		$this->var->add_def_cols('nombre_persona','varchar');
		$this->var->add_def_cols('codigo_empleado_empleado','varchar');
		$this->var->add_def_cols('estado_cajero_cajero','numeric');
		$this->var->add_def_cols('desc_cajero','text');
		$this->var->add_def_cols('fecha_arqueo','date');
		$this->var->add_def_cols('sw_resultado','numeric');
		$this->var->add_def_cols('obs_arqueo','varchar');
		$this->var->add_def_cols('tipo_caja','numeric');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarArqueo
	 * Prop�sito:				Contar los registros de tts_caja_arqueo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-23 15:28:02
	 */
	function ContarArqueo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_caja_arqueo_sel';
		$this->codigo_procedimiento = "'TS_ARQUEO_COUNT'";

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
	 * Nombre de la funci�n:	InsertarArqueo
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tts_caja_arqueo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-23 15:28:02
	 */
	function InsertarArqueo($id_caja_arqueo,$id_caja,$id_cajero,$fecha_arqueo,$sw_resultado,$obs_arqueo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_caja_arqueo_iud';
		$this->codigo_procedimiento = "'TS_ARQUEO_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_caja);
		$this->var->add_param($id_cajero);
		$this->var->add_param("'$fecha_arqueo'");
		$this->var->add_param($sw_resultado);
		$this->var->add_param("'$obs_arqueo'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarArqueo
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tts_caja_arqueo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-23 15:28:02
	 */
	function ModificarArqueo($id_caja_arqueo,$id_caja,$id_cajero,$fecha_arqueo,$sw_resultado,$obs_arqueo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_caja_arqueo_iud';
		$this->codigo_procedimiento = "'TS_ARQUEO_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_caja_arqueo);
		$this->var->add_param($id_caja);
		$this->var->add_param($id_cajero);
		$this->var->add_param("'$fecha_arqueo'");
		$this->var->add_param($sw_resultado);
		$this->var->add_param("'$obs_arqueo'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarArqueo
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tts_caja_arqueo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-23 15:28:02
	 */
	function EliminarArqueo($id_caja_arqueo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tts_caja_arqueo_iud';
		$this->codigo_procedimiento = "'TS_ARQUEO_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_caja_arqueo);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
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
	 * Nombre de la funci�n:	ValidarArqueo
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tts_caja_arqueo
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-23 15:28:02
	 */
	function ValidarArqueo($operacion_sql,$id_caja_arqueo,$id_caja,$id_cajero,$fecha_arqueo,$sw_resultado,$obs_arqueo)
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
				//Validar id_caja_arqueo - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_caja_arqueo");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_caja_arqueo", $id_caja_arqueo))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_caja - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_caja");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_caja", $id_caja))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_cajero - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_cajero");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cajero", $id_cajero))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fecha_arqueo - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_arqueo");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_arqueo", $fecha_arqueo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar sw_resultado - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("sw_resultado");
			$tipo_dato->set_MaxLength(131072);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "sw_resultado", $sw_resultado))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar obs_arqueo - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("obs_arqueo");
			$tipo_dato->set_MaxLength(150);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "obs_arqueo", $obs_arqueo))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_caja_arqueo - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_caja_arqueo");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_caja_arqueo", $id_caja_arqueo))
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