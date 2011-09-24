<div class="pages form">
<?php echo $this->Form->create('Page');?>
	<fieldset>
		<legend><?php __('Add Gallery Page'); ?></legend>
	<?php
		echo $this->Form->hidden('menu_id', array('value' => $menu_id));
		echo $this->Form->hidden('page_type_id', array('value' => 2));
		echo $this->Form->hidden('title', array('value' => $menu_title));
		echo $this->Form->hidden('wysiwg_content');
		echo $this->Form->input('pic_1');
		echo $this->Form->input('pic_2');
		echo $this->Form->input('pic_3');
		echo $this->Form->input('pic_4');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

