<?php $subcategories=$this->requestAction("/subcategories/getlist/".$brand["Brand"]["id"]); // carga las subcategorias de la primera marca ?>
<div class="sub_category twCenMt">
	<?php if($subcategories): ?>
	<ul>
		<?php foreach($subcategories as $subcategory): ?>
		<li>
			<a href="/marcas/<?php echo $brand['Brand']['slug']?>/subcategoria:<?php echo $subcategory['Subcategory']['id']?>"><?php echo $subcategory["Subcategory"]["name"]; ?></a>
		</li>
		<?php endforeach;?>
	</ul>
	<?php endif;?>
	
	<?php if(!$subcategories):?>
		No hay categorías
	<?php endif?>
</div>