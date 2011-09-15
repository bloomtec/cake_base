<div class="team form">
	<?php
		echo $this->Form->create('Team', array('action' => 'add'));
		echo $this->Form->input('name', array('label' => '1. NOMBRE'));
		echo $this->Form->input('team_style_id', array('label' => '2. ESTILO DE JUEGO'));
		echo "3. CONVOCAR";
		/**
		 * Como se hace para seleccionar y enviar eso al controlador
		 * para manejar el proceso de convocatorio
		 */
	?>
</div>
<div class="container-paginado" rel="/users/listFriends/<?=$this->Session->read('Auth.User.id')?>">
	<!-- AQUI SE CARGA LA VISTA DEL PAGINADO CON AJAX DEBE EXISTIR -->
</div>
<div class="team form">
	<?php
		echo "4. IMAGEN";
		/**
		 * Meter el código para subir la imágen del equipo
		 */
	?>
	<?php
		echo $this->Form->hidden('image');
		echo $this->Form->submit('CHULO PARA ENVIAR EL FORM');
	?>
</div>