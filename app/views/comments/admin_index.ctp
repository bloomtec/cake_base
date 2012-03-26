<div class="comments index">
	<h2><?php __('Comments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
									
					<th><?php echo $this->Paginator->sort('users_id');?></th>
									
					<th><?php echo $this->Paginator->sort('comment');?></th>
									
					<th><?php echo $this->Paginator->sort('model');?></th>
									
					<th><?php echo $this->Paginator->sort('foreign_key');?></th>
										<th><?php echo $this->Paginator->sort('Status','active');?></th>
						
					<th><?php echo $this->Paginator->sort('alias');?></th>
									
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
		<td>
			<?php echo $this->Html->link($comment['Users']['id'], array('controller' => 'users', 'action' => 'view', $comment['Users']['id'])); ?>
		</td>
		<td><?php echo $comment['Comment']['comment']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['model']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['foreign_key']; ?>&nbsp;</td>
<?php if($comment['Comment']['active']){ ?>
		<td><?php echo 'Active'; ?>&nbsp;</td>
<?php }else{ ?>
		<td><?php echo 'Inactive'; ?>&nbsp;</td>
<?php }
 ?>		<td><?php echo $comment['Comment']['alias']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['created']; ?>&nbsp;</td>
		<td><?php echo $comment['Comment']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $comment['Comment']['slug']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $comment['Comment']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $comment['Comment']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $comment['Comment']['id'])); ?>
			<?php if(isset($comment['Comment']['active'])&& $comment['Comment']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $comment['Comment']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $comment['Comment']['id']));
}?>
			<?php if(isset($comment['Comment']['active'])&& !$comment['Comment']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $comment['Comment']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $comment['Comment']['id'])); 
}?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
		<?php
			echo $this->Paginator->counter(array('format' => __('Página %page% de %pages%, mostrando %current% registros de un total de %count%, desde el %start%, hasta el %end%', true)));
		?>
	</p>
	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
	<div class="actions">
		<ul>
			<li>	<?php echo $this->Html->link(__('Agregar', true), array('action' => 'add'),array('class'=>'add')); ?>
</li>
		</ul>
	</div>
</div>
