<?php
	//debug($this->data);
	if ($type_id == 1 || $type_id == 2) :
		echo $this -> Form -> input('Product.architecture_id', array('empty' => 'Seleccione...', 'div'=>'class=input select required'));
		echo $this -> Form -> input('Socket.Socket', array('multiple'=>'checkbox', 'div'=>'input select required'));
?>
		<div id="sock_id" rel="<?php echo $this->data['Socket'][0]['id']; ?>"></div>
		<div id="sockets" class="input radio">
		</div>
<?php
	endif;
	
	if ($type_id == 2) {
		echo $this -> Form -> input('Product.is_video_included');
	}
	
	if (($type_id >= 2 && $type_id <= 6) || $type_id == 10 || $type_id == 14 || $type_id == 15) {
		//echo $this -> Form -> input('Slot.Slot', array('multiple'=>'checkbox', 'div'=>'input select required'));
		$i = 0;
	?>
		<table>
			<tr>
				<th>Slot</th>
				<th>Cantidad</th>
			</tr>
		<?php foreach($slots as $i=>$slot){
			$quantity = 0;
			if(isset($this->data['Slot']) && !empty($this->data['Slot'])) {
				foreach($this->data['Slot'] as $aSlot) {
					//debug($aSlot);
					if($aSlot['id']==$i){
						$quantity = $aSlot['ProductsSlot']['quantity'];
					}
				}
			}
		?>
			<tr>
				<td>
					<?php
						if($quantity) {
							echo $this -> Form -> checkbox('slots.'.$i.'.checked', array('id' => 'check'.$i, 'checked'=>true));
						} else {
							echo $this -> Form -> checkbox('slots.'.$i.'.checked', array('id' => 'check'.$i, 'checked'=>false));
						}
					?>
					<label for='check<?php echo $i ?>'> <?php echo $slot ?> </label>
				</td>
				<td>
					<?php
						if($quantity) {
							echo $this -> Form -> text ('slots.'.$i.'.quantity',array('value'=>$quantity, 'class'=>'quantity'));
						} else {
							echo $this -> Form -> text ('slots.'.$i.'.quantity',array('class'=>'quantity'));
						}
						$i += 1;
					?>
			</td>
			</tr>
		<?php } ?>
		</table>
		<?php
		
		if ($type_id == 5) {
			echo $this -> Form -> input('Product.is_big_casing_required', array('div'=>'input select required'));
			echo $this -> Form -> input('Product.required_power');
		}
	}
	
	if ($type_id == 7) {
		echo $this -> Form -> input('Product.is_power_supply_included', array('div'=>'input select required'));
		echo $this -> Form -> input('Product.is_big_casing', array('div'=>'input select required'));
	}
	
	if ($type_id == 13) {
		echo $this -> Form -> input('Product.power_output', array('div'=>'input select required'));
	}

?>
