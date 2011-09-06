<div class="userFields form">
<?php echo $this->Form->create('UserField');?>
	<fieldset>
		<legend><?php __('Admin Add User Field'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List User Fields', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Document Types', true), array('controller' => 'document_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document Type', true), array('controller' => 'document_types', 'action' => 'add')); ?> </li>
	</ul>
</div>