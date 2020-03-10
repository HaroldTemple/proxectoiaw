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

#Captura das variables provenintes de signup.html
$usuario = $_POST['usuario'];
$nome = $_POST['nome'];
$enderezo = $_POST['enderezo'];
$telefono = $_POST['telefono'];
$dni = $_POST['dni'];
$contrasinal1 = $_POST['contrasinal1'];
$contrasinal2 = $_POST['contrasinal2'];

#Control das variables introducidas
##Obtemos o largo das varibales intruducidas
$usuarioLargo = strlen($usuario);
$nomeLargo = strlen($nome);
$enderezoLargo = strlen($enderezo);
$telefonoLargo = strlen($telefono);
$dniLargo = strlen($dni);
$contrasinal1Largo = strlen($contrasinal1);
$contrasinal2Largo = strlen($contrasinal2);

##Variables de control
$usuarioV = 0;
$nomeV = 0;
$enderezoV = 0;
$telefonoV = 0;
$dniV = 0;
$telefonoV = 0;
$contrasinalV = 0;

#En todos os casos contralamos que os campos non estean valeiros e cumpran coa lonxitude requerida
#O xeito de programar a lóxica ten os bloques invertidos para xestionar os campos valeiros

#Contrasinal - Requerimos:
## que as duas contrasinales introducdas coincidan ademais de que conteña polo menos unha letra maiúscula, unha letra minúscula e un número
## que cada vez que haxa un erro según queimamos etapas, engadimos as variables anteriores para xerar o mensaxe de erro
if ($contrasinal1Largo == 0) {
	header("Location: ./err/signup/vacio_contrasinal1.php");
} elseif ($contrasinal1Largo < 6) {
	header("Location: ./err/signup/mal_contrasinal_corta.php");
	mysqli_close($conn_db);
} elseif ($contrasinal1Largo > 8) {
	header("Location: ./err/signup/mal_contrasinal_larga.php");
	mysqli_close($conn_db);
} elseif (!preg_match('`[a-z]`', $contrasinal1)) {
	header("Location: ./err/signup/mal_formato_contrasinal_falta_minuscula.php");
	mysqli_close($conn_db);
} elseif (!preg_match('`[A-Z]`', $contrasinal1)) {
	header("Location: ./err/signup/mal_formato_contrasinal_falta_mayuscula.php");
	mysqli_close($conn_db);
} elseif (!preg_match('`[0-9]`', $contrasinal1)) {
	header("Location: ./err/signup/mal_formato_contrasinal_falta_numero.php");
	mysqli_close($conn_db);
} else {
	if ($contrasinal2Largo == 0) {
		header("Location: ./err/signup/vacio_contrasinal2.php");
	} elseif ($contrasinal1 != $contrasinal2) {
		header("Location: ./err/signup/mal_no_coinciden_contrasinais.php");
	} else {

		#Cambiamos a 1 a variable de control que permitiranos despois validar o rexistro
		$contrasinalV = 1;
	}
}

##DNI - Requerimos vlor único de 9 caracteres (8 números seguido dunha letra) con validación de letra
if ($dniLargo == 0) {
	header("Location: ./err/signup/vacio_dni.php");
} elseif ($dniLargo != 9) {
	session_start();
	$_SESSION['usuario'] = $usuario;
	$_SESSION['nome'] = $nome;
	$_SESSION['enderezo'] = $enderezo;
	$_SESSION['telefono'] = $telefono;
	$_SESSION['dni'] = $dni;
	header("Location: ./err/signup/mal_largo_dni.php");
	mysqli_close($conn_db);
} elseif ($dniLargo == 9) {
	$numeros = substr($dni, 0, 8);
	$letra = strtoupper($dni[8]);

	###Función de comprobación de validez de la letra introducida
	if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1) == $letra) {

		#Cambiamos a 1 a variable de control que permitiranos despois validar o rexistro
		$dniV = 1;
	} else {
		session_start();
		$_SESSION['usuario'] = $usuario;
		$_SESSION['nome'] = $nome;
		$_SESSION['enderezo'] = $enderezo;
		$_SESSION['telefono'] = $telefono;
		$_SESSION['dni'] = $dni;
		header("Location: ./err/signup/mal_formato_dni.php");
		mysqli_close($conn_db);
	}
}

##Telefono - Valor único de 9 caracteres e so composto por números
if ($telefonoLargo == 0) {
	header("Location: ./err/signup/vacio_telefono.php");
} elseif (!is_numeric($telefono)) {
	session_start();
	$_SESSION['usuario'] = $usuario;
	$_SESSION['nome'] = $nome;
	$_SESSION['enderezo'] = $enderezo;
	$_SESSION['telefono'] = $telefono;
	header("Location: ./err/signup/mal_tipoValor_telefono.php");
	mysqli_close($conn_db);
} elseif ($telefonoLargo != 9) {
	session_start();
	$_SESSION['usuario'] = $usuario;
	$_SESSION['nome'] = $nome;
	$_SESSION['enderezo'] = $enderezo;
	$_SESSION['telefono'] = $telefono;
	header("Location: ./err/signup/mal_telefono.php");
	mysqli_close($conn_db);
} else {

	#Cambiamos a 1 a variable de control que permitiranos despois validar o rexistro
	$telefonoV = 1;
}

##Enderezo - Mínimo 8 máximo 90 caracteres
if ($enderezoLargo == 0) {
	header("Location: ./err/signup/vacio_enderezo.php");
} elseif ($enderezoLargo < 8 or $enderezoLargo > 60) {
	session_start();
	$_SESSION['usuario'] = $usuario;
	$_SESSION['nome'] = $nome;
	$_SESSION['enderezo'] = $enderezo;
	header("Location: ./err/signup/mal_enderezo.php");
	mysqli_close($conn_db);
} else {

	#Cambiamos a 1 a variable de control que permitiranos despois validar o rexistro
	$enderezoV = 1;
}

##Nome - Mínimo 3 máximo 60caracteres
if ($nomeLargo == 0) {
	header("Location: ./err/signup/vacio_nome.php");
} elseif ($nomeLargo < 3 or $nomeLargo > 60) {
	session_start();
	$_SESSION['usuario'] = $usuario;
	$_SESSION['nome'] = $nome;
	header("Location: ./err/signup/mal_nome.php");
	mysqli_close($conn_db);
} else {

	#Cambiamos a 1 a variable de control que permitiranos despois validar o rexistro
	$nomeV = 1;
}

##Usuario - Mínimo 4 máximo 24 caracteres
##No exista o usuario na táboa usuario nin está prerexistrado na táboa novo_rexistro
$queryComprUsuarioTusuario = "SELECT usuario FROM usuario WHERE usuario = '$usuario'";
$validUsuarioTusuario = mysqli_num_rows($conn_db->query($queryComprUsuarioTusuario)); //Se exite o usuario esperamos un 1, se non, un 0
$queryComprUsuarioTnovo_rexistro = "SELECT usuario FROM novo_rexistro WHERE usuario = '$usuario'";
$validUsuarioTnovo_rexistro = mysqli_num_rows($conn_db->query($queryComprUsuarioTnovo_rexistro)); //Se exite o usuario esperamos un 1, se non, un 0

if ($usuarioLargo == 0) {
	header("Location: ./err/signup/vacio_usuario.php");
} elseif ($usuarioLargo < 4 or $usuarioLargo > 25) {
	session_start();
	$_SESSION['usuario'] = $usuario;
	header("Location: ./err/signup/mal_usuario.php");
	mysqli_close($conn_db);
} elseif ($validUsuarioTusuario == 1) {
	header("Location: ./err/signup/usuario_rexistrado.php");
} elseif ($validUsuarioTnovo_rexistro == 1) {
	header("Location: ./err/signup/usuario_prerexistrado.php");
} else {

	#Cambiamos a 1 a variable de control que permitiranos despois validar o rexistro
	$usuarioV = 1;
}

#Se todos os campos foron engadidos teremos todas as variables de control igualdas a 1
##Sumamos todos os valores das variables de control
$total = $usuarioV + $nomeV + $enderezoV + $dniV + $telefonoV + $contrasinalV;

#Se a suma (todas) e igual a 6, facemos un Insert na táboa novo_rexistro para deixar o usuario prerexistrado
if ($total == 6) {
	$conn_db->query("INSERT INTO novo_rexistro VALUES('$usuario', '$contrasinal1', '$nome', '$enderezo', '$telefono', '$dni')");

	#Rediriximos exito
	header("Location: ./check/signup_success.php");
}
?>