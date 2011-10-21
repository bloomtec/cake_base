<div class="users form tahoma">
<?php echo $this->Form->create('User');?>

<h1 class="orden twCenMt">Mis datos</h1>

	<fieldset>
		
	<?php
		echo $this->Form->input('id');
		echo $this->Form->hidden('email');
		echo $this->Form->hidden('pass',array('type'=>'password','label'=>'Password'));
		echo $this->Form->hidden('role_id',array('value'=>2));
		echo $this->Form->input('UserField.id');
		echo $this->Form->input('UserField.name',array('label'=>'Nombres'));
		echo $this->Form->input('UserField.surname',array('label'=>'Apellidos'));
		echo $this->Form->input('UserField.sex',array('label'=>'Sexo','options'=>array('Hombre','Mujer')));
		echo $this->Form->input('UserField.country',array('label'=>'Pais'));
		echo $this->Form->input('UserField.state',array('label'=>'Estado'));
		echo $this->Form->input('UserField.city',array('label'=>'Ciudad'));
		echo $this->Form->input('UserField.address',array('label'=>'Dirección'));
		echo $this->Form->input('UserField.birthday',array('label'=>'Fecha de Nacimiento'));
		echo $this->Form->input('UserField.phone',array('label'=>'Telefono'));
		echo $this->Form->input('UserField.mobile',array('label'=>'Celular'));
		
	?>
	<div style="clear: both"></div>
	</fieldset>
	<input type="submit" class="input_verde" value="Guardar" />
	<a href='/users/profile' class="azul volver_profile"> Volver </a>
	
	
<?php echo $this->Form->end();?>
</div>