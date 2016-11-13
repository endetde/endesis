<?php
/**
 * Nombre de la clase:	cls_DBRelacion.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tsg_tsg_relacion
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-05-17 16:09:00
 */

 
class cls_DBRelacion
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
	 * Nombre de la funci�n:	ListarRelacion
	 * Prop�sito:				Desplegar los registros de tsg_relacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-17 16:09:00
	 */
	function ListarRelacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$esquema)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_relacion_sel';
		$this->codigo_procedimiento = "'SG_RELACO_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);
		$esquema=strtolower($esquema);
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
		$this->var->add_param("'$esquema'");
		//Carga la definici�n de columnas con sus tipos de datos
		
		$this->var->add_def_cols('nombre','text');
		$this->var->add_def_cols('codigo','text');
		$this->var->add_def_cols('titulo','text');
		$this->var->add_def_cols('descripcion','text');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarRelacion
	 * Prop�sito:				Contar los registros de tsg_relacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-17 16:09:00
	 */
	function ContarRelacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$esquema)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_relacion_sel';
		$this->codigo_procedimiento = "'SG_RELACO_COUNT'";
		$esquema=strtolower($esquema);
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
		$this->var->add_param("'$esquema'");
		
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
	 * Nombre de la funci�n:	InsertarRelacion
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tsg_relacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-17 16:09:00
	 */
	function InsertarRelacion($id_relacion,$nombre,$codigo,$titulo,$descripcion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_relacion_iud';
		$this->codigo_procedimiento = "'SG_RELACO_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$nombre'");
		$this->var->add_param("'$codigo'");
		$this->var->add_param("'$titulo'");
		$this->var->add_param("'$descripcion'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarRelacion
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tsg_relacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-17 16:09:00
	 */
	function ModificarRelacion($id_relacion,$nombre,$codigo,$titulo,$descripcion,$esquema)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_relacion_iud';
		$this->codigo_procedimiento = "'SG_RELACO_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		
		$this->var->add_param("'$nombre'");
		$this->var->add_param("'$codigo'");
		$this->var->add_param("'$titulo'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$esquema'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarRelacion
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tsg_relacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-17 16:09:00
	 */
	function EliminarRelacion($id_relacion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_relacion_iud';
		$this->codigo_procedimiento = "'SG_RELACO_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_relacion);
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
	 * Nombre de la funci�n:	ValidarRelacion
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tsg_relacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-17 16:09:00
	 */
	function ValidarRelacion($operacion_sql,$id_relacion,$nombre,$codigo,$titulo,$descripcion)
	{
		$this->salida = "";
		$valid = new cls_validacion_serv();

		//Clase para validar el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();
	
		//Ejecuta la validaci�n por el tipo de operaci�n
		if($operacion_sql=='insert' || $operacion_sql=='update')
		{
			

			//Validar nombre - tipo text
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nombre");
			$tipo_dato->set_MaxLength(300);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "nombre", $nombre))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar codigo - tipo text
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("codigo");
			$tipo_dato->set_MaxLength(300);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "codigo", $codigo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar titulo - tipo text
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("titulo");
			$tipo_dato->set_MaxLength(300);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "titulo", $titulo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar descripcion - tipo text
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(300);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_relacion - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_relacion");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_relacion", $id_relacion))
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