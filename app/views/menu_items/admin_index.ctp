<div class="menuItems index">
	<h2><?php __('Menu Items');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('menu_id');?></th>
						
		<th><?php echo $this->Paginator->sort('parent_id');?></th>
						
		<th><?php echo $this->Paginator->sort('lft');?></th>
						
		<th><?php echo $this->Paginator->sort('rght');?></th>
						
		<th><?php echo $this->Paginator->sort('name');?></th>
						
		<th><?php echo $this->Paginator->sort('link');?></th>
						
		<th><?php echo $this->Paginator->sort('created');?></th>
						
		<th><?php echo $this->Paginator->sort('updated');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($menuItems as $menuItem):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $menuItem['MenuItem']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($menuItem['Menu']['name'], array('controller' => 'menus', 'action' => 'view', $menuItem['Menu']['id'])); ?>
		</td>
		<td><?php echo $menuItem['MenuItem']['parent_id']; ?>&nbsp;</td>
		<td><?php echo $menuItem['MenuItem']['lft']; ?>&nbsp;</td>
		<td><?php echo $menuItem['MenuItem']['rght']; ?>&nbsp;</td>
		<td><?php echo $menuItem['MenuItem']['name']; ?>&nbsp;</td>
		<td><?php echo $menuItem['MenuItem']['link']; ?>&nbsp;</td>
		<td><?php echo $menuItem['MenuItem']['created']; ?>&nbsp;</td>
		<td><?php echo $menuItem['MenuItem']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $menuItem['MenuItem']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $menuItem['MenuItem']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $menuItem['MenuItem']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $menuItem['MenuItem']['id'])); ?>
			<?php if(isset($menuItem['MenuItem']['active'])&& $menuItem['MenuItem']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $menuItem['MenuItem']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $menuItem['MenuItem']['id']));
}?>
			<?php if(isset($menuItem['MenuItem']['active'])&& !$menuItem['MenuItem']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $menuItem['MenuItem']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $menuItem['MenuItem']['id'])); 
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