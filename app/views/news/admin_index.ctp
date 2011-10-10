<div class="news index">
	<h2><?php __('News');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
				
									
							<th><?php echo $this->Paginator->sort('name');?></th>
									
							<th><?php echo $this->Paginator->sort('description');?></th>
									
							<th><?php echo $this->Paginator->sort('wysiwyg_content');?></th>
									
							<th><?php echo $this->Paginator->sort('image');?></th>
									
							<th><?php echo $this->Paginator->sort('created');?></th>
									
							<th><?php echo $this->Paginator->sort('updated');?></th>
								<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($news as $news):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $news['News']['name']; ?>&nbsp;</td>
		<td><?php echo $news['News']['description']; ?>&nbsp;</td>
		<td><?php echo $news['News']['wysiwyg_content']; ?>&nbsp;</td>
		<td><?php echo $this->Html->image('uploads/100x100/'.$news['News']['image']); ?>&nbsp;</td>
		<td><?php echo $news['News']['created']; ?>&nbsp;</td>
		<td><?php echo $news['News']['updated']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $news['News']['id']),array('class'=>'view icon','title'=>__('View',true))); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $news['News']['id']),array('class'=>'edit icon','title'=>__('Edit',true))); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $news['News']['id']), array('class'=>'delete icon','title'=>__('Delete',true)), sprintf(__('Are you sure you want to delete # %s?', true), $news['News']['id'])); ?>
			<?php if(isset($news['News']['active'])&& $news['News']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setInactive', $news['News']['id']), array('class'=>'setInactive icon','title'=>__('Set Inactive',true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $news['News']['id']));
}?>
			<?php if(isset($news['News']['active'])&& !$news['News']['active']){
			 echo $this->Html->link(__(' ', true), array('action' => 'setActive', $news['News']['id']), array('class'=>'setActive icon','title'=>__('Set Active',true)), sprintf(__('Are you sure you want to set active # %s?', true), $news['News']['id'])); 
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
