<div class="comments form">
<?php echo $this->Form->create('Comment');?>
	<fieldset>
		<legend><?php __('Admin Edit Comment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('comment');
		echo $this->Form->hidden('user_id');
		echo $this->Form->hidden('product_id');
		echo $this->Form->input('is_visible');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

