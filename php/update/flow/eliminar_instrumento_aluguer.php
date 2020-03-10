<?php
#Inicio de sesión
include './../../session/start.php';

#Conexión á base de datos
include './../../session/db.php';

#Captura de variables
$modelo=$_POST['modelo'];
$marca=$_POST['marca'];

#Consulta para verificar que iniciouse sesión. Se coincide a contrasinal e o usuario esperamos un 1, se non, un 0
$queryComprUsuario = "SELECT usuario, contrasinal FROM usuario WHERE usuario = '$usuario' AND contrasinal = '$contrasinal'";
$validUsuarioYcontrasinal = mysqli_num_rows($conn_db->query($queryComprUsuario));

#Comprobación de se o usuario es válido ou non
if ($validUsuarioYcontrasinal != 1){
    header("Location: ./../../path/lock.php");
} else {

    #Delete na táboa equipos_aluguer
    $consultaDeleteAluguer = "DELETE FROM equipo_aluguer WHERE marca = '$marca' AND modelo = '$modelo'";
    
    #Execución da consulta e redireccionamento
    if ($consultaDeleteAluguer){
        $conn_db->query($consultaDeleteAluguer);
        header("Location: ./../../check/aluguer_eliminar_success.php");
    }
}
?>