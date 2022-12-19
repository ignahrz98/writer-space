<?php
	/*
		VISTA PARA ARTICULOS ESCRITOS POR EL USUARIO.
	*/
?>

<article>

    <div class="page-header">
        <h1>Mis artículos</h1>
    </div>
        
    <!--Herramienta de búsqueda en el perfil-->
    <form action="./?view=perfil&perfil=mis_articulos" method="post">
        <fieldset>
                
            <div class="row">
                <div class="col-xs-8">
                    <select name="articulos_a_filtrar" id="articulos_a_filtrar" class="form-control">
                            
                        <option value="todos_los_articulos"
                            <?php
                                if($_REQUEST['articulos_a_filtrar'] == 'todos_los_articulos') 
                                {

                                    echo ' selected ';

                                }
                            ?>
                        >Todos los artículos</option>

                        <option value="articulos_borradores"
	                        <?php
	                            if($_REQUEST['articulos_a_filtrar'] == 'articulos_borradores') 
	                            {

	                                echo ' selected ';

	                            }
	                        ?>  
                        >Borradores</option>
                        
                        <option value="articulos_publicados"
                            <?php
                                if($_REQUEST['articulos_a_filtrar'] == 'articulos_publicados') 
                                {

                                    echo ' selected ';

                                }
                            ?>
                        >Publicados</option>
                    </select>
                </div>

                <div class="col-xs-4">
                    <input type="submit" value="Filtrar" class='btn btn-primary'>
                </div>

            </div>
        </fieldset>
    </form><br>

    <div class="table-responsive">
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Titulo</th>         
                    <th>Estado</th>
                    <th>Editar</th>
                </tr>
            </thead>

            <tbody>
            <?php
                #   Iniciar contador para contabilizar artículos mostrados.
                $impresos=0;

                foreach ($articulos_del_usuario as $key) 
                {
            	
                    $id_articulo = $key['id_articulo'];
                    $articulo_titulo = $key['articulo_titulo'];
                    $articulo_estado = $key['articulo_estado'];
            ?>

                    <tr>
                        <td><a href='./?view=leer&id=<?php echo $id_articulo;?>'><?php echo $articulo_titulo;?></a></td>
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

                        <!--Boton para editar artículo-->
                        <td>
                            <form action='./?view=editor' method='post'>
                                <input type='hidden' name='id_articulo' value='<?php echo $id_articulo;?>'>
                                <input type='submit' value='Editar' class='btn btn-primary btn-xs'>
                            </form>
                        </td>
                    </tr>

            <?php
            
                    #   Incrementar contador con cada artículo mostrado
                    $impresos++;
                    
        	    } #	Cierre del Foreach
            ?>
            </tbody>
        </table>
    </div>

<?php

    #   Paginación de la tabla de articulos.

    #   En caso de no haber impresos y no exitir pos.
    #   El usuario no ha creado su primer articulo aún.
    if ($impresos == 0 && !isset($_GET['pos'])) 
    {
        
?>
        <div class="jumbotron">
            <h1>No hay artículos</h1>
            <p>Crea uno para empezar</p>
        </div>

<?php 

    }   #   En caso de no haber impresos pero si pos > 0
        #   Final de la paginación.
        else if($impresos == 0 && $inicio > 0) 
    {
        $anterior = $inicio-20;

?>

		<div class="jumbotron">
		    <h1>Has llegado al final</h1>
		    <a href="./?view=perfil&perfil=mis_articulos&pos=<?php echo $anterior.$articulos_a_filtrar?>">Vuelve atrás</a>
		</div>

<?php
        
    }

    #   Luego de los mensajes anteriores mostrar la flechitas de atras
    #   y siguiente.

    echo "<ul class='pager'>";
    
    if($inicio > 0 && $impresos != 0) 
    {

        $anterior = $inicio - 20;
        echo "<li class='previous'><a href='./?view=perfil&perfil=mis_articulos&pos=" . $anterior . $articulos_a_filtrar . "'>&larr; Atras</a></li>";
    
    }
    
    if($impresos==20) 
    {

        $proximo = $inicio + 20;
        echo "<li class='next'><a href='./?view=perfil&perfil=mis_articulos&pos=" . $proximo . $articulos_a_filtrar . "'>Próximo &rarr;</a></li>";
    
    }

    echo "</ul>"
?>
</article>