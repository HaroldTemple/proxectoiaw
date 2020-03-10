<?php
#Inicio de sesión
	session_start();
	$usuario=$_SESSION['usuario'];
	$nome=$_SESSION['nome'];

#Mensaxe
	echo "<p>✅ Usuario: ".$usuario."</br></p>";
	echo "<p>💩 Nome: ".$nome."</p>";
	echo "<p style='text-indent: 3em'>Intentaches engadir como nome \"".$nome."\" que ten unha extensión de ".strlen($nome)." caracteres.</br></p>";
	echo "<p style='text-indent: 3em'>Inténtao de novo cun nome de usuario de polo menos 3 caracteres e non mais de 60.</p>";
?>