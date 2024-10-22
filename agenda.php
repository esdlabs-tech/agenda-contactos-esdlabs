<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:index.php');
}

// Consultar notificaciones para el usuario actual
$conexion = mysqli_connect('Servidor', 'Usuario', 'Password', 'NombreBBDD');
$idUsuario = $_SESSION['ID'];
$sql = "SELECT * FROM notificaciones WHERE id_usuario_destino = $idUsuario AND visto = 0";
$resultado = mysqli_query($conexion, $sql);
$numNotificaciones = mysqli_num_rows($resultado);
mysqli_close($conexion);
?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agenda de Contactos by ESD Labs</title>
        <meta name="description" content="Agenda de Contactos creada con PHP">
        <meta name="keywords" content="agenda, contactos, ESD Labs">
        <meta name="author" content="ESD Labs">
        <meta name="robots" content="index, follow">

          <link rel="icon" type="image/x-icon" href="imgs/favicon.png">
        
        <link rel="stylesheet" href="styles/styles.css">
              
    </head>
    <body>

        <header>
        
        <?php if ($numNotificaciones > 0): ?>
            <div class="notification montserrat">
                Tienes <?php echo $numNotificaciones; ?> notificaciones pendientes.
                <a href="notificacion.php?idusu=<?php echo $idUsuario; ?>&id_usuario_destino=<?php echo $_SESSION['ID']; ?>">Ver notificaciones</a>
                <input type="hidden" name="id_contacto" value="<?= $idContacto ?>">
                <input type="hidden" name="id_usuario_origen" value="<?= $_SESSION['ID'] ?>">
            </div>
        <?php endif; ?>

        <p><a class="button" href="nuevo.php"> Añadir Contacto </a></p>
</header>
        <table>
            <tr>
                <th class="montserrat">Código</th>
                <th class="montserrat">Nombre</th>
                <th class="montserrat">Telefono</th>
                <th class="montserrat">Correo</th>      
            </tr>
            <?php
            $idUsuario = $_SESSION['ID'];
            $datosagenda = mysqli_connect('Servidor', 'Usuario', 'Password');
            mysqli_select_db($datosagenda, 'NombreBBDD');
            $ID = trim($_SESSION['ID']);
            $consulta = "SELECT * FROM contactos WHERE id_usuario = $ID AND visible=1";
            $result = mysqli_query($datosagenda, $consulta);

            foreach ($result as $valor) {

                $idContacto = $valor['id_contacto'];
                $idOrigen = $valor['id_usuario'];
                ?>
                <tr>
                    <td><?= $valor['id_contacto']; ?></td>
                    <td><?= $valor['nombre']; ?></td>
                    <td><?= $valor['telefono']; ?></td>
                    <td><?= $valor['correo'] ?></td>
                    <td>
                        <form action="compartir.php" method="GET">
                            <input type="hidden" name="id_contacto" value="<?= $idContacto ?>">
                            <input type="hidden" name="id_usuario_origen" value="<?= $_SESSION['ID'] ?>">
                            <label for="id_usuario_destino">Elige un usuario con quien compartir:</label>
                            <select name="id_usuario_destino" id="id_usuario_destino">
                                <option value="1">Chema</option>
                                <option value="2">Pepe</option>
                                <option value="3">Ana</option>
                                <option value="4">Manuel</option>
                            </select>
                            <input type="submit" name="submitted" value="Compartir">
                        </form>
                    </td>

                    <td> 
                        <form method="POST" action="modificar.php">
                            <input id="Id_contacto" name="Id_contacto" type="hidden" value=<?= $valor['id_contacto']; ?>>
                            <input id="nombre" name="nombre" type="hidden" value=<?= $valor['nombre']; ?>>
                            <input id="telefono" name="telefono" type="hidden" value=<?= $valor['telefono']; ?>>
                            <input id="correo" name="correo" type="hidden" value=<?= $valor['correo']; ?>>
                            <input type="submit" name="submitted" value="Modificar"> </td>
                        </form>

                    </td>
                    <td>

                        <form method="POST" action="borrado.php">
                            <input id="Id_contacto" name="Id_contacto" type="hidden" value=<?= $valor['id_contacto']; ?>>

                            <input type="submit" name="submitted" value="Borrar"> 
                            </td>
                        </form>
                </tr>

            <?php } ?>
        </table>
        <hr>
        
        <h3 class="montserrat">Contactos compartidos</h3>
        <hr>
        
        <table>
            <tr class="montserrat">
                <th>Código</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Correo</th>      
            </tr>
            <?php
            $idUsuario = $_SESSION['ID'];
            $datosagenda = mysqli_connect('Servidor', 'Usuario', 'Password');
            mysqli_select_db($datosagenda, 'NombreBBDD');
            $ID = trim($_SESSION['ID']);
            $consulta = "SELECT comparte.id_contacto, nombre, telefono, correo
                        FROM comparte 
                        RIGHT JOIN contactos ON comparte.id_contacto = contactos.id_contacto
                        WHERE id_usuario_destino  = $ID AND visible = 1 "
                    . "AND comparte.aceptado IS NOT NULL AND comparte.aceptado != 0";
            $result = mysqli_query($datosagenda, $consulta);

            foreach ($result as $valor) {

                ?>
                <tr>
                    <td><?= $valor['id_contacto']; ?></td>
                    <td><?= $valor['nombre']; ?></td>
                    <td><?= $valor['telefono']; ?></td>
                    <td><?= $valor['correo'] ?></td>
                    <td>

                        <form method="POST" action="borrado.php">
                            <input id="Id_contacto" name="Id_contacto" type="hidden" value=<?= $valor['id_contacto']; ?>>

                            <input type="submit" name="submitted" value="Borrar"> 
                            </td>
                        </form>
                    
                </tr>

            <?php } ?>
        </table>    
        
        <p class="montserrat"><a class="button" href="logout.php"> Salir </a><p></p>

        <footer>
            <p class="negrita montserrat"> Creado por &#129354 <strong><a href="https://esdlabs.es/">ESD
                    Labs</strong></a> &#129354 </p>
        </footer>
    </body>
</html>
<script type="text/javascript">
    document.getElementById('compartirButton').addEventListener('click', function () {
        var msjcmprt1 = "Contacto añadido satisfactoriamente.";
        alert(msjcmprt1);
    });
</script>


