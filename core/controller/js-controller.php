<?php
	/*
		@titulo			Controlodar de Javacript.
		@descripcion 	Controlador encargado de gestionar los archivos .js
	*/

	class JS
	{
		const TIPO_DE_ARCHIVO = ".js";

		/*
			Añadir archivo .css

			$nombre_del_archivo 	Nombre del archivo a añadir
		*/
		public function add($nombre_del_archivo)
		{
?>
			<script src=<?php echo _ADD_JS_ . $nombre_del_archivo . self::TIPO_DE_ARCHIVO; ?>></script>	
<?php
		}
	}
?>