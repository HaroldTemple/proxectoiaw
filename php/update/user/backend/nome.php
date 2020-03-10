<?php
#Inicio de sesión
include './../../../session/start.php';

#Conexión á base de datos
include './../../../session/db.php';

#Captura de variables
$nome1 = $_POST['nome1'];
$nome2 = $_POST['nome2'];

#Control das variables introducidas
##Obtención do largo das varibales intruducidas
$nome1Largo = strlen($nome1);
$nome2Largo = strlen($nome2);

#Controlamos que o os campos non estean valeiors así como que teñan un formato adecuado
#Redireccionamos os errores
##Nome - Mínimo 3 máximo 60caracteres
if ($nome1Largo == 0 OR $nome2Largo == 0) {
    header("Location: ./../../../err/usuario/vacio.php");
} elseif ($nome1Largo < 3 or $nome1Largo > 60) {
	header("Location: ./../../../err/usuario/mal_largo.php");
} elseif ($nome1 != $nome2) {
    header("Location: ./../../../err/usuario/mal_coincidencia.php");
} else {

    #Update na táboa usuario
    $consultaUpdateUsuario = "UPDATE usuario SET nome = '$nome1' WHERE usuario = '$usuario'";
    $conn_db->query($consultaUpdateUsuario);
 
    #Redireccionamos exito
    header("Location: ./../../../../php/check/usuario_success.php");
}
?>