<?php
	/**
	*	@titulo 		Action para cambiar contraseña.
	*	@descripcion	Realizar el cambio de contraseña.
	*/

	require_once(_ADD_MODEL_ . "usuariosBD.php");

	class CambiarContrasena 
	{
		var $cadena_direccion = "";

		/**
		*	Establecer nueva contrasena
		*
		*	$id_usuario_sesion_activa
		*	$contrasena_actual_ingresada
		*	$contrasena_nueva_ingresada
		*	$confirmar_contrasena_ingresada
		*	$contrasena_actual
		*/
		public function set(	$id_usuario_sesion_activa,
								$contrasena_actual_ingresada,
								$contrasena_nueva_ingresada,
								$confirmar_contrasena_ingresada,
								$contrasena_actual)
		{
			#	Validar la confirmación de la contraseña.
        	if ($contrasena_nueva_ingresada == $confirmar_contrasena_ingresada)
        	{
        		#   Validar que tanto la clave ingresada como la registrada en la BD coincidan.
        		if(password_verify($contrasena_actual_ingresada, $contrasena_actual))
        		{

        			#   Crear la contraseña con hash.
        			$crear_contrasena_con_hash = password_hash( $contrasena_nueva_ingresada,
                                                            	PASSWORD_DEFAULT);

        			#   Actualizar clave por la nueva ingresada.
        			$tabla_usuarios = new UsuariosBD();
        			$tabla_usuarios->set_update_clave_nueva($crear_contrasena_con_hash,
                                                        	$id_usuario_sesion_activa);

        			$this->add_cadena_direccion("&contrasena_actualizada_exitosamente");

        		}	# Si la contraseña no coincide con la almacenada.
        			else
        		{

        			$this->add_cadena_direccion("&contrasena_actual_incorrecta");

        		}

        	} 	#	Si no coinciden las contraseñas al confirmarse.
        		else
        	{

        		$this->add_cadena_direccion("&confirmar_contrasena_fallido");

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