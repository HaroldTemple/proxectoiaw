<?php
    echo "<p>Noraboa. Cambiaches o valor con éxito.</p></br>";
    echo "
        <span id='cuentaRegresiva'></span>
        <script type=\"text/javascript\">
            window.onload = cuentaRegresiva;
            let tiempo = 5;
            function cuentaRegresiva() {
                document.getElementById('cuentaRegresiva').innerHTML = 'Serás redirecionado en ' + tiempo;
                if(tiempo==0){
                    window.location='./../usuario.php';
                }else{
                    tiempo-=1;0;
                    setTimeout('cuentaRegresiva()',1000);
                }
            }
        </script>";
?>