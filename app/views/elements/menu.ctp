<?php $menus= $this->requestAction("/menus/getList");?>
<ul class="menu">
	<?php foreach($menus as $background=>$title): ?>
	<li style="background: <?=$background?>"><?=$title?></li>
	<?php endforeach;?>
	<div style="clear:both;"></div>
</ul>
