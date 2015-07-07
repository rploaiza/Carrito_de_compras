
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

        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">

        <!-- jQuery -->
        <script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>


        <!-- DataTables -->
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
        <script src="js/ajax.js"></script>


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
       <nav class="navbar navbar-default navbar-fixed-top">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div  class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Menu de Navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="principal.php"></a>
            <!--<a class="navbar-brand page-scroll" href="#page-top" style="margin-left:45%;";>LINE BUY</a> -->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul style="margin-top: -4%;" style="float: right;" class="nav navbar-nav navbar-right">

                <img style="width: 10%; float: left;" src="img/logo.png">

                <li style="float: right;  width: 10%;">
                    <a style="font-size: 90%;" class="page-scroll" href="principal.php"><img style="width: 150%;" id="home" src="ico/home.png">Inicio</a>
                </li>

                <li style="float: right;  width: 10%;">
                    <a style="font-size: 90%;" class="page-scroll" href="index.php"><img style="width: 150%;" id="carrito" src="ico/carrito.png">Comprar</a>
                </li>     

                <li style="float: right;  width: 10%;">
                    <a style="font-size: 90%;" class="page-scroll" href="mis_pedidos.php"><img style="width: 500%;" id="carrito" src="ico/pedidos.png">Pedidos</a>
                </li>
            </ul>

        </div>

        <ul class="nav navbar-nav navbar-left">
            <li>
                <a class="page-scroll" href="#">BIENVENIDO: <?php echo $_SESSION['usuario']; ?></a>

            </li>                 
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a class="page-scroll" href="logout.php">CERRAR SESION</a>

            </li>                 
        </ul>

    </div>
    <!-- /.navbar-collapse -->
</nav>
<!-- Services Headder -->     
<section id="services">
    <div class="container">
        <div class="row1 text-center">
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
                    <section class="cd-gallery" width="100%">                            
                        <?php
                        extract($_POST);
                        extract($_GET);
                        echo "<div style='width:auto%; height:100%; overflow:auto;'>";
                        if (isset($tabla)) {
                            echo "<h1 class='section-subheading text-muted'>".$tabla."</h1>";
                            echo "<form method='post' enctype='multipart/form-data'>";
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
                                echo "<script>location.href='administrador.php?tabla=categoria_producto'</script>";  
                                $miconexion->consulta();
                                        //--- FIN BORRA FILA DE TABLAS ----
                            }else{
                                            //--- INICIO ACTUALIZAR FILA TABLAS ----
                                if ($edi==1) { 
                                    if (isset($act)) {
                                        $miconexion->consulta("SELECT * FROM ".$tabla." WHERE ".$act."=".$id);
                                        $miconexion->consultaUpdate();
                                        if (isset($_REQUEST['actualizar'])) {  
                                           // echo "UPDATE ".$tabla." SET cedula='".$cedula."', nombre='".$nombre."', apellido='".$apellido."', direccion='".$direccion."', telefono='".$telefono."', email='".$email."', user='".$user."', pass='".$pass."'WHERE id=".$id;
                                            switch ($tabla) {
                                                            /*case 'carrito':
                                                                $miconexion->consulta("SELECT cedula AS 'Cedula del Cliente', codigo AS 'Codigo del Producto', cantidad AS '# Productos' FROM ".$tabla);
                                                                break;*/
                                                                case 'categoria_estado':
                                                                $miconexion->consulta("UPDATE ".$tabla." SET estado='".$estado."' WHERE id=".$id);
                                                                echo "<script>location.href='administrador.php?tabla=categoria_estado'</script>";
                                                                break;
                                                                case 'categoria_producto':
                                                                $miconexion->consulta("UPDATE ".$tabla." SET categoria='".$categoria."' WHERE id=".$id);
                                                                echo "<script>location.href='administrador.php?tabla=categoria_producto'</script>";                                                                
                                                                break;
                                                                case 'estado':
                                                                $miconexion->consulta("UPDATE ".$tabla." SET nombre='".$nombre."', descrpcion='".$descrpcion."', descuento='".$descuento."'WHERE id=".$id);
                                                                echo "<script>location.href='administrador.php?tabla=estado'</script>"; 
                                                                break;
                                                                case 'usuario':
                                                                $miconexion->consulta("UPDATE ".$tabla." SET cedula='".$cedula."', nombre='".$nombre."', apellido='".$apellido."', direccion='".$direccion."', telefono='".$telefono."', email='".$email."', user='".$user."', pass='".$pass."'WHERE id=".$id);
                                                                break;
                                                                case 'producto':
                                                                $miconexion->consulta("UPDATE ".$tabla." SET codigo='".$codigo."', nombre='".$nombre."', marca='".$marca."', nota='".$nota."', valor='".$valor."', cantidad='".$cantidad."'WHERE id=".$id);
                                                                break;
                                                            } 
                                                        }                               
                                                    }
                                                    echo'<meta http-equiv="refresh" content="administrador.php>';   
                                                }
                                            //---- FIN ACTUALIZAR FILA TABLAS ----

                                            }
                                        }else{

                                            echo "<form method='post' enctype='multipart/form-data'>";
                                            if (isset($_REQUEST['nuevo'])) {                                             

                                                switch ($tabla) {                           

                                                    case 'categoria_estado':
                                                    $miconexion->categoria_estado();
                                                    break;
                                                    case 'categoria_producto':
                                                    $miconexion->catprod();
                                                    break;
                                                    case 'categoria_usuario':
                                                    $query = "SELECT tipo, descripcion FROM ".$tabla;
                                                    break;
                                                    case 'estado':
                                                    $miconexion->estadoproducto();
                                                    break;
                                                    case 'producto':
                                                    $miconexion->procategoria();
                                                    ?>
                                                    <p>Seleccione la Imagen:
                                                        <input type="file" name="imagen"/>
                                                    </p>
                                                    <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.js"></script>
                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $("#cont").change(function() {
                                                                if ($("#cont option[value='3']").attr('selected')) {
                                                                    <?php 
                                                                    $miconexion->consulta("SELECT COUNT(id_estado) FROM producto WHERE id_estado=1");
                                                                    $var=$miconexion->consulta_lista();
                                                                    if ($var[0] == 6) {
                                                                        ?>    
                                                                        alert("El limite de ofertas esta copado.");
                                                                        location.href='administrador.php?tabla=producto'
                                                                        <?php    
                                                                    }
                                                                    ?>
                                                                }
                                                            }); 
                                                    });
                                                    </script>
                                            <?php
                                                    break;
                                                }
                                                echo "<button type='submit' class='btn btn-xl' name='guardar' value='guardar'>Guardar</button>";
                                                echo "</form>"; 
                                            }
                                            if (isset($_REQUEST['guardar'])) {

                                                if($tabla=='categoria_estado'){
                                                    mysql_query("insert into categoria_estado values('','$estado')");
                                                    echo "<script>location.href='administrador.php?tabla=categoria_estado'</script>";}else{
                                                        if($tabla=='categoria_producto'){
                                                            mysql_query("insert into categoria_producto values('','$categoria')");
                                                        echo "<script>location.href='administrador.php?tabla=categoria_producto'</script>";}else{
                                                                if($tabla=='estado'){
                                                                 mysql_query("insert into estado values('','$nombre', '$descrpcion', '$descuento', '$idcatestado')");
                                                                 echo "<script>location.href='administrador.php?tabla=estado'</script>";}else{
                                                                    if($tabla=='producto'){
                                                                        $destino='img/producto';
                                                                        $origen=$_FILES['imagen']['tmp_name'];
                                                                        $nombreImagen=$_FILES['imagen']['name'];
                                                                        $rutaDestino=$destino.'/'.$nombreImagen;
                                                                        $moveResult = move_uploaded_file($origen, $destino.'/'.$nombreImagen);
                                                                        $query = "INSERT INTO producto(id, id_categoria, id_estado, id_estado_pro, codigo, nombre, marca, nota, valor, estado, cantidad, imagen) values ('','$idcat','$idest','$idcatest', '$codigo', '$nombre', '$marca', '$nota', '$valor', '$estado', '$cantidad', '$rutaDestino')";
                                                                        $res = mysql_query($query) or die("error". mysql_error());
                                                                        echo "<script>location.href='administrador.php?tabla=producto'</script>";    

                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </section>
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
                }
                else{
                    echo '<script>location.href = "login.php";</script>'; 
                }
                ?>
