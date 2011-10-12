<div class="menuItems form">
<?php echo $this->Form->create('MenuItem');?>
	<fieldset>
		<legend><?php __('Editar Menu Item'); ?></legend>
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
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('MenuItem.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('MenuItem.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Menu Items', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Menus', true), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu', true), array('controller' => 'menus', 'action' => 'add')); ?> </li>
	</ul>
</div>