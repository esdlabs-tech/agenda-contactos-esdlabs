<?php

// Conexión a la DB
$conn = mysqli_connect("Servidor", "Usuario", "Password", "NombreBBDD");

// Validar y sanitizar input
$contact_id = (int)filter_input(INPUT_POST, 'contact_id', FILTER_SANITIZE_NUMBER_INT);
$shared_user_id = (int)filter_input(INPUT_POST, 'shared_user_id', FILTER_SANITIZE_NUMBER_INT);

// Chequea si el usuario tiene permiso para compartir
$current_user_id = $_SESSION['ID'];
$is_authorized = isAuthorizedToShare($contact_id, $current_user_id); // Replace with your authorization function

if ($is_authorized) {
    $sql = "UPDATE Contacts SET user_id = ? WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $shared_user_id, $contact_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Contacto compartido
            echo "Contacto compartido!"; 
        } else {
            echo "Error compartiendo: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
} else {
    echo "No estás autorizado para compartir.";
}

mysqli_close($conn);

?>

