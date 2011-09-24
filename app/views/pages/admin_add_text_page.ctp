<div class="pages form">
<?php echo $this->Form->create('Page');?>
	<fieldset>
		<legend><?php __('Add Text Page'); ?></legend>
	<?php
		echo $this->Form->hidden('menu_id', array('value' => $menu_id));
		echo $this->Form->hidden('page_type_id', array('value' => 1));
		echo $this->Form->hidden('title', array('value' => $menu_title));
		echo $this->Form->input('wysiwg_content');
		echo $this->Form->hidden('pic_1');
		echo $this->Form->hidden('pic_2');
		echo $this->Form->hidden('pic_3');
		echo $this->Form->hidden('pic_4');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

