<div class="view-calling">
	<div class="info-user">
		
	</div>
	<div class="message"><?=$message?></div>
	<div class="actions">
		<span class="notificacion"> </span>
		<a class="accept" href="/friendships/acceptFriendship/<?=$user_a_id?>/<?=$user_b_id?>">
			aceptar
		</a>
		<a class="reject" href="/friendships/rejectFriendship/<?=$user_a_id?>/<?=$user_b_id?>">
			rechazar
		</a>
	</div>
</div>
