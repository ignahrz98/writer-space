<?php
	/*
		CONTROLADOR DEL INDEX
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

	#	Variable para contabilizar la paginación
	if(isset($_REQUEST['pos'])) 
	{

	  $inicio=$_REQUEST['pos'];

	}  	#	Por defecto, inicia en 0.
		else 
	{

	  $inicio = 0;

	}

    $articulos_publicados = $tabla_articulos->get_articulos_publicados($inicio);

?>