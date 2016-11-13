<?php
/**
 * Nombre de la Clase:	    CustomDBKardexPersonal
 * Prop�sito:				Es la interfaz del modelo del Sistema de Kardex de Personal
 * todos los metodos existentes pasan por aqui
 * Fecha de Creaci�n:		21-06-2007
 * Autor:					Rodrigo Chumacero Moscoso
 *
 */
class cls_CustomDBKardexPersonal
{
	//variable que contiene la salida de la ejecuci�n de la funci�n
	//si la funci�n tuvo error (false), salida contendr� el mensaje de error
	//si la funci�n no tuvo error (true), salida contendr� el resultado, ya sea un conjunto de datos o un mensaje de confirmaci�n
	var $salida = "";

	//Variable que contedr� la cadena de llamada a las funciones postgres
	var $query = "";

	//Bandera que indica si los datos se decodificar�n o no
	var $decodificar = false;

	function __construct()
	{
		include_once("cls_DBEmpleado.php");
		include_once("cls_DBEmpleadoCta.php");
		include_once("cls_DBEmpleadoTpmFrppa.php");
		include_once("cls_DBEmpleadoExtension.php");
		include_once("cls_DBUnidadOrganizacional.php");
		include_once("cls_DBUnidadOrganizacionalArb.php");
		include_once("cls_DBNivelOrganizacional.php");
		include_once("cls_DBHistoricoAsignacion.php"); 
		include_once("cls_DBEmpleadoHorario.php");
		include_once("cls_DBHorario.php");
		include_once("cls_DBTipoHorario.php");
		include_once("cls_DBEmpleadoTrabajo.php");
		include_once("cls_DBTipoCapacitacion.php");
		include_once("cls_DBEmpleadoCapacitacion.php");
		
		
		include_once("cls_DBSeguro.php");
		include_once("cls_DBAfp.php");
		include_once("cls_DBEmpleadoAfp.php");
		include_once("cls_DBEmpleadoSeguro.php");
		include_once("cls_DBParametroKardex.php");
		include_once("cls_DBContrato.php");
		include_once("cls_DBEmpleadoCtaBancaria.php");
		include_once("cls_DBUnidadOrganizacionalDiagrama.php");
		include_once("cls_DBTipoDescuentoBono.php");
		include_once("cls_DBDescuentoBono.php");
		include_once("cls_DBTipoPlanilla.php");
		include_once("cls_DBColumna.php");
		
		include_once("cls_DBEmpleadoPlanilla.php");
		
		include_once("cls_DBColumnaValor.php");
		include_once("cls_DBRepPlanilla.php");
		include_once("cls_DBPlanillaPresupuesto.php");
		include_once("cls_DBTipoColumna.php");
		include_once("cls_DBResumenHorarioMes.php");
		include_once("cls_DBEscalaSalarial.php");
		include_once("cls_DBColumnaPartidaEjecucion.php");
		
		
		include_once("cls_DBParametroCostoPlanilla.php");
		
		//
		include_once("cls_DBParametroCuentaAuxiliar.php");
		include_once("cls_DBTipoObligacion.php"); 
		//include_once("cls_DBUnidadOrganizacionalDiagrama.php");
		include_once("cls_DBVacacion.php");
		include_once("cls_DBCategoriaVacacion.php");
		//include_once("cls_DBTipoHorario.php");
		include_once("cls_DBRelacionFamiliar.php"); 
		include_once("cls_DBPlanillaK.php");
		include_once("cls_DBObligacion.php"); 
		include_once("cls_DBFactoresKardex.php");
		include_once("cls_DBTipoColumnaBase.php");
		include_once("cls_DBRepObligacion.php");
		include_once("../../../sis_contabilidad/modelo/cls_DBXlsCsv.php");
		include_once("cls_DBRepEmpleado.php");
		include_once("cls_DBRepEmpleadoAFP.php");
		include_once("cls_DBCompensacion.php");
		include_once("cls_DBTarjeta.php");
		include_once("cls_DBPlanillaTrimestral.php");
		
		//13feb12
		include_once("cls_DBEmpleadoPpto.php");
		
		
		//06.2014
		include_once("cls_DBClasificadorRetenciones.php");

		//09.05.2014
		include_once("cls_DBTipoContrato.php");
		include_once("cls_DBCargo.php");
	}

	/////////////// EMPLEADO/////////////////////
	function ListarEmpleado($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ListarEmpleado($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado->salida;
		$this->query = $dbEmpleado->query;
		return $res;
	}
	function ContarListaEmpleado($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado= new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ContarListaEmpleado($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado->salida;
		$this->query = $dbEmpleado->query;
		return $res;
	}

	//Listado de Empleado para usar en reportes

	function ListarEmpleadoRep($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ListarEmpleadoRep($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado->salida;
		$this->query = $dbEmpleado->query;
		return $res;
	}
	function ContarListaEmpleadoRep($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado= new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ContarListaEmpleadoRep($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado->salida;
		$this->query = $dbEmpleado->query;
		return $res;
	}

	/////////////   FIN EMPLEADO /////////////////////////////

	///////////////////////////////////////////////////////////////////
	//////////////�LTIMA VERSI�N EMPLEADO (AUTOGENERADO)///////////////
	///////////////////////////////////////////////////////////////////


	/// --------------------- tkp_empleado --------------------- ///

	function ListarEmpleado_($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ListarEmpleado_($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}
	function ListarFuncionario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ListarFuncionario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}
	function ListarEmpleadoGerencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ListarEmpleadoGerencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}
	function ListarEmpleadoEP($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ListarEmpleadoEP($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}

	function ContarEmpleado($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ContarEmpleado($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}
	function ContarFuncionario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ContarFuncionario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}
	function ContarEmpleadoGerencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ContarEmpleadoGerencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}
	function ContarEmpleadoEP($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ContarEmpleadoEP($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}

	function ListarEmpleadoUsuarioEP($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ListarEmpleadoUsuarioEP($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}
	function ContarEmpleadoUsuarioEP($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ContarEmpleadoUsuarioEP($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}
	function ListarEmpleadoLicencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ListarEmpleadoLicencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado->salida;
		$this->query = $dbEmpleado->query;
		return $res;
	}
	function ContarEmpleadoLicencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado= new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ContarEmpleadoLicencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado->salida;
		$this->query = $dbEmpleado->query;
		return $res;
	}
	function InsertarEmpleado($id_empleado,$id_persona,$codigo_empleado,$id_cuenta,$id_auxiliar,$estado_reg,$fecha_reg,$id_depto,$id_lugar,$fecha_ingreso,$antiguedad_ant,$id_escala_salarial,$compensa,$marca
	,$nivel_academico,$tiene_descuento
	)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->InsertarEmpleado($id_empleado,$id_persona,$codigo_empleado,$id_cuenta,$id_auxiliar,$estado_reg,$fecha_reg,$id_depto,$id_lugar,$fecha_ingreso,$antiguedad_ant,$id_escala_salarial,$compensa,$marca
		,$nivel_academico,$tiene_descuento
		);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}

	function ModificarEmpleado($id_empleado,$id_persona,$codigo_empleado,$id_cuenta,$id_auxiliar,$estado_reg,$fecha_reg,$id_depto,$id_lugar,$fecha_ingreso,$antiguedad_ant,$id_escala_salarial,$compensa,$marca
	,$nivel_academico,$tiene_descuento
	)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ModificarEmpleado($id_empleado,$id_persona,$codigo_empleado,$id_cuenta,$id_auxiliar,$estado_reg,$fecha_reg,$id_depto,$id_lugar,$fecha_ingreso,$antiguedad_ant,$id_escala_salarial,$compensa,$marca
		,$nivel_academico,$tiene_descuento
		);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}

	function EliminarEmpleado($id_empleado)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado -> EliminarEmpleado($id_empleado);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}

	function ValidarEmpleado($operacion_sql,$id_empleado,$id_persona,$codigo_empleado,$id_cuenta,$id_auxiliar,$estado_reg,$fecha_reg)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ValidarEmpleado($operacion_sql,$id_empleado,$id_persona,$codigo_empleado,$id_cuenta,$id_auxiliar,$estado_reg,$fecha_reg);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}

	
	function ListarEmpleados($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ListarEmpleados($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}
	
	
	function ContarEmpleados($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ContarEmpleados($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}
	
	function InsertarEmpleadoSuplente($id_empleado,$id_empleado_suplente,$subsis,$vista)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->InsertarEmpleadoSuplente($id_empleado,$id_empleado_suplente,$subsis,$vista);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}
	
	function ListarSelPersonal($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ListarSelPersonal($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}

	function ContarSelPersonal($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ContarSelPersonal($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}
	
	
	
	/****************04nov11: informar de cambios en asignacion de funcionarios******************/
	function ListarInformacionEmpleadoMail($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ListarInformacionEmpleadoMail($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}
	//asignar correo a funcionario
	function ModificarEmpleadoCorreo($id_empleado,$mail)
	{
		$this->salida = "";
		$dbEmpleado = new cls_DBEmpleado($this->decodificar);
		$res = $dbEmpleado ->ModificarEmpleadoCorreo($id_empleado,$mail);
		$this->salida = $dbEmpleado ->salida;
		$this->query = $dbEmpleado ->query;
		return $res;
	}
	
	/// --------------------- fin tkp_empleado --------------------- ///


	////////////// FIN EMPLEADO////////////////////////////

/// --------------------- tkp_empleado_cta --------------------- ///
	function ListarEmpleadoCta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoCta = new cls_DBEmpleadoCta($this->decodificar);
		$res = $dbEmpleadoCta ->ListarEmpleadoCta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoCta ->salida;
		$this->query = $dbEmpleadoCta ->query;
		return $res;
	}
	function ContarEmpleadoCta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoCta = new cls_DBEmpleadoCta($this->decodificar);
		$res = $dbEmpleadoCta ->ContarEmpleadoCta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoCta ->salida;
		$this->query = $dbEmpleadoCta ->query;
		return $res;
	}
	function InsertarEmpleadoCta($id_empleado_cta,$id_empleado,$id_gestion,$id_cuenta,$id_auxiliar,$estado_reg,$id_cuenta_cobrar)
	{
		$this->salida = "";
		$dbEmpleadoCta = new cls_DBEmpleadoCta($this->decodificar);
		$res = $dbEmpleadoCta ->InsertarEmpleadoCta($id_empleado_cta,$id_empleado,$id_gestion,$id_cuenta,$id_auxiliar,$estado_reg,$id_cuenta_cobrar);
		$this->salida = $dbEmpleadoCta ->salida;
		$this->query = $dbEmpleadoCta ->query;
		return $res;
	}

	function ModificarEmpleadoCta($id_empleado_cta,$id_empleado,$id_gestion,$id_cuenta,$id_auxiliar,$estado_reg,$id_cuenta_cobrar)
	{
		$this->salida = "";
		$dbEmpleadoCta = new cls_DBEmpleadoCta($this->decodificar);
		$res = $dbEmpleadoCta ->ModificarEmpleadoCta($id_empleado_cta,$id_empleado,$id_gestion,$id_cuenta,$id_auxiliar,$estado_reg,$id_cuenta_cobrar);
		$this->salida = $dbEmpleadoCta ->salida;
		$this->query = $dbEmpleadoCta ->query;
		return $res;
	}

	function EliminarEmpleadoCta($id_empleado_cta)
	{
		$this->salida = "";
		$dbEmpleadoCta = new cls_DBEmpleadoCta($this->decodificar);
		$res = $dbEmpleadoCta -> EliminarEmpleadoCta($id_empleado_cta);
		$this->salida = $dbEmpleadoCta ->salida;
		$this->query = $dbEmpleadoCta ->query;
		return $res;
	}

	function ValidarEmpleadoCta($operacion_sql,$id_empleado_cta,$id_empleado,$id_gestion,$id_cuenta,$id_auxiliar,$estado_reg)
	{
		$this->salida = "";
		$dbEmpleadoCta = new cls_DBEmpleadoCta($this->decodificar);
		$res = $dbEmpleadoCta ->ValidarEmpleadoCta($operacion_sql,$id_empleado_cta,$id_empleado,$id_gestion,$id_cuenta,$id_auxiliar,$estado_reg);
		$this->salida = $dbEmpleadoCta ->salida;
		$this->query = $dbEmpleadoCta ->query;
		return $res;
	}
	/// --------------------- fin tkp_empleado_cta --------------------- ///

	/// --------------------- tkp_empleado_tpm_frppa --------------------- ///

	function ListarEmpleadoTpmFrppa($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoTpmFrppa = new cls_DBEmpleadoTpmFrppa($this->decodificar);
		$res = $dbEmpleadoTpmFrppa ->ListarEmpleadoTpmFrppa($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoTpmFrppa ->salida;
		$this->query = $dbEmpleadoTpmFrppa ->query;
		return $res;
	}

	function ContarEmpleadoTpmFrppa($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoTpmFrppa = new cls_DBEmpleadoTpmFrppa($this->decodificar);
		$res = $dbEmpleadoTpmFrppa ->ContarEmpleadoTpmFrppa($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoTpmFrppa ->salida;
		$this->query = $dbEmpleadoTpmFrppa ->query;
		return $res;
	}

	function InsertarEmpleadoTpmFrppa($id_empleado_frppa,$id_empleado,$fecha_registro,$hora_ingreso,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$estado_reg)
	{
		$this->salida = "";
		$dbEmpleadoTpmFrppa = new cls_DBEmpleadoTpmFrppa($this->decodificar);
		$res = $dbEmpleadoTpmFrppa ->InsertarEmpleadoTpmFrppa($id_empleado_frppa,$id_empleado,$fecha_registro,$hora_ingreso,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$estado_reg);
		$this->salida = $dbEmpleadoTpmFrppa ->salida;
		$this->query = $dbEmpleadoTpmFrppa ->query;
		return $res;
	}

	function ModificarEmpleadoTpmFrppa($id_empleado_frppa,$id_empleado,$fecha_registro,$hora_ingreso,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$estado_reg)
	{
		$this->salida = "";
		$dbEmpleadoTpmFrppa = new cls_DBEmpleadoTpmFrppa($this->decodificar);
		$res = $dbEmpleadoTpmFrppa ->ModificarEmpleadoTpmFrppa($id_empleado_frppa,$id_empleado,$fecha_registro,$hora_ingreso,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$estado_reg);
		$this->salida = $dbEmpleadoTpmFrppa ->salida;
		$this->query = $dbEmpleadoTpmFrppa ->query;
		return $res;
	}

	function EliminarEmpleadoTpmFrppa($id_empleado_frppa)
	{
		$this->salida = "";
		$dbEmpleadoTpmFrppa = new cls_DBEmpleadoTpmFrppa($this->decodificar);
		$res = $dbEmpleadoTpmFrppa -> EliminarEmpleadoTpmFrppa($id_empleado_frppa);
		$this->salida = $dbEmpleadoTpmFrppa ->salida;
		$this->query = $dbEmpleadoTpmFrppa ->query;
		return $res;
	}

	
	function ListarEmpleadoUsuarioTpmFrppa($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoTpmFrppa = new cls_DBEmpleadoTpmFrppa($this->decodificar);
		$res = $dbEmpleadoTpmFrppa ->ListarEmpleadoUsuarioTpmFrppa($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoTpmFrppa ->salida;
		$this->query = $dbEmpleadoTpmFrppa ->query;
		return $res;
	}

	function ContarEmpleadoUsuarioTpmFrppa($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoTpmFrppa = new cls_DBEmpleadoTpmFrppa($this->decodificar);
		$res = $dbEmpleadoTpmFrppa ->ContarEmpleadoUsuarioTpmFrppa($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoTpmFrppa ->salida;
		$this->query = $dbEmpleadoTpmFrppa ->query;
		return $res;
	}

	function ValidarEmpleadoTpmFrppa($operacion_sql,$id_empleado_frppa,$id_empleado,$fecha_registro,$hora_ingreso,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$estado_reg)
	{
		$this->salida = "";
		$dbEmpleadoTpmFrppa = new cls_DBEmpleadoTpmFrppa($this->decodificar);
		$res = $dbEmpleadoTpmFrppa ->ValidarEmpleadoTpmFrppa($operacion_sql,$id_empleado_frppa,$id_empleado,$fecha_registro,$hora_ingreso,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$estado_reg);
		$this->salida = $dbEmpleadoTpmFrppa ->salida;
		$this->query = $dbEmpleadoTpmFrppa ->query;
		return $res;
	}

	
		
	function ListarEPempleado($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEpeEmpleado= new cls_DBEmpleadoTpmFrppa($this->decodificar);
		$res = $dbEpeEmpleado->ListarEPempleado($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEpeEmpleado->salida;
		$this->query = $dbEpeEmpleado->query;
		return $res;
	}
	
	
	function ContarEPempleado($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEpeEmpleado = new cls_DBEmpleadoTpmFrppa($this->decodificar);
		$res = $dbEpeEmpleado->ContarEPempleado($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEpeEmpleado->salida;
		$this->query = $dbEpeEmpleado->query;
		return $res;
	}
	
	
	
	/// --------------------- fin tkp_empleado_tpm_frppa --------------------- ///
	/// --------------------- tkp_empleado_extension --------------------- ///

	function ListarEmpleadoExtension($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoExtension = new cls_DBEmpleadoExtension($this->decodificar);
		$res = $dbEmpleadoExtension ->ListarEmpleadoExtension($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoExtension ->salida;
		$this->query = $dbEmpleadoExtension ->query;
		return $res;
	}
	
	function ContarEmpleadoExtension($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoExtension = new cls_DBEmpleadoExtension($this->decodificar);
		$res = $dbEmpleadoExtension ->ContarEmpleadoExtension($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoExtension ->salida;
		$this->query = $dbEmpleadoExtension ->query;
		return $res;
	}
	function ListarEmpleadoExtensionGerente($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoExtension = new cls_DBEmpleadoExtension($this->decodificar);
		$res = $dbEmpleadoExtension ->ListarEmpleadoExtensionGerente($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoExtension ->salida;
		$this->query = $dbEmpleadoExtension ->query;
		return $res;
	}
	
	function ContarEmpleadoExtensionGerente($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoExtension = new cls_DBEmpleadoExtension($this->decodificar);
		$res = $dbEmpleadoExtension ->ContarEmpleadoExtensionGerente($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoExtension ->salida;
		$this->query = $dbEmpleadoExtension ->query;
		return $res;
	}
	function InsertarEmpleadoExtension($id_empleado_extension,$codigo_telefonico,$id_empleado,$id_gerencia,$estado)
	{
		$this->salida = "";
		$dbEmpleadoExtension = new cls_DBEmpleadoExtension($this->decodificar);
		$res = $dbEmpleadoExtension ->InsertarEmpleadoExtension($id_empleado_extension,$codigo_telefonico,$id_empleado,$id_gerencia,$estado);
		$this->salida = $dbEmpleadoExtension ->salida;
		$this->query = $dbEmpleadoExtension ->query;
		return $res;
	}
	
	function ModificarEmpleadoExtension($id_empleado_extension,$codigo_telefonico,$id_empleado,$id_gerencia,$estado)
	{
		$this->salida = "";
		$dbEmpleadoExtension = new cls_DBEmpleadoExtension($this->decodificar);
		$res = $dbEmpleadoExtension ->ModificarEmpleadoExtension($id_empleado_extension,$codigo_telefonico,$id_empleado,$id_gerencia,$estado);
		$this->salida = $dbEmpleadoExtension ->salida;
		$this->query = $dbEmpleadoExtension ->query;
		return $res;
	}
	
	function EliminarEmpleadoExtension($id_empleado_extension)
	{
		$this->salida = "";
		$dbEmpleadoExtension = new cls_DBEmpleadoExtension($this->decodificar);
		$res = $dbEmpleadoExtension -> EliminarEmpleadoExtension($id_empleado_extension);
		$this->salida = $dbEmpleadoExtension ->salida;
		$this->query = $dbEmpleadoExtension ->query;
		return $res;
	}
	
	function ValidarEmpleadoExtension($operacion_sql,$id_empleado_extension,$codigo_telefonico,$id_empleado,$id_gerencia,$estado)
	{
		$this->salida = "";
		$dbEmpleadoExtension = new cls_DBEmpleadoExtension($this->decodificar);
		$res = $dbEmpleadoExtension ->ValidarEmpleadoExtension($operacion_sql,$id_empleado_extension,$codigo_telefonico,$id_empleado,$id_gerencia,$estado);
		$this->salida = $dbEmpleadoExtension ->salida;
		$this->query = $dbEmpleadoExtension ->query;
		return $res;
	}
	
	/// --------------------- fin tkp_empleado_extension --------------------- ///
	
	
	/// --------------------- tkp_unidad_organizacional --------------------- ///

	function ListarUnidadOrganizacional($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacional($this->decodificar);
		$res = $dbUnidadOrganizacional ->ListarUnidadOrganizacional($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	
	function ContarUnidadOrganizacional($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacional($this->decodificar);
		$res = $dbUnidadOrganizacional ->ContarUnidadOrganizacional($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	
	
	function ListarUnidadOrganizacionalCentro($id_empleado)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacional($this->decodificar);
		$res = $dbUnidadOrganizacional ->ListarUnidadOrganizacionalCentro($id_empleado);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	function InsertarUnidadOrganizacional($id_unidad_organizacional,$nombre_unidad,$nombre_cargo,$centro,$cargo_individual,$descripcion,$fecha_reg,$id_nivel_organizacional,$estado_reg)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacional($this->decodificar);
		$res = $dbUnidadOrganizacional ->InsertarUnidadOrganizacional($id_unidad_organizacional,$nombre_unidad,$nombre_cargo,$centro,$cargo_individual,$descripcion,$fecha_reg,$id_nivel_organizacional,$estado_reg);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	
	function ModificarUnidadOrganizacional($id_unidad_organizacional,$nombre_unidad,$nombre_cargo,$centro,$cargo_individual,$descripcion,$fecha_reg,$id_nivel_organizacional,$estado_reg)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacional($this->decodificar);
		$res = $dbUnidadOrganizacional ->ModificarUnidadOrganizacional($id_unidad_organizacional,$nombre_unidad,$nombre_cargo,$centro,$cargo_individual,$descripcion,$fecha_reg,$id_nivel_organizacional,$estado_reg);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	
	function EliminarUnidadOrganizacional($id_unidad_organizacional)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacional($this->decodificar);
		$res = $dbUnidadOrganizacional -> EliminarUnidadOrganizacional($id_unidad_organizacional);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	
	function ValidarUnidadOrganizacional($operacion_sql,$id_unidad_organizacional,$nombre_unidad,$nombre_cargo,$centro,$cargo_individual,$descripcion,$fecha_reg,$id_nivel_organizacional,$estado_reg)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacional($this->decodificar);
		$res = $dbUnidadOrganizacional ->ValidarUnidadOrganizacional($operacion_sql,$id_unidad_organizacional,$nombre_unidad,$nombre_cargo,$centro,$cargo_individual,$descripcion,$fecha_reg,$id_nivel_organizacional,$estado_reg);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	
	//RCM: 03/02/2009
	function ListarUnidadOrganizacionalEP($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacional($this->decodificar);
		$res = $dbUnidadOrganizacional ->ListarUnidadOrganizacionalEP($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	
	//RCM: 03/02/2009
	function ContarUnidadOrganizacionalEP($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacional($this->decodificar);
		$res = $dbUnidadOrganizacional ->ContarUnidadOrganizacionalEP($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	
	/// --------------------- fin tkp_unidad_organizacional --------------------- ///
	/// --------------------- tkp_unidad_organizacional_arb --------------------- ///
	
	function ListarUnidadOrganizacionalRaiz($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacionalArb($this->decodificar);
		$res = $dbUnidadOrganizacional ->ListarUnidadOrganizacionalRaiz($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	
	function ListarUnidadOrganizacionalArb($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$agrupador)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacionalArb($this->decodificar);
		$res = $dbUnidadOrganizacional ->ListarUnidadOrganizacionalArb($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$agrupador);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	function ContarUnidadOrganizacionalArb($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$raiz)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacionalArb($this->decodificar);
		$res = $dbUnidadOrganizacional ->ContarUnidadOrganizacionalArb($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$raiz);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	function InsertarUnidadOrganizacionalRaiz($id,$id_padre,$relacion,$observaciones,$nombre_unidad,$nombre_cargo,$centro,$cargo_individual,$descripcion,$id_nivel_organizacional,$id_padre_nuevo,$estado_reg,$importe_max_apro,$importe_max_pre)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacionalArb($this->decodificar);
		$res = $dbUnidadOrganizacional ->InsertarUnidadOrganizacionalRaiz($id,$id_padre,$relacion,$observaciones,$nombre_unidad,$nombre_cargo,$centro,$cargo_individual,$descripcion,$id_nivel_organizacional,$id_padre_nuevo,$estado_reg,$importe_max_apro,$importe_max_pre);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	
	function InsertarUnidadOrganizacionalArb($id,$id_padre,$relacion,$observaciones,$nombre_unidad,$nombre_cargo,$centro,$cargo_individual,$descripcion,$id_nivel_organizacional,$id_padre_nuevo,$estado_reg,$importe_max_apro,$importe_max_pre,$sw_presto,$prioridad,$area,$correspondencia)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacionalArb($this->decodificar);
		$res = $dbUnidadOrganizacional ->InsertarUnidadOrganizacionalArb($id,$id_padre,$relacion,$observaciones,$nombre_unidad,$nombre_cargo,$centro,$cargo_individual,$descripcion,$id_nivel_organizacional,$id_padre_nuevo,$estado_reg,$importe_max_apro,$importe_max_pre,$sw_presto,$prioridad,$area,$correspondencia);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	function ModificarUnidadOrganizacionalArb($id,$id_padre,$relacion,$observaciones,$nombre_unidad,$nombre_cargo,$centro,$cargo_individual,$descripcion,$id_nivel_organizacional,$id_padre_nuevo,$estado_reg,$importe_max_apro,$importe_max_pre,$sw_presto,$prioridad,$area,$correspondencia)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacionalArb($this->decodificar);
		$res = $dbUnidadOrganizacional ->ModificarUnidadOrganizacionalArb($id,$id_padre,$relacion,$observaciones,$nombre_unidad,$nombre_cargo,$centro,$cargo_individual,$descripcion,$id_nivel_organizacional,$id_padre_nuevo,$estado_reg,$importe_max_apro,$importe_max_pre,$sw_presto,$prioridad,$area,$correspondencia);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	function EliminarUnidadOrganizacionalArb($id,$id_padre)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacionalArb($this->decodificar);
		$res = $dbUnidadOrganizacional ->EliminarUnidadOrganizacionalArb($id,$id_padre);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	function EliminarUnidadOrganizacionalRaiz($id)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacionalArb($this->decodificar);
		$res = $dbUnidadOrganizacional ->EliminarUnidadOrganizacionalRaiz($id);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	function DragAndDrop($id,$id_padre,$id_padre_nuevo)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacionalArb($this->decodificar);
		$res = $dbUnidadOrganizacional ->DragAndDrop($id,$id_padre,$id_padre_nuevo);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	function ValidarUnidadOrganizacionalArb($id,$id_padre,$nombre_unidad,$nombre_cargo,$centro,$cargo_individual,$descripcion,$id_nivel_organizacional,$estado_reg)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacionalArb($this->decodificar);
		$res = $dbUnidadOrganizacional ->ValidarUnidadOrganizacionalArb($id,$id_padre,$nombre_unidad,$nombre_cargo,$centro,$cargo_individual,$descripcion,$id_nivel_organizacional,$estado_reg);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	

	function FiltrarOrganigramaArb($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$v_id)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacionalArb($this->decodificar);
		$res = $dbUnidadOrganizacional ->FiltrarOrganigramaArb($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$v_id);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	
	//4may12: Mercedes Zambrana
	function SubirArchivo($id_unidad_organizacional,$url_archivo,$extension)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBUnidadOrganizacionalArb($this->decodificar);
		$res = $dbUnidadOrganizacional ->SubirArchivo($id_unidad_organizacional,$url_archivo,$extension);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	
	/// --------------------- fin tkp_unidad_organizacional_arb --------------------- ///

	/// --------------------- tkp_nivel_organizacional --------------------- ///

	function ListarNivelOrganizacional($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbNivelOrganizacional = new cls_DBNivelOrganizacional($this->decodificar);
		$res = $dbNivelOrganizacional ->ListarNivelOrganizacional($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbNivelOrganizacional ->salida;
		$this->query = $dbNivelOrganizacional ->query;
		return $res;
	}
	
	function ContarNivelOrganizacional($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbNivelOrganizacional = new cls_DBNivelOrganizacional($this->decodificar);
		$res = $dbNivelOrganizacional ->ContarNivelOrganizacional($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbNivelOrganizacional ->salida;
		$this->query = $dbNivelOrganizacional ->query;
		return $res;
	}
	
	function InsertarNivelOrganizacional($id_nivel_organizacional,$nombre_nivel,$numero_nivel)
	{
		$this->salida = "";
		$dbNivelOrganizacional = new cls_DBNivelOrganizacional($this->decodificar);
		$res = $dbNivelOrganizacional ->InsertarNivelOrganizacional($id_nivel_organizacional,$nombre_nivel,$numero_nivel);
		$this->salida = $dbNivelOrganizacional ->salida;
		$this->query = $dbNivelOrganizacional ->query;
		return $res;
	}
	
	function ModificarNivelOrganizacional($id_nivel_organizacional,$nombre_nivel,$numero_nivel)
	{
		$this->salida = "";
		$dbNivelOrganizacional = new cls_DBNivelOrganizacional($this->decodificar);
		$res = $dbNivelOrganizacional ->ModificarNivelOrganizacional($id_nivel_organizacional,$nombre_nivel,$numero_nivel);
		$this->salida = $dbNivelOrganizacional ->salida;
		$this->query = $dbNivelOrganizacional ->query;
		return $res;
	}
	
	function EliminarNivelOrganizacional($id_nivel_organizacional)
	{
		$this->salida = "";
		$dbNivelOrganizacional = new cls_DBNivelOrganizacional($this->decodificar);
		$res = $dbNivelOrganizacional -> EliminarNivelOrganizacional($id_nivel_organizacional);
		$this->salida = $dbNivelOrganizacional ->salida;
		$this->query = $dbNivelOrganizacional ->query;
		return $res;
	}
	
	function ValidarNivelOrganizacional($operacion_sql,$id_nivel_organizacional,$nombre_nivel,$numero_nivel)
	{
		$this->salida = "";
		$dbNivelOrganizacional = new cls_DBNivelOrganizacional($this->decodificar);
		$res = $dbNivelOrganizacional ->ValidarNivelOrganizacional($operacion_sql,$id_nivel_organizacional,$nombre_nivel,$numero_nivel);
		$this->salida = $dbNivelOrganizacional ->salida;
		$this->query = $dbNivelOrganizacional ->query;
		return $res;
	}
	
	/// --------------------- fin tkp_nivel_organizacional --------------------- ///
		/// --------------------- tkp_historico_asignacion --------------------- ///

	function ListarHistoricoAsignacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbHistoricoAsignacion = new cls_DBHistoricoAsignacion($this->decodificar);
		$res = $dbHistoricoAsignacion ->ListarHistoricoAsignacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbHistoricoAsignacion ->salida;
		$this->query = $dbHistoricoAsignacion ->query;
		return $res;
	}
	
	function ContarHistoricoAsignacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbHistoricoAsignacion = new cls_DBHistoricoAsignacion($this->decodificar);
		$res = $dbHistoricoAsignacion ->ContarHistoricoAsignacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbHistoricoAsignacion ->salida;
		$this->query = $dbHistoricoAsignacion ->query;
		return $res;
	}
	
function InsertarHistoricoAsignacion($id_historico_asignacion,$fecha_asignacion,$estado,$id_unidad_organizacional,$id_empleado,$fecha_finalizacion,$id_empleado_suplente
	,$id_lugar
	//19.05.2014
	,$id_cargo,$id_tipo_contrato,$tipo_registro
	)
	{
		$this->salida = "";
		$dbHistoricoAsignacion = new cls_DBHistoricoAsignacion($this->decodificar);
		$res = $dbHistoricoAsignacion ->InsertarHistoricoAsignacion($id_historico_asignacion,$fecha_asignacion,$estado,$id_unidad_organizacional,$id_empleado,$fecha_finalizacion,$id_empleado_suplente
		,$id_lugar
		//19.05.2014
		,$id_cargo,$id_tipo_contrato,$tipo_registro
		);
		$this->salida = $dbHistoricoAsignacion ->salida;
		$this->query = $dbHistoricoAsignacion ->query;
		return $res;
	}
	
	function ModificarHistoricoAsignacion($id_historico_asignacion,$fecha_asignacion,$estado,$id_unidad_organizacional,$id_empleado,$fecha_finalizacion,$id_empleado_suplente
	,$id_lugar
	//19.05.2014
	,$id_cargo,$id_tipo_contrato,$tipo_registro
	)
	{
		$this->salida = "";
		$dbHistoricoAsignacion = new cls_DBHistoricoAsignacion($this->decodificar);
		$res = $dbHistoricoAsignacion ->ModificarHistoricoAsignacion($id_historico_asignacion,$fecha_asignacion,$estado,$id_unidad_organizacional,$id_empleado,$fecha_finalizacion,$id_empleado_suplente
		,$id_lugar
		//19.05.2014
		,$id_cargo,$id_tipo_contrato,$tipo_registro
		);
		$this->salida = $dbHistoricoAsignacion ->salida;
		$this->query = $dbHistoricoAsignacion ->query;
		return $res;
	}
	
	function EliminarHistoricoAsignacion($id_historico_asignacion)
	{
		$this->salida = "";
		$dbHistoricoAsignacion = new cls_DBHistoricoAsignacion($this->decodificar);
		$res = $dbHistoricoAsignacion -> EliminarHistoricoAsignacion($id_historico_asignacion);
		$this->salida = $dbHistoricoAsignacion ->salida;
		$this->query = $dbHistoricoAsignacion ->query;
		return $res;
	}
	
	function ValidarHistoricoAsignacion($operacion_sql,$id_historico_asignacion,$fecha_asignacion,$estado,$id_unidad_organizacional,$id_empleado,$fecha_finalizacion)
	{
		$this->salida = "";
		$dbHistoricoAsignacion = new cls_DBHistoricoAsignacion($this->decodificar);
		$res = $dbHistoricoAsignacion ->ValidarHistoricoAsignacion($operacion_sql,$id_historico_asignacion,$fecha_asignacion,$estado,$id_unidad_organizacional,$id_empleado,$fecha_finalizacion);
		$this->salida = $dbHistoricoAsignacion ->salida;
		$this->query = $dbHistoricoAsignacion ->query;
		return $res;
	}
	
	/// --------------------- fin tkp_historico_asignacion --------------------- ///
	/// --------------------- Relacion Familiar --------------------- ///

	function ListarRelacionFamiliar($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRelacionFamiliar = new cls_DBRelacionFamiliar($this->decodificar);
		$res = $dbRelacionFamiliar ->ListarRelacionFamiliar($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRelacionFamiliar ->salida;
		$this->query = $dbRelacionFamiliar ->query;
		return $res;
	}
  
	function ContarRelacionFamiliar($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRelacionFamiliar = new cls_DBRelacionFamiliar($this->decodificar);
		$res = $dbRelacionFamiliar ->ContarRelacionFamiliar($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRelacionFamiliar ->salida;
		$this->query = $dbRelacionFamiliar ->query;
		return $res;
	}

	function InsertarRelacionFamiliar($id_relacion_familiar,$id_empleado,$id_persona,$id_institucion,$relacion)
	{
		$this->salida = "";
		$dbRelacionFamiliar = new cls_DBRelacionFamiliar($this->decodificar);
		$res = $dbRelacionFamiliar ->InsertarRelacionFamiliar($id_relacion_familiar,$id_empleado,$id_persona,$id_institucion,$relacion);
		$this->salida = $dbRelacionFamiliar ->salida;
		$this->query = $dbRelacionFamiliar ->query;
		return $res;
	}
	

	function ModificarRelacionFamiliar($id_relacion_familiar,$id_empleado,$id_persona,$id_institucion,$relacion)
	{
		$this->salida = "";
		$dbRelacionFamiliar = new cls_DBRelacionFamiliar($this->decodificar);
		$res = $dbRelacionFamiliar ->ModificarRelacionFamiliar($id_relacion_familiar,$id_empleado,$id_persona,$id_institucion,$relacion);
		$this->salida = $dbRelacionFamiliar ->salida;
		$this->query = $dbRelacionFamiliar ->query;
		return $res;
	}

	function EliminarRelacionFamiliar($id_relacion_familiar)
	{
		$this->salida = "";
		$dbRelacionFamiliar = new cls_DBRelacionFamiliar($this->decodificar);
		$res = $dbRelacionFamiliar -> EliminarRelacionFamiliar($id_relacion_familiar);
		$this->salida = $dbRelacionFamiliar ->salida;
		$this->query = $dbRelacionFamiliar ->query;
		return $res;
	}

	function ValidarRelacionFamiliar($operacion_sql,$id_persona,$apellido_paterno,$apellido_materno,$nombre,$fecha_nacimiento,$foto_persona,$doc_id,$genero,$casilla,$telefono1,$telefono2,$celular1,$celular2,$pag_web,$email1,$email2,$email3,$fecha_registro,$hora_registro,$fecha_ultima_modificacion,$hora_ultima_modificacion,$observaciones,$id_tipo_doc_identificacion)
	{
		$this->salida = "";
		$dbRelacionFamiliar = new cls_DBRelacionFamiliar($this->decodificar);
		$res = $dbRelacionFamiliar ->ValidarRelacionFamiliar($operacion_sql,$id_persona,$apellido_paterno,$apellido_materno,$nombre,$fecha_nacimiento,$foto_persona,$doc_id,$genero,$casilla,$telefono1,$telefono2,$celular1,$celular2,$pag_web,$email1,$email2,$email3,$fecha_registro,$hora_registro,$fecha_ultima_modificacion,$hora_ultima_modificacion,$observaciones,$id_tipo_doc_identificacion);
		$this->salida = $dbRelacionFamiliar ->salida;
		$this->query = $dbRelacionFamiliar ->query;
		return $res;
	}

	/// --------------------- fin relacion_familiar --------------------- ///
	/// --------------------- tkp_tipo_columna --------------------- ///

	function ListarColumnaTipo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbTipoColumna = new cls_DBTipoColumna($this->decodificar);
		$res = $dbTipoColumna ->ListarColumnaTipo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbTipoColumna ->salida;
		$this->query = $dbTipoColumna ->query;
		return $res;
	}
	
	function ContarColumnaTipo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbTipoColumna = new cls_DBTipoColumna($this->decodificar);
		$res = $dbTipoColumna ->ContarColumnaTipo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbTipoColumna ->salida;
		$this->query = $dbTipoColumna ->query;
		return $res;
	}
	
	function InsertarColumnaTipo($id_columna_tipo,$id_parametro_kardex,$id_partida,$nombre,$valor,$tipo_dato,$id_moneda,$tipo_aporte,$estado_reg,$fecha_reg,$cotizable,$descripcion,$descuento_incremento,$observacion,$formula,$id_tipo_descuento_bono,$codigo,$id_cuenta_pasivo,$id_auxiliar_pasivo,$compromete,$id_tipo_columna_base)
	{
		$this->salida = "";
		$dbTipoColumna = new cls_DBTipoColumna($this->decodificar);
		$res = $dbTipoColumna ->InsertarColumnaTipo($id_columna_tipo,$id_parametro_kardex,$id_partida,$nombre,$valor,$tipo_dato,$id_moneda,$tipo_aporte,$estado_reg,$fecha_reg,$cotizable,$descripcion,$descuento_incremento,$observacion,$formula,$id_tipo_descuento_bono,$codigo,$id_cuenta_pasivo,$id_auxiliar_pasivo,$compromete,$id_tipo_columna_base);
		$this->salida = $dbTipoColumna ->salida;
		$this->query = $dbTipoColumna ->query;
		return $res;
	}
	
	function ModificarColumnaTipo($id_columna_tipo,$id_parametro_kardex,$id_partida,$nombre,$valor,$tipo_dato,$id_moneda,$tipo_aporte,$estado_reg,$fecha_reg,$cotizable,$descripcion,$descuento_incremento,$observacion,$formula,$id_tipo_descuento_bono,$codigo,$id_cuenta_pasivo,$id_auxiliar_pasivo,$compromete,$id_tipo_columna_base,$movimiento_contable,$prorratea)
	{
		$this->salida = "";
		$dbTipoColumna = new cls_DBTipoColumna($this->decodificar);
		$res = $dbTipoColumna ->ModificarColumnaTipo($id_columna_tipo,$id_parametro_kardex,$id_partida,$nombre,$valor,$tipo_dato,$id_moneda,$tipo_aporte,$estado_reg,$fecha_reg,$cotizable,$descripcion,$descuento_incremento,$observacion,$formula,$id_tipo_descuento_bono,$codigo,$id_cuenta_pasivo,$id_auxiliar_pasivo,$compromete,$id_tipo_columna_base,$movimiento_contable,$prorratea);
		$this->salida = $dbTipoColumna ->salida;
		$this->query = $dbTipoColumna ->query;
		return $res;
	}
	
	function EliminarColumnaTipo($id_columna_tipo)
	{
		$this->salida = "";
		$dbTipoColumna = new cls_DBTipoColumna($this->decodificar);
		$res = $dbTipoColumna -> EliminarColumnaTipo($id_columna_tipo);
		$this->salida = $dbTipoColumna ->salida;
		$this->query = $dbTipoColumna ->query;
		return $res;
	}
	
	function ValidarColumnaTipo($operacion_sql,$id_columna_tipo,$id_parametro_kardex,$id_partida,$nombre,$valor,$tipo_dato,$id_moneda,$tipo_aporte,$estado_reg,$fecha_reg,$cotizable,$descripcion,$descuento_incremento,$observacion,$formula,$movimiento_contable,$prorratea)
	{
		$this->salida = "";
		$dbTipoColumna = new cls_DBTipoColumna($this->decodificar);
		$res = $dbTipoColumna ->ValidarColumnaTipo($operacion_sql,$id_columna_tipo,$id_parametro_kardex,$id_partida,$nombre,$valor,$tipo_dato,$id_moneda,$tipo_aporte,$estado_reg,$fecha_reg,$cotizable,$descripcion,$descuento_incremento,$observacion,$formula,$movimiento_contable,$prorratea);
		$this->salida = $dbTipoColumna ->salida;
		$this->query = $dbTipoColumna ->query;
		return $res;
	}
	
	/// --------------------- fin tkp_tipo_columna --------------------- ///
	
/// --------------------- tkp_horario --------------------- ///

	function ListarHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbHorario = new cls_DBHorario($this->decodificar);
		$res = $dbHorario ->ListarHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbHorario ->salida;
		$this->query = $dbHorario ->query;
		return $res;
	}
	
	function ContarListaHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbHorario = new cls_DBHorario($this->decodificar);
		$res = $dbHorario ->ContarListaHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbHorario ->salida;
		$this->query = $dbHorario ->query;
		return $res;
	}
	function AprobarSolicitudLicenciaDet($id_vacacion,$id_tipo_horario,$id_empleado,$id_empleado_aprobacion,$tipo,$num_solicitud)
	{
		$this->salida = "";
		$dbHorario = new cls_DBHorario($this->decodificar);
		$res = $dbHorario -> AprobarSolicitudLicenciaDet($id_vacacion,$id_tipo_horario,$id_empleado,$id_empleado_aprobacion,$tipo,$num_solicitud);
		$this->salida = $dbHorario ->salida;
		$this->query = $dbHorario ->query;
		return $res;
	}
	function FinalizaSolicitudLicencia($id_horario,$tipo)
	{
		$this->salida = "";
		$dbHorario = new cls_DBHorario($this->decodificar);
		$res = $dbHorario -> FinalizaSolicitudLicencia($id_horario,$tipo);
		$this->salida = $dbHorario ->salida;
		$this->query = $dbHorario ->query;
		return $res;
	}
	function InsertarHorario($id_horario,$id_tipo_horario,$id_vacacion,$fecha_inicio,$fecha_fin,$numero_periodo,$horas_por_dia,$hora_ini_p1,$hora_fin_p1,$hora_ini_p2,$hora_fin_p2,$tipo_periodo,$observaciones,$repite_anualmente,$estado_reg)
	{
		$this->salida = "";
		$dbHorario = new cls_DBHorario($this->decodificar);
		$res = $dbHorario ->InsertarHorario($id_horario,$id_tipo_horario,$id_vacacion,$fecha_inicio,$fecha_fin,$numero_periodo,$horas_por_dia,$hora_ini_p1,$hora_fin_p1,$hora_ini_p2,$hora_fin_p2,$tipo_periodo,$observaciones,$repite_anualmente,$estado_reg);
		$this->salida = $dbHorario ->salida;
		$this->query = $dbHorario ->query;
		return $res;
	}
	
	function ModificarHorario($id_horario,$id_tipo_horario,$id_vacacion,$fecha_inicio,$fecha_fin,$numero_periodo,$horas_por_dia,$hora_ini_p1,$hora_fin_p1,$hora_ini_p2,$hora_fin_p2,$tipo_periodo,$observaciones,$repite_anualmente,$estado_reg)
	{
		$this->salida = "";
		$dbHorario = new cls_DBHorario($this->decodificar);
		$res = $dbHorario ->ModificarHorario($id_horario,$id_tipo_horario,$id_vacacion,$fecha_inicio,$fecha_fin,$numero_periodo,$horas_por_dia,$hora_ini_p1,$hora_fin_p1,$hora_ini_p2,$hora_fin_p2,$tipo_periodo,$observaciones,$repite_anualmente,$estado_reg);
		$this->salida = $dbHorario ->salida;
		$this->query = $dbHorario ->query;
		return $res;
	}
	
	function EliminarHorario($id_horario)
	{
		$this->salida = "";
		$dbHorario = new cls_DBHorario($this->decodificar);
		$res = $dbHorario -> EliminarHorario($id_horario);
		$this->salida = $dbHorario ->salida;
		$this->query = $dbHorario ->query;
		return $res;
	}
	
	function ValidarHorario($operacion_sql,$id_horario,$id_tipo_horario,$id_vacacion,$fecha_inicio,$fecha_fin,$numero_periodo,$horas_por_dia,$hora_ini_p1,$hora_fin_p1,$hora_ini_p2,$hora_fin_p2,$tipo_periodo,$observaciones,$repite_anualmente)
	{
		$this->salida = "";
		$dbHorario = new cls_DBHorario($this->decodificar);
		$res = $dbHorario ->ValidarHorario($operacion_sql,$id_horario,$id_tipo_horario,$id_vacacion,$fecha_inicio,$fecha_fin,$numero_periodo,$horas_por_dia,$hora_ini_p1,$hora_fin_p1,$hora_ini_p2,$hora_fin_p2,$tipo_periodo,$observaciones,$repite_anualmente);
		$this->salida = $dbHorario ->salida;
		$this->query = $dbHorario ->query;
		return $res;
	}
	
	/// --------------------- fin tkp_horario --------------------- ///
	
	/// --------------------- tkp_tipo_horario --------------------- ///

	function ListarTipoHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbTipoHorario = new cls_DBTipoHorario($this->decodificar);
		$res = $dbTipoHorario ->ListarTipoHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbTipoHorario ->salida;
		$this->query = $dbTipoHorario ->query;
		return $res;
	}
	
	function ContarListaTipoHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbTipoHorario = new cls_DBTipoHorario($this->decodificar);
		$res = $dbTipoHorario ->ContarListaTipoHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbTipoHorario ->salida;
		$this->query = $dbTipoHorario ->query;
		return $res;
	}
	
	function InsertarTipoHorario($id_tipo_horario,$codigo,$nombre)
	{
		$this->salida = "";
		$dbTipoHorario = new cls_DBTipoHorario($this->decodificar);
		$res = $dbTipoHorario ->InsertarTipoHorario($id_tipo_horario,$codigo,$nombre);
		$this->salida = $dbTipoHorario ->salida;
		$this->query = $dbTipoHorario ->query;
		return $res;
	}
	
	function ModificarTipoHorario($id_tipo_horario,$codigo,$nombre)
	{
		$this->salida = "";
		$dbTipoHorario = new cls_DBTipoHorario($this->decodificar);
		$res = $dbTipoHorario ->ModificarTipoHorario($id_tipo_horario,$codigo,$nombre);
		$this->salida = $dbTipoHorario ->salida;
		$this->query = $dbTipoHorario ->query;
		return $res;
	}
	
	function EliminarTipoHorario($id_tipo_horario)
	{
		$this->salida = "";
		$dbTipoHorario = new cls_DBTipoHorario($this->decodificar);
		$res = $dbTipoHorario -> EliminarTipoHorario($id_tipo_horario);
		$this->salida = $dbTipoHorario ->salida;
		$this->query = $dbTipoHorario ->query;
		return $res;
	}
	
	function ValidarTipoHorario($operacion_sql,$id_tipo_horario,$codigo,$nombre)
	{
		$this->salida = "";
		$dbTipoHorario = new cls_DBTipoHorario($this->decodificar);
		$res = $dbTipoHorario ->ValidarTipoHorario($operacion_sql,$id_tipo_horario,$codigo,$nombre);
		$this->salida = $dbTipoHorario ->salida;
		$this->query = $dbTipoHorario ->query;
		return $res;
	}
	
	/// --------------------- fin tkp_tipo_horario --------------------- ///
	

	/*********************************Seguro************************************/
	
	function ListarSeguro($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbSeguro = new cls_DBSeguro($this->decodificar);
		$res = $dbSeguro ->ListarSeguro($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbSeguro->salida;
		$this->query = $dbSeguro->query;
		return $res;
	}
	function ContarSeguro($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbSeguro= new cls_DBSeguro($this->decodificar);
		$res = $dbSeguro->ContarSeguro($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbSeguro->salida;
		$this->query = $dbSeguro->query;
		return $res;
	}
	

	function InsertarSeguro($id_seguro,$nombre,$fecha_reg,$estado_reg)
	{
		$this->salida = "";
		$dbSeguro = new cls_DBSeguro($this->decodificar);
		$res = $dbSeguro ->InsertarSeguro($id_seguro,$nombre,$fecha_reg,$estado_reg);
		$this->salida = $dbSeguro->salida;
		$this->query = $dbSeguro ->query;
		return $res;
	}

	function ModificarSeguro($id_seguro,$nombre,$fecha_reg,$estado_reg)
	{
		$this->salida = "";
		$dbSeguro = new cls_DBSeguro($this->decodificar);
		$res = $dbSeguro ->ModificarSeguro($id_seguro,$nombre,$fecha_reg,$estado_reg);
		$this->salida = $dbSeguro->salida;
		$this->query = $dbSeguro ->query;
		return $res;
	}

	function EliminarSeguro($id_seguro)
	{
		$this->salida = "";
		$dbSeguro = new cls_DBSeguro($this->decodificar);
		$res = $dbSeguro ->EliminarSeguro($id_seguro);
		$this->salida = $dbSeguro->salida;
		$this->query = $dbSeguro ->query;
		return $res;
	}

	function ValidarSeguro($operacion_sql,$id_seguro,$nombre,$fecha_reg,$estado_reg)
	{
		$this->salida = "";
		$dbSeguro = new cls_DBSeguro($this->decodificar);
		$res = $dbSeguro ->ValidarSeguro($operacion_sql,$id_seguro,$nombre,$fecha_reg,$estado_reg);
		$this->salida = $dbSeguro->salida;
		$this->query = $dbSeguro ->query;
		return $res;
	}
	
	/*********************************AFP************************************/
	
	function ListarAfp($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbAfp = new cls_DBAfp($this->decodificar);
		$res = $dbAfp ->ListarAfp($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp->query;
		return $res;
	}
	function ContarAfp($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbAfp= new cls_DBAfp($this->decodificar);
		$res = $dbAfp->ContarAfp($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp->query;
		return $res;
	}
	

	function InsertarAfp($id_afp,$nombre,$fecha_reg,$estado_reg,$codigo)
	{
		$this->salida = "";
		$dbAfp = new cls_DBAfp($this->decodificar);
		$res = $dbAfp ->InsertarAfp($id_afp,$nombre,$fecha_reg,$estado_reg,$codigo);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}

	function ModificarAfp($id_afp,$nombre,$fecha_reg,$estado_reg,$codigo)
	{
		$this->salida = "";
		$dbAfp = new cls_DBAfp($this->decodificar);
		$res = $dbAfp ->ModificarAfp($id_afp,$nombre,$fecha_reg,$estado_reg,$codigo);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}

	function EliminarAfp($id_afp)
	{
		$this->salida = "";
		$dbAfp = new cls_DBAfp($this->decodificar);
		$res = $dbAfp ->EliminarAfp($id_afp);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}

	function ValidarAfp($operacion_sql,$id_afp,$nombre,$fecha_reg,$estado_reg)
	{
		$this->salida = "";
		$dbAfp = new cls_DBAfp($this->decodificar);
		$res = $dbAfp ->ValidarAfp($operacion_sql,$id_afp,$nombre,$fecha_reg,$estado_reg);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}
	
	
	
	
	/*********************************Empleado AFP************************************/
	
	function ListarEmpleadoAfp($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbAfp = new cls_DBEmpleadoAfp($this->decodificar);
		$res = $dbAfp ->ListarEmpleadoAfp($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp->query;
		return $res;
	}
	function ContarEmpleadoAfp($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbAfp= new cls_DBEmpleadoAfp($this->decodificar);
		$res = $dbAfp->ContarEmpleadoAfp($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp->query;
		return $res;
	}
	

	function InsertarEmpleadoAfp($id_empleado_afp,$id_empleado,$id_afp,$nro_afp,$fecha_reg,$estado_reg,$jubilado,$fecha_asignacion,$fecha_finalizacion)
	{
		$this->salida = "";
		$dbAfp = new cls_DBEmpleadoAfp($this->decodificar);
		$res = $dbAfp ->InsertarEmpleadoAfp($id_empleado_afp,$id_empleado,$id_afp,$nro_afp,$fecha_reg,$estado_reg,$jubilado,$fecha_asignacion,$fecha_finalizacion);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}

	function ModificarEmpleadoAfp($id_empleado_afp,$id_empleado,$id_afp,$nro_afp,$fecha_reg,$estado_reg,$jubilado,$fecha_asignacion,$fecha_finalizacion)
	{
		$this->salida = "";
		$dbAfp = new cls_DBEmpleadoAfp($this->decodificar);
		$res = $dbAfp ->ModificarEmpleadoAfp($id_empleado_afp,$id_empleado,$id_afp,$nro_afp,$fecha_reg,$estado_reg,$jubilado,$fecha_asignacion,$fecha_finalizacion);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}

	function EliminarEmpleadoAfp($id_empleado_afp)
	{
		$this->salida = "";
		$dbAfp = new cls_DBEmpleadoAfp($this->decodificar);
		$res = $dbAfp ->EliminarEmpleadoAfp($id_empleado_afp);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}

	function ValidarEmpleadoAfp($operacion_sql,$id_empleado_afp,$id_empleado,$id_afp,$nro_afp,$fecha_reg,$estado_reg)
	{
		$this->salida = "";
		$dbAfp = new cls_DBEmpleadoAfp($this->decodificar);
		$res = $dbAfp ->ValidarEmpleadoAfp($operacion_sql,$id_empleado_afp,$id_empleado,$id_afp,$nro_afp,$fecha_reg,$estado_reg);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}
	
	
	/*********************************Empleado Seguro************************************/
	
	function ListarEmpleadoSeguro($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbSeguro = new cls_DBEmpleadoSeguro($this->decodificar);
		$res = $dbSeguro ->ListarEmpleadoSeguro($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbSeguro->salida;
		$this->query = $dbSeguro->query;
		return $res;
	}
	function ContarEmpleadoSeguro($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbSeguro= new cls_DBEmpleadoSeguro($this->decodificar);
		$res = $dbSeguro->ContarEmpleadoSeguro($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbSeguro->salida;
		$this->query = $dbSeguro->query;
		return $res;
	}
	

	function InsertarEmpleadoSeguro($id_empleado_seguro,$id_empleado,$id_seguro,$nro_seguro,$fecha_reg,$estado_reg)
	{
		$this->salida = "";
		$dbSeguro = new cls_DBEmpleadoSeguro($this->decodificar);
		$res = $dbSeguro ->InsertarEmpleadoSeguro($id_empleado_seguro,$id_empleado,$id_seguro,$nro_seguro,$fecha_reg,$estado_reg);
		$this->salida = $dbSeguro->salida;
		$this->query = $dbSeguro ->query;
		return $res;
	}

	function ModificarEmpleadoSeguro($id_empleado_seguro,$id_empleado,$id_seguro,$nro_seguro,$fecha_reg,$estado_reg)
	{
		$this->salida = "";
		$dbSeguro = new cls_DBEmpleadoSeguro($this->decodificar);
		$res = $dbSeguro ->ModificarEmpleadoSeguro($id_empleado_seguro,$id_empleado,$id_seguro,$nro_seguro,$fecha_reg,$estado_reg);
		$this->salida = $dbSeguro->salida;
		$this->query = $dbSeguro ->query;
		return $res;
	}

	function EliminarEmpleadoSeguro($id_empleado_seguro)
	{
		$this->salida = "";
		$dbSeguro = new cls_DBEmpleadoSeguro($this->decodificar);
		$res = $dbSeguro ->EliminarEmpleadoSeguro($id_empleado_seguro);
		$this->salida = $dbSeguro->salida;
		$this->query = $dbSeguro ->query;
		return $res;
	}

	function ValidarEmpleadoSeguro($operacion_sql,$id_empleado_seguro,$id_empleado,$id_seguro,$nro_seguro,$fecha_reg,$estado_reg)
	{
		$this->salida = "";
		$dbSeguro = new cls_DBEmpleadoSeguro($this->decodificar);
		$res = $dbSeguro ->ValidarEmpleadoSeguro($operacion_sql,$id_empleado_seguro,$id_empleado,$id_seguro,$nro_seguro,$fecha_reg,$estado_reg);
		$this->salida = $dbSeguro->salida;
		$this->query = $dbSeguro ->query;
		return $res;
	}
	/// --------------------- tkp_parametro_kardex --------------------- ///

	function ListarParametroKardex($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbParametroKardex = new cls_DBParametroKardex($this->decodificar);
		$res = $dbParametroKardex ->ListarParametroKardex($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbParametroKardex ->salida;
		$this->query = $dbParametroKardex ->query;
		return $res;
	}
	
	function ContarParametroKardex($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbParametroKardex = new cls_DBParametroKardex($this->decodificar);
		$res = $dbParametroKardex ->ContarParametroKardex($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbParametroKardex ->salida;
		$this->query = $dbParametroKardex ->query;
		return $res;
	}
	
	function InsertarParametroKardex($id_parametro_kardex,$id_gestion,$salario_min_nacional,$id_moneda,$porcen_fijo_cooperativa,$aporte_fijo_min_cooperativa,$estado_reg,$fecha_reg,$porcen_max_quincena,$id_moneda_cooperativa,$horas_mes_laboral)
	{
		$this->salida = "";
		$dbParametroKardex = new cls_DBParametroKardex($this->decodificar);
		$res = $dbParametroKardex ->InsertarParametroKardex($id_parametro_kardex,$id_gestion,$salario_min_nacional,$id_moneda,$porcen_fijo_cooperativa,$aporte_fijo_min_cooperativa,$estado_reg,$fecha_reg,$porcen_max_quincena,$id_moneda_cooperativa,$horas_mes_laboral);
		$this->salida = $dbParametroKardex ->salida;
		$this->query = $dbParametroKardex ->query;
		return $res;
	}
	
	function ModificarParametroKardex($id_parametro_kardex,$id_gestion,$salario_min_nacional,$id_moneda,$porcen_fijo_cooperativa,$aporte_fijo_min_cooperativa,$estado_reg,$fecha_reg,$porcen_max_quincena,$id_moneda_cooperativa,$horas_mes_laboral,$fecha_inicio)
	{
		$this->salida = "";
		$dbParametroKardex = new cls_DBParametroKardex($this->decodificar);
		$res = $dbParametroKardex ->ModificarParametroKardex($id_parametro_kardex,$id_gestion,$salario_min_nacional,$id_moneda,$porcen_fijo_cooperativa,$aporte_fijo_min_cooperativa,$estado_reg,$fecha_reg,$porcen_max_quincena,$id_moneda_cooperativa,$horas_mes_laboral,$fecha_inicio);
		$this->salida = $dbParametroKardex ->salida;
		$this->query = $dbParametroKardex ->query;
		return $res;
	}
	
	function EliminarParametroKardex($id_parametro_kardex)
	{
		$this->salida = "";
		$dbParametroKardex = new cls_DBParametroKardex($this->decodificar);
		$res = $dbParametroKardex -> EliminarParametroKardex($id_parametro_kardex);
		$this->salida = $dbParametroKardex ->salida;
		$this->query = $dbParametroKardex ->query;
		return $res;
	}
	
	function ValidarParametroKardex($operacion_sql,$id_parametro_kardex,$id_gestion,$salario_min_nacional,$id_moneda,$porcen_fijo_cooperativa,$aporte_fijo_min_cooperativa,$estado_reg,$fecha_reg)
	{
		$this->salida = "";
		$dbParametroKardex = new cls_DBParametroKardex($this->decodificar);
		$res = $dbParametroKardex ->ValidarParametroKardex($operacion_sql,$id_parametro_kardex,$id_gestion,$salario_min_nacional,$id_moneda,$porcen_fijo_cooperativa,$aporte_fijo_min_cooperativa,$estado_reg,$fecha_reg);
		$this->salida = $dbParametroKardex ->salida;
		$this->query = $dbParametroKardex ->query;
		return $res;
	}
	
	/// --------------------- fin tkp_parametro_kardex --------------------- ///
	
/// --------------------- tkp_categoria_vacacion --------------------- ///

	function ListarCategoriaVacacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbCategoriaVacacion = new cls_DBCategoriaVacacion($this->decodificar);
		$res = $dbCategoriaVacacion ->ListarCategoriaVacacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbCategoriaVacacion ->salida;
		$this->query = $dbCategoriaVacacion ->query;
		return $res;
	}
	
	function ContarCategoriaVacacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbCategoriaVacacion = new cls_DBCategoriaVacacion($this->decodificar);
		$res = $dbCategoriaVacacion ->ContarCategoriaVacacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbCategoriaVacacion ->salida;
		$this->query = $dbCategoriaVacacion ->query;
		return $res;
	}
	
	function InsertarCategoriaVacacion($id_categoria_vacacion,$nombre,$dias_vacacion,$caducidad,$antiguedad_ini,$descripcion,$fecha_reg,$estado_reg,$antiguedad_fin)
	{
		$this->salida = "";
		$dbCategoriaVacacion = new cls_DBCategoriaVacacion($this->decodificar);
		$res = $dbCategoriaVacacion ->InsertarCategoriaVacacion($id_categoria_vacacion,$nombre,$dias_vacacion,$caducidad,$antiguedad_ini,$descripcion,$fecha_reg,$estado_reg,$antiguedad_fin);
		$this->salida = $dbCategoriaVacacion ->salida;
		$this->query = $dbCategoriaVacacion ->query;
		return $res;
	}
	
	function ModificarCategoriaVacacion($id_categoria_vacacion,$nombre,$dias_vacacion,$caducidad,$antiguedad_ini,$descripcion,$fecha_reg,$estado_reg,$antiguedad_fin)
	{
		$this->salida = "";
		$dbCategoriaVacacion = new cls_DBCategoriaVacacion($this->decodificar);
		$res = $dbCategoriaVacacion ->ModificarCategoriaVacacion($id_categoria_vacacion,$nombre,$dias_vacacion,$caducidad,$antiguedad_ini,$descripcion,$fecha_reg,$estado_reg,$antiguedad_fin);
		$this->salida = $dbCategoriaVacacion ->salida;
		$this->query = $dbCategoriaVacacion ->query;
		return $res;
	}
	
	function EliminarCategoriaVacacion($id_categoria_vacacion)
	{
		$this->salida = "";
		$dbCategoriaVacacion = new cls_DBCategoriaVacacion($this->decodificar);
		$res = $dbCategoriaVacacion -> EliminarCategoriaVacacion($id_categoria_vacacion);
		$this->salida = $dbCategoriaVacacion ->salida;
		$this->query = $dbCategoriaVacacion ->query;
		return $res;
	}
	
	function ValidarCategoriaVacacion($operacion_sql,$id_categoria_vacacion,$nombre,$dias_vacacion,$caducidad,$antiguedad,$descripcion,$fecha_reg,$estado_reg)
	{
		$this->salida = "";
		$dbCategoriaVacacion = new cls_DBCategoriaVacacion($this->decodificar);
		$res = $dbCategoriaVacacion ->ValidarCategoriaVacacion($operacion_sql,$id_categoria_vacacion,$nombre,$dias_vacacion,$caducidad,$antiguedad,$descripcion,$fecha_reg,$estado_reg);
		$this->salida = $dbCategoriaVacacion ->salida;
		$this->query = $dbCategoriaVacacion ->query;
		return $res;
	}
	
	/// --------------------- fin tkp_categoria_vacacion --------------------- ///
	
	
	
	
	/******************************** CONTRATO *********************************/
	
	function ListarContrato($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbContrato = new cls_DBContrato($this->decodificar);
		$res = $dbContrato ->ListarContrato($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbContrato ->salida;
		$this->query = $dbContrato ->query;
		return $res;
	}
	
	function ContarContrato($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbContrato = new cls_DBContrato($this->decodificar);
		$res = $dbContrato ->ContarContrato($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbContrato ->salida;
		$this->query = $dbContrato ->query;
		return $res;
	}
	
	function InsertarContrato($id_contrato,$nro_contrato,$tipo_contrato,$sueldo,$id_moneda,$fecha_ini,$fecha_fin,$fecha_reg,$estado_reg,$id_empleado,
	$forma_pago,$tiene_quincena,$porcen_quincena,$socio_cooperativa,$monto_fijo,$porcen_fijo_cooperativa,$fecha_inicio_quincena,$tipo_registro_contrato)
	{
		$this->salida = "";
		$dbContrato = new cls_DBContrato($this->decodificar);
		$res = $dbContrato ->InsertarContrato($id_contrato,$nro_contrato,$tipo_contrato,$sueldo,$id_moneda,$fecha_ini,$fecha_fin,$fecha_reg,$estado_reg,$id_empleado,
		$forma_pago,$tiene_quincena,$porcen_quincena,$socio_cooperativa,$monto_fijo,$porcen_fijo_cooperativa,$fecha_inicio_quincena,$tipo_registro_contrato);
		$this->salida = $dbContrato ->salida;
		$this->query = $dbContrato ->query;
		return $res;
	}
	
	function ModificarContrato($id_contrato,$nro_contrato,$tipo_contrato,$sueldo,$id_moneda,$fecha_ini,$fecha_fin,$fecha_reg,$estado_reg,$id_empleado,
	$forma_pago,$tiene_quincena,$porcen_quincena,$socio_cooperativa,$monto_fijo,$porcen_fijo_cooperativa,$fecha_inicio_quincena,$tipo_registro_contrato)
	{ 
		$this->salida = "";
		$dbContrato = new cls_DBContrato($this->decodificar);
		$res = $dbContrato ->ModificarContrato($id_contrato,$nro_contrato,$tipo_contrato,$sueldo,$id_moneda,$fecha_ini,$fecha_fin,$fecha_reg,$estado_reg,$id_empleado,
		$forma_pago,$tiene_quincena,$porcen_quincena,$socio_cooperativa,$monto_fijo,$porcen_fijo_cooperativa,$fecha_inicio_quincena,$tipo_registro_contrato);
		$this->salida = $dbContrato ->salida;
		$this->query = $dbContrato ->query;
		return $res;
	}
	
	function EliminarContrato($id_contrato)
	{
		$this->salida = "";
		$dbContrato = new cls_DBContrato($this->decodificar);
		$res = $dbContrato -> EliminarContrato($id_contrato);
		$this->salida = $dbContrato ->salida;
		$this->query = $dbContrato ->query;
		return $res;
	}
	
	function ValidarContrato($operacion_sql,$id_contrato,$nro_contrato,$tipo_contrato,$sueldo,$id_moneda,$fecha_ini,$fecha_fin,$fecha_reg,$estado_reg,$id_empleado)
	{
		$this->salida = "";
		$dbContrato = new cls_DBContrato($this->decodificar);
		$res = $dbContrato ->ValidarContrato($operacion_sql,$id_contrato,$nro_contrato,$tipo_contrato,$sueldo,$id_moneda,$fecha_ini,$fecha_fin,$fecha_reg,$estado_reg,$id_empleado);
		$this->salida = $dbContrato ->salida;
		$this->query = $dbContrato ->query;
		return $res;
	}

	/*********************************Empleado Horario************************************/
	
	function ListarEmpleadoHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoHorario = new cls_DBEmpleadoHorario($this->decodificar);
		$res = $dbEmpleadoHorario ->ListarEmpleadoHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoHorario->salida;
		$this->query = $dbEmpleadoHorario->query;
		return $res;
	}
	function ContarEmpleadoHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoHorario= new cls_DBEmpleadoHorario($this->decodificar);
		$res = $dbEmpleadoHorario->ContarEmpleadoHorario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoHorario->salida;
		$this->query = $dbEmpleadoHorario->query;
		return $res;
	}
	

	function InsertarEmpleadoHorario($id_empleado_horario,$id_empleado,$id_turno,$estado_reg,$fecha_ini,$fecha_fin)
	{
		$this->salida = "";
		$dbEmpleadoHorario = new cls_DBEmpleadoHorario($this->decodificar);
		$res = $dbEmpleadoHorario ->InsertarEmpleadoHorario($id_empleado_horario,$id_empleado,$id_turno,$estado_reg,$fecha_ini,$fecha_fin);
		$this->salida = $dbEmpleadoHorario->salida;
		$this->query = $dbEmpleadoHorario ->query;
		return $res;
	}

	function ModificarEmpleadoHorario($id_empleado_horario,$id_empleado,$id_turno,$estado_reg,$fecha_ini,$fecha_fin)
	{
		$this->salida = "";
		$dbEmpleadoHorario = new cls_DBEmpleadoHorario($this->decodificar);
		$res = $dbEmpleadoHorario ->ModificarEmpleadoHorario($id_empleado_horario,$id_empleado,$id_turno,$estado_reg,$fecha_ini,$fecha_fin);
		$this->salida = $dbEmpleadoHorario->salida;
		$this->query = $dbEmpleadoHorario ->query;
		return $res;
	}

	function EliminarEmpleadoHorario($id_empleado_horario)
	{
		$this->salida = "";
		$dbEmpleadoHorario = new cls_DBEmpleadoHorario($this->decodificar);
		$res = $dbEmpleadoHorario ->EliminarEmpleadoHorario($id_empleado_horario);
		$this->salida = $dbEmpleadoHorario->salida;
		$this->query = $dbEmpleadoHorario ->query;
		return $res;
	}

	function ValidarEmpleadoHorario($operacion_sql,$id_empleado_horario,$id_empleado,$id_horario,$estado_reg,$fecha_ini,$fecha_fin)
	{
		$this->salida = "";
		$dbEmpleadoHorario = new cls_DBEmpleadoHorario($this->decodificar);
		$res = $dbEmpleadoHorario ->ValidarEmpleadoHorario($operacion_sql,$id_empleado_horario,$id_empleado,$id_horario,$estado_reg,$fecha_ini,$fecha_fin);
		$this->salida = $dbEmpleadoHorario->salida;
		$this->query = $dbEmpleadoHorario ->query;
		return $res;
	}
	/*******************************Fin Empleado Horario************************************/
	
	
	/*********************************Empleado Cta Bancaria************************************/
	
	function ListarEmpleadoCtaBancaria($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoCtaBancaria = new cls_DBEmpleadoCtaBancaria($this->decodificar);
		$res = $dbEmpleadoCtaBancaria ->ListarEmpleadoCtaBancaria($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoCtaBancaria->salida;
		$this->query = $dbEmpleadoCtaBancaria->query;
		return $res;
	}
	function ContarEmpleadoCtaBancaria($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoCtaBancaria= new cls_DBEmpleadoCtaBancaria($this->decodificar);
		$res = $dbEmpleadoCtaBancaria->ContarEmpleadoCtaBancaria($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoCtaBancaria->salida;
		$this->query = $dbEmpleadoCtaBancaria->query;
		return $res;
	}
	

	function InsertarEmpleadoCtaBancaria($id_empleado_cta_bancaria,$id_empleado,$id_institucion,$nro_cuenta,$fecha_reg,$estado_reg,$fecha_asignacion,$fecha_finalizacion)
	{
		$this->salida = "";
		$dbEmpleadoCtaBancaria = new cls_DBEmpleadoCtaBancaria($this->decodificar);
		$res = $dbEmpleadoCtaBancaria ->InsertarEmpleadoCtaBancaria($id_empleado_cta_bancaria,$id_empleado,$id_institucion,$nro_cuenta,$fecha_reg,$estado_reg,$fecha_asignacion,$fecha_finalizacion);
		$this->salida = $dbEmpleadoCtaBancaria->salida;
		$this->query = $dbEmpleadoCtaBancaria ->query;
		return $res;
	}

	function ModificarEmpleadoCtaBancaria($id_empleado_cta_bancaria,$id_empleado,$id_institucion,$nro_cuenta,$fecha_reg,$estado_reg,$fecha_asignacion,$fecha_finalizacion)
	{
		$this->salida = "";
		$dbEmpleadoCtaBancaria = new cls_DBEmpleadoCtaBancaria($this->decodificar);
		$res = $dbEmpleadoCtaBancaria ->ModificarEmpleadoCtaBancaria($id_empleado_cta_bancaria,$id_empleado,$id_institucion,$nro_cuenta,$fecha_reg,$estado_reg,$fecha_asignacion,$fecha_finalizacion);
		$this->salida = $dbEmpleadoCtaBancaria->salida;
		$this->query = $dbEmpleadoCtaBancaria ->query;
		return $res;
	}

	function EliminarEmpleadoCtaBancaria($id_empleado_cta_bancaria)
	{
		$this->salida = "";
		$dbEmpleadoCtaBancaria = new cls_DBEmpleadoCtaBancaria($this->decodificar);
		$res = $dbEmpleadoCtaBancaria ->EliminarEmpleadoCtaBancaria($id_empleado_cta_bancaria);
		$this->salida = $dbEmpleadoCtaBancaria->salida;
		$this->query = $dbEmpleadoCtaBancaria ->query;
		return $res;
	}

	function ValidarEmpleadoCtaBancaria($operacion_sql,$id_empleado_cta_bancaria,$id_empleado,$id_institucion,$nro_cuenta,$fecha_reg,$estado_reg)
	{
		$this->salida = "";
		$dbEmpleadoCtaBancaria = new cls_DBEmpleadoCtaBancaria($this->decodificar);
		$res = $dbEmpleadoCtaBancaria ->ValidarEmpleadoCtaBancaria($operacion_sql,$id_empleado_cta_bancaria,$id_empleado,$id_institucion,$nro_cuenta,$fecha_reg,$estado_reg);
		$this->salida = $dbEmpleadoCtaBancaria->salida;
		$this->query = $dbEmpleadoCtaBancaria ->query;
		return $res;
	}
	
	/*******************************Diagrama unidad organizacional************************************/
	function ListarUnidadOrganizacionalDiagrama($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$v_id,$v_crit_fil)
	{ 
		$this->salida = "";
		$dbUnidadOrganizacionalDiagrama = new cls_DBUnidadOrganizacionalDiagrama($this->decodificar);
		$res = $dbUnidadOrganizacionalDiagrama ->ListarUnidadOrganizacionalDiagrama($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$v_id,$v_crit_fil);
		$this->salida = $dbUnidadOrganizacionalDiagrama->salida;
		$this->query = $dbUnidadOrganizacionalDiagrama->query;
		return $res;
	}
	
	/*********************************Tipo Descto Bono************************************/
	
	function ListarTipoDescuentoBono($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbTipoDescuentoBono = new cls_DBTipoDescuentoBono($this->decodificar);
		$res = $dbTipoDescuentoBono ->ListarTipoDescuentoBono($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbTipoDescuentoBono->salida;
		$this->query = $dbTipoDescuentoBono->query;
		return $res;
	}
	function ContarTipoDescuentoBono($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbTipoDescuentoBono= new cls_DBTipoDescuentoBono($this->decodificar);
		$res = $dbTipoDescuentoBono->ContarTipoDescuentoBono($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbTipoDescuentoBono->salida;
		$this->query = $dbTipoDescuentoBono->query;
		return $res;
	}
	

	function InsertarTipoDescuentoBono($id_tipo_descuento_bono,$codigo,$nombre,$descripcion,$tipo,$fecha_reg,$estado_reg,$modalidad,$valor_modalidad_porcentual,$forma_asignacion)
	{
		$this->salida = "";
		$dbTipoDescuentoBono = new cls_DBTipoDescuentoBono($this->decodificar);
		$res = $dbTipoDescuentoBono ->InsertarTipoDescuentoBono($id_tipo_descuento_bono,$codigo,$nombre,$descripcion,$tipo,$fecha_reg,$estado_reg,$modalidad,$valor_modalidad_porcentual,$forma_asignacion);
		$this->salida = $dbTipoDescuentoBono->salida;
		$this->query = $dbTipoDescuentoBono ->query;
		return $res;
	}

	function ModificarTipoDescuentoBono($id_tipo_descuento_bono,$codigo,$nombre,$descripcion,$tipo,$fecha_reg,$estado_reg,$modalidad,$valor_modalidad_porcentual,$forma_asignacion)
	{
		$this->salida = "";
		$dbTipoDescuentoBono = new cls_DBTipoDescuentoBono($this->decodificar);
		$res = $dbTipoDescuentoBono ->ModificarTipoDescuentoBono($id_tipo_descuento_bono,$codigo,$nombre,$descripcion,$tipo,$fecha_reg,$estado_reg,$modalidad,$valor_modalidad_porcentual,$forma_asignacion);
		$this->salida = $dbTipoDescuentoBono->salida;
		$this->query = $dbTipoDescuentoBono ->query;
		return $res;
	}

	function EliminarTipoDescuentoBono($id_tipo_descuento_bono)
	{
		$this->salida = "";
		$dbTipoDescuentoBono = new cls_DBTipoDescuentoBono($this->decodificar);
		$res = $dbTipoDescuentoBono ->EliminarTipoDescuentoBono($id_tipo_descuento_bono);
		$this->salida = $dbTipoDescuentoBono->salida;
		$this->query = $dbTipoDescuentoBono ->query;
		return $res;
	}

	function ValidarTipoDescuentoBono($operacion_sql,$id_tipo_descuento_bono,$codigo,$nombre,$descripcion,$tipo,$fecha_reg,$estado_reg)
	{
		$this->salida = "";
		$dbTipoDescuentoBono = new cls_DBTipoDescuentoBono($this->decodificar);
		$res = $dbTipoDescuentoBono ->ValidarTipoDescuentoBono($operacion_sql,$id_tipo_descuento_bono,$codigo,$nombre,$descripcion,$tipo,$fecha_reg,$estado_reg);
		$this->salida = $dbTipoDescuentoBono->salida;
		$this->query = $dbTipoDescuentoBono ->query;
		return $res;
	}
	
	
	/********************************* Descto Bono************************************/
	
	function ListarDescuentoBono($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbDescuentoBono = new cls_DBDescuentoBono($this->decodificar);
		$res = $dbDescuentoBono ->ListarDescuentoBono($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbDescuentoBono->salida;
		$this->query = $dbDescuentoBono->query;
		return $res;
	}
	function ContarDescuentoBono($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbDescuentoBono= new cls_DBDescuentoBono($this->decodificar);
		$res = $dbDescuentoBono->ContarDescuentoBono($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbDescuentoBono->salida;
		$this->query = $dbDescuentoBono->query;
		return $res;
	}
	

	function InsertarDescuentoBono($id_descuento_bono,$id_tipo_descuento_bono,$id_empleado,$id_moneda,$monto_total,
	$num_cuotas,$monto_faltante,$valor_por_cuota,$fecha_ini,$fecha_reg,$estado_reg,$cuotas
	,$fecha_fin
	)
	{
		$this->salida = "";
		$dbDescuentoBono = new cls_DBDescuentoBono($this->decodificar);
		$res = $dbDescuentoBono ->InsertarDescuentoBono($id_descuento_bono,$id_tipo_descuento_bono,$id_empleado,$id_moneda,$monto_total,
	$num_cuotas,$monto_faltante,$valor_por_cuota,$fecha_ini,$fecha_reg,$estado_reg,$cuotas
	,$fecha_fin
	);
		$this->salida = $dbDescuentoBono->salida;
		$this->query = $dbDescuentoBono ->query;
		return $res;
	}

	function ModificarDescuentoBono($id_descuento_bono,$id_tipo_descuento_bono,$id_empleado,$id_moneda,$monto_total,
	$num_cuotas,$monto_faltante,$valor_por_cuota,$fecha_ini,$fecha_reg,$estado_reg,$cuotas
	,$fecha_fin
	)
	{
		$this->salida = "";
		$dbDescuentoBono = new cls_DBDescuentoBono($this->decodificar);
		$res = $dbDescuentoBono ->ModificarDescuentoBono($id_descuento_bono,$id_tipo_descuento_bono,$id_empleado,$id_moneda,$monto_total,
	$num_cuotas,$monto_faltante,$valor_por_cuota,$fecha_ini,$fecha_reg,$estado_reg,$cuotas
	,$fecha_fin
	);
		$this->salida = $dbDescuentoBono->salida;
		$this->query = $dbDescuentoBono ->query;
		return $res;
	}

	function EliminarDescuentoBono($id_descuento_bono)
	{
		$this->salida = "";
		$dbDescuentoBono = new cls_DBDescuentoBono($this->decodificar);
		$res = $dbDescuentoBono ->EliminarDescuentoBono($id_descuento_bono);
		$this->salida = $dbDescuentoBono->salida;
		$this->query = $dbDescuentoBono ->query;
		return $res;
	}

	function ValidarDescuentoBono($operacion_sql,$id_descuento_bono,$id_tipo_descuento_bono,$id_empleado,$id_moneda,$monto_total,
	$num_cuotas,$monto_faltante,$valor_por_cuota,$fecha_ini,$fecha_reg,$estado_reg)
	{
		$this->salida = "";
		$dbDescuentoBono = new cls_DBDescuentoBono($this->decodificar);
		$res = $dbDescuentoBono ->ValidarDescuentoBono($operacion_sql,$id_descuento_bono,$id_tipo_descuento_bono,$id_empleado,$id_moneda,$monto_total,
	$num_cuotas,$monto_faltante,$valor_por_cuota,$fecha_ini,$fecha_reg,$estado_reg);
		$this->salida = $dbDescuentoBono->salida;
		$this->query = $dbDescuentoBono ->query;
		return $res;
	}
	
	/// --------------------- tkp_tipo_planilla --------------------- ///

	function ListarTipoPlanilla($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbTipoPlanilla = new cls_DBTipoPlanilla($this->decodificar);
		$res = $dbTipoPlanilla ->ListarTipoPlanilla($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbTipoPlanilla ->salida;
		$this->query = $dbTipoPlanilla ->query;
		return $res;
	}
	
	function ContarTipoPlanilla($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbTipoPlanilla = new cls_DBTipoPlanilla($this->decodificar);
		$res = $dbTipoPlanilla ->ContarTipoPlanilla($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbTipoPlanilla ->salida;
		$this->query = $dbTipoPlanilla ->query;
		return $res;
	}
	
	function InsertarTipoPlanilla($id_tipo_planilla,$nombre,$descripcion,$estado_reg,$id_depto,$tipo,$basica)
	{
		$this->salida = "";
		$dbTipoPlanilla = new cls_DBTipoPlanilla($this->decodificar);
		$res = $dbTipoPlanilla ->InsertarTipoPlanilla($id_tipo_planilla,$nombre,$descripcion,$estado_reg,$id_depto,$tipo,$basica);
		$this->salida = $dbTipoPlanilla ->salida;
		$this->query = $dbTipoPlanilla ->query;
		return $res;
	}
	
	function ModificarTipoPlanilla($id_tipo_planilla,$nombre,$descripcion,$estado_reg,$id_depto,$tipo,$basica)
	{
		$this->salida = "";
		$dbTipoPlanilla = new cls_DBTipoPlanilla($this->decodificar);
		$res = $dbTipoPlanilla ->ModificarTipoPlanilla($id_tipo_planilla,$nombre,$descripcion,$estado_reg,$id_depto,$tipo,$basica);
		$this->salida = $dbTipoPlanilla ->salida;
		$this->query = $dbTipoPlanilla ->query;
		return $res;
	}
	
	function EliminarTipoPlanilla($id_tipo_planilla)
	{
		$this->salida = "";
		$dbTipoPlanilla = new cls_DBTipoPlanilla($this->decodificar);
		$res = $dbTipoPlanilla -> EliminarTipoPlanilla($id_tipo_planilla);
		$this->salida = $dbTipoPlanilla ->salida;
		$this->query = $dbTipoPlanilla ->query;
		return $res;
	}
	
	function ValidarTipoPlanilla($operacion_sql,$id_tipo_planilla,$nombre,$descripcion,$estado_reg)
	{
		$this->salida = "";
		$dbTipoPlanilla = new cls_DBTipoPlanilla($this->decodificar);
		$res = $dbTipoPlanilla ->ValidarTipoPlanilla($operacion_sql,$id_tipo_planilla,$nombre,$descripcion,$estado_reg);
		$this->salida = $dbTipoPlanilla ->salida;
		$this->query = $dbTipoPlanilla ->query;
		return $res;
	}
	
	/// --------------------- fin tkp_tipo_planilla --------------------- ///
	
	/// --------------------- tkp_columna --------------------- ///

	function ListarColumna($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbColumna = new cls_DBColumna($this->decodificar);
		$res = $dbColumna ->ListarColumna($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbColumna ->salida;
		$this->query = $dbColumna ->query;
		return $res;
	}
	
	function ContarColumna($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbColumna = new cls_DBColumna($this->decodificar);
		$res = $dbColumna ->ContarColumna($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbColumna ->salida;
		$this->query = $dbColumna ->query;
		return $res;
	}
	
	function InsertarColumna($id_columna,$id_tipo_planilla,$id_columna_tipo,$formula,$valor_defecto,$estado_reg,$en_reporte,$orden_reporte,$total
	,$orden_ejecucion,$fecha_inicio
	)
	{
		$this->salida = "";
		$dbColumna = new cls_DBColumna($this->decodificar);
		$res = $dbColumna ->InsertarColumna($id_columna,$id_tipo_planilla,$id_columna_tipo,$formula,$valor_defecto,$estado_reg,$en_reporte,$orden_reporte,$total
		,$orden_ejecucion,$fecha_inicio
		);
		$this->salida = $dbColumna ->salida;
		$this->query = $dbColumna ->query;
		return $res;
	}
	
	function ModificarColumna($id_columna,$id_tipo_planilla,$id_columna_tipo,$formula,$valor_defecto,$estado_reg,$en_reporte,$orden_reporte,$total
	,$orden_ejecucion,$fecha_inicio
	)
	{
		$this->salida = "";
		$dbColumna = new cls_DBColumna($this->decodificar);
		$res = $dbColumna ->ModificarColumna($id_columna,$id_tipo_planilla,$id_columna_tipo,$formula,$valor_defecto,$estado_reg,$en_reporte,$orden_reporte,$total,$orden_ejecucion,$fecha_inicio);
		$this->salida = $dbColumna ->salida;
		$this->query = $dbColumna ->query;
		return $res;
	}
	
	function EliminarColumna($id_columna)
	{
		$this->salida = "";
		$dbColumna = new cls_DBColumna($this->decodificar);
		$res = $dbColumna -> EliminarColumna($id_columna);
		$this->salida = $dbColumna ->salida;
		$this->query = $dbColumna ->query;
		return $res;
	}
	
	function ValidarColumna($operacion_sql,$id_columna,$id_tipo_planilla,$id_columna_tipo,$formula,$valor_defecto,$estado_reg)
	{
		$this->salida = "";
		$dbColumna = new cls_DBColumna($this->decodificar);
		$res = $dbColumna ->ValidarColumna($operacion_sql,$id_columna,$id_tipo_planilla,$id_columna_tipo,$formula,$valor_defecto,$estado_reg);
		$this->salida = $dbColumna ->salida;
		$this->query = $dbColumna ->query;
		return $res;
	}
	
	/// --------------------- fin tkp_columna --------------------- ///
	
	
	/********************************* Capacitacion ************************************/
	
	function ListarTipoCapacitacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbCapacitacion = new cls_DBTipoCapacitacion($this->decodificar);
		$res = $dbCapacitacion ->ListarTipoCapacitacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbCapacitacion->salida;
		$this->query = $dbCapacitacion->query;
		return $res;
	}
	function ContarTipoCapacitacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbCapacitacion= new cls_DBTipoCapacitacion($this->decodificar);
		$res = $dbCapacitacion->ContarTipoCapacitacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbCapacitacion->salida;
		$this->query = $dbCapacitacion->query;
		return $res;
	}
	

	function InsertarTipoCapacitacion($id_tipo_capacitacion,$nombre,$descripcion,$fecha_reg,$estado_reg,$carrera)
	{
		$this->salida = "";
		$dbCapacitacion = new cls_DBTipoCapacitacion($this->decodificar);
		$res = $dbCapacitacion ->InsertarTipoCapacitacion($id_tipo_capacitacion,$nombre,$descripcion,$fecha_reg,$estado_reg,$carrera);
		$this->salida = $dbCapacitacion->salida;
		$this->query = $dbCapacitacion ->query;
		return $res;
	}

	function ModificarTipoCapacitacion($id_tipo_capacitacion,$nombre,$descripcion,$fecha_reg,$estado_reg,$carrera)
	{
		$this->salida = "";
		$dbCapacitacion = new cls_DBTipoCapacitacion($this->decodificar);
		$res = $dbCapacitacion ->ModificarTipoCapacitacion($id_tipo_capacitacion,$nombre,$descripcion,$fecha_reg,$estado_reg,$carrera);
		$this->salida = $dbCapacitacion->salida;
		$this->query = $dbCapacitacion ->query;
		return $res;
	}

	function EliminarTipoCapacitacion($id_tipo_capacitacion)
	{
		$this->salida = "";
		$dbCapacitacion = new cls_DBTipoCapacitacion($this->decodificar);
		$res = $dbCapacitacion ->EliminarTipoCapacitacion($id_tipo_capacitacion);
		$this->salida = $dbCapacitacion->salida;
		$this->query = $dbCapacitacion ->query;
		return $res;
	}

	function ValidarTipoCapacitacion($operacion_sql,$id_tipo_capacitacion,$nombre,$descripcion,$fecha_reg,$estado_reg)
	{
		$this->salida = "";
		$dbCapacitacion = new cls_DBTipoCapacitacion($this->decodificar);
		$res = $dbCapacitacion ->ValidarTipoCapacitacion($operacion_sql,$id_tipo_capacitacion,$nombre,$descripcion,$fecha_reg,$estado_reg);
		$this->salida = $dbCapacitacion->salida;
		$this->query = $dbCapacitacion ->query;
		return $res;
	}
	
	/***********************************Empleado Capacitacion************************************/
	
	function ListarEmpleadoCapacitacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoCapacitacion = new cls_DBEmpleadoCapacitacion($this->decodificar);
		$res = $dbEmpleadoCapacitacion ->ListarEmpleadoCapacitacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoCapacitacion->salida;
		$this->query = $dbEmpleadoCapacitacion->query;
		return $res;
	}
	function ContarEmpleadoCapacitacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoCapacitacion= new cls_DBEmpleadoCapacitacion($this->decodificar);
		$res = $dbEmpleadoCapacitacion->ContarEmpleadoCapacitacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoCapacitacion->salida;
		$this->query = $dbEmpleadoCapacitacion->query;
		return $res;
	}
	

	function InsertarEmpleadoCapacitacion($id_empleado_capacitacion, $id_capacitacion,$descripcion,$id_institucion,$tipo_capacitacion,$financiado,$fecha_ini,$fecha_fin,$id_empleado,$nombre_institucion,$direccion_institucion,$ano_graduacion,$id_persona, $carrera,$fecha_titulo,$reg_profesional)
	{
		$this->salida = "";
		$dbEmpleadoCapacitacion = new cls_DBEmpleadoCapacitacion($this->decodificar);
		$res = $dbEmpleadoCapacitacion ->InsertarEmpleadoCapacitacion($id_empleado_capacitacion, $id_capacitacion,$descripcion,$id_institucion,$tipo_capacitacion,$financiado,$fecha_ini,$fecha_fin,$id_empleado,$nombre_institucion,$direccion_institucion,$ano_graduacion,$id_persona,$carrera,$fecha_titulo,$reg_profesional);
		$this->salida = $dbEmpleadoCapacitacion->salida;
		$this->query = $dbEmpleadoCapacitacion ->query;
		return $res;
	}

	function ModificarEmpleadoCapacitacion($id_empleado_capacitacion, $id_capacitacion,$descripcion,$id_institucion,$tipo_capacitacion,$financiado,$fecha_ini,$fecha_fin,$id_empleado,$nombre_institucion,$direccion_institucion,$ano_graduacion,$id_persona,$carrera,$fecha_titulo,$reg_profesional)
	{
		$this->salida = "";
		$dbEmpleadoCapacitacion = new cls_DBEmpleadoCapacitacion($this->decodificar);
		$res = $dbEmpleadoCapacitacion ->ModificarEmpleadoCapacitacion($id_empleado_capacitacion, $id_capacitacion,$descripcion,$id_institucion,$tipo_capacitacion,$financiado,$fecha_ini,$fecha_fin,$id_empleado,$nombre_institucion,$direccion_institucion,$ano_graduacion,$id_persona,$carrera,$fecha_titulo,$reg_profesional);
		$this->salida = $dbEmpleadoCapacitacion->salida;
		$this->query = $dbEmpleadoCapacitacion ->query;
		return $res;
	}

	function EliminarEmpleadoCapacitacion($id_empleado_capacitacion)
	{
		$this->salida = "";
		$dbEmpleadoCapacitacion = new cls_DBEmpleadoCapacitacion($this->decodificar);
		$res = $dbEmpleadoCapacitacion ->EliminarEmpleadoCapacitacion($id_empleado_capacitacion);
		$this->salida = $dbEmpleadoCapacitacion->salida;
		$this->query = $dbEmpleadoCapacitacion ->query;
		return $res;
	}

	function ValidarEmpleadoCapacitacion($operacion_sql,$id_empleado_capacitacion, $id_capacitacion,$descripcion,$id_institucion,$tipo_capacitacion,$financiado,$fecha_ini,$fecha_fin,$id_empleado)
	{
		$this->salida = "";
		$dbEmpleadoCapacitacion = new cls_DBEmpleadoCapacitacion($this->decodificar);
		$res = $dbEmpleadoCapacitacion ->ValidarEmpleadoCapacitacion($operacion_sql,$id_empleado_capacitacion, $id_capacitacion,$descripcion,$id_institucion,$tipo_capacitacion,$financiado,$fecha_ini,$fecha_fin,$id_empleado);
		$this->salida = $dbEmpleadoCapacitacion->salida;
		$this->query = $dbEmpleadoCapacitacion ->query;
		return $res;
	}
	
	
	
	
	
	/********************************* EmpleadoTrabajo ************************************/
	
	function ListarEmpleadoTrabajo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoTrabajo = new cls_DBEmpleadoTrabajo($this->decodificar);
		$res = $dbEmpleadoTrabajo ->ListarEmpleadoTrabajo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoTrabajo->salida;
		$this->query = $dbEmpleadoTrabajo->query;
		return $res;
	}
	function ContarEmpleadoTrabajo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoTrabajo= new cls_DBEmpleadoTrabajo($this->decodificar);
		$res = $dbEmpleadoTrabajo->ContarEmpleadoTrabajo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoTrabajo->salida;
		$this->query = $dbEmpleadoTrabajo->query;
		return $res;
	}
	

	function InsertarEmpleadoTrabajo($id_empleado_trabajo,$descripcion,$id_institucion,$tipo_institucion,$cargo,$fecha_ini,$fecha_fin,$id_empleado,$nombre_institucion,$direccion_institucion,$id_persona)
	{
		$this->salida = "";
		$dbEmpleadoTrabajo = new cls_DBEmpleadoTrabajo($this->decodificar);
		$res = $dbEmpleadoTrabajo ->InsertarEmpleadoTrabajo($id_empleado_trabajo,$descripcion,$id_institucion,$tipo_institucion,$cargo,$fecha_ini,$fecha_fin,$id_empleado,$nombre_institucion,$direccion_institucion,$id_persona);
		$this->salida = $dbEmpleadoTrabajo->salida;
		$this->query = $dbEmpleadoTrabajo ->query;
		return $res;
	}

	function ModificarEmpleadoTrabajo($id_empleado_trabajo,$descripcion,$id_institucion,$tipo_institucion,$cargo,$fecha_ini,$fecha_fin,$id_empleado,$nombre_institucion,$direccion_institucion,$id_persona)
	{
		$this->salida = "";
		$dbEmpleadoTrabajo = new cls_DBEmpleadoTrabajo($this->decodificar);
		$res = $dbEmpleadoTrabajo ->ModificarEmpleadoTrabajo($id_empleado_trabajo,$descripcion,$id_institucion,$tipo_institucion,$cargo,$fecha_ini,$fecha_fin,$id_empleado,$nombre_institucion,$direccion_institucion,$id_persona);
		$this->salida = $dbEmpleadoTrabajo->salida;
		$this->query = $dbEmpleadoTrabajo ->query;
		return $res;
	}

	function EliminarEmpleadoTrabajo($id_empleado_trabajo)
	{
		$this->salida = "";
		$dbEmpleadoTrabajo = new cls_DBEmpleadoTrabajo($this->decodificar);
		$res = $dbEmpleadoTrabajo ->EliminarEmpleadoTrabajo($id_empleado_trabajo);
		$this->salida = $dbEmpleadoTrabajo->salida;
		$this->query = $dbEmpleadoTrabajo ->query;
		return $res;
	}

	function ValidarEmpleadoTrabajo($operacion_sql,$id_empleado_trabajo,$descripcion,$id_institucion,$tipo_institucion,$cargo,$fecha_ini,$fecha_fin,$id_empleado)
	{
		$this->salida = "";
		$dbEmpleadoTrabajo = new cls_DBEmpleadoTrabajo($this->decodificar);
		$res = $dbEmpleadoTrabajo ->ValidarEmpleadoTrabajo($operacion_sql,$id_empleado_trabajo,$descripcion,$id_institucion,$tipo_institucion,$cargo,$fecha_ini,$fecha_fin,$id_empleado);
		$this->salida = $dbEmpleadoTrabajo->salida;
		$this->query = $dbEmpleadoTrabajo ->query;
		return $res;
	}
	
	
	/// --------------------- tkp_empleado_planilla --------------------- ///

	function ListarEmpleadoPlanilla($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoPlanilla = new cls_DBEmpleadoPlanilla($this->decodificar);
		$res = $dbEmpleadoPlanilla ->ListarEmpleadoPlanilla($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoPlanilla ->salida;
		$this->query = $dbEmpleadoPlanilla ->query;
		return $res;
	}
	
	function ContarEmpleadoPlanilla($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoPlanilla = new cls_DBEmpleadoPlanilla($this->decodificar);
		$res = $dbEmpleadoPlanilla ->ContarEmpleadoPlanilla($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoPlanilla ->salida;
		$this->query = $dbEmpleadoPlanilla ->query;
		return $res;
	}
	
	function ContarEmpleadoPlanillaDinamica($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_planilla,$id_tipo_planilla,$cc)
	{
		$this->salida = "";
		$dbEmpleadoPlanilla = new cls_DBEmpleadoPlanilla($this->decodificar);
		$res = $dbEmpleadoPlanilla ->   ContarEmpleadoPlanillaDinamica ($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_planilla,$id_tipo_planilla,$cc);
		$this->salida = $dbEmpleadoPlanilla ->salida;
		$this->query = $dbEmpleadoPlanilla ->query;
		return $res;
	}
	
	
		function ListarEmpleadoPlanillaDinamica($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_planilla,$id_tipo_planilla,$cc)
	{
		$this->salida = "";
		$dbEmpleadoPlanilla = new cls_DBEmpleadoPlanilla($this->decodificarodificar);
		$res = $dbEmpleadoPlanilla ->ListarEmpleadoPlanillaDinamica($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_planilla,$id_tipo_planilla,$cc);
		$this->salida = $dbEmpleadoPlanilla ->salida;
		$this->query = $dbEmpleadoPlanilla ->query;
		return $res;
	}
	
	function InsertarEmpleadoPlanilla($id_empleado_planilla,$id_empleado,$id_planilla)
	{
		$this->salida = "";
		$dbEmpleadoPlanilla = new cls_DBEmpleadoPlanilla($this->decodificar);
		$res = $dbEmpleadoPlanilla ->InsertarEmpleadoPlanilla($id_empleado_planilla,$id_empleado,$id_planilla);
		$this->salida = $dbEmpleadoPlanilla ->salida;
		$this->query = $dbEmpleadoPlanilla ->query;
		return $res;
	}
	
		function ModificarEmpleadoPlanilla($id_empleado_planilla,$id_empleado,$id_planilla,$pago_liquido)
	{
		$this->salida = "";
		$dbEmpleadoPlanilla = new cls_DBEmpleadoPlanilla($this->decodificar);
		$res = $dbEmpleadoPlanilla ->ModificarEmpleadoPlanilla($id_empleado_planilla,$id_empleado,$id_planilla,$pago_liquido);
		$this->salida = $dbEmpleadoPlanilla ->salida;
		$this->query = $dbEmpleadoPlanilla ->query;
		return $res;
	}
	
	function EliminarEmpleadoPlanilla($id_empleado_planilla)
	{
		$this->salida = "";
		$dbEmpleadoPlanilla = new cls_DBEmpleadoPlanilla($this->decodificar);
		$res = $dbEmpleadoPlanilla -> EliminarEmpleadoPlanilla($id_empleado_planilla);
		$this->salida = $dbEmpleadoPlanilla ->salida;
		$this->query = $dbEmpleadoPlanilla ->query;
		return $res;
	}
	
	function ValidarEmpleadoPlanilla($operacion_sql,$id_empleado_planilla,$id_empleado,$id_planilla)
	{
		$this->salida = "";
		$dbEmpleadoPlanilla = new cls_DBEmpleadoPlanilla($this->decodificar);
		$res = $dbEmpleadoPlanilla ->ValidarEmpleadoPlanilla($operacion_sql,$id_empleado_planilla,$id_empleado,$id_planilla);
		$this->salida = $dbEmpleadoPlanilla ->salida;
		$this->query = $dbEmpleadoPlanilla ->query;
		return $res;
	}
	
		function ModificarEmpleadoColumna($bandera,$id_grid,$id_planilla)
	{
		$this->salida = "";
		$dbEmpleadoPlanilla = new cls_DBEmpleadoPlanilla($this->decodificar);
		$res = $dbEmpleadoPlanilla ->ModificarEmpleadoColumna($bandera,$id_grid,$id_planilla);
		$this->salida = $dbEmpleadoPlanilla ->salida;
		$this->query = $dbEmpleadoPlanilla ->query;
		return $res;
	}
	
	
	/// --------------------- fin tkp_empleado_planilla --------------------- ///
	
	/// --------------------- tkp_planilla --------------------- ///

	function ListarPlanilla($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbPlanilla = new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla ->ListarPlanilla($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	
	function ContarPlanilla($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbPlanilla = new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla ->ContarPlanilla($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	
	function InsertarPlanilla($id_planilla,$id_tipo_planilla,$id_periodo,$id_moneda,$numero,$estado,$observaciones,$fecha_planilla)
	{
		$this->salida = "";
		$dbPlanilla = new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla ->InsertarPlanilla($id_planilla,$id_tipo_planilla,$id_periodo,$id_moneda,$numero,$estado,$observaciones,$fecha_planilla);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	
	function ModificarPlanilla($id_planilla,$id_tipo_planilla,$id_periodo,$id_moneda,$numero,$estado,$observaciones,$fecha_planilla)
	{
		$this->salida = "";
		$dbPlanilla = new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla ->ModificarPlanilla($id_planilla,$id_tipo_planilla,$id_periodo,$id_moneda,$numero,$estado,$observaciones,$fecha_planilla);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	
	
	function  calcularPlanillaCompleta($id_planilla)
	{
		$this->salida = "";
		$dbPlanilla = new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla -> calcularPlanillaCompleta($id_planilla);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	
	function EliminarPlanilla($id_planilla)
	{
		$this->salida = "";
		$dbPlanilla = new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla -> EliminarPlanilla($id_planilla);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	
	function ValidarPlanilla($operacion_sql,$id_planilla,$id_tipo_planilla,$id_periodo,$id_moneda,$numero,$estado,$observaciones)
	{
		$this->salida = "";
		$dbPlanilla = new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla ->ValidarPlanilla($operacion_sql,$id_planilla,$id_tipo_planilla,$id_periodo,$id_moneda,$numero,$estado,$observaciones);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	
	function generarPlanilla($id_planilla,$tipo)
	{
		$this->salida = "";
		$dbPlanilla = new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla ->generarPlanilla($id_planilla,$tipo);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	
	function clonarPlanilla($id_planilla_padre,$tipo,$id_tipo_planilla,$id_periodo,$id_moneda,$numero,$estado,$observaciones,$fecha_planilla)
	{
		$this->salida = "";
		$dbPlanilla = new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla ->clonarPlanilla($id_planilla_padre,$tipo,$id_tipo_planilla,$id_periodo,$id_moneda,$numero,$estado,$observaciones,$fecha_planilla);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	
		function calcularPlanillaAnticipo($id_planilla)
	{
		$this->salida = "";
		$dbPlanilla = new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla ->calcularPlanillaAnticipo($id_planilla);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	function ResumenCostosPersonal($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_planilla)
	{
		$this->salida = "";
		$dbPlanilla = new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla ->ResumenCostosPersonal($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_planilla);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	function ResumenCostosPersonalDis($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_planilla,$fecha_planilla)
	{
		$this->salida = "";
		$dbPlanilla = new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla ->ResumenCostosPersonalDis($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_planilla,$fecha_planilla);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	function ResumenDistritos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_planilla,$fecha_planilla)
	{
		$this->salida = "";
		$dbPlanilla = new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla ->ResumenDistritos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_planilla,$fecha_planilla);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	/// --------------------- fin tkp_planilla --------------------- ///
	
	/// --------------------- tkp_columna_valor --------------------- ///

	function ListarColumnaValor($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbColumnaValor = new cls_DBColumnaValor($this->decodificar);
		$res = $dbColumnaValor ->ListarColumnaValor($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbColumnaValor ->salida;
		$this->query = $dbColumnaValor ->query;
		return $res;
	}
	
	function ContarColumnaValor($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbColumnaValor = new cls_DBColumnaValor($this->decodificar);
		$res = $dbColumnaValor ->ContarColumnaValor($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbColumnaValor ->salida;
		$this->query = $dbColumnaValor ->query;
		return $res;
	}
	
	function InsertarColumnaValor($id_columna_valor,$valor)
	{
		$this->salida = "";
		$dbColumnaValor = new cls_DBColumnaValor($this->decodificar);
		$res = $dbColumnaValor ->InsertarColumnaValor($id_columna_valor,$valor);
		$this->salida = $dbColumnaValor ->salida;
		$this->query = $dbColumnaValor ->query;
		return $res;
	}
	
	
	function InsertarColumnaValorArray($id_empleado_planilla_array,$id_columna_array,$id_valor_array,$tam)
	{
		$this->salida = "";
		$dbColumnaValor = new cls_DBColumnaValor($this->decodificar);
		$res = $dbColumnaValor -> InsertarColumnaValorArray($id_empleado_planilla_array,$id_columna_array,$id_valor_array,$tam);
		$this->salida = $dbColumnaValor ->salida;
		$this->query = $dbColumnaValor ->query;
		return $res;
	}
	
	
	function ModificarColumnaValor($id_columna_valor,$valor)
	{
		$this->salida = "";
		$dbColumnaValor = new cls_DBColumnaValor($this->decodificar);
		$res = $dbColumnaValor ->ModificarColumnaValor($id_columna_valor,$valor);
		$this->salida = $dbColumnaValor ->salida;
		$this->query = $dbColumnaValor ->query;
		return $res;
	}
	
	function EliminarColumnaValor($id_columna_valor)
	{
		$this->salida = "";
		$dbColumnaValor = new cls_DBColumnaValor($this->decodificar);
		$res = $dbColumnaValor -> EliminarColumnaValor($id_columna_valor);
		$this->salida = $dbColumnaValor ->salida;
		$this->query = $dbColumnaValor ->query;
		return $res;
	}
	
	function ValidarColumnaValor($operacion_sql,$id_columna_valor,$valor)
	{
		$this->salida = "";
		$dbColumnaValor = new cls_DBColumnaValor($this->decodificar);
		$res = $dbColumnaValor ->ValidarColumnaValor($operacion_sql,$id_columna_valor,$valor);
		$this->salida = $dbColumnaValor ->salida;
		$this->query = $dbColumnaValor ->query;
		return $res;
	}
	//avq
	function ListarRepPlanillaCab($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->ListarRepPlanillaCab($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	
	function ListarRepPlanillaSum($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->ListarRepPlanillaSum($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	function ListarRepPlanillaDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->ListarRepPlanillaDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	function ListarRepPlanillaCol($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->ListarRepPlanillaCol($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	
	function ListaPlanillaSueldoNetoDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->ListaPlanillaSueldoNetoDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	function ListaPapeletaSueldo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->ListaPapeletaSueldo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	
	function ListaPlanillaImpositiva($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->ListaPlanillaImpositiva($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	function ListaPlanillaImpositivaAreas($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->ListaPlanillaImpositivaAreas($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	function ListarSumRepPlanillaDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->ListarSumRepPlanillaDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	
	
	
	//ENDE-001 :19dic12-MZM : Procedimiento para reporte de planilla de aguinaldo con formato para presentacion ante la Jefatura de Trabajo 
	
	
	function ListarRepPlanillaAguinaldo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_planilla)
	{
		$this->salida = "";
		$dbEmpleadoPlanilla = new cls_DBRepPlanilla($this->decodificarodificar);
		$res = $dbEmpleadoPlanilla ->ListarRepPlanillaAguinaldo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_planilla);
		$this->salida = $dbEmpleadoPlanilla ->salida;
		$this->query = $dbEmpleadoPlanilla ->query;
		return $res;
	}
   function ListarRepPlanillaPrimas($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_planilla)
	{
		$this->salida = "";
		$dbEmpleadoPlanilla = new cls_DBRepPlanilla($this->decodificarodificar);
		$res = $dbEmpleadoPlanilla ->ListarRepPlanillaPrimas($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_planilla);
		$this->salida = $dbEmpleadoPlanilla ->salida;
		$this->query = $dbEmpleadoPlanilla ->query;
		return $res;
	}
	/// --------------------- fin tkp_columna_valor --------------------- ///
	
	
	
	
	/*********************************PlanillaPresupuesto************************************/
	
	function ListarPlanillaPresupuesto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbAfp = new  cls_DBPlanillaPresupuesto($this->decodificar);
		$res = $dbAfp ->ListarPlanillaPresupuesto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp->query;
		return $res;
	}
	function  ContarPlanillaPresupuesto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbAfp= new cls_DBPlanillaPresupuesto($this->decodificar);
		$res = $dbAfp-> ContarPlanillaPresupuesto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp->query;
		return $res;
	}
	
	

	function InsertarPlanillaPresupuesto($id_planilla_presupuesto,$id_planilla,$id_presupuesto,$porcentaje)
	{
				
		$this->salida = "";
		$dbAfp = new cls_DBPlanillaPresupuesto($this->decodificar);
		$res = $dbAfp ->InsertarPlanillaPresupuesto($id_planilla_presupuesto,$id_planilla,$id_presupuesto,$porcentaje);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}

	function ModificarPlanillaPresupuesto($id_planilla_presupuesto,$id_planilla,$id_presupuesto,$porcentaje)
	{
		$this->salida = "";
		$dbAfp = new cls_DBPlanillaPresupuesto($this->decodificar);
		$res = $dbAfp ->ModificarPlanillaPresupuesto($id_planilla_presupuesto,$id_planilla,$id_presupuesto,$porcentaje);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}

	function EliminarPlanillaPresupuesto($id_planilla_presupuesto)
	{
		$this->salida = "";
		$dbAfp = new cls_DBPlanillaPresupuesto($this->decodificar);
		$res = $dbAfp ->EliminarPlanillaPresupuesto($id_planilla_presupuesto);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}
	
	function ComprometerPptoPlanilla($id_planilla_presupuesto,$accion)
	{
		$this->salida = "";
		$dbAfp = new cls_DBPlanillaPresupuesto($this->decodificar);
		$res = $dbAfp ->ComprometerPptoPlanilla($id_planilla_presupuesto,$accion);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}
//6jul11 MZM reporte de ejecucion presupuestaria por planilla
	function ListarRepPlanillaPpto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad){
		$this->salida = "";
		$dbPlanillaPpto = new cls_DBPlanillaPresupuesto($this->decodificar);
		$res = $dbPlanillaPpto ->ListarRepPlanillaPpto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbPlanillaPpto->salida;
		$this->query = $dbPlanillaPpto ->query;
		return $res;
	}
	
			/// --------------------- tkp_parametro_cuenta_auxiliar --------------------- ///

	function ListarParametroCuentaAuxiliar($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbParametroCuentaAuxiliar = new cls_DBParametroCuentaAuxiliar($this->decodificar);
		$res = $dbParametroCuentaAuxiliar ->ListarParametroCuentaAuxiliar($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbParametroCuentaAuxiliar ->salida;
		$this->query = $dbParametroCuentaAuxiliar ->query;
		return $res;
	}
	
	function ContarParametroCuentaAuxiliar($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbParametroCuentaAuxiliar = new cls_DBParametroCuentaAuxiliar($this->decodificar);
		$res = $dbParametroCuentaAuxiliar ->ContarParametroCuentaAuxiliar($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbParametroCuentaAuxiliar ->salida;
		$this->query = $dbParametroCuentaAuxiliar ->query;
		return $res;
	}
	
	function InsertarParametroCuentaAuxiliar($id_parametro_cuenta_auxiliar,$id_cuenta,$id_auxiliar,$id_gestion,$id_presupuesto,$id_columna_tipo,$id_orden_trabajo)
	{
		$this->salida = "";
		$dbParametroCuentaAuxiliar = new cls_DBParametroCuentaAuxiliar($this->decodificar);
		$res = $dbParametroCuentaAuxiliar ->InsertarParametroCuentaAuxiliar($id_parametro_cuenta_auxiliar,$id_cuenta,$id_auxiliar,$id_gestion,$id_presupuesto,$id_columna_tipo,$id_orden_trabajo);
		$this->salida = $dbParametroCuentaAuxiliar ->salida;
		$this->query = $dbParametroCuentaAuxiliar ->query;
		return $res;
	}
	
	function ModificarParametroCuentaAuxiliar($id_parametro_cuenta_auxiliar,$id_cuenta,$id_auxiliar,$id_gestion,$id_presupuesto,$id_columna_tipo,$id_orden_trabajo)
	{
		$this->salida = "";
		$dbParametroCuentaAuxiliar = new cls_DBParametroCuentaAuxiliar($this->decodificar);
		$res = $dbParametroCuentaAuxiliar ->ModificarParametroCuentaAuxiliar($id_parametro_cuenta_auxiliar,$id_cuenta,$id_auxiliar,$id_gestion,$id_presupuesto,$id_columna_tipo,$id_orden_trabajo);
		$this->salida = $dbParametroCuentaAuxiliar ->salida;
		$this->query = $dbParametroCuentaAuxiliar ->query;
		return $res;
	}
	
	function EliminarParametroCuentaAuxiliar($id_parametro_cuenta_auxiliar)
	{
		$this->salida = "";
		$dbParametroCuentaAuxiliar = new cls_DBParametroCuentaAuxiliar($this->decodificar);
		$res = $dbParametroCuentaAuxiliar -> EliminarParametroCuentaAuxiliar($id_parametro_cuenta_auxiliar);
		$this->salida = $dbParametroCuentaAuxiliar ->salida;
		$this->query = $dbParametroCuentaAuxiliar ->query;
		return $res;
	}
	
	function ValidarParametroCuentaAuxiliar($operacion_sql,$id_parametro_cuenta_auxiliar,$id_cuenta,$id_auxiliar,$id_gestion,$id_presupuesto,$id_columna_tipo,$id_orden_trabajo)
	{
		$this->salida = "";
		$dbParametroCuentaAuxiliar = new cls_DBParametroCuentaAuxiliar($this->decodificar);
		$res = $dbParametroCuentaAuxiliar ->ValidarParametroCuentaAuxiliar($operacion_sql,$id_parametro_cuenta_auxiliar,$id_cuenta,$id_auxiliar,$id_gestion,$id_presupuesto,$id_columna_tipo,$id_orden_trabajo);
		$this->salida = $dbParametroCuentaAuxiliar ->salida;
		$this->query = $dbParametroCuentaAuxiliar ->query;
		return $res;
	}
	
	/// --------------------- fin tkp_parametro_cuenta_auxiliar --------------------- ///
	
	
/*********************************TIPO_OBLIGACION************************************/
	
	function ListarTipoObligacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbAfp = new cls_DBTipoObligacion($this->decodificar);
		$res = $dbAfp ->ListarTipoObligacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp->query;
		return $res;
	}
	function ContarTipoObligacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbAfp= new cls_DBTipoObligacion($this->decodificar);
		$res = $dbAfp->ContarTipoObligacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp->query;
		return $res;
	}
	

	function InsertarTipoObligacion($id_tipo_obligacion,$codigo,$nombre)
	{
		$this->salida = "";
		$dbAfp = new cls_DBTipoObligacion($this->decodificar);
		$res = $dbAfp ->InsertarTipoObligacion($id_tipo_obligacion,$codigo,$nombre);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}

	function ModificarTipoObligacion($id_tipo_obligacion,$codigo,$nombre)
	{
		$this->salida = "";
		$dbAfp = new cls_DBTipoObligacion($this->decodificar);
		$res = $dbAfp ->ModificarTipoObligacion($id_tipo_obligacion,$codigo,$nombre);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}

	function EliminarTipoObligacion($id_tipo_obligacion)
	{
		$this->salida = "";
		$dbAfp = new cls_DBTipoObligacion($this->decodificar);
		$res = $dbAfp ->EliminarTipoObligacion($id_tipo_obligacion);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}
/// --------------------- tkp_resumen_horario_mes --------------------- ///

	function ListarResumenHorarioMes($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbResumenHorarioMes = new cls_DBResumenHorarioMes($this->decodificar);
		$res = $dbResumenHorarioMes ->ListarResumenHorarioMes($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbResumenHorarioMes ->salida;
		$this->query = $dbResumenHorarioMes ->query;
		return $res;
	}
	
	function ContarResumenHorarioMes($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbResumenHorarioMes = new cls_DBResumenHorarioMes($this->decodificar);
		$res = $dbResumenHorarioMes ->ContarResumenHorarioMes($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbResumenHorarioMes ->salida;
		$this->query = $dbResumenHorarioMes ->query;
		return $res;
	}
	function ListarEmpleadoPlanillaF($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbResumenHorarioMes = new cls_DBResumenHorarioMes($this->decodificar);
		$res = $dbResumenHorarioMes ->ListarEmpleadoPlanillaF($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbResumenHorarioMes ->salida;
		$this->query = $dbResumenHorarioMes ->query;
		return $res;
	}
	
	function ContarEmpleadoPlanillaF($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbResumenHorarioMes = new cls_DBResumenHorarioMes($this->decodificar);
		$res = $dbResumenHorarioMes ->ContarEmpleadoPlanillaF($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbResumenHorarioMes ->salida;
		$this->query = $dbResumenHorarioMes ->query;
		return $res;
	}
	function InsertarResumenHorarioMes($id_resumen_horario_mes,$id_empleado_planilla_f,$id_planilla)
	{
		$this->salida = "";
		$dbResumenHorarioMes = new cls_DBResumenHorarioMes($this->decodificar);
		$res = $dbResumenHorarioMes ->InsertarResumenHorarioMes($id_resumen_horario_mes,$id_empleado_planilla_f,$id_planilla);
		$this->salida = $dbResumenHorarioMes ->salida;
		$this->query = $dbResumenHorarioMes ->query;
		return $res;
	}
	function ModificarResumenHorarioMes($id_resumen_horario_mes,$id_empleado_planilla,$horas_disp,$horas_normales,$horas_extra,$horas_nocturnas,$costo_horas_normales,$costo_horas_extra,$costo_horas_nocturnas,$costo_horas_disp,$horas_normales_efectivas)
	{
		$this->salida = "";
		$dbResumenHorarioMes = new cls_DBResumenHorarioMes($this->decodificar);
		$res = $dbResumenHorarioMes ->ModificarResumenHorarioMes($id_resumen_horario_mes,$id_empleado_planilla,$horas_disp,$horas_normales,$horas_extra,$horas_nocturnas,$costo_horas_normales,$costo_horas_extra,$costo_horas_nocturnas,$costo_horas_disp,$horas_normales_efectivas);
		$this->salida = $dbResumenHorarioMes ->salida;
		$this->query = $dbResumenHorarioMes ->query;
		return $res;
	}
	
	function EliminarResumenHorarioMes($id_resumen_horario_mes)
	{
		$this->salida = "";
		$dbResumenHorarioMes = new cls_DBResumenHorarioMes($this->decodificar);
		$res = $dbResumenHorarioMes ->EliminarResumenHorarioMes($id_resumen_horario_mes);
		$this->salida = $dbResumenHorarioMes ->salida;
		$this->query = $dbResumenHorarioMes ->query;
		return $res;
	}
	function CargaResumenMarcas($id_resumen_horario_mes,$fecha_desde,$fecha_hasta)
	{
		$this->salida = "";
		$dbResumenHorarioMes = new cls_DBResumenHorarioMes($this->decodificar);
		$res = $dbResumenHorarioMes ->CargaResumenMarcas($id_resumen_horario_mes,$fecha_desde,$fecha_hasta);
		$this->salida = $dbResumenHorarioMes ->salida;
		$this->query = $dbResumenHorarioMes ->query;
		return $res;
	}
	function ValidaResumen($id_resumen_horario_mes,$horas_disp,$horas_normales,$horas_extra,$horas_nocturnas)
	{
		$this->salida = "";
		$dbResumenHorarioMes = new cls_DBResumenHorarioMes($this->decodificar);
		$res = $dbResumenHorarioMes ->ValidaResumen($id_resumen_horario_mes,$horas_disp,$horas_normales,$horas_extra,$horas_nocturnas);
		$this->salida = $dbResumenHorarioMes ->salida;
		$this->query = $dbResumenHorarioMes ->query;
		return $res;
	}
	function ValidaResumenTodos($id_planilla)
	{
		$this->salida = "";
		$dbResumenHorarioMes = new cls_DBResumenHorarioMes($this->decodificar);
		$res = $dbResumenHorarioMes ->ValidaResumenTodos($id_planilla);
		$this->salida = $dbResumenHorarioMes ->salida;
		$this->query = $dbResumenHorarioMes ->query;
		return $res;
	}
	function CorrigeResumen($id_resumen_horario_mes,$tipo)
	{
		$this->salida = "";
		$dbResumenHorarioMes = new cls_DBResumenHorarioMes($this->decodificar);
		$res = $dbResumenHorarioMes ->CorrigeResumen($id_resumen_horario_mes,$tipo);
		$this->salida = $dbResumenHorarioMes ->salida;
		$this->query = $dbResumenHorarioMes ->query;
		return $res;
	}
	function ProrrateaHoras($id_resumen_horario_mes,$id_empleado_planilla,$horas_normales,$horas_extra,$horas_disp,$horas_nocturnas)
	{
		$this->salida = "";
		$dbResumenHorarioMes = new cls_DBResumenHorarioMes($this->decodificar);
		$res = $dbResumenHorarioMes ->ProrrateaHoras($id_resumen_horario_mes,$id_empleado_planilla,$horas_normales,$horas_extra,$horas_disp,$horas_nocturnas);
		$this->salida = $dbResumenHorarioMes ->salida;
		$this->query = $dbResumenHorarioMes ->query;
		return $res;
	}
	function ProrrateaHorasTodos($id_planilla)
	{
		$this->salida = "";
		$dbResumenHorarioMes = new cls_DBResumenHorarioMes($this->decodificar);
		$res = $dbResumenHorarioMes ->ProrrateaHorasTodos($id_planilla);
		$this->salida = $dbResumenHorarioMes ->salida;
		$this->query = $dbResumenHorarioMes ->query;
		return $res;
	}
	function ProrrateaOtrosHoras($id_resumen_horario_mes,$tipo)
	{
		$this->salida = "";
		$dbResumenHorarioMes = new cls_DBResumenHorarioMes($this->decodificar);
		$res = $dbResumenHorarioMes ->ProrrateaOtrosHoras($id_resumen_horario_mes,$tipo);
		$this->salida = $dbResumenHorarioMes ->salida;
		$this->query = $dbResumenHorarioMes ->query;
		return $res;
	}
	function ValidarResumenHorarioMes($operacion_sql,$id_resumen_horario_mes,$id_empleado_planilla,$horas_disp,$horas_normales,$horas_extra,$horas_nocturnas)
	{
		$this->salida = "";
		$dbResumenHorarioMes = new cls_DBResumenHorarioMes($this->decodificar);
		$res = $dbResumenHorarioMes ->ValidarResumenHorarioMes($operacion_sql,$id_resumen_horario_mes,$id_empleado_planilla,$horas_disp,$horas_normales,$horas_extra,$horas_nocturnas);
		$this->salida = $dbResumenHorarioMes ->salida;
		$this->query = $dbResumenHorarioMes ->query;
		return $res;
	}
	
	/// --------------------- fin tkp_resumen_horario_mes --------------------- ///
	
	
	
	/*********************************ESCALA SALARIAL************************************/
	
	function ListarEscalaSalarial($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEscalaSalarial = new cls_DBEscalaSalarial($this->decodificar);
		$res = $dbEscalaSalarial ->ListarEscalaSalarial($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEscalaSalarial->salida;
		$this->query = $dbEscalaSalarial->query;
		return $res;
	}
	function ContarEscalaSalarial($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEscalaSalarial= new cls_DBEscalaSalarial($this->decodificar);
		$res = $dbEscalaSalarial->ContarEscalaSalarial($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEscalaSalarial->salida;
		$this->query = $dbEscalaSalarial->query;
		return $res;
	}
	


	function InsertarEscalaSalarial($id_escala_salarial,$nombre,$nivel,$estado_reg,$descripcion,$sueldo_mensual)
	{
		$this->salida = "";
		$dbEscalaSalarial = new cls_DBEscalaSalarial($this->decodificar);
		$res = $dbEscalaSalarial ->InsertarEscalaSalarial($id_escala_salarial,$nombre,$nivel,$estado_reg,$descripcion,$sueldo_mensual);
		$this->salida = $dbEscalaSalarial->salida;
		$this->query = $dbEscalaSalarial ->query;
		return $res;
	}

	function ModificarEscalaSalarial($id_escala_salarial,$nombre,$nivel,$estado_reg,$descripcion,$sueldo_mensual)
	{
		$this->salida = "";
		$dbEscalaSalarial = new cls_DBEscalaSalarial($this->decodificar);
		$res = $dbEscalaSalarial ->ModificarEscalaSalarial($id_escala_salarial,$nombre,$nivel,$estado_reg,$descripcion,$sueldo_mensual);
		$this->salida = $dbEscalaSalarial->salida;
		$this->query = $dbEscalaSalarial ->query;
		return $res;
	}
	function EliminarEscalaSalarial($id_escala_salarial)
	{
		$this->salida = "";
		$dbEscalaSalarial = new cls_DBEscalaSalarial($this->decodificar);
		$res = $dbEscalaSalarial ->EliminarEscalaSalarial($id_escala_salarial);
		$this->salida = $dbEscalaSalarial->salida;
		$this->query = $dbEscalaSalarial ->query;
		return $res;
	}
	
	function ValidarEscalaSalarial($operacion_sql,$id_escala_salarial,$nombre,$nivel,$estado_reg,$descripcion)
	{
		$this->salida = "";
		$dbEscalaSalarial= new cls_DBEscalaSalarial($this->decodificar);
		$res = $dbEscalaSalarial->ValidarEscalaSalarial($operacion_sql,$id_escala_salarial,$nombre,$nivel,$estado_reg,$descripcion);
		$this->salida = $dbEscalaSalarial->salida;
		$this->query = $dbEscalaSalarial->query;
		return $res;
	}
	
	
	/*******10-11-2014********/
	function InsertarEscalaSalarialIncremento($id_rango_ini, $id_rango_fin,$porcentaje, $fecha_aplicacion)
	{
		$this->salida = "";
		$dbEscalaSalarial = new cls_DBEscalaSalarial($this->decodificar);
		$res = $dbEscalaSalarial ->InsertarEscalaSalarialIncremento($id_rango_ini, $id_rango_fin,$porcentaje, $fecha_aplicacion);
		$this->salida = $dbEscalaSalarial->salida;
		$this->query = $dbEscalaSalarial ->query;
		return $res;
	}
	
	
	
	/************************************ COLUMNA PARTIDA EJECUCION ********************************************/
	
	function ListarVistaColParEje($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbVistaColParEje = new cls_DBColumnaPartidaEjecucion($this->decodificar);
		$res = $dbVistaColParEje->ListarVistaColParEje($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbVistaColParEje->salida;
		$this->query = $dbVistaColParEje->query;
		return $res;
	}
	function ContarVistaColParEje($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbVistaColParEje= new cls_DBColumnaPartidaEjecucion($this->decodificar);
		$res = $dbVistaColParEje->ContarVistaColParEje($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbVistaColParEje->salida;
		$this->query = $dbVistaColParEje->query;
		return $res;
	}
	
		function ListarColumnaPartidaEjecucionObli($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbVistaColParEje = new cls_DBColumnaPartidaEjecucion($this->decodificar);
		$res = $dbVistaColParEje->ListarColumnaPartidaEjecucionObli($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbVistaColParEje->salida;
		$this->query = $dbVistaColParEje->query;
		return $res;
	}
	function ContarColumnaPartidaEjecucionObli($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbVistaColParEje= new cls_DBColumnaPartidaEjecucion($this->decodificar);
		$res = $dbVistaColParEje->ContarColumnaPartidaEjecucionObli($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbVistaColParEje->salida;
		$this->query = $dbVistaColParEje->query;
		return $res;
	}

	

	function ListarColumnaPartidaEjecucionArb($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBColumnaPartidaEjecucion($this->decodificar);
		$res = $dbUnidadOrganizacional ->ListarColumnaPartidaEjecucionArb($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	function ContarColumnaPartidaEjecucionArb($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbUnidadOrganizacional = new cls_DBColumnaPartidaEjecucion($this->decodificar);
		$res = $dbUnidadOrganizacional ->ContarColumnaPartidaEjecucionArb($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbUnidadOrganizacional ->salida;
		$this->query = $dbUnidadOrganizacional ->query;
		return $res;
	}
	
	/// --------------------- tkp_parametro_costo_planilla --------------------- ///

	function ListarAsignaPago($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbParametroCostoPlanilla = new cls_DBParametroCostoPlanilla($this->decodificar);
		$res = $dbParametroCostoPlanilla ->ListarAsignaPago($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbParametroCostoPlanilla ->salida;
		$this->query = $dbParametroCostoPlanilla ->query;
		return $res;
	}
	
	function ContarListaAsignaPago($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbParametroCostoPlanilla = new cls_DBParametroCostoPlanilla($this->decodificar);
		$res = $dbParametroCostoPlanilla ->ContarListaAsignaPago($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbParametroCostoPlanilla ->salida;
		$this->query = $dbParametroCostoPlanilla ->query;
		return $res;
	}
	function ListarProrrateoHoras($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbParametroCostoPlanilla = new cls_DBParametroCostoPlanilla($this->decodificar);
		$res = $dbParametroCostoPlanilla ->ListarProrrateoHoras($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbParametroCostoPlanilla ->salida;
		$this->query = $dbParametroCostoPlanilla ->query;
		return $res;
	}
	
	function ContarProrrateoHoras($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbParametroCostoPlanilla = new cls_DBParametroCostoPlanilla($this->decodificar);
		$res = $dbParametroCostoPlanilla ->ContarProrrateoHoras($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbParametroCostoPlanilla ->salida;
		$this->query = $dbParametroCostoPlanilla ->query;
		return $res;
	}
	function InsertarParametroCostoPlanilla($id_parametro_costo_planilla,$id_empleado_planilla,$id_gestion,$id_presupuesto,$id_orden_trabajo,$id_resumen_horario_mes,$horas_normales,$horas_extra,$horas_nocturnas,$horas_disp)
	{
		$this->salida = "";
		$dbParametroCostoPlanilla = new cls_DBParametroCostoPlanilla($this->decodificar);
		$res = $dbParametroCostoPlanilla ->InsertarParametroCostoPlanilla($id_parametro_costo_planilla,$id_empleado_planilla,$id_gestion,$id_presupuesto,$id_orden_trabajo,$id_resumen_horario_mes,$horas_normales,$horas_extra,$horas_nocturnas,$horas_disp);
		$this->salida = $dbParametroCostoPlanilla ->salida;
		$this->query = $dbParametroCostoPlanilla ->query;
		return $res;
	}
	function InsertarAsignaPago($hidden_id_parametro_costo_planilla, $hidden_id_empleado,$hidden_id_gestion,$hidden_id_presupuesto,$txt_valor,$txt_estado_reg,$hidden_orden_trabajo)
	{
		$this->salida = "";
		$dbParametroCostoPlanilla = new cls_DBParametroCostoPlanilla($this->decodificar);
		$res = $dbParametroCostoPlanilla ->InsertarAsignaPago($hidden_id_parametro_costo_planilla, $hidden_id_empleado,$hidden_id_gestion,$hidden_id_presupuesto,$txt_valor,$txt_estado_reg,$hidden_orden_trabajo);
		$this->salida = $dbParametroCostoPlanilla ->salida;
		$this->query = $dbParametroCostoPlanilla ->query;
		return $res;
	}
	function ModificarParametroCostoPlanilla($id_parametro_costo_planilla,$id_empleado_planilla,$id_gestion,$id_presupuesto,$id_orden_trabajo,$id_resumen_horario_mes,$horas_normales,$horas_extra,$horas_nocturnas,$horas_disp)
	{
		$this->salida = "";
		$dbParametroCostoPlanilla = new cls_DBParametroCostoPlanilla($this->decodificar);
		$res = $dbParametroCostoPlanilla ->ModificarParametroCostoPlanilla($id_parametro_costo_planilla,$id_empleado_planilla,$id_gestion,$id_presupuesto,$id_orden_trabajo,$id_resumen_horario_mes,$horas_normales,$horas_extra,$horas_nocturnas,$horas_disp);
		$this->salida = $dbParametroCostoPlanilla ->salida;
		$this->query = $dbParametroCostoPlanilla ->query;
		return $res;
	}
	function ModificarAsignaPago($hidden_id_parametro_costo_planilla, $hidden_id_empleado,$hidden_id_gestion,$hidden_id_presupuesto,$txt_valor,$txt_estado_reg,$hidden_orden_trabajo)
	{
		$this->salida = "";
		$dbParametroCostoPlanilla = new cls_DBParametroCostoPlanilla($this->decodificar);
		$res = $dbParametroCostoPlanilla ->ModificarAsignaPago($hidden_id_parametro_costo_planilla, $hidden_id_empleado,$hidden_id_gestion,$hidden_id_presupuesto,$txt_valor,$txt_estado_reg,$hidden_orden_trabajo);
		$this->salida = $dbParametroCostoPlanilla ->salida;
		$this->query = $dbParametroCostoPlanilla ->query;
		return $res;
	}
	function EliminarParametroCostoPlanilla($id_parametro_costo_planilla)
	{
		$this->salida = "";
		$dbParametroCostoPlanilla = new cls_DBParametroCostoPlanilla($this->decodificar);
		$res = $dbParametroCostoPlanilla -> EliminarParametroCostoPlanilla($id_parametro_costo_planilla);
		$this->salida = $dbParametroCostoPlanilla ->salida;
		$this->query = $dbParametroCostoPlanilla ->query;
		return $res;
	}
	function EliminarAsignaPago($id_parametro_costo_planilla)
	{
		$this->salida = "";
		$dbParametroCostoPlanilla = new cls_DBParametroCostoPlanilla($this->decodificar);
		$res = $dbParametroCostoPlanilla -> EliminarAsignaPago($id_parametro_costo_planilla);
		$this->salida = $dbParametroCostoPlanilla ->salida;
		$this->query = $dbParametroCostoPlanilla ->query;
		return $res;
	}
	function ValidarParametroCostoPlanilla($operacion_sql,$id_parametro_costo_planilla,$id_empleado_planilla,$id_gestion,$id_presupuesto,$id_orden_trabajo,$id_resumen_horario_mes,$horas_normales)
	{
		$this->salida = "";
		$dbParametroCostoPlanilla = new cls_DBParametroCostoPlanilla($this->decodificar);
		$res = $dbParametroCostoPlanilla ->ValidarParametroCostoPlanilla($operacion_sql,$id_parametro_costo_planilla,$id_empleado_planilla,$id_gestion,$id_presupuesto,$id_orden_trabajo,$id_resumen_horario_mes,$horas_normales);
		$this->salida = $dbParametroCostoPlanilla ->salida;
		$this->query = $dbParametroCostoPlanilla ->query;
		return $res;
	}
	/// --------------------- fin tkp_parametro_costo_planilla --------------------- ///



/*********************************TIPO_OBLIGACION************************************/
	
	function ListarObligacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbAfp = new cls_DBObligacion($this->decodificar);
		$res = $dbAfp ->ListarObligacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp->query;
		return $res;
	}
	function ContarObligacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbAfp= new cls_DBObligacion($this->decodificar);
		$res = $dbAfp->ContarObligacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp->query;
		return $res;
	}
	

	function InsertarObligacion($id_obligacion,$id_tipo_obligacion,$id_planilla,$id_comprobante,$monto,$estado_reg,$observaciones,$id_cuenta_bancaria,$tipo_pago,$id_gestion)
	{
		$this->salida = "";
		$dbAfp = new cls_DBObligacion($this->decodificar);
		$res = $dbAfp ->InsertarObligacion($id_obligacion,$id_tipo_obligacion,$id_planilla,$id_comprobante,$monto,$estado_reg,$observaciones,$id_cuenta_bancaria,$tipo_pago,$id_gestion);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}

	function ModificarObligacion($id_obligacion,$id_tipo_obligacion,$id_planilla,$id_comprobante,$monto,$estado_reg,$observaciones,$id_cuenta_bancaria,$tipo_pago,$id_cuenta,$id_auxiliar,$id_gestion)
	{
		$this->salida = "";
		$dbAfp = new cls_DBObligacion($this->decodificar);
		$res = $dbAfp ->ModificarObligacion($id_obligacion,$id_tipo_obligacion,$id_planilla,$id_comprobante,$monto,$estado_reg,$observaciones,$id_cuenta_bancaria,$tipo_pago,$id_cuenta,$id_auxiliar,$id_gestion);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}

	function EliminarObligacion($id_obligacion)
	{
		$this->salida = "";
		$dbAfp = new cls_DBObligacion($this->decodificar);
		$res = $dbAfp ->EliminarObligacion($id_obligacion);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}
	
	
	/*function PagarObligacion($id_obligacion,$id_tipo_obligacion,$id_planilla,$id_comprobante,$monto,$estado_reg,$observaciones,$id_cuenta_bancaria,$tipo_pago,$mi_array,$cantidad_obligaciones
	//,$fecha_pago
	)
	{
		$this->salida = "";
		$dbAfp = new cls_DBObligacion($this->decodificar);
		$res = $dbAfp ->PagarObligacion($id_obligacion,$id_tipo_obligacion,$id_planilla,$id_comprobante,$monto,$estado_reg,$observaciones,$id_cuenta_bancaria,$tipo_pago,$mi_array,$cantidad_obligaciones
		//,$fecha_pago
		);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}*/
	
	function PagarObligacion($id_obligacion,$id_tipo_obligacion,$id_planilla,$id_comprobante,$monto,$estado_reg,$observaciones,$id_cuenta_bancaria,$tipo_pago,$mi_array,$cantidad_obligaciones
	,$fecha_pago,$obs_pago,$acreedor,$id_lugar
	)
	{
		$this->salida = "";
		$dbAfp = new cls_DBObligacion($this->decodificar);
		$res = $dbAfp ->PagarObligacion($id_obligacion,$id_tipo_obligacion,$id_planilla,$id_comprobante,$monto,$estado_reg,$observaciones,$id_cuenta_bancaria,$tipo_pago,$mi_array,$cantidad_obligaciones
		,$fecha_pago,$obs_pago, $acreedor,$id_lugar
		);
		$this->salida = $dbAfp->salida;
		$this->query = $dbAfp ->query;
		return $res;
	}
	
		/**********************************TIPO COLUMNA BASE*****************************************/
	function ListarTipoColumnaBase($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbTipoColumnaBase = new cls_DBTipoColumnaBase($this->decodificar);
		$res = $dbTipoColumnaBase ->ListarTipoColumnaBase($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbTipoColumnaBase ->salida;
		$this->query = $dbTipoColumnaBase ->query;
		return $res;
	}
	
	function ContarTipoColumnaBase($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbTipoColumnaBase = new cls_DBTipoColumnaBase($this->decodificar);
		$res = $dbTipoColumnaBase ->ContarTipoColumnaBase($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbTipoColumnaBase ->salida;
		$this->query = $dbTipoColumnaBase ->query;
		return $res;
	}
	
	function InsertarTipoColumnaBase($id_tipo_columna_base,$prioridad,$id_tipo_columna,$id_tipo_columna_fk,$fecha_reg)
	{
		$this->salida = "";
		$dbTipoColumnaBase = new cls_DBTipoColumnaBase($this->decodificar);
		$res = $dbTipoColumnaBase ->InsertarTipoColumnaBase($id_tipo_columna_base,$prioridad,$id_tipo_columna,$id_tipo_columna_fk,$fecha_reg);
		$this->salida = $dbTipoColumnaBase ->salida;
		$this->query = $dbTipoColumnaBase ->query;
		return $res;
	}
	
	function ModificarTipoColumnaBase($id_tipo_columna_base,$prioridad,$id_tipo_columna,$id_tipo_columna_fk,$fecha_reg)
	{
		$this->salida = "";
		$dbTipoColumnaBase = new cls_DBTipoColumnaBase($this->decodificar);
		$res = $dbTipoColumnaBase ->ModificarTipoColumnaBase($id_tipo_columna_base,$prioridad,$id_tipo_columna,$id_tipo_columna_fk,$fecha_reg);
		$this->salida = $dbTipoColumnaBase ->salida;
		$this->query = $dbTipoColumnaBase ->query;
		return $res;
	}
	
	function EliminarTipoColumnaBase($id_tipo_columna_base)
	{
		$this->salida = "";
		$dbTipoColumnaBase = new cls_DBTipoColumnaBase($this->decodificar);
		$res = $dbTipoColumnaBase -> EliminarTipoColumnaBase($id_tipo_columna_base);
		$this->salida = $dbTipoColumnaBase ->salida;
		$this->query = $dbTipoColumnaBase ->query;
		return $res;
	}
	
	function ValidarTipoColumnaBase($operacion_sql,$id_tipo_columna_base,$prioridad,$id_tipo_columna,$id_tipo_columna_fk,$fecha_reg)
	{
		$this->salida = "";
		$dbTipoColumnaBase = new cls_DBTipoColumnaBase($this->decodificar);
		$res = $dbTipoColumnaBase ->ValidarTipoColumnaBase($operacion_sql,$id_tipo_columna_base,$prioridad,$id_tipo_columna,$id_tipo_columna_fk,$fecha_reg);
		$this->salida = $dbTipoColumnaBase ->salida;
		$this->query = $dbTipoColumnaBase ->query;
		return $res;
	}
	
	
	
	/**********************************FACTORES KARDEX*****************************************/
	function ListarFactoresKardex($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbFactoresKardex= new cls_DBFactoresKardex($this->decodificar);
		$res = $dbFactoresKardex->ListarFactoresKardex($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbFactoresKardex->salida;
		$this->query = $dbFactoresKardex ->query;
		return $res;
	}
	
	function ContarFactoresKardex($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbFactoresKardex= new cls_DBFactoresKardex($this->decodificar);
		$res = $dbFactoresKardex->ContarFactoresKardex($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbFactoresKardex->salida;
		$this->query = $dbFactoresKardex->query;
		return $res;
	}
	
	function InsertarFactoresKardex($id_factores_kardex,$codigo, $nombre, $valor, $estado_reg,$descripcion)
	{
		$this->salida = "";
		$dbFactoresKardex= new cls_DBFactoresKardex($this->decodificar);
		$res = $dbFactoresKardex->InsertarFactoresKardex($id_factores_kardex,$codigo, $nombre, $valor, $estado_reg,$descripcion);
		$this->salida = $dbFactoresKardex->salida;
		$this->query = $dbFactoresKardex ->query;
		return $res;
	}
	
	function ModificarFactoresKardex($id_factores_kardex,$codigo,$nombre,$valor, $estado_reg,$descripcion)
	{
		$this->salida = "";
		$dbFactoresKardex= new cls_DBFactoresKardex($this->decodificar);
		$res = $dbFactoresKardex->ModificarFactoresKardex($id_factores_kardex,$codigo,$nombre,$valor, $estado_reg,$descripcion);
		$this->salida = $dbFactoresKardex->salida;
		$this->query = $dbFactoresKardex->query;
		return $res;
	}
	
	function EliminarFactoresKardex($id_factores_kardex)
	{
		$this->salida = "";
		$dbFactoresKardex= new cls_DBFactoresKardex($this->decodificar);
		$res = $dbFactoresKardex-> EliminarFactoresKardex($id_factores_kardex);
		$this->salida = $dbFactoresKardex->salida;
		$this->query = $dbFactoresKardex ->query;
		return $res;
	}
	
	function ValidarFactoresKardex($operacion_sql,$id_factores_kardex,$codigo,$nombre,$valor, $estado_reg)
	{
		$this->salida = "";
		$dbFactoresKardex= new cls_DBFactoresKardex($this->decodificar);
		$res = $dbFactoresKardex->ValidarFactoresKardex($operacion_sql,$id_factores_kardex,$codigo,$nombre,$valor, $estado_reg);
		$this->salida = $dbFactoresKardex->salida;
		$this->query = $dbFactoresKardex ->query;
		return $res;
	}
	
	function ListarObligacionPlanillaDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepObligacion= new cls_DBRepObligacion($this->decodificar);
		$res = $dbRepObligacion->ListarObligacionPlanillaDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepObligacion->salida;
		$this->query = $dbRepObligacion ->query;
		return $res;
	}
	function ListarObligacionPlanillaCab($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepObligacion= new cls_DBRepObligacion($this->decodificar);
		$res = $dbRepObligacion->ListarObligacionPlanillaCab($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepObligacion->salida;
		$this->query = $dbRepObligacion ->query;
		return $res;
	}
/// --------------------- tkp_vacacion --------------------- ///

	function ListarVacacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->ListarVacacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	
	function ContarVacacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->ContarVacacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	function ListarSolicitudLicencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->ListarSolicitudLicencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	
	function ContarSolicitudLicencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->ContarSolicitudLicencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	function ListarSolicitudLicenciaDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->ListarSolicitudLicenciaDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	
	function ContarSolicitudLicenciaDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->ContarSolicitudLicenciaDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	function ListarAprobarSolicitudLicenciaDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->ListarAprobarSolicitudLicenciaDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	
	function ContarAprobarSolicitudLicenciaDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->ContarAprobarSolicitudLicenciaDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	function ListarAprobarSolicitudLicencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->ListarAprobarSolicitudLicencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	
	function ContarAprobarSolicitudLicencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->ContarAprobarSolicitudLicencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	function InsertarSolicitudLicencia($id_vacacion,$id_gestion,$id_empleado)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->InsertarSolicitudLicencia($id_vacacion,$id_gestion,$id_empleado);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	function EliminarSolicitudLicencia($id_vacacion)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion -> EliminarSolicitudLicencia($id_vacacion);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	function InsertarSolicitudLicenciaDet($id_horario,$id_tipo_horario,$id_vacacion,$fecha_inicio,$fecha_fin,$tipo_periodo,$observaciones)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->InsertarSolicitudLicenciaDet($id_horario,$id_tipo_horario,$id_vacacion,$fecha_inicio,$fecha_fin,$tipo_periodo,$observaciones);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	
	function ModificarSolicitudLicenciaDet($id_horario,$id_tipo_horario,$id_vacacion,$fecha_inicio,$fecha_fin,$tipo_periodo,$observaciones)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->ModificarSolicitudLicenciaDet($id_horario,$id_tipo_horario,$id_vacacion,$fecha_inicio,$fecha_fin,$tipo_periodo,$observaciones);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	
	function EliminarSolicitudLicenciaDet($id_horario)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion -> EliminarSolicitudLicenciaDet($id_horario);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	function InsertarReformularSolicitudLicenciaDet($id_horario,$id_tipo_horario,$id_vacacion,$num_solicitud,$fecha_inicio,$fecha_fin,$tipo_periodo,$observaciones)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->InsertarReformularSolicitudLicenciaDet($id_horario,$id_tipo_horario,$id_vacacion,$num_solicitud,$fecha_inicio,$fecha_fin,$tipo_periodo,$observaciones);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	
	function ModificarReformularSolicitudLicenciaDet($id_horario,$id_tipo_horario,$id_vacacion,$num_solicitud,$fecha_inicio,$fecha_fin,$tipo_periodo,$observaciones)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->ModificarReformularSolicitudLicenciaDet($id_horario,$id_tipo_horario,$id_vacacion,$num_solicitud,$fecha_inicio,$fecha_fin,$tipo_periodo,$observaciones);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	
	function EliminarReformularSolicitudLicenciaDet($id_horario,$num_solicitud)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
	//	echo "Custom".$id_horario;
		//echo "<br>".$num_solicitud;
		//exit;
		$res = $dbVacacion -> EliminarReformularSolicitudLicenciaDet($id_horario,$num_solicitud);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	function InsertarVacacion($id_vacacion,$id_gestion,$id_empleado,$id_categoria_vacacion,$total_dias)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->InsertarVacacion($id_vacacion,$id_gestion,$id_empleado,$id_categoria_vacacion,$total_dias);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	
	function ModificarVacacion($id_vacacion,$id_gestion,$id_empleado,$id_categoria_vacacion,$total_dias)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->ModificarVacacion($id_vacacion,$id_gestion,$id_empleado,$id_categoria_vacacion,$total_dias);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	
	function EliminarVacacion($id_vacacion)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion -> EliminarVacacion($id_vacacion);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	
	function ValidarVacacion($operacion_sql,$id_vacacion,$id_gestion,$id_empleado,$id_categoria_vacacion,$total_dias)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->ValidarVacacion($operacion_sql,$id_vacacion,$id_gestion,$id_empleado,$id_categoria_vacacion,$total_dias);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	
	
	function RepSolicitudLicencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empleado,$id_vacacion,$id_tipo_horario,$id_emp_aprobador)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion -> RepSolicitudLicencia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empleado,$id_vacacion,$id_tipo_horario,$id_emp_aprobador);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
		
	function SumarHorasXDia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empleado,$id_tipo_horario,$numero_sol,$id_vacacion,$id_emp_aprobador)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion -> SumarHorasXDia($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_empleado,$id_tipo_horario,$numero_sol,$id_vacacion,$id_emp_aprobador);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	function InsertarAdelantaLicencia($id_vacacion,$fecha_inicio,$fecha_fin,$tipo_periodo,$observaciones)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->InsertarAdelantaLicencia($id_vacacion,$fecha_inicio,$fecha_fin,$tipo_periodo,$observaciones);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	
	function RepResSolicitud($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion -> RepResSolicitud($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	function InsertarSolicitudLicenciaG($id_vacacion,$id_empleado)
	{
		$this->salida = "";
		$dbVacacion = new cls_DBVacacion($this->decodificar);
		$res = $dbVacacion ->InsertarSolicitudLicenciaG($id_vacacion,$id_empleado);
		$this->salida = $dbVacacion ->salida;
		$this->query = $dbVacacion ->query;
		return $res;
	}
	/// --------------------- fin tkp_vacacion --------------------- ///
	
		//avq 23/03/2011
	function ListarEmpleadoCuentasBancRep($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->ListarEmpleadoCuentasBancRep($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	
	//avq 25/03/2011
	function SumEmpleadoDistrito($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->SumEmpleadoDistrito($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	 
	function ListaPlanillaDatosEmpleado($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->ListaPlanillaDatosEmpleado($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	function ListarEmpleadoBonos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)

	{
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->ListarEmpleadoBonos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	function ListarSumEmpleadoBonos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)

	{
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->ListarSumEmpleadoBonos($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	function ListaHistoricosAsignacionesEmpleados($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)

	{
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->ListaHistoricosAsignacionesEmpleados($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	/**
	 * ana 17/05/2011
	 * 
	 */
	
	function RepEmpleadoContratosDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepEmpleado = new cls_DBRepEmpleado($this->decodificar);
		$res = $dbRepEmpleado ->RepEmpleadoContratosDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepEmpleado ->salida;
		$this->query = $dbRepEmpleado ->query;
		return $res;
	}
	function RepEmpleadoContratosCargosDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepEmpleado = new cls_DBRepEmpleado($this->decodificar);
		$res = $dbRepEmpleado ->RepEmpleadoContratosCargosDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepEmpleado ->salida;
		$this->query = $dbRepEmpleado ->query;
		return $res;
	}
	
	
	
	function ListarArchivoPago($id_planilla,$id_subsistema,$id_cuenta_bancaria,$codigo)
	{ 
		$this->salida = "";
		$dbPlanilla= new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla ->ListarArchivoPago($id_planilla,$id_subsistema,$id_cuenta_bancaria,$codigo);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	
	function ListarArchivoDavinci($id_planilla,$codigo,$monto)
	{
		$this->salida = "";
		$dbPlanilla= new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla ->ListarArchivoDavinci($id_planilla,$codigo,$monto);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	function ListarArchivoTrimestral($id_planilla)
	{
		$this->salida = "";
		$dbPlanilla= new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla ->ListarArchivoTrimestral($id_planilla);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	
	//AVQ 13/06/2011
	function RepEmpleadoAFPsDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepEmpleadoAFP= new cls_DBRepEmpleadoAFP($this->decodificar);
		$res = $dbRepEmpleadoAFP ->RepEmpleadoAFPsDetalle($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepEmpleadoAFP ->salida;
		$this->query = $dbRepEmpleadoAFP ->query;
		return $res;
	}
	
	
	function RepDetalleAfp($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepEmpleadoAFP= new cls_DBRepEmpleadoAFP($this->decodificar);
		$res = $dbRepEmpleadoAFP ->RepDetalleAfp($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepEmpleadoAFP ->salida;
		$this->query = $dbRepEmpleadoAFP ->query;
		return $res;
	}
	//AVQ  27/06/2011
	function DatosEmpleadoCV($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepEmpleado= new cls_DBRepEmpleado($this->decodificar);
		$res = $dbRepEmpleado->DatosEmpleadoCV($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepEmpleado ->salida;
		$this->query = $dbRepEmpleado ->query;
		return $res;
	}
	function DatosCapacitacionEmpleadoCV($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepEmpleado= new cls_DBRepEmpleado($this->decodificar);
		$res = $dbRepEmpleado->DatosCapacitacionEmpleadoCV($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepEmpleado ->salida;
		$this->query = $dbRepEmpleado ->query;
		return $res;
	}
	function DatosExperienciaLabEmpleadoCV($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepEmpleado= new cls_DBRepEmpleado($this->decodificar);
		$res = $dbRepEmpleado->DatosExperienciaLabEmpleadoCV($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepEmpleado ->salida;
		$this->query = $dbRepEmpleado ->query;
		return $res;
	}
	function DatosRelacionesFamiliares($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepEmpleado= new cls_DBRepEmpleado($this->decodificar);
		$res = $dbRepEmpleado->DatosRelacionesFamiliares($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepEmpleado ->salida;
		$this->query = $dbRepEmpleado ->query;
		return $res;
	}
	
	//AVQ  22/06/2011
	function SolPagoObligacionCab($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepObligacion= new cls_DBRepObligacion($this->decodificar);
		$res = $dbRepObligacion->SolPagoObligacionCab($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepObligacion ->salida;
		$this->query = $dbRepObligacion ->query;
		return $res;
	}
	
	function SolPagoObligacionEPDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepObligacion= new cls_DBRepObligacion($this->decodificar);
		$res = $dbRepObligacion->SolPagoObligacionEPDet($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepObligacion ->salida;
		$this->query = $dbRepObligacion ->query;
		return $res;
	}
	// avq 06/07/2011
	function ObtenerAfps($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepEmpleadoAFP= new cls_DBRepEmpleadoAFP($this->decodificar);
		$res = $dbRepEmpleadoAFP ->ObtenerAfps($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepEmpleadoAFP ->salida;
		$this->query = $dbRepEmpleadoAFP ->query;
		return $res;
	}
	
	//06.2014
	function ListarArchivoMin($id_planilla,$codigo)
	{
		$this->salida = "";
		$dbPlanilla= new cls_DBPlanillaK($this->decodificar);
		$res = $dbPlanilla ->ListarArchivoMin($id_planilla, $codigo);
		$this->salida = $dbPlanilla ->salida;
		$this->query = $dbPlanilla ->query;
		return $res;
	}
	
	
	
	/******************************** COMPENSACION *********************************/
	
	function ListarCompensacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbCompensacion = new cls_DBCompensacion($this->decodificar);
		$res = $dbCompensacion ->ListarCompensacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbCompensacion ->salida;
		$this->query = $dbCompensacion ->query;
		return $res;
	}
	
	function ContarCompensacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbCompensacion = new cls_DBCompensacion($this->decodificar);
		$res = $dbCompensacion ->ContarCompensacion($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbCompensacion ->salida;
		$this->query = $dbCompensacion ->query;
		return $res;
	}
	
	function InsertarCompensacion($id_compensacion,$fecha_inicio,$fecha_fin,$compensado,$id_empleado,$total_dias)
	{
		$this->salida = "";
		$dbCompensacion = new cls_DBCompensacion($this->decodificar);
		$res = $dbCompensacion ->InsertarCompensacion($id_compensacion,$fecha_inicio,$fecha_fin,$compensado,$id_empleado,$total_dias);
		$this->salida = $dbCompensacion ->salida;
		$this->query = $dbCompensacion ->query;
		return $res;
	}
	
	function ModificarCompensacion($id_compensacion,$fecha_inicio,$fecha_fin,$compensado,$id_empleado,$total_dias)
	{
		$this->salida = "";
		$dbCompensacion = new cls_DBCompensacion($this->decodificar);
		$res = $dbCompensacion ->ModificarCompensacion($id_compensacion,$fecha_inicio,$fecha_fin,$compensado,$id_empleado,$total_dias);
		$this->salida = $dbCompensacion ->salida;
		$this->query = $dbCompensacion ->query;
		return $res;
	}
	
	function EliminarCompensacion($id_compensacion,$id_empleado)
	{
		$this->salida = "";
		$dbCompensacion = new cls_DBCompensacion($this->decodificar);
		$res = $dbCompensacion -> EliminarCompensacion($id_compensacion,$id_empleado);
		$this->salida = $dbCompensacion ->salida;
		$this->query = $dbCompensacion ->query;
		return $res;
	}
	
	function ValidarCompensacion($operacion_sql,$id_compensacion,$fecha_inicio,$fecha_fin,$compensado,$id_empleado,$total_dias)
	{
		$this->salida = "";
		$dbCompensacion = new cls_DBCompensacion($this->decodificar);
		$res = $dbCompensacion ->ValidarCompensacion($operacion_sql,$id_compensacion,$fecha_inicio,$fecha_fin,$compensado,$id_empleado,$total_dias);
		$this->salida = $dbCompensacion ->salida;
		$this->query = $dbCompensacion ->query;
		return $res;
	}
	/// --------------------- tkp_compensacion --------------------- ///
	/// --------------------- tkp_tarjeta --------------------- ///

	function ListarTarjeta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbTarjeta = new cls_DBTarjeta($this->decodificar);
		$res = $dbTarjeta ->Listartarjeta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbTarjeta ->salida;
		$this->query = $dbTarjeta ->query;
		return $res;
	}
	
	function ContarListaTarjeta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbTarjeta = new cls_DBTarjeta($this->decodificar);
		$res = $dbTarjeta ->ContarListaTarjeta($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbTarjeta ->salida;
		$this->query = $dbTarjeta ->query;
		return $res;
	}
	function InsertarTarjeta($id_tarjeta, $estado_codigo,$id_empleado,$nombre_usuario)
	{
		$this->salida = "";
		$dbTarjeta = new cls_DBTarjeta($this->decodificar);
		$res = $dbTarjeta ->InsertarTarjeta($id_tarjeta, $estado_codigo,$id_empleado,$nombre_usuario);
		$this->salida = $dbTarjeta ->salida;
		$this->query = $dbTarjeta ->query;
		return $res;
	}
	function ModificarTarjeta($id_tarjeta, $estado_codigo,$id_empleado,$nombre_usuario)
	{
		$this->salida = "";
		$dbTarjeta = new cls_DBTarjeta($this->decodificar);
		$res = $dbTarjeta ->ModificarTarjeta($id_tarjeta, $estado_codigo,$id_empleado,$nombre_usuario);
		$this->salida = $dbTarjeta ->salida;
		$this->query = $dbTarjeta ->query;
		return $res;
	}
	function EliminarTarjeta($id_tarjeta)
	{
		$this->salida = "";
		$dbTarjeta = new cls_DBTarjeta($this->decodificar);
		$res = $dbTarjeta -> EliminarTarjeta($id_tarjeta);
		$this->salida = $dbTarjeta ->salida;
		$this->query = $dbTarjeta ->query;
		return $res;
	}
	/// --------------------- fin tkp_tarjeta --------------------- ///

	
      
	/// --------------------- tkp_planilla_trimestral --------------------- ///

	
	function InsertarPlanillaTrimestral($id_planilla_trimestral,$ci_firma,$fecha,$firma,$inc_permanente_p,$inc_permanente_t,$inc_temporal,$muerte,$num_accidentes,$num_enfermedad_trabajo,$num_ingresos_trim,$num_retiros_trim,$num_turnos_trabajo, $id_planilla,$lugar)
	{ 
	
		$this->salida = "";
		$dbEventoPlanilla = new cls_DBPlanillaTrimestral($this->decodificar);
		$res = $dbEventoPlanilla ->InsertarPlanillaTrimestral($id_planilla_trimestral,$ci_firma,$fecha,$firma,$inc_permanente_p,$inc_permanente_t,$inc_temporal,$muerte,$num_accidentes,$num_enfermedad_trabajo,$num_ingresos_trim,$num_retiros_trim,$num_turnos_trabajo, $id_planilla,$lugar);
		$this->salida = $dbEventoPlanilla ->salida;
		$this->query = $dbEventoPlanilla ->query;
		return $res;   
	}  
	/// --------------------- fin tkp_tarjeta --------------------- ///
	function ListaPapeletaAguinaldo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{    
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->ListaPapeletaAguinaldo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	function  DescuentosEmpleadosHoras($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{    
		$this->salida = "";
		$dbRepEmpleado = new cls_DBRepEmpleado($this->decodificar);
		$res = $dbRepEmpleado -> DescuentosEmpleadosHoras($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepEmpleado ->salida;
		$this->query = $dbRepEmpleado ->query;
		return $res;
	}
	
function ListaPapeletaPrima($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{    
		$this->salida = "";
		$dbRepPlanilla = new cls_DBRepPlanilla($this->decodificar);
		$res = $dbRepPlanilla ->ListaPapeletaPrima($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepPlanilla ->salida;
		$this->query = $dbRepPlanilla ->query;
		return $res;
	}
	
	//13feb12
	/// --------------------- tkp_empleado_ppto --------------------- ///

	function ListarEmpleadoPpto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoPpto = new cls_DBEmpleadoPpto($this->decodificar);
		$res = $dbEmpleadoPpto ->ListarEmpleadoPpto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoPpto ->salida;
		$this->query = $dbEmpleadoPpto ->query;
		return $res;
	}
	
	function ContarEmpleadoPpto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbEmpleadoPpto = new cls_DBEmpleadoPpto($this->decodificar);
		$res = $dbEmpleadoPpto ->ContarEmpleadoPpto($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbEmpleadoPpto ->salida;
		$this->query = $dbEmpleadoPpto ->query;
		return $res;
	}
	
	
	function InsertarEmpleadoPpto($id_empleado_ppto,$id_empleado,$id_presupuesto,$id_gestion,$porcentaje,$estado_reg,$fecha_ini,$fecha_fin)
	{
		$this->salida = "";
		$dbEmpleadoPpto = new cls_DBEmpleadoPpto($this->decodificar);
		$res = $dbEmpleadoPpto ->InsertarEmpleadoPpto($id_empleado_ppto,$id_empleado,$id_presupuesto,$id_gestion,$porcentaje,$estado_reg,$fecha_ini,$fecha_fin);
		$this->salida = $dbEmpleadoPpto ->salida;
		$this->query = $dbEmpleadoPpto ->query;
		return $res;
	}
	
	function ModificarEmpleadoPpto($id_empleado_ppto,$id_empleado,$id_presupuesto,$id_gestion,$porcentaje,$estado_reg,$fecha_ini,$fecha_fin)
	{
		$this->salida = "";
		$dbEmpleadoPpto = new cls_DBEmpleadoPpto($this->decodificar);
		$res = $dbEmpleadoPpto ->ModificarEmpleadoPpto($id_empleado_ppto,$id_empleado,$id_presupuesto,$id_gestion,$porcentaje,$estado_reg,$fecha_ini,$fecha_fin);
		$this->salida = $dbEmpleadoPpto ->salida;
		$this->query = $dbEmpleadoPpto ->query;
		return $res;
	}
	
	function EliminarEmpleadoPpto($id_empleado_ppto)
	{
		$this->salida = "";
		$dbEmpleadoPpto = new cls_DBEmpleadoPpto($this->decodificar);
		$res = $dbEmpleadoPpto -> EliminarEmpleadoPpto($id_empleado_ppto);
		$this->salida = $dbEmpleadoPpto ->salida;
		$this->query = $dbEmpleadoPpto ->query;
		return $res;
	}
	
	function DatosEmpleadosAreas($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbRepEmpleado = new cls_DBRepEmpleado($this->decodificar);
		$res = $dbRepEmpleado -> DatosEmpleadosAreas($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepEmpleado ->salida;
		$this->query = $dbRepEmpleado ->query;
		return $res;
	}
  function DatosEmpleadosSindicato($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{  
		$this->salida = "";
		$dbRepEmpleado = new cls_DBRepEmpleado($this->decodificar);
		$res = $dbRepEmpleado ->DatosEmpleadosSindicato($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbRepEmpleado->salida;
		$this->query = $dbRepEmpleado->query;
		return $res;
	}
	
	
	//06.2014 CLASIFICADOR RETENCIONES
	function ListarClasificadorRetenciones($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbClasificadorRetenciones = new cls_DBClasificadorRetenciones($this->decodificar);
		$res = $dbClasificadorRetenciones ->ListarClasificadorRetenciones($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbClasificadorRetenciones->salida;
		$this->query = $dbClasificadorRetenciones ->query;
		return $res;
	}
	
	function ContarClasificadorRetenciones($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbClasificadorRetenciones = new cls_DBClasificadorRetenciones($this->decodificar);
		$res = $dbClasificadorRetenciones ->ContarClasificadorRetenciones($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbClasificadorRetenciones ->salida;
		$this->query = $dbClasificadorRetenciones ->query;
		return $res;
	}
	
	
	function InsertarClasificadorRetenciones($id_clasificador_retenciones,$nombre,$id_tipo_columna,$codigo,$estado_reg)
	{
		$this->salida = "";
		$dbClasificadorRetenciones = new cls_DBClasificadorRetenciones($this->decodificar);
		$res = $dbClasificadorRetenciones->InsertarClasificadorRetenciones($id_clasificador_retenciones,$nombre,$id_tipo_columna,$codigo,$estado_reg);
		$this->salida = $dbClasificadorRetenciones ->salida;
		$this->query = $dbClasificadorRetenciones ->query;
		return $res;
	}
	
	function ModificarClasificadorRetenciones($id_clasificador_retenciones,$nombre,$id_tipo_columna,$codigo,$estado_reg)
	{
		$this->salida = "";
		$dbClasificadorRetenciones = new cls_DBClasificadorRetenciones($this->decodificar);
		$res = $dbClasificadorRetenciones ->ModificarClasificadorRetenciones($id_clasificador_retenciones,$nombre,$id_tipo_columna,$codigo,$estado_reg);
		$this->salida = $dbClasificadorRetenciones ->salida;
		$this->query = $dbClasificadorRetenciones ->query;
		return $res;
	}
	
	function EliminarClasificadorRetenciones($id_clasificador_retenciones)
	{
		$this->salida = "";
		$dbClasificadorRetenciones = new cls_DBClasificadorRetenciones($this->decodificar);
		$res = $dbClasificadorRetenciones -> EliminarClasificadorRetenciones($id_clasificador_retenciones);
		$this->salida = $dbClasificadorRetenciones ->salida;
		$this->query = $dbClasificadorRetenciones ->query;
		return $res;
	}
	/********************************************09.05.2014*****************************************/
	
	function ListarTipoContrato($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbTipoContrato = new cls_DBTipoContrato($this->decodificar);
		$res = $dbTipoContrato ->ListarTipoContrato($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbTipoContrato ->salida;
		$this->query = $dbTipoContrato ->query;
		return $res;
	}
	
	function ContarListaTipoContrato($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbTipoContrato = new cls_DBTipoContrato($this->decodificar);
		$res = $dbTipoContrato ->ContarListaTipoContrato($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbTipoContrato ->salida;
		$this->query = $dbTipoContrato ->query;
		return $res;
	}
	
	function InsertarTipoContrato($id_tipo_contrato,$codigo,$nombre)
	{
		$this->salida = "";
		$dbTipoContrato = new cls_DBTipoContrato($this->decodificar);
		$res = $dbTipoContrato ->InsertarTipoContrato($id_tipo_contrato,$codigo,$nombre);
		$this->salida = $dbTipoContrato ->salida;
		$this->query = $dbTipoContrato ->query;
		return $res;
	}
	
	function ModificarTipoContrato($id_tipo_contrato,$codigo,$nombre)
	{
		$this->salida = "";
		$dbTipoContrato = new cls_DBTipoContrato($this->decodificar);
		$res = $dbTipoContrato ->ModificarTipoContrato($id_tipo_contrato,$codigo,$nombre);
		$this->salida = $dbTipoContrato ->salida;
		$this->query = $dbTipoContrato ->query;
		return $res;
	}
	
	function EliminarTipoContrato($id_tipo_contrato)
	{
		$this->salida = "";
		$dbTipoContrato = new cls_DBTipoContrato($this->decodificar);
		$res = $dbTipoContrato -> EliminarTipoContrato($id_tipo_contrato);
		$this->salida = $dbTipoContrato ->salida;
		$this->query = $dbTipoContrato ->query;
		return $res;
	}
	
	function ValidarTipoContrato($operacion_sql,$id_tipo_contrato,$codigo,$nombre)
	{
		$this->salida = "";
		$dbTipoContrato = new cls_DBTipoContrato($this->decodificar);
		$res = $dbTipoContrato ->ValidarTipoContrato($operacion_sql,$id_tipo_contrato,$codigo,$nombre);
		$this->salida = $dbTipoContrato ->salida;
		$this->query = $dbTipoContrato ->query;
		return $res;
	}
	/***************************************************************/
	
	function ListarCargo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbCargo = new cls_DBCargo($this->decodificar);
		$res = $dbCargo ->ListarCargo($cant, $puntero, $sortcol, $sortdir, $criterio_filtro, $id_financiador, $id_regional, $id_programa, $id_proyecto, $id_actividad);
		$this->salida = $dbCargo ->salida;
		$this->query = $dbCargo ->query;
		return $res;
	}
	
	function ContarCargo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad)
	{
		$this->salida = "";
		$dbCargo = new cls_DBCargo($this->decodificar);
		$res = $dbCargo ->ContarCargo($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad);
		$this->salida = $dbCargo ->salida;
		$this->query = $dbCargo ->query;
		return $res;
	}
	
	function InsertarCargo($id_cargo, $id_escala_salarial, $numero_item, $tipo_item, $codigo_cargo, $nombre_cargo, $id_tipo_contrato)
	{
		$this->salida = "";
		$dbCargo = new cls_DBCargo($this->decodificar);
		$res = $dbCargo ->InsertarCargo($id_cargo, $id_escala_salarial, $numero_item, $tipo_item, $codigo_cargo, $nombre_cargo, $id_tipo_contrato);
		$this->salida = $dbCargo ->salida;
		$this->query = $dbCargo ->query;
		return $res;
	}
	
	function ModificarCargo($id_cargo, $id_escala_salarial, $numero_item, $tipo_item, $codigo_cargo, $nombre_cargo, $id_tipo_contrato,$estado_reg)
	{
		$this->salida = "";
		$dbCargo = new cls_DBCargo($this->decodificar);
		$res = $dbCargo ->ModificarCargo($id_cargo, $id_escala_salarial, $numero_item, $tipo_item, $codigo_cargo, $nombre_cargo, $id_tipo_contrato,$estado_reg);
		$this->salida = $dbCargo ->salida;
		$this->query = $dbCargo ->query;
		return $res;
	}
	
	function EliminarCargo($id_cargo)
	{
		$this->salida = "";
		$dbCargo = new cls_DBCargo($this->decodificar);
		$res = $dbCargo -> EliminarCargo($id_cargo);
		$this->salida = $dbCargo ->salida;
		$this->query = $dbCargo ->query;
		return $res;
	}
	
	function ValidarCargo($operacion_sql, $id_cargo, $id_escala_salarial, $numero_item, $tipo_item, $codigo_cargo, $nombre_cargo, $id_tipo_contrato)
	{
		$this->salida = "";
		$dbCargo = new cls_DBCargo($this->decodificar);
		$res = $dbCargo ->ValidarCargo($operacion_sql, $id_cargo, $id_escala_salarial, $numero_item, $tipo_item, $codigo_cargo, $nombre_cargo, $id_tipo_contrato);
		$this->salida = $dbCargo ->salida;
		$this->query = $dbCargo ->query;
		return $res;
	}
	
	
}
?>