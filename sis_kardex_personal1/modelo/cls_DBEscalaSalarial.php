<?php
/**
 * Nombre de la clase:	cls_DBEscalaSalarial.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tkp_tkp_escala_salarial
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2010-08-19 10:28:39
 */

 
class cls_DBEscalaSalarial
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
	 * Nombre de la funci�n:	ListarEscalaSalarial
	 * Prop�sito:				Desplegar los registros de tkp_escala_salarial
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function ListarEscalaSalarial($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_escala_salarial_sel';
		$this->codigo_procedimiento = "'KP_ESCSAL_SEL'";

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

		//Carga la definici�n de escala_salarials con sus tipos de datos
		$this->var->add_def_cols('id_escala_salarial','int4');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('nivel','integer');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('sueldo_mensual','numeric');
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
	 * Nombre de la funci�n:	ContarEscalaSalarial
	 * Prop�sito:				Contar los registros de tkp_escala_salarial
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-10-21 10:28:39
	 */
	function ContarEscalaSalarial($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_escala_salarial_sel';
		$this->codigo_procedimiento = "'KP_ESCSAL_COUNT'";

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

		
		//Carga la definici�n de escala_salarials con sus tipos de datos
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
	 * Nombre de la funci�n:	InsertarEscalaSalarial
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_escala_salarial
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
function InsertarEscalaSalarial($id_escala_salarial,$nombre,$nivel,$estado_reg,$descripcion,$sueldo_mensual)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_escala_salarial_iud';
		$this->codigo_procedimiento = "'KP_ESCSAL_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$nombre'");
		$this->var->add_param($nivel);
		$this->var->add_param("'$estado_reg'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param($sueldo_mensual);
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarEscalaSalarial
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_escala_salarial
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
function ModificarEscalaSalarial($id_escala_salarial,$nombre,$nivel,$estado_reg,$descripcion,$sueldo_mensual)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_escala_salarial_iud';
		$this->codigo_procedimiento = "'KP_ESCSAL_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_escala_salarial);
		
		$this->var->add_param("'$nombre'");
		$this->var->add_param($nivel);
		$this->var->add_param("'$estado_reg'");
		
		$this->var->add_param("'$descripcion'");
		$this->var->add_param($sueldo_mensual);
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarEscalaSalarial
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tkp_escala_salarial
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function EliminarEscalaSalarial($id_escala_salarial)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_escala_salarial_iud';
		$this->codigo_procedimiento = "'KP_ESCSAL_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_escala_salarial);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//sueldo mensual
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarEscalaSalarial
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tkp_escala_salarial
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function ValidarEscalaSalarial($operacion_sql,$id_escala_salarial,$nombre,$nivel,$estado_reg,$descripcion)
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
				//Validar id_escala_salarial - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_escala_salarial");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_escala_salarial", $id_escala_salarial))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_Columna("nivel");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "nivel", $nivel))
			{
				$this->salida = $valid->salida;
				return false;
			}
		
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nombre");
			$tipo_dato->set_MaxLength(1000);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "nombre", $nombre))
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
			//Validar id_escala_salarial - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_escala_salarial");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_escala_salarial", $id_escala_salarial))
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
	
	/***********10-11-2014************/
	/**
	 * Nombre de la funci�n:	InsertarEscalaSalarial
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_escala_salarial
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function InsertarEscalaSalarialIncremento($id_rango_ini,$id_rango_fin,$porcentaje, $fecha_aplicacion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_escala_salarial_iud';
		$this->codigo_procedimiento = "'KP_ESCSALINC_INS'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_rango_ini);
		$this->var->add_param("null");//$nombre
		$this->var->add_param($id_rango_fin);
		$this->var->add_param("null");
		$this->var->add_param("'$fecha_aplicacion'");
		$this->var->add_param($porcentaje);
	
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	
		return $res;
	}
	
	
}?>