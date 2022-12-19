<?php
/*
	BARRA DE MENU SUPERIOR.
*/

class Barra_de_menu 
{
	
	/*
        Iniciar creación del menu superior
    */
	public static function crear_menu() 
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
                
                    <a class="navbar-brand" href="./">WriterSpace</a>

                </div>

                <?php
              	
                    if (isset($_SESSION['id_usuario_sesion_activa'])) 
                    {

                    	self::opciones_con_sesion();

                  	} else 
                    {

                    	self::opciones_sin_sesion();

                  	}
                   
                ?>
            </div>
        </nav>

<?php
  } #  Cierre de crear_menu()

	/*
        Cuando no existe la sesion.
    */
	public static function opciones_sin_sesion() 
    {
?>

    	<div class="collapse navbar-collapse navbar-ex1-collapse">

            <ul class="nav navbar-nav">
                <li><a href="./?view=acceder" class="enlace-menu">Acceder</a></li>
            </ul>
                
            <?php #self::buscador(); ?>
        </div>

<?php
	} #  Cierre de opciones_sin_sesion()

	/*
        Cuando si existe la sesion
    */
	public static function opciones_con_sesion() 
    {
?>

    	<div class="collapse navbar-collapse navbar-ex1-collapse">
            
            <ul class="nav navbar-nav">
                <li><a href='./?view=perfil' class="enlace-menu">Perfil</a></li>
            </ul>
            
          	<?php self::buscador(); ?>

      	</div>

<?php
	} # Cierre de opciones_con_sesion()

	/*
        Buscador ubicado en el menu superior.
    */
	public static function buscador() 
    {
?>
    	<form action='./?view=buscador' class="navbar-form navbar-right" role="search" method="post">

            <div class="input-group">

                <input type="text" name='buscador' class="form-control input-buscador" placeholder="Buscar..." required>

                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default btn-buscador"><span class='glyphicon glyphicon-search'></button>
                </span>

            </div>

        </form>
<?php		
	} #    Cierre de buscador()
}
?>