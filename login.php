<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = trim($_REQUEST['Usuario']);
    $clave = trim($_REQUEST['Password']);
    // Agregar datos de conexión de tu Servidor SQL
    $datosagenda = mysqli_connect('Servidor', 'Usuario', 'Password');
    mysqli_select_db($datosagenda, 'NombreBBDD');

    $consulta = "SELECT * FROM usuario WHERE Login = '$usuario' AND pass = '$clave'";
    $result = mysqli_query($datosagenda, $consulta);

    if (mysqli_num_rows($result) == '1') {
        session_start();
        $_SESSION['usuario'] = $usuario;
 
        foreach ($result as $valor) {};
        $_SESSION['ID'] = $valor['id_usuario'];

        header('Location:agenda.php');
    } else {
        header('Location:index.php');
    }
} else {
    header('Location:index.php');
}

    
    /*$facceso = file('acceso.txt');
    foreach ($facceso as $contenido) {
        $array[] = trim($contenido);
    } 
    if (($usuario == $array[0] ) && ($clave == $array[1] )) {
        session_start();
        $_SESSION['usuario']=$usuario;
        
        header('Location:agenda.php');
    } else {
        header('Location:index.php');
    }*/
    