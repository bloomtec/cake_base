<div class="friend-request">
	<?php
	echo $form -> create("Friendship", array("action" => "add", "id" => "request-friend"));
	//echo $this->Form->text('user_a_id',array());
	echo $this -> Form -> hidden('user_b_id', array("value" => $this -> params["named"]["to_id"]));
	echo $this -> Form -> hidden('is_accepted', array("value" => 0));
	echo $this -> Form -> hidden('is_blocked', array("value" => 0));
	echo $form -> label("Mensaje");
	echo "<div style=\"clear:both\"></div>";
	echo $this -> Form -> textArea("Message", array("label" => "Mensaje"));
	echo "<div class=\"confirmacion\"></div>";
	echo $form -> end(" ", array("id" => "request-friend-submit"));
?>
</div>