<?php
/**
 * Nombre de la clase:	cls_DBUsuarioAutorizado.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tpr_tpr_usuario_autorizado
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-08-18 17:10:52
 */

 
class cls_DBCaiff
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
	 * Nombre de la funci�n:	ListarCaiff
	 * Prop�sito:				Desplegar los registros de tpr_usuario_autorizado
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		
	 */
	function ListarCaiff($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_caiff_detalle_sel';
		$this->codigo_procedimiento = "'PR_CAIFF_SEL'";

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
		$this->var->add_def_cols('id_caiff','integer');
		$this->var->add_def_cols('id_gestion','integer');
		$this->var->add_def_cols('desc_gestion','numeric');
		$this->var->add_def_cols('id_periodo','integer');
		$this->var->add_def_cols('desc_periodo','text');
		$this->var->add_def_cols('fecha_inicio','date');
		$this->var->add_def_cols('fecha_fin','date');
		$this->var->add_def_cols('estado','varchar'); 
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('usuario_reg','varchar');
		$this->var->add_def_cols('fecha_reg','timestamp');
			
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarCaiff
	 * Prop�sito:				Contar los registros de tpr_usuario_autorizado
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		
	 */
	function ContarCaiff($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_caiff_detalle_sel';
		$this->codigo_procedimiento = "'PR_CAIFF_COUNT'";

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
	 * Nombre de la funci�n:	InsertarAutorizacionPresupuesto
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tpr_usuario_autorizado
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-18 17:10:52
	 */
	function InsertarCaiff($id_gestion,$id_periodo,$descripcion,$fecha_ini,$fecha_fin)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_caiff_detalle_iud';
		$this->codigo_procedimiento = "'PR_CAIFF_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		
		$this->var->add_param("NULL");//pr_id_caiff
		$this->var->add_param($id_gestion);//pr_id_gestion
		$this->var->add_param($id_periodo);//pr_id_periodo
		$this->var->add_param("'$fecha_ini'");//pr_fecha_inicio
	 	$this->var->add_param("'$fecha_fin'");//pr_fecha_fin
	 	$this->var->add_param("NULL");//pr_estado
	 	$this->var->add_param("'$descripcion'");//pr_descripcion

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarCaiff
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2
	 */
	function ModificarCaiff($id_caiff,$id_gestion,$id_periodo,$descripcion,$fecha_ini,$fecha_fin)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_caiff_detalle_iud';
		$this->codigo_procedimiento = "'PR_CAIFF_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		
		$this->var->add_param($id_caiff);//pr_id_caiff
		$this->var->add_param($id_gestion);//pr_id_gestion
		$this->var->add_param($id_periodo);//pr_id_periodo
		$this->var->add_param("'$fecha_ini'");//pr_fecha_inicio
	 	$this->var->add_param("'$fecha_fin'");//pr_fecha_fin
	 	$this->var->add_param("NULL");//pr_estado
	 	$this->var->add_param("'$descripcion'");//pr_descripcion
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarCaiff
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n 				    (autogenerado)
	 * Fecha de creaci�n:		2008-08-18 17:10:52
	 */
	function EliminarCaiff($id_caiff)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_caiff_detalle_iud';
		$this->codigo_procedimiento = "'PR_CAIFF_DEL'";
		
		$this->var = new cls_middle($this->nombre_funcion, $this->codigo_procedimiento, $this->decodificar);
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var->add_param($id_caiff);//pr_id_caiff
		$this->var->add_param("NULL");//pr_id_gestion
		$this->var->add_param("NULL");//pr_id_periodo
		$this->var->add_param("NULL");//pr_fecha_inicio
	 	$this->var->add_param("NULL");//pr_fecha_fin
	 	$this->var->add_param("NULL");//pr_estado
	 	$this->var->add_param("NULL");//pr_descripcion
		//Ejecuta la funci�n

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}	
	/**
	 * Nombre de la funci�n:	ValidarCaiff
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tpr_usuario_autorizado
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		
	 */
	function ValidarCaiff($operacion_sql,$id_caiff,$id_gestion,$id_periodo,$descripcion)
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
				//Validar id_usuario_autorizado - tipo int4
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_Columna("id_caiff");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_caiff", $id_caiff))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

		

			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_gestion");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_gestion", $id_gestion))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_periodo");
			$tipo_dato->set_MaxLength(10);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_periodo", $id_periodo))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("descripcion");
			$tipo_dato->set_MaxLength(100);
			$tipo_dato->set_AllowBlank(true);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "descripcion", $descripcion))
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
	 * Nombre de la funci�n:	Migrar Sin Partida
	 * Prop�sito:				Permite ejecutar la funci�n de migraci�n 
	 * Autor:				    AVQ
	 * Fecha de creaci�n:		2015/01/01
	 */
	function MigrarSP($id_caiff,$id_gestion,$id_periodo,$descripcion,$fecha_ini,$fecha_fin,$estado)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_caiff_detalle_iud';
		$this->codigo_procedimiento = "'PR_MIGSP_INS'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
	
		$this->var->add_param($id_caiff);//pr_id_caiff
		$this->var->add_param($id_gestion);//pr_id_gestion
		$this->var->add_param("NULL");//pr_id_periodo
		$this->var->add_param("NULL");//pr_fecha_inicio
		$this->var->add_param("NULL");//pr_fecha_fin
		$this->var->add_param("NULL");//pr_estado
		$this->var->add_param("NULL");//pr_descripcion
	
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	   // echo $this->query;
	    //exit;
		return $res;
	}
	/**
	 * Nombre de la funci�n:	Migrar Con Partida
	 * Prop�sito:				Permite ejecutar la funci�n de migraci�n
	 * Autor:				    AVQ
	 * Fecha de creaci�n:		2015/01/01
	 */
	function MigrarCP($id_caiff,$id_gestion,$id_periodo,$descripcion,$fecha_ini,$fecha_fin,$estado)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_caiff_detalle_iud';
		$this->codigo_procedimiento = "'PR_MIGCP_INS'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
	
		$this->var->add_param($id_caiff);//pr_id_caiff
		$this->var->add_param($id_gestion);//pr_id_gestion
		$this->var->add_param($id_periodo);//pr_id_periodo
		$this->var->add_param("'$fecha_ini'");//pr_fecha_inicio
		$this->var->add_param("'$fecha_fin'");//pr_fecha_fin
		$this->var->add_param("'$estado'");//pr_estado
		$this->var->add_param("'$descripcion'");//pr_descripcion
	
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	
		return $res;
	}
	/**
	 * Nombre de la funci�n:	Primera Validaci�n
	 * Prop�sito:				Permite ejecutar la funci�n de validacion
	 * Autor:				    AVQ
	 * Fecha de creaci�n:		2015/01/01
	 */
	function Validar_1($id_caiff,$id_gestion,$id_periodo,$descripcion,$fecha_ini,$fecha_fin,$estado)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_caiff_detalle_iud';
		$this->codigo_procedimiento = "'PR_VALIPRIM_INS'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
	
		$this->var->add_param($id_caiff);//pr_id_caiff
		$this->var->add_param($id_gestion);//pr_id_gestion
		$this->var->add_param($id_periodo);//pr_id_periodo
		$this->var->add_param("'$fecha_ini'");//pr_fecha_inicio
		$this->var->add_param("'$fecha_fin'");//pr_fecha_fin
		$this->var->add_param("'$estado'");//pr_estado
		$this->var->add_param("'$descripcion'");//pr_descripcion
	
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
	 * Nombre de la funci�n:	Segunda Validaci�n
	 * Prop�sito:				Permite ejecutar la funci�n de validacion
	 * Autor:				    AVQ
	 * Fecha de creaci�n:		2015/01/01
	 */
	function Validar_2($id_caiff,$id_gestion,$id_periodo,$descripcion,$fecha_ini,$fecha_fin,$estado)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_caiff_detalle_iud';
		$this->codigo_procedimiento = "'PR_VALISEG_INS'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
	
		$this->var->add_param($id_caiff);//pr_id_caiff
		$this->var->add_param($id_gestion);//pr_id_gestion
		$this->var->add_param($id_periodo);//pr_id_periodo
		$this->var->add_param("'$fecha_ini'");//pr_fecha_inicio
		$this->var->add_param("'$fecha_fin'");//pr_fecha_fin
		$this->var->add_param("'$estado'");//pr_estado
		$this->var->add_param("'$descripcion'");//pr_descripcion
	
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	
		return $res;
	}
	/**
	 * Nombre de la funci�n:	Tercera Validaci�n
	 * Prop�sito:				Permite ejecutar la funci�n de validacion
	 * Autor:				    AVQ
	 * Fecha de creaci�n:		2015/01/01
	 */
	function Validar_3($id_caiff,$id_gestion,$id_periodo,$descripcion,$fecha_ini,$fecha_fin,$estado)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_caiff_detalle_iud';
		$this->codigo_procedimiento = "'PR_VALITERC_INS'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
	
		$this->var->add_param($id_caiff);//pr_id_caiff
		$this->var->add_param($id_gestion);//pr_id_gestion
		$this->var->add_param($id_periodo);//pr_id_periodo
		$this->var->add_param("'$fecha_ini'");//pr_fecha_inicio
		$this->var->add_param("'$fecha_fin'");//pr_fecha_fin
		$this->var->add_param("'$estado'");//pr_estado
		$this->var->add_param("'$descripcion'");//pr_descripcion
	
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	
		return $res;
	}
	/**
	 * Nombre de la funci�n:	Tercera Validaci�n
	 * Prop�sito:				Permite ejecutar la funci�n de validacion
	 * Autor:				    AVQ
	 * Fecha de creaci�n:		2015/01/01
	 */
	function Validar_4($id_caiff,$id_gestion,$id_periodo,$descripcion,$fecha_ini,$fecha_fin,$estado)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_caiff_detalle_iud';
		$this->codigo_procedimiento = "'PR_VALICUAR_INS'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
	
		$this->var->add_param($id_caiff);//pr_id_caiff
		$this->var->add_param($id_gestion);//pr_id_gestion
		$this->var->add_param($id_periodo);//pr_id_periodo
		$this->var->add_param("'$fecha_ini'");//pr_fecha_inicio
		$this->var->add_param("'$fecha_fin'");//pr_fecha_fin
		$this->var->add_param("'$estado'");//pr_estado
		$this->var->add_param("'$descripcion'");//pr_descripcion
	
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();
	
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
	
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	
		return $res;
	}
	
	
}?>