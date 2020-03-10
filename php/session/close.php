<?php
#Mensaxe
	echo "Grazas por empregar o noso servizo.";

#Inicio de sesión
	session_start();

#Destrucción de sesión
	session_destroy();

#Conta regresiva
	echo "
		<span id='cuentaRegresiva'></span>
		<script type=\"text/javascript\">
			window.onload = cuentaRegresiva;
			let tiempo = 5;
			function cuentaRegresiva() {
				document.getElementById('cuentaRegresiva').innerHTML = 'Serás redirecionado en ' + tiempo;
				if(tiempo==0){
					window.location='../../index.html';
				}else{
					tiempo-=1;0;
					setTimeout('cuentaRegresiva()',1000);
				}
			}
		</script>";
?>