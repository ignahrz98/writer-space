<?php
    /*
        CONTROLADOR PARA LEER ARTÍCULOS
    */

    require_once("core/model/articulosBD.php");
    require_once("core/model/usuarios_guardar_articulosBD.php");

    $tabla_articulos = new ArticulosBD();
    $tabla_usuarios_guardar_articulos = new Usuarios_Guardar_ArticulosBD();

    if(isset($_SESSION['id_usuario_sesion_activa'])) 
    {

        #	Clave primaria del usuario activo.
        $id_usuario_sesion_activa = $_SESSION['id_usuario_sesion_activa'];

    }

    #   Boleano para verificar si existe artículo.
    $articulo_existe = true;

    #	Recuperar id del recurso a visualizar.
    $id_articulo_a_leer = $_REQUEST['id'];

    #   Verificar si existe al artículo a visualizar.
    if ($tabla_articulos->get_articulos_existe_status($id_articulo_a_leer)) 
    {

        $articulo_a_leer = $tabla_articulos->get_articulo_por_id($id_articulo_a_leer);

        #   Preparar variables para mostrar artículo
        foreach ($articulo_a_leer as $key) 
        {
            $id_articulo = $key['id_articulo'];
            $articulo_titulo = $key['articulo_titulo'];
            $articulo_introduccion = $key['articulo_introduccion'];
            $articulo_cuerpo = $key['articulo_cuerpo'];
            $articulo_estado = $key['articulo_estado'];
            $articulo_tags = $key['articulo_tags'];
            $articulo_fuente = $key['articulo_fuente'];
            $fecha_de_creacion = $key['fecha_de_creacion'];
            $fecha_de_publicacion = $key['fecha_de_publicacion'];
            $fecha_ultima_actualizacion = $key['fecha_ultima_actualizacion'];
            $id_usuario_autor = $key['id_usuario'];

            $username = $key['username'];
            $nombres_usuario_autor = $key['nombres'];
            $apellidos_usuario_autor = $key['apellidos'];
            $usuario_descripcion_autor = $key['usuario_presentacion'];
        }

        #   Preparar cadena de tags con link
        $tags_separados = explode(",", $articulo_tags);
        $tags_con_links = "";

        foreach ($tags_separados as $key=>$valor) 
        {
            #  Si $valor está vacio es porque no se han indicado tags.
            
            if ($valor != "") 
            {
                $tags_con_links = $tags_con_links . "   <span class='label label-default label-tags-con-links hidden-print'>
                                                            <a href='./?view=buscador&buscador=" . $valor . "&busqueda=etiquetas' class='tags-con-links'> 
                                                                " . $valor . "
                                                            </a>
                                                        </span>";
            }
            
        }

        if(isset($id_usuario_sesion_activa))
        {
            #   Verificar si el usuario a guardado del artículo.
            if ($tabla_usuarios_guardar_articulos->get_usuario_guardar_articulo_status($id_usuario_sesion_activa,$id_articulo)) 
            {
                $articulo_guardado_status = true;
            } 
                else
            {
                $articulo_guardado_status = false;
            }
        }
        

    }   #   En caso de no existir
        else
    {
        $articulo_existe = false;
    }

?>