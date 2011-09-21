<div class="pane" id="challenges">
	<div class="challenges tab" rel="challenges">
	
	</div>
	<div class="body">
		<div class="content" style="width:90%;">
			<h2>RETOS</h2>
			<div class="switches">
				<div class="show-friends selected">
					Armar Partido
				</div>
				<div class="show-teams">
					Retar Equipo
				</div>
				<div style="clear:both;"></div>
			</div>
			<div class="friend-panel">
				<?php 
					echo $form->create("Match",array("action"=>"add","id"=>"create-match"));
					
					echo $form->end();
				 ?>
				<div class="match-player">
					
				</div>
				<div class="container-paginado add-to-match friends" rel="/users/listFriends/criteria:">
				
				</div>
				<button id="armar-equipo">ARMAR EQUIPO</button>	
				<div class="match-confirmation">
					
				</div>			
			</div>

			<div class="container-search equipos equipos-panel" rel="/teams/ajaxSearch/criteria:" id="otros-equipos">
				
			</div>
						
		</div>
		<div style="clear:both;"></div>
	</div>
</div>