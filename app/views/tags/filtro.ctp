<h1>Buscar por:</h1>
<ul>
	<?php if(isset($brands) && !empty($brands)) : ?>			
	<h2>Nuestras marcas</h2>
	<select id="filtro-marcas">
		<?php foreach($brands as $id=>$brand) :	?>
		<option id="<?=$id?>"><?=$brand?></option>>
		<?php endforeach; ?>
	</select>
	<?php endif; ?>
	<?php if(isset($architectures) && !empty($architectures)) : ?>			
	<h2>Arquitecturas</h2>
	<select id="filtro-arquitecturas">
		<?php foreach($architectures as $id=>$architecture) : ?>
		<option id="<?=$id?>"><?=$architecture?></option>>
		<?php endforeach; ?>
	</select>
	<?php endif; ?>
	<?php if(isset($sockets) && !empty($sockets)) : ?>			
	<h2>Sockets</h2>
	<select id="filtro-sockets">
		<?php foreach($sockets as $id=>$socket) : ?>
		<option id="<?=$id?>"><?=$socket?></option>>
		<?php endforeach; ?>
	</select>
	<?php endif; ?>
	<!-- SEGUN LO QUE VI NO ME GUSTA ESTE FILTRO ¬¬
	<?php if(isset($slots) && !empty($slots)) : ?>			
	<h2>Puertos</h2>
	<select id="filtro-puertos">
		<?php foreach($slots as $id=>$slot) : ?>
		<option id="<?=$id?>"><?=$slot?></option>>
		<?php endforeach; ?>
	</select>
	<?php endif; ?>
	-->
</ul>