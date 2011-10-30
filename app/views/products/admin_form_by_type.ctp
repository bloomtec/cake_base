<?php
if ($type_id == 1 || $type_id == 2) {
	echo $this -> Form -> input('Product.architecture_id', array('empty' => 'Seleccione...'));
	echo $this -> Form -> input('Socket.Socket');
}
if ($type_id == 2) {
	echo $this -> Form -> input('Product.is_video_included');
}
if (($type_id >= 2 && $type_id <= 6) || $type_id == 10 || $type_id == 13) {
	echo $this -> Form -> input('Slot.Slot');
}
?>
