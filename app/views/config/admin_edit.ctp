<div class="orders form">
<?php echo $this->Form->create('Config',array("url"=>"/admin/config/edit"));?>
	<fieldset>
		<legend><?php __('Modificar Configuración'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('score_by_registering', array('label' => __('Premio De Registro', true)));
		echo $this->Form->input('score_by_invitations', array('label' => __('Premio De Invitación', true)));
		echo $this->Form->input('max_score_by_invitations', array('label' => __('Máximo De Premio Por Invitación', true)));
		echo $this->Form->input('score_for_buying', array('label' => __('Premio De Compra', true)));
		echo $this->Form->input('is_newsletter_active', array('label' => __('Envío De Correos Activo', true)));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>