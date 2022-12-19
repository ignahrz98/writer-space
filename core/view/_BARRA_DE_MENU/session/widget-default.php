<?php
	/**
	*	@titulo			Opciones del menú con session.
	*	@descripcion 	Mostrar opciones en el menu superior cuando existe session.
	*/

	class MenuSession
	{
		
		public static function show()
		{
?>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
                
                <ul class="nav navbar-nav">
                    <li><a href='./?view=perfil' class="enlace-menu">Perfil</a></li>
                </ul>
                
              	<?php Buscador::show(); ?>

          	</div>
<?php
		} 
	}
?>