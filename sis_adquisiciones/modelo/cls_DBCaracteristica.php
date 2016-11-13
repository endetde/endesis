<?php
/**
 * Nombre de la clase:	cls_DBCaracteristica.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tad_tad_caracteristica
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-05-13 09:57:25
 */

 
class cls_DBCaracteristica
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
	 * Nombre de la funci�n:	ListarCaracteristica
	 * Prop�sito:				Desplegar los registros de tad_caracteristica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-13 09:57:25
	 */
	function ListarCaracteristica($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_caracteristica_sel';
		$this->codigo_procedimiento = "'AD_CARACT_SEL'";

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
		$this->var->add_def_cols('id_caracteristica','int4');
		$this->var->add_def_cols('caracteristica','varchar');
		$this->var->add_def_cols('descripcion','text');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_solicitud_compra_det','int4');
		$this->var->add_def_cols('desc_solicitud_compra_det','text');
		$this->var->add_def_cols('id_item_propuesto','int4');
		$this->var->add_def_cols('desc_item_propuesto','varchar');
		$this->var->add_def_cols('id_servicio_propuesto','int4');
		$this->var->add_def_cols('desc_servicio_propuesto','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	
	
	
	function ListarCaracteristicaItem($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_item)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_caracteristica_item_sel';
		$this->codigo_procedimiento = "'AD_CAITEM_SEL'";

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
		$this->var->add_param("$id_item");//id_actividad
		
        $this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('valor','varchar');
		$this->var->add_def_cols('unidad_medida','varchar');
		$this->var->add_def_cols('ultima_fecha','date');
		
		//Ejecuta la funci�n de consulta


		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	
	/**
	 * Nombre de la funci�n:	ContarCaracteristica
	 * Prop�sito:				Contar los registros de tad_caracteristica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-13 09:57:25
	 */
	function ContarCaracteristica($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_caracteristica_sel';
		$this->codigo_procedimiento = "'AD_CARACT_COUNT'";

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
//		echo $this->query;
//		exit();
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	
	function ContarCaracteristicaItem($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_item)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_caracteristica_item_sel';
		$this->codigo_procedimiento = "'AD_CAITEM_COUNT'";

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
        $this->var->add_param("$id_item");//id_actividad
		
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
		//echo $this->query;
		//exit();
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	InsertarCaracteristica
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tad_caracteristica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-13 09:57:25
	 */
	function InsertarCaracteristica($id_caracteristica,$caracteristica,$descripcion,$fecha_reg,$id_solicitud_compra_det,$id_item_propuesto,$id_servicio_propuesto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_caracteristica_iud';
		$this->codigo_procedimiento = "'AD_CARACT_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$caracteristica'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_solicitud_compra_det);
		$this->var->add_param($id_item_propuesto);
		$this->var->add_param($id_servicio_propuesto);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarCaracteristica
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tad_caracteristica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-13 09:57:25
	 */
	function ModificarCaracteristica($id_caracteristica,$caracteristica,$descripcion,$fecha_reg,$id_solicitud_compra_det,$id_item_propuesto,$id_servicio_propuesto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_caracteristica_iud';
		$this->codigo_procedimiento = "'AD_CARACT_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_caracteristica);
		$this->var->add_param("'$caracteristica'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_solicitud_compra_det);
		$this->var->add_param($id_item_propuesto);
		$this->var->add_param($id_servicio_propuesto);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarCaracteristica
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tad_caracteristica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-13 09:57:25
	 */
	function EliminarCaracteristica($id_caracteristica)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_caracteristica_iud';
		$this->codigo_procedimiento = "'AD_CARACT_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_caracteristica);
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
	 * Nombre de la funci�n:	ValidarCaracteristica
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tad_caracteristica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-13 09:57:25
	 */
	function ValidarCaracteristica($operacion_sql,$id_caracteristica,$caracteristica,$descripcion,$fecha_reg,$id_solicitud_compra_det,$id_item_propuesto,$id_servicio_propuesto)
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
				//Validar id_caracteristica - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_caracteristica");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_caracteristica", $id_caracteristica))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar caracteristica - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("caracteristica");
			$tipo_dato->set_MaxLength(50);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "caracteristica", $caracteristica))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar descripcion - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(300);
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

			
			
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_caracteristica - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_caracteristica");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_caracteristica", $id_caracteristica))
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
	/**
	 * Nombre de la funci�n:	ListarCaracteristicaSeguimientoSolicitud
	 * Prop�sito:				Desplegar los registros de tad_caracteristica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-16 11:58:34
	 */
	function ListarCaracteristicaSeguimientoSolicitud($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_caracteristica_sel';
		$this->codigo_procedimiento = "'AD_SEGCAR_SEL'";

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
		$this->var->add_def_cols('id_caracteristica','int4');
		$this->var->add_def_cols('caracteristica','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_solicitud_compra_det','int4');
		$this->var->add_def_cols('desc_solicitud_compra_det','');
		$this->var->add_def_cols('id_item_propuesto','int4');
		$this->var->add_def_cols('desc_item_propuesto','varchar');
		$this->var->add_def_cols('id_servicio_propuesto','int4');
		$this->var->add_def_cols('desc_servicio_propuesto','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarCaracteristicaSeguimientoSolicitud
	 * Prop�sito:				Contar los registros de tad_caracteristica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-16 11:58:34
	 */
	function ContarCaracteristicaSeguimientoSolicitud($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_caracteristica_sel';
		$this->codigo_procedimiento = "'AD_SEGCAR_COUNT'";

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
	 * Nombre de la funci�n:	InsertarCaracteristicaSeguimientoSolicitud
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tad_caracteristica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-16 11:58:34
	 */
	function InsertarCaracteristicaSeguimientoSolicitud($id_caracteristica,$caracteristica,$descripcion,$fecha_reg,$id_solicitud_compra_det,$id_item_propuesto,$id_servicio_propuesto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_caracteristica_iud';
		$this->codigo_procedimiento = "'AD_SEGCAR_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$caracteristica'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_solicitud_compra_det);
		$this->var->add_param($id_item_propuesto);
		$this->var->add_param($id_servicio_propuesto);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarCaracteristicaSeguimientoSolicitud
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tad_caracteristica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-16 11:58:34
	 */
	function ModificarCaracteristicaSeguimientoSolicitud($id_caracteristica,$caracteristica,$descripcion,$fecha_reg,$id_solicitud_compra_det,$id_item_propuesto,$id_servicio_propuesto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_caracteristica_iud';
		$this->codigo_procedimiento = "'AD_SEGCAR_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_caracteristica);
		$this->var->add_param("'$caracteristica'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_solicitud_compra_det);
		$this->var->add_param($id_item_propuesto);
		$this->var->add_param($id_servicio_propuesto);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarCaracteristicaSeguimientoSolicitud
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tad_caracteristica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-16 11:58:34
	 */
	function EliminarCaracteristicaSeguimientoSolicitud($id_caracteristica)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_caracteristica_iud';
		$this->codigo_procedimiento = "'AD_SEGCAR_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_caracteristica);
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
	 * Nombre de la funci�n:	ValidarCaracteristicaSeguimientoSolicitud
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tad_caracteristica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-16 11:58:34
	 */
	function ValidarCaracteristicaSeguimientoSolicitud($operacion_sql,$id_caracteristica,$caracteristica,$descripcion,$fecha_reg,$id_solicitud_compra_det,$id_item_propuesto,$id_servicio_propuesto)
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
				//Validar id_caracteristica - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_caracteristica");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_caracteristica", $id_caracteristica))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar caracteristica - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("caracteristica");
			$tipo_dato->set_MaxLength(50);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "caracteristica", $caracteristica))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar descripcion - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(300);
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

			//Validar id_solicitud_compra_det - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_solicitud_compra_det");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_solicitud_compra_det", $id_solicitud_compra_det))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_item_propuesto - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_item_propuesto");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_item_propuesto", $id_item_propuesto))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_servicio_propuesto - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_servicio_propuesto");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_servicio_propuesto", $id_servicio_propuesto))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_caracteristica - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_caracteristica");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_caracteristica", $id_caracteristica))
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