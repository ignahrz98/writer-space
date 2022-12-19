<?php
	/*
		TABLA RECURSOS
	*/

	class ArticulosBD 
	{
		const NOMBRE_DE_TABLA = "articulos";

		var $resultados_de_la_consulta;

		/*
			Obtener un articulo por su id para su lectura.

			$id_articulo 		Identificador del articulo a obtener.

			@return 			Recurso para lectura.
		*/
		public function get_articulo_por_id($id_articulo) 
		{

			$db = new DBController();

			$sql = "SELECT * FROM articulos AS a 
					JOIN usuarios AS u 
					ON a.id_usuario = u.id_usuario 
					WHERE a.id_articulo = " . $id_articulo . ";";

			$resultados = $db->ejecutar_consulta($sql);

			return $resultados;

		}

		/*
			Obtener un array articulos.

			$id_usuario 			ID del usuario a mostrar articulos.
			$inicio 				ID del articulo desde donde empezar a contar.
			$articulo_estado 	 	Estado de los articulos a obtener.

			@return 		Array con articulos.
		*/
		public function get_articulos_por_id_usuario($id_usuario,$inicio,$articulo_estado) 
		{

			$db = new DBController();

			#	Iniciar la cadena con la sentencia.
			$sql = "SELECT * FROM articulos
	                WHERE id_usuario=".$id_usuario."";

	        #	Añadir filtrado por privacidad.
	        #	Mostrar todos los artículos, por defecto.
	        if ($articulo_estado != "todos") 
	        {

	        	#	Mostrar artículos borradores.
	        	if ($articulo_estado == "borrador") 
	        	{

	        		$sql .= " AND articulo_estado=0";

	        	
	        	} 	#	Mostrar artículos publicados.
	        		else if ($articulo_estado == "publicado") 
	        	{

	        		$sql .= " AND articulo_estado=1";

	        	}
	        }

	        #	Ultimos ajustes a la sentencia.
	        $sql.=" ORDER BY id_articulo DESC
	               	LIMIT $inicio,20";

	        $resultados = $db->ejecutar_consulta($sql);

			return $resultados;

		}

		/*
			Obtener los tags de los articulos

			@return 	Etiquetas de los artículos
		*/
		public function get_articulos_tags()
		{

			$db = new DBController();

			$sql = "SELECT articulo_tags FROM articulos
					WHERE articulo_estado = 1 && articulo_tags != ''";

			$resultados = $db->ejecutar_consulta($sql);

			return $resultados;

		}

		/*
			Obtener titulo del artículo solicitado.

			$id_articulo 	ID del artículo a buscar titulo.

			@return 		Titulo del artículo solicitado.
		*/
		public function get_articulo_titulo($id_articulo)
		{

			$db = new DBController();

			$sql = "SELECT articulo_titulo 
					FROM articulos 
					WHERE id_articulo = " . $id_articulo . "";

			$resultados = $db->ejecutar_consulta($sql);

			return $resultados;
			
		}

		/*
			Crear un articulo nuevo.

			$id_usuario				ID del usuario autor.
			$articulo_titulo 		Título del nuevo articulo.
			$articulo_introduccion	Breve introducción del artículo
			$articulo_cuerpo 		Cuerpo del artículo.
			$articulo_fuente 		Fuentes del artículo.
			$articulo_estado 		Estado del artículo.
			$articulo_tags 			Etiquetas del artículo.
			$fecha_actual 			Fecha de creación/publicación del artículo.
		*/
		public function set_articulo_nuevo(	$id_usuario,
											$articulo_titulo,
											$articulo_introduccion,
											$articulo_cuerpo,
											$articulo_fuente,
											$articulo_estado,
											$articulo_tags,
											$fecha_actual) 
		{

			$db = new DBController();
			
			#	Primero armar la sentencia SQL
			$sql = "INSERT INTO articulos(
								
					id_usuario
					,articulo_titulo
					,articulo_introduccion
					,articulo_cuerpo
					,articulo_fuente
					,articulo_tags
					,fecha_de_creacion";

			#	Si será publicado en la creación.
			if ($articulo_estado == "publicado") 
			{

				$sql .= ",fecha_de_publicacion
						,articulo_estado
						,articulo_publicado_status";
			
			}	#	Si será un borrador al momento de crear.
				else if ($articulo_estado == "borrador") 
			{
					
					$sql .= ",articulo_estado
							,articulo_publicado_status";

			}

			$sql .= ") VALUES(

					" . $id_usuario . "
					,'" . $articulo_titulo . "'
					,'" . $articulo_introduccion . "'
					,'" . $articulo_cuerpo . "'
					,'" . $articulo_fuente . "'
					,'" . $articulo_tags . "'
					,'" . $fecha_actual . "'";

			#	Si será publicado en la creación.
			if ($articulo_estado=="publicado") 
			{

				$sql .= ",'" . $fecha_actual . "'
						,1
						,1";
			
			} 	#	Si será un borrador al momento de crear.
				else if ($articulo_estado == "borrador") 
			{
					
					$sql .= ",0
							,0";
					
			}

			$sql .= ");";

			$db->ejecutar($sql);

		}

		/*
			Eliminar articulo.

			$id_articulo 	ID del artículo a eliminar.
		*/
		public function eliminar_articulo($id_articulo)
		{

			$db = new DBController();
		
			$sql = "DELETE FROM articulos 
					WHERE id_articulo=" . $id_articulo . ";";

			$db->ejecutar($sql);

		}

		/*
			Actualizar articulo.

			$id_articulo 				ID del artículo a actualizar
			$articulo_titulo 			Titulo a actualizar
			$articulo_introduccion 		Breve introducción a actualizar
			$articulo_cuerpo 			Cuerpo a actualizar
			$articulo_fuente 			Fuentes a actualizar
			$articulo_estado 			Estado a actualizar
			$articulo_tags 				Etiquetas a actualizar
			$fecha_actual				Fecha de la operación de actualización
			$articulo_publicado_status 	Status de publicación del artículo
		*/
		public function actualizar_articulo($id_articulo,
											$articulo_titulo,
											$articulo_introduccion,
											$articulo_cuerpo,
											$articulo_fuente,
											$articulo_estado,
											$articulo_tags,
											$fecha_actual,
											$articulo_publicado_status)
		{
			
			$db = new DBController();

			#	Sobreescribir valor de articulo_estado por su numeral correspondiente.
			if ($articulo_estado == "borrador") 
			{

				$articulo_estado = 0;

			} 
				else if ($articulo_estado == "publicado") 
			{

				$articulo_estado = 1;

			}

			#	Ejecutar UPDATE
			$sql = "UPDATE articulos 
        	        SET 
        	        id_articulo='" . $id_articulo . "',
        	        articulo_titulo='" . $articulo_titulo . "',
        	        articulo_introduccion='" . $articulo_introduccion . "',
        	        articulo_cuerpo='" . $articulo_cuerpo . "',
        	        articulo_fuente='" . $articulo_fuente . "',
        	        articulo_estado='" . $articulo_estado . "',
        	        articulo_tags='" . $articulo_tags . "',
        	        fecha_ultima_actualizacion='" . $fecha_actual . "'
        	        WHERE id_articulo=" . $id_articulo . ";";

        	$db->ejecutar($sql);

        	# Ejecutar UPDATE para publicación de un articulo.
        	if($articulo_estado == 1 && $articulo_publicado_status == 0)
        	{

        		$sql = "UPDATE articulos
                        SET fecha_de_publicacion='" . $fecha_actual . "',
                        articulo_publicado_status=1
                        WHERE id_articulo=" . $id_articulo . ";";

                $db->ejecutar($sql);

    		}
		}

		/*
			Obtener articulos por etiqueta

			$etiqueta 	Obtener articulos según esta etiqueta
			$inicio 	Buscar desde este valor

			@return 	Articulos encontrados según la etiqueta solicitada
		*/
		public function get_articulos_por_etiqueta($etiqueta,$inicio)
		{

			$db = new DBController();

			$sql = "SELECT * FROM articulos 
			    	WHERE articulo_estado=1 AND articulo_tags LIKE '%" . $etiqueta . "%'
			    	ORDER BY fecha_de_publicacion DESC
			    	LIMIT " . $inicio . ",10";

			$resultados = $db->ejecutar_consulta($sql);

			return $resultados;

		}

		/*
			Obtener articulos por titulo

			$titulo 	Obtener articulos según este titulo
			$inicio 	Buscar desde este valor

			@return 	Articulos encontrados según el titulo solicitado
		*/
		public function get_articulos_por_titulo($titulo,$inicio)
		{

			$db = new DBController();

			$sql = "SELECT * FROM articulos 
			    	WHERE articulo_estado=1 AND articulo_titulo LIKE '%" . $titulo . "%'
			    	ORDER BY fecha_de_publicacion DESC
			    	LIMIT " . $inicio . ",10";

			$resultados = $db->ejecutar_consulta($sql);

			return $resultados;

		}

		/*
			Obtener articulo que pertenece al usuario activo, medida de seguridad.

			$id_usuario_activo 		ID del usuario activo
			$id_articulo 			ID del articulo a buscar, deberá pertener al usuario activo

			@return 			Articulo encontrado
		*/
		public function get_articulo_por_id_y_usuario_activo($id_usuario_activo,$id_articulo)
		{

			$db = new DBController();

			$sql = "SELECT * FROM articulos 
					WHERE id_usuario=" . $id_usuario_activo . " AND id_articulo=" . $id_articulo . ";";

			$resultados = $db->ejecutar_consulta($sql);

			return $resultados;

		}

		/*
			Obtener un array de articulos publicados.

			$inicio 	Buscar desde este valor.

			@return 	Array de articulos publicados.
		*/
		public function get_articulos_publicados($inicio) 
		{

			$db = new DBController();

			$sql = "SELECT * FROM articulos 
                    WHERE articulo_estado=1 
                    ORDER BY fecha_de_publicacion DESC
                    LIMIT " . $inicio . ",10;";

            $resultados = $db->ejecutar_consulta($sql);

			return $resultados;

		}

		/*
			Obtener el ID del último artículo creado por el usuario.
			Para ejecutarlo inmediatamente después del INSERT.

			$id_usuario 	ID del usuario a obtener ID del último artículo.
		*/
		public function get_id_ultimo_articulo_por_usuario($id_usuario)
		{

			$db = new DBController();

			$sql = "SELECT id_articulo 
					FROM articulos 
					WHERE id_usuario=" . $id_usuario . "
					ORDER BY id_articulo DESC 
					LIMIT 1";

			$resultados = $db->ejecutar_consulta($sql);

			return $resultados;
		}

		/*
			Verificar que el artículo solicitado existe.

			$id_articulo 		ID del artículo a verificar si existe

			@return 			Status
		*/
		public function get_articulos_existe_status($id_articulo)
		{
			$db = new DBController();

			$sql = "SELECT COUNT(*) FROM " . self::NOMBRE_DE_TABLA . "
					WHERE id_articulo = " . $id_articulo . ";";

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
	}
?>