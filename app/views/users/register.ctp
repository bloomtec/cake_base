<?php echo $this->Html->css("wizard.css");?>
<div id="drawer">[Existen errores en tus datos. Por favor verificalos]</div>
<div class="register form">
<?php echo $this -> Form -> create('User', array('controller' => 'users', 'action' => 'register')); ?>

	<div id="wizard">

		<!-- status bar -->
		<ul id="status">
			<li class="active">CREAR CUENTA</li>
			<li>FOTO</li>
			<li> FANZONE</li>
		</ul>

		<!-- scrollable items -->
		<div class="items">

			<!-- pages -->
			<div class="page">
				<!--<h1>Datos Básicos</h1>-->
				<div class="input required" style="margin-top:10px;">
					<label for="email">CORREO ELECTRÓNICO</label>
					<input type="email" id="email" name="data[User][email]" />
				</div>
				<div class="float required">
					<?php echo $this->Form->input('UserField.nombres',array("label"=>"NOMBRES","id"=>"nombres"));?>
					<?php echo $this->Form->input('UserField.apellidos',array("label"=>"APELLIDOS","div"=>"input last"));?>
					<div style="clear:both"></div>
				</div>
				<div class="float required">
					<?php echo $this->Form->input('password',array("label"=>"CONTRASEÑA"));?>
					<?php echo $this->Form->input('password2',array("label"=>"VERIFICAR CONTRASEÑA","type"=>"password","div"=>"input last"));?>
					<div style="clear:both"></div>
				</div>
				<div class="fecha">
					<?php echo $this->Form->input('birthday', array('type' => 'date',"label"=>"FECHA DE NACIMIENTO")); ?>
					<div style="clear:both"></div>
				</div>
				
				<div class="genero">
					<label>GENERO</label>
					<?php echo $form->input("UserField.gender",array("value"=>"m","id"=>"gender"));?>
					<div class="male check checked" rel="gender"  value="m">
						Masculino
					</div>
					<br />
					<div class="female check no-checked" rel="gender" value="f">
						Femenino
					</div>
				</div>
				<div class="pie-preferido">
					<label>PIE PREFERIDO</label>
					<?php echo $form->input("UserField.foot_id",array("value"=>"2","id"=>"foot"));?>
					<div class="derecho check checked" value="2" rel="foot">
						Derecho
					</div>
					<br />
					<div class="izquierdo check no-checked" value="1" rel="foot">
						Izquierdo
					</div>
				</div>
				<div style="clear:both"> </div>
				<div class="posicion">
					<label>Posición</label>
					<?php echo $form->hidden("UserField.position_id",array("value"=>"2","id"=>"position"));?>
					<div class="posicion-col">
						<?php echo $html->image("uploads/arquero.png",array("height"=>80)) ?>
						<div class="derecho check checked" value="1" rel="position">
							Arquero
						</div>
						<br />
						<?php echo $html->image("uploads/defensa.png",array("height"=>80)) ?>
						<div class="izquierdo check no-checked" value="2" rel="position">
							Defensa
						</div>
					</div>
					<div class="posicion-col">
						<?php echo $html->image("uploads/volante.png",array("height"=>80)) ?>
						<div class="derecho check no-checked" value="3" rel="position">
							Volante
						</div>
						<br />
						<?php echo $html->image("uploads/delantero.png",array("height"=>80)) ?>
						<div class="izquierdo check no-checked" value="4" rel="position">
							Delantero
						</div>
					</div>
					
				</div>
				
			<div style="clear:both"></div>
				<button type="button" class="next right">Continuar »</button>
			</div>
			<div class="page">
				[ Any HTML content ]
				<button type="button" class="next right">Continuar »</button>
			</div>
			<div class="page">
				[ Any HTML content ]
				<input type="submit" value="Registrarme!!" />				
			</div>

		</div>

	</div>


</form>
</div>
<script type="text/javascript">
	$(function(){
		var root = $("#wizard").scrollable();
		// some variables that we need
var api = root.scrollable(), drawer = $("#drawer");

// validation logic is done inside the onBeforeSeek callback
api.onBeforeSeek(function(event, i) {

	// we are going 1 step backwards so no need for validation
	if (api.getIndex() < i) {

		// 1. get current page
		var page = root.find(".page").eq(api.getIndex()),

			 // 2. .. and all required fields inside the page
			 inputs = page.find(".required :input").removeClass("error"),

			 // 3. .. which are empty
			 empty = inputs.filter(function() {
				return $(this).val().replace(/\s*/g, '') == '';
			 });

		 // if there are empty fields, then
		if (empty.length) {

			// slide down the drawer
			drawer.slideDown(function()  {

				// colored flash effect
				drawer.css("backgroundColor", "#229");
				setTimeout(function() { drawer.css("backgroundColor", "#000"); }, 1000);
			});

			// add a CSS class name "error" for empty & required fields
			empty.addClass("error");

			// cancel seeking of the scrollable by returning false
			return false;

		// everything is good
		} else {

			// hide the drawer
			drawer.slideUp();
		}

	}

	// update status bar
	$("#status li").removeClass("active").eq(i).addClass("active");
});
root.find("button.next").keydown(function(e) {
	if (e.keyCode == 9) {

		// seeks to next tab by executing our validation routine
		api.next();
		e.preventDefault();
	}
});
	});
</script>