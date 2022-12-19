<?php
/*
    Vista para leer artículos

    Mostrar el artículo que el usuario quiere leer y su información
*/

require_once("core/controller/leer-controller.php");
?>

<div class="container contenedor-section-aside">
    <div class="row">
        <?php

            #   Si algún usuario quiere ver un borrador de otro usuario, que no lo tiene guardado
            #   negar acceso al artículo.
            if($id_usuario_sesion_activa != $id_usuario_autor && $articulo_estado == 0 && $articulo_guardado_status == false || $articulo_existe == false)
            {
                if (isset($_GET['articulo_eliminado_de_guardado_exitosamente'])) 
                {

                    alertasConBotonDeCierre::generar_la_alerta("alert-success","El artículo ha sido eliminado de guardados exitosamente.");
                
                }
        ?>      <br>
                <div class="jumbotron">
                    <h1>Artículo no disponible</h1>
                    <p>Es posible que el artículo no exista, haya sido eliminado o se encuentre en mantenimiento.</p>
                    <p>Tip: Si guardas un artículo, podrás seguir viendolo, aún cuando se encuentre en mantenimiento.</p>
                </div>
        <?php
            }
                else 
            {
        ?>

        
    
                <section class='col-sm-8'>

                    <a name="arriba"></a>

                    <!--Area de alertas-->
                <?php
                    if (isset($_GET['articulo_guardado_exitosamente'])) 
                    {

                        alertasConBotonDeCierre::generar_la_alerta("alert-success","El artículo ha sido guardado exitosamente.");
                    
                    }

                    if (isset($_GET['articulo_eliminado_de_guardado_exitosamente'])) 
                    {

                        alertasConBotonDeCierre::generar_la_alerta("alert-success","El artículo ha sido eliminado de guardados exitosamente.");
                    
                    }

                    #   Cuando un usuario tiene un artículo guardado, que está en estado de borrador.
                    if ($id_usuario_sesion_activa != $id_usuario_autor && $articulo_estado == 0 &&  $articulo_guardado_status == true) 
                    {
                        alertasConBotonDeCierre::generar_la_alerta("alert-warning","Este artículo que has guardado, se encuentra en mantenimiento. Su contenido puede cambiar.");
                    }

                    #   Si no hay sesión activa, lector invitado.
                    if (!isset($id_usuario_sesion_activa)) 
                    {
                        alertasConBotonDeCierre::generar_la_alerta("alert-info","Estas leyendo como invitado.");
                    }

                ?>

                    <ul class="nav nav-tabs hidden-print">
                        <li class="active"><a href="#">Artículo</a></li>

                        <?php  
                            #   Si el lector es el autor del artículo, mostrar editar

                            if(isset($id_usuario_sesion_activa)) 
                            {
                                if($id_usuario_autor == $id_usuario_sesion_activa)
                                {
                        ?>
                                    <li><a href="./?view=editor&id_articulo=<?php echo $id_articulo; ?>">Editar</a></li>
                        
                                    <!-- Button trigger modal -->
                                    <li><a href="#" data-toggle="modal" data-target="#myModal">Información</a></li>
                        <?php
                                }
                        ?>
                                <li>
                                    <a href="./?action=guardar_articulo&id=<?php echo $id_articulo; ?>">
                                        <?php
                                            #   Mostrar Guardar/Guardado.
                                            if ($articulo_guardado_status) 
                                            {

                                                echo "Guardado";

                                            } 
                                                else
                                            {

                                                echo "Guardar";

                                            }
                                        ?>
                                    </a>
                                </li>
                        <?php
                            }
                        ?>

                        <li><a href="./?action=generar_pdf_articulo&id=<?php echo $id_articulo; ?>">Descargar en PDF</a></li>
                    </ul>
            
                    <?php echo $tags_con_links;?>

                    <h1 class="titulo-lectura"><?php echo $articulo_titulo;?></h1><br>

                    <p class="introduccion-articulo-leer"><?php echo $articulo_introduccion; ?></p>

                    <p>Escrito por: <b><?php echo $nombres_usuario_autor . " " . $apellidos_usuario_autor . " @" . $username?></b></p>

                    <?php
                        if($articulo_estado == 1) 
                        {
                    ?>
                            <p><?php echo $fecha_de_publicacion;?></p>
                    <?php  
                        }
                    ?>

                    <div class="cuerpo-lectura">
                        <?php echo $articulo_cuerpo; ?>
                    </div>

                    <div class="lectura-subir">
                        <a href="#arriba" class="hidden-print">Ir arriba</a>
                    </div>
                    
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">
                            <h1 class="panel-title">Fuentes</h1>
                        </div>

                        <div class="panel-body panel-fuentes">
                            <?php
                                if ($articulo_fuente != "") 
                                {
                                    echo $articulo_fuente;
                                }
                                    else
                                {
                            ?>
                                    <span class="label label-default">No contiene fuentes</span>
                            <?php
                                }
                                
                            ?>
                        </div>
                    
                    </div>
                </section>
                
                <aside class="col-sm-4">

                    <div class="panel panel-default hidden-print">
                        <div class="panel-heading">
                            <h1 class="panel-title">Presentación del autor</h1>
                        </div>

                        <div class="panel-body">
                            <p>
                                <?php
                                    echo "@" . $username;
                                    echo "<h4>".$nombres_usuario_autor." ".$apellidos_usuario_autor."</h4>";
                                    echo $usuario_descripcion_autor;
                                ?>                    
                            </p>
                        </div>
                    </div>
                </aside>
            </div>

            <?php
                # Generar modal solo si el lector es el autor del artículo.
                if($id_usuario_autor == $id_usuario_sesion_activa)
                {
            ?>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                        &times;
                                    </button>
                                    
                                    <h4 class="modal-title" id="myModalLabel">
                                        Información del artículo
                                    </h4>
                                </div>

                                <div class="modal-body">
                                    <p>Esta información solo está disponible para el autor del artículo.</p>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th>Información</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>Fecha de creación</td>
                                                <td><?php echo $fecha_de_creacion; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Fecha de publicación</td>
                                                <td>
                                                    <?php 
                                                         
                                                        if ($fecha_de_publicacion == null) 
                                                        {
                                                    ?>
                                                            <span class="label label-default">Aún no ha sido publicado</span>
                                                    <?php
                                                        } else
                                                        {
                                                            echo $fecha_de_publicacion;
                                                        }
                                                    ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Fecha de la úlima actualización</td>
                                                <td>
                                                    <?php 
                                                        
                                                        if ($fecha_ultima_actualizacion == null) 
                                                        {
                                                    ?>
                                                            <span class="label label-default">Aún no ha sido actualizado</span>
                                                    <?php
                                                        } else
                                                        {
                                                            echo $fecha_ultima_actualizacion;
                                                        }
                                                    ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Estado del articulo</td>
                                                <td>
                                                    <?php

                                                        #   Si el estado del articulo es 0 es un borrador.
                                                        if ($articulo_estado == 0) 
                                                        {
                                                    ?>
                                                            <span class="label label-default">Borrador</span>
                                                    <?php
                                                            #echo "Borrador";

                                                        }   #   Si el estado del articulo es 1 está publicado.
                                                            else if ($articulo_estado == 1) 
                                                        {
                                                    ?>
                                                            <span class="label label-success">Publicado</span>
                                                    <?php
                                                            #echo "Publicado";

                                                        }

                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                                        Cerrar
                                    </button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal -->
            <?php
                }
            ?>

            <?php
            }
        ?>
    </div>


</div>