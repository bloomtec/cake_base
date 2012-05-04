<?php
$selected = null;
if (!empty($myPC['Cards'])) {
	foreach ($myPC['Cards'] as $key => $val) {
		$selected[$key]=$key;
	}
}
// los seleccionados en a variable pc
?>
<div class="multiple opcional" rel='Cards'>
	<h2>Otras Tarjetas:</h2>
	<?php echo $form -> input('other_cards_id', array('label'=>false,'legend' => false, 'options' => $items, 'multiple' => 'checkbox','selected'=>$selected));?>
</div>