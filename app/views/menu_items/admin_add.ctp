<div class="menuItems form">
<?php echo $this->Form->create('MenuItem');?>
	<fieldset>
		<legend><?php __('Admin Add Menu Item'); ?></legend>
	<?php
		echo $this->Form->input('menu_id');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('name');
		echo $this->Form->input('link');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Menu Items', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Menus', true), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu', true), array('controller' => 'menus', 'action' => 'add')); ?> </li>
	</ul>
</div>