<?php
/**
 * Nombre de la clase:	cls_DBTipoColumnaBase.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tkp_tkp_tipo_columna_base
 * Autor:				(autogenerado)
 * Fecha creaci�n:		15-11-2010
 */

 
class cls_DBTipoColumnaBase
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
	 * Nombre de la funci�n:	ListarTipoColumnaBase
	 * Prop�sito:				Desplegar los registros de tkp_tipo_columna_base
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		15-11-2010
	 */
	function ListarTipoColumnaBase($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_tipo_columna_base_sel';
		$this->codigo_procedimiento = "'KP_TICOBA_SEL'";

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
		$this->var->add_def_cols('id_tipo_columna_base','int4');
		$this->var->add_def_cols('prioridad','integer');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_tipo_columna','int4');
		$this->var->add_def_cols('desc_tipo_columna','varchar');
		$this->var->add_def_cols('id_tipo_columna_fk','int4');
		$this->var->add_def_cols('desc_tipo_columna_fk','varchar');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
				
		/*echo $this->query;
		exit();*/

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarTipoColumnaBase
	 * Prop�sito:				Contar los registros de tkp_tipo_columna_base
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		15-11-2010
	 */
	function ContarTipoColumnaBase($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_tipo_columna_base_sel';
		$this->codigo_procedimiento = "'KP_TICOBA_COUNT'";

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
	 * Nombre de la funci�n:	InsertarTipoColumnaBase
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_tipo_columna_base
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		15-11-2010
	 */
	function InsertarTipoColumnaBase($id_tipo_columna_base,$prioridad,$id_tipo_columna,$id_tipo_columna_fk,$fecha_reg)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_tipo_columna_base_iud';
		$this->codigo_procedimiento = "'KP_TICOBA_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($prioridad);
		$this->var->add_param($id_tipo_columna);
		$this->var->add_param($id_tipo_columna_fk);
		$this->var->add_param("'$fecha_reg'");
			
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarTipoColumnaBase
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_tipo_columna_base
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		15-11-2010
	 */
	function ModificarTipoColumnaBase($id_tipo_columna_base,$prioridad,$id_tipo_columna,$id_tipo_columna_fk,$fecha_reg)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_tipo_columna_base_iud';
		$this->codigo_procedimiento = "'KP_TICOBA_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_tipo_columna_base);
		$this->var->add_param($prioridad);
		$this->var->add_param($id_tipo_columna);
		$this->var->add_param($id_tipo_columna_fk);
		$this->var->add_param("'$fecha_reg'");
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo $this->query;
		exit();*/

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarTipoColumnaBase
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tkp_tipo_columna_base
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		15-11-2010
	 */
	function EliminarTipoColumnaBase($id_tipo_columna_base)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_tipo_columna_base_iud';
		$this->codigo_procedimiento = "'KP_TICOBA_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_tipo_columna_base);
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
	 * Nombre de la funci�n:	ValidarTipoColumnaBase
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tkp_tipo_columna_base
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		15-11-2010
	 */
	function ValidarTipoColumnaBase($operacion_sql,$id_tipo_columna_base,$prioridad,$id_tipo_columna,$id_tipo_columna_fk,$fecha_reg)
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
				//Validar id_columna_tipo - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_tipo_columna_base");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_columna_base", $id_tipo_columna_base))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_parametro_kardex - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_tipo_columna");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_columna", $id_tipo_columna))
			{
				$this->salida = $valid->salida;
				return false;
			}

			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_tipo_columna_fk");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_columna_fk", $id_tipo_columna_fk))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("prioridad");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "prioridad", $prioridad))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_columna_tipo - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_tipo_columna_base");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_columna_base", $id_tipo_columna_base))
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