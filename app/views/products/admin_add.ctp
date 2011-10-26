<?php echo $this->Form->create('Product');?>
	<fieldset>
		<legend><?php __('Admin Add Product'); ?></legend>
	<?php
		echo $this->Form->input('product_type_id');
		echo $this->Form->input('architecture_id');
		echo $this->Form->input('is_video_included');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('ref');
		echo $this->Form->input('price');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		echo $this->Form->input('keywords');
		echo $this->Form->input('recommendations');
		echo $this->Form->input('is_gamers');
		echo $this->Form->input('is_active');
		echo $this->Form->input('times_visited');
		echo $this->Form->input('Slot');
		echo $this->Form->input('Socket');
		echo $this->Form->input('Tag');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>