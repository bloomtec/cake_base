<div class="userFields form">
<?php echo $this->Form->create('UserField');?>
	<fieldset>
		<legend><?php __('Admin Edit User Field'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('document_type_id');
		echo $this->Form->input('document');
		echo $this->Form->input('name');
		echo $this->Form->input('surname');
		echo $this->Form->input('phone');
		echo $this->Form->input('address');
		echo $this->Form->input('email');
		echo $this->Form->input('birthday');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('UserField.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('UserField.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List User Fields', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Document Types', true), array('controller' => 'document_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document Type', true), array('controller' => 'document_types', 'action' => 'add')); ?> </li>
	</ul>
</div>