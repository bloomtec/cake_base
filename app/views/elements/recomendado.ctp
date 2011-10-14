<?php foreach($products as $product):?>
<div class="recomendado">
	<a href='/products/view/<?php echo $product['Product']['id']?>' ><img src="/img/uploads/100x100/<?php echo $product['Product']['image']?>" /></a>
	<h2><?php echo $product['Product']['name']?></h2>
	<h3>PRECIO: <?php echo $product['Product']['price']?></h3>
</div>
<?php endforeach;?>
<div style='clear:both;'></div>