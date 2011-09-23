<a class="browse  prev"> </a>
<a class="browse  next"> </a>
<div class="scrollable">   
	<div class="items">
		<?php foreach($menu["Page"] as $page):?>
			<?php 
				if($page["type_id"]==1){
					echo $this->element("slide");
				}else{
					echo $this->element("gallery");
				}
			?>
		<?php endforeach;?>
	</div>
</div>