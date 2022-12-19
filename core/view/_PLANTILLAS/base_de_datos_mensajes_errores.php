<?php
#	Mensajes de errores de la base predefinidos

Class MensajesErroresBD {

	public static function show_error_coneccion() {
		echo "<h1>A ocurrido un error al conectar con el servidor.</h1>";
	}

	public static function show_error_seleccion() {
		echo "<h1>Error al seleccionar la base de datos.</h1>";
	}

	public static function show_error_query() {
		echo "<h1>Error al ejecutar sentencias en la base de datos.</h1>";
	}
}
?>