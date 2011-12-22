<div>
	<?php echo $this->Session->flash(); ?>

<?php
	e($this->Form->create());
	e('<fieldset>');
	e($this->Form->input('validation_code', array('value'=>'')));
	e('</fieldset>');
	e($this->Form->end(__('Validate Email', true)));
?>
<div style="clear:both;"></div>
</div>