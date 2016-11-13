<?php
/**
 * Nombre de la clase:	cls_DBTipoCuentaCuenta.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla taf_taf_tipo_cuenta_cuenta
 * Autor:				jrivera
 * Fecha creaci�n:		2010-11-08 18:08:55
 */

 
class cls_DBTipoCuentaCuenta
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
	 * Nombre de la funci�n:	ListarTipoCuenta
	 * Prop�sito:				Desplegar los registros de taf_tipo_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-11-08 18:08:55
	 */
	function ListarTipoCuentaCuenta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_gestion,$id_p,$id_tipo_cuenta)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_tipo_cuenta_cuenta_sel';
		$this->codigo_procedimiento = "'AF_TIPCUCU_SEL'";

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
		
		$this->var->add_param($id_gestion);
		if($id_p=='id')
			$this->var->add_param("NULL");
		else 
			$this->var->add_param($id_p);
		$this->var->add_param($id_tipo_cuenta);

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_tipo_cuenta','int4');
		$this->var->add_def_cols('id_tipo_cuenta_cuenta','int4');
		$this->var->add_def_cols('id','int4');
		$this->var->add_def_cols('id_p','int4');
		$this->var->add_def_cols('id_presupuesto','int4');
		$this->var->add_def_cols('id_tipo_activo','int4');
		$this->var->add_def_cols('id_sub_tipo_activo','int4');
		
		$this->var->add_def_cols('text','varchar');
		$this->var->add_def_cols('tipo','varchar');
		$this->var->add_def_cols('leaf','varchar');
		$this->var->add_def_cols('allowDelete','varchar');
		$this->var->add_def_cols('allowEdit','varchar');
		$this->var->add_def_cols('allowDrag','varchar');
		$this->var->add_def_cols('qtip','varchar');
		$this->var->add_def_cols('xxxx','varchar');
		
		$this->var->add_def_cols('id_cuenta','int4');
		$this->var->add_def_cols('id_auxiliar','int4');
			
		$this->var->add_def_cols('nro_cuenta','varchar');
		$this->var->add_def_cols('nombre_cuenta','varchar');
		$this->var->add_def_cols('codigo_cuenta','varchar');
		$this->var->add_def_cols('nombre_auxiliar','varchar');
		$this->var->add_def_cols('desc_presupuesto','varchar');
		$this->var->add_def_cols('desc_tipo_activo','varchar');
		$this->var->add_def_cols('desc_sub_tipo_activo','varchar');


		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query('*','asoc');

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	InsertarTipoCuenta
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla taf_tipo_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-11-08 18:08:55
	 */
	function InsertarTipoCuentaCuenta($id_p,$id_tipo_cuenta,$id_gestion,$id_presupuesto,$id_tipo_activo,$id_sub_tipo_activo,$id_cuenta,$id_auxiliar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_tipo_cuenta_cuenta_iud';
		$this->codigo_procedimiento = "'AF_TIPCUCU_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_p);
		$this->var->add_param($id_tipo_cuenta);
		$this->var->add_param($id_gestion);
		$this->var->add_param($id_presupuesto);
		$this->var->add_param($id_tipo_activo);
		$this->var->add_param($id_sub_tipo_activo);
		$this->var->add_param($id_cuenta);
		$this->var->add_param($id_auxiliar);
		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarTipoCuenta
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla taf_tipo_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-11-08 18:08:55
	 */
	function ModificarTipoCuentaCuenta($id,$id_tipo_cuenta,$id_gestion,$id_presupuesto,$id_tipo_activo,$id_sub_tipo_activo,$id_cuenta,$id_auxiliar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_tipo_cuenta_cuenta_iud';
		$this->codigo_procedimiento = "'AF_TIPCUCU_MOD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id);
		$this->var->add_param($id_tipo_cuenta);
		$this->var->add_param($id_gestion);
		$this->var->add_param($id_presupuesto);
		$this->var->add_param($id_tipo_activo);
		$this->var->add_param($id_sub_tipo_activo);
		$this->var->add_param($id_cuenta);
		$this->var->add_param($id_auxiliar);
		

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarTipoCuenta
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla taf_tipo_cuenta
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-11-08 18:08:55
	 */
	function EliminarTipoCuentaCuenta($id)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_taf_tipo_cuenta_cuenta_iud';
		$this->codigo_procedimiento = "'AF_TIPCUCU_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id);
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
	
	
}?>