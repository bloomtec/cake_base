<?php 
	$selectedId = null;
	if(isset($selected_id)) {
		$selectedId = $selected_id;
	}
?>
<div class="sencillo" rel="PowerSupply">
	<?php echo $form->radio('supply_id',$items,array('legend'=>false,'value'=>$selectedId)); ?>
</div>
