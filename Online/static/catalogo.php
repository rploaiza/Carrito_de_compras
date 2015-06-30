<!-- Inicio de catalogo -->
            <br>
            <section id="catalogo">

              <?php
              $pa=mysql_query("SELECT * FROM producto where estado='s'");       
              while($row=mysql_fetch_array($pa)){
                ?>    

                <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';
                    document.getElementById('fade').style.display='block'"><img id="imagen" src="img/producto/<?php echo $row['codigo']; ?>.jpg" width="100%"></a>
                    <div class="caption">
                      <h5><?php echo $row['nombre'];?></h5>
                      <p id="catal" style="color:#0044cc;">$<?php echo number_format($row['valor'],2,",","."); ?></p>
                      <p id="catal"><?php echo $row['nota'];?></p>
                      <p id="catal">
                        <form name="form<?php $row['codigo']; ?>" method="post" action="">
                          <input type="hidden" name="codigo" value="<?php echo $row['codigo']; ?>">
                          <button type="submit" name="boton" class="btn-comprar">
                            <!-- <i class="icon-shopping-cart"></i>--> <strong style="font-size:55%;" >Agregar al Carrito</strong>
                          </button>
                        </form> 
                      </p>
                    </div>
                  </div>
                </div>
                <?php 
                include("detalle_producto.php"); /*Esta en un archivo detalle_producto.php en carpeta static*/
                ?>
                <?php } ?>      
              </section>
              <!-- Fin catalogo -->
