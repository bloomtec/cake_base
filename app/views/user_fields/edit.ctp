<div class="userFields form">
<?php echo $this->Form->create('UserField');?>
	<fieldset>
		<legend><?php __('Edit User Field'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('document_type_id');
		echo $this->Form->input('document');
		echo $this->Form->input('name');
		echo $this->Form->input('surname');
		echo $this->Form->input('birthday');
		echo $this->Form->input('prefered_foot');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

