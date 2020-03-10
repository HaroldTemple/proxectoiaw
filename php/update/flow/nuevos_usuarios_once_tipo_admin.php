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
    
    #Insert na táboa usuario
    #Neste caso o usuario será de tipo Administrador ['a'] na táboa usuario
    $consultaInsertUsuario="INSERT
        INTO usuario (usuario, contrasinal, nome, direccion, telefono, nifdni, tipo_usuario)
        VALUES ('$subusuario', '$contrasinal', '$nome', '$direccion', '$telefono', '$nifdni', 'a')";
    
    #Delete na táboa novo_rexistro
    $consultaDeleteNovoRexistro = "DELETE FROM novo_rexistro WHERE usuario = '$subusuario'";

    #Iniciamos a lóxica
    if ($consultaInsertUsuario){

        #Executamos o Insert
        $conn_db->query($consultaInsertUsuario);
        if ($consultaDeleteNovoRexistro){

            #Executamos o Delete
            $conn_db->query($consultaDeleteNovoRexistro);
        }

        #Redireccionamos
        header("Location: ../admin_panel/nuevos_registros.php");
    }
}
?>