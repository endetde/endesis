<?php
class funciones {
	
	/*
	 * ********************************************************* Nombre de la funci�n:	copiar_archivo_servidor($archivo_temporal,$carpeta_destino) Prop�sito:				Se utiliza esta funci�n para copiar srchivos al servidor Par�metros:				$archivo_temporal	-->	Aqu� se almacena el nombre del archivo temporal $carpeta_destino --> Aqu� se guarda el nombre de la carpeta destino Valores de Retorno:		$nombre_archivo 	-->	Retorna el nombre del archivo -1	--> Indica que se produjo un error y no se pudo subir el archivo al servidor *********************************************************
	 */
	function carga_archivo($archivo, $directorio_destino) {
		// Revisa si el archivo es de mas de 5 megabytes.
		if ($archivo['size'] < 5512000) {
			$nombre_archivo = basename($archivo['name']);
			$nombre_archivo = $this->limpiar($nombre_archivo);
			
			$archivo_destino = $directorio_destino . $nombre_archivo;
			
			if (move_uploaded_file($archivo['tmp_name'], $archivo_destino)) {
				// ""move_uploaded_file"" funcion que no funciona en este servidor
				rename($archivo_destino, $directorio_destino . "fv_lec_proce.txt");
				return $nombre_archivo;
				chmod($directorio_destino . "fv_lec_proce.txt", 0777);
			} else {
				return - 1;
			}
		} else {
			return - 2;
		}
	}
	function limpiar($archivo) {
		$ruta = pathinfo($archivo);
		$nombre_completo = $ruta["basename"];
		$extension = $ruta["extension"];
		
		if (isset($extension) && ! empty($extension)) {
			$extension = "." . $extension;
			
			// obtener la posicion de la extension
			$position = strpos($nombre_completo, $extension);
			
			// sacar el nombre del archivo sin extension
			$nombre_sin_extension = substr($archivo, 0, $position);
		} else {
			$nombre_sin_extension = $nombre_completo;
		}
		$len = strlen($nombre_sin_extension);
		$cadena = '';
		
		for($i = 0; $i < $len; $i ++) {
			$str = substr($nombre_sin_extension, $i, 1);
			if ($str != ' ' && $str != '�' && $str != '�' && $str != '�' && $str != '�' && $str != '�' && $str != '�' && $str != '�' && $str != '�' && $str != '�' && $str != '�' && $str != '�') {
				$cadena = $cadena . $str;
			}
		}
		
		return $cadena . $extension;
	}
	
	// /////////////////////////////////////////////////////////////////////////////////////////
	// Funciones Ruddy Luj�n Bravo (Fin)
	// /////////////////////////////////////////////////////////////////////////////////////////
	
	/*
	 * ********************************************************* Nombre de la funci�n:	renombrar ( $archivo,$carpeta_archivo ) Prop�sito:				Se utiliza esta funci�n para copiar srchivos al servidor Par�metros:				$archivo	-->	Aqu� se almacena el nombre del archivo ha ser cambiado $carpeta_archivo --> Aqu� se guarda el nombre de la carpeta destino Valores de Retorno:		$nuevo_nombre	-->	El nuevo nombre del archivo Observaci�n:			----- Fecha de Creaci�n:		25 - 07 - 2013 Versi�n:				1.0.0 *********************************************************
	 */
	function renombra_archivo($archivo, $carpeta_archivo) {
		$ruta = pathinfo($archivo);
		$nombre_completo = $ruta["basename"];
		$extension = $ruta["extension"];
		
		if (isset($extension) && ! empty($extension)) {
			$extension = "." . $extension;
			
			// obtener la posicion de la extension
			$position = strpos($nombre_completo, $extension);
			
			// sacar el nombre del archivo sin extension
			$nombre_sin_extension = substr($archivo, 0, $position);
		} else {
			$nombre_sin_extension = $nombre_completo;
		}
		
		$n = 0;
		$copia = "";
		
		while ( file_exists($carpeta_archivo . $nombre_sin_extension . $copia . $extension) ) {
			if ($n <= 9)
				$n = "00" . $n;
			
			if ($n <= 99 && $n >= 10)
				$n = "0" . $n;
			
			if ($n <= 999 && $n >= 100)
				$n = "" . $n;
			
			$copia = "_" . $n;
			$n ++;
		}
		
		return $nombre_sin_extension . $copia . $extension;
	}
	function PreguntaExtencion($archivo) {
		$ext = '';
		
		$vari = explode(".", $archivo);
		$ext = $vari[1];
		return $ext;
	}
}
?>