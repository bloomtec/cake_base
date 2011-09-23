<?php $menus= $this->requestAction("/menus/getAll");?>
<ul class="menu">
	<?php foreach($menus as $menu): ?>
	<li style="background: <?=$menu["Menu"]["background_code"]?>">
		<a href="/view/<?=$menu["Menu"]["slug"]?>">
			<span class="container">
				<?=$menu["Menu"]["wysiwyg_title"]?>
			</span>
		</a>
	</li>
	<?php endforeach;?>
	<div style="clear:both;"></div>
</ul>
