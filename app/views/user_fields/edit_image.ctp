<div class="userFields form">
	<div class="preview">
			<?php echo $html->image($this->data["UserField"]["image"]); ?>
	</div>
<?php echo $this->Form->create('UserField');?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('email');
		//echo $this->Form->input('password');
		//echo $this->Form->input('role_id');
		//echo $this->Form->input('name',array("label"=>"Nombre"));
		//echo $this->Form->input('surname',array("label"=>"Apellidos"));
		//echo $this->Form->input('birthday',array("label"=>"Nacimiento","minYear"=>"1950"));
		//echo $this->Form->input('foot_id',array("options"=>$feets,"div"=>"float","label"=>"Pierna"));
		//echo $this->Form->input('Position',array("label"=>"Posicion","multiple"=>"checkbox"));		
		echo $this->Form->input("image",array("id"=>"single-field"));
		//echo $this->Form->input('Club');
		//echo $this->Form->input('CountrySquad');
		
	?>
	</fieldset>
	<div class="respuesta"></div>
	<?php echo $this->Form->end(" ");?>
</div>

