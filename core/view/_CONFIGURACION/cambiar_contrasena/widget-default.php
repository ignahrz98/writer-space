<?php
	/*
		VISTA DE CONFIGURACIÓN PARA CAMBIAR LA CLAVE
	*/
?>

<div class="col-md-4 col-md-offset-4 card-centrado">
	<form action="./?action=configuracion" method="post">
	  	<fieldset>
			
			<legend>Cambiar la contraseña</legend>

			<!--Area de las alertas-->
			<?php
				if (isset($_GET['contrasena_actualizada_exitosamente'])) 
				{
					alertasConBotonDeCierre::generar_la_alerta("alert-success","Contraseña actualizada.");
				}

				if (isset($_GET['contrasena_actual_incorrecta'])) 
				{
					# code...
					alertasConBotonDeCierre::generar_la_alerta("alert-danger","La contraseña actual es incorrecta.");
				}

				if (isset($_GET['confirmar_contrasena_fallido'])) 
				{
					# code...
					alertasConBotonDeCierre::generar_la_alerta("alert-danger","No se pudo confirmar la contraseña, porque, no coinciden.");
				}
			?>			
			
			<label for="contrasena_actual">Contraseña actual:</label>
			<input type="password" name="contrasena_actual" placeholder="Contraseña actual..." id="contrasena_actual" class='form-control' minlength="7" maxlength="10" required><br>
			
			<label for="contrasena_nueva">Nueva contraseña:</label>
			<input type="password" name="contrasena_nueva" placeholder="Contraseña nueva..." id="contrasena_nueva" class='form-control' minlength="7" maxlength="10" required><br>
			
			<label for="confirmar_contrasena">Confirmar contraseña:</label>
			<input type="password" name="confirmar_contrasena" placeholder="Confirmar contraseña..." id="confirmar_contrasena" class='form-control' minlength="7" maxlength="10" required><br>
	  		
	  		<input type="hidden" name="tipo" value="cambiar_contrasena">
			
			<input type="submit" value="Cambiar contraseña" class="btn btn-primary btn-block">
		
		</fieldset>
	</form>
</div>