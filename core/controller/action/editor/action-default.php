<?php
    /**
    *   @titulo         Controlador de action del editor.
    *   @descripcion    Ejecutar operaciones sobre los artículos desde el editor.
    **/

    #   Añadir clase de articulos, para evitar añadirlo más adelante
    #   en las validaciones.
    require_once(_ADD_MODEL_ . "articulosBD.php");
    require_once(_ADD_MODEL_ . "usuarios_guardar_articulosBD.php");

    #   Crear objeto para tabla recurso por adelantado.
    $tabla_articulos = new ArticulosBD();
    $tabla_usuarios_guardar_articulosBD = new Usuarios_Guardar_ArticulosBD();

    #   Pasar variable de sesión a una variable normal
    $id_usuario_sesion_activa = $_SESSION['id_usuario_sesion_activa'];

    #   Pasar a variables normales los datos que vienen del editor de artículos.
    $articulo_titulo = $_REQUEST['articulo_titulo'];
    $articulo_introduccion = $_REQUEST['articulo_introduccion'];
    $articulo_cuerpo = $_REQUEST['articulo_cuerpo'];
    $articulo_tags = $_REQUEST['articulo_tags'];
    $articulo_fuente = $_REQUEST['articulo_fuente'];
    $articulo_estado = $_REQUEST['articulo_estado'];

    #   Proceder a reemplazar a la comilla simple que detiene ejecucion de BD
    $articulo_titulo = str_replace('\'', '´', $articulo_titulo);
    $articulo_introduccion = str_replace('\'', '´', $articulo_introduccion);
    $articulo_cuerpo = str_replace('\'', '´', $articulo_cuerpo);
    $articulo_tags = str_replace('\'', '´', $articulo_tags);
    $articulo_fuente = str_replace('\'', '´', $articulo_fuente);

    #   Lo mismo con las comillas dobles. 
    $articulo_titulo = str_replace('"', '´´', $articulo_titulo);
    $articulo_introduccion = str_replace('"', '´´', $articulo_introduccion);
    $articulo_tags = str_replace('"', '´´', $articulo_tags);


    #	Fecha de operacion para aplicar a insertar o actualizar.
    $fecha_actual = date("Y/m/d H:i:s");


    #	Creación del artículo.
    if (isset($_POST['crear'])) 
    {

        #   Realizar el INSERT, dependendiendo si es borrador o publicado al momento
        #   de crear el articulo, la capa de modelo se ocupa de eso.
        $tabla_articulos->set_articulo_nuevo(   $id_usuario_sesion_activa,
                                                $articulo_titulo,
                                                $articulo_introduccion,
                                                $articulo_cuerpo,
                                                $articulo_fuente,
                                                $articulo_estado,
                                                $articulo_tags,
                                                $fecha_actual);

        #   Obtener el ID del artículo para redirigir a editarlo.
        $id_articulo_nuevo = $tabla_articulos->get_id_ultimo_articulo_por_usuario($id_usuario_sesion_activa);

        #   Redirigir a editor.
        $cadena_direccion = "Location: ./?view=editor&articulo_creado_exitosamente";

        #   En caso de que el artículo sea publicado al momento de su creación.
        if ($articulo_estado == "publicado") 
        {

            $cadena_direccion .= "&articulo_creado_publicado";

        }

        #   Concatenar ID del articulo creado a la dirección.
        foreach ($id_articulo_nuevo as $key) 
        {

            $cadena_direccion .= "&id_articulo=" . $key['id_articulo'];

        }
        

        header($cadena_direccion);

    
    }   #   Eliminar artículo.
        else if (isset($_POST['eliminar'])) 
    {

    	#	Recuperar id del artículo a eliminar.
        $id_articulo_eliminar = $_REQUEST['id_articulo'];

        #   Realizar el DELETE.
        $tabla_articulos->eliminar_articulo($id_articulo_eliminar);

        #   Eliminar de articulos guardados en todos los usuarios.
        $tabla_usuarios_guardar_articulosBD->eliminar_articulos_guardados_a_todos($id_articulo_eliminar);

        #   Redirigir a editor.
        $cadena_direccion = "Location: ./?view=editor&articulo_eliminado_exitosamente";

        header($cadena_direccion);

    
    }   #   Actualizar artículo.
        else if (isset($_POST['actualizar'])) 
    {

        #   Pasar par de variables importantes para este procedimiento.
        #   Se recupera articulo_publicado_status para mantener lógica del sitio.
    	$articulo_publicado_status = $_REQUEST['articulo_publicado_status'];
        $articulo_estado_previo = $_REQUEST['articulo_estado_previo'];
    	$id_articulo = $_REQUEST['id_articulo'];

        #   Realizar la actualización.
        $tabla_articulos->actualizar_articulo(  $id_articulo,
                                                $articulo_titulo,
                                                $articulo_introduccion,
                                                $articulo_cuerpo,
                                                $articulo_fuente,
                                                $articulo_estado,
                                                $articulo_tags,
                                                $fecha_actual,
                                                $articulo_publicado_status);

        #   Redirigir a editor.
        $cadena_direccion = "Location: ./?view=editor&id_articulo=" .$id_articulo . "&articulo_actualizado_exitosamente";

        #   En caso de que el artículo sea publicado al momento de actualizar.
        #   Se debe verificar que no este previamente publicado para no mostrar
        #   el mensaje de publicado sin necesidad.
        if ($articulo_estado == "publicado" && $articulo_estado_previo != 1) 
        {

            $cadena_direccion .= "&articulo_actualizado_publicado";

        }

        header($cadena_direccion);

    
   
    }   #   Leer artículo
        else if (isset($_POST['leer'])) 
    {
    	
    	header("Location: ./?view=leer&id=".$_POST['id_articulo']."");

    }   #   En caso de crear borrador desde .txt
        else if (isset($_POST['archivo_submit'])) 
    {

        #   type del archivo.
        $tipo_archivo = $_FILES['archivo_de_texto']['type'];

        if ($tipo_archivo == "text/plain") 
        {

            #   Datos del archivo 
            $nombre_archivo = $_FILES['archivo_de_texto']['name'];
            $archivo_temporal = $_FILES["archivo_de_texto"]["tmp_name"];

            $fp = fopen($archivo_temporal, "r");
            
            $articulo_cuerpo = fread($fp, filesize($archivo_temporal));
            $articulo_cuerpo = nl2br($articulo_cuerpo);

            fclose($fp);

            $tabla_articulos->set_articulo_nuevo(   $id_usuario_sesion_activa,
                                                    $nombre_archivo,
                                                    "",
                                                    $articulo_cuerpo,
                                                    "",
                                                    "borrador",
                                                    "",
                                                    $fecha_actual);

            #   Obtener el ID del artículo para redirigir a editarlo.
            $id_articulo_nuevo = $tabla_articulos->get_id_ultimo_articulo_por_usuario($id_usuario_sesion_activa);

            #   Concatenar ID del articulo creado a la dirección.
            foreach ($id_articulo_nuevo as $key) 
            {

                $cadena_direccion .= "&id_articulo=" . $key['id_articulo'];

            }

            #   Redirigir a editor.
            $cadena_direccion = "Location: ./?view=editor&articulo_creado_exitosamente";

            #   Concatenar ID del articulo creado a la dirección.
            foreach ($id_articulo_nuevo as $key) 
            {

                $cadena_direccion .= "&id_articulo=" . $key['id_articulo'];

            }

            header($cadena_direccion);

        }   #   En caso de que el tipo de archivo sea incorrecto.
            else 
        {

             $cadena_direccion = "Location: ./?view=editor&tipo_archivo_incorrecto";

             header($cadena_direccion);

        }
    }
?>