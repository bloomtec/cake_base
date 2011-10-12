<div class="buscar tahoma">
	<div class="izq">
		<h3>También puedes buscar por marca</h3>
		<?php foreach($brands as $brand):?>
			<div class="marcas">
				<img src="/img/uploads/<?php echo  $brand['Brand']['image_brand']?>" />
				<h1><?php echo $brand['Brand']['name'];?></h1>
				<h2><?php echo $brand['Brand']['country'];?></h2>
				<div style="clear: both"></div>
			</div>
		<?php endforeach;?>
	</div>
	<div class="der">
	<h3>Resultados</h3>
		<h1><?php e($this->element('product-list', $products)); ?></h1>
	</div>
</div>