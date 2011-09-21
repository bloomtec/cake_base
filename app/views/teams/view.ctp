<div class="teams data">
	<?php echo $html->image("uploads/100x100".$team["Team"]["image"]);?>
	<p>
		<h2><?php echo $team["Team"]["name"];?></h2>
	</p>
</div>
<h2>Nomina</h2>
<div class="container-paginado no-actions" rel="/teams/payroll/<?=$team["Team"]["id"]?>">
	<!-- AQUI SE CARGA LA VISTA DEL PAGINADO CON AJAX DEBE EXISTIR la vista teams/payroll-->
</div>

<h2>Convocar</h2>
<div class="container-paginado convocar" team="<?=$team['Team']['id']; ?>" rel="/users/listNotTeamUsers/team_id:<?=$team['Team']['id']; ?>">
	<!-- AQUI SE CARGA LA VISTA DEL PAGINADO CON AJAX DEBE EXISTIR la vista teams/payroll-->
</div>