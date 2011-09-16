<div class="documentTypes form">
<?php echo $this->Form->create('DocumentType');?>
	<fieldset>
		<legend><?php __('Add Document Type'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

