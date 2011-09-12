<div class="pane" id="teams">
	<div class="teams tab" rel="teams">
	</div>
	<div class="body">
		<div class="menu">	
			<h2 class="selected">Equipos</h2>
			<ul class="team-lists">
				<?php $teams=$this->requestAction("/teams/requestFind/all/null/Bl00MWebGr0up");?>
				<?php foreach($teams as $team):?>
					<li>
					<?php echo $html->link($team["Team"]["name"],array("controller"=>"usersTeams","action"=>"getPayroll",$team["Team"]["id"]),array("class"=>"load"));?>
						
					<?php echo $html->link("X",array("controller"=>"teams","action"=>"ajax_delete",$team["Team"]["id"]),array("class"=>"delete","rel"=> $team["Team"]["id"]));?>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="separator"></div>
		<div class="content">
							
		</div>
		<div style="clear:both;"></div>
	</div>
</div>