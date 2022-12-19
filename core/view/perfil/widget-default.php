<?php
    /**
    *   @titulo         Vista del perfil
    *   @descripcion    Mostrar vista del perfil
    **/

    require_once(_ADD_CONTROLLER_ . "perfil-controller.php");
?>

    <div class="container contenedor-section-aside">

        <div class="row">
            <br>
            <aside class="col-sm-4">

                <?php
                    require_once(_ADD_VIEW_ . "_PERFIL/_MENU_LATERAL/" . _VIEW_FILE);
                ?>

            </aside>

            <section class='col-sm-8'>

                    <?php
                        #   Vista por defecto del perfil.
                        if (!isset($_GET['perfil'])) 
                        {

                            require_once(_ADD_VIEW_ . "_PERFIL/default/" . _VIEW_FILE);

                        }   #   En caso de mostrar artículos del usuario.
                            else if ($_GET['perfil'] == "mis_articulos") 
                        {

                            require_once(_ADD_VIEW_ . "_PERFIL/mis_articulos/" . _VIEW_FILE);

                        }   #   En caso de mostrar artículos guardados del usuario.
                            else if ($_GET['perfil'] == "articulos_guardados") 
                        {

                            require_once(_ADD_VIEW_ . "_PERFIL/articulos_guardados/" . _VIEW_FILE);

                        }

                    ?>

            </section>
        </div>
    </div>