<?php
/**
 * Nombre de la clase:	cls_DBSietCbtePartida.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tsi_siet_partida
 * Autor:				A.V.Q.
 * Fecha creaci�n:		2015-11-12
 */

 
class cls_DBSietCbtePartida
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
	 * Nombre de la funci�n:	ListarSietPartida
	 * Prop�sito:				Desplegar los registros de tsi_siet_partida
	 * Autor:				    a.v.q.
	 * Fecha de creaci�n:		2015-11-12
	 */
	function ListarSietCbtePartida($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_cbte_partida_sel';
		$this->codigo_procedimiento = "'PR_SIEPAR_SEL'";

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
		$this->var->add_def_cols('id_siet_cbte_partida','INTEGER');
		$this->var->add_def_cols('id_siet_cbte','bigint');
		$this->var->add_def_cols('id_partida','INTEGER');
		$this->var->add_def_cols('importe','numeric');
		$this->var->add_def_cols('codigo_partida','varchar');
		$this->var->add_def_cols('id_oec','INTEGER');
		$this->var->add_def_cols('codigo_oec','varchar');
		$this->var->add_def_cols('nombre_partida','varchar');
		$this->var->add_def_cols('nombre_oec','varchar');
		$this->var->add_def_cols('id_siet_ent_ua_transf','INTEGER');
		$this->var->add_def_cols('desc_entidad','varchar');
		$this->var->add_def_cols('desc_ua','varchar');
		
		
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
	 * Nombre de la funci�n:	ContarSietPartida
	 * Prop�sito:				Contar los registros de tsi_siet_partida
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function ContarSietCbtePartida($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_cbte_partida_sel';
		$this->codigo_procedimiento = "'PR_SIEPAR_COUNT'";

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
	 * Nombre de la funci�n:	InsertarSietPartida
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tsi_siet_partida
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function InsertarSietCbtePartida($id_siet_cbte_partida,$id_siet_cbte,$id_partida,$importe,$id_oec,$id_siet_ent_ua_transf)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_cbte_partida_iud';
		$this->codigo_procedimiento = "'PR_SIEPAR_INS'";
        
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_siet_cbte);
		$this->var->add_param($id_partida);
		$this->var->add_param($importe);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($id_oec);
		$this->var->add_param($id_siet_ent_ua_transf);
      //Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	/**
	 * Nombre de la funci�n:	InsertarSietCbtePartidaExcel
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tsi_siet_partida
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function InsertarSietCbtePartidaExcel($id_siet_cbte,$importe,$codigo_partida,$codigo_oec)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_cbte_partida_iud';
		$this->codigo_procedimiento = "'PR_SIEPAREXC_INS'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_siet_cbte);
		$this->var->add_param("NULL");
		$this->var->add_param($importe);
		$this->var->add_param("'$codigo_partida'");
		$this->var->add_param("'$codigo_oec'");
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
	 * Nombre de la funci�n:	ModificarSietPartida
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tsi_siet_partida
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function ModificarSietCbtePartida($id_siet_cbte_partida,$id_siet_cbte,$id_partida,$importe,$id_oec,$id_siet_ent_ua_transf)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_cbte_partida_iud';
		$this->codigo_procedimiento = "'PR_SIEPAR_UPD'";
		
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_siet_cbte_partida);
		$this->var->add_param($id_siet_cbte);
		$this->var->add_param($id_partida);
		$this->var->add_param($importe);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($id_oec);
		$this->var->add_param($id_siet_ent_ua_transf);
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
       /* echo $this->query;
        exit;*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarSietPartida
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tsi_siet_partida
	 * Autor:				    avq
	 * Fecha de creaci�n:		01/11/2015
	 */
	function EliminarSietCbtePartida($id_siet_cbte_partida)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_siet_cbte_partida_iud';
		$this->codigo_procedimiento = "'PR_SIEPAR_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_siet_cbte_partida);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL"); //descripcion
		$this->var->add_param("NULL");//CODIGO PARTIDA
		$this->var->add_param("NULL");//CODIGO oec
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
	 * Nombre de la funci�n:	ValidarSietPartida
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tsi_siet_partida
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function ValidarSietCbtePartida($operacion_sql,$id_siet_cbte_partida,$id_siet_cbte,$id_partida,$importe)
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
				$tipo_dato->set_Columna("id_siet_cbte_partida");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_siet_cbte_partida", $id_siet_cbte_partida))
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
			//Validar id_cobertura - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_siet_cbte_partida");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_siet_cbte_partida", $id_siet_cbte_partida))
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
