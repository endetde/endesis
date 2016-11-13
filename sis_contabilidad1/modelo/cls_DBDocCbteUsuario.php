<?php
/**
 * Nombre de la Clase:	cls_DBDocCbteUsuario
 * Prop�sito:			Permite realizar la funcionalidad de la tabla sci.tct_doc_cbte_usuario *  
 *
 * Autor:				Williams Escobar
 * Fecha creaci�n:		15-03-2011
 *
 */
class cls_DBDocCbteUsuario
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
	//**************funcion que lleva a cabo la importacion a la tabla temporal ***************/
	
	//************** funcion que lleva a cabo el listado de los datos en la tabla sci.tct_doc_cbte_usuario*****************/
	function ListarDocCbteUsuario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{ 
		$this->salida = ""; 
		$this->nombre_funcion = 'f_tct_doc_cbte_usuario_sel';
		$this->codigo_procedimiento = "'CT_DOCCBTEUSER_SEL'";
		
		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";

		//Carga la definici�n de columnas con sus tipos de datos
		
		
		$this->var->add_def_cols('documento','varchar');
		$this->var->add_def_cols('desc_persona','text');
		$this->var->add_def_cols('titulo_cbte','varchar');
		$this->var->add_def_cols('desc_clase','varchar');
		$this->var->add_def_cols('sw_validacion','varchar');
		$this->var->add_def_cols('sw_edicion','varchar');
		
		$this->var->add_def_cols('id_doc_cbte_usuario','integer');
		$this->var->add_def_cols('id_documento','integer');
		$this->var->add_def_cols('id_clase_cbte','integer');
		$this->var->add_def_cols('id_usuario','integer');
		$this->var->add_def_cols('id_periodo_subsistema','integer');
		
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}

	
	/**
	 * Nombre de la funci�n:	ContarColumna
	 * Prop�sito:				Contar los registros la tabla 
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2011-03-15 09:10:39
	 */
	function ContarDocCbteUsuario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_doc_cbte_usuario_sel';
		$this->codigo_procedimiento = "'CT_DOCCBTEUSER_COUNT'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = $cant;
		$this->var->puntero = $puntero;
		$this->var->sortcol = "'$sortcol'";
		$this->var->sortdir = "'$sortdir'";
		$this->var->criterio_filtro = "'$criterio_filtro'";
		
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
	 * Nombre de la funci�n:	InsertarColumna
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla TCT_DOC_CBTE_USUARIO
	 * Autor:				    (WILLIAMS ESCOBAR)
	 * Fecha de creaci�n:		2011-03-15 09:13:39
	 */
	function InsertarDocCbteUsuario($id_documento,$id_clase_cbte,$id_usuario,$id_periodo_subsistema,$sw_validacion,$sw_edicion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_doc_cbte_usuario_iud';
		$this->codigo_procedimiento = "'CT_DOCCBTEUSER_INS'";
		
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param($id_documento);
		$this->var->add_param($id_clase_cbte);
		$this->var->add_param($id_usuario);
		$this->var->add_param($id_periodo_subsistema);			
		$this->var->add_param("'$sw_validacion'");	
		$this->var->add_param("'$sw_edicion'");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
        
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarColumna
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla TCT_DOC_CBTE_USUARIO
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2011-03-15 09:22:39
	 */
	function ModificarDocCbteUsuario($id_doc_cbte_user,$id_documento,$id_clase_cbte,$id_usuario,$id_periodo_subsistema,$sw_validacion,$sw_edicion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_doc_cbte_usuario_iud';
		$this->codigo_procedimiento = "'CT_DOCCBTEUSER_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_doc_cbte_user);
		$this->var->add_param($id_documento);
		$this->var->add_param($id_clase_cbte);
		$this->var->add_param($id_usuario);
		$this->var->add_param($id_periodo_subsistema);			
		$this->var->add_param("'$sw_validacion'");	
		$this->var->add_param("'$sw_edicion'");		
				
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}	
		
	/**
	 * Nombre de la funci�n:	EliminarDocCbteUsuario
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n delsci.tct_doc_cbte_usuario
	 * Autor:				    (Williams Escobar)
	 * Fecha de creaci�n:		2011-03-15 09:28:39
	 */
	function EliminarDocCbteUsuario($id_doc_cbte_user)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_doc_cbte_usuario_iud';
		$this->codigo_procedimiento = "'CT_DOCCBTEUSER_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_doc_cbte_user);
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
		//echo $this->query; exit();
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
        
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarColumna
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tkp_columna
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */ 
	function ValidarDocCbteUsuario($operacion_sql,$id_doc_cbte_user,$id_documento,$id_clase_cbte,$id_usuario,$id_periodo_subsistema,$sw_validacion,$sw_edicion)	
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
			//Validar id_columna - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_doc_cbte_user");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_doc_cbte_user", $id_doc_cbte_user))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar valor_defecto - tipo numeric
			$tipo_dato ->_reiniciar_valor();
			$tipo_dato->set_Columna("id_documento");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_documento", $id_documento))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_clase_cbte");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_clase_cbte", $id_clase_cbte))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			//vALIDAR USUARIO			
				
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("id_usuario");
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_AllowBlank(false);
				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_usuario", $id_usuario))
				{
					$this->salida = $valid->salida;
					return false;
				}	
			//VALIDAR	$id_periodo_subsistema
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("id_periodo_subsistema");
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_AllowBlank(false);
				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_periodo_subsistema", $id_periodo_subsistema))
				{
					$this->salida = $valid->salida;
					return false;
				}
				//VALIDAR $sw_validacion
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("sw_validacion");
				$tipo_dato->set_MaxLength(2);
				$tipo_dato->set_AllowBlank(false);
				if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "sw_validacion", $sw_validacion))
				{
					$this->salida = $valid->salida;
					return false;
				}				
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar id_columna - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_doc_cbte_user");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_doc_cbte_user", $id_doc_cbte_user))
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