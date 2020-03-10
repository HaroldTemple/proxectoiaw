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

    #Comprobamos se quedan unidades para ser devoltas, se non, non se pode facer Update, se sí, face Update na táboa equipo_aluguer
    #Quedámonos co valor 'cantidade'
    $consultaTotalItem = $conn_db->query("SELECT * FROM equipo_devolto WHERE modelo='$modelo' AND usuario = '$subusuario'");
    $filaConsulta = $consultaTotalItem->fetch_assoc();
    $totalCantidade = $filaConsulta['cantidade'];

    #Update na táboa equipo_aluguer
    $consultaUpdateAluguer = "UPDATE equipo_aluguer SET cantidade = cantidade+1 WHERE modelo = '$modelo'";

    #Update na táboa equipo_devolto
    $consultaUpdateAlugado = "UPDATE equipo_devolto SET cantidade = cantidade-1 WHERE modelo = '$modelo' AND usuario = '$subusuario'";

    #Delete na táboa equipo_devolto
    $consultaDeleteDevolto = "DELETE FROM equipo_devolto WHERE modelo = '$modelo' AND usuario = '$subusuario'";

    #Se ainda queda por devolver
    if($totalCantidade > 1){

        #Modificamos sobre a táboa aluguer engadindo unha unidade
        $conn_db->query($consultaUpdateAluguer);

        #Modificamos sobre a táboa alugado restando unha unidade
        $conn_db->query($consultaUpdateAlugado);

        #Redireccionamos
        header("Location: ../../returnedAdmin.php");

    #Se é o último por devolver
    }else{
    
        #Modificamos sobre a táboa aluguer engadindo unha unidade
        $conn_db->query($consultaUpdateAluguer);
    
        #Modificamos sobre a táboa alugado restando unha unidade
        $conn_db->query($consultaUpdateAlugado);

        #Eliminamos a fila da táboa devolto
        $conn_db->query($consultaDeleteDevolto);

        #Redireccionamos
        header("Location: ../../returnedAdmin.php");
    }
}