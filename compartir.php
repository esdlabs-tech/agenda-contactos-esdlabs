<?php
session_start();

$conn = mysqli_connect("Servidor", "Usuario", "Password", "NombreBBDD");

// validar y sanear inputs
$idContacto = filter_input(INPUT_GET, 'id_contacto', FILTER_SANITIZE_NUMBER_INT);
$idUsuarioDestino = filter_input(INPUT_GET, 'id_usuario_destino', FILTER_SANITIZE_NUMBER_INT);

$currentUserId = $_SESSION['ID'];

$sqlComparte = "INSERT INTO comparte (id_contacto, id_usuario_origen, id_usuario_destino)
                VALUES (?, ?, ?)";
$stmtComparte = mysqli_prepare($conn, $sqlComparte);

if ($stmtComparte) {
    mysqli_stmt_bind_param($stmtComparte, "iii", $idContacto, $currentUserId, $idUsuarioDestino);
    $successComparte = mysqli_stmt_execute($stmtComparte);
    mysqli_stmt_close($stmtComparte);
} else {
    $successComparte = false;
}

if ($successComparte) {
    // Obtener el nombre del usuario que comparte el contacto
    $sqlNombreUsuario = "SELECT Login FROM usuario WHERE id_usuario = ?";
    $stmtNombreUsuario = mysqli_prepare($conn, $sqlNombreUsuario);


    if ($stmtNombreUsuario) {
        mysqli_stmt_bind_param($stmtNombreUsuario, "i", $currentUserId);
        mysqli_stmt_execute($stmtNombreUsuario);
        mysqli_stmt_bind_result($stmtNombreUsuario, $nombreUsuario);
        mysqli_stmt_fetch($stmtNombreUsuario);
        mysqli_stmt_close($stmtNombreUsuario);
    } else {
        $nombreUsuario = "Usuario desconocido";
    }

    // Creamos el mensaje para la notificación
    $mensaje = "Has recibido un nuevo contacto de $nombreUsuario.";

    $sql = "INSERT INTO notificaciones (id_usuario_destino, mensaje, id_contacto, visto) VALUES (?, ?, ?, '0')";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'isi', $idUsuarioDestino, $mensaje, $idContacto); // Corrected order of parameters
        $successNotificacion = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        $successNotificacion = false;
    }

    if ($successNotificacion) {
        echo "Contacto compartido y notificación enviada correctamente.";
    } else {
        echo "Error al enviar la notificación.";
    }
}
    ?>

    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Agenda de contactos</title>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                    border: 1px solid blue;
                    font-family: 'montserrat', 'Verdana';
                    
                }

                table td {
                    border: 1px solid blue;
                    text-align: center;
                    padding: 1.3rem;
                    font-family: 'roboto', 'Verdana';
                }

                .button {
                    border-radius: .5rem;
                    color: white;
                    background-color: blue;
                    padding: 1rem;
                    text-decoration: none;
                    font-family: 'montserrat', 'Verdana';
                    margin-top: 1em;
                    margin-bottom: 1em;
                }
            </style>
        </head>
        <body>
            <p></p>
            <p><a class="button" href="nuevo.php"> Añadir Contacto </a><p></p>

            <table>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                </tr>
    <?php
    $idUsuario = $_SESSION['ID'];

    // Consulta para recuperar los contactos del usuario
    $query = "SELECT * FROM contactos WHERE id_usuario = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $idUsuario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_contacto'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['telefono'] . "</td>";
        echo "<td>" . $row['correo'] . "</td>";
        echo "</tr>";
    }

    mysqli_stmt_close($stmt);
    ?>
        </table>

        <p><a class="button" href="agenda.php"> Volver </a></p>

    </body>
</html>
