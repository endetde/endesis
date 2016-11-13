<?php
/**
 * Nombre de la clase:	cls_DBSubTipoActivoCuenta.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tad_taid_sub_tipo_activo_cuenta
 * Autor:				AVQ
 * Fecha creaci�n:		08/07/2010
 */

 
class cls_DBSubTipoActivoCuenta
{
	var $salida;
	var $query;
	var $var;
	var $estado_reg_funcion;
	var $id_cuenta_procedimiento;
	var $decodificar;
	
	function __construct()
	{
		$this->decodificar=$decodificar;
	}
	
	/**
	 * Nombre de la funci�n:	ListarSubTipoActivoCuenta
	 * Prop�sito:				Desplegar los registros de taid_sub_tipo_activo_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-07 15:34:51
	 */
	function ListarSubTipoActivoCuenta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->estado_reg_funcion = 'f_taf_sub_tipo_activo_cuenta_sel';
		$this->id_cuenta_procedimiento = "'AF_SUTIAC_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->estado_reg_funcion,$this->id_cuenta_procedimiento);

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
		$this->var->add_def_cols('id_sub_tipo_activo_cuenta','integer');
		$this->var->add_def_cols('id_sub_tipo_activo','integer');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('id_usuario_reg','integer');
		$this->var->add_def_cols('desc_usuario','text');
		$this->var->add_def_cols('id_cuenta','integer');
		$this->var->add_def_cols('desc_cuenta','text');
		$this->var->add_def_cols('id_auxiliar','integer');
		$this->var->add_def_cols('desc_auxiliar','text');
        $this->var->add_def_cols('id_proceso','integer');
        $this->var->add_def_cols('desc_proceso','text');
        $this->var->add_def_cols('id_gestion','integer');
        $this->var->add_def_cols('gestion','numeric');
        $this->var->add_def_cols('id_presupuesto','integer');
        $this->var->add_def_cols('desc_estructura','text');
        $this->var->add_def_cols('id_unidad_organizacional','integer');
        $this->var->add_def_cols('desc_unidad_organizacional','varchar');
        
        $this->var->add_def_cols('id_cuenta2','integer');
        $this->var->add_def_cols('id_auxiliar2','integer');
        $this->var->add_def_cols('desc_cuenta2','text');
        $this->var->add_def_cols('desc_auxiliar2','text');
        
        $this->var->add_def_cols('id_fina_regi_prog_proy_acti','integer');
        $this->var->add_def_cols('desc_epe','text');
        $this->var->add_def_cols('id_tipo_activo','integer');
        $this->var->add_def_cols('desc_sub_tipo_activo','varchar');
        $this->var->add_def_cols('desc_tipo_activo','varchar');
        $this->var->add_def_cols('nivel','varchar');
		
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
	 * Nombre de la funci�n:	ContarSubTipoActivoCuenta
	 * Prop�sito:				Contar los registros de tad_sub_tipo_activo_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-07 15:34:51
	 */
	function ContarSubTipoActivoCuenta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->estado_reg_funcion = 'f_taf_sub_tipo_activo_cuenta_sel';
		$this->id_cuenta_procedimiento = "'AF_SUTIAC_COUNT'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->estado_reg_funcion,$this->id_cuenta_procedimiento);

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
	 * Nombre de la funci�n:	InsertarSubTipoActivoCuenta
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla taid_sub_tipo_activo_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-07 15:34:51
	 */
	function InsertarSubTipoActivoCuenta($id_sub_tipo_activo_cuenta,$id_sub_tipo_activo,$estado_reg,$fecha_reg,$id_usuario_reg,$id_cuenta,$id_auxiliar,$id_proceso,$id_gestion,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional,$id_presupuesto,$id_cuenta2,$id_auxiliar2,$id_tipo_activo,$nivel)
	{
		$this->salida = "";
		$this->estado_reg_funcion = 'f_taf_sub_tipo_activo_cuenta_iud';
		$this->id_cuenta_procedimiento = "'AF_SUTIAC_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->estado_reg_funcion,$this->id_cuenta_procedimiento,$this->decodificar);
		
		$this->var->add_param("NULL");
		$this->var->add_param("$id_sub_tipo_activo");
		$this->var->add_param("'$estado_reg'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param("$id_usuario_reg");
		$this->var->add_param("$id_cuenta");
        $this->var->add_param("$id_auxiliar");
        $this->var->add_param("$id_proceso");
        $this->var->add_param("$id_gestion");
        $this->var->add_param("null");
        $this->var->add_param("null");
        $this->var->add_param("$id_presupuesto");
        $this->var->add_param("$id_cuenta2");
        $this->var->add_param("$id_auxiliar2");
        
        $this->var->add_param("$id_tipo_activo");
        $this->var->add_param("'$nivel'");
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
       /* echo  $this->query;
        exit;*/
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarSubTipoActivoCuenta
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla taid_sub_tipo_activo_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-07 15:34:51
	 */
	function ModificarSubTipoActivoCuenta($id_sub_tipo_activo_cuenta,$id_sub_tipo_activo,$estado_reg,$fecha_reg,$id_usuario_reg,$id_cuenta,$id_auxiliar,$id_proceso,$id_gestion,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional,$id_presupuesto,$id_cuenta2,$id_auxiliar2,$id_tipo_activo,$nivel)
	{
		$this->salida = "";
		$this->estado_reg_funcion = 'f_taf_sub_tipo_activo_cuenta_iud';
		$this->id_cuenta_procedimiento = "'AF_SUTIAC_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->estado_reg_funcion,$this->id_cuenta_procedimiento,$this->decodificar);
		$this->var->add_param("$id_sub_tipo_activo_cuenta");
		$this->var->add_param("$id_sub_tipo_activo");
		$this->var->add_param("'$estado_reg'");
		$this->var->add_param("'$fecha_reg'");
		$this->var->add_param("$id_usuario_reg");
		$this->var->add_param("$id_cuenta");
        $this->var->add_param("$id_auxiliar");
        $this->var->add_param("$id_proceso");
        $this->var->add_param("$id_gestion");
		$this->var->add_param("null");
        $this->var->add_param("null");
        $this->var->add_param("$id_presupuesto");
        $this->var->add_param("$id_cuenta2");
        $this->var->add_param("$id_auxiliar2");
        $this->var->add_param("$id_tipo_activo");
        $this->var->add_param("'$nivel'");
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
	 * Nombre de la funci�n:	EliminarSubTipoActivoCuenta
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla taid_sub_tipo_activo_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-07 15:34:51
	 */
	function EliminarSubTipoActivoCuenta($id_sub_tipo_activo_cuenta)
	{
		$this->salida = "";
		$this->estado_reg_funcion = 'f_taf_sub_tipo_activo_cuenta_iud';
		$this->id_cuenta_procedimiento = "'AD_SUTIAC_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->estado_reg_funcion,$this->id_cuenta_procedimiento,$this->decodificar);
		
		$this->var->add_param($id_sub_tipo_activo_cuenta);
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
	
	/**
	 * Nombre de la funci�n:	ValidarSubTipoActivoCuenta
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla taid_sub_tipo_activo_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-05-07 15:34:51
	 */
	function ValidarSubTipoActivoCuenta($operacion_sql,$id_sub_tipo_activo_cuenta,$id_sub_tipo_activo,$estado_reg,$fecha_reg,$id_usuario_reg,$id_cuenta,$id_auxiliar,$id_proceso,$id_gestion,$id_fina_regi_prog_proy_acti,$id_unidad_organizacional,$id_presupuesto)
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
				//Validar iid_sub_tipo_activo_cuenta - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_sub_tipo_activo_cuenta");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_sub_tipo_activo_cuenta", $id_sub_tipo_activo_cuenta))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}
			
			/*$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_sub_tipo_activo");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_sub_tipo_activo", $id_sub_tipo_activo))
				{
					$this->salida = $valid->salida;
					return false;
				}*/
			
			//Validar estado_reg - tipo varchar
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("estado_reg");
			$tipo_dato->set_MaxLength(30);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "estado_reg", $estado_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
				//Validar fecha_reg - tipo date
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("fecha_reg");
			$tipo_dato->set_MaxLength(10);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_reg", $fecha_reg))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_Columna("id_usuario_reg");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_usuario_reg", $id_usuario_reg))
				{
					$this->salida = $valid->salida;
					return false;
				}

			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_Columna("id_cuenta");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cuenta", $id_cuenta))
				{
					$this->salida = $valid->salida;
					return false;
				}
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_Columna("id_auxiliar");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_auxiliar", $id_auxiliar))
				{
					$this->salida = $valid->salida;
					return false;
				}				
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_Columna("id_proceso");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_proceso", $id_proceso))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_Columna("id_gestion");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_gestion", $id_proceso))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
//			$tipo_dato->_reiniciar_valor();
//			$tipo_dato->set_MaxLength(10);
//			$tipo_dato->set_Columna("id_fina_regi_prog_proy_acti");
//
//				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_fina_regi_prog_proy_acti", $id_fina_regi_prog_proy_acti))
//				{
//					$this->salida = $valid->salida;
//					return false;
//				}
//			$tipo_dato->_reiniciar_valor();
//			$tipo_dato->set_MaxLength(10);
//			$tipo_dato->set_Columna("id_unidad_organizacional");
//
//				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_unidad_organizacional", $id_unidad_organizacional))
//				{
//					$this->salida = $valid->salida;
//					return false;
//				}
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_Columna("id_presupuesto");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_presupuesto", $id_presupuesto))
				{
					$this->salida = $valid->salida;
					return false;
				}
			//Validaci�n exitosa
			return true;
		}
		elseif ($operacion_sql=='delete')
		{
			//Validar iid_sub_tipo_activo_cuenta - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_sub_tipo_activo_cuenta");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_sub_tipo_activo_cuenta", $id_sub_tipo_activo_cuenta))
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