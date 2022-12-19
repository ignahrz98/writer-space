<?php
    /*
        VISTA DEL BUSCADOR.

        Mostrar los resultados de la búsqueda realizada por el usuario, mediante input de búsqueda
        y mediante los links de búsqueda por etiquetas.
    */

    require_once("core/controller/buscador-controller.php");
?>

<div class="container contenedor-section-aside">
    <div class="row">
        <section class="col-sm-8">
        
            <?php
            
                $impresos=0; //Contar resultados.

                foreach ($articulos_encontrados_en_busqueda as $key) 
                {
                    if ( $impresos == 0 ) 
                    {
            
            ?>
            
                        <div class="alert alert-info">
                            <?php echo $mensaje_con_alerta;?>
                        </div>
            
            <?php
            
                } # Cierre del if para mostrar info una vez
            
            ?>
            

                <div class="row">
                    <div class="superpanel col-xs-10 col-xs-offset-1">

                        <p><?php echo crear_tags_con_link($key['articulo_tags']); ?></p>

                        <h3>
                            <a href="<?php echo "./?view=leer&id=" . $key['id_articulo']; ?>" class="superpanel-titulo">
                                <?php echo $key['articulo_titulo'];?>
                            </a>
                        </h3>

                        <p><?php echo $key['fecha_de_publicacion'];?></p>

                        <p><?php echo $key['articulo_introduccion']; ?></p>

                    </div>
                </div>

            <?php
            
                $impresos++;

        	    }  #   Cierre de llave del foreach

                if($impresos == 0 && $inicio == 0) 
                {
            
            ?>

                    <div class="alert alert-danger">
                        No se han encontrado coincidiencia para: <?php echo $buscador;?>
                    </div>

                    <div class="alert alert-warning">
                        Verifique su ortografía. Revise cada espacio y tilde en su búsqueda.
                    </div>

            <?php
            
                }   #   Llave de cierre del if contador de resultados.

                
                #   Paginación de las publicaciones
                #   Cuando se llega al final de la paginación
                if( $impresos == 0 && $inicio > 0 ) 
                {

                    $anterior = $inicio-10;
            
            ?>
                    <div class="jumbotron">
                        <h1>Has llegado al final</h1>
                        <a href="./?view=buscador&pos=<?php echo $anterior; ?>&buscador=<?php echo $buscador . $cadena_tipo_de_busqueda; ?>">
                            Vuelve atrás
                        </a>
                    </div>
            
            <?php
                    
                } # Cierre del if

                echo "<ul class='pager'>";
            
                if($inicio > 0 && $impresos!=0) 
                {
                
                    $anterior = $inicio-10;

            ?>

                    <li class='previous'>
                        <a href="./?view=buscador&pos=<?php echo $anterior; ?>&buscador=<?php echo $buscador . $cadena_tipo_de_busqueda ?>" >
                            &larr; Atras
                        </a>
                    </li>

            <?php
            
                }
                
                if( $impresos == 10 ) 
                {
            
                    $proximo = $inicio+10;

            ?>  
                    <li class='next'>
                        <a href="./?view=buscador&pos=<?php echo $proximo; ?>&buscador=<?php echo $buscador . $cadena_tipo_de_busqueda; ?>">
                            Próximo &rarr;
                        </a>
                    </li>
            <?php
            
                }

                echo "</ul>";
            ?>
        </section>

        <aside class='col-sm-4'>

            <?php #require_once("core/view/_LLUVIA_DE_ETIQUETAS/widget-default.php");?>

        </aside>
    </div>
</div>