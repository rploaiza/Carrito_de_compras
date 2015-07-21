<?php 
include("static/site_config.php"); 
include ("static/clase_mysql.php");
$miconexion = new clase_mysql;

$miconexion->conectar($db_name,$db_host, $db_user,$db_password);
session_start();
if (isset($_SESSION['usuario'])){ 
  class Consultar_Producto{
    private $consulta;
    private $fetch;
    
    function __construct($codigo){
      $this->consulta = mysql_query("SELECT * FROM producto WHERE codigo='$codigo'");
      $this->fetch = mysql_fetch_array($this->consulta);
    }
    
    function consultar($campo){
      return $this->fetch[$campo];
    }
  }
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
    <link rel="stylesheet" href="css/style.css">
    +<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>

    <style type="text/css">
      h2{
        margin: 0;     
        color: #666;
        padding-top: 90px;
        font-size: 52px;
        font-family: "trebuchet ms", sans-serif;    
      }
      .item{
        text-align: center;
        height: 200px;
      }
      .carousel{
        margin-top: 20px;
      }
      .bs-example{
        margin: 20px;
      }
      .imga{
        height: 150px;


      }
    </style>

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
    <!-- Navigation -->
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
      <div>
        <ul class="nav navbar-nav navbar-left">
          <li>
           <a class="page-scroll" href="#">BIENVENIDO:
            <?php
            $miconexion->consulta("SELECT * FROM usuario WHERE user='".strtolower ($_SESSION['usuario'])."'");
            $miconexion->nombreuser();
            ?>
          </a>
        </li>                 
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a class="page-scroll" href="logout.php">CERRAR SESION</a>
        </li>                 
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </nav><br>

  <div class="row-fluid">
    <div class="span2">
      <div id="sidebar"><br><br><br>
        <div class="col-md-10">
          <br>
          <br>

          <?php  
          extract($_POST);
          extract($_GET);             
          $a=0;
          $miconexion->consulta("select * from categoria_producto");
          $miconexion->consulta_lista1();
          ?>
        </div>       
      </div>       
    </div><br><br>
    <!-- Inicio de catalogo --> 
    <div class="span7">          
      <section id="catalogo">
        <?php
        if (isset($id)) {
          if ($id=='todos') {
<<<<<<< HEAD
            $miconexion->consulta("SELECT p.*, e.estado AS estados FROM producto p, categoria_estado e where p.id_estado=e.id and p.estado='s'");
            $miconexion->consultacatalogo();
          }elseif ($id=='oferta') {
            $miconexion->consulta("SELECT p.*, e.estado AS estados FROM producto p, categoria_estado e where p.id_estado=e.id and p.estado='s' and e.estado <>'Normal'");
            $miconexion->consultacatalogo();
          }else{
            $miconexion->consulta("SELECT p.*, e.estado AS estados FROM producto p, categoria_estado e where p.id_estado=e.id and p.id_categoria=".$id);
            $miconexion->consultacatalogo();
          }
        }else{
          $miconexion->consulta("SELECT p.*, e.estado AS estados FROM producto p, categoria_estado e where p.id_estado=e.id");
          $miconexion->consultacatalogo();
        }

        ?>
        <div id="fade" class="black_overlay"></div>
      </section>
      <!-- Fin catalogo -->

      <div class="span3">  

        <div id="modal1" class="modalmask">

          <div class="modalbox movedown">

            <a href="index.php" title="Close" class="close">X</a>
            <?php
            $miconexion->consulta("select * from producto where id=".$_GET['id']);
            $miconexion->descatalogo2();
            ?>
          </div>
        </div>
      </div>

      <div class="span4">  
        <?php 
        include("static/pedido.php");
        ?>  
      </div>

    </div>
    

    <!-- Services Footer -->
    
=======
         $miconexion->consulta("SELECT p.*, e.estado AS estados FROM producto p, categoria_estado e where p.id_estado=e.id and p.estado='s'");
         $miconexion->consultacatalogo2();
       }elseif ($id=='oferta') {
        $miconexion->consulta("SELECT p.*, e.estado AS estados FROM producto p, categoria_estado e where p.id_estado=e.id and p.estado='s' and e.estado <>'Normal'");
        $miconexion->consultacatalogo2();
      }else{
        $miconexion->carpromocion();
        $miconexion->consulta("SELECT p.*, e.estado AS estados FROM producto p, categoria_estado e where p.id_estado=e.id and p.id_categoria=".$id);
        $miconexion->consultacatalogo2();
      }
    }else{
      $miconexion->consulta("SELECT p.*, e.estado AS estados FROM producto p, categoria_estado e where p.id_estado=e.id");
      $miconexion->consultacatalogo2();
    }

    ?>
    <div id="fade" class="black_overlay"></div>
  </section>
  <!-- Fin catalogo -->
  <div id="modal1" class="modalmask">

    <div class="modalbox movedown">

      <a href="#" title="Close" class="close">X</a>
      <?php
      $miconexion->consulta("select * from producto where id=".$_GET['id']);
      $miconexion->descatalogo2();
                                      
      ?>
    </div>
  </div>
</div>

<div class="span3">  
  <?php 
  include("static/pedido.php");     
  ?>  
</div>
</div>
<hr>
>>>>>>> f011f75d2808183eacc29e2f7c3062ea9563ba96

<!-- Services Footer -->

<<<<<<< HEAD
    <!-- /container -->
=======


<!-- /container -->
>>>>>>> f011f75d2808183eacc29e2f7c3062ea9563ba96

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
<<<<<<< HEAD
=======

>>>>>>> f011f75d2808183eacc29e2f7c3062ea9563ba96
    <footer style="background: #423E3E;">
      <?php include("static/footer.php") ?>
    </footer>
    </html>
    <?php
  }else{
    echo '<script>location.href = "login.php";</script>'; 
  }
  ?>
