<div class="couponBatches view">
<h2><?php  __('Coupon Batch');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $couponBatch['CouponBatch']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $couponBatch['CouponBatch']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $couponBatch['CouponBatch']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Value'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo (100*$couponBatch['CouponBatch']['value'])."%"; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $couponBatch['CouponBatch']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $couponBatch['CouponBatch']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>


<div class="related">
	<h3><?php __('Related Coupons');?></h3>
	<?php if (!empty($couponBatch['Coupon'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Coupon Batch Id'); ?></th>
		<th><?php __('Serial'); ?></th>
		<th><?php __('Is Redeemed'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($couponBatch['Coupon'] as $coupon):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $coupon['id'];?></td>
			<td><?php echo $coupon['coupon_batch_id'];?></td>
			<td><?php echo $coupon['serial'];?></td>
			<td><?php echo $coupon['is_redeemed'];?></td>
			<td><?php echo $coupon['created'];?></td>
			<td><?php echo $coupon['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'coupons', 'action' => 'delete', $coupon['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $coupon['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Back', true), array('controller' => 'coupon_batches', 'action' => 'index'));?> </li>
		</ul>
	</div>
</div>
