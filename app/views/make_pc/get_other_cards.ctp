<?php 
	$selectedId  = null; // los seleccionados en a variable pc
	
?>
<div class="multiple" rel='Cards'>
	<h2>Otras Tarjetas:</h2>
	<?php echo $form->input('other_cards_id',array('legend'=>false,'options'=>$items,'multiple'=>'checkbox')); ?>	
</div>