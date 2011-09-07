<div class="pages index">
	<h2><?php __('Pages');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('keywords');?></th>
			<th><?php echo $this->Paginator->sort('active');?></th>
			<th><?php echo $this->Paginator->sort('content');?></th>
			<th><?php echo $this->Paginator->sort('slug');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($pages as $page):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $page['Page']['id']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['title']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['description']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['keywords']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['active']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['content']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['slug']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['created']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $page['Page']['id']),array('class'=>'view')); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $page['Page']['id'],array('class'=>'edit')); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $page['Page']['id']), array('class'=>'delete'), sprintf(__('Are you sure you want to delete # %s?', true), $page['Page']['id'])); ?>
			<?php if(isset(!$page['Page']['active'])&& $page['Page']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $page['Page']['id']), array('class'=>'delete'), sprintf(__('Are you sure you want to inactive # %s?', true), $page['Page']['id']));
}			<?php if(isset(!$page['Page']['active'])&& !$page['Page']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $page['Page']['id']), array('class'=>'delete'), sprintf(__('Are you sure you want to active # %s?', true), $page['Page']['id'])); 
}
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