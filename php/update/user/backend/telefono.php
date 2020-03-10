<?php
#Inicio de sesión
include './../../../session/start.php';

#Conexión á base de datos
include './../../../session/db.php';

#Captura de variables
$telefono1 = $_POST['telefono1'];
$telefono2 = $_POST['telefono2'];

#Control das variables introducidas
##Obtención do largo das varibales intruducidas
$telefono1Largo = strlen($telefono1);
$telefono2Largo = strlen($telefono2);

#Controlamos que o os campos non estean valeiors así como que teñan un formato adecuado
#Redireccionamos os errores
##Telefono - Valor único de 9 caracteres y sólo compuesto por números
if ($telefono1Largo == 0 OR $telefono2Largo == 0) {
    header("Location: ./../../../err/usuario/vacio.php");
} elseif (!is_numeric($telefono1)) {
    header("Location: ./../../../err/usuario/mal_tipo_valor.php");
} elseif ($telefono1Largo != 9) {
	header("Location: ./../../../err/usuario/mal_largo.php");
	mysqli_close($conn_db);
} else {

    #Update na táboa usuario
    $consultaUpdateUsuario = "UPDATE usuario SET telefono = '$telefono1' WHERE usuario = '$usuario'";
    $conn_db->query($consultaUpdateUsuario);

    #Redireccionamos exito
    header("Location: ./../../../../php/check/usuario_success.php");
}
?>