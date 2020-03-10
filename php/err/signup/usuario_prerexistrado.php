<?php
#Inicio de sesión
	session_start();
	$usuario=$_SESSION['usuario'];

#Mensaxe
	echo "<p>💩 Usuario: ".$usuario." non existe pero está prerexistrado, por favor inténtelo con outro.</p>"
?>