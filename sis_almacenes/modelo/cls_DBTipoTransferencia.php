<?php
/**
 * Nombre de la clase:	cls_DBTipoTransferencia.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tal_tal_tipo_transferencia
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2007-10-02 11:05:39
 */

class cls_DBTipoTransferencia
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
	 * Nombre de la funci�n:	ListarTipoTransferencia
	 * Prop�sito:				Desplegar los registros de tal_tipo_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-02 11:05:39
	 */
	function ListarTipoTransferencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_tipo_transferencia_sel';
		$this->codigo_procedimiento = "'AL_TIPTRA_SEL'";

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
		$this->var->add_param($func->iif($id_financiador == '','NULL',$id_financiador));//id_financiador
		$this->var->add_param($func->iif($id_regional == '','NULL',$id_regional));//id_regional
		$this->var->add_param($func->iif($id_programa == '','NULL',$id_programa));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '','NULL',$id_proyecto));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '','NULL',$id_actividad));//id_actividad

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_tipo_transferencia','int4');
		$this->var->add_def_cols('nombre','varchar');
		$this->var->add_def_cols('descripcion','varchar');
		$this->var->add_def_cols('observaciones','varchar');
		$this->var->add_def_cols('fecha_reg','date');

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarTipoTransferencia
	 * Prop�sito:				Contar los registros de tal_tipo_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-02 11:05:39
	 */
	function ContarTipoTransferencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_tipo_transferencia_sel';
		$this->codigo_procedimiento = "'AL_TIPTRA_COUNT'";

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
		$this->var->add_param($func->iif($id_financiador == '','NULL',$id_financiador));//id_financiador
		$this->var->add_param($func->iif($id_regional == '','NULL',$id_regional));//id_regional
		$this->var->add_param($func->iif($id_programa == '','NULL',$id_programa));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '','NULL',$id_proyecto));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '','NULL',$id_actividad));//id_actividad
		
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
	 * Nombre de la funci�n:	InsertarTipoTransferencia
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tal_tipo_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-02 11:05:39
	 */
	function InsertarTipoTransferencia($id_tipo_transferencia,$nombre,$descripcion,$observaciones,$fecha_reg)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_tipo_transferencia_iud';
		$this->codigo_procedimiento = "'AL_TIPTRA_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param("NULL");
		$this->var->add_param("'$nombre'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$fecha_reg'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ModificarTipoTransferencia
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tal_tipo_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-02 11:05:39
	 */
	function ModificarTipoTransferencia($id_tipo_transferencia,$nombre,$descripcion,$observaciones,$fecha_reg)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_tipo_transferencia_iud';
		$this->codigo_procedimiento = "'AL_TIPTRA_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_tipo_transferencia);
		$this->var->add_param("'$nombre'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param("'$observaciones'");
		$this->var->add_param("'$fecha_reg'");

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarTipoTransferencia
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tal_tipo_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-02 11:05:39
	 */
	function EliminarTipoTransferencia($id_tipo_transferencia)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tal_tipo_transferencia_iud';
		$this->codigo_procedimiento = "'AL_TIPTRA_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_tipo_transferencia);
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
	 * Nombre de la funci�n:	ValidarTipoTransferencia
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tal_tipo_transferencia
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2007-10-02 11:05:39
	 */
	function ValidarTipoTransferencia($operacion_sql,$id_tipo_transferencia,$nombre,$descripcion,$observaciones,$fecha_reg)
	{
		return true;
	}
	
	
}?>