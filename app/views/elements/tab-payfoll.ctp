<div class="pane" id="payfoll">
	<div class="payfoll tab" rel="payfoll">
	</div>
	<div class="body">
		<div class="content" style="width:90%;">
			<div class="container-paginado no-actions friends" rel="/users/listFriends/criteria:">
					
			</div>
			<div class="container-search all" rel="/users/search/" id="tabSearch">
					
			</div>				
		</div>
		<div style="clear:both;"></div>
		<div class="search">
			<h2>Buscar</h2>
			<div class="criterios">
			<?php echo $form->input("email",array("label"=>"Email","id"=>"email"));?>	
			<?php echo $form->input("nombre",array("label"=>"Nombre","id"=>"nombre"));?>
			</div>
			<?php echo $form->button(" ",array("id"=>"searchPlayer")); ?>
		</div>
	</div>
</div>