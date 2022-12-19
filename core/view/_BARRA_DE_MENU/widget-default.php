<?php
	/**
	*	@titulo  		Barra de Menú
	*	@descripcion 	Crear la barra de menú superior
	*/

	class BarraDeMenu
	{
		
		/*
			Iniciar la creacion del menu superior.
		*/
		public function show()
		{
?>
			<nav class="navbar" role="navigation">
                <div class="container">

                    <div class="navbar-header">

                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Desplegar navegación</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    
                        <a class="navbar-brand" href="./"><?php echo NOMBRE_DEL_SISTEMA; ?></a>

                    </div> <!--Cierre <div> navbar-header-->

                        <?php
                      	
                            #   Crear opciones dependiendo si existe session.
                            if (isset($_SESSION['id_usuario_sesion_activa'])) 
                            {
                 
                            	MenuSession::show();

                          	}   #    Si no existe session.
                                else 
                            {
                            
                            	MenuNoSession::show();

                          	}
                           
                        ?>
                </div> <!--Cierre <div> container-->
            </nav> <!--Cierre <nav> navbar-->
<?php
		}
	}
?>