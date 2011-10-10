<div class="adPositions form">
<?php echo $this->Form->create('AdPosition');?>
	<fieldset>
		<legend><?php __('Add Ad Position'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

