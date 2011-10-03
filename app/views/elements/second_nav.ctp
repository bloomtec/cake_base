<?php
//NAVEGACION DE MARCAS
$brands = $this -> requestAction("/brands/brandOfCategory/" . $category["Category"]["id"]);
// carga las subcategorias de la primera marca
?>
<div class="second_nav">
	<?php if($brands):?>
	<ul>
		<?php foreach($brands as $librand):?>
		<li>
			<a href="/marcas/<?php echo $librand["Brand"]["id"]?>">
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
	<a class="carrito" href="#">Mi Carrito</a>
<a href="#" class="info_carrito">0 Prendas $900.000</a>
</div>
