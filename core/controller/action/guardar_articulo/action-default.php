<?php
	/*
		ACTION DE GUARDAR ARTICULO.S
	*/

	require_once("core/model/usuarios_guardar_articulosBD.php");

	$id_usuario_sesion_activa = $_SESSION['id_usuario_sesion_activa'];
	$id_articulo_a_guardar = $_REQUEST['id'];

	#	Cadena con enlace para redirigir luego de realizar action.
	$cadena_direccion = "Location: ./?view=leer&id=" . $id_articulo_a_guardar;

	$tabla_usuarios_guardar_articulos = new Usuarios_Guardar_ArticulosBD();

	# 	Proceder a guardar/no guardar.
	if ($tabla_usuarios_guardar_articulos->get_usuario_guardar_articulo_status($id_usuario_sesion_activa,$id_articulo_a_guardar)) 
	{

		$tabla_usuarios_guardar_articulos->eliminar_usuario_guardar_articulos($id_usuario_sesion_activa,$id_articulo_a_guardar);

		$cadena_direccion .= "&articulo_eliminado_de_guardado_exitosamente";

	}   # Si el status de guardado es false, proceder a guardar.
		else
	{

		$tabla_usuarios_guardar_articulos->set_nuevo_articulo_guardado($id_usuario_sesion_activa,$id_articulo_a_guardar);
		
		$cadena_direccion .= "&articulo_guardado_exitosamente";

	}

	header($cadena_direccion);
?>