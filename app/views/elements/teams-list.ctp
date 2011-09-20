<ul class="equipos listado search-results">
	<!-- NO MODIFICAR-->
	<?php foreach($teams as $team):
	?>
	<li class="team">
		<div class="actions">
			<?php echo $html->link($html->image("boton-add.png"),array("controller"=>"teams","action"=>"request"),array("escape"=>false,"title"=>"Añadir","class"=>"add"))
			?>
			<?php echo $html->link("retar",array("controller"=>"challenges","action"=>"challengeFromSearch",$team["Team"]["id"]),array("escape"=>false,"title"=>"Añadir","class"=>"challenge overlay"))
			?>
		</div>
		<div class="image">
			<?php echo $html -> link($html -> image($team["Team"]["image"]), array("controller" => "team", "action" => "profile", $team["Team"]["id"]), array("escape" => false, "class" => "overlay"));?>
		</div>
		<div class="name">
			<?php echo $team["Team"]["name"];?>
		</div>
	</li>
	<?php endforeach;?>
	<div style="clear:both;"></div>
</ul>
<div class="paging paging-search">		
<?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>
	 	<?php echo $this->Paginator->numbers(array("separator"=>" "));?>
		<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>