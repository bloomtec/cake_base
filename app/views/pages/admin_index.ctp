<div class="pages index">
	<h2><?php __('Pages');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>				
		<th><?php echo $this->Paginator->sort('name');?></th>
		<th><?php echo $this->Paginator->sort('description');?></th>
		<th><?php echo $this->Paginator->sort('keywords');?></th>
		<th><?php echo $this->Paginator->sort('Status','active');?></th>									
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
		<td><?php echo $page['Page']['name']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['description']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['keywords']; ?>&nbsp;</td>
<?php if($page['Page']['active']){ ?>
		<td><?php echo 'Active'; ?>&nbsp;</td>
<?php }else{ ?>
		<td><?php echo 'Inactive'; ?>&nbsp;</td>
<?php }
 ?>		
		<td><?php echo $page['Page']['created']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $page['Page']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $page['Page']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $page['Page']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $page['Page']['id'])); ?>
			<?php if(isset($page['Page']['active'])&& $page['Page']['active']){
			 echo $this->Html->link(__('Set Inactive', true), array('action' => 'setInactive', $page['Page']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $page['Page']['id']));
}?>
			<?php if(isset($page['Page']['active'])&& !$page['Page']['active']){
			 echo $this->Html->link(__('Set Active', true), array('action' => 'setActive', $page['Page']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $page['Page']['id'])); 
}?>
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
