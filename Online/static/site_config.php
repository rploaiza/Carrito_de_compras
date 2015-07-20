<?php

#DATOS DE LA WEBAPP
$site_name="Universidad Técnica Particular de Loja";
$project_name="Tienda Virtual";
$site_autor="ing_web_2015";
$url_site="http://127.0.0.1/Carrito_de_compras/";


#Datos de configuracion de mysql
$db_host="127.0.0.1";
$db_user="root";
$db_password="";
$db_name="tienda_online";
$connect = new mysqli($db_host,$db_user,$db_password,$db_name) or die("error" . mysqli_errno($connect));	
?>
