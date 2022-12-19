<?php
	/*
		CONTROLADOR DE LA LLUVIA DE ETIQUETAS, SE ALMACENA EN $cadena_lluvia_etiquetas
	*/

	require_once("core/model/articulosBD.php");

	#	Iniciar cadena que contendrá la lluvia de etiquetas.
	$cadena_lluvia_etiquetas = "";

	$tabla_articulos = new ArticulosBD();
	$resultados_de_tags_publicados = $tabla_articulos->get_articulos_tags();

	#	Separar tags en arrays
	#	Primero recorrer valor tags de cada registro obtenido de la BD.

	$tags_numero = 0;

	foreach ($resultados_de_tags_publicados as $key) 
	{
		#	Segundo Separar los tags en arrays
		$tags_separados = explode(",", $key['articulo_tags']);
		$tags_con_links = "";
		
		foreach ($tags_separados as $key_sep) 
		{

			$key_sep = trim($key_sep);

			if ($tags_numero == 0) 
			{
				$tags_con_links .= "$key_sep";
			} else 
			{
				$tags_con_links .= ",$key_sep";
			}

			$tags_numero++;

		}

		#	Concatenar tags con link a la cadena de tags
		$cadena_lluvia_etiquetas .= $tags_con_links;

	}

	#	Aqui ya existe una mega cadena con todos los tags que existen en el sitio.
	#	Ahora toca contar los tags y separarlos en un array sin repeticiones.
	#	Crear array desde la mega cadena.

	$array_lluvia_etiquetas = explode(",", $cadena_lluvia_etiquetas);

	#	Eliminar repeticiones en la cadena.

	#	Preparar array
	$array_asociativo_etiquetas_con_apariciones = array();

	foreach ($array_lluvia_etiquetas as $key => $value) 
	{

		#	Quitar espacios en blancos al principio y al final
		$value = trim($value);

		#	Contar apariciones de cada etiqueta
		$apariciones = substr_count($cadena_lluvia_etiquetas, $value);

		#	Añadir valores al array aociativo con las apariciones de las etiquetas.
		$array_asociativo_etiquetas_con_apariciones[$value] = $apariciones; 
	}

	#	Con el array ya creado ahora toca sacar los calculos

	$valor_max = max($array_asociativo_etiquetas_con_apariciones);
	$valor_min = min($array_asociativo_etiquetas_con_apariciones);
	$diferencia = $valor_max - $valor_min;

	#	ordeno el array
	ksort($array_asociativo_etiquetas_con_apariciones);

	#	Calcular importancia de cada etiqueta.
	$cadena_lluvia_etiquetas_a_mostrar = "";

	foreach ($array_asociativo_etiquetas_con_apariciones as $nombre_de_etiqueta => $apariciones) 
	{
		
		#	Calculo un valor de 0 a 10 para cada etiqueta, porcentualmente según valores máximos y mínimos 
		#	encontrados
		$valor_relativo = round((($apariciones - $valor_min) / $diferencia) * 10);

		$clase_css_para_etiqueta = "etiqueta-".$valor_relativo;

		$cadena_lluvia_etiquetas_a_mostrar .= "	<a href='./?view=buscador&buscador=" . $nombre_de_etiqueta . "&busqueda=etiquetas' class='label_lluvia_etiquetas " . $clase_css_para_etiqueta . "'>
													" . $nombre_de_etiqueta . "
												</a>";	
																				
	}
?>