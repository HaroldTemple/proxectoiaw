<?php
#Inicio de sesión
include './../../session/start.php';

#Conexión á base de datos
include './../../session/db.php';

#Captura de variables
$cantidade=$_POST['cantidade'];
$modelo=$_POST['modelo'];
$marca=$_POST['marca'];
$descripcion=$_POST['descripcion'];
$foto=$_POST['foto'];
$prezo=$_POST['prezo'];

##Precisamos dunha variable extra para desambiguar o usuario que administra do usuario que alugou
$subusuario=$_POST['subusuario'];

#Consulta para verificar que iniciouse sesión. Se coincide a contrasinal e o usuario esperamos un 1, se non, un 0
$queryComprUsuario = "SELECT usuario, contrasinal FROM usuario WHERE usuario = '$usuario' AND contrasinal = '$contrasinal'";
$validUsuarioYcontrasinal = mysqli_num_rows($conn_db->query($queryComprUsuario));

#Comprobación de se o usuario es válido ou non
if ($validUsuarioYcontrasinal != 1){
    header("Location: ./../../path/lock.php");
} else {

    #Comprobamos se quedan unidades para ser alugadas para facer Update
    #Quedámonos co valor 'cantidade'
    $consultaTotalItem = $conn_db->query("SELECT cantidade FROM equipo_aluguer WHERE modelo = '$modelo'");
    $filaConsulta = $consultaTotalItem->fetch_assoc();
    $totalCantidade = $filaConsulta['cantidade'];


    #Update na táboa equipo_aluguer
    $consultaUpdateAlugado = "UPDATE equipo_aluguer SET cantidade = cantidade+$cantidade WHERE modelo = '$modelo'";

    #Delete na táboa equipo_devolto
    $consultaDeleteDevolto = "DELETE FROM equipo_devolto WHERE modelo = '$modelo' AND usuario = '$subusuario'";

    #Iniciamos a devolución de todos os instrumentos da liña
    if($totalCantidade){

        #Actualizamos a táboa alugado e eliminamos de táboa devolto
        $conn_db->query($consultaUpdateAlugado);
        $conn_db->query($consultaDeleteDevolto);

        #Redireccionamos
        header("Location: ../../returnedAdmin.php");
    }
}