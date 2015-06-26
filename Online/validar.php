<?php
//error_reporting(0);
include ("static/site_config.php");
include ("static/clase_mysql.php");
$miconexion = new clase_mysql;
$miconexion->conectar($db_name,$db_host, $db_user,$db_password);
$user=$_POST['user'];
$pass=$_POST['pass'];
session_start();
if ($_POST['user'] == null || $_POST['pass'] == null){
    echo '<span>Por favor complete todos los campos.</span>';
}else{

    $miconexion->consulta("SELECT *FROM usuario");
    $miconexion->consultauser($user,$pass);   
}
?>
