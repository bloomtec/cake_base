<div class="users form">
	<div class="basic-data">
		<?php echo $this -> Form -> create('User');?>
		<fieldset>
			<legend>
				<?php __('Editar Información');?>
			</legend>
			<?php
				echo $this -> Form -> input('id');
				echo $this -> Form -> input('name', array('label'=>'Nombre'));
				echo $this -> Form -> input('last_name', array('label'=>'Apellido'));
				//echo $this -> Form -> input('phone');
			?>
		</fieldset>
		<?php echo $this -> Form -> end(__('Submit', true));?>
	</div>
	<div class="registered-addresses">
		<?php
			if(empty($this->data['Address'])) {
				echo '<br />';
			} else {
				echo '<h2>Direcciones Registradas</h2>';
				foreach($this->data['Address'] as $address):
		?>
		<table class="address-info">
			<tr>
				<td><label>País</label></td>
				<td><?=$address['country'];?></td>
			</tr>
			<tr>
				<td><label>Departamento</label></td>
				<td><?=$address['state'];?></td>
			</tr>
			<tr>
				<td><label>Ciudad</label></td>
				<td><?=$address['city'];?></td>
			</tr>
			<tr>
				<td><label>Dirección Linea 1</label></td>
				<td><?=$address['address_line_1'];?></td>
			</tr>
			<tr>
				<td><label>Dirección Linea 2</label></td>
				<td><?=$address['address_line_2'];?></td>
			</tr>
			<tr>
				<td><label>Teléfono</label></td>
				<td><?=$address['phone'];?></td>
			</tr>
			<tr>
				<td><a href="/addresses/edit/<?=$address['id'];?>">Editar</a></td>
				<td><a href="/addresses/delete/<?=$address['id'];?>">Eliminar</a></td>
			</tr>
		</table>
			<?php
				endforeach;
			}
		?>
	</div>
	<div>
		<h2><?php __('Registrar una nueva dirección'); ?></h2>
		<?php echo $this -> Form -> create('Address', array('action' => 'add'));?>
		<fieldset>
			<?php
				echo $this -> Form -> hidden('Address.user_id', array('value' => $this -> Session -> read('Auth.User.id')));
				echo $this -> Form -> input('Address.country', array('required' => 'required'));
				echo $this -> Form -> input('Address.state', array('required' => 'required'));
				echo $this -> Form -> input('Address.city', array('required' => 'required'));
				echo $this -> Form -> input('Address.address_line_1', array('required' => 'required'));
				echo $this -> Form -> input('Address.address_line_2');
				echo $this -> Form -> input('Address.phone', array('required' => 'required'));
			?>
		</fieldset>
		<?php echo $this -> Form -> end(__('Submit', true));?>
	</div>
</div>