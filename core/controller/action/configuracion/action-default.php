<?php
    /** 
    *   @titulo         Configuración del usuario.
    *   @descripción    Realizar las operaciones de configuración.
    */

    require_once(_ADD_MODEL_ . "usuariosBD.php");

    require_once(_ADD_ACTION_ . "configuracion/cambiar_contrasena/" . _ACTION_FILE);
    require_once(_ADD_ACTION_ . "configuracion/informacion_personal/" . _ACTION_FILE);
    require_once(_ADD_ACTION_ . "configuracion/apariencia/" . _ACTION_FILE);

    $tabla_usuarios = new UsuariosBD();

    #	Almacenar id del usuario
    $id_usuario_sesion_activa = $_SESSION['id_usuario_sesion_activa'];

    #	Tipo de operacion solicitada
    $operacion = $_REQUEST['tipo'];

    #	Recuperar datos del usuario para realizar comparaciones necesarias.
    $datos_de_usuario = $tabla_usuarios->get_usuario_por_id($id_usuario_sesion_activa);

    #   Añadir datos de la BD a variables.
    foreach ($datos_de_usuario as $key) 
    {

        $username_actual = $key['username'];
    	$nombres_actual = $key['nombres'];
        $apellidos_actual = $key['apellidos'];
        $contrasena_actual = $key['contrasena'];
        $usuario_presentacion_actual = $key['usuario_presentacion'];
        $tema_oscuro_active = $key['tema_oscuro_active'];

    }

    $cadena_direccion = "Location: ./?view=configuracion";

    #	En caso de solicitar cambiar la contraseña.
    if($operacion == "cambiar_contrasena") 
    {
        
        $cadena_direccion .= "&configurar=cambiar_contrasena";

        $cambiar_contrasena = new CambiarContrasena();

        $cambiar_contrasena->set(   $id_usuario_sesion_activa,
                                    $_REQUEST['contrasena_actual'],
                                    $_REQUEST['contrasena_nueva'],
                                    $_REQUEST['confirmar_contrasena'],
                                    $contrasena_actual);

        $cadena_direccion .= $cambiar_contrasena->get_cadena_direccion();

    }   #    En caso de solicitar actualizar datos del usuario
        else if($operacion == "informacion_personal") 
    {

        $cadena_direccion .= "&configurar=informacion_personal";

        $informacion_personal = new InformacionPersonal();

        $informacion_personal->set( $id_usuario_sesion_activa,
                                    $_REQUEST['username'],
                                    $_REQUEST['nombres'],
                                    $_REQUEST['apellidos'],
                                    $_REQUEST['presentacion'],
                                    $username_actual);

        $cadena_direccion .= $informacion_personal->get_cadena_direccion();

    }   #   En caso de cambiar apariencia.
        else if($operacion == "apariencia")
    {

        $cadena_direccion .= "&configurar=apariencia";

        $apariencia = new Apariencia();

        $apariencia->set(   $id_usuario_sesion_activa,
                            $_REQUEST['tema_oscuro']);

    }

    header($cadena_direccion);
?>