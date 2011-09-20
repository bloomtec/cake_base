<div class="pane" id="teams">
	<div class="teams tab" rel="teams">
	</div>
	<div class="body">
		<div class="menu">	
			<h2 class="selected menu-team"><a href="#">Equipos</a></h2>
			<ul class="team-lists">
				<?php $teams=$this->requestAction("/teams/myTeams");?>
				<?php foreach($teams as $id=>$team):?>
					<li>
					<?php echo $html->link($team,array("controller"=>"teams","action"=>"view",$id),array("class"=>"load"));?>
						
					<?php echo $html->link("X",array("controller"=>"teams","action"=>"ajax_delete",$id),array("class"=>"delete","rel"=> $id));?>
				</li>
				<?php endforeach; ?>
			</ul>
			<br />
			<h2 class="selected"><?php echo $html->link("Crear", array("controller"=>"teams", "action"=>"viewCreate"),array("class"=>"load"));?></h2>
			<br />
			<h2 class="selected"><?php echo $html->link("Buscar", array("controller"=>"teams", "action"=>"search"),array("class"=>"load"));?></h2>
		</div>
		
		<div class="content">
							
		</div>
		<div style="clear:both;"></div>
	</div>
</div>
