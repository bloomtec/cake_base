<?php foreach($products as $product):?>
<div class="recomendado">
	<a href='/products/view/<?php echo $product['Product']['id']?>' ><img src="/img/uploads/<?php echo $product['Product']['image']?>" /></a>
	<h2><?php echo $product['Product']['name']?></h2>
	<h3>$ <?php echo  number_format($product['Product']["price"], 0, ' ', '.');?></h3>
</div>
<?php endforeach;?>
<div style='clear:both;'></div>