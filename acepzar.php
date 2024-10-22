<?php

echo $acepzar =  filter_input(INPUT_POST, 'acepzar', FILTER_SANITIZE_NUMBER_INT);
echo "<br>";
echo $id_notificacion =  isset($_POST['id_notificacion']) ? htmlspecialchars($_POST['id_notificacion']): '';;
echo "<br>";
echo $idContacto =  isset($_POST['id_contacto']) ? htmlspecialchars($_POST['id_contacto']): '';;
$conn = mysqli_connect("servidor", "Usuario", "Password", "NombreBBDD");

// Assuming $conn is your database connection

// Escape the $id_notificacion variable to prevent SQL injection
$id_notificacion = mysqli_real_escape_string($conn, $id_notificacion);

// Construct the SQL query
$sqlComparte = "UPDATE `notificaciones` SET `visto` = '1' WHERE `id` = '$id_notificacion'";

// Execute the query and handle errors
if(mysqli_query($conn, $sqlComparte)) {
    echo "Notification marked as seen successfully.";
} else {
    // If there's an error, print it
    echo "Error updating notification: " . mysqli_error($conn);
}


$sqlComparte2 = "UPDATE comparte SET aceptado = $acepzar WHERE id_share = $id_notificacion";
$result2 = mysqli_query($conn, $sqlComparte2);


header('Location: agenda.php');


 

