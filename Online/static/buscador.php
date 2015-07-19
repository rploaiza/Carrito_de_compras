<?php 
	require_once('../static/site_config.php');

	sleep(1);

	$search = '';
	if (isset($_POST['search'])){
		$search = strtolower($_POST['search']);
	}

	$consulta = "select distinct p.*, e.estado from categoria_producto c, producto p, categoria_estado e WHERE p.id_categoria=c.id and p.id_estado = e.id and c.categoria LIKE '%".$search."%' and p.marca LIKE '%".$search."%' and p.valor LIKE '%".$search."%' or c.categoria LIKE '%".$search."%' and p.id_categoria=c.id and p.id_estado = e.id or p.marca LIKE '%".$search."%' and p.id_categoria=c.id and p.id_estado = e.id or p.id_categoria=c.id and p.valor LIKE '%".$search."%' and p.id_estado = e.id ";
	//$consulta = "select distinct  p.*, e.estado from categoria_producto c, producto p, categoria_estado e WHERE p.id_categoria=c.id_categoria and p.id_estado = e.id_categoria_estado and c.categoria LIKE '%".$search."%'  and p.marca LIKE '%".$search."%' and p.valor LIKE'%".$search."%'  

	// or c.categoria LIKE '%".$search."%' and p.id_categoria=c.id_categoria and p.id_estado = e.id_categoria_estado or p.marca  LIKE '%".$search."%' and p.id_categoria=c.id_categoria and p.id_estado = e.id_categoria_estado or  p.id_categoria=c.id_categoria and p.valor  LIKE '%".$search."%' and p.id_estado = e.id_categoria_estado


	//ORDER BY valor DESC LIMIT 5";
	$resultado = $connect->query($consulta);
	$fila = mysqli_fetch_assoc($resultado);
	$total = mysqli_num_rows($resultado);
?>
<?php if ($total>0 && $search!='') { ?>
	<h2>Resultados de la búsqueda</h2>
	<?php do { error_reporting(0);?>


	<style>

	.borde 
	{
	  background-color: #E7E7E7;
	  height: 13em;
	  margin-left: 18%;
	  margin-right: -20%;
	  border-radius: 0.5em;
	}
		
	</style>


	<div class="container">
        <div class="row">
				<div class='col-md-10'>
					<div class="borde">
						<span class="titulo"><?php echo str_replace($search, '<strong>'.$search.'</strong>', utf8_encode($fila['nombre'])) ?>
						</span>
						<br><br><br>
					<?php echo "
						<div class='col-md-6'> 
			                <div id ='consul'class='titulo'>
				                <center>
				                   	<img class='p-imag' width='100' height='150' src='".$fila['imagen']."' alt='".$lista['nombre']."'>
									<br>
				                    <strong>Marca: ".$fila['marca']."</strong>
				                 </center>   
			                </div>
			            </div>

						<div class='col-md-4'>                      
		                    <p>
		                        <strong>Descripcion: </strong>".$fila['nota']."<br>  
		                        <strong>Valor: </strong>$".$fila['valor']." <br> 
		                        <strong>Estado: </strong>".$fila['estado']."<br> 
		                    </p>
		                </div>";
		                ?>
	                <br>
	            </div>              
	    	</div>
    	</div>
    </div>

     <hr>


	<?php } while ($fila=mysqli_fetch_assoc($resultado)); ?>
<?php } 
elseif($total>0 && $search=='') echo '<h2>Ingresa un parámetro de búsqueda</h2><p>Ingresa palabras clave relacionadas con el tema de esta web</p>';
else echo '<h2>No se han encontrado resultados</h2><p>Inténta realizar tu búsqueda con palabras más especificas...</p>';
?>
