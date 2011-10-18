<div class="orders form">
<?php echo $this->Form->create('Order');?>
	<fieldset>
		<legend><?php __('Admin Edit Order'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('order_state_id');
		echo $this->Form->input('coupon_id', array("readonly"=>true));
		echo $this->Form->input('nombre', array("readonly"=>true));
		echo $this->Form->input('apellido', array("readonly"=>true));
		echo $this->Form->input('pais', array("readonly"=>true));
		echo $this->Form->input('estado', array("readonly"=>true));
		echo $this->Form->input('ciudad', array("readonly"=>true));
		echo $this->Form->input('direccion', array("readonly"=>true));
		echo $this->Form->input('telefono', array("readonly"=>true));
		echo $this->Form->input('celular', array("readonly"=>true));
		echo $this->Form->input('email', array("readonly"=>true));
		echo $this->Form->input('subtotal', array("readonly"=>true));
		echo $this->Form->input('descuento', array("readonly"=>true));
		echo $this->Form->input('total', array("readonly"=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

