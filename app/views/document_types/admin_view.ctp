<div class="documentTypes view">
<h2><?php  __('Document Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $documentType['DocumentType']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $documentType['DocumentType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $documentType['DocumentType']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $documentType['DocumentType']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Document Type', true), array('action' => 'edit', $documentType['DocumentType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Document Type', true), array('action' => 'delete', $documentType['DocumentType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $documentType['DocumentType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Document Types', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document Type', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Fields', true), array('controller' => 'user_fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Field', true), array('controller' => 'user_fields', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php __('Related User Fields');?></h3>
	<?php if (!empty($documentType['UserField'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $documentType['UserField']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $documentType['UserField']['user_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Document Type Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $documentType['UserField']['document_type_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Document');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $documentType['UserField']['document'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $documentType['UserField']['name'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Surname');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $documentType['UserField']['surname'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Phone');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $documentType['UserField']['phone'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $documentType['UserField']['address'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $documentType['UserField']['email'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $documentType['UserField']['created'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $documentType['UserField']['updated'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit User Field', true), array('controller' => 'user_fields', 'action' => 'edit', $documentType['UserField']['id'])); ?></li>
			</ul>
		</div>
	</div>
	