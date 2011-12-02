<?php echo $this->Html->script('sortable');?>
<div class="pageSliders index">
	<h2><?php __('Page Sliders');?></h2>
	<table cellpadding="0" cellspacing="0" id="sortable" controller="pageSliders">
	<tr class="ui-state-disabled" >
		<th ><?php echo $this->Paginator->sort('sort');?></th>
		<th><?php echo $this->Paginator->sort('page_id');?></th>
		<th><?php echo $this->Paginator->sort('name');?></th>
		<th><?php echo $this->Paginator->sort('description');?></th>
		<th><?php echo $this->Paginator->sort('wysiwyg_content');?></th>
		<th><?php echo $this->Paginator->sort('created');?></th>
		<th><?php echo $this->Paginator->sort('updated');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($pageSliders as $pageSlider):
		$class = ' class=" ui-state-default "';
		if ($i++ % 2 == 0) {
			$class = ' class="altrow ui-state-default "';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $pageSlider['PageSlider']['id'] ?>'>
		<td class='sort'>
			<?php echo $pageSlider['PageSlider']['sort'] ?>
		</td>
		<td>
			<?php echo $this->Html->link($pageSlider['Page']['name'], array('controller' => 'pages', 'action' => 'view', $pageSlider['Page']['id'])); ?>
		</td>
		<td><?php echo $pageSlider['PageSlider']['name']; ?>&nbsp;</td>
		<td><?php echo $pageSlider['PageSlider']['description']; ?>&nbsp;</td>
		<td><?php echo $pageSlider['PageSlider']['wysiwyg_content']; ?>&nbsp;</td>
		<td><?php echo $pageSlider['PageSlider']['created']; ?>&nbsp;</td>
		<td><?php echo $pageSlider['PageSlider']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $pageSlider['PageSlider']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $pageSlider['PageSlider']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $pageSlider['PageSlider']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $pageSlider['PageSlider']['id'])); ?>
			<?php if(isset($pageSlider['PageSlider']['active'])&& $pageSlider['PageSlider']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $pageSlider['PageSlider']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $pageSlider['PageSlider']['id']));
}?>
			<?php if(isset($pageSlider['PageSlider']['active'])&& !$pageSlider['PageSlider']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $pageSlider['PageSlider']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $pageSlider['PageSlider']['id'])); 
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
			<li>	<?php echo $this->Html->link(__('Add', true), array('action' => 'add',$this->params['pass'][0]),array('class'=>'add')); ?>
</li>
		</ul>
	</div>
</div>
