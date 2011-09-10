<div class="clubsUsers view">
<h2><?php  __('Clubs User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $clubsUser['ClubsUser']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Club'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($clubsUser['Club']['name'], array('controller' => 'clubs', 'action' => 'view', $clubsUser['Club']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($clubsUser['User']['email'], array('controller' => 'users', 'action' => 'view', $clubsUser['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>


