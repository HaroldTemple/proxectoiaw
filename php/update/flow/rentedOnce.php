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

    #Comprobamos se quedan unidades para ser alugadas, se non, non se pode facer Update, se sí, face Update na táboa equipo_aluguer
    #Quedámonos co valor 'cantidade'
    $consultaTotalItem = $conn_db->query("SELECT cantidade FROM equipo_alugado WHERE modelo = '$modelo' AND usuario = '$usuario'");
    $filaConsulta = $consultaTotalItem->fetch_assoc();
    $totalCantidade = $filaConsulta['cantidade'];

    #Insert na táboa equipo_devolto
    $consultaInsertDevolto = "INSERT INTO equipo_devolto VALUES ('$marca', '1', '$descripcion', '$modelo', '$foto', '$usuario')";
    
    #Update na táboa equipo_devolto
    $consultaUpdateDevolto = "UPDATE equipo_devolto SET cantidade = cantidade+1 WHERE modelo = '$modelo' AND usuario = '$usuario'";

    #Update na táboa equipo_alugado
    $consultaUpdateAlugado = "UPDATE equipo_alugado SET cantidade = cantidade-1 WHERE modelo = '$modelo' AND usuario = '$usuario'";

    #Delete na táboa equipo_alugado
    $consultaDeleteAlugado = "DELETE FROM equipo_alugado WHERE modelo = '$modelo' AND usuario = '$usuario'";

    #Se a cantidade non é 0, podemos facer cambios
    if($totalCantidade > 1){

        #Se non existe na táboa, facemos un Insert na táboa equipo_devolto
        if($totalDevolto == 0){
            $conn_db->query($consultaInsertDevolto);

        #Se existe na táboa, facemos un Update na táboa equipo_devolto
        }else{
            $conn_db->query($consultaUpdateDevolto);
        }
        #Facemos un Update na táboa alugado restando así unha unidade
        $conn_db->query($consultaUpdateAlugado);

        #Redirecionamos
        header("Location: ../../rented.php");

    }else{
        $conn_db->query($consultaUpdateDevolto);
        $conn_db->query($consultaDeleteAlugado);

        #Redirecionamos
        header("Location: ../../rented.php");
    }
}
?>