<?php 
    include_once("php_conexion.php");
    if(!empty($_GET['del'])){
        $id=$_GET['del'];
        mysql_query("DELETE FROM carrito WHERE codigo='$id'");
        header('location:mis_pedidos.php');
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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/agency.css" rel="stylesheet">
        <style type="text/css">
            body {
              padding-top: 60px;
              padding-bottom: 40px;
            }
        </style>
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="ico/favicon.png">
    </head>

    <body>

           <nav style="background: #000;" class="navbar navbar-default navbar-fixed-top">
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
                    <a style="font-size: 90%;" class="page-scroll" href="principal.php"><img style="width: 30%;" id="home" src="ico/home.png">Inicio</a>
                </li>

                <li style="float: right;  width: 10%;">
                    <a style="font-size: 90%;" class="page-scroll" href="index.php"><img style="width: 20%;" id="carrito" src="ico/carrito.png">Comprar</a>
                </li>     
            </ul>

        </div>

        <ul class="nav navbar-nav navbar-right">
            <li>
                <a class="page-scroll" href="logout.php">CERRAR SESION</a>

            </li>                 
        </ul>

    </div>
    <!-- /.navbar-collapse -->
</nav>
<br>
<br>

        <div class="container">
          <!-- Main hero unit for a primary marketing message or call to action -->
          <!-- Example row of columns -->
            <div align="center">
                <?php 
                    if(!empty($_POST['n_cant'])){
                        $n_cant=$_POST['n_cant'];
                        $n_codigo=$_POST['codigo'];
                        $oProducto=new Consultar_Producto($n_codigo);
                        mysql_query("UPDATE carrito SET cantidad='$n_cant' WHERE codigo='$n_codigo'");
                        echo '<div class="alert alert-success" align="center">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Cantidad del Producto "'.$oProducto->consultar('nombre').'" Actualizada con Exito</strong>
                        </div>';
                    }
                ?>
                <table class="table table-bordered">
                    <tr class="info">
                        <td><strong class="text-info">Articulo</strong></td>
                        <td><div align="right"><strong class="text-info">Valor Unitario</strong></div></td>
                        <td><center><strong class="text-info">Seleccione la Cantidad</strong></center></td>
                        <td><div align="right"><strong class="text-info">Total</strong></div></td>
                        <td></td>
                    </tr>
                    <?php 
                        $total=0;$neto=0;
                        $pa=mysql_query("SELECT * FROM carrito");       
                        while($row=mysql_fetch_array($pa)){
                            $oProducto=new Consultar_Producto($row['codigo']);
                            $total=$row['cantidad']*$oProducto->consultar('valor');#cantidad * valor unitario
                            $neto=$neto+$total;#acumulamos el neto
                    ?>
                    <tr>
                        <td>
                            <div align="center">
                                <strong><?php echo $oProducto->consultar('nombre'); ?></strong><br>
                                <img src="img/producto/<?php echo $row['codigo']; ?>.jpg" width="200" height="200" class="img-polaroid">
                            </div>
                        </td>
                        <td>
                            <br><br><div align="right">$ <?php echo number_format($oProducto->consultar('valor'),2,",","."); ?></div>
                        </td>
                        <td><br><br>
                            <center>
                                <a href="#cant<?php echo $row['codigo']; ?>" role="button" class="btn" data-toggle="modal" title="Editar Cantidad">
                                    <span class="badge badge-success"><?php echo $row['cantidad']; ?></span>
                                </a>  
                            </center>
                        </td>
                        <td>
                            <br><br><div align="right">$ <?php echo number_format($total,2,",","."); ?></div>
                        </td>
                        <td><br><br>
                            <center>
                                <a href="mis_pedidos.php?del=<?php echo $row['codigo']; ?>" title="Eliminar de la Lista">
                                    <button type="button" class="close" aria-label="Close">
                                        <span  style="color:#000;" aria-hidden="true">&times;</span>
                                    </button>X
                                </a>
                            </center>
                        </td>
                    </tr>
                    <div id="cant<?php echo $row['codigo']; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <form name="form<?php $row['codigo']; ?>" method="post" action="">
                            <input type="hidden" name="codigo" value="<?php echo $row['codigo']; ?>">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                <h3 id="myModalLabel">Actualizar Existencia</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row-fluid">
                                    <div class="span6">
                                        <img src="img/producto/<?php echo $row['codigo']; ?>.jpg" width="200" height="200" class="img-polaroid">
                                    </div>
                                    <div class="span6">
                                        <strong><?php echo $oProducto->consultar('nombre'); ?></strong><br>
                                        <strong>Cantidad Actual: </strong><?php echo $row['cantidad']; ?><br><br>
                                        <strong>Nueva Cantidad</strong><br>
                                        <input name="n_cant" value="<?php echo $row['cantidad']; ?>" type="number" autocomplete="off" min="1">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> <strong>Cerrar</strong></button>
                                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> <strong>Actualizar</strong></button>
                            </div>
                        </form>
                    </div>

                    <?php } ?>
                    <tr class="info">
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><div align="right"><strong>NETO A PAGAR</strong></div></td>
                      <td><div align="right"><strong>$ <?php echo number_format($neto,2,",","."); ?></strong></div></td>
                      <td>&nbsp;</td>
                    </tr>
                </table>

    </div>

    <hr>
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

    <footer style="background: #000;">
        <?php include("static/footer.php") ?>
    </footer>

    </html>
