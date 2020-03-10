<?php
#Inicio de sesión
include './../../../session/start.php';

#Conexión á base de datos
include './../../../session/db.php';

#Captura de variables
$enderezo1 = $_POST['enderezo1'];
$enderezo2 = $_POST['enderezo2'];

#Control das variables introducidas
##Obtención do largo das varibales intruducidas
$enderezo1Largo = strlen($enderezo1);
$enderezo2Largo = strlen($enderezo2);

#Controlamos que o os campos non estean valeiors así como que teñan un formato adecuado
#Redireccionamos os errores
##Enderezo - Mínimo 8 máximo 90 caracteres
if ($enderezo1Largo == 0 OR $enderezo2Largo == 0) {
    header("Location: ./../../../err/usuario/vacio.php");
} elseif ($enderezo1Largo < 8 or $enderezo1Largo > 60) {
    header("Location: ./../../../err/usuario/mal_largo.php");
} else {

    #Update na táboa usuario
    $consultaUpdateUsuario = "UPDATE usuario SET direccion = '$enderezo1' WHERE usuario = '$usuario'";
    $conn_db->query($consultaUpdateUsuario);

    #Redireccionamos exito
    header("Location: ./../../../../php/check/usuario_success.php");
}
?>