<?php
    /*
        VISTA DEL INDEX.
    */

    require_once("core/controller/index-controller.php");

    #   Mostrar la vista dependiendo si existe o no una sesión activa.
    if (isset($_SESSION['id_usuario_sesion_activa'])) 
    {

        require_once("core/view/_INDEX/sesion_usuario_activa/widget-default.php");

    }   #   Si no existe mostrar la vista por defecto.
        else 
    {

        require_once("core/view/_INDEX/default/widget-default.php");

    }
?>