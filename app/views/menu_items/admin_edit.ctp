<div class="menuItems form">
<?php echo $this->Form->create('MenuItem');?>
	<fieldset>
		<legend><?php __('Admin Edit Menu Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('menu_id');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('name');
		echo $this->Form->input('link');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

