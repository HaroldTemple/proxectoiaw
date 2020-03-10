<?php
#Inicio de sesión
	session_start();
	$usuario=$_SESSION['usuario'];

#Mensaxe
	echo "💩 Usuario: ".$usuario;
	echo "<p style='text-indent: 3em'>Intentaches engadir como usuario \"".$usuario."\" que ten unha extensión de ".strlen($usuario)." caracteres.</br></p>";
	echo "<p style='text-indent: 3em'>Inténtao de novo cun valor de polo menos 4 caracteres e non mais de 24.</p>";
?>