<?php
	/*
		PLANTILLAS DE LAS ALERTAS QUE TIENEN BOTON DE CIERRE.
	*/

	class alertasConBotonDeCierre {

		/*
			Generar la alerta solicitada

			$tipo_de_alerta 		Tipo de alerta a mostrar:
									alert-success
									alert-info
									alert-warning
									alert-danger
			$mensaje_a_mostrar 		Mensaje a mostrar en la alerta
		*/
		public static function generar_la_alerta($tipo_de_alerta,$mensaje_a_mostrar)
		{

?>

			<div class="alert <?php echo $tipo_de_alerta;?> alert-dismissable">
				
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
					&times;
				</button>
				
				<?php echo $mensaje_a_mostrar;?>

			</div>

<?php
		}
		
	}
?>