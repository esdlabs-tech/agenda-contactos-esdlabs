<?php
session_start();
// Agregar los datos de conexión de tu servidor SQL
$conn = mysqli_connect("servidor", "Usuario", "Password", "NombreBBDD");

// Validar y sanear inputs
$idUsuarioDestino = filter_input(INPUT_GET, 'id_usuario_destino', FILTER_SANITIZE_NUMBER_INT);
$idUsuarioOrigen = filter_input(INPUT_GET, 'id_usuario_origen', FILTER_SANITIZE_NUMBER_INT);
$idContacto = filter_input(INPUT_GET, 'id_contacto', FILTER_SANITIZE_NUMBER_INT);
//$_SESSION['id_contacto'] = $_GET['idusu'];

$currentUserId = $_SESSION['ID'];

// Obtener el id_contacto de la tabla comparte
$sqlComparte = "SELECT notificaciones.id,contactos.nombre, contactos.telefono, contactos.correo
FROM notificaciones
LEFT JOIN contactos ON notificaciones.id_contacto = contactos.id_contacto
WHERE notificaciones.id_usuario_destino = $idUsuarioDestino AND notificaciones.visto = 0";
$result = mysqli_query($conn, $sqlComparte);
?>
<style>
    @font-face {
    font-family: "montserrat";
    src: url("../fonts/montserrat/Montserrat-VariableFont_wght.ttf");
}
            table {
                border-collapse: collapse;
                width: 100%;
                border: 1px solid black;
                font-family: 'montserrat', 'Verdana';
            }
            table td {
                border: 1px solid blue;
                text-align: center;
                padding: 1.3rem;
                font-family: 'montserrat', 'Verdana';
            }
            .button {
                border-radius: .5rem;
                color: white;
                background-color: blue;
                padding: 0.75rem;
                text-decoration: none;
                margin: 0.75rem;
                font-family: 'montserrat', 'Verdana';
                
            }
            .notification {
                background-color: #f2f2f2;
                padding: 1rem;
                margin-bottom: 1rem;
                
            }
            .montserrat {
    font-family: 'montserrat';
}
        </style>
        <p><a class="button" href="agenda.php"> Volver </a></p>
        
<table>
    <tr>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Correo</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($result as $fila) : ?>
        <tr>
            <td><?= $fila['nombre']; ?></td>
            <td><?= $fila['telefono']; ?></td>
            <td><?= $fila['correo']; ?></td>
            <td>
                <form method="post" action="acepzar.php">
                    <button style="float:inline" value="1" name="acepzar">Aceptar</button>
                    <input type="hidden" value="<?= $fila['id'] ?>" name="id_notificacion">
                </form><br>
                <form method="post" action="acepzar.php">
                    <button style="float:inline;" value="0" name="acepzar">Rechazar</button>
                    <input type="hidden" value="<?= $fila['id'] ?>" name="id_notificacion">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>





<?php
mysqli_close($conn);
?>

