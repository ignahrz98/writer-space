<?php
	/*
		TABLA USUARIOS_GUARDAR_ARTICULOS
	*/

	class Usuarios_Guardar_ArticulosBD
	{
		const NOMBRE_DE_TABLA = "usuarios_guardar_articulos";

		var $id_usuario_guardar_articulo;
		var $id_usuario;
		var $id_articulo;

		var $resultados_de_la_consulta;

		/*
			Usuario guarda un artículo.

			$id_usuario 		ID del usuario a guardar artículo.
			$id_articulo		ID del artículo a guardar.
		*/
		public function set_nuevo_articulo_guardado($id_usuario,$id_articulo)
		{

			$db = new DBController();

			$sql = "INSERT INTO " . self::NOMBRE_DE_TABLA . " (
					id_usuario,
					id_articulo)

					VALUES (
					" . $id_usuario . ",
					" . $id_articulo . "
					);";

			$db->ejecutar($sql);
		}

		/*
			Verificar si el artículo ha sido guardado por el usuario.

			$id_usuario			ID del usuario a consultar.
			$id articulo 		ID del articulo a consultar.

			@return 			Estado del artículo guardado
		*/	
		public function get_usuario_guardar_articulo_status($id_usuario,$id_articulo)
		{
			$db = new DBController();

			$sql = "SELECT COUNT(*) FROM " . self::NOMBRE_DE_TABLA . "
					WHERE id_usuario = " . $id_usuario . " AND id_articulo = " . $id_articulo . ";";

			$this->resultados_de_la_consulta = $db->ejecutar_consulta($sql);

			#	Retornar valor boleano.
			foreach ($this->resultados_de_la_consulta as $key) 
			{
				if ($key['COUNT(*)'] == 0) 
				{

					return false;

				} 
					else 
				{

					return true;

				}
			}
		}

		/*
			Cuando el usuario ya no quiere tener guardado un artículo.

			$id_usuario			ID del usuario a borrar guardado.
			$id articulo 		ID del articulo a borrar de guardados.
		*/
		public function eliminar_usuario_guardar_articulos($id_usuario,$id_articulo)
		{
			$db = new DBController();

			$sql = "DELETE FROM " . self::NOMBRE_DE_TABLA . " 
					WHERE id_usuario = " . $id_usuario . " AND id_articulo = " . $id_articulo . ";";

			$db->ejecutar($sql);
		}

		/*
			Borrar el artículo de todas las listas de guardados.

			$id_articulo 		ID a borrar de articulos guardados de todos.
		*/
		public function eliminar_articulos_guardados_a_todos($id_articulo)
		{
			$db = new DBController();

			$sql = "DELETE FROM " . self::NOMBRE_DE_TABLA . "
					WHERE id_articulo = " . $id_articulo . "";

			$db->ejecutar($sql);
		}

		/*
			Obtener los artículos guardados por el usuario.

			$id_usuario 	ID del usuario a consultar artículos guardados.
			$inicio 		Buscar desde aquí.
		*/
		public function get_articulos_guardados_por_el_usuario($id_usuario,$inicio)
		{
			$db = new DBController();
			
			$sql = "SELECT * FROM usuarios_guardar_articulos as g 
					JOIN articulos as a 
					ON g.id_articulo = a.id_articulo 
					WHERE g.id_usuario = " . $id_usuario . "
					ORDER BY g.	id_usuario_guardar_articulo DESC
					LIMIT $inicio,20;";

			$this->resultados_de_la_consulta = $db->ejecutar_consulta($sql);

			return $this->resultados_de_la_consulta;
		}
	}
?>