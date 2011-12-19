<?php
$userId=$this -> Session -> read('Auth.User.id');
if ($userId) {
	echo $this -> Form -> create("Comment", array('action' => 'add', 'id' => 'CommentForm'));
	echo $this -> Form -> hidden('model',array('value'=>$model));
	echo $this -> Form -> hidden('foreign_key',array('value'=>$foreign_key));
	echo $this -> Form -> textarea('comment',array("class"=>"comentario"));
	echo $this -> Form -> end("Enviar");
} else {
	echo $this -> Html -> link("DEBES AUTENTICARTE PARA AGREGAR COMENTARIOS",array("controller"=>"users"));
}
?>