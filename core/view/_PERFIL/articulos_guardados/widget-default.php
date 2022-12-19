<?php
	/*
		VISTA PARA MOSTRAR ARTÍCULOS GUARDADOS POR EL USUARIO.
	*/
?>

<div class="page-header">
    <h1>Artículos guardados</h1>
</div>

<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
            <tr>
                <th>Titulo</th>         
                <th>Estado</th>
            </tr>
        </thead>

        <tbody>
        	<?php
        		#   Iniciar contador para contabilizar artículos mostrados.
                $impresos=0;

                foreach ($articulos_guardados as $key) 
                {
                	# code...
                	$id_articulo = $key['id_articulo'];
                    $articulo_titulo = $key['articulo_titulo'];
                    $articulo_estado = $key['articulo_estado'];
                    $id_usuario_autor = $key['id_usuario'];

            ?>
            		<tr>
		        		<td><a href='./?view=leer&id=<?php echo $id_articulo;?>'><?php echo $articulo_titulo;?></a></td>
		        		<td>
	        				<?php

                                #   Si el estado del articulo es 0 es un borrador.
                                if ($articulo_estado == 0) 
                                {
                                    #   Mostrar etiqueta borrador o mantenimiento.
                                    if ($id_usuario_autor == $id_usuario_sesion_activa) 
                                    {
                                        # code...
                            ?>
                                        <span class="label label-default">Borrador</span>
                            <?php
                                    } 
                                        else
                                    {
                            ?>
                                        <span class="label label-warning">Mantenimiento</span>
                            <?php
                                    }
                            ?>
                                    
                                    
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
            <?php
        	 	#   Incrementar contador con cada artículo mostrado
                $impresos++;
  
                }

       

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
            <h1>No hay artículos guardados</h1>
            <p>Guarda uno para empezar, incluso los tuyos puedes guardarlos aquí.</p>
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
		    <a href="./?view=perfil&perfil=articulos_guardados&pos=<?php echo $anterior.$articulos_a_filtrar?>">Vuelve atrás</a>
		</div>

<?php
        
    }

    #   Luego de los mensajes anteriores mostrar la flechitas de atras
    #   y siguiente.

    echo "<ul class='pager'>";
    
    if($inicio > 0 && $impresos != 0) 
    {

        $anterior = $inicio - 20;
        echo "<li class='previous'><a href='./?view=perfil&perfil=articulos_guardados&pos=" . $anterior . $articulos_a_filtrar . "'>&larr; Atras</a></li>";
    
    }
   
    if($impresos==20) 
    {

        $proximo = $inicio + 20;
        echo "<li class='next'><a href='./?view=perfil&perfil=articulos_guardados&pos=" . $proximo . $articulos_a_filtrar . "'>Próximo &rarr;</a></li>";
    
    }

    echo "</ul>"
?>
