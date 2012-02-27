
<div class="deals index">
	<h2><?php __('Deals');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr  >
		<th><?php echo $this->Paginator->sort('restaurant_id');?></th>
		<th><?php echo $this->Paginator->sort('name');?></th>
		<th><?php echo $this->Paginator->sort('description');?></th>
		<th><?php echo $this->Paginator->sort('image');?></th>
		<th><?php echo $this->Paginator->sort('amount');?></th>
		<th><?php echo $this->Paginator->sort('price');?></th>
		<th><?php echo $this->Paginator->sort('max_buys');?></th>
		<th><?php echo $this->Paginator->sort('visits');?></th>
		<th><?php echo $this->Paginator->sort('created');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($deals as $deal):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $deal['Deal']['id'] ?>'>
		<td>
			<?php echo $this->Html->link($deal['Restaurant']['name'], array('controller' => 'restaurants', 'action' => 'view', $deal['Restaurant']['id'])); ?>
		</td>
		<td><?php echo $deal['Deal']['name']; ?>&nbsp;</td>
		<td><?php echo $deal['Deal']['description']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$deal['Deal']['image']); ?>&nbsp;</td>
		<td><?php echo $deal['Deal']['amount']; ?>&nbsp;</td>
		<td><?php echo $deal['Deal']['price']; ?>&nbsp;</td>
		<td><?php echo $deal['Deal']['max_buys']; ?>&nbsp;</td>
		<td><?php echo $deal['Deal']['visits']; ?>&nbsp;</td>
		<td><?php echo $deal['Deal']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php
				echo $this->Html->link(__('View', true), array('action' => 'view', $deal['Deal']['slug']),array('class'=>'view icon','title'=>__('View',true)));
				if($this -> Session -> read('Auth.User.role_id') != 4) {
					echo $this->Html->link(__('Edit', true), array('action' => 'edit', $deal['Deal']['id']),array('class'=>'edit icon','title'=>__('Edit',true)));
					echo $this->Html->link(__('Delete', true), array('action' => 'delete', $deal['Deal']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $deal['Deal']['id']));
				}
			?>
			<?php if(isset($deal['Deal']['active'])&& $deal['Deal']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $deal['Deal']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $deal['Deal']['id']));
}?>
			<?php if(isset($deal['Deal']['active'])&& !$deal['Deal']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $deal['Deal']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $deal['Deal']['id'])); 
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
	<?php if($this -> Session -> read('Auth.User.role_id') != 4) : ?>
	<div class="actions">
		<ul>
			<li>
				<?php echo $this->Html->link(__('Add', true), array('action' => 'add'),array('class'=>'add')); ?>
			</li>
		</ul>
	</div>
	<?php endif; ?>
</div>