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

#Consulta para verificar que iniciouse sesión. Se coincide a contrasinal e o usuario esperamos un 1, se non, un 0
$queryComprUsuario = "SELECT usuario, contrasinal FROM usuario WHERE usuario = '$usuario' AND contrasinal = '$contrasinal'";
$validUsuarioYcontrasinal = mysqli_num_rows($conn_db->query($queryComprUsuario));

#Comprobación de se o usuario es válido ou non
if ($validUsuarioYcontrasinal != 1){
    header("Location: ./../../path/lock.php");
} else {

    #Comprobación se existe ou non a liña na táboa equipo_devolto
    $result = $conn_db->query("SELECT modelo FROM equipo_devolto WHERE modelo = '$modelo' AND usuario = '$usuario'");
    
    #Determinamos o número de filas do resultado
    $totalDevolto = $result->num_rows;

    #Insert na táboa equipos_devolto
    $consultaInsertDevolto = "INSERT INTO equipo_devolto VALUES ('$marca', '$cantidade', '$descripcion', '$modelo', '$foto', '$usuario')";
    
    #Update na táboa equipo_devolto
    $consultaUpdateDevolto = "UPDATE equipo_devolto SET cantidade = cantidade+$cantidade WHERE modelo = '$modelo' AND usuario = '$usuario'";

    #Delete na táboa equipo_alugado
    $consultaDeleteAlugado = "DELETE FROM equipo_alugado WHERE modelo = '$modelo' AND usuario = '$usuario'";

    #Se a cantidade non é 0, podemos facer cambios
    if($totalDevolto == 0){

        #Se non existe na táboa, facemos un Insert na táboa equipo_devolto e borramos unha unidade na táboa equipo_alugado
        $conn_db->query($consultaInsertDevolto);
        $conn_db->query($consultaDeleteAlugado);

        #Redirecionamos
        header("Location: ../../rented.php");
    }else{

        #Se existe na táboa, facemos un Update na táboa equipo_devolto e borramos unha unidade na táboa equipo_alugado
        $conn_db->query($consultaUpdateDevolto);
        $conn_db->query($consultaDeleteAlugado);

        #Redirecionamos
        header("Location: ../../rented.php");
    }
}
?>