<div class="brands tahoma">
		<?php foreach($brands as $brand):?>
		<div class="marcas">
			<img src="/img/uploads/<?php echo $brand['Brand']['image_brand']?>" />
			<h1><?php echo $brand['Brand']['name']?></h1>
			<h2><?php echo $brand['Brand']['country']?></h2>
			<div style="clear: both"></div>
		</div>
		<p><?php echo $brand['Brand']['description']?>
		</p>
		<div style="clear: both"></div>
		<?php endforeach;?>
</div>