<?php
//NAVEGACION DE MARCAS
$brands = $this -> requestAction("/brands/brandOfCategory/" . $category["Category"]["id"]);
// carga las subcategorias de la primera marca
?>
<?php if($brands):?>
<?php foreach($brands as $librand):?>
<div class="category">
	<ul class='brands-menu'>
		<li>
			<a href="/marcas/<?php echo $librand["Brand"]["slug"]?>" alt="<?php echo $librand["Brand"]["name"]?>" >
				<img src="/img/uploads/<?php echo $librand["Brand"]["image_brand"];?>" rel="<?php echo $librand["Brand"]["image_hover"];?>" image="<?php echo $librand["Brand"]["image_brand"];?>" />
			</a>			
		</li>
	</ul>
	<ul class="twCenMt">
		<?php //debug($brand);?>
		<?php if(!empty($librand["Subcategory"])): ?>
		<?php foreach($librand["Subcategory"] as $subcategory):?>
		<li>
			<a href="/marcas/<?php echo $librand["Brand"]["slug"]?>/subcategoria:<?php echo $subcategory['id']?>"><?php echo $subcategory["name"]; ?></a>
		</li>
		<?php endforeach;?>
		<?php endif;?>
	</ul>
	<ul class="img_catalogo">
		<?php $i=0; ?>
		<?php if(!empty($librand["Product"])): ?>
		<?php foreach($librand["Product"] as $product):?>
		<?php 
				if($i==6) break;
				$i++;
		?>
		<li>
			<a href="/marcas/<?php echo $librand["Brand"]["slug"]?>/subcategoria:<?php echo $subcategory['id']?>">
				<img src="/img/uploads/<?php echo $product['image']?>" />
			</a>
		</li>
		<?php endforeach;?>
		<?php endif;?>
		<div style="clear: both"></div>
	</ul>
	<a class="azul twCenMt" href="/marcas/<?php echo $librand["Brand"]["slug"]?>">VER CATALOGO DE <?php echo strtoupper($librand["Brand"]["name"]);?></a>
	<div style="clear: both"></div>
</div>
<?php endforeach; ?>
<?php endif;?>
