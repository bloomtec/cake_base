<?php 
	$selectedId1 = $selectedId2 = null; // los seleccionados en a variable pc
	if(isset($selected_id_1)) {
		$selectedId1 = $selected_id_1;
	}
	if(isset($selected_id_2)) {
		$selectedId2 = $selected_id_2;
	}
?>
<<<<<<< HEAD
<div class="excluyente">
	<div rel='1'>
		<h3>Monitor</h3>
		<?php echo $form->radio('monitor_id',$items,array('legend'=>false,'value'=>$selectedId)); ?>	
=======
<div class="exclusivo">
	<div rel='1'>
		<h3>Monitor</h3>
		<?php echo $form->radio('monitor_id1',$items,array('legend'=>false,'value'=>$selectedId1)); ?>	
>>>>>>> 73ba613d587ab0d290506480ccf9e6f6422f0a39
	</div>	
	<div rel='2'>
		<h3>Segundo Monitor (opcional):</h3>
		<?php echo $form->radio('monitor_id2',$items,array('legend'=>false,'value'=>$selectedId2)); ?>
	</div>
</div>