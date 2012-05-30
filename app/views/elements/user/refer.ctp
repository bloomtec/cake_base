<?php echo $this -> Form -> create('User',array('style'=>'float:left;width:53%;'));?>
<p><?php __('Cuéntale a tus amigos acerca de nuestra página y acumula dinero!!'); ?></p>
<fieldset>
	<?php $user = $this -> Session -> read('Auth');	?>
	<div class="input text">
		<label for="UserCorreoRecomendado1">
			<?php echo __('correo eléctronico referido'); ?> 1
		</label>
		<input name="data[User][correo_recomendado_1]" type="text" id="UserCorreoRecomendado1">
	</div>
	<div class="input text">
		<label for="UserCorreoRecomendado2">
			<?php echo __('correo eléctronico referido'); ?> 2
		</label>
		<input name="data[User][correo_recomendado_2]" type="text" id="UserCorreoRecomendado2">
	</div>
	<div class="input text">
		<label for="UserCorreoRecomendado3">
			<?php echo __('correo eléctronico referido'); ?> 3
		</label>
		<input name="data[User][correo_recomendado_3]" type="text" id="UserCorreoRecomendado3">
	</div>
	<div class="input text">
		<label for="UserCorreoRecomendado4">
			<?php echo __('correo eléctronico referido'); ?> 4
		</label>
		<input name="data[User][correo_recomendado_4]" type="text" id="UserCorreoRecomendado4">
	</div>
	<div class="input text">
		<label for="UserCorreoRecomendado5">
			<?php echo __('correo eléctronico referido'); ?> 5
		</label>
		<input name="data[User][correo_recomendado_5]" type="text" id="UserCorreoRecomendado5">
	</div>
	<div style="clear:both;"></div>
	<?php echo $this -> Form -> end(__('Referir', true));?>
	<div style="clear:both;"></div>
</fieldset>