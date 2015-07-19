
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
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <script src="js/modernizr.js"></script>
    <!-- Modernizr -->
    <link rel="stylesheet" type="text/css" href="css/jquery.lightbox.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <link rel="shortcut icon" href="http://www.azulweb.net/wp-content/uploads/2014/02/icono-2.png" />
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    <link rel="stylesheet" href="css/estilos.css">
    <?php
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
        mysql_query("DELETE *FROM carrito WHERE codigo='$id'");
        header('location:index.php');
      }
      ?>
    <style>
        @media (min-width: 768px) {
            .container {
              width: 80%;
            }
            .btn{
                display: block;
                width: 17%;
            }
        }
        @media (min-width: 400px){
            .container{
                width: 80%;
            }
            .btn{
                display: block;
                width: 123%;
                margin-left: 2.1em;
            }
        }
        input.buscador{
            width: auto;
            background: url("img/lupa.png") no-repeat scroll 0 0 transparent;
            background-position: 11em 0.1em;
            background-color: #205FA7;
            color: #FFFFFF;
            cursor: pointer;
            margin-left: -65%;
            padding: 1%;
        }
        .row {
            margin-right: -1px;
            margin-left: -63px;
        }

</style>
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
                        $miconexion->consulta("select * from categoria_producto");
                        $miconexion->consulta_lista2();


                    ?>
                    <div style="width: 180%">  
                        <?php 
                            include("static/pedido2.php");
                            include("static/historial.php");
                            
                        ?>  
                        <br>
                        <img src="img/celular1.jpg" style="width:100%;">
                        <br><br>
                        <img src="img/bank.png" style="width:100%;">
 
                    </div>
                        
                      
                </div>
                <div class="container1">
                    <div class="col-md-10"> 
                        <aside id="modulos">         
                            <div class="cd-filter-conten"> 
                               <div class="row">
                                    <div class="form center">
                                        <br><input type="text" class="buscador" name="search" id="search"  placeholder="Buscar producto">
                                    </div>
                                </div>
                                <div id="re"></div>
                                <div class="footer center"></div>
                            </div>
                            <!-- Inicio catalogo -->                     
                                <?php
                                extract($_POST);
                                extract($_GET);
                                if (isset($id)) {
                                    if ($id=='todos') {
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
                                <div id="modal1" class="modalmask">

                                <div class="modalbox movedown">

                                    <a href="principal.php" title="Close" class="close">X</a>
                                    <?php
                                        $miconexion->consulta("select * from producto where id=".$_GET['id']);
                                        $miconexion->descatalogo();

                                  function dameURL(){
                                  $url="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']."#modal1";
                                  return $url;
                                  }
                                  
                     
                                        ?>
                                    </div>
                                </div>
                            
                              <!-- Fin catalogo -->
                       
                    </div>
                    <br>
                                <br>
                                <br>
                     </aside>
                </div>
            </div>   
        </div> 
    </section>
    <script language="javascript" type="text/javascript">
        function enviar(pagina){
            document.selec_con.action = pagina;
            document.selec_con.submit();

        }
    </script>
    <!--jQuery -->
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
    <script src="js/main.js"></script>
    <!-- Resource jQuery -->
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
    <footer  style="background:#423E3E;" >
        <?php include("static/footer.php") ?>
    </footer>
</body>
</html>
