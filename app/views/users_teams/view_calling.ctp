<div class="view-calling">
	<div class="info-team">
		<?php echo $html->image("uploads/100x100/".$team["Team"]["image"]);?>
		<p>
			<?=$team["Team"]["name"];?>
		</p>
	</div>
	<br />
	<h2>Nomina</h2>
	<div class="container-paginado no-actions" rel="/teams/payroll/<?=$team["Team"]["id"]?>/limit:6">
			<!-- AQUI SE CARGA LA VISTA DEL PAGINADO CON AJAX DEBE EXISTIR la vista teams/payroll-->
	</div>
	<div class="actions">
		<span class="notificacion"> </span>
		<a class="accept" href="/usersTeams/acceptCallToTeam/<?=$user_id?>/<?=$team["Team"]["id"]?>">
			
		</a>
		<a class="reject" href="/usersTeams/rejectCallToTeam/<?=$user_id?>/<?=$team["Team"]["id"]?>">
			
		</a>
	</div>
</div>
