<div class="addresses form">
<?php echo $this->Form->create('Address');?>
	<fieldset>
		<legend><?php __('Add Address'); ?></legend>
	<?php
		echo $this->Form->hidden('user_id', array('value'=>$users[0]));
		echo $this->Form->input('country');
		echo $this->Form->input('state');
		echo $this->Form->input('city');
		echo $this->Form->input('address_line_1');
		echo $this->Form->input('address_line_2');
		echo $this->Form->input('phone');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

