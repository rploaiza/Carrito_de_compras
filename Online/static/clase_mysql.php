<?php
class clase_mysql{
	/*Variables para la conexion a la db*/
	var $BaseDatos;
	var $Servidor;
	var $Usuario;
	var $Clave;
	/*Identificadores de conexion y consulta*/
	var $Conexion_ID = 0;
	var $Consulta_ID = 0;
	/*Numero de error y error de textos*/
	var $Errno = 0;
	var $Error = "";
	function clase_mysql(){
 		//cosntructor
	}

	function conectar($db, $host, $user, $pass){
		if($db!="") $this->BaseDatos = $db;
		if($host!="") $this->Servidor = $host;
		if($user!="") $this->Usuario = $user;
		if($pass!="") $this->Clave = $pass;

 		//conectamos al servidor de db
		$this->Conexion_ID=mysql_connect($this->Servidor,$this->Usuario, $this->Clave);
		if(!$this->Conexion_ID){
			$this->Error="La conexion con el servidor fallida";
			return 0;
		}

		//Seleccionamos la base de datos
		if(!mysql_select_db($this->BaseDatos, $this->Conexion_ID)){
			$this->Error="Imposible abrir ".$this->BaseDatos;
			return 0;
		} 	
		/*Si todo tiene exito, retorno el identificador de la conexion*/
		return $this->Conexion_ID;
	}	

 	//Ejecuta cualquier consulta
	function consulta($sql=""){
		if($sql==""){
			$this->Error="NO hay ningun sql";
			return 0;
		}
 		//ejecutamos la consulta
		$this->Consulta_ID = mysql_query($sql, $this->Conexion_ID);
		if(!$this->Consulta_ID){
			$this->Errno = mysql_errno();
			$this->Error = mysql_error();
		}
 		//retorna la consulta ejecutada
		return $this->Consulta_ID;
	}

	
	function consultaUpdate($sql=""){
		echo "<form name='actualizar' method='post' action='administrador.php'>";
		while ($row = mysql_fetch_array($this->Consulta_ID)) {
			for ($i=0; $i < $this->numcampos(); $i++) { 
				echo "<div class='form-group'>";
				if ($i==0) {
					$id=$row[$i];
				}else{
					echo mysql_field_name($this->Consulta_ID, $i).":<input class='form-control' value='".$row[$i]."' name='".$this->nombrecampo($i)."' type='text'>";
					echo "<p class='help-block text-danger'></p>";
					echo "</div>";
				}

			}
			echo "<br>";                           
		}
		echo "<button type='submit' class='btn btn-xl' name='actualizar' value='actualizar'>Actualizar</button>"; 
		echo "</form>";
	}



	function consultacatalogo(){
		while ($row = mysql_fetch_array($this->Consulta_ID)) {
			?>  
			<div class="producto2">       
				<a href="principal.php?id=<?php echo $row['id'];?>&#modal1"><img src="<?php echo $row['imagen']; ?>" width="100%"></a>
				<div class="caption" >
					<h5 style="height: 18px"><?php echo $row['nombre'];?></h5>
					<p style="color:#0044cc;">$<?php echo number_format($row['valor'],2,",","."); ?></p>
					<?php	
					if ($row['estados']=='normal') {
						echo "<p id='normal' style='color:blue;'>".$row['estados']."</p>";
					}elseif ($row['estados']=='oferta') {
						echo "<p id='oferta' style='color:red;'>".$row['estados']."</p>";
					}else{
						echo "<p id='promocion' style='color:green;'>".$row['estados']."</p>";					
					}
					?>	
					<p>
						<form name="form<?php $row['codigo']; ?>" method="post" action="">
							<input type="hidden" name="codigo" value="<?php echo $row['codigo']; ?>">
							<button type="submit" name="boton" class="btn-comprar">
								<strong style="font-size:55%;">COMPRAR</strong>
							</button>
						</form> 
					</p>
				</div>
			</div>
			<?php
		}
	}

	function descatalogo(){
		while ($row = mysql_fetch_array($this->Consulta_ID)) {
			?>  
			<div class="row">
				<div class="col-md-12">
				<span style="text-align:center; color:#0D47A1"><strong><?php echo $row['nombre'];?></strong></span><br><br>
					<div class="row">
						<div class="col-md-3 col-md-push-7">
							<img src="<?php echo $row['imagen'];?>"><br><br>
						</div>
						<div class="col-md-5 col-md-pull-1" style="text-align:left;">
							<span><strong>Marca:</strong></span>
							<span><?php echo $row['marca'];?></span><br><br>
							<span><strong>Precio:</strong></span>
							<span>Precio: <?php echo $row['valor'];?></span><br><br>
							<span><strong>Caracteristicas:</strong></span>
							<strong><span><?php echo $row['nota'];?></span></strong><br><br>
							<?php
								$res='"'.dameURL().'"';			
								mysql_query("INSERT INTO historial (codigo, url) VALUES ('$row[4]','<a href=$res>link</a>')");
							?>
					</div>
				</div>
			</div>
			<?php
		}
	}

	function consultacatalogo2(){
		while ($row = mysql_fetch_array($this->Consulta_ID)) {
			?>  
			<div class="producto">        
				<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';
				document.getElementById('fade').style.display='block'"><img src="<?php echo $row['imagen']; ?>" width="100%"></a>
				<div class="caption" >
					<h5><?php echo $row['nombre'];?></h5>
					<p style="color:#0044cc;">$<?php echo number_format($row['valor'],2,",","."); ?></p>
					<p><?php echo $row['nota'];?></p>
					<?php

					if ($row['estados']=='normal') {
						echo "<p id='normal' style='color:blue;'>".$row['estados']."</p>";
					}elseif ($row['estados']=='oferta') {
						echo "<p id='oferta' style='color:red;'>".$row['estados']."</p>";
					}else{
						echo "<p id='promocion' style='color:green;'>".$row['estados']."</p>";					
					}
					?>

					<p>
						<form name="form<?php $row['codigo']; ?>" method="post" action="">
							<input type="hidden" name="codigo" value="<?php echo $row['codigo']; ?>">
							<button type="submit" name="boton" class="btn-comprar">
								<strong style="font-size:55%;"><a style="color:#fff;" href="login.php">Agregar al Carrito</a></strong>
							</button>
						</form> 
					</p>
				</div>
			</div>
			<?php
		}
	}
 	//Devulve el numero de campos de la culsulta
	function numcampos(){
		return mysql_num_fields($this->Consulta_ID);
	}

 	//Devuleve el numero de registros de la culsulta
	function numregistros(){
		return mysql_num_rows($this->Consulta_ID);
	}

 	//Devuelve el nombre de un campo de la consulta
	function nombrecampo($numcampo){
		return mysql_field_name($this->Consulta_ID, $numcampo);
	}

 	//Muestra los resultados de la consulta
	function verconsulta($bd){
		echo "<div class='table-responsive'> ";
		echo "<table id='example'>";
		echo "<thead>";
		echo "<tr>";
 		//mostrar los nombres de los campos
		for ($i=0; $i < $this->numcampos(); $i++) { 
			echo "<th>".$this->nombrecampo($i)."</th>";
		}
		echo "<th>Borrar</th>";
		echo "<th>Editar</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";		
		while ($row = mysql_fetch_array($this->Consulta_ID)) {
			echo "<tr>";
			for ($i=0; $i < $this->numcampos(); $i++) { 
				echo "<td>".$row[$i]."</td>";
			}
			echo "<td><a href='admin.php?bd=$bd&id=".$row[0]."&act=1&nom=".$this->nombrecampo(0)."'>
			<img src='images/cancel.png'></a></td>";
			echo "<td><a href='admin.php?bd=$bd&id=".$row[0]."&act=2&nom=".$this->nombrecampo(0)."'>
			<img src='images/edit.png'></a></td>";
			echo "</tr>";
		}
		echo "</tbody>";	
		echo "</table>";
		echo "</div>";
	}
 	//Ver tablas
	function verconsultablas(){
		$nonTabla = array("carrito", "categoria_estado", "categoria_producto", "estado", "producto", "usuario");
		$nonTabla1 = array("Tabla Carrito de Compras", "Tabla Estados del Producto", "Tabla Categorias de Productos", "Tabla Descripción de Estados", "Tabla Productos", "Tabla Usuario");

		echo "<form name='formulario' method='post' action='administrador.php'>";
 		//mostrar los nombres de los campos

		while ($row = mysql_fetch_array($this->Consulta_ID)) {
			for ($i=0; $i < $this->numcampos(); $i++) { 
				for ($j=0; $j < 6 ; $j++) { 
					if ($row[0]==$nonTabla[$j]) {

						echo "<button class='btn btn-xl1' data-filter='.".$row[0]."'><a href='administrador.php?tabla=".$row[0]."' name='tablas' value='".$row[$i]."' data-type='".$row[0]."'>".utf8_decode ($nonTabla1[$j])."</a></button>";
						echo "</form>";
					}
				}

			} 
		}		
	}
	function nombreuser(){
		while ($row = mysql_fetch_array($this->Consulta_ID)) {
			echo utf8_decode(utf8_encode($row[3]." ".$row[4]));
		}		
	}

	function consultauser($user,$pass){
		$a=1;
		while ($row = mysql_fetch_array($this->Consulta_ID)) {

			for ($i=0; $i < $this->numcampos(); $i++){
				if ($user==$row[8] AND $pass==$row[9] AND $row[1]==1) {
					$_SESSION["usuario"] = $row[8];
					echo '<script>location.href = "administrador.php"</script>';
					exit();
				}else{
					if ($user==$row[8] AND $pass==$row[9] AND $row[1]==2) {
						$_SESSION["usuario"] = $row[8];
						echo '<script>location.href = "administrador.php"</script>';
						exit();
					}else{
						if ($user==$row[8] AND $pass==$row[9] AND $row[1]==3) {
							$_SESSION["usuario"] = $row[8];
							echo '<script>location.href = "index.php"</script>';
							exit();
						}else{
							if ($a==mysql_num_rows($this->Consulta_ID)) {
								echo "<script language='javascript'> alert('Sus datos son incorrecotos')</script>";
								echo '<script>location.href = "login.php"</script>';

								exit();
							}
						}
					}
				}
			}
			$a++;		
		}		
	}
	function verconsulta2($tabla){

		echo "<table id='example' class='display' cellspacing='0' width='100%'>";
		echo "<thead>";
		echo "<tr>";
		 		//mostrar los nombres de los campos
		for ($i=0; $i < $this->numcampos(); $i++) { 
			echo "<td>".utf8_decode ($this->nombrecampo($i))."</td>";
		}
		echo "<td width='0.3em'>Editar</td>";
		echo "<td width='0.3em'>Borrar</td>";		 			
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		while ($row = mysql_fetch_array($this->Consulta_ID)) {
			echo "<tr>";
			for ($i=0; $i < $this->numcampos(); $i++) { 
				if ($this->nombrecampo($i)=='imagen') {
					echo "<td><img src='".$row[$i]."'></td>";
				}else{
					echo "<td>".$row[$i]."</td>";
				}
				
			}

			echo "<td><a href='administrador.php? id=$row[0]&act=".$this->nombrecampo(0)."&tabla=$tabla&edi=1'><img src='img/editar.png' ></a></td>";
			echo "<td><a href='administrador.php? id=$row[0]&act=".$this->nombrecampo(0)."&tabla=$tabla&edi=2'><img src='img/borrar.png' ></a></td>";
			echo "</tr>";
		}
		echo "</tbody>";	
		echo "</table>";
	}

	function verconsulta5($bd){

		echo "<table id='example' class='display' cellspacing='0' width='100%'>";

		echo "<thead>";


		echo "<tr>";

 		//mostrar los nombres de los campos
		for ($i=0; $i < $this->numcampos(); $i++) { 
			echo "<th>".$this->nombrecampo($i)."</th>";

		}


		echo "<th>Borrar</th>";
		echo "<th>Editar</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";		
		while ($row = mysql_fetch_array($this->Consulta_ID)) {
			echo "<tr>";
			for ($i=0; $i < $this->numcampos(); $i++) { 
				echo "<td>".$row[$i]."</td>";
			}
			echo "<td><a href='admin.php?bd=$bd&id=".$row[0]."&act=1&nom=".$this->nombrecampo(0)."' style='text-decoration:none;'>
			<span class='lnr lnr-pencil'></span></a></td>";
			echo "<td><a href='admin.php?bd=$bd&id=".$row[0]."&act=2&nom=".$this->nombrecampo(0)."' style='text-decoration:none;'>
			<span class='lnr lnr-trash'></span></a></td>";
			echo "</tr>";
		}
		echo "</tbody>";	
		echo "</table>";


	}
	function consulta_lista(){
		while ($row = mysql_fetch_array($this->Consulta_ID)) {
			for ($i=0; $i < $this->numcampos(); $i++) { 
				$row[$i];
				
			}
			return $row;
		}
	}
	function consulta_lista1(){
		while ($row = mysql_fetch_array($this->Consulta_ID)) {

			echo "<button name= btn_cat class='btn btn-xl1' data-filter='.".$row[1]."'><a href='index.php?id=".$row[0]."' class='nava' data-type='".$row[1]."'>".utf8_encode($row[1])."</a></button>";			
		}
		echo "<button name= btn_cat class='btn btn-xl1' data-filter='.".$row[1]."'><a href='index.php?id=todos' class='nava' data-type='".$row[1]."'>Todos</a></button>";
		echo "<button name= btn_cat class='btn btn-xl1' data-filter='.".$row[1]."'><a href='index.php?id=oferta' class='nava' data-type='".$row[1]."'>".utf8_decode(utf8_encode("Ofertas y más..."))."</a></button>";			
	}
	function consulta_lista2(){
		while ($row = mysql_fetch_array($this->Consulta_ID)) {

			echo "<button name= btn_cat class='btn btn-xl1' data-filter='.".$row[1]."'><a href='principal.php?id=".$row[0]."' class='nava' data-type='".$row[1]."'>".utf8_decode(utf8_encode($row[1]))."</a></button>";			
		}
		echo "<button name= btn_cat class='btn btn-xl1' data-filter='.".$row[1]."'><a href='principal.php?id=todos' class='nava' data-type='".$row[1]."'>Todos</a></button>";
		echo "<button name= btn_cat class='btn btn-xl1' data-filter='.".$row[1]."'><a href='principal.php?id=oferta' class='nava' data-type='".$row[1]."'>".utf8_decode("Ofertas y más...")."</a></button>";			
	}

	function consulta_menu(){
		echo "<ul>";
		while ($row = mysql_fetch_array($this->Consulta_ID)) {
			echo "<li class='active'><a href='admin.php?bd=".$row[0]."'>" .utf8_encode($row[0]) . "</a></li>";
		}
		echo "</ul>";
	}



	function consulta_tabla($bd){
		echo '<div class="row">';
		echo '<div class="col-md-6 col-md-offset-3">';
		echo '<form class="form-horizontal" action="include/insertar.php" method="post">';
		echo '<div class="form-group">';
		echo '<label for="bd" class="col-sm-4 control-label"></label>';
		echo '<div class="col-sm-8">';
		echo '<input type="hidden" class="form-control" name="bd" value="'.$bd.'">';
		echo '</div>';
		echo '</div>';
		while ($row = mysql_fetch_array($this->Consulta_ID)) {
			echo '<div class="form-group">';
			echo '<label for="'.$row[0].'" class="col-sm-4 control-label">'.$row[0].'</label>';
			echo '<div class="col-sm-8">';
			if ($row[2]=="NO") {
				if ($row[1]=="text") {
					echo '<textarea class="form-control" rows="10" cols ="30" id="'.$row[0].'" name="'.$row[0].'" placeholder="Ingrese su '.$row[0].'..." required></textarea>';
					echo "<script type='text/javascript'>";
					echo "CKEDITOR.replace ('".$row[0]."');";
					echo "</script>";
				}else if($row[1]=="date"){
					echo '<input type="date" class="form-control" id="focusedInput" name="'.$row[0].'" placeholder="'.$row[0].'" required>';
				}else if($row[3]=="PRI"){
					echo '<input type="text" class="form-control" id="focusedInput" name="'.$row[0].'" placeholder="" disabled=true required>';
				}else{
					echo '<input type="text" class="form-control" id="focusedInput" name="'.$row[0].'" placeholder="'.$row[0].'" required>';
				}
			}else{
				if ($row[1]=="text") {
					echo '<textarea class="form-control" rows="10" cols ="25" id="'.$row[0].'" name="'.$row[0].'" placeholder="Ingrese su '.$row[0].'..."></textarea>';
					echo "<script type='text/javascript'>";
					echo "CKEDITOR.replace ('".$row[0]."');";
					echo "</script>";
				}else if($row[1]=="date"){
					echo '<input type="date" class="form-control" id="focusedInput" name="'.$row[0].'" placeholder="'.$row[0].'">';
				}else if($row[3]=="PRI"){
					echo '<input type="text" class="form-control" id="focusedInput" name="'.$row[0].'" placeholder="" disabled=true >';
				}else{
					echo '<input type="text" class="form-control" id="focusedInput" name="'.$row[0].'" placeholder="'.$row[0].'">';
				}
			}
			echo '</div>';
			echo '</div>';
		}
		echo '<div class="form-group">';
		echo '<div class="col-sm-offset-2 col-sm-10">';
		echo '<button type="submit" class="btn btn-default">Enviar</button>';
		echo '</div>';
		echo '</div> ';      
		echo '</form>';        
		echo '</div>';
		echo '</div>';
	}

	function consulta_tabla2($bd, $list){
		echo '<div class="row">';
		echo '<div class="col-md-6 col-md-offset-3">';
		echo '<form class="form-horizontal" action="include/actualizar.php?" method="post">';
		echo '<div class="form-group">';
		echo '<label for="bd" class="col-sm-4 control-label"></label>';
		echo '<div class="col-sm-8">';
		echo '<input type="hidden" class="form-control" name="bd" value="'.$bd.'">';
		echo '</div>';
		echo '</div>';
		$cont = 0;
		while ($row = mysql_fetch_array($this->Consulta_ID)) {
			echo '<div class="form-group">';
			echo '<label for="'.$row[0].'" class="col-sm-4 control-label">'.$row[0].'</label>';
			echo '<div class="col-sm-8">';
			if ($row[2]=="NO") {
				if ($row[1]=="text") {
					echo '<textarea class="form-control" rows="4" cols ="20" id="'.$row[0].'" name="'.$row[0].'" required>'.$list[$cont].'</textarea>';
					echo "<script type='text/javascript'>";
					echo "CKEDITOR.replace ('".$row[0]."');";
					echo "</script>";
				}else if($row[1]=="date"){
					echo '<input type="date" class="form-control" id="focusedInput" name="'.$row[0].'" value="'.$list[$cont].'" required>';
				}else if($row[3]=="PRI"){
					echo '<input type="text" class="form-control" id="focusedInput" name="'.$row[0].'" value="'.$list[$cont].'" readonly required>';
				}else{
					echo '<input type="text" class="form-control" id="focusedInput" name="'.$row[0].'" value="'.$list[$cont].'" required>';
				}
			}else{
				if ($row[1]=="text") {
					echo '<textarea class="form-control" rows="4" cols ="20" id="'.$row[0].'" name="'.$row[0].'">'.$list[$cont].'</textarea>';
					echo "<script type='text/javascript'>";
					echo "CKEDITOR.replace ('".$row[0]."');";
					echo "</script>";
				}else if($row[1]=="date"){
					echo '<input type="date" class="form-control" id="focusedInput" name="'.$row[0].'" value="'.$list[$cont].'">';
				}else if($row[3]=="PRI"){
					echo '<input type="text" class="form-control" id="focusedInput" name="'.$row[0].'" value="'.$list[$cont].'" readonly >';
				}else{
					echo '<input type="text" class="form-control" id="focusedInput" name="'.$row[0].'" value="'.$list[$cont].'">';
				}
			}
			echo '</div>';
			echo '</div>';
			$cont = $cont + 1;
		}
		echo '<div class="form-group">';
		echo '<div class="col-sm-offset-2 col-sm-10">';
		echo '<button type="submit" class="btn btn-default">Editar</button>';
		echo '</div>';
		echo '</div> ';      
		echo '</form>';        
		echo '</div>';
		echo '</div>';

	}

	function opciones($num){
		if($num==1){
			while ($row = mysql_fetch_array($this->Consulta_ID)) {
				echo "<option value='".$row[0]."'>".utf8_encode($row[1])."</option>";
			}
		}else if ($num==2){
			while ($row = mysql_fetch_array($this->Consulta_ID)) {
				echo "<option value='".$row[0]."'>".utf8_encode($row[2]." ".$row[3])."</option>";
			}
		}else if ($num==3){
			while ($row = mysql_fetch_array($this->Consulta_ID)) {
				echo "<option value='".$row[0]."'>".utf8_encode($row[0])."</option>";
			}
		}
	}
	function hora(){
		while ($row = mysql_fetch_array($this->Consulta_ID)) {
			$array[0]=$row[0];
			$array[1]=$row[1];
		}

		return $array;
	}


	function procategoria(){
		echo "Categoria: ";
		$query = "SELECT * FROM categoria_producto WHERE id";
		$result = mysql_query($query) or die("error". mysql_error());                                   
		echo "<div class='form-group'>";                                                                
		echo "<select class='form-control' name='idcat'>";
		echo '<option value="" default selected>- Select -</option>';
		while ($row = mysql_fetch_array($result)) {
			echo "<h3 class='section-subheading text-muted'> string   ".$row[0]."</h3>";   
			echo "string  ".$row[0];
			echo "<option value='".$row[0]."'>".$row[1]."</option>"; 
		}
		echo "</select><br>";
		echo "<p class='help-block text-danger'></p>";
		echo "</div>";
	                                                    //------- extraccion de los estados ------
		include ("static/estado.php");

		echo "<select class='form-control' name='estado'>";
		echo '<option value=""> - Select - </option>';
		echo '<option value="s">Disnonible</option>';
		echo '<option value="s">Fuera de stock</option>';
		echo "</select><br>";

  	                                                    //-------- exit -------
		$query = "SELECT codigo, nombre, marca, nota FROM producto";
		$result = mysql_query($query) or die("error". mysql_error());
		$a = mysql_num_fields($result);
		while ($row = mysql_fetch_array($result)) {
			for ($i=0; $i < $a ; $i++) { 
				echo "<div class='form-group'>";
				echo mysql_field_name($result, $i).":<input class='form-control' name='".mysql_field_name($result, $i)."' type='text' placeholder='".mysql_field_name($result, $i)."'>";
				echo "<p class='help-block text-danger'></p>";
				echo "</div>";
			}
			$a=0;                             
		}

		$query = "SELECT valor, cantidad FROM producto";
		$result = mysql_query($query) or die("error". mysql_error());
		$a = mysql_num_fields($result);
		while ($row = mysql_fetch_array($result)) {
			for ($i=0; $i < $a ; $i++) { 
				echo "<div class='form-group'>";
				echo mysql_field_name($result, $i).":<input class='form-control' name='".mysql_field_name($result, $i)."' type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder='".mysql_field_name($result, $i)."'>";
				echo "<p class='help-block text-danger'></p>";
				echo "</div>";
			}
			$a=0;                             
		}
		
	}
	function procategoria2(){
		echo "Categoria: ";
		$query = "SELECT * FROM categoria_producto WHERE id";
		$result = mysql_query($query) or die("error". mysql_error());                                   
		echo "<div class='form-group'>";                                                                
		echo "<select class='form-control' name='idcat'>";
		echo '<option value="" default selected>- Select -</option>';
		while ($row = mysql_fetch_array($result)) {
			echo "<h3 class='section-subheading text-muted'> string   ".$row[0]."</h3>";   
			echo "string  ".$row[0];
			echo "<option value='".$row[0]."'>".$row[1]."</option>"; 
		}
		echo "</select><br>";
		echo "<p class='help-block text-danger'></p>";
		echo "</div>";
		                                                    //------- extraccion de los estados ------
		include ("static/estado.php");
		$_POST['idcatest'];
		//echo "Estado del producto: ";
		echo "<select class='form-control' name='estado'>";
		echo '<option value=""> - Select - </option>';
		echo '<option value="s">Disnonible</option>';
		echo '<option value="n">Fuera de stock</option>';
		echo "</select><br>";
	}
	function catprod(){
		$query = "SELECT categoria FROM categoria_producto";
		$result = mysql_query($query) or die("error". mysql_error());
		$a = mysql_num_fields($result);
		while ($row = mysql_fetch_array($result)) {
			for ($i=0; $i < $a ; $i++) { 
				echo "<div class='form-group'>";
				echo mysql_field_name($result, $i).":<input class='form-control' name='".mysql_field_name($result, $i)."' type='text'>";
				echo "<p class='help-block text-danger'></p>";
				echo "</div>";
			}
			$a=0;                             
		}
	}
	function categoria_estado(){
		$query = "SELECT estado FROM categoria_estado";
		$result = mysql_query($query) or die("error". mysql_error());
		$a = mysql_num_fields($result);
		while ($row = mysql_fetch_array($result)) {
			for ($i=0; $i < $a ; $i++) { 
				echo "<div class='form-group'>";
				echo mysql_field_name($result, $i).":<input class='form-control' name='".mysql_field_name($result, $i)."' type='text'>";
				echo "<p class='help-block text-danger'></p>";
				echo "</div>";

			}
			$a=0;                             
		}
	}
	function estadoproducto(){

		$query = "SELECT nombre, descripcion, descuento, id_categoria_estado FROM estado";
		echo "Categoria del Estado: ";
		$query = "SELECT * FROM categoria_estado WHERE id";
		$result = mysql_query($query) or die("error". mysql_error());
		echo "<select class='form-control' name='idcatestado'>";
		while ($row = mysql_fetch_array($result)) {
			echo "string  ".$row[0];
			echo "<option value='".$row[0]."'>".$row[1]."</option>"; 
		}
		echo "</select><br>";
		$query = "SELECT nombre, descrpcion, descuento FROM estado WHERE id";
		$result = mysql_query($query) or die("error". mysql_error());
		$cont = mysql_num_fields($result);
		while ($row = mysql_fetch_array($result)) {
			for ($i=0; $i < $cont ; $i++) { 
				echo "<div class='form-group'>";
				echo mysql_field_name($result, $i).":<input class='form-control' name='".mysql_field_name($result, $i)."' type='text' placeholder='".mysql_field_name($result, $i)."'>";
				echo "<p class='help-block text-danger'></p>";
				echo "</div>";
			}
			echo "<br>";
			$cont=0;                             
		}   

	}
}
?>
