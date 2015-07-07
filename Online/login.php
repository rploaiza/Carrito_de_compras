<?php
session_start();
if (isset($_SESSION['usuario'])){
    echo $_SESSION['usuario']." ==  lcchalan";
    if ($_SESSION['usuario'] == 'lcchalan') {
        echo '<script>location.href = "administrador.php";</script>';     
    }else{
        if ($_SESSION['usuario']=='jromero') {
            echo '<script>location.href = "administrador2.php";</script>'; 
        }else{
            echo '<script>location.href = "index.php";</script>';   
        }
    }
}else{
    ?>

<!DOCTYPE html>
<html lang="es">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Line Buy - Login</title>
    <!-- Bootstrap Core CSS -->
    <!-- Custom CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/agency.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
  

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

<body style="background-image: url(img/blue.jpg);">
  <!-- Header -->
    <header>

<a style="float: right;  width: 11%;" href="principal.php"><img style="width: 150%;" id="home" src="ico/home.png"></a>
<div class="container">
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
                <br>
                <br>
                <br>
                <style>

                    .panel-heading{
                        background-color: #F9F9F9; 
                        border-bottom: 1px solid rgb(221, 221, 221);                  
                    }

                    .panel-body{
                        background-color: #F9F9F9;
                        
                    }

                    .panel-footer{
                        background-color: #F9F9F9;                   
                    }
                    
                </style>
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-lock"></span> Login</div>
                <div class="panel-body">

                <form clase="form" method="POST" action="return false" onsubmit="return false">
                <div id="resultado"></div>
                <input type="text" name="user" id="user" value="" placeholder="USUARIO"><br><br>
                <input type="password" name="pass" id="pass" value="" placeholder="*******"><br><br><br>
                <button id="login-button" onclick="Validar(document.getElementById('user').value, document.getElementById('pass').value);"><img style=" width: 23%;" src="img/key.png">ENTRAR</button>
                </form>
                <script>
                function Validar(user, pass)
                {
                    $.ajax({
                        url: "validar.php",
                        type: "POST",
                        data: "user="+user+"&pass="+pass,
                        success: function(resp){
                            $('#resultado').html(resp)
                        }        
                    });
                }
            </script>    
                </div>
                <div class="panel-footer">
                    No esta registrado? 
                    <a data-toggle="modal" href="#betaModal">
                        Registrese aquí
                    </a>
                </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>
</div>

<div id="betaModal" class="modal hide fade">
    <div class="modal-header">
            <button class="close" data-dismiss="modal">×</button>
    </div>
    <div class="modal-body">

    <div class="container">
<div class="col-md-5">
    <style>
        .form-group{
            width: 100%;
        }

        form input:focus {
          width: 100%;
        }
    </style>
    <div class="form-area">  
        <form name="sentMessage" id="contactForm"  method="post" novalidate>
        <h5 style="margin-bottom: 20px; text-align: center;">Ingrese sus datos</h5>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Cedula" name="cedula" required="" autofocus="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nombre" name="nombre" required="" autofocus="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Apellido" name="apellido" required="" autofocus="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Direccion" name="direccion" required="" autofocus="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Telefono" name="telefono" required="" autofocus="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" name="email" required="" autofocus="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="User" name="user" required="" autofocus="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Pass" name="pass" required="" autofocus="">
                    </div>            
        <button type='submit' name="guardar" value="guardar">Registrarse</button>
        <button type='submit' name="guardar" value="guardar">Salir</button>
        </form>
    </div>
</div>
</div>
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
                                echo "<script>location.href='login.php'</script>"; 
                            }else{
                                echo "<script language='javascript'> alert('Se ha registrado con exito)</script>";
                                echo "<script>location.href='login.php'</script>"; 
                            }
                        }
                    ?>
                <!--FIN REGISTRO-->

                </div>
            </div>
        </div>
    </section>
                </div>
            </div>
        </div>
    </div>
</div>


    </header>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>

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

  </body>
</html>

<?php
}
?>
