<?php
#Inicio de sesión
	session_start();
	$usuario=$_SESSION['usuario'];
	$nome=$_SESSION['nome'];
	$enderezo=$_SESSION['enderezo'];
	$telefono=$_SESSION['telefono'];

#mensaxe
	echo "<p>✅ Usuario: ".$usuario."</br></p>";
	echo "<p>✅ Nome: ".$nome."</br></p>";
	echo "<p>✅ Enderezo: ".$enderezo."</br></p>";
	echo "<p>💩 Telefono: ".$telefono."</p>";
	echo "<p style='text-indent: 3em'>Intentaches engadir como teléfono \"".$telefono."\" valor que non está composto exclusivamente por números.</br></p>";
	echo "<p style='text-indent: 3em'>Inténtao de novo cun teléfono de 9 números exactos.</p>";
?>