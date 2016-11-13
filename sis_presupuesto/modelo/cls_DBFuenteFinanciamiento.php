<?php
/**
 * Nombre de la clase:	cls_DBFuenteFinanciamiento.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpr_tpr_fuente_financiamiento
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-07-15 10:55:06
 */

 
class cls_DBFuenteFinanciamiento
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
	 * Nombre de la funci�n:	ListarFuenteFinanciamiento
	 * Prop�sito:				Desplegar los registros de tpr_fuente_financiamiento
	 * Autor:				    Grover Velasquez Colque
	 * Fecha de creaci�n:		2008-07-15 10:55:06
	 */
	function ListarFuenteFinanciamiento($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_fuente_financiamiento_sel';
		$this->codigo_procedimiento = "'PR_FUNFIN_SEL'";

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
		$this->var->add_def_cols('id_fuente_financiamiento','int4');
		$this->var->add_def_cols('codigo_fuente','varchar');
		$this->var->add_def_cols('denominacion','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('sigla','varchar');
		$this->var->add_def_cols('usuario_reg','varchar');
		$this->var->add_def_cols('fecha_reg','timestamp');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo($this->query = $this->var->query);
		exit();*/
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarFuenteFinanciamiento
	 * Prop�sito:				Contar los registros de tpr_fuente_financiamiento
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-15 10:55:06
	 */
	function ContarFuenteFinanciamiento($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_fuente_financiamiento_sel';
		$this->codigo_procedimiento = "'PR_FUNFIN_COUNT'";

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
	 * Nombre de la funci�n:	InsertarFuenteFinanciamiento
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_fuente_financiamiento
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-15 10:55:06
	 */
	function InsertarFuenteFinanciamiento($id_fuente_financiamiento,$codigo_fuente,$denominacion,$descripcion,$sigla)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_fuente_financiamiento_iud';
		$this->codigo_procedimiento = "'PR_FUNFIN_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		
		$this->var->add_param("'$codigo_fuente'");
		$this->var->add_param("'$denominacion'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$sigla'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarFuenteFinanciamiento
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpr_fuente_financiamiento
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-15 10:55:06
	 */
	function ModificarFuenteFinanciamiento($id_fuente_financiamiento,$codigo_fuente,$denominacion,$descripcion,$sigla)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_fuente_financiamiento_iud';
		$this->codigo_procedimiento = "'PR_FUNFIN_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_fuente_financiamiento);
		$this->var->add_param("'$codigo_fuente'");
		$this->var->add_param("'$denominacion'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$sigla'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarFuenteFinanciamiento
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_fuente_financiamiento
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-15 10:55:06
	 */
	function EliminarFuenteFinanciamiento($id_fuente_financiamiento)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_fuente_financiamiento_iud';
		$this->codigo_procedimiento = "'PR_FUNFIN_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_fuente_financiamiento);
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
	 * Nombre de la funci�n:	ValidarFuenteFinanciamiento
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpr_fuente_financiamiento
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-15 10:55:06
	 */
	function ValidarFuenteFinanciamiento($operacion_sql,$id_fuente_financiamiento,$codigo_fuente,$denominacion,$descripcion,$sigla)
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
				//Validar id_fuente_financiamiento - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_fuente_financiamiento");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_fuente_financiamiento", $id_fuente_financiamiento))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar codigo_fuente - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("codigo_fuente");
			$tipo_dato->set_MaxLength(3);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "codigo_fuente", $codigo_fuente))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar denominacion - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("denominacion");
			$tipo_dato->set_MaxLength(100);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "denominacion", $denominacion))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar descripcion - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(1000);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar sigla - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("sigla");
			$tipo_dato->set_MaxLength(50);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "sigla", $sigla))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_fuente_financiamiento - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_fuente_financiamiento");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_fuente_financiamiento", $id_fuente_financiamiento))
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