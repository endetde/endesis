<?php
/**
 * Nombre de la clase:	cls_DBDetallePropuesta.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tad_tad_detalle_propuesta
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2009-02-03 11:26:25
 */


class cls_DBDetallePropuesta
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
	 * Nombre de la funci�n:	ListarDetallePropuesta
	 * Prop�sito:				Desplegar los registros de tad_detalle_propuesta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2009-02-03 11:26:25
	 */
	function ListarDetallePropuesta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_detalle_propuesta_sel';
		$this->codigo_procedimiento = "'AD_DETPROP_SEL'";

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
		$this->var->add_def_cols('id_detalle_propuesta','int4');
		$this->var->add_def_cols('id_cotizacion_det','int4');
		$this->var->add_def_cols('id_item','int4');
		$this->var->add_def_cols('codigo_item','varchar');
		$this->var->add_def_cols('desc_item','varchar');
		$this->var->add_def_cols('id_servicio','int4');
		$this->var->add_def_cols('desc_servicio','varchar');
		$this->var->add_def_cols('precio','numeric');
		$this->var->add_def_cols('cantidad','numeric');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('descripcion','text');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_item_solicitado','int4');
		$this->var->add_def_cols('id_servicio_solicitado','int4');
		$this->var->add_def_cols('percio_moneda_cotizada','numeric');
		$this->var->add_def_cols('precio_sin_imp','numeric');
		$this->var->add_def_cols('precio_sin_imp_mon_cot','numeric');
		$this->var->add_def_cols('estado','varchar');
		$this->var->add_def_cols('garantia','varchar');
		$this->var->add_def_cols('observaciones','varchar');        
		$this->var->add_def_cols('id_unidad_medida_base','int4');
		$this->var->add_def_cols('desc_unidad_medida','varchar');


		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarDetallePropuesta
	 * Prop�sito:				Contar los registros de tad_detalle_propuesta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2009-02-03 11:26:25
	 */
	function ContarDetallePropuesta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_detalle_propuesta_sel';
		$this->codigo_procedimiento = "'AD_DETPROP_COUNT'";

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
	 * Nombre de la funci�n:	InsertarDetallePropuesta
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tad_detalle_propuesta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2009-02-03 11:26:25
	 */
	function InsertarDetallePropuesta($id_detalle_propuesta,$id_cotizacion_det,$id_item,$id_servicio,$precio,$cantidad,$nombre,$descripcion,$fecha_reg,$id_item_solicitado,$id_servicio_solicitado,$estado,$garantia,$observaciones,$id_unidad_medida_base)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_detalle_propuesta_iud';
		$this->codigo_procedimiento = "'AD_DETPROP_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_cotizacion_det);
		$this->var->add_param($id_item);
		$this->var->add_param($id_servicio);
		$this->var->add_param($precio);
		$this->var->add_param($cantidad);
		$this->var->add_param("'$nombre'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_item_solicitado);
		$this->var->add_param($id_servicio_solicitado);
		$this->var->add_param("'$estado'");
		$this->var->add_param("'$garantia'");
		$this->var->add_param("'$observaciones'");
        $this->var->add_param($id_unidad_medida_base);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	ModificarDetallePropuesta
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tad_detalle_propuesta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2009-02-03 11:26:25
	 */
	function ModificarDetallePropuesta($id_detalle_propuesta,$id_cotizacion_det,$id_item,$id_servicio,$precio,$cantidad,$nombre,$descripcion,$fecha_reg,$id_item_solicitado,$id_servicio_solicitado,$estado,$garantia,$observaciones,$id_unidad_medida_base)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_detalle_propuesta_iud';
		$this->codigo_procedimiento = "'AD_DETPROP_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_detalle_propuesta);
		$this->var->add_param($id_cotizacion_det);
		$this->var->add_param($id_item);
		$this->var->add_param($id_servicio);
		$this->var->add_param($precio);
		$this->var->add_param($cantidad);
		$this->var->add_param("'$nombre'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_item_solicitado);
		$this->var->add_param($id_servicio_solicitado);
		$this->var->add_param("'$estado'");
		$this->var->add_param("'$garantia'");
		$this->var->add_param("'$observaciones'");
        $this->var->add_param($id_unidad_medida_base);
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	EliminarDetallePropuesta
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tad_detalle_propuesta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2009-02-03 11:26:25
	 */
	function EliminarDetallePropuesta($id_detalle_propuesta,$id_cotizacion_det)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_detalle_propuesta_iud';
		$this->codigo_procedimiento = "'AD_DETPROP_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_detalle_propuesta);
		$this->var->add_param($id_cotizacion_det);
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

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}



	function SelecAdjDetallePropuesta($id_detalle_propuesta,$id_cotizacion_det)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_detalle_propuesta_iud';
		$this->codigo_procedimiento = "'AD_DETPROSEL_ADJ'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_detalle_propuesta);
		$this->var->add_param($id_cotizacion_det);
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

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}


	/**
	 * Nombre de la funci�n:	ValidarDetallePropuesta
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tad_detalle_propuesta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2009-02-03 11:26:25
	 */
	function ValidarDetallePropuesta($operacion_sql,$id_detalle_propuesta,$id_cotizacion_det,$id_item,$id_servicio,$precio,$cantidad,$nombre,$descripcion,$fecha_reg,$id_item_solicitado,$id_servicio_solicitado)
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
				//Validar id_detalle_propuesta - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_detalle_propuesta");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_detalle_propuesta", $id_detalle_propuesta))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_cotizacion_det - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_cotizacion_det");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cotizacion_det", $id_cotizacion_det))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_item - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_item");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_item", $id_item))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_servicio - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_servicio");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_servicio", $id_servicio))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar precio - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("precio");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "precio", $precio))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar cantidad - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("cantidad");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "cantidad", $cantidad))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar nombre - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nombre");
			$tipo_dato->set_MaxLength(200);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "nombre", $nombre))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar descripcion - tipo text
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(300);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fecha_reg - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_reg");
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_reg", $fecha_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_item_solicitado - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_item_solicitado");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_item_solicitado", $id_item_solicitado))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_servicio_solicitado - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_servicio_solicitado");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_servicio_solicitado", $id_servicio_solicitado))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_detalle_propuesta - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_detalle_propuesta");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_detalle_propuesta", $id_detalle_propuesta))
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