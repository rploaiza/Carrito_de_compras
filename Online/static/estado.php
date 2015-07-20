<?php
echo "Promociones: ";
$res=mysql_query("select * from categoria_estado");
?>
<div class='form-group'>   
	<select id="cont" onchange="load(this.value)" class='form-control' name='idest'>
		<option value=""> - Select - </option>

		<?php
		while($fila=mysql_fetch_array($res)){
			?>
			<option value="<?php echo $fila[0]; ?>"><?php echo $fila[1]; ?></option>
			<?php } ?>
		</select>
		<div id="myDiv"></div>
	</div><br>
Estado del producto: