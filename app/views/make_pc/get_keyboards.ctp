<?php 
	$selectedId = null;
	if($selected_id) {
		$selectedId = $selected_id;
	}
?>
<div class="sencillo">
	<h3>Teclado:</h3>
	<?php echo $form->radio('keyboard_id',$items,array('legend'=>false,'value'=>$selectedId)); ?>	
</div>	