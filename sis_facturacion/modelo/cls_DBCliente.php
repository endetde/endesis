<?php
/**
 * Nombre de la Clase:	cls_DBCliente
 * Prop�sito:			Permite ejecutar la funcionalidad de la tabla tfv_cliente
 * Autor:				MTSL
 * Fecha creaci�n:		2014.05
 *
 */
class cls_DBCliente
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

	//Nombre del archivo
	var $nombre_archivo = "cls_DBCliente.php";

	//Matriz de par�metros de validaci�n de todas las columnas
	var $matriz_validacion = array();
	
	//Bandera que indica si los datos se decodificar�n o no
	var $decodificar = false;

	function __construct()
	{
		//Carga los par�metro de validaci�n de todas las columnas
		//$this->cargar_param_valid();
		
		//Carga en una variable interna la bandera del GET o POST
		$this->decodificar = $decodificar;
	}

	/**
	 * Nombre de la funci�n:	ListarCliente
	 * Prop�sito:				Desplegar los registros de tfv_Cliente en funci�n de los par�metros del filtro
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
	function ListarCliente($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_cliente_sel';
		$this->codigo_procedimiento = "'FV_CLIENT_SEL'";

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
		//Carga los par�metros espec�ficos de la estructura program�tica
		$this->var->add_param($func->iif($id_financiador == '',"'%'","'$id_financiador'"));//id_financiador
		$this->var->add_param($func->iif($id_regional == '',"'%'","'$id_regional'"));//id_regional
		$this->var->add_param($func->iif($id_programa == '',"'%'","'$id_programa'"));//id_programa
		$this->var->add_param($func->iif($id_proyecto == '',"'%'","'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'","'$id_actividad'"));//id_actividad
		
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_cliente','integer');
		$this->var->add_def_cols('razon_social','varchar');
		$this->var->add_def_cols('nro_nit','numeric');
		$this->var->add_def_cols('direccion','varchar');
		$this->var->add_def_cols('telefono','varchar');
		$this->var->add_def_cols('repre_legal','varchar');
		$this->var->add_def_cols('docid_legal','varchar');
		$this->var->add_def_cols('nomb_fact','varchar');
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
	 * Nombre de la funci�n:	ContarCliente
	 * Prop�sito:				Contar el total de registros desplegados en funci�n de los par�metros de filtro
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
	function ContarCliente($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_cliente_sel';
		$this->codigo_procedimiento = "'FV_CLIENT_COUNT'";

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
	 * Nombre de la funci�n:	InsertarCliente
	 * Prop�sito:				Permite ejecutar la funci�n de inserci�n de la tabla tfv_Cliente
	 * 							con los par�metros requeridos
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
		
	function InsertarCliente($id_cliente, $razon_social, $nro_nit, $direccion, $telefono, $repre_legal, $docid_legal, $nomb_fact)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_cliente_iud';
		$this->codigo_procedimiento = "'FV_CLIENT_INS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("NULL");//id de cliente
		$this->var->add_param("'$razon_social'");//razon social del cliente
		$this->var->add_param("$nro_nit");//nit del clliente
		$this->var->add_param("'$direccion'");//direccion del cliente
		$this->var->add_param("'$telefono'");//telefonos del cliente
		$this->var->add_param("'$repre_legal'");//representante legal del cliente
		$this->var->add_param("'$docid_legal'");//ci del representante legal
		$this->var->add_param("'$nomb_fact'");//nombre al que se factura
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;

		return $res;
	}

	/**
	 * Nombre de la funci�n:	ModificarCliente
	 * Prop�sito:				Permite ejecutar la funci�n de modificaci�n de la tabla tfv_Cliente
	 * con los par�metros requeridos
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
	function ModificarCliente($id_cliente, $razon_social, $nro_nit, $direccion, $telefono, $repre_legal, $docid_legal, $nomb_fact)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_cliente_iud';
		$this->codigo_procedimiento = "'FV_CLIENT_UPD'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		
		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_cliente");//id de Cliente
		$this->var->add_param("'$razon_social'");//razon social del cliente
		$this->var->add_param("$nro_nit");//nit del clliente
		$this->var->add_param("'$direccion'");//direccion del cliente
		$this->var->add_param("'$telefono'");//telefonos del cliente
		$this->var->add_param("'$repre_legal'");//representante legal del cliente
		$this->var->add_param("'$docid_legal'");//ci del representante legal
		$this->var->add_param("'$nomb_fact'");//nombre al que se factura

		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}

	/**
	 * Nombre de la funci�n:	EliminarCliente
	 * Prop�sito:				Permite ejecutar la funci�n de eliminaci�n de la tabla tfv_Cliente
	 * con los par�metros requeridos
	 * Autor:					MTSL
	 * Fecha de creaci�n:		2014.05
	 */
	function EliminarCliente($id_cliente)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tfv_cliente_iud';
		$this->codigo_procedimiento = "'FV_CLIENT_DEL'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);

		//Carga par�metros espec�ficos (no incluyen los par�metros fijos)
		$this->var->add_param("$id_cliente");//id de Cliente
		$this->var->add_param("null");//razon social del cliente
		$this->var->add_param("null");//nit del clliente
		$this->var->add_param("null");//direccion del cliente
		$this->var->add_param("null");//telefonos del cliente
		$this->var->add_param("null");//representante legal del cliente
		$this->var->add_param("null");//ci del representante legal
		$this->var->add_param("null");//nombre al que se factura
		
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		
		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ValidarCliente
	 * Prop�sito:				Realiza una validaci�n de datos del lado del servidor (sin consultar a BD)
	 * Autor:					MTSL			
	 * Fecha creaci�n:			2014.05
	 */
	function ValidarCliente($operacion_sql, $id_cliente, $razon_social, $nro_nit, $direccion, $telefono, $repre_legal, $docid_legal, $nomb_fact)
	{
		//operacion_sql se refiere a que operaci�n validar (por ejemplo: insert, update, delete; podr�an ser otros espec�ficos)
		$this->salida = "";
		$valid = new cls_validacion_serv();

		//Clase para validad el tipo de dato
		$tipo_dato = new cls_define_tipo_dato();
		
		//Ejecuta la validaci�n por el tipo de operaci�n
		switch ($operacion_sql) {
			case 'insert' or 'update':
				/*******************************Verificaci�n de datos****************************/
				//Verifica que las columnas obligatorias tengan datos, que tenga formato v�lido y un tama�o v�lido
				//Se valida todas las columnas de la tabla
				
				if($operacion_sql == 'update')
				{				
					//Validar id_Cliente - tipo integer
					$tipo_dato->_reiniciar_valor();
					$tipo_dato->set_Columna("id_cliente");	
					$tipo_dato->set_MaxLength(15);
					$tipo_dato->set_MinLength(0);
					$tipo_dato->set_Signo('2');
					 
					if(!$valid->verifica_dato($tipo_dato->TipoDatoInteger(), "id_cliente", $id_cliente))
					{
						$this->salida = $valid->salida;
						return false;
					}
				}
				
				//Validaci�n exitosa
				return true;
				break;
               
			case 'delete':
				break;
				
			default:
				return false;
				break;
		}
	}
}?>