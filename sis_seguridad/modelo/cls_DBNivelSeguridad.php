<?php
/*
* Nombre de archivo:	    cls_DBTipoFormulario.php
* Prop�sito:				
* Fecha de Creaci�n:		2010-12-20
* Autor:					Marcos A. Flores Valda
*/
class cls_DBNivelSeguridad
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
	 * Autor:				    Boris Claros Olivera
	 * Fecha de creaci�n:		2010-04-21 10:28:39
	 */
	function ListarNivelSeguridad($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_nivel_seguridad_sel';
		$this->codigo_procedimiento = "'SG_NSEG_SEL'";
		
		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_nivel_seguridad','INTEGER');
		$this->var->add_def_cols('codigo','VARCHAR');
		$this->var->add_def_cols('nombre_nivel','VARCHAR');
		$this->var->add_def_cols('prioridad','INTEGER');
				
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
	 * Autor:				    Boris Claros Olivera
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function ContarNivelSeguridad($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_nivel_seguridad_sel';
		$this->codigo_procedimiento = "'SG_NSEG_COUNT'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('TotalCount','bigint');

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
	function InsertarNivelSeguridad($codigo,$nombre_nivel,$prioridad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_nivel_seguridad_iud';
		$this->codigo_procedimiento = "'SG_NSEG_INS'";
		
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$codigo'");
		$this->var->add_param("'$nombre_nivel'");
		$this->var->add_param($prioridad);
		
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//echo $this->query;exit;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarColumna
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_columna
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function ModificarNivelSeguridad($id_nivel_seguridad,$codigo,$nombre_nivel,$prioridad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_nivel_seguridad_iud';
		$this->codigo_procedimiento = "'SG_NSEG_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_nivel_seguridad);
		$this->var->add_param("'$codigo'");
		$this->var->add_param("'$nombre_nivel'");
		$this->var->add_param($prioridad);
				
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
	function EliminarNivelSeguridad($id_nivel_seguridad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_nivel_seguridad_iud';
		$this->codigo_procedimiento = "'SG_NSEG_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_nivel_seguridad);
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
	 * Nombre de la funci�n:	ValidarColumna
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tkp_columna
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function ValidarNivelSeguridad($operacion_sql,$id_nivel_seguridad,$codigo,$nombre_nivel,$prioridad)
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
				$tipo_dato->set_Columna("id_nivel_seguridad");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_nivel_seguridad", $id_nivel_seguridad))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			
			
			//Validar codigo - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("codigo");
			$tipo_dato->set_MaxLength(100);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "codigo", $codigo))
			{
				$this->salida = $valid->salida;
				return false;
				
				echo $descripcion;
					exit;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nombre_nivel");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "nombre_nivel", $nombre_nivel))
			{
				$this->salida = $valid->salida;
				return false;
				
				echo $nombre;
					exit;
			}
						
			//Validar prioridad - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("prioridad");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "prioridad", $prioridad))
			{
				$this->salida = $valid->salida;
				return false;
				
				echo $id_subsistema;
				exit;		
			}

			

			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_columna - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_nivel_seguridad");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_nivel_seguridad", $id_nivel_seguridad))
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
}
?>