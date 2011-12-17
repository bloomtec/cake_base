<div class="comments-list">
<?php 
if($comments){
	foreach($comments as $comment):
?>
	<div class="comentario_usuario comment" rel="<?php echo $comment['id'];?>">
		<div class="usuario">
			<h1><?php echo $comment["User"]["name"]." ".$comment["User"]["last_name"]?></h1>
			<img class="estrellas" src="/img/estrella_categoria.png" />
			<img class="estrellas" src="/img/estrella_categoria.png" />
			<img class="estrellas" src="/img/estrella_categoria.png" />
			<img class="estrellas" src="/img/estrella_categoria.png" />
			<img class="estrellas" src="/img/estrella_categoria.png" />
			<?php 
				if($comment["User"]["id"] == $this -> Session ->read("Auth.User.id")){
					echo $html -> link("borrar", array("controller" => "comments", "action"=> "delete",$comment['id']),array('class'=>'delete-comment','rel'=>$comment['id']));
				}
			?>
		</div>
		<div class="comentario">
			<p>
				<?php echo __($comment["comment"]); ?>
			</p>
		</div>
	<div style='clear:both;'></div>
	</div>
	
<?php
	endforeach;
}else{
	echo $this -> Html -> para('no-comments',"No hay comentarios disponibles");
}

?>
</div>