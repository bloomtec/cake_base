<div class="publicMessages index">
	<h2><?php __('Public Messages');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('to_user_id');?></th>
						
		<th><?php echo $this->Paginator->sort('from_user_id');?></th>
						
		<th><?php echo $this->Paginator->sort('subject');?></th>
						
		<th><?php echo $this->Paginator->sort('content');?></th>
						
		<th><?php echo $this->Paginator->sort('created');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($publicMessages as $publicMessage):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $publicMessage['PublicMessage']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($publicMessage['ToUser']['email'], array('controller' => 'users', 'action' => 'view', $publicMessage['ToUser']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($publicMessage['FromUser']['email'], array('controller' => 'users', 'action' => 'view', $publicMessage['FromUser']['id'])); ?>
		</td>
		<td><?php echo $publicMessage['PublicMessage']['subject']; ?>&nbsp;</td>
		<td><?php echo $publicMessage['PublicMessage']['content']; ?>&nbsp;</td>
		<td><?php echo $publicMessage['PublicMessage']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $publicMessage['PublicMessage']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $publicMessage['PublicMessage']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $publicMessage['PublicMessage']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $publicMessage['PublicMessage']['id'])); ?>
			<?php if(isset($publicMessage['PublicMessage']['active'])&& $publicMessage['PublicMessage']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $publicMessage['PublicMessage']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $publicMessage['PublicMessage']['id']));
}?>
			<?php if(isset($publicMessage['PublicMessage']['active'])&& !$publicMessage['PublicMessage']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $publicMessage['PublicMessage']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $publicMessage['PublicMessage']['id'])); 
}?>
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