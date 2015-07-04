
<?php
header('Content-Type: text/html; charset=ISO-8859-1');
include("static/site_config.php"); 
include ("static/clase_mysql.php");
$miconexion = new clase_mysql;

$miconexion->conectar($db_name,$db_host, $db_user,$db_password);
session_start();
if (isset($_SESSION['usuario'])){  
    ?>  

    <!DOCTYPE html>
    <html>

        <head>
            <link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css">  
            <!-- jQuery -->
            <script type="text/javascript" charset="utf8" src="media/js/jquery.js"></script>
            <!-- DataTables -->
            <script type="text/javascript" charset="utf8" src="media/js/jquery.dataTables.js"></script>


            <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable();
            } );
            </script>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">
            <title>Line Buy - Registro</title>
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/agency.css" rel="stylesheet">

        </head>
        <body>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="http://localhost/carritovirtual/">Line Buy</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#">BIENVENIDO: <?php echo $_SESSION['usuario']; ?></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="logout.php">CERRAR SESION</a>
                    </li>                    
                </ul>
            </div>
            <section id="services">
                <div class="container">
                    <div class="row text-center">
                        <div  class="col-md-4">
                            <h4>Tablas</h4>
                            <h3 class="section-subheading text-muted">Compre nuestros productos en linea...</h3>
                            <?php
                            $miconexion->consulta("show tables");
                            $miconexion->verconsultablas();
                            ?>
                        </div>
                        <div class="col-md-8" >
                            <h4>Datos de las Tablas</h4><br><br>
                            <aside id="modulos">       
                                <section class="cd-gallery">                            
                                    <?php
                                    extract($_POST);
                                    extract($_GET);
                                    echo "<div style='width:auto%; height:100%; overflow:auto;'>";
                                    if (isset($tabla)) {
                                        echo "<h1 class='section-subheading text-muted'>".$tabla."</h1>";
                                        echo "<form method='post'>";
                                        switch ($tabla) {
                                            case 'carrito':
                                                $miconexion->consulta("SELECT cedula AS 'Cedula del Cliente', codigo AS 'Codigo del Producto', cantidad AS '# Productos' FROM ".$tabla);
                                            break;
                                            case 'categoria_estado':
                                                $miconexion->consulta("SELECT id, estado AS 'Estado del Producto' FROM ".$tabla);
                                            break;
                                            case 'categoria_producto':
                                                $miconexion->consulta("SELECT id, categoria AS 'Categoria de Producto' FROM ".$tabla);
                                            break;
                                            case 'estado':
                                                $miconexion->consulta("SELECT id, nombre AS 'Nomina de Estado del Producto', descrpcion AS 'Detalle de la Nomina del Producto', descuento AS 'Descuento del Producto' FROM ".$tabla);
                                            break;
                                            case 'usuario':
                                                $miconexion->consulta("SELECT id, cedula AS 'Cedula', nombre AS 'Nombre', apellido AS 'Apellido', direccion AS 'Dirección', telefono AS 'Teléfono', email AS 'Email', user AS 'Usuario', pass AS 'Contraseña' FROM ".$tabla);
                                            break;
                                            case 'producto':
                                                $miconexion->consulta("SELECT id, codigo AS 'Codigo del Producto', nombre AS 'Nombre del Producto', nota AS 'Caracteristicas del Producto', valor AS 'Precio del Producto', cantidad AS 'Productos en Stock' FROM ".$tabla);
                                            break;
                                        }
                                        $miconexion->verconsulta2($tabla);

                                        echo "<br><button type='submit'  class='btn btn-xl' name='nuevo' value='nuevo'>Nuevos</button><br><br><br>"; 
                                        echo "</div>";
                                    }
                
                                    //---   INICIO CRDUD ---
                                    if (isset($id)) {  
                                        //--- BORRA FILA DE TABLAS ----
                                        if ($edi==2) { 
                                            $miconexion->consulta("DELETE FROM ".$tabla." WHERE ".$act."=".$id);
                                            $miconexion->consulta();
                                        //--- FIN BORRA FILA DE TABLAS ----
                                        }else{
                                            //--- INICIO ACTUALIZAR FILA TABLAS ----
                                            if ($edi==1) { 
                                                if (isset($act)) {

                                                    $miconexion->consulta("SELECT * FROM ".$tabla." WHERE ".$act."=".$id);
                                                    $miconexion->consultaUpdate();
                                                    if (isset($_REQUEST['actualizar'])) {  
                                                        echo "UPDATE ".$tabla." SET cedula='".$cedula."', nombre='".$nombre."', apellido='".$apellido."', direccion='".$direccion."', telefono='".$telefono."', email='".$email."', user='".$user."', pass='".$pass."'WHERE id=".$id;
                                                        switch ($tabla) {
                                                            /*case 'carrito':
                                                                $miconexion->consulta("SELECT cedula AS 'Cedula del Cliente', codigo AS 'Codigo del Producto', cantidad AS '# Productos' FROM ".$tabla);
                                                            break;*/
                                                            case 'categoria_estado':
                                                                $miconexion->consulta("UPDATE ".$tabla." SET estado='".$estado."' WHERE id=".$id);
                                                            break;
                                                            case 'categoria_producto':
                                                                $miconexion->consulta("UPDATE ".$tabla." SET categoria='".$categoria."' WHERE id=".$id);                                                                
                                                            break;
                                                            case 'estado':
                                                                $miconexion->consulta("UPDATE ".$tabla." SET nombre='".$nombre."', descrpcion='".$descrpcion."', descuento='".$descuento."'WHERE id=".$id);
                                                            break;
                                                            case 'usuario':
                                                                $miconexion->consulta("UPDATE ".$tabla." SET cedula='".$cedula."', nombre='".$nombre."', apellido='".$apellido."', direccion='".$direccion."', telefono='".$telefono."', email='".$email."', user='".$user."', pass='".$pass."'WHERE id=".$id);
                                                            break;
                                                            case 'producto':
                                                                $miconexion->consulta("UPDATE ".$tabla." SET codigo='".$codigo."', nombre='".$nombre."', nota='".$nota."', valor='".$valor."', cantidad='".$cantidad."'WHERE id=".$id);
                                                            break;
                                                        } 
                                                    }                               
                                                }
                                                echo'<meta http-equiv="refresh" content="administrador.php>';   
                                            }
                                            //---- FIN ACTUALIZAR FILA TABLAS ----
                                            
                                        }
                                    }else{

                                        echo "<form method='post'>";
                                        if (isset($_REQUEST['nuevo'])) {                                             

                                            switch ($tabla) {                           

                                                case 'categoria_estado':
                                                    $query = "SELECT estado FROM ".$tabla;
                                                break;
                                                case 'categoria_producto':
                                                    $query = "SELECT categoria FROM ".$tabla;
                                                break;
                                                case 'categoria_usuario':
                                                    $query = "SELECT tipo, descripcion FROM ".$tabla;
                                                break;
                                                case 'estado':
                                                    $query = "SELECT nombre, descripcion, descuento, id FROM ".$tabla;

                                                    echo "Estado del Producto': ";
                                                    $query = "SELECT * FROM categoria_estado WHERE id";
                                                    $result = mysql_query($query) or die("error". mysql_error());
                                                    echo "<select class='form-control' name='idcatestado'>";
                                                    while ($row = mysql_fetch_array($result)) {
                                                        echo "string  ".$row[0];
                                                        echo "<option value='".$row[0]."'>".$row[1]."</option>"; 
                                                    }
                                                    echo "</select><br>";

                                                    $query = "SELECT nombre AS 'Nomina de Estado del Producto', descrpcion AS 'Detalle de la Nomina del Producto', descuento AS 'Descuento del Producto' FROM estado WHERE id";
                                                    $result = mysql_query($query) or die("error". mysql_error());
                                                    $cont = mysql_num_fields($result);
                                                    while ($row = mysql_fetch_array($result)) {
                                                        for ($i=0; $i < $cont ; $i++) { 
                                                            echo "<div class='form-group'>";
                                                            echo mysql_field_name($result, $i).":<input class='form-control' name='".mysql_field_name($result, $i)."' type='text' placeholder='".mysql_field_name($result, $i)."'>";
                                                            echo "<p class='help-block text-danger'></p>";
                                                            echo "</div>";

                                                        }
                                                        echo "<br>";
                                                        $cont=0;                             
                                                    }  

                                                    echo '<button type="submit" class="btn btn-info btn-lg"  data-target="#myModal" name="gestado" value="gestado">Guarda</button>';
                                                                    //-------------exit---------------
                                                break;
                                                case 'producto':

                                                echo "Categoria: ";
                                                $query = "SELECT * FROM categoria_producto WHERE id";
                                                $result = mysql_query($query) or die("error". mysql_error());                                   
                                                echo "<div class='form-group'>";                                                                
                                                echo "<select class='form-control' name='idcat'>";
                                                echo '<option value="" default selected>Seleccione</option>';
                                                while ($row = mysql_fetch_array($result)) {
                                                    echo "<h3 class='section-subheading text-muted'> string   ".$row[0]."</h3>";   
                                                    echo "string  ".$row[0];
                                                    echo "<option value='".$row[0]."'>".$row[1]."</option>"; 
                                                }
                                                echo "</select><br>";
                                                echo "<p class='help-block text-danger'></p>";
                                                echo "</div>";
                                                                    //------- extraccion de los estados ------
                                                include ("static/estado.php");    
                                                                    //-------- exit -------
                                                $query = "SELECT codigo, nombre, nota, valor, estado, cantidad, imagen FROM producto";
                                                $result = mysql_query($query) or die("error". mysql_error());
                                                $a = mysql_num_fields($result);
                                                while ($row = mysql_fetch_array($result)) {
                                                    for ($i=0; $i < $a ; $i++) { 
                                                        echo "<div class='form-group'>";
                                                        echo mysql_field_name($result, $i).":<input class='form-control' name='".mysql_field_name($result, $i)."' type='text' placeholder='".mysql_field_name($result, $i)."'>";
                                                        echo "<p class='help-block text-danger'></p>";
                                                        echo "</div>";

                                                    }
                                                    echo "<br>";
                                                    $a=0;                             
                                                }        
                                                echo "<button type='submit' class='btn btn-xl' name='guardar' value='guardar'>Guardar</button>";                                                 
                                                break;
                                            }
                                            if ($tabla== 'categoria_estado' OR $tabla== 'categoria_producto') {
                                                $result = mysql_query($query) or die("error". mysql_error());
                                                $a = mysql_num_fields($result);
                                                while ($row = mysql_fetch_array($result)) {
                                                    for ($i=0; $i < $a ; $i++) { 
                                                        echo "<div class='form-group'>";
                                                        echo mysql_field_name($result, $i).":<input class='form-control' name='".mysql_field_name($result, $i)."' type='text'>";
                                                        echo "<p class='help-block text-danger'></p>";
                                                        echo "</div>";

                                                    }
                                                    echo "<br>";
                                                    $a=0;                             
                                                }
                                                echo "<button type='submit' class='btn btn-xl' name='guardar' value='guardar'>Guardar</button>"; 
                                            }

                                            echo "</form>"; 


                                        }
                                        if (isset($_REQUEST['gestado'])) {
                                 #-------------Promocion---------------
                                            $promocion = ("SELECT id_categoria_estado FROM estado WHERE id_categoria_estado=3 ");
                                            $result = mysql_query($promocion) or die("error". mysql_error());
                                            $a = mysql_num_rows($result);
                                            echo $a;
                                                                #------ formulario de estado -----------

                                            if($a >= 2){

                                                mysql_query("insert into estado values('','$nombre', '$descrpcion', '$descuento', '$idcatestado')");

                                            }else{
                                                echo '<script>alert("El limite de ofertas esta copado. ")</script> ';
                                            }


                                        }

                                        if (isset($_REQUEST['guardar'])) {



                                            if($tabla=='categoria_estado'){
                                                mysql_query("insert into categoria_estado values('','$estado')");}else{
                                                    if($tabla=='categoria_producto'){
                                                        mysql_query("insert into categoria_producto values('','$categoria')");}else{
                                                            if($tabla=='producto'){
                                                                echo $_POST['idcatest'];
                                                                mysql_query("insert into producto values ('','$idcat','$idest','$idcatest', '$codigo', '$nombre', '$nota', '$valor', '$estado', '$cantidad', '$imagen')");}else{
                                                                       # $ressql=$miconexion->consulta("insert into usuario values ('id','$user','$pass')");
                                                                    echo "No se ingreso ningun dato";
                                                                }
                                                            }
                                                        }
                                                    }



                                                }


                                                ?>

                                                
                                            </section> <!-- cd-gallery -->
                                        </aside> 
                                    </div>
                                </div>
                            </div>
                        </section>
            <footer>
                
            </footer>
        </body>
    </html>
<?php
}else{
    echo '<script>location.href = "login.php";</script>'; 
}
?>