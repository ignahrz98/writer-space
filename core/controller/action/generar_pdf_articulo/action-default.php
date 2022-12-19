<?php
	/**
	*	@titulo 		Action para generar pdf de articulos.
	*	@descripcion 	Generar el .pdf del artículo solicitado.
	*/

	require_once(_ADD_MODEL_ . "articulosBD.php");

	#	Recuperar id del recurso a visualizar.
    $id_articulo_a_leer = $_REQUEST['id'];

    $tabla_articulos = new ArticulosBD();
    $articulo_a_leer = $tabla_articulos->get_articulo_por_id($id_articulo_a_leer);

    #	Preparar variables para mostrar artículo
    foreach ($articulo_a_leer as $key) 
    {
    	$id_articulo = $key['id_articulo'];
        $articulo_titulo = $key['articulo_titulo'];
        $articulo_introduccion = $key['articulo_introduccion'];
        $articulo_cuerpo = $key['articulo_cuerpo'];
        $articulo_estado = $key['articulo_estado'];
        $articulo_tags = $key['articulo_tags'];
        $articulo_fuente = $key['articulo_fuente'];
        $fecha_de_creacion = $key['fecha_de_creacion'];
        $fecha_de_publicacion = $key['fecha_de_publicacion'];
        $fecha_ultima_actualizacion = $key['fecha_ultima_actualizacion'];
        $id_usuario_autor = $key['id_usuario'];

        $username = $key['username'];
        $nombres_usuario_autor = $key['nombres'];
        $apellidos_usuario_autor = $key['apellidos'];
        $usuario_descripcion_autor = $key['usuario_presentacion'];
    }

    #	Cargar en buffer.
	ob_start();
?>

	<p><?php echo $articulo_introduccion; ?></p>
	<h1><?php echo $articulo_titulo; ?></h1>
	<hr>

	<?php echo $articulo_cuerpo; ?>

<?php
	require_once 'res/plugins/dompdf/autoload.inc.php';
	use Dompdf\Dompdf;
	$dompdf = new DOMPDF();
	$dompdf->load_html(ob_get_clean());
	$dompdf->render();
	$pdf = $dompdf->output();
	$filename = $articulo_titulo . ".pdf";
	file_put_contents($filename, $pdf);
	$dompdf->stream($filename);
?>

