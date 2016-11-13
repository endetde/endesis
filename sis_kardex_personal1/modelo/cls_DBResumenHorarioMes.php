<?php
/**
 * Nombre de la Clase:	cls_DBResumenHorarioMes
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tkp_parametro_cuenta_auxiliar
 * Autor:				Fernanda Prudencio Cardona
 * Fecha creaci�n:		13-10-2010
 *
 */
class cls_DBResumenHorarioMes
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
	var $nombre_archivo = "cls_DBResumenHorarioMes.php";

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
	 * Nombre de la funci�n:	ListarResumenHorarioMes
	 * Prop�sito:				Desplegar los registros de tkp_resumen_horario_mes en funci�n de los par�metros del filtro
	 * Autor:					Fernanda Prudencio Cardona
	 * Fecha de creaci�n:		13-10-2010
	 *
	 */
	function ListarResumenHorarioMes($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_resumen_horario_mes_sel';
		$this->codigo_procedimiento = "'KP_RESHORMES_SEL'";

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
		//$this->var->add_param($func->iif($id_actividad == '',"'%'",$id_actividad));//id_actividad
		$this->var->add_param("'$id_actividad'");//id_actividad

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_resumen_horario_mes','integer');
		$this->var->add_def_cols('id_empleado_planilla','integer');
		$this->var->add_def_cols('usuario_reg','integer');
		$this->var->add_def_cols('horas_disp','numeric');
		$this->var->add_def_cols('horas_normales','numeric');
		$this->var->add_def_cols('horas_extra','numeric');
		$this->var->add_def_cols('horas_nocturnas','numeric');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('nombre_completo','text');
		$this->var->add_def_cols('id_empleado','integer');
		$this->var->add_def_cols('id_gestion','integer');
		$this->var->add_def_cols('parametrizado','integer');
		$this->var->add_def_cols('id_planilla','integer');
		$this->var->add_def_cols('horas_normales_efectivas','numeric');
		$this->var->add_def_cols('costo_horas_normales_efectivas','numeric');
		$this->var->add_def_cols('costo_horas_extra','numeric');
		$this->var->add_def_cols('costo_horas_nocturnas','numeric');
		$this->var->add_def_cols('costo_horas_disp','numeric');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarResumenHorarioMes
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					Fernanda Prudencio Cardona
	 * Fecha de creaci�n:		13-10-2010
	 *
	 */
	function ContarResumenHorarioMes($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_resumen_horario_mes_sel';
		$this->codigo_procedimiento = "'KP_RESHORMES_COUNT'";

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
	 * Nombre de la funci�n:	ListarEmpleadoPlanillaF
	 * Prop�sito:				Desplegar los registros de tkp_resumen_horario_mes en funci�n de los par�metros del filtro
	 * Autor:					Fernanda Prudencio Cardona
	 * Fecha de creaci�n:		13-10-2010
	 *
	 */
	function ListarEmpleadoPlanillaF($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_resumen_horario_mes_sel';
		$this->codigo_procedimiento = "'KP_EMPPLAN_FAL'";

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
		$this->var->add_def_cols('id_empleado_planilla','integer');
		$this->var->add_def_cols('id_empleado','integer');
		$this->var->add_def_cols('nombre_completo','text');
		$this->var->add_def_cols('id_planilla','integer');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	/**
	 * Nombre de la funci�n:	ContarEmpleadoPlanillaF
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					Fernanda Prudencio Cardona
	 * Fecha de creaci�n:		13-10-2010
	 *
	 */
	function ContarEmpleadoPlanillaF($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_resumen_horario_mes_sel';
		$this->codigo_procedimiento = "'KP_EMPPLAN_FAL_COUNT'";

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
	 * Nombre de la funci�n:	InsertarResumenHorarioMes
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_resumen_horario_mes
	 * Autor:				    Fernanda Prudencio Cardona
	 * Fecha de creaci�n:		13-10-2010
	 * Descripci�n:             
	
	 */
	function InsertarResumenHorarioMes($id_resumen_horario_mes,$id_empleado_planilla_f,$id_planilla)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_resumen_horario_mes_iud';
		$this->codigo_procedimiento = "'KP_RESHORMES_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_planilla);
		$this->var->add_param($id_empleado_planilla_f);
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
	 * Nombre de la funci�n:	ModificarResumenHorarioMes
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_resumen_horario_mes
	 * Autor:				    Fernanda Prudencio Cardona
	 * Fecha de creaci�n:		13-10-2010
	 */
	function ModificarResumenHorarioMes($id_resumen_horario_mes,$id_empleado_planilla,$horas_disp,$horas_normales,$horas_extra,$horas_nocturnas,$costo_horas_normales,$costo_horas_extra,$costo_horas_nocturnas,$costo_horas_disp,$horas_normales_efectivas)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_resumen_horario_mes_iud';
		$this->codigo_procedimiento = "'KP_RESHORMES_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_resumen_horario_mes);
		$this->var->add_param($id_empleado_planilla);
		$this->var->add_param($horas_disp);
		$this->var->add_param($horas_normales);
		$this->var->add_param($horas_extra);
		$this->var->add_param($horas_nocturnas);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($costo_horas_normales);
		$this->var->add_param($costo_horas_extra);
		$this->var->add_param($costo_horas_nocturnas);
		$this->var->add_param($costo_horas_disp);
		$this->var->add_param($horas_normales_efectivas);
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarResumenHorarioMes
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tkp_resumen_horario_mes
	 * Autor:				    Fernanda Prudencio Cardona
	 * Fecha de creaci�n:		13-10-2010
	 */
	function EliminarResumenHorarioMes($id_resumen_horario_mes)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_resumen_horario_mes_iud';
		$this->codigo_procedimiento = "'KP_RESHORMES_DEL'";
      
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_resumen_horario_mes);
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
	 * Nombre de la funci�n:	CargaResumenMarcas
	 * Prop�sito:				Permite ejecutar la funci�n de cargado del resumen de marcas
	 * Autor:				    Fernanda Prudencio Cardona
	 * Fecha de creaci�n:		13-10-2010
	 */
	function CargaResumenMarcas($id_resumen_horario_mes,$fecha_desde,$fecha_hasta)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_resumen_horario_mes_iud';
		$this->codigo_procedimiento = "'KP_CARGA_RESUMEN_MARCAS'";
      
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_resumen_horario_mes);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("'$fecha_desde'");
		$this->var->add_param("'$fecha_hasta'");
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
	 * Nombre de la funci�n:	ValidaResumen
	 * Prop�sito:				Permite ejecutar la funci�n de validaci�n de la tabla tkp_resumen_horario_mes
	 * Autor:				    Fernanda Prudencio Cardona
	 * Fecha de creaci�n:		11-11-2010
	 */
	function ValidaResumen($id_resumen_horario_mes,$horas_disp,$horas_normales,$horas_extra,$horas_nocturnas)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_resumen_horario_mes_iud';
		$this->codigo_procedimiento = "'KP_VALIDA_RES'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_resumen_horario_mes);
		$this->var->add_param("NULL");
		$this->var->add_param($horas_disp);
		$this->var->add_param($horas_normales);
		$this->var->add_param($horas_extra);
		$this->var->add_param($horas_nocturnas);
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
	 * Nombre de la funci�n:	ValidaResumenTodos
	 * Prop�sito:				Permite ejecutar la funci�n de validaci�n de la tabla tkp_resumen_horario_mes
	 * Autor:				    Fernanda Prudencio Cardona
	 * Fecha de creaci�n:		11-11-2010
	 */
	function ValidaResumenTodos($id_planilla)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_resumen_horario_mes_iud';
		$this->codigo_procedimiento = "'KP_VALIDA_TODOS_RES'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_planilla);
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
	 * Nombre de la funci�n:	CorrigeResumen
	 * Prop�sito:				Permite ejecutar la funci�n de correccion de la tabla tkp_resumen_horario_mes
	 * Autor:				    Fernanda Prudencio Cardona
	 * Fecha de creaci�n:		11-11-2010
	 */
	function CorrigeResumen($id_resumen_horario_mes,$tipo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_resumen_horario_mes_iud';
		$this->codigo_procedimiento = "'KP_CORRIG_RES'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_resumen_horario_mes);
		$this->var->add_param($tipo);
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
	 * Nombre de la funci�n:	ProrrateaHoras
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_resumen_horario_mes
	 * Autor:				    Fernanda Prudencio Cardona
	 * Fecha de creaci�n:		13-10-2010
	 * Descripci�n:             
	
	 */
	function ProrrateaHoras($id_resumen_horario_mes,$id_empleado_planilla,$horas_normales,$horas_extra,$horas_disp,$horas_nocturnas)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_resumen_horario_mes_iud';
		$this->codigo_procedimiento = "'KP_PRORRATEA_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_resumen_horario_mes);
		$this->var->add_param($id_empleado_planilla);
		$this->var->add_param($horas_disp);
		$this->var->add_param($horas_normales);
		$this->var->add_param($horas_extra);
		$this->var->add_param($horas_nocturnas);
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
	 * Nombre de la funci�n:	ProrrateaHorasTodos
	 * Prop�sito:				Permite ejecutar la funci�n de validaci�n de la tabla tkp_resumen_horario_mes
	 * Autor:				    Fernanda Prudencio Cardona
	 * Fecha de creaci�n:		11-11-2010
	 */
	function ProrrateaHorasTodos($id_planilla)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_resumen_horario_mes_iud';
		$this->codigo_procedimiento = "'KP_PRORRATEA_TODOS_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_planilla);
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
	 * Nombre de la funci�n:	ProrrateaOtrosHoras
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_costo_columna_valor
	 * Autor:				    Fernanda Prudencio Cardona
	 * Fecha de creaci�n:		13-10-2010
	 * Descripci�n:             
	
	 */
	function ProrrateaOtrosHoras($id_resumen_horario_mes,$tipo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tkp_resumen_horario_mes_iud';
		$this->codigo_procedimiento = "'KP_PRORRATEA_OTRO_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_resumen_horario_mes);
		$this->var->add_param($tipo);
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
       //echo $this->query; exit;
		return $res;
	}
	/**
	 * Nombre de la funci�n:	ValidarResumenHorarioMes
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tkp_resumen_horario_mes
	 * Autor:				    Fernanda Prudencio Cardona
	 * Fecha de creaci�n:		13-10-2010
	 */
	function ValidarResumenHorarioMes($operacion_sql,$id_resumen_horario_mes,$id_empleado_planilla,$horas_disp,$horas_normales,$horas_extra,$horas_nocturnas)
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
				//Validar $id_resumen_horario_mes - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_resumen_horario_mes");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_resumen_horario_mes", $id_resumen_horario_mes))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}
			
			
				
				//Validar $id_empleado_planilla - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_empleado_planilla");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado_planilla", $id_empleado_planilla))
				{
					$this->salida = $valid->salida;
					return false;
				}

			//Validar $horas_disp - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("horas_disp");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "horas_disp", $horas_disp))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			
			//Validar $horas_normales - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("horas_normales");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "horas_normales", $horas_normales))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar $horas_extras - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("horas_extra");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "horas_extra", $horas_extra))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar $horas_nocturnas - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("horas_nocturnas");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "horas_nocturnas", $horas_nocturnas))
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
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_resumen_horario_mes");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_resumen_horario_mes", $id_resumen_horario_mes))
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