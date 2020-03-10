<?php
#Mensaxe
    echo "<p>Noraboa. Modificaches un instrumento en aluguer con éxito.</p></br>";

#Conta regresiva
    echo "
        <span id='cuentaRegresiva'></span>
        <script type=\"text/javascript\">
            window.onload = cuentaRegresiva;
            let tiempo = 5;
            function cuentaRegresiva() {
                document.getElementById('cuentaRegresiva').innerHTML = 'Serás redirecionado en ' + tiempo;
                if(tiempo==0){
                    window.location='../menu.php';
                }else{
                    tiempo-=1;0;
                    setTimeout('cuentaRegresiva()',1000);
                }
            }
        </script>";
?>