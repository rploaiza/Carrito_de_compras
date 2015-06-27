
            <?php
        if(!empty($_POST['codigo'])){
          $codigo=$_POST['codigo'];
          $pa=mysql_query("SELECT * FROM carrito WHERE codigo='$codigo'");        
          if($row=mysql_fetch_array($pa)){
            $new_cant=$row['cantidad']+1;
            mysql_query("UPDATE carrito SET cantidad='$new_cant' WHERE codigo='$codigo'");
          }else{
            mysql_query("INSERT INTO carrito (codigo, cantidad) VALUES ('$codigo','1')");
          }
        }
      ?>
               <div id="sidebar"><br><br><br>
                  <h2 align="center"><a style="color:#0D47A1;"  href="mis_pedidos.php">Mis Pedidos</a></h2>
                  <table class="table table-bordered">
                      <tr>
                        <td>
                          <table class="table table-bordered table table-hover">
                            <?php 
                $neto=0;$tneto=0;
                $pa=mysql_query("SELECT * FROM carrito");       
                while($row=mysql_fetch_array($pa)){
                  $oProducto=new Consultar_Producto($row['codigo']);
                  $neto=$oProducto->consultar('valor')*$row['cantidad'];
                  $tneto=$tneto+$neto;
                  
              ?>
                              <tr style="font-size:9px">
                                <td><?php echo $oProducto->consultar('nombre'); ?></td>
                                <td><?php echo $row['cantidad']; ?></td>
                                <td>$ <?php echo number_format($neto,2,",","."); ?></td>
                                <td>
                                  <a href="index.php?del=<?php echo $row['codigo']; ?>" title="Eliminar de la Lista">
                                    <button type="button" class="close" aria-label="Close">
      <span  style="color:#0044cc;" aria-hidden="true">&times;</span>
    </button>
                                    </a>
                                </td>
                              </tr>
                            <?php }
              ?>
                              <td colspan="4" style="font-size:9px"><div align="right">$<?php echo number_format($tneto,2,",","."); ?></div></td>
                            <?php 
                $pa=mysql_query("SELECT * FROM carrito");       
                if(!$row=mysql_fetch_array($pa)){
              ?>
                              <tr><div class="alert alert-success" align="center"><strong>No hay Productos Registrados</strong></div></tr>
                <?php } ?>
                            </table>
                        </td>
                      </tr>
                    </table>
                </div>