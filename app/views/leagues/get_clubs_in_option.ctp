<?php if(isset($options)&&$options){?>
	<?php foreach($options as $value=>$name):?>
		<option value="<?php echo $value?>"><?php echo $name?></option>
	<?php endforeach;?>
<?php }else{ ?>
	<option value="">Seleccione</option>
<?php }?>
