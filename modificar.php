<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location:index.php');
}else
{
$ID=$_SESSION['ID'];  }
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_contacto = trim($_REQUEST['Id_contacto']);
     $nombre = trim($_REQUEST['nombre']);
      $telefono = trim($_REQUEST['telefono']);
       $correo = trim($_REQUEST['correo']);
       
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8">
        <title>Acceso</title>
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
    
    <p><h2> Pagina de edición de registro de agenda </h2></p>
      <p>  </p>
        <p>  </p>
          <p>  </p>
   <form method="POST" action="grabar_modificado.php">
         <table>
                <tr>
        <p>
                <td><label for="nombre">Nombre</label>  </td>
             <td><input id="nombre" type="text" name="nombre" value="<?= $nombre ?>"></td>
        </p>
         </tr>
          <tr>
         <p>
             <td><label for="telefono">Telefono</label></td>
            <td> <input id="telefono" type="text" name="telefono" value="<?=  $telefono ?>"></td>
        </p>
        </tr>
          <tr>
        <p>
            <td><label for="correo">Correo</label></td>
            <td><input id="correo" type="text" name="correo" value="<?=  $correo ?>"></td>
        </p>
           </tr>
        <p>
             <tr>
              <td>   
            <input id="Id_contacto" name="Id_contacto" type="hidden" value=<?= $id_contacto; ?>>
            <input id="Id_usuario" name="Id_usuario" type="hidden" value=<?= $ID; ?>>
              </td>           
                 <td>          
            <input type="submit" value="Modificar">
            </td>
            </tr>
            
        </p>
                 <table>

    </form>
</body>
</html>
