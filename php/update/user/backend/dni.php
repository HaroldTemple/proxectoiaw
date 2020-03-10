<?php
#Inicio de sesión
include './../../../session/start.php';

#Conexión á base de datos
include './../../../session/db.php';

#Captura de variables
$dni1 = $_POST['dni1'];
$dni2 = $_POST['dni2'];

#Control das variables introducidas
##Obtención do largo das varibales intruducidas
$dni1Largo = strlen($dni1);
$dni2Largo = strlen($dni2);

#Controlamos que o os campos non estean valeiors así como que teñan un formato adecuado
#Redireccionamos os errores
##DNI - Valor único de 9 caracteres (8 números seguido dunha letra) con validación de letra
if ($dni1Largo == 0 OR $dni2Largo == 0) {
    header("Location: ./../../../err/usuario/vacio.php");
} elseif ($dni1Largo != 9) {
    header("Location: ./../../../err/usuario/mal_largo.php");
} elseif ($dni1Largo == 9) {
	$numeros = substr($dni1, 0, 8);
	$letra = strtoupper($dni1[8]);

	###Comprobación de validez da letra introducida
	if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1) == $letra) {

		#Update na táboa usuario
        $consultaUpdateUsuario = "UPDATE usuario SET nifdni='$dni1' WHERE usuario = '$usuario'";
		$conn_db->query($consultaUpdateUsuario);

		#Redireccionamos
        header("Location: ../../../../php/check/usuario_success.php");
	} else {

		#Redireccionamos exito
        header("Location: ../../../err/usuario/mal_formato.php");
	}
}
?>