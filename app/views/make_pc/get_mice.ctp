<?php 
	$selectedId = null;
	if($selected_id) {
		$selectedId = $selected_id;
	}
?>
<div rel='1'>
	<h3>Teclado:</h3>
	<?php echo $form->radio('mouse_id',$items,array('legend'=>false,'value'=>$selectedId)); ?>	
</div>	