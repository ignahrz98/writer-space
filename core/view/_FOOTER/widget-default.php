<?php
	/**
	*	@titulo 		Vista del footer.
	*	@descripcion 	Mostrar el footer.
	**/

  	class Footer
  	{
  		/*
  		*	Mostrar <footer>
  		*/
  		public function show()
  		{
?>
			<footer class='col-sm-12'>
				<div class="container">
					<a href="./" class="link-footer"><?php echo NOMBRE_DEL_SISTEMA; ?></a> &copy; <?php echo ANIO; ?>
				</div>
			</footer>
<?php
  		}
  	}
?>