<?php
/**
 * Nombre de la clase:	cls_DBContratista.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpm_tpm_contratista
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-11-06 21:05:09
 */

class cls_DBContratista
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
	 * Nombre de la funci�n:	ListarContratista
	 * Prop�sito:				Desplegar los registros de tpm_contratista
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-06 21:05:09
	 */
	function ListarContratista($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_contratista_sel';
		$this->codigo_procedimiento = "'PM_CONTRA_SEL'";

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
		$this->var->add_def_cols('id_contratista','int4');
		$this->var->add_def_cols('codigo','varchar');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('estado_registro','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_institucion','int4');
		$this->var->add_def_cols('desc_institucion','varchar');
		$this->var->add_def_cols('id_persona','int4');
		$this->var->add_def_cols('desc_person','text');
		$this->var->add_def_cols('nombre_contratista','varchar');
		$this->var->add_def_cols('pagina_web','varchar');
		$this->var->add_def_cols('email','varchar');
		$this->var->add_def_cols('direccion','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarContratista
	 * Prop�sito:				Contar los registros de tpm_contratista
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-06 21:05:09
	 */
	function ContarContratista($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_contratista_sel';
		$this->codigo_procedimiento = "'PM_CONTRA_COUNT'";

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
	 * Nombre de la funci�n:	InsertarContratista
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpm_contratista
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-06 21:05:09
	 */
	function InsertarContratista($id_contratista,$codigo,$observaciones,$estado_registro,$fecha_reg,$id_institucion,$id_persona)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_contratista_iud';
		$this->codigo_procedimiento = "'PM_CONTRA_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$codigo'");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$estado_registro'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_institucion);
		$this->var->add_param($id_persona);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarContratista
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpm_contratista
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-06 21:05:09
	 */
	function ModificarContratista($id_contratista,$codigo,$observaciones,$estado_registro,$fecha_reg,$id_institucion,$id_persona)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_contratista_iud';
		$this->codigo_procedimiento = "'PM_CONTRA_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_contratista);
		$this->var->add_param("'$codigo'");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$estado_registro'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_institucion);
		$this->var->add_param($id_persona);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarContratista
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpm_contratista
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-06 21:05:09
	 */
	function EliminarContratista($id_contratista)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpm_contratista_iud';
		$this->codigo_procedimiento = "'PM_CONTRA_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_contratista);
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
	 * Nombre de la funci�n:	ValidarContratista
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpm_contratista
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-11-06 21:05:09
	 */
	function ValidarContratista($operacion_sql,$id_contratista,$codigo,$observaciones,$estado_registro,$fecha_reg,$id_institucion,$id_persona)
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
				//Validar id_contratista - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_contratista");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_contratista", $id_contratista))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar codigo - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("codigo");
			$tipo_dato->set_MaxLength(20);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "codigo", $codigo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar observaciones - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("observaciones");
			$tipo_dato->set_MaxLength(200);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "observaciones", $observaciones))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar estado_registro - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_registro");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado_registro", $estado_registro))
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

			//Validar id_institucion - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_institucion");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_institucion", $id_institucion))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_persona - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_persona");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_persona", $id_persona))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validaci�n de reglas de datos

			//Validar estado_registro
			$check = array ("activo","inactivo","eliminado");
			if(!in_array($estado_registro,$check))
			{
				$this->salida[0] = "f";
				$this->salida[1] = "Error de validaci�n en columna 'estado_registro': El valor no est� dentro del dominio definido";
				$this->salida[2] = "ORIGEN = $this->nombre_archivo";
				$this->salida[3] = "PROC = ValidarContratista";
				$this->salida[4] = "NIVEL = 3";
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_contratista - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_contratista");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_contratista", $id_contratista))
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