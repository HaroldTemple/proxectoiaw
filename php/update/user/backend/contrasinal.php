<?php
#Inicio de sesión
include './../../../session/start.php';

#Conexión á base de datos
include './../../../session/db.php';

#Captura de variables
$contrasinal1 = $_POST['contrasinal1'];
$contrasinal2 = $_POST['contrasinal2'];

#Control das variables introducidas
##Obtención do largo das varibales intruducidas
$contrasinal1Largo = strlen($contrasinal1);
$contrasinal2Largo = strlen($contrasinal2);

#Controlamos que o os campos non estean valeiors así como que teñan un formato adecuado
#Redireccionamos os errores
if ($contrasinal1Largo == 0 OR $contrasinal2Largo == 0) {
    header("Location: ./../../../err/usuario/vacio.php");
} elseif ($contrasinal1Largo < 6 OR $contrasinal1Largo > 8) {
    header("Location: ./../../../err/usuario/mal_largo.php");
} elseif (!preg_match('`[a-z]`', $contrasinal1)) {
    header("Location: ./../../../err/usuario/mal_formato.php");
} elseif (!preg_match('`[A-Z]`', $contrasinal1)) {
    header("Location: ./../../../err/usuario/mal_formato.php");
} elseif (!preg_match('`[0-9]`', $contrasinal1)) {
    header("Location: ./../../../err/usuario/mal_formato.php");
} else {

	#Update na táboa usuario - Valor comprendido entre 6 e 8 caracteres que contenga polo menos unah maiúscula, unha minúscula e un número
    $consultaUpdateUsuario="UPDATE usuario SET contrasinal='$contrasinal1' WHERE usuario='$usuario'";
    $conn_db->query($consultaUpdateUsuario);

    #Redireccionamos exito
    header("Location: ./../../../../php/check/usuario_success.php");
}
?>