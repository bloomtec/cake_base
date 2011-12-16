<?php echo $this->Html->script('sortable');?>
<div class="tags index">
	<h2><?php __('Tags');?></h2>
	<table cellpadding="0" cellspacing="0" id="sortable" controller="tags">
	<tr class="ui-state-disabled" >
		<th ><?php echo $this->Paginator->sort('sort');?></th>
		<th><?php echo $this->Paginator->sort('name');?></th>
		<th><?php echo $this->Paginator->sort('in_gamers');?></th>
		<th><?php echo $this->Paginator->sort('sort_in_gamers');?></th>
		<th><?php echo $this->Paginator->sort('description');?></th>
		<th><?php echo $this->Paginator->sort('keywords');?></th>
		<th><?php echo $this->Paginator->sort('created');?></th>
		<th><?php echo $this->Paginator->sort('updated');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($tags as $tag):
		$class = ' class=" ui-state-default "';
		if ($i++ % 2 == 0) {
			$class = ' class="altrow ui-state-default "';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $tag['Tag']['id'] ?>'>
		<td class='sort'>
			<?php echo $tag['Tag']['sort'] ?>
		</td>
		<td><?php echo $tag['Tag']['name']; ?>&nbsp;</td>
		<td><?php echo $tag['Tag']['in_gamers']; ?>&nbsp;</td>
		<td><?php echo $tag['Tag']['sort_in_gamers']; ?>&nbsp;</td>
		<td><?php echo $tag['Tag']['description']; ?>&nbsp;</td>
		<td><?php echo $tag['Tag']['keywords']; ?>&nbsp;</td>
		<td><?php echo $tag['Tag']['created']; ?>&nbsp;</td>
		<td><?php echo $tag['Tag']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $tag['Tag']['slug']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $tag['Tag']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Sliders', true), array('controller'=>'tagSliders', 'action' => 'index', $tag['Tag']['id']),array('class'=>'slider icon','title'=>__('Slider',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $tag['Tag']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $tag['Tag']['id'])); ?>
			<?php if(isset($tag['Tag']['active'])&& $tag['Tag']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $tag['Tag']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $tag['Tag']['id']));
}?>
			<?php if(isset($tag['Tag']['active'])&& !$tag['Tag']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $tag['Tag']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $tag['Tag']['id'])); 
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
