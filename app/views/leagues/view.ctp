<div class="leagues view">
<h2><?php  __('League');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $league['League']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $league['League']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Image'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image('uploads/100x100/'.$league['League']['image']); ?>
			&nbsp;
		</dd>
	</dl>
</div>


<div class="related">
	<h3><?php __('Related Clubs');?></h3>
	<?php if (!empty($league['Club'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('League Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Image'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($league['Club'] as $club):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $club['id'];?></td>
			<td><?php echo $club['league_id'];?></td>
			<td><?php echo $club['name'];?></td>
			<td><?php echo $club['image'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'clubs', 'action' => 'view', $club['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'clubs', 'action' => 'edit', $club['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'clubs', 'action' => 'delete', $club['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $club['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Club', true), array('controller' => 'clubs', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
