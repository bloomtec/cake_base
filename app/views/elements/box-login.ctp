<h1><?php __('Área de clientes'); ?></h1>
<?php e($form -> create('User', array('action' => 'login'))); ?>
<label for='email'><?php __('Correo:'); ?></label>
<input type="email" class="input" id='email' name='data[User][email]' required="required" />
<label for='password'><?php __('Contraseña:'); ?></label>
<input type="password" id='password' class="input" name='data[User][password]' required="required" />
<h3><a href="/users/recordarPassword"><?php __('¿Olvido su contraseña?'); ?></a></h3>
<input type="submit" class="submit" value="Ingresar" />
<a class="submit primero" href='/users/register'> <?php __('Registrese'); ?> </a>
<?php e($form -> end()); ?>