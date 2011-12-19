<div class="addresses form">
<?php echo $this->Form->create('Address');?>
	<fieldset>
		<legend><?php __('Admin Add Address'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
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

