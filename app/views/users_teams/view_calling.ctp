<div class="view-calling">
	<div class="info-team">
		
	</div>
	<div class="container-paginado no-actions" rel="/teams/payroll/<?=$team["Team"]["id"]?>">
			<!-- AQUI SE CARGA LA VISTA DEL PAGINADO CON AJAX DEBE EXISTIR la vista teams/payroll-->
	</div>
	<div class="actions">
		<span class="notificacion"> </span>
		<a class="accept" href="/usersTeams/acceptCallToTeam/<?=$user_id?>/<?=$team["Team"]["id"]?>">
			aceptar
		</a>
		<a class="reject" href="/usersTeams/rejectCallToTeam/<?=$user_id?>/<?=$team["Team"]["id"]?>">
			rechazar
		</a>
	</div>
</div>
