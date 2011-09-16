<?php
	// Buscar el menú por el nombre enviado a este elemento
	$menu = $this->requestAction('/menus/getMenu/' . $menu_name);
	if(!empty($menu)) {
		$menu_items = $this->requestAction('/menu_items/getMenuItems/' . $menu['Menu']['id']);
?>
<div class="sf-content">
	<ul class="sf-menu">
		<!-- Llenar el menú acorde el contenido de la BD -->
		<?php
			foreach ($menu_items as $lvl0_menuItem) {
				echo "<li>";
				echo $html->link($lvl0_menuItem['MenuItem']['name'], $lvl0_menuItem['MenuItem']['link']);
				if(!empty($lvl0_menuItem['MenuItem']['children'])) {
					echo "<ul>";
					foreach($lvl0_menuItem['MenuItem']['children'] as $lvl1_menuItem) {
						echo "<li>";
						echo $html->link($lvl1_menuItem['MenuItem']['name'], $lvl1_menuItem['MenuItem']['link']);
						if(!empty($lvl1_menuItem['MenuItem']['children'])) {
							echo "<ul>";
							foreach($lvl1_menuItem['MenuItem']['children'] as $lvl2_menuItem) {
								echo "<li>";
								echo $html->link($lvl2_menuItem['MenuItem']['name'], $lvl2_menuItem['MenuItem']['link']);
								
								echo "</li>";
							}
							echo "</ul>";
						}
						echo "</li>";
					}
					echo "</ul>";
				}
				echo "</li>";
			}
		?>
	</ul>
</div>
<?php
	} else {
		// Manejar si no se encuentra el menú
?>
<div class="menuNotFound">
	<p>
		No se ha encontrado el menú que solicito, intente con otro nombre.
	</p>
</div>
<?php
	}
?>