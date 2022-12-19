<?php
	/**
	*	@titulo 		Controlador de Base de Datos
	*	@descripcion 	Controlador encargado de gestionar las operaciones en
	*					la Base de Datos
	*/

	class DBController 
	{

		var $mysqli; #	Variable que almacena la conexion propiamente dicha.

		/*
			Conectar con la base de datos.
		*/
		public function conectar()
		{
			
			$this->mysqli = new mysqli(	DatosDeLaBD::get_servidor(),
										DatosDeLaBD::get_usuario() ,
										DatosDeLaBD::get_password(),
										DatosDeLaBD::get_database());
			

			if ($this->mysqli->connect_errno) 
			{

	    		die("Error de conexión: " . $this->mysqli->connect_error);

			}
		}

		/*
			Cerrar la conexion con la BD
		*/
		public function cerrar_coneccion() 
		{

			$this->mysqli->close();

		}

		/*
			Ejecutar sentencia

			$sentencia 	SQL a ejecutar
		*/
		public function ejecutar($sentencia) 
		{

			self::conectar();

			$this->mysqli->query($sentencia);

			self::cerrar_coneccion();

		}

		/*
			Ejecutar consulta en la base de datos
			
			$sentencia 	SQL de la consulta a ejecutar

			@return 	arreglo listo para recorrer
		*/
		public function ejecutar_consulta($sentencia) 
		{

			self::conectar();

			$resultado_de_la_consulta = $this->mysqli->query($sentencia);

			while($res = $resultado_de_la_consulta->fetch_assoc()) 
			{

				$resultados[] = $res;

			}

			$resultado_de_la_consulta->free();

			self::cerrar_coneccion();

			return $resultados;
			
		}
	}
?>