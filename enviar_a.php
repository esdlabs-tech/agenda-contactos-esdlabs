<<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:index.php');
}
?>

<?php
// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Recogemos variables
    $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
    $telefono = isset($_REQUEST['telefono']) ? $_REQUEST['telefono'] : null;
    $correo = isset($_REQUEST['correo']) ? $_REQUEST['correo'] : null;
    // Variables
    $mysql_id = mysqli_connect('servidor', 'usuario', 'password');
    // Conecta con base de datos
if (mysqli_select_db ($mysql_id, 'NombreBBDD'))
{
   $ID= $_SESSION['ID'];
$result = mysqli_query($mysql_id, "INSERT INTO contactos (id_contacto, nombre, telefono, correo, id_usuario, visible) VALUES (NULL, '$nombre', '$telefono', '$correo', '$ID' , '1');");
}

    // Prepara INSERT
    
    // Redireccionamos a Leer
    header('Location: agenda.php');
}
?>
