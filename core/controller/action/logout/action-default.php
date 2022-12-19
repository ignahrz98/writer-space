<?php
 	/*
 		CONTROLADOR DEL LOGOUT
 	*/

	session_destroy();

	header("Location: ./");
	
?>