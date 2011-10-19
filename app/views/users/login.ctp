<div class="login_izq tahoma">
	<h1 class="titulos_rosado">LOGIN</h1>
	<?php e($this->Form->create('User', array('controller'=>'users', 'action'=>'login'))); ?>
		<label>TU CORREO ELECTRÓNICO</label>
		<input id="UserEmail" name="data[User][email]" type="email" required="required" />
		<label>CONTRASEÑA</label>
		<input id="UserPassword" name="data[User][password]" type="password" required="required" />
		<div style="clear: both"></div>
		<a class="azul">¿Olvidaste tu contraseña?</a>
		<div style="clear: both"></div>
		<input type="checkbox" />	
		<label class="olvidaste"> Recordar esta información </label>	
		<input type="submit" class='twCenMt' value="Entrar" />
		<div style="clear: both"></div>
	</form>
</div>
<div class="login_izq tahoma">
	<h1 class="titulos_rosado">REGÍSTRATE</h1>
	<?php e($this->Form->create('User', array('controller'=>'users', 'action'=>'register'))); ?>
		<label>NOMBRE *</label>
		<input id="UserFieldName" name="data[UserField][name]" type="text" required="required" />
		<label>APELLIDOS *</label>
		<input id="" name="data[UserField][surname]" type="text" required="required" />
		<label>TU CORREO ELECTRÓNICO *</label>
		<input id="UserEmail" name="data[User][email]" type="email" required="required" />
		<label>CONTRASEÑA *</label>
		<input id="UserPassword" name="data[User][password]" type="password" required="required" />
		<label>SEXO *</label>
		<?php echo $this->Form->input('UserField.sex',array('options'=>array('Hombre'=>'Hombre','Mujer'=>'Mujer'),'div'=>false,'label'=>false));?>
		<br /><br />
		<label>FECHA DE NACIMIENTO</label>
		<?php echo $this->Form->input('UserField.birthday',array('div'=>false,'label'=>false));?>
		<br /><br />
		<label>DEPARTAMENTO</label>
		<input type="text"/>
		<label>CIUDAD</label>
		<input type="text"/>
		<input type="checkbox" />	
		<label class="olvidaste">  Autorizo a Colors Tennis  que me envíe información por correo electrónico </label>	
		<input type="submit" class='twCenMt' value="Registrate" />
		<div style="clear: both"></div>
	</form>
</div>
<script>
$('#UserRegisterForm').validator({lang:'es'}).submit(function(e){
	var form=$(this);
	var fields=$(this).serialize();
	if(!e.isDefaultPrevented()){
		jQuery.ajax({
			url : '/users/ajaxRegister',
			type : "POST",
			cache : false,
			dataType : "json",
			data : fields,
			success : function(validate){
				if(validate===1){
					window.location.reload();
				}else{
					form.data("validator").invalidate(validate);
				}
			}
		});	
		e.preventDefault();
	}
});
$('#UserLoginForm').validator({lang:'es'}).submit(function(e){
	var form=$(this);
	var fields=$(this).serialize();
	if(!e.isDefaultPrevented()){
		jQuery.ajax({
			url : '/users/ajaxLogin',
			type : "POST",
			cache : false,
			dataType : "json",
			data : fields,
			success : function(validate){
				if(validate===1){
					window.location.reload();
				}else{
					form.data("validator").invalidate(validate);
				}
			}
		});	
		e.preventDefault();
	}
});
	Cufon.replace('.tahoma', {
		fontFamily : 'Tahoma',
		trim : "simple",
		hoverables:{a:true},
		hover:{color:'#ffaedc'}

	});
	Cufon.replace('.twCenMt', {
		fontFamily : 'TwCenMt',
		trim : "simple",
		hoverables:{a:true},
		hover:{color:'#00CFB5'}
	});
	
</script>