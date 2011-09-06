<div class="documentTypes index">
	<h2><?php __('Document Types');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($documentTypes as $documentType):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $documentType['DocumentType']['id']; ?>&nbsp;</td>
		<td><?php echo $documentType['DocumentType']['name']; ?>&nbsp;</td>
		<td><?php echo $documentType['DocumentType']['created']; ?>&nbsp;</td>
		<td><?php echo $documentType['DocumentType']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $documentType['DocumentType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $documentType['DocumentType']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $documentType['DocumentType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $documentType['DocumentType']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Document Type', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List User Fields', true), array('controller' => 'user_fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Field', true), array('controller' => 'user_fields', 'action' => 'add')); ?> </li>
	</ul>
</div>