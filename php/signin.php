<?php
#Captura de variable de usuario e contrasinal dende index.html
$usuario = $_POST['usuario'];
$contrasinal = $_POST['contrasinal'];

#Variables da conexión da base de datos
$host_db = "localhost";
$usuario_db = "root";
$contrasinal_db = "";
$nome_db = "equipamentos";

#Conexión coa base de datos, almacenamos o resultado nunha variable para o seu posterior emprego
$conn_db = new mysqli($host_db, $usuario_db, $contrasinal_db, $nome_db);

#Comprobación da conexión contra á base de datos. Se non é correcta avísanos e nos sinala o error
if ($conn_db->connect_errno) {
    echo 'Fallo da conexión contra á base de datos: ' . $conn_db->connect_error;
}/*else {
 echo 'Base de datos conectada correctamente.';
}*/

#Primeira etapa do control de acceso - Comporbamos se están engadidos os campos necesarios para o acceso e discutimos de que xeito avisar o usuario no caso de que lle falte un, otro ou os dous

#Lóxica de acceso
##Se deixa o campo usuario valeiro se lle avisa
##Se deixa os dous campos valeiros se lle avisa
##Se existe pero introduce unha contrasinal equivocada se lle avisa
##Se existe pero deixa o campo contrasinal se lle avisa
##Se o usuario existe comprobamos a contrasinal se non redirecionamos á páxina de rexistro
##Se o usuario existe e a contrasinal é válida, rediriximos a menu.php
###Cálculo do largo da cadea $usuario y $contrasinal para verificar se está valeira ou non
$usuarioLargo = strlen($usuario);
$contrasinalLargo = strlen($contrasinal);
if ($usuarioLargo == 0 && $contrasinalLargo == 0){
	header("Location: ./err/signin/total.php");
} elseif ($usuarioLargo == 0) {
	header("Location: ./err/signin/parcial_usuario.php");
} elseif ($contrasinalLargo == 0) {
	header("Location: ./err/signin/parcial_contrasinal.php");
} else{

	#Segunda etapa de control de acceso - Unha vez comporbado que os dous campos existen, comprobamos se o usuario ingresado existe e a sua contrasinal é válida
	#Consulta á base de datos sobre a existencia do usuario
	$queryComprUsuario = "SELECT usuario FROM usuario WHERE usuario = '$usuario'";
	$validUsuario = mysqli_num_rows($conn_db->query($queryComprUsuario));//Se exite o usuario esperamos un 1, se no, un 0

	#Consulta á base de datos sobre a validez da contrasinal
	$queryComprContrasinal = "SELECT usuario,contrasinal FROM usuario WHERE usuario = '$usuario' AND contrasinal = '$contrasinal'";
	$validContrasinal = mysqli_num_rows($conn_db->query($queryComprContrasinal));//Se coincide a contrasinal esperamos un 1, se no, un 0

	#Comprobamos se o usuario é válido ou non
	if ($validUsuario == 1){

		#Se, ademais de que o usuario existe, a contrasinal é correcta, iniciamos sesión para propagar as variables, redireccionamos o menú e pechamos a conexión contra a base de datos
		if ($validContrasinal == 1){
			session_start();
			$_SESSION["usuario"] = $usuario;
			$_SESSION["contrasinal"] = $contrasinal;
			header("Location: ./menu.php");
			mysqli_close ($conn_db);

		#Se o usuario existe pero a contrasinal non é válida, se lle avisa
		} else {
			header("Location: ./err/signin/no_valido_contrasinal.php");
		}

	#Se o usuario non existe se lle avisa
	} else {
		header("Location: ./err/signin/no_valido_usuario.php");
	}
}
?>