<?php
/**
 * Nombre clase:    cls_criterio_filtro
 * Prop�sito:		Devuelve el criterio del filtro en formato SQL a partir dela informaci�n enviada por el control
 * Fecha creaci�n:	30-05-2007
 * Autor:			Rodrigo Chumacero Moscoso
 */
class cls_criterio_filtro
{
	var $array_filtro = array(); //array que contiene los datos del filtro
	var $criterio_filtro;//cadena que contendr� la condici�n sql del filtro para mandar a la bd
	var $sep = '#';//Separador de las columnas del filtro mandado por el post
	var $cond_defecto = '0=0';//Condici� por defecto si es que no hay valores espec�ficos del filtro
	var $array_criterios_extra = array();//array que contendr� los criterios extras para el filtro
	
	var $cont = 0;//Variable para creaci�n de nuevas filas en la matriz array_filtro
	var $cont_extra = 0;//Variable para creaci�n de nuevas filas para los criterios extra
	

	//Bandera que indica si los datos se decodifican o no
	var $decodificar = false;

	/**
	 * Nombre funci�n:	__construct
	 * Prop�sito:		Constructor de la clase, que almacena internamente la bandera para la decodificaci�n
	 * Fecha creaci�n:	30-05-2007
	 * Autor:			Rodrigo Chumacero Moscoso
	 *
	 * @param unknown_type $decodificar
	 */
	function __construct($decodificar)
	{
		$this->decodificar = $decodificar;
	}

	/**
	 * Nombre funci�n:	obtener_criterio_filtro
	 * Prop�sito:		Devolver el criterio filtro con el formato SQL en funci�n de los par�metros de filtrado enviados
	 * Fecha creaci�n:	30-05-2007
	 * Autor:			Rodrigo Chumacero Moscoso
	 *
	 * @return unknown
	 */
	function obtener_criterio_filtro()
	{
		$this->criterio_filtro = "";

		//Obtiene el tama�o del array del filtro
		$lim = sizeof($this->array_filtro);

		for($j=0; $j<$lim; $j++)
		{
			$condicion = "";
			if($this->array_filtro[$j][0] != "" && $this->array_filtro[$j][1] != "")
			{
				//Separa las columnas para el filtro
				$filtro = explode($this->sep, $this->array_filtro[$j][0]);

				//Obtiene el filterValue de la iteraci�n correspondiente
				$aux_value = $this->array_filtro[$j][1];

				//Obtiene la bandera que indica si es filtro avanzado o no
				$avanzado = $this->array_filtro[$j][2];
				
				//Concantena las condiciones de todas las columnas
				for($i=0; $i<sizeof($filtro); $i++)
				{
					//Obtiene la columna i
					$aux_col = $filtro[$i];

					if($i == 0 && $i == sizeof($filtro) - 1)
					{
						//una sola columna, empieza con '(' y cierra con ')'
						//verifica si el filtro es avanzado o no
						if(!$avanzado)
						{
							//No es avanzado, entonces coloca los % al principio y al final
							$condicion = "(lower($aux_col) LIKE lower(''%$aux_value%''))";
						}
						else
						{
							//Es avanzado, entonces NO coloca los % al principio y al final
							$condicion = "(lower($aux_col) LIKE lower(''$aux_value''))";
						}

					}
					else
					{
						//Varias columnas
						if($i==0)
						{
							//primera columna; empieza la cadena con ( y termina con OR
							//verifica si el filtro es avanzado o no
							if(!$avanzado)
							{
								//No es avanzado, entonces coloca los % al principio y al final
								$condicion .= "(lower($aux_col) LIKE lower(''%$aux_value%'') OR ";
							}
							else
							{
								//Es avanzado, entonces NO coloca los % al principio y al final
								$condicion .= "(lower($aux_col) LIKE lower(''$aux_value'') OR ";
							}
						}
						elseif($i == sizeof($filtro)-1)
						{
							//�litma columna; cierra la cadena con )
							//verifica si el filtro es avanzado o no
							if(!$avanzado)
							{
								//No es avanzado, entonces coloca los % al principio y al final
								$condicion .= "lower($aux_col) LIKE lower(''%$aux_value%''))";
							}
							else
							{
								//Es avanzado, entonces NO coloca los % al principio y al final
								$condicion .= "lower($aux_col) LIKE lower(''$aux_value''))";
							}
						}
						else
						{
							//columna del medio; termina con OR
							//verifica si el filtro es avanzado o no
							if(!$avanzado)
							{
								//No es avanzado, entonces coloca los % al principio y al final
								$condicion .= "lower($aux_col) LIKE lower(''%$aux_value%'') OR ";
							}
							else
							{
								//Es avanzado, entonces NO coloca los % al principio y al final
								$condicion .= "lower($aux_col) LIKE lower(''$aux_value'') OR ";
							}
						}
					}
				}//END FOR i

				//Si la cadena no es vac�a, concatena al criterio del filtro; y verifica si debe anteponerse AND
				if($this->criterio_filtro == "") $this->criterio_filtro = $condicion;
				else $this->criterio_filtro .= " AND $condicion";
			}
		}//END FOR j

		///Verifica si el criterio est� vac�o
		if($this->criterio_filtro == "") $vacio = true;

		//Verifica si tiene criterios extra
		if(sizeof($this->array_criterios_extra)>0)
		{
			for($i=0;$i<sizeof($this->array_criterios_extra);$i++)
			{
				$col = $this->array_criterios_extra[$i][0];
				$valor = $this->array_criterios_extra[$i][1];
				if($vacio)
				{
					$this->criterio_filtro .= "$col = $valor";
					$vacio = false;
				}
				else
				{
					$this->criterio_filtro .= " AND $col = $valor";
				}
			}
		}
		else
		{
			//Si la cadena criterio filtro es vac�a, devuelve la condici�n por defecto $cond_defecto
			if($vacio) $this->criterio_filtro = $this->cond_defecto;
		}

		return $this->criterio_filtro;
	}

	/**
	 * Nombre funci�n:	add_condicion_filtro
	 * Prop�sito:		Permite almacenar los par�metros de la condici�n
	 * Fecha creaci�n:	30-05-2007
	 * Autor:			Rodrigo Chumacero Moscoso
	 *
	 * @param unknown_type $filterCol
	 * @param unknown_type $filterValue
	 */
	function add_condicion_filtro($filterCol, $filterValue, $filterAvanzado)
	{
		//Verifica que el filterCol sea distinto de undefined o null
		if($filterValue == 'undefined' || $filterValue == 'null' )
		{
			return 0;	
		}
		
		//Verifica que el filterValue sea distinto de undefined o null
		if($filterCol == 'undefined' || $filterCol == 'null' )
		{
			return 0;	
		}
		
		//Agrega la o las columnas del filtro en el array
		$this->array_filtro[$this->cont][0] = $filterCol;

		//Verifica si debe decodificarse el dato o no para introducir el valor del filtro en el array
		if($this->decodificar)
		{
			//Decodifica el dato
			$this->array_filtro[$this->cont][1] = utf8_decode($filterValue);
		}
		else
		{
			//No decodifica el dato
			$this->array_filtro[$this->cont][1] = $filterValue;
		}

		//Verifica si el filtro es avanzado para colocarlo al array (de ser as� no se le coloca los % al principio y al final)
		switch ($filterAvanzado) {
			case "true":
				$this->array_filtro[$this->cont][2] = true;
				break;
			case "false":
				$this->array_filtro[$this->cont][2] = false;
				break;
				$this->array_filtro[$this->cont][2] =false;
			default:
				break;
		}

		//Incrementa el n�mero de elementos del array
		$this->cont++;
	}
	
	function add_criterio_extra($nombre_columna, $valor)
	{
		if($nombre_columna != "" && $valor != "")
		{
			$this->array_criterios_extra[$this->cont_extra][0]= $nombre_columna;
			$this->array_criterios_extra[$this->cont_extra][1]= $valor;
			$this->cont_extra++;
		}
	}
}
?>