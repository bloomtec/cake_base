<div class="countries view">
<h2><?php  __('Country');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $country['Country']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $country['Country']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Image'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image('uploads/100x100/'.$country['Country']['image']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Language'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $country['Country']['language']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Present'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php
				// echo $country['Country']['is_present'];
				if($country['Country']['is_present']) {
					echo '<input type="checkbox" disabled checked />';
				} else {
					echo '<input type="checkbox" disabled />';
				}
			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $country['Country']['code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Money Symbol'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $country['Country']['money_symbol']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price Ranges'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $country['Country']['price_ranges']; ?>
			&nbsp;
		</dd>
		<!--
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $country['Country']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $country['Country']['updated']; ?>
			&nbsp;
		</dd>
		-->
	</dl>
</div>


<div class="related">
	<h3><?php __('Related Addresses');?></h3>
	<?php if (!empty($country['Address'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Adress'); ?></th>
		<th><?php __('Zip'); ?></th>
		<th><?php __('Country Id'); ?></th>
		<th><?php __('City Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($country['Address'] as $address):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $address['name'];?></td>
			<td><?php echo $address['user_id'];?></td>
			<td><?php echo $address['address'];?></td>
			<td><?php echo $address['zip'];?></td>
			<td><?php echo $address['country_id'];?></td>
			<td><?php echo $address['city_id'];?></td>
			<td><?php echo $address['created'];?></td>
			<td><?php echo $address['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'addresses', 'action' => 'view', $address['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'addresses', 'action' => 'edit', $address['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'addresses', 'action' => 'delete', $address['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $address['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Address', true), array('controller' => 'addresses', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Cities');?></h3>
	<?php if (!empty($country['City'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Image'); ?></th>
		<th><?php __('Is Present'); ?></th>
		<th><?php __('Code'); ?></th>
		<!--
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		-->
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($country['City'] as $city):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $city['name'];?></td>
			<td><?php echo $city['description'];?></td>
			<td><?php echo $this->Html->image('/img/uploads/100x100/'.$city['image']); ?></td>
			<td>
				<?php
					if($city['is_present']) {
						echo '<input type="checkbox" disabled checked />';
					} else {
						echo '<input type="checkbox" disabled />';
					}
				?>
			</td>
			<td><?php echo $city['code'];?></td>
			<!--
			<td><?php echo $city['created'];?></td>
			<td><?php echo $city['updated'];?></td>
			-->
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'cities', 'action' => 'view', $city['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'cities', 'action' => 'edit', $city['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'cities', 'action' => 'delete', $city['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $city['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New City', true), array('controller' => 'cities', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
