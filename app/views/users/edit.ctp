<div class="users form" id="register_login">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<h1><?php __('Update My Info'); ?></h1>
	<?php
	
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('phone');
	?>
	</fieldset>
	<?php echo $this -> Form -> submit(__('Submit', true))?>
	</form>
</div>