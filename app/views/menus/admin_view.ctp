<div class="menus view">
<h2><?php  __('Menu');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menu['Menu']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Wysiwyg Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menu['Menu']['wysiwyg_title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Background Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menu['Menu']['background_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Slug'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $menu['Menu']['slug']; ?>
			&nbsp;
		</dd>
	</dl>
</div>


<div class="related">
	<h3><?php __('Related Pages');?></h3>
	<?php if (!empty($menu['Page'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>

		<th><?php __('Page Type Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th>Content</th>

		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($menu['Page'] as $page):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>

			<td><?php echo $pageTypes[$page['page_type_id']];?></td>
			<td><?php echo $page['title'];?></td>
			<td><?php echo $page['wysiwyg_content'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__(' ', true), array('controller' => 'pages', 'action' => 'view', $page['id']),array("class"=>"icon view","title"=>"view")); ?>
				<?php 
					if( $page['page_type_id']==1){
						echo $this->Html->link(__(' ', true), array('controller' => 'pages', 'action' => 'editTextPage', $page['id']),array("class"=>"icon edit")); 
					}else{
						echo $this->Html->link(__(' ', true), array('controller' => 'pages', 'action' => 'editGalleryPage', $page['id']),array("class"=>"icon edit")); 
					}
				?>
				<?php echo $this->Html->link(__(' ', true), array('controller' => 'pages', 'action' => 'delete', $page['id']), array("class"=>"icon delete","title"=>"delete"), sprintf(__('Are you sure you want to delete # %s?', true), $page['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Page', true), array('controller' => 'pages', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
