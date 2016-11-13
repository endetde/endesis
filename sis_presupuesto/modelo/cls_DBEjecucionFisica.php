<?php
/**
 * Nombre de la clase:	cls_DBEjecucionFisica.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpr_ejecucion_fisica
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-07-04 08:54:27
 */

 
class cls_DBEjecucionFisica
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
	 * Nombre de la funci�n:	ListarEjecucionFisica
	 * Prop�sito:				Desplegar los registros de tpr_ejecucion_fisica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 08:54:27
	 */
	function ListarEjecucionFisica($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_ejecucion_fisica_sel';
		$this->codigo_procedimiento = "'PR_EJEC_FISICA_SEL'";

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
		$this->var->add_def_cols('id_ejecucion_fisica','int4');
		$this->var->add_def_cols('id_parametro','integer');
		$this->var->add_def_cols('desc_parametro','numeric');
		$this->var->add_def_cols('id_proyecto','integer');
		$this->var->add_def_cols('periodo_pres','numeric');
		$this->var->add_def_cols('porcentaje_ejecucion','numeric');
		$this->var->add_def_cols('estado','varchar');
		$this->var->add_def_cols('id_usr_reg','integer');
		$this->var->add_def_cols('desc_usr_reg','text');
		$this->var->add_def_cols('fecha_reg','text');
		$this->var->add_def_cols('id_usr_mod','integer');
		$this->var->add_def_cols('desc_usr_mod','text');
		$this->var->add_def_cols('fecha_mod','text');
		$this->var->add_def_cols('justificacion_fisica','text');
		$this->var->add_def_cols('justificacion_financiera','text');
		$this->var->add_def_cols('acciones_fisica','text');
		$this->var->add_def_cols('acciones_financiera','text');
		$this->var->add_def_cols('problemas_fisica','text');
		$this->var->add_def_cols('tiempo_solucion','text');
		
		$this->var->add_def_cols('presupuesto_aprobado','numeric');
		$this->var->add_def_cols('presupuesto_vigente','numeric');
		$this->var->add_def_cols('ejecucion_financiera','numeric');		
		$this->var->add_def_cols('porcentaje_financiera','text');		
		

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo $this->query;
		exit();*/
		
		return $res;
	}	
		
	/**
	 * Nombre de la funci�n:	ContarEjecucionFisica
	 * Prop�sito:				Contar los registros de tpr_ejecucion_fisica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 08:54:27
	 */
	function ContarEjecucionFisica($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_ejecucion_fisica_sel';
		$this->codigo_procedimiento = "'PR_EJEC_FISICA_COUNT'";

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
	
	function ListarReporteEjecucionFisica($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)	
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_ejecucion_fisica_sel';
		$this->codigo_procedimiento = "'PR_REP_EJE_FIS_SEL'";

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
		
		$this->var->add_def_cols('desc_parametro','numeric');
		$this->var->add_def_cols('periodo_pres','varchar');
		
		$this->var->add_def_cols('nombre_proyecto','varchar');
		$this->var->add_def_cols('codigo_sisin','bigint');
		$this->var->add_def_cols('fase_proyecto','varchar');
		$this->var->add_def_cols('tipo_estudio','varchar');
		$this->var->add_def_cols('gerencia','varchar');
		$this->var->add_def_cols('desc_persona','text');
		$this->var->add_def_cols('celular','varchar');
		
		$this->var->add_def_cols('presupuesto_aprobado','numeric');
		$this->var->add_def_cols('presupuesto_vigente','numeric');
		$this->var->add_def_cols('ejecucion_financiera','numeric');
		
		$this->var->add_def_cols('porcentaje_financiera','text');		
		$this->var->add_def_cols('justificacion_financiera','text');
		$this->var->add_def_cols('acciones_financiera','text');
		
		$this->var->add_def_cols('porcentaje_ejecucion','text'); 
		$this->var->add_def_cols('justificacion_fisica','text');
		$this->var->add_def_cols('acciones_fisica','text');
		

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo $this->query;
		exit();*/
		
		return $res;
	}	
	
	/**
	 * Nombre de la funci�n:	InsertarEjecucionFisica
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_ejecucion_fisica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 08:54:27
	 */
	function InsertarEjecucionFisica($id_ejecucion_fisica,$id_parametro,$id_proyecto,$periodo_pres,$porcentaje_ejecucion,$estado,$justificacion_fisica,$justificacion_financiera,$acciones_fisica,$acciones_financiera,$problemas_fisica,$tiempo_solucion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_ejecucion_fisica_iud';
		$this->codigo_procedimiento = "'PR_EJEC_FISICA_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_parametro);
		$this->var->add_param($id_proyecto);
		$this->var->add_param($periodo_pres);
		$this->var->add_param($porcentaje_ejecucion);
		$this->var->add_param("'$estado'");
		$this->var->add_param("'$justificacion_fisica'");
		$this->var->add_param("'$justificacion_financiera'");
		$this->var->add_param("'$acciones_fisica'");
		$this->var->add_param("'$acciones_financiera'");
		$this->var->add_param("'$problemas_fisica'");
		$this->var->add_param("'$tiempo_solucion'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarEjecucionFisica
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpr_ejecucion_fisica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 08:54:27
	 */
	function ModificarEjecucionFisica($id_ejecucion_fisica,$id_parametro,$id_proyecto,$periodo_pres,$porcentaje_ejecucion,$estado,$justificacion_fisica,$justificacion_financiera,$acciones_fisica,$acciones_financiera,$problemas_fisica,$tiempo_solucion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_ejecucion_fisica_iud';
		$this->codigo_procedimiento = "'PR_EJEC_FISICA_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_ejecucion_fisica);
		$this->var->add_param($id_parametro);
		$this->var->add_param($id_proyecto);
		$this->var->add_param($periodo_pres);
		$this->var->add_param($porcentaje_ejecucion);
		$this->var->add_param("'$estado'");
		$this->var->add_param("'$justificacion_fisica'");
		$this->var->add_param("'$justificacion_financiera'");
		$this->var->add_param("'$acciones_fisica'");
		$this->var->add_param("'$acciones_financiera'");
		$this->var->add_param("'$problemas_fisica'");
		$this->var->add_param("'$tiempo_solucion'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarEjecucionFisica
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_ejecucion_fisica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 08:54:27
	 */
	function EliminarEjecucionFisica($id_ejecucion_fisica)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_ejecucion_fisica_iud';
		$this->codigo_procedimiento = "'PR_EJEC_FISICA_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_ejecucion_fisica);
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
	
	function CambiarEstadoEjecucionFisica($id_ejecucion_fisica,$accion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_ejecucion_fisica_iud';
		$this->codigo_procedimiento = "'PR_EJEC_FISICA_CERRAR'";
		
		/*if($accion=='enviar_autorizar'){
			$this->codigo_procedimiento = "'PR_MODIFI_ENVIAR_AUTORIZAR'";
		}
		elseif ($accion=='aprobar_modificacion'){
			$this->codigo_procedimiento = "'PR_MODIFI_APROBAR'";
		}
		elseif ($accion=='rechazar_modificacion'){
			$this->codigo_procedimiento = "'PR_MODIFI_RECHAZAR'";
		}
		elseif ($accion=='concluir_modificacion'){
			$this->codigo_procedimiento = "'PR_MODIFI_CONCLUIR'";
		}*/

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		
		$this->var->add_param($id_ejecucion_fisica);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("'$accion'");
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
	 * Nombre de la funci�n:	ValidarEjecucionFisica
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpr_ejecucion_fisica
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 08:54:27
	 */
	function ValidarEjecucionFisica($operacion_sql,$id_ejecucion_fisica,$id_parametro,$id_proyecto,$periodo_pres,$porcentaje_ejecucion,$estado)
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
				//Validar id_ejecucon_fisica - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_ejecucion_fisica");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_ejecucion_fisica", $id_ejecucion_fisica))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}
			
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_categoria - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_ejecucion_fisica");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_ejecucion_fisica", $id_ejecucion_fisica))
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