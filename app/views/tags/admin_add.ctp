<div class="tags form">
<?php echo $this->Form->create('Tag');?>
	<fieldset>
		<legend><?php __('Admin Add Tag'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('in_gamers');
		echo $this->Form->input('description');
		echo $this->Form->input('keywords');
		echo $this->Form->input('Product');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

