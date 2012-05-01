<?php 
	$selectedId = null;
	if(isset($selected_id)) {
		$selectedId = $selected_id;
	}
?>
<div class="sencillo" rel="Keyboard">
	<h2>Teclado:</h2>
	<?php echo $form->radio('keyboard_id',$items,array('legend'=>false,'value'=>$selectedId)); ?>	
</div>	