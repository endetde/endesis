<?php
/**
 * Nombre de la clase:	cls_DBProveedorCuentaAuxiliar.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tad_tad_proveedor_cuenta_auxiliar
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-12-16 16:05:57
 */

 
class cls_DBProveedorCuentaBancaria
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
	 * Nombre de la funci�n:	ListarProveedorCuentaDetalle
	 * Prop�sito:				Desplegar los registros de tad_proveedor_cuenta_auxiliar
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-16 16:05:57
	 */
	function ListarProveedorCuentaBancaria($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_proveedor_cuenta_bancaria_sel';
		$this->codigo_procedimiento = "'AD_PROCUBA_SEL'";

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
		$this->var->add_def_cols('id_proveedor_cuenta_bancaria','int4');
		$this->var->add_def_cols('id_proveedor','int4');
		$this->var->add_def_cols('id_institucion','int4');
		$this->var->add_def_cols('desc_institucion','varchar');
		$this->var->add_def_cols('nro_cuenta','varchar');
		$this->var->add_def_cols('estado_reg','varchar');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarProveedorCuentaDetalle
	 * Prop�sito:				Contar los registros de tad_proveedor_cuenta_auxiliar
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-16 16:05:57
	 */
	function ContarProveedorCuentaBancaria($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_proveedor_cuenta_bancaria_sel';
		$this->codigo_procedimiento = "'AD_PROCUBA_COUNT'";

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
	 * Nombre de la funci�n:	InsertarProveedorCuentaDetalle
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tad_proveedor_cuenta_auxiliar
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-16 16:05:57
	 */
	function InsertarProveedorCuentaBancaria($id_proveedor,$id_institucion,$nro_cuenta,$estado_reg)
	{
		
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_proveedor_cuenta_bancaria_iud';
		$this->codigo_procedimiento = "'AD_PROCUBA_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_proveedor);
		$this->var->add_param($id_institucion);
		$this->var->add_param("'$nro_cuenta'");
		$this->var->add_param("'$estado_reg'");
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarProveedorCuentaDetalle
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tad_proveedor_cuenta_auxiliar
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-16 16:05:57
	 */
	function ModificarProveedorCuentaBancaria($id_proveedor_cuenta_bancaria,$id_proveedor,$id_institucion,$nro_cuenta,$estado_reg)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_proveedor_cuenta_bancaria_iud';
		$this->codigo_procedimiento = "'AD_PROCUBA_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_proveedor_cuenta_bancaria);
		$this->var->add_param($id_proveedor);
		$this->var->add_param($id_institucion);
		$this->var->add_param("'$nro_cuenta'");
		$this->var->add_param("'$estado_reg'");
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarProveedorCuentaDetalle
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tad_proveedor_cuenta_auxiliar
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-16 16:05:57
	 */
	function EliminarProveedorCuentaBancaria($id_proveedor_cuenta_bancaria)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_proveedor_cuenta_bancaria_iud';
		$this->codigo_procedimiento = "'AD_PROCUBA_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_proveedor_cuenta_bancaria);
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
	 * Nombre de la funci�n:	ValidarProveedorCuentaDetalle
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tad_proveedor_cuenta_auxiliar
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-12-16 16:05:57
	 */
	function ValidarProveedorCuentaBancaria($operacion_sql,$id_proveedor_cuenta_bancaria,$id_proveedor,$id_institucion,$nro_cuenta,$estado_reg)
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
				//Validar id_proveedor_cuenta_auxiliar - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_proveedor_cuenta_bancaria");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_proveedor_cuenta_bancaria", $id_proveedor_cuenta_bancaria))
				{
					$this->salida = $valid->salida;
					return false;
				}
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

			//Validar id_cuenta - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_institucion");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_institucion", $id_institucion))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar id_cuenta_anticipo - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nro_cuenta");
			$tipo_dato->set_MaxLength(30);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "nro_cuenta", $nro_cuenta))
			{
				$this->salida = $valid->salida;
				return false;
			}//Validar id_cuenta_garantia - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_reg");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
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
			//Validar id_proveedor_cuenta_auxiliar - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_proveedor_cuenta_bancaria");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_proveedor_cuenta_bancaria", $id_proveedor_cuenta_bancaria))
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