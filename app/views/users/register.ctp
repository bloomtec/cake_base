<?php 
	echo $this->Html->css("wizard.css",true);
	echo $this->Html->css('uploadify',true);
	echo $this->Html->Script("swfobject");
	echo $this->Html->Script("jquery.uploadify.v2.1.4.min");
	echo $this->Html->Script("upload");	
?>
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
					<?php echo $this->Form->input('UserField.birthday', array('type' => 'date',"label"=>"FECHA DE NACIMIENTO","minYear"=>"1950","maxYear"=>"2025")); ?>
					<div style="clear:both"></div>
				</div>
				
				<div class="genero single">
					<label>GENERO</label>
					<?php echo $form->hidden("UserField.gender",array("value"=>"m","id"=>"gender"));?>
					<div class="male check checked" rel="gender"  value="Masculino">
						Masculino
					</div>
					<br />
					<div class="female check no-checked" rel="gender" value="Femenino">
						Femenino
					</div>
				</div>
				<div class="pie-preferido single">
					<label>PIE PREFERIDO</label>
					<?php echo $form->hidden("UserField.foot_id",array("value"=>"2","id"=>"foot"));?>
					<div class="derecho check checked" value="2" rel="foot">
						Derecho
					</div>
					<br />
					<div class="izquierdo check no-checked" value="1" rel="foot">
						Izquierdo
					</div>
					<br />
					<div class="izquierdo check no-checked" value="2" rel="foot">
						Ambos
					</div>
				</div>
				<div style="clear:both"> </div>
				<div class="posicion multiple">
					<label>Posición</label>
					<?php echo $form->hidden("UserField.position_id",array("value"=>"1","id"=>"position"));?>
					
						<?php echo $html->image("arquero.png",array("width"=>50)) ?>
						<div class="left check no-checked" rel="1">
							Arquero
						</div>
					
						<?php echo $html->image("volante.png",array("width"=>50)) ?>
						<div class="check no-checked" rel="3">
							Volante
						</div>
						<br />
						<?php echo $html->image("defensa.png",array("width"=>50)) ?>
						<div class="left check no-checked" rel="2">
							Defensa
						</div>
						<?php echo $html->image("delantero.png",array("width"=>50)) ?>
						<div class=" check no-checked" rel="4">
							Delantero
						</div>
				
					
				</div>
				
			<div style="clear:both"></div>
				<button type="button" class="next right">Continuar »</button>
			</div>
			<div class="page">
				<?php echo $form->hidden("UserField.image",array("id"=>"single-field","value"=>"defaul-image-profile.jpg"))?>
				<div class="preview">
					<?php echo $html->image("uploads/100x100/defaul-image-profile.jpg");?>
				</div>
				<div id="single-upload">
				</div>
				<button type="button" class="prev" style="float:left">« Volver</button>
				<button type="button" class="next right">Continuar »</button>
			</div>			
			<div class="page preferencias">
				<h1> CLUBES</h1>
				<div class="float">
					<?php 
					$ligas=$this->requestAction("/leagues/getList");
					echo $form->input("League.0",array("label"=>"LIGA","class"=>"liga","options"=>$ligas,"empty"=>"Seleccione"))?>
					<?php echo $form->input("Club.0",array("label"=>"CLUB","class"=>"club","div"=>"last input","empty"=>"Seleccione","type"=>"select"));?>
				</div>
				<div class="float">
					<?php echo $form->input("League.1",array("label"=>"LIGA","class"=>"liga","options"=>$ligas,"empty"=>"Seleccione"))?>
					<?php echo $form->input("Club.1",array("label"=>"CLUB","class"=>"club","div"=>"last input","empty"=>"Seleccione","type"=>"select"));?>
				</div>
				<div class="float">
					<?php 
				echo $form->input("League.2",array("label"=>"LIGA","class"=>"liga","options"=>$ligas,"empty"=>"Seleccione"))?>
					<?php echo $form->input("Club.2",array("label"=>"CLUB","class"=>"club","div"=>"last input","empty"=>"Seleccione","type"=>"select"));?>
				</div>
				<div style="clear:both;"></div>
				<br />
				<h1>SELECCIONES</h1>
				<?php $selecciones=$this->requestAction("/countrySquads/getList");?>
				<?php 
				echo $form->input("CountrySquad.0",array("options"=>$selecciones,"label"=>false,"empty"=>"Seleccione"))
				?>
				<?php 
				echo $form->input("CountrySquad.1",array("options"=>$selecciones,"label"=>false,"empty"=>"Seleccione"))
				?>
				<?php 
				echo $form->input("CountrySquad.2",array("options"=>$selecciones,"label"=>false,"empty"=>"Seleccione"))
				?>
				<div style="clear:both"></div>
				<button type="button" class="prev" style="float:left">« Volver</button>
				<button class="button submit">Registrarme!!</button>				
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