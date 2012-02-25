<div class="restaurants index">
	<h2><?php __('Restaurants');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr>
		<th><?php echo $this->Paginator->sort('zone_id');?></th>
		<th><?php echo $this->Paginator->sort('name');?></th>
		<th><?php echo $this->Paginator->sort('description');?></th>
		<th><?php echo $this->Paginator->sort('phone');?></th>
		<th><?php echo $this->Paginator->sort('image');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($restaurants as $restaurant):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $restaurant['Restaurant']['id'] ?>'>
		<td>
			<?php echo $this->Html->link($restaurant['Zone']['name'], array('controller' => 'zones', 'action' => 'view', $restaurant['Zone']['id'])); ?>
		</td>
		<td><?php echo $restaurant['Restaurant']['name']; ?>&nbsp;</td>
		<td><?php echo $restaurant['Restaurant']['description']; ?>&nbsp;</td>
		<td><?php echo $restaurant['Restaurant']['phone']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$restaurant['Restaurant']['image']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $restaurant['Restaurant']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $restaurant['Restaurant']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $restaurant['Restaurant']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $restaurant['Restaurant']['id'])); ?>
			<?php if(isset($restaurant['Restaurant']['active'])&& $restaurant['Restaurant']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $restaurant['Restaurant']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $restaurant['Restaurant']['id']));
}?>
			<?php if(isset($restaurant['Restaurant']['active'])&& !$restaurant['Restaurant']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $restaurant['Restaurant']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $restaurant['Restaurant']['id'])); 
}?>
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
	<div class="actions">
		<ul>
			<li>	<?php echo $this->Html->link(__('Add', true), array('action' => 'add'),array('class'=>'add')); ?>
</li>
		</ul>
	</div>
</div>