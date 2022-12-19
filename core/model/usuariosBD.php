<?php
	/*
		TABLA USUARIOS.
	*/

	class UsuariosBD 
	{
		const NOMBRE_DE_TABLA = "usuarios";

		/*
			Devolver usuario por username.
			
			$username_a_buscar 		Cadena con el username a buscar.
			@return 				Resultado de la consulta.
		*/
		public function get_usuario_por_username($username_a_buscar) 
		{

			$db = new DBController();

			$sql = "SELECT id_usuario,username,contrasena 
					FROM usuarios
					WHERE username='".$username_a_buscar."';";

			$resultados = $db->ejecutar_consulta($sql);

			return $resultados;

		}

		/*
			Devolver usario por id

			$id_usuario 		Identificador del usuario a devolver

			@return 			Usuario encontrado
		*/
		public function get_usuario_por_id($id_usuario) 
		{
			$db = new DBController();

			$sql = "SELECT * FROM usuarios 
					WHERE id_usuario=".$id_usuario.";";

			$resultados = $db->ejecutar_consulta($sql);

			return $resultados;
		}

		/*
			Devolver status del tema oscuro

			$id_usuario 	ID del usuario a verificar tema oscuro

			@return 		status
		*/
		public function get_tema_oscuro_status($id_usuario)
		{
			$db = new DBController();

			$sql = "SELECT tema_oscuro_active
					FROM usuarios 
					WHERE id_usuario= " . $id_usuario . ";";

			$resultados = $db->ejecutar_consulta($sql);

			foreach ($resultados as $key) 
			{
				if ($key['tema_oscuro_active'] == 0) 
				{
					# code...
					return false;
				} 
					else if ($key['tema_oscuro_active'] == 1) 
				{
					# code...
					return true;
				}
			}
		}

		/*
			Actualizar clave.

			$clave_nueva 	Cadena que contiene la clave nueva del usuario
			$id_usuario 	ID del usuario a actualizar clave
		*/
		public function set_update_clave_nueva($clave_nueva,$id_usuario) 
		{
			$db = new DBController();

			$sql = "UPDATE " . self::NOMBRE_DE_TABLA . "
	                SET contrasena='" . $clave_nueva . "'
	                WHERE id_usuario=" . $id_usuario. ";";

	        $db->ejecutar($sql);

		}
		/*
			Actualizar información personal del usuario.

			$id_usuario				ID del usuario a actualizar información
			$username 				Nombre de usuario desde input
			$nombres 				Nombres desde input
			$apellidos 				Apellidos desde input
			$usuario_presentacion 	Presentacion del usuario desde input

		*/
		public function actualizar_informacion_personal(	$id_usuario,
	                                       					$username,
	                                            			$nombres,
	                                            			$apellidos,
	                                            			$usuario_presentacion)
		{
			$db = new DBController();

			$sql = "UPDATE " . self::NOMBRE_DE_TABLA . "
	                SET username='" . $username . "',
                		nombres='" . $nombres . "',
	                	apellidos='" . $apellidos . "',
	                	usuario_presentacion='" . $usuario_presentacion . "'
	                WHERE id_usuario=" . $id_usuario . ";";

			$db->ejecutar($sql);
		}

		/*
			Actualizar la apariencia.

			$id_usuario 					ID del usuario a actualizar apariencia.
            $tema_oscuro_seleccionado  		Status tema oscuro seleccionado
		*/
		public function actualizar_apariencia( 	$id_usuario,
                                                $tema_oscuro_seleccionado)
		{
			#	Reemplazar select por su numeral correspondiente.
			if ($tema_oscuro_seleccionado == "si") 
			{

				$tema_oscuro_active = 1;

			} else if ($tema_oscuro_seleccionado == "no") 
			{

				$tema_oscuro_active = 0;

			}

			$db = new DBController();

			$sql = "UPDATE " . self::NOMBRE_DE_TABLA . "
	                SET tema_oscuro_active='" . $tema_oscuro_active . "'
	                WHERE id_usuario=" . $id_usuario . ";";

	        $db->ejecutar($sql);

		}

		/*
			Crear un nuevo usuario.

			$username_usuario_nuevo 			Username a registrar
			$contrasena_usuario_nuevo  			Contraseña del usuario a registrar
		*/
		public function set_nuevo_usuario(	$username_usuario_nuevo,
											$contrasena_usuario_nuevo)
		{

			$db = new DBController();

			$sql = "INSERT INTO usuarios(
					username,
					contrasena) 

					VALUES (
					'".$username_usuario_nuevo."',
					'".$contrasena_usuario_nuevo."');";

			$db->ejecutar($sql);
			
		}

		/*
			Verificar si el username ingresado está disponible

			$username_a_verificar 	Cadena con el username a verificar si está disponible

			@return 	Estado del username
		*/
		public function verificar_username_disponible($username_a_verificar) 
		{

			$db = new DBController();

			$sql = "SELECT * FROM usuarios 
					WHERE username='".$username_a_verificar."';";

			$resultados = $db->ejecutar_consulta($sql);

			#	Buscar coincidiencias

			$username_esta_disponible = true;

			foreach ($resultados as $key) 
			{
				
				if ($username_a_verificar == $key['username']) 
				{
					
					$username_esta_disponible = false;

				} 

			}

			return $username_esta_disponible;

		}
	}
?>