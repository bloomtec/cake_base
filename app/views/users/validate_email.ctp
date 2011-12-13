<div>
	<?php echo $this->Session->flash(); ?>
</div>
<?php
	e($this->Form->create());
	e('<fieldset>');
	e($this->Form->input('validation_code', array('value'=>'')));
	e('</fieldset>');
	e($this->Form->end(__('Validate Email', true)));
?>