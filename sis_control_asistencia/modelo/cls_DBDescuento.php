<?php
class cls_DBDescuento
{

	//Variable que contiene la salida de la ejecuci�n de la funci�n
	//si la funci�n tuvo error (false), salida contendr� el mensaje de error
	//si la funci�n no tuvo error (true), salida contendr� el resultado, ya sea un conjunto de datos o un mensaje de confirmaci�n
	var $salida;
	//Variable que contedr� la cadena de llamada a las funciones postgres
	var $query;
	//Variables para la ejecuci�n de funciones
	var $var; //middle_client
	var $nombre_funcion; //nombre de la funci�n a ejecutar
	var $codigo_procedimiento; //codigo del procedimiento a ejecutar

	var $nombre_archivo = "cls_DBDescuento.php";

	//Matriz de par�metros de validaci�n de todas las columnas
	var $matriz_validacion = array();

	//Bandera que indica si los datos se decodificar�n o no
	var $decodificar = false;

	function __construct($decodificar)
	{
		//Carga los par�metro de validaci�n de todas las columnas
		//$this->cargar_param_valid();
		
		//Carga en una variable interna la bandera del GET o POST
		$this->decodificar = $decodificar;
	}


	/*
	**********************************************************
	Nombre de la funci�n:	CrearDescuento()

	Prop�sito:				Se utiliza esta funci�n para insertar una nueva Lectura del Reloj en la base de datos
	Par�metros:				$descripcion	-->	desc 
	&obs --> observaciones pertinentes
	Valores de Retorno:		 0	-->	Retorna el nombre del archivo
	-1	--> Indica que se produjo un error y no se pudo subir el archivo al servidor
	**********************************************************
	*/
	function CrearDescuento($id_descuento,$id_empleado,$sueldo,$fecha_inicio,$fecha_fin,$tiempo_no_trab,$descuento,$observaciones)
	{
		$this->salida = "";
		$this->nombre_funcion = 'casis.f_tca_resumen_descuento_iud';
		$this->codigo_procedimiento = "'CA_RESU_DESC_INS'";
		  
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id_fina_regi_prog_proy_acti
		$this->var->add_param("NULL");//id_descuento
		$this->var->add_param("$id_empleado");//codigo_empleado
		$this->var->add_param("'$sueldo'");//fecha
		$this->var->add_param("'$fecha_inicio'");//hora
		$this->var->add_param("'$fecha_fin'");//tipo_movimiento
		$this->var->add_param("'$tiempo_no_trab'");//tipo_movimiento
		$this->var->add_param("'$descuento'");//tipo_movimiento
		$this->var->add_param("'$observaciones'");//observaciones
                
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	/*
	**********************************************************
	Nombre de la funci�n:	CrearDescuento()

	Prop�sito:				Se utiliza esta funci�n para insertar una nueva Lectura del Reloj en la base de datos
	Par�metros:				$descripcion	-->	desc 
	&obs --> observaciones pertinentes
	Valores de Retorno:		 0	-->	Retorna el nombre del archivo
	-1	--> Indica que se produjo un error y no se pudo subir el archivo al servidor
	**********************************************************
	*/
	function EliminarRepetidos()
	{
		$this->salida = "";
		$this->nombre_funcion = 'casis.f_tca_resumen_descuento_iud';
		$this->codigo_procedimiento = "'CA_ELIM_REP_DEL'";
		  
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id_fina_regi_prog_proy_acti
		$this->var->add_param("NULL");//id_descuento
		$this->var->add_param("'$codigo_empleado'");//codigo_empleado
		$this->var->add_param("'$sueldo'");//fecha
		$this->var->add_param("'$fecha_inicio'");//hora
		$this->var->add_param("'$fecha_fin'");//tipo_movimiento
		$this->var->add_param("'$tiempo_no_trab'");//tipo_movimiento
		$this->var->add_param("'$descuento'");//tipo_movimiento
		$this->var->add_param("'$observaciones'");//observaciones
                
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}
	
	function EliminarDescuento($txt_fecha_ini)
	{
		$this->salida = "";
		$this->nombre_funcion = 'casis.f_tca_resumen_descuento_iud';
		$this->codigo_procedimiento = "'CA_DESC_DEL'";
		  
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id_fina_regi_prog_proy_acti
		$this->var->add_param("NULL");//id_descuento
		$this->var->add_param("NULL");//codigo_empleado
		$this->var->add_param("NULL");//fecha
		$this->var->add_param("'$fecha_ini'");//hora
		$this->var->add_param("NULL");//tipo_movimiento
		$this->var->add_param("NULL");//tipo_movimiento
		$this->var->add_param("NULL");//tipo_movimiento
		$this->var->add_param("NULL");//observaciones
                
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		return $res;
	}

	function DiferenciaDias($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$txt_fecha_ini,$txt_fecha_fin)
	{
		$this->salida = "";
		$this->nombre_funcion = 'casis.f_tca_resumen_mensual_descuento_sel';
		$this->codigo_procedimiento = "'CA_DIF_DIAS_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
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
        $this->var->add_param("'$txt_fecha_ini'");//fecha_inicio
        $this->var->add_param("'$txt_fecha_fin'");//fecha_fin
		//Carga la definici�n de columnas con sus tipos de datos
		
		$this->var->add_def_cols('total','integer');
		
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida[0][0];
		
			
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//echo $this->query;
		//exit;
		return $res;
	}	
	
	function SumaDiasFin($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$txt_fecha_ini,$txt_fecha_fin)
	{
		$this->salida = "";
		$this->nombre_funcion = 'casis.f_tca_resumen_mensual_descuento_sel';
		$this->codigo_procedimiento = "'CA_SUM_FIN_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
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
        $this->var->add_param("'$txt_fecha_ini'");//fecha_inicio
        $this->var->add_param("'$txt_fecha_fin'");//fecha_fin
		//Carga la definici�n de columnas con sus tipos de datos
		
		$this->var->add_def_cols('fecha_fin','date');
		
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida[0][0];
		
			
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		//echo $this->query;
		//exit;
		return $res;
	}	
	
	function SumaDiasInicio($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$txt_fecha_ini,$txt_fecha_fin)
	{
		$this->salida = "";
		$this->nombre_funcion = 'casis.f_tca_resumen_mensual_descuento_sel';
		$this->codigo_procedimiento = "'CA_SUM_INI_SEL'";

		$func = new cls_funciones();//Instancia de las funciones generales

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
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
        $this->var->add_param("'$txt_fecha_ini'");//fecha_inicio
        $this->var->add_param("'$txt_fecha_fin'");//fecha_fin
		//Carga la definici�n de columnas con sus tipos de datos
		
		$this->var->add_def_cols('fecha_ini','date');
		
		
		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida[0][0];
		
			
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
	//	echo $this->query;
		//exit;
		return $res;
	}	
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $operacion_sql
	 * @param unknown_type $id_parametros_generales
	 * @param unknown_type $nombre_atributo
	 * @param unknown_type $valor_atributo
	 * @param unknown_type $descripcion
	 * @return unknown
	 */
	function ValidarDescuento($operacion_sql,$id_descuento,$codigo_empleado,$sueldo,$fecha_inicio,$fecha_fin,$tiempo_no_trab,$descuento,$observaciones)
	{
		//operacion_sql se refiere a que operaci�n validar (por ejemplo: insert, update, delete; podr�an ser otros espec�ficos)

		$this->salida = "";
		$valid = new cls_validacion_serv();
		
		//Clase para validar el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();

		//Ejecuta la validaci�n por el tipo de operaci�n
		switch ($operacion_sql)
		{
			case 'insert' :
				
					/*******************************Verificaci�n de datos****************************/
					//Verifica que las columnas obligatorias tengan datos, que tenga formato v�lido y un tama�o v�lido
					//Se valida todas las columnas de la tabla
							
									
				//Validar codigo_empleado - tipo varchar
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("codigo_empleado");
				$tipo_dato->set_MaxLength(40);
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "codigo_empleado", $codigo_empleado))
				
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar sueldo - tipo real
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("sueldo");
				$tipo_dato->set_AllowBlank("true");	
								
				if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "sueldo", $sueldo))				
				//if(!$valid->verifica_dato($this->matriz_validacion[2],"valor_atributo",$valor_atributo))
				{
					$this->salida = $valid->salida;
					return false;
				}

				//Validar fecha_inicio - tipo date
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("fecha_inicio");	
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_inicio", $fecha_inicio))				
				//if(!$valid->verifica_dato($this->matriz_validacion[3],"descripcion",$descripcion))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("fecha_fin");	
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_fin", $fecha_fin))				
				//if(!$valid->verifica_dato($this->matriz_validacion[3],"descripcion",$descripcion))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar tiempo_no_trab - tipo interval
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("tiempo_no_trab");	
								
				if(!$valid->verifica_dato($tipo_dato->TipoDatoInterval(), "tiempo_no_trab", $tiempo_no_trab))				
				//if(!$valid->verifica_dato($this->matriz_validacion[3],"descripcion",$descripcion))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar descuento - tipo varchar
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("descuento");	
			    $tipo_dato->set_AllowBlank("true");
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "descuento", $descuento))				
				//if(!$valid->verifica_dato($this->matriz_validacion[3],"descripcion",$descripcion))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar observaciones - tipo varchar
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("observaciones");
				$tipo_dato->set_MaxLength(50);
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "observaciones", $observaciones))
				
				{
					$this->salida = $valid->salida;
					return false;
				}
				//Validaci�n exitosa
				return true;				
				break;
				
			case 'update' :
				
					/*******************************Verificaci�n de datos****************************/
					//Verifica que las columnas obligatorias tengan datos, que tenga formato v�lido y un tama�o v�lido
					//Se valida todas las columnas de la tabla
				
					
				//Validar id_lectura_reloj - tipo entero
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("id_descuento");	
				$tipo_dato->set_MaxLength(10);
				$tipo_dato->set_MinLength(0);				
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_descuento", $id_descuento))					
				//if(!$valid->verifica_dato($this->matriz_validacion[0], "id_parametro_general", $id_parametro_general))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar codigo_empleado - tipo varchar
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("codigo_empleado");
				$tipo_dato->set_MaxLength(40);
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "codigo_empleado", $codigo_empleado))
				
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar sueldo - tipo real
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("sueldo");
				$tipo_dato->set_AllowBlank("true");	
								
				if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "sueldo", $sueldo))				
				//if(!$valid->verifica_dato($this->matriz_validacion[2],"valor_atributo",$valor_atributo))
				{
					$this->salida = $valid->salida;
					return false;
				}

				//Validar fecha_inicio - tipo date
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("fecha_inicio");	
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_inicio", $fecha_inicio))				
				//if(!$valid->verifica_dato($this->matriz_validacion[3],"descripcion",$descripcion))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("fecha_fin");	
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoDate(), "fecha_fin", $fecha_fin))				
				//if(!$valid->verifica_dato($this->matriz_validacion[3],"descripcion",$descripcion))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar tiempo_no_trab - tipo interval
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("tiempo_no_trab");	
								
				if(!$valid->verifica_dato($tipo_dato->TipoDatoInterval(), "tiempo_no_trab", $tiempo_no_trab))				
				//if(!$valid->verifica_dato($this->matriz_validacion[3],"descripcion",$descripcion))
				{
					$this->salida = $valid->salida;
					return false;
				}
				
				//Validar descuento - tipo varchar
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("descuento");	
			    $tipo_dato->set_AllowBlank("true");
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoReal(), "descuento", $descuento))				
				//if(!$valid->verifica_dato($this->matriz_validacion[3],"descripcion",$descripcion))
				{
					$this->salida = $valid->salida;
					return false;
				}
				//Validar observaciones - tipo varchar
				$tipo_dato->_reiniciar_valor();
				$tipo_dato->set_Columna("observaciones");
				$tipo_dato->set_MaxLength(50);
				
				if(!$valid->verifica_dato($tipo_dato->TipoDatoText(), "observaciones", $observaciones))
				
				{
					$this->salida = $valid->salida;
					return false;
				}
								
				//Validaci�n exitosa
				return true;
				break;


			case 'delete':
				break;
			default:
				{
					return false;
				}
				break;
		}

	}
	


}
?>