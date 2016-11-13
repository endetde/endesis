<?php
/**
**********************************************************
Nombre de la Clase:	    cls_Arbol
Prop�sito:				Permite listar nodos de un arbol
Fecha de Creaci�n:		04-10-2007
Versi�n:				1.0.0
Autor:					Enzo Rojas
**********************************************************
*/
/**
 * Permite listar los procesos y/o operaciones que puede realizar un usuario.
 *
 */
include_once("../../lib/lib_modelo/cls_middle.php");
include_once("../../lib/lib_general/cls_funciones.php");

class cls_Arbol
{
	/**
	 * Variable que contiene la salida de la ejecuci�n de la funci�n
	 * si la funci�n tuvo error (false), salida contendr� el mensaje de error
	 * si la funci�n no tuvo error (true), salida contendr� el resultado, ya sea un conjunto de datos o un mensaje de confirmaci�n
	 * @var unknown_type $salida
	 */	
	var $salida;
	/**
	 * Variable para el objeto de la clase cls_bd_middle
	 * @var unknown_type $var
	 */
	var $var;
	
	/**
	 * nombre de la funci�n a ejecutar
	 * @var unknown_type $nombre_funcion
	 */


	function __construct()
	{
		//Carga los par�metro de validaci�n de todas las columnas
		//$this->cargar_param_valid();
	}

	/**
 	* Enter description here...
 	*
 	* @param unknown_type $id_usuario
 	* @param unknown_type $id_rol
 	* @param unknown_type $ip_origen
 	* @param unknown_type $mac_maquina
 	* @return permisos: lista de procedimientos a los que puede realizar, error: si id_usuario no existe .
 	*/
	function ListarNodos($id_usuario,$id_rol,$ip_origen,$mac_maquina)
	{
		$this->salida ="";
		$this->nombre_funcion = 'f_gen_listar_nodos';
		$this->codigo_procedimiento = "'GN_LISNOD'";

		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros espec�fos
		$this->var->add_param($id_usuario=='' ? 'NULL':"'$id_usuario'");//id_usuario
		$this->var->add_param($id_rol=='' ? 'NULL':"'$id_rol'");//id_rol
		$this->var->add_param($ip_origen=='' ? 'NULL':"'$ip_origen'");//ip_origen
		$this->var->add_param($mac_maquina=='' ? 'NULL':"'$mac_maquina'");//mac_maquina

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_metaproceso','integer');
		$this->var->add_def_cols('nombre','text');
		$this->var->add_def_cols('nivel','integer');
		$this->var->add_def_cols('fk_id_metaproceso','integer');
		$this->var->add_def_cols('codigo_procedimiento','varchar');
		$this->var->add_def_cols('nombre_achivo','varchar');
		$this->var->add_def_cols('ruta_archivo','text');
		$this->var->add_def_cols('visible','varchar');
		$this->var->add_def_cols('orden_logico','integer');
		$this->var->add_def_cols('icono','varchar');
		$this->var->add_def_cols('nombre_tabla','varchar');
		$this->var->add_def_cols('prefijo','varchar');
		$this->var->add_def_cols('codigo_base','varchar');
		$this->var->add_def_cols('tipo_vista','varchar');
		$this->var->add_def_cols('con_ep','varchar');
		$this->var->add_def_cols('con_interfaz','varchar');
		$this->var->add_def_cols('num_datos_hijo','integer');
		$this->var->add_def_cols('id_subsistema','integer');

		//Ejecuta la funci�n de consulta
		$res = $this ->var->exec_query_sss();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//echo "sql: ".$this->var->query;
		return $res;
	}
	
	function ListarHijos($nodoArbol,$idSubSistema)
	{
		$this->salida ="";
		$this->nombre_funcion = 'f_gen_obtener_hijos';
		$this->codigo_procedimiento = "'GN_OBTHIJ'";
		
			
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);
		
		$this->var->add_param($nodoArbol=='' ? 'NULL':"'$nodoArbol'");//
		$this->var->add_param($idSubSistema=='' ? 'NULL':"'$idSubSistema'");//
		
		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('id_metaproceso','integer');
		$this->var->add_def_cols('nombre','text');
		$this->var->add_def_cols('nivel','integer');
		$this->var->add_def_cols('fk_id_metaproceso','integer');
		$this->var->add_def_cols('codigo_procedimiento','varchar');
		$this->var->add_def_cols('nombre_achivo','varchar');
		$this->var->add_def_cols('ruta_archivo','text');
		$this->var->add_def_cols('visible','varchar');
		$this->var->add_def_cols('orden_logico','integer');
		$this->var->add_def_cols('icono','varchar');
		$this->var->add_def_cols('nombre_tabla','varchar');
		$this->var->add_def_cols('prefijo','varchar');
		$this->var->add_def_cols('codigo_base','varchar');
		$this->var->add_def_cols('tipo_vista','varchar');
		$this->var->add_def_cols('con_ep','varchar');
		$this->var->add_def_cols('con_interfaz','varchar');
		$this->var->add_def_cols('num_datos_hijo','integer');

		//Ejecuta la funci�n de consulta
		$res = $this ->var->exec_query_sss();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//echo "sql: ".$this->var->query;
		return $res;
	}
	

}?>