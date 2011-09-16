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
	</dl>
</div>


<div class="related">
	<h3><?php __('Related User Fields');?></h3>
	<?php if (!empty($documentType['UserField'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Document Type Id'); ?></th>
		<th><?php __('Document'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Surname'); ?></th>
		<th><?php __('Birthday'); ?></th>
		<th><?php __('Foot Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($documentType['UserField'] as $userField):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $userField['id'];?></td>
			<td><?php echo $userField['user_id'];?></td>
			<td><?php echo $userField['document_type_id'];?></td>
			<td><?php echo $userField['document'];?></td>
			<td><?php echo $userField['name'];?></td>
			<td><?php echo $userField['surname'];?></td>
			<td><?php echo $userField['birthday'];?></td>
			<td><?php echo $userField['foot_id'];?></td>
			<td><?php echo $userField['created'];?></td>
			<td><?php echo $userField['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'user_fields', 'action' => 'view', $userField['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'user_fields', 'action' => 'edit', $userField['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'user_fields', 'action' => 'delete', $userField['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userField['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Field', true), array('controller' => 'user_fields', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
