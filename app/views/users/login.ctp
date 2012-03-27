<div id="register_login">
	<div class="register form">
		<?php
		echo $this -> Form -> create('User', array('action' => 'login'));
		?>
		<fieldset class="centrar">
			<legend>
				<?php __('Ingresar');?>
			</legend>
			<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posu
			</p>
			<div class="input text">
				<label for='email'><?php __('Correo:'); ?></label>
				<input type="email" class="input" id='email' name='data[User][email]' required="required" />
			</div>
			<div class="input text">
				<label for='password'><?php __('Contraseña:'); ?></label>
				<input type="password" id='password' class="input" name='data[User][password]' required="required" />
			</div>
			
		</fieldset>
		<div class="btn_wrraper">			
			<?php
			echo $this -> Form -> end(__('Ingresar', true));
			?>
		</div>
		<?php
			echo $this -> Session -> flash('auth');
			?>
	</div>
	<div class="login form">
		<?php //echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'register'));?>
		<?php echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'ajaxRegister', 'novalidate'=>'novalidate'));?>
		<fieldset class="centrar">
			<legend>
				<?php __('¿Aún no eres usuario?');?>
			</legend>
			<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posu
			</p>
				<div class="input text">
					<label for="UserEmail"><?php __('Correo:'); ?></label>
					<input id='UserEmail' type='email' name='data[User][email]' required = 'required' value="" />
					<span class="field_required">*</span>
				</div>
				<div class="input text">
					<label for="UserConfirmEmail"><?php __('Confirmar Correo:'); ?></label>
					<input id='UserConfirmEmail' type='email' name='data[User][confirm_email]' data-equals='data[User][email]' required = 'required' value="" />
					<span class="field_required">*</span>
				</div>
				<?php
					echo $this -> Form -> input('name', array('label'=>__('Nombre', true), 'required'=>'required'));
					echo $this -> Form -> input('last_name', array('label'=>__('Apellido', true), 'required'=>'required'));
					echo $this -> Form -> input('password', array('label'=>__('Contraseña', true), 'required' => 'required', 'value'=>''));
					echo $this -> Form -> input('confirm_password', array('label'=>__('Confirmar Contraseña', true), 'type' => 'password',  'required' => 'required', 'value'=>'', 'data-equals'=>'data[User][password]'));
					echo $this -> Form -> input('phone', array('label'=>__('Teléfono', true), 'required' => 'required' , 'title' => __('Este campo es para poder contactarte cuando hagas una compra. En caso contrario no será utilizado',true) ));
					echo $this -> Form -> input('country_id', array('label'=>__('País', true)));
					echo $this -> Form -> input('city_id', array('label'=>__('Ciudad', true)));
				?>
		</fieldset>
		<div class="btn_wrraper">
			<?php echo $this -> Form -> end(__('Register', true));?>
		</div>
		
	</div>
	<div style="clear: both"></div>
</div>
