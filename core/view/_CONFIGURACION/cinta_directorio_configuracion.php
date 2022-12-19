<?php
#	Cinta de navegacion en la vista de configuración

class CintaDirectorioConfiguracion {
	#	function a llamar
	public function crear_cinta() {
		echo "<ol class=\"breadcrumb\">";

		echo self::add_ubicacion("./?view=configuracion","Panel Principal",false);
		
	}

	public function add_activo($texto_a_mostrar) {
		echo self::add_ubicacion("",$texto_a_mostrar,true);
		
		echo "</ol>";
	}

	public function cerrar_cinta() {
		echo "</ol>";
	}

	/*	
	Añadir ubicacion a la cinta
	@enlace 			Enlace de la ubicacion 
	@texto_a_mostrar 	Texto del link
	@activo 			Si la ubicacion es activa o no

	<li><a href="./?view=configuracion">Panel Principal</a></li>
	<li class="active">Información personal</li>
	*/
	private function add_ubicacion($enlace, $texto_a_mostrar, $activo) {
		$cadena_ubicacion = "";

		# En caso de que la ubicacion no sea la activa
		if ($activo == false) {
			
			$cadena_ubicacion .= "<li><a href=\"".$enlace."\">".$texto_a_mostrar."</a></li>";

		} else if ($activo == true) {
			$cadena_ubicacion .= "<li class=\"active\">".$texto_a_mostrar."</li>";
		}

		return $cadena_ubicacion;
	}

}
?>