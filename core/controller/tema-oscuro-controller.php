<?php
	/*
		CONTROLADOR PARA ACTIVAR MODO OSCURO.
	*/

	class TemaOscuroController 
	{
		/*
			Establecer tema activado por el usuario.
		*/
		public static function set_tema()
		{
			if (isset($_SESSION['id_usuario_sesion_activa'])) 
			{
				require_once("core/model/usuariosBD.php");
				$tabla_usuarios = new UsuariosBD();

				if ($tabla_usuarios->get_tema_oscuro_status($_SESSION['id_usuario_sesion_activa'])) 
				{
?>
					<link href="res/css/tema-oscuro.css" rel="stylesheet" type="text/css">
<?php
				}
			}
		}
	}
?>