<div class="addresses form">
<?php echo $this->Form->create('Address');?>
	<fieldset>
		<legend><?php __('Edit Address'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->hidden('user_id', array('value'=>$users[0]));
		echo $this->Form->input('name');
		echo $this->Form->input('country');
		echo $this->Form->input('state');
		echo $this->Form->input('city');
		echo $this->Form->input('address_line_1');
		echo $this->Form->input('address_line_2');
		echo $this->Form->input('phone');
		echo $this->Form->input('default');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
<div style="clear: both"></div>
</div>

