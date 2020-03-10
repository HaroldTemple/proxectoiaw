<?php
#Inicio de sesión
include './../php/session/start.php';

#Conexión á base de datos
include './../php/session/db.php';

#Consulta para verificar que iniciouse sesión. Se coincide a contrasinal e o usuario esperamos un 1, se non, un 0
$queryComprUsuario = "SELECT usuario, contrasinal FROM usuario WHERE usuario = '$usuario' AND contrasinal = '$contrasinal'";
$validUsuarioYcontrasinal = mysqli_num_rows($conn_db->query($queryComprUsuario));

#Comprobación de se o usuario es válido ou non
if ($validUsuarioYcontrasinal != 1){
    header("Location: ./../../path/lock.php");
} else {

    #Barra de navegación (en este caso engadímola aquí por una probla coas rutas)
    echo "<link rel = \"stylesheet\" href = \"https://fonts.googleapis.com/icon?family=Material+Icons\">
    <link rel = \"stylesheet\" href = \"https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css\">
    <script type = \"text/javascript\" src = \"https://code.jquery.com/jquery-2.1.1.min.js\"></script>           
    <script src = \"https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js\"></script> ";
    echo "
        <nav>
        <div class=\"nav-wrapper blue-grey darken-2\">
        <a href=\".0/menu.php\" class=\"brand-logo left\">Trebellos</a>
        <ul class=\"right\">
            <li><a href=\"./usuario.php\">Usuario</a></li>
            <li><a href=\"./menu.php\">Menú</a></li>
            <li><a href=\"./session/close.php\">Pechar sesión</a></li>
        </ul>
        </div>
        </nav>
        <a class = \"btn dropdown-button\" data-activates = \"dropdown0\">Xestión<i class = \"mdi-navigation-arrow-drop-down right\"></i></a>
        <ul id = \"dropdown0\" class = \"dropdown-content\">
            <li><a href=\"./../php/update/admin_panel/nuevos_registros.php\">Administrar novos rexistros</a></li>
            <li class=\"divider\"></li>
            <li><a href=\"./returnedAdmin.php\">Xestionar devolucións</a></li>
        </ul>
        <a class = \"btn dropdown-button\" data-activates = \"dropdown1\">Aluguer<i class = \"mdi-navigation-arrow-drop-down right\"></i></a>
        <ul id = \"dropdown1\" class = \"dropdown-content\">
            <li><a href=\"./../php/update/admin_panel/nuevo_instrumento_aluguer.php\">Engadir</a></li>
            <li class=\"divider\"></li>
            <li><a href=\"./../php/update/admin_panel/eliminar_instrumento_aluguer.php\">Eliminar</a></li>
            <li class=\"divider\"></li>
            <li><a href=\"./../php/update/admin_panel/modificar_instrumento_aluguer.php\">Modificar</a></li>
        </ul>
        <a class = \"btn dropdown-button\" data-activates = \"dropdown2\">Venda<i class = \"mdi-navigation-arrow-drop-down right\"></i></a>
        <ul id = \"dropdown2\" class = \"dropdown-content\">
            <li><a href=\"./../php/update/admin_panel/nuevo_instrumento_venda.php\">Engadir</a></li>
            <li class=\"divider\"></li>
            <li><a href=\"./../php/update/admin_panel/eliminar_instrumento_venda.php\">Eliminar</a></li>
            <li class=\"divider\"></li>
            <li><a href=\"./../php/update/admin_panel/modificar_instrumento_venda.php\">Modificar</a></li>
        </ul>
        <a class = \"btn dropdown-button\" data-activates = \"dropdown3\">Informes<i class = \"mdi-navigation-arrow-drop-down right\"></i></a>
        <ul id = \"dropdown3\" class = \"dropdown-content\">
            <li><a href=\"./../php/update/flow/informe_aluguer.php\">Informe</a></li>
            <li class=\"divider\"></li>
            <li><a href=\"./../php/update/flow/informe_venda.php\">Informe</a></li>
        </ul>
  ";
    #Consuta á base de datos para obter a táboa equipo_devolto (sen condicional WHERE porque ten que verse todos)
    $consulta = mysqli_query($conn_db,
        "SELECT equipo_devolto.marca,
                equipo_devolto.cantidade,
                equipo_devolto.descripcion,
                equipo_devolto.modelo,
                equipo_devolto.foto,
                equipo_devolto.usuario,
                equipo_aluguer.prezo
        FROM equipo_devolto
        JOIN equipo_aluguer
        ON equipo_devolto.modelo=equipo_aluguer.modelo"
    );

    #Obter número de filas da táboa
    $numeroFilas = mysqli_num_rows($consulta);

    #Quedan elementos que mostrar na táboa equipo_devolto
    if($numeroFilas != 0){

        #Pintamos por pantalla os elementos da táboa devolto
        echo "
            <div class='container'>
                <div class='row col-md-6 col-md-offset-2 custyle'>
                    <table class='table table-striped custab'>
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Descripción</th>
                            <th>Cantidade</th>
                            <th>Imaxe</th>
                            <th class='text-center'>Validación</th>
                        </tr>
                    </thead>
                </div>
            </div>
        ";

        #Mostramos usuario
        echo "
            <h1 class=\"text-center\">Lista de equipamento devolto</h1>
            <h3 class=\"text-center\">Estás conectado como <a>$usuario</a></h3>
            <p><h6 class=\"text-center\">Número total de filas: $numeroFilas</h6>";
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
                    "<td>".$fila['usuario']."</td>".
                    "<td>".$fila['marca']."</td>".
                    "<td>".$fila['modelo']."</td>".
                    "<td>".$fila['descripcion']."</td>".
                    "<td>".$fila['cantidade']."</td>".
                    "<td><img width='120' height='120' src=".$fila['foto']."></td>".
                    "<td class='text-center'>".
                    #Enviamos polo método POST e de xeito oculto as variable que precisamos no modo Todos
                    "<form action='update/flow/returnedAdminBulk.php' method='post'>".
                        "<input type='hidden' name='cantidade' value=\"".$fila['cantidade']."\">".
                        "<input type='hidden' name='modelo' value=\"".$fila['modelo']."\">".
                        "<input type='hidden' name='marca' value=\"".$fila['marca']."\">".
                        "<input type='hidden' name='foto' value=\"".$fila['foto']."\">".
                        "<input type='hidden' name='prezo' value=\"".$fila['prezo']."\">".
                        "<input type='hidden' name='subusuario' value=\"".$fila['usuario']."\">".
                        "<input type='hidden' name='descripcion' value=\"".$fila['descripcion']."\">".
                        "<button class='btn btn-info btn-xs' type='submit'>".
                            "Todos ".
                            "<span class='glyphicon glyphicon-tag'></span>".
                        "</button>".
                    "</form>".
                    #Enviamos polo método POST e de xeito oculto as variable que precisamos no modo 1 a 1
                    "<form action='update/flow/returnedAdminOnce.php' method='post'>".
                        "<input type='hidden' name='cantidade' value=\"".$fila['cantidade']."\">".
                        "<input type='hidden' name='modelo' value=\"".$fila['modelo']."\">".
                        "<input type='hidden' name='marca' value=\"".$fila['marca']."\">".
                        "<input type='hidden' name='foto' value=\"".$fila['foto']."\">".
                        "<input type='hidden' name='prezo' value=\"".$fila['prezo']."\">".
                        "<input type='hidden' name='subusuario' value=\"".$fila['usuario']."\">".
                        "<input type='hidden' name='descripcion' value=\"".$fila['descripcion']."\">".
                        "<button class='btn btn-info btn-xs' type='submit'>".
                            "1 en 1 ".
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
                <h1 class=\"text-center\">Lista de equipamento devolto</h1>
                <h3 class=\"text-center\">Estás conectado como <a>$usuario</a></h3>
                <h1 class=\"text-success text-center\">No hai contenido que amosar</h1>
            ";        
        }
}
?>