<div class="adPositions view">
<h2><?php  __('Ad Position');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $adPosition['AdPosition']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $adPosition['AdPosition']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $adPosition['AdPosition']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>


<div class="related">
	<h3><?php __('Related Ads');?></h3>
	<?php if (!empty($adPosition['Ad'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Wysiwyg Content'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th><?php __('Prints'); ?></th>
		<th><?php __('Clicks'); ?></th>
		<th><?php __('Ad Position Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($adPosition['Ad'] as $ad):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $ad['id'];?></td>
			<td><?php echo $ad['name'];?></td>
			<td><?php echo $ad['wysiwyg_content'];?></td>
			<td><?php echo $ad['created'];?></td>
			<td><?php echo $ad['updated'];?></td>
			<td><?php echo $ad['prints'];?></td>
			<td><?php echo $ad['clicks'];?></td>
			<td><?php echo $ad['ad_position_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'ads', 'action' => 'view', $ad['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'ads', 'action' => 'edit', $ad['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'ads', 'action' => 'delete', $ad['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ad['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Ad', true), array('controller' => 'ads', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
