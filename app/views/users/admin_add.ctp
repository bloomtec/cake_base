<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Admin Add User'); ?></legend>
	<?php
		echo $this->Form->input('role_id');
		echo $this->Form->input('active', array('checked'=>true));
		echo $this->Form->input('email');
		echo $this->Form->input('pass', array('label'=>__('Password', true),'type'=>'password', 'value'=>''));
		echo $this->Form->input('name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('phone');
	?>
	<div class="city-id" style="visibility: hidden;">
	<?php
		echo $this->Form->input('city_id', array('empty'=>__('Select...', true)));
	?>
	</div>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
