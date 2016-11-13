<?php
/**
 * Nombre de la clase:	cls_DBGestion.php
 * Prop�sito:			Permite ejecutar toda la funcionalidad de la tabla tct_tct_gestion
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-12-01 14:49:31
 */
 
 
class cls_DBENDESIS
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
	

	
	
	function TTSIntegracionRendicionCaja($id_caja,$id_caja_aux,$id_caja_auxiliar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_ct_i_integracionENDESIS';
		$this->codigo_procedimiento = "'CT_INT_REN_CAJ'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_caja);
		$this->var->add_param($id_caja_aux);
		$this->var->add_param($id_caja_auxiliar);
 
 
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
/*	echo $this->query;
		 exit();*/
		return $res;
	}
	
	function TTSIntegracionSolicitudFondos($id_avance,$id_caja_aux,$id_caja_auxiliar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_ct_i_integracionENDESIS';
		$this->codigo_procedimiento = "'CT_INT_SOLICITUD_FONDOS'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance);
		$this->var->add_param($id_caja_aux);
		$this->var->add_param($id_caja_auxiliar);
 
 
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		exit();*/
		return $res;
	}
	
	function TTSIntegracionDescargo($id_avance,$id_caja_aux,$id_caja_auxiliar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_ct_i_integracionENDESIS';
		$this->codigo_procedimiento = "'CT_INT_DESCARGO'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_avance);
		$this->var->add_param($id_caja_aux);
		$this->var->add_param($id_caja_auxiliar);
 
 
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		exit();*/
		return $res;
	}	
	
	function TTSIntegracionViatico($id_viatico,$id_caja_aux,$id_caja_auxiliar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_ct_i_integracionENDESIS';
		$this->codigo_procedimiento = "'CT_INT_VIATICO'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_viatico);
		$this->var->add_param($id_caja_aux);
		$this->var->add_param($id_caja_auxiliar);
 
 
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo $this->query;
		exit();*/
		
		return $res;
	}
	
	function TTSIntegracionViaticoRendicion($id_viatico,$id_caja_aux,$id_caja_auxiliar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_ct_i_integracionENDESIS';
		$this->codigo_procedimiento = "'CT_INT_VIATICO_RENDICION'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_viatico);
		$this->var->add_param($id_caja_aux);
		$this->var->add_param($id_caja_auxiliar); 
 
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo $this->query;
		exit();*/
		
		return $res;
	}
	
	function TTSIntegracionViaticoFinalizacion($id_viatico,$id_caja_aux,$id_caja_auxiliar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_ct_i_integracionENDESIS';
		$this->codigo_procedimiento = "'CT_INT_VIATICO_FINALIZACION'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_viatico);
		$this->var->add_param($id_caja_aux);
		$this->var->add_param($id_caja_auxiliar);
 
 
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo $this->query;
		exit();*/
		
		return $res;
	}
	
	function TTSIntegracionValesCaja($id_caja_regis,$id_caja_aux,$id_caja_auxiliar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_ct_i_integracionENDESIS';
		$this->codigo_procedimiento = "'CT_INT_VALES_CAJA'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_caja_regis);
		$this->var->add_param($id_caja_aux);
		$this->var->add_param($id_caja_auxiliar);
 
 
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo $this->query;
		exit();*/
		 
		return $res;
	}
	
	function TTSIntegracionDevengarServicios($id_devengado,$id_caja_aux,$id_caja_auxiliar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_ct_i_integracionENDESIS';
		$this->codigo_procedimiento = "'CT_INT_DEVENGADO'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_devengado);
		$this->var->add_param($id_caja_aux);
		$this->var->add_param($id_caja_auxiliar);
 
 
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		 exit();*/
		return $res;
	}
	
	function TTSIntegracionPagoDevengado($id_devengado,$id_caja_aux,$id_caja_auxiliar)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_ct_i_integracionENDESIS';
		$this->codigo_procedimiento = "'CT_INT_PAGO_DEVENGADO'";

		//Instancia la clase midlle para la ejecuci�n de la funci�n de la BD
		$this->var = new cls_middle($this->nombre_funcion,$this->codigo_procedimiento,$this->decodificar);
		$this->var->add_param($id_devengado);
		$this->var->add_param($id_caja_aux);
		$this->var->add_param($id_caja_auxiliar);
 
 
		//Ejecuta la funci�n
		$res = $this->var->exec_non_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		/*echo $this->query;
		 exit();*/
		return $res;
	}
	
}?>