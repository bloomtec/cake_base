<div class="pages form">
<?php echo $this->Form->create('Page');?>
	<fieldset>
		<legend><?php __('Admin Add Page'); ?></legend>
	<?php
		echo $this->Form->input('menu_id');
		echo $this->Form->input('page_type_id');
		echo $this->Form->input('title');
		echo $this->Form->input('wysiwg_content');
		echo $this->Form->input('pic_1');
		echo $this->Form->input('pic_2');
		echo $this->Form->input('pic_3');
		echo $this->Form->input('pic_4');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

