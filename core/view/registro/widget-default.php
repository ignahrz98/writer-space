<?php
    /*
        VISTA DE REGISTRO DE USUARIOS
    */

    require_once("core/controller/registro-controller.php");
?>

<section>
                
    <div class="container contenedor-section-aside">

        <div class="row">

            <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4 card-centrado">

                <a href="./?view=acceder">&larr; Regresar a iniciar sesión</a><br><br>

                <!--Area de las alertas-->
                <?php

                    if (isset($_GET['espacios_en_blanco'])) 
                    {

                        alertasConBotonDeCierre::generar_la_alerta("alert-danger","El username no puede contener espacios en blanco.");
                    
                    }

                    if (isset($_GET['username_corto'])) 
                    {

                        alertasConBotonDeCierre::generar_la_alerta("alert-danger","El username es muy corto.");
                    
                    }

                    if (isset($_GET['username_disponible'])) 
                    {

                        alertasConBotonDeCierre::generar_la_alerta("alert-success","El username está dìsponible.");
                    
                    }

                    if (isset($_GET['username_en_uso'])) 
                    {

                        alertasConBotonDeCierre::generar_la_alerta("alert-danger","El username ya está en uso.");
                    
                    }

                    if (isset($_GET['contrasena_corta'])) 
                    {

                        alertasConBotonDeCierre::generar_la_alerta("alert-danger","La contraseña es muy corta.");
                    
                    }

                    if (isset($_GET['contrasena_larga'])) 
                    {

                        alertasConBotonDeCierre::generar_la_alerta("alert-danger","La contraseña es muy larga.");
                    
                    }

                    if (isset($_GET['contrasenas_no_coinciden'])) 
                    {

                        alertasConBotonDeCierre::generar_la_alerta("alert-danger","Las contraseñas no coinciden.");

                    }

                    if (isset($_GET['registro_exitoso'])) 
                    {

                        alertasConBotonDeCierre::generar_la_alerta("alert-success","El registro se ha realizado exitosamente.");
                    
                        alertasConBotonDeCierre::generar_la_alerta("alert-info","Ya puedes iniciar sesión con tu nueva cuenta.");

                    }

                ?>

    	     	 <form action="./?action=registro" method="post" id="formulario_de_registro" class="center-block">
                    <fieldset>
                        <legend>Registrarme</legend>
                            
                        <label for="username_registrar">Crear username</label>
                        <input type="text" placeholder="Username" name="username_registrar" minlength="5" maxlength="30" id="username_registrar" class="form-control" value="<?php echo $username_registrar;?>" required>
                        <span class="help-block">El username no deberá contener espacios en blanco, y tener más de 5 carácteres</span>

                        <label for="crear_contrasena">Crear Contraseña</label>
                        <input type="password" placeholder="Password" name="crear_contrasena"  minlength="7" maxlength="10" id="crear_contrasena" class="form-control" required>
                        <span class="help-block">Su contraseña deberá contener entre 7 y 10 carácteres</span>

                        <label for="confirmar_contrasena">Confirmar La Contraseña</label>
                        <input type="password" placeholder="Confirmar password" name="confirmar_contrasena" minlength="7" maxlength="10" id="confirmar_contrasena" class="form-control" required>
                        <span class="help-block">Para confirmar la contraseña, deberá volverla a ingresar</span>
                        <br><br>

                        <span class="help-block">Cuando todo esté listo, haga click en "Registrarme"</span>
                        <input type="submit" value="Registrarme" class="btn btn-primary btn-block">
                    </fieldset>
                </form>

            </div>

        </div>

    </div>
    
</section>