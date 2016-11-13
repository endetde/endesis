<?php
/**
 * Nombre de la clase:	cls_DBItemArchivo.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tal_tal_item_archivo
 * Autor:				
 * Fecha creaci�n:		
 */

class cls_DBItemArchivo
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
	 * Nombre de la funci�n:	ListarItemArchivo
	 * Prop�sito:				Desplegar los registros de tal_item_archivo
	 * Autor:				    
	 * Fecha de creaci�n:			 
	 * */
	function ListarItemArchivo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_item_archivo_sel';
		$this->codigo_procedimiento = "'AL_ITEARC_SEL'";

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
		$this->var->add_param($func->iif($id_financiador == '','NULL',$id_financiador));//id_financiador
		$this->var->add_param($func->iif($id_regional == '','NULL',$id_regional));//id_regional
		$this->var->add_param($func->iif($id_programa == '','NULL',$id_programa));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '','NULL',$id_proyecto));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '','NULL',$id_actividad));//id_actividad

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_item_archivo','int4');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('tipo','varchar');
	//	$this->var->add_def_cols('archivo','bytea');
		$this->var->add_def_cols('extension','varchar');
		$this->var->add_def_cols('fecha_reg','date');
        $this->var->add_def_cols('id_item','int4');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarItemArchivo
	 * Prop�sito:				Contar los registros de tal_item_archivo
	 * Autor:				    
	 * Fecha de creaci�n:		
	 */
	function ContarItemArchivo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_item_archivo_sel';
		$this->codigo_procedimiento = "'AL_ITEARC_COUNT'";

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
		$this->var->add_param($func->iif($id_financiador == '','NULL',$id_financiador));//id_financiador
		$this->var->add_param($func->iif($id_regional == '','NULL',$id_regional));//id_regional
		$this->var->add_param($func->iif($id_programa == '','NULL',$id_programa));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '','NULL',$id_proyecto));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '','NULL',$id_actividad));//id_actividad
		
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
	 * Nombre de la funci�n:	InsertarItemArchivo
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_item_archivo
	 * Autor:				    
	 * Fecha de creaci�n:		
	 */
	function InsertarItemArchivo($id_item_archivo,$descripcion,$tipo,$archivo,$extension,$fecha_reg, $id_item)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_item_archivo_iud';
		$this->codigo_procedimiento = "'AL_ITEARC_INS'";
		

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$tipo'");
		$this->var->add_param("'$archivo'");
		$this->var->add_param("'$extension'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_item);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarItemArchivo
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_item_archivo
	 * Autor:				    
	 * Fecha de creaci�n:		
	 */
	function ModificarItemArchivo($id_item_archivo,$descripcion,$tipo,$archivo,$extension,$fecha_reg,$id_item)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_item_archivo_iud';
		$this->codigo_procedimiento = "'AL_ITEARC_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_item_archivo);
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$tipo'");
		$this->var->add_param("'$archivo'");
		$this->var->add_param("'$extension'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param($id_item);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarItemArchivo
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_item_archivo
	 * Autor:				    
	 * Fecha de creaci�n:		
	 */
	function EliminarItemArchivo($id_item_archivo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_item_archivo_iud';
		$this->codigo_procedimiento = "'AL_ITEARC_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_item_archivo);
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
	 * Nombre de la funci�n:	ValidarItemArchivo
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tal_item_archivo
	 * Autor:				    
	 * Fecha de creaci�n:		
	 */
	function ValidarItemArchivo($operacion_sql,$id_item_archivo,$descripcion,$tipo,$archivo,$extension,$id_item)
	{
		$this->salida = "";
		$valid = new cls_validacion_serv();

		//Clase para validad el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();
	
		//Ejecuta la validaci�n por el tipo de operaci�n
		if($operacion_sql=='insert' || $operacion_sql=='update')
		{
			if($operacion_sql == 'update')
			{
				//Validar id_item_reemplazo - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("id_item_archivo");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_item_archivo", $id_item_archivo))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar descripcion - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(300);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar observaciones - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("tipo");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "tipo", $tipo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fecha_reg - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("archivo");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "archivo", $archivo))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_item - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("extension");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "extension", $extension))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar id_item - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_item");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_item", $id_item))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{	//Validar id_item_archivo - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_item");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_item", $id_item))
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