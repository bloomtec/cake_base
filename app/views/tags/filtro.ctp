<form id="FormFiltro" accept-charset="utf-8" method="post" controller="tags" action="<?php echo $tag['Tag']['slug']; ?>">
	<h1>Buscar por:</h1>
	<ul>
		<?php if(isset($brands) && !empty($brands)) : ?>			
		<h2>Nuestras marcas</h2>
		<select id="BrandId" name="data[brand_id]">
			<option value="">Seleccione...</option>
			<?php foreach($brands as $id=>$brand) :	?>
			<option value="<?=$id?>"><?=$brand?></option>>
			<?php endforeach; ?>
		</select>
		<?php endif; ?>
		<?php if(isset($architectures) && !empty($architectures)) : ?>			
		<h2>Arquitecturas</h2>
		<select id="ArchitectureId" name="data[architecture_id]">
			<option value="">Seleccione...</option>
			<?php foreach($architectures as $id=>$architecture) : ?>
			<option value="<?=$id?>"><?=$architecture?></option>>
			<?php endforeach; ?>
		</select>
		<?php endif; ?>
		<?php if(isset($sockets) && !empty($sockets)) : ?>	
		<h2>Sockets</h2>
		<select id="SocketId" name="data[socket_id]">
			<option value="">Seleccione...</option>
			<?php foreach($sockets as $id=>$socket) : ?>
			<option value="<?=$id?>"><?=$socket?></option>>
			<?php endforeach; ?>
		</select>
		<?php endif; ?>
		<?php if(isset($tag_id) && !empty($tag_id) && $tag_id == 2) : ?>			
		<h2>Video Integrado</h2>
		<select id="filtro-sockets">
			<option value="">Seleccione...</option>
			<option value="1">Sí</option>
			<option value="0">No</option>
		</select>
		<?php endif; ?>
		<input type="hidden" value="<?php echo $tag_id; ?>" id="TagId" name="data[tag_id]" />
	</ul>
	<input type="submit" value="Buscar" />
</form>