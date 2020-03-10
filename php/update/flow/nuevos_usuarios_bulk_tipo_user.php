<?php
#Captura de variables
$subusuario=$_POST['subusuario'];
$nome=$_POST['nome'];
$contrasinal=$_POST['contrasinal'];
$direccion=$_POST['direccion'];
$telefono=$_POST['telefono'];
$nifdni=$_POST['nifdni'];

#Inicio de sesion
session_start();
$usuario=$_SESSION['usuario'];
$contrasinal=$_SESSION['contrasinal'];

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

#Consulta para verificar que iniciouse sesión. Se coincide a contrasinal e o usuario esperamos un 1, se non, un 0
$queryComprUsuario="SELECT usuario,contrasinal FROM usuario WHERE usuario='$usuario' AND contrasinal='$contrasinal'";
$validUsuarioYcontrasinal=mysqli_num_rows($conn_db->query($queryComprUsuario));//Si coincide la contraseña y el usuario esperamos un 1, si no, un 0

#Comporbamos si se ha iniciado sesión
if($validUsuarioYcontrasinal != 1){
    header("Location: path/lock.php");
}else{

    #Consulta táboa novo_rexistro na fila usuario
    $resultado = mysqli_query($conn_db, "SELECT usuario FROM novo_rexistro");

    #Inicamos array para engadir todos os usuarios atopados
    $listaUsuarios=array();
    
    #Alimentamos o array cos usuarios atopados
    while ($row = mysqli_fetch_array($resultado)) {
        array_push($listaUsuarios, $row[0]);  
    }

    #Obtemos o largo do array para determinar o ciclo que empregaremos despois
    $largoListaUsuarios=sizeof($listaUsuarios);

    #Delete (truncar) toda a táboa novo_rexistro xa que introduciremos todos os usuarios
    $consultaTruncarNovoRexistro="DELETE FROM novo_rexistro";

    #Iniciamos a lóxica
    if($resultado){

        #Iniciamos unha variable incremental
        $incremento = 0;

        #Neste bucle faremos un Insert por cada usuario
        while($incremento < $largoListaUsuarios){

            #Neste caso os usuarios serán de tipo Usuario ['u'] na táboa usuario
            $consultaInsertUsuario="INSERT
                INTO usuario (usuario, contrasinal, nome, direccion, telefono, nifdni, tipo_usuario)
                VALUES ('$listaUsuarios[$incremento]', '$contrasinal', '$nome', '$direccion', '$telefono', '$nifdni', 'u')";

                #Executamos o Insert
                $conn_db->query($consultaInsertUsuario);
                $incremento++;
        }

        #Executamos o Delete
        $conn_db->query($consultaTruncarNovoRexistro);

        #Redireccionamos
        header("Location: ../admin_panel/nuevos_registros.php");
    }
}
?>