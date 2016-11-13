<?php
/**
 * Nombre de la clase:	cls_DBParametroAdquisicion.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tad_tad_parametro_adquisicion
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-06-13 16:12:36
 */

 
class cls_DBParametroAdquisicion
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
	 * Nombre de la funci�n:	ListarParametroAdquisicion
	 * Prop�sito:				Desplegar los registros de tad_parametro_adquisicion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-06-13 16:12:36
	 */
	function ListarParametroAdquisicion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_parametro_adquisicion_sel';
		$this->codigo_procedimiento = "'AD_PARADQ_SEL'";

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
		$this->var->add_def_cols('id_parametro_adquisicion','int4');
		$this->var->add_def_cols('estado','varchar');
		$this->var->add_def_cols('fecha','date');
		$this->var->add_def_cols('id_gestion_subsistema','int4');
		$this->var->add_def_cols('id_subsistema','int4');
		$this->var->add_def_cols('id_gestion','int4');
		$this->var->add_def_cols('gestion','numeric');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarParametroAdquisicion
	 * Prop�sito:				Contar los registros de tad_parametro_adquisicion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-06-13 16:12:36
	 */
	function ContarParametroAdquisicion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_parametro_adquisicion_sel';
		$this->codigo_procedimiento = "'AD_PARADQ_COUNT'";

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
	 * Nombre de la funci�n:	ModificarParametroAdquisicion
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tad_parametro_adquisicion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-06-13 16:12:36
	 */
	function ModificarParametroAdquisicionEstado($id_gestion_subsistema,$estado,$fecha)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_parametro_adquisicion_iud';
		$this->codigo_procedimiento = "'AD_PADQES_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_gestion_subsistema);
		$this->var->add_param("'$estado'");
		$this->var->add_param("'$fecha'");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//id_gestion
		$this->var->add_param("NULL");//id_empresa
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
       
		return $res;
	}
	/**
	 * Nombre de la funci�n:	ModificarParametroAdquisicion
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tad_parametro_adquisicion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-06-13 16:12:36
	 */
	function InsertarParametroAdquisicion($id_empresa)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_parametro_adquisicion_iud';
		$this->codigo_procedimiento = "'AD_PARADQ_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//id_gestion
		$this->var->add_param($id_empresa);//id_empresa
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
       
		return $res;
	}
	
	

	/**
	 * Nombre de la funci�n:	ListarParametroAdquisicion
	 * Prop�sito:				Desplegar los registros de tad_parametro_adquisicion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-06-13 16:12:36
	 */
	function ListarCorrelativoGeneral($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_parametro_adquisicion_sel';
		$this->codigo_procedimiento = "'AD_CORGEN_SEL'";

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
		$this->var->add_def_cols('id_documento','int4');
		$this->var->add_def_cols('codigo','varchar');
		$this->var->add_def_cols('nro_doc_actual','bigint');
		$this->var->add_def_cols('nro_doc_siguiente','bigint');
		$this->var->add_def_cols('id_periodo','integer');
		$this->var->add_def_cols('id_gestion_subsistema','integer');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	/**
	 * Nombre de la funci�n:	ValidarParametroAdquisicion
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tad_parametro_adquisicion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-06-13 16:12:36
	 */
	function ValidarParametroAdquisicion($operacion_sql,$id_parametro_adquisicion,$estado,$fecha,$id_gestion_subsistema)
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
				//Validar id_parametro_adquisicion - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_parametro_adquisicion");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_parametro_adquisicion", $id_parametro_adquisicion))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			
			//Validar estado - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado");
			$tipo_dato->set_MaxLength(30);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado", $estado))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fecha - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha", $fecha))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar periodo - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("periodo");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_gestion_subsistema", $periodo))
			{
				$this->salida = $valid->salida;
				return false;
			}


			//Validaci�n de reglas de datos

			//Validar estado
			$check = array ("activo","congelado","cerrado");
			if(!in_array($estado,$check))
			{
				$this->salida[0] = "f";
				$this->salida[1] = "Error de validaci�n en columna 'estado': El valor no est� dentro del dominio definido";
				$this->salida[2] = "ORIGEN = $this->nombre_archivo";
				$this->salida[3] = "PROC = ValidarParametroAdquisicion";
				$this->salida[4] = "NIVEL = 3";
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_parametro_adquisicion - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_parametro_adquisicion");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_parametro_adquisicion", $id_parametro_adquisicion))
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
	
	
	function ObtenerNumDoc($tipo_doc, $tipo_adq)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_obtener_num';
		$this->codigo_procedimiento = "NULL";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		
		//Carga los par�metros espec�ficos de la estructura program�tica
		
		$this->var->add_param("'$tipo_doc'");//
		$this->var->add_param("'$tipo_adq'");//
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_function();

		//Obtiene el tipo de cambio devuelto por la funci�n
		$this->salida = $this->var->salida;
		
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	
		return $res;
	}
	

	
	function ListarGestionParametroAdq($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_parametro_adquisicion_sel';
		$this->codigo_procedimiento = "'AD_GESPAR_SEL'";

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
		$this->var->add_def_cols('id_parametro_adquisicion','int4');
		$this->var->add_def_cols('gestion','numeric');
		$this->var->add_def_cols('id_gestion','int4');
		$this->var->add_def_cols('gestion_min','numeric');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarParametroAdquisicion
	 * Prop�sito:				Contar los registros de tad_parametro_adquisicion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-06-13 16:12:36
	 */
	function ContarGestionParametroAdq($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_parametro_adquisicion_sel';
		$this->codigo_procedimiento = "'AD_GESPAR_COUNT'";

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
	
	
	
}?>