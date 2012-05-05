<div class="comments form">
<?php echo $this->Form->create('Comment');?>
	<fieldset>
		<legend><?php __('Añadir Comentario'); ?></legend>
	<?php
		echo $this->Form->input('users_id', array('label' => __('Usuario', true)));
		echo $this->Form->input('comment', array('label' => __('Comentario', true)));
		echo $this->Form->input('model', array('label' => __('Modelo', true)));
		echo $this->Form->input('foreign_key', array('label' => __('Llave Foránea', true)));
		echo $this->Form->input('active', array('label' => __('Activo', true)));
		echo $this->Form->input('alias', array('label' => __('Alias', true)));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>