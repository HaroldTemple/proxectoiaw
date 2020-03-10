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
$prezo=$_POST['prezo'];

#Conversor da data a castelán
include './../../../rsc/extra/dateConvertor.php';

#Consulta para verificar que iniciouse sesión. Se coincide a contrasinal e o usuario esperamos un 1, se non, un 0
$queryComprUsuario = "SELECT usuario, contrasinal FROM usuario WHERE usuario = '$usuario' AND contrasinal = '$contrasinal'";
$validUsuarioYcontrasinal = mysqli_num_rows($conn_db->query($queryComprUsuario));

#Comprobación de se o usuario es válido ou non
if ($validUsuarioYcontrasinal != 1){
    header("Location: ./../../path/lock.php");
} else {

    #Comprobamos se quedan unidades para ser vendidas
    $consultaTotalItem = $conn_db->query("SELECT cantidade FROM equipo_venda WHERE modelo = '$modelo'");
    $filaConsulta = $consultaTotalItem->fetch_assoc();
    $totalCantidade = $filaConsulta['cantidade'];

    #Comprobamos se existe ou non a liña na táboa equipo_alugado
    $result=$conn_db->query("SELECT modelo FROM equipo_alugado WHERE modelo = '$modelo' AND usuario = '$usuario'");

    #Determinamos o número de filas do resultado
    $totalVenda = $result->num_rows;
    
    #Delete na táboa equipos_alugado
    $consultaDeleteVenda = "UPDATE equipo_venda SET cantidade = cantidade-1 WHERE modelo = '$modelo'";

    #Se ainda quedan unidades a venda, podemos elaboara un ticket de venda
    if($totalCantidade > 0){
        #Composición da data
        $fecha=date('Y')."_".$meses[date('n')-1]."_".date('d')."_".$dias[date('w')];

        #Composición do nome do arquivo
        $composeName="informe_venda_$fecha.txt";
        $fileName = basename($composeName);
        $filePath = './'.$fileName;

        #Función apertura sitema de ficheiros [lectura]
        $fp=fopen($composeName, "w");

        #Consulta a toda a táboa
        $consulta="SELECT * FROM equipo_venda";
        $resultado = mysqli_query($conn_db, $consulta);

        #Calculamos el IVA y el precio con IVA
        $total=$prezo*1.21;
        $iva=$total-$prezo;

        #Inicialización dunha variable incremnetal
        $incremento=1;

        #Pintamos no arquivo o contido
echo"trebellos.gal

Data: $fecha

Usuario: $usuario

Producto:
    Marca - $marca
    Modelo - $modelo
    Descripción - $descripcion

Prezo sin IVA: $prezo €

IVA (21%): $iva €

Total: $total €
";

        #Executamos a orde de creación do arquivo e o eliminamos do servidor
        header("Content-Disposition: attachment; filename=$fileName");
        readfile($filePath);
        unlink($composeName);
        
        #Delete da táboa equipo_venda
        $conn_db->query($consultaDeleteVenda);

        #Pechamos a función do sistema de ficheiros
        fclose($fp);

        #Redirecionamos
        header("Refresh: 1; ../../sale.php");

        exit;

    #Se non quedan unidades a venda, non podemos elaboara un ticket de venda
    } else {

        #Redirecionamos
        header("Location: ../../sale.php");
    }
}