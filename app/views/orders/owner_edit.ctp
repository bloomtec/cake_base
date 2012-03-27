<div class="order form">
	<?php echo $this -> Form -> create('Order'); ?>
	<fieldset>
		<legend>
			<?php echo __('Editar Orden'); ?>
		</legend>
		<?php
			echo $this -> Form -> hidden('User.id', array('value' => $this -> data['User']['id']));
			echo $this -> Form -> input('id');
			echo $this -> Form -> input('Deal.name', array('label' => __('Promoción', true), 'disabled' => 'disabled'));
			echo $this -> Form -> input('code', array('label' => __('Código', true), 'disabled' => 'disabled'));
			echo $this -> Form -> input('User.name', array('label' => __('Nombre', true), 'disabled' => 'disabled'));
			echo $this -> Form -> input('User.last_name', array('label' => __('Apellido', true), 'disabled' => 'disabled'));
			echo $this -> Form -> input('quantity', array('label' => __('Cantidad', true), 'disabled' => 'disabled'));
			echo $this -> Form -> input('Address.address', array('label' => __('Dirección', true), 'disabled' => 'disabled'));
			if($this -> data['Order']['order_state_id'] == 1) {
				echo $this -> Form -> input('order_state_id', array('label' => __('Estado', true)));
			} else {
				echo $this -> Form -> input('order_state_id', array('label' => __('Estado', true), 'disabled' => true));
			}
		?>
	</fieldset>
	<?php echo $this -> Form -> submit(__('Submit', true)); ?>
</div>