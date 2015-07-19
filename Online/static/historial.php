
<?php
  if(!empty($_POST['codigo'])){
    $codigo=$_POST['codigo'];
    $pa=mysql_query("SELECT * FROM historial WHERE codigo='$codigo'");        
    if($row=mysql_fetch_array($pa)){
      
    }else{
      mysql_query("INSERT INTO historial (codigo, url) VALUES ('$codigo','1')");
    }
  }
?>
<div id="sidebar"><br>
  <h2 align="center">
    <a style="color:#0D47A1;"  href=""><img style="width: 15%;" src="ico/pedidos.png">Mi Historial</a>
  </h2>
  <table class="table table-bordered">
    <tr>
      <td>
        <table class="table table-bordered table table-hover">
          <?php 
            //$neto=0;$tneto=0;
            $pa=mysql_query("SELECT * FROM historial");       
            while($row=mysql_fetch_array($pa)){
              $oProducto=new Consultar_Producto($row['codigo']);
              //$neto=$oProducto->consultar('valor')*$row['cantidad'];
              //$tneto=$tneto+$neto;    
          ?>
              <tr style="font-size:9px">
                <td><?php echo $oProducto->consultar('nombre'); ?></td>
                <td><?php echo $row['url']; ?></td>
              <!--  <td>$ <?php echo number_format($neto,2,",","."); ?></td>-->
              </tr> 
          <?php
            }
          ?>
          <td colspan="4" style="font-size:9px">
          </td>
          <?php 
            $pa=mysql_query("SELECT * FROM carrito");       
            if(!$row=mysql_fetch_array($pa)){
              ?>
              <tr>
                <div class="alert alert-success" align="center"><strong>No hay Productos Registrados</strong></div>
              </tr>
          <?php } ?>
        </table>
      </td>
    </tr>
  </table>
</div>