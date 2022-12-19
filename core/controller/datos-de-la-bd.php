<?php
	/**
	*	@titulo 		Datos de la BD.
	*	@descripcion 	Datos que permiten la conexión del sistema, con la 
	*					Base de Datos.
	**/

	class DatosDeLaBD 
	{
		/*
			Retornar nombre del servidor.

			@return 	Nombre del servidor.
		*/
		public static function get_servidor() 
		{

			$dato = "localhost";
	    	return $dato;

		}

		/*
			Retornar nombre del usuario de la base de datos.

			@return 	Usuario de la base de datos.
		*/
		public static function get_usuario() 
		{

			$dato = "root";
	    	return $dato;

		}

		/*
			Retornar contraseña de la base de datos.

			@return 	Contraseña de la base de datos.
		*/
		public static function get_password() 
		{

			$dato = "";
	    	return $dato;

		}

		/*
			Retornar nombre de la base de datos.

			@return 	Nombre de la base de datos.
		*/
		public static function get_database() 
		{

			$dato = "writer_space";
	    	return $dato;

		}
	}
	?>