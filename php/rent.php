<?php
#Inicio de sesión
include './../php/session/start.php';

#Conexión á base de datos
include './../php/session/db.php';

#Consulta para verificar que iniciouse sesión. Se coincide a contrasinal e o usuario esperamos un 1, se non, un 0
$queryComprUsuario = "SELECT usuario, contrasinal FROM usuario WHERE usuario = '$usuario' AND contrasinal = '$contrasinal'";
$validUsuarioYcontrasinal = mysqli_num_rows($conn_db->query($queryComprUsuario));

#Comprobación de si el usuario es válido o no
if($validUsuarioYcontrasinal != 1){
    header("Location: ../../../path/lock.php");
}else{

    #Barra de navegación
    include '../templates/navbar.php';

    #Consuta á base de datos para obter a táboa equipos_aluguer
    $consulta = mysqli_query($conn_db, "SELECT * FROM equipo_aluguer");

    #Obetemos número de filas da táboa
    $numeroFilas = mysqli_num_rows($consulta);

    #Quedan elementos que mostrar na táboa equipo_aluguer
    if($numeroFilas != 0){

    #Pintamos por pantalla os elementos da táboa aluguer
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
                        <th class='text-center'>Alugar</th>
                    </tr>
                </thead>
            </div>
        </div>
        ";

        #Mostrar usuario
        echo "
            <h1 class=\"text-center\">Lista de equipamiento en aluguer</h1>
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

        #Listamos instrumentos en venda
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
                    "<form action='update/flow/rent.php' method='post'>".
                        "<input type='hidden' name='cantidade' value=\"".$fila['cantidade']."\">".
                        "<input type='hidden' name='modelo' value=\"".$fila['modelo']."\">".
                        "<input type='hidden' name='marca' value=\"".$fila['marca']."\">".
                        "<input type='hidden' name='foto' value=\"".$fila['foto']."\">".
                        "<input type='hidden' name='prezo' value=\"".$fila['prezo']."\">".
                        "<input type='hidden' name='descripcion' value=\"".$fila['descripcion']."\">".
                        "<button class='btn btn-info btn-xs' type='submit'>".
                            "Alugar ".
                            "<span class='glyphicon glyphicon-tag'></span>".
                        "</button>".
                    "</form>".
                    "</td>".
                "</tr>";
        }
        #No gallo de que non teñamos nada que amosar
        }else{
            echo "
                <link rel=\"stylesheet\" href=\"//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css\">
                <h1 class=\"text-center\">Lista de equipamiento en aluguer</h1>
                <h3 class=\"text-center\">Estás conectado como <a>$usuario</a></h3>
                <h1 class=\"text-success text-center\">Non hai contido que amosar</h1>
            ";
        }
}
?>