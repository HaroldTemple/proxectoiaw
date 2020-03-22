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

#Consulta para verificar que iniciouse sesión. Se coincide a contrasinal e o usuario esperamos un 1, se non, un 0
$queryComprUsuario = "SELECT usuario, contrasinal FROM usuario WHERE usuario = '$usuario' AND contrasinal = '$contrasinal'";
$validUsuarioYcontrasinal = mysqli_num_rows($conn_db->query($queryComprUsuario));

#Comprobación de se o usuario es válido ou non
if ($validUsuarioYcontrasinal != 1){
    header("Location: ./../../path/lock.php");
} else {

    #Comprobamos se quedan unidades para ser alugadas, se non, non se pode facer Update, se sí, face Update na táboa equipo_aluguer
    #Quedámonos co valor 'cantidade'
    $consultaTotalItem = $conn_db->query("SELECT cantidade FROM equipo_aluguer WHERE modelo = '$modelo'");
    $filaConsulta = $consultaTotalItem->fetch_assoc();
    $totalCantidade = $filaConsulta['cantidade'];

    #Redefinimos a cantidade restándole unha unidade
    $nuevaCantidade = $cantidade-1;

    #Update na táboa equipo_aluguer
    $consultaUpdateAluguer = "UPDATE equipo_aluguer SET cantidade = '$nuevaCantidade' WHERE modelo = '$modelo'";

    #Comprobamos se existe ou non a línea na táboa equipo_alugado para averiguar se temos que facer un Insert ou un Update
    $result = $conn_db->query("SELECT modelo FROM equipo_alugado WHERE modelo = '$modelo' AND usuario = '$usuario'");

    #Determinamos o número de filas do resultado
    $totalAlugado = $result->num_rows;

    #Insert na táboa equipos_alugado
    $consultaInsertAlugado = "INSERT INTO equipo_alugado (marca, cantidade, descripcion, modelo, foto, usuario) VALUES ('$marca', '1', '$descripcion', '$modelo', '$foto', '$usuario')";
    
    #Insert na táboa equipos_alugado
    $consultaUpdatetAlugado = "UPDATE equipo_alugado SET cantidade = cantidade+1 WHERE modelo = '$modelo' AND usuario = '$usuario'";

    #Se a cantidade non é 0, podemos facer cambios
    if($totalCantidade > 0){

        #Se non existe na táboa, facemos un Insert na táboa equipo_alugado e restamos unha unidade na táboa equipo_aluguer
        if ($totalAlugado == 0 ){
            $conn_db->query($consultaUpdateAluguer);
            $conn_db->query($consultaInsertAlugado);

            #Redirecionamos
            header("Location: ../../rent.php");

            #Se existe na táboa, facemos un Update na táboa equipo_alugado e restamos unha unidade na táboa equipo_aluguer
            }else{
                $conn_db->query($consultaUpdateAluguer);
                $conn_db->query($consultaUpdatetAlugado);

                #Redirecionamos
                header("Location: ../../rent.php");
            }
    
    #Se a cantidade é 0, non podemos facer cambios
    }else{
    
        #Redirecionamos
        header("Location: ../../rent.php");
    }
}
?>