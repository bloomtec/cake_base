<?php
	$selectedId = null;
	if(isset($selected_id)) {
		$selectedId = $selected_id;
	}
?>
<div class="sencillo" rel="Motherboard">
	<?php echo $form->radio('motherboard_id', $items, array('legend' => false, 'value' => $selectedId)); ?>
</div>