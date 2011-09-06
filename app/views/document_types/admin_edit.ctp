<div class="documentTypes form">
<?php echo $this->Form->create('DocumentType');?>
	<fieldset>
		<legend><?php __('Admin Edit Document Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('DocumentType.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('DocumentType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Document Types', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List User Fields', true), array('controller' => 'user_fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Field', true), array('controller' => 'user_fields', 'action' => 'add')); ?> </li>
	</ul>
</div>