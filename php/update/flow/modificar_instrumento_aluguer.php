<?php
#Inicio de sesión
include './../../session/start.php';

#Conexión á base de datos
include './../../session/db.php';

#Captura de variables
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$descripcion = $_POST['descripcion'];
$cantidade = $_POST['cantidade'];
$prezo = $_POST['prezo'];
$foto = $_POST['foto'];
$submarca = $_POST['marca'];
$submodelo = $_POST['modelo'];

#Consulta para verificar que iniciouse sesión. Se coincide a contrasinal e o usuario esperamos un 1, se non, un 0
$queryComprUsuario = "SELECT usuario, contrasinal FROM usuario WHERE usuario = '$usuario' AND contrasinal = '$contrasinal'";
$validUsuarioYcontrasinal = mysqli_num_rows($conn_db->query($queryComprUsuario));

#Comprobación de si el usuario es válido o no
if($validUsuarioYcontrasinal != 1){
    header("Location: ../../../path/lock.php");
}else{

    #Estilos e formulario
    #Enviamos ocultas duas variable que precisaremos para que no entre en conflicto (desambiguar)
    echo "
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"../../../fonts/Linearicons-Free-v1.0.0/icon-font.min.css\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"../../../css/util.css\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"../../../css/main.css\">
        <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\"
            integrity=\"sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh\" crossorigin=\"anonymous\">
        <div class=\"limiter\">
            <div class=\"container-login100\" style=\"background-image: url('../../../images/bg-01.jpg');\">
                <div class=\"wrap-login100 p-t-30 p-b-50\">
                <span class=\"login100-form-title p-b-40\">";
                echo "<a>conectado como</a></br>";
                echo "<span style=\"color: #66CCFF\">".$usuario."</span></br>";
                echo "</br> modificar </br> instrumento </br> aluguer </br>";
                echo "
                </span>
                    <form class=\"login100-form validate-form p-b-33 p-t-5\" name=\"formulario\" method=\"post\"
                        action=\"../admin_panel/modificacion_instrumento_aluguer.php\">
                        <input type='hidden' name='submodelo' value=\"$submodelo\">
                        <input type='hidden' name='submarca' value=\"$submarca\">
                        <div class=\"wrap-input100 validate-input\" data-validate=\"marca\">
                            <input class=\"input100\" type=\"text\" name=\"marca\" placeholder=\"Marca - $marca\">
                            <span class=\"focus-input100\" data-placeholder=\"&#xe802;\"></span>
                        </div>
                        <div class=\"wrap-input100 validate-input\" data-validate=\"modelo\">
                            <input class=\"input100\" type=\"text\" name=\"modelo\" placeholder=\"Modelo - $modelo\">
                            <span class=\"focus-input100\" data-placeholder=\"&#xe802;\"></span>
                        </div>
                        <div class=\"wrap-input100 validate-input\" data-validate=\"descripcion\">
                            <input class=\"input100\" type=\"text\" name=\"descripcion\" placeholder=\"Descripción - $descripcion\">
                            <span class=\"focus-input100\" data-placeholder=\"&#xe802;\"></span>
                        </div>
                        <div class=\"wrap-input100 validate-input\" data-validate=\"cantidade\">
                            <input class=\"input100\" type=\"text\" name=\"cantidade\" placeholder=\"Cantidade - $cantidade\">
                            <span class=\"focus-input100\" data-placeholder=\"&#xe802;\"></span>
                        </div>
                        <div class=\"wrap-input100 validate-input\" data-validate=\"prezo\">
                            <input class=\"input100\" type=\"text\" name=\"prezo\" placeholder=\"Prezo - $prezo\">
                            <span class=\"focus-input100\" data-placeholder=\"&#xe802;\"></span>
                        </div>
                        <div class=\"wrap-input100 validate-input\" data-validate=\"foto\">
                            <input class=\"input100\" type=\"text\" name=\"foto\" placeholder=\"Foto [url]\">
                            <span class=\"focus-input100\" data-placeholder=\"&#xe802;\"></span>
                        </div>
                        <div class=\"container-login100-form-btn m-t-32\">
                            <input class=\"login100-form-btn\" type=\"submit\" value=\"Modificar\"></input>
                        </div>
                        <div class=\"container-login100-form-btn m-t-32\">
                            <a class=\"login100-form-btn\" href=\"../admin_panel/modificar_instrumento_aluguer.php\">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    ";
}
?>