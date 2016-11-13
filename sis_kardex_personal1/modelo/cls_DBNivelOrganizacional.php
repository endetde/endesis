<?php
/**
 * Nombre de la clase:	cls_DBUnidadOrganizacional.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tkp_tkp_unidad_organizacional
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-05-12 09:24:17
 */

 
class cls_DBNivelOrganizacional
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
	 * Nombre de la funci�n:	ListarUnidadOrganizacional
	 * Prop�sito:				Desplegar los registros de tkp_unidad_organizacional
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 09:24:17
	 */
	function ListarNivelOrganizacional($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'kard.f_tkp_nivel_organizacional_sel';
		$this->codigo_procedimiento = "'KP_NIVORG_SEL'";

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
		$this->var->add_def_cols('id_nivel_organizacional','int4');
		$this->var->add_def_cols('nombre_nivel','varchar');
		$this->var->add_def_cols('numero_nivel','integer');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarUnidadOrganizacional
	 * Prop�sito:				Contar los registros de tkp_unidad_organizacional
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 09:24:17
	 */
	function ContarNivelOrganizacional($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'kard.f_tkp_nivel_organizacional_sel';
		$this->codigo_procedimiento = "'KP_NIVORG_COUNT'";

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
	 * Nombre de la funci�n:	InsertarNivelOrganizacional
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_nivel_organizacional
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 09:24:17
	 */
	function InsertarNivelOrganizacional($id_nivel_organizacional,$nombre_nivel,$numero_nivel)
	{
		$this->salida = "";
		$this->nombre_funcion = 'kard.f_tkp_nivel_organizacional_iud';
		$this->codigo_procedimiento = "'KP_NIVORG_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$nombre_nivel'");
		$this->var->add_param("$numero_nivel");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	/**
	 * Nombre de la funci�n:	ModificarNivelOrganizacional
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_nivel_organizacional
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 09:24:17
	 */
	function ModificarNivelOrganizacional($id_nivel_organizacional,$nombre_nivel,$numero_nivel)
	{
		$this->salida = "";
		$this->nombre_funcion = 'kard.f_tkp_nivel_organizacional_iud';
		$this->codigo_procedimiento = "'KP_NIVORG_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_nivel_organizacional);
		$this->var->add_param("'$nombre_nivel'");
		$this->var->add_param("$numero_nivel");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarNivelOrganizacional
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tkp_nivel_organizacional
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 09:24:17
	 */
	function EliminarNivelOrganizacional($id_nivel_organizacional)
	{
		$this->salida = "";
		$this->nombre_funcion = 'kard.f_tkp_nivel_organizacional_iud';
		$this->codigo_procedimiento = "'KP_NIVORG_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_nivel_organizacional);
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
	 * Nombre de la funci�n:	ValidarNivelOrganizacional
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tkp_nivel_organizacional
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 09:24:17
	 */
	function ValidarNivelOrganizacional($operacion_sql,$id_nivel_organizacional,$nombre_nivel,$numero_nivel)
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
				//Validar id_nivel_organizacional - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_nivel_organizacional");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_nivel_organizacional", $id_nivel_organizacional))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar nombre_nivel - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nombre_nivel");
			$tipo_dato->set_MaxLength(50);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "nombre_nivel", $nombre_nivel))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar numero_nivel - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("numero_nivel");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "numero_nivel", $numero_nivel))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_nivel_organizacional - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_nivel_organizacional");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_nivel_organizacional", $id_nivel_organizacional))
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