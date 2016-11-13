<?php
/**
**********************************************************
Nombre de la Clase:	    cls_DBPermiso
Prop�sito:				Permite listar los procesos y/o operaciones que puede realizar un usuario.
Fecha de Creaci�n:		05-06-2007
Versi�n:				1.0.0
Autor:					Enzo Rojas
**********************************************************
*/
/**
 * Permite listar los procesos y/o operaciones que puede realizar un usuario.
 *
 */
class cls_DBPermiso
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
	var $nombre_funcion;
	/**
	 * codigo del procedimiento a ejecutar	
	 * @var unknown_type $codigo_procedimiento
	 */
	var $codigo_procedimiento;
	/**
	 * Nombre del archivo
	 *
	 * @var unknown_type $nombre_archivo
	 */
	var $nombre_archivo = "cls_DBPermiso.php";	
	/**
	 * Matriz de par�metros de validaci�n de todas las columnas
	 *
	 * @var unknown_type
	 */
	var $matriz_validacion = array();

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
	function ListaPermiso($id_usuario,$id_rol,$ip_origen,$mac_maquina){
		$this->salida ="";
		$this->nombre_funcion = 'f_sg_privilegios_usuario';
		$this->codigo_procedimiento = "'SG_MET_PRO_SEL'";

		$func = new cls_funciones();
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros espec�fos
        $this->var->add_param($func->iif($id_usuario == '','NULL',"'$id_usuario'"));//id_usuario
        $this->var->add_param($func->iif($id_usuario == '','NULL',"'$id_rol'"));//id_rol
        $this->var->add_param($func->iif($ip_origen == '','NULL',"'$ip_origen'"));//ip_origen
		$this->var->add_param($func->iif($mac_maquina == '','NULL',"'$mac_maquina'"));//mac_maquina
						
		//Carga la definici�n de columnas con sus tipos de datos		
		$this->var->add_def_cols('id_metaproceso','integer');
		$this->var->add_def_cols('nombre','text');		
		$this->var->add_def_cols('nivel','integer');
		$this->var->add_def_cols('descripcion','text');		
		$this->var->add_def_cols('fk_id_metaproceso','integer');
		$this->var->add_def_cols('codigo_procedimiento','varchar');
		$this->var->add_def_cols('nombre_achivo','varchar');
		$this->var->add_def_cols('ruta_archivo','text');
		$this->var->add_def_cols('visible','varchar');
		$this->var->add_def_cols('orden_logico','integer');		
		$this->var->add_def_cols('icono','varchar');		

		//Ejecuta la funci�n de consulta
		$res = $this ->var->exec_query_sss();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//echo "sql: ".$this->var->query;
		return $res;
	}
	
	
	function ListaPermisoArb($id_usuario,$id_rol,$ip_origen,$mac_maquina,$nivel,$id_metaproceso_padre){
		
		
		$this->salida ="";
		$this->nombre_funcion = 'f_sg_privilegios_usuario_arb';
		$this->codigo_procedimiento = "'SG_MET_PRO_SEL'";

		$func = new cls_funciones();
		
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento);

		//Carga los par�metros espec�fos
        $this->var->add_param($func->iif($id_usuario == '','NULL',"'$id_usuario'"));//id_usuario
        $this->var->add_param($func->iif($id_usuario == '','NULL',"'$id_rol'"));//id_rol
        $this->var->add_param($func->iif($ip_origen == '','NULL',"'$ip_origen'"));//ip_origen
		$this->var->add_param($func->iif($mac_maquina == '','NULL',"'$mac_maquina'"));//mac_maquina
		$this->var->add_param("'$nivel'");//nivel
		$this->var->add_param("'$id_metaproceso_padre'");//nivel
						
		//Carga la definici�n de columnas con sus tipos de datos		
		$this->var->add_def_cols('id_metaproceso','integer');
		$this->var->add_def_cols('nombre','text');		
		$this->var->add_def_cols('nivel','integer');
		$this->var->add_def_cols('descripcion','text');		
		$this->var->add_def_cols('fk_id_metaproceso','integer');
		$this->var->add_def_cols('codigo_procedimiento','varchar');
		$this->var->add_def_cols('nombre_achivo','varchar');
		$this->var->add_def_cols('ruta_archivo','text');
		$this->var->add_def_cols('visible','varchar');
		$this->var->add_def_cols('orden_logico','integer');		
		$this->var->add_def_cols('icono','varchar');
		$this->var->add_def_cols('clase_vista','varchar');

		//Ejecuta la funci�n de consulta
		//echo "LLEGA LLEGA ".$this ->query; exit;
		$res = $this ->var->exec_query_sss();
		
		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;
		//echo "sql: ".$this->var->query;
		return $res;
	}
	
}?>