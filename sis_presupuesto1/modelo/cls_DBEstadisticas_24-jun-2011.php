<?php
/**
 * Nombre de la clase:	cls_DBEstadisiticas.php
 * Prop�sito:			Permite obtenere informacion estadistica sobre las transacciones realizadas
 * Autor:				(autogenerado)
 * Fecha creaci�n:		2008-07-04 08:54:27
 */

 
class cls_DBEstadisticas
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
	 * Nombre de la funci�n:	ListarEstadisticasSistema
	 * Prop�sito:				Desplegar los registros de tpr_categoria
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 08:54:27
	 */
	function ListarEstadisticasSistema($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_subsistema,$id_usuario,$gestion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_estadisticas_sel';
		
		/*echo $id_usuario;
		exit();*/
		
		if(($id_usuario =='' || $id_usuario=='%') && ($id_subsistema=='' || $id_subsistema=='%'))
		{
			//filtrando solo por gestion
			$id_usuario=0;
			$id_subsistema=0;
			$this->codigo_procedimiento = "'SG_TRANS_SISTEMA_1_SEL'";
		}
		else 
		{	
			
			if($id_subsistema=='' || $id_subsistema=='%')
			{
				//filtrando por gestion y usuario
				$id_subsistema=0;
				$this->codigo_procedimiento = "'SG_TRANS_SISTEMA_2_SEL'";
			}
			else 
			{
				if($id_usuario=='' || $id_usuario=='%')
				{
					//filtrando por gestion y subsistema
					$id_usuario=0;
					$this->codigo_procedimiento = "'SG_TRANS_SISTEMA_3_SEL'";
				}
				else 
				{	
					//filtrando por gestion, usuario y subsistema
					$this->codigo_procedimiento = "'SG_TRANS_SISTEMA_4_SEL'";
				}
			}
		}
		

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
		
		$this->var->add_param($id_subsistema);
		$this->var->add_param($id_usuario);
		$this->var->add_param($gestion);
		
		/*$this->var->id_subsistema = $id_subsistema;
		$this->var->id_usuario = $id_usuario;
		$this->var->gestion = $gestion;*/

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('nombre_largo','text');
		$this->var->add_def_cols('enero','bigint');
		$this->var->add_def_cols('febrero','bigint');
		$this->var->add_def_cols('marzo','bigint');
		$this->var->add_def_cols('abril','bigint');
		$this->var->add_def_cols('mayo','bigint');
		$this->var->add_def_cols('junio','bigint');
		$this->var->add_def_cols('julio','bigint');
		$this->var->add_def_cols('agosto','bigint');
		$this->var->add_def_cols('septiembre','bigint');
		$this->var->add_def_cols('octubre','bigint');
		$this->var->add_def_cols('noviembre','bigint');
		$this->var->add_def_cols('diciembre','bigint');
		$this->var->add_def_cols('total','bigint');
	

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo $this->query;
		exit ();*/
		
		return $res;
	}
	
	/**
	 * Nombre de la funci�n:	ContarCategoria
	 * Prop�sito:				Contar los registros de tpr_categoria
	 * Autor:				    (autogenerado)
	 * Fecha de creaci�n:		2008-07-04 08:54:27
	 */
	function ListarEstadisticasUsuario($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_subsistema,$id_usuario,$gestion)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tsg_estadisticas_sel';
		
				
		if(($id_usuario =='' || $id_usuario=='%') && ($id_subsistema=='' || $id_subsistema=='%'))
		{
			//filtrando solo por gestion
			$id_usuario=0;
			$id_subsistema=0;
			$this->codigo_procedimiento = "'SG_TRANS_USUARIO_1_SEL'";
		}
		else 
		{	
			if($id_usuario=='' || $id_usuario=='%')
			{
				//filtrando por gestion y subsistema
				$id_usuario=0;
				$this->codigo_procedimiento = "'SG_TRANS_USUARIO_2_SEL'";
			}
			else 
			{
				if($id_subsistema=='' || $id_subsistema=='%')
				{
					//filtrando por gestion y usuario
					$id_subsistema=0;
					$this->codigo_procedimiento = "'SG_TRANS_USUARIO_3_SEL'";
				}			
				else 
				{	
					//filtrando por gestion, subsistema y usuario
					$this->codigo_procedimiento = "'SG_TRANS_USUARIO_4_SEL'";
				}
			}
		}
		

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
		
		$this->var->add_param($id_subsistema);
		$this->var->add_param($id_usuario);
		$this->var->add_param($gestion);
		
		/*$this->var->id_subsistema = $id_subsistema;
		$this->var->id_usuario = $id_usuario;
		$this->var->gestion = $gestion;*/

		//Carga la definici�n de columnas con sus tipos de datos
		$this->var->add_def_cols('nombre_largo','text');
		$this->var->add_def_cols('enero','bigint');
		$this->var->add_def_cols('febrero','bigint');
		$this->var->add_def_cols('marzo','bigint');
		$this->var->add_def_cols('abril','bigint');
		$this->var->add_def_cols('mayo','bigint');
		$this->var->add_def_cols('junio','bigint');
		$this->var->add_def_cols('julio','bigint');
		$this->var->add_def_cols('agosto','bigint');
		$this->var->add_def_cols('septiembre','bigint');
		$this->var->add_def_cols('octubre','bigint');
		$this->var->add_def_cols('noviembre','bigint');
		$this->var->add_def_cols('diciembre','bigint');
		$this->var->add_def_cols('total','bigint');
		
	

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo $this->query;
		exit ();*/
		
		return $res;
	}	
	
	function ListarEjecucionTrimestral($cant,$puntero,$sortcol,$sortdir,$criterio_filtro,$id_financiador,$id_regional,$id_programa,$id_proyecto,$id_actividad,$id_parametro,$fecha_ini,$fecha_fin,$tipo_pres1,$id_moneda,$filtro,$id_presupuesto,$id_uo)
	{
		$this->salida = "";
		$this->nombre_funcion = 'f_tpr_eje_trimestral_rep';

		if($filtro=='Presupuesto')
		{	
			$this->codigo_procedimiento = "'PR_EJE_TRIM_PRES'";
		}
		else 
		{
			if($filtro=='Unidad Organizacional')
			{	
				$this->codigo_procedimiento = "'PR_EJE_TRIM_UO'";
			}
			else
			{
				if($filtro=='Proyecto')
				{	
					$this->codigo_procedimiento = "'PR_EJE_TRIM_PROY'";
				}
			}
		}
			
			
			
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
		$this->var->add_param("'$id_proyecto'");//id_proyecto
		//$this->var->add_param($func->iif($id_proyecto == '',"'%'","'$id_proyecto'"));//id_proyecto
		$this->var->add_param($func->iif($id_actividad == '',"'%'","'$id_actividad'"));//id_actividad
		
		$this->var->add_param("$id_parametro");
		$this->var->add_param("'$fecha_ini'");
		$this->var->add_param("'$fecha_fin'");		
		$this->var->add_param("'$tipo_pres1'");
		$this->var->add_param("$id_moneda");
		$this->var->add_param("'$id_presupuesto'");
		$this->var->add_param("'$id_uo'");
		

		//Carga la definici�n de columnas con sus tipos de datos
		//$this->var->add_def_cols('id_presupuesto','integer');
		$this->var->add_def_cols('descripcion','text');
		$this->var->add_def_cols('presupuesto_inicial','numeric');
		$this->var->add_def_cols('modificaciones','numeric');
		$this->var->add_def_cols('presupuesto_vigente','numeric');
		
		$this->var->add_def_cols('pv_enero','numeric');
		$this->var->add_def_cols('ej_enero','numeric');
		$this->var->add_def_cols('porcentaje_enero','text');
		$this->var->add_def_cols('pv_febrero','numeric');
		$this->var->add_def_cols('ej_febrero','numeric');
		$this->var->add_def_cols('porcentaje_febrero','text');
		$this->var->add_def_cols('pv_marzo','numeric');
		$this->var->add_def_cols('ej_marzo','numeric');
		$this->var->add_def_cols('porcentaje_marzo','text');
		$this->var->add_def_cols('sumaTrim1','numeric');
		$this->var->add_def_cols('sumaAcum1','numeric');
		
		$this->var->add_def_cols('pv_abril','numeric');
		$this->var->add_def_cols('ej_abril','numeric');
		$this->var->add_def_cols('porcentaje_abril','text');
		$this->var->add_def_cols('pv_mayo','numeric');
		$this->var->add_def_cols('ej_mayo','numeric');
		$this->var->add_def_cols('porcentaje_mayo','text');
		$this->var->add_def_cols('pv_junio','numeric');
		$this->var->add_def_cols('ej_junio','numeric');
		$this->var->add_def_cols('porcentaje_junio','text');
		$this->var->add_def_cols('sumaTrim2','numeric');
		$this->var->add_def_cols('sumaAcum2','numeric');
		
		$this->var->add_def_cols('pv_julio','numeric');
		$this->var->add_def_cols('ej_julio','numeric');
		$this->var->add_def_cols('porcentaje_julio','text');
		$this->var->add_def_cols('pv_agosto','numeric');
		$this->var->add_def_cols('ej_agosto','numeric');
		$this->var->add_def_cols('porcentaje_agosto','text');
		$this->var->add_def_cols('pv_septiembre','numeric');
		$this->var->add_def_cols('ej_septiembre','numeric');
		$this->var->add_def_cols('porcentaje_septiembre','text');
		$this->var->add_def_cols('sumaTrim3','numeric');
		$this->var->add_def_cols('sumaAcum3','numeric');
		
		$this->var->add_def_cols('pv_octubre','numeric');
		$this->var->add_def_cols('ej_octubre','numeric');
		$this->var->add_def_cols('porcentaje_octubre','text');
		$this->var->add_def_cols('pv_noviembre','numeric');
		$this->var->add_def_cols('ej_noviembre','numeric');
		$this->var->add_def_cols('porcentaje_noviembre','text');
		$this->var->add_def_cols('pv_diciembre','numeric');
		$this->var->add_def_cols('ej_diciembre','numeric');
		$this->var->add_def_cols('porcentaje_diciembre','text');
		$this->var->add_def_cols('sumaTrim4','numeric');
		$this->var->add_def_cols('sumaAcum4','numeric');
		
		$this->var->add_def_cols('ej_total','numeric');
		$this->var->add_def_cols('porcentaje_total','text');
	

		//Ejecuta la funci�n de consulta
		$res = $this->var->exec_query();

		//Obtiene el array de salida de la funci�n y retorna el resultado de la ejecuci�n
		$this->salida = $this->var->salida;

		//Obtiene la cadena con que se llam� a la funci�n de postgres
		$this->query = $this->var->query;
		
		/*echo $this->query;
		exit ();*/
		
		return $res;
	}
}?>