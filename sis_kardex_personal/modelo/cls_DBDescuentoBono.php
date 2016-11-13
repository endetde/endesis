<?php
/**
 * Nombre de la clase:	cls_DBDescuentoBono.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tkp_tkp_descuento_bono
 * Autor:				Mercedes Zambrana Meneses
 * Fecha creaci�n:		12-08-2010
 */

class cls_DBDescuentoBono
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
	 * Nombre de la funci�n:	ListarDescuentoBono
	 * Prop�sito:				Desplegar los registros de tkp_descuento_bono
	 * Autor:				    Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		12-08-2010
	 */
	function ListarDescuentoBono($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_descuento_bono_sel';
		$this->codigo_procedimiento = "'KP_EMPBONO_SEL'";

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
		$this->var->add_def_cols('id_descuento_bono','int4');
		$this->var->add_def_cols('id_tipo_descuento_bono','int4');
		$this->var->add_def_cols('id_empleado','int4');
		$this->var->add_def_cols('id_moneda','int4');
		
		$this->var->add_def_cols('monto_total','numeric');
		$this->var->add_def_cols('num_cuotas','int4');
		$this->var->add_def_cols('monto_faltante','numeric');
		$this->var->add_def_cols('valor_por_cuota','numeric');
		$this->var->add_def_cols('fecha_ini','date');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('desc_empleado','text');
		$this->var->add_def_cols('desc_tipo_descuento_bono','varchar');
		$this->var->add_def_cols('desc_moneda','varchar');
		$this->var->add_def_cols('cuotas','varchar');
		$this->var->add_def_cols('fecha_fin','date');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	   /* echo $this->query;
	    exit;*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarDescuentoBono
	 * Prop�sito:				Contar los registros de tkp_descuento_bono
	 * Autor:				    Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		12-08-2010
	 */
	function ContarDescuentoBono($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_descuento_bono_sel';
		$this->codigo_procedimiento = "'KP_EMPBONO_COUNT'";

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
	 * Nombre de la funci�n:	InsertarDescuentoBono
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_descuento_bono
	 * Autor:				    Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		12-08-2010
	 */
	function InsertarDescuentoBono($id_descuento_bono,$id_tipo_descuento_bono,$id_empleado,$id_moneda,$monto_total,
	$num_cuotas,$monto_faltante,$valor_por_cuota,$fecha_ini,$fecha_reg,$estado_reg,$cuotas,$fecha_fin)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_descuento_bono_iud';
		$this->codigo_procedimiento = "'KP_EMPBONO_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("$id_tipo_descuento_bono");
		$this->var->add_param("$id_empleado");
		$this->var->add_param("$id_moneda");
		$this->var->add_param("$monto_total");
		
		$this->var->add_param("$num_cuotas");
		$this->var->add_param("$monto_faltante");
		$this->var->add_param("$valor_por_cuota");
		$this->var->add_param("'$fecha_ini'");
		
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param("'$estado_reg'");
		$this->var->add_param("'$cuotas'");
		$this->var->add_param("'$fecha_fin'");
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarDescuentoBono
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_descuento_bono
	 * Autor:				    Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		12-08-2010
	 */
	function ModificarDescuentoBono($id_descuento_bono,$id_tipo_descuento_bono,$id_empleado,$id_moneda,$monto_total,
	$num_cuotas,$monto_faltante,$valor_por_cuota,$fecha_ini,$fecha_reg,$estado_reg,$cuotas,$fecha_fin)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_descuento_bono_iud';
		$this->codigo_procedimiento = "'KP_EMPBONO_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_descuento_bono);
		$this->var->add_param("$id_tipo_descuento_bono");
		$this->var->add_param("$id_empleado");
		$this->var->add_param("$id_moneda");
		$this->var->add_param("$monto_total");
		
		$this->var->add_param("$num_cuotas");
		$this->var->add_param("$monto_faltante");
		$this->var->add_param("$valor_por_cuota");
		$this->var->add_param("'$fecha_ini'");
		
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param("'$estado_reg'");
		$this->var->add_param("'$cuotas'");
		
		$this->var->add_param("'$fecha_fin'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarDescuentoBono
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tkp_descuento_bono
	 * Autor:				    Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		12-08-2010
	 */
	function EliminarDescuentoBono($id_descuento_bono)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_descuento_bono_iud';
		$this->codigo_procedimiento = "'KP_EMPBONO_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_descuento_bono);
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
		$this->var->add_param("NULL");//cuotas -- 24mar11
		
		$this->var->add_param("NULL");// fecha_fin
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	
	/**
	 * Nombre de la funci�n:	ValidarDescuentoBono
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tkp_descuento_bono
	 * Autor:				    Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		12-08-2010
	 */
	
	function ValidarDescuentoBono($operacion_sql,$id_descuento_bono,$id_tipo_descuento_bono,$id_empleado,$id_moneda,$monto_total,
	$num_cuotas,$monto_faltante,$valor_por_cuota,$fecha_ini,$fecha_reg,$estado_reg)
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
				//Validar id_empleado_frppa - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_descuento_bono");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_descuento_bono", $id_descuento_bono))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_empleado - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_tipo_descuento_bono");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_descuento_bono", $id_tipo_descuento_bono))
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
			
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_moneda");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_moneda", $id_moneda))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			
			

			//Validar fecha_registro - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_reg");
			$tipo_dato->set_AllowBlank("true");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_reg", $fecha_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}

			
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_reg");
			$tipo_dato->set_MaxLength(20);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado_reg", $estado_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_empleado_frppa - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_descuento_bono");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_descuento_bono", $id_descuento_bono))
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