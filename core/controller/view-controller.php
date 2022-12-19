<?php
	/**
	*	@titulo 			Controlador de vistas.
	*	@descripcion 		Controlador encargado de cargar las vistas
	*/

	class View 
	{

		/*
			Llamar a la vista
		
			$vista 	Nombre de la vista llamada
		*/
		public static function add_view($vista) 
		{

			require_once(_ADD_VIEW_ . $vista. "/" . _VIEW_FILE);

		}
	}

?>