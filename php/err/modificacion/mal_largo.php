<?php
#Mensaxe
	echo "Engadiches polo meno un campo cunha cantidade de carecteres superior os permitidos.</br>";
	echo "Marca [24].</br>";
	echo "Modelo [50].</br>";
	echo "Descripción [100].</br>";
	echo "Cantidade [11].</br>";
	echo "Prezo [11].</br>";
	echo "Foto [1000].</br>";
	echo "</br>";

#Conta regresiva
	echo "
	<span id='cuentaRegresiva'></span>
	<script type=\"text/javascript\">
		window.onload = cuentaRegresiva;
		let tiempo = 5;
		function cuentaRegresiva() {
			document.getElementById('cuentaRegresiva').innerHTML = 'Serás redirecionado en ' + tiempo;
			if(tiempo==0){
				window.location='../../menu.php';
			}else{
				tiempo-=1;0;
				setTimeout('cuentaRegresiva()',1000);
			}
		}
	</script>";
?>