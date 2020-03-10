<?php
#Inicio de sesión
	session_start();
	$usuario=$_SESSION['usuario'];
	$nome=$_SESSION['nome'];
	$enderezo=$_SESSION['enderezo'];

#Mensaxe
	echo "<p>✅ Usuario: ".$usuario."</br></p>";
	echo "<p>✅ Nome: ".$nome."</br></p>";
	echo "<p>💩 Enderezo: ". $enderezo."</p>";
	echo "<p style='text-indent: 3em'>Intentaches engadir como enderezo \"".$enderezo."\" que ten unha extensión de ".strlen($enderezo)." caracteres.</br></p>";
	echo "<p style='text-indent: 3em'>Inténtao de novo cun enderezo de polo menos 8 caracteres e non mais de 90.</p>";
?>