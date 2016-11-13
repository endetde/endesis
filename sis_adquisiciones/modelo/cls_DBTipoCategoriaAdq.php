<?php
/**
 * Nombre de la clase:	cls_DBTipoCategoriaAdq.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tad_tad_tipo_categoria_adq
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-05-12 10:18:00
 */

 
class cls_DBTipoCategoriaAdq
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
	 * Nombre de la funci�n:	ListarTipoCategoriaAdq
	 * Prop�sito:				Desplegar los registros de tad_tipo_categoria_adq
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 10:18:00
	 */
	function ListarTipoCategoriaAdq($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_tipo_categoria_adq_sel';
		$this->codigo_procedimiento = "'AD_TIPCAT_SEL'";

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
		$this->var->add_def_cols('id_tipo_categoria_adq','int4');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_categoria_adq','int4');
		$this->var->add_def_cols('desc_categoria_adq','varchar');
		$this->var->add_def_cols('estado_categoria','varchar');
		$this->var->add_def_cols('tipo','varchar');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('precio_min','numeric');
		$this->var->add_def_cols('precio_max','numeric');
		$this->var->add_def_cols('doc_respaldo','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarTipoCategoriaAdq
	 * Prop�sito:				Contar los registros de tad_tipo_categoria_adq
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 10:18:00
	 */
	function ContarTipoCategoriaAdq($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_tipo_categoria_adq_sel';
		$this->codigo_procedimiento = "'AD_TIPCAT_COUNT'";

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
	 * Nombre de la funci�n:	InsertarTipoCategoriaAdq
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tad_tipo_categoria_adq
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 10:18:00
	 */
	function InsertarTipoCategoriaAdq($id_tipo_categoria_adq,$fecha_reg,$id_categoria_adq,$estado_categoria,$tipo,$nombre)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_tipo_categoria_adq_iud';
		$this->codigo_procedimiento = "'AD_TIPCAT_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_categoria_adq);
		$this->var->add_param("'$estado_categoria'");
		$this->var->add_param("'$tipo'");
		$this->var->add_param("'$nombre'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarTipoCategoriaAdq
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tad_tipo_categoria_adq
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 10:18:00
	 */
	function ModificarTipoCategoriaAdq($id_tipo_categoria_adq,$fecha_reg,$id_categoria_adq,$estado_categoria,$tipo,$nombre)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_tipo_categoria_adq_iud';
		$this->codigo_procedimiento = "'AD_TIPCAT_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_tipo_categoria_adq);
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_categoria_adq);
		$this->var->add_param("'$estado_categoria'");
		$this->var->add_param("'$tipo'");
		$this->var->add_param("'$nombre'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarTipoCategoriaAdq
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tad_tipo_categoria_adq
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 10:18:00
	 */
	function EliminarTipoCategoriaAdq($id_tipo_categoria_adq)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tad_tipo_categoria_adq_iud';
		$this->codigo_procedimiento = "'AD_TIPCAT_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_tipo_categoria_adq);
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
	 * Nombre de la funci�n:	ValidarTipoCategoriaAdq
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tad_tipo_categoria_adq
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 10:18:00
	 */
	function ValidarTipoCategoriaAdq($operacion_sql,$id_tipo_categoria_adq,$fecha_reg,$id_categoria_adq,$estado_categoria,$tipo,$nombre)
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
				//Validar id_tipo_categoria_adq - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_tipo_categoria_adq");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_categoria_adq", $id_tipo_categoria_adq))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar fecha_reg - tipo date
//			$tipo_dato->_reiniciar_valor();
//			$tipo_dato->set_Columna("fecha_reg");
//			$tipo_dato->set_MaxLength(10);
//			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_reg", $fecha_reg))
//			{
//				$this->salida = $valid->salida;
//				return false;
//			}

			//Validar id_categoria_adq - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_categoria_adq");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_categoria_adq", $id_categoria_adq))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar estado_categoria - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_categoria");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado_categoria", $estado_categoria))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar tipo - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("tipo");
			$tipo_dato->set_MaxLength(30);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "tipo", $tipo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar nombre - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nombre");
			$tipo_dato->set_MaxLength(30);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "nombre", $nombre))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validaci�n de reglas de datos

			//Validar estado_categoria
			$check = array ("activo","inactivo","eliminado");
			if(!in_array($estado_categoria,$check))
			{
				$this->salida[0] = "f";
				$this->salida[1] = "Error de validaci�n en columna 'estado_categoria': El valor no est� dentro del dominio definido";
				$this->salida[2] = "ORIGEN = $this->nombre_archivo";
				$this->salida[3] = "PROC = ValidarTipoCategoriaAdq";
				$this->salida[4] = "NIVEL = 3";
				return false;
			}
			//Validar tipo
			$check = array ("Cotizacion","Solicitud","Proceso");
			if(!in_array($tipo,$check))
			{
				$this->salida[0] = "f";
				$this->salida[1] = "Error de validaci�n en columna 'tipo': El valor no est� dentro del dominio definido";
				$this->salida[2] = "ORIGEN = $this->nombre_archivo";
				$this->salida[3] = "PROC = ValidarTipoCategoriaAdq";
				$this->salida[4] = "NIVEL = 3";
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_tipo_categoria_adq - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_tipo_categoria_adq");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_categoria_adq", $id_tipo_categoria_adq))
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