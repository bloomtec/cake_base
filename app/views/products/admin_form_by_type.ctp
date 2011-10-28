<?php
if ($type_id == 1 || $type_id == 2) {
	echo $this -> Form -> input('Product.architecture_id', array('empty'=>'Seleccione...'));
	echo $this -> Form -> input('Product.Socket', array('type'=>'select', 'empty'=>'Seleccione...'));
}
if ($type_id == 2) {
	echo $this -> Form -> input('Product.is_video_included');
}
if (($type_id >= 2 && $type_id <= 6) || $type_id == 10 || $type_id == 13) {
	echo $this -> Form -> input('Slot.Slot');
}
echo $this -> Form -> input('Product.brand_id');
echo $this -> Form -> input('Product.name');
echo $this -> Form -> input('Product.description');
echo $this -> Form -> input('Product.ref');
echo $this -> Form -> input('Product.price');
echo $this -> Form -> input('Product.keywords');
echo $this -> Form -> input('Product.recommendations');
echo $this -> Form -> input('Product.is_gamers');
echo $this -> Form -> input('Product.is_active');
echo $this -> Form -> input('Product.is_featured');
echo $this -> Form -> input('Tag.Tag');
?>
