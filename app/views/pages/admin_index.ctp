<div class="pages index">
	<h2><?php __('Pages');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('menu_id');?></th>
						
		<th><?php echo $this->Paginator->sort('page_type_id');?></th>
						
		<th><?php echo $this->Paginator->sort('title');?></th>
						
		<th><?php echo $this->Paginator->sort('wysiwg_content');?></th>
						
		<th><?php echo $this->Paginator->sort('pic_1');?></th>
						
		<th><?php echo $this->Paginator->sort('pic_2');?></th>
						
		<th><?php echo $this->Paginator->sort('pic_3');?></th>
						
		<th><?php echo $this->Paginator->sort('pic_4');?></th>
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
		<td>
			<?php echo $this->Html->link($page['Menu']['title'], array('controller' => 'menus', 'action' => 'view', $page['Menu']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($page['PageType']['name'], array('controller' => 'page_types', 'action' => 'view', $page['PageType']['id'])); ?>
		</td>
		<td><?php echo $page['Page']['title']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['wysiwg_content']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['pic_1']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['pic_2']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['pic_3']; ?>&nbsp;</td>
		<td><?php echo $page['Page']['pic_4']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $page['Page']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $page['Page']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $page['Page']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $page['Page']['id'])); ?>
			<?php if(isset($page['Page']['active'])&& $page['Page']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $page['Page']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $page['Page']['id']));
}?>
			<?php if(isset($page['Page']['active'])&& !$page['Page']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $page['Page']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $page['Page']['id'])); 
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