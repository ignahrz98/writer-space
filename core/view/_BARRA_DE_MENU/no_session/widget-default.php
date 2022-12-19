<?php
	/**
	*	@titulo			Opciones del menú sin session.
	*	@descripcion 	Mostrar opciones en el menu superior cuando no existe session.
	*/

	class MenuNoSession
	{
		
		public static function show()
		{
?>
			<div class="collapse navbar-collapse navbar-ex1-collapse">

                <ul class="nav navbar-nav">
                    <li><a href="./?view=acceder" class="enlace-menu">Acceder</a></li>
                </ul>
                    
            </div>
<?php
		} 
	}
?>