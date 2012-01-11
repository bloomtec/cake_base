<h1 class="premios">Premios</h1>
<p class="premios">
	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
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
			<h1>Para <a href="/prizes/view/<?php echo $premio ['Prize']['id']?>">REDIMIR</a> este premio, necesitas</h1>
			<h2><?php echo $premio ['Prize']['score'] ?> puntos</h2>
		</div>
		<div style="clear: both"></div>
	</div>
<?php	endforeach; ?>
<div class="paging">
	<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
|
	<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>
