<?php
/**
 * Nombre de la clase:	cls_DBDetalleSalidaUC.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tal_tal_almacen
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-10-11 09:24:52
 */

class cls_DBDetalleSalidaUC
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
	 * Nombre de la funci�n:	ListarOrdenSalidaUCDetalle
	 * Prop�sito:				Desplegar los registros de tal_almacen
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-11 09:24:52
	 */
	function ListarOrdenSalidaUCDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_orden_salida_uc_detalle_sel';
		$this->codigo_procedimiento = "'AL_OSUCDE_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = "'$cant'";
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
		$this->var->add_param("NULL");
		//$this->var->add_param("NULL");

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_orden_salida_uc_detalle','int4');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_tipo_unidad_constructiva','integer');
		$this->var->add_def_cols('id_salida','int4');
		$this->var->add_def_cols('id_unidad_constructiva','int4');
		$this->var->add_def_cols('cantidad','numeric');
		$this->var->add_def_cols('codigo','varchar');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('id_item','integer');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		//echo "query: ".$this->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarOrdenSalidaUCDetalle
	 * Prop�sito:				Contar los registros de tal_almacen
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-11 09:24:52
	 */
	function ContarOrdenSalidaUCDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_orden_salida_uc_detalle_sel';
		$this->codigo_procedimiento = "'AL_OSUCDE_COUNT'";

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
		$this->var->add_param($func->iif($id_financiador == '', "'%'", "'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional    == '', "'%'", "'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa    == '', "'%'", "'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto    == '', "'%'", "'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad   == '', "'%'", "'$id_actividad'"));//id_actividad
		$this->var->add_param("NULL");
		//$this->var->add_param("NULL");

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
	 * Nombre de la funci�n:	InsertarOrdenSalidaUCDetalle
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_almacen
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-11 09:24:52
	 */
	function InsertarDetalleSalidaUC($id_detalle_salida_uc,$cantidad,$observaciones,$id_orden_salida_uc_detalle,$id_tipo_unidad_constructiva,$id_modulo_uc,$id_composicion_tuc,$id_tipo_unidad_constructiva_orig)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_detalle_salida_uc_iud';
		$this->codigo_procedimiento = "'AL_DESAUC_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("$cantidad");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("NULL");
		$this->var->add_param($id_orden_salida_uc_detalle);
		$this->var->add_param("$id_tipo_unidad_constructiva");
		$this->var->add_param($id_modulo_uc);
		$this->var->add_param($id_composicion_tuc);
		$this->var->add_param($id_tipo_unidad_constructiva_orig);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	ModificarAlmacen
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_almacen
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-11 09:24:52
	 */
	function ModificarDetalleSalidaUC($id_detalle_salida_uc,$cantidad,$observaciones,$id_orden_salida_uc_detalle,$id_tipo_unidad_constructiva,$id_modulo_uc,$id_composicion_tuc,$id_tipo_unidad_constructiva_orig)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_detalle_salida_uc_iud';
		$this->codigo_procedimiento = "'AL_DESAUC_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("$id_detalle_salida_uc");
		$this->var->add_param("$cantidad");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("NULL");//fecha
		$this->var->add_param($id_orden_salida_uc_detalle);
		$this->var->add_param("$id_tipo_unidad_constructiva");
		$this->var->add_param($id_modulo_uc);
		$this->var->add_param($id_composicion_tuc);
		$this->var->add_param($id_tipo_unidad_constructiva_orig);
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	EliminarAlmacen
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_almacen
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-11 09:24:52
	 */
	function EliminarDetalleSalidaUC($id_detalle_salida_uc)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_detalle_salida_uc_iud';
		$this->codigo_procedimiento = "'AL_DESAUC_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_detalle_salida_uc);
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
	 * Nombre de la funci�n:	InsertarOrdenSalidaUCDetalle
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_almacen
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-11 09:24:52
	 */
	function VolverOriginal($id_detalle_salida_uc,$cantidad,$observaciones,$id_orden_salida_uc_detalle,$id_tipo_unidad_constructiva,$id_modulo_uc,$id_composicion_tuc,$id_tipo_unidad_constructiva_orig)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_detalle_salida_uc_iud';
		$this->codigo_procedimiento = "'AL_DESAUC_ORI'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("$cantidad");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("NULL");
		$this->var->add_param($id_orden_salida_uc_detalle);
		$this->var->add_param("$id_tipo_unidad_constructiva");
		$this->var->add_param($id_modulo_uc);
		$this->var->add_param($id_composicion_tuc);
		$this->var->add_param($id_tipo_unidad_constructiva_orig);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

}?>