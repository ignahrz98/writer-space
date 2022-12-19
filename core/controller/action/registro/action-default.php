<?php
	/*
		ACCION DE REGISTRO DE USUARIOS.
	*/

	require_once("core/model/usuariosBD.php");
	$tabla_usuarios = new UsuariosBD();

	$username_registrar = $_REQUEST['username_registrar'];
	$crear_contrasena = $_REQUEST['crear_contrasena'];
	$confirmar_contrasena = $_REQUEST['confirmar_contrasena'];

	$habilitar_registro = true;
	$username_esta_bien = true;
	$cadena_para_mensajes_de_error = "";

	#echo "Username: ".$username_registrar."<br>";
	#echo "Crear contrasena: ".$crear_contrasena."<br>";
	#echo "Confirmar contrasena: ".$confirmar_contrasena."<br><br>";

	#$hash = password_hash($crear_contrasena, PASSWORD_DEFAULT);

	#echo "HASH: " . $hash."<br><br>";

	#	Validar registro
	#	Validar username, primero detectar si no contiene espacios en blanco
	if (strpos($username_registrar, " ")) 
	{

		#echo "El username no puede contener espacios en blanco<br>";

		$habilitar_registro = false;
		$username_esta_bien = false;

		$cadena_para_mensajes_de_error .= "&espacios_en_blanco";

	}

	#	Validar longitud del username
	if(strlen($username_registrar) < 5)
	{

		#echo "El username es muy corto<br>";

		$habilitar_registro = false;
		$username_esta_bien = false;

		$cadena_para_mensajes_de_error .= "&username_corto";

	}

	#	Validar si el username está disponible.
	if($username_esta_bien)
	{
		if ($tabla_usuarios->verificar_username_disponible($username_registrar)) 
		{

			#echo "está disponible";

			$cadena_para_mensajes_de_error .= "&username_disponible";

		} else 
		{

			#echo "ya esta en uso";

			$cadena_para_mensajes_de_error .= "&username_en_uso";

			$habilitar_registro = false;

		}
	}

	#	Luego validar la longitud de la contrasena
	if(strlen($crear_contrasena) < 7)
	{

		#echo "La contrasena es muy corta<br>";

		$habilitar_registro = false;

		$cadena_para_mensajes_de_error .= "&contrasena_corta";

	} else 	if(strlen($crear_contrasena) > 10)
	{

		#echo "La contrasena es muy larga<br>";

		$habilitar_registro = false;

		$cadena_para_mensajes_de_error .= "&contrasena_larga";

	}

	#	Validar que las contraseñas ingresadas coincidan.
	if ($crear_contrasena != $confirmar_contrasena) 
	{

		#echo "Las contrasenas ingresadas no coinciden<br>";

		$habilitar_registro = false;

		$cadena_para_mensajes_de_error .= "&contrasenas_no_coinciden";

	}

	#	Realizar registro o volver al formulario
	if ($habilitar_registro == true) 
	{

		#echo "Registro true";

		$crear_contrasena_con_hash = password_hash($crear_contrasena, PASSWORD_DEFAULT);

		$tabla_usuarios->set_nuevo_usuario(	$username_registrar,
											$crear_contrasena_con_hash);

		$cadena_direccion = "Location: ./?view=registro";
		$cadena_direccion .= "&registro_exitoso";

		header($cadena_direccion);

	} else 
	{

		#echo "registro false";

		#	Armar la cadena con los datos para mostrar mensajes y rellenar el formulario
		#	automaticamente

		$cadena_direccion = "Location: ./?view=registro";
		$cadena_direccion .= $cadena_para_mensajes_de_error;
		$cadena_direccion .= "&username_registrar=" . $username_registrar;

		header($cadena_direccion);

	}


	/*
	Este codigo es para validar la contrasena
	if (password_verify($crear_contrasena, $hash)) 
	{
    	echo '¡La contraseña es válida!';
	} else 
	{
    	echo 'La contraseña no es válida.';
	}
	*/

	/*
	$tabla_usuarios->set_nuevo_usuario(	$username,
										$nombres,
										$apellidos,
										$pass1,
										$sexo,
										$nivelEst);

	echo "	<script type='text/javascript'>
	        	alert('Registro exitoso, reciba una cordial bienvenida!!!');
	        	location='./';
	        </script>";
	*/
?>