<h1 class="premios">Premios</h1>
<p class="premios">
	En COMOPROMOS tus domicilios se convienten el premios, acumula puntos con tu registro, invitando a tus amigos a registrarse y por cada compra que realices. Aqui te damos las siguientes opciones
</p>
<?php foreach($prizes as $premio): ?>
	<div class="producto_premio">
		<a href="/prizes/view/<?php echo $premio ['Prize']['id']?>"><img src="/img/uploads/<?php echo $premio['Prize'] ['image'] ?>" /></a>
		<div class="premios_info">
				<a href="/prizes/view/<?php echo $premio ['Prize']['id']?>">
					<?php echo $premio ['Prize']['name'] ?>
				</a>
			<p>
				<?php echo $premio ['Prize']['description'] ?>
			</p>
		</div>
		<div class="premios_puntos">
			<h1>
				Para
				<?php if($this -> Session -> read('Auth.User.id')) : ?>
					<a href="/prizes/redeem/<?php echo $premio ['Prize']['id']?>">
				<?php endif; ?>
				REDIMIR
				<?php if($this -> Session -> read('Auth.User.id')) : ?>
					</a>
				<?php endif; ?>
				este premio, necesitas
			</h1>
			<h2><?php echo $premio ['Prize']['score'] ?> puntos</h2>
		</div>
		<div style="clear: both"></div>
	</div>
<?php	endforeach; ?>
<div class="paging">
	<?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
|
	<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>
