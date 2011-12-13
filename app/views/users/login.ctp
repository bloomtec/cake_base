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
				<label for='email'>E-mail:</label>
				<input type="email" class="input" id='email' name='data[User][email]' required="required" />
			</div>
			<div class="input text">
				<label for='password'>Password:</label>
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
					<label for="UserEmail"><?php echo __('Email', true); ?></label>
					<input id='UserEmail' type='email' name='data[User][email]' required = 'required' value="" />
					<span class="field_required">*</span>
				</div>
				<div class="input text">
					<label for="UserConfirmEmail"><?php echo __('Confirm Email', true); ?></label>
					<input id='UserConfirmEmail' type='email' name='data[User][confirm_email]' data-equals='data[User][email]' required = 'required' value="" />
					<span class="field_required">*</span>
				</div>
				<?php
					echo $this -> Form -> input('name', array('label'=>__('Name', true), 'required'=>'required'));
					echo $this -> Form -> input('last_name', array('label'=>__('Last Name', true), 'required'=>'required'));
					echo $this -> Form -> input('password', array('label'=>__('Password', true), 'required' => 'required', 'value'=>''));
					echo $this -> Form -> input('confirm_password', array('label'=>__('Confirm Password', true), 'type' => 'password',  'required' => 'required', 'value'=>'', 'data-equals'=>'data[User][password]'));
					echo $this -> Form -> input('phone', array('label'=>__('Phone', true), 'required' => 'required' , 'title' => __('This field is to be able to contact you once you make a purchase. It will not be used otherwise.',true) ));
					echo $this -> Form -> input('country_id', array('label'=>__('Country', true)));
					echo $this -> Form -> input('city_id', array('label'=>__('City', true)));
				?>
		</fieldset>
		<div class="btn_wrraper">
			<?php echo $this -> Form -> end(__('Register', true));?>
		</div>
		
	</div>
	<div style="clear: both"></div>
</div>
