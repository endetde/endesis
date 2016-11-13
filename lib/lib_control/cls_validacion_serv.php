<?php
/**
 * Nombre clase:	cls_validacion_serv
 * Prop�sito:		Validar integridad de los datos antes de mandar a la base de datos
 * Fecha creaci�n: 	15-05-2007
 * Autor:			Rodrigo Chumacero Moscoso
  */
class cls_validacion_serv
{
	var $sep_mil;
	var $sep_decim;
	var $sep_fecha;
	var $formato_fecha;
	var $num_decim;
	var $salida; //array que devolver� la respuesta de la validaci�n del dato
	var $nombre_archivo = "cls_validacion_serv.php";

	/**
	 * Constructor
	 *
	 */
	function __construct()
	{
		//include_once("../configuracion.valid.php");
		//Se cargan los valores predefinidos de la configuraci�n
		/*$this->sep_mil = $SEP_MIL;
		$this->sep_decim = $SEP_DECIM;
		$this->sep_fecha = $SEP_FECHA;
		$this->formato_fecha = $FORMATO_FECHA;
		$this->num_decim = $NUM_DECIM;*/

		$this->sep_mil = ",";
		$this->sep_decim = ".";
		$this->sep_fecha = "-";
		$this->formato_fecha = "MM/dd/yyyy";
		$this->num_decim = 2;
	}

	//*************************************************************************************************//
	//Funciones B�sicas internas de validaci�n que s�lo indican true o false para los formatos de datos//
	//*************************************************************************************************//

	/**
	 * Enter description here...
	 *
	 * @param unknown_type $data
	 * @return unknown
	 */
	function validar_cadena_digitos($data)
	{	//Verifica si $data s�lo contiene d�gitos del 0 al 9
		for ($i=0;$i<strlen($data);$i++) {
			$ascii=ord($data[$i]);
			if (intval($ascii) >=48 && intval($ascii) <=57) continue;
			else return false;
		}
		return true;
	}
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $data
	 * @return unknown
	 */
	function validar_separadores_mil($data)
	{
		//quita todos los separadores de  mil de la cadena
		$fin=str_replace($this->sep_mil,"",$data);

		//Verifica si tiene s�lo d�gitos
		if(!$this->validar_cadena_digitos($fin)) return false;

		//Cuenta los separadores de mil
		$int_cant_sep_mil= substr_count($data,$this->sep_mil);

		//Si no tiene separadores de mil devuelve true
		if($int_cant_sep_mil==0) return true;

		//Obtiene el n�mero m�ximo de separadores de mil
		$intCantMaxSepMil =intval((strlen($fin)-1)/3);

		//Verifica que no se pase del n�mero m�ximo de separadores de mil
		if($int_cant_sep_mil!=$intCantMaxSepMil) return false;

		//Verifica que los separadores de mil est�n colocados correctamente cada 3 d�gitos
		$aux=strrev($data);
		for($i=0;$i<=strlen($aux)-1;$i++)
		{
			if(($i+1)%4==0)
			{
				if($aux[$i]!=$sep_mil) return false;
			}
		}
		return true;
	}
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $data
	 * @return unknown
	 */
	function validar_numero($data)
	{	//Verifica que $data sea un n�mero en general (entero o real)

		$data=trim($data);

		if(strlen($data)==0) return false;

		//Verifica que la cadena no termine en ","
		if($data[strlen($data)-1]==$this->sep_decim) return false;

		//Verifica si tiene signo + o - al comienzo
		$val=$data[0];
		switch ($val) {
			case "+":
				$data=substr($data,1);
				break;
			case "-":
				$data=substr($data,1);
				break;
		}

		//separa la parte derecha e izquierda del separador decimal en el array $sep
		$a_sep=explode($this->sep_decim,$data);

		//se cuenta la cantidad de separadores de decimal (si hay m�s de dos elementos en el array $a_sep
		if(sizeof($a_sep)>2) return false;

		//verifica si la parte decimal es puro d�gitos
		if(!$this->validar_cadena_digitos($a_sep[1])) return false;

		//Verifica los separadores de mil
		if(!$this->validar_separadores_mil($a_sep[0])) return false;

		//Devuelve verdadero
		return true;
	}
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $data
	 * @return unknown
	 */
	function nn($data)
	{	//vuelve el n�mero como nativo
		if($this->validar_numero($data))
		{
			$data=str_replace($this->sep_mil,"#!",$data);
			$data=str_replace($this->sep_decim,".",$data);
			$data=str_replace("#!",",",$data);
			return $data;
		}
		else return "##!!ERROR!";
	}
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $data
	 * @return unknown
	 */
	function nf($data)
	{	//Vuelve un n�mero nativo a n�mero con el formato de la configuraci�n
		$data=str_replace(",","#!",$data);
		$data=str_replace(".",$this->sep_decim,$data);
		$data=str_replace("#!",$this->sep_mil,$data);
		return $data;
	}
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $data
	 * @return unknown
	 */
	function validar_fecha($data)
	{
		//Verifica que el $data tenga un formato v�lido de fecha
		$a_sep=explode($this->sep_fecha,$data);

		if(sizeof($a_sep)==3)
		{
			//verifica si son d�gitos cada parte de la cadena
			if(!$this->validar_cadena_digitos($a_sep[0])) return false;
			if(!$this->validar_cadena_digitos($a_sep[1])) return false;
			if(!$this->validar_cadena_digitos($a_sep[2])) return false;

			//Verifica que los d�gitos sean mayores a cero
			if($a_sep[0]<=0) return false;
			if($a_sep[1]<=0) return false;
			if($a_sep[2]<=0) return false;

			//Verifica cantidad de d�gitos en cada parte de la cadena en funci�n de la m�scara
			switch ($this->formato_fecha)
			{
				case "dd/MM/yyyy":
					if(strlen($a_sep[0])<1||strlen($a_sep[0])>2) return false;
					if(strlen($a_sep[1])<1||strlen($a_sep[1])>2) return false;
					if(strlen($a_sep[2])!=4) return false;
					break;
				case "MM/dd/yyyy":
					if(strlen($a_sep[0])<1||strlen($a_sep[0])>2) return false;
					if(strlen($a_sep[1])<1||strlen($a_sep[1])>2) return false;
					if(strlen($a_sep[2])!=4) return false;
					break;
				case "yyyy/MM/dd":
					if(strlen($a_sep[0])!=4) return false;
					if(strlen($a_sep[1])<1||strlen($a_sep[1])>2) return false;
					if(strlen($a_sep[2])<1||strlen($a_sep[2])>2) return false;
					break;
			}
			return true;
		}
		else return false;
	}

	/**
	*************************************************************************
	*Funciones que aplican las funciones b�sicas para devolver datos v�lidos
	************************************************************************
	*/
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $data
	 * @param unknown_type $resp
	 * @param unknown_type $signo
	 * @return unknown
	 */
	function es_entero($data,&$resp,$signo=1)
	{	//Valida si $data es un n�mero entero, y verifica signo (1:sin signo, 2:positivo,3:negativo)
		if($this->validar_numero($data))
		{
			$decim = substr(strrchr($data, $this->sep_decim),1);

			if($decim>0)
			{
				$resp = "El n�mero contiene decimales";
				return false;
			}
			else
			{
				//Verifica el signo
				switch ($signo)
				{
					case 1://sin signo
					{
						return true;
						break;
					}
					case 2://positivo
					{
						if($data>=0) return true;
						else
						{
							$resp = "El n�mero entero no es positivo";
							return false;
						}
						break;
					}

					case 3://negativo
					{
						if($data<0) return true;
						else
						{
							$resp = "El n�mero entero no es negativo";
							return false;
						}
						break;
					}
				}
			}
		}
		else
		{
			$resp = "Valor no num�rico";
			return false;
		}
	}
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $data
	 * @param unknown_type $resp
	 * @param unknown_type $num_decim
	 * @param unknown_type $signo
	 * @return unknown
	 */
	function es_real(&$data,&$resp,$num_decim=2,$signo=1)
	{	//Verifica que sea un n�mero real, y completa la cantidad de d�gitos requeridos
		if($this->validar_numero($data))
		{
			$decim = substr(strrchr($data, $this->sep_decim),1);
			if(strlen($decim)>$num_decim)
			{	//Redondea al n�mero de d�gitos requerido (primero lleva el n�mero a formato nativo php para ejecutar round, y luego lo vuelve al formato
				$data = $this->nf(round($this->nn($data),$num_decim));
			}
			elseif(strlen($decim)<$num_decim)
			{
				//Rellena de ceros hasta completar $data a los decimales requeridos
				if(strlen($decim)==0)
				$data = $data . $this->sep_decim;
				$data = str_pad($data,strlen($data)-strlen($decim)+$num_decim,"0");
			}
			//Verifica el signo
			switch ($signo) {
				case 1://sin signo
				{
					return true;
					break;
				}
				case 2://positivo
				{
					if($data>=0) return true;
					else
					{
						$resp = "El n�mero real no es positivo";
						return false;
					}
					break;
				}

				case 3://negativo
				{
					if($data<0) return true;
					else
					{
						$resp = "El n�mero real no es negativo";
						return false;
					}
					break;
				}
			}
		}
		else
		{
			$resp = "Valor no num�rico";
			return false;
		}
	}
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $data
	 * @param unknown_type $resp
	 * @return unknown
	 */
	function es_porcentaje($data, &$resp)
	{	//Verifica el porcentaje, que debe ir de 0 a 1

		if($this->validar_numero($data))
		{
			if($this->nn($data)>100||$this->nn($data)<0)
			{
				$resp = "El porcentaje no est� entre 0 y 100";
				return false;
			}

			$decim = substr(strrchr($data, $this->sep_decim),1);

			if(strlen($decim)>$this->num_decim)
			{	//Redondea al n�mero de d�gitos requerido (primero lleva el n�mero a formato nativo php para ejecutar round, y luego lo vuelve al formato
				$data= $this->nf(round($this->nn($data),$this->num_decim));
			}
			elseif(strlen($decim)<$this->num_decim)
			{
				//Rellena de ceros hasta completar $data a los decimales requeridos
				if(strlen($decim)==0) $data=$data.$this->sep_decim;
				$data= str_pad($data, strlen($data) - strlen($decim) + $this->num_decim,"0");
			}

			return true;
		}
		else
		{
			$resp = "Valor no num�rico";
			return false;
		}
	}
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $data
	 * @param unknown_type $resp
	 * @return unknown
	 */
	function es_email($data, &$resp){
		$mail_correcto = 0;
		//compruebo unas cosas primeras
		if ((strlen($data) >= 6) && (substr_count($data,"@") == 1) && (substr($data,0,1) != "@") && (substr($data,strlen($data)-1,1) != "@")){
			if ((!strstr($data,"'")) && (!strstr($data,"\"")) && (!strstr($data,"\\")) && (!strstr($data,"\$")) && (!strstr($data," "))) {
				//miro si tiene caracter .
				if (substr_count($data,".")>= 1){
					//obtengo la terminacion del dominio
					$term_dom = substr(strrchr ($data, '.'),1);
					//compruebo que la terminaci�n del dominio sea correcta
					if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
						//compruebo que lo de antes del dominio sea correcto
						$antes_dom = substr($data,0,strlen($data) - strlen($term_dom) - 1);
						$caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
						if ($caracter_ult != "@" && $caracter_ult != "."){
							$mail_correcto = 1;
						}
					}
				}
			}
		}
		if ($mail_correcto) return true;
		else
		{
			$resp = "Valor no tiene formato de email";
			return false;
		}
	}
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $data
	 * @param unknown_type $resp
	 * @return unknown
	 */
	function es_fecha($data,&$resp)
	{	//Verifica que sea fecha en formato v�lido
		$a_sep=explode($this->sep_fecha,$data);

		if($this->validar_fecha($data))
		{	//Verifica que la fecha sea correcta
			switch ($this->formato_fecha)
			{
				case "dd/MM/yyyy":
					if(!checkdate($a_sep[1],$a_sep[0],$a_sep[2]))
					{
						$resp = "Valor de fecha incorrecto";
						return false;
					}
					break;
				case "MM/dd/yyyy":
					if(!checkdate($a_sep[0],$a_sep[1],$a_sep[2]))
					{
						$resp = "Valor de fecha incorrecto";
						return false;
					}
					break;
				case "yyyy/MM/dd":
					if(!checkdate($a_sep[1],$a_sep[2],$a_sep[0]))
					{
						$resp = "Valor de fecha incorrecto";
						return false;
					}
					break;
			}
			return true;
		}
		else
		{
			$resp = "Formato de fecha no v�lido";
			return false;
		}
	}
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $data
	 * @param unknown_type $resp
	 * @return unknown
	 */
	function es_hora($data,&$resp)
	{
		//Verifica que sea hora en formato hh:mm:ss 24
		$a_sep=explode(':',$data);

		//Verifica que tenga las tres partes de la hora
		if(sizeof($a_sep)<=0 || sizeof($a_sep)>3)
		{
			$resp = "Formato de hora incorrecto. Debe estar en formato hh:mm:ss (24)";
			return false;
		}

		//Verifica que sean n�meros
		for($i=0;$i<=2;$i++)
		{
			if(!$this->es_entero($a_sep[$i],$resp))
			{
				$resp = "Formato de hora incorrecto. El valor contiene caracteres inv�lidos";
				return false;
				exit;
			}
		}

		//Verifica que est�n en el rango permitido
		if($a_sep[0]<0 || $a_sep[0]>23)
		{
			$resp = "Formato de hora incorrecto. Hora no v�lida";
			return false;
		}
		if($a_sep[1]<0 || $a_sep[1]>59)
		{
			$resp = "Formato de hora incorrecto. Hora no v�lida";
			return false;
		}
		if($a_sep[2]<0 || $a_sep[2]>59)
		{
			$resp = "Formato de hora incorrecto. Hora no v�lida";
			return false;
		}

		//Validaci�n correcta
		return true;
	}

	function es_fecha_hora($data,&$resp)
	{
		//Verifica que sea fecha y hora en formato fecha hh:mm:ss 24
		$a_sep=explode($this->sep_fecha,$data);
		$a_sep_1=explode(' ',$a_sep[2]);

		//Forma las cadenas de fecha y de hora
		$fecha = $a_sep[0].$this->sep_fecha.$a_sep[1].$this->sep_fecha.$a_sep_1[0];
		$hora = $a_sep_1[1];

		//Verifica si es una fecha v�lida
		if(!$this->es_fecha($fecha,$resp))
		{
			$resp = "Formato de fecha y hora incorrecto. Fecha no v�lida";
			return false;
		}
		//Verifica si es una hora v�lida
		if(!$this->es_hora($hora,$resp))
		{
			$resp = "Formato de fecha y hora incorrecto. Hora no v�lida";
			return false;
		}

		//Validaci�n correcta
		return true;
	}
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $data
	 * @param unknown_type $resp
	 * @return unknown
	 */
	function validar_texto($data,&$resp)
	{	//Valida que no se introduzcan caracteres no v�lidos
		//para aumentar nuevos caracteres admitidos, aumentar antes de ]
		$data = utf8_decode($data);
		$patron="/^[\n\t\ra-zA-Z����������<>��0-9#�%&()=!\"\.,;:\-_|\/\ ]+$/";

		if(strlen(trim($data))==0) return true;

		if(preg_match($patron,$data)) return true;

		else
		{
			$resp = "El texto contiene caracteres no v�lidos";
			return false;
		}
		return true;
	}
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $data
	 * @param unknown_type $resp
	 * @return unknown
	 */
	function es_url($data,&$resp)
	{
		if(preg_match('|^http(s)?://[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $data)) return true;
		else
		{
			$resp = "El formato de la url no es v�lida";
			return false;
		}
	}

	/**
	************************************************************************
	*Funci�n para validaci�n general de los datos                           
	************************************************************************
	* Funci�n que verifica si el dato es obligatorio, si tiene formato v�lido, y si tiene el tama�o v�lido,
	* a partir del array de validaci�n de cada tabla ($array_valid)
	*/
	function verifica_dato($array_valid,$columna,$data)
	{
		//Ubica en la matriz de par�metros la columna especificada
		$sw=false;
		$i=0;

		//Verifica si el campo puede ser vac�o o no
		if($array_valid['allowBlank'] == "false")
		{
			if(strlen(trim($data)) == 0)
			{
				$this->salida[0] = "f";
				$this->salida[1] = "El campo '$columna' no puede estar vac�o";
				$this->salida[2] = "ORIGEN = $this->nombre_archivo";
				$this->salida[3] = "PROC = verifica_dato";
				$this->salida[4] = "NIVEL = 3";
				return false;
			}
		}


		//Verifica si el tipo de dato es correcto (dataType)
		if(strlen(trim($data))>0)
		{
			switch ($array_valid['dataType'])
			{
				case "texto":
					if(!$this->validar_texto($data,$resp))
					{
						$this->salida[0] = "f";
						$this->salida[1] = "Error de validaci�n en columna '$columna': $resp";
						$this->salida[2] = "ORIGEN = $this->nombre_archivo";
						$this->salida[3] = "PROC = verifica_dato";
						$this->salida[4] = "NIVEL = 3";
						return false;
					}
					break;
				case "entero":
					if(!$this->es_entero($data,$resp))
					{
						$this->salida[0] = "f";
						$this->salida[1] = "Error de validaci�n en columna '$columna': $resp";
						$this->salida[2] = "ORIGEN = $this->nombre_archivo";
						$this->salida[3] = "PROC = verifica_dato";
						$this->salida[4] = "NIVEL = 3";
						return false;
					}
					break;
				case "real":
					if(!$this->es_real($data,$resp))
					{
						$this->salida[0] = "f";
						$this->salida[1] = "Error de validaci�n en columna '$columna': $resp";
						$this->salida[2] = "ORIGEN = $this->nombre_archivo";
						$this->salida[3] = "PROC = verifica_dato";
						$this->salida[4] = "NIVEL = 3";
						return false;
					}
					break;
				case "porcentaje":
					if(!$this->es_porcentaje($data,$resp))
					{
						$this->salida[0] = "f";
						$this->salida[1] = "Error de validaci�n en columna '$columna': $resp";
						$this->salida[2] = "ORIGEN = $this->nombre_archivo";
						$this->salida[3] = "PROC = verifica_dato";
						$this->salida[4] = "NIVEL = 3";
						return false;
					}
					break;
				case "fecha":
					if(!$this->es_fecha($data,$resp))
					{
						$this->salida[0] = "f";
						$this->salida[1] = "Error de validaci�n en columna '$columna': $resp";
						$this->salida[2] = "ORIGEN = $this->nombre_archivo";
						$this->salida[3] = "PROC = verifica_dato";
						$this->salida[4] = "NIVEL = 3";
						return false;
					}
					break;
				case "email":
					if(!$this->es_email($data,$resp))
					{
						$this->salida[0] = "f";
						$this->salida[1] = "Error de validaci�n en columna '$columna': $resp";
						$this->salida[2] = "ORIGEN = $this->nombre_archivo";
						$this->salida[3] = "PROC = verifica_dato";
						$this->salida[4] = "NIVEL = 3";
						return false;
					}
					break;
				case "url":
					if(!$this->es_url($data,$resp))
					{
						$this->salida[0] = "f";
						$this->salida[1] = "Error de validaci�n en columna '$columna': $resp";
						$this->salida[2] = "ORIGEN = $this->nombre_archivo";
						$this->salida[3] = "PROC = verifica_dato";
						$this->salida[4] = "NIVEL = 3";
						return false;
					}
					break;
				case "hora":
					if(!$this->es_hora($data,$resp))
					{
						$this->salida[0] = "f";
						$this->salida[1] = "Error de validaci�n en columna '$columna': $resp";
						$this->salida[2] = "ORIGEN = $this->nombre_archivo";
						$this->salida[3] = "PROC = verifica_dato";
						$this->salida[4] = "NIVEL = 3";
						return false;
					}
					break;
				case "fecha_hora":
					if(!$this->es_fecha_hora($data,$resp))
					{
						$this->salida[0] = "f";
						$this->salida[1] = "Error de validaci�n en columna '$columna': $resp";
						$this->salida[2] = "ORIGEN = $this->nombre_archivo";
						$this->salida[3] = "PROC = verifica_dato";
						$this->salida[4] = "NIVEL = 3";
						return false;
					}
					break;
				default:
					{
						$this->salida[0] = "f";
						$this->salida[1] = "Tipo de Dato desconocido para la columna '$columna'";
						$this->salida[2] = "ORIGEN = $this->nombre_archivo";
						$this->salida[3] = "PROC = verifica_dato";
						$this->salida[4] = "NIVEL = 3";
						return false;
					}
					break;
			}
		}

		if($array_valid['dataType'] == "texto")
		{

			//Verifica tama�o del dato(minLengt, maxLength) (s�lo valida si al menos tiene el maxLength)
			if($array_valid['maxLength'] != "")
			{
				//Verifica si tiene minlength, caso contrario asume como cero
				if($array_valid['minLength'] == "") $min_length = 0;
				else $min_length = $array_valid['minLength'] ;

				//Verifica los tama�os
				if(strlen(trim($data)) > $array_valid['maxLength'] || strlen(trim($data)) < $min_length)
				{
					$aux = $array_valid['maxLength'];
					$this->salida[0] = "f";
					$this->salida[1] = "Error de validaci�n en columna '$columna': La longitud debe estar entre $min_length y $aux";
					$this->salida[2] = "ORIGEN = $this->nombre_archivo";
					$this->salida[3] = "PROC = verifica_dato";
					$this->salida[4] = "NIVEL = 3";
					return false;
				}
			}
		}

		//Validaci�n exitosa
		return true;
	}
}
?>