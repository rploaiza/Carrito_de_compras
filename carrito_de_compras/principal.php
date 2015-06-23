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

    <title>Line Buy</title>

    <!-- Bootstrap Core CSS -->
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

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Menu de Navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top"></a>
                <!--<a class="navbar-brand page-scroll" href="#page-top" style="margin-left:45%;";>LINE BUY</a> -->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="http://localhost/carritovirtual/"><img style="width: 10%;" src="img/logo.png"></a>
                        
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Catalogos</a>
                    </li>
                  
                    <li>
                        <a class="page-scroll" href="index.php">Comprar</a>
                    </li> 
                    <li>
                        <a class="page-scroll" href="mis_pedidos.php">Mis Pedidos</a>
                    </li>                    
                    <li>
                        <a class="page-scroll" background="red" href="login.php">Login</a>
                    </li> 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">  
                <div class="intro-heading">Line Buy</div>              
                <div class="intro-lead-in">Compre nuestros productos en linea...</div>
                
                <a href="login.php" class="page-scroll btn btn-xl">Comprar</a>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <h4>Categorias</h4>
                    <h3 class="section-subheading text-muted">Compre nuestros productos en linea...</h3>
                    <?php
                    $a=0;
                    $miconexion->consulta("select * from categoria_producto");
                    for ($i=0; $i < $miconexion->numregistros(); $i++) {                 
                        $a=$a+1;
                        $lista=$miconexion->consulta_lista();
                        echo "<button class='btn btn-xl1' data-filter='.".$lista[1]."'><a href='#0' class='nav$a' data-type='".$lista[1]."'>".$lista[1]."</a>
                        </button>";
                      }
                    ?>

                </div>
                <div class="col-md-8">
                    <h4>Catalogos</h4>
                       <aside id="modulos">         
                        <div class="cd-filter-content">
                            <h3>Filtrar: <input type="search" placeholder="Buscar..."> </h3>
                        </div> <!-- cd-filter-content -->

                        <div class="cd-filter-content"> 
                           <div id="contenedor">
                                <div id="boton" onclick="divLogin()">
                                    Busqueda Avanzada
                                </div>

                                <div id="caja">
                                    
                                </div>   
                            </div>  
                        </div>
                            <section class="cd-gallery">
                            <ul class='gallery'>
                                <?php
                                    $miconexion->consulta("select p.*, c.categoria from categoria_producto c, producto p where c.id_categoria = p.id_categoria");
                                    for ($i=0; $i < $miconexion->numregistros(); $i++) {                 
                                        $lista=$miconexion->consulta_lista();
                                             echo "<li class='mix ".$lista[7]." ".$lista[1]." ".$lista[2]." ".$lista[4]."'>".$lista[1]."
                                                    <a href='".$lista[3]."' data-caption='".$lista[1]." | ".$lista[4]." | Valor: $".$lista[2]." | En Stock: ".$lista[5]."'>
                                                    <img class='p-imag' src='".$lista[11]."' alt='".$lista[1]."'>Valor: $".$lista[2]."</a></li>";
                                                      
                                      }
                                ?>
                            </ul>
                            <div class="cd-fail-message">No hay resultados</div>
                        </section> <!-- cd-gallery -->
                        </aside> 
                </div>
            </div>
        </div>
    </section>


    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; Your Website 2014</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->


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
    </script>

</body>

</html>