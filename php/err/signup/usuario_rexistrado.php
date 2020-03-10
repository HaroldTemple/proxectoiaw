<?php
#Inicio de sesión
	session_start();
	$usuario=$_SESSION['usuario'];

#Mensaxe
	echo "<p>💩 Usuario: ".$usuario." xa existe, por favor inténtao con outro.</p>"
?>