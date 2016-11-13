<?php
/**
 * Nombre de la clase:	cls_DBIngresoDetalle.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tal_tal_ingreso_detalle
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-10-04 15:53:15
 */

class cls_DBIngresoDetalle
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
	 * Nombre de la funci�n:	ListarIngresoDetalle
	 * Prop�sito:				Desplegar los registros de tal_ingreso_detalle
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-04 15:53:15
	 */
	function ListarIngresoDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_ingreso_detalle_sel';
		$this->codigo_procedimiento = "'AL_INGDET_SEL'";

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
		$this->var->add_param($func->iif($id_financiador == '','NULL',$id_financiador));//id_financiador
		$this->var->add_param($func->iif($id_regional == '','NULL',$id_regional));//id_regional
		$this->var->add_param($func->iif($id_programa == '','NULL',$id_programa));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '','NULL',$id_proyecto));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '','NULL',$id_actividad));//id_actividad

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_ingreso_detalle','int4');
		$this->var->add_def_cols('cantidad','numeric');
		$this->var->add_def_cols('costo','numeric');
		$this->var->add_def_cols('precio_venta','numeric');
		$this->var->add_def_cols('costo_unitario','numeric');
		$this->var->add_def_cols('precio_venta_unitario','numeric');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_ingreso','int4');
		$this->var->add_def_cols('id_item','int4');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarIngresoDetalle
	 * Prop�sito:				Contar los registros de tal_ingreso_detalle
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-04 15:53:15
	 */
	function ContarIngresoDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_ingreso_detalle_sel';
		$this->codigo_procedimiento = "'AL_INGDET_COUNT'";

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
		$this->var->add_param($func->iif($id_financiador == '','NULL',$id_financiador));//id_financiador
		$this->var->add_param($func->iif($id_regional == '','NULL',$id_regional));//id_regional
		$this->var->add_param($func->iif($id_programa == '','NULL',$id_programa));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '','NULL',$id_proyecto));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '','NULL',$id_actividad));//id_actividad
		
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
	 * Nombre de la funci�n:	InsertarIngresoDetalle
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_ingreso_detalle
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-04 15:53:15
	 */
	function InsertarIngresoDetalle($id_ingreso_detalle,$cantidad,$costo,$precio_venta,$costo_unitario,$precio_venta_unitario,$observaciones,$fecha_reg,$id_ingreso,$id_item)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_ingreso_detalle_iud';
		$this->codigo_procedimiento = "'AL_INGDET_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($cantidad);
		$this->var->add_param($costo);
		$this->var->add_param($precio_venta);
		$this->var->add_param($costo_unitario);
		$this->var->add_param($precio_venta_unitario);
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_ingreso);
		$this->var->add_param($id_item);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarIngresoDetalle
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_ingreso_detalle
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-04 15:53:15
	 */
	function ModificarIngresoDetalle($id_ingreso_detalle,$cantidad,$costo,$precio_venta,$costo_unitario,$precio_venta_unitario,$observaciones,$fecha_reg,$id_ingreso,$id_item)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_ingreso_detalle_iud';
		$this->codigo_procedimiento = "'AL_INGDET_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_ingreso_detalle);
		$this->var->add_param($cantidad);
		$this->var->add_param($costo);
		$this->var->add_param($precio_venta);
		$this->var->add_param($costo_unitario);
		$this->var->add_param($precio_venta_unitario);
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_ingreso);
		$this->var->add_param($id_item);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarIngresoDetalle
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_ingreso_detalle
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-04 15:53:15
	 */
	function EliminarIngresoDetalle($id_ingreso_detalle)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_ingreso_detalle_iud';
		$this->codigo_procedimiento = "'AL_INGDET_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_ingreso_detalle);
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
	 * Nombre de la funci�n:	ValidarIngresoDetalle
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tal_ingreso_detalle
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-04 15:53:15
	 */
	function ValidarIngresoDetalle($operacion_sql,$id_ingreso_detalle,$cantidad,$costo,$precio_venta,$costo_unitario,$precio_venta_unitario,$observaciones,$fecha_reg,$id_ingreso,$id_item)
	{
		$this->salida = "";
		$valid = new cls_validacion_serv();

		//Clase para validad el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();
	
		//Ejecuta la validaci�n por el tipo de operaci�n
		if($operacion_sql=='insert' || $operacion_sql=='update')
		{
			if($operacion_sql == 'update')
			{
				//Validar id_ingreso_detalle - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("id_ingreso_detalle");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_ingreso_detalle", $id_ingreso_detalle))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar cantidad - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("cantidad");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "cantidad", $cantidad))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar costo - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("costo");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "costo", $costo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar precio_venta - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("precio_venta");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "precio_venta", $precio_venta))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar costo_unitario - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("costo_unitario");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "costo_unitario", $costo_unitario))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar precio_venta_unitario - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("precio_venta_unitario");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "precio_venta_unitario", $precio_venta_unitario))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar observaciones - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("observaciones");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "observaciones", $observaciones))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fecha_reg - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_reg");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_reg", $fecha_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_ingreso - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_ingreso");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_ingreso", $id_ingreso))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_item - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_item");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_item", $id_item))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_ingreso_detalle - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_ingreso_detalle");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_ingreso_detalle", $id_ingreso_detalle))
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