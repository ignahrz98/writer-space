<?php
	/**
	*	@titulo 		Cinta de navegación en la vista de configuración
	*	@descripcion	Crear y mostra la cinta.
	*/

	class CintaDirectorioConfiguracion 
	{
		
		/**
		*	Iniciar creación de la cinta.
		*/
		public function crear_cinta() 
		{
?>

			<ol class="breadcrumb">

<?php
			#	Añadir ubicación principal.
			$this->add_ubicacion("./?view=configuracion","Panel Principal",false);
			
		}

		/**
		*	Añadir texto indicando ubicación actual del usuario.
		*
		*	$texto_a_mostrar 	Texto indicando ubicación actual.
		*/
		public function add_activo($texto_a_mostrar) 
		{

			$this->add_ubicacion("",$texto_a_mostrar,true);

		}

		/**
		*	Cerrar cinta de direcciones.
		*/
		public function cerrar_cinta() 
		{
?>

			</ol>

<?php
		}

		/**	
		*	Añadir ubicacion a la cinta
		*
		*	@enlace 			Enlace de la ubicacion 
		*	@texto_a_mostrar 	Texto del link
		*	@activo 			Si la ubicacion es activa o no
		*/
		private function add_ubicacion($enlace, $texto_a_mostrar, $activo) 
		{
		
			# En caso de que la ubicacion no sea la activa
			if ($activo == false) 
			{
				
?>

				<li>
					<a href="<?php echo $enlace; ?>">
						<?php echo $texto_a_mostrar; ?>
					</a>
				</li>

<?php
			} 	#	Si la ubicación es la actual.
				else if ($activo == true) 
			{
?>

				<li class="active">
					<?php echo $texto_a_mostrar; ?>
				</li>

<?php
			}

		}

	}
?>