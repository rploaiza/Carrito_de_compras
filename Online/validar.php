<?php
error_reporting(0);
session_start();
$link = new mysqli("localhost","root","","tienda_online");
if ($link ->connect_errno)
{
 echo "Fallo al conectar a MySQL: (" . $link ->connect_errno . ") " .$link ->connect_error;
 exit();
}
@mysqli_query($link , "SET NAMES 'utf8'");
if ($_POST['user'] == null || $_POST['pass'] == null)
{
    echo '<span>Por favor complete todos los campos.</span>';
}
else
{
    $user = mysqli_real_escape_string($link , $_POST['user']);
    $pass = mysqli_real_escape_string($link , $_POST['pass']); 
    $consulta = mysqli_query($link , "SELECT user, pass FROM usuario WHERE user = '$user' AND pass = '$pass' AND id_usuario = 1");
    if (mysqli_num_rows($consulta) > 0)
    {
        $_SESSION["usuario"] = $user;   
        echo '<script>location.href = "administrador.php"</script>';
    }else{
        $consulta = mysqli_query($link , "SELECT user, pass FROM usuario WHERE user = '$user' AND pass = '$pass' AND id_usuario = 2");
        if (mysqli_num_rows($consulta) > 0){
            $_SESSION["usuario"] = $user;
            echo '<script>location.href = "administrador.php"</script>';
        }else{
            $consulta = mysqli_query($link , "SELECT user, pass FROM usuario WHERE user = '$user' AND pass = '$pass' AND (id_usuario = 3 OR id_usuario = 0) ");
            if (mysqli_num_rows($consulta) > 0){
                $_SESSION["usuario"] = $user;
                echo '<script>location.href = "comprar.php"</script>';
            }else{
                echo '<span>El usuario y/o clave son incorrectas, vuelva a intentarlo.</span>';
            }
        }
        
    }
}
?>