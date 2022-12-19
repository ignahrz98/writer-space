<?php
	/**
	*	@titulo 	  	autoload
	*	@descripcion 	Cargar todos los archivos indispensables para funcionar
	*/

	#	Datos de la base de datos
	require_once(_ADD_CONTROLLER_ . "datos-de-la-bd.php");

	#	Mensajes de errores en el manejo de la base de datos
	require_once(_ADD_VIEW_ . "_PLANTILLAS/base_de_datos_mensajes_errores.php");

	#	Controlador para la gestion de la base de datos.
	require_once(_ADD_CONTROLLER_ . "db-controller.php");

	#	Controlador de la session.
	require_once(_ADD_CONTROLLER_ . "session-controller.php");
	
	#	Controlador de acciones
	require_once(_ADD_CONTROLLER_ . "action-controller.php");

	#	Controlador de vistas
	require_once(_ADD_CONTROLLER_ . "view-controller.php");

	#	Controlador frontal
	require_once(_ADD_CONTROLLER_ . "front-controller.php");

?>