<?php
#Inicio de sesión
	session_start();
	$usuario=$_SESSION['usuario'];
	$nome=$_SESSION['nome'];
	$enderezo=$_SESSION['enderezo'];
	$telefono=$_SESSION['telefono'];
	$dni=$_SESSION['dni'];

#Mensaxe
	echo "<p>✅ Usuario: ".$usuario."</br></p>";
	echo "<p>✅ Nome: ".$nome."</br></p>";
	echo "<p>✅ Enderezo: ".$enderezo."</br></p>";
	echo "<p>✅ Telefono: ".$telefono."</br></p>";
	echo "<p>✅ DNI: ".$dni."</br></p>";
	echo "<p>💩 Contasinal:</p>";
	echo "<p style='text-indent: 3em'>Engadiches unha contrasinal válida pero non coinciden.</p>";
?>