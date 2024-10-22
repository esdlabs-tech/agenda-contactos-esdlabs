<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_contacto = trim($_REQUEST['Id_contacto']);
  
    $id_usuario = trim($_REQUEST['ID']);
}
?>

<?php

$mysql_id = mysqli_connect('Servidor', 'Usuario', 'Password');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepara UPDATE

    if (mysqli_select_db($mysql_id, 'NombreBBDD')) {

        $result = mysqli_query($mysql_id, "UPDATE contactos SET visible = '0' WHERE contactos.id_contacto = $id_contacto;");

        header('Location: agenda.php');
    }
}
?>
