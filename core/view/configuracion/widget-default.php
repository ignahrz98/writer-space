<?php
    /**
    *   @titulo         Vista de configuración del usuario
    *   @descripcion    Plantilla para cargar las diferentes vistas que posee, la configuración
    *                   del usuario.
    */

    require_once(_ADD_CONTROLLER_ . "configuracion-controller.php");

    require_once(_ADD_VIEW_ . "_CONFIGURACION/_CINTA_DIRECTORIO/" . _VIEW_FILE);

    $cinta = new CintaDirectorioConfiguracion();
?>

<div class="container contenedor-section-aside">
    <div class="row">
        <div class="col-md-12">
            
            <div class="page-header">
                <h1>Panel de configuración</h1>
            </div>

            <?php
                #   Iniciar creación de la cinta.
                $cinta->crear_cinta();

                #   Vista por defecto en configuración
                if (!isset($_GET['configurar'])) 
                {

                    #   Cerrar cinta, sin añadir más nada.
                    $cinta->cerrar_cinta();

                    #   Cargar vista de configuración, por defecto.
                    require_once(_ADD_VIEW_ . "_CONFIGURACION/" . _VIEW_FILE);
            
                }   #   En caso, el usuario quiera cambiar su contrasena.
                    else if ($_GET['configurar'] == 'cambiar_contrasena') 
                {
                    
                    #   Añadir a cinta, ubicación actual.
                    $cinta->add_activo("Cambiar contraseña");
                    $cinta->cerrar_cinta();

                    require_once(_ADD_VIEW_ . "_CONFIGURACION/cambiar_contrasena/" . _VIEW_FILE);
            
                }   #   En caso, el usuario quiere cambiar su información personal
                    else if ($_GET['configurar'] == 'informacion_personal') 
                {

                    $cinta->add_activo("Información personal");
                    $cinta->cerrar_cinta();
                
                    require_once(_ADD_VIEW_ . "_CONFIGURACION/informacion_personal/" . _VIEW_FILE);
            
                }   #   En caso, el usuario quiere cambiar la apariencia del sistema.
                    else if ($_GET['configurar'] == 'apariencia') 
                {

                    $cinta->add_activo("Apariencia");
                    $cinta->cerrar_cinta();
                
                    require_once(_ADD_VIEW_ . "_CONFIGURACION/apariencia/" . _VIEW_FILE);
            
                }
            ?>

        </div>
    </div>

</div>