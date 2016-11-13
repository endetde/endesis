<?php
/**
 * Nombre de la clase:	cls_DBSietDeclara.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tsi_siet_declara
 * Autor:				A.V.Q.
 * Fecha creaci�n:		2015-11-12
 */

 
class cls_DBSietDeclara
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
	 * Nombre de la funci�n:	ListarSietDeclara
	 * Prop�sito:				Desplegar los registros de tsi_siet_declara
	 * Autor:				    a.v.q.
	 * Fecha de creaci�n:		2015-11-12
	 */
	function ListarSietDeclara($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_sel';
		$this->codigo_procedimiento = "'PR_SIEDEC_SEL'";

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
		$this->var->add_param('NULL');//id_siet_declara
		//Carga la definici�n de columnas con sus tipos de datos
		
		$this->var->add_def_cols('id_siet_declara','INTEGER');
		$this->var->add_def_cols('id_gestion','INTEGER');
		$this->var->add_def_cols('gestion','NUMERIC');
		$this->var->add_def_cols('id_periodo','INTEGER');
		$this->var->add_def_cols('periodo','NUMERIC(2,0)');
		$this->var->add_def_cols('id_usuario','INTEGER');
		$this->var->add_def_cols('nombre_completo','TEXT');
		$this->var->add_def_cols('estado','VARCHAR(100)');
		$this->var->add_def_cols('fecha_declara','DATE');
		$this->var->add_def_cols('periodo_lite','varchar');
		$this->var->add_def_cols('id_parametro','integer');
		$this->var->add_def_cols('tipo_declara','varchar');
	/*	$this->var->add_def_cols('id_siet_cbte','integer');
		$this->var->add_def_cols('tipo_siet_declara','varchar');*/
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		exit;*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarInterfazSiet
	 * Prop�sito:				Contar los registros de tpr_cobertura
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 09:53:09
	 */
	function ContarSietDeclara($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_sel';
		$this->codigo_procedimiento = "'PR_SIEDEC_COUNT'";

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
		$this->var->add_param('NULL');//id_siet_declara
		
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
	 * Nombre de la funci�n:	InsertarSietDeclara
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tsi_siet_declara
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function InsertarSietDeclara($id_siet_declara,$id_gestion,$id_periodo,$tipo_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_iud';
		$this->codigo_procedimiento = "'PR_SIEDEC_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_gestion);
		$this->var->add_param($id_periodo);
		$this->var->add_param("'$tipo_declara'");
      //Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
        /*echo $this->query;
         exit;*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarSietDeclara
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tsi_siet_declara
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function ModificarSietDeclara($id_siet_declara,$id_gestion,$id_periodo,$tipo_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_iud';
		$this->codigo_procedimiento = "'PR_SIEDEC_UPD'";
		
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_siet_declara);
		$this->var->add_param($id_gestion);
		$this->var->add_param($id_periodo);
		$this->var->add_param("'$tipo_declara'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	/**
	 * Nombre de la funci�n:	ModificarSietDeclara
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tsi_siet_declara
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function ModificarSietDeclaraFinalizar($id_siet_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_iud';
		$this->codigo_procedimiento = "'PR_SIDEFIN_UPD'";
		
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_siet_declara);
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
	 * Nombre de la funci�n:	ModificarSietDeclara
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tsi_siet_declara
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function ModificarSietDeclaraGenNros($id_siet_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_iud';
		$this->codigo_procedimiento = "'PR_SIDEGENROS_UPD'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_siet_declara);
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
	 * Nombre de la funci�n:	EliminarSietDeclara
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tsi_siet_declara
	 * Autor:				    avq
	 * Fecha de creaci�n:		01/11/2015
	 */
	function EliminarSietDeclara($id_siet_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_iud';
		$this->codigo_procedimiento = "'PR_SIEDEC_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_siet_declara);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param('NULL');
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	/**
	 * Nombre de la funci�n:	InsertarSietCBte
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n a la tabla tsi_siet_cbte
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function InsertarSietCbtesPartidas($id_siet_declara,$id_gestion,$id_periodo,$tipo_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_iud';
		$this->codigo_procedimiento = "'PR_INSCPSIET_UPD'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_siet_declara);
		$this->var->add_param($id_gestion);
		$this->var->add_param($id_periodo);
		$this->var->add_param("'$tipo_declara'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		 exit;*/
		return $res;
	}
	

	
	/**
	 * Nombre de la funci�n:	InsertarSietCBteRecursos
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n a la tabla tsi_siet_cbte para recursos
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function InsertarSietCbtesPartidasRecurso($id_siet_declara,$id_gestion,$id_periodo,$tipo_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_iud';
		$this->codigo_procedimiento = "'PR_INSCCSIETREC_UPD'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_siet_declara);
		$this->var->add_param($id_gestion);
		$this->var->add_param($id_periodo);
		$this->var->add_param('NULL');
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		 exit;*/
		return $res;
	}
	/**
	 * Nombre de la funci�n:	ValidarSietDeclara
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tsi_siet_declara
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function ValidarSietDeclara($operacion_sql,$id_siet_declara,$id_gestion,$id_periodo)
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
				//Validar id_cobertura - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_siet_declara");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_siet_declara", $id_siet_declara))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar porcentaje - tipo numeric
		/*	$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("sw_hotel");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "sw_hotel", $sw_hotel))
			{
				$this->salida = $valid->salida;
				return false;
			}	
			//Validar porcentaje - tipo numeric
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("porcentaje");
			$tipo_dato->set_MaxLength(1179650);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "porcentaje", $porcentaje))
			{
				$this->salida = $valid->salida;
				return false;
			}*/
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_cobertura - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_siet_declara");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_siet_declara", $id_siet_declara))
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
	 * Nombre de la funci�n:	ListarSietDeclaraRep
	 * Prop�sito:				Desplegar los registros de tsi_siet_declara
	 * Autor:				    a.v.q.
	 * Fecha de creaci�n:		2015-11-12
	 */
	function ListarSietDeclaraRepTxt($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_siet_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_sel';
		$this->codigo_procedimiento = "'PR_SIECBTEPAR_SEL'";
	
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
		$this->var->add_param($id_siet_declara);//id_siet_declara
		
		//Carga la definici�n de columnas con sus tipos de datos

		
		
		$this->var->add_def_cols('id_siet_declara','INTEGER');
		$this->var->add_def_cols('entidad','TEXT');
		$this->var->add_def_cols('gestion','integer');
		$this->var->add_def_cols('periodo_lite','numeric');
		$this->var->add_def_cols('tipo_declara','varchar');
		$this->var->add_def_cols('nro_cbte','INTEGER');
		$this->var->add_def_cols('fecha_declara','date');
		$this->var->add_def_cols('partida','varchar');
		$this->var->add_def_cols('oec','varchar');
		$this->var->add_def_cols('glosa','varchar');
		$this->var->add_def_cols('auxiliar','varchar');
		$this->var->add_def_cols('cuenta_bancaria','varchar');
		
		$this->var->add_def_cols('cheque','integer');
		$this->var->add_def_cols('importe','numeric');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//echo $this->query;
		return $res;
	}
	/**
	 * Nombre de la funci�n:	RepExcelCbtesSinPartidas
	 * Prop�sito:				Reporte en excel
	 * Autor:				    a.v.q.
	 * Fecha de creaci�n:		2015-11-12
	 */
	function RepExcelCbtesSinPartidas($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_siet_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_rep';
		$this->codigo_procedimiento = "'PR_CBTESINPAR_REP'";
	
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
		$this->var->add_param("$id_siet_declara");//id_siet_declara
		$this->var->add_param("'%'");//id_siet_declara
		//Carga la definici�n de columnas con sus tipos de datos
	
		$this->var->add_def_cols('id_siet_cbte','integer');
		$this->var->add_def_cols('id_cbte','INTEGER');
		$this->var->add_def_cols('nro_cbte','varchar');
		$this->var->add_def_cols('concepto_cbte','VARCHAR(1500)');
		$this->var->add_def_cols('glosa_cbte','VARCHAR(1500)');
		$this->var->add_def_cols('acreedor','VARCHAR');
		$this->var->add_def_cols('desc_clase','VARCHAR(100)');
		$this->var->add_def_cols('desc_subsistema','VARCHAR(2)');
		$this->var->add_def_cols('importe','NUMERIC(18,2)');
		$this->var->add_def_cols('nro_cuenta_banco','varchar');
		$this->var->add_def_cols('nro_cheque','varchar');
				
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
			exit;*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	RepExcelPartidasSinOec
	 * Prop�sito:				Reporte en excel
	 * Autor:				    a.v.q.
	 * Fecha de creaci�n:		2015-11-12
	 */
	function RepExcelPartidasSinOec($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_siet_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_rep';
		$this->codigo_procedimiento = "'PR_CBTESINOEC_REP'";
	
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
		$this->var->add_param("$id_siet_declara");//id_siet_declara
		$this->var->add_param("'%'");//id_siet_declara
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('tipo','text');
		$this->var->add_def_cols('id_siet_cbte_partida','integer');
		$this->var->add_def_cols('codigo_partida','varchar');
		$this->var->add_def_cols('id_cbte','INTEGER');
		$this->var->add_def_cols('nro_cbte','varchar');
		$this->var->add_def_cols('concepto_cbte','varchar');
		$this->var->add_def_cols('desc_subsistema','VARCHAR');
		$this->var->add_def_cols('importe_partida','NUMERIC(18,2)');
		$this->var->add_def_cols('importe_cbte','NUMERIC(18,2)');
		$this->var->add_def_cols('nro_cuenta_banco','varchar');
		$this->var->add_def_cols('nro_cheque','varchar');
		$this->var->add_def_cols('id_siet_cbte','integer');
		
	
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		 exit;*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	Generar Partidas
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n a la tabla presto.tpr_siet_cbte_partida
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function GenerarSietPartidas($id_siet_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_iud';
		$this->codigo_procedimiento = "'PR_GENPARTI_INS'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_siet_declara);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("'NULL'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		 exit;*/
		return $res;
	}
	/**
	 * Nombre de la funci�n:	Generar OEC's
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n a la tabla presto.tpr_siet_cbte_partida
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function GenerarSietOecs($id_siet_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_iud';
		$this->codigo_procedimiento = "'PR_GENOEC_INS'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_siet_declara);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("'NULL'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		 exit;*/
		return $res;
	}
	/**
	 * Nombre de la funci�n:	RepExcelSeguimientoFA
	 * Prop�sito:				Reporte en excel
	 * Autor:				    a.v.q.
	 * Fecha de creaci�n:		2015-11-12
	 */
	function RepExcelSeguimientoFA($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_siet_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_rep';
		$this->codigo_procedimiento = "'PR_SEGFA_REP'";
	
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
		$this->var->add_param("$id_siet_declara");//id_siet_declara
		$this->var->add_param("'%'");//id_siet_declara
		//Carga la definici�n de columnas con sus tipos de datos
		
		$this->var->add_def_cols('periodo_sol','varchar');
		$this->var->add_def_cols('periodo_dev','varchar');
		$this->var->add_def_cols('nro_cuenta_banco','varchar');
		$this->var->add_def_cols('nro_cheque','varchar');
		$this->var->add_def_cols('nro_fa','varchar');
		$this->var->add_def_cols('id_cbte_sol','integer');
		$this->var->add_def_cols('nro_cbte_sol','varchar');
		$this->var->add_def_cols('importe_sol','numeric');
		$this->var->add_def_cols('fecha_cbte_sol','date');
		$this->var->add_def_cols('estado_rendicion','varchar');
		$this->var->add_def_cols('id_cbte_dev','integer');
		$this->var->add_def_cols('nro_cbte_dev','varchar');
		$this->var->add_def_cols('importe_dev','numeric');
		$this->var->add_def_cols('fecha_cbte_dev','date');
		$this->var->add_def_cols('id_cuenta_doc','integer');
		$this->var->add_def_cols('importe_rendicion','numeric');
		$this->var->add_def_cols('saldo','numeric');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		 exit;*/
		return $res;
	}
	/**
	 * Nombre de la funci�n:	RepExcelReportesSietGastos
	 * Prop�sito:				Reporte en excel
	 * Autor:				    a.v.q.
	 * Fecha de creaci�n:		2015-11-12
	 */
	function RepExcelReportesSietGastos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_siet_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_rep';
		$this->codigo_procedimiento = "'PR_EXSIGAS_REP'";
	
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
		$this->var->add_param("$id_siet_declara");//id_siet_declara
		$this->var->add_param("'%'");//id_siet_declara
		//Carga la definici�n de columnas con sus tipos de datos
	
		$this->var->add_def_cols('gestion','varchar');
		$this->var->add_def_cols('mes','varchar');
		$this->var->add_def_cols('entidad','varchar');
		$this->var->add_def_cols('da_ua','varchar');
		$this->var->add_def_cols('numero_documento','integer');
		$this->var->add_def_cols('fecha','date');
		$this->var->add_def_cols('cuenta','varchar');
		$this->var->add_def_cols('libreta','varchar');
		$this->var->add_def_cols('importe','numeric');
		$this->var->add_def_cols('glosa','varchar');
		$this->var->add_def_cols('cheque','varchar');
		$this->var->add_def_cols('documento','varchar');
		$this->var->add_def_cols('tipo','varchar');
		$this->var->add_def_cols('nro_fa','varchar');
			//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		 exit;*/
		return $res;
	}
	/**
	 * Nombre de la funci�n:	RepExcelReportesSietGastosDetalle
	 * Prop�sito:				Reporte en excel
	 * Autor:				    a.v.q.
	 * Fecha de creaci�n:		2015-11-12
	 */
	function RepExcelReportesSietGastosDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_siet_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_rep';
		$this->codigo_procedimiento = "'PR_EXSIGASDET_REP'";
	
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
		$this->var->add_param("$id_siet_declara");//id_siet_declara
		$this->var->add_param("'%'");//id_siet_declara
		//Carga la definici�n de columnas con sus tipos de datos
	
		$this->var->add_def_cols('gestion','varchar');
		$this->var->add_def_cols('mes','varchar');
		$this->var->add_def_cols('entidad','varchar');
		$this->var->add_def_cols('da_ua','varchar');
		$this->var->add_def_cols('numero_documento','integer');
		$this->var->add_def_cols('secuencial','integer');
		$this->var->add_def_cols('sisin','varchar');
		$this->var->add_def_cols('apertura_progr','varchar');
		$this->var->add_def_cols('fuente','varchar');
		$this->var->add_def_cols('organismo','varchar');
		$this->var->add_def_cols('partida','varchar');
		$this->var->add_def_cols('entidad_transf','varchar');
		$this->var->add_def_cols('da_ua_transf','varchar');
		$this->var->add_def_cols('oec','varchar');
		
		$this->var->add_def_cols('importe','numeric');
		$this->var->add_def_cols('nro_cbte','varchar');
		$this->var->add_def_cols('glosa','varchar');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		 exit;*/
		return $res;
	}
	/**
	 * Nombre de la funci�n:	RepExcelReportesSietRecursos
	 * Prop�sito:				Reporte en excel
	 * Autor:				    a.v.q.
	 * Fecha de creaci�n:		2015-11-12
	 */
	function RepExcelReportesSietRecursos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_siet_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_rep';
		$this->codigo_procedimiento = "'PR_EXSIREC_REP'";
	
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
		$this->var->add_param("$id_siet_declara");//id_siet_declara
		$this->var->add_param("'%'");//id_siet_declara
		//Carga la definici�n de columnas con sus tipos de datos
	
		$this->var->add_def_cols('gestion','varchar');
		$this->var->add_def_cols('mes','varchar');
		$this->var->add_def_cols('entidad','varchar');
		$this->var->add_def_cols('da_ua','varchar');
		$this->var->add_def_cols('numero_documento','integer');
		$this->var->add_def_cols('fecha','date');
		$this->var->add_def_cols('cuenta','varchar');
		$this->var->add_def_cols('libreta','varchar');
		$this->var->add_def_cols('importe','numeric');
		$this->var->add_def_cols('glosa','varchar');
		$this->var->add_def_cols('cheque','varchar');
		$this->var->add_def_cols('documento','varchar');
		$this->var->add_def_cols('tipo','varchar');
		$this->var->add_def_cols('nro_fa','varchar');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		 exit;*/
		return $res;
	}
	/**
	 * Nombre de la funci�n:	RepExcelReportesSietRecursosDetalle
	 * Prop�sito:				Reporte en excel
	 * Autor:				    a.v.q.
	 * Fecha de creaci�n:		2015-11-12
	 */
	function RepExcelReportesSietRecursosDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_siet_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_rep';
		$this->codigo_procedimiento = "'PR_EXSIRECDET_REP'";
	
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
		$this->var->add_param("$id_siet_declara");//id_siet_declara
		$this->var->add_param("'%'");//id_siet_declara
		//Carga la definici�n de columnas con sus tipos de datos
	
		$this->var->add_def_cols('gestion','varchar');
		$this->var->add_def_cols('mes','varchar');
		$this->var->add_def_cols('entidad','varchar');
		$this->var->add_def_cols('da_ua','varchar');
		$this->var->add_def_cols('numero_documento','integer');
		$this->var->add_def_cols('secuencial','integer');
		$this->var->add_def_cols('fuente','varchar');
		$this->var->add_def_cols('organismo','varchar');
		$this->var->add_def_cols('rubro','varchar');
		$this->var->add_def_cols('entidad_transf','varchar');
		$this->var->add_def_cols('da_ua_transf','varchar');
		$this->var->add_def_cols('oec','varchar');
		$this->var->add_def_cols('importe','numeric');
		$this->var->add_def_cols('documento','varchar');
		$this->var->add_def_cols('glosa','varchar');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		 exit;*/
		return $res;
	}
	/**
	 * Nombre de la funci�n:	RepExcelReportesSietRecursosDetalle
	 * Prop�sito:				Reporte en excel
	 * Autor:				    a.v.q.
	 * Fecha de creaci�n:		2015-11-12
	 */
	function RepExcelReportesSietTraspasos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_siet_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_rep';
		$this->codigo_procedimiento = "'PR_EXSITRASP_REP'";
	
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
		$this->var->add_param("$id_siet_declara");//id_siet_declara
		$this->var->add_param("'%'");//id_siet_declara
		//Carga la definici�n de columnas con sus tipos de datos
	
		$this->var->add_def_cols('gestion','varchar');
		$this->var->add_def_cols('mes','varchar');
		$this->var->add_def_cols('entidad','varchar');
		$this->var->add_def_cols('da_ua','varchar');
		$this->var->add_def_cols('numero_documento','integer');
		$this->var->add_def_cols('fecha_salida_cb','date');
		$this->var->add_def_cols('cuenta_origen','varchar');
		$this->var->add_def_cols('libreta_origen','varchar');
		$this->var->add_def_cols('entidad_destino','varchar');
		$this->var->add_def_cols('da_ua_destino','varchar');
		$this->var->add_def_cols('cuenta_destino','varchar');
		$this->var->add_def_cols('libreta_destino','varchar');
		$this->var->add_def_cols('importe','numeric');
		$this->var->add_def_cols('glosa','varchar');
		$this->var->add_def_cols('cheque','varchar');
		$this->var->add_def_cols('documento','varchar');
		$this->var->add_def_cols('nro_fa','varchar');
		$this->var->add_def_cols('nro_fa1','varchar');
		$this->var->add_def_cols('id_cuenta_bancaria_origen','integer');
		$this->var->add_def_cols('id_cuenta_bancaria_destino','integer');
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		 exit;*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	RepExcelFondosAvanceAnual
	 * Prop�sito:				Reporte en excel
	 * Autor:				    a.v.q.
	 * Fecha de creaci�n:		2015-11-12
	 */
	function RepExcelFondosAvanceAnual($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_siet_declara,$id_siet_cbte)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_rep';
		$this->codigo_procedimiento = "'PR_REPFAGEN_REP'";
	
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
		$this->var->add_param("$id_siet_declara");//id_siet_declara
		$this->var->add_param("'$id_siet_cbte'");//id_siet_declara
		//Carga la definici�n de columnas con sus tipos de datos
		
		$this->var->add_def_cols('id_cuenta_doc','INTEGER');
		$this->var->add_def_cols('nro_documento','VARCHAR');
		$this->var->add_def_cols('nro_cbte_sol','VARCHAR');
		$this->var->add_def_cols('id_cbte_sol','VARCHAR');
		$this->var->add_def_cols('importe_sol','NUMERIC');
		$this->var->add_def_cols('periodo_sol','VARCHAR');
		$this->var->add_def_cols('sw_fa_sol','varchar');
		$this->var->add_def_cols('nro_cbte_rend','VARCHAR');
		$this->var->add_def_cols('id_cbte_rend','VARCHAR');
		$this->var->add_def_cols('fecha_cbte_rend','date');
		$this->var->add_def_cols('importe_rend','NUMERIC');
		$this->var->add_def_cols('periodo_rend','VARCHAR');
		$this->var->add_def_cols('sw_fa_rend','varchar');
		$this->var->add_def_cols('nro_cbte_dev','VARCHAR');
		$this->var->add_def_cols('id_cbte_dev','VARCHAR');
		$this->var->add_def_cols('importe_dev','NUMERIC');
		$this->var->add_def_cols('periodo_dev','VARCHAR');
		$this->var->add_def_cols('sw_fa_dev','varchar');
		$this->var->add_def_cols('estado_fa','varchar');
		$this->var->add_def_cols('saldo','numeric');
				
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;  
		exit;  */
		return $res;
	}
	/**
	 * Nombre de la funci�n:	ModificarSietDeclara
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tsi_siet_declara
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function ModificarSietDuplicados($id_siet_declara)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_declara_iud';
		$this->codigo_procedimiento = "'PR_SICBTEDUP_UPD'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_siet_declara);
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
}?>
