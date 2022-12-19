<?php
	/*
		CONTROLADOR PARA MOSTRAR <TITLE> DINÁMICO
	*/

  	require_once("core/model/articulosBD.php");

	class TitleHTML
	{
		/*
			Generar el title.

			$title_default		Cadena con title por defecto
		*/
		static function generar_title_dinamico($title_default)
		{
			#	Si existe view.
			if (isset($_GET['view'])) 
			{
				#	Si view solicita leer artículo.
				if ($_GET['view'] == "leer") 
				{

					echo self::get_articulo_titulo($_GET['id']); ;
				
				} 	# En caso contrario, generar title por defecto.
					else
				{
					echo $title_default;
				}
			}   # Si no existe view, generar title por defecto.
				else
			{
				echo $title_default;
			}
		}

		/*
			Obtener el titulo del artículo a leer, para mostrar <TITLE> correspondiente.

			$id_articulo		ID del artículo a buscar.

			@return 			Cadena con el título encontrado.
		*/
		static function get_articulo_titulo($id_articulo)
		{

			$tabla_articulos = new ArticulosBD();

			$datos_obtenidos = $tabla_articulos->get_articulo_titulo($id_articulo);

			foreach ($datos_obtenidos as $key) 
			{
				return $key['articulo_titulo'];
			}
		}
	}
?>