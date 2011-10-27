<h1>Buscar por:</h1>
<ul>
	<h2>Nuestras marcas</h2>
	<select id="marcas">
		<?php
			if(!empty($brands)) :
			foreach($brands as $id=>$brand) : 
		?>
		<option id="<?=$id?>"><?=$brand?></option>>
		<?php
			endforeach;
			endif;
		?>
		<?php
			if(empty($brands)) :
		?>
		<option>No hay productos en esta categoría</option>
		<?php
			endif;
		?>
	</select>
	
</ul>