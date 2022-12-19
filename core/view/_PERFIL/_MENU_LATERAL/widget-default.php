<?php
	/**
	*	@titulo 	Menú lateral del perfil y vistas relacionadas
	**/
?>

<!--Información del perfil-->
<h1><?php echo "@".$perfil_username; ?></h1>
<h2><?php echo $perfil_nombres." ".$perfil_apellidos; ?></h2>

<ul class="list-group">
    <li class="list-group-item"><?php echo $perfil_descripcion;?></li>
    <li class="list-group-item"><a href="./?view=editor">Crear artículo</a></li>
    <li class="list-group-item"><a href="./?view=perfil&perfil=mis_articulos">Mis artículos</a></li>
    <li class="list-group-item"><a href="./?view=perfil&perfil=articulos_guardados">Artículos guardados</a></li>
    <li class="list-group-item"><a href="./?view=configuracion">Configuración</a></li>
    <li class="list-group-item"><a href="./?action=logout">Cerrar sesión</a></li>
</ul>