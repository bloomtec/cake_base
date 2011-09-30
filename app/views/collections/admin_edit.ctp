<div class="collections form">
<?php echo $this->Form->create('Collection');?>
	<fieldset>
		<legend><?php __('Admin Edit Collection'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('brand_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

