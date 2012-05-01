<?php 
	$selectedId = null;
	if(isset($selected_id)) {
		$selectedId = $selected_id;
	}
	
?>
<div class="sencillo" rel="Casing">
	<?php echo $form->radio('casing_id', $items, array('legend'=>false,'value'=>$selectedId)); ?>
</div>