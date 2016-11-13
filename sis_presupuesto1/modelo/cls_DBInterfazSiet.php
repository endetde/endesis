<?php
/**
 * Nombre de la clase:	cls_DBInterfazSiet.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpr_interfaz_siet
 * Autor:				A.V.Q.
 * Fecha creaci�n:		2015-11-12
 */

 
class cls_DBInterfazSiet
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
	 * Nombre de la funci�n:	ListarInterfazSiet
	 * Prop�sito:				Desplegar los registros de tpr_InterfazSiet
	 * Autor:				    a.v.q.
	 * Fecha de creaci�n:		2015-11-12
	 */
	function ListarInterfazSiet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_interfazsiet_sel';
		$this->codigo_procedimiento = "'PR_INTERFAZSIET_SEL'";

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
		$this->var->add_def_cols('id_comprobante','INTEGER');
		$this->var->add_def_cols('concepto_cbte','VARCHAR(1500)');
		$this->var->add_def_cols('id_cuenta','INTEGER');
		$this->var->add_def_cols('nombre_cuenta','VARCHAR(100)');
		$this->var->add_def_cols('id_auxiliar','INTEGER');
		$this->var->add_def_cols('codigo_auxiliar','VARCHAR(15)');
		$this->var->add_def_cols('nombre_auxiliar','VARCHAR(100)');
		$this->var->add_def_cols('importe_com_eje','NUMERIC(18,2)');
		$this->var->add_def_cols('id_partida_presupuesto','INTEGER');
		$this->var->add_def_cols('id_partida','INTEGER');
		$this->var->add_def_cols('codigo_partida','VARCHAR(18)');
		$this->var->add_def_cols('nombre_partida','VARCHAR(150)');
		$this->var->add_def_cols('sigla_oec','VARCHAR(4)');
		$this->var->add_def_cols('nro_cheque','INTEGER');
		$this->var->add_def_cols('id_cuenta_bancaria','INTEGER');
		$this->var->add_def_cols('fecha_cobro','DATE');
		$this->var->add_def_cols('nro_cuenta_banco','VARCHAR(30)');
	
		
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
	 * Nombre de la funci�n:	ContarInterfazSiet
	 * Prop�sito:				Contar los registros de tpr_cobertura
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 09:53:09
	 */
	function ContarInterfazSiet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_interfaz_siet_sel';
		$this->codigo_procedimiento = "'PR_INTERFAZSIET_COUNT'";

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
	 * Nombre de la funci�n:	InsertarInterfazSiet
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_cobertura
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 09:53:09
	 */
/*	function InsertarInterfazSiet($id_cobertura,$porcentaje,$sw_hotel,$descripcion,$via)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_cobertura_iud';
		$this->codigo_procedimiento = "'PR_COBERT_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($porcentaje);
		$this->var->add_param($sw_hotel);
		$this->var->add_param("'$descripcion'");
         $this->var->add_param("'$via'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}*/
	
	/**
	 * Nombre de la funci�n:	ModificarInterfazSiet
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpr_cobertura
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 09:53:09
	 */
	function ModificarInterfazSiet($id_interfaz_siet,$id_partida,$id_oec)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_cobertura_iud';
		$this->codigo_procedimiento = "'PR_COBERT_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_interfaz_siet);
		$this->var->add_param($id_partida);
		$this->var->add_param($id_oec);
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarInterfazSiet
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_cobertura
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 09:53:09
	 */
	/*function EliminarInterfazSiet($id_cobertura)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_cobertura_iud';
		$this->codigo_procedimiento = "'PR_COBERT_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_cobertura);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL"); //descripcion
		$this->var->add_param("NULL");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	*/
	/**
	 * Nombre de la funci�n:	ValidarInterfazSiet
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpr_cobertura
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 09:53:09
	 */
	/*function ValidarInterfazSiet($operacion_sql,$id_cobertura,$porcentaje,$sw_hotel)
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
				$tipo_dato->set_Columna("id_cobertura");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cobertura", $id_cobertura))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar porcentaje - tipo numeric
			$tipo_dato->_reiniciar_valor();
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
			}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_cobertura - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_cobertura");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cobertura", $id_cobertura))
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
	}*/
}?>