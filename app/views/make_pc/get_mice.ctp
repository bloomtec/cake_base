<?php 
	$selectedId = null;
	if($selected_id) {
		$selectedId = $selected_id;
	}
?>
<div class="sencillo">
	<h3>Raton:</h3>
	<?php echo $form->radio('mouse_id',$items,array('legend'=>false,'value'=>$selectedId)); ?>	
</div>	