<?php
#Inicio de sesión
include './../php/session/start.php';

#Conexión á base de datos
include './../php/session/db.php';

#Consulta para verificar que iniciouse sesión. Se coincide a contrasinal e o usuario esperamos un 1, se non, un 0
$queryComprUsuario = "SELECT usuario, contrasinal FROM usuario WHERE usuario = '$usuario' AND contrasinal = '$contrasinal'";
$validUsuarioYcontrasinal = mysqli_num_rows($conn_db->query($queryComprUsuario));

#Comprobación de si el usuario es válido o no
if($validUsuarioYcontrasinal != 1){
    header("Location: ./../../../path/lock.php");
}else{

    #Comprobamos se o usuario que iniciou sesión e Administardor ['a'] ou Usuario ['u']
    ##Dependendo disto, mostramos un menú difernete
    $consultaTotalItem=$conn_db->query("SELECT tipo_usuario FROM usuario WHERE usuario='$usuario'");
    $filaConsulta=$consultaTotalItem->fetch_assoc();
    $tipoUsuario=$filaConsulta['tipo_usuario'];

    #Comprobación de si el usuario es válido o no
    if($validUsuarioYcontrasinal != 1){
        header("Location: path/lock.php");

    #Se é Usuario
    }elseif($tipoUsuario == 'u'){

        #Estilos e botóns
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
                        <div class='container-login100' style='background-image: url(\"../images/bg-01.jpg\");'>
                            <div class='wrap-login100 p-t-30 p-b-50'>
                                <span class='login100-form-title p-b-40'>
                                    panel de usuario
                                </span>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"rent.php\">Aluguer</a>
                                </div>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"rented.php\">Alugado</a>
                                </div>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"returnedUser.php\">Devolto</a>
                                </div>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"sale.php\">Venda</a>
                                </div>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"usuario.php\">Usuario</a>
                                </div>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"session/close.php\">Pechar sesión</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </body>
            </html>
        ";

    #Se pola contra é Administardor
    }else{

        #Estilos e botóns
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
                        <div class='container-login100' style='background-image: url(\"../images/bg-01.jpg\");'>
                            <div class='wrap-login100 p-t-30 p-b-50'>
                                <span class='login100-form-title p-b-40'>
                                    panel de administrador
                                </span>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"./update/admin_panel/nuevos_registros.php\">Administrar novos rexistros</a>
                                </div>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"returnedAdmin.php\">Xestionar devolucións</a>
                                </div>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"./update/admin_panel/nuevo_instrumento_aluguer.php\">Aluguer - Engadir</a>
                                </div>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"./update/admin_panel/eliminar_instrumento_aluguer.php\">Aluguer - Eliminar</a>
                                </div>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"./update/admin_panel/modificar_instrumento_aluguer.php\">Aluguer - Modificar</a>
                                </div>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"./update/admin_panel/nuevo_instrumento_venda.php\">Venda - Engadir</a>
                                </div>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"./update/admin_panel/eliminar_instrumento_venda.php\">Venda - Eliminar</a>
                                </div>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"./update/admin_panel/modificar_instrumento_venda.php\">Venda - Modificar</a>
                                </div>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"update/flow/informe_aluguer.php\">Informe aluguer</a>
                                </div>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"update/flow/informe_venda.php\">Informe venda</a>
                                </div>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"usuario.php\">Usuario</a>
                                </div>
                                <div class='container-login100-form-btn m-t-32'>
                                    <a class='login100-form-btn' href=\"session/close.php\">Pechar sesión</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </body>
            </html>
        ";
    }
}
?>