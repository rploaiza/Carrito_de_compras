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
					echo "<input class='form-control' value='".$row[$i]."' name='".$this->nombrecampo($i)."' type='text'>";
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
	    }
	}
	function consultacatalogo2(){
		while ($row = mysql_fetch_array($this->Consulta_ID)) {
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

 	function consultauser($user,$pass){
 		$a=1;
 		while ($row = mysql_fetch_array($this->Consulta_ID)) {

	 		for ($i=0; $i < $this->numcampos(); $i++){
	 			echo "xxxxxx ".$row[8]." = ".$user." ".$row[9]." = ".$pass." ".$row[1];
	 			if ($user==$row[8] AND $pass==$row[9] AND $row[1]==1) {
	 				echo '<script>location.href = "administrador.php"</script>';
	 				$_SESSION["usuario"] = $row[3]." ".$row[4];
	 				exit();
	 			}else{
	 				if ($user==$row[8] AND $pass==$row[9] AND $row[1]==2) {
	 					$_SESSION["usuario"] = $row[3]." ".$row[4];
	 					echo '<script>location.href = "administrador.php"</script>';
	 					exit();
	 				}else{
	 					if ($user==$row[8] AND $pass==$row[9] AND $row[1]==3) {
	 						$_SESSION["usuario"] = $row[3]." ".$row[4];
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
	 				echo "<td>".$row[$i]."</td>";
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

				echo "<button name= btn_cat class='btn btn-xl1' data-filter='.".$row[1]."'><a href='index.php?id=".$row[0]."' class='nava' data-type='".$row[1]."'>".$row[1]."</a></button>";			
		}
		echo "<button name= btn_cat class='btn btn-xl1' data-filter='.".$row[1]."'><a href='index.php' class='nava' data-type='".$row[1]."'>Todos</a></button>";			
	}
	function consulta_menu(){
		echo "<ul>";
		while ($row = mysql_fetch_array($this->Consulta_ID)) {
    		echo "<li class='active'><a href='admin.php?bd=".$row[0]."'>" . utf8_encode($row[0]) . "</a></li>";
		}
    	echo "</ul>";
	}

	function sql_ingresar($nom, $val){
		$sql="insert into ".$nom." values('".$val[1]."'";
		for ($i=2; $i < count($val)+1; $i++) { 
			$sql =$sql.",'".$val[$i]."'";
		}
		$sql = $sql.")";
echo $sql;
		return $sql;
	}	

	function sql_actualizar($nom, $val, $col){
		$sql="update ".$nom." set ".$col[1]."= '".$val[1];
		for ($i=2; $i < count($val); $i++) { 
			$sql =$sql."', ".$col[$i]."= '".$val[$i];
		}		
		$sql = $sql."' where ".$col[0]." = ".$val[0];
		return $sql;
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

	function generar_reporte(){
 		echo "<div class='table-responsive'> ";
 		echo "<table class='table table-bordered table-hover'>";
 		echo "<thead>";
 		echo "<tr>";
 		//mostrar los nombres de los campos
 		for ($i=0; $i < $this->numcampos(); $i++) { 
 			echo "<th>".$this->nombrecampo($i)."</th>";
 		}
 		echo "</tr>";
 		echo "</thead>";
 		echo "<tbody>";		
 		while ($row = mysql_fetch_array($this->Consulta_ID)) {
 			echo "<tr>";
 			for ($i=0; $i < $this->numcampos(); $i++) { 
 				echo "<td>".$row[$i]."</td>";
 			}
 			echo "</tr>";
 		}
 		echo "</tbody>";	
 		echo "</table>";
 		echo "</div>";
 	}
 }
?>
