<div class="teams data">
	<?php echo $html->image("uploads/100x100".$team["Team"]["image"]);?>
	<p>
		<?php echo $team["Team"]["name"];?>
	</p>
</div>
<div class="container-paginado" rel="/teams/playroll/<?=$team["Team"]["id"]?>">
	<!-- AQUI SE CARGA LA VISTA DEL PAGINADO CON AJAX DEBE EXISTIR la vista teams/payroll-->
</div>
<div class="container-paginado" rel="/users/listFriends/<?=$this->Session->read('Auth.User.id')?>">
	<!-- AQUI SE CARGA LA VISTA DEL PAGINADO CON AJAX DEBE EXISTIR la vista teams/payroll-->
</div>