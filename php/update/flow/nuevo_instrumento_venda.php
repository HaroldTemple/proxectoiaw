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

#Control das variables engadidas
##Obtención do largo das varibales engadidas
$marcaLargo = strlen($marca);
$modeloLargo = strlen($modelo);
$descripcionLargo = strlen($descripcion);
$cantidadeLargo = strlen($cantidade);
$prezoLargo = strlen($prezo);
$fotoLargo = strlen($foto);

#Control de campos valeiros ou cuhna extensión excesiva
if ($marcaLargo == 0 OR
    $modeloLargo == 0 OR
    $descripcionLargo == 0 OR
    $cantidade == 0 OR
    $prezoLargo == 0 OR
    $fotoLargo == 0) {
    header("Location: ./../../err/instrumento/vacio.php");
} elseif ($marcaLargo >= 24 OR
    $modeloLargo >= 50 OR
    $descripcionLargo >= 100 OR
    $cantidadeLargo >= 11 OR
    $prezoLargo >= 11 OR
    $fotoLargo >= 1000) {
    header("Location: ./../../err/instrumento/mal_largo.php");
} else {
	##Insert na táboa equipo_venda
    $consultaInsertVenda="INSERT
        INTO equipo_venda (marca, cantidade, descripcion, modelo, prezo, foto)
        VALUES ('$marca', '$cantidade', '$descripcion', '$modelo', '$prezo', '$foto')";
        $conn_db->query($consultaInsertVenda);
    header("Location: ./../../check/venda_nuevo_success.php");
}
?>