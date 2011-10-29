	
<div class="users form2">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Admin Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('role_id');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		echo $this->Form->input('name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('gender');
		echo $this->Form->input('phone');
		echo $this->Form->input('country');
		echo $this->Form->input('state');
		echo $this->Form->input('city');
		echo $this->Form->input('address');
		echo $this->Form->input('is_active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="images">
		<h2>Image</h2>
		<div class="preview">
			<div class="wrapper">
					 <?php echo $this->Html->image('preview.png');?>
			</div>
		</div>
		<div id="single-upload" controller="users">
		</div>			
</div>

