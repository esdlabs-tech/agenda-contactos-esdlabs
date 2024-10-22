<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_contacto = trim($_REQUEST['Id_contacto']);
    $nombre = trim($_REQUEST['nombre']);
     $telefono = trim($_REQUEST['telefono']);
      $correo = trim($_REQUEST['correo']);
    

?>

<?php

$mysql_id = mysqli_connect('servidor', 'Usuario', 'Password');


   

    if (mysqli_select_db($mysql_id, 'NombreBBDD')) {

        $result = mysqli_query($mysql_id, "UPDATE contactos SET nombre = '$nombre',telefono = '$telefono',correo = '$correo' WHERE contactos.id_contacto = $id_contacto;");

        header('Location: agenda.php');
}}
?>
