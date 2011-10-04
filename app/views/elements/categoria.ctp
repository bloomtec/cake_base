<?php
//NAVEGACION DE MARCAS
$brands = $this -> requestAction("/brands/brandOfCategory/" . $category["Category"]["id"]);
// carga las subcategorias de la primera marca
?>
<div class="category">
	<ul>
		<li><a class="paez" href="#"></a></li>
	</ul>
	
	<?php if(!$brands):?>
		no hay categorias
	<?php endif;?>
	<ul>
		<li><a href="#">ROPA</a></li>
		<li><a href="#">VESTIDOS</a></li>
		<li><a href="#">ZAPATOS</a></li>
		<li><a href="#">BOLSOS</a></li>
		<li><a href="#">ACCESORIOS</a></li>
	</ul>
	<ul class="img_catalogo">
		<li><a href="#"><img src="" /></a></li>
		<li><a href="#"><img src="" /></a></li>
		<li><a href="#"><img src="" /></a></li>
		<li><a href="#"><img src="" /></a></li>
		<li><a href="#"><img src="" /></a></li>
		<li><a href="#"><img src="" /></a></li>
		<div style="clear: both"></div>
	</ul>
	<a class="azul" href="#">VER CATALOGO DE MOTONETA</a>
	
</div>
