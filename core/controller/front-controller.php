<?php
	/**
	*	@titulo:		Controlador frontal.
	*	@descripción:	Controlador que verifica si se ha solicitado una vista o un action.
	*					Si no se ha solicitado nada, muestra el index, por defecto.
	*					Validar session para no mostrar partes del sistema no deseadas.
	**/

	#	Si no existe llamada de view ni action, llamar al index, por defecto.
	if (!isset($_GET['view']) && !isset($_GET['action'])) 
	{
		
		$nombre_de_la_vista_a_llamar = "index";

		require_once(_ADD_VIEW_ . "layout.php");

	}	#	En caso de llamar vista
		else if (isset($_GET['view'])) 
	{
		$session_controller = new Session();

		#	Validar session. Para las vistas.
		if (isset($_SESSION['id_usuario_sesion_activa'])) 
		{

			if($session_controller->session_forbidden($_GET['view']))
			{

				header("Location: ./");

			} 

				else
			{

				$nombre_de_la_vista_a_llamar = $_GET['view'];

			}

		} 
			else
		{

			if($session_controller->no_session_allow($_GET['view']))
			{

				$nombre_de_la_vista_a_llamar = $_GET['view'];
			} 

				else
			{

				header("Location: ./");

			} 
			
		}
		
		require_once(_ADD_VIEW_ . "layout.php");

	}	#	En caso de llamar accion
		else if (isset($_GET['action'])) 
	{

		Action::add_action($_GET['action']);
		
	}
?>