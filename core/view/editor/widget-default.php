<?php
    /*
        VISTA DEL EDITOR DE ARTÍCULOS
    */

    require_once("core/controller/editor-controller.php");
?>

<div class="container contenedor-section-aside">
    <div class="row">          
        
        <section class='col-sm-8'>

            <!--Area de las alertas-->
            <?php 

                if (!isset($_REQUEST['id_articulo'])) 
                {

                    alertasConBotonDeCierre::generar_la_alerta("alert-info","Usted está a punto de comenzar un nuevo artículo.");
                
                } 
                    else
                {   

                    alertasConBotonDeCierre::generar_la_alerta("alert-info","Usted está editando un articulo. <a href='./?view=editor' class='alert-link'>Iniciar uno nuevo ahora</a>");

                }

                if (isset($_GET['articulo_creado_exitosamente'])) 
                {
                    
                    alertasConBotonDeCierre::generar_la_alerta("alert-success","El artículo ha sido creado exitosamente.");

                }

                if (isset($_GET['articulo_creado_publicado']) || isset($_GET['articulo_actualizado_publicado'])) 
                {

                    alertasConBotonDeCierre::generar_la_alerta("alert-success","El artículo ha sido publicado.");

                }

                if (isset($_GET['articulo_eliminado_exitosamente'])) 
                {

                    alertasConBotonDeCierre::generar_la_alerta("alert-success","El artículo ha sido eliminado exitosamente.");
                
                }

                if (isset($_GET['articulo_actualizado_exitosamente'])) 
                {

                    alertasConBotonDeCierre::generar_la_alerta("alert-success","El artículo ha sido actualizado exitosamente.");
                
                }

                if (isset($_GET['tipo_archivo_incorrecto'])) 
                {

                    alertasConBotonDeCierre::generar_la_alerta("alert-danger","No se pudo generar artículo, tipo de archivo incorrecto.");
                
                }

            ?>
            
            <!--Formulario editor de articulos-->
            <form action="./?action=editor" method="post" id="editor-de-articulos">
                
                <fieldset>
                   
                    <legend>Editor de artículos</legend>
                    
                    <label for="articulo_titulo">Titulo del artículo</label>
                    <input type="text" name="articulo_titulo" placeholder="Título del artículo..." maxlength="200" id="articulo_titulo" class="form-control" value="<?php echo $articulo_titulo; ?>" required><br>
                    
                    <label for="articulo_introduccion">Introducción del artículo</label>
                    <textarea name="articulo_introduccion" id="articulo_introduccion" placeholder="Redacte una breve introducción de su artículo..." class="form-control textarea-articulo-introduccion" maxlength="1000"><?php echo $articulo_introduccion; ?></textarea><br>

                    <label for="articulo_cuerpo">Cuerpo del artículo</label><br>
                    <textarea name="articulo_cuerpo" placeholder="Contenido de su artículo..." id="articulo_cuerpo" class="form-control" ><?php echo $articulo_cuerpo; ?></textarea><br>
                    
                    <!--FORMULARIO CONTINUA EN EL ASIDE-->
        </section>
        
        <aside class="col-sm-4">
            
            <!--CONTINUACION DEL FORMULARIO DEL SECTION-->
            <label for="articulo_tags">Etiquetas del artículo</label>
            <input type="text" name="articulo_tags" placeholder="Indicar etiquetas separados por comas, ejm: tag1, tag2..."  id="articulo_tags" maxlength="200" class="form-control" onkeyup="javascript:this.value=this.value.toLowerCase();" value="<?php echo $articulo_tags;?>"><br>
            
            <label for="articulo_fuente">Fuente del contenido</label>
            <textarea name="articulo_fuente" placeholder="Fuente del contenido..." id="articulo_fuente" class="form-control"><?php echo $articulo_fuente;?></textarea><br>
            
            <label for="articulo_estado">Estado del artículo</label>
            <select name="articulo_estado" id="articulo_estado" class="form-control">
                <option value='borrador'
                    
                    <?php
                        
                        if ($articulo_estado == 0) 
                        {
                            echo " selected ";
                        }
                    
                    ?>
                
                >Borrador</option>
                
                <option value='publicado'
                    
                    <?php
                        
                        if ($articulo_estado == 1 || !isset($articulo_estado)) 
                        {
                            
                            echo " selected ";
                        
                        }
                    
                    ?>
                
                >Publicado</option>
            
            </select><br><br>

            <input type="hidden" name="id_articulo" value="<?php echo $id_articulo;?>">
            <input type="hidden" name="articulo_estado_previo" value="<?php echo $articulo_estado; ?>">
            <input type="hidden" name="articulo_publicado_status" value="<?php echo $articulo_publicado_status; ?>">
                
            <label>Crear/Actualizar/Leer</label>

                <?php
                    
                    #   VERIFICAR SI NO EXISTE ID, ES PORQUE EL ARTICULO ES NUEVO.    
                    if (!isset($_REQUEST['id_articulo'])) 
                    {

                ?>

                        <input type="submit" name="crear" value="Crear artículo" class="btn btn-primary btn-block" >
                
                <?php
                
                    }
                
                ?>

                <?php
                    
                    #   VERIFICAR SI EXISTE ID ES PORQUE ES PARA ACTUALIZAR
                    if (isset($_REQUEST['id_articulo'])) 
                    {
                
                ?>

                        <input type="submit" name="actualizar" value="Actualizar articulo" class="btn btn-primary btn-block" >
                
                <?php
                    
                    }
                    
                    #   VERIFICAR SI EXISTE ID ES PORQUE ES PARA LEER
                    if (isset($_REQUEST['id_articulo'])) 
                    {
                
                ?>
                        <input type="submit" name="leer" value="Leer articulo" class="btn btn-success btn-block" ><br>
                <?php
                    
                    }
                
                ?>

                <?php
                    
                    #   VERIFICAR SI EXISTE ID ES PORQUE ES PARA ELIMINAR
                    if (isset($_REQUEST['id_articulo'])) 
                    {
                
                ?>
                
                        <label for="eliminar">¿Deseas eliminar este artículo?</label>
                        <input type="submit" name="eliminar" id="eliminar" value="Eliminar articulo" class="btn btn-danger btn-block" >
                
                <?php
                    
                    }
                
                ?>
            
            </fieldset>
            </form>

            <?php
                
                # Crear recurso desde un archivo .txt
                if (!isset($_REQUEST['id_articulo'])) 
                {
            
            ?>
            
            <br>
            
            <form action="./?action=editor" method="post" enctype="multipart/form-data">
                
                <fieldset>
                    
                    <legend>Crear borrador desde .txt</legend>
                    
                    <input type="file" name="archivo_de_texto" class="form-control" accept=".txt" required><br>
                    
                    <span class="help-block">Se creará un borrador automaticamente</span>
                    
                    <input type="submit" name="archivo_submit" value="Crear desde .txt" class="btn btn-primary form-control">
                
                </fieldset>
            </form>
            
            <?php
                
                } # Cierre del if de crear desde txt
            
            ?>
        </aside>
        
    </div>
</div>