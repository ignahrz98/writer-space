<?php
	/**
	*	@titulo 		Action para cambiar apariencia.
	* 	@descripcion 	Cambiar la apariencia del sistema a gusto del usuario.
	*/

	require_once(_ADD_MODEL_ . "usuariosBD.php");

	class Apariencia
	{
		var $cadena_direccion = "";

		public function set($id_usuario_sesion_activa,
							$tema_oscuro_seleccionado)
		{

			$tabla_usuarios = new UsuariosBD();
			$tabla_usuarios->actualizar_apariencia(	$id_usuario_sesion_activa,
                                               		$tema_oscuro_seleccionado);

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