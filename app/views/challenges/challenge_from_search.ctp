<div class="challenge">
	<?php echo $form->Create("Challenge",array("action"=>"createChallenge"));?>
	<?php echo $form->input("title",array("label"=>"Título")); ?>
	<?php echo $form->hidden("team_challenged_id",array("value"=>$challengedId)) ?>
	<?php echo $form->input("team_challenger_id",array("options"=>$myTeams,"label"=>"Mi equipo")); ?>
	<?php echo $form->input("place",array("label"=>"lugar")); ?>
	<?php echo $form->input("bet",array("label"=>"apuesta")); ?>
	<?php echo $form->input("date",array("label"=>"Fecha y hora")); ?>
	
	<?php echo $form->input("message",array("label"=>"comentarios")); ?>
	<?php echo $form->end(" "); ?>
	
	<div class="respuesta">
		
	</div>
</div>