<a class="browse  prev"> </a>
<a class="browse  next"> </a>
<div class="scrollable">   
	<div class="items">
		<?php foreach($menu["Page"] as $page):?>
			<?php 
				if($page["page_type_id"]==1){
					echo $this->element("slide",array("page"=>$page));
				}else{
					echo $this->element("gallery",array("page"=>$page));
				}
			?>
		<?php endforeach;?>
	</div>
</div>
<script type="text/javascript">
	$(".scrollable").scrollable({
		circular:true
	});
</script>
