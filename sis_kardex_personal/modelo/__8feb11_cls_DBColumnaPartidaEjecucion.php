<?php
/**
 * Nombre de la clase:	cls_DBColumna.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tkp_tkp_columna
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2010-08-19 10:28:39
 */
class cls_DBColumnaPartidaEjecucion
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
	 * Nombre de la funci�n:	ListarColumna
	 * Prop�sito:				Desplegar los registros de tkp_columna
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function ListarColumnaPartidaEjecucion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_columna_partida_ejecucion_sel';
		$this->codigo_procedimiento = "'KP_COPAEJ_SEL'";

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
		$this->var->add_def_cols('id_columna','int4');
		$this->var->add_def_cols('id_tipo_planilla','int4');
		$this->var->add_def_cols('id_columna_tipo','int4');
		$this->var->add_def_cols('desc_tipo_columna','varchar');
		$this->var->add_def_cols('formula','varchar');
		$this->var->add_def_cols('valor_defecto','numeric');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('fecha_reg','timestamp');
		$this->var->add_def_cols('id_usuario','int4');
		$this->var->add_def_cols('usuario','varchar');
		$this->var->add_def_cols('def_tipo_columna','varchar');
		$this->var->add_def_cols('formula_original','varchar');
		$this->var->add_def_cols('codigo','varchar');
		$this->var->add_def_cols('en_reporte','varchar');
		$this->var->add_def_cols('orden_reporte','integer');
		$this->var->add_def_cols('total','varchar');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		//echo $this->query;exit;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarColumna
	 * Prop�sito:				Contar los registros de tkp_columna
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function ContarColumnaPartidaEjecucion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_columna_sel';
		$this->codigo_procedimiento = "'KP_COLUMN_COUNT'";

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
	 * Nombre de la funci�n:	InsertarColumna
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_columna
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function InsertarColumnaPartidaEjecucion($id_columna,$id_tipo_planilla,$id_columna_tipo,$formula,$valor_defecto,$estado_reg, $en_reporte,$orden_reporte,$total)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_columna_iud';
		$this->codigo_procedimiento = "'KP_COLUMN_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_tipo_planilla);
		$this->var->add_param($id_columna_tipo);
		$this->var->add_param("'$formula'");
		$this->var->add_param($valor_defecto);
		$this->var->add_param("'$estado_reg'");
		$this->var->add_param("'$en_reporte'");
		$this->var->add_param($orden_reporte);
		$this->var->add_param("'$total'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarColumna
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_columna
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function ModificarColumnaPartidaEjecucion($id_columna,$id_tipo_planilla,$id_columna_tipo,$formula,$valor_defecto,$estado_reg,$en_reporte,$orden_reporte,$total)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_columna_iud';
		$this->codigo_procedimiento = "'KP_COLUMN_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_columna);
		$this->var->add_param($id_tipo_planilla);
		$this->var->add_param($id_columna_tipo);
		$this->var->add_param("'$formula'");
		$this->var->add_param($valor_defecto);
		$this->var->add_param("'$estado_reg'");
		
		$this->var->add_param("'$en_reporte'");
		$this->var->add_param($orden_reporte);
		$this->var->add_param("'$total'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarColumna
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tkp_columna
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function EliminarColumnaPartidaEjecucion($id_columna)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_columna_iud';
		$this->codigo_procedimiento = "'KP_COLUMN_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_columna);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		
		
		$this->var->add_param("NULL");//("'$en_reporte'");
		$this->var->add_param("NULL");//("'$orden_reporte'");


		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarColumna
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tkp_columna
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function ValidarColumnaPartidaEjecucion($operacion_sql,$id_columna,$id_tipo_planilla,$id_columna_tipo,$formula,$valor_defecto,$estado_reg)
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
				//Validar id_columna - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_columna");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_columna", $id_columna))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_tipo_planilla - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_tipo_planilla");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_planilla", $id_tipo_planilla))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_columna_tipo - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_columna_tipo");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_columna_tipo", $id_columna_tipo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar formula - tipo varchar
			/*$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("formula");
			$tipo_dato->set_MaxLength(100);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "formula", $formula))
			{
				$this->salida = $valid->salida;
				return false;
			}*/

			//Validar valor_defecto - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("valor_defecto");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "valor_defecto", $valor_defecto))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar estado_reg - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_reg");
			$tipo_dato->set_MaxLength(15);
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
			//Validar id_columna - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_columna");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_columna", $id_columna))
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
	
	
	function ListarVistaColParEje($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_columna_partida_ejecucion_sel';
		$this->codigo_procedimiento = "'KP_VICOPAEJ_SEL'";

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
		$this->var->add_def_cols('codigo_columna','varchar');
		$this->var->add_def_cols('nombre_columna','varchar');
		$this->var->add_def_cols('importe','numeric');
		$this->var->add_def_cols('id_ppto','integer');
		$this->var->add_def_cols('id_planilla','integer');
		
		$this->var->add_def_cols('cuenta','text');
		$this->var->add_def_cols('auxiliar','text');
		$this->var->add_def_cols('partida','text');
		$this->var->add_def_cols('tiene_ppto','numeric');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		//echo $this->query;exit;
		return $res;
	}
	
	
	/**/
	function ContarVistaColParEje($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_columna_partida_ejecucion_sel';
		$this->codigo_procedimiento = "'KP_VICOPAEJ_COUNT'";

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