<?php
/**
 * Nombre de la clase:	cls_DBConceptoIngas.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpr_tpr_concepto_ingas
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-07-07 15:19:33
 */

 
class cls_DBConceptoIngas
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
	 * Nombre de la funci�n:	ListarConceptoIngas
	 * Prop�sito:				Desplegar los registros de tpr_concepto_ingas
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-07 15:19:33
	 */
	function ListarConceptoIngas($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_concepto_ingas_sel';
		$this->codigo_procedimiento = "'PR_CONING_SEL'";

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
		$this->var->add_def_cols('id_concepto_ingas','int4');
		$this->var->add_def_cols('desc_ingas','varchar');
		$this->var->add_def_cols('id_partida','int4');
		$this->var->add_def_cols('desc_partida','text');
        $this->var->add_def_cols('id_item','int4');
		$this->var->add_def_cols('desc_item','varchar');
		$this->var->add_def_cols('id_servicio','int4');
		$this->var->add_def_cols('desc_servicio','varchar');
		$this->var->add_def_cols('desc_ingas_item_serv','text');
 		$this->var->add_def_cols('sw_tesoro','numeric');
 		$this->var->add_def_cols('id_oec','integer');
 		$this->var->add_def_cols('desc_oec','text');
 		
 		 		
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
	
	function ListarConceptoPartidaCuentaAux($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_concepto_ingas_sel';
		$this->codigo_procedimiento = "'PR_COPACUAU_SEL'";

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
		$this->var->add_def_cols('id_concepto_ingas','int4');
		$this->var->add_def_cols('desc_ingas','varchar');
		$this->var->add_def_cols('id_partida','int4');
		$this->var->add_def_cols('desc_partida','text');       
		$this->var->add_def_cols('desc_ingas_item_serv','text');
 		$this->var->add_def_cols('sw_tesoro','numeric'); 		
 		$this->var->add_def_cols('desc_cuenta','text');
 		$this->var->add_def_cols('desc_auxiliar','text');
 		$this->var->add_def_cols('id_presupuesto','int4');
 		$this->var->add_def_cols('id_unidad_organizacional','int4');
 		
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
	 * Nombre de la funci�n:	ContarConceptoIngas
	 * Prop�sito:				Contar los registros de tpr_concepto_ingas
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-07 15:19:33
	 */
	function ContarConceptoIngas($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_concepto_ingas_sel';
		$this->codigo_procedimiento = "'PR_CONING_COUNT'";

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
		
		/*echo $this->query;
		exit();*/

		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarConceptoIngas
	 * Prop�sito:				Contar los registros de tpr_concepto_ingas
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-07 15:19:33
	 */
	function ContarConceptoPartidaCuentaAux($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_concepto_ingas_sel';
		$this->codigo_procedimiento = "'PR_COPACUAU_COUNT'";

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
		
		/*echo $this->query;
		exit();*/

		//Retorna el resultado de la ejecuci�n
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	InsertarConceptoIngas
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_concepto_ingas
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-07 15:19:33
	 */
	function InsertarConceptoIngas($id_concepto_ingas,$desc_ingas,$id_partida,$id_item,$id_servicio,$sw_tesoro,$id_oec)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_concepto_ingas_iud';
		$this->codigo_procedimiento = "'PR_CONING_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$desc_ingas'");
		$this->var->add_param($id_partida);
        $this->var->add_param($id_item);
        $this->var->add_param($id_servicio);
        $this->var->add_param("'$sw_tesoro'");
         $this->var->add_param($id_oec);
		//Ejecuta la funci�n
		//echo "que cagada lleg a aqui"; exit();
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
      /*  echo $this->query;
        exit;*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarConceptoIngas
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tpr_concepto_ingas
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-07 15:19:33
	 */
	function ModificarConceptoIngas($id_concepto_ingas,$desc_ingas,$id_partida,$id_item,$id_servicio,$sw_tesoro,$id_oec)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_concepto_ingas_iud';
		$this->codigo_procedimiento = "'PR_CONING_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_concepto_ingas);
		$this->var->add_param("'$desc_ingas'");
		$this->var->add_param($id_partida);
        $this->var->add_param($id_item);
        $this->var->add_param($id_servicio);
      //   $this->var->add_param($id_cuenta);
        $this->var->add_param("'$sw_tesoro'");
        $this->var->add_param($id_oec);
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
    /*    echo $this->query;
		exit();*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarConceptoIngas
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tpr_concepto_ingas
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-07 15:19:33
	 */
	function EliminarConceptoIngas($id_concepto_ingas)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_concepto_ingas_iud';
		$this->codigo_procedimiento = "'PR_CONING_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_concepto_ingas);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
        $this->var->add_param("NULL");
		$this->var->add_param("NULL");
		//$this->var->add_param("NULL");//cuenta
		$this->var->add_param("NULL");//sw_tesoro
		$this->var->add_param("NULL");//sw_tesoro
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarConceptoIngas
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpr_concepto_ingas
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-07 15:19:33
	 */
	function ValidarConceptoIngas($operacion_sql,$id_concepto_ingas,$desc_ingas,$id_partida,$id_item,$id_servicio,$id_cuenta,$sw_tesoro,$id_oec)
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
				//Validar id_concepto_ingas - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_concepto_ingas");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_concepto_ingas", $id_concepto_ingas))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar desc_ingas - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("desc_ingas");
			$tipo_dato->set_MaxLength(150);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "desc_ingas", $desc_ingas))
			{
				$this->salida = $valid->salida;
				return false;
			}

			//Validar id_partida - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_partida");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(),"id_partida", $id_partida))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validar id_partida - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_oec");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(),"id_oec", $id_oec))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validar id_partida - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_item");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(),"id_item", $id_item))
			{
				$this->salida = $valid->salida;
				return false;
			}
			//Validar id_partida - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_servicio");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(),"id_servicio", $id_servicio))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_cuenta");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(),"id_cuenta", $id_cuenta))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("sw_tesoro");
			$tipo_dato->set_MaxLength(150);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "sw_tesoro", $sw_tesoro))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_concepto_ingas - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_concepto_ingas");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_concepto_ingas", $id_concepto_ingas))
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