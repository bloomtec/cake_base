<div class="pages form">
<?php echo $this->Form->create('Page');?>
	<fieldset>
		<legend><?php __('Edit Gallery Page From Menu :: ' . $menu_title); ?></legend>
	<?php
		echo $this->Form->hidden('id');
		echo $this->Form->hidden('menu_id');
		echo $this->Form->hidden('page_type_id');
		echo $this->Form->input('title');
		echo $this->Form->hidden('wysiwyg_content');
		echo $this->Form->input('pic_1');
		echo $this->Form->input('pic_2');
		echo $this->Form->input('pic_3');
		echo $this->Form->input('pic_4');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
