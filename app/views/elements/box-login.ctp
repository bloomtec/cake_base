<h1>Área de clientes</h1>
<?php e($form->create('User',array('action'=>'login')))
?>
<label for='email'>E-mail:</label>
<input type="email" class="input" id='email' name='data[User][email]' required="required" />
<label for='password'>Password:</label>
<input type="password" id='password' class="input" name='data[User][password]' required="required" />
<h3><a href="/users/recordarPassword">¿Olvido su contraseña?</a></h3>
<input type="submit" class="submit" value="Ingresar" />
<a class="submit primero" href='/users/register'> Registrese </a>
</form>