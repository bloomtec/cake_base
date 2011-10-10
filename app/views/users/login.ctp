<div class="login_izq tahoma">
	<h1 class="titulos_rosado">LOGIN</h1>
	<?php e($this->Form->create('User', array('controller'=>'users', 'action'=>'login'))); ?>
		<label>TU CORREO ELECTRÓNICO</label>
		<input id="UserEmail" name="data[User][email]" type="text" />
		<label>CONTRASEÑA</label>
		<input id="UserPassword" name="data[User][password]" type="text" />
		<div style="clear: both"></div>
		<a class="azul">¿Olvidaste tu contraseña?</a>
		<div style="clear: both"></div>
		<input type="checkbox" />	
		<label class="olvidaste"> Recordar esta información </label>	
		<input type="submit" value="Entrar" />
		<div style="clear: both"></div>
	</form>
</div>
<div class="login_izq">
	<h1 class="titulos_rosado">REGÍSTRATE</h1>
	<?php e($this->Form->create('User', array('controller'=>'users', 'action'=>'register'))); ?>
		<label>NOMBRE *</label>
		<input id="UserFieldName" name="data[UserField][name]" type="text" />
		<label>APELLIDOS *</label>
		<input id="" name="data[UserField][surname]" type="text" />
		<label>TU CORREO ELECTRÓNICO *</label>
		<input id="UserEmail" name="data[User][email]" type="text" />
		<label>CONTRASEÑA *</label>
		<input id="UserPassword" name="data[User][password]" type="text" />
		<label>SEXO *</label>
		<input class="sexo" type="text" />
		<label>FECHA DE NACIMIENTO</label>
		<input type="text" class="fecha"/>
		<input type="text" class="fecha"/>
		<input type="text" class="fecha"/>
		<label>DEPARTAMENTO</label>
		<input type="text"/>
		<label>CIUDAD</label>
		<input type="text"/>
		<input type="checkbox" />	
		<label class="olvidaste">  Autorizo a Colors Tennis  que me envíe información por correo electrónico </label>	
		<input type="submit" value="Registrate" />
		<div style="clear: both"></div>
	</form>
</div>