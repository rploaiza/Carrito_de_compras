<?php
    include("static/site_config.php"); 
    include ("static/clase_mysql.php");
    
    $miconexion = new clase_mysql;
    $miconexion->conectar($db_name,$db_host, $db_user,$db_password);
                                        #extract($_POST);
                                    #extract($_GET);

$q=$_POST['q'];
$res=mysql_query("select * from estado WHERE id_categoria_estado=".$q."");
?>
<br>
<br>
Descrpcion del estado: 
<div class='form-group'> 
<select class='form-control' name='idcatest'>

<?php while($fila=mysql_fetch_array($res)){ ?>
 <option value="<?php echo $fila[4]; ?>"><?php echo utf8_encode($fila[1]); ?></option>
<?php } ?>


</select>
</div><br>


