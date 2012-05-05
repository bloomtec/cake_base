<?php 
	$selectedId = null;
	if(isset($selected_id)) {
		$selectedId = $selected_id;
	}
?>
<div class="sencillo" rel="Mouse">
	<h2>Raton:</h2>
	<?php echo $form->radio('mouse_id',$items,array('legend'=>false,'value'=>$selectedId)); ?>	
</div>