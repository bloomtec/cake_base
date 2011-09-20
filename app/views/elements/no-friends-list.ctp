<ul class="nomina listado">
		<?php foreach($friends as $user):?>
			<li class="player" rel="<?=$user["User"]["id"]?>">
				<div class="actions">
					<?php echo $html->link($html->image("boton-add.png"),"#",array("escape"=>false,"title"=>"A�adir","class"=>"add"))?>
				</div>
				<div class="image">
				<?php echo $html->link($html->image($user["UserField"][0]["image"]),array("controller"=>"users","action"=>"profile",$user["User"]["id"]),array("escape"=>false,"class"=>"overlay"));?>
				</div>
				<div class="name">
					<?php echo $user["UserField"][0]["name"]; ?>
				</div>	
				<div class="surname">
					<?php echo $user["UserField"][0]["surname"]; ?>
				</div>	
			</li>
		<?php endforeach;?>		
		<div style="clear:both;"></div>
</ul>
<div class="paging paging-list">		
	<?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class'=>'disabled'));?>
	<?php echo $this->Paginator->numbers(array("separator"=>""));?>
	<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>