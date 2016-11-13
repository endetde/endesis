<?php
/**
 * Nombre de la clase:	cls_DBExtractoBancario.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tts_extracto_bancario
 * Autor:				A.V.Q.
 * Fecha creaci�n:		2015-11-12
 */

 
class cls_DBExtractoBancario
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
	 * Nombre de la funci�n:	ListarExtractoBancario
	 * Prop�sito:				Desplegar los registros de tts_extracto_bancario
	 * Autor:				    a.v.q.
	 * Fecha de creaci�n:		2015-11-12
	 */
	function ListarExtractoBancario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_extracto_bancario_sel';
		$this->codigo_procedimiento = "'PR_EXTBAN_SEL'";

		$func = new cls_funciones();//Instancia de laPR_EXTBAN_SELs funciones generales
		
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
		
		$this->var->add_def_cols('id_extracto_bancario','integer');
		$this->var->add_def_cols('fecha_movimiento','date');
		$this->var->add_def_cols('agencia','VARCHAR');
		$this->var->add_def_cols('descripcion','text');
		$this->var->add_def_cols('nro_documento','VARCHAR');
		$this->var->add_def_cols('monto','numeric');
		$this->var->add_def_cols('id_cuenta_bancaria','integer');
		$this->var->add_def_cols('tipo_importe','VARCHAR');
		$this->var->add_def_cols('sub_tipo_importe ','VARCHAR');
		$this->var->add_def_cols('observaciones','TEXT');
        $this->var->add_def_cols('nro_cuenta_banco','varchar');
		$this->var->add_def_cols('id_siet_cbte','integer');
		$this->var->add_def_cols('sw_asocia','varchar');
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
	 * Nombre de la funci�n:	ContarExtractoBancario
	 * Prop�sito:				Contar los registros de tts_extracto_bancario
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function ContarExtractoBancario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_extracto_bancario_sel';
		$this->codigo_procedimiento = "'PR_EXTBAN_COUNT'";

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
	 * Nombre de la funci�n:	InsertarExtractoBancario
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tts_extracto_bancario
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function InsertarExtractoBancario($id_extracto_bancario,$id_cuenta_bancaria,$fecha_movimiento,$agencia,$descripcion,$nro_documento,$monto,$tipo_importe,$sub_tipo_importe,$id_parametro,$id_periodo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_extracto_bancario_iud';
		$this->codigo_procedimiento = "'PR_EXTBANC_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		
		$this->var->add_param("NULL");
		$this->var->add_param($id_cuenta_bancaria);
		$this->var->add_param("'$fecha_movimiento'");
		$this->var->add_param("'$agencia'");
		$this->var->add_param("'$descripcion'");
		$this->var->add_param($nro_documento);  
		$this->var->add_param($monto);
		$this->var->add_param("'$tipo_importe'");
		$this->var->add_param("'$sub_tipo_importe'");
		$this->var->add_param($id_parametro);
		$this->var->add_param($id_periodo);
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
	 * Nombre de la funci�n:	ModificarExtractoBancario
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tts_extracto_bancario
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function ModificarExtractoBancario($id_extracto_bancario,$sub_tipo_importe,$observaciones,$id_cbte,$monto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_extracto_bancario_iud';
		$this->codigo_procedimiento = "'PR_EXTBANC_UPD'";
		
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_extracto_bancario);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("$monto");
		$this->var->add_param("NULL");
		$this->var->add_param("'$sub_tipo_importe'");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("'$observaciones'");
              $this->var->add_param("$id_cbte");
             
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	EliminarExtractoBancario
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tts_extracto_bancario
	 * Autor:				    avq
	 * Fecha de creaci�n:		01/11/2015
	 */
	function EliminarExtractoBancario($id_extracto_bancario)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_extracto_bancario_iud';
		$this->codigo_procedimiento = "'PR_EXTBANC_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_extracto_bancario);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL"); //descripcion
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
              $this->var->add_param("NULL");
              $this->var->add_param("NULL");
              $this->var->add_param("NULL");
         //     $this->var->add_param("NULL");
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}
	/**
	 * Prop�sito:				Permite buscar las transferencias dado el id_cuenta y diferenciarlas del extracto _bancario
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function DefinirTransferencias($id_cuenta_bancaria,$id_parametro,$id_periodo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_extracto_bancario_iud';
		$this->codigo_procedimiento = "'PR_EXTBANTRA_IUD'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
	
		$this->var->add_param("NULL");
		$this->var->add_param($id_cuenta_bancaria);
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		$this->var->add_param($id_parametro);
		$this->var->add_param($id_periodo);
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
	 * Prop�sito:				Permite generar backup del Extracto Bancario
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function GenerarBackupEB($id_periodo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_extracto_bancario_iud';
		$this->codigo_procedimiento = "'PR_GENBACEB_IUD'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
	
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
		$this->var->add_param("$id_periodo");
		$this->var->add_param("NULL");
		$this->var->add_param("NULL");
		
	
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
	 * Prop�sito:				Permite subir el backup del Extracto Bancario
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	function SubirBackupEB($id_periodo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_extracto_bancario_iud';
		$this->codigo_procedimiento = "'PR_SUBBACEB_IUD'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
	
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
		$this->var->add_param("$id_periodo");
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
	 * Nombre de la funci�n:	ActualizarExtractoBancario
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla presto.tpr_extracto_bancario
	 * Autor:				    a.v.q
	 * Fecha de creaci�n:		01/11/2015
	 */
	
	function ActualizarAsociarExtractoBancario($id_extracto_bancario,$id_cuenta_bancaria,$monto,$tipo_importe,$id_parametro,$id_periodo,$id_siet_cbte)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_extracto_bancario_iud';
		$this->codigo_procedimiento = "'PR_ASOCEB_UPD'";
	
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
	
		$this->var->add_param($id_extracto_bancario);
		$this->var->add_param($id_cuenta_bancaria);
		$this->var->add_param("'NULL'");
		$this->var->add_param("'NULL'");
		$this->var->add_param("'NULL'");
		$this->var->add_param("NULL");
		$this->var->add_param("$monto");
		$this->var->add_param("'$tipo_importe'");
		$this->var->add_param("'NULL'");
		$this->var->add_param($id_parametro);
		$this->var->add_param($id_periodo);
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
