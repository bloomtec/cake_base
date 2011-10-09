<div class="couponBatches index">
	<h2><?php __('Coupon Batches');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
									
							<th><?php echo $this->Paginator->sort('name');?></th>
									
							<th><?php echo $this->Paginator->sort('description');?></th>
									
							<th><?php echo $this->Paginator->sort('value');?></th>
									
							<th><?php echo $this->Paginator->sort('created');?></th>
									
							<th><?php echo $this->Paginator->sort('updated');?></th>
								<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($couponBatches as $couponBatch):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $couponBatch['CouponBatch']['name']; ?>&nbsp;</td>
		<td><?php echo $couponBatch['CouponBatch']['description']; ?>&nbsp;</td>
		<td><?php echo $couponBatch['CouponBatch']['value']; ?>&nbsp;</td>
		<td><?php echo $couponBatch['CouponBatch']['created']; ?>&nbsp;</td>
		<td><?php echo $couponBatch['CouponBatch']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $couponBatch['CouponBatch']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $couponBatch['CouponBatch']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $couponBatch['CouponBatch']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $couponBatch['CouponBatch']['id'])); ?>
			<?php if(isset($couponBatch['CouponBatch']['active'])&& $couponBatch['CouponBatch']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $couponBatch['CouponBatch']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $couponBatch['CouponBatch']['id']));
}?>
			<?php if(isset($couponBatch['CouponBatch']['active'])&& !$couponBatch['CouponBatch']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $couponBatch['CouponBatch']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $couponBatch['CouponBatch']['id'])); 
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
	<div class="actions">
		<ul>
			<li>	<?php echo $this->Html->link(__('Add', true), array('action' => 'add'),array('class'=>'add')); ?>
</li>
		</ul>
	</div>
</div>
