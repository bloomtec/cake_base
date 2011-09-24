<div class="menus index">
	<h2><?php __('Menus');?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this -> Paginator -> sort('id');?></th>
			<th><?php echo $this -> Paginator -> sort('wysiwyg_title');?></th>
			<th><?php echo $this -> Paginator -> sort('background_code');?></th>
			<th><?php echo $this -> Paginator -> sort('slug');?></th>
			<th class="actions"><?php __('Actions');?></th>
		</tr>
		<?php
$i = 0;
foreach ($menus as $menu):
$class = null;
if ($i++ % 2 == 0) {
$class = ' class="altrow"';
}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $menu['Menu']['id'];?>&nbsp;</td>
			<td><?php echo $menu['Menu']['wysiwyg_title'];?>&nbsp;</td>
			<td><?php echo $menu['Menu']['background_code'];?>&nbsp;</td>
			<td><?php echo $menu['Menu']['slug'];?>&nbsp;</td>
			<td class="actions"><?php
			echo $this -> Html -> link(__(' ', true), array('controller' => 'pages', 'action' => 'addTextPage', $menu['Menu']['id'], $menu['Menu']['wysiwyg_title']), array('class' => 'view icon', 'title' => __('Add Text Page', true)));
			echo $this -> Html -> link(__(' ', true), array('controller' => 'pages', 'action' => 'addGalleryPage', $menu['Menu']['id'], $menu['Menu']['wysiwyg_title']), array('class' => 'view icon', 'title' => __('Add Gallery Page', true)));
			?>
			<?php //echo $this -> Html -> link(__(' ', true), array('action' => 'view', $menu['Menu']['id']), array('class' => 'view icon', 'title' => __('View', true)));?>
			<?php //echo $this -> Html -> link(__(' ', true), array('action' => 'edit', $menu['Menu']['id']), array('class' => 'edit icon', 'title' => __('Edit', true)));?>
			<?php //echo $this -> Html -> link(__(' ', true), array('action' => 'delete', $menu['Menu']['id']), array('class' => 'delete icon', 'title' => __('Delete', true)), sprintf(__('Are you sure you want to delete # %s?', true), $menu['Menu']['id']));?>
			<?php
			$page = $this -> requestAction('/pages/getPageByMenuID/' . $menu['Menu']['id']);
			if (!empty($page)) {
				/**
				 * Existe la página para el menú, mostar el edit y/o delete
				 */
				if ($page[0]['Page']['page_type_id'] == 1) {
					echo $this -> Html -> link(__(' ', true), array('controller' => 'pages', 'action' => 'editTextPage', $page[0]['Page']['id'], $menu['Menu']['wysiwyg_title']), array('class' => 'edit icon', 'title' => __('Edit Text Page', true)));
					echo $this -> Html -> link(__(' ', true), array('controller' => 'pages', 'action' => 'deleteTextPage', $page[0]['Page']['id']), array('class' => 'delete icon', 'title' => __('Delete Text Page', true)), sprintf(__('Are you sure you want to delete the page?', true), null));
				} else {
					echo $this -> Html -> link(__(' ', true), array('controller' => 'pages', 'action' => 'editGalleryPage', $page[0]['Page']['id'], $menu['Menu']['wysiwyg_title']), array('class' => 'edit icon', 'title' => __('Edit Gallery Page', true)));
					echo $this -> Html -> link(__(' ', true), array('controller' => 'pages', 'action' => 'deleteGalleryPage', $page[0]['Page']['id']), array('class' => 'delete icon', 'title' => __('Delete Gallery Page', true)), sprintf(__('Are you sure you want to delete the page?', true), null));
				}
			} else {
				/**
				 * No existe la página para el menú, mostrar el/los add según el tipo de página
				 */
			}
			?>
			<?php
			if (isset($menu['Menu']['active']) && $menu['Menu']['active']) {
				echo $this -> Html -> link(__(' ', true), array('action' => 'setInactive', $menu['Menu']['id']), array('class' => 'setInactive icon', 'title' => __('Set Inactive', true)), sprintf(__('Are you sure you want to set inactive # %s?', true), $menu['Menu']['id']));
			}
			?>
			<?php
			if (isset($menu['Menu']['active']) && !$menu['Menu']['active']) {
				echo $this -> Html -> link(__(' ', true), array('action' => 'setActive', $menu['Menu']['id']), array('class' => 'setActive icon', 'title' => __('Set Active', true)), sprintf(__('Are you sure you want to set active # %s?', true), $menu['Menu']['id']));
			}
			?>
			</tr>
			<?php endforeach;?>
	</table>
	<p>
		<?php
		echo $this -> Paginator -> counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)));
		?>
	</p>
	<div class="paging">
		<?php echo $this -> Paginator -> prev('<< ' . __('previous', true), array(), null, array('class' => 'disabled'));?>
		| 	<?php echo $this -> Paginator -> numbers();?>
		|
		<?php echo $this -> Paginator -> next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>