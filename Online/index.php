<?php 
  include_once("php_conexion.php");
  if(!empty($_GET['del'])){
    $id=$_GET['del'];
    mysql_query("DELETE FROM carrito WHERE codigo='$id'");
    header('location:index.php');
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Carrito de Compras</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->



    <!-- Fav and touch icons -->
    
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="ico/favicon.png">

    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>


    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <script src="js/modernizr.js"></script> <!-- Modernizr -->
    <link rel="stylesheet" type="text/css" href="css/jquery.lightbox.css">


    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <link rel="shortcut icon" href="http://www.azulweb.net/wp-content/uploads/2014/02/icono-2.png" />

     <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">


    
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand page-scroll" href="principal.php"><img style="width: 20%;" src="img/logo.png"></a>|
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="index.php">Comprar</a></li>
              <li><a href="mis_pedidos.php">Mis Pedidos</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
     

      <!-- Example row of columns -->
      <div class="row">
        
      </div>
      <div align="center">
        
        <div class="row-fluid">
        <div class="span8">
      <?php
                $pa=mysql_query("SELECT * FROM producto where estado='s'");       
                while($row=mysql_fetch_array($pa)){
            ?>                       
          <table class="table table-bordered">
              <tr><td>
                  <div class="row-fluid">
                      <div class="span4">
                            <center><strong><?php echo $row['nombre']; ?></strong></center><br>
                            <img src="img/producto/<?php echo $row['codigo']; ?>.jpg" class="img-polaroid">
                        </div>
                        <div class="span4"><br><br><br><br>
                            <strong><?php echo $row['nota']; ?></strong><br><br>
                            <strong>Valor: </strong>$ <?php echo number_format($row['valor'],2,",","."); ?>
                        </div>
                        <div class="span4"><br><br><br><br><br>
                          <form name="form<?php $row['codigo']; ?>" method="post" action="">
                              <input type="hidden" name="codigo" value="<?php echo $row['codigo']; ?>">
                                <button type="submit" name="boton" class="btn btn-primary">
                                    <i class="icon-shopping-cart"></i> <strong>Agregar al Carrito</strong>
                                </button>
                            </form>
                        </div>
                    </div>
              </td></tr>
          </table>
          <?php } ?>
          </div>
            <div class="span4">
            <?php
        if(!empty($_POST['codigo'])){
          $codigo=$_POST['codigo'];
          $pa=mysql_query("SELECT * FROM carrito WHERE codigo='$codigo'");        
          if($row=mysql_fetch_array($pa)){
            $new_cant=$row['cantidad']+1;
            mysql_query("UPDATE carrito SET cantidad='$new_cant' WHERE codigo='$codigo'");
          }else{
            mysql_query("INSERT INTO carrito (codigo, cantidad) VALUES ('$codigo','1')");
          }
        }
      ?>
               <div id="sidebar"><br><br><br>
                  <h2 align="center">Mis Pedidos</h2>
                  <table class="table table-bordered">
                      <tr>
                        <td>
                          <table class="table table-bordered table table-hover">
                            <?php 
                $neto=0;$tneto=0;
                $pa=mysql_query("SELECT * FROM carrito");       
                while($row=mysql_fetch_array($pa)){
                  $oProducto=new Consultar_Producto($row['codigo']);
                  $neto=$oProducto->consultar('valor')*$row['cantidad'];
                  $tneto=$tneto+$neto;
                  
              ?>
                              <tr style="font-size:9px">
                                <td><?php echo $oProducto->consultar('nombre'); ?></td>
                                <td><?php echo $row['cantidad']; ?></td>
                                <td>$ <?php echo number_format($neto,2,",","."); ?></td>
                                <td>
                                  <a href="index.php?del=<?php echo $row['codigo']; ?>" title="Eliminar de la Lista">
                                    <i class="icon-remove"></i>
                                    </a>
                                </td>
                              </tr>
                            <?php }
              ?>
                              <td colspan="4" style="font-size:9px"><div align="right">$<?php echo number_format($tneto,2,",","."); ?></div></td>
                            <?php 
                $pa=mysql_query("SELECT * FROM carrito");       
                if(!$row=mysql_fetch_array($pa)){
              ?>
                              <tr><div class="alert alert-success" align="center"><strong>No hay Productos Registrados</strong></div></tr>
                <?php } ?>
                            </table>
                        </td>
                      </tr>
                    </table>
                </div>
            </div>
      </div>
        
      </div>

      <hr>

      <!-- Services Footer -->
    <footer>
        <?php include("static/footer.php") ?>
    </footer>


    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>
    <script>
    $(function() {
            var offset = $("#sidebar").offset();
            var topPadding = 15;
            $(window).scroll(function() {
                if ($("#sidebar").height() < $(window).height() && $(window).scrollTop() > offset.top) { /* LINEA MODIFICADA POR ALEX PARA NO ANIMAR SI EL SIDEBAR ES MAYOR AL TAMAÑO DE PANTALLA */
                    $("#sidebar").stop().animate({
                        marginTop: $(window).scrollTop() - offset.top + topPadding
                    });
                } else {
                    $("#sidebar").stop().animate({
                        marginTop: 0
                    });
                };
            });
        });
  </script>

  </body>
</html>
