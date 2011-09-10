<div class="countrySquadsUsers view">
<h2><?php  __('Country Squads User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $countrySquadsUser['CountrySquadsUser']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Country Squad'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($countrySquadsUser['CountrySquad']['name'], array('controller' => 'country_squads', 'action' => 'view', $countrySquadsUser['CountrySquad']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($countrySquadsUser['User']['email'], array('controller' => 'users', 'action' => 'view', $countrySquadsUser['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>


