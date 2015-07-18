
<?php 
header('Content-Type: text/html; charset=ISO-8859-1');
include("static/site_config.php"); 
include ("static/clase_mysql.php");
$miconexion = new clase_mysql;
$miconexion->conectar($db_name,$db_host, $db_user,$db_password);
?>

<?php
//nheader ("Refresh: 60; URL=http://127.0.0.1/carrito_final/Carrito_de_compras/Online/principal.php");
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
    <script src="js/modernizr.js"></script> <!-- Modernizr -->
    <link rel="stylesheet" type="text/css" href="css/jquery.lightbox.css">


    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <link rel="shortcut icon" href="http://www.azulweb.net/wp-content/uploads/2014/02/icono-2.png" />
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    <link rel="stylesheet" href="css/estilos.css">
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
             .container
           {
                width: 80%;
           }

           .btn
           {
            display: block;
            width: 123%;
            margin-left: 2.1em;
           }


    

        }
        input.buscador
            {
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
          margin-left: -67px;
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
                    $a=0;
                    $miconexion->consulta("select * from categoria_producto");
                    for ($i=0; $i < $miconexion->numregistros(); $i++) {                 
                        $a=$a+1;
                        $lista=$miconexion->consulta_lista();
                        echo "<button name= btn_cat class='btn btn-xl1' data-filter='.".$lista[1]."'><a href='principal.php?id=".$lista['id']."' class='nav$a' data-type='".$lista[1]."'>".$lista[1]."</a>

                    </button>";

                }
                ?>
                <br>    
                <br>

                <section class="Adornos">    
            <img class="imagenes" src="img/impresora1.jpg" width='300' height='300'  margin-left: 1%;>


            <br>
            <br>
            <br>
              <img class="imagenes" src="img/celular1.jpg" width='300' height='300'>
              <br>
               <br>
               <br>
              <img class="imagenes" src="img/bank.png" width='300' height='300'>
        </section>
            </div>





            <div class="container1">
                <div class="col-md-10"> 
                    <aside id="modulos">         
                        <div class="cd-filter-conten"> 
                         <div class="row">
                                    <div class="form center">
                                        <br>
                                     
                                            <input type="text" class="buscador" name="search" id="search"  placeholder="Buscar producto">                                        </form>                                        </form>
                                    </div>
                            </div>

                            <div id="re"></div>
                            <div class="footer center">
                        </div>
            </div>


           


      
<!-- Inicio de catalogo -->

<!-- Inicio catalogo -->
    <?php
    $miconexion->consulta("SELECT p.*, e.estado AS estados FROM producto p, categoria_estado e where p.id_estado=e.id");
    $miconexion->consultacatalogo2();
    ?>

    
    <div id="light" class="white_content">
        <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">
            <button type="button" class="close" aria-label="Close">
                <span  style="color:#0044cc;" aria-hidden="true">&times;</span>
            </button>
        </a>
    </div>
    <div id="fade" class="black_overlay"></div>

<!-- Fin catalogo -->

</section>

</div>
</div>


<script language="javascript" type="text/javascript">
    function enviar(pagina){
        document.selec_con.action = pagina;
        document.selec_con.submit();

    }
</script>
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
