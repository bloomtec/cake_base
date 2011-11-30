<?php 
	$selectedId = null;
	if(isset($selected_id)) {
		$selectedId = $selected_id;
	}
?>
<div class="sencillo">
	<?php echo $form->radio('supply_id',$supplies,array('legend'=>false,'value'=>$selectedId)); ?>
</div>
