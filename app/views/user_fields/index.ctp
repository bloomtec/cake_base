<div class="userFields index">
	<h2><?php __('User Fields');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('user_id');?></th>
						
		<th><?php echo $this->Paginator->sort('document_type_id');?></th>
						
		<th><?php echo $this->Paginator->sort('document');?></th>
						
		<th><?php echo $this->Paginator->sort('name');?></th>
						
		<th><?php echo $this->Paginator->sort('surname');?></th>
						
		<th><?php echo $this->Paginator->sort('birthday');?></th>
						
		<th><?php echo $this->Paginator->sort('prefered_foot');?></th>
						
		<th><?php echo $this->Paginator->sort('created');?></th>
						
		<th><?php echo $this->Paginator->sort('updated');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($userFields as $userField):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $userField['UserField']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userField['User']['email'], array('controller' => 'users', 'action' => 'view', $userField['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($userField['DocumentType']['name'], array('controller' => 'document_types', 'action' => 'view', $userField['DocumentType']['id'])); ?>
		</td>
		<td><?php echo $userField['UserField']['document']; ?>&nbsp;</td>
		<td><?php echo $userField['UserField']['name']; ?>&nbsp;</td>
		<td><?php echo $userField['UserField']['surname']; ?>&nbsp;</td>
		<td><?php echo $userField['UserField']['birthday']; ?>&nbsp;</td>
		<td><?php echo $userField['UserField']['prefered_foot']; ?>&nbsp;</td>
		<td><?php echo $userField['UserField']['created']; ?>&nbsp;</td>
		<td><?php echo $userField['UserField']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $userField['UserField']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $userField['UserField']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $userField['UserField']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $userField['UserField']['id'])); ?>
			<?php if(isset($userField['UserField']['active'])&& $userField['UserField']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $userField['UserField']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $userField['UserField']['id']));
}?>
			<?php if(isset($userField['UserField']['active'])&& !$userField['UserField']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $userField['UserField']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $userField['UserField']['id'])); 
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