<?php
	/*
		CONTROLADOR DEL EDITOR DE ARTÍCULOS
	*/

	require_once("core/model/articulosBD.php");
	$tabla_articulos = new ArticulosBD();

	$id_usuario_sesion_activa = $_SESSION['id_usuario_sesion_activa'];

	#	Crear variables, para evitar NOTICE.
	$id_articulo = "";
	$articulo_titulo = "";
	$articulo_introduccion = "";
	$articulo_cuerpo = "";
	$articulo_estado = "";
	$articulo_tags = "";
	$articulo_fuente = "";
	$fecha_de_publicacion = "";
	$articulo_publicado_status = "";

	#	En caso de que exista id para editar
	if (isset($_REQUEST['id_articulo'])) 
	{

		$id_del_articulo_a_editar = $_REQUEST['id_articulo'];

		#	Lógicamente el usuario solo podrá sus propios artículos.
		#	Por si acaso, alguien se le ocurre editar id a mano para sabotear a otros.
		$valores_para_editar_articulo_del_usuario_activo = $tabla_articulos->get_articulo_por_id_y_usuario_activo($id_usuario_sesion_activa,$id_del_articulo_a_editar);

		#	Pasar datos a variables 
	    foreach ($valores_para_editar_articulo_del_usuario_activo as $key) 
	    {

		    #	Asignar valores a variables.
		    $id_articulo = $key['id_articulo'];
		    $articulo_titulo = $key['articulo_titulo'];
		    $articulo_introduccion = $key['articulo_introduccion'];
		    $articulo_cuerpo = $key['articulo_cuerpo'];
		    $articulo_estado = $key['articulo_estado'];
		    $articulo_tags = $key['articulo_tags'];
		    $articulo_fuente = $key['articulo_fuente'];
		    $fecha_de_publicacion = $key['fecha_de_publicacion'];
		    $articulo_publicado_status = $key['articulo_publicado_status'];

		}
	}
?>