<?php
/**
 * Nombre de la clase:	cls_DBBancarizacion.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tct_bancarizacion
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-10-15 17:39:51
 */

 
class cls_DBBancarizacion
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
	 * Nombre de la funci�n:	ListarBancarizacion
	 * Prop�sito:				Desplegar los registros de tct_bancarizacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-15 17:39:51
	 */
	function ListarBancarizacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_bancarizacion_sel';
		$this->codigo_procedimiento = "'CT_BANCARIZ_SEL'";

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
		$this->var->add_def_cols('id_bancarizacion','int4');
		$this->var->add_def_cols('id_usuario_reg','int4');
		$this->var->add_def_cols('login','varchar');
		$this->var->add_def_cols('fecha_ini','date');
		$this->var->add_def_cols('fecha_fin','date');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('fecha_reg','timestamp');
		$this->var->add_def_cols('estado','varchar');
		$this->var->add_def_cols('id_moneda','int4');
		$this->var->add_def_cols('nombre_moneda','varchar');
		$this->var->add_def_cols('id_deptos','varchar');
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		//echo $this->query ; exit();
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarBancarizacion
	 * Prop�sito:				Contar los registros de tct_bancarizacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-15 17:39:51
	 */
	function ContarBancarizacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_bancarizacion_sel';
		$this->codigo_procedimiento = "'CT_BANCARIZ_COUNT'";

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
	 * Nombre de la funci�n:	InsertarBancarizacion
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tct_bancarizacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-15 17:39:51
	 */
	function InsertarBancarizacion($id_bancarizacion,$fecha_ini,$fecha_fin,$observaciones,$estado,$id_moneda,$id_deptos)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_bancarizacion_iud';
		$this->codigo_procedimiento = "'CT_BANCARIZ_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$fecha_ini'");
		$this->var->add_param("'$fecha_fin'");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$estado'");
		$this->var->add_param($id_moneda);
		$this->var->add_param("'$id_deptos'");
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarBancarizacion
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tct_bancarizacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-15 17:39:51
	 */
	function ModificarBancarizacion($id_bancarizacion,$fecha_ini,$fecha_fin,$observaciones,$estado,$id_moneda,$id_deptos)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_bancarizacion_iud';
		$this->codigo_procedimiento = "'CT_BANCARIZ_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_bancarizacion);
		$this->var->add_param("'$fecha_ini'");
		$this->var->add_param("'$fecha_fin'");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$estado'");
		$this->var->add_param($id_moneda);
		$this->var->add_param("'$id_deptos'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarBancarizacion
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tct_bancarizacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-15 17:39:51
	 */
	function EliminarBancarizacion($id_bancarizacion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_bancarizacion_iud';
		$this->codigo_procedimiento = "'CT_BANCARIZ_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_bancarizacion);
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
	 * Nombre de la funci�n:	GeneraDetalleBancarizacion
	 * Prop�sito:				Permite ejecutar la funci�n para generar el detalle de la bancarizacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-15 17:39:51
	 */
	function GeneraDetalleBancarizacion($id_bancarizacion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_bancarizacion_iud';
		$this->codigo_procedimiento = "'CT_GENDET_BANC'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_bancarizacion);
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
	 * Nombre de la funci�n:	ValidarBancarizacion
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tct_bancarizacion
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-10-15 17:39:51
	 */
	function ValidarBancarizacion($operacion_sql,$id_bancarizacion,$fecha_ini,$fecha_fin,$observaciones,$estado)
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
				//Validar id_parametro - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_bancarizacion");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_bancarizacion", $id_bancarizacion))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar id_gestion - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_ini");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_ini", $fecha_ini))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validar id_gestion - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_fin");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_fin", $fecha_fin))
			{
				$this->salida = $valid->salida;
				return false;
			}		
		
			//Validar id_gestion - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("observaciones");
			$tipo_dato->set_MaxLength(1000);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "observaciones", $observaciones))
			{
				$this->salida = $valid->salida;
				return false;
			}	
			
			//Validar id_gestion - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado");
			$tipo_dato->set_MaxLength(100);
			$tipo_dato->set_AllowBlank("true");
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado", $estado))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_parametro - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_bancarizacion");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_bancarizacion", $id_bancarizacion))
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