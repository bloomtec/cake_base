<div class="menus index">
	<h2><?php __('Menus');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
						
		<th><?php echo $this->Paginator->sort('Title','wysiwyg_title');?></th>
						
		<th><?php echo $this->Paginator->sort('background_code');?></th>
						
		<th><?php echo $this->Paginator->sort('slug');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($menus as $menu):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $menu['Menu']['wysiwyg_title']; ?>&nbsp;</td>
		<td><?php echo $menu['Menu']['background_code']; ?>&nbsp;</td>
		<td><?php echo $menu['Menu']['slug']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $menu['Menu']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $menu['Menu']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $menu['Menu']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $menu['Menu']['id'])); ?>
			<?php if(isset($menu['Menu']['active'])&& $menu['Menu']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $menu['Menu']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $menu['Menu']['id']));
}?>
			<?php if(isset($menu['Menu']['active'])&& !$menu['Menu']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $menu['Menu']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $menu['Menu']['id'])); 
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