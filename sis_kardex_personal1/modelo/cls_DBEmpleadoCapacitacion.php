<?php
/**
 * Nombre de la Clase:	cls_DBEmpleadoCapacitacion
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tkp_Capacitacion
 * Autor:				Mercedes Zambrana Meneses
 * Fecha creaci�n:		20-08-2010
 *
 */
class cls_DBEmpleadoCapacitacion
{
	//Variable que contiene la salida de la ejecuci�n de la funci�n
	//si la funci�n tuvo error (false), salida contendr� el mensaje de error
	//si la funci�n no tuvo error (true), salida contendr� el resultado, ya sea un conjunto de datos o un mensaje de confirmaci�n
	var $salida;
	
	//Variable que contedr� la cadena de llamada a las funciones postgres
	var $query;

	//Variables para la ejecuci�n de funciones
	var $var; //middle_client
	var $nombre_funcion; //nombre de la funci�n a ejecutar
	var $codigo_procedimiento; //codigo del procedimiento a ejecutar

	//Nombre del archivo
	var $nombre_archivo = "cls_DBEmpleadoCapacitacion.php";

	//Matriz de par�metros de validaci�n de todas las columnas
	var $matriz_validacion = array();
	
	//Bandera que indica si los datos se decodificar�n o no
	var $decodificar = false;

	function __construct($decodificar)
	{
		//Carga los par�metro de validaci�n de todas las columnas
		//$this->cargar_param_valid();
		
		//Carga en una variable interna la bandera del GET o POST
		$this->decodificar = $decodificar;
	}

	/**
	 * Nombre de la funci�n:	ListarCapacitacion
	 * Prop�sito:				Desplegar los registros de tkp_Capacitacion en funci�n de los par�metros del filtro
	 * Autor:					Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		20-08-2010
	 *
	 */
	function ListarEmpleadoCapacitacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_empleado_capacitacion_sel';
		$this->codigo_procedimiento = "'KP_EMPCAP_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

		//Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '',"'%'",$id_financiador));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'",$id_regional));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'",$id_programa));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'",$id_proyecto));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'",$id_actividad));//id_actividad

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_empleado_capacitacion','integer');
		$this->var->add_def_cols('id_tipo_capacitacion','integer');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('id_institucion','integer');
		
		$this->var->add_def_cols('financiado','varchar');
		$this->var->add_def_cols('fecha_ini','date');
		$this->var->add_def_cols('fecha_fin','date');
		$this->var->add_def_cols('id_empleado','integer');
		$this->var->add_def_cols('desc_institucion','varchar');
		$this->var->add_def_cols('desc_empleado','text');
		$this->var->add_def_cols('desc_capacitacion','varchar');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('nombre_institucion','varchar');
		$this->var->add_def_cols('direccion_institucion','varchar');
		$this->var->add_def_cols('ano_graduacion','integer');
		$this->var->add_def_cols('lugar_capacitacion','varchar');
		
		$this->var->add_def_cols('id_carrera','integer');
		$this->var->add_def_cols('fecha_titulo','date');
		$this->var->add_def_cols('carrera','varchar');
		$this->var->add_def_cols('reg_profesional','varchar');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarEmpleadoCapacitacion
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		20-08-2010
	 *
	 */
	function ContarEmpleadoCapacitacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_empleado_capacitacion_sel';
		$this->codigo_procedimiento = "'KP_EMPCAP_COUNT'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

		//Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '',"'%'",$id_financiador));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'",$id_regional));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'",$id_programa));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'",$id_proyecto));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'",$id_actividad));//id_actividad

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
	 * Nombre de la funci�n:	InsertarEmpleadoCapacitacion
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_Capacitacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		20-08-2010
	 * Descripci�n:             Se a�adio los atributos fecha_reg, estado_reg
	
	 */
	function InsertarEmpleadoCapacitacion($id_empleado_capacitacion,$id_tipo_capacitacion,$descripcion,$id_institucion,$nombre,$financiado,$fecha_ini,$fecha_fin,$id_empleado,$nombre_institucion,$direccion_institucion,$ano_graduacion,$id_persona,$carrera,$fecha_titulo,$reg_profesional)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_empleado_capacitacion_iud';
		$this->codigo_procedimiento = "'KP_EMPCAP_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_tipo_capacitacion);
		$this->var->add_param("'$descripcion'");
		$this->var->add_param($id_institucion);
		$this->var->add_param("'$nombre'");
		$this->var->add_param("'$financiado'");
		$this->var->add_param("'$fecha_ini'");
		$this->var->add_param("'$fecha_fin'");
		$this->var->add_param($id_empleado);
		$this->var->add_param("'$nombre_institucion'");
		$this->var->add_param("'$direccion_institucion'");
		$this->var->add_param("'$ano_graduacion'");
		$this->var->add_param($id_persona);
		$this->var->add_param("'$carrera'");
		$this->var->add_param("'$fecha_titulo'");
		$this->var->add_param("'$reg_profesional'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarEmpleadoCapacitacion
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_Capacitacion
	 * Autor:				    Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		20-08-2010
	 */
	function ModificarEmpleadoCapacitacion($id_empleado_capacitacion,$id_tipo_capacitacion,$descripcion,$id_institucion,$nombre,$financiado,$fecha_ini,$fecha_fin,$id_empleado,$nombre_institucion,$direccion_institucion,$ano_graduacion,$id_persona,$carrera,$fecha_titulo,$reg_profesional)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_empleado_capacitacion_iud';
		$this->codigo_procedimiento = "'KP_EMPCAP_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_empleado_capacitacion);
		$this->var->add_param($id_tipo_capacitacion);
		$this->var->add_param("'$descripcion'");
		$this->var->add_param($id_institucion);
		$this->var->add_param("'$nombre'");
		$this->var->add_param("'$financiado'");
		$this->var->add_param("'$fecha_ini'");
		$this->var->add_param("'$fecha_fin'");
		$this->var->add_param($id_empleado);
		
		$this->var->add_param("'$nombre_institucion'");
		$this->var->add_param("'$direccion_institucion'");
		$this->var->add_param("'$ano_graduacion'");
		$this->var->add_param($id_persona);
		$this->var->add_param("'$carrera'");
		$this->var->add_param("'$fecha_titulo'");
		$this->var->add_param("'$reg_profesional'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarEmpleadoCapacitacion
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tkp_Capacitacion
	 * Autor:				    Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		20-08-2010
	 */
	function EliminarEmpleadoCapacitacion($id_empleado_capacitacion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_empleado_capacitacion_iud';
		$this->codigo_procedimiento = "'KP_EMPCAP_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_empleado_capacitacion);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		
		$this->var->add_param("NULL");
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
	 * Nombre de la funci�n:	ValidarEmpleadoCapacitacion
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tkp_Capacitacion
	 * Autor:				    Mercedes Zambrana Meneses
	 * Fecha de creaci�n:		20-08-2010
	 */
	function ValidarEmpleadoCapacitacion($operacion_sql,$id_empleado_capacitacion,$id_tipo_capacitacion,$descripcion,$id_institucion,$nombre,$financiado,$fecha_ini,$fecha_fin,$id_empleado)
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
				//Validar id_Capacitacion - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_empleado_capacitacion");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado_capacitacion", $id_empleado_capacitacion))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

				//Validar id_Capacitacion - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_tipo_capacitacion");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_tipo_capacitacion", $id_tipo_capacitacion))
				{
					$this->salida = $valid->salida;
					return false;
				}			
			
				//Validar nombre - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(3000);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			/*$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_institucion");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_institucion", $id_institucion))
				{
					$this->salida = $valid->salida;
					return false;
				}*/
				
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("nombre");
			$tipo_dato->set_MaxLength(300);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "nombre", $nombre))
			{
				$this->salida = $valid->salida;
				return false;
			}		
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("financiado");
			$tipo_dato->set_MaxLength(30);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "financiado", $financiado))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_ini");
			$tipo_dato->set_MaxLength(20);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_ini", $fecha_ini))
			{
				$this->salida = $valid->salida;
				return false;
			}

			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_fin");
			$tipo_dato->set_MaxLength(20);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_fin", $fecha_fin))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado_capacitacion");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado_capacitacion", $id_empleado_capacitacion))
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