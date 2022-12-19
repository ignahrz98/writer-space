<?php
    /**
    *   @titulo         Vista del index cuando existe session
    *   @descripcion    Cuando la session esta activa, se muestra esta vista
    */
?>

<div class="container contenedor-section-aside">
    <div class="row">
            
        <section class='col-sm-8'>

            <h1 class="supertitulo">Novedades</h1>
                    
            <?php
                #   Iniciar contador de articulos mostrados en 0
                $impresos = 0;

                #   Recorrer array con articulos publicados para mostrarlos.
                foreach ($articulos_publicados as $key) 
                {
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
                    #   Incrementar contador de articulos mostrados.
                    $impresos++;

                }   #   Llave de cierre del foreach que muestra los recursos públicos

                #   Paginación de las publicaciones
                if($impresos == 0 && $inicio > 0) 
                {

                    $anterior = $inicio-10;

            ?>

                    <div class="jumbotron">
                        <h1>Has llegado al final</h1>
                        <a href="./?&pos=<?php echo $anterior; ?>">Vuelve atrás</a>
                    </div>

            <?php
                
                }

                #   Botones de paginación.
                echo "<ul class='pager'>";
                        
                if($inicio > 0 && $impresos!=0) 
                {

                    $anterior = $inicio-10;
                    echo "<li class='previous'><a href='./?pos=" . $anterior . "'>&larr; Atras</a></li>";

                }

                if($impresos==10) 
                {

                    $proximo = $inicio+10;
                    echo "<li class='next'><a href='./?pos=" . $proximo . "'>Próximo &rarr;</a></li>";

                }

                echo "</ul>"

            ?>
        
        </section>

        <aside class='col-sm-4'>

            <?php #require_once("core/view/_LLUVIA_DE_ETIQUETAS/widget-default.php");?>

        </aside>
    </div>

</div>