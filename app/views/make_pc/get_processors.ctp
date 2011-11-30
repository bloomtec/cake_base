<?php
	$selectedId = null;
	if(isset($selected_id)) {
		$selectedId = $selected_id;
	}
?>
<div class="sencillo">
	<?php echo $form->radio('processor_id',$items,array('legend'=>false, 'value' => $selectedId)); ?>
</div>