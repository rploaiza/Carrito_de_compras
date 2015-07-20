

<div id="sidebar"><br>
  <h2 align="center">
    <a style="color:#0D47A1;"  href=""><img style="width: 15%;" src="ico/history.png">Mi Historial</a>
  </h2>
  <table class="table table-bordered">
    <tr>
      <td>
        <table class="table table-bordered table table-hover">
          <?php
            $pa=mysql_query("SELECT * FROM historial");       
            while($row=mysql_fetch_array($pa)){
              $oProducto=new Consultar_Producto($row['codigo']); 
          ?>
              <tr style="font-size:9px">
                <td><?php echo $oProducto->consultar('nombre'); ?></td>
                <td><?php echo $row[1]; ?></td>
              </tr> 
           <?php }
            ?>
            <?php
            extract($_POST);
            extract($_GET);
           echo '<form method="post">
            <td colspan="4" style="font-size:9px">
            <br>
            <button align="right" type="submit" name="delete" value="delete">Limpiar</button>
            <br>
            </form> ';
               if (isset($_REQUEST['delete'])) {
                echo"<script> alert('Historial Borrado');</script>"; 
                $miconexion->consulta("TRUNCATE TABLE `historial`");
                echo "<script>location.href='principal.php'</script>";
                
               }
            ?>      

            </td>
            <?php 
            $pa=mysql_query("SELECT * FROM historial");       
            if(!$row=mysql_fetch_array($pa)){
              ?>
              <tr>
                <div class="alert alert-success" align="center"><strong>Historial Limpio</strong></div>
              </tr>
          <?php } ?>
        </table>
      </td>
    </tr>
  </table>
</div>

               