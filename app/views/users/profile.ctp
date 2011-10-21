<div class="profile tahoma category">
	<ul class='profile-menu'>
		<li><a href='/users/edit/<?php echo $this->Session->read('Auth.User.id') ?>'> Mis datos</a></li>
		
	</ul>
	<ul>
		<li class="azul">
			Mis Ordenes
		</li>
	</ul>
	<?php $orders = $this -> requestAction('/orders/getOrders');?>
	<ul>
		<?php if($orders){
		?>
		<?php foreach($orders as $order):
		?>
		<li>
			<?php echo $html -> link($order['Order']['code'], array('controller' => 'orders', 'action' => 'view', $order['Order']['id']), array('class' => 'titulo_rosado'));?>
		</li>
		<?php endforeach;?>
		<?php }else{?>
		<li class="azul">
			No tienes pedidos
		</li>
		<?php }?>
		<div style="clear: both"></div>
	</ul>
	<?php $products = $this -> requestAction('/visited_products/visited');?>
	<?php if($products):
	?>
	<ul>
		<li class="azul">
			Ultimos Productos Vistos
		</li>
	</ul>
	<ul class='img_catalogo'>
		<?php foreach($products as $product):
		?>
		<li>
			<?php echo $html -> image('uploads/' . $product['Product']['image']);?>
		</li>
		<?php endforeach;?>
		<div style="clear: both"></div>
	</ul>
	<?php endif;?>
</div>