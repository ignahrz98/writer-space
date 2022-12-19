<?php
	/*
		@titulo         Buscador del menú superior.
		@descripcion 	Mostrar buscador, en el menu superior.
	*/

	class Buscador
	{
		public static function show()
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
		}
	}
?>