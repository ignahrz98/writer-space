<?php
	/**
	*	@titulo 		Index
	*	@descripcion   	No hace nada, solo establecer configuraciones iniciales, e iniciar
	*					la carga del sistema.
	*
	*	@author 		Ignacio Hernández.
	*	@nombre 		WriterSpace.
	*	@año	 		2021.
	*	@version 		1.0
	**/

	#	Para mostrar advertencias comente la siguiente linea.
	error_reporting(0);

	# Establecer zona horaria de Venezuela.
	date_default_timezone_set('America/Caracas');

	#	Habilitar las variables de sesión.
	session_start();

	#	Constantes del sistema
	define('NOMBRE_DEL_SISTEMA', 'WriterSpace');
	define('ANIO', '2021');

	define( '_ADD_VIEW_', 'core/view/');
	define( '_ADD_ACTION_', 'core/controller/action/');
	define('_ADD_MODEL_', 'core/model/');
	define( '_ADD_CONTROLLER_', 'core/controller/');
	define( '_VIEW_FILE', 'widget-default.php');
	define( '_ACTION_FILE', 'action-default.php');

	define('_ADD_CSS_', 'res/css/');
	define('_ADD_JS_', 'res/js/');


	#	Carga inicial de archivos necesarios para ejecutar el sistema.
	require_once("core/autoload.php");
?>