<?php
	/**
	*	@titulo			Controlador de acciones.
	*	@descripcion	Controlador encargado de cargar los actions.
	*/

	class Action 
	{

		/*
			Llamar action solicitado
		    
		    $accion 	Nombre del action llamado
	    */
		public static function add_action($accion) 
		{
			require_once(_ADD_ACTION_ . $accion . "/" . _ACTION_FILE);
		}
	}

?>