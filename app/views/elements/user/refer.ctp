<?php echo $this -> Form -> create('User');?>
<fieldset>
	<?php $user = $this -> Session -> read('Auth');	?>
	<div class="input text">
		<label for="UserCorreoRecomendado1">
			<?php echo __('Refered email'); ?> 1
		</label>
		<input name="data[User][correo_recomendado_1]" type="text" id="UserCorreoRecomendado1">
	</div>
	<div class="input text">
		<label for="UserCorreoRecomendado2">
			<?php echo __('Refered email'); ?> 2
		</label>
		<input name="data[User][correo_recomendado_2]" type="text" id="UserCorreoRecomendado2">
	</div>
	<div class="input text">
		<label for="UserCorreoRecomendado3">
			<?php echo __('Refered email'); ?> 3
		</label>
		<input name="data[User][correo_recomendado_3]" type="text" id="UserCorreoRecomendado3">
	</div>
	<div class="input text">
		<label for="UserCorreoRecomendado4">
			<?php echo __('Refered email'); ?> 4
		</label>
		<input name="data[User][correo_recomendado_4]" type="text" id="UserCorreoRecomendado4">
	</div>
	<div class="input text">
		<label for="UserCorreoRecomendado5">
			<?php echo __('Refered email'); ?> 5
		</label>
		<input name="data[User][correo_recomendado_5]" type="text" id="UserCorreoRecomendado5">
	</div>
	<?php echo $this -> Form -> end(__('Refer Friends', true));?>
<div style="clear:both;"></div>
</fieldset>