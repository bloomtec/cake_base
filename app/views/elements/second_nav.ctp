<?php
//NAVEGACION DE MARCAS
$brands = $this -> requestAction("/brands/brandOfCategory/" . $category["Category"]["id"]);
// carga las subcategorias de la primera marca
?>
<div class="second_nav tahoma">
	<?php if($brands):?>
	<ul class='brands-menu'>
		<?php foreach($brands as $librand):?>
		<li>
			<a href="/marcas/<?php echo $librand["Brand"]["slug"]?>" alt="<?php echo $librand["Brand"]["name"]?>">
				<?php if(!isset($brand) || $librand["Brand"]["id"]!=$brand["Brand"]["id"]){?>
				<img src="/img/uploads/<?php echo $librand["Brand"]["image_brand"];?>" rel="<?php echo $librand["Brand"]["image_hover"];?>" image="<?php echo $librand["Brand"]["image_brand"];?>" />
				<?php }else{?>
				<img src="/img/uploads/<?php echo $librand["Brand"]["image_hover"];?>" rel="<?php echo $librand["Brand"]["image_hover"];?>" image="<?php echo $librand["Brand"]["image_hover"];?>" />	
				<?php }?>
			</a>
		</li>
		<?php endforeach;?>
	</ul>
	
	<?php endif ?>
	<?php if(!$brands):?>
		no hay categorias
	<?php endif;?>
	<a class="carrito" href="/shopCarts/viewCart">Mi Carrito</a>
<a href="/shopCarts/viewCart" class="info_carrito"><span class='cart-num-items'> 0 </span> Prendas <span class='cart-price-total'>0</span></a>
</div>
