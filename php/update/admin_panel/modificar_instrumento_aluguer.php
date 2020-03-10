<?php
#Inicio de sesión
include './../../session/start.php';

#Conexión á base de datos
include './../../session/db.php';

#Consulta para verificar que iniciouse sesión. Se coincide a contrasinal e o usuario esperamos un 1, se non, un 0
$queryComprUsuario = "SELECT usuario, contrasinal FROM usuario WHERE usuario = '$usuario' AND contrasinal = '$contrasinal'";
$validUsuarioYcontrasinal = mysqli_num_rows($conn_db->query($queryComprUsuario));

#Comprobación de se o usuario es válido ou non
if ($validUsuarioYcontrasinal != 1){
    header("Location: ./../../path/lock.php");
} else {
    include './../../../templates/navbar.php';

    #Consuta a base de datos para obter a táboa equipos_aluguer
    $consulta = mysqli_query($conn_db, "SELECT * FROM equipo_aluguer");

    #Obter número de filas da táboa
    $numeroFilas = mysqli_num_rows($consulta);
    if ($numeroFilas != 0){

    #Pintamos por pantalla as cabeceiras da táboa
    echo "
    <div class='container'>
        <div class='row col-md-6 col-md-offset-2 custyle'>
            <table class='table table-striped custab'>
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Descripción</th>
                    <th>Prezo</th>
                    <th>Cantidade</th>
                    <th>Imaxe</th>
                    <th class='text-center'>Modificar</th>
                </tr>
            </thead>
        </div>
    </div>
    ";

    #Mostrar usuario
    echo "
        <h1 class=\"text-center\">Lista de equipamiento en aluguer para modificar</h1>
        <h3 class=\"text-center\">Estás conectado como <a>$usuario</a></h3>
        <p><h6 class=\"text-center\">Número total de filas: $numeroFilas</h6></p>
    ";
    echo "</br>";
    echo "</br>";

    #Creación dun array coas filas da táboa
    $filas = array();
    while ($fila = mysqli_fetch_array($consulta)){
        $filas[] = $fila;

        #Ordenación do array por orden alfabético
        asort($filas);
    }

    #Creación dun array para encher as columnas
    $cantidades = array();
    $i = 0;
    $posicion = 0;

    #Listamos instrumentos en aluguer
    foreach ($filas as $fila){
        array_push($cantidades, $filas[$i][1]);
        $i = $i+1;
        $_SESSION['cantidades'] = $cantidades;

        #Recoremos cada unha das filas
        echo
            "<tr>".
                "<td>".$fila['marca']."</td>".
                "<td>".$fila['modelo']."</td>".
                "<td>".$fila['descripcion']."</td>".
                "<td>".$fila['prezo']."</td>".
                "<td>".$fila['cantidade']."</td>".
                "<td><img width='120' height='120' src=".$fila['foto']."></td>".
                "<td class='text-center'>".
                #Enviamos polo método POST e de xeito oculto as variable que precisamos
                "<form action='../flow/modificar_instrumento_aluguer.php' method='post'>".
                    "<input type='hidden' name='cantidade' value=\"".$fila['cantidade']."\">".
                    #Como extra precisamos enviar dous valores con outro nome para que non entren en colisión
                    "<input type='hidden' name='submodelo' value=\"".$fila['modelo']."\">".
                    "<input type='hidden' name='submarca' value=\"".$fila['marca']."\">".
                    "<input type='hidden' name='modelo' value=\"".$fila['modelo']."\">".
                    "<input type='hidden' name='marca' value=\"".$fila['marca']."\">".
                    "<input type='hidden' name='foto' value=\"".$fila['foto']."\">".
                    "<input type='hidden' name='prezo' value=\"".$fila['prezo']."\">".
                    "<input type='hidden' name='descripcion' value=\"".$fila['descripcion']."\">".
                    "<button class='btn btn-info btn-xs' type='submit'>".
                        "Modificar ".
                        "<span class='glyphicon glyphicon-tag'></span>".
                    "</button>".
                "</form>".
                "</td>".
            "</tr>";
    }
    #No gallo de que non teñamos nada que mostrar
    }else{
        echo "
        <link rel=\"stylesheet\" href=\"//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css\">
        <h1 class=\"text-center\">Lista de equipamiento en aluguer para modificar</h1>
        <h3 class=\"text-center\">Estás conectado como <a>$usuario</a></h3>
        <h1 class=\"text-success text-center\">No hai contido que mostrar</h1>
    ";
    }
}
?>