<div class="users profile">
	<div class="image">
		<?php echo $html->image("uploads/".$userField["UserField"]["image"]);?>
		<div class="nombre">
			<div><?php echo $userField["UserField"]["name"]?></div>
			<div><?php echo $userField["UserField"]["surname"]?></div>
		</div>
	</div>
	<div class="info">
		<div class="info-text">
			<div>Sexo: <?php echo $userField["UserField"]["gender"]?></div>
			<div>Pie Preferido:	<?php echo $userField['Feet']['name']?></div>
		</div>
	
			
		
		<div class="posiciones">
			Posiciones:	
			<br /><br />
			<?php foreach($userField['Position'] as $position):?>
				<div class="posicion">
					<?php echo $html->image($position["image"],array("height"=>50)); ?>
					<p><?php echo $position['positions']?></p>
				</div>
			<?php endforeach; ?>
		</div>
		<div style="clear: both;">	</div>
	</div>
	<div style="clear: both;">	</div>
	<br />
	<h2> Equipos: </h2>
	<div class="container-paginado teams" rel="/usersTeams/vewUserTeams/".$userField["UserField"]["user_id"]>
		
	</div>
</div>
