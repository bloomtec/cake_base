<div class="team-create form">
	<?php
		echo $this->Form->create('Team', array('action' => 'add',"id"=>"create-team"));
		echo $this->Form->input('name', array('label' => '1. NOMBRE'));
		echo $this->Form->input('team_style_id', array('label' => '2. ESTILO DE JUEGO'));
		echo "3. CONVOCAR";
		/**
		 * Como se hace para seleccionar y enviar eso al controlador
		 * para manejar el proceso de convocatorio
		 */
		echo $this->Form->hidden('image');
		echo $this->Form->end();
	?>
	<div class="payroll-control">

	</div>
	<div class="container-paginado add-to-team" rel="/users/listFriends/<?=$this->Session->read('Auth.User.id')?>">
		<!-- AQUI SE CARGA LA VISTA DEL PAGINADO CON AJAX DEBE EXISTIR -->
	</div>
	<div class="team form">
		4. IMAGEN
		<?php
			/**
			 * Meter el código para subir la imágen del equipo
			 */
		?>
	</div>
	<button rel="#create-team"> CREAR EQUIPO </button>
	<div class="mensaje-error">
		
	</div>
</div>