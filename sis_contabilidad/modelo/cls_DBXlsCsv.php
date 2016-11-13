<?php 
/**
 * Nombre de la Clase:	cls_DBXLsCsv
 * Prop�sito:			Permite realizar la funcionalidad de los datos de un archivo excel a una tabla temporal
 * Autor:				Williams Escobar
 * Fecha creaci�n:		16-02-2011
 *
 */
class cls_DBXlsCsv
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
	function ImportarXls($campos,$id_adjunto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_xls_import';		
		$this->codigo_procedimiento = "'CT_XLS_CREATE'";
		
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("'$campos'");				
		$this->var->add_param($id_adjunto);
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	//************** funcion que lleva a cabo el listado de los archivos en excel*****************/
	function ListarXls($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_adjunto)
	{ 
		$this->salida = ""; 
		$this->nombre_funcion = 'f_tct_xls_sel';
		$this->codigo_procedimiento = "'CT_XLS_SEL'";
		
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
		$this->var->add_def_cols('id_adjunto','int4');
		$this->var->add_def_cols('nombre_doc','varchar');
		$this->var->add_def_cols('observacion','text');
		$this->var->add_def_cols('fecha_reg','date');
		$this->var->add_def_cols('estado_reg','varchar');
		$this->var->add_def_cols('id_usuario_reg','int4');	
		$this->var->add_def_cols('id_correspondencia','int4');
		$this->var->add_def_cols('nombre_arch','varchar');
		$this->var->add_def_cols('extension','varchar');
		$this->var->add_def_cols('nombre_original','varchar');
		$this->var->add_def_cols('desc_persona','varchar');
		
			
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
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function ContarXls($cant,$puntero,$sortcol,$sortdir,$criterio_filtro)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_xls_sel';
		$this->codigo_procedimiento = "'CT_XLS_COUNT'";

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
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tkp_columna
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function InsertarXls($id_adjunto,$nombre_doc,$observacion,$id_correspondencia,$nombre_arch,$extension,$nombre_original,$desc_persona)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_xls_iud';
		$this->codigo_procedimiento = "'CT_XLS_INS'";
		
		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_adjunto);
		$this->var->add_param("'$nombre_doc'");
		$this->var->add_param("'$observacion'");		
		$this->var->add_param($id_correspondencia);	
		$this->var->add_param("'$nombre_arch'");	
		$this->var->add_param("'$extension'");	
		$this->var->add_param("'$nombre_original'");	
		$this->var->add_param("'$desc_persona'");
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
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tkp_columna
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function ModificarAdjunto($id_adjunto,$nombre_doc,$observacion,$id_correspondencia,$nombre_arch,$extension,$nombre_original,$desc_persona)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_xls_iud';
		$this->codigo_procedimiento = "'CT_XLS_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_adjunto);
		$this->var->add_param("'$nombre_doc'");
		$this->var->add_param("'$observacion'");		
		$this->var->add_param($id_correspondencia);
		$this->var->add_param("'$nombre_arch'");	
		$this->var->add_param("'$extension'");
		$this->var->add_param("'$nombre_original'");
		$this->var->add_param("'$desc_persona'");		
				
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}	
		
	/**
	 * Nombre de la funci�n:	EliminarXls
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n del Archivo Excel
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */
	function EliminarXls($id_adjunto)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_xls_iud';
		$this->codigo_procedimiento = "'CT_XLS_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_adjunto);
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
	 * Nombre de la funci�n:	ValidarColumna
	 * Prop�sito:				Permite ejecutar la validaci�n del lado del servidor de la tabla tkp_columna
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2010-08-19 10:28:39
	 */ 
	function ValidarXls($operacion_sql,$id_adjunto,$nombre_doc,$observacion,$nombre_original)	
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
				$tipo_dato->set_Columna("id_adjunto");

				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_adjunto", $id_adjunto))
				{
					$this->salida = $valid->salida;
					return false;
				}
			}

			//Validar valor_defecto - tipo numeric
			$tipo_dato ->_reiniciar_valor();
			$tipo_dato->set_Columna("nombre_doc");
			$tipo_dato->set_MaxLength(100);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "nombre_doc", $nombre_doc))
			{
				$this->salida = $valid->salida;
				return false;
			}
			
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("observacion");
			$tipo_dato->set_MaxLength(150);
			$tipo_dato->set_AllowBlank(false);
			if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "observacion", $observacion))
			{
				$this->salida = $valid->salida;
				return false;
			}
			if($nombre_original==3 ||$nombre_original==4 ||$nombre_original==6 ||$nombre_original==7)
			{	$nombre_original="error";
				
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("nombre_original");
				$tipo_dato->set_MaxLength(20);
				$tipo_dato->set_AllowBlank(false);
				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "nombre_original", $nombre_original))
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
			//Validar id_columna - tipo int4
			$tipo_dato->_reiniciar_valor();
			$tipo_dato->set_Columna("id_adjunto");

			if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_adjunto", $id_adjunto))
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
	
	function ExportarXls($consulta,$nombre_file)
	{ 
		$this->salida = "";
		$this->nombre_funcion = 'f_tct_csv_consulta';
		$this->codigo_procedimiento = "'CT_XLS_CSV'";

		$func = new cls_funciones();//Instancia de las funciones generales
		
		//Instancia la clase middle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros del filtro
		$this->var->cant = 'NULL';
		$this->var->puntero = 'NULL';
		$this->var->sortcol = 'NULL';
		$this->var->sortdir = 'NULL';
		$this->var->criterio_filtro = 'NULL';
		
		///adicion del p�rametro
		$this->var->add_param("'$consulta'");
		$this->var->add_param("'$nombre_file'");
		//Carga la definici�n de columnas con sus tipos de datos
		
		$this->var->add_def_cols('nom_file','varchar');

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
		
		//echo $this->query;exit;

		//Retorna el resultado de la ejecuci�n
		return $res;
	}				
}?>