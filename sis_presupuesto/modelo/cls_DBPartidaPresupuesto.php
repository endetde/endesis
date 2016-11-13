<?php
/**
 * Nombre de la clase:	cls_DBPartidaPresupuesto.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpr_tpr_partida_presupuesto
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-07-10 08:45:12
 */

 
class cls_DBPartidaPresupuesto
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
	 * Nombre de la funci�n:	ListarDetalleParidaFormulacion
	 * Prop�sito:				Desplegar los registros de tpr_partida_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:12
	 */
	function ListarDetallePartidaFormulacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_partida_presupuesto_sel';
		$this->codigo_procedimiento = "'PR_DEPRGA_SEL'";

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
		$this->var->add_def_cols('id_partida_presupuesto','int4');

		
		$this->var->add_def_cols('fecha_elaboracion','date');
		$this->var->add_def_cols('id_partida','integer');
		$this->var->add_def_cols('desc_partida','text');
		$this->var->add_def_cols('id_presupuesto','integer');
		$this->var->add_def_cols('desc_presupuesto','numeric');
		$this->var->add_def_cols('id_partida_detalle','integer');
		$this->var->add_def_cols('mes_01','numeric');
		$this->var->add_def_cols('mes_02','numeric');
		$this->var->add_def_cols('mes_03','numeric');
		$this->var->add_def_cols('mes_04','numeric');
		$this->var->add_def_cols('mes_05','numeric');
		$this->var->add_def_cols('mes_06','numeric');
		$this->var->add_def_cols('mes_07','numeric');
		$this->var->add_def_cols('mes_08','numeric');
		$this->var->add_def_cols('mes_09','numeric');
		$this->var->add_def_cols('mes_10','numeric');
		$this->var->add_def_cols('mes_11','numeric');
		$this->var->add_def_cols('mes_12','numeric');
		$this->var->add_def_cols('total','numeric');
		$this->var->add_def_cols('desc_partida_presupuesto','integer');
		$this->var->add_def_cols('id_moneda','integer');
		$this->var->add_def_cols('desc_moneda','varchar');
		$this->var->add_def_cols('codigo_partida','varchar');
		$this->var->add_def_cols('tipo_memoria','numeric');
		$this->var->add_def_cols('partida_descripcion','varchar');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
//echo 	$this->query;
//exit();
return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarDetalleParidaFormulacion
	 * Prop�sito:				Contar los registros de tpr_partida_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:12
	 */
	function ContarDetallePartidaFormulacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
	 
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_partida_presupuesto_sel';
		$this->codigo_procedimiento = "'PR_DEPRGA_COUNT'";

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

	/*	echo $this->query;
		exit();
		*/
		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	InsertarDetalleParidaFormulacion
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_partida_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:12
	 */
	function InsertarDetallePartidaFormulacion($id_partida_presupuesto,$codigo_formulario,$fecha_elaboracion,$id_partida,$id_presupuesto,$id_partida_detalle,$mes_01,$mes_02,$mes_03,$mes_04,$mes_05,$mes_06,$mes_07,$mes_08,$mes_09,$mes_10,$mes_11,$mes_12,$total,$id_partida_presupuesto,$id_moneda)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_partida_presupuesto_iud';
		$this->codigo_procedimiento = "'PR_DEPRGA_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_partida_presupuesto);
		$this->var->add_param("'$codigo_formulario'");
		$this->var->add_param("'$fecha_elaboracion'");
		$this->var->add_param($id_partida);
		$this->var->add_param($id_presupuesto);
		$this->var->add_param($id_partida_detalle);
		$this->var->add_param($mes_01);
		$this->var->add_param($mes_02);
		$this->var->add_param($mes_03);
		$this->var->add_param($mes_04);
		$this->var->add_param($mes_05);
		$this->var->add_param($mes_06);
		$this->var->add_param($mes_07);
		$this->var->add_param($mes_08);
		$this->var->add_param($mes_09);
		$this->var->add_param($mes_10);
		$this->var->add_param($mes_11);
		$this->var->add_param($mes_12);
		$this->var->add_param($total);
		$this->var->add_param($id_partida_presupuesto);
		$this->var->add_param($id_moneda);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}/**
	 * Nombre de la funci�n:	InsertarDetalleParidaFormulacion
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_partida_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:12
	 */
	function InsertarPartidaPresupuestoAsignacion($id_partida_presupuesto,$codigo_formulario,$fecha_elaboracion,$id_partida,$id_presupuesto)
	{
		$this->salida = "";      
		$this->nombre_funcion = 'f_tpr_partida_presupuesto_iud';
		$this->codigo_procedimiento = "'PR_DETPRR_ASIG_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$codigo_formulario'");
		$this->var->add_param("'$fecha_elaboracion'");
		$this->var->add_param($id_partida);
		$this->var->add_param($id_presupuesto);
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarDetalleParidaFormulacion
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpr_partida_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:12
	 */
	function ModificarDetallePartidaFormulacion($id_partida_presupuesto,$codigo_formulario,$fecha_elaboracion,$id_partida,$id_presupuesto,$id_partida_detalle,$mes_01,$mes_02,$mes_03,$mes_04,$mes_05,$mes_06,$mes_07,$mes_08,$mes_09,$mes_10,$mes_11,$mes_12,$total,$id_partida_presupuesto,$id_moneda)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_partida_presupuesto_iud';
		$this->codigo_procedimiento = "'PR_DEPRGA_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_partida_presupuesto);
		$this->var->add_param("'$codigo_formulario'");
		$this->var->add_param("'$fecha_elaboracion'");
		$this->var->add_param($id_partida);
		$this->var->add_param($id_presupuesto);
		$this->var->add_param($id_partida_detalle);
		$this->var->add_param($mes_01);
		$this->var->add_param($mes_02);
		$this->var->add_param($mes_03);
		$this->var->add_param($mes_04);
		$this->var->add_param($mes_05);
		$this->var->add_param($mes_06);
		$this->var->add_param($mes_07);
		$this->var->add_param($mes_08);
		$this->var->add_param($mes_09);
		$this->var->add_param($mes_10);
		$this->var->add_param($mes_11);
		$this->var->add_param($mes_12);
		$this->var->add_param($total);
		$this->var->add_param($id_partida_presupuesto);
		$this->var->add_param($id_moneda);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarDetalleParidaFormulacion
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_partida_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:12
	 */
	function EliminarDetallePartidaFormulacion($id_partida_presupuesto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_partida_presupuesto_iud';
		$this->codigo_procedimiento = "'PR_DEPRGA_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_partida_presupuesto);
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
	function EliminarDetallePartidaAsignacion($id_partida,$id_presupuesto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_partida_presupuesto_iud';
		$this->codigo_procedimiento = "'PR_DETPRR_ASIG_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($id_partida);
		$this->var->add_param($id_presupuesto);

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	
	/**
	 * Nombre de la funci�n:	ValidarDetalleParidaFormulacion
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpr_partida_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:12
	 */
	function ValidarDetallePartidaFormulacion($operacion_sql,$id_partida_presupuesto,$codigo_formulario,$fecha_elaboracion,$id_partida,$id_presupuesto,$id_partida_detalle,$mes_01,$mes_02,$mes_03,$mes_04,$mes_05,$mes_06,$mes_07,$mes_08,$mes_09,$mes_10,$mes_11,$mes_12,$total,$id_partida_presupuesto,$id_moneda)
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
				//Validar id_partida_presupuesto - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_partida_presupuesto");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_partida_presupuesto", $id_partida_presupuesto))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar codigo_formulario - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("codigo_formulario");
			$tipo_dato->set_MaxLength(25);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "codigo_formulario", $codigo_formulario))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fecha_elaboracion - tipo timestamp
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_elaboracion");
			$tipo_dato->set_MaxLength(100);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "fecha_elaboracion", $fecha_elaboracion))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_partida - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_partida");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_partida", $id_partida))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_presupuesto - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_presupuesto");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_presupuesto", $id_presupuesto))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_partida_detalle - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_partida_detalle");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_partida_detalle", $id_partida_detalle))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar mes_01 - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_01");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_01", $mes_01))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar mes_02 - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_02");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_02", $mes_02))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar mes_03 - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_03");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_03", $mes_03))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar mes_04 - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_04");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_04", $mes_04))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar mes_05 - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_05");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_05", $mes_05))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar mes_06 - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_06");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_06", $mes_06))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar mes_07 - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_07");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_07", $mes_07))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar mes_08 - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_08");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_08", $mes_08))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar mes_09 - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_09");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_09", $mes_09))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar mes_10 - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_10");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_10", $mes_10))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar mes_11 - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_11");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_11", $mes_11))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar mes_12 - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("mes_12");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "mes_12", $mes_12))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar total - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("total");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "total", $total))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_partida_presupuesto - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_partida_presupuesto");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_partida_presupuesto", $id_partida_presupuesto))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_moneda - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_moneda");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_moneda", $id_moneda))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_partida_presupuesto - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_partida_presupuesto");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_partida_presupuesto", $id_partida_presupuesto))
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
	
	
	/**
	 * Nombre de la funci�n:	ValidarDetalleParidaFormulacion
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpr_partida_presupuesto
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-10 08:45:12
	 */
	function ValidarDetallePartidaAsignacion($operacion_sql,$id_partida_presupuesto,$codigo_formulario,$fecha_elaboracion,$id_partida,$id_presupuesto)
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
				//Validar id_partida_presupuesto - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_partida_presupuesto");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_partida_presupuesto", $id_partida_presupuesto))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar codigo_formulario - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("codigo_formulario");
			$tipo_dato->set_MaxLength(25);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "codigo_formulario", $codigo_formulario))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar fecha_elaboracion - tipo timestamp
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_elaboracion");
			$tipo_dato->set_MaxLength(100);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "fecha_elaboracion", $fecha_elaboracion))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_partida - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_partida");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_partida", $id_partida))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_presupuesto - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_presupuesto");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_presupuesto", $id_presupuesto))
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