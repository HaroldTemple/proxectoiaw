<?php
#Mensaxe
    echo "<p>Noraboa. Conseguiches rexistarte con éxito</p>";
    echo "<p>Lembra que para poder iniciar sesión deberás ser validado por un administrador</p>";

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