<div class='quantityHide'>
<?php 
	$selecteds = array(); // los seleccionados en a variable pc
	echo $form->radio('Memory.id',$memories,array('legend'=>false,'value'=>$selectedId));
	echo $form -> input('Memory.quantity', array('value'=>1,'div'=>'quantity' , 'label' => 'cantidad'))	
?>
</div>

<!--
<table class='pc-items'>
	<tr>
		<th> Memoria </th>
		<th> Cantidad </th>
	</tr>
	<?php foreach($memories as $key => $memory): ?>
	<tr>
		<td>
			<?php echo $this -> Form -> radio("Memory[$key]['checked']",array('checked' => in_array($key, $selecteds))) ?>
			<label for'<?php echo "Memory[$key]['checked']"?>'><?php echo $memory; ?></label>
		</td>
		<td>
			<?php echo $this -> Form -> text("Memory[$key]['checked']",array('label' => 'Cantidad','class'=>'quantity')) ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
-->