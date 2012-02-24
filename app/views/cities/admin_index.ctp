
<div class="cities index">
	<h2><?php __('Cities');?></h2>
	<table cellpadding="0" cellspacing="0" >
	<tr  >
		<th><?php echo $this->Paginator->sort('country_id');?></th>
		<th><?php echo $this->Paginator->sort('name');?></th>
		<th><?php echo $this->Paginator->sort('description');?></th>
		<th><?php echo $this->Paginator->sort('image');?></th>
		<th><?php echo $this->Paginator->sort('is_present');?></th>
		<th><?php echo $this->Paginator->sort('code');?></th>
		<!--
		<th><?php echo $this->Paginator->sort('lat');?></th>
		<th><?php echo $this->Paginator->sort('long');?></th>
		<th><?php echo $this->Paginator->sort('created');?></th>
		<th><?php echo $this->Paginator->sort('updated');?></th>
		-->
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($cities as $city):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $city['City']['id'] ?>'>
		<td>
			<?php echo $this->Html->link($city['Country']['name'], array('controller' => 'countries', 'action' => 'view', $city['Country']['id'])); ?>
		</td>
		<td><?php echo $city['City']['name']; ?>&nbsp;</td>
		<td><?php echo $city['City']['description']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$city['City']['image']); ?>&nbsp;</td>
		<td>
			<?php
				// echo $city['City']['is_present'];
				if($city['City']['is_present']) {
					echo '<input type="checkbox" disabled checked />';
				} else {
					echo '<input type="checkbox" disabled />';
				}
			?>
			&nbsp;
		</td>
		<td><?php echo $city['City']['code']; ?>&nbsp;</td>
		<!--
		<td><?php echo $city['City']['lat']; ?>&nbsp;</td>
		<td><?php echo $city['City']['long']; ?>&nbsp;</td>
		<td><?php echo $city['City']['created']; ?>&nbsp;</td>
		<td><?php echo $city['City']['updated']; ?>&nbsp;</td>
		-->
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $city['City']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $city['City']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $city['City']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $city['City']['id'])); ?>
			<?php if(isset($city['City']['active'])&& $city['City']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $city['City']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $city['City']['id']));
}?>
			<?php if(isset($city['City']['active'])&& !$city['City']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $city['City']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $city['City']['id'])); 
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
