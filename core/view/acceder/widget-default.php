<?php
	/*
		VISTA PARA ACCEDER AL SISTEMA
	*/

    require_once("core/controller/acceder-controller.php");
?>

<div class="container contenedor-section-aside">

    <div class="row">

    	<div class="col-xs-10 col-xs-offset-1 8 col-sm-4 col-sm-offset-4 card-centrado">

            <!--Area de las alertas-->

            <?php
                if (isset($_GET['username_no_registrado'])) 
                {

                    alertasConBotonDeCierre::generar_la_alerta("alert-danger","El username ingresado no se encuentra registrado.");
                
                }

                if (isset($_GET['contrasena_incorrecta'])) 
                {

                    alertasConBotonDeCierre::generar_la_alerta("alert-danger","La contraseña ingresada es incorrecta.");
                
                }
            ?>

    		<form action="./?action=login" method="post" id="formulario_de_login">

    			<fieldset>

    				<legend>Iniciar sesión</legend>
    				
                    <label for="username_login">Ingresar username</label>
		            <input type="text" placeholder="Username" name="username_login" maxlength="30" id="username_login" class="form-control"  value="<?php echo $username_login;?>" required><br>
		            
                    <label for="contrasena_login">Ingresar contraseña</label>
                    <input type="password" placeholder="Contraseña" name ="contrasena_login" maxlength="15" id="contrasena_login" class="form-control" required><br><br>
		            <input type="submit" value="iniciar sesión" class="btn btn-primary btn-block">
		                                 
    			</fieldset>

       		</form>
       		<br>
       		<p>¿No tienes cuenta? <a href="./?view=registro">Regístrate ahora</a></p>

    	</div>

    </div>

</div>