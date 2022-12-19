<?php
	/*
		@titulo			Controlodar de CSS.
		@descripcion 	Controlador encargado de gestionar los archivos .css
	*/

	class CSS
	{
		const TIPO_DE_ARCHIVO = ".css";

		/*
			Añadir archivo .css

			$nombre_del_archivo 	Nombre del archivo a añadir
		*/
		public function add($nombre_del_archivo)
		{
?>
			<link href="<?php echo _ADD_CSS_ . $nombre_del_archivo . self::TIPO_DE_ARCHIVO; ?>" rel="stylesheet" type="text/css">
<?php
		}

		/*
			Añadir tema oscuro, si usuario lo tiene activado
		*/
		public function add_tema_oscuro()
		{
			if (isset($_SESSION['id_usuario_sesion_activa'])) 
			{
				require_once("core/model/usuariosBD.php");

				$tabla_usuarios = new UsuariosBD();

				if ($tabla_usuarios->get_tema_oscuro_status($_SESSION['id_usuario_sesion_activa'])) 
				{
					
					$this->add("tema-oscuro");

				}
			}
		}
	}
?>