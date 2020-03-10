<?php
#Variables da conexión á base de datos
$host_db = 'localhost';
$usuario_db = 'root';
$contrasinal_db = '';
$nome_db = 'equipamentos';

#Conexión coa base de datos, almacenamos o resultado nunha variable para o seu posterior uso
$conn_db = new mysqli($host_db, $usuario_db, $contrasinal_db, $nome_db);

#Comprobación da conexión contra á base de datos. Se non é correcta avísanos e nos sinala o error
if ($conn_db->connect_errno) {
    echo 'Fallo da conexión contra á base de datos: ' . $conn_db->connect_error;
}/*else {
 echo 'Base de datos conectada correctamente.';
}*/

#Comprobamos se é Usuario ['u']
$consultaTipo = $conn_db->query("SELECT tipo_usuario FROM usuario WHERE usuario = '$usuario'");
$filaConsulta = $consultaTipo->fetch_assoc();
$tipo = $filaConsulta['tipo_usuario'];

#Comprobación de que tipo de usuario é
##Se he Usuario ['u']
if ($tipo == 'u'){
  echo "<link rel = \"stylesheet\" href = \"https://fonts.googleapis.com/icon?family=Material+Icons\">
        <link rel = \"stylesheet\" href = \"https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css\">
        <script type = \"text/javascript\" src = \"https://code.jquery.com/jquery-2.1.1.min.js\"></script>           
        <script src = \"https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js\"></script> ";
  echo "
    <nav>
    <div class=\"nav-wrapper blue-grey darken-2\">
      <a href=\"./menu.php\" class=\"brand-logo left\">Trebellos</a>
      <ul id=\"nav-mobile\" class=\"right\">
        <li><a href=\"./rent.php\">Aluguer</a></li>
        <li><a href=\"./rented.php\">Alugado</a></li>
        <li><a href=\"./returnedUser.php\">Devolto</a></li>
        <li><a href=\"./sale.php\">Venda</a></li>
        <li><a href=\"./usuario.php\">Usuario</a></li>
        <li><a href=\"./menu.php\">Menú</a></li>
        <li><a href=\"./../php/session/close.php\">Pechar sesión</a></li>
      </ul>
    </div>
    </nav>
  ";
} elseif ($tipo == 'a') {
  echo "<link rel = \"stylesheet\" href = \"https://fonts.googleapis.com/icon?family=Material+Icons\">
        <link rel = \"stylesheet\" href = \"https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css\">
        <script type = \"text/javascript\" src = \"https://code.jquery.com/jquery-2.1.1.min.js\"></script>           
        <script src = \"https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js\"></script> ";
  echo "
    <nav>
    <div class=\"nav-wrapper blue-grey darken-2\">
      <a href=\"./../../menu.php\" class=\"brand-logo left\">Trebellos</a>
      <ul class=\"right\">
        <li><a href=\"./../../usuario.php\">Usuario</a></li>
        <li><a href=\"./../../menu.php\">Menú</a></li>
        <li><a href=\"./../../session/close.php\">Pechar sesión</a></li>
      </ul>
    </div>
    </nav>
      <a class = \"btn dropdown-button\" data-activates = \"dropdown0\">Xestión<i class = \"mdi-navigation-arrow-drop-down right\"></i></a>
      <ul id = \"dropdown0\" class = \"dropdown-content\">
        <li><a href=\"./../admin_panel/nuevos_registros.php\">Admin novos rexistros</a></li>
        <li class=\"divider\"></li>
        <li><a href=\"./../../returnedAdmin.php\">Xestionar devolucións</a></li>
      </ul>
      <a class = \"btn dropdown-button\" data-activates = \"dropdown1\">Aluguer<i class = \"mdi-navigation-arrow-drop-down right\"></i></a>
      <ul id = \"dropdown1\" class = \"dropdown-content\">
        <li><a href=\"./../admin_panel/nuevo_instrumento_aluguer.php\">Engadir</a></li>
        <li class=\"divider\"></li>
        <li><a href=\"./../admin_panel/eliminar_instrumento_aluguer.php\">Eliminar</a></li>
        <li class=\"divider\"></li>
        <li><a href=\"./../admin_panel/modificar_instrumento_aluguer.php\">Modificar</a></li>
      </ul>
      <a class = \"btn dropdown-button\" data-activates = \"dropdown2\">Venda<i class = \"mdi-navigation-arrow-drop-down right\"></i></a>
      <ul id = \"dropdown2\" class = \"dropdown-content\">
        <li><a href=\"./../admin_panel/nuevo_instrumento_venda.php\">Engadir</a></li>
        <li class=\"divider\"></li>
        <li><a href=\"./../admin_panel/eliminar_instrumento_venda.php\">Eliminar</a></li>
        <li class=\"divider\"></li>
        <li><a href=\"./../admin_panel/modificar_instrumento_venda.php\">Modificar</a></li>
      </ul>
      <a class = \"btn dropdown-button\" data-activates = \"dropdown3\">Informes<i class = \"mdi-navigation-arrow-drop-down right\"></i></a>
      <ul id = \"dropdown3\" class = \"dropdown-content\">
        <li><a href=\"./../flow/informe_aluguer.php\">Informe</a></li>
        <li class=\"divider\"></li>
        <li><a href=\"./../flow/informe_venda.php\">Informe</a></li>
      </ul>
  ";
}
?>