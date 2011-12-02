<?php echo $this->Html->script('sortable');?>
<div class="tagSliders index">
	<h2><?php __('Tag Sliders');?></h2>
	<table cellpadding="0" cellspacing="0" id="sortable" controller="tagSliders">
	<tr class="ui-state-disabled" >
		<th ><?php echo $this->Paginator->sort('sort');?></th>
		<th><?php echo $this->Paginator->sort('tag_id');?></th>
		<th><?php echo $this->Paginator->sort('name');?></th>
		<th><?php echo $this->Paginator->sort('wysiwyg_content');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($tagSliders as $tagSlider):
		$class = ' class=" ui-state-default "';
		if ($i++ % 2 == 0) {
			$class = ' class="altrow ui-state-default "';
		}
	?>
	<tr<?php echo $class;?> id='<?php echo $tagSlider['TagSlider']['id'] ?>'>
		<td class='sort'>
			<?php echo $tagSlider['TagSlider']['sort'] ?>
		</td>
		<td>
			<?php echo $this->Html->link($tagSlider['Tag']['name'], array('controller' => 'tags', 'action' => 'view', $tagSlider['Tag']['id'])); ?>
		</td>
		<td><?php echo $tagSlider['TagSlider']['name']; ?>&nbsp;</td>
		<td><?php echo $tagSlider['TagSlider']['wysiwyg_content']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $tagSlider['TagSlider']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $tagSlider['TagSlider']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $tagSlider['TagSlider']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $tagSlider['TagSlider']['id'])); ?>
			<?php if(isset($tagSlider['TagSlider']['active'])&& $tagSlider['TagSlider']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $tagSlider['TagSlider']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $tagSlider['TagSlider']['id']));
}?>
			<?php if(isset($tagSlider['TagSlider']['active'])&& !$tagSlider['TagSlider']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $tagSlider['TagSlider']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $tagSlider['TagSlider']['id'])); 
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
