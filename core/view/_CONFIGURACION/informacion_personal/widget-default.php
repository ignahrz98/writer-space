<?php
	/*
        VISTA DE LA CONFIGURACIÓN DE LOS DATOS PERSONALES
    */
?>

<div class="col-md-4 col-md-offset-4 card-centrado">
    
    <form action="./?action=configuracion" method="post">
        <fieldset>

            <legend>Tus datos.</legend>

            <!--Area de las alertas-->
            <?php
                if (isset($_GET['informacion_personal_actualizada_exitosamente'])) 
                {
                    alertasConBotonDeCierre::generar_la_alerta("alert-success","Su información personal ha sido actualizada.");
                }

                if (isset($_GET['username_no_disponible'])) 
                {
                    alertasConBotonDeCierre::generar_la_alerta("alert-danger","Username no disponible.");
                }
            ?>

            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo $username;?>" id="username" placeholder="username.." class='form-control'>
            <br>

            <label for="nombres">Nombres</label>
            <input type="text" name="nombres" value="<?php echo $nombres;?>" id="nombres" placeholder="nombres.." class='form-control'>
            <br>

            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" value="<?php echo $apellidos;?>" id="apellidos" placeholder="apellidos..." class='form-control'>
            <br>
            
            <label for="presentacion">Su presentación</label>
            <textarea name="presentacion" id="presentacion" class="form-control textarea-usuario-presentacion" maxlength="250" placeholder="Presentese a los demás..."><?php echo $presentacion;?></textarea>
       
    		
            <input type="hidden" name="tipo" value="informacion_personal"><br><br>
    		<input type="submit" value="Guardar Cambios" class='btn btn-primary btn-block'>

    	</fieldset>
    </form>
</div>