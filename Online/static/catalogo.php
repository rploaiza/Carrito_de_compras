<!-- Inicio de catalogo -->
            <br>
            <section id="catalogo">

              <?php
              $miconexion->consulta("SELECT * FROM producto where estado='s'");
              $miconexion->consultacatalogo();
              //$pa=mysql_query("SELECT * FROM producto where estado='s'");       
            
    
                include("detalle_producto.php"); /*Esta en un archivo detalle_producto.php en carpeta static*/
                ?>
            
              </section>
              <!-- Fin catalogo -->
