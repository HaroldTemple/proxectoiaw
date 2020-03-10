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
	echo "<p>💩 DNI: ".$dni."</p>";
	echo "<p style='text-indent: 3em'>Intentaches engadir como DNI \"".$dni."\" que, a pesar de ter unha lonxitude adecuada, non se axusta o formato ou a letra non é a correcta e polo tanto non es válido.</br></p>";
	echo "<p style='text-indent: 3em'>Inténtao de novo cumprindo o formato de 8 números e 1 letra que sexa válida.</p>";
	echo "<p style='text-indent: 3em'>Exemplo - 12345678A.</p>";
?>