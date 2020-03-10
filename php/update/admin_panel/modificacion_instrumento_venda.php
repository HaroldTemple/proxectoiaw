<?php
#Inicio de sesión
include './../../session/start.php';

#Captura de variablea provenientes de signup.html
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$descripcion = $_POST['descripcion'];
$cantidade = $_POST['cantidade'];
$prezo = $_POST['prezo'];
$foto = $_POST['foto'];
$submarca = $_POST['submarca'];
$submodelo = $_POST['submodelo'];

#Conexión á base de datos
include './../../session/db.php';

#Control das variables introducidas
##Obtención do largo das varibales intruducidas
$marcaLargo = strlen($marca);
$modeloLargo = strlen($modelo);
$descripcionLargo = strlen($descripcion);
$cantidadeLargo = strlen($cantidade);
$prezoLargo = strlen($prezo);
$fotoLargo = strlen($foto);

#Control de campos valeior ou cunha extensión excesiva
if ($marcaLargo == 0 OR
    $modeloLargo == 0 OR
    $descripcionLargo == 0 OR
    $cantidade == 0 OR
    $prezoLargo == 0 OR
    $fotoLargo == 0) {
    header("Location: ./../../err/modificacion/vacio.php");
} elseif ($marcaLargo >= 24 OR
    $modeloLargo >= 50 OR
    $descripcionLargo >= 100 OR
    $cantidadeLargo >= 11 OR 
    $prezoLargo >= 11 OR
    $fotoLargo >= 1000) {
    header("Location: ./../../err/modificacion/mal_largo.php");
} else {
    ##Update na táboa equipo_venda
    $consultaUpdateVenda = "UPDATE equipo_venda
        SET marca='$marca', cantidade=$cantidade, descripcion='$descripcion', modelo='$modelo', prezo=$prezo, foto='$foto'
        WHERE marca='$submarca' AND modelo='$submodelo'";
    $conn_db->query($consultaUpdateVenda);
    header("Location: ./../../check/venda_modificar_success.php");
}
?>