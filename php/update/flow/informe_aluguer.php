<?php
#Inicio de sesión
include './../../session/start.php';

#Conexión á base de datos
include './../../session/db.php';

#Conversor da data a castelán
include './../../../rsc/extra/dateConvertor.php';

#Consulta para verificar que iniciouse sesión. Se coincide a contrasinal e o usuario esperamos un 1, se non, un 0
$queryComprUsuario = "SELECT usuario, contrasinal FROM usuario WHERE usuario = '$usuario' AND contrasinal = '$contrasinal'";
$validUsuarioYcontrasinal = mysqli_num_rows($conn_db->query($queryComprUsuario));

#Comprobación de se o usuario é válido ou non
if ($validUsuarioYcontrasinal != 1){
    header("Location: ./../../path/lock.php");
} else {

    #Composición da data
    $fecha=date('Y')."_".$meses[date('n')-1]."_".date('d')."_".$dias[date('w')];

    #Composición do nome do arquivo
    $composeName="informe_aluguer_$fecha.txt";
    $fileName = basename($composeName);
    $filePath = './'.$fileName;

    #Función apertura sitema de ficheiros [lectura]
    $fp=fopen($composeName, "w");

    #Consulta a toda a táboa
    $consulta="SELECT * FROM equipo_aluguer";
    $resultado = mysqli_query($conn_db, $consulta);

    #Inicialización dunha variable incremnetal
    $incremento=1;

    #Pintamos no arquivo o contido
echo"trebellos.gal
           
Listado de instrumentos en aluguer a fecha $fecha
        
Informe leaborado por el usuario: $usuario
    ";

    #Xeramos o contido formateado de cada fila
    while($rows=mysqli_fetch_array($resultado)){
        echo "\n".$incremento."\n";
        echo "\t"."Marca: ".$rows[0]."\n";
        echo "\t"."Modelo: ".$rows[3]."\n";
        echo "\t"."Descripción: ".$rows[2]."\n";
        echo "\t"."Cantidade: ".$rows[1]."\n";
        echo "\t"."Prezo: ".$rows[4]."\n";
    $incremento++;
    }

    #Executamos a orde de creación do arquivo e o eliminamos do servidor
    header("Content-Disposition: attachment; filename=$fileName");
    readfile($filePath);
    unlink($composeName);

    #Pechamos a función do sistema de ficheiros
    fclose($fp);

    #Redirecionamos
    header("Location; ../../../../menu.php");
    exit;
}
?>