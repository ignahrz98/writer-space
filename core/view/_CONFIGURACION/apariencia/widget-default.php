<?php
	/**
	*	@titulo 		Vista para configurar apariencia.
	* 	@descripcion 	Permite al usuario seleccionar que apariencia desea para el
	*					sistema.
	*/
?>

<div class="col-md-4 col-md-offset-4 card-centrado">
	<form action="./?action=configuracion" method="post">
		<fieldset>

			<legend>Apariencia</legend>

			<label for="tema_oscuro">Activar tema</label>

			<select name="tema_oscuro" id="tema_oscuro" class="form-control">
				<option value="no"
					<?php
						if ($tema_oscuro_active == 0) 
						{
							echo " selected ";
						}
					?>
				>Tema predeterminado</option>
				<option value="si"
					<?php
						if ($tema_oscuro_active == 1) 
						{
							echo " selected ";
						}
					?>
				>Tema oscuro</option>
			</select>
			<br>

			<input type="hidden" name="tipo" value="apariencia">

			<input type="submit" value="Ok" class="btn btn-primary btn-block">
			
		</fieldset>
	</form>
</div>