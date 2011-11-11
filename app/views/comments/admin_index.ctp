<div class="comments index">
	<h2><?php __('Comments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
									
							<th><?php echo $this->Paginator->sort('comment');?></th>
									
							<th><?php echo $this->Paginator->sort('user_id');?></th>
									
							<th><?php echo $this->Paginator->sort('product_id');?></th>
									
							<th><?php echo $this->Paginator->sort('is_visible');?></th>
									
							<th><?php echo $this->Paginator->sort('created');?></th>
									
							<th><?php echo $this->Paginator->sort('updated');?></th>
								<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($comments as $comment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $comment['Comment']['comment']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($comment['User']['email'], array('controller' => 'users', 'action' => 'view', $comment['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($comment['Product']['name'], array('controller' => 'products', 'action' => 'view', $comment['Product']['id'])); ?>
		</td>
		<td><?php echo $comment['Comment']['is_visible']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['created']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $comment['Comment']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $comment['Comment']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $comment['Comment']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $comment['Comment']['id'])); ?>
			<?php if(isset($comment['Comment']['active'])&& $comment['Comment']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $comment['Comment']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $comment['Comment']['id']));
			}?>
			<?php if(isset($comment['Comment']['active'])&& !$comment['Comment']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $comment['Comment']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $comment['Comment']['id'])); 
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
