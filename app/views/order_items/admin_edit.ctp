<div class="orderItems form">
<?php echo $this->Form->create('OrderItem');?>
	<fieldset>
		<legend><?php __('Admin Edit Order Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('order_id', array('readonly'=>true, 'value'=>$this->data['OrderItem']['order_id']));
		echo $this->Form->input('transportadora');
		echo $this->Form->input('guia');
		echo "<br />Talla&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:: " . $this->requestAction('/sizes/humanizeSize/'.$this->data['OrderItem']['size_id']) . "<br /><br />";
		if($this->data['OrderItem']['is_gift']){echo "Regalo :: Sí";} else {echo "Regalo :: No";}
		echo "<br /><br />Cantidad :: " . $this->data['OrderItem']['quantity'] . "<br /><br />";
		echo "Precio&nbsp;&nbsp;&nbsp;&nbsp;:: " . $this->data['OrderItem']['price_item'] . "<br /><br />";
		echo "Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:: " . $this->data['OrderItem']['price_total'] . "<br /><br />";
		echo "Nombre&nbsp;&nbsp;:: " . $this->data['OrderItem']['nombre'] . "<br /><br />";
		echo "Apellido&nbsp;&nbsp;:: " . $this->data['OrderItem']['apellido'] . "<br /><br />";
		echo "País&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:: " . $this->data['OrderItem']['pais'] . "<br /><br />";
		echo "Estado&nbsp;&nbsp;&nbsp;:: " . $this->data['OrderItem']['estado'] . "<br /><br />";
		echo "Ciudad&nbsp;&nbsp;&nbsp;:: " . $this->data['OrderItem']['ciudad'] . "<br /><br />";
		echo "Dirección :: " . $this->data['OrderItem']['direccion'] . "<br /><br />";
		echo "Dirección :: " . $this->data['OrderItem']['telefono'] . "<br /><br />";
	?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit', true));?>
</div>

