<?php
/**
 * Nombre de la clase:	cls_DBMotivoIngresoCuenta.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tal_tal_motivo_ingreso_cuenta
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-10-17 15:49:49
 */

class cls_DBMotivoIngresoCuenta
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
	 * Nombre de la funci�n:	ListarMotivoIngresoCuenta
	 * Prop�sito:				Desplegar los registros de tal_motivo_ingreso_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 15:49:49
	 */
	function ListarMotivoIngresoCuenta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_motivo_ingreso_cuenta_sel';
		$this->codigo_procedimiento = "'AL_MINGCU_SEL'";

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
		$this->var->add_def_cols('id_motivo_ingreso_cuenta','int4');
		$this->var->add_def_cols('id_motivo_ingreso','int4');
		$this->var->add_def_cols('desc_motivo_ingreso','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_cuenta','int4');
		$this->var->add_def_cols('desc_cuenta','varchar');
		$this->var->add_def_cols('id_fina_regi_prog_proy_acti','int4');
		$this->var->add_def_cols('desc_fina_regi_prog_proy_acti','int4');
	    $this->var->add_def_cols('nombre_financiador','varchar');
		$this->var->add_def_cols('nombre_regional','varchar');
		$this->var->add_def_cols('nombre_programa','varchar');
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('nombre_actividad','varchar');
		
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
		$this->var->add_def_cols('codigo_ep','text');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarMotivoIngresoCuenta
	 * Prop�sito:				Contar los registros de tal_motivo_ingreso_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 15:49:49
	 */
	function ContarMotivoIngresoCuenta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_motivo_ingreso_cuenta_sel';
		$this->codigo_procedimiento = "'AL_MINGCU_COUNT'";

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
	 * Nombre de la funci�n:	InsertarMotivoIngresoCuenta
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_motivo_ingreso_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 15:49:49
	 */
	function InsertarMotivoIngresoCuenta($id_motivo_ingreso_cuenta,$id_motivo_ingreso,$descripcion,$fecha_reg,$id_cuenta,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_motivo_ingreso_cuenta_iud';
		$this->codigo_procedimiento = "'AL_MINGCU_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_motivo_ingreso);
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_cuenta);
		$this->var->add_param("'$id_financiador'");
		$this->var->add_param("'$id_regional'");
		$this->var->add_param("'$id_programa'");
		$this->var->add_param("'$id_proyecto'");
		$this->var->add_param("'$id_actividad'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarMotivoIngresoCuenta
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_motivo_ingreso_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 15:49:49
	 */
	function ModificarMotivoIngresoCuenta($id_motivo_ingreso_cuenta,$id_motivo_ingreso,$descripcion,$fecha_reg,$id_cuenta,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_motivo_ingreso_cuenta_iud';
		$this->codigo_procedimiento = "'AL_MINGCU_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_motivo_ingreso_cuenta);
		$this->var->add_param($id_motivo_ingreso);
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_cuenta);
		$this->var->add_param("'$id_financiador'");
		$this->var->add_param("'$id_regional'");
		$this->var->add_param("'$id_programa'");
		$this->var->add_param("'$id_proyecto'");
		$this->var->add_param("'$id_actividad'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarMotivoIngresoCuenta
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_motivo_ingreso_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 15:49:49
	 */
	function EliminarMotivoIngresoCuenta($id_motivo_ingreso_cuenta)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_motivo_ingreso_cuenta_iud';
		$this->codigo_procedimiento = "'AL_MINGCU_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_motivo_ingreso_cuenta);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
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
	 * Nombre de la funci�n:	ValidarMotivoIngresoCuenta
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tal_motivo_ingreso_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 15:49:49
	 */
	function ValidarMotivoIngresoCuenta($operacion_sql,$id_motivo_ingreso_cuenta,$id_motivo_ingreso,$descripcion,$fecha_reg,$id_cuenta,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
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
				//Validar id_motivo_ingreso_cuenta - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_motivo_ingreso_cuenta");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_motivo_ingreso_cuenta", $id_motivo_ingreso_cuenta))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_motivo_ingreso - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_motivo_ingreso");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_motivo_ingreso", $id_motivo_ingreso))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar descripcion - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(100);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion))
			{
				$this->salida = $valid->salida;
				return false;
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

			//Validar id_cuenta - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_cuenta");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cuenta", $id_cuenta))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_financiador - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_financiador");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_financiador", $id_financiador))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_regional - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_regional");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_regional", $id_regional))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_programa - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_programa");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_programa", $id_programa))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_proyecto - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_proyecto");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_proyecto", $id_proyecto))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_actividad - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_actividad");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_actividad", $id_actividad))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_motivo_ingreso_cuenta - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_motivo_ingreso_cuenta");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_motivo_ingreso_cuenta", $id_motivo_ingreso_cuenta))
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