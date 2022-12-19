<?php
    /*
      CONTROLADOR DEL LOGIN
    */

    $username_login = $_REQUEST['username_login']; #  Username ingregado
    $contrasena_login = $_REQUEST['contrasena_login']; #  Contraseña ingresada

    require_once("core/model/usuariosBD.php");
    $tabla_usuarios = new UsuariosBD();
    $consulta_de_usuario = $tabla_usuarios->get_usuario_por_username($username_login);

    $cadena_para_mensajes_de_error = "";

    #   Verificar que el array venga con datos
    #   Si está vacio es porque no hay coincidencias en la base de datos.
    if (is_array($consulta_de_usuario)) 
    {

        foreach ($consulta_de_usuario as $key) 
        {

            #   Verificar si el username coincide, de todos modos.
            if ($key['username'] == $username_login) 
            {

                #   Verificar que la contraseña ingresada coincida con la almacenada.
                if (password_verify($contrasena_login, $key['contrasena'])) 
                {

                    $_SESSION['id_usuario_sesion_activa'] = $key['id_usuario'];
                    $_SESSION['username_usuario_sesion_activa'] = $username_login;
                
                    header("Location: ./?view=perfil");

                } else
                {

                    $cadena_direccion = "Location: ./?view=acceder";

                    $cadena_direccion .= "&contrasena_incorrecta";
                    $cadena_direccion .= "&username_login=".$username_login;

                    header($cadena_direccion);

                }

            }

        }

    #   Como el array está vacio se debe a que no existe el username ingresado.
    } else 
    {

        #echo "no existe username";

        $cadena_direccion = "Location: ./?view=acceder";

        $cadena_direccion .= "&username_no_registrado";

        header($cadena_direccion);

    }

?>