<?php
    /**
    *   @titulo         Controlador de la vista del perfil.
    *   @descripcion    Obtener información necesaria para la vista.   
    **/

    require_once(_ADD_MODEL_ . "usuariosBD.php");
    require_once(_ADD_MODEL_ . "articulosBD.php");
    require_once(_ADD_MODEL_ . "usuarios_guardar_articulosBD.php");

    $tabla_usuarios = new UsuariosBD();
    $tabla_articulos = new ArticulosBD();
    $tabla_usuarios_guardar_articulos = new Usuarios_Guardar_ArticulosBD();

    $id_usuario_sesion_activa = $_SESSION['id_usuario_sesion_activa'];

    #   Obtener información del usuario activo para mostrar su perfil.
    $datos_del_perfil_de_usuario = $tabla_usuarios->get_usuario_por_id($id_usuario_sesion_activa);

    #   Preparar datos para mostrar en el perfil
    foreach ($datos_del_perfil_de_usuario as $key) 
    {

        $perfil_username = $key['username'];
        $perfil_nombres = $key['nombres'];
        $perfil_apellidos = $key['apellidos'];
        $perfil_descripcion = $key['usuario_presentacion'];

    }

    #   Variable para realizar la páginación de recursos.
    #   Empieza en 0 por defecto.
    if(isset($_REQUEST['pos'])) 
    {

        $inicio = $_REQUEST['pos'];

    }   #   Si no existe variable para la paginación se empieza en 0.
        else 
    {

        $inicio = 0;

    }

    #	Cadena para $_GET en la paginación
    $articulos_a_filtrar = "";

    #   Verificar que subvista de perfil se ha solicitado.
    if (isset($_GET['perfil'])) 
    {
        # code...
        if ($_GET['perfil'] == "mis_articulos") 
        {
            
            #   Procesar herramienta de busqueda (en caso de ser solicitado el filtrado).
            #   Por defecto, se muestran todos los recursos.
            if (!isset($_REQUEST['articulos_a_filtrar'])) 
            {

                $articulos_del_usuario = $tabla_articulos->get_articulos_por_id_usuario($id_usuario_sesion_activa,$inicio,"todos");

            }   #   Mostrar todos los artículos.
                else if ($_REQUEST['articulos_a_filtrar'] == "todos_los_articulos") 
            {
                
                $articulos_del_usuario = $tabla_articulos->get_articulos_por_id_usuario($id_usuario_sesion_activa,$inicio,"todos");

                $articulos_a_filtrar = "&articulos_a_filtrar=".$_REQUEST['articulos_a_filtrar'];

            }   #   Mostrar articulos borradores.
                else if ($_REQUEST['articulos_a_filtrar'] == "articulos_borradores") 
            {

                $articulos_del_usuario = $tabla_articulos->get_articulos_por_id_usuario($id_usuario_sesion_activa,$inicio,"borrador");
                
                $articulos_a_filtrar = "&articulos_a_filtrar=".$_REQUEST['articulos_a_filtrar'];

            }   #   Mostrar artículos publicados.
                else if ($_REQUEST['articulos_a_filtrar'] == "articulos_publicados") 
            {

                $articulos_del_usuario = $tabla_articulos->get_articulos_por_id_usuario($id_usuario_sesion_activa,$inicio,"publicado");

                $articulos_a_filtrar = "&articulos_a_filtrar=".$_REQUEST['articulos_a_filtrar'];

            }
        } 
            else if ($_GET['perfil'] == "articulos_guardados") 
        {
            $articulos_guardados = $tabla_usuarios_guardar_articulos->get_articulos_guardados_por_el_usuario($id_usuario_sesion_activa,$inicio);
        }
    }

    
?>