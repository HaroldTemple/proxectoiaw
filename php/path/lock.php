<?php
#Mensaxe
    echo "Estás intentando acceder a unha ruta protexida.</br>";
    echo "Para acceder a ela, primeiro debes iniciar sesión.</br>";

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