<?php
/**
 * Nombre de la clase:	cls_DBFirmaAutorizadaTransf.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tal_tal_firma_autorizada_transf
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-12-13 10:09:57
 */

class cls_DBFirmaAutorizadaTransf
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
	 * Nombre de la funci�n:	ListarFirmaAutorizadaTransf
	 * Prop�sito:				Desplegar los registros de tal_firma_autorizada_transf
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-12-13 10:09:57
	 */
	function ListarFirmaAutorizadaTransf($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_firma_autorizada_transf_sel';
		$this->codigo_procedimiento = "'AL_FATRAN_SEL'";

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
		$this->var->add_def_cols('id_firma_autorizada_transf','int4');
		$this->var->add_def_cols('estado_registro','varchar');
		$this->var->add_def_cols('fecha_registro','date');
		$this->var->add_def_cols('id_empleado','int4');
		$this->var->add_def_cols('desc_empleado','int4');
		$this->var->add_def_cols('id_motivo_ingreso_cuenta','int4');
		$this->var->add_def_cols('desc_motivo_ingreso_cuenta','varchar');
		$this->var->add_def_cols('id_motivo_salida_cuenta','int4');
		$this->var->add_def_cols('desc_motivo_salida_cuenta','varchar');
		
		$this->var->add_def_cols('desc_motivo_ingreso','varchar');
		$this->var->add_def_cols('desc_motivo_salida','varchar');
		$this->var->add_def_cols('id_motivo_ingreso','int4');
		$this->var->add_def_cols('id_motivo_salida','int4');
		$this->var->add_def_cols('desc_persona','text');
		
		$this->var->add_def_cols('id_financiador','int4');				
		$this->var->add_def_cols('id_regional','int4');	
		$this->var->add_def_cols('id_programa','int4');
		$this->var->add_def_cols('id_proyecto','int4');											
		$this->var->add_def_cols('id_actividad','int4');	

		$this->var->add_def_cols('codigo_financiador','varchar');
		$this->var->add_def_cols('codigo_regional','varchar');
		$this->var->add_def_cols('codigo_programa','varchar');
		$this->var->add_def_cols('codigo_proyecto','varchar');
		$this->var->add_def_cols('codigo_actividad','varchar');	
		
		$this->var->add_def_cols('id_financiador_sal','int4');				
		$this->var->add_def_cols('id_regional_sal','int4');	
		$this->var->add_def_cols('id_programa_sal','int4');
		$this->var->add_def_cols('id_proyecto_sal','int4');											
		$this->var->add_def_cols('id_actividad_sal','int4');	
		
		$this->var->add_def_cols('codigo_financiador_sal','varchar');
		$this->var->add_def_cols('codigo_regional_sal','varchar');
		$this->var->add_def_cols('codigo_programa_sal','varchar');
		$this->var->add_def_cols('codigo_proyecto_sal','varchar');
		$this->var->add_def_cols('codigo_actividad_sal','varchar');	
                            

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarFirmaAutorizadaTransf
	 * Prop�sito:				Contar los registros de tal_firma_autorizada_transf
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-12-13 10:09:57
	 */
	function ContarFirmaAutorizadaTransf($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_firma_autorizada_transf_sel';
		$this->codigo_procedimiento = "'AL_FATRAN_COUNT'";

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
	 * Nombre de la funci�n:	InsertarFirmaAutorizadaTransf
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_firma_autorizada_transf
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-12-13 10:09:57
	 */
	function InsertarFirmaAutorizadaTransf($id_firma_autorizada_transf,$estado_registro,$fecha_registro,$id_empleado,$id_motivo_ingreso_cuenta,$id_motivo_salida_cuenta)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_firma_autorizada_transf_iud';
		$this->codigo_procedimiento = "'AL_FATRAN_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$estado_registro'");
		$this->var->add_param("'$fecha_registro'");
		$this->var->add_param($id_empleado);
		$this->var->add_param($id_motivo_ingreso_cuenta);
		$this->var->add_param($id_motivo_salida_cuenta);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarFirmaAutorizadaTransf
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_firma_autorizada_transf
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-12-13 10:09:57
	 */
	function ModificarFirmaAutorizadaTransf($id_firma_autorizada_transf,$estado_registro,$fecha_registro,$id_empleado,$id_motivo_ingreso_cuenta,$id_motivo_salida_cuenta)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_firma_autorizada_transf_iud';
		$this->codigo_procedimiento = "'AL_FATRAN_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_firma_autorizada_transf);
		$this->var->add_param("'$estado_registro'");
		$this->var->add_param("'$fecha_registro'");
		$this->var->add_param($id_empleado);
		$this->var->add_param($id_motivo_ingreso_cuenta);
		$this->var->add_param($id_motivo_salida_cuenta);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarFirmaAutorizadaTransf
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_firma_autorizada_transf
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-12-13 10:09:57
	 */
	function EliminarFirmaAutorizadaTransf($id_firma_autorizada_transf)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_firma_autorizada_transf_iud';
		$this->codigo_procedimiento = "'AL_FATRAN_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_firma_autorizada_transf);
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
	 * Nombre de la funci�n:	ValidarFirmaAutorizadaTransf
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tal_firma_autorizada_transf
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-12-13 10:09:57
	 */
	function ValidarFirmaAutorizadaTransf($operacion_sql,$id_firma_autorizada_transf,$estado_registro,$fecha_registro,$id_empleado,$id_motivo_ingreso_cuenta,$id_motivo_salida_cuenta)
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
				//Validar id_firma_autorizada_transf - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_firma_autorizada_transf");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_firma_autorizada_transf", $id_firma_autorizada_transf))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar estado_registro - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_registro");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado_registro", $estado_registro))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fecha_registro - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_registro");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_registro", $fecha_registro))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_empleado - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado", $id_empleado))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_motivo_ingreso_cuenta - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_motivo_ingreso_cuenta");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_motivo_ingreso_cuenta", $id_motivo_ingreso_cuenta))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_motivo_salida_cuenta - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_motivo_salida_cuenta");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_motivo_salida_cuenta", $id_motivo_salida_cuenta))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validaci�n de reglas de datos

			//Validar estado_registro
			$check = array ("activo","inactivo");
			if(!in_array($estado_registro,$check))
			{
				$this->salida[0] = "f";
				$this->salida[1] = "Error de validaci�n en columna 'estado_registro': El valor no est� dentro del dominio definido";
				$this->salida[2] = "ORIGEN = $this->nombre_archivo";
				$this->salida[3] = "PROC = ValidarFirmaAutorizadaTransf";
				$this->salida[4] = "NIVEL = 3";
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_firma_autorizada_transf - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_firma_autorizada_transf");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_firma_autorizada_transf", $id_firma_autorizada_transf))
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