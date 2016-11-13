<?php
/**
 * Nombre de la clase:	cls_DBFirmaAutorizada.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tal_tal_firma_autorizada
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-10-17 15:49:57
 */

class cls_DBFirmaAutorizada
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
	 * Nombre de la funci�n:	ListarFirmaAutorizada
	 * Prop�sito:				Desplegar los registros de tal_firma_autorizada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 15:49:57
	 */
	function ListarFirmaAutorizada($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_firma_autorizada_sel';
		$this->codigo_procedimiento = "'AL_FIRAUT_SEL'";

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
		$this->var->add_def_cols('id_firma_autorizada','int4');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('prioridad','int4');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_empleado_frppa','int4');
		$this->var->add_def_cols('desc_empleado_tpm_frppa','int4');
		$this->var->add_def_cols('id_motivo_salida','int4');
		$this->var->add_def_cols('desc_motivo_salida','varchar');
		$this->var->add_def_cols('id_motivo_ingreso','int4');
		$this->var->add_def_cols('desc_motivo_ingreso','varchar');
		$this->var->add_def_cols('id_almacen_ep','int4');
		$this->var->add_def_cols('desc_almacen_ep','varchar');
		$this->var->add_def_cols('nombre_completo','text');
		$this->var->add_def_cols('desc_almacen','varchar');
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
		$this->var->add_def_cols('id_almacen','integer');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarFirmaAutorizada
	 * Prop�sito:				Contar los registros de tal_firma_autorizada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 15:49:57
	 */
	function ContarFirmaAutorizada($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_firma_autorizada_sel';
		$this->codigo_procedimiento = "'AL_FIRAUT_COUNT'";

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
	 * Nombre de la funci�n:	InsertarFirmaAutorizada
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_firma_autorizada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 15:49:57
	 */
	function InsertarFirmaAutorizada($id_firma_autorizada,$descripcion,$prioridad,$estado_reg,$observaciones,$fecha_reg,$id_empleado_frppa,$id_motivo_salida,$id_motivo_ingreso,$id_almacen_ep)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_firma_autorizada_iud';
		$this->codigo_procedimiento = "'AL_FIRAUT_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");		
		$this->var->add_param("'$descripcion'");
		$this->var->add_param($prioridad);
		$this->var->add_param("'$estado_reg'");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_empleado_frppa);
		$this->var->add_param($id_motivo_salida);
		$this->var->add_param($id_motivo_ingreso);
		$this->var->add_param($id_almacen_ep);
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarFirmaAutorizada
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_firma_autorizada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 15:49:57
	 */
	function ModificarFirmaAutorizada($id_firma_autorizada,$descripcion,$prioridad,$estado_reg,$observaciones,$fecha_reg,$id_empleado_frppa,$id_motivo_salida,$id_motivo_ingreso,$id_almacen_ep)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_firma_autorizada_iud';
		$this->codigo_procedimiento = "'AL_FIRAUT_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_firma_autorizada);
		$this->var->add_param("'$descripcion'");
		$this->var->add_param($prioridad);
		$this->var->add_param("'$estado_reg'");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_empleado_frppa);
		$this->var->add_param($id_motivo_salida);
		$this->var->add_param($id_motivo_ingreso);
		$this->var->add_param($id_almacen_ep);
       	//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarFirmaAutorizada
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_firma_autorizada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 15:49:57
	 */
	function EliminarFirmaAutorizada($id_firma_autorizada)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_firma_autorizada_iud';
		$this->codigo_procedimiento = "'AL_FIRAUT_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_firma_autorizada);
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
	 * Nombre de la funci�n:	InsertarFirmaAutorizada
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_firma_autorizada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 15:49:57
	 */
	function InsertarFirmaAutorizadaEP($id_firma_autorizada,$descripcion,$prioridad,$estado_reg,$observaciones,$fecha_reg,$id_empleado_frppa,$id_motivo_salida,$id_motivo_ingreso,$id_almacen,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_firma_autorizada_ep_iud';
		$this->codigo_procedimiento = "'AL_FIRAUT_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");		
		$this->var->add_param("'$descripcion'");
		$this->var->add_param($prioridad);
		$this->var->add_param("'$estado_reg'");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_empleado_frppa);
		$this->var->add_param($id_motivo_salida);
		$this->var->add_param($id_motivo_ingreso);
		$this->var->add_param($id_almacen);
		$this->var->add_param($id_financiador);
		$this->var->add_param($id_regional);
		$this->var->add_param($id_programa);
		$this->var->add_param($id_proyecto);
		$this->var->add_param($id_actividad);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarFirmaAutorizada
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_firma_autorizada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 15:49:57
	 */
	function ModificarFirmaAutorizadaEP($id_firma_autorizada,$descripcion,$prioridad,$estado_reg,$observaciones,$fecha_reg,$id_empleado_frppa,$id_motivo_salida,$id_motivo_ingreso,$id_almacen,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_firma_autorizada_ep_iud';
		$this->codigo_procedimiento = "'AL_FIRAUT_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_firma_autorizada);
		$this->var->add_param("'$descripcion'");
		$this->var->add_param($prioridad);
		$this->var->add_param("'$estado_reg'");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_empleado_frppa);
		$this->var->add_param($id_motivo_salida);
		$this->var->add_param($id_motivo_ingreso);
		$this->var->add_param($id_almacen);
        $this->var->add_param($id_financiador);
		$this->var->add_param($id_regional);
		$this->var->add_param($id_programa);
		$this->var->add_param($id_proyecto);
		$this->var->add_param($id_actividad);
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarFirmaAutorizada
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_firma_autorizada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 15:49:57
	 */
	function EliminarFirmaAutorizadaEP($id_firma_autorizada)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_firma_autorizada_ep_iud';
		$this->codigo_procedimiento = "'AL_FIRAUT_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_firma_autorizada);
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
	 * Nombre de la funci�n:	ValidarFirmaAutorizada
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tal_firma_autorizada
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-17 15:49:57
	 */
	function ValidarFirmaAutorizada($operacion_sql,$id_firma_autorizada,$descripcion,$prioridad,$estado_reg,$observaciones,$fecha_reg,$id_empleado_frppa,$id_motivo_salida,$id_motivo_ingreso,$id_almacen_ep)
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
				//Validar id_firma_autorizada - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_firma_autorizada");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_firma_autorizada", $id_firma_autorizada))
				{
					$this->salida = $valid->salida;
					return false;
				}
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

			//Validar prioridad - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("prioridad");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "prioridad", $prioridad))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar estado_reg - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_reg");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado_reg", $estado_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar observaciones - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("observaciones");
			$tipo_dato->set_MaxLength(200);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "observaciones", $observaciones))
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

			//Validar id_empleado_frppa - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado_frppa");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado_frppa", $id_empleado_frppa))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_motivo_salida - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_motivo_salida");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_MinLength(0);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_motivo_salida", $id_motivo_salida))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_motivo_ingreso - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_motivo_ingreso");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_MinLength(0);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_motivo_ingreso", $id_motivo_ingreso))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar id_almacen_ep - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_almacen_ep");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_MinLength(0);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_almacen_ep", $id_almacen_ep))
			{
				$this->salida = $valid->salida;
				return false;
			}


			//Validaci�n de reglas de datos

			//Validar estado_reg
			$check = array ("activo","inactivo","eliminado");
			if(!in_array($estado_reg,$check))
			{
				$this->salida[0] = "f";
				$this->salida[1] = "Error de validaci�n en columna 'estado_reg': El valor no est� dentro del dominio definido";
				$this->salida[2] = "ORIGEN = $this->nombre_archivo";
				$this->salida[3] = "PROC = ValidarFirmaAutorizada";
				$this->salida[4] = "NIVEL = 3";
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_firma_autorizada - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_firma_autorizada");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_firma_autorizada", $id_firma_autorizada))
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