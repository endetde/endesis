<?php
/**
 * Nombre de la Clase:	cls_DBEmpleadoCta
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tkp_empleado_cta
 * Autor:				Grover Velasquez Colque
 * Fecha creaci�n:		30-12-2009
 *
 */
class cls_DBEmpleadoCta
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
	var $nombre_archivo = "cls_DBEmpleadoCta.php";

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
	 * Nombre de la funci�n:	ListarEmpleadoCta
	 * Prop�sito:				Desplegar los registros de tkp_empleado en funci�n de los par�metros del filtro
	 * Autor:					Grover Velasquez Colque
	 * Fecha de creaci�n:		30-12-2009	
	 */	

	function ListarEmpleadoCta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{//Este m�todo es el �ltimo creado, y est� con el gui�n bajo porque el antiguo se llama igual
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_empleado_cta_sel';
		$this->codigo_procedimiento = "'KP_EMPCTA_SEL'";

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
		$this->var->add_def_cols('id_empleado_cta','int4');
		$this->var->add_def_cols('id_empleado','int4');
		$this->var->add_def_cols('desc_persona','text');		
		$this->var->add_def_cols('id_gestion','int4');
		$this->var->add_def_cols('desc_gestion','numeric');		
		
		$this->var->add_def_cols('id_cuenta','integer');
		$this->var->add_def_cols('nombre_cuenta','varchar');
		$this->var->add_def_cols('id_auxiliar','integer');
		$this->var->add_def_cols('nombre_auxiliar','varchar');
        $this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_cuenta_cobrar','integer');
		$this->var->add_def_cols('nombre_cuenta_cobrar','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	/*	echo $this->query;
		exit;*/
		return $res;
	}
	
		
	/**
	 * Nombre de la funci�n:	ContarEmpleado
	 * Prop�sito:				Contar los registros de tkp_empleado
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-18 09:06:56
	 */
	function ContarEmpleadoCta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_empleado_cta_sel';
		$this->codigo_procedimiento = "'KP_EMPCTA_COUNT'";

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
	 * Nombre de la funci�n:	InsertarEmpleadoCta
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_empleado
	 * Autor:				    Grover Velasquez Colque
	 * Fecha de creaci�n:		2007-10-18 09:06:56
	 * Fecha ultima de mod:     20/07/2009
	 * Descripci�n:             Se a�adio los atributos fecha_reg, estado_reg
	
	 */
	function InsertarEmpleadoCta($id_empleado_cta,$id_empleado,$id_gestion,$id_cuenta,$id_auxiliar,$estado_reg, $id_cuenta_cobrar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_empleado_cta_iud';
		$this->codigo_procedimiento = "'KP_EMPCTA_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_empleado);
		$this->var->add_param($id_gestion);
		$this->var->add_param($id_cuenta);
		$this->var->add_param($id_auxiliar);
		$this->var->add_param("'$estado_reg'");		
		$this->var->add_param($id_cuenta_cobrar);
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarEmpleadoCta
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_empleado
	 * Autor:				    Grover Velasquez Colque
	 * Fecha de creaci�n:		2007-10-18 09:06:56
	 */
	function ModificarEmpleadoCta($id_empleado_cta,$id_empleado,$id_gestion,$id_cuenta,$id_auxiliar,$estado_reg,$id_cuenta_cobrar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_empleado_cta_iud';
		$this->codigo_procedimiento = "'KP_EMPCTA_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_empleado_cta);
		$this->var->add_param($id_empleado);
		$this->var->add_param($id_gestion);
		$this->var->add_param($id_cuenta);
		$this->var->add_param($id_auxiliar);
		$this->var->add_param("'$estado_reg'");
		$this->var->add_param($id_cuenta_cobrar);
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarEmpleadoCta
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tkp_empleado
	 * Autor:				    Grover Velasquez
	 * Fecha de creaci�n:		2007-10-18 09:06:56
	 */
	function EliminarEmpleadoCta($id_empleado_cta)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_empleado_cta_iud';
		$this->codigo_procedimiento = "'KP_EMPCTA_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_empleado_cta);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");//id_cuenta_cobrar

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarEmpleadoCta
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tkp_empleado
	 * Autor:				    Grover Velasquez Colque
	 * Fecha de creaci�n:		2007-10-18 09:06:56
	 */
	function ValidarEmpleadoCta($operacion_sql,$id_empleado_cta,$id_empleado,$id_gestion,$id_cuenta,$id_auxiliar,$estado_reg)
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
				//Validar id_empleado - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_empleado_cta");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado_cta", $id_empleado_cta))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}
			//Validar id_persona - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado", $id_empleado))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar codigo_empleado - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_gestion");
			$tipo_dato->set_MaxLength(20);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "id_gestion", $id_gestion))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar id_cuenta - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_cuenta");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cuenta", $id_cuenta))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar id_auxiliar - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_auxiliar");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_auxiliar", $id_auxiliar))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_reg");
			$tipo_dato->set_MaxLength(20);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado_reg", $estado_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_reg");
			$tipo_dato->set_MaxLength(20);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_reg", $fecha_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}			
			
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_empleado - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado_cta");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado_cta", $id_empleado_cta))
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