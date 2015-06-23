<!DOCTYPE html>
<html lang="es">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Line Buy - Registro</title>

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
                <a class="navbar-brand page-scroll" href="principal.php"><img style="width: 20%;" src="img/logo.png"></a>
                <!--<a class="navbar-brand page-scroll" href="#page-top" style="margin-left:45%;";>LINE BUY</a> -->
            </div>

            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>


      <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Registro</h2>
                    <h3 class="section-subheading text-muted">Ingrese sus datos para que realice sus compras en LINE</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <!--INICIO REGISTRO-->
                    <form name="sentMessage" id="contactForm"  method="post" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" placeholder="Cedula" name="cedula" required="" autofocus="" type="text">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Nombre" name="nombre" required="" autofocus="" type="text">                                    
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                   <input class="form-control" placeholder="Apellido" name="apellido" required="" autofocus="" type="text">
                                   <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                   <input class="form-control" placeholder="Direccion" name="direccion" required="" autofocus="" type="text">
                                   <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   <input class="form-control" placeholder="Telefono" name="telefono" required="" autofocus="" type="text"> 
                                   <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                   <input class="form-control" placeholder="Email" name="email" required="" autofocus="" type="text">
                                   <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                   <input class="form-control" placeholder="User" name="user" required="" autofocus="" type="text"> 
                                   <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                   <input class="form-control" placeholder="Pass" name="pass" required="" autofocus="" type="text">                                          
                                   <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                
                                <button type='submit' class="btn btn-xl" name="guardar" value="guardar">Registrarse</button>
                            </div>
                        </div>
                    </form>
                     <?php
                        include ("static/site_config.php");
                        include ("static/clase_mysql.php");
                        extract($_POST);
                        $miconexion = new clase_mysql;
                        $miconexion->conectar($db_name,$db_host, $db_user,$db_password);
                        
                        if (isset($_REQUEST['guardar'])AND $cedula!= 0 AND $nombre!=NULL AND $apellido!=NULL AND $direccion!=NULL AND $telefono!=0 AND $user!=NULL AND $pass!=NULL) {    
                                $ressql=$miconexion->consulta("INSERT INTO usuario VALUES ('','3','".$cedula."','".$nombre."','".$apellido."','".$direccion."','".$telefono."','".$email."','".$user."','".$pass."')");            
                            if ($ressql==NULL) {             
                                echo "<script language='javascript'> alert('No se ha podido registrar vuelva ha intentar')</script>";
                                echo "<script>location.href='registro.php'</script>"; 
                            }else{
                                echo "<script language='javascript'> alert('Se ha registrado con exito)</script>";
                                echo "<script>location.href='login.php'</script>"; 
                            }
                        }else{
                            echo "<script language='javascript'> alert('Ud. no ha ingresado todos los campos')</script>";
                        }
                    ?>
                <!--FIN REGISTRO-->

                </div>
            </div>
        </div>
    </section>

    <footer>
        <?php include("static/footer.php") ?>
    </footer>







    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../bootstrap/js/ie10-viewport-bug-workaround.js"></script>

    <script src="../../../bootstrap/js/offcanvas.js"></script>
  </body>
</html>

