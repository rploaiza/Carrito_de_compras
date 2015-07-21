

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
                <td><?php echo $row[2]; ?></td>
              </tr> 
           <?php }
            ?> 
              <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.js"></script>
              <script type="text/javascript">
                $(document).ready(function() {
                  <?php 
                  $miconexion->consulta("SELECT COUNT(id) FROM historial WHERE id");
                  $var=$miconexion->consulta_lista();
                  if ($var[0] == 15) {
                     $miconexion->consulta("DELETE FROM historial WHERE id LIMIT 1");  
                  }
                  ?>
                }); 
              </script>
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

               