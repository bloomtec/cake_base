<div class="view-challenge">
	<div class="info-team">
		
	</div>
	<div class="message"><?=$message?></div>
	<div class="actions">
		<span class="notificacion"> </span>
		<a class="accept" href="/challenges/acceptChallenge/<?=$team_challenger_id?>/<?=$team_challenged_id?>">
			aceptar
		</a>
		<a class="reject" href="/challenges/rejectChallenge/<?=$team_challenger_id?>/<?=$team_challenged_id?>">
			rechazar
		</a>
	</div>
</div>