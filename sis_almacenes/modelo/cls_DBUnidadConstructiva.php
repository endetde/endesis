<?php
/**
 * Nombre de la clase:	cls_DBUnidadConstructiva.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tal_tal_unidad_constructiva
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-03-31 11:16:33
 */

class cls_DBUnidadConstructiva
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
	 * Nombre de la funci�n:	ListarUnidadConstructiva
	 * Prop�sito:				Desplegar los registros de tal_unidad_constructiva
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-03-31 11:16:33
	 */
	function ListarUnidadConstructiva($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_unidad_constructiva_sel';
		$this->codigo_procedimiento = "'AL_UNICON_SEL'";

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
		$this->var->add_def_cols('id_unidad_constructiva','int4');
		$this->var->add_def_cols('codigo','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_tipo_unidad_constructiva','int4');
		$this->var->add_def_cols('desc_tipo_unidad_constructiva','varchar');
		$this->var->add_def_cols('id_prog_proy_acti','int4');
		$this->var->add_def_cols('desc_programa_proyecto_actividad','text');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarUnidadConstructiva
	 * Prop�sito:				Contar los registros de tal_unidad_constructiva
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-03-31 11:16:33
	 */
	function ContarUnidadConstructiva($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_unidad_constructiva_sel';
		$this->codigo_procedimiento = "'AL_UNICON_COUNT'";

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
	 * Nombre de la funci�n:	InsertarUnidadConstructiva
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_unidad_constructiva
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-03-31 11:16:33
	 */
	function InsertarUnidadConstructiva($id_unidad_constructiva,$codigo,$fecha_reg,$id_tipo_unidad_constructiva,$id_prog_proy_acti)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_unidad_constructiva_iud';
		$this->codigo_procedimiento = "'AL_UNICON_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$codigo'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_tipo_unidad_constructiva);
		$this->var->add_param($id_prog_proy_acti);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarUnidadConstructiva
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_unidad_constructiva
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-03-31 11:16:33
	 */
	function ModificarUnidadConstructiva($id_unidad_constructiva,$codigo,$fecha_reg,$id_tipo_unidad_constructiva,$id_prog_proy_acti)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_unidad_constructiva_iud';
		$this->codigo_procedimiento = "'AL_UNICON_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_unidad_constructiva);
		$this->var->add_param("'$codigo'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_tipo_unidad_constructiva);
		$this->var->add_param($id_prog_proy_acti);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarUnidadConstructiva
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_unidad_constructiva
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-03-31 11:16:33
	 */
	function EliminarUnidadConstructiva($id_unidad_constructiva)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_unidad_constructiva_iud';
		$this->codigo_procedimiento = "'AL_UNICON_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_unidad_constructiva);
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
	 * Nombre de la funci�n:	ValidarUnidadConstructiva
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tal_unidad_constructiva
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-03-31 11:16:33
	 */
	function ValidarUnidadConstructiva($operacion_sql,$id_unidad_constructiva,$codigo,$fecha_reg,$id_tipo_unidad_constructiva,$id_prog_proy_acti)
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
				//Validar id_unidad_constructiva - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_unidad_constructiva");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_unidad_constructiva", $id_unidad_constructiva))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar codigo - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("codigo");
			$tipo_dato->set_MaxLength(70);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "codigo", $codigo))
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

			//Validar id_tipo_unidad_constructiva - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_tipo_unidad_constructiva");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_unidad_constructiva", $id_tipo_unidad_constructiva))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_subactividad - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_prog_proy_acti");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_prog_proy_acti", $id_prog_proy_acti))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_unidad_constructiva - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_unidad_constructiva");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_unidad_constructiva", $id_unidad_constructiva))
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