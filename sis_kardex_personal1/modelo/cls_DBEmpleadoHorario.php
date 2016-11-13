<?php
/**
 * Nombre de la clase:	cls_DBEmpleadoHorario.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tkp_historico_asignacion
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-05-12 09:24:17
 */

 
class cls_DBEmpleadoHorario
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
	 * Nombre de la funci�n:	ListarEmpleadoHorario
	 * Prop�sito:				Desplegar los registros de tkp_empleado_horario
	 * Autor:				    Fernando Prudencio Cardona
	 * Fecha de creaci�n:		2008-05-12 09:24:17
	 */
	function ListarEmpleadoHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'kard.f_tkp_empleado_horario_sel';
		$this->codigo_procedimiento = "'KP_EMP_HOR_SEL'";

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
		$this->var->add_def_cols('id_empleado_horario','int4');
		$this->var->add_def_cols('id_empleado','integer');
		
        $this->var->add_def_cols('id_turno','integer');
        $this->var->add_def_cols('fecha_reg','date');
        $this->var->add_def_cols('estado_reg','varchar');
        $this->var->add_def_cols('fecha_ini','date');
        $this->var->add_def_cols('fecha_fin','date');
        $this->var->add_def_cols('codigo_turno','varchar');
        $this->var->add_def_cols('horario','text');
        $this->var->add_def_cols('nombre_turno','varchar');
        $this->var->add_def_cols('tipo_turno','varchar');
        $this->var->add_def_cols('variacion','varchar');
        
        //Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarEmpleadoHorario
	 * Prop�sito:				Contar los registros de tkp_empleado_horario
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 09:24:17
	 */
	function ContarEmpleadoHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'kard.f_tkp_empleado_horario_sel';
		$this->codigo_procedimiento = "'KP_EMP_HOR_COUNT'";

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
	 * Nombre de la funci�n:	InsertarEmpleadoHorario
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_empleado_horario
	 * Autor:				    Fernando Prudencio Cardona
	 * Fecha de creaci�n:		2010-05-12 09:24:17
	 */
	function InsertarEmpleadoHorario($id_empleado_horario,$id_empleado,$id_turno,$estado_reg,$fecha_ini,$fecha_fin)
	{
		$this->salida = "";
		$this->nombre_funcion = 'kard.f_tkp_empleado_horario_iud';
		$this->codigo_procedimiento = "'KP_EMP_HOR_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_empleado);
		$this->var->add_param($id_turno);
		$this->var->add_param("'$estado_reg'");
		$this->var->add_param("'$fecha_ini'");
		$this->var->add_param("'$fecha_fin'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	/**
	 * Nombre de la funci�n:	ModificarEmpleadoHorario
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_empleado_horario
	 * Autor:				    Fernando Prudencio Cardona
	 * Fecha de creaci�n:		2010-05-12 09:24:17
	 */
	function ModificarEmpleadoHorario($id_empleado_horario,$id_empleado,$id_turno,$estado_reg,$fecha_ini,$fecha_fin)
	{
		$this->salida = "";
		$this->nombre_funcion = 'kard.f_tkp_empleado_horario_iud';
		$this->codigo_procedimiento = "'KP_EMP_HOR_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_empleado_horario);
		$this->var->add_param($id_empleado);
		$this->var->add_param($id_turno);
		$this->var->add_param("'$estado_reg'");
		$this->var->add_param("'$fecha_ini'");
		$this->var->add_param("'$fecha_fin'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarEmpleadoHorario
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tkp_empleado_horario
	 * Autor:				    Fernando Prudencio Cardona
	 * Fecha de creaci�n:		2010-05-12 09:24:17
	 */
	function EliminarEmpleadoHorario($id_empleado_horario)
	{
		$this->salida = "";
		$this->nombre_funcion = 'kard.f_tkp_empleado_horario_iud';
		$this->codigo_procedimiento = "'KP_EMP_HOR_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_empleado_horario);
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
	 * Nombre de la funci�n:	ValidarEmpleadoHorario
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tkp_historico_asignacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-12 09:24:17
	 */
	function ValidarEmpleadoHorario($operacion_sql,$id_empleado_horario,$id_empleado,$id_turno,$estado_reg,$fecha_ini,$fecha_fin)
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
				//Validar id_empleado_horario - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_empleado_horario");
				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(),"id_empleado_horario",$id_empleado_horario))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}
			//Validar id_empleado - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado", $id_empleado))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validar id_horario - tipo integer
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_horario");
			$tipo_dato->set_MaxLength(15);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_turno", $id_turno))
			{
				$this->salida = $valid->salida;
				return false;
			}			
							
			//Validar estado_reg - tipo text
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("estado_reg");
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
			//Validar id_empleado_horario - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_empleado_horario");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_empleado_horario", $id_empleado_horario))
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