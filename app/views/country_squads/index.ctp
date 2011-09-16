<div class="countrySquads index">
	<h2><?php __('Country Squads');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('name');?></th>
						
		<th><?php echo $this->Paginator->sort('image');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($countrySquads as $countrySquad):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $countrySquad['CountrySquad']['id']; ?>&nbsp;</td>
		<td><?php echo $countrySquad['CountrySquad']['name']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$countrySquad['CountrySquad']['image']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $countrySquad['CountrySquad']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $countrySquad['CountrySquad']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $countrySquad['CountrySquad']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $countrySquad['CountrySquad']['id'])); ?>
			<?php if(isset($countrySquad['CountrySquad']['active'])&& $countrySquad['CountrySquad']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $countrySquad['CountrySquad']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $countrySquad['CountrySquad']['id']));
}?>
			<?php if(isset($countrySquad['CountrySquad']['active'])&& !$countrySquad['CountrySquad']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $countrySquad['CountrySquad']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $countrySquad['CountrySquad']['id'])); 
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