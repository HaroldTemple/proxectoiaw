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

    #Consuta a base de datos para obter a táboa novo_rexistro
    $consulta = mysqli_query($conn_db,"SELECT
        novo_rexistro.usuario AS subusuario,
        novo_rexistro.contrasinal,
        novo_rexistro.nome,
        novo_rexistro.direccion,
        novo_rexistro.telefono,
        novo_rexistro.nifdni
        FROM novo_rexistro");

    #Pintamos por pantalla as cabeceiras da táboa
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
                    <th>Usuario</th>
                    <th>Nome</th>
                    <th>Contrasinal</th>
                    <th>Enderezo</th>
                    <th>Teléfono</th>
                    <th>DNI</th>
                    <th class='text-center'>Un</th>
                    <th class='text-center'>Todos</th>
                </tr>
            </thead>
        </div>
    </div>
    ";

    #Mostramos usuario
    echo "
        <h1 class=\"text-center\">Lista de usuarios prerexistrados</h1>
        <h3 class=\"text-center\">Estás conectado como administrador <a>$usuario</a></h3>
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
                "<td>".$fila['subusuario']."</td>".
                "<td>".$fila['nome']."</td>".
                "<td>".$fila['contrasinal']."</td>".
                "<td>".$fila['direccion']."</td>".
                "<td>".$fila['telefono']."</td>".
                "<td>".$fila['nifdni']."</td>".
                "<td class='text-center'>".
                #Enviamos polo método POST e de xeito oculto as variable que precisamos
                #Farémolo para caso [tipo de usuario ('u' ou 'a') - forma (un a un ou todos á vez)]
                "<form action='../flow/nuevos_usuarios_once_tipo_user.php' method='post'>".
                    "<input type='hidden' name='subusuario' value=\"".$fila['subusuario']."\">".
                    "<input type='hidden' name='nome' value=\"".$fila['nome']."\">".
                    "<input type='hidden' name='contrasinal' value=\"".$fila['contrasinal']."\">".
                    "<input type='hidden' name='direccion' value=\"".$fila['direccion']."\">".
                    "<input type='hidden' name='telefono' value=\"".$fila['telefono']."\">".
                    "<input type='hidden' name='nifdni' value=\"".$fila['nifdni']."\">".
                    "<button class='btn btn-info btn-sm' type='submit'>".
                        "User".
                    "</button>".
                "</form>".
                "<form action='../flow/nuevos_usuarios_once_tipo_admin.php' method='post'>".
                    "<input type='hidden' name='subusuario' value=\"".$fila['subusuario']."\">".
                    "<input type='hidden' name='nome' value=\"".$fila['nome']."\">".
                    "<input type='hidden' name='contrasinal' value=\"".$fila['contrasinal']."\">".
                    "<input type='hidden' name='direccion' value=\"".$fila['direccion']."\">".
                    "<input type='hidden' name='telefono' value=\"".$fila['telefono']."\">".
                    "<input type='hidden' name='nifdni' value=\"".$fila['nifdni']."\">".
                    "<button class='btn btn-info btn-sm' type='submit'>".
                        "Admin".
                    "</button>".
                "</form>".
                "</td>".
                "<td class='text-center'>".
                "<form action='../flow/nuevos_usuarios_bulk_tipo_user.php' method='post'>".
                    "<input type='hidden' name='subusuario' value=\"".$fila['subusuario']."\">".
                    "<input type='hidden' name='nome' value=\"".$fila['nome']."\">".
                    "<input type='hidden' name='contrasinal' value=\"".$fila['contrasinal']."\">".
                    "<input type='hidden' name='direccion' value=\"".$fila['direccion']."\">".
                    "<input type='hidden' name='telefono' value=\"".$fila['telefono']."\">".
                    "<input type='hidden' name='nifdni' value=\"".$fila['nifdni']."\">".
                    "<button class='btn btn-info btn-sm' type='submit'>".
                        "User".
                    "</button>".
                "</form>".
                "<form action='../flow/nuevos_usuarios_bulk_tipo_admin.php' method='post'>".
                    "<input type='hidden' name='subusuario' value=\"".$fila['subusuario']."\">".
                    "<input type='hidden' name='nome' value=\"".$fila['nome']."\">".
                    "<input type='hidden' name='contrasinal' value=\"".$fila['contrasinal']."\">".
                    "<input type='hidden' name='direccion' value=\"".$fila['direccion']."\">".
                    "<input type='hidden' name='telefono' value=\"".$fila['telefono']."\">".
                    "<input type='hidden' name='nifdni' value=\"".$fila['nifdni']."\">".
                    "<button class='btn btn-info btn-sm' type='submit'>".
                        "Admin".
                    "</button>".
                "</form>".
                "</td>".
            "</tr>";
    }
    #No gallo de que non teñamos nada que amosar
    } else {
    echo "
        <link rel=\"stylesheet\" href=\"//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css\">
        <h1 class=\"text-center\">Lista de usuarios preregistrados</h1>
        <h3 class=\"text-center\">Estás conectado como administrador <a>$usuario</a></h3>
        <h1 class=\"text-success text-center\">No hay contenido que amosar</h1>
    ";
    }
}
?>