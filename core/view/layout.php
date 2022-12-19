<?php
	/**
	*	@titulo 		Layout.
	*	@descripcion 	Crear y rellenar plantilla HTML.
	*					La base de todas las vistas.
	*/

	require_once(_ADD_CONTROLLER_ . "css-controller.php");
	require_once(_ADD_CONTROLLER_ . "js-controller.php");
	
	require_once(_ADD_VIEW_ . "_BARRA_DE_MENU/" . _VIEW_FILE);
	require_once(_ADD_VIEW_ . "_BARRA_DE_MENU/session/" . _VIEW_FILE);
	require_once(_ADD_VIEW_ . "_BARRA_DE_MENU/no_session/" . _VIEW_FILE);
	require_once(_ADD_VIEW_ . "_BARRA_DE_MENU/buscador/" . _VIEW_FILE);

	require_once(_ADD_CONTROLLER_ . "html-title-controller.php");
	require_once(_ADD_VIEW_ . "_PLANTILLAS/alertas_con_boton_de_cierre.php");

	require_once(_ADD_VIEW_ . "_FOOTER/" . _VIEW_FILE);

	$css_controller = new CSS();
	$js_controller = new JS();
	$menu_superior = new BarraDeMenu();
	$footer = new Footer();

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8'>
		<title><?php TitleHTML::generar_title_dinamico(":: WriterSpace ::"); ?></title>

			<?php
				#	Añadir CSS.
				$css_controller->add("bootstrap");
				$css_controller->add("estilos");
				$css_controller->add_tema_oscuro();
			
				#	Añadir Javascript.
				$js_controller->add("jquery");
				$js_controller->add("bootstrap");
			?>

		<script src="res/plugins/tinymce/js/tinymce/tinymce.min.js"></script>

		<script>tinymce.init({ 
	        selector:'#articulo_cuerpo',
	        plugins:"table, lists, link, wordcount, fullscreen, code, contextmenu, paste, hr, help, preview, toc, visualblocks"
	    });</script>

	    <script>tinymce.init({ 
	        selector:'#articulo_fuente',
	        plugins:"lists link",
	        menubar: false,
	        toolbar: "undo redo bullist numlist link"
	    });</script>

	    <meta name='viewport' content='width=device‐width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no'>

	</head>
	<body >
		<?php 

			$menu_superior->show();

			#	Añadir vista a la plantilla
			View::add_view($nombre_de_la_vista_a_llamar);

			$footer->show();

		?>

		
	</body>
</html>