<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('email');
		//echo $this->Form->input('password');
		//echo $this->Form->input('role_id');
		//echo $this->Form->input('UserField.name',array("label"=>"Nombre"));
		//echo $this->Form->input('UserField.surname',array("label"=>"Apellidos"));
		//echo $this->Form->input('UserField.birthday',array("label"=>"Nacimiento","minYear"=>"1950"));
		//echo $this->Form->input('UserField.foot_id',array("options"=>$feets,"div"=>"float","label"=>"Pierna"));
		//echo $this->Form->input('UserField.Position',array("label"=>"Posicion","multiple"=>"checkbox"));		
		echo "<div class='float'>";
		echo $this->Form->input('Club',array("label"=>"Club","multiple"=>"checkbox"));
		echo "</div><div class='float'>";
		echo $this->Form->input('CountrySquad',array("label"=>"Selecciones","multiple"=>"checkbox"));
		echo "</div>";
	?>
	</fieldset>
	<div class="confirmacion"></div>
	<?php echo $this->Form->end(" ");?>
</div>
