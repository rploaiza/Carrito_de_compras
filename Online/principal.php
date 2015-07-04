
<?php 
header('Content-Type: text/html; charset=ISO-8859-1');
include("static/site_config.php"); 
include ("static/clase_mysql.php");
$miconexion = new clase_mysql;
$miconexion->conectar($db_name,$db_host, $db_user,$db_password);
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Buy Online</title>

    <!-- Bootstrap Core CSS -->
     <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
        <script src="js/modernizr.js"></script> <!-- Modernizr -->
        <link rel="stylesheet" type="text/css" href="css/jquery.lightbox.css">


        <link rel="stylesheet" href="css/style.css">
        <script src="js/script.js"></script>
        <link rel="shortcut icon" href="http://www.azulweb.net/wp-content/uploads/2014/02/icono-2.png" />


    </head>

    <body>
        <!-- Services Nav-->
            <?php include("static/nav.php") ?>


        <!-- Services Headder -->
        <header>
            <?php include("static/header.php") ?>
        </header>



        <!-- Services Section -->
        <section id="services">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-2">
                        <?php
                        $a=0;
                        $miconexion->consulta("select * from categoria_producto");
                        for ($i=0; $i < $miconexion->numregistros(); $i++) {                 
                            $a=$a+1;
                            $lista=$miconexion->consulta_lista();
                            echo "<button name= btn_cat class='btn btn-xl1' data-filter='.".$lista[1]."'><a href='principal.php?id=".$lista['id']."' class='nav$a' data-type='".$lista[1]."'>".$lista[1]."</a>
                        </button>";
                        
                    }
                    ?>
                </div>
                <div class="col-md-10"> 
                    <aside id="modulos">         
                        <div class="cd-filter-conten"> 
                         <div id="contenedor">
                         <div class="cd-filter-content">
                        <h4>Filtrar: <input type="search" placeholder="Buscar..."> </h4>
                    </div>
                            <div id="boton" onclick="mostrar('caja'); return false" >
                                Busqueda Avanzada
                            </div>

                            <div id="caja" >
                                <form method="post">
                                   <select name="categoriap" >
                                    <option selected disabled>-- Selecciona una categoria --</option> 
                                    <?php
                                    error_reporting(0);
                                    $a=0;
                                    $miconexion->consulta("select categoria from categoria_producto");
                                    for ($i=0; $i < $miconexion->numregistros(); $i++) {                 
                                        $a=$a+1;
                                        $lista=$miconexion->consulta_lista();
                                        echo $lista[0];
                                        $x =  $lista[0];
                                        ?>
                                        <option value="<?=$x?>"><?=$x?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <select name="marcap">
                                    <option selected disabled>-- Selecciona una marca --</option> 
                                    <?php
                                    error_reporting(0);
                                    $a=0;
                                    $miconexion->consulta("select distinct  marca from producto");
                                    for ($i=0; $i < $miconexion->numregistros(); $i++) {                 
                                        $a=$a+1;
                                        $lista=$miconexion->consulta_lista();
                                        echo $lista[0];
                                        $y =  $lista[0];
                                        ?>
                                        <option value="<?=$y?>"><?=$y?></option>
                                        <?php
                                    }
                                    ?>
                                </select><br>
                                <select  name="precpi">
                                  <option selected disabled>-- Precio minimo--</option> 
                                  <option>10</option>
                                  <option>50</option>
                                  <option>100</option>
                                  <option>300</option>
                                  <option>500</option>
                                  <option>800</option>
                                  <option>1000</option>
                              </select>
                              <select  name="precpf">
                                <option selected disabled>-- Precio maximo--</option> 
                                <option>50</option>
                                <option>100</option>           
                                <option>300</option>
                                <option>500</option>
                                <option>800</option>
                                <option>1000</option>
                                <option>1600</option>
                            </select>

                            <center> <input class="form-btn" name="submit" type="submit" value="Aceptar" /></center>
                            <?php
                            $marca =  $_POST["marcap"];
                            $categoria = $_POST["categoriap"];
                            $preci =$_POST["precpi"];
                            $precf =$_POST["precpf"];


                            $miconexion->consulta("Select producto.codigo, producto.nombre, producto.precio_p, producto.descripcion, producto.marca, categoria_producto.categoria from producto, categoria_producto where=categoria_producto.id and categoria_producto.categoria= '$_POST[categoriap]' and producto.marca ='$_POST[marcap]' and producto.precio_p between '$_POST[precpi]' and '$_POST[precpf]'   or categoria_producto.categoria= '$_POST[categoriap]' and producto.id=categoria_producto.id  or producto.marca ='$_POST[marcap]' and producto.id=categoria_producto.id or  producto.id=categoria_producto.id and producto.precio_p between '$_POST[precpi]' and '$_POST[precpf]' "  );
                                 //$result = mysql_query("Select productos.nombre, productos.precio_p, productos.descripcion, productos.marca, categoria.nombre_cat from productos, categoria where id_catego=id_categoria and categoria.nombre_cat= '$_POST[categoriap]' and productos.marca ='$_POST[marcap]' and productos.precio_p between '$_POST[precpi]' and '$_POST[precpf]'   or categoria.nombre_cat= '$_POST[categoriap]' and id_catego=id_categoria  or productos.marca ='$_POST[marcap]' and id_catego=id_categoria  or  id_catego=id_categoria and productos.precio_p between '$_POST[precpi]' and '$_POST[precpf]' "  );

                            for ($i=0; $i < $miconexion->numregistros(); $i++) {                 
                                $a=$a+1;
                                $lista=$miconexion->consulta_lista();
                                echo "<p> Codigo: ".$lista[0]."</p>";
                                echo "<p> Nombre:".$lista[1]."</p>";
                                echo "<p> Precio: ".$lista[2]."</p>";
                                echo "<p>Descripcion: ".$lista[3]."</p>";
                                echo "<p>Marca: ".$lista[4]."</p>";
                            }
                            ?>
                        </form>

                        <section class="cd-gallery">
                            <ul class='gallery'>

                                <?php
                                echo "string";
                                error_reporting(0);
                                $miconexion->consulta("select p.*, c.categoria from categoria_producto c, producto p where c.id = p.id ");

                                for ($i=0; $i < $miconexion->numregistros(); $i++) {                 
                                    $lista=$miconexion->consulta_lista();
                                    echo "<li class='mix ".$lista[6]."  ".$lista[8]." ".$lista[5]."".$lista[12]."'>
                                    <div class='titulo'>

                                        <img class='p-imag' width='200' height='150' src='".$lista[11]."' alt='".$lista[1]."'>
                                        <div class='nombre'>".$lista[6]."</div>
                                    </div>
                                    <p style='text-align:center;'><strong>".$lista[5]."</strong><p>
                                        <p>

                                            <strong>Valor: </strong>$".$lista[8]."<br>  
                                            <strong>En Stock: </strong>".$lista[10]."
                                        </p>

                                    </li>";
                                }
                                ?>
                            </ul>
                            <div class="cd-fail-message">No hay resultados</div>
                        </section> <!-- cd-gallery -->

                    </div>   
                </div>  
            </div>
            <section class="cd-gallery2">
                <ul class='gallery2'>
                    <?php
                    extract($_GET);
                    error_reporting(0);
                    if (@ !$id) {
                    }
                    if ($id==0) {
                      echo "Selecione una categoria para busqueda";

                  }else{
                   $miconexion->consulta("select p.*, c.categoria from categoria_producto c, producto p where c.id_categoria = p.id  and p.id ='$id'" );
             //$miconexion->consulta("select p.*, c.categoria from categoria_producto c, producto p where c.id_categoria = p.id_categoria ");
                   for ($i=0; $i < $miconexion->numregistros(); $i++) {                 
                    $lista=$miconexion->consulta_lista();
                    echo "<li class='mix ".$lista[6]."  ".$lista[8]." ".$lista[5]."".$lista[12]."'>
                    <div class='titulo'>

                        <img class='p-imag' width='200' height='150' src='".$lista[11]."' alt='".$lista[1]."'>
                        <div class='nombre'>".$lista[6]."</div>
                    </div>
                    <p style='text-align:center;'><strong>".$lista[5]."</strong><p>
                        <p>

                            <strong>Valor: </strong>$".$lista[8]."<br>  
                            <strong>En Stock: </strong>".$lista[10]."
                        </p>

                    </li>";
                }
                if ($i==0) {
                    echo "No hay elementos";
                }
            }
            ?>
        </ul>
        <div class="cd-fail-message">No hay resultados</div>
    </section> <!-- cd-gallery -->
</aside> 
</div>
<!-- Inicio de catalogo -->
            <br>
            <br>
            <section id="catalogo1">

              <?php
              $pa=mysql_query("SELECT * FROM producto where estado='s'");       
              while($row=mysql_fetch_array($pa)){
                ?>    

                <div class="col-sm-6 col-md-3">
                  <div class="thumbnail">
                    <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';
                    document.getElementById('fade').style.display='block'"><img id="imagen" src="img/producto/<?php echo $row['codigo']; ?>.jpg" width="100%"></a>
                    <div class="caption">
                      <h5><?php echo $row['nombre'];?></h5>
                      <p id="catal" style="color:#0044cc;">$<?php echo number_format($row['valor'],2,",","."); ?></p>
                      <p id="catal1"><?php echo $row['nota'];?></p>
                      <p id="catal">
                        <form name="form<?php $row['codigo']; ?>" method="post" action="">
                          <input type="hidden" name="codigo" value="<?php echo $row['codigo']; ?>">
                          <button type="submit" style="padding:0.5%;" name="boton" class="btn btn-primary">
                            <!-- <i class="icon-shopping-cart"></i>--> <strong style="font-size:75%;" >Agregar al Carrito</strong>
                          </button>
                        </form> 
                      </p>
                    </div>
                  </div>
                </div>
                <?php 
                include("detalle_producto.php"); /*Esta en un archivo detalle_producto.php en carpeta static*/
                ?>
                <?php } ?>      
              </section>
              <!-- Fin catalogo -->
</section>
</div>
</div>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/cbpAnimatedHeader.js"></script>

<!-- Contact Form JavaScript -->
<script src="js/jqBootstrapValidation.js"></script>
<script src="js/contact_me.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/agency.js"></script>

<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mixitup.min.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
<script src="js/jquery.lightbox.js"></script>
<script>
      // Initiate Lightbox
      $(function() {
        $('.gallery a').lightbox(); 
    });
  </script>


  <script language="JavaScript">
    function muestra_oculta(id){
        if (document.getElementById){ //se obtiene el id
        var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
        el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
    }
}
window.onload = function(){/*hace que se cargue la función lo que predetermina que div estará oculto hasta llamar a la función nuevamente*/
    muestra_oculta('contenido_a_mostrar');/* "contenido_a_mostrar" es el nombre que le dimos al DIV */
}
function mostrar(id) {
    obj = document.getElementById(id);
    obj.style.display = (obj.style.display == 'none') ? 'block' : 'none';
}
</script>
<footer  style="background: #000;" >
    <?php include("static/footer.php") ?>
</footer>
</body>
</html>
