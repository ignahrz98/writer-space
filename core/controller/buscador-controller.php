<?php
	/*
		CONTROLADOR DEL BUSCADOR
	*/

	require_once(_ADD_MODEL_ . "articulosBD.php");
	$tabla_articulos = new ArticulosBD();

	/*
		Función para separar la cadena de tags, y generar un link para uno.

		$tags_cadena_entrante 	Cadena de tags.

		@return 				Una cadena de tags que contienen un link.
	*/
	function crear_tags_con_link($tags_cadena_entrante) 
	{

		$tags_separados = explode(",", $tags_cadena_entrante);
		$tags_con_links = "";

		foreach ($tags_separados as $key=>$valor) 
		{

		    #  Si $valor está vacio es porque no se han indicado tags.
        
	        if ($valor != "") 
	        {
	            $tags_con_links = $tags_con_links . "   <span class='label label-default label-tags-con-links'>
	                                                        <a href='./?view=buscador&buscador=" . $valor . "&busqueda=etiquetas' class='tags-con-links'> 
	                                                            " . $valor . "
	                                                        </a>
	                                                    </span>";
	        }

		}

		return $tags_con_links;

	}

	if(isset($_REQUEST['pos'])) 
	{

	  	$inicio = $_REQUEST['pos'];

	} else 
	{

	  	$inicio = 0;

	}

	$buscador = $_REQUEST['buscador'];

	#	Eliminar espacios en blanco al comienzo y final de la cadena de busqueda.
	$buscador = trim($buscador);

	#	Reemplazar comilla simple.
	$buscador = str_replace('\'', '´', $buscador);

	#	Cadena para almacenar tipo de busqueda para la paginación
	$cadena_tipo_de_busqueda = "";

	if (isset($_REQUEST['busqueda'])) 
	{

		if ($_REQUEST['busqueda'] == "etiquetas") 
		{

			$articulos_encontrados_en_busqueda = $tabla_articulos->get_articulos_por_etiqueta($buscador,$inicio);
			
			$mensaje_con_alerta = "ETIQUETA: ".$buscador;

			$cadena_tipo_de_busqueda = "&busqueda=etiquetas";

		}
		
	} else 
	{

		$articulos_encontrados_en_busqueda = $tabla_articulos->get_articulos_por_titulo($buscador,$inicio);

		$mensaje_con_alerta = "Usted está buscando: ".$buscador;

	}
?>