<style>
	.ui-autocomplete-loading { background: white url('/img/ui-anim_basic_16x16.gif') right center no-repeat; }
</style>
<div class="login_izq tahoma">
	<h1 class="titulos_rosado">LOGIN</h1>
	<?php e($this->Form->create('User', array('controller'=>'users', 'action'=>'login'))); ?>
		<label>TU CORREO ELECTRÓNICO</label>
		<input id="UserEmail" name="data[User][email]" type="email" required="required" />
		<label>CONTRASEÑA</label>
		<input id="UserPassword" name="data[User][password]" type="password" required="required" />
		<div style="clear: both"></div>
		<a class="azul remember" href="/users/rememberPassword">¿Olvidaste tu contraseña?</a>
		<div style="clear: both"></div>
		
		<input type="checkbox" />	
		<label class="olvidaste"> Recordar esta información </label>	
		<input type="submit" class='twCenMt' value="Entrar" />
		<div style="clear: both"></div>
	</form>
	<?php e($this->Form->create('User', array('controller'=>'users', 'action'=>'rememberPassword','id'=>'rememberForm'))); ?>
		
		<label>CORREO ELECTRÓNICO REGISTRADO</label>
		<input id="UserEmail" name="data[User][email]" type="email" required="required" />
		<div style="clear: both"></div>
		<a class="azul ingresar" href="#">Ingresar</a>
		<input type="submit" class='twCenMt' value="Solicitar" />
		<div style="clear: both"></div>
		<div class='confirmacion-remember'>
			Se ha enviado un nuevo password a tu correo electronico
		</div>
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
		<?php echo $this->Form->input('UserField.sex',array('options'=>array('Hombre','Mujer'),'div'=>false,'label'=>false));?>
		<br /><br />
		<label>FECHA DE NACIMIENTO</label>
		<?php echo $this->Form->input('UserField.birthday',array('div'=>false,'label'=>false));?>
		<br /><br />
	
		<input type="hidden" id='country' name='data[UserField][country]'/>
		<input type="hidden" id='state' name='data[UserField][state]'/>
		<input type="hidden" id='city'name='data[UserField][city]' />
		<label>CIUDAD</label>
		<input type='text' id='resultGeo' placeholder="ciudad/departamento/pais" >
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
	
		$(function() {
		function log( city, state, country) {
			$('#city').val(city);
			$('#state').val(state);
			$('#country').val(country);
			//$('#resultGeo').val(city+', '+state+', '+country);
		}

		$( "#resultGeo" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "http://ws.geonames.org/searchJSON",
					dataType: "jsonp",
					data: {
						featureClass: "P",
						style: "full",
						maxRows: 12,
						name_startsWith: request.term
					},
					success: function( data ) {
						response( $.map( data.geonames, function( item ) {
							return {
								label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
								city: item.name,
								country: item.countryName,
								state:  item.adminName1 ? item.adminName1 : "", 
								value: item.name+', '+item.adminName1+', '+item.countryName
							}
						}));
					}
				});
			},
			minLength: 2,
			select: function( event, ui ) {
				log( ui.item.city ? ui.item.city: this.value, ui.item.city ? ui.item.state: '', ui.item.country ? ui.item.country:'');
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
	});
</script>