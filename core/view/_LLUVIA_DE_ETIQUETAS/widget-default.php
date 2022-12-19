<?php
	/*
		VISTA DEL PANEL DE LLUVIA DE ETIQUETAS

		Para reutilizar en diferentes vistas
	*/

	require_once("core/controller/lluvia-de-etiquetas-controller.php");
?>


<div class="panel panel-default">
            
    <div class="panel-heading">
        <h3 class="panel-title">Etiquetas utilizadas en WriterSpace</h3>
    </div>

    <div class="panel-body">
        <?php echo $cadena_lluvia_etiquetas_a_mostrar; ?>
    </div>

</div>