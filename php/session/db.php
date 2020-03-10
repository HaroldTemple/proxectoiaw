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
?>