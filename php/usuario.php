<?php
#Inicio de sesión
include './../php/session/start.php';

#Conexión á base de datos
include './../php/session/db.php';

#Consulta para verificar que iniciouse sesión. Se coincide a contrasinal e o usuario esperamos un 1, se non, un 0
$queryComprUsuario="SELECT usuario,contrasinal FROM usuario WHERE usuario='$usuario' AND contrasinal='$contrasinal'";
$validUsuarioYcontrasinal=mysqli_num_rows($conn_db->query($queryComprUsuario));//Si coincide la contraseña y el usuario esperamos un 1, si no, un 0

#Comprobación de se o usuario é válido ou non
if($validUsuarioYcontrasinal != 1){
    header("Location: path/lock.php");
}else{

    #Estilos e botón de acceso
    echo "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <title>trebellos.gal</title>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='stylesheet' type='text/css' href=\"../fonts/Linearicons-Free-v1.0.0/icon-font.min.css\">
            <link rel='stylesheet' type='text/css' href=\"../css/util.css\">
            <link rel='stylesheet' type='text/css' href=\"../css/main.css\">
            <link rel='stylesheet' type='text/css' href=\"../css/icons.css\">
            <script src=\"https://cdn.linearicons.com/free/1.0.0/svgembedder.min.js\"></script>
            <link rel='stylesheet' href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\" integrity=\"sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh\" crossorigin=\"anonymous\">
        </head>
        <body>
            <div class='limiter'>
                <div class='container-login100' style=\"background-image: url('../images/bg-01.jpg');\">
                    <div class='wrap-login100 p-t-30 p-b-50'>
                        <span class='login100-form-title p-b-41'>
                            cuenta de usuario de</br>";
        echo "<span style=\"color: #66CCFF\">".$usuario."</span></br>";
        echo "
        </span>
        <div class='limiter' style='text-align: center'>
            <a href='update/user/frontend/nome.php'>
                <svg class='lnr lnr-highlight'>
                    <use xlink:href='#lnr-highlight'></use>
                </svg>
            </a>
            <a href='update/user/frontend/enderezo.php'>
                <svg class='lnr lnr-home'>
                    <use xlink:href='#lnr-home'></use>
                </svg>
            </a>
            <a href='update/user/frontend/telefono.php'>
                <svg class='lnr lnr-phone-handset'>
                    <use xlink:href='#lnr-phone-handset'></use>
                </svg>
            </a>
            <a href='update/user/frontend/dni.php'>
                <svg class='lnr lnr-license'>
                    <use xlink:href='#lnr-license'></use>
                </svg>
            </a>
            <a href='update/user/frontend/contrasinal.php'>
                <svg class='lnr lnr-lock'>
                    <use xlink:href='#lnr-lock'></use>
                </svg>
            </a>
        </div>
        <div>
            <p>nome | enderezo | teléfono | dni | contrasinal</p>
        </div>
        <p></p>
        <p>
            <a href='menu.php'>
            <svg class='lnr lnr-lock'>
                    <use xlink:href='#lnr-undo'></use>
                </svg>
                </a>
            </p>
            <div>
                <p>| volver |</p>
            </div>
            </div>
                </div>
            </div>
        </body>
    </html>
    ";
}
?>