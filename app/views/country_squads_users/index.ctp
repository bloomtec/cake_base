<div class="countrySquadsUsers index">
	<h2><?php __('Country Squads Users');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
		<th><?php echo $this->Paginator->sort('id');?></th>
						
		<th><?php echo $this->Paginator->sort('country_squad_id');?></th>
						
		<th><?php echo $this->Paginator->sort('user_id');?></th>
					<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($countrySquadsUsers as $countrySquadsUser):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $countrySquadsUser['CountrySquadsUser']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($countrySquadsUser['CountrySquad']['name'], array('controller' => 'country_squads', 'action' => 'view', $countrySquadsUser['CountrySquad']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($countrySquadsUser['User']['email'], array('controller' => 'users', 'action' => 'view', $countrySquadsUser['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__(' ', true), array('action' => 'view', $countrySquadsUser['CountrySquadsUser']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'edit', $countrySquadsUser['CountrySquadsUser']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__(' ', true), array('action' => 'delete', $countrySquadsUser['CountrySquadsUser']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $countrySquadsUser['CountrySquadsUser']['id'])); ?>
			<?php if(isset($countrySquadsUser['CountrySquadsUser']['active'])&& $countrySquadsUser['CountrySquadsUser']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $countrySquadsUser['CountrySquadsUser']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $countrySquadsUser['CountrySquadsUser']['id']));
}?>
			<?php if(isset($countrySquadsUser['CountrySquadsUser']['active'])&& !$countrySquadsUser['CountrySquadsUser']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $countrySquadsUser['CountrySquadsUser']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $countrySquadsUser['CountrySquadsUser']['id'])); 
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