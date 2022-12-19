<?php
	/**
	*	@titulo 		Action para actualizar la información personal del usuario.
	*	@descripcion 	Realizar la actualización de la información personal de los usuarios.
	*/

	require_once(_ADD_MODEL_ . "usuariosBD.php");

	class InformacionPersonal
	{
		var $cadena_direccion = "";

		/**
		*	Establecer la actualización de la información personal.
		*/
		public function set( 	$id_usuario_sesion_activa,
								$username,
								$nombres,
								$apellidos,
								$usuario_presentacion,
								$username_actual)
		{
			$tabla_usuarios = new UsuariosBD();

			#   Verificar que el nuevo username esté disponible.
			#   Primero comparar que el username desde el formulario sea diferente al actual.
			if ($username_actual != $username)
			{

				#   Verificar que esté disponible el nuevo username.
				if ($tabla_usuarios->verificar_username_disponible($username)) 
				{

					#   Actualizar información del usuario.
					#	Actualizando el username.
					$tabla_usuarios->actualizar_informacion_personal(   $id_usuario_sesion_activa,
                                                                    	$username,
                                                                    	$nombres,
                                                                    	$apellidos,
                                                                    	$usuario_presentacion);

					$this->add_cadena_direccion("&informacion_personal_actualizada_exitosamente");

				} 	# En caso, el username no está disponible.
					else
				{

					$this->add_cadena_direccion("&username_no_disponible");

				}

			}   # En caso, no hay cambios en el username.
				else
			{
				
				$tabla_usuarios->actualizar_informacion_personal(   $id_usuario_sesion_activa,
                                                                	$username,
                                                                	$nombres,
                                                                	$apellidos,
                                                                	$usuario_presentacion);

				$this->add_cadena_direccion("&informacion_personal_actualizada_exitosamente");
			}

		}

		/**
		*	Añadir a la cadena de direccion
		*	
		* 	$cadena
		*/
		private function add_cadena_direccion($cadena)
		{

			$this->cadena_direccion .= $cadena;

		}

		/**
		*	Retornar la cadena direccion.
		*/
		public function get_cadena_direccion()
		{

			return $this->cadena_direccion;

		}
	}
?>