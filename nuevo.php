
<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8">
        <title>Agenda</title>
        <style>
            table {
                border-collapse: collapse;
                width: 50%;
            }
            table td {
                border: 1px solid green;
                text-align: center;
                padding: 1.3rem;
            }
            .button {
                border-radius: .5rem;
                color: white;
                background-color: graytext;
                padding: 1rem;
                text-decoration: none;
            }
        </style>
    </head>
 <body>
        <form method="POST" action="grabar.php">
            <p> </p>

            <h2> Añadir nuevo contacto </h2>            
            <table>
                <tr>
                    <td>Nombre</td>
                    <td><input type="text" name="nombre"></td>
                </tr>
                <tr>
                    <td>Telefono</td>
                    <td><input type="text" name="telefono"></td>
                </tr>
                 <tr>
                    <td>Correo</td>
                    <td><input type="text" name="correo"></td>
                </tr>
                
            </table>
            <input type="submit" name="submitted" value="grabar"></form>
     <br>
     <p><a class="button" href="logout.php"> Salir </a></p>
     <br>
       <p><a class="button" href="agenda.php"> Volver a agenda </a></p>
       <br>
       <footer>
            <p class="negrita montserrat"> Creado por &#129354 <strong><a href="https://esdlabs.es/">ESD
                        Labs</strong></a> &#129354 </p>
        </footer>
    </body>
</html>

