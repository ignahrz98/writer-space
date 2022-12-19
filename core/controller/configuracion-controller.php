<?php
	/**
	*	@titulo 		Controlador de la vista de configuración
	*	@descripcion 	Se encarga de gestionar la vista de configuración.
	*					Así como sus subvistas.
	*/

	require_once(_ADD_MODEL_ . "usuariosBD.php");

	$tabla_usuarios = new UsuariosBD();

	$id_usuario_sesion_activa = $_SESSION['id_usuario_sesion_activa'];

	$datos_de_usuario_activo = $tabla_usuarios->get_usuario_por_id($id_usuario_sesion_activa);

	foreach ($datos_de_usuario_activo as $key) 
	{

		$username = $key['username'];
	  	$nombres = $key['nombres'];
	  	$apellidos = $key['apellidos']; 
	  	$presentacion = $key['usuario_presentacion'];
	  	$tema_oscuro_active = $key['tema_oscuro_active'];

	}
?>