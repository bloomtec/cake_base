<?php 
	$selectedId1 = $selectedId2 = null; // los seleccionados en a variable pc
	if(isset($selected_id_1)) {
		$selectedId1 = $selected_id_1;
	}
	if(isset($selected_id_2)) {
		$selectedId2 = $selected_id_2;
	}
?>
<div class="inclusivo" >
<div class="exclusivo opcional col" rel="VideoCard">
	<h2>Tarjeta de Video<?php if($motherboard['Product']['is_video_included']) echo "(opcional)" ?>:</h2>
	<?php echo $form->radio('video_card_id1',$items,array('legend'=>false,'value'=>$selectedId1, 'rel'=>'1')); ?>
</div>
<div class="exclusivo opcional col" rel="VideoCard">	
	<h2>Modo SLI/CROSSFIRE (opcional):</h2>
	<?php echo $form->radio('video_card_id2',$items,array('legend'=>false,'value'=>$selectedId2, 'rel'=>'2')); ?>
</div>
</div>
