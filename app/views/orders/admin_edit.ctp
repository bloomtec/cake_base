<div class="orders form">
<?php echo $this->Form->create('Order');?>
	<fieldset>
		<legend><?php __('Admin Edit Order'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code');
		echo $this->Form->input('user_id');
		echo $this->Form->input('user_agent');
		echo $this->Form->input('order_state_id');
		echo $this->Form->input('coupon_id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('apellido');
		echo $this->Form->input('pais');
		echo $this->Form->input('estado');
		echo $this->Form->input('ciudad');
		echo $this->Form->input('direccion');
		echo $this->Form->input('telefono');
		echo $this->Form->input('celular');
		echo $this->Form->input('email');
		echo $this->Form->input('subtotal');
		echo $this->Form->input('descuento');
		echo $this->Form->input('total');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

